<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use DB;

class MessagesController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        $currentUserId = Auth::user()->id;
        $threads = Thread::getAllLatest($currentUserId)->get();
        return view('messenger.index', compact('threads', 'currentUserId'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list
        $userId = Auth::user()->id;
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        return view('messenger.show', compact('thread', 'users'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return view('messenger.create', compact('users'));
    }

      public function tran($id,$type)
    {
        $users = User::where('id', '!=', Auth::id())->get();

       $currentUserId = Auth::user()->id;

        $threads = Thread::getAllLatest($currentUserId)->get();
        return view('messenger.tran', compact('users','id','type','threads'));
    }


      public function edit($id)
    {
        // $users = User::where('id', '!=', Auth::id())->get();

        $thread = DB::table("threads")->where('id',$id)->first();
        $participant = DB::table("participants")->where('thread_id',$id)
    ->pluck('user_id')->toArray();

              
        $count = DB::table("participants")->where('thread_id',$id)
        ->where("user_id",Auth::User()->id)->count();

        if ($count <1){
          return redirect('chatify');
        }
        $users = User::where('id', '!=', Auth::id())->get();



        return view('messenger.edit', compact('participant','thread','users'));
    }
        public function delete($id)
    {
        // $users = User::where('id', '!=', Auth::id())->get();
              
        $count = DB::table("participants")->where('thread_id',$id)
        ->where("user_id",Auth::User()->id)->count();

        if ($count <1){
        return redirect('chatify');
        }
        DB::table("participants")->where('thread_id',$id)
        ->where("user_id",Auth::User()->id)->delete();



        return redirect('chatify');
    }



    /**
     * Stores a new message thread.
     *
     * @return mixed
     */

    
     public function editSubmit(Request $req)
    {
      $count = DB::table("participants")->where('thread_id',$req->id)
        ->where("user_id",Auth::User()->id)->count();

        if ($count <1){
          return redirect('chatify');
        }
       $url = "";
      if ($req->file !== null){

      $file = $req->file;
      $file_name = $file->getClientOriginalName();
      $path = $file->store('discuss');

      $url = Storage::url($path);
      

}

        $thread = Thread::where('id',$req->id)->update(
            [
                'subject' => $req->subject,
                'url' => $url
            ]
        );
        
        Thread::findOrFail($req->id)->addParticipant($req->recipients);
        


        return redirect('chatify');
    }

    public function store(Request $req)
    {


       $url = "";
      if ($req->file !== null){

      $file = $req->file;
      $file_name = $file->getClientOriginalName();
      $path = $file->store('discuss');

      $url = Storage::url($path);

      // dd($url);
      

}

        $thread = Thread::create(
            [
                'subject' => $req->subject,
                'user_id'   => Auth::user()->id,
                'url' => $url
            ]
        );
// dd($url);
        // Message
        DB::table("old_messages")->insert(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $req->message,
            ]
        );

        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon,
            ]
        );

            $thread->addParticipant($req->recipients);
        


        return redirect('chatify');
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */

    public function addUser(Request $req){

      $count = DB::table("participants")->where('thread_id',$req->id)
        ->where("user_id",Auth::User()->id)->count();

        if ($count <1){
          return redirect('chatify');
        }

            $thread = Thread::findOrFail($req->id);
            // $sid_array = $req->sid;

        $thread->addParticipant($req->sid);
      // foreach ($sid_array as $sid) {
      //     DB::table('job_users')->insert([
      //     'job_id' => $job->id,
      //     'user_id' => $sid
      // ]);

 return Redirect()->back()->with('notification',' Đã thêm thành viên thành công !');

}

    public function editAvatar(Request $req){

$html ="";
$count = DB::table("participants")->where('thread_id',$req->id)
        ->where("user_id",Auth::User()->id)->count();

        if ($count <1){
          return redirect('chatify');
        }


              if ($req->file !== null){
                $file = $req->file ;
                  $file_name = $file->getClientOriginalName();
                  $path = $file->store('discuss');

                  $url = Storage::url($path);
                 
                  DB::table('threads')
              ->where('id', $req->id)
              ->update(['url' => $url]);
            }



 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

    }

    public function addFile(Request $req){

      $count = DB::table("participants")->where('thread_id',$req->id)
        ->where("user_id",Auth::User()->id)->count();

        if ($count <1){
          return redirect('chatify');
        }

            $thread = Thread::findOrFail($req->id);

$html ="";



              if ($req->file !== null){
            $html = '<br><div class="form-group" id="listimg">';
            foreach ($req->file as $file) {
                  $file_name = $file->getClientOriginalName();
                  $path = $file->store('discuss');

                  $url = Storage::url($path);
                  $html =$html.'<a target="_blank" href="'.$url.'"><img style="width: 400px;margin-left: 3%;" src="'.$url.'" id="listimg" class="preview"></a>';

                  DB::table('mess_url')->insert([
                        'mess_id' => $req->id,
                        'url' => $url
                    ]);
            }
            $html = $html."</div>";
            }

            $mess =  Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => $html,
            ]
        );


 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

    }
    public function update($id,Request $req)
    {
      $count = DB::table("participants")->where('thread_id',$req->id)
        ->where("user_id",Auth::User()->id)->count();

        if ($count <1){
          return redirect('chatify');
        }
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        $thread->activateAllParticipants();

        // Message
        if($req->type == 0){
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => '<img style="width: 50px" src="/js-css/img/icon/like2.png">',
            ]
        );
        }else{
          $mess = "";
            if(strpos($req->message, "http") > -1){
                $mess_arr = explode(" ",$req->message);

                foreach ($mess_arr as $word) {

                  if(strpos($word, "http") > -1){
                       $mess = '<a target="_blank" href="'.$word.'">'.$word."</a>";
                  }else{
                    $mess = " ". $word;
                  }
                }
            }else{
              $mess = $req->message;
            }
           $mess =  Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => $mess,
            ]
        );
            


        }

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
            // $thread->addParticipant($req->recipients);
        

        return redirect('messages/' . $id);
    }


   public function getFileIcon($id){

      $count = DB::table("participants")->where('thread_id',$id)
        ->where("user_id",Auth::User()->id)->count();

        if ($count <1){
          return redirect('chatify');
        }
        $thread = Thread::findOrFail($id);

        $files =  DB::table('mess_url')->where('mess_id', $id)->get();

        return view('messenger.file-icon',compact('thread','files',"id"));

  }

}