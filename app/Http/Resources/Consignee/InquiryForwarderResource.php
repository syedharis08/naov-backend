<?php

namespace App\Http\Resources\Consignee;

use App\Http\Resources\InquiryContainerResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class InquiryForwarderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        foreach ($this->inquiryForwarder()->where('status', 0)->get() as $inquiryForwarder) {
            return [
                'inquiry_id' => $this->inquiry->id,
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
                'containers' => InquiryContainerResource::collection($this->inquiry->inquiryContainers)
            ];
        }
    }
}
