<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;
use App\Currency;
use App\Country;
use App\Category;
use App\StoreCategory;
use App\Product;
use App\Store;
use App\Brand;
use App\State;
use App\City;
use App\SubCategory;
use DB;

class AjaxController extends Controller
{
    public function setStatus(Request $request)
    {
        $input = $request->all();
       // print_r($input);exit;
        $id = isset($input['id']) ? $input['id'] : '';
        $status = isset($input['status']) ? $input['status'] : '';
        $type = isset($input['type']) ? $input['type'] : '';
         //dd($type);
        if (!empty($type)) {
            switch ($type) {
                case 'userStatus':
                    $updateStatus = User::where(['id' => $id])->update(['status' => $status]);
                    break;
                case 'role_status':
                        $updateStatus = Role::where(['id' => $id])->update(['status' => $status]);
                        break;
                case 'permission_status':
                        $updateStatus = Permission::where(['id' => $id])->update(['status' => $status]);
                        break;  
                case 'currencyStatus':
                        $updateStatus = Currency::where(['id' => $id])->update(['status' => $status]);
                        break;  
                case 'countryStatus':
                        $updateStatus = Country::where(['id' => $id])->update(['status' => $status]);
                        break;  
                case 'categoryStatus':
                    $updateStatus = Category::where(['id' => $id])->update(['status' => $status]);
                    break;
				case 'subcategoryStatus':
                    $updateStatus = SubCategory::where(['id' => $id])->update(['status' => $status]);
                    break;
				case 'storecategoryStatus':
                    $updateStatus = StoreCategory::where(['id' => $id])->update(['status' => $status]);
                    break;	
				case 'brandStatus':
                    $updateStatus = Brand::where(['id' => $id])->update(['status' => $status]);
                    break;	
                case 'productStatus':
                    $updateStatus = Product::where(['id' => $id])->update(['status' => $status]);
                    break;
                case 'storeStatus':
                    $updateStatus = Store::where(['id' => $id])->update(['status' => $status]);
                    break;
                default:
                    $updateStatus = array();
            }
        } else {
            $updateStatus = array();
        }
        //print_r($updateStatus); exit;
        if (!empty($updateStatus)) {
            return response()->json(['code' => 200, 'updateStatus' => $status]);
        }else{
            return response()->json(array('code' => 100, 'message' => 'Some error , Try again'));
        }
    }

    function startToEndDateArr($sDate, $eDate)
    {
        $day = 86400; // Day in seconds
        $format = 'Y-m-d'; // Output format (see PHP date funciton)
        $sDate = strtotime($sDate); // Start as time
        $eDate = strtotime($eDate); // End as time
        $numDays = round(($eDate - $sDate) / $day) + 1;
        $days = array();

        for ($d = 0; $d < $numDays; ++$d) {
            $days[] = date($format, ($sDate + ($d * $day)));
        }

        return $days;
    }

    public function checkEmail(Request $request)
    {
        $input = $request->all();
        $email = $input['email'];
        $user_id = $input['user_id'];
        if(empty($user_id)){
            $users = User::where(['email' => $email])->first();
        }else{
            $users = User::where(['email' => $email])->where('id', '!=', $user_id)->first();
        }
    
        if (!empty($users->name)) {
            return response()->json(['status' => false, 'message' => 'already exist', 'data' => $users]);
            //return false;
        } else {
            return response()->json(array('status' => true, 'message' => 'not exist.'));
            //return true;
        }
    }

    public function checkUniqueEntry(Request $request){
        $input = $request->all();
        //print_r($input); exit;
        $type = $input['tableName'];
        $value = $input['inputValue'];
        $editId = $input['editDataId'];
        if (!empty($type) && !empty($value)) {
            switch ($type) {
                case 'permission':
                    $checkUnique = Permission::where(['name' => $value])->where('id', '!=', $editId)->first();
                    break;
                case 'role':
                    $checkUnique = Role::where(['name' => $value])->where('id', '!=', $editId)->first();
                    break; 
                case 'currency_code':
                    $checkUnique = Currency::where(['currency_code' => $value])->where('id', '!=', $editId)->first();
                    break;  
                case 'country_name':
                    $checkUnique = Country::where(['name' => $value])->where('id', '!=', $editId)->first();
                    break; 
                case 'country_code':
                    $checkUnique = Country::where(['country_code' => $value])->where('id', '!=', $editId)->first();
                    break;      
                case 'category':
                    $checkUnique = Category::where(['name' => $value])->where('id', '!=', $editId)->first();
                    break; 
				case 'subcategory':
                    $checkUnique = SubCategory::where(['name' => $value])->where('id', '!=', $editId)->first();
                    break;
                case 'product':
                    $checkUnique = Product::where(['name' => $value])->where('id', '!=', $editId)->first();
                    break;      
                default:
                    $checkUnique = array();
            }
        } else {
            $checkUnique = array();
        }
        
        if (!empty($checkUnique)) {
            return response()->json(['status' => false, 'message' => 'already exist']);
            //return false;
        } else {
            return response()->json(array('status' => true, 'message' => 'not exist.'));
            //return true;
        }

    }

