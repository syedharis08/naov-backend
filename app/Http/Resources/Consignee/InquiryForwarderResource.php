<?php

namespace App\Http\Resources\Consignee;

use App\Http\Resources\InquiryContainerResource;
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
            'inquiry_id' => $this->id,
            'volume' => $this->volume,
            'weight' => $this->weight,
            'date' => $this->seaFreight->date,
            'notes' => $this->notes,
            'is_dangerous' => $this->is_dangerous,
            'loading_port_id' => $this->seaFreight->loading_port_id,
            'destination_port_id' => $this->seaFreight->destination_port_id,
            'loading_port' => $this->seaFreight->loadingPort->name ?? Null,
            'destination_port' => $this->seaFreight->destinationPort->name ?? Null,
            'commodity' => $this->commodity ?? null,
            'containers' => InquiryContainerResource::collection($this->inquiryContainers)
        ];
    }
}
//
//foreach ($this->inquiryForwarder()->where('status', 0)->get() as $inquiryForwarder) {
//    return [
//        'inquiry_id' => $this->id,
//        'volume' => $this->volume,
//        'weight' => $this->weight,
//        'date' => $this->seaFreight->date,
//        'notes' => $this->notes,
//        'is_dangerous' => $this->is_dangerous,
//        'loading_port_id' => $this->seaFreight->loading_port_id,
//        'destination_port_id' => $this->seaFreight->destination_port_id,
//        'loading_port' => $this->seaFreight->loadingPort->name ?? Null,
//        'destination_port' => $this->seaFreight->destinationPort->name ?? Null,
//        'commodity' => $this->commodity ?? null,
//        'status' => $inquiryForwarder->status,
//        'containers' => InquiryContainerResource::collection($this->inquiryContainers)
//    ];
//}
