<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManagerStatic as Image;

use App\User;
use App\Credential;
use App\Broker;
use DB;
use File;
use App\Consumer;
use App\Staff;
use App\Accountant;

use App\Project;
use App\Area;
use App\Zone;
use App\Historyzone;
use Mail;

use Illuminate\Support\Str;
use Illuminate\Http\Request;


use Excel;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\SimpleType\TblWidth;



class NewFinanceController extends Controller
{   
 public function newfinance(){

 $allow_list = [28,198,180,179];

    if(!in_array(Auth()->user()->id, $allow_list) && !$this->checkLead()){

        return redirect("/");
    }
$finances  = DB::table("finance")
    ->leftJoin('finance_tag', 'finance.id', '=', 'finance_tag.finance_id')
    ->leftJoin('tags', 'finance_tag.tag_id', '=', 'tags.id')
    ->select("finance.content as content"
      ,"finance.id as id","finance.type as type","finance.date as date"
      ,"finance.target as target","finance.amount as amount","finance.note as note"
      ,"finance.type as type","finance.created_at as time"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )
    ->groupBy('finance.id')
            ->get();

             $tag_groups = DB::table("tag_group")->get();
     $tag_groups_arr = [];
    foreach($tag_groups as $tag){
        $tagArr = explode(",", $tag->tag);
        // dd(DB::table("tags")->select("name")->whereIn("id",$tagArr)->get()->toArray());
        $data = implode(";",DB::table("tags")->select("name")->whereIn("id",$tagArr)->pluck("name")->toArray());
        $tag->str = $data;
        $tag_groups_arr[$tag->id]=$data;
    }
    // dd($finances);

    return view('newfinance.new-finance',compact('finances',"tag_groups_arr"));
  }

public function addNewFinance(Request $req){

     try{



   $tagArr = [];

    $tags = explode(",", $req->tags);
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



// dd($req->type);
               $finance_id = DB::table("finance")->insertGetId([
                    'content'=>$req->content,
                    'date' => $req->date,
                    'target' => $req->target,
                    'amount' => $req->amount,
                    'date' => $req->date,
                    'note' => $req->note,
                    'type' => $req->type,
                ]);

            
           foreach ($tagArr as $tag) {
                 # code...
               DB::table("finance_tag")->insert([
                    'finance_id' => $finance_id,
                    'tag_id' => $tag
                ]);
          }


          // $group_tags =  $req->tagids;
          //   foreach ($group_tags as $group) {
          //        # code...
          //      DB::table("consumer_grouptag")->insert([
          //           'consumer_id' => $new_consumer->id,
          //           'group_id' => $group
          //       ]);
          // }

            return Redirect()->back()->with('notification',' Đã tạo file thành công ');

            }
                catch (\Exception $e) { 
                  dd($e);
                // return Redirect()->back()->with('warning',' Thiếu thông tin ');
                }

  }
   public function editfinance(Request $req){
          
    $tagArr = [];
    $tags = explode(",", $req->tag);
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
    // dd($tagArr);
    DB::table("finance_tag")->where("finance_id",$req->id)->delete();

              foreach ($tagArr as $tag) {
         # code...
       DB::table("finance_tag")->insert([
            'finance_id' => $req->id,
            'tag_id' => $tag

        ]);
       }

        DB::table("finance")->where('id', $req->id)->update([
            'content'=>$req->content,
            'date' => $req->date,
            'target' => $req->target,
            'amount' => $req->amount,
            'date' => $req->date,
            'note' => $req->note,
            'type' => $req->type,
        ]);

        /*DB::table("finance_tag")
        ->where("finance_id",$req->id)
        ->delete();
         $group_tags =  $req->tagids;
            foreach ($group_tags as $group) {
                 # code...
               DB::table("consumer_grouptag")->insert([
                    'consumer_id' => $req->id,
                    'group_id' => $group
                ]);
          }
*/
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }
    public function financeDelete($id){
        if(!$this->checkSaleMap()){
          return redirect("/");
        }

        DB::table("finance")->where("id",$id)->delete();
        return redirect()->back()->with("notification","Đã xóa file thành công1");
    }

    public function import(Request $request){
DB::table("finance_sheet")->update(["amount"=>0]);

$array = Excel::toArray([], request()->file('user_file'));
// dd($array);
$array = $array[0];
$flag = 0;
foreach($array as $row){
    if($flag ==0){
        $flag =1;
        continue;
    }
    $finance_id =   DB::table("finance")->insertGetId([
            'content'=>$row[0],
            'date' => $row[5],
            'target' => $row[1],
            'amount' =>  $row[2],
            'note' =>  $row[4],
            'type' =>  $row[3],
    ]);


    $tagArr = [];

    $tags = explode(",", $row[6]);
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


   foreach ($tagArr as $tag) {
         # code...
       DB::table("finance_tag")->insert([
            'finance_id' => $finance_id,
            'tag_id' => $tag
        ]);
  }




}



      return redirect()->back()->with('notification', 'Đã cập nhật tệp thành công!!');
    

}
 public function sqlfinance(Request $req){

     
       $sum = DB::table("finance_tag")->sum("amount");
       
       DB::table("finance")
    ->leftJoin('finance_tag', 'finance.id', '=', 'finance_tag.finance_id')
    ->leftJoin('tags', 'finance_tag.tag_id', '=', 'tags.id')
    ->select("finance.content as content"
      ,"finance.id as id","finance.type as type","finance.date as date"
      ,"finance.target as target","finance.amount as amount","finance.note as note"
      ,"finance.type as type","finance.created_at as time"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )
    ->groupBy('finance.id')
    ->sum("amount");
    dd($sum);
    }

}