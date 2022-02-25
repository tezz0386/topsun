<?php

namespace App\Providers;

use App\Models\Admin\Setting\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Models\Admin\Project\Project;
use App\Models\Client;
use App\Models\Message;
use App\Models\News;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        // -------------------------Project Section-----------------------------------
        View::composer(['front.front_layout'],function($view){
            $view->with('project',Project::where('status','active')->orderBy('id','DESC')->get());
        });
        // -------------------------Project Section-----------------------------------


        // -------------------------Client Section-----------------------------------

        View::composer(['front*'],function($view){
            $view->with('client',Client::where('status','active')->orderBy('id','DESC')->get());
        });

        // -------------------------Client Section-----------------------------------

        // -------------------------Setting Section-----------------------------------

        View::composer(['front.front_layout'],function($view){
            $view->with('setting',Setting::first());
        });

        // -------------------------Setting Section-----------------------------------


         // -------------------------Contact Section-----------------------------------

         View::composer(['layouts.admin.partial.navbar'],function($view){
            $view->with('message',Message::whereDate('created_at',today())->get());
        });

        // -------------------------Contact Section-----------------------------------

        // -------------------------News Section-----------------------------------

        View::composer(['front*'],function($view){
            $view->with('news',News::orderBy('id','DESC')->get());
        });


        // -------------------------News Section-----------------------------------

         // -------------------------Popup Section-----------------------------------

         View::composer(['front.index'],function($view){
            $view->with('popup',News::where('is_popup','yes')->orderBy('id','DESC')->first());
        });


        // -------------------------Popup Section-----------------------------------

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $setting = Setting::find(1);
        View::share('setting', $setting);
        define('SITE_NAME', $setting->name);
    }
}
