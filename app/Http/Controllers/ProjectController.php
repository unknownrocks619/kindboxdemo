<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Organiser;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Traits\Upload;
use App\Models\ProjectGallery;

class ProjectController extends Controller
{
    //
    use Upload;
    public function index() {
        $projects = Project::withCount(["images"])->get();
        return view("projects.index",compact("projects"));
    }

    public function create(){
        $orgs = Organiser::get();
        $cats = Category::get();
        return view('projects.create',compact("orgs","cats"));
    }

    public function store(Request $request) {
        $request->validate([
            "project_name" => "required",
            "category" => "required",
            "organisor" => "required",
            "description" => "required",
            "featured_image" => "required",
            "project_budget" => "required",
            "country" => "required",
            "city" => "required",
            "address" => "required",
        ]);

        $project = new Project;
        $project->organiser_id = $request->organisor;
        $project->project_title = $request->project_name;
        $project->slug = \Str::slug($request->project_name,'-');
        $project->country = $request->country;
        $project->city = $request->city;
        $project->address = $request->address;
        $project->total_budget = $request->project_budget;
        $project->deduct_amount = 10;
        $project->total_collected = 0;
        $project->completed = false;
        $project->category_id = $request->category;
        $project->description = $request->description;

        if ($request->hasFile("featured_image") ) {
            $project->featured_image = $this->upload($request,'featured_image')->id;
        }
        try {
            $project->save();
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'success' => false,
                "message" => "Unable to create new project.",
                "error" => $th->getMessage()
            ]);
        }
        $request->session()->flash('success',"Project Created.");
        return response([
            "success" => true,
            "message" => "Please wait.... redirecting in few seconds.",
            "redirect" => route('organiser.list_project_images',$project->id)
        ]);
    }

    public function edit(Request $request, Project $project)  {
        $orgs = Organiser::get();
        $cats = Category::get();
        return view("projects.edit",compact('project',"orgs","cats"));
    }

    public function update(Request $request, Project $project) {
        $request->validate([
            "project_name" => "required",
            "category" => "required",
            "organisor" => "required",
            "description" => "required",
            "project_budget" => "required",
            "country" => "required",
            "city" => "required",
            "address" => "required",
        ]);

        $project->organiser_id = $request->organisor;
        $project->project_title = $request->project_name;
        $project->description = $request->description;
        if ($project->isDirty("project_title") ) {
            $project->slug = \Str::slug($request->project_name,'-');
        }
        $project->country = $request->country;
        $project->city = $request->city;
        $project->address = $request->address;
        $project->total_budget = $request->project_budget;
        $project->deduct_amount = 10;
        $project->total_collected = 0;
        $project->completed = false;
        $project->category_id = $request->category;
        $project->map_link = $request->map_link;
        $project->map_embed = $request->map_embed;

        if ($request->hasFile("featured_image") ) {
            $project->featured_image = $this->upload($request,'featured_image')->id;
        }
        try {
            $project->save();
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'success' => false,
                "message" => "Unable to create new project.",
                "error" => $th->getMessage()
            ]);
        }
        $request->session()->flash('success',"Project Updated.");
        return response([
            "success" => true,
            "message" => "",
            "redirect" => route('organiser.project.edit',$project->id)
        ]);
    }

    public function destroy(Request $request,Project $project) {
        
        $project->delete();

        $request->session()->flash("success","Project Deleted.");
        return back();
    }

    public function images(Project $project) {
        $p_images = ProjectGallery::where("project_id",$project->id)->paginate(10);
        return view("projects.images.index",compact('project','p_images'));
    }

    public function dashboardLoader(Request $request) {
        $projects = Project::with(['uploaded_image',"project_org"])->latest()->get();
        return view("welcome.partials.project",compact("projects"));
    }

    public function view_transaction(Request $request, Project $project) {
        return view("projects.transactions",compact("project"));
    }

    /**
     * Public view.
     */

     public function list_project() {
         $projects = Project::with(["uploaded_image"])->latest()->get();
         return view("pages.projects.index",compact("projects"));
     }

     public function project_detail(Project $project , $slug) {

        return view('pages.projects.detail',compact('project'));
     }
}
