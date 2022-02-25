<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feature;
use App\Models\About;
use App\Models\Product;
use App\Models\Service;
use App\Models\Admin\Project\Project;
use App\Models\Team;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Portfolio;
use App\Models\Organization;
use App\Models\Message;
use Mail;
use App\Mail\Enquiry;
use App\Models\OurTeam;
class FrontendController extends Controller
{
    
    protected $feature=null;
    protected $about=null;
    protected $product=null;
    protected $service=null;
    protected $project=null;
    protected $team=null;
    protected $blog=null;
    protected $gallery=null;
    protected $portfolio=null;
    protected $organization=null;
    protected $message=null;
    protected $ourTeam=null;

    public function __construct(Feature $feature,About $about,Product $product,Service $service,Project $project,Team $team,Blog $blog,Gallery $gallery,Portfolio $portfolio,Organization $organization,Message $message,OurTeam $ourTeam)
    {
        $this->feature=$feature;
        $this->about=$about;
        $this->product=$product;
        $this->service=$service;
        $this->project=$project;
        $this->team=$team;
        $this->blog=$blog;
        $this->gallery=$gallery;
        $this->portfolio=$portfolio;
        $this->organization=$organization;
        $this->message=$message;
        $this->ourTeam=$ourTeam;
    }

    public function index()
    {


        $this->feature=$this->feature->where('status','active')->limit(4)->get();
        // dd($this->feature);

        $this->about=$this->about->first();

        $this->product=$this->product->where('status','active')->limit(4)->orderBy('id','DESC')->get();

        $this->service=$this->service->where('status','active')->orderBy('id','DESC')->get();

        $project=$this->project->where('status','active')->limit(4)->orderBy('id','DESC')->get();

        $upcomming_event=$this->project->where('upcomming_status','yes')->where('status','active')->limit(3)->orderBy('id','DESC')->get();

        

        
        return view('front.index')
        ->with('Features',$this->feature)
        ->with('about',$this->about)
        ->with('products',$this->product)
        ->with('services',$this->service)
        ->with('projects',$project)
        ->with('upcomming_project',$upcomming_event);
    }

    public function ourStory()
    {
        $this->about=$this->about->first();


        return view('front.about.our_story')
        ->with('about',$this->about);
    }

    public function ourMission()
    {
        $this->about=$this->about->first();

        return view('front.about.our_mission')
        ->with('about',$this->about);

    }

    public function ourTeam()
    {
        $this->ourTeam=$this->ourTeam->first();

        $first_level=$this->team->where('level','first')->where('status','active')->first();

        $second_level=$this->team->where('level','second')->where('status','active')->limit(2)->get();

        $third_level=$this->team->where('level','third')->where('status','active')->limit(3)->get();

        
        return view('front.about.our_team')
        ->with('first',$first_level)
        ->with('second',$second_level)
        ->with('third',$third_level)
        ->with('team',$this->ourTeam);
    }

    public function project()
    {
        $this->project=$this->project->where('status','active')->orderBy('id','DESC')->get();

        
        return view('front.project.project_list')
        ->with('projects',$this->project);
    }

    public function projectDetail(Request $request,$slug)
    {
        $this->project=$this->project->where('slug',$slug)->where('status','active')->firstOrFail();

        $more_project=$this->project->where('status','active')->where('id','!=',$this->project->id)->orderBy('id','DESC')->get();

        


        return view('front.project.project_detail')
        ->with('project_detail',$this->project)
        ->with('more_project',$more_project);
    }

    public function blogList()
    {
        $this->blog=$this->blog->where('status','active')->orderBy('id','DESC')->get();


        return view('front.blog.blog_list')
        ->with('blogs',$this->blog);
    }

    public function blogDetail(Request $request,$slug)
    {
        $this->blog=$this->blog->where('slug',$slug)->where('status','active')->firstOrFail();

        $recent_post=$this->blog->where('status','active')->orderBy('id','DESC')->where('id','!=',$this->blog->id)->limit(2)->get();

        $recent_project=$this->project->where('status','active')->limit(2)->get();

        return view('front.blog.blog_detail')
        ->with('blog_detail',$this->blog)
        ->with('recent_post',$recent_post)
        ->with('recent_project',$recent_project);

    }

    public function gallery()
    {
        $this->gallery=$this->gallery->where('status','active')->orderBy('id','DESC')->get();

        return view('front.gallery.gallery')
        ->with('galleries',$this->gallery);
    }

    public function galleryList(Request $request,$id)
    {
        $this->gallery=$this->gallery->findOrFail($id);

        $gallery_list=$this->gallery->getImage;

       
        return view('front.gallery.gallery_list')
        ->with('galleries',$gallery_list)
        ->with('gallery',$this->gallery);
    }

    public function contact()
    {
        return view('front.contact.contact');
    }

    public function product(Request $request,$slug)
    {
        if($slug=='all')
        {
            $first_item=$this->product->where('status','active')->orderBy('id','DESC')->first();

            
        }
        else
        {
            $first_item=$this->product->where('status','active')->findOrFail($slug);

           
        }

        $this->product=$this->product->where('status','active')->where('id','!=',$first_item->id)->orderBy('id','DESC')->get();



        return view('front.product.product')
        ->with('products',$this->product)
        ->with('first_item',$first_item);
    }

    public function portfolio()
    {
        $this->portfolio=$this->portfolio->where('status','active')->orderBy('id','DESC')->get();

        $all_sector=$this->organization->where('status','active')->get();


        return view('front.portfolio.portfolio')
        ->with('portfolios',$this->portfolio)
        ->with('all_sector',$all_sector);
    }

    public function getSector(Request $request)
    {
        if($request->sector_id !='all')
        {
            $this->portfolio=$this->portfolio->where('status','active')->findOrFail($request->sector_id);

            $data=$this->portfolio->getOrg;
        }
        else
        {
            $this->portfolio=$this->portfolio->where('status','active')->get();
            $data=$this->organization->where('status','active')->get();
        }


        if(!$this->portfolio)
        {
            return response()->json([
                'error'=>true,
                'data'=>null,
                'msg'=>'Invalid Id !'
            ],200);
        }

        return response()->json([
            'error'=>false,
            'data'=>$data,
            'path'=>asset('uploads/file/'),
            'msg'=>'Success !'
        ],200);
        

        
    }

    public function postMessage(Request $request)
    {
        $rules=$this->message->getRules();
        $request->validate($rules);
        $data=$request->all();
        $this->message->fill($data);
        $status=$this->message->save();

        if($status)
        {
            Mail::to('sumitkarn989@gmail.com')->send(new Enquiry($this->message));
            $request->session()->flash('success','Your Message Has Been Posted Successfully !');
        }
        else

        {
            $request->session()->flash('error','Sorry There Was A Problem While Postoing Your Message !');
        }

        return redirect()->back();
    }

    public function event(Request $request,$slug)
    {
        $event=$this->project->where('status','active')->where('slug',$slug)->firstOrFail();

        $recent_blog=$this->blog->where('status','active')->orderBy('id','DESC')->limit(2)->get();

        $recent_project=$this->project->where('status','active')->where('id','!=',$event->id)->orderBy('id','DESC')->limit(2)->get();

        return view('front.project.event')
        ->with('event',$event)
        ->with('projects',$recent_project)
        ->with('blogs',$recent_blog);
    }

}
