<?php

namespace App\Http\Controllers;

use App\Models\OurTeam;
use Illuminate\Http\Request;

use App\Support\ImageSupport;
use Kamaln7\Toastr\Facades\Toastr;

class OurTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $imageSupport;
    protected $our_team=null;
    protected $imageWidth=719;
    protected $imageHeight=400;
    protected $folderName='admin.team.our_team.';

    public function __construct(OurTeam $our_team,ImageSupport $imageSupport)
    {
        $this->our_team=$our_team;
        $this->imageSupport=$imageSupport;
        $this->data['n']=1;
        $this->data['page']='our-team';
    }
    public function index($n='')
    {

        $this->data['ourteams']=$this->our_team->getOurTeams($n);
        $this->data['activePage']='our_team';
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
     * @param  \App\Models\OurTeam  $ourTeam
     * @return \Illuminate\Http\Response
     */
    public function show(OurTeam $ourTeam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OurTeam  $ourTeam
     * @return \Illuminate\Http\Response
     */
    public function edit(OurTeam $ourTeam)
    {

        $this->data['activePage']='our_team_create';
        $this->data['ourteam']=$ourTeam;
        return view($this->folderName.'form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OurTeam  $ourTeam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OurTeam $ourTeam)
    {

        $rules=$ourTeam->getRules();
        $request->validate($rules);
        $data=$request->except('image');

        if($request->image)
        {
            $image=$this->imageSupport->saveAnyImg($request, 'teams', 'image', $this->imageWidth, $this->imageHeight);
            if($image)
            {
                if($ourTeam->image && $ourTeam->image !=null)
                {
                    $this->imageSupport->deleteImg('teams', $ourTeam->image);
                }
                $data['image']=$image;
            }
        }

       $ourTeam->fill($data);
       $status=$ourTeam->save();
       if($status)
        {
            Toastr::success('Successfully Our Team Section has Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Our Team Section', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('ourTeam.index')->with('success', 'Successfully  Our Team Section has Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OurTeam  $ourTeam
     * @return \Illuminate\Http\Response
     */
    public function destroy(OurTeam $ourTeam)
    {
        
    }

    
}
