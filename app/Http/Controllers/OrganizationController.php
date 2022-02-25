<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Support\ImageSupport;
use Kamaln7\Toastr\Facades\Toastr;
use App\Models\Portfolio;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $organization=null;
    protected $imageSupport;
    protected $imageWidth=40;
    protected $imageHeight=40;
    protected $folderName='admin.portfolio.organization.';
    protected $sector=null;

    public function __construct(Organization $organization,ImageSupport $imageSupport,Portfolio $sector)
    {
        $this->organization=$organization;
        $this->imageSupport=$imageSupport;
        $this->data['n']=1;
        $this->data['page']='organization_list';
        $this->sector=$sector;
    }
    
    public function index($n='')
    {
        $this->data['organizations']=$this->organization->getOrganizations($n);
        $this->data['activePage']='organization_list';
        return view($this->folderName.'index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['activePage']='Organization_create';

        $this->sector=$this->sector->where('status','active')->get();

        return view($this->folderName.'form', $this->data)
        ->with('sector_list',$this->sector);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=$this->organization->getRules();
        $request->validate($rules);

        $data=$request->except('pdf');

        if($request->pdf)
        {
            $file=$this->organization->uploadFile($request->title,$request->pdf);
            if($file)
            {
                $data['pdf']=$file;
            }
        }

        $this->organization->fill($data);
        $status=$this->organization->save();

        if($status)
        {
            Toastr::success('Successfully 1 Organization has added', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Adding Organization', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('organization.index')->with('success', 'Successfully 1 Organization has added');

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        $this->sector=$this->sector->where('status','active')->get();

        $this->data['activePage']='Organization_create';
        $this->data['organization']=$organization;
        return view($this->folderName.'form', $this->data)
        ->with('sector_list',$this->sector);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {

        $rules=$organization->getRules('update');
        $request->validate($rules);

        $data=$request->except('pdf');

        if($request->pdf)
        {
            $file=$this->organization->uploadFile($request->title,$request->pdf);
            if($file)
            {
                if($organization->pdf && $organization->pdf !=null)
                {
                    $this->organization->deleteFile($organization->pdf);
                }

                $data['pdf']=$file;
            }
        }

        $organization->fill($data);
        $status=$organization->save($data);

        if($status)
        {
            Toastr::success('Successfully 1 Organization has updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Organization', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('organization.index')->with('success', 'Successfully 1 Organization has updated');


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        $file=$organization->pdf;

        $del=$organization->delete();
        if($del)
        {
            if($file && $file !=null)
            {
                $organization->deleteFile($file);
            }
            Toastr::success('Successfully 1 Organization has deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Deleting Organization', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('organization.index')->with('success', 'Successfully 1 Organization has Deleted');

    }

    public function toOrg(Request $request)
    {
        // dd($request->all());
        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change', 'error !!!', ['positionClass'=>'toast-bottom-right']);
            return redirect()->route('organization.index')->with('error', 'Plz Select At Least One To Make Change');

        }
        
        if($request->multiple_action !='delete')
        {
            $this->organization->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);
            Toastr::success('Successsfully  Organization Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);


        }
        else
        {
            
            $this->organization->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Organization  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('organization.index')->with('success', 'Successfuly 1 Organization has updated');
        
        
    }

    public function getStatusOrg($check)
    {
        $organization = Organization::where('status', $check)->paginate(25);
        $this->data['organizations']=$organization;
        $this->data['activePage']='organization_list';
        return view($this->folderName.'index', $this->data)
        ->with('n',1); 
    }

}
