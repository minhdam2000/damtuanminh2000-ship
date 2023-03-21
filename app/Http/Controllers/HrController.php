<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Userreq;
use App\Credential;
use App\Broker;
use DB;
use File;
use App\Consumer;
use App\Job;
use App\Jobmoniters;
use App\Staff;
use App\Accountant;
use App\Department;
use App\Role;
use App\Reply;
use App\Like;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Mail;

use App\Http\Requests;


class HrController extends Controller
{   
    
//substep

    public function index(){
         if(!$this->checkHuman()){
        return redirect("/");
      }
        $infos = DB::table("department")
        ->leftJoin('department_permission',"department_permission.department_id","department.id")
     ->select(
        "department.id as id","department.name as name",
        "department.hid as hid","department.mid as mid",
        "department.des as des",
        DB::raw("group_concat(department_permission.permission_id SEPARATOR ', ') as permiss"))
     ->groupBy('department.id')
     ->get() ;
     // dd($infos);
        $level = 1;

         $staffList = DB::table("users")
     ->where("users.admin_id",">",1)->where("status",">",0)
     ->where("role",0)
     ->select("users.name as name","users.email as email"
        , "users.phone as phone",
      "users.identify as identify", "users.id as id")
    ->where("role_id","<>",26)
     ->get();

     $permission =  DB::table("permission")->get();

        
    return view('hr.index', compact('infos',"level","staffList","permission")); 
    }

    public function getDepartPermiss($id){
        return DB::table("department_permission")
        ->where("department_id",$id)->pluck("permission_id")
        ->toArray();
    }


    public function getAdminDepartment(){
        // dd(Auth::user()->admin_id );
         if(Auth::user()->admin_id > 1){
        return redirect("/");
      }
        $infos = Department::get();
        $chartData = [];
        foreach ($infos as $info) {
            $temp = [];
            $temp[] = $info->name;

            // $roles = Role::where('department_id', $info->id)->get();
            $temp[] = 0;
            $chartData[] = $temp;
         }
        return view('hr.admin-department', compact('infos',"chartData")); 
    }

       public function getAdminContribute(){
         if(!$this->checkHuman()){
        return redirect("/");
      }
        $infos = DB::table("contractors")->get();
        return view('hr.admin-contribute', compact('infos')); 
    }

 public function getHrPlotDetail(){
        $infos = Department::get();
        $chartData = [];
        return 0;
        foreach ($infos as $info) {
            $temp = [];
            $roles = 0;
            $sum =0;
            $temp12 = [];
         // foreach ($chartData as $chartData) {
         //    print_r($chartData);
         // }
         // dd($chartData);
         // foreach ($chartData[0][2] as $key => $value) {
         //     echo $key;
         }
        return view('hr.hrplot', compact('infos',"chartData")); 
    }

 public function getHrPlot(){

        $root = Department::where("id",10)->first();
        $infos = Department::where("mid",10)->get();
        $chartData = [];
        foreach ($infos as $info) {
            $temp = [];
            $roles =  Department::where("mid",$info->id)->get();
            $sum =0;
            $temp12 = [];
            foreach ($roles as $role) {
                $count = 0;
                $sum = $sum  + $count;
            $temp2 = [];


            $temp2[] = $role->id;
            $temp2[] = $role->name;
            $temp2[] = 1;
            $temp12[] = $temp2;
            }
            $temp[] = $info->name;
            $temp[] = $info->id;
            $temp[] = $temp12;
            $chartData[] = $temp;
        }
         // foreach ($chartData as $chartData) {
         //    print_r($chartData);
         // }
         // dd($chartData);
         // foreach ($chartData[0][2] as $key => $value) {
         //     echo $key;
         // }
        return view('hr.hrplot', compact('root','infos',"chartData")); 
    }

    public function getAdminDepartmentInfo($id){
         if(!$this->checkHuman()){
        return redirect("/");
      }
   
    $department_name= Department::where("id",$id)->first()->name;

    $infos = 0;

   return view('hr.admin-role', compact('id','infos','department_name'));

    }
  
    public function getStaffByDepartment($id){

    $department = Department::where("id",$id)->first();

    $des = $department->des;
    $img = $department->url;

       $user =  DB::table("users")
     ->select("users.name as name", "users.phone as phone","users.identify as identify", "users.id as id")->where("status","<>",0)->get();

     return [$user,$des,$img];

    }


