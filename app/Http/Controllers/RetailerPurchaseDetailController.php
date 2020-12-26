<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Store;
use App\Category;
use App\Brand;
use App\Currency;
use App\RetailerPurchaseDetail;
use App\RetailersPurchaseDataMapping;

class RetailerPurchaseDetailController extends Controller
{
    public function index(Request $request)
    {
		//print_r("hello");exit;
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        $retailersPurchaseDetails = RetailerPurchaseDetail::leftjoin('stores','stores.id','=','retailer_purchase_details.store_id')->where(['retailer_purchase_details.status' => $type])->orderBy('retailer_purchase_details.id','DESC')->select('retailer_purchase_details.id','retailer_purchase_details.order_id','retailer_purchase_details.updated_at','stores.name as store_name')->get();
		$store = Store::where(['status' => 1])->get();
		return view('admin.retailerspurchase.index',compact('retailersPurchaseDetails','btnStatus','store'));

    }

    public function create(Request $request)
    {
		$store = Store::where(['status' => 1])->get();
		$product = Product::where(['status' => 1])->get();
        return view('admin.retailerspurchase.create',compact('store','Product'));
    }

    public function store(Request $request)
    {   
        $inputData = $request->all();
		$inputData['order_id'] = uniqid();
        $RetailerPurchase = RetailerPurchaseDetail::create($inputData);
        if(!empty($RetailerPurchase)){
            return redirect()->route('retailerspurchase.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        } 
    }

    public function edit($id)
    {
        $orderDetails = RetailerPurchaseDetail::where(['id' => $id])->first();
		$orderProductDetails = RetailersPurchaseDataMapping::leftjoin('retailer_purchase_details','retailer_purchase_details.id','=','retailers_purchase_data_mappings.retailer_id')->leftjoin('categories','categories.id','=','retailers_purchase_data_mappings.category_id')->leftjoin('products','products.id','=','retailers_purchase_data_mappings.product_id')->leftjoin('stores','stores.id','=','retailers_purchase_data_mappings.store_id')->where(['retailers_purchase_data_mappings.retailer_id' => $id])->select('product_quantity','product_mrp','retailers_purchase_data_mappings.discount','pv','bv','total_ammount','products.name as product_name','categories.name as category_name','stores.name as store_name')->get();
		//print_r($orderProductDetails); exit;
		$product = Product::where(['status' => 1])->get();
		$brand = Brand::where(['status' => 1])->get();
		$category = Category::where(['status' => 1])->get();
        return view('admin.retailerspurchase.create',compact('orderDetails','product','brand','category','orderProductDetails'));
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

	public function submitOrderData(Request $request){
		$input = $request->all();
		$currencyData = Currency::where(['status' => 1])->select('currency_code','conversion_rate')->get()->toArray();
		if(!empty($currencyData)){
			$pvValue = $currencyData[0]['conversion_rate'];
			$bvValue = $currencyData[1]['conversion_rate'];
			$ammount = $input['ammount'];
			$pV = ceil($ammount/$pvValue);
			$bV = ceil($pV*$bvValue);
		}
		
		$inputData['retailer_id'] = $input['retailer_id'];
		$inputData['category_id'] = $input['category_id'];
		$inputData['brand_id'] = $input['brand_id'];
		$inputData['product_id'] = $input['product_id'];
		$inputData['store_id'] = $input['store_id'];
		$inputData['product_quantity'] = $input['product_quantity'];
		$inputData['product_mrp'] = $input['product_mrp'];
		$inputData['discount'] = $input['discount'];
		$inputData['total_ammount'] = $input['ammount'];
		$inputData['pv'] = $pV;
		$inputData['bv'] = $bV;
	
		$retailerOrderData = RetailersPurchaseDataMapping::create($inputData);
		if (!empty($retailerOrderData)) {
          return response()->json(['code' => 200]);
		  }else{
			  return response()->json(array('code' => 100, 'message' => 'Some error , Try again'));
		  }
	}
}
