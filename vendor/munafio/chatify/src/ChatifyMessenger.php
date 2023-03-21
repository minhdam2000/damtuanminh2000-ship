<?php

namespace Chatify;

use Chatify\Http\Models\Message;
use Chatify\Http\Models\Favorite;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;
use Exception;
use DB;
use Carbon\Carbon;

class ChatifyMessenger
{
    /**
     * Allowed extensions to upload attachment
     * [Images / Files]
     *
     * @var
     */
    public static $allowed_images = array('png','jpg','jpeg','gif');
    public static $allowed_files  = array('zip','rar','txt','doc','docx','pdf',
                                    'csv','xls','xlsx',"sql");

    /**
     * This method returns the allowed image extensions
     * to attach with the message.
     *
     * @return array
     */
    public function getAllowedImages(){
        return self::$allowed_images;
    }

    /**
     * This method returns the allowed file extensions
     * to attach with the message.
     *
     * @return array
     */
    public function getAllowedFiles(){
        return self::$allowed_files;
    }

    /**
     * Returns an array contains messenger's colors
     *
     * @return array
     */
    public function getMessengerColors(){
        return [
            '1' => '#2180f3',
            '2' => '#2196F3',
            '3' => '#00BCD4',
            '4' => '#3F51B5',
            '5' => '#673AB7',
            '6' => '#4CAF50',
            '7' => '#FFC107',
            '8' => '#FF9800',
            '9' => '#ff2522',
            '10' => '#9C27B0',
        ];
    }

    /**
     * Pusher connection
     */
    public function pusher()
    {
        return new Pusher(
            config('chatify.pusher.key'),
            config('chatify.pusher.secret'),
            config('chatify.pusher.app_id'),
            [
                'cluster' => config('chatify.pusher.options.cluster'),
                'useTLS' => config('chatify.pusher.options.useTLS')
            ]
        );
    }

    /**
     * Trigger an event using Pusher
     *
     * @param string $channel
     * @param string $event
     * @param array $data
     * @return void
     */
    public function push($channel, $event, $data)
    {
        return $this->pusher()->trigger($channel, $event, $data);
    }

    /**
     * Authintication for pusher
     *
     * @param string $channelName
     * @param string $socket_id
     * @param array $data
     * @return void
     */
    public function pusherAuth($channelName, $socket_id, $data = []){
        return $this->pusher()->socket_auth($channelName, $socket_id, $data);
    }

    /**
     * Fetch message by id and return the message card
     * view as a response.
     *
     * @param int $id
     * @return array
     */
    public function fetchMessage($id){
        $attachment = $attachment_type = $attachment_title = null;
        $msg = Message::where('id',$id)->first();

        // If message has attachment
        if($msg->attachment){
            // Get attachment and attachment title
            $att = explode(',',$msg->attachment);
            $attachment       = $att[0];
            $attachment_title = $att[1];

            // determine the type of the attachment
            $ext = pathinfo($attachment, PATHINFO_EXTENSION);
            $attachment_type = in_array($ext,$this->getAllowedImages()) ? 'image' : 'file';
        }

        $user = DB::table("users")->where("id",$msg->from_id)->first(); 
        return [
            'id' => $msg->id,
            'from_id' => $msg->from_id,
            'to_id' => $msg->to_id,
            "user_name"=>$user->name,
            'message' => $msg->body,
            'attachment' => [$attachment, $attachment_title, $attachment_type],
            'time' => $msg->created_at->diffForHumans(),
            'fullTime' => $msg->created_at,
            'viewType' => ($msg->from_id == Auth::user()->id) ? 'sender' : 'default',
            'seen' => $msg->seen,
            'type'=>"user",
            'pin'=>-1,
            'avatar'=> $user->avatar
        ];
    }


