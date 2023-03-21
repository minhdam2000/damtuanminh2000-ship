<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\User;
use DB;
use App\Project;
use App\Area;
use App\Zone;
use App\Historyzone;

use App\Consumer;
use App\Consumer2;
use App\Accountant;
use App\Staff;
use App\Department;
use App\Event;

use App\Role;



use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;


use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\SimpleType\TblWidth;

use Image;
use OneSignal;
use Mail;

class AreaController extends Controller
{	
	function convert_number_to_words($number) {
 
		$hyphen      = ' ';
		$conjunction = ' ';
		$separator   = ' ';
		$negative    = 'âm ';
		$decimal     = ' phẩy ';
		$one     = 'mốt';
		$ten         = 'lẻ';
		$dictionary  = array(
		0                   => 'Không',
		1                   => 'Một',
		2                   => 'Hai',
		3                   => 'Ba',
		4                   => 'Bốn',
		5                   => 'Năm',
		6                   => 'Sáu',
		7                   => 'Bảy',
		8                   => 'Tám',
		9                   => 'Chín',
		10                  => 'Mười',
		11                  => 'Mười một',
		12                  => 'Mười hai',
		13                  => 'Mười ba',
		14                  => 'Mười bốn',
		15                  => 'Mười lăm',
		16                  => 'Mười sáu',
		17                  => 'Mười bảy',
		18                  => 'Mười tám',
		19                  => 'Mười chín',
		20                  => 'Hai mươi',
		30                  => 'Ba mươi',
		40                  => 'Bốn mươi',
		50                  => 'Năm mươi',
		60                  => 'Sáu mươi',
		70                  => 'Bảy mươi',
		80                  => 'Tám mươi',
		90                  => 'Chín mươi',
		100                 => 'trăm',
		1000                => 'ngàn',
		1000000             => 'triệu',
		1000000000          => 'tỷ',
		1000000000000       => 'nghìn tỷ',
		1000000000000000    => 'ngàn triệu triệu',
		1000000000000000000 => 'tỷ tỷ'
		);
		 
		if (!is_numeric($number)) {
			return false;
		}
		 
		// if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
		//  // overflow
		//  trigger_error(
		//  'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
		//  E_USER_WARNING
		//  );
		//  return false;
		// }
		 
		if ($number < 0) {
			return $negative . $this->convert_number_to_words(abs($number));
		}
		 
		$string = $fraction = null;
		 
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
		 
		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
			break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= strtolower( $hyphen . ($units==1?$one:$dictionary[$units]) );
				}
			break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= strtolower( $conjunction . ($remainder<10?$ten.$hyphen:null) . $this->convert_number_to_words($remainder) );
				}
			break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number - ($numBaseUnits*$baseUnit);
				$string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= strtolower( $remainder < 100 ? $conjunction : $separator );
					$string .= strtolower( $this->convert_number_to_words($remainder) );
				}
			break;
		}
		 
		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}
		 
		return $string;
	}
	
 	public function cProject(){
// dd(Auth()->user()->id);
		$cid = DB::table("consumer")->where("user_id",Auth()->user()->id)->first()->id;
      $pid = DB::table("zone")
		->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
		->where("consumer_id",$cid)
		->select("map_config.project_id")->distinct()->pluck('project_id')->toArray();

		$projects = Project::whereIn("id",$pid)->get();
		return view('map.cproject', compact('projects'));
	}


	 public function projectList(){

		if(!$this->checkMap()){
			return redirect("/");
		}
		$projects = Project::get();
		return view('map.project_list', compact('projects'));
	}

	 public function projectConList(){

		if(!$this->checkAdmin() && !!$this->checkContributeMap()){
			return redirect("/");
		}
		$projects = Project::get();
		return view('map.project_con_list', compact('projects'));
	}

	 public function projectDrawList(){

		if(!$this->checkAdmin() && Auth()->user()->role_id != 14 ){
			return redirect("/");
		}
		$projects = Project::get();
		return view('map.project_draw_list', compact('projects'));
	}

 	public function projectAdminList(){

		if(!$this->checkMap()){
			return redirect("/");
		}
		$projects = Project::get();
		return view('map.project_admin_list', compact('projects'));
	}
	

 	public function projectAdd(Request $req){

		if(!$this->checkAdmin()){
			return redirect("/");
		}
		if($req->id == 0){
			Project::insert(["name"=>$req->name,"city"=>$req->city,"display"=>$req->display]);
		}else{
			// dd($req->city);
			Project::where("id",$req->id)
			->update(["name"=>$req->name,"city"=>$req->city,"display"=>$req->display]);
		}
		return redirect()->back();
	}


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
					'filters' => array(array("field" => "tag", "key" => "role", "relation" => "=", "value" => $role_id)),
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

 function editFileNames(Request $request){

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


     DB::table('zone_files')
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


    DB::table('zone_files')
              ->where('id', $request->id)
              ->update(['name' => $request->title,'url' => $url]);

    }

 DB::table('zone_files_tags')
->where('file_id',$request->id)->delete();


              foreach ($tagArr as $tag) {
         # code...
       DB::table("zone_files_tags")->insert([
            'file_id' => $request->id,
            'tag_id' => $tag

        ]);
       }


 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

}

 public function mergeSelectPdfs($id){
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
       $files = DB::table("zone_files")
    ->leftJoin('zone_files_tags', 'zone_files.id', '=', 'zone_files_tags.file_id')
    ->leftJoin('tags', 'zone_files_tags.tag_id', '=', 'tags.id')
    ->select("zone_files.name as name","zone_files.created_at as created_at"
        ,"zone_files.id as id","zone_files.url as url"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
)
    ->where('zone_id', $id)
    ->where('zone_files.name',"like", "%".$_COOKIE['cv_temp']."%")
    ->orWhere('tags.name',"like", "%".$_COOKIE['cv_temp']."%")
    ->orderBy('zone_files.name', 'desc')
    ->groupBy('zone_files.id')

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

 public function mergeAllPdfs($id){
     if(!$this->checkLead()){
        return redirect("/");
      }
    ini_set('memory_limit', '2048M');
        $path = "/var/www/html/ship/";

    // $process_name = DB::table("process")->where("id",$id)->first()->name;
    // dd($process_name);
       $files = DB::table("zone_files")
                ->where('zone_id', $id)
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
         	dd($e);
        return redirect()->back()->with('warning',' Đã có lỗi tệp tin, vui lòng liên hệ admin');

        }
        return Redirect("/");
}

  function editFiles(Request $request){

         if(!$this->checkHuman()){
        return redirect("/");
      }


   $tagArr = [];

    $tags = explode(",", $request->tags);
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
  
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      if($request->title == null){
        $title = $file->getClientOriginalName();
      }
      if(strlen($file_name) < 2){
    return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

      }
      // dd($title);
      $path = $file->store('system');

      $url = Storage::url($path);

      $i = $i +1;

      $file_id =  DB::table("zone_files")->insertGetId([
            'zone_id' => $request->id,
            'url' => $url,
            'name'=>$title,
            'type'=>$request->type
        ]);


        DB::table('zone_files_tags')
              ->where('file_id', $file_id)->delete();


              foreach ($tagArr as $tag) {
         # code...
       DB::table("zone_files_tags")->insert([
            'file_id' => $file_id,
            'tag_id' => $tag

        ]);
       }

     



        // print_r($return);
         $zone = $this->getLead();
       // print_r($lead)

              foreach ($zone as $zones) {
                DB::table('zone_file_noti')->insert([
                'event_id' => $file_id,
                'user_id' => $zones
            ]);
            }
       // $lead = $this->getLead();
       // print_r($lead)

            //   foreach ($lead as $lid) {
            //     DB::table('file_noti')->insert([
            //     'event_id' => $file_id,
            //     'user_id' => $lid
            // ]);
            // }
      }


//         }
// catch (\Exception $e) { 
//     return Redirect()->back()->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');;
//                }

 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

}

