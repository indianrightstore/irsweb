<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        $categoryDetails = Category::where(['status' => $type])->orderBy('id','DESC')->get();
        //print_r($currencyDetails); exit;
        return view('admin.category.index',compact('categoryDetails','btnStatus'));

    }

    public function create(Request $request)
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {   
        $inputData = $request->all();
        $category = Category::create($inputData);
        if(!empty($category)){
            return redirect()->route('category.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        } 
    }

    public function edit($id)
    {
        $categoryDetails = Category::where(['id' => $id])->first();
        return view('admin.category.create',compact('categoryDetails'));
    }
    
    public function update(Request $request,$id)
    {
        $inputData = $request->all();
        $category = Category::findOrFail($id);
        $category->update($inputData);
          
        if(!empty($category)){
            return redirect()->route('category.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }  
    }   
}
