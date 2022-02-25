<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerVideo extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'video'
    ];

    public function getVideos($n='')
    {
        $bannerVideos = [];
        if($n==''){
           $bannerVideos = BannerVideo::orderByDesc('created_at')->paginate(25);
        }elseif($n=='all'){
            $bannerVideos = BannerVideo::orderByDesc('created_at')->get();
        }
        else{
            $bannerVideos = BannerVideo::orderByDesc('created_at')->paginate($n);
        }
        return $bannerVideos;
    }

    public function getRules()
    {
        $rules=[
            'title'=>'required|string|max:100',
            'video'=>'required|mimes:mp4,mov,ogg,qt|max:100000'
        ];

        return $rules;
    }

    public function uploadVideo($title,$pdf)
    {
        $fileName = ucfirst($title)."-".time().'.'.$pdf->extension();  
   
        $status=$pdf->move(public_path('uploads/video/'), $fileName);
        if($status)
        {
            return $fileName;
        }
        else
        {
            return null;
        }
    }

    public function deleteVideo($video)
    {
        $path=public_path()."/uploads/video/".$video;
        if(file_exists($path))
        {
            unlink($path);
        }

    }
}