function DeleteZoneFile($id){
    DB::table("zone_files")->where("id",$id)->delete();
     return Redirect()->back()->with('warning',' Đã xóa tệp tin thành công !');
}

	public function depositUpdate($id){

		if(!$this->checkSaleMap()){
			return redirect("/");
		}
		 DB::table("deposit")->where("id",$id)
		->update([
			"book"=>$req->book
		]);

		return redirect()->back()->with("notification","Đã cập nhật book");


	}

	 public function depositRemove($id){

		if(!$this->checkSaleMap()){
			return redirect("/");
		}

		DB::table("deposit")->where("id",$id)
		->update([
			'status'=>-1,
			"content"=>$req->content
		]);

		return redirect("/deposit-list")->with("notification","Đã hủy cọc");

	}


	public function depositDetail($id){

		if(!$this->checkSaleMap()){
			return redirect("/");
		}
		$deposit = DB::table("deposit")->where("id",$id)->first();

		$zone = DB::table('zone')
		->where('id',$deposit->zone_id)->first();


		$consumer = Consumer::where('id',$deposit->consumer_id)->first();

		return view('deposit.view', compact('consumer','deposit','zone'));

	}

	public function zone_warehouse($id){
    $type = 0;
    $delete_route = "file-delete";

    $zones = DB::table("zone")
    ->where("id",$id)->first();

    $cv = DB::table("zone_files")->where("zone_id",$id)
    ->leftJoin('zone_files_tags', 'zone_files.id', '=', 'zone_files_tags.file_id')
    ->leftJoin('tags', 'zone_files_tags.tag_id', '=', 'tags.id')
    ->select("zone_files.name as name","zone_files.created_at as created_at"
        ,"zone_files.id as id","zone_files.url as url"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
)
    ->groupBy('zone_files.id')
    ->where("zone_files.type",$type)->get();



    $tag_groups = DB::table("tag_group")->get();
     $tag_groups_arr = [];
    foreach($tag_groups as $tag){
        $tagArr = explode(",", $tag->tag);
        // dd(DB::table("tags")->select("name")->whereIn("id",$tagArr)->get()->toArray());
        $data = implode(";",DB::table("tags")->select("name")->whereIn("id",$tagArr)->pluck("name")->toArray());
        $tag->str = $data;
        $tag_groups_arr[$tag->id]=$data;
    }


    return view('map.zone_warehouse',compact("id","delete_route",'zones','cv',"tag_groups_arr","type"));

  }

	public function depositList(){
		if(!$this->checkMap()){
			return redirect("/");
		}
		
		$deposit = DB::table("deposit")->where("status",0)
		->leftJoin('zone', 'deposit.zone_id', '=', 'zone.id')
		->leftJoin('consumer', 'deposit.consumer_id', '=', 'consumer.id')
		->select("deposit.id as id", "zone.name as name","consumer.name as cname"
			,"consumer.phone_number as phone")
		->get();

		$deposit_complete = DB::table("deposit")->where("status",1)
		->leftJoin('zone', 'deposit.zone_id', '=', 'zone.id')
		->leftJoin('consumer', 'deposit.consumer_id', '=', 'consumer.id')
		->select("deposit.id as id", "zone.name as name","consumer.name as cname"
			,"consumer.phone_number as phone")
		->get();
		$deposit_close = DB::table("deposit")->where("status",-1)
		->leftJoin('zone', 'deposit.zone_id', '=', 'zone.id')
		->leftJoin('consumer', 'deposit.consumer_id', '=', 'consumer.id')
		->select("deposit.id as id", "zone.name as name","consumer.name as cname"
			,"consumer.phone_number as phone")
		->get();
		return view('deposit.index', compact('deposit', "deposit_complete","deposit_close"));

	}

 public function minimapList($id){
    $project = Project::where("id", $id)->first();
    $areas = Area::where("project_id", $id)->get();

    $zone_display = DB::table('zone')
		->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
		->leftJoin('users', 'zone.staff_id', '=', 'users.id')
		->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
		->leftJoin('accountant', 'zone.accountant_id', '=', 'accountant.id')
		->select("zone.id as id",'zone.name as name','map_config.zone as zone', 'zone.state as state',"zone.area_id as aid","zone.image_name as image_name",
			"zone.unit_price as unit_price","zone.final_price as final_price","zone.real_price as real_price","zone.lock as lock","zone.lock_user as lock_user",DB::raw("TIMESTAMPDIFF(MINUTE,zone.lock_time,NOW()) as lock_time"),
			"zone.view as view","zone.position as position",
			"zone.done as done","zone.dept as dept","zone.acreage as acreage"
			,'zone.deposit_date','zone.complete_date', 'consumer.id as customer_id',
			"consumer.phone_number as consumer_phone_number",'consumer.identify_card as consumer_identify_card',
			'users.id as staff_id',"users.phone as staff_phone_number",'users.identify as staff_identify_card',
			'accountant.id as accountant_id',"accountant.phone_number as accountant_phone_number",'accountant.name as accountant_name','users.name as staff_name','consumer.name as consumer_name')
		->where("map_config.zone","<>",null)
		->where("map_config.project_id",$id)
		->get();


    $zone =  DB::table('zone')
		->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
		->select('zone.bid',
				DB::raw('count(zone.id) as total'),
				DB::raw('sum(zone.state = 0) as nonsell'),
				DB::raw('sum(zone.state > 2) as done1'),
				DB::raw('sum(zone.state = 2) as nondone1'),
				DB::raw('sum(zone.acreage) as acreage'),
				DB::raw('sum(zone.real_price*acreage) as real_price'),
				DB::raw('sum(zone.final_price) as final_price'),
				DB::raw('sum(zone.done) as done'),
				DB::raw('sum(zone.dept) as dept')
		)
		->groupBy('zone.bid')
		->where('zone.bid', 'NOT LIKE', '%N%')
		->where("map_config.project_id",$id)
		->get();


		 $zone_total =  DB::table('zone')
		->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
		->select(
				DB::raw('count(zone.id) as total'),
				DB::raw('sum(zone.state = 0) as nonsell'),
				DB::raw('sum(zone.state > 2) as done1'),
				DB::raw('sum(zone.state = 2) as nondone1'),
				DB::raw('sum(zone.acreage) as acreage'),
				DB::raw('sum(zone.real_price*acreage) as real_price'),
				DB::raw('sum(zone.final_price) as final_price'),
				DB::raw('sum(zone.done) as done'),
				DB::raw('sum(zone.dept) as dept')
		)
		->where("map_config.project_id",$id)
		->where('zone.bid', 'NOT LIKE', '%N%')->first();


 $acreage =  DB::table('zone')
		->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
		->select('zone.bid',
				DB::raw('count(*) as total2'),
				DB::raw('sum(CASE WHEN state = 0 THEN acreage ELSE 0 END) as nonsell'),
				DB::raw('sum(CASE WHEN state > 2 THEN acreage ELSE 0 END) as done1'),
				DB::raw('sum(CASE WHEN state = 2 THEN acreage ELSE 0 END) as nondone1'),
				DB::raw('sum(acreage) as total'),
				DB::raw('sum(real_price*acreage) as real_price'),
				DB::raw('sum(final_price) as final_price'),
				DB::raw('sum(done) as done'),
				DB::raw('sum(dept) as dept')
		)
		->groupBy('zone.bid')
		->where("map_config.project_id",$id)
		->where('zone.bid', 'NOT LIKE', '%N%')
		->where('zone.acreage', ">",0)
		->get();


		 $acreage_total =  DB::table('zone')
		->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
		->select(
				DB::raw('count(*) as total2'),
				DB::raw('sum(CASE WHEN state = 0 THEN acreage ELSE 0 END) as nonsell'),
				DB::raw('sum(CASE WHEN state > 2 THEN acreage ELSE 0 END) as done1'),
				DB::raw('sum(CASE WHEN state = 2 THEN acreage ELSE 0 END) as nondone1'),
				DB::raw('sum(acreage) as total'),
				DB::raw('sum(real_price*acreage) as real_price'),
				DB::raw('sum(final_price) as final_price'),
				DB::raw('sum(done) as done'),
				DB::raw('sum(dept) as dept')
		)
		->where("map_config.project_id",$id)
		->where('zone.bid', 'NOT LIKE', '%N%')
		->where('zone.acreage', ">",0)->first();

    // dd($areas);
    return view('map.minimap', compact('areas','project'
    	,'zone','zone_total','acreage',"acreage_total","zone_display"));
  }
public function minimapFixList($id){
    $project = Project::where("id", $id)->first();
    $areas = Area::where("project_id", $id)->get();
    // dd($areas);
    return view('map.minimapfix', compact('areas','project'));
  }

	public function areaList($id){
		if(!$this->checkMap()){
			return redirect("/");
		}
		

		$project = Project::where("id", $id)->first();
		$areas = Area::where("project_id", $id)->get();

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

		$did = Role::where("id", Auth()->user()->role_id)->first()->department_id;


 $acreage =  DB::table('zone')
		->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
		->select('zone.bid',
				DB::raw('count(*) as total2'),
				DB::raw('sum(CASE WHEN state = 0 THEN acreage ELSE 0 END) as nonsell'),
				DB::raw('sum(CASE WHEN state > 2 THEN acreage ELSE 0 END)) as done1'),
				DB::raw('sum(CASE WHEN state = 2 THEN acreage ELSE 0 END)) as nondone1'),
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
				DB::raw('sum(CASE WHEN state = 0 THEN acreage ELSE 0 END) as nonsell'),
				DB::raw('sum(CASE WHEN state > 2 THEN acreage ELSE 0 END)) as done1'),
				DB::raw('sum(CASE WHEN state = 2 THEN acreage ELSE 0 END)) as nondone1'),
				DB::raw('sum(acreage) as total'),
				DB::raw('sum(real_price*acreage) as real_price'),
				DB::raw('sum(final_price) as final_price'),
				DB::raw('sum(done) as done'),
				DB::raw('sum(dept) as dept')
		)
		->groupBy('zone.position')
		->where("map_config.project_id",$id)
		->where('zone.bid', 'NOT LIKE', '%N%')->first();

		$did = Role::where("id", Auth()->user()->role_id)->first()->department_id;


		return view('map.area_list', compact('areas','project','zone','did','zone_total','acreage_total','acreage',"id"));


	}
	public function areaFullConList($id){
		if(!$this->checkContributeMap()){
			return redirect("/");
		}
		

		$project = Project::where("id", $id)->first();
		$areas = Area::where("project_id", $id)->get();

		return view('map.area_all_contribute_information', compact('areas','project'));


	}
	public function publicMap($id){

		$project = Project::where("id", $id)->first();
		$areas = Area::where("project_id", $id)->get();
		
		$did = 0;
		$colors = DB::table("new_color")->first();




		return view('map.public-map', compact('areas','project',"colors","did"));
      

	}


	public function publicMapShare($id,$zid){
		$project = Project::where("id", $id)->first();
		$areas = Area::where("project_id", $id)->get();
		return view('map.public-map-share', compact('areas','project','zid'));
      

	}

	public function cMap($id){

		$project = Project::where("id", $id)->first();
		$areas = Area::where("project_id", $id)->get();
		$cid = DB::table("consumer")->where("user_id",Auth()->user()->id)->first()->id;


		return view('map.cmap', compact('areas','project',"cid"));
      



	}



	public function areaFullList($id){
		if(!$this->checkMap()){
			return redirect("/");
		}
		

    $isLead = $this->checkLead();
		$project = Project::where("id", $id)->first();
		$areas = Area::where("project_id", $id)->get();

		
		$did = 0;
		$colors = DB::table("new_color")->first();


		return view('map.area_full_list', compact('areas','project','did',"id","colors","isLead"));



	}

	public function getAllZone(){
		if(!$this->checkMap()){
			return redirect("/");
		}

		$zone = DB::table('zone')
		->leftJoin('users', 'zone.staff_id', '=', 'users.id')
		->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
		->leftJoin('accountant', 'zone.accountant_id', '=', 'accountant.id')
		->select("zone.id as id",'zone.name as name','zone.zone as zone', 'zone.state as state',"zone.area_id as aid","zone.image_name as image_name",
			"zone.unit_price as unit_price","zone.final_price as final_price","zone.real_price as real_price",
			"zone.done as done","zone.dept as dept","zone.acreage as acreage"
			,'zone.deposit_date','zone.complete_date', 'consumer.id as customer_id',
			"consumer.phone_number as consumer_phone_number",'consumer.identify_card as consumer_identify_card',
			'users.id as staff_id',"users.phone_number as staff_phone_number",'users.identify_card as staff_identify_card',
			'accountant.id as accountant_id',"accountant.phone_number as accountant_phone_number",'accountant.name as accountant_name','users.name as staff_name','consumer.name as consumer_name')->get();
		return json_encode($zone);

		
	}

	public function getAllPublic($id){

		$zone = DB::table('zone')
		->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
		->leftJoin('users', 'zone.staff_id', '=', 'users.id')
		->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
		->leftJoin('accountant', 'zone.accountant_id', '=', 'accountant.id')
		->select("zone.id as id",'zone.name as name','map_config.zone as zone', 'zone.state as state',"zone.area_id as aid","zone.image_name as image_name",
			"zone.unit_price as unit_price","zone.final_price as final_price","zone.real_price as real_price","zone.lock as lock","zone.lock_user as lock_user",DB::raw("TIMESTAMPDIFF(MINUTE,zone.lock_time,NOW()) as lock_time"),
			"zone.view as view","zone.position as position",
			"zone.done as done","zone.dept as dept","zone.acreage as acreage"
			,'zone.deposit_date','zone.complete_date', 'consumer.id as customer_id')
		->where("map_config.zone","<>",null)
		->where("map_config.project_id",$id)
		->get();
		return json_encode($zone);

		
	}


	public function getAllZoneMap($id){
		if(!$this->checkMap()){
			return redirect("/");
		}

		$zone = DB::table('zone')
		->rightJoin('map_config', 'zone.name', '=', 'map_config.name')
		->leftJoin('users', 'zone.staff_id', '=', 'users.id')
		->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
		->leftJoin('accountant', 'zone.accountant_id', '=', 'accountant.id')
		->select("zone.id as id",'zone.name as name','map_config.zone as zone', 'zone.state as state',"zone.area_id as aid","zone.image_name as image_name",
			"zone.unit_price as unit_price","zone.final_price as final_price","zone.real_price as real_price","zone.lock as lock","zone.lock_user as lock_user",DB::raw("TIMESTAMPDIFF(MINUTE,zone.lock_time,NOW()) as lock_time"),
			"zone.view as view","zone.position as position",
			"zone.done as done","zone.dept as dept","zone.acreage as acreage"
			,'zone.deposit_date','zone.complete_date', 'consumer.id as customer_id',
			"consumer.phone_number as consumer_phone_number",'consumer.identify_card as consumer_identify_card',
			'users.id as staff_id',"users.phone as staff_phone_number",'users.identify as staff_identify_card',
			'accountant.id as accountant_id',"accountant.phone_number as accountant_phone_number",'accountant.name as accountant_name','users.name as staff_name','consumer.name as consumer_name')
		->where("map_config.zone","<>",null)
		->where("zone.project_id",$id)
		->where("map_config.project_id",$id)
		->get();
		// dd("oke");
		return json_encode($zone);

		
	}
	public function areaConfig($id){
		// dd(Auth()->user()->role_id);
		if(!$this->checkAdmin() && Auth()->user()->role_id != 14){
			return redirect("/");
		}

		// $files = DB::table("contribute_file")->get();
		// foreach ($files as $file) {	
  //      DB::table("contribute_file_tags")->insert([
  //           'file_id' => $file->id,
  //           'tag_id' => 14

  //       ]);
		// 	if($file->projects_id = 1){

				
  //      DB::table("contribute_file_tags")->insert([
  //           'file_id' => $file->id,
  //           'tag_id' => 11

  //       ]);
		// 	}elseif($file->projects_id = 1){
	
  //      DB::table("contribute_file_tags")->insert([
  //           'file_id' => $file->id,
  //           'tag_id' => 11

  //       ]);

  //      DB::table("contribute_file_tags")->insert([
  //           'file_id' => $file->id,
  //           'tag_id' => 25

  //       ]);
		// 	}else{
	
  //      DB::table("contribute_file_tags")->insert([
  //           'file_id' => $file->id,
  //           'tag_id' => 24

  //       ]);
		// 	}
		// 	#
		// }
		$consumers = Consumer::get();
		
		$area = Area::where("id", 9)->first();

		$project = Project::where("id",$id)->first();
		return view('map.area_config', compact('project','consumers','area',"id"));
	
	}
