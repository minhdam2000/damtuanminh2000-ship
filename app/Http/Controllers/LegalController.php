<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Credential;
use App\Broker;
use DB;
use File;
use App\Consumer;
use App\Staff;
use App\Accountant;

use App\Project;
use App\Area;
use App\Zone;
use App\Historyzone;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Event;

class LegalController extends Controller
{	
    function sendMessage($mess,$role_id,$user_id) {
    print($user_id);
    $content      = array(
        "en" => $mess
    );
    $hashes_array = array();
    array_push($hashes_array, array(
        "id" => "like-button",
        "text" => "Chi tiết",
        "icon" => "http://i.imgur.com/N8SN8ZS.png",
        "url" => "https://lopital.vn"
    ));

  if ($user_id == 0){
   $fields = array(
      'app_id' => "e935d517-019c-48b1-a3da-982624168815",

          'filters' => array(array("field" => "tag", "key" => "test", "relation" => "=", "value" => "1")),

          'data' => array("foo" => "bar"),
          'contents' => $content
      );
 }else{

   $fields = array(
      'app_id' => "e935d517-019c-48b1-a3da-982624168815",
          'filters' => array(array("field" => "tag", "key" => "user_id", "relation" => "=", "value" => $user_id)),
          'data' => array("foo" => "bar"),
          'contents' => $content
      );
 }
        
    
    $fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic MGI3NDcwNjQtNDYxZC00ZGM0LWIzZDktOGMzZjgwODI4ZDBk'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $response = curl_exec($ch);
    curl_close($ch);
    // dd($response);
    
    return $response;

}



	public function list(){

		if(!$this->checkHuman()){
			return redirect("/");
		}
		// $projects = Project::get();

     //  $legal = DB::table("file_noti")
     // ->rightJoin('files', 'files.id', '=', 'file_noti.event_id')
     // ->rightJoin('projects', 'projects.id', '=', 'files.project_id')



      $projects = DB::table("projects")
     ->leftJoin('process', 'projects.id', '=', 'process.project_id')
     ->leftJoin('files', 'process.id', '=', 'files.project_id')
     ->leftJoin('file_noti', 'files.id', '=', 'file_noti.event_id')
      ->select("projects.id as id","projects.name as name",
  DB::raw('sum(CASE WHEN file_noti.seen = 0 and file_noti.user_id = '.Auth()->user()->id.' THEN 1 ELSE 0 END) as noti'),
  DB::raw('count(*) as noti2')
    )
              ->groupBy("projects.id")
              ->get();
    // ;

		return view('legal.project', compact('projects'));
	}

	  public function data($id){
         if(!$this->checkHuman()){
        return redirect("/");
      }


    $project = DB::table("projects")
    ->where("id",$id)->first();

    // $file = DB::table("contribute_file")->where("project_id",$id)->get();

    $process  = DB::table("process")->where("project_id",$id)->first();

    $index = $process->id;

    DB::table("process")
     ->leftJoin('files', 'process.id', '=', 'files.project_id')
     ->leftJoin('file_noti', 'files.id', '=', 'file_noti.event_id')
    ->where("file_noti.seen","<",1)
            ->where("file_noti.user_id", Auth()->user()->id)
    ->update(["file_noti.seen"=>1]);


    $cv1 = DB::table("files")->where("project_id",$index)->where("type",1)->get();
    $cv2 = DB::table("files")->where("project_id",$index)->where("type",2)->get();

    return view('legal.file',compact('project','cv1','cv2','id','index'));

  }

   public function regulation(){
      //    if(!$this->checkHuman()){
      //   return redirect("/");
      // }



    $cv = DB::table("files")->where("type",3)->get();
    return view('legal.regulation',compact('cv'));

  }

 function editRegulation(Request $request){
         if(!$this->checkHuman()){
        return redirect("/");
      }

    $title = $request->title;
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

      }
      $path = $file->store('system');

      $url = Storage::url($path);

