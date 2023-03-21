<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Credential;
use App\Broker;
use App\Area;
use App\Zone;
use DB;
use File;
use App\Consumer;
use App\Staff;
use App\Accountant;
use Carbon\Carbon;
use Excel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\TaxImport;
use App\Imports\FinImport;


class FinanceController extends Controller
{	


      public function index($id = 0){
     if(!$this->checkLeadDepart()){
        return redirect("/");
    }
    $isLead = $this->checkLead();





    $display_type = 0;
    // $task_total = DB::table("building_job")->where("level",0)->where("project_id",$id)->first();


    $total_amount  = DB::table("finance_sheet")
    ->count();

    if($total_amount > 0){
       $finance =DB::table("finance_sheet")->get();
      for ($i =0;$i <5;$i ++){
        foreach($finance as $fi){
            $temp_amount  = DB::table("finance_sheet")
            ->where("last_id",$fi->id)
             ->sum('amount');
             // if($i == 3){
             //    dd($temp_amount);
             // }
             if($temp_amount  != 0){
                 DB::table("finance_sheet")->where("id",$fi->id)
                 ->update([
                    "amount"=>$temp_amount
                 ]);
               }

        }

      }
    }

    $finance_sheet =DB::table("finance_sheet")->where("root_id",0)->get();


  // $input_details= DB::table("finance_sheet")
  //        ->select("finance_sheet.id as id","finance_sheet.title as title",
  //         "finance_sheet.description as description","finance_sheet.amount as amount",
  //         "0 as type","finance_sheet.date as date")->where("last_id",1)
  //        ->get();


$input_details_type_id=
    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);


$in = DB::table("finance_sheet")->where("id",1)->first()->amount;
$out = DB::table("finance_sheet")->where("id",2)->first()->amount;
$total = $in - $out;
// dd($total);
DB::table("finance_sheet")->where("id",6)
             ->update([
                "amount"=>$total
             ]);



$finance_list =DB::table("finance_sheet")->where("root_id",0)
->select("id","stt")->get();

// dd($finance_list);


  $input= DB::table("finance_sheet")
         ->select("finance_sheet.id as id","finance_sheet.title as title",
          "finance_sheet.description as description","finance_sheet.amount as amount","finance_sheet.date as date")->where("last_id",1)
         ->get();

$fin_input = DB::table("finance_sheet")
         ->select("finance_sheet.amount as amount")->where("id",1)->first()->amount;


      $asset= DB::table("finance_sheet")
         ->select("finance_sheet.id as id","finance_sheet.title as title",
          "finance_sheet.description as description","finance_sheet.amount as amount","finance_sheet.date as date")->where("last_id",3)
         ->get();
$fin_asset = DB::table("finance_sheet")
         ->select("finance_sheet.amount as amount")->where("id",3)->first()->amount;



        $dept= DB::table("finance_sheet")
         ->select("finance_sheet.id as id","finance_sheet.title as title",
          "finance_sheet.description as description","finance_sheet.amount as amount","finance_sheet.date as date")->where("last_id",5)
         ->get();
          
$fin_dept = DB::table("finance_sheet")
         ->select("finance_sheet.amount as amount")->where("id",5)->first()->amount;


        $output= DB::table("finance_sheet")
         ->select("finance_sheet.id as id","finance_sheet.title as title",
          "finance_sheet.description as description","finance_sheet.amount as amount","finance_sheet.date as date")->where("last_id",2)
         ->get();
 
$fin_output = DB::table("finance_sheet")
         ->select("finance_sheet.amount as amount")->where("id",2)->first()->amount;

 
$fin_money = DB::table("finance_sheet")
         ->select("finance_sheet.amount as amount")->where("id",6)->first()->amount;



        $unpay= DB::table("finance_sheet")
         ->select("finance_sheet.id as id","finance_sheet.title as title",
          "finance_sheet.description as description","finance_sheet.amount as amount","finance_sheet.date as date")->where("last_id",4)
         ->get();
          
$fin_unpay = DB::table("finance_sheet")
         ->select("finance_sheet.amount as amount")->where("id",4)->first()->amount;

return view('finance.index',compact("finance_sheet","finance_list","id",
"input","fin_input","fin_money",
"output","fin_output",
"dept","fin_dept",
"unpay","fin_unpay",
"asset","fin_asset","isLead"
));

  }

  public function index_input($id = 0){
         if(!$this->checkAccount()){
        return redirect("/");
      }




    $display_type = 0;
    // $task_total = DB::table("building_job")->where("level",0)->where("project_id",$id)->first();


    $total_amount  = DB::table("finance_input")
    ->sum('amount');

    if($total_amount > 0){
       $finance =DB::table("finance_input")->get();
      for ($i =0;$i <5;$i ++){
        foreach($finance as $fi){
            $temp_amount  = DB::table("finance_input")
            ->where("last_id",$fi->id)
             ->sum('amount');
             if($temp_amount  > 0){
             DB::table("finance_input")->where("id",$fi->id)
             ->update([
                "amount"=>$temp_amount
             ]);
           }

        }

      }
    }

    $finance_input =DB::table("finance_input")->where("root_id",0)->get();


  // $input_details= DB::table("finance_input")
  //        ->select("finance_input.id as id","finance_input.title as title",
  //         "finance_input.description as description","finance_input.amount as amount",
  //         "0 as type","finance_input.date as date")->where("last_id",1)
  //        ->get();


$input_details_type_id=
    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);


