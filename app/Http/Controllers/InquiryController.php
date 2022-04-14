<?php

namespace App\Http\Controllers;

use App\Http\Resources\InquiryForwarderRateResource;
use App\Http\Resources\InquiryForwarderResource;
use App\Models\Inquiry;
use App\Models\InquiryForwarder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InquiryController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = Inquiry::class;
    }

    public function create(Request $request)
    {
        $user = request()->user();
        $inquiry= $user->inquiries()->create($request->all());
        $services = $request->get('serviceFields');
        $containers = $services['container'];
        $inquiry->seaFreight()->create($services);

        foreach ($user->forwarders as $forwarder) {
            $inquiryForwarderRates = $inquiry->inquiryForwarder()->create([
                'forwarder_id' => $forwarder->id
            ]);
        }
        foreach ($containers as $container) {
            $inquiry->inquiryContainers()->create($container);
        }
        return response()->json(['message' => 'Successfully added the Inquiry'], Response::HTTP_OK);
    }

    public function getInquires()
    {
        $user = request()->user();
        return response()->json(['inquires'=> InquiryForwarderResource::collection($user->inquiryForwarder)], Response::HTTP_OK);
    }

    public function inquiryAddRate(Request $request,$id){
        $inquiryForwarder = InquiryForwarder::find($id);
        $inquiryRates = $request->get('inquireRates');
        foreach ($inquiryRates as $inquiryRate){
            $inquiryForwarderRate = $inquiryForwarder->inquiryForwarderRate()
                ->create($inquiryRate);
            if(!$inquiryRate['is_direct_route'])
            {
                foreach ($inquiryRate['via_ports'] as $via_port)
                {
                    $inquiryForwarderRate->viaPorts()->create([
                       'port_id' => $via_port
                    ]);
                }
            }
            $extraRates = $inquiryRate['extraRates'];
            foreach ($extraRates as $extraCharge) {
                $inquiryForwarderRate->extraCharges()->create($extraCharge);
            }
            foreach ($inquiryRate['containerRates'] as $containerRate)
            {
                $inquiryForwarderRate->inquiryForwarderContainerRates()->create($containerRate);
            }
        }
        return response()->json(['message' => 'Successfully added the Inquiry'], Response::HTTP_OK);
    }


    public function getInquiryRate($id)
    {
        $user = request()->user();
        $inquiryForwarder = $user->inquiryForwarder()->where('inquiry_id',$id)->first();
        return response()->json(['inquiryRates'=> InquiryForwarderRateResource::collection($inquiryForwarder->inquiryForwarderRate)],
            Response::HTTP_OK);
    }

    public function addExtendedForwarders(Request $request)
    {
        $forwarders = $request->get('forwarder_ids');
        foreach ($forwarders as $forwarder) {
            InquiryForwarder::create([
                'inquiry_id' => $request->get('inquiry_id'),
                'status' => $request->get('status'),
                'forwarder_id' => $forwarder,
                'inquiry_forwarder_id' => $request->get('inquiry_forwarder_id'),
                'ref_forwarder_status' => $request->get('ref_forwarder_status'),
            ]);
        }
        $inquiryForwarder = InquiryForwarder::find($request->get('inquiry_forwarder_id'));
        $inquiryForwarder->status = 1;
        $inquiryForwarder->save();
        return response()->json(['message' => 'Successfully forwarded Inquiries'], Response::HTTP_OK);

    }

}
