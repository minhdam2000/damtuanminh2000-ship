<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Session;
use Auth;
use App\Reply;
use App\Channel;
use App\Discussion;
use App\Like;
use App\User;
use DB;


class DiscussionsController extends Controller
{
    //

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

    public function create(){



        $channels = Channel::all();
      

        return view('discussions.create')->with('channels', $channels);

    }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required',
            // 'channel_id' => 'required',
            'content' => 'required'
        ]);





        $discussions = Discussion::create([
           'title' => $request->title,
           'channel_id' => 1,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'slug' => str_slug($request->title)
        ]);

      if ($request->file !== null){
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      $path = $file->store('discuss');

      $url = Storage::url($path);
      
      DB::table('discussions_url')->insert([
            'blog_id' => $discussions->id,
            'url' => $url
        ]);
}
}

        $discussions->save();



        Session::flash('success', 'Discussion added successfully');
        return redirect()->route('discussion', ['id' =>$discussions->id]);
    }

    public function show($id){

        
        $discussions = Discussion::where('id', $id)->first();

        $files =  DB::table('discussions_url')->where('blog_id', $id) ->limit(5)->get();
        $file_count =  DB::table('discussions_url')->where('blog_id', $id) ->count();
               

        return view('discussions.show', compact("discussions","files","file_count"));
    }


   public function getFile($id){

        $discussions = Discussion::where('id', $id)->first();

        $files =  DB::table('discussions_url')->where('blog_id', $id)->get();
        return view('discussions.file',compact('discussions','files',"id"));

  }


   public function getFileIcon($id){

        $discussions = Discussion::where('id', $id)->first();

        $files =  DB::table('discussions_url')->where('blog_id', $id)->get();

        return view('discussions.file-icon',compact('discussions','files',"id"));

  }


  public function editDiscuss(Request $request){
    $uid = DB::table('discussions')
              ->where('id', $request->id)->first()->user_id;

    if($uid !== Auth::id()){

        return redirect("/");
    }

 $affected = DB::table('discussions')
              ->where('id', $request->id)
              ->update(['title' => $request->title,'content' => $request->content]);
 return Redirect()->back()->with('notification',' Đã sửa thông tin thành công !');
  }

  function editDiscussFile(Request $request){
    $uid = DB::table('discussions')
              ->where('id', $request->id)->first()->user_id;
    if($uid !== Auth::id()){
      
        return redirect("/");
    }


    $title = $request->title;
  try{
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

      }
      // dd($title);
      $path = $file->store('discuss');

      $url = Storage::url($path);


       DB::table("discussions_url")->insert([
            'url' => $url,
            'blog_id'=>$request->id,
        ]);



      }


        }
catch (\Exception $e) { 
    return Redirect()->back()->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');;
               }

 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

}


function DeleteFileDiscuss($id){

    $bid = DB::table('discussions_url')
              ->where('id', $id)->first()->blog_id;

    $uid = DB::table('discussions')
              ->where('id', $bid)->first()->user_id;
  if($uid !== Auth::id()){
      
        return redirect("/");
    }


    // dd($id);
       DB::table("discussions_url")->where("id",$id)->delete();
 return Redirect()->back()->with('notification',' Đã xóa tệp tin !');

}
    public function delete($id){

    $uid = DB::table('discussions')
              ->where('id', $id)->first()->user_id;
      if($uid !== Auth::id()){
      
        return redirect("/");
    }


        Discussion::where('id', $id)->where('user_id', Auth::id())->delete();
        Reply::where('discussion_id', $id)->where('user_id', Auth::id())->delete();
        return redirect()->route('forum');
    }

    public function reply($id){

        $discussions = Discussion::find($id);

        $reply = Reply::create([
            'user_id' =>Auth::id(),
            'discussion_id'=> $id,
            'content' => request()->content

           
        ]);

   if (request()->file !== null){
foreach (request()->file as $file) {
      $file_name = $file->getClientOriginalName();
      // dd( $file_name);
// Storage::disk('public')->put($file_name, $file);
      $path = $file->store('discuss');

      $url = Storage::url($path);
      
      DB::table('replies_url')->insert([
            'blog_id' => $reply->id,
            'url' => $url
        ]);
}
}


     $this->sendMessage("Đã có người bình luận về bài viết của bạn" ,0, $discussions->user_id);
        Session::flash('success', 'Replied to this discussion');

        return redirect()->back();
    }

    public function likeDetail($id){
        $user_ids = Like::where("reply_id",$id)->pluck('user_id')->toArray();
        $users = DB::table("users")
        ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
        ->select("users.name as name","roles.name as role")
        ->whereIn("users.id",$user_ids)->get();
        return $users;
    }
}
