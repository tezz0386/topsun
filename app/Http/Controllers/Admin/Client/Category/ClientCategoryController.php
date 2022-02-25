<?php

namespace App\Http\Controllers\Admin\Client\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Client\ClientCategory;
use Illuminate\Support\Facades\Validator;
use Kamaln7\Toastr\Facades\Toastr;

class ClientCategoryController extends Controller
{
    protected $folderName = 'admin.client.category.';
    protected $category;
    protected $data;
    function __construct(ClientCategory $category)
    {
        $this->middleware('auth');
        $this->category = $category;
        $this->data['page']='client';
        $this->data['activePage']='client_category';
        $this->data['n']=1;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['categories']=ClientCategory::orderByDesc('created_at')->get();
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
        return view( $this->folderName.'form', $this->data);
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
        $input = $request->all();
        $validator = Validator::make($input, [
            'title'=>'required|unique:client_categories',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $this->category->create($input);
        Toastr::success('Successfully Category Created', 'Suceess !!!', ['positionClass'=>'toast-bottom-right']);
        return redirect()->route('client-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Client\ClientCategory  $clientCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ClientCategory $clientCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Client\ClientCategory  $clientCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientCategory $clientCategory)
    {
        //
        // return $clientCategory;
        $this->data['clientCategory']=$clientCategory;
        return view($this->folderName.'form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Client\ClientCategory  $clientCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientCategory $clientCategory)
    {
        //
        // return $clientCategory;
        $input = $request->all();
        $validator = Validator::make($input, [
            'title'=>'required|unique:client_categories,title,'.$clientCategory->id,
        ]);
        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $this->category=$clientCategory;
        $this->category->update($input);
        Toastr::success('Successfully Category Updated', 'Suceess !!!', ['positionClass'=>'toast-bottom-right']);
        return redirect()->route('client-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Client\ClientCategory  $clientCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientCategory $clientCategory)
    {
        //
        $clientCategory->clients()->delete();
        $clientCategory->delete();
        Toastr::warning('Successfully Category Deleted with its child', 'Suceess !!!', ['positionClass'=>'toast-bottom-right']);
        return redirect()->route('client-category.index');
    }
}
