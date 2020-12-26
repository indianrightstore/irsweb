<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;

class CurrencyController extends Controller
{
    public function index(Request $request)
    {
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        $currencyDetails = Currency::where(['status' => $type])->orderBy('id','DESC')->get();
        //print_r($currencyDetails); exit;
        return view('admin.currency.index',compact('currencyDetails','btnStatus'));

    }

    public function create(Request $request)
    {
        return view('admin.currency.create');
    }

    public function store(Request $request)
    {   
        $inputData = $request->all();
        $inputData['currency_code'] = strtoupper($inputData['currency_code']);
        $currency = Currency::create($inputData);
        if(!empty($currency)){
            return redirect()->route('currency.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        } 
    }

    public function edit($id)
    {
        $currencyDetails = Currency::where(['id' => $id])->first();
        return view('admin.currency.create',compact('currencyDetails'));
    }
    
    public function update(Request $request,$id)
    {
        $inputData = $request->all();
        $inputData['currency_code'] = strtoupper($inputData['currency_code']);
        $Currency = Currency::findOrFail($id);
        $Currency->update($inputData);
          
        if(!empty($Currency)){
            return redirect()->route('currency.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }  
    }   
}