       DB::table("files")->insert([
            'type' => 3,
            'url' => $url,
            'name'=>$title,
            'project_id'=>0
        ]);
     }
 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !1');

}


 function editFile(Request $request){

         if(!$this->checkHuman()){
        return redirect("/");
      }


   $tagArr = [];

    $tags = explode(",", $request->tags);
    // dd($tags);
    foreach ($tags as $tag) {
        $tag = trim($tag);
       $count = DB::table("tags")->where("name",$tag)->count();
       if($count > 0){

        $tagArr[] =  DB::table("tags")->where("name",$tag)->first()->id;
       }else{
       $id = DB::table("tags")->insertGetId([
          "name"=>$tag
        ]);
        $tagArr[] = $id;
      }
    }




    $title = $request->title;
    // dd($request->all());
  $i = DB::table("files")->where("project_id",$request->id)->count();
  // try{
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

      }
    if(strlen($title) < 2){
            
            $title = $file_name;
      }
      // dd($title);
      $path = $file->store('system');

      $url = Storage::url($path);

      $i = $i +1;

      $file_id =  DB::table("files")->insertGetId([
            'type' => $request->type,
            'url' => $url,
            'name'=>$title,
            'project_id'=>$request->id
        ]);


        DB::table('file_tags')
              ->where('file_id', $file_id)->delete();


              foreach ($tagArr as $tag) {
         # code...
       DB::table("file_tags")->insert([
            'file_id' => $file_id,
            'tag_id' => $tag

        ]);
       }

     



        // print_r($return);

       $lead = $this->getLead();
       // print_r($lead)

              foreach ($lead as $lid) {
                DB::table('file_noti')->insert([
                'event_id' => $file_id,
                'user_id' => $lid
            ]);
            }

        if($title == $file_name){
            $title = "";
        }
      }


//         }
// catch (\Exception $e) { 
//     return Redirect()->back()->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');;
//                }

 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !2');

}
  function editFileName(Request $request){


    $tagArr = [];

    $tags = explode(",", $request->tags);
    // dd($tags);
    foreach ($tags as $tag) {
        $tag = trim($tag);
       $count = DB::table("tags")->where("name",$tag)->count();
       if($count > 0){

        $tagArr[] =  DB::table("tags")->where("name",$tag)->first()->id;
       }else{
       $id = DB::table("tags")->insertGetId([
          "name"=>$tag
        ]);
        $tagArr[] = $id;
      }
    }

    if($request->file == null){


     DB::table('files')
              ->where('id', $request->id)
              ->update(['name' => $request->title]);
    }else{
        $file =$request->file[0];
       $file_name = $file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

      }
      // dd($title);
      $path = $file->store('system');

      $url = Storage::url($path);


    DB::table('files')
              ->where('id', $request->id)
              ->update(['name' => $request->title,'url' => $url]);

    }

 DB::table('file_tags')
->where('file_id',$request->id)->delete();


              foreach ($tagArr as $tag) {
         # code...
       DB::table("file_tags")->insert([
            'file_id' => $request->id,
            'tag_id' => $tag

        ]);
       }


 return Redirect()->back()->with('notification',' Đã sửa tệp tin thành công !');

}
    


public function DeleteFile($id){
  if(!$this->checkHuman()){
        return redirect()->back()->with('warning',' Tài khoản không có quyền thực hiện');
}

       DB::table("files")->where("id",$id)->delete();
       DB::table("file_noti")->where("event_id",$id)->delete();
 return Redirect()->back()->with('notification',' Đã xóa tệp tin thành công !1');

}


public function mergeSelectPdf($id){
    // dd($_COOKIE['cv_temp']);
    if(!isset($_COOKIE['cv_temp'])){
        return redirect()->back()->with('warning',' Không đọc từ từ khóa');

    }
     if(!$this->checkLead()){
        return redirect("/");
      }
    ini_set('memory_limit', '2048M');
        $path = "/var/www/html/ship/";

    // $process_name = DB::table("process")->where("id",$id)->first()->name;
    // dd($process_name);
       $files = DB::table("files")
    ->leftJoin('file_tags', 'files.id', '=', 'file_tags.file_id')
    ->leftJoin('tags', 'file_tags.tag_id', '=', 'tags.id')
    ->select("files.name as name","files.created_at as created_at"
        ,"files.id as id","files.url as url"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
)
    ->where('project_id', $id)
    ->where('files.name',"like", "%".$_COOKIE['cv_temp']."%")
    ->orWhere('tags.name',"like", "%".$_COOKIE['cv_temp']."%")
    ->orderBy('files.name', 'desc')
    ->groupBy('files.id')

    ->get();
        // dd(count($files));

        $pdf = new \PDFMerger();
            foreach ($files  as $file) {
                // dd($file->url);
                try{

        if(strpos($file->url,".pdf") > 0 ){
        $url =  str_replace("/storage/","storage/app/",$file->url);
        $pdf->addPDF($path.$url,'all');
    }

        // break;
    }      catch (\Exception $e){
           continue;
        }
            }
     
                try{
        $pdf->merge('download', "HSPL.pdf");
         }      catch (\Exception $e){
            dd($e);
        return redirect()->back()->with('warning',' Đã có lỗi tệp tin, vui lòng liên hệ admin');

        }

        //         try{
        // $pdf->merge('download', "HSPL.pdf");
        //  } catch (Exception $ex) {
        //     dd($ex);
        // }

        return Redirect("/");
}



