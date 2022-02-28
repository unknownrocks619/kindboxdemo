<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organiser extends Model
{
    use HasFactory;

    public function projects() {
        return $this->hasMany(Project::class,"organiser_id");
    }

    public function f_image() {
        return $this->hasOne(Uploader::class,"id","featured_image");
    }
}
