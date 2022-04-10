<?php

namespace App\Http\Controllers;

use App\Http\Resources\InquiryForwarderRateResource;
use App\Http\Resources\InquiryResource;
use App\Models\Inquiry;
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

        foreach ($services['forwarder_ids'] as $forwarder_id) {
            $inquiryForwarderRates = $inquiry->inquiryForwarderRates()->create([
                'forwarder_id' => $forwarder_id
            ]);
            foreach ($containers as $container) {
                $inquiryForwarderRates->inquiryForwarderContainerRate()->create($container);
            }
        }
        return response()->json(['message' => 'Successfully added the Inquiry'], Response::HTTP_OK);
    }

    public function getInquires()
    {
        $user = request()->user();
        return response()->json(['inquires'=>InquiryForwarderRateResource::collection($user->inquiryForwarderRate)], Response::HTTP_OK);
    }

    public function inquiryAddRate(Request $request,$id){
        $inquiryForwarder = InquiryForwarderRate::find($id);
    }

}
