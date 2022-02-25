<?php

namespace App\Http\Controllers;

use App\Models\Admin\Client\ClientCategory;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Support\ImageSupport;
use Kamaln7\Toastr\Facades\Toastr;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $client=null;
    protected $imageSupport;
    protected $imageWidth=2000;
    protected $imageHeight=1000;
    protected $folderName='admin.client.';
    protected $data;
    public function __construct(Client $client,ImageSupport $imageSupport)
    {
        $this->client=$client;
        $this->imageSupport=$imageSupport;
        $this->data['n']=1;
        $this->data['page']='client';
    }

    public function index($n='')
    {
        $this->data['clients']=$this->client->getClients($n);
        $this->data['activePage']='client_list';
        return view($this->folderName.'index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['activePage']='client_create';
        $this->data['categories']=ClientCategory::orderByDesc('created_at')->where('status', 'active')->get();
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
        return $request;
        $rules=$this->client->getRules();
        $request->validate($rules);

        $data=$request->except('image');

        $image=$this->imageSupport->saveAnyImg($request, 'clients', 'image', $this->imageWidth, $this->imageHeight);
        if($image)
        {
            $data['image']=$image;
        }
        $data['category_id']=$request->category;
        $this->client->fill($data);
        $status=$this->client->save();
        if($status)
        {
            Toastr::success('Successfully 1 Client has added', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Adding Client', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('client.index')->with('success', 'Successfully 1 Client has added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $this->data['activePage']='client_create';
        $this->data['blog']=$client;
        $this->data['categories']=ClientCategory::orderByDesc('created_at')->where('status', 'active')->get();
        return view($this->folderName.'form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $rules=$client->getRules('update');
        $request->validate($rules);

        $data=$request->except('image');
        if($request->image)
        {
            $image=$this->imageSupport->saveAnyImg($request, 'clients', 'image', $this->imageWidth, $this->imageHeight);
            if($image)
            {
                if($client->image && $client->image !=null)
                {
                    $this->imageSupport->deleteImg('clients',$client->image);
                }
                $data['image']=$image;
            }
        }
        $data['category_id']=$request->category;
        $client->fill($data);
        $status=$client->save();
        
        if($status)
        {
            Toastr::success('Successfully 1 Client has Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Client', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('client.index')->with('success', 'Successfully 1 Client has Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $image=$client->image;
        $del=$client->delete();
        if($del)
        {
            if($image)
            {
                $this->imageSupport->deleteImg('clients',$image);
            }

            Toastr::success('Successfully 1 Client has Deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Error 1 Client has Deleted', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('client.index')->with('success', 'Successfully 1 Client has Deleted');

    }

    public function getStatusClient($check)
    {
        $client = Client::where('status', $check)->paginate(25);
        $this->data['clients']=$client;
        $this->data['activePage']='project_list';
        return view($this->folderName.'index', $this->data)
        ->with('n',1);
    }

    public function toClient(Request $request)
    {
        // dd($request->all());
        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change', 'error !!!', ['positionClass'=>'toast-bottom-right']);
            return redirect()->route('client.index')->with('error', 'Plz Select At Least One To Make Change');

        }
        
        if($request->multiple_action !='delete')
        {
            $this->client->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);
            Toastr::success('Successsfully  Client Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);


        }
        else
        {
            
            $this->client->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Client  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('client.index')->with('success', 'Successfuly 1 Client has updated');
        
        
    }

    public function getClients(ClientCategory $clientCategory)
    {
        $this->data['clients']=Client::where('category_id', $clientCategory->id)->orderByDesc('created_at')->get();
        $this->data['activePage']='client_list';
        return view($this->folderName.'index', $this->data);
    }
}
