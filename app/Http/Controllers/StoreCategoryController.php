<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreCategory;

class StoreCategoryController extends Controller
{
    public function index(Request $request)
    {
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        $categoryDetails = StoreCategory::where(['status' => $type])->orderBy('id','DESC')->get();
        //print_r($currencyDetails); exit;
        return view('admin.storecategory.index',compact('categoryDetails','btnStatus'));

    }

    public function create(Request $request)
    {
        return view('admin.storecategory.create');
    }

    public function store(Request $request)
    {   
        $inputData = $request->all();
        $category = StoreCategory::create($inputData);
        if(!empty($category)){
            return redirect()->route('storecategory.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        } 
    }

    public function edit($id)
    {
        $categoryDetails = StoreCategory::where(['id' => $id])->first();
        return view('admin.storecategory.create',compact('categoryDetails'));
    }
    
    public function update(Request $request,$id)
    {
        $inputData = $request->all();
        $category = StoreCategory::findOrFail($id);
        $category->update($inputData);
          
        if(!empty($category)){
            return redirect()->route('storecategory.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }  
    }   
}
