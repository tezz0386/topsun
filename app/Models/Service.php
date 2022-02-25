<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'image',
        'status'
    ];

    public function getServices($n='')
    {
        $services = [];
        if($n==''){
           $services = Service::orderByDesc('created_at')->paginate(25);
        }elseif($n=='all'){
            $services = Service::orderByDesc('created_at')->get();
        }
        else{
            $services = Service::orderByDesc('created_at')->paginate($n);
        }
        return $services;
    }

    public function getRules($act='add')
    {
        $rules=[
            'title'=>'required|string|max:100',
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
