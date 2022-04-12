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
            'user' => $this->inquiry->user,
            'inquiry_id' => $this->inquiry_id,
            'volume' => $this->inquiry->volume,
            'weight' => $this->inquiry->weight,
            'date' => $this->date,
            'notes' => $this->inquiry->notes,
            'is_dangerous' => $this->inquiry->is_dangerous,
            'loading_port_id' => $this->inquiry->seaFreight->loading_port_id,
            'destination_port_id' => $this->inquiry->seaFreight->destination_port_id,
            'loading_port' => $this->inquiry->seaFreight->loadingPort->name ?? Null,
            'destination_port' => $this->inquiry->seaFreight->destinationPort->name ?? Null,
            'commodity' => $this->inquiry->commodity ?? null,
            'containers' => InquiryContainerResource::collection($this->inquiry->inquiryContainers)
        ];
    }
}
