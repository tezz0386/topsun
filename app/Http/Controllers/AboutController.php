<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use App\Support\ImageSupport;
use Kamaln7\Toastr\Facades\Toastr;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $about=null;
    protected $imageSupport;
    protected $imageWidth=700;
    protected $imageHeight=500;
    protected $folderName='admin.about.';

    public function __construct(About $about,ImageSupport $imageSupport)
    {
        $this->about=$about;
        $this->imageSupport=$imageSupport;
        $this->data['n']=1;
        $this->data['page']='about';
    }

    

    public function index($n='')
    {
        $this->data['abouts']=$this->about->getAbouts($n);
        $this->data['activePage']='About_list';
        return view($this->folderName.'index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['activePage']='About_create';
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        $this->data['activePage']='about_create';
        $this->data['about']=$about;
        return view($this->folderName.'form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        


        $rules=$about->getRules();
        $request->validate($rules);

        $data=$request->except('image');

        if($request->image)
        {
            $image=$this->imageSupport->saveAnyImg($request, 'abouts', 'image', $this->imageWidth, $this->imageHeight);
            if($image)
            {
                if($about->image && $about->image !=null)
                {
                    $this->imageSupport->deleteImg('abouts',$about->image);
                }
                $data['image']=$image;
            }
        }
        $about->fill($data);
        $status=$about->save();
        if($status)
        {
            Toastr::success('Successfully 1 About Us has Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating ABout Us Page', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('about.index')->with('success', 'Successfully 1 About Us has Updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }

    public function updateStatus(Request $request,$id,$status)
    {
        $this->about=$this->about->findOrFail($id);

        if($status=='active')
        {
            $this->about->status='inactive';
        }
        else
        {
            $this->about->status='active';
        }

        $status=$this->about->save();

        if($status)
        {
            Toastr::success('Successfully 1 About Status has Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating ABout Status', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('about.index')->with('success', 'Successfully 1 About Status has Updated');
    }
}
