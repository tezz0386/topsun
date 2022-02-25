<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Support\ImageSupport;
use Kamaln7\Toastr\Facades\Toastr;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $imageSupport;
    protected $product=null;
    protected $imageWidth=1920;
    protected $imageHeight=1280;
    protected $folderName='admin.product.';

    public function __construct(Product $product,ImageSupport $imageSupport)
    {
        $this->product=$product;
        $this->imageSupport=$imageSupport;
        $this->data['n']=1;
        $this->data['page']='product';
    }
    public function index($n='')
    {

        $this->data['products']=$this->product->getProducts($n);
        $this->data['activePage']='product_list';
        return view($this->folderName.'index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['activePage']='product_create';
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
        $rules=$this->product->getRules();
        $request->validate($rules);
        $data=$request->except('image');
        $image=$this->imageSupport->saveAnyImg($request, 'products', 'image', $this->imageWidth, $this->imageHeight);
        if($image)
        {
            $data['image']=$image;
        }

        $this->product->fill($data);
        $status=$this->product->save();

        if($status)
        {
            Toastr::success('Successfully 1 Product has added', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Adding Product', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('product.index')->with('success', 'Successfully 1 Product has added');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->data['activePage']='product_create';
        $this->data['product']=$product;
        return view($this->folderName.'form', $this->data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules=$product->getRules('update');
        $request->validate($rules);
        $data=$request->except('image');

        if($request->image)
        {
            $image=$this->imageSupport->saveAnyImg($request, 'products', 'image', $this->imageWidth, $this->imageHeight);
            if($image)
            {
                if($product->image && $product->image !=null)
                {
                    $this->imageSupport->deleteImg('products', $product->image);
                }
                $data['image']=$image;
            }
        }
        
        $product->fill($data);
        $status=$product->save();

        if($status)
        {
            Toastr::success('Successfully 1 Product has Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Updating Product', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('product.index')->with('success', 'Successfully 1 Product has Updated');
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $image=$product->image;
        $del=$product->delete();
        
        if($del)
        {
            if($image && $image !=null)
            {
                $this->imageSupport->deleteImg('products', $image);
            }
            Toastr::success('Successfully 1 Product has Deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }
        else
        {
            Toastr::warning('Sorry ! There Was A Problem While Deleting Product', 'Error !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('product.index')->with('success', 'Successfully 1 Product has Deleted');
    }

    public function getStatusProduct($check)
    {
        $product = Product::where('status', $check)->paginate(25);
        $this->data['products']=$product;
        $this->data['activePage']='Product_list';
        return view($this->folderName.'index', $this->data)
        ->with('n',1);  
    }

    public function toProduct(Request $request)
    {
        // dd($request->all());
        if($request->selects ==null)
        {
            Toastr::warning('Error  Plz Select At Least One To Make Change', 'error !!!', ['positionClass'=>'toast-bottom-right']);
            return redirect()->route('product.index')->with('error', 'Plz Select At Least One To Make Change');

        }
        
        if($request->multiple_action !='delete')
        {
            $this->product->whereIn('id',$request->selects)->update([
                'status'=>$request->multiple_action
            ]);
            Toastr::success('Successsfully  Product Status has Been  Updated', 'Success !!!', ['positionClass'=>'toast-bottom-right']);


        }
        else
        {
            
            $this->product->whereIn('id',$request->selects)->delete();
             Toastr::success('Successsfully  Product  has Been  Deleted', 'Success !!!', ['positionClass'=>'toast-bottom-right']);
        }

        return redirect()->route('product.index')->with('success', 'Successfuly 1 Product has updated');
        
        
    }
}
