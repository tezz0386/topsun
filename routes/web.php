<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\Banner\BannerController;
use App\Http\Controllers\Admin\Project\ProjectController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Client\Category\ClientCategoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// --------------------------------------------Frontend Routes Starts Here-----------------------------------------------


	Route::group(['namespace'=>'App\Http\Controllers'],function(){

		Route::get('/','FrontEndController@index')->name('homepage');
		Route::get('/our-story','FrontendController@ourStory')->name('our-story');
		Route::get('/our-mission','FrontendController@ourMission')->name('our_mission');
		Route::get('/our-team','FrontendController@ourTeam')->name('our-team');
		Route::get('/project/list','FrontendController@project')->name('project-list');
		Route::get('/project/detail/{slug}','FrontendController@projectDetail')->name('project');
		Route::get('/blog/list','FrontendController@blogList')->name('blog-list');
		Route::get('/blog/detail/{slug}','FrontendController@blogDetail')->name('blog-detail');
		Route::get('/gallery','FrontendController@gallery')->name('gallery');
		Route::get('/gallery/list/{id}','FrontendController@galleryList')->name('gallery-list');
		Route::get('/contact','FrontendController@contact')->name('contact');
		Route::put('/post-message','FrontEndController@postMessage')->name('post-message');
		Route::get('/product/{slug}','FrontendController@product')->name('product');
		Route::get('/portfolio','FrontendController@portfolio')->name('portfolio');
		Route::get('get-sector','FrontEndController@getSector')->name('get-sector');
		Route::get('/event/{slug}','FrontendController@event')->name('event');
		
	});
// --------------------------------------------Frontend Routes Ends Here-----------------------------------------------