public function areaFix($id){
		if(!$this->checkAdmin() && Auth()->user()->role_id != 14){
			return redirect("/");
		}

		$consumers = Consumer::get();
		$area = Area::where("id", $id)->first();

		
		return view('map.area_fix', compact('consumers','area'));
	}

	public function areaInformation($id){
		if(!$this->checkSaleMap()){
			return redirect("/");
		}
						$consumers = Consumer::get();
		$area = Area::where("id", $id)->first();

		$zone =  DB::table('zone')
		->select('zone.bid',
				DB::raw('count(zone.id) as total'),
				DB::raw('sum(zone.state = 0) as nonsell'),
				DB::raw('sum(zone.state > 2) as done1'),
				DB::raw('sum(zone.state = 2) as nondone1'),
				DB::raw('sum(zone.acreage) as acreage'),
				DB::raw('sum(zone.real_price*acreage) as real_price'),
				DB::raw('sum(zone.final_price) as final_price'),
				DB::raw('sum(zone.done) as done'),
				DB::raw('sum(zone.dept) as dept')
		)
		->groupBy('zone.project_id','zone.bid')
		->where('zone.bid', 'NOT LIKE', '%N%')
		->where('zone.name', 'NOT LIKE', 'N%')
		->where("zone.project_id",$area->project_id)
		->get();


		 $zone_total =  DB::table('zone')
		->select(
				DB::raw('count(zone.id) as total'),
				DB::raw('sum(zone.state = 0) as nonsell'),
				DB::raw('sum(zone.state > 2) as done1'),
				DB::raw('sum(zone.state = 2) as nondone1'),
				DB::raw('sum(zone.acreage) as acreage'),
				DB::raw('sum(zone.real_price*acreage) as real_price'),
				DB::raw('sum(zone.final_price) as final_price'),
				DB::raw('sum(zone.done) as done'),
				DB::raw('sum(zone.dept) as dept')
		)
		->groupBy('zone.project_id','zone.bid')
		->where('zone.bid', 'NOT LIKE', '%N%')
		->where('zone.name', 'NOT LIKE', 'N%')
		->where("zone.project_id",$area->project_id)
		->first();

 $acreage =  DB::table('zone')
		->select('zone.bid',
				DB::raw('count(*) as total2'),
				DB::raw('sum(CASE WHEN state = 0 THEN acreage ELSE 0 END) as nonsell'),
				DB::raw('sum(CASE WHEN state > 2 THEN acreage ELSE 0 END) as done1'),
				DB::raw('sum(CASE WHEN state = 2 THEN acreage ELSE 0 END) as nondone1'),
				DB::raw('sum(acreage) as total'),
				DB::raw('sum(real_price*acreage) as real_price'),
				DB::raw('sum(final_price) as final_price'),
				DB::raw('sum(done) as done'),
				DB::raw('sum(dept) as dept')
		)
		
		->groupBy('zone.project_id','zone.bid')
		->where('zone.bid', 'NOT LIKE', '%N%')
		->where('zone.name', 'NOT LIKE', 'N%')
		->where("zone.project_id",$area->project_id)
		->get();


		 $acreage_total =  DB::table('zone')
		->select(
				DB::raw('count(*) as total2'),
				DB::raw('sum(CASE WHEN state = 0 THEN acreage ELSE 0 END) as nonsell'),
				DB::raw('sum(CASE WHEN state > 2 THEN acreage ELSE 0 END) as done1'),
				DB::raw('sum(CASE WHEN state = 2 THEN acreage ELSE 0 END) as nondone1'),
				DB::raw('sum(acreage) as total'),
				DB::raw('sum(real_price*acreage) as real_price'),
				DB::raw('sum(final_price) as final_price'),
				DB::raw('sum(done) as done'),
				DB::raw('sum(dept) as dept')
		)
		->where("zone.id",$area->project_id)
		->where('zone.bid', 'NOT LIKE', '%N%')
		->where('zone.name', 'NOT LIKE', 'N%')
		->where('zone.acreage', ">",0)->first();

		return view('map.area_information', compact('consumers','area',
			"zone","zone_total","acreage","acreage_total"));
	}
 public function TransUpdate(Request $req){
		if(!$this->checkSaleMap()){
			return redirect("/");
		}

		 if(!$this->checkLead()){
			return redirect("/");
		}

		// dd($req->zone_id);
		DB::table("zone")->where("id",$req->zone_id)->update([
			'vat'=> $req->vat,
			'real_price'=> $req->real_price
		]);

return redirect()->back()->with("notification","Đã cập nhật thành công");
	}


	public function addDeposit(Request $req){
		if(!$this->checkSaleMap()){
			return redirect("/");
		}
if($req->file == null ) {
	return Redirect()->back()->with('warning',' Thiếu minh chứng ');
		 
 // dd($req->trans_type);
}
if(strlen($req->cname1) > 200){
						return Redirect()->back()->with('warning',' Tên khách hàng quá dài ');
					}

					if(strlen($req->cphone1) > 15){
						return Redirect()->back()->with('warning',' Số điện thoại quá dài ');
					}
					if(strlen($req->cidentify1) > 15){
						return Redirect()->back()->with('warning',' Chứng minh thư quá dài ');
					}
			
			
		$path = $req->file->store('contribute');

		$url1 = Storage::url($path);


		 DB::table("consumer_next")->insert([
				'zone_id' => $req->zone_id,
				'name' => $req->cname,
				'phone_number' => $req->cphone,
				"email" => $req->cemail,
				'url' => $url1
		]);

		
		return redirect()->back();
	}

	public function editColor(Request $req){
        if(!$this->checkSaleMap()){
          return redirect("/");
        }
       DB::table("new_color")->where('id', 1)->update([
            'can_da_ban' =>$req->can_da_ban,   
            'can_da_mua'=>$req->can_da_mua,
            'can_chua_thanh_toan'=>$req->can_chua_thanh_toan,
            'can_da_thanh_toan'=>$req->can_da_thanh_toan,
            
        ]);
       
 return redirect()->back()->with('notification',' Đã Sửa tệp tin thành công !1');
 
}

 public function areaDeposit($id){
		if(!$this->checkSaleMap()){
			return redirect("/");
		}

		$zone = DB::table('zone')
		->where([['zone.id',$id]])->first();

		if($zone->lock > 0){
			$check_user =  $zone = DB::table('zone')
		->where([['zone.lock_user',Auth()->user()->id]])
		 ->where([['zone.id',$id]])->where('lock',1)
		->count();

			if($check_user <1){
			return redirect()->back()->with('warning',' Khu vực đã đang được khóa bởi người khác');
			}
		}


		$zone = DB::table('zone')
		->where([['zone.id',$id]])->first();

		if($zone->state > 0){
			return redirect()->back()->with('warning',' Khu vực đã được đặt trước ');
		}

		$cts = DB::table("consumer_next")->where("zone_id",$id)->get();
		$consumers = Consumer::get();
		$area = Area::where("id", $id)->first();

		return view('map.deposit', compact('consumers','zone','id',"cts"));
	}
public function areaTransType($id){
		if(!$this->checkSaleMap()){
			return redirect("/");
		}

		return  $step_id = DB::table("staff_process_step")
		 ->leftJoin('staff_process', 'staff_process_step.process_id', '=', 'staff_process.id')
		->leftJoin('staff_step', 'staff_process_step.step_id', '=', 'staff_step.id')
		->select("staff_step.id as id","staff_step.name as name")
		->where('staff_process_step.case_num',2)
		->where('staff_process.id',$id)->get();

	}
	public function areaTrans($id){

		
		if(!$this->checkSaleMap()){
			return redirect("/");
		}

		$zone = DB::table('zone')
		->where([['zone.id',$id]])->first();

		if($zone->lock > 0){
			$check_user =  $zone = DB::table('zone')
		->where([['zone.lock_user',Auth()->user()->id]])
		 ->where([['zone.id',$id]])->where('lock',1)
		->count();

			if($check_user <1){
			return redirect()->back()->with('warning',' Khu vực đã đang được khóa bởi người khác');
			}
		}


		$zone = DB::table('zone')
		->where([['zone.id',$id]])->first();

		if($zone->state > 0){
			return redirect()->back()->with('warning',' Khu vực đã được đặt trước ');
		}


		$consumers = Consumer::get();
		$area = Area::where("id", $id)->first();

		$staff = User::where("role_id","<", 6)
		->where("role_id",">", 1)->where("status","<>",0)
		->select("id","name","role_id")
		->get();


		$trans_type =DB::table("staff_process")->orderBy('id', 'desc')->get();
		return view('map.trans', compact('staff','trans_type','consumers','zone'));
	}
 public function zoneAdminReset($id){
			// dd("???");
		if(!$this->checkAdmin()){
			return redirect("/");
		}

		if(!$this->checkLead()){
			return redirect("/");
		}

		 DB::table('zone')->where('zone.id',$id)->update([
			'staff_id' => 0,
			'consumer_id' =>0,
			'state' => 0,
			'lock_user' => 0,
			'lock_time' => Carbon::now(),
			'lock' => 0,
			'trans_type' => 0,
			'unit_price' => 0,
			'final_price' => 0,
			'real_price' => 0,
			'price_discount' => 0,
			'vat' => 0,
			'done' => 0,
			'dept' => 0,
			'deposit' => 0,
		]);
		 DB::table("zone_pay")->where("zone_id",$id)->delete();
		 DB::table("zone_process")->where("zone_id",$id)->delete();
		 DB::table("zone_step")->where("zone_id",$id)->delete();
		 DB::table("zone_task")->where("zone_id",$id)->delete();
		 // DB::table("zone_task_url")->where("zone_id",$id)->delete();


		return redirect()->back()->with('notification',' Đã hủy khu vực thành công ');
	}

	 public function zoneReset(Request $req){
			// dd("???");
		if(!$this->checkSaleMap()){
			return redirect("/");
		}

		if(!$this->checkLead()){
			return redirect("/");
		}
DB::table('zone_remove')->insert([
	"zone_id"=>$req->id,
	"consumer_id"=>$req->cid,
	"content"=>$req->content,

]);
$id = $req->id;
// dd($id);
$myzone = DB::table('zone')->where('zone.id',$id)->first();

$zbk_id = DB::table("zone_backup")->insertGetId([

	"zone_id"=>$myzone->id,
	"consumer_id"=>$myzone->consumer_id,
	"name"=>$myzone->name,
	"acreage"=>$myzone->acreage,
	"zone"=>$myzone->zone,
	"state"=>-1,
	"trans_type"=>$myzone->trans_type,
	"final_price"=>$myzone->final_price,
	"unit_price"=>$myzone->unit_price,
	"real_price"=>$myzone->real_price,
	"price_discount"=>$myzone->price_discount,
	"con_discount"=>$myzone->con_discount,
	"vat"=>$myzone->vat,
	"pay_step"=>$myzone->pay_step,
	"done"=>$myzone->done,
	"gap"=>$myzone->gap,
	"dept"=>$myzone->dept,
	"deposit"=>$myzone->deposit,
	"inner_tax"=>$myzone->inner_tax
]);

 DB::table("zone_pay")->where("zone_id",$id)->update(["zone_id"=>$zbk_id*-1 ]);
 DB::table("zone_process")->where("zone_id",$id)->update(["zone_id"=>$zbk_id*-1 ]);
 DB::table("zone_step")->where("zone_id",$id)->update(["zone_id"=>$zbk_id*-1 ]);
 DB::table("zone_task")->where("zone_id",$id)->update(["zone_id"=>$zbk_id*-1 ]);


$zname = $myzone->name;
		 DB::table('zone')->where('zone.id',$id)->update([
			'staff_id' => 0,
			'consumer_id' =>0,
			'state' => 0,
			'lock_user' => 0,
			'lock_time' => Carbon::now(),
			'lock' => 0,
			'trans_type' => 0,
			'unit_price' => 0,
			'final_price' => 0,
			'real_price' => 0,
			'price_discount' => 0,
			'vat' => 0,
			'done' => 0,
			'dept' => 0,
			'deposit' => 0,
		]);

 // $depart = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->department_id;

		$response = $this->sendMessage("Đã hủy hợp đồng: ".$zname,1,0);

		$event  = new Event();



		$event->title = "Hủy hợp đồng";
		$event->type = 1;
		$event->description = "Hủy hợp đồng ".$zname;
		// $data = json_decode($response, true);
		$event->permiss = 0;
		$event->user_id = Auth()->user()->id;

		$event->save();

		 $lead = $this->getLead();

             foreach ($lead as $lid) {
                DB::table('event_noti')->insert([
                'event_id' => $event->id,
                'user_id' => $lid
            ]);
            }


		return redirect('area-full-list/1')->with('notification',' Đã hủy khu vực thành công ');
	}

		public function CompleteZone($id){
			// dd("???");
		if(!$this->checkSaleMap()){
			return redirect("/");
		}

		$zone =  DB::table('zone')->where([['zone.id',$id]])->first();
		 DB::table('zone')->where([['zone.id',$id]])->update([
			'done' => $zone->final_price,
			'dept' =>  0,
			'state' => 3
		]);
		return redirect()->back()->with('notification',' Đã cập nhật khu vực thành công ');
	}

		public function zoneLock($id){
			// dd("???");
		// if(!$this->checkSaleMap()){
		// 	return redirect("/");
		// }

		$check_user =  $zone = DB::table('zone')
		->where([['zone.lock_user',Auth()->user()->id]])
		->where('lock',1)
		->count();

		if ($check_user > 0){
			return redirect()->back()->with('warning',' Chỉ được khóa tối đa 1 lô');
		}
		$zone = DB::table('zone')
		->where([['zone.id',$id]])->first();

		if($zone->lock > 0){
			return redirect()->back()->with('warning',' Khu vực đã đang được khóa bởi người khác');
		}

		 DB::table('zone')->where([['zone.id',$id]])->update([
			'lock_user' => Auth()->user()->id,
			'lock_time' => Carbon::now(),
			'lock' => 1
		]);
		return redirect()->back()->with('notification',' Đã khóa khu vực thành công ');
	}

