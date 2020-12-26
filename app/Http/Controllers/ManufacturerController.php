<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\State;
use App\City;
use App\Manufacturer;
use App\StoreCategory;
use File;
use Storage;
use URL;

class ManufacturerController extends Controller
{
    public function index(Request $request)
    {
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        $manufacturerDetails = Manufacturer::where(['status' => $type])->orderBy('id','DESC')->get();
	   foreach ($manufacturerDetails as $manufacturerVal) {
            $encryptedId = skill_crypt($manufacturerVal->id, 'e');
            $folder = 'manufacturer';
            if(isset($manufacturerVal->file_name) && !empty($manufacturerVal->file_name)){
                $imgPathUrl = getUploadPathServer($encryptedId, $folder).$manufacturerVal->file_name;
                //$imgPath = getImagePath($imgPathUrl, 1200, 1000, 'resize');
				$imgPath =  URL::to('/')."/media/".$imgPathUrl;
                $manufacturerVal->imgPath = $imgPath;
            }else{
                $manufacturerVal->imgPath = '';
            }
            
        }
        return view('admin.manufacturer.index',compact('manufacturerDetails','btnStatus'));

    }

    public function create(Request $request)
    {
		$upload['size'] = getMaxSize('image');
        $upload['path'] = getUploadPathServer();
        $upload['format'] = json_encode(getValidExtension('image'));	
		$manufacturer = Manufacturer::where(['status' => 1])->get();
		$storeCategory = StoreCategory::where(['status' => 1])->get();
		$country = Country::where(['status' => 1])->get();
        $state = State::where(['status' => 1])->get();
        $city = City::where(['status' => 1])->get();
        return view('admin.manufacturer.create',compact('manufacturer','country','state','city','upload','storeCategory'));
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
        $manufacturer = Manufacturer::create($inputData);
		
		if (!empty($fileName)) {
            $tempPath = Storage::disk('uploads')->getDriver()->getAdapter()->applyPathPrefix(getUploadPathServer().$fileName);
            $encryptedId = skill_crypt($manufacturer->id, 'e');
            $folder = 'manufacturer';
            $newPath = Storage::disk('uploads')->getDriver()->getAdapter()->applyPathPrefix(getUploadPathServer($encryptedId, $folder).$fileName);
            if (File::exists(dirname($tempPath))) {
                File::makeDirectory(dirname($newPath), 0777, true, true);
            }
            $moveFile = File::move($tempPath, $newPath);
        }
		
		
        if(!empty($manufacturer)){
            return redirect()->route('manufacturer.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        } 
    }

    public function edit($id)
    {
		$upload['size'] = getMaxSize('image');
        $upload['path'] = getUploadPathServer();
        $upload['format'] = json_encode(getValidExtension('image'));
        $manufacturerDetails = Manufacturer::where(['id' => $id])->first();
		$storeCategory = StoreCategory::where(['status' => 1])->get();
		$country = Country::where(['status' => 1])->get();
        $state = State::where(['status' => 1])->get();
        $city = City::where(['status' => 1])->get();
        return view('admin.manufacturer.create',compact('manufacturerDetails','country','state','city','upload','storeCategory'));
    }
    
    public function update(Request $request,$id)
    {
        $inputData = $request->all();
		unset($inputData['country_id']);
		unset($inputData['state_id']);
		unset($inputData['city_id']);
		if (isset($inputData['key']) && !empty($inputData['key'])) {
			unset($inputData['location']);
            $link_array = explode('/', $inputData['key']);
            $fileName = end($link_array);
            $inputData['file_name'] = $fileName;    
        }else{
			unset($inputData['file_name']);
		}
        $manufacturer = Manufacturer::findOrFail($id);
        $manufacturer->update($inputData);
          
		  if (!empty($fileName)) {
            $tempPath = Storage::disk('uploads')->getDriver()->getAdapter()->applyPathPrefix(getUploadPathServer().$fileName);
            $encryptedId = skill_crypt($manufacturer->id, 'e');
            $folder = 'manufacturer';
            $newPath = Storage::disk('uploads')->getDriver()->getAdapter()->applyPathPrefix(getUploadPathServer($encryptedId, $folder).$fileName);
            if (File::exists(dirname($tempPath))) {
                File::makeDirectory(dirname($newPath), 0777, true, true);
            }
            $moveFile = File::move($tempPath, $newPath);
        }
		
        if(!empty($manufacturer)){
            return redirect()->route('manufacturer.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }  
    }   
}
