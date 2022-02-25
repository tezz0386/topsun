<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'address',
        'level',
        'designation',
        'contact_num',
        'detail',
        'image',
        'status'
    ];

    public function getTeams($n='')
    {
        $teams = [];
        if($n==''){
           $teams = Team::orderByDesc('created_at')->paginate(25);
        }elseif($n=='all'){
            $teams = Team::orderByDesc('created_at')->get();
        }
        else{
            $teams = Team::orderByDesc('created_at')->paginate($n);
        }
        return $teams;
    }

    public function getRules($act='add')
    {
        $rules=[
            'name'=>'required|string|max:250',
            'designation'=>'required|string|max:100',
            'level'=>'required|in:first,second,third',
            'contact_num'=>'nullable|string',
            'address'=>'nullable|string',
            'detail'=>'nullable|string',
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
