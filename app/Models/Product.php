<?php

namespace App\Models;

use App\FileManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =['name', 'image', 'description', 'price', 'discount'];

    protected $appends = ['totalPrice'];

    public function getImage()
    {
        return $this->image ? \Storage::url(FileManager::PRODUCT_IMAGE_PATH .$this->image) : null;
    }
    public function getTotalPriceAttribute()
    {
        return ( 1 - ($this->discount/100)) * $this->price;
    }
}