public function zoneUnlock($id){
			// dd("???");
		// if(!$this->checkSaleMap()){
		// 	return redirect("/");
		// }


		// $check = DB::table('zone')
		// ->where([['zone.lock_user',Auth()->user()->id]])
		// ->where([['zone.id',$id]])->count();

		$check = 1;
		if($check > 0){

		 DB::table('zone')->where([['zone.id',$id]])->update([
			'lock_user' => 0,
			'lock' => 0
		]);
		return redirect()->back()->with('notification',' Đã khóa khu vực thành công ');
		}else{
			return redirect("/");

		}
	}

	public function zoneLockBySid(Request $req){
			// dd("???");
		if(!$this->checkSaleMap()){
			return redirect("/");
		}
		$sid =  array_map('intval',explode(",",$req->sid[0]));
		// dd($sid);

		if($req->type == 2){
		DB::table('zone')->whereIn('zone.id',$sid)->update([
			'lock_user' => Auth()->user()->id,
			'lock_time' => Carbon::now(),
			'lock' => 2
		]);  
		return redirect()->back()->with('notification',' Đã khóa khu vực thành công ');
		}else{
		 DB::table('zone')->whereIn('zone.id',$sid)->update([
					'lock_user' => 0,
					'lock_time' => Carbon::now(),
					'lock' => 0
				]);
			 return redirect()->back()->with('notification',' Đã mở khóa khu vực thành công ');

		}

 
	
	}
	public function editZone(Request $req){
			// dd("???");
		if(!$this->checkSaleMap()){
			return redirect("/");
		}
		$path = $req->file->store('contribute');

		$url = Storage::url($path);
		DB::table('zone')->where('zone.id',$req->id)->update([
			'name' => $req->name,
			'unit_price' => $req->unit,
			'position' => $req->pos,
			'acreage' => $req->acreage,
			'view' => $req->view,
			'image_name'=>$url
		]);  
		return redirect()->back()->with('notification',' Đã thay đổi thông tin ');
	
		}

 
	
	
	public function areaContributeInformation($id){
		if(!$this->checkContributeMap()){
			return redirect("/");
		}
		
		$area = Area::where("id", $id)->first();
		return view('map.area_contribute_information', compact('area'));
	}

	public function updateZone(Request $req, $cam_id){  
		if(!$this->checkAdmin()){
			return redirect("/");
		}
		
		$data = $req->zones;
		$width = $req->zones[0];
		$height = $req->zones[1];
		$resolution = Camera::where('id',$cam_id)->first()->resolution;
		if($resolution = 1){
			$ratio = $width/1920;
		}
		else{
			$ratio = $width/1280;
		}


		array_shift($data);
		array_shift($data);
		$zones_value = $data;
		$zones=[];
		foreach($zones_value as $zone_value){
			$zone = [];
			$points = explode(",",$zone_value);
			foreach($points as $point){
				array_push($zone,round($point/($ratio)));
			}
			array_push($zones,$zone);
		}
		$zones = json_encode($zones);
		// Camera::where('id',$cam_id)->update(['zone'=>$zones]);
		return "true";
	}

	
	public function addMapConfig(Request $req){  
		if(!$this->checkAdmin() && Auth()->user()->role_id != 14){
			return redirect("/");
		}
		$zones = $req->zones;
		$zones = json_encode($zones);

		DB::table('map_config')->insert([
		"project_id"=> $req->id,
		'name' => $req->name,
		'zone' => $zones
]);
		return redirect()->back();
	}

	public function editMapConfig(Request $req){  
		if(!$this->checkAdmin() && Auth()->user()->role_id != 14){
			return redirect("/");
		}
		DB::table('map_config')->where("id",$req->id)->update([
		'name' => $req->name
]);
		return redirect()->back();
	}

	public function addAreaConfig(Request $req){  
		if(!$this->checkAdmin() && Auth()->user()->role_id != 14){
			return redirect("/");
		}
		$zones = $req->zones;
		$zones = json_encode($zones);
		// dd("????");


		if($this->checkAdmin()){
		DB::table('zone')->insert([
		"area_id"=> $req->area_id,
		"name"=> $req->name,
		'zone' => $zones,
		'state' => -1
]);
	}else{
		// dd($req->area_id);
		DB::table('zone')->where("name",$req->name)->where("project_id",$req->project_id)->update([
		"area_id"=> $req->area_id,
		'zone' => $zones
]);

	}
		return redirect()->back()->with("notification","Đã thêm cấu hinh");
	}

	public function editAreaConfig(Request $req){  
		if(!$this->checkAdmin() && Auth()->user()->role_id != 14){
			return redirect("/");
		}
		// dd($req->id);
		// DB::table('zone')->where("id",$req->id)->update([
		// 'name' => $req->name
// ]);
		return redirect()->back();
	}

	public function removeAreaConfig(Request $req){  
		if(!$this->checkAdmin() && Auth()->user()->role_id != 14){
			return redirect("/");
		}
		// dd($req->id);
		DB::table('zone')->where("id",$req->id)->update([
		"area_id"=> 0,
		'zone' => ""
]);
		return redirect()->back()->with("notification","Đã xóa cấu hinh");;
	}



	public function addZone(Request $req){
			if(!$this->checkAdmin()){
			return redirect("/");
		}

		$zones = $req->zones;
		$zones = json_encode($zones);

		try{
			$new_zone = new Zone();
			$new_zone->name = $req->name;
			$new_zone->area_id = $req->area_id;
			$new_zone->position = $req->position;
			$new_zone->view = $req->view;
			// $new_zone->deposit = $req->deposit;
			$new_zone->pay_step = $req->pay_step;

			$new_zone->zone = $zones;
			$new_zone->state = 0;
			$new_zone->final_price = 132;
			$new_zone->unit_price = 132;
			$new_zone->pay_step = 0;
			$new_zone->bid = "lk";
			$new_zone->save();
			$area = Area::where("id", $req->area_id)->first();

				 return redirect('area-information/'.$req->area_id);
			// return view('map.area_information', compact('area'))->with('notification', ' Zone has been added !');

		}    catch (\Exception $e){
			return $e->getMessage();
		}
		catch (InvalidArgumentException $e) {
			return $e->getMessage();
		}

	}

		public function updateZoneConsumer(Request $req){
// try{
			if(!$this->checkSaleMap()){
				return redirect("/");
			}
			// dd($req->trans_type);

			 DB::table("consumer_history")->insert([
            'zone_id' => $req->zone_id,
            'name' => $req->cname1,
            'birth_date' => $req->birth_day1,
            'phone_number' => $req->cphone1,
            "email" => $req->cemail1,
            "married" => $req->married,
            "married_role" => $req->married_role,
            "identify_card" => $req->cidentify1,
            "iden_date" => $req->ciden_date1,
            "iden_location" => $req->clocation1,
            "address" => $req->caddress1
        ]);


			if ($req->con_id > 0){

				// dd("okjoe");

				$consumer_id = $req->con_id;

				 Consumer::where('id',$consumer_id )->update([
						'name' => $req->cname1,
						'birth_date' => $req->birth_day1,
						'phone_number' => $req->cphone1,
						"email" => $req->cemail1,
						"married" => $req->married,
						"married_role" => $req->married_role,
						"identify_card" => $req->cidentify1,
						"iden_date" => $req->ciden_date1,
						"iden_location" => $req->clocation1,
						"address" => $req->caddress1
				]);



        $consumer = DB::table("consumer")->where("id",$consumer_id)->first();
        User::where("email", $consumer->email)->where("role_id",27)->delete();


            $new_user = new User();
            $new_user->name = $consumer->name;
            $new_user->email = $consumer->email;
            $new_user->phone = $consumer->phone_number;
            $new_user->identify = $consumer->identify_card;


            $new_user->iden_date = $consumer->iden_date;

            $new_user->iden_location = $consumer->iden_location;

            $new_user->tax_code = "00000";

            $new_user->birth_date = $consumer->birth_date;

            $new_user->role_id = 27;

            $pass = Str::random(25);
            $new_user->password = Hash::make($pass);

          
            $new_user->save();
            DB::table("consumer")->where("id",$consumer_id)->update(["user_id"=>$new_user->id]);

            $data = array('mypass'=>$pass,"myemail"=>$consumer->email,"email"=>$consumer->email);
            // dd($data);
                  Mail::send('consumer', $data, function($message) use ($data)  {
                     $message->to($data['email'], 'hông báo tài khoản cho khách hàng')->subject
                        ('Thông báo tài khoản cho khách hàng');
                     $message->from('automail.lopital@gmail.com','Lopital');
                  });
      

				$consumer = Consumer::where("id",$req->con_id)->first();
				$count =Consumer2::where("consumer_id",$consumer_id)->count();
				if($count > 0 ){
				$consumer2 = Consumer2::where("consumer_id",$consumer_id)->first();
				 Consumer2::where('consumer_id', $consumer_id)->update([
					 'name' => $req->cname1,
						'birth_date' => $req->birth_day2,
						'phone_number' => $req->cphone2,
						"email" => $req->cemail2,
						"identify_card" => $req->cidentify2,
						"iden_date" => $req->ciden_date2,
						"iden_location" => $req->clocation2,
						"address" => $req->caddress2
				]);
				}else{
					
			if( $consumer->married == 2){
				$new_consumer2 = new Consumer2();
				 $new_consumer2->consumer_id = $consumer_id;
				 $new_consumer2->name = $req->cname2;
					$new_consumer2->birth_date = $req->birth_day2;
					$new_consumer2->phone_number = $req->cphone2;
					$new_consumer2->email = $req->cemail2;


					$new_consumer2->identify_card = $req->cidentify2;
					$new_consumer2->iden_date = $req->ciden_date2;
					$new_consumer2->iden_location = $req->clocation2;

					$new_consumer2->address = $req->caddress2;
					$new_consumer2->save();

					$consumer2 = $new_consumer2;

				}
			}
				

			}else{

			$flag = Consumer::where("identify_card",$req->cidentify1)->count();

			if($flag > 0){

				// return redirect()->back()->with("warning","Đã trùng chứng minh thư");
			

					$consumer = Consumer::where("identify_card",$req->cidentify1)->first();
					$consumer_id = $consumer->id;

					Consumer::where('id',$consumer_id )->update([
						'name' => $req->cname1,
						'birth_date' => $req->birth_day1,
						'phone_number' => $req->cphone1,
						"email" => $req->cemail1,
						"married" => $req->married,
						"married_role" => $req->married_role,
						"identify_card" => $req->cidentify1,
						"iden_date" => $req->ciden_date1,
						"iden_location" => $req->clocation1,
						"address" => $req->caddress1
				]);
				$count = Consumer2::where("consumer_id",$consumer_id)->count();
		 
				if($count > 0 ){
				$consumer2 = Consumer2::where("consumer_id",$consumer_id)->first();
				 Consumer2::where('consumer_id', $consumer_id)->update([
					 'name' => $req->cname2,
						'birth_date' => $req->birth_day2,
						'phone_number' => $req->cphone2,
						"email" => $req->cemail2,
						"identify_card" => $req->cidentify2,
						"iden_date" => $req->ciden_date2,
						"iden_location" => $req->clocation2,
						"address" => $req->caddress2
				]);
				}else{

			if( $consumer->married == 2){
				$new_consumer2 = new Consumer2();
				 $new_consumer2->consumer_id = $consumer_id;
				 $new_consumer2->name = $req->cname2;
					$new_consumer2->birth_date = $req->birth_day2;
					$new_consumer2->phone_number = $req->cphone2;
					$new_consumer2->email = $req->cemail2;


					$new_consumer2->identify_card = $req->cidentify2;
					$new_consumer2->iden_date = $req->ciden_date2;
					$new_consumer2->iden_location = $req->clocation2;

					$new_consumer2->address = $req->caddress2;
					$new_consumer2->save();

					$consumer2 = $new_consumer2;

				}
			}
			}else{

					if(strlen($req->cname1) > 200){
						return Redirect()->back()->with('warning',' Tên khách hàng quá dài ');
					}

					if(strlen($req->cphone1) > 15){
						return Redirect()->back()->with('warning',' Số điện thoại quá dài ');
					}
					if(strlen($req->cidentify1) > 15){
						return Redirect()->back()->with('warning',' Chứng minh thư quá dài ');
					}
					// print($req->identify);
					// dd(strlen($req->phone));
					 $new_consumer = new Consumer();
						$new_consumer->name = $req->cname1;
						$new_consumer->birth_date = $req->birth_day1;
						$new_consumer->phone_number = $req->cphone1;
						$new_consumer->email = $req->cemail1;


						$new_consumer->married = $req->married;
						$new_consumer->married_role = $req->married_role;

						$new_consumer->identify_card = $req->cidentify1;
						$new_consumer->iden_date = $req->ciden_date1;
						$new_consumer->iden_location = $req->clocation1;

						$new_consumer->address = $req->caddress1;
						$new_consumer->save();
						$consumer = $new_consumer;
						$consumer_id = $new_consumer->id;

						   $consumer = DB::table("consumer")->where("id",$consumer_id)->first();
        User::where("email", $consumer->email)->where("role_id",27)->delete();


            $new_user = new User();
            $new_user->name = $consumer->name;
            $new_user->email = $consumer->email;
            $new_user->phone = $consumer->phone_number;
            $new_user->identify = $consumer->identify_card;


            $new_user->iden_date = $consumer->iden_date;

            $new_user->iden_location = $consumer->iden_location;

            $new_user->tax_code = "00000";

            $new_user->birth_date = $consumer->birth_date;

            $new_user->role_id = 27;

            $pass = Str::random(25);
            $new_user->password = Hash::make($pass);

            $data = array('mypass'=>$pass,"myemail"=>$consumer->email,"email"=>$consumer->email);
           	try{
            Mail::send('consumer', $data, function($message) use ($data)  {
                     $message->to($data['email'], 'Thông báo tài khoản cho khách hàng')->subject
                        ('Thông báo tài khoản cho khách hàng');
                     $message->from('automail.lopital@gmail.com','Lopital');
                  });
      		}
    catch (\Exception $e) { 
    	$end = 1;
			}
			if( $req->married == 2){
				$new_consumer2 = new Consumer2();
				 $new_consumer2->consumer_id = $consumer_id;
				 $new_consumer2->name = $req->cname2;
					$new_consumer2->birth_date = $req->birth_day2;
					$new_consumer2->phone_number = $req->cphone2;
					$new_consumer2->email = $req->cemail2;


					$new_consumer2->identify_card = $req->cidentify2;
					$new_consumer2->iden_date = $req->ciden_date2;
					$new_consumer2->iden_location = $req->clocation2;

					$new_consumer2->address = $req->caddress2;
					$new_consumer2->save();

					$consumer2 = $new_consumer2;
}
			}
		}
		$con_discount = 0;
		if($req->con_discount !== null){
			$con_discount = $req->con_discount;
		}

			Zone::where('id', $req->zone_id)->update([
						'staff_id' => $req->staff_id,
						'deposit' => $req->radio,
						'consumer_id' => $consumer_id,
						'unit_price' => $req->unit_price,
						'real_price' => $req->real_price,
						'final_price' => $req->final_price,
						'done' => 0,
			              'lock_user' => 0,
			              'lock_time' => Carbon::now(),
			              'lock' => 0,
						'dept' => $req->final_price,
						'vat' => $req->vat,
						'tax' => $req->tax,
						'inner_tax' => $req->inner_tax,
						'gap' => $req->gap_final,
						'trans_type' => $req->trans_type,
						'price_discount' => $req->price_discount,
						'con_discount' => $con_discount,
						'pay_step'=>$req->pay_step,
						'deposit_date' => date('Y-m-d'),
						'state' => 2
				]);
		
$now = Carbon::now();





// echo $now->year;
// echo $now->month;
// echo $now->weekOfYear;
		$zone = Zone::where('id', $req->zone_id)->first();
		 if($zone->acreage > 120){
			
	$con_price = "1,636,685,000 ";
	$con_value = 1636685000;

		 }else{
	$con_price = "1,558,055,000"; 
	$con_value = 1558055000;
		 }
$unit_price = number_format($zone->unit_price, 0, ",", ".");

						

								 


$cellRowSpan = array('vMerge' => 'restart');
$cellRowContinue = array('vMerge' => 'continue');
$cellColSpan = array('gridSpan' => 2);

$TableFontStyle = array('align'=>'both','name'=>'Times New Roman', 'bold'=>false, 'size'=>12);


$deposit_tableFontStyle = array('align'=>'both','name'=>'Times New Roman', 'bold'=>false, 'size'=>12);

$deposit_tableFontStyle2 = array('align'=>'both','name'=>'Times New Roman', 'bold'=>true, 'size'=>12);




	$table = new Table(array('align'=>'both','lineHeight' => 1.5, 'borderSize' => 3, 'borderColor' => 'black', 'width' => 9500,'unit' => TblWidth::TWIP));
			$table->addRow();
			$table->addCell(3500,$cellRowSpan)->addText("Đợt thanh toán",$TableFontStyle , array('align'=>'center') );
			$table->addCell(10000,$cellColSpan)->addText("Tiến độ thanh toán",$TableFontStyle , array('align'=>'center') );


			$table->addRow();
			$table->addCell(null, $cellRowContinue);
			$table->addCell(6000)->addText("Số tiền",$TableFontStyle , array('align'=>'center'));
			$table->addCell(3000)->addText("Thời gian",$TableFontStyle,array('align'=>'center'));
			$zone_buy = 0;
			for($i = 1;$i < $req->pay_step +1;$i++ ){
				$money = "pay".$i;
				$date = "pay_date".$i;
				DB::table('zone_pay')->insert([
						'zone_id' => $req->zone_id,
						'step' => $i,
						'money'=>$req->$money,
						'date'=>$req->$date,


				]);

				$vn_date = date("d-m-Y", strtotime($req->$date));

				$table->addRow();
				$table->addCell(3500)->addText("Đợt ".$i,$TableFontStyle , array('align'=>'center'));
				$table->addCell(6000)->addText(number_format($req->$money, 0, ",", "."),$TableFontStyle, array('align'=>'center'));
				$table->addCell(3000)->addText($vn_date,$TableFontStyle, array('align'=>'center'));
				

			}
$zone_buy =  number_format($zone_buy, 0, ",", ".");


////	
$deposit_table = new Table(array('align'=>'both','lineHeight' => 1.5, 'borderSize' => 3, 'borderColor' => 'black', 'width' => 10000,'unit' => TblWidth::TWIP));
			$deposit_table->addRow();
			$deposit_table->addCell(1500)->addText("Đợt",$deposit_tableFontStyle2 , array('align'=>'center') );
			$deposit_table->addCell(3000)->addText("Số tiền",$deposit_tableFontStyle2 , array('align'=>'center') );
			$deposit_table->addCell(4000)->addText("Tiến độ nộp",$deposit_tableFontStyle2 , array('align'=>'center') );
			$deposit_table->addCell(1500)->addText("Ghi chú",$deposit_tableFontStyle2 , array('align'=>'center') );


		 
			$zone_buy = 0;
			for($i = 1;$i < $req->pay_step +1;$i++ ){
				$money = "pay".$i;
				$date = "pay_date".$i;

				$deposit_table->addRow();
				$deposit_table->addCell(1500)->addText("Đợt ".$i,$deposit_tableFontStyle2 , array('align'=>'center'));

				$deposit_table->addCell(3000)->addText(number_format($req->$money, 0, ",", ".")." VND",$deposit_tableFontStyle, array('align'=>'center'));
			

				$vn_date = date("d-m-Y", strtotime($req->$date));
				if($req->pay_step != $i){
				$deposit_table->addCell(4000)->addText("Ngày ".$vn_date,$deposit_tableFontStyle, array('align'=>'left'));
			}else{
				$deposit_table->addCell(4000)->addText("Ngày ".$vn_date." nộp tiền và ký hợp đồng chuyển nhượng quyền sử dụng đất và làm thủ tục lăn vân tay sang tên cá nhân.",$deposit_tableFontStyle, array('align'=>'left'));

				}

				$deposit_table->addCell(1500)->addText("",$deposit_tableFontStyle, array('align'=>'left'));
				$zone_buy = $zone_buy + $req->$money;

			}
			 $deposit_table->addRow();
				$deposit_table->addCell(1500)->addText("TỔNG",$deposit_tableFontStyle2 , array('align'=>'center'));
				$deposit_table->addCell(4000)->addText(number_format($zone_buy, 0, ",", ".")." đ",$deposit_tableFontStyle2, array('align'=>'center'));
				
				$deposit_table->addCell(7000)->addText("",$deposit_tableFontStyle2, array('align'=>'left'));

				$deposit_table->addCell(3000)->addText("",$deposit_tableFontStyle2, array('align'=>'left'));

//////////

//////////

	$final_table_l = new Table(array('align'=>'both','lineHeight' => 1.5, 'borderSize' => 3, 'borderColor' => 'black', 'width' => 9500,'unit' => TblWidth::TWIP));
			$final_table_l->addRow();
			$final_table_l->addCell(1500,$cellRowSpan)->addText("Đợt thanh toán",$deposit_tableFontStyle2 , array('align'=>'center') );
			$final_table_l->addCell(8000,$cellColSpan)->addText("Tiến độ thanh toán",$deposit_tableFontStyle2 , array('align'=>'center') );


			$final_table_l->addRow();
			$final_table_l->addCell(null, $cellRowContinue);
			$final_table_l->addCell(5000)->addText("Số tiền",$TableFontStyle , array('align'=>'center'));
			$final_table_l->addCell(4000)->addText("Thời gian",$TableFontStyle,array('align'=>'center'));
			// $zone_buy = 0;
			for($i = 1;$i < 3;$i++ ){

				$final_table_l->addRow();
				$final_table_l->addCell(1500)->addText("Đợt ".$i,$deposit_tableFontStyle2 , array('align'=>'center'));

				if($i == 1){
				$final_table_l->addCell(4000)->addText("Thanh toán ".number_format($zone->real_price * $zone->acreage, 0, ",", "."). "đ (".$this->convert_number_to_words($zone->real_price * $zone->acreage)." đồng)",$TableFontStyle, array('align'=>'center'));
				}elseif($i == 2){
				$final_table_l->addCell(4000)->addText("Thanh toán ".number_format($req->vat, 0, ",", "."). "đ (".$this->convert_number_to_words($req->vat + $req->tax)." đồng)",$TableFontStyle, array('align'=>'center'));
				}else{
				$final_table_l->addCell(4000)->addText("",$TableFontStyle, array('align'=>'center'));
				}
				$vn_date = date("d-m-Y", strtotime($req->$date));
				$temp = "";
				if($i == 1){
					$temp = "Tại thời điểm ký hợp đồng";

				}else if($i == 2){
					$temp = "Tại thời điểm Bên A làm thủ tục giấy chứng nhận quyền sử dụng đất cho Bên B";
				}
				$final_table_l->addCell(4000)->addText($temp."(Ngày ".$vn_date.")",$TableFontStyle, array('align'=>'center'));

			}













/////////////////////////

 $templateFile = '../storage/app/word_template/c1.docx';
		$templateObject = new TemplateProcessor($templateFile);
		$templateObject->setValue('ondate', date("d-m-Y", strtotime($req->pay_date1)));

		$templateObject->setValue('location1', $consumer->iden_location);
		$templateObject->setValue('name1', $consumer->name);
		$templateObject->setValue('identify1', $consumer->identify_card);
		$templateObject->setValue('birth_date1', date("d-m-Y", strtotime($consumer->birth_date)));
		$templateObject->setValue('iden_date1', date("d-m-Y", strtotime($consumer->iden_date)));
		$templateObject->setValue('address1', $consumer->address);
		$templateObject->setValue('phone1', $consumer->phone_number);
		$templateObject->setValue('email1', $consumer->email);

		if($consumer->married == 2){
		$templateObject->setValue('location2', $consumer2->iden_location);
		$templateObject->setValue('name2', $consumer2->name);
		$templateObject->setValue('identify2', $consumer2->identify_card);
		$templateObject->setValue('birth_date2', date("d-m-Y", strtotime($consumer2->birth_date)));
		$templateObject->setValue('iden_date2', date("d-m-Y", strtotime($consumer2->iden_date)));
		$templateObject->setValue('address2', $consumer2->address);
		$templateObject->setValue('phone2', $consumer2->phone_number);
		$templateObject->setValue('email2', $consumer2->email);
}

		$templateObject->setValue('zone_name',$zone->name);
		// $templateObject->setValue('zone_bid',$zone->name);
		$templateObject->setValue('acreage',$zone->acreage );
		$templateObject->setValue('zone_area', $zone->location);
		$templateObject->setValue('zone_location', 'Sau hồ');
		$templateObject->setValue('zone_position', '');
		$templateObject->setValue('zone_n1', substr($zone->name, -2));
		$templateObject->setValue('zone_n2', substr($zone->name, 2,2));
		$templateObject->setValue('zone_n3', substr($zone->name, 2,2).substr($zone->name, -2));

		 // $templateObject->setValue('zone_bid', substr($zone->name, 2,2).substr($zone->name, -2));
		 $templateObject->setValue('zone_bid', substr($zone->name, 0,4));

		 $templateObject->setValue('zone_buy', number_format($zone->final_price, 0, ",", "."));


		 $templateObject->setValue('num_money', number_format($zone->final_price, 0, ",", "."));

		$templateObject->setValue('text_money', $this->convert_number_to_words($zone->final_price));

		 $templateObject->setValue('num_deposit', number_format($req->pay1, 0, ",", "."));

		$templateObject->setValue('text_deposit', $this->convert_number_to_words($req->pay1));


		$vn_date = date("d-m-Y", strtotime($req->paydate1));
		$templateObject->setValue('on_date', $vn_date);

		 $templateObject->setValue('land_price', number_format($zone->unit_price * $zone->acreage, 0, ",", "."));

$templateObject->setValue('con_price', $con_price);
$templateObject->setValue('unit_price', $unit_price);


		$templateObject->setValue('day', $now->day);
		$templateObject->setValue('month', $now->month);
		$templateObject->setValue('year', $now->year);
		$quy = "I";
		if($now->month > 9){
			$quy = "IV";
		}elseif($now->month > 6){
			$quy = "III";
		}elseif($now->month > 3){
			$quy = "II";
		}

		$templateObject->setValue('quy', $quy);

		$templateObject->setComplexBlock('deposit_table', $deposit_table);
		// $templateObject->saveAs('template_with_table.docx');



		$wordDocumentFile = $templateObject->saveAs("../storage/app/word/c1-".$req->zone_id.".docx");

if($req->trans_type == 2){
		$templateFile = '../storage/app/word_template/l1.docx';
		$templateObject = new TemplateProcessor($templateFile);

		$templateObject->setValue('location1', $consumer->iden_location);
		$templateObject->setValue('name1', $consumer->name);
		$templateObject->setValue('identify1', $consumer->identify_card);
		$templateObject->setValue('birth_date1', date("d-m-Y", strtotime($consumer->birth_date)));
		$templateObject->setValue('iden_date1', date("d-m-Y", strtotime($consumer->iden_date)));
		$templateObject->setValue('address1', $consumer->address);
		$templateObject->setValue('phone1', $consumer->phone_number);
		$templateObject->setValue('email1', $consumer->email);

		if($consumer->married == 2){
		$templateObject->setValue('location2', $consumer2->iden_location);
		$templateObject->setValue('name2', $consumer2->name);
		$templateObject->setValue('identify2', $consumer2->identify_card);
		$templateObject->setValue('birth_date2', date("d-m-Y", strtotime($consumer2->birth_date)));
		$templateObject->setValue('iden_date2', date("d-m-Y", strtotime($consumer2->iden_date)));
		$templateObject->setValue('address2', $consumer2->address);
		$templateObject->setValue('phone2', $consumer2->phone_number);
		$templateObject->setValue('email2', $consumer2->email);
}

		$templateObject->setValue('zone_name',$zone->name );
		$templateObject->setValue('zone_area', $zone->acreage);
		$templateObject->setValue('zone_location', 'Sau hồ');
		$templateObject->setValue('zone_position', '');
		$templateObject->setValue('zone_n1', substr($zone->name, -2));
		$templateObject->setValue('zone_n2', substr($zone->name, 2,2));
		$templateObject->setValue('zone_n3', substr($zone->name, 2,2).substr($zone->name, -2));

		 $templateObject->setValue('zone_buy', number_format($zone->real_price * $zone->acreage+$zone->vat, 0, ",", "."));

		 $templateObject->setValue('num_money', number_format($zone->real_price * $zone->acreage+$zone->vat, 0, ",", "."));

		$templateObject->setValue('text_money', $this->convert_number_to_words($zone->real_price * $zone->acreage+$zone->vat));

		 $templateObject->setValue('land_price', number_format($zone->real_price * $zone->acreage, 0, ",", "."));
$templateObject->setValue('con_price', $con_price);
$templateObject->setValue('unit_price', $unit_price);
$templateObject->setValue('real_price', $zone->real_price);



		$templateObject->setValue('day', $now->day);
		$templateObject->setValue('month', $now->month);
		$templateObject->setValue('year', $now->year);

		$templateObject->setComplexBlock('table', $table);
		// $templateObject->saveAs('template_with_table.docx');



		$wordDocumentFile = $templateObject->saveAs("../storage/app/word/l1-".$req->zone_id.".docx");



		$templateFile = '../storage/app/word_template/l2.docx';
		if(floatval($consumer->married) < 2){
		$templateFile = '../storage/app/word_template/l2a.docx';

		}
		$templateObject = new TemplateProcessor($templateFile);

		$templateObject->setValue('location1', $consumer->iden_location);
		$templateObject->setValue('name1', $consumer->name);
		$templateObject->setValue('identify1', $consumer->identify_card);
		$templateObject->setValue('birth_date1', date("d-m-Y", strtotime($consumer->birth_date)));
		$templateObject->setValue('iden_date1', date("d-m-Y", strtotime($consumer->iden_date)));
		$templateObject->setValue('address1', $consumer->address);
		$templateObject->setValue('phone1', $consumer->phone_number);
		$templateObject->setValue('email1', $consumer->email);

		if($consumer->married == 2){
		$templateObject->setValue('location2', $consumer2->iden_location);
		$templateObject->setValue('name2', $consumer2->name);
		$templateObject->setValue('identify2', $consumer2->identify_card);
		$templateObject->setValue('birth_date2', date("d-m-Y", strtotime($consumer2->birth_date)));
		$templateObject->setValue('iden_date2', date("d-m-Y", strtotime($consumer2->iden_date)));
		$templateObject->setValue('address2', $consumer2->address);
		$templateObject->setValue('phone2', $consumer2->phone_number);
		$templateObject->setValue('email2', $consumer2->email);
}

		$templateObject->setValue('zone_name',$zone->name );
		$templateObject->setValue('zone_area', $zone->acreage);
		$templateObject->setValue('zone_location', 'Sau hồ');
		$templateObject->setValue('zone_position', '');
		$templateObject->setValue('zone_n1', substr($zone->name, -2));
		$templateObject->setValue('zone_n2', substr($zone->name, 2,2));
		$templateObject->setValue('zone_n3', substr($zone->name, 2,2).substr($zone->name, -2));

		 $templateObject->setValue('zone_bid', substr($zone->name, 2,2).substr($zone->name, -2));
		 $templateObject->setValue('zone_type', substr($zone->name, 0,2));
	

		 $templateObject->setValue('zone_buy', number_format($zone->real_price * $zone->acreage+$zone->vat, 0, ",", "."));

		 $templateObject->setValue('num_money', number_format($zone->real_price * $zone->acreage+$zone->vat, 0, ",", "."));

		$templateObject->setValue('text_money', $this->convert_number_to_words($zone->real_price * $zone->acreage+$zone->vat));

		 $templateObject->setValue('land_price', number_format($zone->real_price * $zone->acreage, 0, ",", "."));
$templateObject->setValue('con_price', $con_price);
$templateObject->setValue('unit_price', $unit_price);
$templateObject->setValue('real_price', $zone->real_price );





		$templateObject->setValue('day', $now->day);
		$templateObject->setValue('month', $now->month);
		$templateObject->setValue('year', $now->year);
	$quy = "I";
		if($now->month > 9){
			$quy = "IV";
		}elseif($now->month > 6){
			$quy = "III";
		}elseif($now->month > 3){
			$quy = "II";
		}
		$templateObject->setValue('quy', $quy);
		$templateObject->setComplexBlock('table', $table);
		$templateObject->setComplexBlock('final_table_l', $final_table_l);
		// $templateObject->saveAs('template_with_table.docx');



		$wordDocumentFile = $templateObject->saveAs("../storage/app/word/l2-".$req->zone_id.".docx");

 } 
	elseif($req->trans_type == 3){
 // if(1>0){
	$templateFile = '../storage/app/word_template/h1.docx';
		$templateObject = new TemplateProcessor($templateFile);


		$templateObject->setValue('location1', $consumer->iden_location);
		$templateObject->setValue('name1', $consumer->name);
		$templateObject->setValue('identify1', $consumer->identify_card);
		$templateObject->setValue('birth_date1', date("d-m-Y", strtotime($consumer->birth_date)));
		$templateObject->setValue('iden_date1', date("d-m-Y", strtotime($consumer->iden_date)));
		$templateObject->setValue('address1', $consumer->address);
		$templateObject->setValue('phone1', $consumer->phone_number);
		$templateObject->setValue('email1', $consumer->email);

		if($consumer->married == 2){
		$templateObject->setValue('location2', $consumer2->iden_location);
		$templateObject->setValue('name2', $consumer2->name);
		$templateObject->setValue('identify2', $consumer2->identify_card);
		$templateObject->setValue('birth_date2', date("d-m-Y", strtotime($consumer2->birth_date)));
		$templateObject->setValue('iden_date2', date("d-m-Y", strtotime($consumer2->iden_date)));
		$templateObject->setValue('address2', $consumer2->address);
		$templateObject->setValue('phone2', $consumer2->phone_number);
		$templateObject->setValue('email2', $consumer2->email);
}

		$templateObject->setValue('zone_name',$zone->name );
		$templateObject->setValue('zone_area', $zone->acreage);
		$templateObject->setValue('zone_location', 'Sau hồ');
		$templateObject->setValue('zone_position', '');
		$templateObject->setValue('zone_n1', substr($zone->name, -2));
		$templateObject->setValue('zone_n2', substr($zone->name, 2,2));
		$templateObject->setValue('zone_n3', substr($zone->name, 2,2).substr($zone->name, -2));

		 $templateObject->setValue('zone_bid', substr($zone->name, 2,2).substr($zone->name, -2));
		 $templateObject->setValue('zone_type', substr($zone->name, 0,2));
		 $templateObject->setValue('zone_buy', number_format($zone->final_price, 0, ",", "."));

		 $templateObject->setValue('num_money', number_format($zone->final_price, 0, ",", "."));

		$templateObject->setValue('text_money', $this->convert_number_to_words($zone->final_price));

		 $templateObject->setValue('land_price', number_format($zone->unit_price * $zone->acreage, 0, ",", "."));
$templateObject->setValue('con_price', $con_price);
$templateObject->setValue('unit_price', $unit_price);



		$templateObject->setValue('day', $now->day);
		$templateObject->setValue('month', $now->month);
		$templateObject->setValue('year', $now->year);


		$templateObject->setComplexBlock('table', $table);
		// $templateObject->saveAs('template_with_table.docx');



		$wordDocumentFile = $templateObject->saveAs("../storage/app/word/h1-".$req->zone_id.".docx");



		$templateFile = '../storage/app/word_template/h2.docx';
		// print(floatval($consumer->married));
		if(floatval($consumer->married) <2){
			// print("wtf");
		$templateFile = '../storage/app/word_template/h2a.docx';
}
// dd($templateFile);
		$templateObject = new TemplateProcessor($templateFile);

		$templateObject->setValue('location1', $consumer->iden_location);
		$templateObject->setValue('name1', $consumer->name);
		$templateObject->setValue('identify1', $consumer->identify_card);
		$templateObject->setValue('birth_date1', date("d-m-Y", strtotime($consumer->birth_date)));
		$templateObject->setValue('iden_date1', date("d-m-Y", strtotime($consumer->iden_date)));
		$templateObject->setValue('address1', $consumer->address);
		$templateObject->setValue('phone1', $consumer->phone_number);
		$templateObject->setValue('email1', $consumer->email);

		if($consumer->married == 2){
		$templateObject->setValue('location2', $consumer2->iden_location);
		$templateObject->setValue('name2', $consumer2->name);
		$templateObject->setValue('identify2', $consumer2->identify_card);
		$templateObject->setValue('birth_date2', date("d-m-Y", strtotime($consumer2->birth_date)));
		$templateObject->setValue('iden_date2', date("d-m-Y", strtotime($consumer2->iden_date)));
		$templateObject->setValue('address2', $consumer2->address);
		$templateObject->setValue('phone2', $consumer2->phone_number);
		$templateObject->setValue('email2', $consumer2->email);
}

		$templateObject->setValue('zone_name',$zone->name );
		$templateObject->setValue('zone_area', $zone->acreage);
		$templateObject->setValue('zone_location', 'Sau hồ');
		$templateObject->setValue('zone_position', '');
		$templateObject->setValue('zone_n1', substr($zone->name, -2));
		$templateObject->setValue('zone_n2', substr($zone->name, 2,2));
		$templateObject->setValue('zone_n3', substr($zone->name, 2,2).substr($zone->name, -2));
		 $templateObject->setValue('zone_bid', substr($zone->name, 2,2).substr($zone->name, -2));
		 $templateObject->setValue('zone_type', substr($zone->name, 0,2));

		 $templateObject->setValue('zone_buy', number_format($zone->final_price, 0, ",", "."));
		 $templateObject->setValue('num_money', number_format($zone->final_price, 0, ",", "."));

		$templateObject->setValue('text_money', $this->convert_number_to_words($zone->final_price));

		 $templateObject->setValue('land_price', number_format($zone->unit_price * $zone->acreage, 0, ",", "."));

		$templateObject->setValue('con_price', $con_price);
		$templateObject->setValue('unit_price', $unit_price);


		$templateObject->setValue('t1',  number_format($zone_buy, 0, ",", ".")." đ");
		$templateObject->setValue('t2', number_format($zone_buy*0.1, 0, ",", ".")." đ");

		$templateObject->setValue('t3', number_format($zone_buy*1.1, 0, ",", ".")." đ");
		$templateObject->setValue('t4', number_format($con_value*0.95, 0, ",", ".")." đ");

		$templateObject->setValue('t5', number_format($con_value*0.05, 0, ",", ".")." đ");

		$templateObject->setValue('t6', "");
		$templateObject->setValue('t7', $con_price);

		$templateObject->setValue('day', $now->day);
		$templateObject->setValue('month', $now->month);
		$templateObject->setValue('year', $now->year);

		$templateObject->setComplexBlock('table', $table);
		// $templateObject->saveAs('template_with_table.docx');



		$wordDocumentFile = $templateObject->saveAs("../storage/app/word/h2-".$req->zone_id.".docx");
 }


		$event  = new Event();


	$zname = Zone::where('id', $req->zone_id)->first()->name;

		$event->title = "Hợp đồng mới";
		$event->type = 1;
		$event->description = "Đã kí hợp đồng nhà ".$zname;
		// $data = json_decode($response, true);
		$event->permiss = 0;
		$event->user_id = Auth()->user()->id;

		$event->save();

		 $lead = $this->getLead();

            foreach ($lead as $lid) {
	            DB::table('event_noti')->insert([
	                'event_id' => $event->id,
	                'user_id' => $lid
	            ]);
            }
										

			      return Redirect("/chatify/zone-sale/".$req->zone_id)->with('notification', 'cập nhật thông tin thành công');
   
		
	}
		public function confirmDeal($id){

			if(!$this->checkSaleMap()){
				return redirect("/");
			}
		

			$acc_id = Accountant::where("user_id",Auth()->user()->id)->first()->id;
				Zone::where('id', $id)->update([
						'accountant_id' => $acc_id,
						'complete_date' => date('Y-m-d'),
						'state' => 2
				]);
		}

		 public function deleteMapConfig($id){

			if(!$this->checkAdmin() && Auth()->user()->role_id != 14){
				return redirect("/");
			}
		

				 DB::table('map_config')->where('id', $id)->delete();
			}
	 public function deleteZone($id){

			if(!$this->checkAdmin()){
				return redirect("/");
			}
		

				 Zone::where('id', $id)->delete();
			}
	public function getZone(int $area_id){
		// dd("???");
			 if(!$this->checkMap() && Auth()->user()->role_id != 14){
				return redirect("/");
			}
		

		// $area = Zone::where('area_id', $area_id)->get();

		$area = DB::table('zone')
		->leftJoin('staff', 'zone.staff_id', '=', 'staff.id')
		->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
		->leftJoin('accountant', 'zone.accountant_id', '=', 'accountant.id')
		->leftJoin('area', 'zone.area_id', '=', 'area.id')
		->where([['zone.area_id',$area_id]])
		->select("zone.id as id",'zone.name as name','zone.zone as zone', 'zone.state as state',"zone.acreage as acreage",
			"zone.final_price as price",'zone.deposit_date','zone.complete_date', 'consumer.id as customer_id','zone.contribute_state as contribute_state',
			"consumer.phone_number as consumer_phone_number",'consumer.identify_card as consumer_identify_card',
			'staff.id as staff_id',"staff.phone_number as staff_phone_number",'staff.identify_card as staff_identify_card',
			'accountant.id as accountant_id',"accountant.phone_number as accountant_phone_number",'accountant.name as accountant_name','staff.name as staff_name','consumer.name as consumer_name',"area.display as display")
		->where('zone.bid', 'NOT LIKE', '%N%')
		->where('zone.name', 'NOT LIKE', 'N%')
		->get();
		// dd($area);
		return json_encode($area);
	}

	public function getConfig($id){
			 if(!$this->checkMap() && Auth()->user()->role_id != 14){
				return redirect("/");
			}

		$area = DB::table('map_config')->where("project_id",$id)->get();
		return json_encode($area);
	}


