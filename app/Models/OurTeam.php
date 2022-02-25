<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurTeam extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'image',
        'description'
    ];

    public function getOurTeams($n='')
    {
        $our_teams = [];
        if($n==''){
           $our_teams = OurTeam::orderByDesc('created_at')->paginate(25);
        }elseif($n=='all'){
            $our_teams = OurTeam::orderByDesc('created_at')->get();
        }
        else{
            $our_teams = OurTeam::orderByDesc('created_at')->paginate($n);
        }
        return $our_teams;
    }

    public function getRules()
    {
        $rules=[
            'title'=>'required|string|max:150',
            'image'=>'required|image|max:5000',
            'description'=>'nullable|string'
        ];

        return $rules;
    }
}
