<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Support\ImageSupport;
use Kamaln7\Toastr\Facades\Toastr;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */

    protected $service=null;
    protected $imageSupport;
    protected $imageWidth=500;
    protected $imageHeight=500;
    protected $folderName='admin.service.';

    public function __construct(Service $service,ImageSupport $imageSupport)
    {
        $this->service=$service;
        $this->imageSupport=$imageSupport;
        $this->data['n']=1;
        $this->data['page']='service';
    }

    public function index($n='')
    {
        $this->data['services']=$this->service->getServices($n);
        $this->data['activePage']='Service_list';
        return view($this->folderName.'index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['activePage']='Service_create';
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
        $rules=$this->service->getRules();
        $request->validate($rules);
        $data=$request->except('image');

        $image=$this->imageSupport->saveAnyImg($request, 'services', 'image', $this->imageWidth, $this->imageHeight);
        if($image)
        {
            $data['image']=$image;
        }

        $this->service->fill($data);
        $status=$this->service->save();

        if($status)
        {
            Toastr::success('Successfully 1 Service has added', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Adding Service', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('service.index')->with('success', 'Successfully 1 Service has added');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $this->data['activePage']='Service_create';
        $this->data['service']=$service;
        return view($this->folderName.'form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $rules=$service->getRules('update');
        $request->validate($rules);

        $data=$request->except('image');
        if($request->image)
        {
            $image=$this->imageSupport->saveAnyImg($request, 'services', 'image', $this->imageWidth, $this->imageHeight);
            if($image)
            {
                if($service->image && $service->image !=null)
                {
                    $this->imageSupport->deleteImg('services', $service->image);
                }
                $data['image']=$image;
            }
        }

        $service->fill($data);
        $status=$service->save();
        if($status)
        {
            Toastr::success('Successfully 1 Service has Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Service', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('service.index')->with('success', 'Successfully 1 Service has Updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $image=$service->image;

        $del=$service->delete();

        if($del)
        {
            if($image && $image !=null)
            {
                $this->imageSupport->deleteImg('services', $image);
            }
            Toastr::success('Successfully 1 Service has Deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Deleting Service', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('service.index')->with('success', 'Successfully 1 Service has Deleted');

    }

    public function getStatusService($check)
    {
        $service = Service::where('status', $check)->paginate(25);
        $this->data['services']=$service;
        $this->data['activePage']='Service_list';
        return view($this->folderName.'index', $this->data)
        ->with('n',1);   
    }


    public function toService(Request $request)
    {
        // dd($request->all());
        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change', 'error !!!', ['positionClass'=>'toast-bottom-right']);
            return redirect()->route('service.index')->with('error', 'Plz Select At Least One To Make Change');

        }
        
        if($request->multiple_action !='delete')
        {
            $this->service->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);
            Toastr::success('Successsfully  Service Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);


        }
        else
        {
            
            $this->service->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Service  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('service.index')->with('success', 'Successfuly 1 Service has updated');
        
        
    }
}
