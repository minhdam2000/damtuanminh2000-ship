<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use App\Reply;
use DB;
use App\Like;
class RepliesController extends Controller
{
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

    //
    public function like($id){
        $reply = Reply::find($id);

        $like = Like::create([
            'reply_id' => $id,
            'user_id' => Auth::id()
        ]);

        Session::flash('success', 'you liked the reply');

     $this->sendMessage("Đã có người thích trả lời của bạn" ,0, $reply->user_id);
        return redirect()->back();
    }

    public function unlike($id){
        $like = Like::where('reply_id', $id)->where('user_id', Auth::id())->first();

        $like->delete();

        Session::flash('success', 'you unliked this reply');

        return redirect()->back();
    }

    public function replyDelete($id){

        Reply::where('id', $id)->where('user_id', Auth::id())->delete();
 DB::table('replies_url')->where('blog_id', $id)->delete();
        return Redirect()->back()->with('notification',' Đã xóa bình luận !');
    }
}
