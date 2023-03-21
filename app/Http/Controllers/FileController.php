<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use DB;

class FileController extends Controller
{

    public function __invoke($file_path)
    {
                    // dd($file_path);
        if (!Storage::disk('local')->exists($file_path)) {
            abort(404);
        }

        if(isset(Auth::user()->name)){
        // $local_path = config('filesystems.disks.local.root') . DIRECTORY_SEPARATOR . $file_path;

        if(strpos($file_path, ".png") >0
        || strpos($file_path, ".PNG") >0
        || strpos($file_path, ".jpg") >0
        || strpos($file_path, ".JPG") >0
            ){
             $local_path = config('filesystems.disks.local.root') . DIRECTORY_SEPARATOR .$file_path;
                            return response()->file($local_path);
        }


        if(strpos($file_path,"finalViewBKCS") > -1){
        $local_path = config('filesystems.disks.local.root') . DIRECTORY_SEPARATOR .$file_path;
        return response()->file($local_path);
        }else{ 
            $name = DB::table("files")->where("url","LIKE","%".$file_path."%")->first();

            if($name == null){
                 $name = DB::table("contribute_file")->where("url","LIKE","%".$file_path."%")->first();
                 if($name == null){
                    // return response()->file($file_path);

                    $part = explode("/", $file_path);
                    $file_name =  end($part);

                    $name = DB::table("building_messages")->where("attachment","LIKE","%".$file_name."%")->first();

                    if($name == null){
                            $local_path = config('filesystems.disks.local.root') . DIRECTORY_SEPARATOR .$file_path;
                            return response()->file($local_path);
                        
                    }

                    $final_name = explode(",",$name->attachment)[1];
                    Storage::delete('/finalViewBKCS/'.$final_name);
                    Storage::copy($file_path, '/finalViewBKCS/'.$final_name);
                    return redirect('/storage/finalViewBKCS/'.$final_name);

                 }else{
                    $name = $name->name;


                 }
            }else{

                    $name = $name->name;
            }


            $part = explode(".", $file_path);
            $type =  end($part);

            $final_name = $name.".".$type; 
            Storage::delete('/finalViewBKCS/'.$final_name);
            Storage::copy($file_path, '/finalViewBKCS/'.$final_name);
            return redirect('/storage/finalViewBKCS/'.$final_name);
        }

        // dd($local_path);

        }else{

            if(isset($_COOKIE['guest_name'])){
                
                $local_path = config('filesystems.disks.local.root') . DIRECTORY_SEPARATOR . $file_path;

                return response()->file($local_path);

            }
            abort(404); 
        }
    }
}