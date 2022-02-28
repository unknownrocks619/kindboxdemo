<?php

namespace App\Http\Traits;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Uploader;
/**
 * 
 */
trait Upload
{

    private $thumb = false;
    private $width = 244;
    private $height = 163;
    private $thumb_path = 'thumbnails';

    public function enable_thumbnail() {
        $this->thumb = true;
    }

    public function disable_thumbnail() {
        $this->thumb = false;
    }

    public function setRatio($width,$height) {
        $this->width = $width;
        $this->height = $height;
    }

    public function set_thumb_path($path) {
        $this->thumb_path = $path;
    }

    public function getProperty($property) {

        if (property_exists($this,$property) ) {
            return $this->$property;
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request,$file_name = null, $folder="site")
    {   
        //
        if ( ! $file_name && $request->hasFile('file')) {
            
            // let's upload and set in the given location
            $uploader = new Uploader();

            // orginal filename 
            $uploader->original_name = $request->file('file')->getClientOriginalName();
            $uploader->file_type = $request->file('file')->getMimeType();
            $uploader->path =  Storage::putFile($folder,$request->file('file')->path());
            
            if ($this->getProperty("thumb") ) {
                $uploader->thumb = $this->generate_thumbnail($request);
            }
            $uploader->save();
            return $uploader;
        }

        if ($request->hasFile($file_name)) {

            // let's upload and set in the given location
            $uploader = new Uploader();
            $file_detail = [
                "original_name" =>$request->file($file_name)->getClientOriginalName (),
                'file_type' => $request->file($file_name)->getMimeType(),
                'path' =>Storage::putFile('site',$request->file($file_name)->path())
            ];

            if ($this->getProperty("thumb") ) {
                $file_detail["thumb"] = $this->generate_thumbnail($request,$file_name);
            }
            // orginal filename 
        
            return $uploader->create($file_detail);
        }
    }

    public function generate_thumbnail(Request $request, $file_name = 'file'){
        
        if ($this->getProperty("thumb") ) {
            $image      = $request->file($file_name);
            $fileName   = $image->hashName();
            // dd($fileName);
            $img = \Image::make($image->getRealPath());
            $img->resize($this->getProperty("width"), $this->getProperty("height"), function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            //dd();
            $disk = Storage::disk('local')->put($this->getProperty("thumb_path").'/'.$fileName, $img, 'public');
            return $this->getProperty('thumb_path')."/".$fileName;
        }
        return null;
    }
   
}
