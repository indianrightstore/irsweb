<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;
use App\Category;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        $subcategoryDetails = SubCategory::where(['status' => $type])->orderBy('id','DESC')->get();
        //print_r($currencyDetails); exit;
        return view('admin.subcategory.index',compact('subcategoryDetails','btnStatus'));

    }

    public function create(Request $request)
    {
		$category = Category::where(['status'=>1])->get();
        return view('admin.subcategory.create',compact('category'));
    }

    public function store(Request $request)
    {   
        $inputData = $request->all();
        $subcategory = SubCategory::create($inputData);
        if(!empty($subcategory)){
            return redirect()->route('subcategory.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        } 
    }

    public function edit($id)
    {
        $subcategoryDetails = SubCategory::where(['id' => $id])->first();
		$category = Category::where(['status'=>1])->get();
        return view('admin.subcategory.create',compact('subcategoryDetails','category'));
    }
    
    public function update(Request $request,$id)
    {
        $inputData = $request->all();
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update($inputData);
          
        if(!empty($subcategory)){
            return redirect()->route('subcategory.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }  
    }   
}