$in = DB::table("finance_input")->where("id",1)->first()->amount;
$out = DB::table("finance_input")->where("id",2)->first()->amount;
$total = $in - $out;
// dd($total);
DB::table("finance_input")->where("id",6)
             ->update([
                "amount"=>$total
             ]);



$finance_list =DB::table("finance_input")->where("root_id",0)
->select("id","stt")->get();

// dd($finance_list);


  $input= DB::table("finance_input")
         ->select("finance_input.id as id","finance_input.title as title",
          "finance_input.description as description","finance_input.amount as amount","finance_input.date as date")->where("last_id",1)
         ->get();

$fin_input = DB::table("finance_input")
         ->select("finance_input.amount as amount")->where("id",1)->first()->amount;


      $asset= DB::table("finance_input")
         ->select("finance_input.id as id","finance_input.title as title",
          "finance_input.description as description","finance_input.amount as amount","finance_input.date as date")->where("last_id",3)
         ->get();
$fin_asset = DB::table("finance_input")
         ->select("finance_input.amount as amount")->where("id",3)->first()->amount;



        $dept= DB::table("finance_input")
         ->select("finance_input.id as id","finance_input.title as title",
          "finance_input.description as description","finance_input.amount as amount","finance_input.date as date")->where("last_id",5)
         ->get();
          
$fin_dept = DB::table("finance_input")
         ->select("finance_input.amount as amount")->where("id",5)->first()->amount;


        $output= DB::table("finance_input")
         ->select("finance_input.id as id","finance_input.title as title",
          "finance_input.description as description","finance_input.amount as amount","finance_input.date as date")->where("last_id",2)
         ->get();
 
$fin_output = DB::table("finance_input")
         ->select("finance_input.amount as amount")->where("id",2)->first()->amount;

 
$fin_money = DB::table("finance_input")
         ->select("finance_input.amount as amount")->where("id",6)->first()->amount;



        $unpay= DB::table("finance_input")
         ->select("finance_input.id as id","finance_input.title as title",
          "finance_input.description as description","finance_input.amount as amount","finance_input.date as date")->where("last_id",4)
         ->get();
          
$fin_unpay = DB::table("finance_input")
         ->select("finance_input.amount as amount")->where("id",4)->first()->amount;

return view('finance.index',compact("finance_input","finance_list","id",
"input","fin_input","fin_money",
"output","fin_output",
"dept","fin_dept",
"unpay","fin_unpay",
"asset","fin_asset"
));

  }


   public function detail($id = 0){
         if(!$this->checkAccount()){
        return redirect("/");
      }




    $display_type = 0;
    // $task_total = DB::table("building_job")->where("level",0)->where("project_id",$id)->first();


    $total_amount  = DB::table("finance_sheet")
    ->sum('amount');

    if($total_amount > 0){
       $finance =DB::table("finance_sheet")->get();
      for ($i =0;$i <5;$i ++){
        foreach($finance as $fi){
            $temp_amount  = DB::table("finance_sheet")
            ->where("last_id",$fi->id)
             ->sum('amount');
             if($temp_amount  > 0){
             DB::table("finance_sheet")->where("id",$fi->id)
             ->update([
                "amount"=>$temp_amount
             ]);
           }

        }

      }
    }

    $finance_sheet =DB::table("finance_sheet")->where("last_id",$id)->get();




$in = DB::table("finance_sheet")->where("id",1)->first()->amount;
$out = DB::table("finance_sheet")->where("id",2)->first()->amount;
$total = $in - $out;
DB::table("finance_sheet")->where("id",6)
             ->update([
                "amount"=>$total
             ]);



$finance_list =DB::table("finance_sheet")->where("last_id",$id)
->select("id","stt")->get();

$cur_list = DB::table("finance_sheet")->where("id",$id)
->first();

return view('finance.detail',compact("finance_sheet","finance_list","id","cur_list"
));
}

public function deleteStep($id){

    $finance_sheet =DB::table("finance_sheet")->where("id",$id)->delete();
    return redirect()->back()->with("notification","Đã xóa hạng mục");
}

	public function getView(){
      if(!$this->checkAccount()){
        return redirect("/");
      }

            // dd(Auth::user()->role_id);
            return view('finance.finance');
        
    }
