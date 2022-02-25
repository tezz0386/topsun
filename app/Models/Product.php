<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'status',
        'image',
        'description'
    ];

    public function getRules($act='add')
    {
        $rules=[
            'title'=>'required|string|max:250',
            'image'=>'required|image|max:5000',
            'status'=>'required|in:active,inactive',
            'description'=>'nullable|string'
        ];

        if($act !='add')
        {
            $rules['image']='sometimes|image|max:5000';
        }

        return $rules;
    }


    public function getProducts($n='')
    {
        $products = [];
        if($n==''){
           $products = Product::orderByDesc('created_at')->paginate(25);
        }elseif($n=='all'){
            $products = Product::orderByDesc('created_at')->get();
        }
        else{
            $products = Product::orderByDesc('created_at')->paginate($n);
        }
        return $products;
    }
}