 public function fetchMessageForCalender($id){
        $attachment = $attachment_type = $attachment_title = null;
        $msg = DB::table("calender_messages")->where('id',$id)->first();

        // If message has attachment
        if($msg->attachment){
            // Get attachment and attachment title
            $att = explode(',',$msg->attachment);
            $attachment       = $att[0];
            $attachment_title = $att[1];

            // determine the type of the attachment
            $ext = pathinfo($attachment, PATHINFO_EXTENSION);
            $attachment_type = in_array($ext,$this->getAllowedImages()) ? 'image' : 'file';
        }


        // $attachment = $msg->attachment;
        // $attachment_title = "oke";
        // $attachment_type = "file";
    // }
    
            $viewType = 'default' ;
if (Auth::check()) {
        if ($msg->user_id == Auth::user()->id){
            $to_id = 0;
            $from_id = $msg->user_id ; 
            $viewType = "sender";
        }else{
            $from_id = 0;
            $to_id = $msg->user_id ; 
            $viewType = 'default';

        }
    }else{
         $from_id = 0;
            $to_id = $msg->user_id ;
            $viewType = 'default' ;
    }

        if($msg->user_id > 0){
          $check = DB::table("users")->where("id",$msg->user_id)->first();
        if($check != null){
        $avatar = DB::table("users")->where("id",$msg->user_id)->first()->avatar; 
        $name = DB::table("users")->where('id',$msg->user_id)->first()->name;
        }else{
             $name = "old user";
        $avatar = "/js-css/img/icon/avatar.png";
        }
    }else{
        if(isset($_COOKIE['guest_id'])){
            if ($msg->user_id  == $_COOKIE['guest_id']*-1){
                $viewType = "sender";
            }
        }
        $name = DB::table("schedule_guest")->where('id',$msg->user_id*-1)->first()->name;
        $avatar = "/js-css/img/icon/avatar.png";


    }
        $seen = 1;
        // print_r( $msg->body."<br>");
        return [
            'id' => $msg->id,
            'from_id' => $from_id,
            'to_id' => $to_id,
            "user_name"=>$name,
            'message' => $msg->body,
            'attachment' => [$attachment, $attachment_title, $attachment_type],
            'time' => Carbon::parse($msg->created_at)->diffForHumans(),
            'fullTime' => $msg->created_at,
            'viewType' => $viewType,
            'seen' => $seen,
            'type'=>"schedule",
            'pin'=>$msg->pin,
            'storage'=>$msg->storage,
            'avatar'=> $avatar
        ];
    }