public function HumanDetail($id){
       if(!$this->checkAccount()){
        return redirect("/");
      }
            // dd(Auth::user()->role_id);
               $infomation = DB::table("zone_process")
     ->leftJoin('zone', 'zone_process.zone_id', '=', 'zone.id')
     ->leftJoin('users', 'zone.staff_id', '=', 'users.id')
    ->select("zone_process.id as id","zone.name as name","zone.gap as gap", "zone.state as state",
"zone.updated_at as date")
    ->where("users.id","=",$id)->get();


    return json_encode($infomation);

        
    }


    public function SalaryUpdate(){
       if(!$this->checkAccount()){
        return redirect("/");
      }

$startDate = Carbon::today()->firstOfMonth(); 

      $now = Carbon::now();
      // echo $now->year;
      // echo $now->month;
        $users = DB::table("users")->where("status",">",0)->get();
        foreach ($users as $user) {
          $check = DB::table("user_salary")->where("user_id",$user->id)
          ->where("month",$now->month)
          ->where("year",$now->year)
          ->count();
          try{
     print($user->id);
 $gap = DB::table("users")
     ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
     ->leftJoin('department', 'roles.department_id', '=', 'department.id')
     ->leftJoin('zone', 'users.id', '=', 'zone.staff_id')
     ->select(DB::raw('sum(CASE WHEN zone.updated_at > "'.$startDate.'" THEN zone.gap ELSE 0 END) as gap'))
    ->groupBy('users.id')
     ->where("users.id",$user->id)->first()->gap;
     print("<br>".$gap."<br>");
}     catch (\Exception $e){
      return $e->getMessage();
    }
          if($check > 0){
            DB::table("user_salary")->where("user_id",$user->id)
          ->where("month",$now->month)
          ->where("year",$now->year)
          ->update([
                "user_id" => $user->id,
                "salary" => $user->salary,
                "penalty" => $user->penalty,
                "gap" => $gap,
                "kpi" => $user->kpi,
                "year" => $now->year,
                "month" => $now->month
            ]);
          }else{
            DB::table("user_salary")->insert([
                "user_id" => $user->id,
                "salary" => $user->salary,
                "penalty" => $user->penalty,
                "gap" => $gap,
                "kpi" => $user->kpi,
                "year" => $now->year,
                "month" => $now->month
            ]);
          }
        }

 return redirect()->back()->with("notification","Đã lưu thông tin lương thành công");
        
    }

 public function salaryEdit(Request $req){
      if(!$this->checkAccount()){
        return redirect("/");
      }

      DB::table("users")->where("id",$req->id)->update([
          'salary' => $req->salary,
          'kpi' => $req->kpi,
          'penalty' => $req->penalty
      ]);

      return redirect()->back()->with("notification","Đã sửa thông tin thành công");

  }
    public function salary(){
      if(!$this->checkAccount()){
        return redirect("/");
      }


$startDate = Carbon::today()->firstOfMonth(); 

 $users_near = DB::table("users")
     ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
     ->leftJoin('department', 'roles.department_id', '=', 'department.id')
     ->leftJoin('zone', 'users.id', '=', 'zone.staff_id')
     ->where("users.admin_id",">",1)->where("users.status",">",0)
     ->select("users.name as name","users.email as email", "users.phone as phone",
"users.salary as salary","users.kpi as kpi", "users.penalty as penalty",
      "users.identify as identify", "users.id as id","roles.name as rname",
      "department.name as dname",
      DB::raw('sum(CASE WHEN zone.updated_at > "'.$startDate.'" THEN zone.gap ELSE 0 END) as gap'))
    ->groupBy('users.id')
     ->get();



        return view('finance.salary',compact('users_near'));
    

    }

  public function salaryDetail($year,$month){
      if(!$this->checkAccount()){
        return redirect("/");
      }

 $users_near = DB::table("users")
     ->leftJoin('user_salary', 'user_salary.user_id', '=', 'users.id')
     ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
     ->leftJoin('department', 'roles.department_id', '=', 'department.id')
     ->leftJoin('zone', 'users.id', '=', 'zone.staff_id')
     ->where("users.admin_id",">",1)->where("users.status",">",0)
     ->where("user_salary.month",$month)
     ->where("user_salary.year",$year)
     ->select("users.name as name","users.email as email", "users.phone as phone",
"user_salary.salary as salary","user_salary.kpi as kpi", "user_salary.penalty as penalty","user_salary.gap as gap",
      "users.identify as identify", "users.id as id","roles.name as rname",
      "department.name as dname")
     ->get();



        return view('finance.salary-detail',compact('users_near'));
    

    }

public function human(){
      if(!($this->checkSaleMap() && $this->checkLead())){
        return redirect("/");
      }


$startDate = Carbon::today()->firstOfMonth(); 

 $users_near = DB::table("users")
     ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
     ->leftJoin('zone', 'users.id', '=', 'zone.staff_id')
     ->where("roles.department_id",1)
     ->where("zone.updated_at",">",$startDate)
     ->where("users.admin_id",">",1)->where("users.status",">",0)
     ->select("users.name as name","users.email as email", "users.phone as phone","users.identify as identify", "users.id as id","roles.name as rname",
      DB::raw('sum(gap) as gap'))
    ->groupBy('users.id')
     ->get();

      $users = DB::table("users")
     ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
     ->leftJoin('zone', 'users.id', '=', 'zone.staff_id')
     ->where("roles.department_id",1)
     ->where("users.admin_id",">",1)->where("users.status",">",0)
     ->select("users.name as name","users.email as email", "users.phone as phone","users.identify as identify", "users.id as id","roles.name as rname",
      DB::raw('sum(gap) as gap'))
    ->groupBy('users.id')
     ->get();



        return view('finance.human',compact('users_near','users'));
    

    }

 public function tax()
{
  if(!$this->checkAccount()){
        return redirect("/");

      }

        $tax = DB::table("finance_tax")
         ->get();

        return view('finance.tax',compact('tax'));
}    


