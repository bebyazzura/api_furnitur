<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=> $this->name,
            'image' => $this->image,
            'description' => $this->description,
            'price' => $this->price,
            'seller'=> $this->seller,
            'seller_name' => $this->seller_name
        ];
    }
}
