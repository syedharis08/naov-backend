<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class InquiryForwarderContainerRateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "inquiry_container_id" => $this->inquiry_container_id,
            "loading_exw_charge" => $this->loading_exw_charge,
            "destination_exw_charge" => $this->destination_exw_charge,
            "rate" => $this->rate,
            "container" => $this->inquiryContainer->container,
            "quantity" => $this->inquiryContainer->quantity,
            "extraCharges" => $this->inquiryForwarderContainerRateExtraCharges,
        ];
    }
}
