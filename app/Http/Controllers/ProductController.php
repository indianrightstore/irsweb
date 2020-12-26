<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Manufacturer;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        $productDetails = Product::leftjoin('manufacturers','manufacturers.id','=','products.manufacturer_id')->where(['products.status' => $type])->orderBy('products.id','DESC')->select('products.id','products.name','products.price','products.market_price','products.updated_at','products.status','manufacturers.name as manufacturers_name')->get();
        //print_r($currencyDetails); exit;
        return view('admin.product.index',compact('productDetails','btnStatus'));

    }

    public function create(Request $request)
    {
		$brand = Brand::where(['status' => 1])->get();
		$manufacturer = Manufacturer::where(['status' => 1])->get();
        return view('admin.product.create',compact('brand','manufacturer'));
    }

    public function store(Request $request)
    {   
        $inputData = $request->all();
        $product = Product::create($inputData);
        if(!empty($product)){
            return redirect()->route('product.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        } 
    }

    public function edit($id)
    {
        $productDetails = Product::where(['id' => $id])->first();
		$brand = Brand::where(['status' => 1])->get();
		$manufacturer = Manufacturer::where(['status' => 1])->get();
        return view('admin.product.create',compact('productDetails','brand','manufacturer'));
    }
    
    public function update(Request $request,$id)
    {
        $inputData = $request->all();
        $product = Product::findOrFail($id);
        $product->update($inputData);
          
        if(!empty($product)){
            return redirect()->route('product.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }  
    }   
}
