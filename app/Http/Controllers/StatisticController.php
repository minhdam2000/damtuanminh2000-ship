<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
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

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class StatisticController extends Controller
{	
	public function getView(){

      if(!$this->checkLead()){
        return redirect("/");
      }
            // dd(Auth::user()->role_id);
            $staffs = Staff::get();
        $zone =  DB::table('zone')
        ->rightJoin('map_config', 'zone.name', '=', 'map_config.name')
        ->rightJoin('projects', 'projects.id', '=', 'map_config.project_id')
        ->select("projects.id as id","projects.name as name",
                DB::raw('sum(CASE WHEN state >-1 THEN 1 ELSE 0 END) as total'),
                DB::raw('sum(state = 0) as nonsell'),
                DB::raw('sum(state > 2) as done1'),
                DB::raw('sum(state = 2) as nondone1'),
                DB::raw('sum(acreage) as acreage'),
                DB::raw('sum(real_price*acreage) as real_price'),
                DB::raw('sum(final_price) as final_price'),
                DB::raw('sum(done) as done'),
                DB::raw('sum(dept) as dept')
        )
        ->groupBy('projects.id')
        // ->where('zone.bid', 'NOT LIKE', '%N%')
        ->get();

         $acreage =  DB::table('zone')
        ->rightJoin('map_config', 'zone.name', '=', 'map_config.name')
        ->rightJoin('projects', 'projects.id', '=', 'map_config.project_id')
        ->select("projects.id as id","projects.name as name",
                DB::raw('sum(CASE WHEN state >0 THEN acreage ELSE 0 END) as nonsell'),
                DB::raw('sum(CASE WHEN state >2 THEN acreage ELSE 0 END) as done1'),
                DB::raw('sum(CASE WHEN state =2 THEN acreage ELSE 0 END) as nondone1'),
                DB::raw('sum(acreage) as total'),
                DB::raw('sum(real_price*acreage) as real_price'),
                DB::raw('sum(final_price) as final_price'),
                DB::raw('sum(done) as done'),
                DB::raw('sum(dept) as dept')
        )
     ->groupBy('projects.id')
        // ->where('zone.bid', 'NOT LIKE', '%N%')
        ->get();



            return view('map.admin_statistic', compact('staffs',"acreage","zone"));
        
    }

    public function getViewById($id){

      if(!$this->checkLead()){
        return redirect("/");
      }
            // dd(Auth::user()->role_id);
            $staffs = Staff::get();
      
        $zone =  DB::table('zone')
        ->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
        ->select('zone.bid',
                DB::raw('count(*) as total'),
                DB::raw('sum(state = 0) as nonsell'),
                DB::raw('sum(state > 2) as done1'),
                DB::raw('sum(state = 2) as nondone1'),
                DB::raw('sum(acreage) as acreage'),
                DB::raw('sum(real_price*acreage) as real_price'),
                DB::raw('sum(final_price) as final_price'),
                DB::raw('sum(done) as done'),
                DB::raw('sum(dept) as dept')
        )
        ->groupBy('zone.bid')
        ->where("map_config.project_id",$id)
        ->where('zone.bid', 'NOT LIKE', '%N%')
        ->get();


         $zone_total =  DB::table('zone')
        ->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
        ->select(
                DB::raw('count(*) as total'),
                DB::raw('sum(state = 0) as nonsell'),
                DB::raw('sum(state > 2) as done1'),
                DB::raw('sum(state = 2) as nondone1'),
                DB::raw('sum(acreage) as acreage'),
                DB::raw('sum(real_price*acreage) as real_price'),
                DB::raw('sum(final_price) as final_price'),
                DB::raw('sum(done) as done'),
                DB::raw('sum(dept) as dept')
        )
        ->groupBy('zone.position')
        ->where("map_config.project_id",$id)
        ->where('zone.bid', 'NOT LIKE', '%N%')->first();



 $acreage =  DB::table('zone')
        ->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
        ->select('zone.bid',
                DB::raw('count(*) as total2'),
                DB::raw('sum(CASE WHEN state >0 THEN acreage ELSE 0 END) as nonsell'),
                DB::raw('sum(CASE WHEN state >2 THEN acreage ELSE 0 END) as done1'),
                DB::raw('sum(CASE WHEN state =2 THEN acreage ELSE 0 END) as nondone1'),
                DB::raw('sum(acreage) as total'),
                DB::raw('sum(real_price*acreage) as real_price'),
                DB::raw('sum(final_price) as final_price'),
                DB::raw('sum(done) as done'),
                DB::raw('sum(dept) as dept')
        )
        ->groupBy('zone.bid')
        ->where("map_config.project_id",$id)
        ->where('zone.bid', 'NOT LIKE', '%N%')
        ->get();


         $acreage_total =  DB::table('zone')
        ->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
        ->select(
                DB::raw('count(*) as total2'),
                DB::raw('sum(CASE WHEN state >0 THEN acreage ELSE 0 END) as nonsell'),
                DB::raw('sum(CASE WHEN state >2 THEN acreage ELSE 0 END) as done1'),
                DB::raw('sum(CASE WHEN state =2 THEN acreage ELSE 0 END) as nondone1'),
                DB::raw('sum(acreage) as total'),
                DB::raw('sum(real_price*acreage) as real_price'),
                DB::raw('sum(final_price) as final_price'),
                DB::raw('sum(done) as done'),
                DB::raw('sum(dept) as dept')
        )
        ->groupBy('zone.position')
        ->where("map_config.project_id",$id)
        ->where('zone.bid', 'NOT LIKE', '%N%')->first();



        return view('map.admin_statistic_detail', compact('id','zone','zone_total','acreage_total','acreage'));



        
    }

    public function auditChart(){
            // dd(Auth::user()->role_id);

        $zone =  DB::table('zone')
        ->rightJoin('map_config', 'zone.name', '=', 'map_config.name')
        ->rightJoin('projects', 'projects.id', '=', 'map_config.project_id')
        ->select('zone.bid',
                DB::raw('count(*) as count'),
                DB::raw('zone.bid as name'),
                DB::raw('sum(CASE WHEN acreage >0 THEN acreage ELSE 0 END) as acreage'),
                DB::raw('sum(CASE WHEN done >0 THEN done ELSE 0 END) as done'),
                DB::raw('sum(CASE WHEN dept >0 THEN dept ELSE 0 END) as dept'),
        )
        ->groupBy('projects.id')
        ->get();

        $zone_total =  DB::table('zone')->select('zone.bid',
        DB::raw('count(*) as count'),
        DB::raw('sum(CASE WHEN acreage is  not null THEN acreage ELSE 0 END) as acreage'),
        )->get();

        print_r(json_encode([$zone,$zone_total]));
        // print_r(json_encode($zone));
        
    }

    public function auditChartById(){
            // dd(Auth::user()->role_id);

        $zone =  DB::table('zone')
        ->rightJoin('map_config', 'zone.name', '=', 'map_config.name')
        ->rightJoin('projects', 'projects.id', '=', 'map_config.project_id')
        ->select('zone.bid',
                DB::raw('count(*) as count'),
                DB::raw('zone.bid as name'),
                DB::raw('sum(CASE WHEN acreage >0 THEN acreage ELSE 0 END) as acreage'),
                DB::raw('sum(CASE WHEN done >0 THEN done ELSE 0 END) as done'),
                DB::raw('sum(CASE WHEN dept >0 THEN dept ELSE 0 END) as dept'),
        )
        ->groupBy('zone.bid')
        ->where('zone.bid', 'NOT LIKE', '%N%')
        ->get();

        $zone_total =  DB::table('zone')->select('zone.bid',
        DB::raw('count(*) as count'),
        DB::raw('sum(CASE WHEN acreage is  not null THEN acreage ELSE 0 END) as acreage'),
        )->get();

        print_r(json_encode([$zone,$zone_total]));
        // print_r(json_encode($zone));
        
    }


    public function auditBar(){
            // dd(Auth::user()->role_id);
            return '{"key": ["Tháng 1", "Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10","Tháng 11","Tháng 12"], "value": [18, 23, 23, 19, 33, 52, 26, 18, 34,63,45,64]}';
        
    }

	public function addNewConsumer(Request $req){
            $new_consumer = new Consumer();
            $new_consumer->name = $req->name;
            $new_consumer->phone_number = $req->phone_number;
            $new_consumer->identify_card = $req->identify;
            $new_consumer->save();
            return Redirect()->route('consumer-list')->with('notification',' A Credential has been added.');
	}


	public function CredentialConsumer($Credential_id){
        $Credential = Credential::where('id',$Credential_id)->first();
        $Credential_profiles = CredentialProfile::where('Credential_id',$Credential_id)->distinct()->get(['profile_id','Credential_id','profile_name']);
        $profile_current = CredentialProfile::where([['Credential_id',$Credential_id],['profile_id',$Credential->profile_id]])->get();
        return view('device.Credential_information',compact('Credential','Credential_profiles','profile_current'));
	}

    public function editConsumer(Request $req, $Credential_id){
        Consumer::where('id', $Credential_id)->update([
            'name' => $req->Credential_name,
            'phone_number' => $req->phone_number,
            'identify_card' => $req->identify
        ]);
        return Redirect()->back()->with('notification', 'Update successfully');
    }

    public function deleteConsumer(Request $req){
        // print($req);
        $data = $req->post();
        $flag = 0;
        foreach ($data as $key => $value){
            if(is_int($key)){
                // print($key);
                try{
                  
                    Consumer::where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->route('consumer-list')->with('notification',' All Credential has been deleted.');
        }else{
                return Redirect()->back()->with('warning', 'There are some error when try to delete credentials');

        }
       
        

    }
}