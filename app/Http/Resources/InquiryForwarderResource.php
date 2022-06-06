<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InquiryForwarderResource extends JsonResource
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
            'inquiry_forwarder_id' => $this->id,
            'service_id' => $this->inquiry->service_id,
            'extended_forwarder' => $this->ref_forwarder_status,
            'user' => $this->inquiry->user,
            'user_address' => $this->inquiry->user->address,
            'inquiry_id' => $this->inquiry_id,
            'volume' => $this->inquiry->volume,
            'weight' => $this->inquiry->weight,
            'date' => $this->inquiry->seaFreight->date,
            'notes' => $this->inquiry->notes,
            'is_dangerous' => $this->inquiry->is_dangerous,
            'loading_port_id' => $this->inquiry->seaFreight->loading_port_id,
            'destination_port_id' => $this->inquiry->seaFreight->destination_port_id,
            'loading_port' => $this->inquiry->seaFreight->loadingPort->name ?? Null,
            'destination_port' => $this->inquiry->seaFreight->destinationPort->name ?? Null,
            'commodity' => $this->inquiry->commodity ?? null,
            'shipper' => $this->inquiry->shipper ?? null,
            'shipper_id' => $this->inquiry->shipper_id ?? null,
            'vessel_departure' => $this->inquiry->vessel_departure ?? null,
            'ship_transit_time' => $this->acceptedInquiryForwarderRate->ship_transit_time ?? null,
            'status' => $this->inquiry->status,
            'rateMessage' => count($this->inquiryForwarderRate) > 0 ? "Click to view rates" : " ",
            'containers' => InquiryContainerResource::collection($this->inquiry->inquiryContainers)
        ];


        if ($this->inquiry->shipper_id) {
            $data['shipper_address'] = AddressResource::make($this->inquiry->shipper->address);
        }

        return $data;
    }
}
