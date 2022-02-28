<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function images() {
        return $this->hasMany(ProductGallery::class,"product_id");
    }

    public function featured() {
        return $this->hasOne(Uploader::class,"id","featured_image");
    }
}
