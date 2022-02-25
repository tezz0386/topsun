<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BannerVideo;

class BannerVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list=array(
            array(
                'title'=>'Banner Video',
                'video'=>'banner.mp4'
            )
        );

        foreach($list as $video)
        {
            if(BannerVideo::where('title',$video['title'])->count() <=0)
            {
                $videos=new BannerVideo();
                $videos->fill($video);
                $videos->save();
            }
        }
    }
}