public function mergeAllPdf($id){
     if(!$this->checkLead()){
        return redirect("/");
      }
    ini_set('memory_limit', '2048M');
        $path = "/var/www/html/ship/";

    // $process_name = DB::table("process")->where("id",$id)->first()->name;
    // dd($process_name);
       $files = DB::table("files")
                ->where('project_id', $id)
                ->orderBy('name', 'desc')->get();
        // dd(count($files));

                try{
        $pdf = new \PDFMerger();
            foreach ($files  as $file) {
                // dd($file->url);
                try{

        if(strpos($file->url,".pdf") > 0 ){
        $url =  str_replace("/storage/","storage/app/",$file->url);
                // dd($url);
        $pdf->addPDF($path.$url,'all');
    }

        // break;
    }      catch (\Exception $e){
           continue;
        }
            }
     
        $pdf->merge('download', "HSPL.pdf");
         }      catch (\Exception $e){
        return redirect()->back()->with('warning',' Đã có lỗi tệp tin, vui lòng liên hệ admin');

        }
        return Redirect("/");
}



public function mergeAllPdfTest($id){
     if(!$this->checkLead()){
        return redirect("/");
      }
    ini_set('memory_limit', '2048M');
        $path = "/var/www/html/ship/";

    // $process_name = DB::table("process")->where("id",$id)->first()->name;
    // dd($process_name);
       $files = DB::table("files")
                ->where('project_id', $id)
                ->orderBy('name', 'desc')->get();
        // dd(count($files));

        $pdf = new \PDFMerger();
        $i = 0;
            foreach ($files  as $file) {

                // dd($file->url);
                try{

        if(strpos($file->url,".pdf") > 0 ){

            // echo $file->url;echo "<br>";
        // if($i > 3){
        //     break;
        // }
        // if($i < 1){
        //     // echo $file->url;
        //     $i = $i +1;
        //     continue;
        // }
        $url =  str_replace("/storage/","storage/app/",$file->url);
                // dd($url);
        $pdf->addPDF($path.$url,'all');
        $i = $i +1;
    }
        // break;
    }      catch (\Exception $e){
           continue;
        }
            }
        // dd($i);

        try{
        $pdf->merge('download', "HSPL.pdf");
         } catch (\Exception $ex) {
            dd($ex);
        }
        // return Redirect("/");
}

public function mergePdf(request $req){
     if(!$this->checkLead()){
        return redirect("/");
      }
    ini_set('memory_limit', '2048M');
        $path = "/var/www/html/ship/";

       $files = DB::table("files")
                ->where("created_at",">",$req->date1)
                ->where("created_at","<",$req->date2)
                ->where('project_id', $req->id)
                ->orderBy('name', 'desc')->get();
        // dd(count($files));
        if(count($files) > 0){
                try{
        $pdf = new \PDFMerger();
            foreach ($files  as $file) {
                // dd($file->url);
                try{

        if(strpos($file->url,".pdf") > 0 ){
        $url =  str_replace("/storage/","storage/app/",$file->url);
                // dd($url);
        $pdf->addPDF($path.$url,'all');
    }

        // break;
    }      catch (\Exception $e){
           continue;
        }
            }
     
        $pdf->merge('download', "HSPL.pdf");
    }      catch (\Exception $e){
        return redirect()->back()->with('warning',' Đã có lỗi tệp tin, vui lòng liên hệ admin');

        }
        return redirect()->back()->with('notification',' Đã tải xuống thành công');

    }
    else{

        return redirect()->back()->with('warning',' Không tìm thấy tệp tin');
    }
}

