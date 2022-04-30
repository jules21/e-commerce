<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id'=>$this->id,
            'image'=> $this->image ? $this->getImage() : null,
            'name'=> $this->name,
            'price'=> $this->price,
            'discount'=> $this->discount,
            'description'=> $this->description
        ];
    }
}
