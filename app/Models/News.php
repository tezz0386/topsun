<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'slug',
        'image',
        'is_news',
        'is_popup',
        'url'
    ];

    public function getNews($n='')
    {
        $news = [];
        if($n==''){
           $news = News::orderByDesc('created_at')->paginate(25);
        }elseif($n=='all'){
            $news = News::orderByDesc('created_at')->get();
        }
        else{
            $news = News::orderByDesc('created_at')->paginate($n);
        }
        return $news;
    }

    public function getRules($act='add',$is_news)
    {
        // dd($is_news);


        $rules=[
            'title'=>'required|string|max:250',
            'url'=>'required|url',
            'is_news'=>'required|in:yes,no',
            'is_popup'=>'required|in:yes,no',
            'image'=>'required|image|max:5000'
        ];

        if($is_news !='yes')
        {
            $rules['url']='nullable|url';
        }

        if($act !='add')
        {
            $rules['image']='sometimes|image|max:5000';
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
}