 public function fetchMessageForBuild($id){
        $attachment = $attachment_type = $attachment_title = null;
        $msg = DB::table("building_messages")->where('id',$id)->first();

        // If message has attachment
        if($msg->attachment){
            // Get attachment and attachment title
            $att = explode(',',$msg->attachment);
            $attachment       = $att[0];
            $attachment_title = $att[1];

            // determine the type of the attachment
            $ext = pathinfo($attachment, PATHINFO_EXTENSION);
            $attachment_type = in_array($ext,$this->getAllowedImages()) ? 'image' : 'file';
        }


        // $attachment = $msg->attachment;
        // $attachment_title = "oke";
        // $attachment_type = "file";
    // }
    
            $viewType = 'default' ;
if (Auth::check()) {
        if ($msg->user_id == Auth::user()->id){
            $to_id = 0;
            $from_id = $msg->user_id ; 
            $viewType = "sender";
        }else{
            $from_id = 0;
            $to_id = $msg->user_id ; 
            $viewType = 'default';

        }
    }else{
         $from_id = 0;
            $to_id = $msg->user_id ;
            $viewType = 'default' ;
    }

        if($msg->user_id > 0){
          $check = DB::table("users")->where("id",$msg->user_id)->first();
        if($check != null){
        $avatar = DB::table("users")->where("id",$msg->user_id)->first()->avatar; 
        $name = DB::table("users")->where('id',$msg->user_id)->first()->name;
        }else{
             $name = "old user";
        $avatar = "/js-css/img/icon/avatar.png";
        }
    }else{
        if(isset($_COOKIE['guest_id'])){
            if ($msg->user_id  == $_COOKIE['guest_id']*-1){
                $viewType = "sender";
            }
        }
        $name = DB::table("schedule_guest")->where('id',$msg->user_id*-1)->first()->name;
        $avatar = "/js-css/img/icon/avatar.png";


    }
        $seen = 1;
        // print_r( $msg->body."<br>");
        return [
            'id' => $msg->id,
            'from_id' => $from_id,
            'to_id' => $to_id,
            "user_name"=>$name,
            'message' => $msg->body,
            'attachment' => [$attachment, $attachment_title, $attachment_type],
            'time' => Carbon::parse($msg->created_at)->diffForHumans(),
            'fullTime' => $msg->created_at,
            'viewType' => $viewType,
            'seen' => $seen,
            'type'=>"schedule",
            'pin'=>$msg->pin,
            'storage'=>$msg->storage,
            'avatar'=> $avatar
        ];
    }


public function fetchMessageForConsumer($id){
        $attachment = $attachment_type = $attachment_title = null;
        $msg = DB::table("consumer_messages")->where('id',$id)->first();

        // If message has attachment
        if($msg->attachment){
            // Get attachment and attachment title
            $att = explode(',',$msg->attachment);
            $attachment       = $att[0];
            $attachment_title = $att[1];

            // determine the type of the attachment
            $ext = pathinfo($attachment, PATHINFO_EXTENSION);
            $attachment_type = in_array($ext,$this->getAllowedImages()) ? 'image' : 'file';
        }


        // $attachment = $msg->attachment;
        // $attachment_title = "oke";
        // $attachment_type = "file";
    // }
    
            $viewType = 'default' ;
if (Auth::check()) {
        if ($msg->user_id == Auth::user()->id){
            $to_id = 0;
            $from_id = $msg->user_id ; 
            $viewType = "sender";
        }else{
            $from_id = 0;
            $to_id = $msg->user_id ; 
            $viewType = 'default';

        }
    }else{
         $from_id = 0;
            $to_id = $msg->user_id ;
            $viewType = 'default' ;
    }

        if($msg->user_id > 0){
          $check = DB::table("users")->where("id",$msg->user_id)->first();
        if($check != null){
        $avatar = DB::table("users")->where("id",$msg->user_id)->first()->avatar; 
        $name = DB::table("users")->where('id',$msg->user_id)->first()->name;
        }else{
             $name = "old user";
        $avatar = "/js-css/img/icon/avatar.png";
        }
    }else{
        if(isset($_COOKIE['guest_id'])){
            if ($msg->user_id  == $_COOKIE['guest_id']*-1){
                $viewType = "sender";
            }
        }
        $name = DB::table("schedule_guest")->where('id',$msg->user_id*-1)->first()->name;
        $avatar = "/js-css/img/icon/avatar.png";


    }
        $seen = 1;
        // print_r( $msg->body."<br>");
        return [
            'id' => $msg->id,
            'from_id' => $from_id,
            'to_id' => $to_id,
            "user_name"=>$name,
            'message' => $msg->body,
            'attachment' => [$attachment, $attachment_title, $attachment_type],
            'time' => Carbon::parse($msg->created_at)->diffForHumans(),
            'fullTime' => $msg->created_at,
            'viewType' => $viewType,
            'seen' => $seen,
            'type'=>"schedule",
            'pin'=>$msg->pin,
            'storage'=>$msg->storage,
            'avatar'=> $avatar
        ];
    }




