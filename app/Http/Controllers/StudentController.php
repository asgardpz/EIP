<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class StudentController extends Controller
{
    public function upload(Request $request){
        if($request->isMethod('POST')){
            $files=$request->file("file");
            if($files->isValid()){
                $oragnalName=$files->getClientOriginalName();
                $ext=$files->getClientOriginalExtension();
                $type=$files->getClientMimeType();
                $realPath=$files->getRealPath();
                //$file_new_name=date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
                $file_new_name=$oragnalName;
                $bool=Storage::disk('public')->put($file_new_name,file_get_contents($realPath));
                //var_dump($bool);//exit;
                //return view('rest_api');
                var_dump($oragnalName);
            }
        }
        //return view('upload');
    }
}