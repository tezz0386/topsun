<?php 

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ImageSupport
{

    public function uploadImage($image,$dir,$thumb="50x50")
    {
        list($thumb_width,$thumb_height)=explode("x",$thumb);
        
        $path=public_path().'/Uploads/'.$dir;
        if(!File::exists($path))
        {
            File::makeDirectory($path,0777,true,true);
        }

        $image_name=ucfirst($dir)."-".date("YmdHis")."-".rand(0,9999).".".$image->getClientOriginalExtension();

        $status=$image->move($path,$image_name);
        if($status)
        {
            Image::make($path."/".$image_name)->resize($thumb_width,$thumb_height,function($constraint){
                return $constraint->aspectRatio();
            })->save($path."/".$image_name);

            return $image_name;
        }
        else
        {
            return null;
        }
    }

    public  function saveGallery($file=NULL,$folder_name,$width, $height)
    {
        $filenamewithextension =$file->getClientOriginalName();
        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $file->getClientOriginalExtension();
        //filename to store
        $filenametostore = $filename.'_'.time().'.'.$extension;

        //Upload File
        $image=$file->move('uploads/'.$folder_name, $filenametostore);
        $img = Image::make($image->getPathname());
        $img->fit($width, $height);
        $path = sprintf('%s/thumbnail/%s', $image->getPath(), $image->getFilename());
        $directory = sprintf('%s/thumbnail', $image->getPath());
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        $img->save($path);
        File::delete(public_path('uploads/'.$folder_name.'/'.$filenametostore));
        return $filenametostore;
    }
    public  function saveAnyImg(Request $request,$folder_name,$imageName,$width,$height)
    {
        $filenamewithextension = $request->file($imageName)->getClientOriginalName();
        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        

        //get file extension
        $extension = $request->file($imageName)->getClientOriginalExtension();

        //filename to store
        $filenametostore = $filename.'_'.time().'.'.$extension;

        //Upload File
        $image=$request->file($imageName)->move('uploads/'.$folder_name, $filenametostore);
        $img = Image::make($image->getPathname());
        $img->fit($width, $height);
        $path = sprintf('%s/thumbnail/%s', $image->getPath(), $image->getFilename());
        $directory = sprintf('%s/thumbnail', $image->getPath());
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        $img->save($path);
        File::delete(public_path('uploads/'.$folder_name.'/'.$filenametostore));
        return $filenametostore;
    }
    public  function saveImg(Request $request,$folder_name,$imageName)
    {
        $filenamewithextension = $request->file($imageName)->getClientOriginalName();
        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file($imageName)->getClientOriginalExtension();

        //filename to store
        $filenametostore = $filename.'_'.time().'.'.$extension;

        //Upload File
        $image=$request->file($imageName)->move('uploads/'.$folder_name, $filenametostore);
        $img = Image::make($image->getPathname());
        $path = sprintf('%s/thumbnail/%s', $image->getPath(), $image->getFilename());
        $directory = sprintf('%s/thumbnail', $image->getPath());
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        $img->save($path);
        File::delete(public_path('uploads/'.$folder_name.'/'.$filenametostore));
        return $filenametostore;
    }
    public function deleteImg($folder_name,$file_name)
    {
        File::delete(public_path('uploads/'.$folder_name.'/'.$file_name));
        File::delete(public_path('uploads/'.$folder_name.'/thumbnail/'.$file_name));
    }
}


 ?>