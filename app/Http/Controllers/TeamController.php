<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

use App\Support\ImageSupport;
use Kamaln7\Toastr\Facades\Toastr;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $imageSupport;
    protected $team=null;
    protected $imageWidth=500;
    protected $imageHeight=500;
    protected $folderName='admin.team.';

    public function __construct(Team $team,ImageSupport $imageSupport)
    {
        $this->team=$team;
        $this->imageSupport=$imageSupport;
        $this->data['n']=1;
        $this->data['page']='team';
    }
    public function index($n='')
    {

        $this->data['teams']=$this->team->getTeams($n);
        $this->data['activePage']='team_list';
        return view($this->folderName.'index', $this->data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['activePage']='team_create';
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

        $rules=$this->team->getRules();
        $request->validate($rules);

        $data=$request->except('image');

        $image=$this->imageSupport->saveAnyImg($request, 'teams', 'image', $this->imageWidth, $this->imageHeight);

        if($image)
        {
            $data['image']=$image;
        }

        $this->team->fill($data);
        $status=$this->team->save();
        if($status)
        {
            Toastr::success('Successfully 1 Team Member has added', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Adding Team Member', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('team.index')->with('success', 'Successfully 1 Team Member has added');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $this->data['activePage']='team_create';
        $this->data['team']=$team;
        return view($this->folderName.'form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $rules=$team->getRules('update');
        $request->validate($rules);

        $data=$request->except('image');
        if($request->image)
        {
            $image=$this->imageSupport->saveAnyImg($request, 'teams', 'image', $this->imageWidth, $this->imageHeight);
            if($image)
            {
                if($team->image && $team->image !=null)
                {
                    $this->imageSupport->deleteImg('teams', $team->image);
                }
                $data['image']=$image;
            }
        }

        $team->fill($data);
        $status=$team->save();
        if($status)
        {
            Toastr::success('Successfully 1 Team Member has updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Team Member', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('team.index')->with('success', 'Successfully 1 Team Member has updated');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $image=$team->image;
        $del=$team->delete();
        if($del)
        {
            if($image && $image !=null)
            {
                $this->imageSupport->deleteImg('teams', $image);
            }
            Toastr::success('Successfully 1 Team Member has deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Deleting Team Member', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('team.index')->with('success', 'Successfully 1 Team Member has deleted');

        
        
    }

    public function getStatusTeam($check)
    {
        $team = Team::where('status', $check)->paginate(25);
        $this->data['teams']=$team;
        $this->data['activePage']='team_list';
        return view($this->folderName.'index', $this->data)
        ->with('n',1);  
    }

    public function toTeam(Request $request)
    {
        // dd($request->all());
        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change', 'error !!!', ['positionClass'=>'toast-bottom-right']);
            return redirect()->route('blog.index')->with('error', 'Plz Select At Least One To Make Change');

        }
        
        if($request->multiple_action !='delete')
        {
            $this->team->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);
            Toastr::success('Successsfully  Team Member Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);


        }
        else
        {
            
            $this->team->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Team Member  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('team.index')->with('success', 'Successfuly 1 Team Member has updated');
        
        
    }
}