    public function checkUniqueDates(Request $request){
        $input = $request->all();
        //print_r(strtotime($input['end_date']));exit;
        if(strtotime($input['start_date']) == strtotime($input['end_date'])){
            return response()->json(['status' => false, 'message' => 'Please ensure that the End Date is greater than to the Start Date.']);
        }else{
        $checkDate =  (new AjaxController)->startToEndDateArr($input['start_date'],$input['end_date']);
        $tourDates = TourPrice::where(['status' => '1'])->get();
            foreach($checkDate as $checkDatekey=>$checkDateVal){
            $paymentDate=date('Y-m-d', strtotime($checkDateVal));
                foreach($tourDates as $oldDataKey=>$oldDataVal){
                    $contractDateBegin = date('Y-m-d', strtotime($oldDataVal->start_date));
                    $contractDateEnd = date('Y-m-d', strtotime($oldDataVal->end_date));    
                    if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd)){
                        return response()->json(['status' => false, 'message' => 'These Dates Already Exist in Another Season Please Select Different Dates']);                      
                    }
            }
            
        }
     }
  }
 
  public function setBookingStatus(Request $request)
  {
      $input = $request->all();
       //print_r($input);exit;
      $id = isset($input['id']) ? $input['id'] : '';
      $status = isset($input['status']) ? $input['status'] : '';
      $type = isset($input['type']) ? $input['type'] : '';
       //dd($type);
      if (!empty($type)) {
          switch ($type) {
              case 'tourDateBookingStatus':
                  $updateStatus = TourPrice::where(['id' => $id])->update(['book_status' => $status]);
                  break;
              default:
                  $updateStatus = array();
          }
      } else {
          $updateStatus = array();
      }
      
      if (!empty($updateStatus)) {
          return response()->json(['code' => 200, 'updateStatus' => $status]);
      }else{
          return response()->json(array('code' => 100, 'message' => 'Some error , Try again'));
      }
  }

  public function disabledAllPrices(Request $request){
    $input = $request->all();
    //print_r($input); exit;
    $tour_id = $input['tour_id'];
    $status = $input['status'];
    $updateStatus = TourPrice::where(['tour_id' => $tour_id])->update(['status' => $status]);
    if (!empty($updateStatus)) {
        return response()->json(['code' => 200, 'updateStatus' => $status]);
    }else{
        return response()->json(array('code' => 100, 'message' => 'Some error , Try again'));
    }
  }

  public function checkPricesStatus(Request $request){
    $input = $request->all();
   // print_r($input); exit;
    $tour_id = $input['tour_id'];
    $checkPricesStatus = TourPrice::where(['tour_id' => $tour_id,'status' => 1])->select('id','tour_id')->get();
    //print_r($checkPricesStatus);exit;
    if (!empty($checkPricesStatus[0]->id)) {
        return response()->json(['code' => 200, 'message' => 'Please Inactive all Prices to Change tour type']);
    }else{
        $getPriceIds = TourPrice::where(['tour_id' => $tour_id,'status' => 0])->select('id')->get();
        foreach($getPriceIds as $priceIds){
            DB::table('tour_price_mappings')->where('price_id', $priceIds->id)->delete();
        }
        DB::table('tour_prices')->where('tour_id', $tour_id)->delete();
        DB::table('tour_margins')->where('tour_id', $tour_id)->delete();
        return response()->json(array('code' => 100, 'message' => 'All Data Deleted SuccessFully'));
    }
  }
  
  public function getState(Request $request){
	 $input = $request->all();
	 $country_id = $input['country_id'];
	 $stateData = State::where(['status' => 1, 'country_id' => $country_id])->get();
	 if (!empty($stateData)) {
        return response()->json(['code' => 200, 'stateData' => $stateData]);
    }else{
        return response()->json(array('code' => 100, 'message' => 'Some error , Try again'));
    }
  }
  
  public function getCity(Request $request){
	 $input = $request->all();
	 $state_id = $input['state_id'];
	 $cityData = City::where(['status' => 1, 'state_id' => $state_id])->get();
	 if (!empty($cityData)) {
        return response()->json(['code' => 200, 'cityData' => $cityData]);
    }else{
        return response()->json(array('code' => 100, 'message' => 'Some error , Try again'));
    }
  }
  
  public function getProductValue(Request $request){
	  $input = $request->all();
	  $product_id = $input['product_id'];
	$productData = Product::where(['status' => 1 , 'id' => $product_id])->select('market_price','price','discount')->first();
	if(!empty($productData)){
		return response()->json(['code' => 200, 'productData' => $productData]);
	}else{
		return response()->json(array('code' => 100, 'message' => 'Some error , Try again'));
	}
  }
}
