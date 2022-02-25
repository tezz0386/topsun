<?php

namespace App\Models\Admin\Project;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UpcommingProject;
class Project extends Model
{
    use HasFactory;
    use Sluggable;
    protected $path = 'uploads/projects/thumbnail/';
    protected $fillable=[
        'created_by',
        'title',
        'slug',
        'image',
        'summary',
        'description',
        'started_at',
        'finished_at',
        'status',
        'title_tag',
        'meta_keywords',
        'meta_description',
        'upcomming_status'
    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getProjects($n='')
    {
        $projects = [];
        if($n==''){
           $projects = Project::orderByDesc('created_at')->paginate(25);
        }elseif($n=='all'){
            $projects = Project::orderByDesc('created_at')->get();
        }elseif($n=='up-comming'){
            $projects=$this->where('upcomming_status','yes')->get();
        }
        else{
            $projects = Project::orderByDesc('created_at')->paginate($n);
        }
        return $projects;
    }

    

    
}
