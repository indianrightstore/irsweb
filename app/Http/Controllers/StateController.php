<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\Country;

class StateController extends Controller
{
    public function index(Request $request)
    {
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        $stateDetails = State::where(['status' => $type])->orderBy('id','DESC')->get();
        //print_r($currencyDetails); exit;
        return view('admin.state.index',compact('stateDetails','btnStatus'));

    }

    public function create(Request $request)
    {
		$country = Country::where(['status' => 1])->get();
        return view('admin.state.create',compact('country'));
    }

    public function store(Request $request)
    {   
        $inputData = $request->all();
        $state = State::create($inputData);
        if(!empty($state)){
            return redirect()->route('state.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        } 
    }

    public function edit($id)
    {
        $stateDetails = State::where(['id' => $id])->first();
		$country = Country::where(['status' => 1])->get();
        return view('admin.state.create',compact('stateDetails','country'));
    }
    
    public function update(Request $request,$id)
    {
        $inputData = $request->all();
        $state = State::findOrFail($id);
        $state->update($inputData);
          
        if(!empty($state)){
            return redirect()->route('state.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }  
    }   
}
