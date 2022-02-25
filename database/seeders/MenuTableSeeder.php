<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     $list=array(
    //         array(
    //             'title'=>'Home',
    //             'status'=>'active',
    //         ),
    //         array(
    //             'title'=>'About',
    //             'status'=>'active',
    //         ),
    //         array(
    //             'title'=>'Products',
    //             'status'=>'active',
    //         ),
    //         array(
    //             'title'=>'Projects',
    //             'status'=>'active',
    //         ),
    //         array(
    //             'title'=>'Blogs',
    //             'status'=>'active',
    //         ),
    //         array(
    //             'title'=>'Gallery',
    //             'status'=>'active',
    //         ),
    //         array(
    //             'title'=>'Portfolio',
    //             'status'=>'active',
    //         ),
    //         array(
    //             'title'=>'Contact',
    //             'status'=>'active',
    //         )
    //     );

    //     foreach($list as $menu_info)
    //     {
    //         if(Menu::where('title',$menu_info['title'])->count() <=0)
    //         {
    //             $menu=new Menu();
    //             $menu->fill($menu_info);
    //             $menu->save();
    //         }
    //     }
    // }
}
