<?php

namespace App\Http\Resources;

use App\Models\InquiryForwarderExtraCharge;
use App\Models\InquiryForwarderViaPorts;
use Illuminate\Http\Resources\Json\JsonResource;

class InquiryForwarderRateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data =  [
            'user_id' => $this->inquiryForwarder->inquiry->user->id,
            'user_name' => $this->inquiryForwarder->inquiry->user->name,
            'company_name' => $this->inquiryForwarder->inquiry->user->company_name,
            'company_email' => $this->inquiryForwarder->inquiry->user->company_email,
            'user_email' => $this->inquiryForwarder->inquiry->user->email,
            'inquiry_id' => $this->inquiryForwarder->inquiry->id,
            'forwarder_id' => $this->inquiryForwarder->forwarder_id ?? null,
            'forwarder' => $this->inquiryForwarder ?? null,
            'shippier_id' => $this->inquiryForwarder->inquiry->shipper_id ?? 'null',
            'shipper' => $this->inquiryForwarder->inquiry->shipper ?? 'null',
            'user' => $this->inquiryForwarder->inquiry->user,
            'service_id' => $this->inquiryForwarder->inquiry->service_id,
            'inquiry_forwarder_rate_id' => $this->id,
            'inquiry_forwarder_id' => $this->inquiryForwarder->id,
            'loading_port_id' => $this->loading_port_id ?? null,
            'destination_port_id' => $this->destination_port_id ?? null,
            'loading_port' => $this->loadingPort->name ?? 'null',
            'destination_port' => $this->destinationPort->name ?? 'null',
            'carrier_name' => $this->carrier->name ?? 'null',
            'carrier_id' => $this->carrier_id,
            'validity_date' => $this->validity_date,
            "free_days" => $this->free_days,
            "closing_date" => $this->closing_date,
            "vessel_departure" => $this->vessel_departure,
            "ship_transit_time"  => $this->ship_transit_time,
            "confirm_spaces" => $this->confirm_spaces,
            "rate" => $this->rate,
            "is_direct_route" => $this->is_direct_route,
            "containerRates" =>  InquiryForwarderContainerRateResource::collection($this->inquiryForwarderContainerRates),
            "extraCharges" => InquiryForwarderExtraChargeResource::collection($this->extraCharges),
            "via_ports" => "",

        ];
        if (!$this->is_direct_route) {
            $data['via_ports'] = InquiryForwarderViaPortResource::collection($this->viaPorts);
        }
        return $data;
    }
}
