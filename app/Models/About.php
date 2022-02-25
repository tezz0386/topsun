<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable=[
        'title',
        'summary',
        'about_description',
        'our_mission',
        'our_mission_summary',
        'our_vision',
        'our_vision_summary',
        'our_objectives',
        'our_objectives_summary',
        'image',
        'video_link'
    ];


    public function getAbouts($n='')
    {
        $abouts = [];
        if($n==''){
           $abouts = About::orderByDesc('created_at')->paginate(25);
        }elseif($n=='all'){
            $abouts = About::orderByDesc('created_at')->get();
        }
        else{
            $abouts = About::orderByDesc('created_at')->paginate($n);
        }
        return $abouts;
    }

    public function getRules()
    {
        $rules=[
            'title'=>'required|string|max:150',
            'summary'=>'nullable|string',
            'about_description'=>'required|string',
            'our_mission_summary'=>'nullable|string',
            'our_vision_summary'=>'nullable|string',
            'our_objectives_summary'=>'nullable|string',
            'image'=>'sometimes|image|max:5000',
            'video_link'=>'required|string'
        ];

        return $rules;
    }
}
