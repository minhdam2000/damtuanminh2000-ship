<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use App\KmsClient;
use App\Camera;
use Illuminate\Http\Request;
use App\Account;
use App\Event;
use Carbon\Carbon;

class EventController extends Controller
{	
	public function getEvents($adminId){
		if($adminId == Auth()->user()->id){
			$events = Event::where('admin_id', $adminId)->orderBy('created_at', 'desc')->take(5)->get();
			return $events;
		}
		return;
	}

public function contributeTask(){
if (!$this->checkContributeMap()){
	return redirect("/");
}


$startDate = Carbon::today()->addDays(-30);
$endDate = Carbon::today()->addDays(7);

$contribute_all = DB::table("history_zone")
->leftJoin('zone', 'zone.id', '=', 'history_zone.zone_id')
->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
->leftJoin('projects', 'projects.id', '=', 'map_config.project_id')
->select("projects.name as pname","history_zone.id as id","history_zone.url as url","history_zone.description as des","zone.name as name","history_zone.updated_at as updated_at")->get();

// dd($contribute);

$contribute_near = DB::table("history_zone")
->leftJoin('zone', 'zone.id', '=', 'history_zone.zone_id')
->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
->leftJoin('projects', 'projects.id', '=', 'map_config.project_id')
->select("projects.name as pname","history_zone.id as id","history_zone.url as url","history_zone.description as des","zone.name as name","history_zone.updated_at as updated_at")
->whereBetween('history_zone.updated_at', [$startDate, $endDate])->get();

return view('event.contribute',compact('contribute_all',"contribute_near"));
}