    public function viewStaffByDepartment(){
      $staffs = DB::table("users")
      ->leftJoin("user_department","user_department.user_id","users.id")
      ->leftJoin("department","user_department.department_id","department.id")
     ->where("users.admin_id",">",1)->where("status",">",0)
     ->select("users.name as name","users.email as email", "users.phone as phone","users.identify as identify", "users.id as id",
        "department.name as dname")->get();


      $users = DB::table("users")
      ->leftJoin("user_department","user_department.user_id","users.id")
      ->leftJoin("department","user_department.department_id","department.id")
     ->where("users.admin_id",">",1)->where("status",">",0)
     ->select("users.name as name","users.email as email", "users.phone as phone",
      "users.identify as identify", "users.id as id","department.name as dname")->get();


   $addrequest = [];

    $deleterequest = [];

$department= Department::get();
$roles = [];
   return view('hr.staff-list', compact('staffs','roles'
    ,'department','users','addrequest','deleterequest'));

    }

    public function getStaffInfo($id){
        $flag = 0;
         if(Auth::user()->id == $id){
            $flag = 1;
         }

         if(!$this->checkLead() && $flag ==0){
        return redirect("/");
      }
    $user_info = DB::table("users")
     ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
     ->leftJoin('department', 'department.id', '=', 'roles.department_id')
    ->select("users.name as name","users.email as email","users.phone as phone","users.begin_date as begin_date",
        "users.identify as identify","roles.name as rname","department.name as dname",
        "users.created_at as time")
    ->where("users.id",$id)->first();

    $events = DB::table("staff_event")
    ->where("staff_id",$id)->get();
    // dd($user_info->name);

    $job_stas = DB::table("jobs")
     ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
     ->select("jobs.status",DB::raw("count(jobs.id) as num"))->groupBy("jobs.status")
     ->where("job_users.user_id",$id)
     ->get();

     $job_info = DB::table("jobs")
     ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
     ->select("jobs.name as name", "jobs.start_date as sdate",
      "jobs.end_date as edate as name", "jobs.status as status")
     ->where("job_users.user_id",$id)
     ->get();

    $reply = Reply::where("user_id",$id)->count();
    $likes = DB::table("replies")
     ->leftJoin('likes', 'likes.reply_id', '=', 'replies.id')
     ->where("replies.user_id",$id)->count();

    $sale_info = DB::table("zone")
     ->leftJoin('users', 'zone.staff_id', '=', 'users.id')
     ->select("zone.name as name","zone.final_price as price","zone.updated_at as date","zone.gap as gap")
     ->where("users.id",$id)->get();

    $num_sale =  DB::table("zone")
     ->leftJoin('users', 'zone.staff_id', '=', 'users.id')
     ->where("users.id",$id)->count();

 $salary = DB::table("users")
     ->leftJoin('user_salary', 'user_salary.user_id', '=', 'users.id')
     ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
     ->leftJoin('department', 'roles.department_id', '=', 'department.id')
     ->where("users.id",$id)
     ->select("users.name as name","users.email as email", "users.phone as phone",
"user_salary.salary as salary","user_salary.kpi as kpi", "user_salary.penalty as penalty","user_salary.gap as gap","user_salary.month as month","user_salary.year as year",
      "users.identify as identify", "users.id as id","roles.name as rname",
      "department.name as dname")
     ->get();

    $price_sale =  DB::table("zone")
     ->leftJoin('users', 'zone.staff_id', '=', 'users.id')
     ->select(DB::raw("sum(zone.final_price) as price"))->groupBy("users.id")
     ->where("users.id",$id)->first();

   return view('hr.human', compact("id",'user_info',"events",'job_info','job_stas','sale_info'
    ,'reply','likes','num_sale','price_sale',"salary"));

    }
    public function addNewAdminDepartment(Request $req){
         if(!$this->checkHuman()){
        return redirect("/");
      }


       $dept_id = Department::insertGetId([
            'name' => $req->name,
            'mid' => 0,
            'des' => $req->des
        ]);

       $permiss = $req->pid;
 $allow_list = [28,198,180,179];
    if(in_array(Auth()->user()->id, $allow_list) || $isLead){
       foreach($permiss as $permiss_id){
            DB::table("department_permission")
            ->insert([
                "department_id"=> $dept_id,
                "permission_id"=> $permiss_id,
            ]);
       }
   }

          
            return Redirect()->back()->with('notification',' Đã tạo phòng ban thành công ');
    }

