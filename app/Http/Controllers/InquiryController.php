<?php

namespace App\Http\Controllers;

use App\Http\Resources\InquiryForwarderRateResource;
use App\Http\Resources\InquiryResource;
use App\Models\Inquiry;
use App\Models\InquiryForwarder;
use App\Models\InquiryForwarderExtraCharge;
use App\Models\InquiryForwarderRate;
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
        return response()->json(['inquires'=>$user->inquiryForwarderRate], Response::HTTP_OK);
    }

    public function inquiryAddRate(Request $request,$id){
        $inquiryForwarder = InquiryForwarder::find($id);
        $inquiryRates = $request->get('inquireRates');
        foreach ($inquiryRates as $inquiryRate){
            $inquiryForwarderRate = $inquiryForwarder->inquiryForwarderRate()
                ->create($inquiryRate);
            $extraRates = $inquiryRate['extraRates'];
            foreach ($extraRates as $extraCharge) {
                $inquiryForwarderRate->extraCharges()->create($extraCharge);
            }
            foreach ($inquiryRate['containerRates'] as $containerRate)
            {
                $inquiryForwarderRate->inquiryForwarderContainerRates()->create($containerRate);
            }
        }
    }

}