 public function fetchMessageForSale($id){
        $attachment = $attachment_type = $attachment_title = null;
        $msg = DB::table("zone_messages")->where('id',$id)->first();

        // If message has attachment
        if($msg->attachment){
            // Get attachment and attachment title
            $att = explode(',',$msg->attachment);
            $attachment       = $att[0];
            $attachment_title = $att[1];

            // determine the type of the attachment
            $ext = pathinfo($attachment, PATHINFO_EXTENSION);
            $attachment_type = in_array($ext,$this->getAllowedImages()) ? 'image' : 'file';
        }


        // $attachment = $msg->attachment;
        // $attachment_title = "oke";
        // $attachment_type = "file";
    // }
    
            $viewType = 'default' ;
if (Auth::check()) {
        if ($msg->user_id == Auth::user()->id){
            $to_id = 0;
            $from_id = $msg->user_id ; 
            $viewType = "sender";
        }else{
            $from_id = 0;
            $to_id = $msg->user_id ; 
            $viewType = 'default';

        }
    }else{
         $from_id = 0;
            $to_id = $msg->user_id ;
            $viewType = 'default' ;
    }

        if($msg->user_id > 0){
          $check = DB::table("users")->where("id",$msg->user_id)->first();
        if($check != null){
        $avatar = DB::table("users")->where("id",$msg->user_id)->first()->avatar; 
        $name = DB::table("users")->where('id',$msg->user_id)->first()->name;
        }else{
             $name = "old user";
        $avatar = "/js-css/img/icon/avatar.png";
        }
    }else{
        if(isset($_COOKIE['guest_id'])){
            if ($msg->user_id  == $_COOKIE['guest_id']*-1){
                $viewType = "sender";
            }
        }
        $name = DB::table("schedule_guest")->where('id',$msg->user_id*-1)->first()->name;
        $avatar = "/js-css/img/icon/avatar.png";


    }
        $seen = 1;
        // print_r( $msg->body."<br>");
        return [
            'id' => $msg->id,
            'from_id' => $from_id,
            'to_id' => $to_id,
            "user_name"=>$name,
            'message' => $msg->body,
            'attachment' => [$attachment, $attachment_title, $attachment_type],
            'time' => Carbon::parse($msg->created_at)->diffForHumans(),
            'fullTime' => $msg->created_at,
            'viewType' => $viewType,
            'seen' => $seen,
            'type'=>"schedule",
            'pin'=>$msg->pin,
            'storage'=>$msg->storage,
            'avatar'=> $avatar
        ];
    }

    public function fetchMessageForSchedule($id){
        $attachment = $attachment_type = $attachment_title = null;
        $msg = DB::table("schedule_messages")->where('id',$id)->first();

        // If message has attachment
        if($msg->attachment){
            // Get attachment and attachment title
            $att = explode(',',$msg->attachment);
            $attachment       = $att[0];
            $attachment_title = $att[1];

            // determine the type of the attachment
            $ext = pathinfo($attachment, PATHINFO_EXTENSION);
            $attachment_type = in_array($ext,$this->getAllowedImages()) ? 'image' : 'file';
        }


        // $attachment = $msg->attachment;
        // $attachment_title = "oke";
        // $attachment_type = "file";
    // }
    
            $viewType = 'default' ;
if (Auth::check()) {
        if ($msg->user_id == Auth::user()->id){
            $to_id = 0;
            $from_id = $msg->user_id ; 
            $viewType = "sender";
        }else{
            $from_id = 0;
            $to_id = $msg->user_id ; 
            $viewType = 'default';

        }
    }else{
         $from_id = 0;
            $to_id = $msg->user_id ;
            $viewType = 'default' ;
    }

        if($msg->user_id > 0){
        $check = DB::table("users")->where("id",$msg->user_id)->first();
        if($check != null){
        $avatar = DB::table("users")->where("id",$msg->user_id)->first()->avatar; 
        $name = DB::table("users")->where('id',$msg->user_id)->first()->name;
        }else{
             $name = "old user";
        $avatar = "/js-css/img/icon/avatar.png";
        }
    }else{
        if(isset($_COOKIE['guest_id'])){
            if ($msg->user_id  == $_COOKIE['guest_id']*-1){
                $viewType = "sender";
            }
        }
        $name = DB::table("schedule_guest")->where('id',$msg->user_id*-1)->first()->name;
        $avatar = "/js-css/img/icon/avatar.png";


    }
        $seen = 1;
        // print_r( $msg->body."<br>");
        return [
            'id' => $msg->id,
            'from_id' => $from_id,
            'to_id' => $to_id,
            "user_name"=>$name,
            'message' => $msg->body,
            'attachment' => [$attachment, $attachment_title, $attachment_type],
            'time' => Carbon::parse($msg->created_at)->diffForHumans(),
            'fullTime' => $msg->created_at,
            'viewType' => $viewType,
            'seen' => $seen,
            'type'=>"schedule",
            'pin'=>$msg->pin,
            'avatar'=> $avatar
        ];
    }

