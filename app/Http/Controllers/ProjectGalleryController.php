<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Traits\Upload;
use App\Models\ProjectGallery;

class ProjectGalleryController extends Controller
{
    //
    use Upload;
    public function store(Request $request, Project $project) {
        
        $gallery = new ProjectGallery;
        $gallery->project_id = $project->id;
        $gallery->file = $this->upload($request,"file");
        $gallery->save();

        return response([
            'success' => true,
            "message" => "Image uploaded",
            "image_data" => $gallery->id
        ]);

    }

    public function destroy(Request $request, ProjectGallery $project_gallery) {

        $project_gallery->delete();

        $request->session()->flash("success","Image Deleted From Gallery.");
        return back();
    }
}
