<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use App\Support\ImageSupport;
use Kamaln7\Toastr\Facades\Toastr;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $feature=null;
    protected $imageSupport;
    protected $imageWidth=200;
    protected $imageHeight=200;
    protected $folderName='admin.feature.';

    public function __construct(Feature $feature,ImageSupport $imageSupport)
    {
        $this->feature=$feature;
        $this->imageSupport=$imageSupport;
        $this->data['n']=1;
        $this->data['page']='about';
    }


    public function index($n='')
    {
        $this->data['features']=$this->feature->getFeatures($n);
        $this->data['activePage']='feature_list';
        return view($this->folderName.'index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['activePage']='feature_create';
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
        $rules=$this->feature->getRules();
        $request->validate($rules);
        $data=$request->except('image');

        $image=$this->imageSupport->saveAnyImg($request, 'feature', 'image', $this->imageWidth, $this->imageHeight);
        if($image)
        {
            $data['image']=$image;
        }

        $this->feature->fill($data);
        $status=$this->feature->save();

        if($status)
        {
            Toastr::success('Successfully 1 Feature has added', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Adding Feature', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('feature.index')->with('success', 'Successfully 1 Feature has added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit(Feature $feature)
    {
        $this->data['activePage']='feature_create';
        $this->data['features']=$feature;
        return view($this->folderName.'form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feature $feature)
    {
        $rules=$feature->getRules('update');
        $request->validate($rules);
        $data=$request->except('image');

        if($request->image)
        {
            $image=$this->imageSupport->saveAnyImg($request, 'feature', 'image', $this->imageWidth, $this->imageHeight);
            if($image)
            {
                if($feature->image && $feature->image !=null)
                {
                    $this->imageSupport->deleteImg('feature',$feature->image);
                }
                $data['image']=$image;
            }
        }

        $feature->fill($data);
        $status=$feature->save();

        if($status)
        {
            Toastr::success('Successfully 1 Feature has Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Feature', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('feature.index')->with('success', 'Successfully 1 Feature has Updated');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {
        $image=$feature->image;

        $del=$feature->delete();
        if($del)
        {
            if($image)
            {
                $this->imageSupport->deleteImg('feature',$image);
            }
            Toastr::success('Successfully 1 Feature has Deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Deleted', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('feature.index')->with('success', 'Successfully 1 Feature has Deleted');

    }

    public function getStatusFeature($check)
    {
        $feature = Feature::where('status', $check)->paginate(25);
        $this->data['features']=$feature;
        $this->data['activePage']='feature_list';
        return view($this->folderName.'index', $this->data)
        ->with('n',1);
    }

    public function toFeature(Request $request)
    {
        // dd($request->all());
        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change', 'error !!!', ['positionClass'=>'toast-bottom-right']);
            return redirect()->route('feature.index')->with('error', 'Plz Select At Least One To Make Change');

        }
        
        if($request->multiple_action !='delete')
        {
            $this->feature->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);
            Toastr::success('Successsfully  Feature Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);


        }
        else
        {
            
            $this->feature->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Feature  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('feature.index')->with('success', 'Successfuly 1 Feature has updated');
        
        
    }
}