 public function fetchMessageForThread($id){
        $attachment = $attachment_type = $attachment_title = null;
        $msg = DB::table("schedule_sub_messages")->where('id',$id)->first();

        // If message has attachment
        if($msg->attachment){
            // Get attachment and attachment title
            $att = explode(',',$msg->attachment);
            $attachment       = $att[0];
            $attachment_title = $att[1];

            // determine the type of the attachment
            $ext = pathinfo($attachment, PATHINFO_EXTENSION);
            $attachment_type = in_array($ext,$this->getAllowedImages()) ? 'image' : 'file';
        }


        // $attachment = $msg->attachment;
        // $attachment_title = "oke";
        // $attachment_type = "file";
    // }
            $viewType = 'default' ;
      if (Auth::check()) {
        if ($msg->user_id == Auth::user()->id){
            $to_id = 0;
            $from_id = $msg->user_id ; 
            $viewType = "sender";
        }else{
            $from_id = 0;
            $to_id = $msg->user_id ; 
            $viewType = 'default';

        }
    }else{
         $from_id = 0;
            $to_id = $msg->user_id ;
            $viewType = 'default' ;
    }

        if($msg->user_id > 0){
        $check = DB::table("users")->where("id",$msg->user_id)->first();
        if($check != null){
        $avatar = DB::table("users")->where("id",$msg->user_id)->first()->avatar; 
        $name = DB::table("users")->where('id',$msg->user_id)->first()->name;
        }else{
             $name = "old user";
        $avatar = "/js-css/img/icon/avatar.png";
        }
    }else{
        if(isset($_COOKIE['guest_id'])){
            if ($msg->user_id  == $_COOKIE['guest_id']*-1){
                $viewType = "sender";
            }
        }
        $name = DB::table("schedule_guest")->where('id',$msg->user_id*-1)->first()->name;
        $avatar = "/js-css/img/icon/avatar.png";


    }
        $seen = 1;
        // print_r( $msg->body."<br>");
        return [
            'id' => $msg->id,
            'from_id' => $from_id,
            'to_id' => $to_id,
            "user_name"=>$name,
            'message' => $msg->body,
            'attachment' => [$attachment, $attachment_title, $attachment_type],
            'time' => Carbon::parse($msg->created_at)->diffForHumans(),
            'fullTime' => $msg->created_at,
            'viewType' => $viewType,
            'seen' => $seen,
            'type'=>"thread",
            'pin'=>$msg->pin,
            'avatar'=> $avatar
        ];
    }

        public function fetchMessageForGroup($id){
        $attachment = $attachment_type = $attachment_title = null;
        $msg = DB::table("old_messages")->where('id',$id)->first();

        // If message has attachment
        if($msg->attachment){
            // Get attachment and attachment title
            $att = explode(',',$msg->attachment);
            $attachment       = $att[0];
            $attachment_title = $att[1];

            // determine the type of the attachment
            $ext = pathinfo($attachment, PATHINFO_EXTENSION);
            $attachment_type = in_array($ext,$this->getAllowedImages()) ? 'image' : 'file';
        }

        $seen = 1;
        $participant = DB::table("participants")->where('thread_id',$msg->thread_id)
        ->where('user_id',$msg->user_id)->first();
         if ($participant->last_read === null || $participant->updated_at > $participant->last_read) {
                $seen = 0;
            }
        if ($msg->user_id == Auth::user()->id){
            $to_id = 0;
            $from_id = $msg->user_id ; 
        }else{
            $from_id = 0;
            $to_id = $msg->user_id ; 

        }
        $user = DB::table("users")->where("id",$msg->user_id)->first(); 
        $name = DB::table("users")->where('id',$msg->user_id)->first()->name;
        // print_r( $msg->body."<br>");
        return [
            'id' => $msg->id,
            'from_id' => $from_id,
            'to_id' => $to_id,
            "user_name"=>$name,
            'message' => $msg->body,
            'attachment' => [$attachment, $attachment_title, $attachment_type],
            'time' => Carbon::parse($msg->created_at)->diffForHumans(),
            'fullTime' => $msg->created_at,
            'viewType' => ($msg->user_id == Auth::user()->id) ? 'sender' : 'default',
            'seen' => $seen,
            'type'=>"group",
            'pin'=>-1,
            'avatar'=> $user->avatar
        ];
    }