Auth::routes();
// -----------------------------------------Backend Routes Starts Here--------------------------------------------------
Route::get('/admin', [AdminHomeController::class, 'index'])->middleware('role:admin')->name('admin.dashboard');
Route::group(['prefix'=>'admin', 'middleware'=>'role:admin'], function(){
	// Route::get('/home', [HomeController::class, 'index'])->middleware('role:admin')->name('admin.dashboard');
	Route::resource('setting', SettingController::class)->except(['destroy', 'edit', 'show']);
	Route::resource('banner', BannerController::class)->except(['show']);
	Route::get('/projects/{n?}', [ProjectController::class, 'index'])->name('project.index');
	Route::resource('project', ProjectController::class)->except(['index']);
	Route::get('get-status-project/{check?}', [ProjectController::class, 'getStatusProject'])->name('get-status-project');

	// -------------------------------Project Routes Starts Here------------------------------------
	Route::post('to-project', [ProjectController::class, 'to'])->name('to-project');
	Route::get('/project/up-coming-project/list',[ProjectController::class, 'upCommingProject'])->name('up_comming');
	Route::get('/project/upcomming-date/{id}',[ProjectController::class, 'setCommingProject'])->name('project.set_upcomming');
	Route::put('/project/set/upcomming-date/{id}',[ProjectController::class, 'setupCommingDate'])->name('set-upcomming');
	// -------------------------------Project Routes Ends Here------------------------------------



	// -------------------------------Blog Routes Starts Here------------------------------------
	Route::resource('/blog',BlogController::class);
	Route::get('get-status-blog/{check?}', [BlogController::class, 'getStatusBlog'])->name('get-status-blog');
	Route::get('/blogs/{n?}', [BlogController::class, 'index'])->name('blog.index');
	Route::post('to-blog', [BlogController::class, 'toBlog'])->name('to-blog');
	// -------------------------------Blog Routes Ends Here------------------------------------


	Route::group(['namespace'=>'App\Http\Controllers'],function(){

	// -------------------------------Client Routes Starts Here------------------------------------
		Route::resource('/client','ClientController');
		Route::get('/{clientCategory}/clients','ClientController@getClients')->name('getClientsWithCategory');
		Route::get('get-status-client/{check?}','ClientController@getStatusClient')->name('get-status-client');
		Route::post('to-client','ClientController@toClient')->name('to-client');

			// FOR CLIENT CATEGORY
			Route::get('/client-category', [ClientCategoryController::class, 'index'])->name('client-category.index');
			Route::get('/client-category/create', [ClientCategoryController::class, 'create'])->name('client-category.create');
			Route::post('/client-category', [ClientCategoryController::class, 'store'])->name('client-category.store');
			Route::get('/client-category/edit/{clientCategory}', [ClientCategoryController::class, 'edit'])->name('client-category.edit');
			Route::patch('/client-category/edit/{clientCategory}', [ClientCategoryController::class, 'update'])->name('client-category.update');
			Route::delete('/client-category/{clientCategory}', [ClientCategoryController::class, 'destroy'])->name('client-category.destroy');
	// -------------------------------Client Routes Ends Here------------------------------------


	// -------------------------------About Routes Starts Here------------------------------------
		Route::resource('/about','AboutController');
		Route::get('/about/update-status/{id}/{status}','AboutController@updateStatus')->name('update-about-status');
	// -------------------------------About Routes Ends Here------------------------------------

	
	// --------------------------------Feature Routes Starts Here--------------------------------------------

		Route::resource('/feature','FeatureController');
		Route::get('get-status-feature/{check?}','FeatureController@getStatusFeature')->name('get-status-feature');
		Route::post('to-feature','FeatureController@toFeature')->name('to-feature');
		Route::get('/feature-about','AboutController@index')->name('admin.feature.index');
	// --------------------------------Feature Routes Ends Here--------------------------------------------


	// ----------------------------------Menu Section Routes Starts Here---------------------------------------------

		Route::resource('/menu','MenuController');
		Route::get('get-status-menu/{check?}','MenuController@getStatusMenu')->name('get-status-menu');
		Route::post('to-menu','MenuController@toMenu')->name('to-menu');
	// ----------------------------------Menu Section Routes Ends Here---------------------------------------------


	// ----------------------------------Service Section Routes Starts Here---------------------------------------------

		Route::resource('/service','ServiceController');
		Route::get('get-status-service/{check?}','ServiceController@getStatusService')->name('get-status-service');
		Route::post('to-service','ServiceController@toService')->name('to-service');

	// ----------------------------------Service Section Routes Ends Here---------------------------------------------


	// ----------------------------------Product Section Routes Starts Here---------------------------------------------

		Route::resource('/product','ProductController');
		Route::get('get-status-product/{check?}','ProductController@getStatusProduct')->name('get-status-product');
		Route::post('to-product','ProductController@toProduct')->name('to-product');

	// ----------------------------------Product Section Routes Ends Here---------------------------------------------


	// -------------------------------------Portfolio Section Starts Here------------------------------------------------

		Route::resource('/portfolio','PortfolioController');
		Route::get('get-status-sector/{check?}','PortfolioController@getStatusSector')->name('get-status-sector');
		Route::post('to-sector','PortfolioController@toSector')->name('to-sector');

	// -------------------------------------Portfolio Section Ends Here------------------------------------------------

	// -------------------------------------Organization Section Starts Here------------------------------------------------

		Route::resource('/organization','OrganizationController');
		Route::post('/to-org','OrganizationController@toOrg')->name('to-org');
		Route::get('get-status-org/{check?}','OrganizationController@getStatusOrg')->name('get-status-org');


	// -------------------------------------organization Section Ends Here------------------------------------------------

	// -------------------------------------Gallery Section Starts Here------------------------------------------------

	Route::resource('/gallery','GalleryController');


	// -------------------------------------Gallery Section Ends Here------------------------------------------------


	// -------------------------------------Portfolio Section Starts Here------------------------------------------------

	Route::resource('/team','TeamController');
	Route::get('get-status-team/{check?}','TeamController@getStatusTeam')->name('get-status-team');
	Route::post('/to-team','TeamController@toTeam')->name('to-team');
	Route::resource('/ourTeam','OurTeamController');
	
	
	// -------------------------------------Portfolio Section Ends Here------------------------------------------------

	// -------------------------------------Banner Video Section Starts Here------------------------------------------------

	Route::resource('/bannerVideo','BannerVideoController');
	
	
	// -------------------------------------Banner Video Section Ends Here------------------------------------------------

	// ----------------------------------------News Section Starts Here---------------------------------------------

		Route::resource('/news','NewsController');

	// ----------------------------------------News Section Ends Here---------------------------------------------
	});

	
});

Route::group(['namespace'=>'App\Http\Controllers','middleware'=>'auth'],function(){
	Route::get('/delete-image','GalleryController@deleteImage');

});
// -----------------------------------------Backend Routes Ends Here--------------------------------------------------

