<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable=[
        'portfolio_id',
        'title',
        'status',
        'pdf'
    ];

    public function getOrganizations($n='')
    {
        $organizations = [];
        if($n==''){
           $organizations = Organization::orderByDesc('created_at')->paginate(25);
        }elseif($n=='all'){
            $organizations = Organization::orderByDesc('created_at')->get();
        }
        else{
            $organizations = Organization::orderByDesc('created_at')->paginate($n);
        }
        return $organizations;
    }

    public function getRules($act='add')
    {
        $rules=[
            'title'=>'required|string|max:150',
            'status'=>'required|in:active,inactive',
            'pdf'=>'required|mimes:pdf,doc,docx|max:10000',
            'portfolio_id'=>'required|exists:portfolios,id'
        ];

        if($act !='add')
        {
            $rules['pdf']='sometimes|mimes:pdf,doc,docx|max:10000';
        }

        return $rules;
        
    }

    public function uploadFile($title,$pdf)
    {
        $fileName = ucfirst($title)."-".time().'.'.$pdf->extension();  
   
        $status=$pdf->move(public_path('uploads/file/'), $fileName);
        if($status)
        {
            return $fileName;
        }
        else
        {
            return null;
        }
    }

    public function getOrg()
    {
        return $this->hasOne('App\Models\Portfolio','id','portfolio_id');
    }

    public function deleteFile($file)
    {
        $path="uploads/file/".$file;
        if($path)
        {
            unlink($path);
        }
    }
}
