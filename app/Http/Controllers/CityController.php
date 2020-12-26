<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\State;
use App\City;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        $cityDetails = City::where(['cities.status' => $type])->orderBy('cities.id','DESC')->get();
        return view('admin.city.index',compact('cityDetails','btnStatus'));

    }

    public function create(Request $request)
    {
        $countryDetails = Country::where(['status' => 1])->orderBy('id','DESC')->get();
        $stateDetails = State::where(['status' => 1])->orderBy('id','DESC')->get();
		$cityDetails =[];
        return view('admin.city.create',compact('cityDetails','countryDetails','stateDetails'));
    }

    public function store(Request $request)
    {   
        $inputData = $request->all();
        $city = City::create($inputData);
        if(!empty($city)){
            return redirect()->route('city.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }  
    }

    public function edit($id)
    {
		$countryDetails = Country::where(['status' => 1])->orderBy('id','DESC')->get();
        $stateDetails = State::where(['status' => 1])->orderBy('id','DESC')->get();
        $cityDetails = City::where(['id' => $id])->first();
        return view('admin.city.create',compact('cityDetails','countryDetails','stateDetails'));
    }
    
    public function update(Request $request,$id)
    {
        $inputData = $request->all();
        $city = City::findOrFail($id);
        $city->update($inputData);
        if(!empty($city)){
            return redirect()->route('city.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        } 
           
    }

}
