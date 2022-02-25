<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'status',
        'created_by',
        'content'
    ];

    public function getGallerys($n='')
    {
        $gallerys = [];
        if($n==''){
           $gallerys = Gallery::orderByDesc('created_at')->paginate(25);
        }elseif($n=='all'){
            $gallerys = Gallery::orderByDesc('created_at')->get();
        }
        else{
            $gallerys = Gallery::orderByDesc('created_at')->paginate($n);
        }
        return $gallerys;
    }

    public function getRules($act='add')
    {
        $rules=[
            'title'=>'required|string|max:200',
            'status'=>'required|in:active,inactive',
            'content'=>'nullable|string',
            'image*'=>'required|image|max:5000'
        ];

        if($act !='add')
        {
            $rules['image*']='sometimes|image|max:5000';
        }

        return $rules;
    }

    public function getImage()
    {
        return $this->hasMany('App\Models\GalleryImage','gallery_id','id');
    }
}
