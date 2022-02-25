<?php

namespace App\Models;

use App\Models\Admin\Client\ClientCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'status',
        'address',
        'phone',
        'url',
        'email',
        'image',
        'category_id',
    ];


    public function getClients($n='')
    {
        $clients = [];
        if($n==''){
           $clients = Client::orderByDesc('created_at')->paginate(25);
        }elseif($n=='all'){
            $clients = Client::orderByDesc('created_at')->get();
        }
        else{
            $clients = Client::orderByDesc('created_at')->paginate($n);
        }
        return $clients;
    }

    public function getRules($act='add')
    {
        $rules=[
            'name'=>'required|string|max:250',
            'email'=>'nullable|email',
            'phone'=>'nullable|string',
            'url'=>'nullable|url',
            'address'=>'nullable|string',
            'status'=>'required|in:active,inactive',
            'image'=>'required|image|max:5000',
            'category'=>'required',
        ];

        if($act !='add')
        {
            $rules['image']='sometimes|image|max:5000';
        }

        return $rules;
    }
    public function category()
    {
        return $this->belongsTo(ClientCategory::class, 'category_id');
    }
}