	public function saleTask(){
if (!$this->checkSaleMap()){
	return redirect("/");
}
$startDate = Carbon::today();
$endDate = Carbon::today()->addDays(7);

$task = DB::table('zone_task')
->leftJoin('zone', 'zone_task.zone_id', '=', 'zone.id')
->leftJoin('staff_task', 'zone_task.task_id', '=', 'staff_task.id')
->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
 ->select("zone.id as id","consumer.name as cname","consumer.phone_number as cphone","zone.name as zname"
 	,"zone_task.end_date as date","staff_task.name as sname")->get();

$pay = DB::table('zone_pay')
->leftJoin('zone', 'zone_pay.zone_id', '=', 'zone.id')
->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
 ->select("zone.id as id","consumer.name as cname","consumer.phone_number as cphone","zone.name as zname"
 	,"zone_pay.date as date","zone_pay.step as step","zone_pay.money as money")->get();

$task_near = DB::table('zone_task')
->leftJoin('zone', 'zone_task.zone_id', '=', 'zone.id')
->leftJoin('staff_task', 'zone_task.task_id', '=', 'staff_task.id')
->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
 ->select("zone.id as id","consumer.name as cname","consumer.phone_number as cphone","zone.name as zname"
 	,"zone_task.end_date as date","staff_task.name as sname")
->whereBetween('end_date', [$startDate, $endDate])->get();

$pay_near = DB::table('zone_pay')
->leftJoin('zone', 'zone_pay.zone_id', '=', 'zone.id')
->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
 ->select("zone.id as id","consumer.name as cname","consumer.phone_number as cphone","zone.name as zname"
 	,"zone_pay.date as date","zone_pay.step as step","zone_pay.money as money")
->whereBetween('date', [$startDate, $endDate])->get();

		return view('event.sale_task',compact('task_near',"pay_near","pay","task"));
	}
	public function getEventList(){

		DB::table('events')
	    ->leftJoin('event_noti', 'event_noti.event_id', '=', 'events.id')
		->where("event_noti.user_id",Auth()->user()->id)->update([
				"seen"=>1
		]);
		if ($this->checkLead()){
		$sale_events = DB::table('events')
	    ->leftJoin('event_noti', 'event_noti.event_id', '=', 'events.id')
	    ->leftJoin('users', 'events.user_id', '=', 'users.id')
	    ->leftJoin('staff', 'users.id', '=', 'staff.user_id')
	    ->leftJoin('accountant', 'users.id', '=', 'accountant.user_id')
		->select("events.id as id",'events.title as title','events.description as description', 'events.type as type',
      "events.permiss as permiss","events.created_at as time","staff.name as staff_name", "accountant.name as accountant_name","event_noti.seen as seen")
		->where("event_noti.user_id",Auth()->user()->id)
		->where("type",1)->where("permiss",0)->get();

		$sale_count = DB::table('events')
	    ->leftJoin('event_noti', 'event_noti.event_id', '=', 'events.id')
		->where("event_noti.user_id",Auth()->user()->id)
		->where("event_noti.seen",0)
		->where("type",1)->count();

        $contribute_events = DB::table('events')
	    ->leftJoin('event_noti', 'event_noti.event_id', '=', 'events.id')
	    ->leftJoin('users', 'events.user_id', '=', 'users.id')
	    ->leftJoin('contributes', 'users.id', '=', 'contributes.user_id')
		->select("events.id as id",'events.title as title','events.description as description', 'events.type as type',
      "events.permiss as permiss","contributes.name as con_name","events.created_at as time","event_noti.seen as seen")
		->where("event_noti.user_id",Auth()->user()->id)
		->where("type",2)->where("permiss",0)->get();

		$contribute_count = DB::table('events')
	    ->leftJoin('event_noti', 'event_noti.event_id', '=', 'events.id')
		->where("event_noti.user_id",Auth()->user()->id)
		->where("event_noti.seen",0)
		->where("type",2)->count();

        $system_events = DB::table('events')
	    ->leftJoin('event_noti', 'event_noti.event_id', '=', 'events.id')
	    ->leftJoin('users', 'events.user_id', '=', 'users.id')
		->select("events.id as id",'events.title as title','events.description as description', 'events.type as type',
      "events.permiss as permiss","users.email as email","events.created_at as time","event_noti.seen as seen")
		->where("event_noti.user_id",Auth()->user()->id)
		->where("type",3)->where("permiss",0)->get();


		
		$system_count = DB::table('events')
	    ->leftJoin('event_noti', 'event_noti.event_id', '=', 'events.id')
		->where("event_noti.user_id",Auth()->user()->id)
		->where("event_noti.seen",0)
		->where("type",3)->count();

		// dd($system_count);

        $other_events = DB::table('events')->where("type",4)->where("permiss",0)->get();
		return view('event.admin_event_list',compact('sale_events',"contribute_events","system_events","other_events",
			"sale_count","contribute_count","system_count"
	));

		}elseif($this->checkContributeMap()){
$group_events = DB::table('events')->where("type",1)->where("permiss",0)->get();
 $personal_events = DB::table('events')->where("user_id",Auth()->user()->id)->where("permiss",1)->get();


$startDate = Carbon::today()->addDays(-14);;
$endDate = Carbon::today()->addDays(7);

// print_r($endDate);
 $job= DB::table("jobs")
->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
->leftJoin('users', 'users.id', '=', 'job_users.user_id')
->select("jobs.id as id","jobs.user_id as user_id","jobs.name as name","jobs.des as des","jobs.status as status"
  ,"jobs.start_date as start_date","jobs.end_date as end_date"
  ,DB::raw("group_concat(users.name SEPARATOR ', ') as names"))
// ->select(DB::raw("count(users.id)"))
->groupBy('jobs.id')
->where("job_users.user_id", Auth()->user()->id)->where("jobs.status",0)
->whereBetween('jobs.end_date', [$startDate, $endDate])->get();

$contribute = DB::table("history_zone")
->leftJoin('zone', 'zone.id', '=', 'history_zone.zone_id')
->select("history_zone.id as id","history_zone.url as url","history_zone.description as des","zone.name as name","history_zone.updated_at as updated_at")
->whereBetween('history_zone.updated_at', [$startDate, $endDate])->get();

	// dd($contribute);
return view('event.con_event_list',compact('job','personal_events',"group_events","contribute"));
		}

		else{
 $group_events = DB::table('events')->where("type",1)->where("permiss",0)->get();
 $personal_events = DB::table('events')->where("user_id",Auth()->user()->id)->where("permiss",1)->get();


$startDate = Carbon::today();
$endDate = Carbon::today()->addDays(7);


 $job= DB::table("jobs")
->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
->leftJoin('users', 'users.id', '=', 'job_users.user_id')
->select("jobs.id as id","jobs.user_id as user_id","jobs.name as name","jobs.des as des","jobs.status as status"
  ,"jobs.start_date as start_date","jobs.end_date as end_date"
  ,DB::raw("group_concat(users.name SEPARATOR ', ') as names"))
// ->select(DB::raw("count(users.id)"))
->groupBy('jobs.id')
->where("job_users.user_id", Auth()->user()->id)->where("jobs.status",0)
->whereBetween('jobs.end_date', [$startDate, $endDate])->get();

$task = DB::table('zone_task')
->leftJoin('zone', 'zone_task.zone_id', '=', 'zone.id')
->leftJoin('staff_task', 'zone_task.task_id', '=', 'staff_task.id')
->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
 ->select("consumer.name as cname","consumer.phone_number as cphone","zone.name as zname"
 	,"zone_task.end_date as date","staff_task.name as sname")
 ->where("zone.staff_id", Auth()->user()->id)
->whereBetween('end_date', [$startDate, $endDate])->get();

$pay = DB::table('zone_pay')
->leftJoin('zone', 'zone_pay.zone_id', '=', 'zone.id')
->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
 ->select("consumer.name as cname","consumer.phone_number as cphone","zone.name as zname"
 	,"zone_pay.date as date","zone_pay.step as step","zone_pay.money as money")
 ->where("zone.staff_id", Auth()->user()->id)
->whereBetween('date', [$startDate, $endDate])->get();

		return view('event.event_list',compact('job','personal_events',"group_events","pay","task"));
		}
	}

	public function checkEvent(){
		$countEventWatched = Event::where('admin_id', Auth()->user()->id)->whereNull('status')->count();
		if($countEventWatched != 0)
			return 1;
		else
			return 0;
	}

	public function eventWatched(){
		Event::where('admin_id', Auth()->user()->id)->update([
			'status' => 1
		]);
		return;
	}

	public function getHistory($cam_id, $date)
    {
        // $dateEvent = date("Y-m-d");
        $data = DB::table('events')->get();
        return response()->json($data);
    }

    public function Noti($type){
    		if($this->checkLead()){
		$event = DB::table('events')
	    ->leftJoin('event_noti', 'event_noti.event_id', '=', 'events.id')
				->where("event_noti.seen",0)
				->where("events.type",$type)
			     ->where("event_noti.user_id",Auth()->user()->id)->update(["seen" =>1]);
			  }
    }

}