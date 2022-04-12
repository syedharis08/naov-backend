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
            'id' => $this->id,
            'carrier_name' => $this->carrier_id,
            'carrier_id' => $this->carrier->name ?? Null,
            'validity_date' => $this->validity_date,
            "free_days" => $this->free_days,
            "closing_date" => $this->closing_date,
            "vessel_departure" => $this->vessel_departure ,
            "ship_transit_time"  => $this->ship_transit_time,
            "confirm_spaces" => $this->confirm_spaces,
            "rate" => $this->rate,
            "is_direct_route" => $this->is_direct_route ,
            "containerRates" =>  InquiryForwarderContainerRateResource::collection($this->inquiryForwarderContainerRates),
            "extraCharges" => InquiryForwarderExtraChargeResource::collection($this->extraCharges),
            "via_ports" => "",
            ];
        if(!$this->is_direact_route)
        {
            $data['via_ports'] = InquiryForwarderViaPortResource::collection($this->viaPorts);
        }
        return $data;
    }
}
