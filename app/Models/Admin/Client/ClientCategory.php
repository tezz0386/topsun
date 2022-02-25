<?php

namespace App\Models\Admin\Client;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientCategory extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'status',
    ];
    public function clients()
    {
        return $this->hasMany(Client::class,'category_id');
    }

}
