<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // DB::table('users')->insert([
        //     'name'=>'Tejendra Dangaura',
        //     'email'=>'dangaura.tejendra.123@gmail.com',
        //     'password'=>Hash::make('tezz0386'),
        //     'role'=>'admin',
        //     'created_at'=>Carbon::now(),
        //     'updated_at'=>Carbon::now(),
        // ]);
        // DB::table('settings')->insert([
        //     'name'=>'App Name',
        //     'email'=>'example@gmail.com',
        //     'contact_no'=>'980577500',
        //     'address'=>'Kohalpur Kathmandu',
        // ]);

        // DB::table('abouts')->insert([
        //     'title'=>'About Us',
        //     'about_description'=>'About Us description',
        //     'our_mission'=>'Our Mission',
        //     'our_mission_summary'=>'Our Mission Summary',
        //     'our_vision'=>'Our Vision',
        //     'our_vision_summary'=>'Our Vision Summary',
        //     'our_objectives'=>'Our Objectives',
        //     'our_objectives_summary'=>'Our Objectives Summary',
        //     'status'=>'active'
        // ]);
        
        // $this->call(MenuTableSeeder::class);
        $this->call(OurTeamSedeer::class);
        $this->call(BannerVideoSeeder::class);

    }
}
