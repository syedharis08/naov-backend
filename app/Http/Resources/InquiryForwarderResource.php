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
        return [
            'inquiry_forwarder_id' => $this->id,
            'service_id' => $this->service_id,
            'extended_forwarder' => $this->ref_forwarder_status,
            'user' => $this->inquiry->user,
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
            'shipper_id' =>$this->inquiry->shipper_id ?? null,
            'status' => $this->inquiry->status,
            'containers' => InquiryContainerResource::collection($this->inquiry->inquiryContainers)
        ];
    }
}
