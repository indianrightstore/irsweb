<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        $brandDetails = Brand::where(['status' => $type])->orderBy('id','DESC')->get();
        //print_r($currencyDetails); exit;
        return view('admin.brand.index',compact('brandDetails','btnStatus'));

    }

    public function create(Request $request)
    {
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {   
        $inputData = $request->all();
        $brand = Brand::create($inputData);
        if(!empty($brand)){
            return redirect()->route('brand.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        } 
    }

    public function edit($id)
    {
        $brandDetails = Brand::where(['id' => $id])->first();
        return view('admin.brand.create',compact('brandDetails'));
    }
    
    public function update(Request $request,$id)
    {
        $inputData = $request->all();
        $brand = Brand::findOrFail($id);
        $brand->update($inputData);
          
        if(!empty($brand)){
            return redirect()->route('brand.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }  
    }   
}
