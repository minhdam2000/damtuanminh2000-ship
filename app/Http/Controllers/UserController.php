<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use App\KmsClient;
use App\Http\Controllers\AgentController;
use App\Proxy;
use Illuminate\Support\Facades\Hash;
use App\CertificateAlocator;
use App\Camera;
use App\CameraPermission;
use Illuminate\Http\Request;
use App\Account;
use App\UserLocationAccess;
use App\Event;
use App\Staff;
use App\Boss;
use App\Contribute;
use App\Accountant;
use App\Department;
use App\Role;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{	

	public function loginKms() {
		return view('auth.login');
	}

	public function postLoginKms(Request $req){
		
		// $this->validate($req, [
		// 	'email' => 'required',
		// 	'g-recaptcha-response' => 'required|captcha',
		// ]);

		$user = User::where([['email', $req->email]])->get();
		if(count($user) != 0 && Hash::check($req->password, $user[0]->password)){
			if(($user[0]->status == 1)){
				Auth::login($user[0]);
				//$check = $this->createLocation(Auth()->user()->id , $req->ip());
		    	return Redirect('/');
		    }
		    else{
		    	return redirect()->back()->with('email', 'Email does not exist.');
		    }	
		}
		elseif(count(User::where('email', $req->email)->get()) == 0){
			return redirect()->back()->with('email', 'Email does not exist.');
		}
		else{
			return redirect()->back()->with('password', 'Password incorrect.');
		}
	}

	public function getAccountList(){
		if(Auth()->user()->admin_id < 2){
			$users = Account::get();
			$department = Department::get();
			$roles = Role::where("department_id",$department[0]->id)->get();

			return view('account.admin_account_list',compact('users','department','roles'));
		}
		
	}

	public function getUserRegister() {
		return view('account.user_register');
	}
	public function getRoleList($id){
		if($id != 12){
		return Role::where("department_id",$id)->get();
		}else{

		return DB::table("contractors")->get();
		}
	}
	public function postUserRegister(Request $req) {
		if(count(User::where('email', $req->email)->get()) != 0){
			return 'Email already exist';
		}
		elseif($req->password != $req->password_confirmation){
			return 'The password confirmation does not match';
		}
		else{
			$new_user = new User();
			$new_user->name = $req->name;
			$new_user->email = $req->email;
			$new_user->phone = $req->phone_number;
			$new_user->identify = $req->identify;
			// $new_user->phone_number = $req->phone_number;
     		$new_user->iden_date = $req->iden_date;

            $new_user->iden_location = $req->iden_location;

            $new_user->tax_code = $req->tax_code;

            $new_user->birth_date = $req->birth_date;

            $new_user->begin_date = $req->begin_date;

			if($req->role > 0 )
				$new_user->role_id = $req->role;
			if($req->department == 12){
				$new_user->role_id = -($req->role);
			}

			$new_user->admin_id = Auth()->user()->id;
			$new_user->password = Hash::make($req->password);

			// $new_user->password = Hash::make($req->password);
			$new_user->display = 1;
			$new_user->status = 1;
			$new_user->save();

			// if($req->role == 3){
			// 	// print_r("hrere");
			// 	$new_staff = new Staff();
			// 	$new_staff->name = $req->name;
			// 	$new_staff->user_id = $new_user->id;
			// 	$new_staff->identify_card = $req->identify;
			// 	$new_staff->phone_number = $req->phone_number;
			// 	$new_staff->save();
			// 	// print_r("saved");

			// }elseif ($req->role == 4) {
			// 	$new_accountant = new Accountant();
			// 	$new_accountant->name = $req->name;
			// 	$new_accountant->user_id = $new_user->id;
			// 	$new_accountant->identify_card = $req->identify;
			// 	$new_accountant->phone_number = $req->phone_number;
			// 	$new_accountant->save();
			// }
			// elseif ($req->role == 5) {
			// 	$new_accountant = new Contribute();
			// 	$new_accountant->name = $req->name;
			// 	$new_accountant->user_id = $new_user->id;
			// 	$new_accountant->save();
			// }
			// elseif ($req->role == 6) {
			// 	$new_accountant = new Boss();
			// 	$new_accountant->name = $req->name;
			// 	$new_accountant->user_id = $new_user->id;
			// 	$new_accountant->save();
			// }
			return Redirect()->back()->with('notification',' Đã tạo nhân viên thành công');
			return 'true';
		}
	}

	public function createUserSuccess() {
        return Redirect()->route('accountlist')->with('notification',' A User has been added !');
    }

	public function postRemoveAdmin(Request $req) {
		if(Auth()->user()->role_id != 1)
			return abort(404);
		$inputs = $req->all();
        unset($inputs['_token']);
        if(isset($inputs['select-all'])){
			unset($inputs['select-all']);
		}
		if(count($inputs) == 0){
        	return Redirect()->route('accountlist')->with('warning',' You have not selected any accounts.');
		}
		foreach($inputs as $input){
			User::where('id', $input)->update(['status'=> 0]);
		}
		if(count($inputs) == 1){
			return Redirect()->route('accountlist')->with('notification',' The user has been deleted.');
		}
		else {
			return Redirect()->route('accountlist')->with('notification',' The users have been deleted
.');
		}
	}

	public function postRemoveUser(Request $req) {
		$inputs = $req->all();
        unset($inputs['_token']);
        if(isset($inputs['select-all'])){
			unset($inputs['select-all']);
		}
		if(count($inputs) == 0){
        	return Redirect()->route('accountlist')->with('warning',' You have not selected any accounts.');
		}
		foreach($inputs as $input){
			$permission = User::where([['id', $input],['admin_id', Auth()->user()->id]])->get();
			if(count($permission)!=0){
				User::where('id', $input)->delete();
			}
		}
		if(count($inputs) == 1){
			return Redirect()->route('accountlist')->with('notification',' The user has been deleted.');
		}
		else {
			return Redirect()->route('accountlist')->with('notification',' The users have been deleted.');
		}
	}

	public function getUserEdit($userid){
		// if(User::where('id', $userid)->first()->admin_id == 1)
		// 	return;

		$role = User::where('id', $userid)->first()->role_id;
		if ($role > 0){
			$department = Role::where('id', $role)->first()->department_id;
		}else{
			$department =12;
		}
				$user = User::where('users.id', $userid)->first();
				// print_r("saved");



		
		return [$department,$user];
	}

	public function postUserEdit(Request $req, $userid){
		// if(User::where('id', $userid)->first()->admin_id ==1)
		// 	return;
		// $pass =  $req->password;
		if(count(User::where([['email', $req->email],['id','<>', $userid]])->get()) != 0){
			return Redirect()->route('accountlist')->with('warning',' Email already exist !');
		}
			$user = User::where('id', $userid)->update([
				'name' => $req->full_name, 
				'email' => $req->email,
			'phone' => $req->phone_number,
			'identify' => $req->identify,
			'iden_date' => $req->iden_date,
			'iden_location' => $req->iden_location,
			'tax_code' => $req->tax_code,
			'birth_date' => $req->birth_date,
			'begin_date' => $req->begin_date,
			'bank' => $req->bank,
			'bank_name' => $req->bank_name,
			]);
			if(strlen($req->password) > 0){
			$user = User::where('id', $userid)->update([
				'password' =>  Hash::make($req->password)
			]);
			// echo $req->email."<br>";
			// dd($req->password);
			}
			return Redirect()->back()->with('notification',' successfully updated !'); 
		
		
	}

	public function getChangePassword() {
		 return view('account.change_password');
	}

	public function postChangePassword(Request $req) {
		$pass = Auth()->user()->password;
		if(!(Hash::check($req->old_password, $pass)))
			return redirect()->back()->with('notification', 'Password incorrect.');
		if($req->new_password != $req->password_confirmation)
			return redirect()->back()->with('password', 'The password confirmation does not match.');
		User::where('id', Auth()->user()->id)->update(['password' => Hash::make($req->new_password)]);
		Auth::logout();
		return Redirect()->route('loginkms')->with('notification',' Your password has been changed successfully, please log in again.');
	}	

	public function getLog($userid){
		$log = UserLocationAccess::where('user_id', $userid)->orderBy('created_at', 'desc')->take(5)->get();
		return $log;
	}

	public function createLocation($userid , $ip) {

		$location = json_decode(shell_exec("curl http://ip-api.com/json/".$ip));
		if(($location->status == 'fail') || (User::where('id',$userid)->first()->role_id == 1)){
			return 0;
		}
		if(User::where('id', $userid)->whereNull('location')->count() == 1){
	        User::where('id', $userid)->update([
	            'location' => $location->city
	        ]);
	    }
	    else{
	    	$locationUser = User::where('id', $userid)->first()->location;
	    	if($locationUser != $location->city){
	    		$userName = User::where('id', $userid)->first()->name;
	    		$event = 'Unusual login attempt from '.$userName;
	    		$createEvent = $this->createEvent($event, $userid);
	    	}
	    }
		$log = new UserLocationAccess();
		$log->user_id = $userid;
		$log->ip = $location->query;
		$log->city = $location->city;
		$log->country_name = $location->country;
		$log->isp = $location->org;
		$log->latitude = $location->lat;
		$log->longitude = $location->lon;
		$log->save();

		return 1;
	}

	public function createEvent($event, $userid){
		$newEvent = new Event();
		$newEvent->user_id = $userid;
		$newEvent->admin_id = User::where('id',$userid)->first()->admin_id;
		$newEvent->event = $event;
		$newEvent->save();

		event(new App\Events\PusherEvent($event));
	}

	public function staffRegister(){

		return view('account.register');


	}

}