<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'names' => [
                'first' => $this->first_name,
                'last' => $this->last_name,
                'full' => $this->first_name.' '.$this->last_name,
            ],
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'paystubs' => PaystubResource::collection(
                $this->whenLoaded('paystubs')
            ),
        ];
    }
}