    public function editAdminDepartment(Request $req){
         if(!$this->checkHuman()){
        return redirect("/");
      }

        Department::where('id', $req->id)->update([
            'name' => $req->name,
            'des' => $req->des,
            'mid' => $req->mid,
            'hid' => $req->hid,
        ]);

        DB::table("department_permission")
        ->where("department_id",$req->id)
        ->delete();
$allow_list = [28,198,180,179];
    if(in_array(Auth()->user()->id, $allow_list) || $this->checkLead()){
        $permiss = $req->pid;
           foreach($permiss as $permiss_id){
                DB::table("department_permission")
                ->insert([
                    "department_id"=> $req->id,
                    "permission_id"=> $permiss_id,
                ]);
           }
}
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

    public function deleteDepartment($id){
    if($id == 14){
        $allow_list = [28,198,180,179];
        if(!in_array(Auth()->user()->id, $allow_list) && !$this->checkLead()){
            return redirect("/");
        }
    }
         $users = DB::table("users")->where("department_id",$id)->pluck('id')->toArray();
            foreach($users as $user_id){
            $count = DB::table("user_department")->where("user_id",$user_id)->count();
            if ($count  > 0 ){
                $dept = DB::table("user_department")
                ->leftJoin('department',"department.id","user_department.department_id")
                ->where("user_department.user_id",$user_id)
                ->where("department.mid",">",0)->first();
                if ($dept != null){

                    DB::table("users")->where("id",$user_id)->update(["department_id"=>$dept->id]);
                }else{

                    $rid = DB::table("user_department")->where("user_id",$user_id)->first()->department_id;
                    DB::table("users")->where("id",$user_id)->update(["department_id"=>$rid]);
                }
            }else{
                DB::table("users")->where("id",$user_id)->update(["department_id"=>0]);
            }
        }


        Department::where("id",$id)->delete(); 
        DB::table("user_department")->where("department_id",$id)->delete(); 



        return Redirect()->back()->with('notification',' Đã xóa phòng ban');
       


    }

    public function deleteRole($id){
       $user_count = DB::table('users')->where("role_id",$id)->count();
       if ($user_count > 0){
            return Redirect()->back()->with('warning', 'Không thể xóa khi phòng đang có nhân viên');
       }else{

        Role::where("id",$id)->delete(); 

           return Redirect()->back()->with('notification',' Đã xóa chức vụ');
       }


    }


    public function deleteAdminDepartment(Request $req){
         if(!$this->checkHuman()){
        return redirect("/");
      }
        // print($req);
        $data = $req->post();
        $flag = 0;
        foreach ($data as $key => $value){
            if(is_int($key)){
                // print($key);
                try{
                  
                    Department::where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->route('admin-department')->with('notification',' Đã xóa tất cả phòng ban');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa phòng ban');

        }
       
        

    }
     
     public function addNewAdminRole(Request $req){
         if(!$this->checkHuman()){
        return redirect("/");
      }


       Role::insert([
            'department_id' => $req->id,
            'name' => $req->name,
            'level' => $req->level,
            'des' => $req->des,

        ]);
            return Redirect()->back()->with('notification',' Đã tạo chức vụ thành công ');
    }

    public function editAdminRole(Request $req){
         if(!$this->checkHuman()){
        return redirect("/");
      }
      // dd($req->des);
        Role::where('id', $req->id)->update([
            'name' => $req->name,
            'level' => $req->level,
            'des' => $req->des,
        ]);
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

    public function deleteAdminRole(Request $req){
         if(!$this->checkHuman()){
        return redirect("/");
      }
        // print($req);
        $data = $req->post();
        $flag = 0;
        foreach ($data as $key => $value){
            if(is_int($key)){
                // print($key);
                try{
                  
                    Role::where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->back()->with('notification',' Đã xóa tất cả phòng ban');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa phòng ban');

        }
       
        

    }
     public function addNewStaffEvent(Request $req){
   DB::table('staff_event')->insert([
                    'staff_id' => $req->id,
                    'name' => $req->name,
                    'des' => $req->des,
                    'date' => $req->date
                ]);
            return Redirect()->back()->with('notification',' Đã tạo sự kiện thành công ');

            
               

    }

    public function EditStaffEvent(Request $req){
        DB::table('staff_event')->where('id', $req->id)->update([
            'name' => $req->name,
            'des' => $req->des,
            'date' => $req->date
        ]);
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

    public function deleteStaffEvent(Request $req){
        // print($req);
        $data = $req->post();
        $flag = 0;
        foreach ($data as $key => $value){
            if(is_int($key)){
                // print($key);
                try{
                  
                    DB::table('staff_event')->where("id",intval($key))->delete();
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


     public function addNewAdminContractors(Request $req){
         if(!$this->checkHuman()){
        return redirect("/");
      }


       DB::table("contractors")->insert([
            'name' => $req->name,
            'proxy' => $req->proxy,
            'phone' => $req->phone
        ]);
            return Redirect()->back()->with('notification',' Đã tạo nhà thầu thành công ');
    }

    public function editAdminContractors(Request $req){
         if(!$this->checkHuman()){
        return redirect("/");
      }

        DB::table("contractors")->where('id', $req->id)->update([
            'name' => $req->name,
            'proxy' => $req->proxy,
            'phone' => $req->phone
        ]);
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

    public function deleteAdminContractors(Request $req){
         if(!$this->checkHuman()){
        return redirect("/");
      }
        // print($req);
        $data = $req->post();
        $flag = 0;
        foreach ($data as $key => $value){
            if(is_int($key)){
                // print($key);
                try{
                  
                    DB::table("contractors")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->back()->with('notification',' Đã xóa tất cả nhà thầu');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa phòng ban');

        }
       
        

    }


    public function removeRole($user_id,$role_id){
         if(!$this->checkHuman()){
        return redirect("/");
      }

        DB::table("user_role")->where("user_id",$user_id)->where("role_id",$role_id)->delete();
        $currentRole = DB::table("users")->where("id",$user_id)->first()->role_id;
        if ($currentRole == $role_id){
            $count = DB::table("user_role")->where("user_id",$user_id)->count();
            if ($count  > 0 ){
                $rid = DB::table("user_role")->where("user_id",$user_id)->first()->role_id;
                DB::table("users")->where("id",$user_id)->update(["role_id"=>$rid]);
            }else{
                DB::table("users")->where("id",$user_id)->update(["role_id"=>0]);
            }

        }
                return Redirect()->back()->with('notification',' Đã xóa nhân viên khỏi phòng');

    }

     public function removeDepartment($user_id,$role_id){
         if(!$this->checkHuman()){
        return redirect("/");
      }

        DB::table("user_department")->where("user_id",$user_id)->where("department_id",$role_id)->delete();
        $currentRole = DB::table("users")->where("id",$user_id)->first()->role_id;
        if ($currentRole == $role_id){
            $count = DB::table("user_department")->where("user_id",$user_id)->count();
            if ($count  > 0 ){
                $rid = DB::table("user_department")->where("user_id",$user_id)->first()->department_id;
                DB::table("users")->where("id",$user_id)->update(["department_id"=>$rid]);
            }else{
                DB::table("users")->where("id",$user_id)->update(["department_id"=>0]);
            }

        }
                return Redirect()->back()->with('notification',' Đã xóa nhân viên khỏi phòng');

    }

    public function postAddUserRole(Request $req) {
        if(!$this->checkHuman()){
                return redirect("/");
              }

               $sid_array = $req->sid;

            // dd($sid_array);
            if($sid_array != null){
              foreach ($sid_array as $sid) {
               DB::table("user_role")->insert([
                "role_id"=>$req->role,
                "user_id"=>$sid,

            ]);
                $currentRole = DB::table("users")->where("id",$sid)->first()->role_id;
                if ($currentRole == $req->role){
                        DB::table("users")->where("id",$sid)->update(["role_id"=>$req->role]);
                }
            }
        }
          return Redirect()->back()->with('notification',' Đã thêm thành viên cho phòng!');
    }

     public function postAddUserDepartment(Request $req) {
        if(!$this->checkHuman()){
                return redirect("/");
              }

              if($req->department == 14){
        $allow_list = [28,198,180,179];
        if(!in_array(Auth()->user()->id, $allow_list) && !$this->checkLead()){
            return redirect("/");
        }
    }
    
               $sid_array = $req->sid;

            // dd($sid_array);
            if($sid_array != null){
              foreach ($sid_array as $sid) {
               DB::table("user_department")->insert([
                "department_id"=>$req->department,
                "user_id"=>$sid,

            ]);
                $currentDept = DB::table("users")->where("id",$sid)->first()->department_id;
                if($currentDept ==0){
                        DB::table("users")->where("id",$sid)->update(["department_id"=>$req->department]);
                }elseif ($currentDept != $req->department){
                        $deptCheck = DB::table("department")->where("id",$req->department)->first()->mid;

                        if ($deptCheck > 0){
                        DB::table("users")->where("id",$sid)->update(["department_id"=>$req->department]);
                        }
                }
            }
        }
          return Redirect()->back()->with('notification',' Đã thêm thành viên cho phòng!');
    }


    public function resetPass($id) {

    if(!$this->checkLead()){
        return redirect("/");
    }

    // $pass = Hash::make("123456");

    $user = DB::table("users")->where("id",$id)->first();
// dd($user);
    User::where('id', $id)->update(['password' => Hash::make("lopital")]);

    return 0;
    
    }
    public function postUserRegister(Request $req) {
 if(!$this->checkHuman()){
        return redirect("/");
      }
        if(count(User::where('email', $req->email)->where("status",1)->get()) != 0){

            return 'Đã tồn tại email';
        }
        elseif($req->password != $req->password_confirmation){
            return 'Mật khẩu không khớp';
        }
        else{

             User::where('email', $req->email)->delete();
             
            $new_user = new User();
            // $new_user->user_id = Auth()->user()->id;
            $new_user->name = $req->name;
            $new_user->email = $req->email;
            $new_user->phone = $req->phone_number;
            $new_user->identify = $req->identify;


            $new_user->iden_date = $req->iden_date;

            $new_user->iden_location = $req->iden_location;

            $new_user->tax_code = $req->tax_code;

            $new_user->birth_date = $req->birth_date;

            $new_user->begin_date = $req->begin_date;
            $new_user->bank = $req->bank;

            $new_user->bank_name = $req->bank_name;

            $new_user->role_id = 0;
            // if($req->role > 0 )
            //     $new_user->role_id = 0;
            // if($req->department == 12){
            //     $new_user->role_id = -($req->role);
            // }

            // $new_user->password = Hash::make($req->password);

            $pass = "123456";
            $new_user->password = Hash::make($pass);

          
            $new_user->save();

            // $department = Department::where("id",$req->department)->first()->name;
            // $role = Role::where("id",$req->role)->first()->name;

            $data = array('mypass'=>$pass,"myemail"=>$req->email,"email"=>$req->email);

            try{

                  Mail::send('newaccount', $data, function($message) use ($data)  {
                     $message->to($data['email'], 'thông báo tài khoản cho nhân viên')->subject
                        ('Thông báo tài khoản cho nhân viên');
                     $message->from('automail.lopital@gmail.com','Lopital');
                  });
            } catch (\Exception $e) { 
                dd($e);

                }

          
            return Redirect()->back()->with('notification',' Đã thêm tài khoản thành công');
        }
    }


    public function postRegister(Request $req) {
    // dd("123");
        if(count(User::where('email', $req->email)->get()) != 0){
            // dd("????11?");
            return Redirect()->back()->with('warning',' Email đã tồn tại');
            return 'Email already exist';
        }
        elseif($req->password != $req->password_confirmation){
            return Redirect()->back()->with('warning',' Xác nhận mật khẩu không khớp');
            return 'The password confirmation does not match';
        }
        else{
            // dd("?????");
            $new_user = new Userreq();
            $new_user->user_id = 0;
            $new_user->name = $req->name;
            $new_user->email = $req->email;
            $new_user->phone = $req->phone_number;
            $new_user->identify = $req->identify;


            $new_user->iden_date = $req->iden_date;

            $new_user->iden_location = $req->iden_location;

            $new_user->tax_code = $req->tax_code;

            $new_user->birth_date = $req->birth_date;



            $new_user->role_id = 5;

            $new_user->password = Hash::make($req->password);

          

      
 try{
      $avatar = $req->file[0];


            $path = $avatar->store('system');

            $avatar_url = Storage::url($path);

      $front = $req->file[1];

            $path = $front->store('system');

            $front_url = Storage::url($path);
        $back = $req->file[2];

            $path = $back->store('system');

            $back_url = Storage::url($path);

            $new_user->avatar =  $avatar_url;
            $new_user->save();


            DB::table("user_confirm")->insert([
                "user_id"=>$new_user->id,
                "front"=>$front_url,
                "back"=>$back_url,
            ]);


  }
  catch (\Exception $e) { 
            return Redirect()->back()->with('warning','Tải thiếu ảnh');
               }


    $email = $req->email;
      $data = array('name'=>$req->name,"email"=>$email);
      Mail::send('mail', $data, function($message) use ($data)  {
         $message->to($data['email'], 'Đăng kí công tác viên')->subject
            ('Đăng kí công tác viên thành công');
         $message->from('automail.lopital@gmail.com','Lopital');
      });
      // echo "Basic Email Sent. Check your inbox.";
   

           return view('account.thanks');
        }
    }


function deleteRequest($id){
 if(!$this->checkHuman()){
        return redirect("/");
      }
      DB::table("users")->where("id",$id)->update(["status"=>0]);
    // DB::table("users_delete_request")->insert(["user_id"=>Auth()->user()->id
    // ,"request_id"=>$id]);
    return Redirect()->back()->with('notification',' Đã thêm yêu cầu');
      
}

function removeAddRequest($id){
 if(!$this->checkHuman()){
        return redirect("/");
      }
    DB::table("users_add_request")->where("id",$id)->first()->user_id;
    if($user_id == Auth()->user()->id){
    DB::table("users_add_request")->where("id",$id)->delete();
    return Redirect()->back()->with('notification',' Đã thêm yêu cầu');
    }else{

    return Redirect()->back()->with('warning',' Bạn không có quyền với tác vụ');
    }
      
}

function removeDeleteRequest($id){
 if(!$this->checkHuman()){
        return redirect("/");
      }
      DB::table("users_delete_request")->where("id",$id)->first()->user_id;
    if($user_id == Auth()->user()->id){
    DB::table("users_delete_request")->where("id",$id)->delete();
    return Redirect()->back()->with('notification',' Đã thêm yêu cầu');
    }else{

    return Redirect()->back()->with('warning',' Bạn không có quyền với tác vụ');
    }

      
}

public function getRequestList(){
 if(!$this->checkHuman()){
        return redirect("/");
      }
        if(Auth()->user()->admin_id < 2){
            $addrequest = DB::table("users_add_request")
     ->leftJoin('user_confirm', 'user_confirm.user_id', '=', 'users_add_request.id')
     ->leftJoin('users', 'users.id', '=', 'users_add_request.user_id')
     ->leftJoin('roles', 'roles.id', '=', 'users_add_request.role_id')
     ->leftJoin('department', 'department.id', '=', 'roles.department_id')
     ->select("users_add_request.name as name","users_add_request.email as email", "users_add_request.phone as phone","users.name as nname","users.email as nemail",
      "users_add_request.identify as identify", "users_add_request.id as id","users_add_request.created_at as time","user_confirm.front as front", "user_confirm.back as back","users_add_request.avatar as avatar",
      "roles.name as rname","department.name as dname")->where("users_add_request.status",0)->get();
     // dd($addrequest);
    $deleterequest = DB::table("users_delete_request")
     ->leftJoin('users', 'users.id', '=', 'users_delete_request.request_id')
     ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
     ->leftJoin('department', 'department.id', '=', 'roles.department_id')
     ->select("users.name as name","users.email as email", "users.phone as phone","users_delete_request.user_id as user_id","users_delete_request.created_at as time",
      "users.identify as identify", "users_delete_request.id as id",
      "roles.name as rname","department.name as dname")->where("users_delete_request.status",0)->get();

             $addrequest1 = DB::table("users_add_request")
     ->leftJoin('users', 'users.id', '=', 'users_add_request.user_id')
     ->leftJoin('roles', 'roles.id', '=', 'users_add_request.role_id')
     ->leftJoin('department', 'department.id', '=', 'roles.department_id')
     ->select("users_add_request.name as name","users_add_request.email as email", "users_add_request.phone as phone","users.name as nname","users.email as nemail",
      "users_add_request.identify as identify", "users_add_request.id as id","users_add_request.created_at as time",
      "roles.name as rname","department.name as dname")->where("users_add_request.status",1)->get();

    $deleterequest1 = DB::table("users_delete_request")
     ->leftJoin('users', 'users.id', '=', 'users_delete_request.request_id')
     ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
     ->leftJoin('department', 'department.id', '=', 'roles.department_id')
     ->select("users.name as name","users.email as email", "users.phone as phone","users_delete_request.user_id as user_id","users_delete_request.created_at as time",
      "users.identify as identify", "users_delete_request.id as id",
      "roles.name as rname","department.name as dname")->where("users_delete_request.status",1)->get();
     

             $addrequest2 = DB::table("users_add_request")
     ->leftJoin('users', 'users.id', '=', 'users_add_request.user_id')
     ->leftJoin('roles', 'roles.id', '=', 'users_add_request.role_id')
     ->leftJoin('department', 'department.id', '=', 'roles.department_id')
     ->select("users_add_request.name as name","users_add_request.email as email", "users_add_request.phone as phone","users.name as nname","users.email as nemail","users_add_request.created_at as time",
      "users_add_request.identify as identify", "users_add_request.id as id",
      "roles.name as rname","department.name as dname")->where("users_add_request.status",2)->get();

    $deleterequest2 = DB::table("users_delete_request")
     ->leftJoin('users', 'users.id', '=', 'users_delete_request.request_id')
     ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
     ->leftJoin('department', 'department.id', '=', 'roles.department_id')
     ->select("users.name as name","users.email as email", "users.phone as phone","users_delete_request.user_id as user_id","users_delete_request.created_at as time",
      "users.identify as identify", "users_delete_request.id as id",
      "roles.name as rname","department.name as dname")->where("users_delete_request.status",2)->get();
     


            $department = Department::get();
            $roles = Role::where("department_id",$department[0]->id)->get();

            return view('account.admin_request_list',compact('department','roles','deleterequest','addrequest',
        'deleterequest1','addrequest1',
        'deleterequest2','addrequest2'));
        }
        
    }


function adminConfirmAddRequest($id){
 if(!$this->checkHuman()){
        return redirect("/");
      }
    $user_temp = DB::table("users_add_request")->where("id",$id)->first();

  $new_user = new User();
            $new_user->name = $user_temp->name;
            $new_user->email = $user_temp->email;
            $new_user->phone = $user_temp->phone;
            $new_user->identify = $user_temp->identify;


            $new_user->iden_date = $user_temp->iden_date;

            $new_user->iden_location = $user_temp->iden_location;

            $new_user->tax_code = $user_temp->tax_code;

            $new_user->birth_date = $user_temp->birth_date;

            $new_user->begin_date = $user_temp->begin_date;

            $new_user->role_id = $user_temp->role_id;
            
            $new_user->password = $user_temp->password;

            $new_user->display = 1;
            $new_user->status = 1;
          
            $new_user->save();

          
          $email = $user_temp->email;
      $data = array('name'=>$user_temp->name,"email"=>$email);
      Mail::send('mail', $data, function($message) use ($data)  {
         $message->to($data['email'], 'Đã mở tài khoản thành công')->subject
            ('Tài khoản của bạn đã được xét duyệt, bạn có thể truy cập và sử dụng hệ thống');
         $message->from('automail.lopital@gmail.com','Lopital');
      });



    DB::table("users_add_request")->where("id",$id)->update(["status"=>1]);
    return Redirect()->back()->with('notification',' Đã thêm yêu cầu');
      
}

function adminRemoveAddRequest($id){
 if(!$this->checkHuman()){
        return redirect("/");
      }
    DB::table("users_add_request")->where("id",$id)->update(["status"=>2]);
    return Redirect()->back()->with('notification',' Đã thêm yêu cầu');
      
}

function adminConfirmDeleteRequest($id){
 if(!$this->checkHuman()){
        return redirect("/");
      }
    $req = DB::table("users_delete_request")->where("id",$id)->first();
    DB::table("users")->where("id",$req->request_id)->update(["status"=>0]);
    DB::table("users_delete_request")->where("id",$id)->update(["status"=>1]);
    return Redirect()->back()->with('notification',' Đã thêm yêu cầu');
      
}

function adminRemoveDeleteRequest($id){  
 if(!$this->checkHuman()){
        return redirect("/");
      }
    DB::table("users_delete_request")->where("id",$id)->update(["status"=>2]);
    return Redirect()->back()->with('notification',' Đã thêm yêu cầu');
      
}
    function removeAccount($id){
        DB::table("users")->where("id",$id)->update([
            "status"=>0]); return Redirect()->back()->with('notification',' Đã xóa tài khoản');
    }
}