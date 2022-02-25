<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

use App\Support\ImageSupport;
use Kamaln7\Toastr\Facades\Toastr;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $sector=null;
    protected $imageSupport;
    protected $imageWidth=40;
    protected $imageHeight=40;
    protected $folderName='admin.portfolio.sector.';

    public function __construct(Portfolio $sector,ImageSupport $imageSupport)
    {
        $this->sector=$sector;
        $this->imageSupport=$imageSupport;
        $this->data['n']=1;
        $this->data['page']='sector_list';
    }


    public function index($n='')
    {
        $this->data['sectors']=$this->sector->getSectors($n);
        $this->data['activePage']='sector_list';
        return view($this->folderName.'index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['activePage']='Sector_create';
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
        $rules=$this->sector->getRules();
        $request->validate($rules);
        $data=$request->except('image');

        if($request->image)
        {
            $image=$this->imageSupport->saveAnyImg($request, 'sectors', 'image', $this->imageWidth, $this->imageHeight);
            if($image)
            {
                $data['image']=$image;
            }
        }

        $this->sector->fill($data);
        $status=$this->sector->save();

        if($status)
        {
            Toastr::success('Successfully 1 Sector has added', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Adding Sector', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('portfolio.index')->with('success', 'Successfully 1 Sector has added');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        $this->data['activePage']='Sector_create';
        $this->data['sector']=$portfolio;
        return view($this->folderName.'form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $rules=$portfolio->getRules();
        $request->validate($rules);
        $data=$request->except('image');

        if($request->image)
        {
            $image=$this->imageSupport->saveAnyImg($request, 'sectors', 'image', $this->imageWidth, $this->imageHeight);
            if($image)
            {
                $data['image']=$image;
                if($portfolio->image && $portfolio->image !=null)
                {
                    $this->imageSupport->deleteImg('sectors', $portfolio->image);
                }
            }
        }

        $portfolio->fill($data);
        $status=$portfolio->save();

        if($status)
        {
            Toastr::success('Successfully 1 Sector has updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Sector', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('portfolio.index')->with('success', 'Successfully 1 Sector has updated');

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        $image=$portfolio->image;
        $del=$portfolio->delete();

        if($del)
        {
            if($image && $image !=null)
            {
                $this->imageSupport->deleteImg('sectors', $image);
            }
            Toastr::success('Successfully 1 Sector has deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Deleting Sector', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('portfolio.index')->with('success', 'Successfully 1 Sector has deleted');
    }

    public function getStatusSector($check)
    {
        $sector = Portfolio::where('status', $check)->paginate(25);
        $this->data['sectors']=$sector;
        $this->data['activePage']='sector_list';
        return view($this->folderName.'index', $this->data)
        ->with('n',1); 
    }

    public function toSector(Request $request)
    {
        // dd($request->all());
        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change', 'error !!!', ['positionClass'=>'toast-bottom-right']);
            return redirect()->route('portfolio.index')->with('error', 'Plz Select At Least One To Make Change');

        }
        
        if($request->multiple_action !='delete')
        {
            $this->sector->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);
            Toastr::success('Successsfully  Sector Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);


        }
        else
        {
            
            $this->sector->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Sector  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('portfolio.index')->with('success', 'Successfuly 1 Sector has updated');
        
        
    }

    
}
