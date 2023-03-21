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
use App\Consumer2;
use App\Job;
use App\Jobmoniters;
use App\Staff;
use App\Accountant;
use App\Department;
use App\Event;
use App\Role;

use Intervention\Image\ImageManagerStatic as Image;


use Illuminate\Support\Str;
use Illuminate\Http\Request;


class VipController extends Controller
{   
     public function deletealvip(Request $req){
        // print($req);
      if(!$this->checkAdmin()){
        return redirect("/");
      }
      
        $data = $req->post();
        $flag = 0;
        foreach ($data as $key => $value){
            if(is_int($key)){
                // print($key);
                try{
                    DB::table("vip")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->back()->with('notification',' Đã xóa tất cả  cấu hình');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa  cấu hình');

        }
       
        

    }

    function DeleteVipTag($id){
    DB::table("vip_tag")->where("id",$id)->delete();
     return Redirect()->back()->with('warning',' Đã xóa tệp tin thành công !');
}


	
    public function detail($id){
    $vips = DB::table("vip")
    ->leftJoin('vip_tag_connection', 'vip.id', '=', 'vip_tag_connection.vip_id')
    ->leftJoin('vip_tag', 'vip_tag_connection.tag_id', '=', 'vip_tag.id')
    ->select("vip.name as name"
      ,"vip.id as id","vip.name as name","vip.describe as describe"
              ,DB::raw("group_concat(vip_tag.name SEPARATOR ', ') as vip_tag")
    )
    ->groupBy('vip.id')
    ->where("vip.id",$id)
            ->first();

     $vip_event = DB::table("vip_event")->where("vip_id",$id)->get();  


     $tag_id_list = DB::table("vip_tag_connection")->where("vip_id",$id)->pluck("tag_id")->toArray();
     $tags = DB::table("vip_tag")->whereIn("id",$tag_id_list)->get();
     foreach($tags as $tag){
        $tag->event = DB::table("vip_tag_event")->where("tag_id",$tag->id)->get();
     }

     // dd($tags);


            return view('vip.detail',compact("id",'vips',"vip_event"));

    }
    public function eventtag($id){
    $vips = DB::table("vip_tag")
            ->first();

     $vip_eventtag = DB::table("vip_tag_event")->where("tag_id",$id)->get();    
            return view('vip.eventtag',compact("id",'vips',"vip_eventtag"));

    }
	public function event(){
    $vips  = DB::table("vip")
    ->leftJoin('vip_tag_connection', 'vip.id', '=', 'vip_tag_connection.vip_id')
    ->leftJoin('vip_tag', 'vip_tag_connection.tag_id', '=', 'vip_tag.id')
    ->select("vip.name as name"
      ,"vip.id as id","vip.name as name","vip.describe as describe"
              ,DB::raw("group_concat(vip_tag.name SEPARATOR ', ') as vip_tag")
    )
    ->groupBy('vip.id')
            ->get();

             $tag_groups = DB::table("vip_tag_group")->get();
     $tag_groups_arr = [];
    foreach($tag_groups as $tag){
        $tagArr = explode(",", $tag->tag);
        // dd(DB::table("tags")->select("name")->whereIn("id",$tagArr)->get()->toArray());
        $data = implode(";",DB::table("vip_tag")->select("name")->whereIn("id",$tagArr)->pluck("name")->toArray());
        $tag->str = $data;
        $tag_groups_arr[$tag->id]=$data;
    }
    // dd($finances);
    $tags = DB::table("vip_tag")->get();

    return view('vip.event',compact('vips',"tag_groups_arr","tags"));

  }
    function DeleteVipFileTag($id){
    DB::table("vip_tag_event")->where("id",$id)->delete();
     return Redirect()->back()->with('warning',' Đã xóa tệp tin thành công !');
}

   function DeleteVipFile($id){
    DB::table("vip_event")->where("id",$id)->delete();
     return Redirect()->back()->with('warning',' Đã xóa tệp tin thành công !');
}

  public function vipimport(Request $request){
DB::table("finance_sheet")->update(["amount"=>0]);

$array = Excel::toArray([], request()->file('user_file'));

$array = $array[1];

foreach($array as $row){
  if(is_int($row[5]) || is_float($row[5])){
    DB::table("finance_sheet")->where("eid",$row[2])->update(["amount"=>$row[5]]);
  }
}



      return redirect()->back()->with('notification', 'Đã cập nhật tệp thành công!!');
    

}
    public function vip_test($id = 0){  
    // setcookie("job_flag", 0, time()+3600*24, "/", false);
// dd($_COOKIE['job_flag']);
        // dd($_COOKIE['job_flag']);
        if(!$this->checkLead()){
            
            return redirect("/");
        }
        $curent_schedule =  DB::table("vip_event")->where("vip_id",0)->where("root_id",$id)->where("status",0)->get();
            $complete_schedule =  DB::table("schedule")->where("building_id",0)->where("root_id",$id)->where("status",1)->get();

            $stop_schedule = DB::table("schedule")->where("building_id",0)->where("root_id",$id)->where("status",2)->get();
 $schedule_list =  DB::table("schedule")->where("root_id",0)->where("status",0)->pluck('id')->toArray();

            if($id > 0 ){
                  $mys = DB::table("schedule")->where("building_id",0)->where("id",$id)->first();
                  $did = DB::table("schedule_department")->where("schedule_id",$mys->id)->pluck('department_id')->toArray();

            $dept = DB::table("department")->whereIn("id",$did)->get();
            }else{

            $dept = DB::table("department")->get();
            }


            $job_users = DB::table("schedule")
            ->RightJoin('schedule_department', 'schedule.id', '=', 'schedule_department.schedule_id')
            ->RightJoin('department', 'department.id', '=', 'schedule_department.department_id')
  ->select("department.id as id", "department.name as name",
                DB::raw('sum(CASE WHEN schedule.status = 0 THEN 1 ELSE 0 END) as s0'),
                DB::raw('sum(CASE WHEN schedule.status = 1 THEN 1 ELSE 0 END) as s1'),
                DB::raw('sum(CASE WHEN schedule.status = 2 THEN 1 ELSE 0 END) as s2')
            )
->where("schedule.building_id",0)
          ->groupBy('department.id')
                ->orderBy('department.id', 'asc')

          ->get();
        // dd($schedule_list);

 // dd($schedule_list);
            return view('schedule.boss', compact('schedule_list','id','dept','curent_schedule','complete_schedule','stop_schedule',"job_users"));
    }

  public function addNameVip(Request $req){

     try{

   $tagArr = [];

    $tags = explode(",", $req->tags);
    // dd($tags);
    foreach ($tags as $tag) {
        $tag = trim($tag);
       $count = DB::table("vip_tag")->where("name",$tag)->count();
       if($count > 0){

        $tagArr[] =  DB::table("vip_tag")->where("name",$tag)->first()->id;
       }else{
       $id = DB::table("vip_tag")->insertGetId([
          "name"=>$tag
        ]);
        $tagArr[] = $id;
      }
    }

               $vip_id = DB::table("vip")->insertGetId([
                    'name'=>$req->name,
                    'describe' => $req->describe,
                ]);

            
           foreach ($tagArr as $tag) {
                 # code...
               DB::table("vip_tag_connection")->insert([
                    'vip_id' => $vip_id,
                    'tag_id' => $tag,
                ]);
          }
            return Redirect()->back()->with('notification',' Đã tạo file thành công ');

            }
                catch (\Exception $e) { 
                  dd($e);
                // // return Redirect()->back()->with('warning',' Thiếu thông tin ');
                 }

  }

  
  public function addTagVipTag(Request $req){
   DB::table('vip_tag')->insert([
                    'name' => $req->name
                    
                ]);
            return Redirect()->back()->with('notification',' Đã tạo sự kiện thành công ');
 }
 public function addNewVipEvent(Request $req){
     DB::table('vip_event')->insert([
        'vip_id' => $req->id,
        'name' => $req->name,
        'type' => $req->type,
        'date' => $req->date,
        'is_lunar' => $req->is_lunar,
        'is_preply' => $req->is_preply,
        'end_date' => $req->end_date,
        'start_time'=>$req->start_time,
        'end_time'=>$req->end_time,
        'note'=>$req->note,
    ]);
     return Redirect()->back()->with('notification',' Đã tạo sự kiện thành công ');
 }

 public function addNewVipEventTag(Request $req){
   DB::table('vip_tag_event')->insert([
                    'tag_id' => $req->id,
                    'name' => $req->name,
                    'date' => $req->date,
                    'is_lunar' => $req->is_lunar,
                    'is_preply' => $req->is_preply,
                    'end_date' => $req->end_date,
                    'start_time'=>$req->start_time,
                    'end_time'=>$req->end_time,
                    'note'=>$req->note,
                ]);
            return Redirect()->back()->with('notification',' Đã tạo sự kiện thành công ');
 }

    public function EditVipEvent(Request $req){
        DB::table('vip_event')->where('id', $req->id)->update([
        'name' => $req->name,
        'date' => $req->date,
        'type' => $req->type,
        'is_lunar' => $req->is_lunar,
        'is_preply' => $req->is_preply,
        'end_date' => $req->end_date,
        'start_time'=>$req->start_time,
        'end_time'=>$req->end_time,
        'note'=>$req->note,
        ]);
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }
    public function EditVipEventTag(Request $req){
        DB::table('vip_tag_event')->where('id', $req->id)->update([
            'name' => $req->name,
            'date' => $req->date,
            'is_lunar'=>$req->is_lunar,
            'is_preply'=>$req->is_preply,
            'end_date' => $req->end_date,
            'start_time'=>$req->start_time,
            'end_time'=>$req->end_time,
            'note'=>$req->note,
        ]);
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

  public function deleteDanhSach(Request $req){
        // print($req);
        $data = $req->post();
        $flag = 0;
        foreach ($data as $key => $value){
            if(is_int($key)){
                // print($key);
                try{
                  
                    DB::table('vip_event')->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->back()->with('notification',' Đã xóa tất cả khách hàng.');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa khách');

        }
       
        

    }

  public function editvip(Request $req){
          
    $tagArr = [];
    $tags = explode(",", $req->tag);
    // dd($tags);
    foreach ($tags as $tag) {
        $tag = trim($tag);
       $count = DB::table("vip_tag")->where("name",$tag)->count();
       if($count > 0){

        $tagArr[] =  DB::table("vip_tag")->where("name",$tag)->first()->id;
       }else{
       $id = DB::table("vip_tag")->insertGetId([
          "name"=>$tag
        ]);
        $tagArr[] = $id;
      }
    }
    // dd($tagArr);
    DB::table("vip_tag_connection")->where("vip_id",$req->id)->delete();

              foreach ($tagArr as $tag) {
         # code...
       DB::table("vip_tag_connection")->insert([
            'vip_id' => $req->id,
            'tag_id' => $tag

        ]);
       }

        DB::table("vip")->where('id', $req->id)->update([
            'name'=>$req->name,
            'describe' => $req->describe,
        ]);

        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }
    public function vipDelete($id){
        // dd($id);

        DB::table("vip")->where("id",$id)->delete();
        return redirect()->back()->with("notification","Đã xóa file thành công");
    }
    public function updateVipTag(Request $req){
          
    $tagArr = [];
    $tags = explode(",", $req->tag);
    // dd($tags);
    foreach ($tags as $tag) {
        $tag = trim($tag);
       $count = DB::table("vip_tag")->where("name",$tag)->count();
       if($count > 0){

        $tagArr[] =  DB::table("vip_tag")->where("name",$tag)->first()->id;
       }else{
       $id = DB::table("vip_tag")->insertGetId([
          "name"=>$tag
        ]);
        $tagArr[] = $id;
      }
    }
    // dd($tagArr);
    DB::table("vip_tag_connection")->where("vip_id",$req->id)->delete();

              foreach ($tagArr as $tag) {
         # code...
       DB::table("vip_tag_connection")->insert([
            'vip_id' => $req->id,
            'tag_id' => $tag

        ]);
       }

        DB::table("vip_tag")->where('id', $req->id)->update([
            'name'=>$req->name,
            
        ]);

        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

}