public function import(Request $request){
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

public function detailSale(){
      if(!$this->checkAccount()){
        return redirect("/");

      }

       $data  =  DB::table("zone")
           ->select(
            DB::raw('sum(zone.done) as done'),
DB::raw("date_format(zone.created_at, '%Y-%m') as time"),DB::raw("date_format(zone.created_at, '%m/%Y') as time_display")
           )
             ->groupBy("time")
             ->where("done",">",0)
           ->get();

     $detail  =  DB::table("zone")
           ->select('zone.done as done','zone.name as name','zone.updated_at as time')
             ->where("done",">",0)
           ->get();


  return view('finance.detail-sale',compact("data","detail"));  

    }

public function detailDaily(){
      if(!$this->checkAccount()){
        return redirect("/");

      }

        $data= DB::table("finance_output")
         ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
         ->leftJoin('users', 'finance_output.user_id', '=', 'users.id')
         ->select("finance_output.id as id","finance_output.title as title",
          "finance_output.description as description","finance_output.amount as amount",
          "finance_output.type as type","finance_output.date as date","users.name as uname",
          "finance_output_type.name as name")
         ->where("finance_output_type.id",9)
         ->get();

         

         $salary= DB::table("users")
             ->leftJoin('user_salary', 'user_salary.user_id', '=', 'users.id')
             ->where("users.admin_id",">",1)->where("users.status",">",0)
             ->select(DB::raw("sum(user_salary.salary) + sum(user_salary.kpi) - sum(user_salary.penalty) as salary"),
"user_salary.month as month", "user_salary.year as year" )
             ->groupBy("month","year")
             ->get();

           // dd($salary);

          $gap  =  DB::table("zone")
           ->select(
            DB::raw('sum(zone.gap) as gap'),
DB::raw("date_format(zone.created_at, '%Y-%m') as time"),DB::raw("date_format(zone.created_at, '%m/%Y') as time_display")
           )
             ->groupBy("time")
             ->where("gap",">",0)
           ->get();


           // dd($gap);

        return view('finance.detail-daily',compact("data", "salary", "gap"));  


    }


public function OldDetail($type,$id){
      if(!$this->checkAccount()){
        return redirect("/");

      }
      if ($type == 2){
        $type_name = DB::table("finance_output_type")
         ->where("finance_output_type.id",$id)
         ->first()->name;

        $data= DB::table("finance_output")
         ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
         ->leftJoin('users', 'finance_output.user_id', '=', 'users.id')
         ->select("finance_output.id as id","finance_output.title as title",
          "finance_output.description as description","finance_output.amount as amount",
          "finance_output.type as type","finance_output.date as date","users.name as uname",
          "finance_output_type.name as name")
         ->where("finance_output_type.id",$id)
         ->get();
}else{
        $type_name = DB::table("finance_input_type")
         ->where("finance_input_type.id",$id)
         ->first()->name;
        $data= DB::table("finance_input")
         ->leftJoin('finance_input_type', 'finance_input.type', '=', 'finance_input_type.id')
         ->leftJoin('users', 'finance_input.user_id', '=', 'users.id')
         ->select("finance_input.id as id","finance_input.title as title",
          "finance_input.description as description","finance_input.amount as amount",
          "finance_input.type as type","finance_input.date as date","users.name as uname",
          "finance_input_type.name as name")
         ->where("finance_input_type.id",$id)
         ->get();
}
        $output_type = DB::table("finance_output_type")->get();
        $input_type = DB::table("finance_input_type")->get();

        return view('finance.detail',compact("type_name","data"));  


    }



public function indexOld(){
      if(!$this->checkAccount()){
        return redirect("/");

      }

        $outputs= DB::table("finance_output")
         ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
         ->leftJoin('users', 'finance_output.user_id', '=', 'users.id')
         ->select("finance_output.id as id","finance_output.title as title",
          "finance_output.description as description","finance_output.amount as amount",
          "finance_output.type as type","finance_output.date as date","users.name as uname",
          "finance_output_type.name as name")
         ->get();
        $inputs= DB::table("finance_input")
         ->leftJoin('finance_input_type', 'finance_input.type', '=', 'finance_input_type.id')
         ->leftJoin('users', 'finance_input.user_id', '=', 'users.id')
         ->select("finance_input.id as id","finance_input.title as title",
          "finance_input.description as description","finance_input.amount as amount",
          "finance_input.type as type","finance_input.date as date","users.name as uname",
          "finance_input_type.name as name")
         ->get();



        $output_type = DB::table("finance_output_type")->get();
        $input_type = DB::table("finance_input_type")->get();

        return view('finance.index',compact('outputs','inputs',"input_type","output_type"));
    


    }

    public function getSubAsJson($id){

   $data = DB::table("finance_sheet")->where("last_id",$id)->get();
   // dd($data);
   return json_encode($data);
}
public function Addinput(Request $req){
      if(!$this->checkAccount()){
        return redirect("/");
      }

   $root =  DB::table("finance_input")->where("id",$req->id)->first();

 if($user->user_id > 0){

    $user_id = $user->user_id;
 }else{
    $user_id = $req->id;
 }

     
      DB::table("finance_input")->insert([
        "type"=>Auth()->user()->id,
        "user_id"=>$user_id,
        "title"=>$req->name,
        "description"=>$req->des,
        "amount"=>$req->amount,
        "date"=>$req->date
      ]);
     
    return redirect()->back()->with("notification","Đã thêm hạng mục");

    }


 public function Addsub(Request $req){
      if(!$this->checkAccount()){
        return redirect("/");
      }

   $root =  DB::table("finance_sheet")->where("id",$req->id)->first();

 if($root->root_id > 0){

    $root_id = $root->root_id;
 }else{
    $root_id = $req->id;
 }

     
      DB::table("finance_sheet")->insert([
        "sender"=>Auth()->user()->id,
        "root_id"=>$root_id,
        "last_id"=>$root->id,
        "title"=>$req->name,
        "amount"=>$req->amount,
      ]);
     
    return redirect()->back()->with("notification","Đã thêm hạng mục");

    }


     public function Editsub(Request $req){
      if(!$this->checkAccount()){
        return redirect("/");
      }
      // dd($req->amount);
     
      DB::table("finance_sheet")->where("id",$req->id)->update([
        "title"=>$req->name,
        "amount"=>$req->amount,
      ]);
     
    return redirect()->back()->with("notification","Đã sửa hạng mục");

    }


      public function Add(Request $req){
      if(!$this->checkAccount()){
        return redirect("/");
      }
     
      DB::table("finance_sheet")->insert([
        "sender"=>Auth()->user()->id,
        "title"=>$req->name,
        "description"=>$req->des,
        "amount"=>$req->amount,
        "date"=>$req->date
      ]);
     
    return redirect()->back()->with("notification","Đã thêm hạng mục");

    }


    public function Edit(Request $req){
      if(!$this->checkAccount()){
        return redirect("/");
      }

       DB::table("finance_sheet")->where("id",$req->id)->update([
        "title"=>$req->name,
        "description"=>$req->des,
        "amount"=>$req->amount,
        "date"=>$req->date
      ]);
      //  echo $table."<br>";
      // dd($req->id);
    return redirect()->back()->with("notification","Đã sửa hạng mục");

    }

   public function AddOld(Request $req){
      if(!$this->checkAccount()){
        return redirect("/");
      }

        if($req->table_type == 0){
        $table = "finance_input";
      }elseif($req->table_type == 1){
        $table = "finance_output";

      }elseif($req->table_type == 2){
        $table = "finance_asset";

      }elseif($req->table_type == 3){
        $table = "finance_dept";

      }
     
      DB::table($table)->insert([
        "user_id"=>Auth()->user()->id,
        "title"=>$req->name,
        "description"=>$req->des,
        "type"=>$req->type,
        "amount"=>$req->amount,
        "date"=>$req->date
      ]);
     
    return redirect()->back()->with("notification","Đã thêm hạng mục");

    }


    public function EditOld(Request $req){
      if(!$this->checkAccount()){
        return redirect("/");
      }

        if($req->table_type == 0){
        $table = "finance_input";
      }elseif($req->table_type == 1){
        $table = "finance_output";

      }elseif($req->table_type == 2){
        $table = "finance_asset";

      }elseif($req->table_type == 3){
        $table = "finance_dept";

      }
     

       DB::table($table)->where("id",$req->id)->update([
        "title"=>$req->name,
        "description"=>$req->des,
        "type"=>$req->type,
        "amount"=>$req->amount,
        "date"=>$req->date
      ]);
      //  echo $table."<br>";
      // dd($req->id);
    return redirect()->back()->with("notification","Đã sửa hạng mục");

    }


      public function taxFile($id){
         if(!$this->checkAccount()){
        return redirect("/");
      }


    $tax = DB::table("finance_tax")
    ->where("id",$id)->first();
    $file = DB::table("finance_tax_file")->where("fid",$id)->get();
    return view('finance.file',compact('tax','file','id'));

  }
        public function EditTax(Request $req){
      if(!$this->checkAccount()){
        return redirect("/");
      }


       DB::table("finance_tax")->where("id",$req->id)->update([
        "name"=>$req->name,
        "des"=>$req->des,
        "unit"=>$req->unit,
        "total"=>$req->total,
      ]);

      
    return redirect()->back()->with("notification","Đã sửa hạng mục");

    }



    public function Delete($type,$id){
      if(!$this->checkAccount()){
        return redirect("/");
      }
      if($type == 0){
         DB::table("finance_input")->where("id",$id)->delete();
      }else{
         DB::table("finance_output")->where("id",$id)->delete();
      }

    return redirect()->back()->with("notification","Đã sửa hạng mục");

    }



   

    public function type(){
      if(!$this->checkAccount()){
        return redirect("/");

      }

        $outputs= DB::table("finance_output_type")->get();
        $inputs= DB::table("finance_input_type")->get();
        return view('finance.type',compact('outputs','inputs'));
    


    }

    public function addType(Request $req){
      if(!$this->checkAccount()){
        return redirect("/");
      }
      if($req->type == 0){
         DB::table("finance_input_type")->insert(["name"=>$req->name]);
      }else{
         DB::table("finance_output_type")->insert(["name"=>$req->name]);

      }
    return redirect()->back()->with("notification","Đã thêm hạng mục");

    }


    public function EditType(Request $req){
      if(!$this->checkAccount()){
        return redirect("/");
      }
      if($req->type == 0){
         DB::table("finance_input_type")->where("id",$req->id)->update(["name"=>$req->name]);
      }else{
         DB::table("finance_output_type")->where("id",$req->id)->update(["name"=>$req->name]);

      }
    return redirect()->back()->with("notification","Đã sửa hạng mục");

    }

    public function deleteType($type,$id){
      if(!$this->checkAccount()){
        return redirect("/");
      }
      if($type == 0){
         DB::table("finance_input_type")->where("id",$id)->delete();
      }else{
         DB::table("finance_output_type")->where("id",$id)->delete();
      }

    return redirect()->back()->with("notification","Đã sửa hạng mục");

    }


    public function auditChart($type){

        if(!$this->checkAccount()){
        return redirect("/");
      }

            // dd(Auth::user()->role_id);
        // print_r('{"country": {"Nguyên Hoàng Sơn": 50, "Trương Tiến Dũng": 48, "Đặng Đức Huy": 51, "Nguyên văn A": 20, "Hoàng Văn B": 12, "Còn lại": 211}, "ip": {"Xuân An 1": 65, "Xuân An 2": 95,"Xuân An 3": 35,"Xuân An 4": 65,"Xuân An 5": 60,"Xuân An 6": 70}, "total_country": 7178, "total_ip": 7178}');
        if ($type == 3){
            $output= DB::table("finance_output")
            ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
            ->select(DB::raw("sum(finance_output.amount) as amount"),DB::raw(" sum(finance_output.amount) /(SELECT sum(amount) from finance_output) as percent"),
          "finance_output_type.name as type_name")->groupBy('type_name')->get();


            $input = DB::table("finance_input")
            ->leftJoin('finance_input_type', 'finance_input.type', '=', 'finance_input_type.id')
            ->select(DB::raw("sum(finance_input.amount) as amount"),DB::raw(" sum(finance_input.amount) /(SELECT sum(amount) from finance_input) as percent"),
          "finance_input_type.name as type_name")->groupBy('type_name')->get();

  $output_data_name= DB::table("finance_output")
            ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
            ->select("finance_output.title as title","finance_output.amount as amount","finance_output.created_at as time",
          "finance_output_type.name as type_name")->orderBy('type_name', 'asc')->get();

            $output_data_date= DB::table("finance_output")
            ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
            ->select("finance_output.title as title","finance_output.amount as amount","finance_output.created_at as time",DB::raw("DATE_FORMAT(finance_output.created_at, '%Y-%m-%d') as timegroup"),
          "finance_output_type.name as type_name")->orderBy('time', 'desc')->get();

              $input_data_name= DB::table("finance_input")
            ->leftJoin('finance_input_type', 'finance_input.type', '=', 'finance_input_type.id')
            ->select("finance_input.title as title","finance_input.amount as amount","finance_input.created_at as time",
          "finance_input_type.name as type_name")->orderBy('type_name', 'asc')->get();

              $input_data_date= DB::table("finance_input")
            ->leftJoin('finance_input_type', 'finance_input.type', '=', 'finance_input_type.id')
            ->select("finance_input.title as title","finance_input.amount as amount","finance_input.created_at as time",DB::raw("DATE_FORMAT(finance_input.created_at, '%Y-%m-%d') as timegroup"),
          "finance_input_type.name as type_name")->orderBy('time', 'desc')->get();



     $startDate = Carbon::today()->firstOfMonth(); 

       $salary= DB::table("users")
     ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
     ->leftJoin('department', 'roles.department_id', '=', 'department.id')
     ->leftJoin('zone', 'users.id', '=', 'zone.staff_id')
     ->where("users.admin_id",">",1)->where("users.status",">",0)
     ->select(DB::raw("sum(users.salary) as salary"),
      DB::raw("sum(users.kpi) as kpi"),
      DB::raw( "sum(users.penalty) as penalty"))
     ->first();


            $gap  =  DB::table("zone")
         ->select(
          DB::raw('sum(zone.gap) as gap'))
         ->first();

            $label = "Bảng cân đối thu chi toàn hệ thống";
            print_r(json_encode([json_encode($output),json_encode($input),json_encode($output_data_name),json_encode($output_data_date),json_encode($input_data_name),json_encode($input_data_date)
                    ,$label, json_encode($salary), json_encode($gap)]));;
        }elseif ($type == 0){
            $month =  now()->month;
            if ($month < 10){
                $month = '0'.$month;
            }
            $year =  now()->year;

            $output= DB::table("finance_output")
            ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
            ->select(DB::raw("sum(finance_output.amount) as amount"),DB::raw(" sum(finance_output.amount) /(SELECT sum(amount) from finance_output) as percent"),
          "finance_output_type.name as type_name")->where("finance_output.created_at","like",$year."-".$month."%")->groupBy('type_name')->get();


            $input = DB::table("finance_input")
            ->leftJoin('finance_input_type', 'finance_input.type', '=', 'finance_input_type.id')
            ->select(DB::raw("sum(finance_input.amount) as amount"),DB::raw(" sum(finance_input.amount) /(SELECT sum(amount) from finance_input) as percent"),
          "finance_input_type.name as type_name")->where("finance_input.created_at","like",$year."-".$month."%")->groupBy('type_name')->get();

             $output_data_name= DB::table("finance_output")
            ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
            ->select("finance_output.title as title","finance_output.amount as amount","finance_output.created_at as time",
          "finance_output_type.name as type_name")->where("finance_output.created_at","like",$year."-".$month."%")->orderBy('type_name', 'asc')->get();

            $output_data_date= DB::table("finance_output")
            ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
            ->select("finance_output.title as title","finance_output.amount as amount","finance_output.created_at as time",DB::raw("DATE_FORMAT(finance_output.created_at, '%Y-%m-%d') as timegroup"),
          "finance_output_type.name as type_name")->where("finance_output.created_at","like",$year."-".$month."%")->orderBy('time', 'desc')->get();

              $input_data_name= DB::table("finance_input")
            ->leftJoin('finance_input_type', 'finance_input.type', '=', 'finance_input_type.id')
            ->select("finance_input.title as title","finance_input.amount as amount","finance_input.created_at as time",
          "finance_input_type.name as type_name")->where("finance_input.created_at","like",$year."-".$month."%")->orderBy('type_name', 'asc')->get();

              $input_data_date= DB::table("finance_input")
            ->leftJoin('finance_input_type', 'finance_input.type', '=', 'finance_input_type.id')
            ->select("finance_input.title as title","finance_input.amount as amount","finance_input.created_at as time",DB::raw("DATE_FORMAT(finance_input.created_at, '%Y-%m-%d') as timegroup"),
          "finance_input_type.name as type_name")->where("finance_input.created_at","like",$year."-".$month."%")->orderBy('time', 'desc')->get();



            $label = "Bảng cân đối thu chi tháng ".$month." năm ".$year ;

      $startDate = Carbon::today()->firstOfMonth(); 

       $salary= DB::table("users")
     ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
     ->leftJoin('department', 'roles.department_id', '=', 'department.id')
     ->leftJoin('zone', 'users.id', '=', 'zone.staff_id')
     ->where("users.admin_id",">",1)->where("users.status",">",0)
     ->select(DB::raw("sum(users.salary) as salary"),
      DB::raw("sum(users.kpi) as kpi"),
      DB::raw( "sum(users.penalty) as penalty"))
     ->first();


            $gap  =  DB::table("zone")
         ->select(
          DB::raw('sum(CASE WHEN zone.updated_at > "'.$startDate.'" THEN zone.gap ELSE 0 END) as gap'))
         ->first();





            print_r(json_encode([json_encode($output),json_encode($input),json_encode($output_data_name),json_encode($output_data_date),json_encode($input_data_name),json_encode($input_data_date)
                    ,$label,json_encode($salary),json_encode($gap)]));
    }elseif ($type == 1){
            $month =  now()->month;
            $year =  now()->year;
            if ($month == 1){
                $month = 12;
                $year = $year - 1;

            }else{
                $month = $month - 1;
            }
            if ($month < 10){
                $month = '0'.$month;
            }

            $output= DB::table("finance_output")
            ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
            ->select(DB::raw("sum(finance_output.amount) as amount"),DB::raw(" sum(finance_output.amount) /(SELECT sum(amount) from finance_output) as percent"),
          "finance_output_type.name as type_name")->where("finance_output.created_at","like",$year."-".$month."%")->groupBy('type_name')->get();


            $input = DB::table("finance_input")
            ->leftJoin('finance_input_type', 'finance_input.type', '=', 'finance_input_type.id')
            ->select(DB::raw("sum(finance_input.amount) as amount"),DB::raw(" sum(finance_input.amount) /(SELECT sum(amount) from finance_input) as percent"),
          "finance_input_type.name as type_name")->where("finance_input.created_at","like",$year."-".$month."%")->groupBy('type_name')->get();

          $output_data_name= DB::table("finance_output")
            ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
            ->select("finance_output.title as title","finance_output.amount as amount","finance_output.created_at as time",
          "finance_output_type.name as type_name")->where("finance_output.created_at","like",$year."-".$month."%")->orderBy('type_name', 'asc')->get();

            $output_data_date= DB::table("finance_output")
            ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
            ->select("finance_output.title as title","finance_output.amount as amount","finance_output.created_at as time",DB::raw("DATE_FORMAT(finance_output.created_at, '%Y-%m-%d') as timegroup"),
          "finance_output_type.name as type_name")->where("finance_output.created_at","like",$year."-".$month."%")->orderBy('time', 'desc')->get();

              $input_data_name= DB::table("finance_input")
            ->leftJoin('finance_input_type', 'finance_input.type', '=', 'finance_input_type.id')
            ->select("finance_input.title as title","finance_input.amount as amount","finance_input.created_at as time",
          "finance_input_type.name as type_name")->where("finance_input.created_at","like",$year."-".$month."%")->orderBy('type_name', 'asc')->get();

              $input_data_date= DB::table("finance_input")
            ->leftJoin('finance_input_type', 'finance_input.type', '=', 'finance_input_type.id')
            ->select("finance_input.title as title","finance_input.amount as amount","finance_input.created_at as time",DB::raw("DATE_FORMAT(finance_input.created_at, '%Y-%m-%d') as timegroup"),
          "finance_input_type.name as type_name")->where("finance_input.created_at","like",$year."-".$month."%")->orderBy('time', 'desc')->get();


      $startDate = Carbon::today()->subDays(30)->firstOfMonth(); 

       $salary= DB::table("users")
     ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
     ->leftJoin('department', 'roles.department_id', '=', 'department.id')
     ->leftJoin('zone', 'users.id', '=', 'zone.staff_id')
     ->where("users.admin_id",">",1)->where("users.status",">",0)
     ->select(DB::raw("sum(users.salary) as salary"),
      DB::raw("sum(users.kpi) as kpi"),
      DB::raw( "sum(users.penalty) as penalty"))
     ->first();


            $gap  =  DB::table("zone")
         ->select(
          DB::raw('sum(CASE WHEN zone.updated_at > "'.$startDate.'" THEN zone.gap ELSE 0 END) as gap'))
         ->first();


            $label = "Bảng cân đối thu chi tháng ".$month." năm ".$year ;
            print_r(json_encode([json_encode($output),json_encode($input),json_encode($output_data_name),json_encode($output_data_date),json_encode($input_data_name),json_encode($input_data_date)
                    ,$label,json_encode($salary),json_encode($gap)
                  ]));;
        
    }elseif ($type == 2){
            $month =  now()->month;
            $year =  now()->year;

            if ($month  > 9){
                $month3 = 4;
                $fmonth = "10";
                $emonth = "12";
            }elseif($month > 6){
                $month3 = 3;
                $fmonth = "07";
                $emonth = "09";
            }elseif($month > 3){
                $month3 = 2;
                $fmonth = "04";
                $emonth = "06";
            }else{
                $month3 = 1;
                $fmonth = "01";
                $emonth = "03";
            }


            $output= DB::table("finance_output")
            ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
            ->select(DB::raw("sum(finance_output.amount) as amount"),DB::raw(" sum(finance_output.amount) /(SELECT sum(amount) from finance_output) as percent"),
          "finance_output_type.name as type_name")->where("finance_output.created_at",">",$year."-".$fmonth."%")->where("finance_output.created_at","<",$year."-".$emonth."%")->groupBy('type_name')->get();


            $input = DB::table("finance_input")
            ->leftJoin('finance_input_type', 'finance_input.type', '=', 'finance_input_type.id')
            ->select(DB::raw("sum(finance_input.amount) as amount"),DB::raw(" sum(finance_input.amount) /(SELECT sum(amount) from finance_input) as percent"),
          "finance_input_type.name as type_name")->where("finance_input.created_at",">",$year."-".$fmonth."%")->where("finance_input.created_at","<",$year."-".$emonth."%")->groupBy('type_name')->get();


            $output_data_name= DB::table("finance_output")
            ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
            ->select("finance_output.title as title","finance_output.amount as amount","finance_output.created_at as time",
          "finance_output_type.name as type_name")->where("finance_output.created_at",">",$year."-".$fmonth."%")->where("finance_output.created_at","<",$year."-".$emonth."%")->orderBy('type_name', 'asc')->get();

            $output_data_date= DB::table("finance_output")
            ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
            ->select("finance_output.title as title","finance_output.amount as amount","finance_output.created_at as time",DB::raw("DATE_FORMAT(finance_output.created_at, '%Y-%m-%d') as timegroup"),
          "finance_output_type.name as type_name")->where("finance_output.created_at",">",$year."-".$fmonth."%")->where("finance_output.created_at","<",$year."-".$emonth."%")->orderBy('time', 'desc')->get();

              $input_data_name= DB::table("finance_input")
            ->leftJoin('finance_input_type', 'finance_input.type', '=', 'finance_input_type.id')
            ->select("finance_input.title as title","finance_input.amount as amount","finance_input.created_at as time",
          "finance_input_type.name as type_name")->where("finance_input.created_at",">",$year."-".$fmonth."%")->where("finance_input.created_at","<",$year."-".$emonth."%")->orderBy('type_name', 'asc')->get();

              $input_data_date= DB::table("finance_input")
            ->leftJoin('finance_input_type', 'finance_input.type', '=', 'finance_input_type.id')
            ->select("finance_input.title as title","finance_input.amount as amount","finance_input.created_at as time",DB::raw("DATE_FORMAT(finance_input.created_at, '%Y-%m-%d') as timegroup"),
          "finance_input_type.name as type_name")->where("finance_input.created_at",">",$year."-".$fmonth."%")->where("finance_input.created_at","<",$year."-".$emonth."%")->orderBy('time', 'desc')->get();

     $salary= DB::table("users")
     ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
     ->leftJoin('department', 'roles.department_id', '=', 'department.id')
     ->leftJoin('zone', 'users.id', '=', 'zone.staff_id')
     ->where("users.admin_id",">",1)->where("users.status",">",0)
     ->select(DB::raw("sum(users.salary) as salary"),
      DB::raw("sum(users.kpi) as kpi"),
      DB::raw( "sum(users.penalty) as penalty"))
     ->first();


            $gap  =  DB::table("zone")
         ->select(
          DB::raw('sum(CASE WHEN zone.updated_at > "'.$year."-".$emonth."%".'" THEN zone.gap ELSE 0 END) as gap'))
         ->first();
        
            $label = "Bảng cân đối thu chi quý ".$month3." năm ".$year ;
            print_r(json_encode([json_encode($output),json_encode($input),json_encode($output_data_name),json_encode($output_data_date),json_encode($input_data_name),json_encode($input_data_date)
                    ,$label,json_encode($salary),json_encode($gap)
                  ]));;
            // print_r(json_encode([json_encode($output),json_encode($input)]));
        }
    }

    public function auditBar(){
          if(!$this->checkAccount()){
        return redirect("/");
      }
     $input =  DB::table("finance_input")
      ->select(DB::raw('sum(amount) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
->groupby('year','month')
->get();
     $output =  DB::table("finance_output")
      ->select(DB::raw('sum(amount) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
->groupby('year','month')
->get();


           $input_detail =  DB::table("finance_input")
      ->select(DB::raw('sum(amount) as `data`'),"type as type", DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  DB::raw('YEAR(created_at) year, MONTH(created_at) month',"type"))
->groupby("type",'year','month')
->get();
     $output_detail =  DB::table("finance_output")
      ->select(DB::raw('sum(amount) as `data`'),"type as type", DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
->groupby("type",'year','month')
->get();
      
            // dd(Auth::user()->role_id);
            return [$input,$output, $input_detail ,$output_detail ];
        
    }
 function editFile(Request $request){
    $title = $request->title;
    // dd($request->all());
  $i = DB::table("finance_tax_file")->where("fid",$request->id)->count();
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

       DB::table("finance_tax_file")->insert([
            'url' => $url,
            'name'=>$title,
            'fid'=>$request->id,
            'image_id'=>$i,
        ]);



      }


        }
catch (\Exception $e) { 
    return Redirect()->back()->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');;
               }

 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

}
  function editFileName(Request $request){
     DB::table('finance_tax_file')
              ->where('id', $request->id)
              ->update(['name' => $request->title]);

 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

}
    


function DeleteFile($id){
  if(!$this->checkLead()){
        return redirect()->back()->with('warning',' Tài khoản không có quyền thực hiện');
}

       DB::table("finance_tax_file")->where("id",$id)->delete();
 return Redirect()->back()->with('notification',' Đã xóa tệp tin thành công !');

}

}