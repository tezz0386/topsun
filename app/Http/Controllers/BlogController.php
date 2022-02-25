<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Support\ImageSupport;
use Kamaln7\Toastr\Facades\Toastr;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $imageSupport;
    protected $blog=null;
    protected $imageWidth=719;
    protected $imageHeight=400;
    protected $folderName='admin.blog.';

    public function __construct(Blog $blog,ImageSupport $imageSupport)
    {
        $this->blog=$blog;
        $this->imageSupport=$imageSupport;
        $this->data['n']=1;
        $this->data['page']='blog';
    }
    public function index($n='')
    {

        $this->data['blogs']=$this->blog->getBlogs($n);
        $this->data['activePage']='blog_list';
        return view($this->folderName.'index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        $this->data['activePage']='blog_create';
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

        $rules=$this->blog->getRules();
        $request->validate($rules);

        $data=$request->except('image');

        $image=$this->imageSupport->saveAnyImg($request, 'blogs', 'image', $this->imageWidth, $this->imageHeight);

        if($image)
        {
            $data['image']=$image;
        }

        $data['slug']=$this->blog->getSlugs($request->title);

        $this->blog->fill($data);
        $status=$this->blog->save();
        if($status)
        {
            Toastr::success('Successfully 1 Blog has added', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Adding Blog', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('blog.index')->with('success', 'Successfully 1 banner has added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        
        $this->data['activePage']='project_create';
        $this->data['blog']=$blog;
        return view($this->folderName.'form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $rules=$blog->getRules('update');
        $request->validate($rules);

        $data=$request->except('image');

        if($request->image)
        {
            if($blog->image && $blog->image !=null)
            {
                $this->imageSupport->deleteImg('blogs', $blog->image);
            }
            $image=$this->imageSupport->saveAnyImg($request, 'blogs', 'image', $this->imageWidth, $this->imageHeight);
            $data['image']=$image;
            
        }
        
        $blog->fill($data);
        $status=$blog->save($data);

        
        if($status)
        {
            Toastr::success('Successfully 1 Blog has Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Blog', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('blog.index')->with('success', 'Successfully 1 Blog has Updated');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $image=$blog->image;

        $status=$blog->delete();

        if($status)
        {
            if($image)
            {
                $this->imageSupport->deleteImg('blogs', $blog->image);
            }
            Toastr::success('Successfully 1 Blog has Deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Deleting Blog', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('blog.index')->with('success', 'Successfully 1 Blog has Deleted');
    }

    public function getStatusBlog($check)
    {
        $blog = Blog::where('status', $check)->paginate(25);
        $this->data['blogs']=$blog;
        $this->data['activePage']='project_list';
        return view($this->folderName.'index', $this->data)
        ->with('n',1);  
    }

    public function toBlog(Request $request)
    {
        // dd($request->all());
        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change', 'error !!!', ['positionClass'=>'toast-bottom-right']);
            return redirect()->route('blog.index')->with('error', 'Plz Select At Least One To Make Change');

        }
        
        if($request->multiple_action !='delete')
        {
            $this->blog->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);
            Toastr::success('Successsfully  Blog Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);


        }
        else
        {
            
            $this->blog->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Blog  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('blog.index')->with('success', 'Successfuly 1 Blog has updated');
        
        
    }
}
