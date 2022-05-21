<?php

namespace App\Http\Resources\Forwarder;

use Illuminate\Http\Resources\Json\JsonResource;

class ForwarderUserResource extends JsonResource
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
            'id' => $this->id,
            'role_id' => $this->role_id,
            'company_name' => $this->company_name  ,
            'company_email' => $this->company_email,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'is_logged_in' => $this->is_logged_in,
            'is_terms_and_conditions' => $this->is_terms_conditions,
            'status' => $this->pivot->status
        ];
    }
}
