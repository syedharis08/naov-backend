<?php

namespace App\Http\Controllers;

use App\Http\Resources\InquiryExtendedForwarderRateResource;
use App\Http\Resources\InquiryForwarderRateResource;
use App\Http\Resources\InquiryForwarderResource;
use App\Http\Resources\Consignee\InquiryForwarderResource as ConsigneeInquiryResource;
use App\Models\Inquiry;
use App\Models\InquiryDocument;
use App\Models\InquiryForwarder;
use App\Models\InquiryForwarderRate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class   InquiryController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = Inquiry::class;
    }

    public function create(Request $request)
    {
        $user = request()->user();
        $inquiry = $user->inquiries()->create($request->all());
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
        $inquiryForwarders = $user->inquiryForwarder()->where('status', 0)
            ->whereHas('inquiry', function ($query) {
                return $query->where('inquiries.status', 0);
            })
            ->with('inquiry')
            ->latest()->get();
        return response()->json(['inquires' => InquiryForwarderResource::collection($inquiryForwarders)], Response::HTTP_OK);
    }

    public function getConsigneeInquires()
    {
        $user = request()->user();
        $inquiries = $user->inquiries()->where('status', 0)->latest()->get();
        return response()->json(['inquires' => ConsigneeInquiryResource::collection($inquiries)], Response::HTTP_OK);
    }

    public function inquiryAddRate(Request $request, $id)
    {
        $inquiryForwarder = InquiryForwarder::find($id);
        $inquiryRates = $request->get('inquireRates');
        foreach ($inquiryRates as $inquiryRate) {
            $inquiryForwarderRate = $inquiryForwarder->inquiryForwarderRate()
                ->create($inquiryRate);
            if (!$inquiryRate['is_direct_route']) {
                foreach ($inquiryRate['via_ports'] as $via_port) {
                    $inquiryForwarderRate->viaPorts()->create([
                        'port_id' => $via_port
                    ]);
                }
            }
            $extraRates = $inquiryRate['extraRates'];
            foreach ($extraRates as $extraCharge) {
                $inquiryForwarderRate->extraCharges()->create($extraCharge);
            }
            foreach ($inquiryRate['containerRates'] as $containerRate) {
                $inquiryForwarderRate->inquiryForwarderContainerRates()->create($containerRate);
                // $inquiryContainerRates = $inquiryForwarderRate->inquiryForwarderContainerRates()->create($containerRate);
                // if ($containerRate['extraCharges']) {
                //     foreach ($containerRate['extraCharges'] as $containerRateExtraCharge) {
                //         $inquiryContainerRates->inquiryForwarderContainerRateExtraCharges()->create($containerRateExtraCharge);
                //     }
                // }
            }
        }
        return response()->json(['message' => 'Successfully added the Inquiry'], Response::HTTP_OK);
    }


    public function getInquiryRate($id)
    {
        $user = request()->user();
        $inquiryForwarder = $user->inquiryForwarder()->where('inquiry_id', $id)->first();
        return response()->json(
            ['inquiryRates' => InquiryForwarderRateResource::collection($inquiryForwarder->inquiryForwarderRate)],
            Response::HTTP_OK
        );
    }

    public function addExtendedForwarders(Request $request)
    {
        $forwarders = $request->get('forwarder_ids');
        foreach ($forwarders as $forwarder) {
            InquiryForwarder::create([
                'inquiry_id' => $request->get('inquiry_id'),
                'status' => 0,
                'forwarder_id' => $forwarder,
                'inquiry_forwarder_id' => $request->get('inquiry_forwarder_id'),
                'ref_forwarder_status' => 2,
            ]);
        }
        $inquiryForwarder = InquiryForwarder::find($request->get('inquiry_forwarder_id'));
        $inquiryForwarder->ref_forwarder_status = 1;
        $inquiryForwarder->status = 0;
        $inquiryForwarder->save();
        return response()->json(['message' => 'Successfully forwarded Inquiries'], Response::HTTP_OK);
    }

    public function getExtraRate($id)
    {
        $inquiryForwarder = InquiryForwarder::where('id', $id)->first();
        return response()->json(
            ['extendedRates' =>
                InquiryExtendedForwarderRateResource::collection($inquiryForwarder->inquiryExtendedForwarders)],
            Response::HTTP_OK
        );
    }

    public function getConsigneeInquiryRate($id)
    {
        $inquiry = Inquiry::find($id);
        $inquiryForwarderRates = $inquiry->inquiryForwarderRates()->where('inquiry_forwarders.status', 0)->get();
        return response()->json(['inquiryRates' => InquiryForwarderRateResource::collection($inquiryForwarderRates)], Response::HTTP_OK);
    }

    public function consigneeInquiryAcceptRate($inquiryId, $inquiryForwarderRateId, Request $request)
    {
        $inquiry = Inquiry::find($inquiryId);
        $inquiryForwarderRate = InquiryForwarderRate::find($inquiryForwarderRateId);
        $inquiry->forwarder_id = $inquiryForwarderRate->forwarder_id;
        $inquiry->status = 1;
        $inquiry->save();
        $inquiryForwarderRate->status = 1;
        $inquiryForwarderRate->save();
        $inquiryForwarderRate->inquiryForwarder()->update([
            'status' => 2
        ]);
        if ($inquiryForwarderRate->inquiry_extended_forwarder_rate_id) {
            $inquiryExtendedForwarderRate = InquiryForwarderRate::where('id', $inquiryForwarderRate->inquiry_extended_forwarder_rate_id)->first();
            $inquiryExtendedForwarderRate->status = 1;
            $inquiryExtendedForwarderRate->save();
            $extendInquiryForwarder = $inquiryExtendedForwarderRate->inquiryForwarder;
            $extendInquiryForwarder->update([
                'status' => 2
            ]);
        }
        if ($request->has('shipper_id'))
            $inquiry->update([
                'shipper_id' => $request->shipper_id
            ]);
        return response()->json(['message' => 'Successfully Accepted Rate'], Response::HTTP_OK);
    }

    public function extendedForwarderRateAcceptance($id, $rate_id)
    {
        $inquiryForwarder = InquiryForwarder::find($id);
        $inquiryForwarder->rate_status = 1;
        $inquiryForwarder->save();
//        $inquiryForwarderRate = InquiryForwarderRate::find($rate_id);
//        $inquiryForwarderRate->status = 1;
//        $inquiryForwarderRate->save();
        return response()->json(['message' => 'Successfully Accepted Rate'], Response::HTTP_OK);
    }


    public function addDocument(Request $request)
    {
        $user = request()->user();
        $inquiry = Inquiry::find($request->get('inquiry_id'));
        $request['document_path'] = request('document')->store($this->model::UPLOAD_DIRECTORY);
        $request['user_id'] = $user->id;
        $inquiry->inquiryDocuments()->create($request->all());
        return response()->json(['message' => 'Successfully Added Document'], Response::HTTP_OK);
    }

    public function getDocuments($id)
    {
        $inquiry = Inquiry::find($id);
        $documents = $inquiry->inquiryDocuments;
        return response()->json(['documents' => $documents], Response::HTTP_OK);
    }

    public function getDocument($id)
    {
        $document = InquiryDocument::find($id);
        return response()->json(['document' => $document], Response::HTTP_OK);
    }

    public function inquiryChangeStatus(Request $request)
    {
        $inquiry = Inquiry::find($request->get('inquiry_id'));
        $inquiry->status = $request->get('status');
        $inquiry->save();
        // $inquiryForwarder = InquiryForwarder::find($request->get('inquiry_forwarder_id'));
        // $inquiryForwarder->status = $request->get('status');
        // $inquiryForwarder->save();
        return response()->json(['message' => 'Successfully Status updated'], Response::HTTP_OK);
    }


    public function getAcceptedInquiries()
    {
        $user = request()->user();
        $inquiries = $user->inquiries()->where('status', '!=', 0)->latest()->get();
        $shipperInquiries = $user->shipperInquiries()->where('status', '!=', 0)->latest()->get();
        return response()->json([
            'shipperInquires' => ConsigneeInquiryResource::collection($shipperInquiries), 'inquires' => ConsigneeInquiryResource::collection($inquiries)
        ], Response::HTTP_OK);
    }

    public function getForwarderAcceptedInquires()
    {
        $user = request()->user();
        $inquiryForwarders = $user->inquiryForwarder()->where('status', '!=', 0)->latest()->get();
//        $inquiryForwarders = $user->inquiryForwarder()->where('status', '!=', 0)
//            ->whereHas('inquiryExtendedForwarders',
//                function ($query) {
//                    return $query->where('rate_status', '!=',0);
//                })
//            ->with('inquiryExtendedForwarders')->get();
        return response()->json(['inquiries' => InquiryForwarderResource::collection($inquiryForwarders)], Response::HTTP_OK);
    }

    public function getAcceptedRateConsignee($id)
    {
        $inquiry = Inquiry::find($id);
        if ($inquiry) {
            $inquiryForwarderRates = $inquiry->inquiryForwarderRates()->where('inquiry_forwarder_rates.status', 1)
                ->get();
            return response()->json(['inquiryRates' => InquiryForwarderRateResource::collection($inquiryForwarderRates)], Response::HTTP_OK);
        }
    }

    public function getAcceptedRateForwarder($id)
    {
        $user = request()->user();
        $inquiryForwarder = $user->inquiryForwarder()->where('inquiry_id', $id)->where('status', '=', 2)->first();
        $inquiryForwarderRate = $inquiryForwarder->inquiryForwarderRate()->where('status', '1')->first();
        return response()->json(
            ['inquiryRates' => [InquiryForwarderRateResource::make($inquiryForwarderRate)]],
            Response::HTTP_OK
        );
    }


    public function getInquiryAcceptedForwarderRate($id)
    {
        $user = request()->user();
        $inquiryForwarders = InquiryForwarder::where('inquiry_id', $id)->whereHas('inquiryForwarderRate', function ($query) {
            return $query->where('inquiry_extended_forwarder_rate_id', '!=', null);
        })->with('inquiryForwarderRate')->get();

        if ($inquiryForwarders) {
            foreach ($inquiryForwarders as $inquiryForwarder) {
                $inquiryForwarderRate = collect($inquiryForwarder->inquiryForwarderRate)->filter(function ($item) {
                    return $item->status == 1 && !is_null($item->inquiry_extended_forwarder_rate_id);
                });
            }
        }

        if (isset($inquiryForwarderRate) && count($inquiryForwarderRate) > 0) {
            $inquiryForwarderRate = collect($inquiryForwarderRate)->first();
            $inquiryExtendedForwarderRate = $inquiryForwarderRate->extendedForwarderRate;
            if ($inquiryForwarderRate->inquiryForwarder->forwarder_id == $user->id) {
                return response()->json(
                    ['inquiryRates' => [InquiryForwarderRateResource::make($inquiryForwarderRate)],
                        'extendedRates' => [InquiryForwarderRateResource::make($inquiryExtendedForwarderRate)]
                    ],
                    Response::HTTP_OK
                );
            } else {
                return response()->json(
                    ['inquiryRates' => [InquiryForwarderRateResource::make($inquiryExtendedForwarderRate)],
                    ],
                    Response::HTTP_OK
                );
            }
        }

        $inquiryForwarder = $user->inquiryForwarder()->where('inquiry_id', $id)->where('status', '=', 2)->first();
        if ($inquiryForwarder) {
            $inquiryForwarderRate = $inquiryForwarder->inquiryForwarderRate()->where('status', '1')->first();

            return response()->json(
                ['inquiryRates' => [InquiryForwarderRateResource::make($inquiryForwarderRate)]],
                Response::HTTP_OK
            );
        }

        return response()->json(
            ['error' => 'Not Found'],
            Response::HTTP_NOT_FOUND
        );
    }


    public function inquiryVesselDeparted($id)
    {
        $user = request()->user();
        $inquiryForwarder = $user->inquiryForwarder()->where('inquiry_id', $id)->where('status', '=', 2)->first();
        $inquiryForwarderRate = $inquiryForwarder->inquiryForwarderRate()->where('status', '=', 1)->first();
        $inquiryForwarderRate->vessel_departure = date("Y-m-d H:i:s");
        $inquiryForwarderRate->save();
        return response()->json(
            ['message' => 'Vessel Departed'],
            Response::HTTP_OK
        );
    }


    public function updateDocument($id, Request $request)
    {
        $document = InquiryDocument::find($id);
        if (request('document')) {
            $request['document_path'] = request('document')->store($this->model::UPLOAD_DIRECTORY);
        }
        $document->update($request->all());
        return response()->json(['message' => 'Successfully Updated the Document'], Response::HTTP_OK);
    }


    public function rateDelete($rate_id)
    {
        $inquiryForwarderRate = InquiryForwarderRate::find($rate_id);
        $extendedForwarderRates = InquiryForwarderRate::where('inquiry_extended_forwarder_rate_id',$inquiryForwarderRate->id)->get();
        foreach ($extendedForwarderRates as $extendedForwarderRate)
        {
            $extendedForwarderRate->inquiryForwarderContainerRates()->delete();
            $extendedForwarderRate->extraCharges()->delete();
            $extendedForwarderRate->viaPorts()->delete();
        }
        $inquiryForwarderRate->inquiryForwarderContainerRates()->delete();
        $inquiryForwarderRate->extraCharges()->delete();
        $inquiryForwarderRate->viaPorts()->delete();
        return response()->json(['message' => 'Rate Deleted Successfully'], Response::HTTP_OK);
    }

    public function rateInquiryDelete($inquiryForwarderId)
    {
        $inquiryForwarder = InquiryForwarder::find($inquiryForwarderId);
        foreach ($inquiryForwarder->inquiryForwarderRate as $inquiryForwarderRate)
        {
            $extendedForwarderRates = InquiryForwarderRate::where('inquiry_extended_forwarder_rate_id',$inquiryForwarderRate->id)->get();
            foreach ($extendedForwarderRates as $extendedForwarderRate)
            {
                $extendedForwarderRate->inquiryForwarderContainerRates()->delete();
                $extendedForwarderRate->extraCharges()->delete();
                $extendedForwarderRate->viaPorts()->delete();
            }
            $inquiryForwarderRate->inquiryForwarderContainerRates()->delete();
            $inquiryForwarderRate->extraCharges()->delete();
            $inquiryForwarderRate->viaPorts()->delete();
        }
        foreach ($inquiryForwarder->inquiryExtendedForwarders as $inquiryForwarderExtendedRate)
        {
            foreach ($inquiryForwarderExtendedRate->inquiryForwarderRate as $inquiryForwarderRate)
            {
                $extendedForwarderRates = InquiryForwarderRate::where('inquiry_extended_forwarder_rate_id',$inquiryForwarderRate->id)->get();
                foreach ($extendedForwarderRates as $extendedForwarderRate)
                {
                    $extendedForwarderRate->inquiryForwarderContainerRates()->delete();
                    $extendedForwarderRate->extraCharges()->delete();
                    $extendedForwarderRate->viaPorts()->delete();
                }
                $inquiryForwarderExtendedRate->inquiryForwarderContainerRates()->delete();
                $inquiryForwarderExtendedRate->extraCharges()->delete();
                $inquiryForwarderExtendedRate->viaPorts()->delete();
            }
        }

        $inquiryForwarder->delete();
        return response()->json(['message' => 'Rate Deleted Successfully'], Response::HTTP_OK);

    }
}