public function getHistoryZone($id){
		 if(!$this->checkMap()){
				return redirect("/");
			}

		// $area = Zone::where('area_id', $area_id)->get();

		$area = DB::table('history_zone')
		->leftJoin('zone', 'zone.id', '=', 'history_zone.zone_id')
		->where([['zone.id',$id]])
		->select("history_zone.description as description",'history_zone.url as url','history_zone.created_at as time', 'zone.contribute_state as state')->get();
		return json_encode($area);
	}

	public function getContributeZone(int $area_id){

			 if(!$this->checkMap()){
				return redirect("/");
			}

		// $area = Zone::where('area_id', $area_id)->get();

		$area = DB::table('zone')
		->where([['zone.area_id',$area_id]])
		->select("zone.id as id",'zone.name as name','zone.zone as zone', 'zone.state as state','zone.contribute_state as contribute_state')->get();
		return json_encode($area);
	}
	public function addHistoryZone(Request $request)
		{
			 if(!$this->checkMap()){
				return redirect("/");
			}
			
				if ($request->file == null){
					 return Redirect()->back()->with('warning', 'Chưa có tệp tải lên');
				}
			// $image = $request->file('file');;

			// $img = Image::make($image->getRealPath());

			// $img = $request->file;
			$id =  $request->id;
			$des = $request->des;

// try{
foreach ($request->file as $file) {
			$path = $file->store('contribute');

			$url = Storage::url($path);

       $temp = explode("/", $url);
      $temp = end($temp);

      $img = Image::make($file)
      ->resize(300, 300)->stream();



      $path = Storage::disk('public')->put($temp, $img);



			$new_history = new Historyzone();
			$new_history->zone_id = $id;
			$new_history->user_id = Auth()->user()->id;
			$new_history->url = $url;
			$new_history->url_small = "/storage/public/".$temp;
			$new_history->description = $des;
			$new_history->save();

			$his_id = $new_history ->id;


			  DB::table("history_zone_tag")->insert([
                  "history_id"=>$his_id,
                  "tag_id"=>11,
        ]);

         DB::table("history_zone_tag")->insert([
                  "history_id"=>$his_id,
                  "tag_id"=>26,
        ]);

         DB::table("history_zone_tag")->insert([
                  "history_id"=>$his_id,
                  "tag_id"=>27,
        ]);

					
			// $destinationPath = public_path().'/js-css/img/history/';

			// $request->file->move($destinationPath,'zone'.$id.'_'.$new_history->id.'.jpg');


			// Historyzone::where('id', $new_history->id)->update([
			//       'url' => $url
			//   ]);
}
	 // }
// catch (\Exception $e) { 

// 				return Redirect()->back()->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');
				
// 							 }
		$zone_contribute = Zone::where("id",$id)->first()->contribute_state;
		if ($zone_contribute !== $request->state){

			Zone::where('id', $id)->update([
						'contribute_state' => $request->state
				]);
				 return back()->with('notification', 'Đã cập nhật tiến độ');;
		}
				// event($e = new RedisEvent($request->all()));

			// $image->move($destinationPath.'');
			// return "true";
	}



 
	public function getArea(int $project_id){
			 if(!$this->checkSaleMap() && Auth()->user()->role_id != 14){
				return redirect("/");
			}
			
		// $area = Zone::where('area_id', $area_id)->get();

		$area = Area::where([['project_id',$project_id]])->get();
	 
		return json_encode($area);
	}



	   public function addMinimap(Request $req){
    $zones = $req->zones;
    $zones = json_encode($zones);

    try{
      $new_zone = new Area();
      $new_zone->name = $req->name;
      $new_zone->description = $req->description;
      $new_zone->project_id = $req->project_id;
      $new_zone->zone = $zones;
      $new_zone->save();
      $area = Area::where("id", $new_zone->id)->first();

       Area::where('id', $area->id)->update([
            'url' => $area->name.".png"
        ]);
         return redirect()->back();
      // return view('map.area_list', compact('area'))->with('notification', ' Zone has been added !');

    }    catch (\Exception $e){
      return $e->getMessage();
    }
    catch (InvalidArgumentException $e) {
      return $e->getMessage();
    }

  }
  public function deleteMinimap($id){
      Area::where('id', $id)->delete();
  }



	 public function addArea(Request $req){
			 if(!$this->checkAdmin()){
				return redirect("/");
			}
			
		$zones = $req->zones;
		$zones = json_encode($zones);

		try{
			$new_zone = new Zone();
			$new_zone->name = $req->name;
			$new_zone->area_id = 10;
			$new_zone->zone = $zones;
			$new_zone->bid = "O";
			$new_zone->state = 0;
			$new_zone->final_price = 0;
			$new_zone->unit_price = 0;
			$new_zone->price_discount = 0;
			$new_zone->con_discount = 0;
			$new_zone->vat = 0;
			$new_zone->tax = 0;
			$new_zone->gap = 0;
			$new_zone->inner_tax = 0;
			$new_zone->real_price = 0;
			$new_zone->pay_step = 0;
			$new_zone->save();


			DB::table('map_config')->insert([
					'name' => $req->name,
					'zone' => $zones
			]);


			
			 return redirect()->back();
			// return view('map.area_list', compact('area'))->with('notification', ' Zone has been added !');

		}    catch (\Exception $e){
			return $e->getMessage();
		}
		catch (InvalidArgumentException $e) {
			return $e->getMessage();
		}

	}
	public function deleteArea($id){
			 if(!$this->checkAdmin()){
				return redirect("/");
			}
			
			Area::where('id', $id)->delete();
	}

	public function saveClick($id){
		$zc = DB::table("zone_click_statistic")->where("zone_id",$id)->first();
		// dd($zc);
		if($zc == NULL){
			DB::table("zone_click_statistic")->insert([
				"zone_id"=>$id
			]);
		}else{
			DB::table("zone_click_statistic")->where("zone_id",$id)->update([
				"count"=>$zc->count + 1
			]);
		}
		return $zc->count;
	}

		public function saveSearch(Request $req){

			if(strlen($req->unit_price_low) == 0 || $req->unit_price_low<0 ){
				$unit_price_low =0;
			}else{

				$unit_price_low = $req->unit_price_low;
			}

			if(strlen($req->unit_price_high) == 0  || $req->unit_price_high<0){
				$unit_price_high =0;
			}else{

				$unit_price_high = $req->unit_price_high;
			}

			if(strlen($req->total_price_low) == 0 || $req->total_price_low<0){
				$total_price_low =0;
			}else{

				$total_price_low = $req->total_price_low;
			}

			if(strlen($req->total_price_high) == 0 || $req->total_price_high<0){
				$total_price_high =0;
			}else{

				$total_price_high = $req->total_price_high;
			}

			if(strlen($req->area_high) == 0 || $req->area_high<0){
				$area_high =0;
			}else{

				$area_high = $req->area_high;
			}

			if(strlen($req->area_low) == 0 || $req->area_low<0){
				$area_low =0;
			}else{

				$area_low = $req->area_low;
			}
			DB::table("zone_search_statistic")->insert([
				"unit_price_low"=>$unit_price_low,
				"unit_price_high"=>$unit_price_high,
				"total_price_low"=>$total_price_low,
				"total_price_high"=>$total_price_high,
				"type"=>$req->type,
				"area_low"=>$area_low,
				"area_high"=>$area_high
			]);
		
		return 1;
	}

	public function zoneSuggestJson(){
		$area = [];
		for ($i = 0; $i < 10; $i ++){
			$temp =DB::table("zone_search_statistic")
			->where("area_low","<=",$i*300)
			->where("area_high","<=",($i+1)*300)->count();
			$area[] = $temp;
		}


		$unit_price = [];
		for ($i = 3; $i < 17; $i ++){
			$temp =DB::table("zone_search_statistic")
			->where("unit_price_low","<=",$i*1000000)
			->where("unit_price_high","<=",($i+1)*1000000)->count();
			$unit_price[] = $temp;
		}


		$total_price= [];
		for ($i = 0; $i < 30; $i= $i +3){
			$temp =DB::table("zone_search_statistic")
			->where("total_price_low","<=",$i*1000000000)
			->where("total_price_high","<=",($i+3)*1000000000)->count();
			$total_price[] = $temp;
		}

		 return [$area,$unit_price,$total_price];
	}

	public function zoneSuggest($id){

     if(!$this->checkLead()){
        return redirect("/");
      }

    $project = Project::where("id", $id)->first();


		$zone =  DB::table('zone')
		->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
		->select('zone.bid',
				DB::raw('count(zone.id) as total'),
				DB::raw('sum(zone.state = 0) as nonsell'),
				DB::raw('sum(zone.state > 2) as done1'),
				DB::raw('sum(zone.state = 2) as nondone1'),
				DB::raw('sum(zone.acreage) as acreage'),
				DB::raw('sum(zone.real_price*acreage) as real_price'),
				DB::raw('sum(zone.final_price) as final_price'),
				DB::raw('sum(zone.done) as done'),
				DB::raw('sum(zone.dept) as dept')
		)
		->groupBy('zone.bid')
		->where('zone.bid', 'NOT LIKE', '%N%')
		->where("map_config.project_id",$id)
		->get();


		 $zone_total =  DB::table('zone')
		->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
		->select(
				DB::raw('count(zone.id) as total'),
				DB::raw('sum(zone.state = 0) as nonsell'),
				DB::raw('sum(zone.state > 2) as done1'),
				DB::raw('sum(zone.state = 2) as nondone1'),
				DB::raw('sum(zone.acreage) as acreage'),
				DB::raw('sum(zone.real_price*acreage) as real_price'),
				DB::raw('sum(zone.final_price) as final_price'),
				DB::raw('sum(zone.done) as done'),
				DB::raw('sum(zone.dept) as dept')
		)
		->where("map_config.project_id",$id)
		->where('zone.bid', 'NOT LIKE', '%N%')->first();


 		$acreage =  DB::table('zone')
		->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
		->select('zone.bid',
				DB::raw('count(*) as total2'),
				DB::raw('sum(CASE WHEN state = 0 THEN acreage ELSE 0 END) as nonsell'),
				DB::raw('sum(CASE WHEN state > 2 THEN acreage ELSE 0 END) as done1'),
				DB::raw('sum(CASE WHEN state = 2 THEN acreage ELSE 0 END) as nondone1'),
				DB::raw('sum(acreage) as total'),
				DB::raw('sum(real_price*acreage) as real_price'),
				DB::raw('sum(final_price) as final_price'),
				DB::raw('sum(done) as done'),
				DB::raw('sum(dept) as dept')
		)
		->groupBy('zone.bid')
		->where("map_config.project_id",$id)
		->where('zone.bid', 'NOT LIKE', '%N%')
		->where('zone.acreage', ">",0)
		->get();


		$acreage_total =  DB::table('zone')
		->leftJoin('map_config', 'zone.name', '=', 'map_config.name')
		->select(
				DB::raw('count(*) as total2'),
				DB::raw('sum(CASE WHEN state = 0 THEN acreage ELSE 0 END) as nonsell'),
				DB::raw('sum(CASE WHEN state > 2 THEN acreage ELSE 0 END) as done1'),
				DB::raw('sum(CASE WHEN state = 2 THEN acreage ELSE 0 END) as nondone1'),
				DB::raw('sum(acreage) as total'),
				DB::raw('sum(real_price*acreage) as real_price'),
				DB::raw('sum(final_price) as final_price'),
				DB::raw('sum(done) as done'),
				DB::raw('sum(dept) as dept')
		)


		->where("map_config.project_id",$id)
		->where('zone.bid', 'NOT LIKE', '%N%')
		->where('zone.acreage', ">",0)->first();

		$click_sum = DB::table("zone_click_statistic")
		->leftJoin("zone","zone_click_statistic.zone_id","zone.id")
		->select(
				DB::raw('sum(zone_click_statistic.count) as count'),
				DB::raw('avg(zone.acreage) as acreage1'),
				DB::raw('avg(zone.acreage*zone_click_statistic.count) as acreage2'),
				DB::raw('avg(zone.unit_price) as unit_price'),
				DB::raw('avg(zone.final_price) as final_price')
		)
		->first();

		$click_bid = DB::table("zone_click_statistic")
		->leftJoin("zone","zone_click_statistic.zone_id","zone.id")
		->select("zone.bid as name",
				DB::raw('sum(zone_click_statistic.count) as count'),
				DB::raw('avg(zone.acreage) as acreage1'),
				DB::raw('avg(zone.acreage*zone_click_statistic.count) as acreage2'),
				DB::raw('avg(zone.unit_price) as unit_price'),
				DB::raw('avg(zone.final_price) as final_price')
		)
		->groupBy("zone.bid")
		->get();
		// dd($click_bid);

		$overall = DB::table("zone_search_statistic")
		->select(
				DB::raw('sum(id) as total_row'),
				DB::raw('sum(CASE WHEN unit_price_low> 0  THEN 1 ELSE 0 END) as unit_price_low'),
				DB::raw('sum(CASE WHEN unit_price_high> 0  THEN 1 ELSE 0 END) as unit_price_high'),
				DB::raw('sum(CASE WHEN total_price_low> 0  THEN 1 ELSE 0 END) as total_price_low'),
				DB::raw('sum(CASE WHEN total_price_high> 0  THEN 1 ELSE 0 END) as total_price_high'),
				DB::raw('sum(CASE WHEN area_high> 0  THEN 1 ELSE 0 END) as area_high'),
				DB::raw('sum(CASE WHEN area_low> 0  THEN 1 ELSE 0 END) as area_low'),
				DB::raw('sum(CASE WHEN length(type) > 0  THEN 1 ELSE 0 END) as type')
		)
		->first();


		$overall2 = DB::table("zone_search_statistic")
		->select(
				DB::raw('count(id) as total_row'),
				DB::raw('avg(CASE WHEN unit_price_low> 0  THEN unit_price_low ELSE 0 END) as unit_price_low'),
				DB::raw('avg(CASE WHEN unit_price_high> 0  THEN unit_price_high ELSE 0 END) as unit_price_high'),
				DB::raw('avg(CASE WHEN total_price_low> 0  THEN total_price_low ELSE 0 END) as total_price_low'),
				DB::raw('avg(CASE WHEN total_price_high> 0  THEN total_price_high ELSE 0 END) as total_price_high'),
				DB::raw('avg(CASE WHEN area_high> 0  THEN area_high ELSE 0 END) as area_high'),
				DB::raw('avg(CASE WHEN area_low> 0  THEN area_low ELSE 0 END) as area_low')
		)
		->first();






         return view('map.suggest',compact(
         			"project","id",
         			"click_sum","click_bid",
         			"zone","zone_total",
         			"acreage","acreage_total",
         			"overall","overall2"
         ));
	}
}