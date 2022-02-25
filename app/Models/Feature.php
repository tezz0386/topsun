<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'summary',
        'status',
        'image'
    ];

    public function getFeatures($n='')
    {
        $features = [];
        if($n==''){
           $features = Feature::orderByDesc('created_at')->paginate(25);
        }elseif($n=='all'){
            $features = Feature::orderByDesc('created_at')->get();
        }
        else{
            $features = Feature::orderByDesc('created_at')->paginate($n);
        }
        return $features;
    }

    public function getRules($act='add')
    {
        $rules=[
            'title'=>'required|string|max:100',
            'summary'=>'required|string',
            'status'=>'required|in:active,inactive',
            'image'=>'required|image|max:5000'
        ];

        if($act !='add')
        {
            $rules['image']='sometimes|image|max:5000';
        }
        return $rules;
    }
}
