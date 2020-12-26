<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Currency;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        $countryDetails = Country::leftjoin('currencies','currencies.id','=','countries.currency_code_id')->where(['countries.status' => $type])->orderBy('countries.id','DESC')->get(['countries.id', 'countries.name', 'countries.country_code', 'countries.latitude', 'countries.longitude', 'currencies.currency_code', 'currencies.conversion_rate', 'countries.created_at', 'countries.updated_at', 'countries.status']);
        // dd($countryDetails);
        return view('admin.country.index',compact('countryDetails','btnStatus'));

    }

    public function create(Request $request)
    {
        $currencyDetails = Currency::where(['status' => '1'])->get();
        return view('admin.country.create',compact('currencyDetails'));
    }

    public function store(Request $request)
    {   
        $inputData = $request->all();
        $country = Country::create($inputData);
        if(!empty($country)){
            return redirect()->route('country.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }  
    }

    public function edit($id)
    {
        $countryDetails = Country::where(['id' => $id])->first();
        $currencyDetails = Currency::get();
        return view('admin.country.create',compact('countryDetails','currencyDetails'));
    }
    
    public function update(Request $request,$id)
    {
        $inputData = $request->all();
        $country = Country::findOrFail($id);
        $country->update($inputData);
        if(!empty($country)){
            return redirect()->route('country.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        } 
           
    }

}
