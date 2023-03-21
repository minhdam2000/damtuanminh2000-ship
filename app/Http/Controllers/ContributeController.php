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

class ContributeController extends Controller
{	

	public function list(){

		if(!$this->checkContributeMap()){
			return redirect("/");
		}
		$projects = Project::get();
		return view('contribute.project', compact('projects'));
	}

	  public function data($id){
         if(!$this->checkContributeMap()){
        return redirect("/");
      }


    $project = DB::table("projects")
    ->where("id",$id)->first();
   $file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.type as type"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )

            ->groupBy('contribute_file.id')
    ->where("project_id",$id)->where("contribute_file.type",2)->get();


    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);


    return view('contribute.file',compact('project','file','id',"tags"));

  }

 function editFile(Request $request){
    $title = $request->title;
    // dd($request->all());

    $tagArr = [];

    $tags = explode(",", $request->tags);

    foreach ($tags as $tag) {
       $count = DB::table("tags")->where("name",$tag)->count();
       if($count > 0){

        $tagArr[] =  DB::table("tags")->where("name",$tag)->first()->id;
       }else{
       $id = DB::table("tags")->insertGetId([
          "name"=>$tag
        ]);
        $tagArr[] = $id;
      }
    }foreach ($tagArr as $tag) {
      echo $tag."<br>";
    }

  $i = DB::table("contribute_file")->where("project_id",$request->id)->count();
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


       $fid = DB::table("contribute_file")->insertGetId([
            'url' => $url,
            'type' => 2,
            'user_id' => Auth()->user()->id,
            'name'=>$title,
            'project_id'=>$request->id
        ]);

  foreach ($tagArr as $tag) {
         # code...
       DB::table("contribute_file_tags")->insert([
            'file_id' => $fid,
            'tag_id' => $tag

        ]);
       }

      }

      }


      
catch (\Exception $e) { 
    return Redirect()->back()->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');;
               }

 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

}
  function editFileName(Request $request){

      $tagArr = [];

    $tags = explode(",", $request->tags);

    foreach ($tags as $tag) {
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

     DB::table('contribute_file')
              ->where('id', $request->id)
              ->update(['name' => $request->title]);
    // dd($request->id);
     DB::table('contribute_file_tags')
  ->where('file_id', $request->id)->delete();
  foreach ($tagArr as $tag) {
         # code...
       DB::table("contribute_file_tags")->insert([
            'file_id' => $request->id,
            'tag_id' => $tag

        ]);
       }


 return Redirect()->back()->with('notification',' Đã sửa tệp tin thành công !');

}
    


function DeleteFile($id){
  if(!$this->checkLead()){
        return redirect()->back()->with('warning',' Tài khoản không có quyền thực hiện');
}

       DB::table("contribute_file")->where("id",$id)->delete();
          DB::table('contribute_file_tags')
              ->where('file_id', $id)->delete();

 return Redirect()->back()->with('notification',' Đã xóa tệp tin thành công !');

}

}