public function mergePdfTest(request $req){
     if(!$this->checkLead()){
        return redirect("/");
      }
    ini_set('memory_limit', '2048M');
        $path = "/var/www/html/ship/";

       $files = DB::table("files")
                ->where("created_at",">",$req->date1)
                ->where("created_at","<",$req->date2)
                ->where('project_id', $req->id)
                ->orderBy('name', 'desc')->get();
        // dd(count($files));
        if(count($files) > 0){
        $pdf = new \PDFMerger();
            foreach ($files  as $file) {
                // dd($file->url);
                try{

        if(strpos($file->url,".pdf") > 0 ){
        $url =  str_replace("/storage/","storage/app/",$file->url);
                // dd($url);
        $pdf->addPDF($path.$url,'all');
    }

        // break;
    }      catch (\Exception $e){
           continue;
        }
            }
     
        $pdf->merge('download', "HSPL.pdf");
        
        return redirect()->back()->with('notification',' Đã tải xuống thành công');
        
    }
    else{

        return redirect()->back()->with('warning',' Không tìm thấy tệp tin');
    }
}




public function addStep(Request $req){
     if(!$this->checkLead()){
        return redirect("/");
      }
    DB::table("legal_process")->insert(
        [
            "stt"=>$req->stt,
            "process_id"=>$req->id,
            "step_id"=>$req->step,
            "title"=>$req->title,
            "sender"=>"",
        ]
    );


        return redirect()->back()->with('notification',' Đã thêm tệp thành công 4');
}



public function addSubstep(Request $req){
     if(!$this->checkLead()){
        return redirect("/");
      }



    
   $root =  DB::table("legal_process")->where("id",$req->id)->first();

 if($root->root_id > 0){

    $root_id = $root->root_id;
 }else{
    $root_id = $req->id;
 }
    DB::table("legal_process")->insert(
        [
            "stt"=>$req->stt,
            "process_id"=>$root->process_id,
            "root_id"=>$root_id,
            "last_id"=>$root->id,
            "step_id"=>$root->step_id,
            "title"=>$req->title,
            "sender"=>$req->sender,
        ]
    );


        return redirect()->back()->with('notification',' Đã thêm tệp thành công 5');
}


public function editStep(Request $req){
     if(!$this->checkLead()){
        return redirect("/");
      }

    // dd($req->id);
    DB::table("legal_process")->where("id",$req->id)->update(
        [
            "stt"=>$req->stt,
            "title"=>$req->title,
            "sender"=>$req->sender
        ]
    );


        return redirect()->back()->with('notification',' Đã sửa tệp thành công');
}


public function deleteProcess($id){
     if(!$this->checkLead()){
        return redirect("/");
      }

    DB::table("legal_process")->where("id",$id)->delete();


        return redirect()->back()->with('notification',' Đã xóa tệp thành công');
}

public function changeStatus($id){
     if(!$this->checkLead()){
        return redirect("/");
      }



      $status = DB::table("legal_process")->where("id",$id)->first()->status;
      if($status > 0){
DB::table("legal_process")->where("id",$id)->update(
        [
            "status"=>0
        ]
    );
      }else{
        DB::table("legal_process")->where("id",$id)->update(
        [
            "status"=>1
        ]
    );
      }


        return redirect()->back()->with('notification',' Đã cập nhật trạng thái');
}


public function getSubAsJson($id){

   $root =  DB::table("legal_process")->where("id",$id)->first();

   $data = DB::table("legal_process")->where("last_id",$id)->orderBy('stt', 'asc')->get();

   return json_encode($data);
}



public function processFile($id){
     if(!$this->checkHuman()){
        return redirect("/");
      }

      $type = 2;

   $legal =  DB::table("legal_process")->where("id",$id)->first();

    $file = DB::table("legal_process_file")->where("lp_id",$id)->get();
    $index = $legal->process_id;
    return view('legal.file',compact('id','legal','file','type',"index"));

}

public function processFileAdd(Request $request){
     if(!$this->checkHuman()){
        return redirect("/");
      }

    $title = $request->title;
  $i = DB::table("legal_process_file")->where("lp_id",$request->id)->count();
  try{
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

      }
      // dd($title);
      $path = $file->store('system');

      $url = Storage::url($path);

      $i = $i +1;

       DB::table("legal_process_file")->insert([
            'url' => $url,
            'type'=>$request->type,
            'title'=>$title,
            'lp_id'=>$request->id,
            'image_id'=>$i,
        ]);


       $process_id =  DB::table("legal_process")
       ->where("id",$request->id)
       ->first()
       ->process_id;
       // dd($request->type);
          if($request->type > 0){
            DB::table("files")->insert([
                'url' => $url,
                'type'=>$request->type,
                'name'=>$title,
                'project_id'=>$process_id,
                'tree'=>1
            ]);
          }

      }

        }
