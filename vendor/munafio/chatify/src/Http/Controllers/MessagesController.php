<?php

namespace Chatify\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Chatify\Http\Models\Message;
use Chatify\Http\Models\Favorite;
use Chatify\Facades\ChatifyMessenger as Chatify;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use DB;


use App\Consumer;
use App\Consumer2;


use Carbon\Carbon;

class MessagesController extends Controller
{
  function sendMessage($mess,$role_id,$user_id) {
    // print($user_id);
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
    // print("\nJSON sent:\n");
    // print($fields);

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

    /**
     * Authinticate the connection for pusher
     *
     * @param Request $request
     * @return void
     */
    public function pusherAuth(Request $request)
    {
        // Auth data
        if(Auth::check()){
            $authData = json_encode([
                'user_id' => Auth::user()->id,
                'user_info' => [
                    'name' => Auth::user()->name
                ]
            ]);
        }else{
          $authData = json_encode([
            'user_id' => $_COOKIE['guest_id']*-1,
            'user_info' => [
                'name' => "guest"
            ]
        ]);
      }
        // check if user authorized
        // if (Auth::check()) {
      return Chatify::pusherAuth(
        $request['channel_name'],
        $request['socket_id'],
        $authData
    );
        // }
        // if not authorized
      return new Response('Unauthorized', 401);
  }

    /**
     * Returning the view of the app with the required data.
     *
     * @param int $id
     * @return void
     */
    public function index($id = null)
    {
        // get current route
        $route = (in_array(\Request::route()->getName(), ['user', config('chatify.path')]))
        ? 'user'
        : \Request::route()->getName();

        // prepare id
        return view('Chatify::pages.app', [
            'id' => ($id == null) ? 0 : $route . '_' . $id,
            'route' => $route,
            'messengerColor' => Auth::user()->messenger_color,
            // 'dark_mode' => Auth::user()->dark_mode < 1 ? 'light' : 'dark',
            'dark_mode' => 'dark',
        ]);
    }

    public function schedule($id = null)
    {
        // dd($_COOKIE['mess_flag']);
            // setcookie("mess_flag", 0, time()+3600*24, "/", false);
        DB::table('job_noti')->where("job_id",$id)
        ->where("user_id",Auth()->user()->id)->update(["seen"=>1]);

        // dd("1242141");
        $schedule = DB::table("schedule")
        ->leftJoin('schedule_user', 'schedule_user.schedule_id', '=', 'schedule.id')
        ->leftJoin('users', 'users.id', '=', 'schedule_user.user_id')
        ->select("schedule.id as id",
            "schedule.last_id as last_id",
            "schedule.user_id as user_id","schedule.title as title","schedule.content as content","schedule.status as status"
            ,"schedule.start_date as start_date","schedule.end_date as end_date")
                    // ->select(DB::raw("count(users.id)"))
        ->groupBy('schedule.id')
        ->where("schedule.id", $id)->first();

        $files = DB::table("schedule_file")  ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
        ->select("schedule_file.id as id",
            "schedule_file.user_id as user_id",
            "schedule_file.title as title",
            "schedule_file.type as type",
            "schedule_file.url as url",
            "schedule_file.created_at as time",
            "users.name as uname")

        ->where("schedule_id",$id)->get();


        // get current route
        $route = (in_array(\Request::route()->getName(), ['user', config('chatify.path')]))
        ? 'user'
        : \Request::route()->getName();

        // prepare id
        return view('Chatify::schedule.app', [
            'id' => ($id == null) ? 0 : $route . '_' . $id,
            'route' => $route,
            'messengerColor' => "",
            'dark_mode' => 'light',
            'schedule' => $schedule,
            'files' => $files

        ]);
    }
    function scheduleForGuest($token = null){
        try{
         $id =  DB::table("schedule")->where("token",$token)->first()->id;

         if (Auth::check()) {
             DB::table('job_noti')->where("job_id",$id)
             ->where("user_id",Auth()->user()->id)->update(["seen"=>1]);

        // dd("1242141");
             $schedule = DB::table("schedule")
             ->leftJoin('schedule_user', 'schedule_user.schedule_id', '=', 'schedule.id')
             ->leftJoin('users', 'users.id', '=', 'schedule_user.user_id')
             ->select("schedule.id as id",
                "schedule.last_id as last_id",
                "schedule.user_id as user_id","schedule.title as title","schedule.content as content","schedule.status as status"
                ,"schedule.start_date as start_date","schedule.end_date as end_date")
                    // ->select(DB::raw("count(users.id)"))
             ->groupBy('schedule.id')
             ->where("schedule.id", $id)->first();

             $files = DB::table("schedule_file")  ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
             ->select("schedule_file.id as id",
                "schedule_file.user_id as user_id",
                "schedule_file.title as title",
                "schedule_file.type as type",
                "schedule_file.url as url",
                "schedule_file.created_at as time",
                "users.name as uname")

             ->where("schedule_id",$id)->get();


        // get current route
             $route = (in_array(\Request::route()->getName(), ['user', config('chatify.path')]))
             ? 'user'
             : \Request::route()->getName();

        // prepare id
             return view('Chatify::schedule.app', [
                'id' => ($id == null) ? 0 : $route . '_' . $id,
                'route' => $route,
                'messengerColor' => "",
                'dark_mode' => 'light',
                'schedule' => $schedule,
                'files' => $files

            ]);
         }

            // dd($id);
     }catch (\Exception $e){
        return redirect("/");
    }
    if(Auth::user()) {  
        $this->schedule($id);
    }
    $schedule = DB::table("schedule")
    ->leftJoin('schedule_user', 'schedule_user.schedule_id', '=', 'schedule.id')
    ->leftJoin('users', 'users.id', '=', 'schedule_user.user_id')
    ->select("schedule.id as id",
        "schedule.last_id as last_id",
        "schedule.user_id as user_id","schedule.title as title","schedule.content as content","schedule.status as status"
        ,"schedule.start_date as start_date","schedule.end_date as end_date")
                    // ->select(DB::raw("count(users.id)"))
    ->groupBy('schedule.id')
    ->where("schedule.id", $id)->first();

    $files = DB::table("schedule_file")  ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
    ->select("schedule_file.id as id",
        "schedule_file.user_id as user_id",
        "schedule_file.title as title",
        "schedule_file.type as type",
        "schedule_file.url as url",
        "schedule_file.created_at as time",
        "users.name as uname")

    ->where("schedule_id",$id)->get();


        // get current route
    $route = (in_array(\Request::route()->getName(), ['user', config('chatify.path')]))
    ? 'user'
    : \Request::route()->getName();

        // prepare id
    return view('Chatify::guest.app', [
        'id' => ($id == null) ? 0 : $route . '_' . $id,
        'route' => $route,
        'messengerColor' => "",
        'dark_mode' => 'light',
        'schedule' => $schedule,
        'files' => $files

    ]);
}
    /**
     * Fetch data by id for (user/group)
     *
     * @param Request $request
     * @return collection
     */
    public function idFetchData(Request $request)
    {
        // Favorite
        if ($request['type'] == 'user') { 
            $thread = "";
            $favorite = Chatify::inFavorite($request['id']);

        // User data
            $fetch = User::where('id', $request['id'])->first();
            $avatar = $fetch->avatar;
        }elseif($request['type'] == 'thread') {
        // dd($request['type']);
         $fetch = DB::table("schedule_thread_user")->where("thread_id",$request['id'])
         ->orderBy('id', 'ASC')->first();
            // dd($request['id']);
         $thread = DB::table("schedule_threads")->where("id",$request['id'])->first();
         $avatar = $thread->url;
         $favorite = false;
     }else{
        $fetch = DB::table("participants")->where("thread_id",$request['id'])
        ->orderBy('id', 'ASC')->first();
            // dd($request['id']);
        $thread = DB::table("threads")->where("id",$request['id'])->first();
        $avatar = $thread->url;
        $favorite = false;
    }

        // send the response
    return Response::json([
        'thread'=>$thread,
        'favorite' => $favorite,
        'fetch' => $fetch,
        'user_avatar' => $avatar,
    ]);
}

    /**
     * This method to make a links for the attachments
     * to be downloadable.
     *
     * @param string $fileName
     * @return void
     */
    public function download($fileName)
    {
        $path = storage_path() . '/app/public/' . config('chatify.attachments.folder') . '/' . $fileName;
        if (file_exists($path)) {
            return Response::download($path, $fileName);
        } else {
            return abort(404, "Sorry, File does not exist in our server or may have been deleted!");
        }
    }

    public function tran(Request $request)
    {   
        if ($request->type = "user"){
            $mess = DB::table("messages")->where("id",$request->id)->first();
        }else{
            $mess = DB::table("old_messages")->where("id",$request->id)->first();
        }
        // dd($mess);
        // default variables
        $error_msg = $attachment = $attachment_title = null;

        if (!$error_msg) {
            // send to database
            if($request->recipients !==null && count($request->recipients) > 0){
                $recipients = $request->recipients;
                foreach ($recipients as $user) {
                    $messageID = mt_rand(9, 999999999) + time()+$user;
                    Chatify::newMessage([
                        'id' => $messageID,
                        'type' => $mess->type,
                        'from_id' => Auth::user()->id,
                        'to_id' => $user,
                        'body' => $mess->body,
                        'attachment' => $mess->attachment,
                    ]);


                    $messageData = Chatify::fetchMessage($messageID);

                    Chatify::push('private-chatify', 'messaging', [
                        'type' => "user",
                        'from_id' => Auth::user()->id,
                        'to_id' => $user,
                        'message' => Chatify::messageCard($messageData, 'default')
                    ]);

                }


            // fetch message to send it with the response
                $messageData = Chatify::fetchMessage($messageID);
                $response = $this->sendMessage(Auth::user()->name.": ".$request['message'],0,$request['id']);

            // dd("????");

            // send to user using pusher
            }
            // dd($request->group);
            if($request->groups !==null && count($request->groups) > 0){

                $groups = $request->groups;
                foreach ($groups as $group) {
                   $messageID =  DB::table("old_messages")->insertGetId([
                    'user_id' => Auth::user()->id,
                    'thread_id' => $group,
                    'body' => $mess->body,
                    'attachment' => $mess->attachment,
                ]);
            // send to user using pusher
                   $messageData = Chatify::fetchMessageForGroup($messageID);
                   Chatify::push('private-chatify', 'messaging', [
                    'type' => "group",
                    'from_id' => Auth::user()->id,
                    'to_id' => $group,
                    'message' => Chatify::messageCard($messageData, 'default')
                ]);


               }

           }

       } 
       return redirect('/chatify');
   }

    /**
     * Send a message to database
     *
     * @param Request $request
     * @return JSON response
     */

    public function sendGuest(Request $request)
    {
        setcookie("mess_flag", 1, time()+3600*24, "/", false);
        // default variables
        $error_msg = $attachment = $attachment_title = null;
        // if there is attachment [file]
        if ($request->hasFile('file')) {
            // allowed extensions
            $allowed_images = Chatify::getAllowedImages();
            $allowed_files  = Chatify::getAllowedFiles();
            $allowed        = array_merge($allowed_images, $allowed_files);

            $file = $request->file('file');
            // if size less than 150MB
            if ($file->getSize() < 150000000) {
                if (in_array($file->getClientOriginalExtension(), $allowed)) {
                    // get attachment name
                    $attachment_title = $file->getClientOriginalName();
                    // upload attachment and store the new name
                    $attachment = Str::uuid() . "." . $file->getClientOriginalExtension();
                    $file->storeAs("public/" . config('chatify.attachments.folder'), $attachment);
                } else {
                    $error_msg = "File extension not allowed!";
                }
            } else {
                $error_msg = "File size is too long!";
            }
        }

        if (!$error_msg) {
            // send to database
            if($request->type == "schedule"){
            // dd($_COOKIE['guest_id']);
              $messageID =  DB::table("schedule_messages")->insertGetId([
                'user_id' => $_COOKIE['guest_id']*-1,
                'schedule_id' => $request['id'],
                'body' => trim(htmlentities($request['message'])),
                'attachment' => ($attachment) ? $attachment . ',' . $attachment_title : null,
            ]);

              $startDate = Carbon::now()->subMinutes(30);
              DB::table('job_noti')->where("job_id", $request['id'])->where("created_at","<",$startDate)->delete();
              $count =  DB::table('job_noti')->where("job_id", $request['id'])->count(); 
              $messageData = Chatify::fetchMessageForSchedule($messageID);
              $humans =  DB::table("schedule_user")->where("schedule_id",$request['id'])->get();

              if (Auth::check()) {
                 $auth_id = Auth::user()->id;
             }else{
                $auth_id  = $_COOKIE['guest_id'];

            }
            if($count == 0){

                foreach ($humans as $human) {
                    if($human->user_id !=$auth_id){
                     DB::table('job_noti')->insert([
                      'job_id' => $request['id'],
                      'user_id' => $human->user_id
                  ]);
                 }

             }
         }

            // send to user using pusher
         Chatify::push('private-chatify', 'messaging', [
            'type' => "schedule",
            'from_id' => $_COOKIE['guest_id']*-1,
            'to_id' => $request['id'],
            'message' => Chatify::messageCard($messageData, 'default')
        ]);


     }elseif($request->type == "thread"){
// dd($request->type);
    // print((int)$request['id']);
    // dd(DB::table("schedule_threads")->where("id",">",0)->first());
        $noti_id = DB::table("schedule_threads")->where("id",$request['id'])->first()->schedule_id;
        $messageID =  DB::table("schedule_sub_messages")->insertGetId([
            'user_id' => $_COOKIE['guest_id']*-1,
            'messages_id' => $request['id'],
            'body' => trim(htmlentities($request['message'])),
            'attachment' => ($attachment) ? $attachment . ',' . $attachment_title : null,
        ]);
        $startDate = Carbon::now()->subMinutes(30);
        DB::table('job_noti')->where("job_id", $request['id'])->where("created_at","<",$startDate)->delete();
        $count =  DB::table('job_noti')->where("job_id", $request['id'])->count(); 
        // dd($messageID );
        $messageData = Chatify::fetchMessageForThread($messageID);
        $humans =  DB::table("schedule_user")->where("schedule_id",$request['id'])->get();
        foreach ($humans as $human) {


            if (Auth::check()) {
             $auth_id = Auth::user()->id;
         }else{
            $auth_id  = $_COOKIE['guest_id'];

        }       
        if($count == 0){
            if($human->user_id != $auth_id ){
             DB::table('job_noti')->insert([
              'job_id' => $noti_id,
              'user_id' => $human->user_id
          ]);
         }
     }

 }
            // send to user using pusher
 Chatify::push('private-chatify', 'messaging', [
    'type' => "thread",
    'from_id' => $_COOKIE['guest_id']*-1,
    'to_id' => $request['id'],
    'message' => Chatify::messageCard($messageData, 'default')
]);


} 

        // send the response



}
return Response::json([
    'status' => '200',
    'error' => $error_msg ? 1 : 0,
    'error_msg' => $error_msg,
    'message' => Chatify::messageCard(@$messageData),
    'tempID' => $request['temporaryMsgId'],
]);
}


public function sendSale(Request $request)
{
    setcookie("mess_flag", 1, time()+3600*24, "/", false);
    $error_msg = $attachment = $attachment_title = null;

        // if there is attachment [file]
    if ($request->hasFile('file')) {
            // allowed extensions
        $allowed_images = Chatify::getAllowedImages();
        $allowed_files  = Chatify::getAllowedFiles();
        $allowed        = array_merge($allowed_images, $allowed_files);
        $files = $request->file;

        foreach($files as $file){
            // $file = $request->file('file');
            // if size less than 150MB
            if ($file->getSize() < 150000000) {
                if (in_array($file->getClientOriginalExtension(), $allowed)) {
                    // get attachment name
                    $attachment_title = $file->getClientOriginalName();
                    // upload attachment and store the new name
                    $attachment = Str::uuid() . "." . $file->getClientOriginalExtension();
                    $file->storeAs("public/" . config('chatify.attachments.folder'), $attachment);
                } else {
                    $error_msg = "File extension not allowed!";
                }
            } else {
                $error_msg = "File size is too long!";
            }

            if (!$error_msg) {
                $messageID =  DB::table("zone_messages")->insertGetId([
                    'user_id' => Auth::user()->id,
                    'zone_id' => $request['id'],
                    'body' => $request['message'],
                    'attachment' => ($attachment) ? $attachment . ',' . $attachment_title : null,
                ]);
                $startDate = Carbon::now()->subMinutes(30);
                DB::table('zone_noti')->where("zone_id", $request['id'])->where("created_at","<",$startDate)->delete();
                $count =  DB::table('zone_noti')->where("zone_id", $request['id'])->count(); 

                $messageData = Chatify::fetchMessageForSale($messageID);

    // $roles = DB::table("roles")->whereIn("department_id",[6,10])->pluck('id')->toArray();

                $lead = DB::table("user_department")
                ->leftJoin("department","department.id","user_department.department_id")
                ->where("department.mid",0)
                ->distinct()->pluck("user_department.user_id")->toArray();



                if($count == 0){
                    foreach ($lead as $lid) {
                        if($lid ==Auth::user()->id){
                            continue;
                        }

                        DB::table('zone_noti')->insert([
                          'zone_id' => $request['id'],
                          'user_id' => $lid
                      ]);

                    }
                }
            // send to user using pusher
                Chatify::push('private-chatify', 'messaging', [
                    'type' => "sale",
                    'from_id' => Auth::user()->id,
                    'to_id' => $request['id'],
                    'message' => Chatify::messageCardSale($messageData, 'default')
                ]);


            }
        }
    }else{
     $messageID =  DB::table("zone_messages")->insertGetId([
        'user_id' => Auth::user()->id,
        'zone_id' => $request['id'],
        'body' => $request['message'],
        'attachment' => null,
    ]);
     $startDate = Carbon::now()->subMinutes(30);
     DB::table('zone_noti')->where("zone_id", $request['id'])->where("created_at","<",$startDate)->delete();
     $count =  DB::table('zone_noti')->where("zone_id", $request['id'])->count(); 

     $messageData = Chatify::fetchMessageForSale($messageID);
//             $humans =  DB::table("zone_noti")->where("zone_id",$request['id'])->get();
//             if($count == 0){
//             foreach ($humans as $human) {
//                 if($human->user_id !=Auth::user()->id){
//  DB::table('zone_noti')->insert([
//                   'zone_id' => $request['id'],
//                   'user_id' => $human->user_id
//               ]);
//                 }
//             }
// }
    // $roles = DB::table("roles")->whereIn("department_id",[6,10])->pluck('id')->toArray();

     $lead = DB::table("user_department")
     ->leftJoin("department","department.id","user_department.department_id")
     ->where("department.mid",0)
     ->distinct()->pluck("user_department.user_id")->toArray();


     $sids =  DB::table("schedule_user")->where("schedule_id",$request['id'])->pluck('user_id')->toArray();

     if($count == 0){
        foreach ($lead as $lid) {
         if($sids != null){
            if (in_array($lid, $sids)) {
                continue;
            }
        }
        if($lid ==Auth::user()->id){
            continue;
        }

        DB::table('zone_noti')->insert([
          'zone_id' => $request['id'],
          'user_id' => $lid
      ]);

    }
}
            // send to user using pusher
Chatify::push('private-chatify', 'messaging', [
    'type' => "sale",
    'from_id' => Auth::user()->id,
    'to_id' => $request['id'],
    'message' => Chatify::messageCardSale($messageData, 'default')
]);
}

return Response::json([
    'status' => '200',
    'error' => $error_msg ? 1 : 0,
    'error_msg' => $error_msg,
    'message' => Chatify::messageCardSale(@$messageData),
    'tempID' => $request['temporaryMsgId'],
]);

}



public function sendBuild(Request $request)
{
        // dd("123123");
    setcookie("mess_flag", 1, time()+3600*24, "/", false);
    $error_msg = $attachment = $attachment_title = null;

        // if there is attachment [file]
    if ($request->hasFile('file')) {
            // allowed extensions
        $allowed_images = Chatify::getAllowedImages();
        $allowed_files  = Chatify::getAllowedFiles();
        $allowed        = array_merge($allowed_images, $allowed_files);
        $files = $request->file;

        foreach($files as $file){
            // $file = $request->file('file');
            // if size less than 150MB
            if ($file->getSize() < 1500000000) {
                if (in_array($file->getClientOriginalExtension(), $allowed)) {
                    // get attachment name
                    $attachment_title = $file->getClientOriginalName();
                    // upload attachment and store the new name
                    $attachment = Str::uuid() . "." . $file->getClientOriginalExtension();
                    $file->storeAs("public/" . config('chatify.attachments.folder'), $attachment);
                } else {
                    $error_msg = "File extension not allowed!";
                }
            } else {
                $error_msg = "File size is too long!";
            }

            if (!$error_msg) {
            // dd("123123");
                $messageID =  DB::table("building_messages")->insertGetId([
                    'user_id' => Auth::user()->id,
                    'building_id' => $request['id'],
                    'body' => $request['message'],
                    'attachment' => ($attachment) ? $attachment . ',' . $attachment_title : null,
                ]);
                $startDate = Carbon::now()->subMinutes(30);
                DB::table('build_noti')->where("building_id", $request['id'])->where("created_at","<",$startDate)->delete();
                $count =  DB::table('build_noti')->where("building_id", $request['id'])->count(); 
dd($count);
                $messageData = Chatify::fetchMessageForBuild($messageID);

    // $roles = DB::table("roles")->whereIn("department_id",[6,10])->pluck('id')->toArray();

                $lead = DB::table("user_department")
                ->leftJoin("department","department.id","user_department.department_id")
                ->where("department.mid",0)
                ->distinct()->pluck("user_department.user_id")->toArray();


                if($count == 0){
                    foreach ($lead as $lid) {
    // if($lid ==Auth::user()->id){
    //         continue;
    // }

                      DB::table('build_noti')->insert([
                          'building_id' => $request['id'],
                          'user_id' => $lid
                      ]);

                  }
              }
            // send to user using pusher
              Chatify::push('private-chatify', 'messaging', [
                'type' => "build",
                'from_id' => Auth::user()->id,
                'to_id' => $request['id'],
                'message' => Chatify::messageCardBuild($messageData, 'default')
            ]);


          }
      }
  }else{
     $messageID =  DB::table("building_messages")->insertGetId([
        'user_id' => Auth::user()->id,
        'building_id' => $request['id'],
        'body' => $request['message'],
        'attachment' => null,
    ]);
     $startDate = Carbon::now()->subMinutes(30);
     DB::table('build_noti')->where("building_id", $request['id'])->where("created_at","<",$startDate)->delete();
     $count =  DB::table('build_noti')->where("building_id", $request['id'])->count(); 

     $startDate = Carbon::now()->subMinutes(30);
     DB::table('build_noti')->where("building_id", $request['id'])->where("created_at","<",$startDate)->delete();
     $count =  DB::table('build_noti')->where("building_id", $request['id'])->count(); 

     $messageData = Chatify::fetchMessageForBuild($messageID);

    // $roles = DB::table("roles")->whereIn("department_id",[6,10])->pluck('id')->toArray();

     $lead = DB::table("user_department")
     ->leftJoin("department","department.id","user_department.department_id")
     ->where("department.mid",0)
     ->distinct()->pluck("user_department.user_id")->toArray();


     if($count == 0){
        foreach ($lead as $lid) {
    // if($lid ==Auth::user()->id){
    //         continue;
    // }

          DB::table('build_noti')->insert([
              'building_id' => $request['id'],
              'user_id' => $lid
          ]);

      }
  }

  $messageData = Chatify::fetchMessageForBuild($messageID);
//             $humans =  DB::table("zone_noti")->where("zone_id",$request['id'])->get();
//             if($count == 0){
//             foreach ($humans as $human) {
//                 if($human->user_id !=Auth::user()->id){
//  DB::table('zone_noti')->insert([
//                   'zone_id' => $request['id'],
//                   'user_id' => $human->user_id
//               ]);
//                 }
//             }
// }
    // $roles = DB::table("roles")->whereIn("department_id",[6,10])->pluck('id')->toArray();

  $lead = DB::table("user_department")
  ->leftJoin("department","department.id","user_department.department_id")
  ->where("department.mid",0)
  ->distinct()->pluck("user_department.user_id")->toArray();


//     $sids =  DB::table("schedule_user")->where("schedule_id",$request['id'])->pluck('user_id')->toArray();

// if($count == 0){
//     foreach ($lead as $lid) {
//              if($sids != null){
//         if (in_array($lid, $sids)) {
//             continue;
//         }
//     }
//     if($lid ==Auth::user()->id){
//             continue;
//     }

//           DB::table('building_id')->insert([
//           'zone_id' => $request['id'],
//           'building_id' => $lid
//       ]);

//       }
//   }
            // send to user using pusher
  Chatify::push('private-chatify', 'messaging', [
    'type' => "build",
    'from_id' => Auth::user()->id,
    'to_id' => $request['id'],
    'message' => Chatify::messageCardBuild($messageData, 'default')
]);
}

return Response::json([
    'status' => '200',
    'error' => $error_msg ? 1 : 0,
    'error_msg' => $error_msg,
    'message' => Chatify::messageCardBuild(@$messageData),
    'tempID' => $request['temporaryMsgId'],
]);

}
public function sendCalender(Request $request)
{
    // dd($request['id']);
        // dd("123123");
    setcookie("mess_flag", 1, time()+3600*24, "/", false);
    $error_msg = $attachment = $attachment_title = null;
        // if there is attachment [file]
    if ($request->hasFile('file')) {
            // allowed extensions
        $allowed_images = Chatify::getAllowedImages();
        $allowed_files  = Chatify::getAllowedFiles();
        $allowed        = array_merge($allowed_images, $allowed_files);
        $files = $request->file;

        foreach($files as $file){
            // $file = $request->file('file');
            // if size less than 150MB
            if ($file->getSize() < 1500000000) {
                if (in_array($file->getClientOriginalExtension(), $allowed)) {
                    // get attachment name
                    $attachment_title = $file->getClientOriginalName();
                    // upload attachment and store the new name
                    $attachment = Str::uuid() . "." . $file->getClientOriginalExtension();
                    $file->storeAs("public/" . config('chatify.attachments.folder'), $attachment);
                } else {
                    $error_msg = "File extension not allowed!";
                }
            } else {
                $error_msg = "File size is too long!";
            }
// dd($error_msg);
            if (!$error_msg) {
            // dd("123123");
    // dd($request->file);
                $messageID =  DB::table("calender_messages")->insertGetId([
                    'user_id' => Auth::user()->id,
                    'calender_id' => $request['id'],
                    'body' => $request['message'],
                    'attachment' => ($attachment) ? $attachment . ',' . $attachment_title : null,
                ]);

                $startDate = Carbon::now()->subMinutes(30);
                

                $messageData = Chatify::fetchMessageForCalender($messageID);

    // $roles = DB::table("roles")->whereIn("department_id",[6,10])->pluck('id')->toArray();

                $lead = DB::table("user_department")
                ->leftJoin("department","department.id","user_department.department_id")
                ->where("department.mid",0)
                ->distinct()->pluck("user_department.user_id")->toArray();


                if($count == 0){
                    foreach ($lead as $lid) {
    // if($lid ==Auth::user()->id){
    //         continue;
    // }


                  }
              }
            // send to user using pusher
              Chatify::push('private-chatify', 'messaging', [
                'type' => "calender",
                'from_id' => Auth::user()->id,
                'to_id' => $request['id'],
                'message' => Chatify::messageCardCalender($messageData, 'default')
            ]);


          }
      }
  }else{
     $messageID =  DB::table("calender_messages")->insertGetId([
        'user_id' => Auth::user()->id,
        'calender_id' => $request['id'],
        'body' => $request['message'],
        'attachment' => null,
    ]);


    // $roles = DB::table("roles")->whereIn("department_id",[6,10])->pluck('id')->toArray();

     $lead = DB::table("user_department")
     ->leftJoin("department","department.id","user_department.department_id")
     ->where("department.mid",0)
     ->distinct()->pluck("user_department.user_id")->toArray();


  $messageData = Chatify::fetchMessageForCalender($messageID);
  // dd($messageData);
//             $humans =  DB::table("zone_noti")->where("zone_id",$request['id'])->get();
//             if($count == 0){
//             foreach ($humans as $human) {
//                 if($human->user_id !=Auth::user()->id){
//  DB::table('zone_noti')->insert([
//                   'zone_id' => $request['id'],
//                   'user_id' => $human->user_id
//               ]);
//                 }
//             }
// }
    // $roles = DB::table("roles")->whereIn("department_id",[6,10])->pluck('id')->toArray();

  $lead = DB::table("user_department")
  ->leftJoin("department","department.id","user_department.department_id")
  ->where("department.mid",0)
  ->distinct()->pluck("user_department.user_id")->toArray();


//     $sids =  DB::table("schedule_user")->where("schedule_id",$request['id'])->pluck('user_id')->toArray();

// if($count == 0){
//     foreach ($lead as $lid) {
//              if($sids != null){
//         if (in_array($lid, $sids)) {
//             continue;
//         }
//     }
//     if($lid ==Auth::user()->id){
//             continue;
//     }

//           DB::table('building_id')->insert([
//           'zone_id' => $request['id'],
//           'building_id' => $lid
//       ]);

//       }
//   }
            // send to user using pusher
  Chatify::push('private-chatify', 'messaging', [
    'type' => "calender",
    'from_id' => Auth::user()->id,
    'to_id' => $request['id'],
    'message' => Chatify::messageCardCalender($messageData, 'default')
]);
}

return Response::json([
    'status' => '200',
    'error' => $error_msg ? 1 : 0,
    'error_msg' => $error_msg,
    'message' => Chatify::messageCardCalender(@$messageData),
    'tempID' => $request['temporaryMsgId'],
]);

}
public function sendConsumer(Request $request)
{
        // dd("123123");
    setcookie("mess_flag", 1, time()+3600*24, "/", false);
    $error_msg = $attachment = $attachment_title = null;

        // if there is attachment [file]
    if ($request->hasFile('file')) {
            // allowed extensions
        $allowed_images = Chatify::getAllowedImages();
        $allowed_files  = Chatify::getAllowedFiles();
        $allowed        = array_merge($allowed_images, $allowed_files);
        $files = $request->file;

        foreach($files as $file){
            // $file = $request->file('file');
            // if size less than 150MB
            if ($file->getSize() < 150000000) {
                if (in_array($file->getClientOriginalExtension(), $allowed)) {
                    // get attachment name
                    $attachment_title = $file->getClientOriginalName();
                    // upload attachment and store the new name
                    $attachment = Str::uuid() . "." . $file->getClientOriginalExtension();
                    $file->storeAs("public/" . config('chatify.attachments.folder'), $attachment);
                } else {
                    $error_msg = "File extension not allowed!";
                }
            } else {
                $error_msg = "File size is too long!";
            }

            if (!$error_msg) {
            // dd("123123");
                $messageID =  DB::table("consumer_messages")->insertGetId([
                    'user_id' => Auth::user()->id,
                    'consumer_id' => $request['id'],
                    'body' => $request['message'],
                    'attachment' => ($attachment) ? $attachment . ',' . $attachment_title : null,
                ]);
                $startDate = Carbon::now()->subMinutes(30);
                DB::table('consumer_noti')->where("consumer_id", $request['id'])->where("created_at","<",$startDate)->delete();
                $count =  DB::table('consumer_noti')->where("consumer_id", $request['id'])->count(); 

                $messageData = Chatify::fetchMessageForBuild($messageID);

    // $roles = DB::table("roles")->whereIn("department_id",[6,10])->pluck('id')->toArray();

                $lead = DB::table("user_department")
                ->leftJoin("department","department.id","user_department.department_id")
                ->where("department.mid",0)
                ->distinct()->pluck("user_department.user_id")->toArray();


            // send to user using pusher
              Chatify::push('private-chatify', 'messaging', [
                'type' => "consumer",
                'from_id' => Auth::user()->id,
                'to_id' => $request['id'],
                'message' => Chatify::messageCardBuild($messageData, 'default')
            ]);


          }
      }
  }else{
     $messageID =  DB::table("consumer_messages")->insertGetId([
        'user_id' => Auth::user()->id,
        'consumer_id' => $request['id'],
        'body' => $request['message'],
        'attachment' => null,
    ]);

     $startDate = Carbon::now()->subMinutes(30);
     DB::table('consumer_noti')->where("consumer_id", $request['id'])->where("created_at","<",$startDate)->delete();
     $count =  DB::table('consumer_noti')->where("consumer_id", $request['id'])->count(); 

     $messageData = Chatify::fetchMessageForConsumer($messageID);

    // $roles = DB::table("roles")->whereIn("department_id",[6,10])->pluck('id')->toArray();

     $lead = DB::table("user_department")
     ->leftJoin("department","department.id","user_department.department_id")
     ->where("department.mid",0)
     ->distinct()->pluck("user_department.user_id")->toArray();

     if($count == 0){
        foreach ($lead as $lid) {

          DB::table('consumer_noti')->insert([
              'consumer_id' => $request['id'],
              'user_id' => $lid
          ]);

      }
  }

  $messageData = Chatify::fetchMessageForConsumer($messageID);

            // send to user using pusher
  Chatify::push('private-chatify', 'messaging', [
    'type' => "consumer",
    'from_id' => Auth::user()->id,
    'to_id' => $request['id'],
    'message' => Chatify::messageCardBuild($messageData, 'default')
]);
}

return Response::json([
    'status' => '200',
    'error' => $error_msg ? 1 : 0,
    'error_msg' => $error_msg,
    'message' => Chatify::messageCardBuild(@$messageData),
    'tempID' => $request['temporaryMsgId'],
]);

}




public function send(Request $request)
{

    setcookie("mess_flag", 1, time()+3600*24, "/", false);
        // default variables
    $error_msg = $attachment = $attachment_title = null;

        // if there is attachment [file]
    if ($request->hasFile('file')) {
            // allowed extensions
        $allowed_images = Chatify::getAllowedImages();
        $allowed_files  = Chatify::getAllowedFiles();
        $allowed        = array_merge($allowed_images, $allowed_files);
        $files = $request->file;

        foreach($files as $file){
            // $file = $request->file('file');
            // if size less than 150MB
            if ($file->getSize() < 150000000) {
                if (in_array($file->getClientOriginalExtension(), $allowed)) {
                    // get attachment name
                    $attachment_title = $file->getClientOriginalName();
                    // upload attachment and store the new name
                    $attachment = Str::uuid() . "." . $file->getClientOriginalExtension();
                    $file->storeAs("public/" . config('chatify.attachments.folder'), $attachment);
                } else {
                    $error_msg = "File extension not allowed!";
                }
            } else {
                $error_msg = "File size is too long!";
            }

            if (!$error_msg) {
            // send to database
                if($request['type'] == 'user'){
                    $messageID = mt_rand(9, 999999999) + time();
                    Chatify::newMessage([
                        'id' => $messageID,
                        'type' => $request['type'],
                        'from_id' => Auth::user()->id,
                        'to_id' => $request['id'],
                        'body' => trim(htmlentities($request['message'])),
                        'attachment' => ($attachment) ? $attachment . ',' . $attachment_title : null,
                    ]);


            // fetch message to send it with the response
                    $messageData = Chatify::fetchMessage($messageID);

                    $response = $this->sendMessage(Auth::user()->name.": ".$request['message'],0,$request['id']);

            // dd("????");

            // send to user using pusher
                    Chatify::push('private-chatify', 'messaging', [
                        'type' => "user",
                        'from_id' => Auth::user()->id,
                        'to_id' => $request['id'],
                        'message' => Chatify::messageCard($messageData, 'default')
                    ]);
                }
                elseif($request->type == "schedule"){

                  $messageID =  DB::table("schedule_messages")->insertGetId([
                    'user_id' => Auth::user()->id,
                    'schedule_id' => $request['id'],
                    'body' => $request['message'],
                    'attachment' => ($attachment) ? $attachment . ',' . $attachment_title : null,
                ]);
                  $startDate = Carbon::now()->subMinutes(30);
                  DB::table('job_noti')->where("job_id", $request['id'])->where("created_at","<",$startDate)->delete();
                  $count =  DB::table('job_noti')->where("job_id", $request['id'])->count(); 

                  $messageData = Chatify::fetchMessageForSchedule($messageID);
                  $humans =  DB::table("schedule_user")->where("schedule_id",$request['id'])->get();
                  if($count == 0){
                    foreach ($humans as $human) {
                        if($human->user_id !=Auth::user()->id){
                         DB::table('job_noti')->insert([
                          'job_id' => $request['id'],
                          'user_id' => $human->user_id
                      ]);
                     }
                 }
             }
    // $roles = DB::table("roles")->whereIn("department_id",[6,10])->pluck('id')->toArray();

             $lead =  DB::table("user_department")
             ->leftJoin("department","department.id","user_department.department_id")
             ->where("department.mid",0)
             ->distinct()->pluck("user_department.user_id")->toArray();


             $sids =  DB::table("schedule_user")->where("schedule_id",$request['id'])->pluck('user_id')->toArray();

             if($count == 0){
                foreach ($lead as $lid) {
                 if($sids != null){
                    if (in_array($lid, $sids)) {
                        continue;
                    }
                }
                if($lid ==Auth::user()->id){
                    continue;
                }

                DB::table('job_noti')->insert([
                  'job_id' => $request['id'],
                  'user_id' => $lid
              ]);

            }
        }
            // send to user using pusher
        Chatify::push('private-chatify', 'messaging', [
            'type' => "schedule",
            'from_id' => Auth::user()->id,
            'to_id' => $request['id'],
            'message' => Chatify::messageCard($messageData, 'default')
        ]);


    }elseif($request->type == "thread"){
    // print((int)$request['id']);
    // dd(DB::table("schedule_threads")->where("id",">",0)->first());
        $noti_id = DB::table("schedule_threads")->where("id",$request['id'])->first()->schedule_id;
        $messageID =  DB::table("schedule_sub_messages")->insertGetId([
            'user_id' => Auth::user()->id,
            'messages_id' => $request['id'],
            'body' => trim(htmlentities($request['message'])),
            'attachment' => ($attachment) ? $attachment . ',' . $attachment_title : null,
        ]);
        $startDate = Carbon::now()->subMinutes(30);
        DB::table('job_noti')->where("job_id", $request['id'])->where("created_at","<",$startDate)->delete();
        $count =  DB::table('job_noti')->where("job_id", $request['id'])->count(); 
        
        $messageData = Chatify::fetchMessageForThread($messageID);
        $humans =  DB::table("schedule_user")->where("schedule_id",$request['id'])->get();
        if($count == 0){
            foreach ($humans as $human) {
                if($human->user_id !=Auth::user()->id){
                 DB::table('job_noti')->insert([
                  'job_id' => $noti_id,
                  'user_id' => $human->user_id
              ]);
             }
         }
     }
 // $roles = DB::table("roles")->whereIn("department_id",[6,10])->pluck('id')->toArray();

     $lead =  DB::table("user_department")
     ->leftJoin("department","department.id","user_department.department_id")
     ->where("department.mid",0)
     ->distinct()->pluck("user_department.user_id")->toArray();

     $sids =  DB::table("schedule_user")->where("schedule_id",$request['id'])->pluck('user_id')->toArray();

     if($count ==0){
        foreach ($lead as $lid) {
         if($sids != null){
            if (in_array($lid, $sids)) {
                continue;
            }
        }
        if($lid ==Auth::user()->id){
            continue;
        }

        DB::table('job_noti')->insert([
          'job_id' => $noti_id,
          'user_id' => $lid
      ]);

    }
}
            // send to user using pusher
Chatify::push('private-chatify', 'messaging', [
    'type' => "thread",
    'from_id' => Auth::user()->id,
    'to_id' => $request['id'],
    'message' => Chatify::messageCard($messageData, 'default')
]);


} else{
   $messageID =  DB::table("old_messages")->insertGetId([
    'user_id' => Auth::user()->id,
    'thread_id' => $request['id'],
    'body' => trim(htmlentities($request['message'])),
    'attachment' => ($attachment) ? $attachment . ',' . $attachment_title : null,
]);


            // fetch message to send it with the response
   $messageData = Chatify::fetchMessageForGroup($messageID);
   $humans =  DB::table("participants")->where("thread_id",$request['id'])->get();
            // foreach ($humans as $human) {
            //     if($human->user_id != Auth::user()->id){
            //      DB::table('job_noti')->insert([
            //       'job_id' => $schedule_id,
            //       'user_id' => $sid
            //   ]);
            //     }
            // }


            // send to user using pusher
   Chatify::push('private-chatify', 'messaging', [
    'type' => "group",
    'from_id' => Auth::user()->id,
    'to_id' => $request['id'],
    'message' => Chatify::messageCard($messageData, 'default')
]);


}
}
}

}else{
    if(strlen($request['message']) > 0)
      if($request['type'] == 'user'){
        $messageID = mt_rand(9, 999999999) + time();
        Chatify::newMessage([
            'id' => $messageID,
            'type' => $request['type'],
            'from_id' => Auth::user()->id,
            'to_id' => $request['id'],
            'body' => trim(htmlentities($request['message'])),
            'attachment' => ($attachment) ? $attachment . ',' . $attachment_title : null,
        ]);


            // fetch message to send it with the response
        $messageData = Chatify::fetchMessage($messageID);

        $response = $this->sendMessage(Auth::user()->name.": ".$request['message'],0,$request['id']);

            // dd("????");

            // send to user using pusher
        Chatify::push('private-chatify', 'messaging', [
            'type' => "user",
            'from_id' => Auth::user()->id,
            'to_id' => $request['id'],
            'message' => Chatify::messageCard($messageData, 'default')
        ]);
    }
    elseif($request->type == "schedule"){

      $messageID =  DB::table("schedule_messages")->insertGetId([
        'user_id' => Auth::user()->id,
        'schedule_id' => $request['id'],
        'body' => $request['message'],
        'attachment' => null,
    ]);

      $startDate = Carbon::now()->subMinutes(30);
      DB::table('job_noti')->where("job_id", $request['id'])->where("created_at","<",$startDate)->delete();
      $messageData = Chatify::fetchMessageForSchedule($messageID);
      $humans =  DB::table("schedule_user")->where("schedule_id",$request['id'])->get();
      $count = DB::table('job_noti')->where("job_id", $request['id'])->count();
      if($count == 0){
        foreach ($humans as $human) {
            if($human->user_id !=Auth::user()->id){
             DB::table('job_noti')->insert([
              'job_id' => $request['id'],
              'user_id' => $human->user_id
          ]);
         }
     }
 }
    // $roles = DB::table("roles")->whereIn("department_id",[6,10])->pluck('id')->toArray();

 $lead = DB::table("user_department")
 ->leftJoin("department","department.id","user_department.department_id")
 ->where("department.mid",0)
 ->distinct()->pluck("user_department.user_id")->toArray();


 $sids =  DB::table("schedule_user")->where("schedule_id",$request['id'])->pluck('user_id')->toArray();
 if($count == 0){
    foreach ($lead as $lid) {
     if($sids != null){
        if (in_array($lid, $sids)) {
            continue;
        }
    }
    if($lid ==Auth::user()->id){
        continue;
    }
    
    DB::table('job_noti')->insert([
      'job_id' => $request['id'],
      'user_id' => $lid
  ]);

}
}
            // send to user using pusher
Chatify::push('private-chatify', 'messaging', [
    'type' => "schedule",
    'from_id' => Auth::user()->id,
    'to_id' => $request['id'],
    'message' => Chatify::messageCard($messageData, 'default')
]);


}elseif($request->type == "thread"){
    // print((int)$request['id']);
    // dd(DB::table("schedule_threads")->where("id",">",0)->first());
    $noti_id = DB::table("schedule_threads")->where("id",$request['id'])->first()->schedule_id;
    $messageID =  DB::table("schedule_sub_messages")->insertGetId([
        'user_id' => Auth::user()->id,
        'messages_id' => $request['id'],
        'body' => $request['message'],
        'attachment' => null,
    ]);

    $startDate = Carbon::now()->subMinutes(30);
    DB::table('job_noti')->where("job_id", $request['id'])->where("created_at","<",$startDate)->delete();

    $messageData = Chatify::fetchMessageForThread($messageID);
    $humans =  DB::table("schedule_user")->where("schedule_id",$request['id'])->get();

    $count  =  DB::table('job_noti')->where("job_id", $request['id'])->count();
    if($count ==0){
        foreach ($humans as $human) {
            if($human->user_id !=Auth::user()->id){
             DB::table('job_noti')->insert([
              'job_id' => $noti_id,
              'user_id' => $human->user_id
          ]);
         }
     }
 }

 $roles = DB::table("roles")->whereIn("department_id",[6,10])->pluck('id')->toArray();

 $lead = DB::table("user_department")
 ->leftJoin("department","department.id","user_department.department_id")
 ->where("department.mid",0)
 ->distinct()->pluck("user_department.user_id")->toArray();


 $sids =  DB::table("schedule_user")->where("schedule_id",$request['id'])->pluck('user_id')->toArray();
 if($count ==0){
    foreach ($lead as $lid) {
     if($sids != null){
        if (in_array($lid, $sids)) {
            continue;
        }
    }
    if($lid ==Auth::user()->id){
        continue;
    }
    
    DB::table('job_noti')->insert([
      'job_id' => $noti_id,
      'user_id' => $lid
  ]);

}
}
            // send to user using pusher
Chatify::push('private-chatify', 'messaging', [
    'type' => "thread",
    'from_id' => Auth::user()->id,
    'to_id' => $request['id'],
    'attachment' => null,
]);


} else{
   $messageID =  DB::table("old_messages")->insertGetId([
    'user_id' => Auth::user()->id,
    'thread_id' => $request['id'],
    'body' => trim(htmlentities($request['message'])),
    'attachment' => null,
]);


   $messageData = Chatify::fetchMessageForGroup($messageID);
   $humans =  DB::table("participants")->where("thread_id",$request['id'])->get();


            // send to user using pusher
   Chatify::push('private-chatify', 'messaging', [
    'type' => "group",
    'from_id' => Auth::user()->id,
    'to_id' => $request['id'],
    'message' => Chatify::messageCard($messageData, 'default')
]);


}

            // Chatify::push('private-chatify', 'messaging', [
            //     'from_id' => Auth::user()->id,
            //     'to_id' => Auth::user()->id,
            //     'message' => Chatify::messageCard($messageData, 'sender')
            // ]);

}

        // send the response


return Response::json([
    'status' => '200',
    'error' => $error_msg ? 1 : 0,
    'error_msg' => $error_msg,
    'message' => Chatify::messageCard(@$messageData),
    'tempID' => $request['temporaryMsgId'],
]);
}

    /**
     * fetch [user/group] messages from database
     *
     * @param Request $request
     * @return JSON response
     */


    public function fetchSale(Request $request)
    {
        $allMessages = null;
        $query = DB::table("zone_messages")->where("zone_id",$request->id)->orderBy('id', 'asc');
        $messages = $query->get();
        if ($query->count() > 0) {
            foreach ($messages as $message) {
                // echo(Chatify::messageCard(
                    // Chatify::fetchMessageForGroup($message->id)));
                $allMessages .= Chatify::messageCardSale(
                    Chatify::fetchMessageForSale($message->id)
                );

            }
    // dd("hwer");
            // send the response
            return Response::json([
                'count' => $query->count(),
                'messages' => $allMessages,
            ]);
        }

  // send the response
        return Response::json([
            'count' => $query->count(),
            'messages' => '<p class="message-hint"><span>Say \'hi\' and start messaging</span></p>',
        ]);
    }

    public function fetchBuild(Request $request)
    {
        $allMessages = null;
        $query = DB::table("building_messages")->where("building_id",$request->id)->orderBy('id', 'asc');
        $messages = $query->get();
        if ($query->count() > 0) {
            $date = "";
            foreach ($messages as $message) {
                // echo(Chatify::messageCard(
                    // Chatify::fetchMessageForGroup($message->id)));

              $curDate = date('d-m-Y', strtotime($message->created_at));
              if($curDate != $date){
                $date = $curDate;
                $allMessages .= '<div class="chat-date"><div class="start line"></div><span data-translate-inner="STR_DATE_TIME">'.$curDate .'</span><div class="flx"><div class="end line"></div></div></div>';
                    // $allMessages .= "<br>";
            }

            $allMessages .= Chatify::messageCardBuild(
                Chatify::fetchMessageForBuild($message->id)
            );

        }
    // dd("hwer");
            // send the response
        return Response::json([
            'count' => $query->count(),
            'messages' => $allMessages,
        ]);
    }

  // send the response
    return Response::json([
        'count' => $query->count(),
        'messages' => '<p class="message-hint"><span>Say \'hi\' and start messaging</span></p>',
    ]);
}

    public function fetchCalender(Request $request)
    {
        $allMessages = null;
        // dd($request->id);
        $query = DB::table("calender_messages")->where("calender_id",$request->id)->orderBy('id', 'asc');
        $messages = $query->get();
        if ($query->count() > 0) {
            $date = "";
            foreach ($messages as $message) {
            // dd($message->id);
                // echo(Chatify::messageCard(
                    // Chatify::fetchMessageForGroup($message->id)));

              $curDate = date('d-m-Y', strtotime($message->created_at));
              if($curDate != $date){
                $date = $curDate;
                $allMessages .= '<div class="chat-date"><div class="start line"></div><span data-translate-inner="STR_DATE_TIME">'.$curDate .'</span><div class="flx"><div class="end line"></div></div></div>';
                    // $allMessages .= "<br>";
            }
            $allMessages .= Chatify::messageCardCalender(
                Chatify::fetchMessageForCalender($message->id)
            );

        }
    // dd("hwer");
            // send the response
        return Response::json([
            'count' => $query->count(),
            'messages' => $allMessages,
        ]);
    }

  // send the response
    return Response::json([
        'count' => $query->count(),
        'messages' => '<p class="message-hint"><span>Say \'hi\' and start messaging</span></p>',
    ]);
}
public function fetchConsumer(Request $request)
{
    $allMessages = null;
    $query = DB::table("consumer_messages")->where("consumer_id",$request->id)->orderBy('id', 'asc');
    $messages = $query->get();
    if ($query->count() > 0) {
        $date = "";
        foreach ($messages as $message) {
                // echo(Chatify::messageCard(
                    // Chatify::fetchMessageForGroup($message->id)));

          $curDate = date('d-m-Y', strtotime($message->created_at));
          if($curDate != $date){
            $date = $curDate;
            $allMessages .= '<div class="chat-date"><div class="start line"></div><span data-translate-inner="STR_DATE_TIME">'.$curDate .'</span><div class="flx"><div class="end line"></div></div></div>';
                    // $allMessages .= "<br>";
        }

        $allMessages .= Chatify::messageCard(
            Chatify::fetchMessageForConsumer($message->id)
        );

    }
    // dd("hwer");
            // send the response
    return Response::json([
        'count' => $query->count(),
        'messages' => $allMessages,
    ]);
}

  // send the response
return Response::json([
    'count' => $query->count(),
    'messages' => '<p class="message-hint"><span>Say \'hi\' and start messaging</span></p>',
]);
}


public function fetch(Request $request)
{
        // dd($request->type);
        // messages variable
    $allMessages = null;

        // fetch messages
    if($request->type == "user"){
        $query = Chatify::fetchMessagesQuery($request['id'])->orderBy('created_at', 'asc');
        $messages = $query->get();

        // if there is a messages
        if ($query->count() > 0) {
            foreach ($messages as $message) {
                $allMessages .= Chatify::messageCard(
                    Chatify::fetchMessage($message->id)
                );
            }
            // send the response
            return Response::json([
                'count' => $query->count(),
                'messages' => $allMessages,
            ]);
        }
    }

    elseif($request->type == "schedule"){
        $query = DB::table("schedule_messages")->where("schedule_id",$request->id)->orderBy('id', 'asc');
        $messages = $query->get();
        if ($query->count() > 0) {
            $date = "";
            foreach ($messages as $message) {
                // echo(Chatify::messageCard(
                $curDate = date('d-m-Y', strtotime($message->created_at));
                if($curDate != $date){
                    $date = $curDate;
                    $allMessages .= '<div class="chat-date"><div class="start line"></div><span data-translate-inner="STR_DATE_TIME">'.$curDate .'</span><div class="flx"><div class="end line"></div></div></div>';
                    // $allMessages .= "<br>";
                }

                $allMessages .= Chatify::messageCard(
                    Chatify::fetchMessageForSchedule($message->id)
                );

            }
    // dd($allMessages);
            // send the response
            return Response::json([
                'count' => $query->count(),
                'messages' => $allMessages,
            ]);
        }

    }

    elseif($request->type == "thread"){

      $query = DB::table("schedule_sub_messages")->where("messages_id",$request->id)->orderBy('id', 'asc');
      $messages = $query->get();
      if ($query->count() > 0) {
        foreach ($messages as $message) {
                // echo(Chatify::messageCard(
                    // Chatify::fetchMessageForGroup($message->id)));
            $allMessages .= Chatify::messageCard(
                Chatify::fetchMessageForThread($message->id)
            );

        }
    // dd("hwer");
            // send the response
        return Response::json([
            'count' => $query->count(),
            'messages' => $allMessages,
        ]);
    }

}

else{
    $query = DB::table("old_messages")->where("thread_id",$request->id)->orderBy('id', 'asc');
    $messages = $query->get();
    if ($query->count() > 0) {
        foreach ($messages as $message) {
                // echo(Chatify::messageCard(
                    // Chatify::fetchMessageForGroup($message->id)));
            $allMessages .= Chatify::messageCard(
                Chatify::fetchMessageForGroup($message->id)
            );

        }
            // send the response
        return Response::json([
            'count' => $query->count(),
            'messages' => $allMessages,
        ]);
    }

}

if($request->type == "schedule"){
  return Response::json([
    'count' => 1,
    'messages' => '<p class="message-hint"><span>Chưa có tin nhắn, hãy bắt đầu nhắn tin</span></p>',
]);
}
        // send the response
return Response::json([
    'count' => $query->count(),
    'messages' => '<p class="message-hint"><span>Say \'hi\' and start messaging</span></p>',
]);
}
public function fetchGuest(Request $request)
{
        // dd($request->type);
        // messages variable
    $allMessages = null;

        // fetch messages
    if($request->type == "schedule"){
        $query = DB::table("schedule_messages")->where("schedule_id",$request->id)->orderBy('id', 'asc');
        $messages = $query->get();
        if ($query->count() > 0) {
            foreach ($messages as $message) {
                // echo(Chatify::messageCard(
                    // Chatify::fetchMessageForGroup($message->id)));
                $allMessages .= Chatify::messageCard(
                    Chatify::fetchMessageForSchedule($message->id)
                );

            }
    // dd("hwer");
            // send the response
            return Response::json([
                'count' => $query->count(),
                'messages' => $allMessages,
            ]);
        }

    }

    elseif($request->type == "thread"){
        $check = DB::table("schedule_threads")->where("id",$request->id)->where("open",1)->count();
        if($check > 0){
          $query = DB::table("schedule_sub_messages")->where("messages_id",$request->id)
          ->orderBy('id', 'asc');
          $messages = $query->get();
          if ($query->count() > 0) {
            foreach ($messages as $message) {
                // echo(Chatify::messageCard(
                    // Chatify::fetchMessageForGroup($message->id)));
                $allMessages .= Chatify::messageCard(
                    Chatify::fetchMessageForThread($message->id)
                );

            }
    // dd("hwer");
            // send the response
            return Response::json([
                'count' => $query->count(),
                'messages' => $allMessages,
            ]);
        }

    }
}


if($request->type == "schedule"){
  return Response::json([
    'count' => 1,
    'messages' => '<p class="message-hint"><span>Chưa có tin nhắn, hãy bắt đầu nhắn tin</span></p>',
]);
}
        // send the response
return Response::json([
    'count' => $query->count(),
    'messages' => '<p class="message-hint"><span>Say \'hi\' and start messaging</span></p>',
]);
}

    /**
     * Make messages as seen
     *
     * @param Request $request
     * @return void
     */
    public function seen(Request $request)
    {
        // make as seen
        $seen = Chatify::makeSeen($request['id']);
        // send the response
        return Response::json([
            'status' => $seen,
        ], 200);
    }

    /**
     * Get contacts list
     *
     * @param Request $request
     * @return JSON response
     */
    public function getContacts(Request $request)
    {
        // get all users that received/sent message from/to [Auth user]
        $users = Message::join('users',  function ($join) {
            $join->on('messages.from_id', '=', 'users.id')
            ->orOn('messages.to_id', '=', 'users.id');
        })
        ->where('messages.from_id', Auth::user()->id)
        ->orWhere('messages.to_id', Auth::user()->id)
        ->orderBy('messages.created_at', 'desc')
        ->get()
        ->unique('id');

        if ($users->count() > 0) {
            // fetch contacts
            $contacts = null;
            foreach ($users as $user) {
                if ($user->id != Auth::user()->id) {
                    // Get user data
                    $userCollection = User::where('id', $user->id)->first();
                    $contacts .= Chatify::getContactItem($request['messenger_id'], $userCollection);
                }
            }
        }

        // send the response
        return Response::json([
            'contacts' => $users->count() > 0 ? $contacts : '<br><p class="message-hint"><span>Your contatct list is empty</span></p>',
        ], 200);
    }

    public function getThread(Request $request)
    {

        $tids = DB::table("schedule_thread_user")->where("user_id",Auth::user()->id)
        ->pluck("thread_id")->toArray();


        $threads = DB::table("schedule_threads")
        ->where("schedule_id",$request['messenger_id'])->
        whereIn("id",$tids )->orWhere("open",1)
        ->get();

        $contacts = null;

        foreach($threads as $thread){
            $uids = DB::table("schedule_thread_user")->where("thread_id",$thread->id)->pluck("user_id")->toArray();
            $latestMessage =  DB::table("schedule_sub_messages")->where("messages_id",$thread->id)->orderBy('id', 'desc')->first()->body;
            $users = DB::table("users") ->whereIn("id",$uids)->get();

            $uname = "";
            foreach($users as $user){
                $uname = $uname.$user->name.", ";
            }
            $uname = substr($uname, 0, -2);

            $contacts .= '<table class="messenger-list-item " data-contact="a'.$thread->id.'"> <tbody><tr data-action="1"><td style="position: relative"> <div class="avatar av-m" style="background-image: url('.$thread->url.');"> </div> </td><td> <p data-id="thread_'.$thread->id.'">'.$thread->title." (".$uname.")".'<span></span></p><span>'.$latestMessage.'</span> </td></tr></tbody></table>';
        }
        
        
        return Response::json([
            'contacts' => $threads->count() > 0 ? $contacts : '<br><p class="message-hint"><span>Your contatct list is empty</span></p>',
        ], 200);
    }

    public function getThreadGuest(Request $request)
    {

        // $tids = DB::table("schedule_thread_user")->where("user_id",Auth::user()->id)->pluck("thread_id")->toArray();


        $threads = DB::table("schedule_threads")
        ->where("schedule_id",$request['messenger_id'])->where("open",1)
        // -> whereIn("id",$tids )
        ->get();

        $contacts = null;

        foreach($threads as $thread){
            $uids = DB::table("schedule_thread_user")->where("thread_id",$thread->id)->pluck("user_id")->toArray();
            $latestMessage =  DB::table("schedule_sub_messages")->where("messages_id",$thread->id)->orderBy('id', 'desc')->first()->body;
            $users = DB::table("users") ->whereIn("id",$uids)->get();

            $uname = "";
            foreach($users as $user){
                $uname = $uname.$user->name.", ";
            }
            $uname = substr($uname, 0, -2);

            $contacts .= '<table class="messenger-list-item " data-contact="a'.$thread->id.'"> <tbody><tr data-action="1"><td style="position: relative"> <div class="avatar av-m" style="background-image: url('.$thread->url.');"> </div> </td><td> <p data-id="thread_'.$thread->id.'">'.$thread->title." (".$uname.")".'<span></span></p><span>'.$latestMessage.'</span> </td></tr></tbody></table>';
        }
        
        
        return Response::json([
            'contacts' => $threads->count() > 0 ? $contacts : '<br><p class="message-hint"><span>Your contatct list is empty</span></p>',
        ], 200);
    }

    public function getGroups(Request $request)
    {
       $currentUserId = Auth::user()->id;
       $threads = Thread::getAllLatest($currentUserId);
       if ($threads->count() > 0) {
        $threads = $threads->get();
            // fetch contacts
        $contacts = null;

        foreach ($threads as $thread) {

            try{
                // print_r($latestMessage = DB::table("old_messages")->where("thread_id",$thread->id)->orderBy('id', 'DESC')->first());

                // continue;
                $latestMessage = DB::table("old_messages")->where("thread_id",$thread->id)->orderBy('id', 'DESC')->first()->body;
            }
            catch (\Exception $e) { 
                dd($thread->id);
            }
                    // Get user data
            $contacts .= '<table class="messenger-list-item " data-contact="a'.$thread->id.'"> <tbody><tr data-action="1"><td style="position: relative"> <div class="avatar av-m" style="background-image: url('.$thread->url.');"> </div> </td><td> <p data-id="group_'.$thread->id.'">'.$thread->subject." (".$thread->participantsString(Auth::id()).")".'<span></span></p><span>'.$latestMessage.'</span> </td></tr>
            </tbody></table>';

        }
    }
        // dd("??????");

        // send the response
    return Response::json([
        'contacts' => $threads->count() > 0 ? $contacts : '<br><p class="message-hint"><span>Your contatct list is empty</span></p>',
    ], 200);
}


    /**
     * Update user's list item data
     *
     * @param Request $request
     * @return JSON response
     */
    public function updateContactItem(Request $request)
    {
        // Get user data
        $userCollection = User::where('id', $request['user_id'])->first();
        $contactItem = Chatify::getContactItem($request['messenger_id'], $userCollection);

        // send the response
        return Response::json([
            'contactItem' => $contactItem,
        ], 200);
    }

    /**
     * Put a user in the favorites list
     *
     * @param Request $request
     * @return void
     */
    public function favorite(Request $request)
    {
        // check action [star/unstar]
        if (Chatify::inFavorite($request['user_id'])) {
            // UnStar
            Chatify::makeInFavorite($request['user_id'], 0);
            $status = 0;
        } else {
            // Star
            Chatify::makeInFavorite($request['user_id'], 1);
            $status = 1;
        }

        // send the response
        return Response::json([
            'status' => @$status,
        ], 200);
    }

    /**
     * Get favorites list
     *
     * @param Request $request
     * @return void
     */
    public function getFavorites(Request $request)
    {
        $favoritesList = null;
        $favorites = Favorite::where('user_id', Auth::user()->id);
        foreach ($favorites->get() as $favorite) {
            // get user data
            $user = User::where('id', $favorite->favorite_id)->first();
            $favoritesList .= view('Chatify::layouts.favorite', [
                'user' => $user,
            ]);
        }
        // send the response
        return Response::json([
            'favorites' => $favorites->count() > 0
            ? $favoritesList
            : '<p class="message-hint"><span>Your favorite list is empty</span></p>',
        ], 200);
    }

    /**
     * Search in messenger
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        $getRecords = null;
        $input = trim(filter_var($request['input'], FILTER_SANITIZE_STRING));

        $uids = User::leftJoin('roles', 'roles.id', '=', 'users.role_id')
        ->leftJoin('department', 'department.id', '=', 'roles.department_id')
        ->where('users.name', 'LIKE', "%{$input}%")
        ->orWhere('roles.name', 'LIKE', "%{$input}%")
        ->orWhere('department.name', 'LIKE', "%{$input}%")
        ->where("status",">",0)->pluck('users.id')->toArray();


        $uid2 = User::RightJoin('contractors', 'contractors.id', '=', DB::raw('users.role_id*-1'))
        ->where('contractors.name', 'LIKE', "%{$input}%")
        ->orWhere(DB::raw('"đại diện"'), 'LIKE', "%{$input}%")
        ->pluck('users.id')->toArray();


        $result = array_merge($uids, $uid2);
        $records = User::whereIn('id', $result);

        foreach ($records->get() as $record) {
            $getRecords .= view('Chatify::layouts.listItem', [
                'get' => 'search_item',
                'type' => 'user',
                'user' => $record,
            ])->render();
        }
        // send the response
        return Response::json([
            'records' => $records->count() > 0
            ? $getRecords
            : '<p class="message-hint"><span>Nothing to show.</span></p>',
            'addData' => 'html'
        ], 200);
    }
    public function mysearch(Request $request)
    {
            // dd("123");
        $getRecords = null;
        $input = trim(filter_var($request['input'], FILTER_SANITIZE_STRING));

        // $uids = User::leftJoin('roles', 'roles.id', '=', 'users.role_id')
        // ->leftJoin('department', 'department.id', '=', 'roles.department_id')
        // ->where('users.name', 'LIKE', "%{$input}%")
        // ->orWhere('roles.name', 'LIKE', "%{$input}%")
        // ->orWhere('department.name', 'LIKE', "%{$input}%")
        // ->where("status",">",0)->pluck('users.id')->toArray();
        // dd($request['type']);
        if($request['type']=="schedule"){
            $mids = DB::table("schedule_messages")->where("schedule_id",$request['id'])
            ->where("body","like","%".$request['input']."%")->pluck('id')->toArray();
        }else if($request['type']=="sale"){
            $mids = DB::table("zone_messages")->where("zone_id",$request['id'])
            ->where("body","like","%".$request['input']."%")->pluck('id')->toArray();
        }
        else if($request['type']=="user"){

            $mids1 = DB::table("messages")->where("from_id",$request['id'])
            ->where("to_id",Auth::user()->id)->where("body","like","%".$request['input']."%")
            ->pluck('id')->toArray();


            $mids2 = DB::table("messages")->where("to_id",$request['id'])
            ->where("from_id",Auth::user()->id)->where("body","like","%".$request['input']."%")
            ->pluck('id')->toArray();


            $mids = array_merge($mids1,$mids2);  
        }

        elseif($request['type']=="group"){
            $mids = DB::table("old_messages")->where("thread_id",$request['id'])
            ->where("body","like","%".$request['input']."%")->pluck('id')->toArray();
        }
        else{
         $mids = DB::table("schedule_sub_messages")->where("messages_id",$request['id'])
         ->where("body","like","%".$request['input']."%")->pluck('id')->toArray();
     }
     return $mids;

 }
    /**
     * Get shared photos
     *
     * @param Request $request
     * @return void
     */

    public function sharedSale(Request $request)
    {          
        $shared = Chatify::getSharedPhotos($request['user_id'],"sale");
        $sharedPhotos = '<p class="messenger-title">Ảnh đã chia sẻ</p>';
        // dd($shared);
        // shared with its template
        for ($i = 0; $i < count($shared); $i++) {
            $sharedPhotos .= view('Chatify::layouts.listItem', [
                'get' => 'sharedPhoto',
                'image' => asset('storage/public/attachments/' . $shared[$i]),
            ])->render();
        }

        $shared_file = Chatify::getSharedFiles($request['user_id'],"sale");

        $shared_file_html = '<ul class="list-group">
        <li class="list-group-item" ><p style="color:black;">Tệp chia sẻ<i class="fa fa-arrow-down"aria-hidden="true"></i><br><input style="color:black" class="input-edit" type="text" id="fileSreach" onkeyup="fileFiller(this)"></p></li></ul>
        <ul id="fileList" class="list-group" style="width:100%;z-index:1000;max-height:500px;overflow:auto;"> '
        ;

        for ($i = 0; $i < count($shared_file); $i++) {
            $content = explode(',',$shared_file[$i]);
            // dd($content);

            if(strpos($content[1],".png") > 0 
                || strpos($content[1],".jpg") > 0 
                || strpos($content[1],".jpeg") > 0 
            ){

              $type = "photo.jpg";
      }elseif (strpos($content[1],".pdf")> 0) {
          $type = "pdf.png";
      }elseif (strpos($content[1],".doc")> 0) {
          $type = "word.png";
      }elseif (strpos($content[1],".ppt")> 0) {
          $type = "pp.png";
      }elseif (strpos($content[1],".xls")> 0
        || strpos($content[1],".csv") > 0 )
      {
          $type = "excel.png";
      }else{

          $type = "other.png";
      }

      $shared_file_html =   $shared_file_html.'<li class="list-group-item  file-item">
      <span class="preview"><img src="/js-css/img/file_type/'.$type.'"></span><a style="color:black" target="_blank" download="'.$content[1].'" href="/storage/public/attachments/'.$content[0].'" class="preview" type="button">'.$content[1].'</a></li>';
  }
  $shared_file_html =   $shared_file_html."</ul>";

  $pin = "<hr><h3>Tin nhắn đã ghim</h3>";

  $chat_pin  =  DB::table("zone_messages")->where("zone_id", $request['user_id'])
  ->leftJoin('users', 'users.id', '=', 'zone_messages.user_id')
  ->select("zone_messages.id as id","zone_messages.user_id as user_id",
    "zone_messages.body as body",
    "zone_messages.attachment as attachment","zone_messages.created_at as time","zone_messages.pin as pin"
    ,"users.name as name","users.avatar as avatar")
  ->where("pin",1)
  ->orderBy('id', 'desc')->get();
  $pin = '<ul class="list-group" style="max-height:45px;" onclick="ToggleTable(this)">
  <li class="list-group-item" ><p>Danh sách ghim<i class="fafa-arrow-down"aria-hidden="true"></i></p></li></ul>
  <ul class="list-group" style="width:100%;z-index:1000;max-height:200px;overflow:auto;">';
  foreach($chat_pin as $mess){
     $pin = $pin.'<li  onclick="jump('.$mess->id.')" style="color:black;width:100%!important;" class="list-group-item direct-chat-msg" ><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left" style="color:black">'.$mess->name.'</span><span class="direct-chat-timestamp float-right">'.$mess->time.'</span></div> <img class="direct-chat-img" src="'.$mess->avatar.'" alt="message user image"><div class="direct-chat-text"><span>'.$mess->body.'</span></div></li>';

 }               

 $pin = $pin.'</ul>';

 $storage = "<hr><h3>Minh chứng</h3>";

 $chat_pin  =  DB::table("zone_messages")->where("zone_id", $request['user_id'])
 ->leftJoin('users', 'users.id', '=', 'zone_messages.user_id')
 ->select("zone_messages.id as id","zone_messages.user_id as user_id",
    "zone_messages.body as body",
    "zone_messages.attachment as attachment","zone_messages.created_at as time","zone_messages.pin as pin"
    ,"users.name as name","users.avatar as avatar")
 ->where("storage",1)
 ->orderBy('id', 'desc')->get();
 $storage = '<ul class="list-group" style="max-height:45px;" onclick="ToggleTable(this)">
 <li class="list-group-item" ><p>MInh chứng<i class="fafa-arrow-down"aria-hidden="true"></i></p></li></ul>
 <ul class="list-group" style="width:100%;z-index:1000;max-height:200px;overflow:auto;">';
 foreach($chat_pin as $mess){
     $content = explode(',',$mess->attachment);

     $storage = $storage.'<li  onclick="jump('.$mess->id.')" style="color:black;width:100%!important;" class="list-group-item direct-chat-msg" > <img class="direct-chat-img" src="'.$mess->avatar.'" alt="message user image"><div class="direct-chat-text"><a style="color:black" target="_blank" download="'.$content[1].'" href="/storage/public/attachments/'.$content[0].'" class="preview" type="button">'.$content[1].'('.$mess->body.')</a></div></li>';

 }               

 $storage = $storage.'</ul>';
 return Response::json([
    'shared' => count($shared) > 0 ? $sharedPhotos : '<p class="message-hint"><span>Nothing shared yet</span></p>',
    'files' => count($shared_file) > 0 ? $shared_file_html : '',
    'storage' => $storage,
    'id'=>$request['user_id'],
    'type' => $request['type'],
    'pin'=>$pin
], 200);
}


public function ZoneSale($index = null)
{
    $infomation  = DB::table("zone_process")
    ->leftJoin('zone', 'zone_process.zone_id', '=', 'zone.id')
    ->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
    ->leftJoin('users', 'zone.staff_id', '=', 'users.id')

    ->leftJoin('staff_process_step', 'zone_process.process_id', '=', 'staff_process_step.process_id')
    ->leftJoin('staff_step', 'staff_process_step.step_id', '=', 'staff_step.id')
    ->where("zone.id",$index)
    ->select("zone_process.id as id","zone.name as name", "consumer.id as cid",
      "consumer.name as cname", "consumer.phone_number as phone_number", "consumer.identify_card as identify_card",
      "zone_process.id as pid",
      "consumer.birth_date as birth_date",
      "consumer.iden_date as iden_date",
      "consumer.iden_location as iden_location",
      "consumer.married as married",
      "consumer.married_role as married_role",
      "consumer.address as address"
      ,"consumer.email as email"
      ,"users.name as sname"
      ,"users.phone as sphone",
      "zone.state as state"
      ,"staff_step.name as status")->first();

// dd($infomation);
    if($infomation != null){
        $process_id = DB::table("zone_process")->where("zone_id",$index)->first()->process_id;

        $consumer2 = Consumer2::where("consumer_id",$infomation->cid)->first();
        $curstep = DB::table("zone_process")->where("zone_id",$index)->first()->curstep;
    }else{
        $consumer2 = "";
        $process_id = 0;
        $curstep = 0;
    }


    $lock =   DB::table("staff_process_lock")->where('process_id', $process_id)->get();

    $zone_id = $index;
    $zone = DB::table("zone")->where("id",$zone_id)->first();
// dd($zone);
    $staff =  DB::table("staff")->where("id",$zone_id)->first();
    try{
        $cid = DB::table("consumer")->where("user_id",Auth()->user()->id)->first()->id;
    }catch (\Exception $e) { 
        $cid =-1;
    }
// if(!$this->checkMap() && $cid != $zone->consumer_id){
//         return redirect()->back()->with("warning","Bạn không có quyền xem chi tiết lô này");
//       }

    $pays = DB::table("zone_pay")->where("zone_id",$zone_id)->get();
    $zone_cmt = DB::table("zone_comments")->where("zone_id",$zone_id)->get();
    $route = (in_array(\Request::route()->getName(), ['user', config('chatify.path')]))
    ? 'user'
    : \Request::route()->getName();
    $dark_mode = 'light';    
    $messengerColor = '#fff';


    $step = DB::table("staff_step_task")
    ->leftJoin('staff_task', 'staff_step_task.task_id', '=', 'staff_task.id')
    ->leftJoin('zone_task', 'staff_task.id', '=', 'zone_task.task_id')
    ->where('zone_task.status',"<>",5)
    ->where([['zone_task.zone_id',$zone_id]])
    ->groupBy('zone_task.id')
    ->select("zone_task.id as id","staff_task.name as name","staff_task.type as type",
      "staff_task.url as url","zone_task.des as des","zone_task.status as status",
      "zone_task.start_date as start_date","zone_task.end_date as end_date"
  )->orderBy('staff_step_task.pos', 'ASC')->get();

    // dd($step);
    return view('Chatify::sale.app', compact("infomation","process_id",'zone_id','index',"curstep",
        "pays","zone","staff","consumer2",
        "zone_cmt","lock",
        'dark_mode',"route","messengerColor","step"));

}



public function sharedBuild(Request $request)
{          
    $shared = Chatify::getSharedPhotos($request['user_id'],"build");
    $sharedPhotos = '<p class="messenger-title">Ảnh đã chia sẻ</p>';
        // dd($shared);
        // shared with its template
    for ($i = 0; $i < count($shared); $i++) {
        $sharedPhotos .= view('Chatify::layouts.listItem', [
            'get' => 'sharedPhoto',
            'image' => asset('storage/public/attachments/' . $shared[$i]),
        ])->render();
    }

    $shared_file = Chatify::getSharedFiles($request['user_id'],"build");

    $shared_file_html = '<ul class="list-group">
    <li class="list-group-item" ><p style="color:black;">Tệp chia sẻ<i class="fa fa-arrow-down"aria-hidden="true"></i><br><input style="color:black" class="input-edit" type="text" id="fileSreach" onkeyup="fileFiller(this)"></p></li></ul>
    <ul id="fileList" class="list-group" style="width:100%;z-index:1000;max-height:500px;overflow:auto;"> '
    ;

    for ($i = 0; $i < count($shared_file); $i++) {
        $content = explode(',',$shared_file[$i]);
            // dd($content);

        if(strpos($content[1],".png") > 0 
            || strpos($content[1],".jpg") > 0 
            || strpos($content[1],".jpeg") > 0 
        ){

          $type = "photo.jpg";
  }elseif (strpos($content[1],".pdf")> 0) {
      $type = "pdf.png";
  }elseif (strpos($content[1],".doc")> 0) {
      $type = "word.png";
  }elseif (strpos($content[1],".ppt")> 0) {
      $type = "pp.png";
  }elseif (strpos($content[1],".xls")> 0
    || strpos($content[1],".csv") > 0 )
  {
      $type = "excel.png";
  }else{

      $type = "other.png";
  }

  $shared_file_html =   $shared_file_html.'<li class="list-group-item  file-item">
  <span class="preview"><img src="/js-css/img/file_type/'.$type.'"></span><a style="color:black" target="_blank" download="'.$content[1].'" href="/storage/public/attachments/'.$content[0].'" class="preview" type="button">'.$content[1].'</a></li>';
}
$shared_file_html =   $shared_file_html."</ul>";

$pin = "<hr><h3>Tin nhắn đã ghim</h3>";

$chat_pin  =  DB::table("building_messages")->where("building_id", $request['user_id'])
->leftJoin('users', 'users.id', '=', 'building_messages.user_id')
->select("building_messages.id as id","building_messages.user_id as user_id",
    "building_messages.body as body",
    "building_messages.attachment as attachment","building_messages.created_at as time","building_messages.pin as pin"
    ,"users.name as name","users.avatar as avatar")
->where("pin",1)
->orderBy('id', 'desc')->get();
$pin = '<ul class="list-group" style="max-height:45px;" onclick="ToggleTable(this)">
<li class="list-group-item" ><p>Danh sách ghim<i class="fafa-arrow-down"aria-hidden="true"></i></p></li></ul>
<ul class="list-group" style="width:100%;z-index:1000;max-height:200px;overflow:auto;">';
foreach($chat_pin as $mess){
 $pin = $pin.'<li  onclick="jump('.$mess->id.')" style="color:black;width:100%!important;" class="list-group-item direct-chat-msg" ><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left" style="color:black">'.$mess->name.'</span><span class="direct-chat-timestamp float-right">'.$mess->time.'</span></div> <img class="direct-chat-img" src="'.$mess->avatar.'" alt="message user image"><div class="direct-chat-text"><span>'.$mess->body.'</span></div></li>';

}               

$pin = $pin.'</ul>';

$storage = "<hr><h3>Minh chứng</h3>";

$chat_pin  =  DB::table("building_messages")->where("building_id", $request['user_id'])
->leftJoin('users', 'users.id', '=', 'building_messages.user_id')
->select("building_messages.id as id","building_messages.user_id as user_id",
    "building_messages.body as body",
    "building_messages.attachment as attachment","building_messages.created_at as time","building_messages.pin as pin"
    ,"users.name as name","users.avatar as avatar")
->where("storage",1)
->orderBy('id', 'desc')->get();
$storage = '<ul class="list-group" style="max-height:45px;" onclick="ToggleTable(this)">
<li class="list-group-item" ><p>MInh chứng<i class="fafa-arrow-down"aria-hidden="true"></i></p></li></ul>
<ul class="list-group" style="width:100%;z-index:1000;max-height:200px;overflow:auto;">';
foreach($chat_pin as $mess){
 $content = explode(',',$mess->attachment);

 $storage = $storage.'<li  onclick="jump('.$mess->id.')" style="color:black;width:100%!important;" class="list-group-item direct-chat-msg" > <img class="direct-chat-img" src="'.$mess->avatar.'" alt="message user image"><div class="direct-chat-text"><a style="color:black" target="_blank" download="'.$content[1].'" href="/storage/public/attachments/'.$content[0].'" class="preview" type="button">'.$content[1].'('.$mess->body.')</a></div></li>';

}               

$storage = $storage.'</ul>';
return Response::json([
    'shared' => count($shared) > 0 ? $sharedPhotos : '<p class="message-hint"><span>Nothing shared yet</span></p>',
    'files' => count($shared_file) > 0 ? $shared_file_html : '',
    'storage' => $storage,
    'id'=>$request['user_id'],
    'type' => $request['type'],
    'pin'=>$pin
], 200);
}


public function sharedCalender(Request $request)
{          
    $shared = Chatify::getSharedPhotos($request['user_id'],"calender");
    $sharedPhotos = '<p class="messenger-title">Ảnh đã chia sẻ</p>';
        // dd($shared);
        // shared with its template
    for ($i = 0; $i < count($shared); $i++) {
        $sharedPhotos .= view('Chatify::layouts.listItem', [
            'get' => 'sharedPhoto',
            'image' => asset('storage/public/attachments/' . $shared[$i]),
        ])->render();
    }

    $shared_file = Chatify::getSharedFiles($request['user_id'],"calender");

    $shared_file_html = '<ul class="list-group">
    <li class="list-group-item" ><p style="color:black;">Tệp chia sẻ<i class="fa fa-arrow-down"aria-hidden="true"></i><br><input style="color:black" class="input-edit" type="text" id="fileSreach" onkeyup="fileFiller(this)"></p></li></ul>
    <ul id="fileList" class="list-group" style="width:100%;z-index:1000;max-height:500px;overflow:auto;"> '
    ;

    for ($i = 0; $i < count($shared_file); $i++) {
        $content = explode(',',$shared_file[$i]);
            // dd($content);

        if(strpos($content[1],".png") > 0 
            || strpos($content[1],".jpg") > 0 
            || strpos($content[1],".jpeg") > 0 
        ){

          $type = "photo.jpg";
  }elseif (strpos($content[1],".pdf")> 0) {
      $type = "pdf.png";
  }elseif (strpos($content[1],".doc")> 0) {
      $type = "word.png";
  }elseif (strpos($content[1],".ppt")> 0) {
      $type = "pp.png";
  }elseif (strpos($content[1],".xls")> 0
    || strpos($content[1],".csv") > 0 )
  {
      $type = "excel.png";
  }else{

      $type = "other.png";
  }

  $shared_file_html =   $shared_file_html.'<li class="list-group-item  file-item">
  <span class="preview"><img src="/js-css/img/file_type/'.$type.'"></span><a style="color:black" target="_blank" download="'.$content[1].'" href="/storage/public/attachments/'.$content[0].'" class="preview" type="button">'.$content[1].'</a></li>';
}
$shared_file_html =   $shared_file_html."</ul>";

$pin = "<hr><h3>Tin nhắn đã ghim</h3>";

$chat_pin  =  DB::table("calender_messages")->where("calender_id", $request['user_id'])
->leftJoin('users', 'users.id', '=', 'calender_messages.user_id')
->select("calender_messages.id as id","calender_messages.user_id as user_id",
    "calender_messages.body as body",
    "calender_messages.attachment as attachment","calender_messages.created_at as time","calender_messages.pin as pin"
    ,"users.name as name","users.avatar as avatar")
->where("pin",1)
->orderBy('id', 'desc')->get();
$pin = '<ul class="list-group" style="max-height:45px;" onclick="ToggleTable(this)">
<li class="list-group-item" ><p>Danh sách ghim<i class="fafa-arrow-down"aria-hidden="true"></i></p></li></ul>
<ul class="list-group" style="width:100%;z-index:1000;max-height:200px;overflow:auto;">';
foreach($chat_pin as $mess){
 $pin = $pin.'<li  onclick="jump('.$mess->id.')" style="color:black;width:100%!important;" class="list-group-item direct-chat-msg" ><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left" style="color:black">'.$mess->name.'</span><span class="direct-chat-timestamp float-right">'.$mess->time.'</span></div> <img class="direct-chat-img" src="'.$mess->avatar.'" alt="message user image"><div class="direct-chat-text"><span>'.$mess->body.'</span></div></li>';

}               

$pin = $pin.'</ul>';

$storage = "<hr><h3>Minh chứng</h3>";

$chat_pin  =  DB::table("calender_messages")->where("calender_id", $request['user_id'])
->leftJoin('users', 'users.id', '=', 'calender_messages.user_id')
->select("calender_messages.id as id","calender_messages.user_id as user_id",
    "calender_messages.body as body",
    "calender_messages.attachment as attachment","calender_messages.created_at as time","calender_messages.pin as pin"
    ,"users.name as name","users.avatar as avatar")
->where("storage",1)
->orderBy('id', 'desc')->get();
$storage = '<ul class="list-group" style="max-height:45px;" onclick="ToggleTable(this)">
<li class="list-group-item" ><p>MInh chứng<i class="fafa-arrow-down"aria-hidden="true"></i></p></li></ul>
<ul class="list-group" style="width:100%;z-index:1000;max-height:200px;overflow:auto;">';
foreach($chat_pin as $mess){
 $content = explode(',',$mess->attachment);

 $storage = $storage.'<li  onclick="jump('.$mess->id.')" style="color:black;width:100%!important;" class="list-group-item direct-chat-msg" > <img class="direct-chat-img" src="'.$mess->avatar.'" alt="message user image"><div class="direct-chat-text"><a style="color:black" target="_blank" download="'.$content[1].'" href="/storage/public/attachments/'.$content[0].'" class="preview" type="button">'.$content[1].'('.$mess->body.')</a></div></li>';

}               

$storage = $storage.'</ul>';
return Response::json([
    'shared' => count($shared) > 0 ? $sharedPhotos : '<p class="message-hint"><span>Nothing shared yet</span></p>',
    'files' => count($shared_file) > 0 ? $shared_file_html : '',
    'storage' => $storage,
    'id'=>$request['user_id'],
    'type' => $request['type'],
    'pin'=>$pin
], 200);
}
public function sharedPhotos(Request $request)
{          
    $shared = Chatify::getSharedPhotos($request['user_id'],$request['type']);
    $sharedPhotos = '<p class="messenger-title">Ảnh đã chia sẻ</p>';
        // dd($shared);
        // shared with its template
    for ($i = 0; $i < count($shared); $i++) {
        $sharedPhotos .= view('Chatify::layouts.listItem', [
            'get' => 'sharedPhoto',
            'image' => asset('storage/public/attachments/' . $shared[$i]),
        ])->render();
    }

    $shared_file = Chatify::getSharedFiles($request['user_id'],$request['type']);

    $shared_file_html = '<ul class="list-group">
    <li class="list-group-item" ><p style="color:black;">Tệp chia sẻ<i class="fa fa-arrow-down"aria-hidden="true"></i><br><input style="color:black" class="input-edit" type="text" id="fileSreach" onkeyup="fileFiller(this)"></p></li></ul>
    <ul id="fileList" class="list-group" style="width:100%;z-index:1000;max-height:500px;overflow:auto;"> '
    ;

    for ($i = 0; $i < count($shared_file); $i++) {
        $content = explode(',',$shared_file[$i]);
            // dd($content);

        if(strpos($content[1],".png") > 0 
            || strpos($content[1],".jpg") > 0 
            || strpos($content[1],".jpeg") > 0 
        ){

          $type = "photo.jpg";
  }elseif (strpos($content[1],".pdf")> 0) {
      $type = "pdf.png";
  }elseif (strpos($content[1],".doc")> 0) {
      $type = "word.png";
  }elseif (strpos($content[1],".ppt")> 0) {
      $type = "pp.png";
  }elseif (strpos($content[1],".xls")> 0
    || strpos($content[1],".csv") > 0 )
  {
      $type = "excel.png";
  }else{

      $type = "other.png";
  }

  $shared_file_html =   $shared_file_html.'<li class="list-group-item  file-item">
  <span class="preview"><img src="/js-css/img/file_type/'.$type.'"></span><a style="color:black" target="_blank" download="'.$content[1].'" href="/storage/public/attachments/'.$content[0].'" class="preview" type="button">'.$content[1].'</a></li>';
}
$shared_file_html =   $shared_file_html."</ul>";
$user_list = '';
if ($request['type'] == 'group'){
            // if ($request['type'] !== 'schedule'){
    $user_list = '<ul class="list-group" style="max-height:45px;" onclick="ToggleTable(this)">
    <li class="list-group-item" ><p>Danh sách thành viên<i class="fafa-arrow-down"aria-hidden="true"></i></p></li></ul>
    <ul class="list-group" style="width:100%;z-index:1000;max-height:500px;overflow:auto;">';
    $participant = DB::table("participants")->where('thread_id',$request['user_id'])->get();
    foreach ($participant as $participant) {
        $user_temp = DB::table("users")->where('id',$participant->user_id)->first();

        if(strlen($user_temp->avatar) > 0){
            $avatar = $user_temp->avatar;
        }else{
            $avatar = "/js-css/img/icon/avatar.png";
        }
        $user_list =   $user_list.'<li style="color:black;width:100%!important;" class="list-group-item direct-chat-msg" ><div class="direct-chat-infos clearfix"></div> <img class="direct-chat-img" src="'.$avatar.'" alt="message user image"><div class="direct-chat-text"><span>'.$user_temp->name;  }

        $user_list =   $user_list.'<li><a href="/messages/edit/'.$request['user_id'].'" class="preview" type="button">Sửa thông tin</a></li></ul>';

    }elseif($request['type'] == 'thread'){
            // if ($request['type'] !== 'schedule'){
      $user_list = '<ul class="list-group" >
      <li class="list-group-item" ><p>Danh sách thành viên<i class="fafa-arrow-down"aria-hidden="true"></i><br><input type="text"  class="input-edit" id="FileSreach"></p></li></ul>
      <ul class="list-group" style="width:100%;z-index:1000;max-height:500px;overflow:auto;">';
      $participant = DB::table("schedule_thread_user")->where('thread_id',$request['user_id'])->get();
      foreach ($participant as $participant) {
        $user_temp = DB::table("users")->where('id',$participant->user_id)->first();

        if(strlen($user_temp->avatar) > 0){
            $avatar = $user_temp->avatar;
        }else{
            $avatar = "/js-css/img/icon/avatar.png";
        }
        $user_list =   $user_list.'<li style="color:black;width:100%!important;" class="list-group-item direct-chat-msg" ><div class="direct-chat-infos clearfix"></div> <img class="direct-chat-img" src="'.$avatar.'" alt="message user image"><div class="direct-chat-text"><span>'.$user_temp->name;

        if (Auth::check()) {
         ' (<a style="color: red" href="/kick-thread/'.$request['user_id'].'/'.$user_temp->id.'">Xóa</a>)';
     }
     $user_list =   $user_list.'</span></div></li>';
 }
 $user_list =   $user_list.'<li style="color:black;width:100%!important;" class="list-group-item direct-chat-msg"><h3><a style="color:red;" href="/add-thread/'.$request['user_id'].'" class="preview" type="button">Thêm thành viên</a></h3></li></ul>';


 $user_list =   $user_list.'<li style="color:black;width:100%!important;" class="list-group-item direct-chat-msg"><h3><a style="color:red;" href="/leave-thread/'.$request['user_id'].'" class="preview" type="button">Rời khỏi cuộc trò chuyện</a></h3></li></ul>';

}


$pin = "";

if($request['type'] == 'schedule'){

            // dd("whut");
 $chat_pin  =  DB::table("schedule_messages")->where("schedule_id", $request['user_id'])
 ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
 ->select("schedule_messages.id as id","schedule_messages.user_id as user_id",
    "schedule_messages.body as body",
    "schedule_messages.attachment as attachment","schedule_messages.created_at as time","schedule_messages.pin as pin"
    ,"users.name as name","users.avatar as avatar")
 ->where("pin",1)
 ->orderBy('id', 'desc')->get();
 $pin = '<ul class="list-group" style="max-height:45px;" onclick="ToggleTable(this)">
 <li class="list-group-item" ><p>Danh sách ghim<i class="fafa-arrow-down"aria-hidden="true"></i></p></li></ul>
 <ul class="list-group" style="width:100%;z-index:1000;max-height:200px;overflow:auto;">';
 foreach($chat_pin as $mess){
     $pin = $pin.'<li  onclick="jump('.$mess->id.')" style="color:black;width:100%!important;" class="list-group-item direct-chat-msg" ><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left" style="color:black">'.$mess->name.'</span><span class="direct-chat-timestamp float-right">'.$mess->time.'</span></div> <img class="direct-chat-img" src="'.$mess->avatar.'" alt="message user image"><div class="direct-chat-text"><span>'.$mess->body.'</span></div></li>';

 }               

 $pin = $pin.'</ul>';
 // dd($pin); 
}elseif($request['type'] == 'thread'){
 $chat_pin  =  DB::table("schedule_sub_messages")->where("messages_id", $request['user_id'])
 ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
 ->select("schedule_sub_messages.id as id","schedule_sub_messages.user_id as user_id",
    "schedule_sub_messages.body as body",
    "schedule_sub_messages.attachment as attachment","schedule_sub_messages.created_at as time","schedule_sub_messages.pin as pin"
    ,"users.name as name","users.avatar as avatar")
 ->where("pin",1)
 ->orderBy('id', 'desc')->get();
 $pin = '<ul class="list-group" onclick="ToggleTable(this)">
 <li class="list-group-item" ><p>Danh sách ghim<i class="fafa-arrow-down"aria-hidden="true"></i></p></li></ul>
 <ul class="list-group" style="width:100%;z-index:1000;max-height: 200px;:200px;overflow:auto;">';
 foreach($chat_pin as $mess){
     $pin = $pin.'<li  onclick="jump('.$mess->id.')" style="color:black;width:100%!important;" class="list-group-item direct-chat-msg" ><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left" style="color:black">'.$mess->name.'</span><span class="direct-chat-timestamp float-right">'.$mess->time.'</span></div> <img class="direct-chat-img" src="'.$mess->avatar.'" alt="message user image"><div class="direct-chat-text"><span>'.$mess->body.'</span></div></li>';

 }               

 $pin = $pin.'</ul>';
 // dd($pin); 
}
        // send the response
return Response::json([
    'shared' => count($shared) > 0 ? $sharedPhotos : '<p class="message-hint"><span>Nothing shared yet</span></p>',
    'files' => count($shared_file) > 0 ? $shared_file_html : '',
    'user_list' => $user_list,
    'id'=>$request['user_id'],
    'type' => $request['type'],
    'pin'=>$pin
], 200);
}

    /**
     * Delete conversation
     *
     * @param Request $request
     * @return void
     */
    public function deleteConversation(Request $request)
    {
        // delete
        $delete = Chatify::deleteConversation($request['id']);

        // send the response
        return Response::json([
            'deleted' => $delete ? 1 : 0,
        ], 200);
    }

    public function updateSettings(Request $request)
    {
        $msg = null;
        $error = $success = 0;

        // dark mode
        if ($request['dark_mode']) {
            $request['dark_mode'] == "dark"
                ? User::where('id', Auth::user()->id)->update(['dark_mode' => 1])  // Make Dark
                : User::where('id', Auth::user()->id)->update(['dark_mode' => 0]); // Make Light
            }

        // If messenger color selected
            if ($request['messengerColor']) {

                $messenger_color = explode('-', trim(filter_var($request['messengerColor'], FILTER_SANITIZE_STRING)));
                $messenger_color = Chatify::getMessengerColors()[$messenger_color[1]];
                User::where('id', Auth::user()->id)
                ->update(['messenger_color' => $messenger_color]);
            }
        // if there is a [file]
            if ($request->hasFile('avatar')) {
            // allowed extensions
                $allowed_images = Chatify::getAllowedImages();

                $file = $request->file('avatar');
            // if size less than 150MB
                if ($file->getSize() < 150000000) {
                    if (in_array($file->getClientOriginalExtension(), $allowed_images)) {
                    // delete the older one
                        if (Auth::user()->avatar != config('chatify.user_avatar.default')) {
                            $path = storage_path('app/public/' . config('chatify.user_avatar.folder') . '/' . Auth::user()->avatar);
                            if (file_exists($path)) {
                                @unlink($path);
                            }
                        }
                    // upload
                        $avatar = Str::uuid() . "." . $file->getClientOriginalExtension();
                        $update = User::where('id', Auth::user()->id)->update(['avatar' => $avatar]);
                        $file->storeAs("public/" . config('chatify.user_avatar.folder'), $avatar);
                        $success = $update ? 1 : 0;
                    } else {
                        $msg = "File extension not allowed!";
                        $error = 1;
                    }
                } else {
                    $msg = "File extension not allowed!";
                    $error = 1;
                }
            }

        // send the response
            return Response::json([
                'status' => $success ? 1 : 0,
                'error' => $error ? 1 : 0,
                'message' => $error ? $msg : 0,
            ], 200);
        }

    /**
     * Set user's active status
     *
     * @param Request $request
     * @return void
     */
    public function setActiveStatus(Request $request)
    {
        $update = $request['status'] > 0
        ? User::where('id', $request['user_id'])->update(['active_status' => 1])
        : User::where('id', $request['user_id'])->update(['active_status' => 0]);
        // send the response
        return Response::json([
            'status' => $update,
        ], 200);
    }

    public function deleteMess(Request $request)
    {
        if($request->type == "user"){
           Message::where("id",$request->id)->delete();
       }        if($request->type == "schedule"){
        DB::table("schedule_messages")->where("id",$request->id)->delete();
    }        if($request->type == "thread"){
       DB::table("schedule_sub_messages")->where("id",$request->id)->delete();
   } if($request->type == "sale"){
       DB::table("zone_messages")->where("id",$request->id)->delete();
   }if($request->type == "build"){
       DB::table("building_messages")->where("id",$request->id)->delete();
   }
   else{
    DB::table("old_messages")->where("id",$request->id)->delete();
}
        // send the response
return Response::json([
    'status' => 1,
], 200);
}



public function sale($index = null)
{
    $infomation  = DB::table("zone_process")
    ->leftJoin('zone', 'zone_process.zone_id', '=', 'zone.id')
    ->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
    ->leftJoin('users', 'zone.staff_id', '=', 'users.id')

    ->leftJoin('staff_process_step', 'zone_process.process_id', '=', 'staff_process_step.process_id')
    ->leftJoin('staff_step', 'staff_process_step.step_id', '=', 'staff_step.id')
    ->where("zone_process.id",$index)
    ->select("zone_process.id as id","zone.name as name", "consumer.id as cid",
      "consumer.name as cname", "consumer.phone_number as phone_number", "consumer.identify_card as identify_card",
      "consumer.birth_date as birth_date",
      "consumer.iden_date as iden_date",
      "consumer.iden_location as iden_location",
      "consumer.married as married",
      "consumer.married_role as married_role",
      "consumer.address as address"
      ,"consumer.email as email"
      ,"users.name as sname"
      ,"users.phone as sphone"
      ,"staff_step.name as status")->first();

    $consumer2 = Consumer2::where("consumer_id",$infomation->cid)->first();


    $process_id = DB::table("zone_process")->where("id",$index)->first()->process_id;

    $lock =   DB::table("staff_process_lock")->where('process_id', $process_id)->get();

    $zone_id = DB::table("zone_process")->where("id",$index)->first()->zone_id;
    $zone = DB::table("zone")->where("id",$zone_id)->first();
// dd($zone);
    $staff =  DB::table("staff")->where("id",$zone_id)->first();
    try{
        $cid = DB::table("consumer")->where("user_id",Auth()->user()->id)->first()->id;
    }catch (\Exception $e) { 
        $cid =-1;
    }
// if(!$this->checkMap() && $cid != $zone->consumer_id){
//         return redirect()->back()->with("warning","Bạn không có quyền xem chi tiết lô này");
//       }

    $curstep = DB::table("zone_process")->where("id",$index)->first()->curstep;
    $pays = DB::table("zone_pay")->where("zone_id",$zone_id)->get();
    $zone_cmt = DB::table("zone_comments")->where("zone_id",$zone_id)->get();
    $route = (in_array(\Request::route()->getName(), ['user', config('chatify.path')]))
    ? 'user'
    : \Request::route()->getName();
    $dark_mode = 'light';    
    $messengerColor = '#fff';


    $step = DB::table("staff_step_task")
    ->leftJoin('staff_task', 'staff_step_task.task_id', '=', 'staff_task.id')
    ->leftJoin('zone_task', 'staff_task.id', '=', 'zone_task.task_id')
    ->where('zone_task.status',"<>",5)
    ->where([['zone_task.zone_id',$zone_id]])
    ->groupBy('zone_task.id')
    ->select("zone_task.id as id","staff_task.name as name","staff_task.type as type",
      "staff_task.url as url","zone_task.des as des","zone_task.status as status",
      "zone_task.start_date as start_date","zone_task.end_date as end_date"
  )->orderBy('staff_step_task.pos', 'ASC')->get();

    // dd($step);
    return view('Chatify::sale.app', compact("infomation","process_id",'zone_id','index',"curstep",
        "pays","zone","staff","consumer2",
        "zone_cmt","lock",
        'dark_mode',"route","messengerColor","step"));

}

public function build($index = null)
{
    $built = DB::table("buildingg")->where("id",$index)->first();
    $project = DB::table("projects")->where("id",$built->project_id)->first();
    if($project == null){
        $project = DB::table("projects")->first();
    }
    $contract = DB::table("building_contract")->where("bid",$index)->get();
    $contractors = DB::table("contractors")
    ->leftJoin("buildingg_contractor","buildingg_contractor.contractor_id","contractors.id")
    ->select("contractors.id as id","contractors.name as name","contractors.phone as phone")
    ->where("buildingg_contractor.building_id",$built->id)->get();

     // dd($contractors);

    $route = (in_array(\Request::route()->getName(), ['user', config('chatify.path')]))
    ? 'user'
    : \Request::route()->getName();


    $dark_mode = 'light';    
    $messengerColor = '#fff';
    return view('Chatify::building.app', compact("built","contract","contractors",
        'dark_mode',"route","messengerColor","project"));

}

public function calender($index = null)
{
    $calen = DB::table("calendar_event")->where("id",$index)->first();

     // dd($contractors);

    $route = (in_array(\Request::route()->getName(), ['user', config('chatify.path')]))
    ? 'user'
    : \Request::route()->getName();


    $dark_mode = 'light';    
    $messengerColor = '#fff';
    return view('Chatify::calender.app', compact("calen",
        'dark_mode',"route","messengerColor"));

}



public function consumer($id = null)
{

    $consumer = DB::table("consumer")->where("id",$id)->first();
     // dd($contractors);

    $route = (in_array(\Request::route()->getName(), ['user', config('chatify.path')]))
    ? 'user'
    : \Request::route()->getName();


    $dark_mode = 'light';    
    $messengerColor = '#fff';
    return view('Chatify::consumer.app', compact("consumer",
        'dark_mode',"route","messengerColor"));

}



}