    /**
     * Return a message card with the given data.
     *
     * @param array $data
     * @param string $viewType
     * @return void
     */
    public function messageCard($data, $viewType = null){
        $data['viewType'] = ($viewType) ? $viewType : $data['viewType'];
        return view('Chatify::layouts.messageCard',$data)->render();
    }
  public function messageCardSale($data, $viewType = null){
        $data['viewType'] = ($viewType) ? $viewType : $data['viewType'];
        return view('Chatify::saleLayouts.messageCard',$data)->render();
    }
  public function messageCardBuild($data, $viewType = null){
        $data['viewType'] = ($viewType) ? $viewType : $data['viewType'];
        return view('Chatify::buildLayouts.messageCard',$data)->render();
    }
      public function messageCardCalender($data, $viewType = null){
        $data['viewType'] = ($viewType) ? $viewType : $data['viewType'];
        return view('Chatify::calenderLayouts.messageCard',$data)->render();
    }


    /**
     * Default fetch messages query between a Sender and Receiver.
     *
     * @param int $user_id
     * @return Collection
     */
    public function fetchMessagesQuery($user_id){
        return Message::where('from_id',Auth::user()->id)->where('to_id',$user_id)
                    ->orWhere('from_id',$user_id)->where('to_id',Auth::user()->id);
    }

    /**
     * create a new message to database
     *
     * @param array $data
     * @return void
     */
    public function newMessage($data){
        $message = new Message();
        $message->id = $data['id'];
        $message->type = $data['type'];
        $message->from_id = $data['from_id'];
        $message->to_id = $data['to_id'];
        $message->body = $data['body'];
        $message->attachment = $data['attachment'];
        $message->save();
    }

    /**
     * Make messages between the sender [Auth user] and
     * the receiver [User id] as seen.
     *
     * @param int $user_id
     * @return bool
     */
    public function makeSeen($user_id){
        Message::Where('from_id',$user_id)
                ->where('to_id',Auth::user()->id)
                ->where('seen',0)
                ->update(['seen' => 1]);
        return 1;
    }

    /**
     * Get last message for a specific user
     *
     * @param int $user_id
     * @return Collection
     */
    public function getLastMessageQuery($user_id){
        return self::fetchMessagesQuery($user_id)->orderBy('created_at','DESC')->latest()->first();
    }

    /**
     * Count Unseen messages
     *
     * @param int $user_id
     * @return Collection
     */
    public function countUnseenMessages($user_id){
        return Message::where('from_id',$user_id)->where('to_id',Auth::user()->id)->where('seen',0)->count();
    }

    /**
     * Get user list's item data [Contact Itme]
     * (e.g. User data, Last message, Unseen Counter...)
     *
     * @param int $messenger_id
     * @param Collection $user
     * @return void
     */
    public function getContactItem($messenger_id, $user){
        // get last message
        $lastMessage = self::getLastMessageQuery($user->id);

        // Get Unseen messages counter
        $unseenCounter = self::countUnseenMessages($user->id);

        return view('Chatify::layouts.listItem', [
            'get' => 'users',
            'user' => $user,
            'lastMessage' => $lastMessage,
            'unseenCounter' => 0,
            'type'=>'user',
            'id' => $messenger_id,
        ])->render();
    }

    public function getGroupItem($messenger_id, $thread){
        // get last message
        // $lastMessage = self::getLastMessageQuery($user->id);

        // // Get Unseen messages counter
        // $unseenCounter = self::countUnseenMessages($user->id);

        // dd($thread->latestMessage);
        return view('Chatify::layouts.listItem', [
            'get' => 'group',
            'user' => Auth(),
            'lastMessage' => $thread->latestMessage,
            'unseenCounter' => 0,
            'type'=>'user',
            'id' => $messenger_id,
        ])->render();
    }


    /**
     * Check if a user in the favorite list
     *
     * @param int $user_id
     * @return boolean
     */
    public function inFavorite($user_id){
        return Favorite::where('user_id', Auth::user()->id)
                        ->where('favorite_id', $user_id)->count() > 0
                        ? true : false;

    }

