<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function images() {
        return $this->hasMany(ProjectGallery::class,"project_id");
    }

    public function uploaded_image() {
        return $this->belongsTo(Uploader::class,"featured_image");
    }

    public function project_org(){
        return $this->belongsTo(Organiser::class,"organiser_id");
    }

    public function project_transaction() {
        return $this->hasMany(ProjectTransaction::class,"project_id");
    }
}
