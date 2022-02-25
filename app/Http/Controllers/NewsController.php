<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Support\ImageSupport;
use Kamaln7\Toastr\Facades\Toastr;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $news=null;
    protected $imageSupport;
    protected $imageWidth=1920;
    protected $imageHeight=1080;
    protected $folderName='admin.news.';

    public function __construct(News $news,ImageSupport $imageSupport)
    {
        $this->news=$news;
        $this->imageSupport=$imageSupport;
        $this->data['n']=1;
        $this->data['page']='news_list';
    }

    public function index($n='')
    {
        $this->data['news']=$this->news->getNews($n);
        $this->data['activePage']='news_list';
        return view($this->folderName.'index', $this->data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['activePage']='news_list';
        return view($this->folderName.'form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $is_news=$request->is_news;

        // dd($is_news);

        $rules=$this->news->getRules('add',$is_news);
        $request->validate($rules);
        $data=$request->except('image');
        $image=$this->imageSupport->saveAnyImg($request, 'news', 'image', $this->imageWidth, $this->imageHeight);
        if($image)
        {
            $data['image']=$image;
        }

        $data['slug']=$this->news->getSlugs($request->title);

        $this->news->fill($data);
        $status=$this->news->save();

        if($status)
        {
            Toastr::success('Successfully 1 News/Notice has added', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Adding News/Notice', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('news.index')->with('success', 'Successfully 1 News/Notice has added');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $this->data['activePage']='news_list';
        $this->data['new']=$news;
        return view($this->folderName.'form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $is_news=$request->is_news;

        $rules=$news->getRules('update',$is_news);
        $request->validate($rules);
        $data=$request->except('image');
        if($request->image)
        {
            $image=$this->imageSupport->saveAnyImg($request, 'news', 'image', $this->imageWidth, $this->imageHeight);
            if($image)
            {
                if($news->image && $news->image !=null)
                {
                    $this->imageSupport->deleteImg('news', $news->image);
                }
                $data['image']=$image;
            }
        }

        $news->fill($data);
        $status=$news->save();

        if($status)
        {
            Toastr::success('Successfully 1 News/Notice has updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating News/Notice ', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('news.index')->with('success', 'Successfully 1 News/Notice  has updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $image=$news->image;
        $del=$news->delete();
        if($del)
        {
            if($image && $image !=null)
            {
                $this->imageSupport->deleteImg('news', $image);
            }
            Toastr::success('Successfully 1 News/Notice has deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Deleting News/Notice', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('news.index')->with('success', 'Successfully 1 News/Notice has deleted');
    }
}
