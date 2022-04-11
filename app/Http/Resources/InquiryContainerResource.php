<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InquiryContainerResource extends JsonResource
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
            'inquiry_container_id' => $this->id,
            'container_id' => $this->container_id,
            'container' => $this->container->name ?? 'null',
            'quantity' => $this->quantity,
        ];
    }
}
