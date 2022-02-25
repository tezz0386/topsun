<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'slug',
        'image',
        'summary',
        'description',
        'status',
        'title_tag',
        'meta_keywords',
        'meta_description'
    ];

    public function getRules($act='add')
    {
        
        $rules=[
            'title'=>'required|String|max:250',
            'summary'=>'nullable|string',
            'description'=>'nullable|string',
            'title_tag'=>'nullable|string',
            'meta_keywords'=>'nullable|string',
            'meta_description'=>'nullable|string',
            'status'=>'required|in:active,inactive',
            'image'=>'required|image|max:5000'
        ];

        if($act !='add')
        {
            $rules['image']='nullable|image|max:5000';
        }

        return $rules;
    }

    public function getSlugs($title)
    {
        $slug=\Str::slug($title);

        if($this->where('slug',$slug)->count() >0)
        {
            $slug=$slug."-".rand(0,9999);
            $this->getSlugs($slug);
        }

        return $slug;


    }

    
    public function getBlogs($n='')
    {
        $blogs = [];
        if($n==''){
           $blogs = Blog::orderByDesc('created_at')->paginate(25);
        }elseif($n=='all'){
            $blogs = Blog::orderByDesc('created_at')->get();
        }
        else{
            $blogs = Blog::orderByDesc('created_at')->paginate($n);
        }
        return $blogs;
    }

}
