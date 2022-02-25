<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'status',
        'image'
    ];


    public function getSectors($n='')
    {
        $sectors = [];
        if($n==''){
           $sectors = Portfolio::orderByDesc('created_at')->paginate(25);
        }elseif($n=='all'){
            $sectors = Portfolio::orderByDesc('created_at')->get();
        }
        else{
            $sectors = Portfolio::orderByDesc('created_at')->paginate($n);
        }
        return $sectors;
    }

    public function getRules()
    {
        $rules=[
            'title'=>'required|string|max:150',
            'status'=>'required|in:active,inactive',
            'image'=>'sometimes|image|max:5000'
        ];



        return $rules;
    }

    public function getOrg()
    {
        return $this->hasMany('App\Models\Organization','portfolio_id','id')->where('status','active');
    }
}
