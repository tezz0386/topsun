<?php

namespace App\Http\Controllers;

use App\Models\BannerVideo;
use Illuminate\Http\Request;
use App\Support\ImageSupport;
use Kamaln7\Toastr\Facades\Toastr;

class BannerVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $imageSupport;
    protected $bannerVideo=null;
    protected $imageWidth=719;
    protected $imageHeight=400;
    protected $folderName='admin.banner-video.';

    public function __construct(BannerVideo $bannerVideo,ImageSupport $imageSupport)
    {
        $this->bannerVideo=$bannerVideo;
        $this->imageSupport=$imageSupport;
        $this->data['n']=1;
        $this->data['page']='banner_video';
    }
    public function index($n='')
    {

        $this->data['videos']=$this->bannerVideo->getVideos($n);
        $this->data['activePage']='banner_video_create';
        return view($this->folderName.'index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BannerVideo  $bannerVideo
     * @return \Illuminate\Http\Response
     */
    public function show(BannerVideo $bannerVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BannerVideo  $bannerVideo
     * @return \Illuminate\Http\Response
     */
    public function edit(BannerVideo $bannerVideo)
    {
        $this->data['activePage']='banner_video_create';
        $this->data['videos']=$bannerVideo;
        return view($this->folderName.'form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BannerVideo  $bannerVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BannerVideo $bannerVideo)
    {
        // dd($request->video);
        $rules=$bannerVideo->getRules();
        $request->validate($rules);

        $data=$request->except('video');


        $video=$this->bannerVideo->uploadVideo($request->title,$request->video);

        if($video)
        {
            if($bannerVideo->video && $bannerVideo->video !=null)
            {
                $bannerVideo->deleteVideo($bannerVideo->video);
            }
            $bannerVideo->deleteVideo($bannerVideo->video);

            $data['video']=$video;
        }

        // dd($data);

        $bannerVideo->fill($data);
        $status=$bannerVideo->save();
        if($status)
        {
            Toastr::success('Successfully Banner Video has Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Banner Video', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('bannerVideo.index')->with('success', 'Successfully Banner Video has Updated');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BannerVideo  $bannerVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(BannerVideo $bannerVideo)
    {
        //
    }
}
