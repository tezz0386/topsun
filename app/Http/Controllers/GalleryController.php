<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

use App\Support\ImageSupport;
use Kamaln7\Toastr\Facades\Toastr;
use App\Models\GalleryImage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $imageSupport;
    protected $gallery=null;
    protected $imageWidth=500;
    protected $imageHeight=500;
    protected $folderName='admin.gallery.';
    protected $gallery_image=null;

    public function __construct(Gallery $gallery,ImageSupport $imageSupport,GalleryImage $gallery_image)
    {
        $this->gallery=$gallery;
        $this->imageSupport=$imageSupport;
        $this->data['n']=1;
        $this->data['page']='gallery';
        $this->gallery_image=$gallery_image;
    }
    public function index($n='')
    {

        $this->data['gallerys']=$this->gallery->getGallerys($n);
        $this->data['activePage']='gallery_list';
        return view($this->folderName.'index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        $this->data['activePage']='gallery_create';
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

        $rules=$this->gallery->getRules();
        $request->validate($rules);

        $data=$request->except('image');

        $data['created_by']=auth()->user()->id;

        $this->gallery->fill($data);
        $status=$this->gallery->save();

        if($status)
        {
            if($request->image)
            {
                $temp=[];
                foreach($request->image as $image_name)
                {
                    $image=$this->imageSupport->uploadImage($image_name,'Gallery',"500x500");
                    if($image)
                    {
                        $temp[]=array(
                            'gallery_id'=>$this->gallery->id,
                            'image'=>$image
                        );
                    }
                    
                }

                $this->gallery_image->insert($temp);
            }
            Toastr::success('Successfully 1 Gallery has added', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Adding Gallery', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('gallery.index')->with('success', 'Successfully 1 Gallery has added');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $this->data['activePage']='gallery_create';
        $this->data['gallery']=$gallery;
        return view($this->folderName.'form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $rules=$gallery->getRules('update');
        $request->validate($rules);

        $data=$request->except('image');
        $gallery->fill($data);
        $status=$gallery->save();
        if($status)
        {
            if($request->image)
            {
                $temp=[];
                foreach($request->image as $image_name)
                {
                    $image=$this->imageSupport->uploadImage($image_name,'Gallery',"500x500");
                    if($image)
                    {
                        $temp[]=array(
                            'gallery_id'=>$gallery->id,
                            'image'=>$image
                        );
                    }
                    
                }

                $this->gallery_image->insert($temp);
            }
            Toastr::success('Successfully 1 Gallery has updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Gallery', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('gallery.index')->with('success', 'Successfully 1 Gallery has updated');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $image=$gallery->getImage;
        if($image)
        {
            foreach($image as $image_name)
            {
                $this->imageSupport->deleteImg('Gallery', $image_name['image']);
            }
        }
        
        $del=$gallery->delete();
        if($del)
        {
            
            Toastr::success('Successfully 1 Gallery has deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Deleting Gallery', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('gallery.index')->with('success', 'Successfully 1 Gallery has deleted');

    }

    public function deleteImage(Request $request)
    {
        $image=$this->gallery_image->findOrFail($request->image_id);

        if($image)
        {
            $this->imageSupport->deleteImg('Gallery', $image->image);
            $image->delete();
        }
        else
        {
            return response()->json([
                'error'=>true,
                'data'=>null,
                'msg'=>'Invalid Image Id !'
            ],200);
        }
    }
}
