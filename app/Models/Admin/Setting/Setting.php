<?php

namespace App\Models\Admin\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable =[
    	'name',
        'quotation',
    	'icon',
    	'logo',
		'close_day',
		'open_time',
		'close_time',
    	'email',
    	'contact_no',
		'contact_no_2',
    	'location',
    	'address',
    	'facebook_link',
    	'twitter_link',
		'insta_link',
    	'youtube_link',
    	'linkedin_link',
		'whatsapp_no',
		'viber_no',
		'google_link',
		'title_tag',
		'meta_keywords',
		'meta_description',
    ];

	public function getRules()
	{
		$rules=[
			'name'=>'required|string|max:200',
			'close_day'=>'required|string',
			'open_time'=>'required|string',
			'close_time'=>'required|string',
			'email'=>'required|email',
			'address'=>'required|string',
			'contact_no'=>'required|string',
			'contact_no_2'=>'required|string',
			'location'=>'required|string',
			'facebook_link'=>'nullable|string',
			'twitter_link'=>'nullable|string',
			'insta_link'=>'nullable|string',
			'youtube_link'=>'nullable|string',
			'linkedin_link'=>'nullable|string',
			'google_link'=>'nullable|string',
			'whatsapp_no'=>'nullable|string',
			'viber_no'=>'nullable|string',
			'title_tag'=>'nullable|string',
			'meta_keywords'=>'nullable|string',
			'meta_description'=>'nullable|string',
			'quotation'=>'nullable|string',
			'icon'=>'nullable|image|max:5000',
			'logo'=>'nullable|image|max:5000',

		];

		return $rules;
	}
}


