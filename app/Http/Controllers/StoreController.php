<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Product;
use App\StoreProductMapping;
use App\StoreCategory;
use File;
use Storage;
use ImageResize;
use URL;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        $storeDetails = Store::where(['status' => $type])->orderBy('id','DESC')->get();
        foreach ($storeDetails as $storeVal) {
            $encryptedId = skill_crypt($storeVal->id, 'e');
            $folder = 'store';
            if(isset($storeVal->file_name) && !empty($storeVal->file_name)){
                $imgPathUrl = getUploadPathServer($encryptedId, $folder).$storeVal->file_name;
                //$imgPath = getImagePath($imgPathUrl, 1200, 1000, 'resize');
				$imgPath =  URL::to('/')."/media/".$imgPathUrl;
                $storeVal->imgPath = $imgPath;
            }else{
                $storeVal->imgPath = '';
            }
            
        }

        return view('admin.store.index',compact('storeDetails','btnStatus'));

    }

    public function create(Request $request)
    {
        $productDetails = Product::where(['status' => 1])->orderBy('id','DESC')->get();
		$storeCategory = StoreCategory::where(['status' => 1])->get();
		$upload['size'] = getMaxSize('image');
        $upload['path'] = getUploadPathServer();
        $upload['format'] = json_encode(getValidExtension('image'));	
        return view('admin.store.create',compact('productDetails','storeCategory','upload'));
    }

    public function store(Request $request)
    {   
        $inputData = $request->all();
		if (isset($inputData['key']) && !empty($inputData['key'])) {
			unset($inputData['location']);
            $link_array = explode('/', $inputData['key']);
            $fileName = end($link_array);
            $inputData['file_name'] = $fileName;    
        }
		
        $store = Store::create($inputData);
        $store_id = $store->id;
		
        if(!empty($inputData['product'])){
            $data = [];
            foreach($inputData['product'] as $productval){
                $data['store_id'] = $store_id;
                $data['product_id'] = $productval;
                $storeProductId = StoreProductMapping::create($data);
            }
        }
		
		if (!empty($fileName)) {
            $tempPath = Storage::disk('uploads')->getDriver()->getAdapter()->applyPathPrefix(getUploadPathServer().$fileName);
            $encryptedId = skill_crypt($store->id, 'e');
            $folder = 'store';
            $newPath = Storage::disk('uploads')->getDriver()->getAdapter()->applyPathPrefix(getUploadPathServer($encryptedId, $folder).$fileName);
            if (File::exists(dirname($tempPath))) {
                File::makeDirectory(dirname($newPath), 0777, true, true);
            }
            $moveFile = File::move($tempPath, $newPath);
        }
		
        if(!empty($store)){
            return redirect()->route('store.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        } 
    }

    public function edit($id)
    {
		$upload['size'] = getMaxSize('image');
        $upload['path'] = getUploadPathServer();
        $upload['format'] = json_encode(getValidExtension('image'));
        $storeDetails = Store::where(['id' => $id])->first();
        $productDetails = Product::where(['status' => 1])->orderBy('id','DESC')->get();
		$storeCategory = StoreCategory::where(['status' => 1])->get();
        $productIds = StoreProductMapping::where('store_id', '=' , $id)->get();
        if(!empty($productIds)){
            foreach($productIds as $productIdsVal){
                $data[] = $productIdsVal['product_id'];
            }
        }
        return view('admin.store.create',compact('storeDetails','productDetails','data','storeCategory','upload'));
    }
    
    public function update(Request $request,$id)
    {
        $inputData = $request->all();
		if (isset($inputData['key']) && !empty($inputData['key'])) {
			unset($inputData['location']);
            $link_array = explode('/', $inputData['key']);
            $fileName = end($link_array);
            $inputData['file_name'] = $fileName;    
        }else{
			unset($inputData['file_name']);
		}
        $store = Store::findOrFail($id);
        $store->update($inputData);
        if(!empty($inputData['product'])){
            $data = [];
            $DeleteOldIds = StoreProductMapping::where('store_id','=',$id)->delete();
            $store_id = $id;
            foreach($inputData['product'] as $productval){
                $data['store_id'] = $store_id;
                $data['product_id'] = $productval;
                $storeProductId = StoreProductMapping::create($data);
            }
        }
		
		if (!empty($fileName)) {
            $tempPath = Storage::disk('uploads')->getDriver()->getAdapter()->applyPathPrefix(getUploadPathServer().$fileName);
            $encryptedId = skill_crypt($store->id, 'e');
            $folder = 'store';
            $newPath = Storage::disk('uploads')->getDriver()->getAdapter()->applyPathPrefix(getUploadPathServer($encryptedId, $folder).$fileName);
            if (File::exists(dirname($tempPath))) {
                File::makeDirectory(dirname($newPath), 0777, true, true);
            }
            $moveFile = File::move($tempPath, $newPath);
        }
		
        if(!empty($store)){
            return redirect()->route('store.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }  
    }   
}