    /**
     * Make user in favorite list
     *
     * @param int $user_id
     * @param int $star
     * @return boolean
     */
    public function makeInFavorite($user_id, $action){
        if ($action > 0) {
            // Star
            $star = new Favorite();
            $star->id = rand(9,99999999);
            $star->user_id = Auth::user()->id;
            $star->favorite_id = $user_id;
            $star->save();
            return $star ? true : false;
        }else{
            // UnStar
            $star = Favorite::where('user_id',Auth::user()->id)->where('favorite_id',$user_id)->delete();
            return $star ? true : false;
        }
    }

    /**
     * Get shared photos of the conversation
     *
     * @param int $user_id
     * @return array
     */
    public function getSharedPhotos($user_id,$type){
        $images = array(); // Default

        // Get messages
        if($type == "user"){
        $msgs = $this->fetchMessagesQuery($user_id)->orderBy('created_at','DESC');
        }elseif($type == "schedule"){
 $msgs =  DB::table("schedule_messages")->where('schedule_id',$user_id)->orderBy('created_at','DESC'); 
 }elseif($type == "sale"){
 $msgs =  DB::table("zone_messages")->where('zone_id',$user_id)->orderBy('created_at','DESC');
        }elseif($type == "thread"){
 $msgs =  DB::table("schedule_sub_messages")->where('messages_id',$user_id)->orderBy('created_at','DESC');   
}elseif($type == "build"){
 $msgs =  DB::table("building_messages")->where('building_id',$user_id)->orderBy('created_at','DESC');
        }
        else{
        $msgs =  DB::table("old_messages")->where('thread_id',$user_id)->orderBy('created_at','DESC');

        }

        if($msgs->count() > 0){
            foreach ($msgs->get() as $msg) {
                // If message has attachment
                if($msg->attachment){
                    $attachment = explode(',',$msg->attachment)[0]; // Attachment
                    // determine the type of the attachment
                    in_array(pathinfo($attachment, PATHINFO_EXTENSION), $this->getAllowedImages())
                    ? array_push($images, $attachment) : '';
                }
            }
        }
        return $images;

    }

  public function getSharedFiles($user_id,$type){
        $images = array(); // Default
        // Get messages
        if($type == "user"){
        $msgs = $this->fetchMessagesQuery($user_id)->orderBy('created_at','DESC');
        }elseif($type == "schedule"){
 $msgs =  DB::table("schedule_messages")->where('schedule_id',$user_id)->orderBy('created_at','DESC');
 }elseif($type == "sale"){
 $msgs =  DB::table("zone_messages")->where('zone_id',$user_id)->orderBy('created_at','DESC');
         }   elseif($type == "thread"){
 $msgs =  DB::table("schedule_sub_messages")->where('messages_id',$user_id)->orderBy('created_at','DESC');
        
        }
elseif($type == "build"){
 $msgs =  DB::table("building_messages")->where('building_id',$user_id)->orderBy('created_at','DESC');
        }
        else{
        $msgs =  DB::table("old_messages")->where('thread_id',$user_id)->orderBy('created_at','DESC');

        }
        
        if($msgs->count() > 0){
            foreach ($msgs->get() as $msg) {
                // If message has attachment
                if($msg->attachment){
                    // $attachment = explode(',',$msg->attachment)[0]; // Attachment
                    $attachment = $msg->attachment;
                    // determine the type of the attachment
                    in_array(pathinfo($attachment, PATHINFO_EXTENSION), $this->getAllowedFiles())
                    ? array_push($images, $attachment) : '';
                }
            }
        }
        return $images;

    }
    /**
     * Delete Conversation
     *
     * @param int $user_id
     * @return boolean
     */
    public function deleteConversation($user_id){
        try {
            foreach ($this->fetchMessagesQuery($user_id)->get() as $msg) {
                // delete from database
                $msg->delete();
                // delete file attached if exist
                if ($msg->attachment) {
                    $path = storage_path('app/public/'.config('chatify.attachments.folder').'/'.explode(',', $msg->attachment)[0]);
                    if(file_exists($path)){
                        @unlink($path);
                    }
                }
            }
            return 1;
        }catch(Exception $e) {
            return 0;
        }
    }

}