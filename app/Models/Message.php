<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable=[
        'customer_name',
        'phone',
        'email',
        'customer_message',
        'subject'
    ];

    public function getRules()
    {
        $rules=[
            'customer_name'=>'required|string|max:250',
            'email'=>'required|email',
            'phone'=>'nullable|string',
            'subject'=>'required|string|max:200',
            'customer_message'=>'required|string'
        ];

        return $rules;
    }
}
