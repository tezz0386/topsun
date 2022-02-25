<?php

namespace App\Http\Controllers\Admin\Project;

use Illuminate\Http\Request;
use App\Support\ImageSupport;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Admin\Project\Project;
use App\Http\Requests\ProjectUpdateRequest;
class ProjectController extends Controller
{
    protected $data=[];
    protected $imageSupport;
    protected $imageWidth=1920;
    protected $imageHeight=1080;
    protected $thumbWidth=327;
    protected $thumbHeight=218;
    protected $project;
    protected $folderName='admin.project.';
    
    function __construct(ImageSupport $imageSupport, Project $project)
    {
        $this->middleware('auth');
        $this->imageSupport=$imageSupport;
        $this->project = $project;
        $this->data['page']='project';
        $this->data['n']=1;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($n='')
    {
        //
       

        $this->data['projects']=$this->project->getProjects($n);
        $this->data['activePage']='project_list';
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
        $this->data['activePage']='project_create';
        return view($this->folderName.'form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        // dd($request->all());
        //
        // return $request;
        $input = $request->all();
        $input['image']=$this->imageSupport->saveAnyImg($request, 'projects', 'image', $this->imageWidth, $this->imageHeight);
        $this->project->create($input);
        Toastr::success('Successfully 1 project has added', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        return redirect()->route('project.index')->with('success', 'Successfully 1 project has added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Project\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
        $this->data['activePage']='';
        $this->data['project']=$project;
        return view($this->folderName.'show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Project\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        $this->data['activePage']='project_create';
        $this->data['project']=$project;
        return view($this->folderName.'form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Project\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectUpdateRequest $request, Project $project)
    {
        //

        $input = $request->all();
        if(!$request->file('image')==''){
            $this->imageSupport->deleteImg('projects', $project->image);
            $input['image']=$this->imageSupport->saveAnyImg($request, 'projects', 'image', $this->imageWidth, $this->imageHeight);
        }
        
        if($request->upcomming==null)
        {
            $input['upcomming']=false;
        }

        $this->project = $project;
        $this->project->update($input);
        Toastr::success('Successfuly 1 project has updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        return redirect()->route('project.index')->with('success', 'Successfuly 1 project has updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Project\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // dd($project);
        //
        $project->delete();
        Toastr::warning('Successsfully 1 project has deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        return redirect()->route('project.index')->with('success', 'Successfuly 1 project has updated'); 
    }



    // Added for other functionality
    public function getStatusProject($check)
    {
        $project = Project::where('status', $check)->paginate(25);
        $this->data['projects']=$project;
        $this->data['activePage']='project_list';
        return view($this->folderName.'index', $this->data);
    }

    // for multiple action
    public function to(Request $request)
    {
        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select Any One To Performe Something', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
            return redirect()->route('project.index')->with('success', 'Successfuly 1 project has updated');
        }
        if($request->multiple_action !='delete')
        {
            $this->project=$this->project->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);

            Toastr::success('Successsfully  Project Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            $this->project->whereIn('id',$request->selects)->delete();
            Toastr::success('Successsfully  Project  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        

        
        
        return redirect()->route('project.index')->with('success', 'Successfuly 1 project has updated');
    }

    public function upCommingProject($n='')
    {
        $this->data['projects']=$this->project->getProjects('up-comming');
        $this->data['activePage']='up_comming_project_list';
        $upcomming='up_comming';
        return view($this->folderName.'index', $this->data)
        ->with('up_comming',$upcomming);
    }

    public function setCommingProject(Request $request,$id)
    {


        $this->project=$this->project->findOrFail($id);

        $this->data['projects']=$this->project->getProjects('up-comming');
        $this->data['activePage']='up_comming_project_list';
        return view($this->folderName.'upcomming-form', $this->data)
        ->with('project',$this->project);
    }

    public function setupCommingDate(Request $request,$id)
    {
        
        $this->project=$this->project->findOrFail($id);
        
        $rules=[
            'upcomming_status'=>'required|in:yes,no',
            'upcomming_date'=>'nullable|date_format:Y-m-d'
        ];

        

        $request->validate($rules);

        $data=$request->all();
        if($request->upcomming ==null)
        {
            $data['upcomming']=0;
        }
        $this->project->fill($data);
        $status=$this->project->save();
        if($status)
        {
            Toastr::success('Successsfully   Project  Up-Comming Updated Successfully', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Error !  Project  Up-Comming Updated Unsuccessfully !', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }
        
        return redirect()->route('up_comming')->with('success', ' Project  Up-Comming Updated Successfully');

        
    }
}
