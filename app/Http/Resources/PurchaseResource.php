<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
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
            "id"=> $this->id,
            "product_id"=> $this->product_id,
            "user_id"=> $this->user_id,
            "amount"=> $this->amount,
            "status"=> $this->status,
            "product"=> new ProductResource($this->whenLoaded('product')),
        ];
    }
}