catch (\Exception $e) { 
    return Redirect()->back()->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');;
               }

 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công 6!');

}

 public function processFileEdit(Request $request){
     if(!$this->checkHuman()){
        return redirect("/");
      }


    $lpf = 
    DB::table('legal_process_file')
              ->where('id', $request->id)
              ->first();

    $url  = $lpf->url;
    $title  = $lpf->title;
      $process_id =  DB::table("legal_process")
       ->where("id",$lpf->lp_id)
       ->first()
       ->process_id;

    DB::table('legal_process_file')
              ->where('id', $request->id)
              ->update(['title' => $request->title,'type' => $request->type]);

    $file = 
    DB::table('files')
    ->where("url",$url)
    ->where("name",$title)
    ->first();

    if($file != null){
        if($request->type == 0){

            DB::table('files')
            ->where("url",$url)
            ->where("name",$title)
            ->delete();
        }else{
            DB::table('files')
            ->where("url",$url)
            ->where("name",$title)
            ->update(['name' => $request->title,'type' => $request->type]);
        }
    }else{

          if($request->type > 0){


            DB::table("files")->insert([
                'url' => $url,
                'type'=>$request->type,
                'name'=>$title,
                'project_id'=>$process_id,
                'tree'=>1
            ]);
          }
    }


 return Redirect()->back()->with('notification',' Đã sửa tệp tin thành công ! ');

}
     function processFileDelete(Request $request){
         if(!$this->checkHuman()){
        return redirect("/");
      }

    $lpf = 
    DB::table('legal_process_file')
              ->where('id', $request->id)
              ->first();

    $url  = $lpf->url;
    $title  = $lpf->title;

 DB::table('files')
            ->where("url",$url)
            ->where("name",$title)
            ->delete();

     DB::table('legal_process_file')
              ->where('id', $request->id)->delete();

 return Redirect()->back()->with('notification',' Đã xóa tệp tin thành công !');

}





public function convertDB($id){
     if(!$this->checkLead()){
        return redirect("/");
      }

    $step_ids = DB::table("process_step")->where("process_id",$id)
                ->orderBy('pos', 'asc')->pluck("step_id")->toArray();
    $i = 1;
    foreach ($step_ids as $step_id) {
        $step = DB::table("step")->where("id",$step_id)->first();

        $substeps = DB::table("substep")->where("step_id",$step_id)->orderBy('pos', 'asc')->get();

    //     $step_new_id = DB::table("legal_process")->insertGetId(
    //     [
    //         "stt"=>$i,
    //         "process_id"=>$id,
    //         "root_id"=>0,
    //         "last_id"=>0,
    //         "step_id"=>$i,
    //         "title"=>$step->name,
    //         "sender"=>"",
    //     ]
    // );

            $stt1 = 1; 
    foreach ($substeps as $substep) {
            $substep_new_id = DB::table("legal_process")->insertGetId(
                    [
                        "stt"=>$stt1,
                        "process_id"=>$id,
                        "root_id"=>0,
                        "last_id"=>0,
                        "step_id"=>$i,
                        "title"=>$substep->name,
                        "sender"=>"",
                    ]
                );

            $task_ids = DB::table("substep_task")->where("step_id",$substep->id)->orderBy('pos', 'asc')->pluck("task_id")->toArray();

                $stt2 = 1;
            foreach($task_ids as $tid){

            $task = DB::table("task")->where("id",$tid)->first();
                 $task_new_id = DB::table("legal_process")->insertGetId(
                    [
                        "stt"=>$stt2,
                        "process_id"=>$id,
                        "root_id"=>$substep_new_id,
                        "last_id"=>$substep_new_id,
                        "step_id"=>$i,
                        "title"=>$task->name,
                        "sender"=>$task->legal_type,
                    ]
                );

                 $task_url = DB::table("task_url")->where("task_id",$task->id)->get();
                 foreach($task_url as $url){
                      DB::table("legal_process_file")->insert([
                            'url' => $url->url,
                            'title'=>$url->name,
                            'lp_id'=>$task_new_id,
                            'image_id'=>$url->image_id,
                        ]);

                 }
$stt2 = $stt2+1;
            }

$stt1 = $stt1+1;
    }




        $i = $i + 1;
    }
}

}