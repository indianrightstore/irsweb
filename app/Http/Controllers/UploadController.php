<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Mail;
use Redirect;
use App\User;
use Auth;
use Session;
use Validator;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use App\Mail\ContactUsMail;

use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Storage;
use Crypt;
use File;
use App\ArtistVideoDetails;
use App\ArtistAudioDetails;
use App\ArtistPhotoDetails;
use App\ArtistAlbumDetails;
use App\BusinessProfile;
use App\FanProfile;
use App\ArtistProfile;
use App\CoverImage;
use Response;





class UploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function fileUpload(Request $request)
    {
       
        $input_data = $request->all();
        //print_R($input_data);exit;
       /* $profile_file = $request->file('file');print_r($profile_file);exit;
        $rules = array('profile_file' => 'max:5120', 'mimes:jpeg,bmp,png'); 
        $profileOriginalFileName = $request->profile_file->getClientOriginalName();*/
       
        $opcode = $input_data['opcode'];
        $data = $this->genericUpload($request);
        if(!empty($data)){
            return Response::json(['success' => '1', 'uploadDetail'=>$data]);
        }else{
            $data =[];
            return Response::json(['success' => '0', 'uploadDetail'=>$data]);
        }
    }


    
    public function genericUpload($request)
    {
        $data = $request->all();
        if ($request->is('api*')) {
            $user_id=Auth::user()->id;
            $encryptedUserId = skill_crypt($user_id, 'e');
            $fieldId =  'upload';
            if(isset($data['profile_id']) && !empty($data['profile_id'])){
                $encryptedProfileId = $data['profile_id'];
            }else{
                $response['success'] = false;
                $response['code'] = 'SB305';
                $response['message'] = "Please provide profile_id ";
                $response['data'] = [];
                return $response;
            }if(isset($data['path']) && !empty($data['path'])){
                $path = $data['path'];
            }else{
                $response['success'] = false;
                $response['code'] = 'SB305';
                $response['message'] = "Please provide path ";
                $response['data'] = [];
                return $response;
            }
            if(isset($data['opcode']) && !empty($data['opcode'])){
                $opcode = $data['opcode'];
            }
            
            $profileId = skill_crypt($encryptedProfileId, 'd');
            $file = $request->file($fieldId);//print_r($file);exit;
            $originalFileName = $request->$fieldId->getClientOriginalName();
            
        }else{
            $opcode = $data['opcode'];//print_R($opcode);exit;
            if(!empty(Auth::user()->id)){
                $user_id = Auth::user()->id;
            }else{
                $user_id = 0;
            }
            
            $fieldId =  $data['filed'];
            $file = $request->file($fieldId);//print_r($file);exit;
            $originalFileName = $request->$fieldId->getClientOriginalName();
            $path = $data['path'];
        }
        $fileName = time().str_random().'.'.$request->$fieldId->getClientOriginalExtension();
        // print_r($fileName );exit;
        $receiver = new FileReceiver($fieldId, $request, HandlerFactory::classFromRequest($request));
        $save = $receiver->receive();
        $FileName='';
            // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            // save the file and return any response you need, current example uses `move` function. If you are
           // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())
            $disk = Storage::disk('uploads');
            $public_uploads=$save->getFile();
            // It's better to use streaming Streaming (laravel 5.4+)
            $disk->putFileAs($path, $public_uploads, $fileName);//
            unlink($public_uploads->getPathname());
            
            $filePath = $disk->url($path.$fileName);
            $key = $path.$fileName;
            $returnData = [];
            $returnData['key'] = $key;
            $returnData['location'] = $filePath;
            $returnData['fileName'] = $fileName;
            return $returnData;
        } 
        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();
        return response()->json([
            "done" => $handler->getPercentageDone(),
            "name" => $fileName
        ]);
        
    }




	
	



 
    
}



