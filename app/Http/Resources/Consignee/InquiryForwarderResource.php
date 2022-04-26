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
        $data = [
            'forwarder_id' => $this->forwarder_id ?? null,
            'inquiry_forwarder_id' => $this,
            'forwarder' => $this->forwarder ?? null,
            'shipper' => $this->shipper ?? 'null',
            'user' => $this->user,
            'service_id' => $this->service_id,
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
            'status' => $this->status,
            'containers' => InquiryContainerResource::collection($this->inquiryContainers)
        ];

        if ($this->user->id) {
            $userAddress = $this->user->address;
            $userAddress->country;
            $userAddress->state;
            $userAddress->city;
            $data['user_address'] = $userAddress;
        }

        if ($this->shipper_id) {
            $data['shipper_id'] = $this->shipper_id;
            $shipperAddress = $this->shipper->address;
            $shipperAddress->country;
            $shipperAddress->state;
            $shipperAddress->city;
            $data['shipper_address'] = $shipperAddress;
        }
        return $data;
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
