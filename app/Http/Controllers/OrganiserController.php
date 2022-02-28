<?php

namespace App\Http\Controllers;

use App\Models\Organiser;
use Illuminate\Http\Request;
use App\Http\Traits\Upload;

class OrganiserController extends Controller
{
    //
    use Upload;

    public function index() {
        $organisers = Organiser::withCount(["projects"])->get();
        return view("organiser.index",compact('organisers'));
    }

    public function create(){ 

        return view("organiser.create");
    }
    
    public function store(Request $request) {
        $request->validate([
            "name" => "required",
            "description" => "required",
            "website" => "sometimes|url",
            "featured_image" => "sometimes|mimes:png,jpg"
        ]);

        // check slug.
        $slug_exists = Organiser::where('slug',\Str::slug($request->name,"-"))->exists();

        if ($slug_exists) {
            return response([
                "success" => false,
                "message" => "Organisation with similar name already exists."
            ]);
        }

        // now let's insert new return.
        $org = new Organiser;
        $org->name = $request->name;
        $org->slug = \Str::slug($request->name,"-");
        $org->description = $request->description;
        $org->website = $request->website;
        $org->country = $request->country;


        if ($request->hasFile("featured_image") ) {
            $org->featured_image = $this->upload($request,"featured_image")->id;
        }

        try {
            $org->save();
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                "success" => false,
                "message" => "Error: Unable to insert record.",
                "error" => $th->getMessage()
            ]);
        }


        $request->session()->flash("success","New Organisation data saved.");

        return response([
            "success" => true,
            "message" => "New Organisation data saved.",
            'redirect' => route('organiser.organiser.edit',[$org->id])
        ]);


    }

    public function show(Request $request, Organiser $organiser) {

    }

    public function edit(Request $request, Organiser $organiser) {

        return view("organiser.edit",compact("organiser"));
    }


    public function update(Request $request, Organiser $organiser) {
        $request->validate([
            "name" => "required",
            "description" => "required",
            "website" => "sometimes|url",
            "featured_image" => "sometimes|mimes:png,jpg"
        ]);

        $organiser->name = $request->name;

        if ($organiser->isDirty("name") ) {
            // re-check for slug.
            $slug_verify = Organiser::where('slug',\Str::slug($request->name))->first();
            if ( $slug_verify ) {
                return response([
                    "success" => false,
                    "message" => "Organisation already exists."
                ]);
            }

            $organiser->slug = \Str::slug($request->name,"-");
        }

        $organiser->description  = $request->description;

        if ($request->featured_image) {
            $organiser->featured_image = $this->upload($request,"featured_image")->id;
        }

        $organiser->website = $request->website;

        try {
            $organiser->save();
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                "success" => false,
                "message" => "Error: Unable to update.",
                "error" => $th->getMessage()
            ]);
        }
        $request->session()->flash("success","Record Updated");
        return response([
            "success" => true,
            "message" => "Record updated.",
            "redirect" => route('organiser.organiser.edit',$organiser->id)
        ]);
    }

    public function destroy(Request $request, Organiser $organiser) {
        
        try {
            $organiser->delete();
        } catch (\Throwable $th) {
            //throw $th;
            $request->session()->flash("message","Unable to delete.");
            return back();
        }

        $request->session()->flash("success","Organiser Deleted.");
        return back();
    }

    
    public function dashboardLoader(Request $request) {
        $all_orgs = Organiser::with(['f_image'])->latest()->get();
        return view("welcome.partials.orgs",compact("all_orgs"));
    }
}
