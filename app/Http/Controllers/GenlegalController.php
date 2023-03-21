<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Credential;
use App\Broker;
use DB;
use File;
use App\Consumer;
use App\Job;
use App\Jobmoniters;
use App\Staff;
use App\Accountant;
use App\Department;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class GenlegalController extends Controller
{	

//form

    public function getForm(){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
      
        // dd(Auth::user()->role_id);
        $form = DB::table("legal_form")->get();
        return view('genlegal.form', compact('form')); 
    }

  public function addNewForm(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

    $file = $req->file;
      $file_name = $file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');;

      }
      $path = $file->store('system');

      $url = Storage::url($path);

        DB::table("legal_form")->insert([

            'name' => $req->name,
            'url' => $url
        ]);
            return Redirect()->route('genlegal-form-list')->with('notification',' Đã tạo biểu mẫu thành công ');
    }

    public function editForm(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
          $file = $req->file;
      $file_name = $file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');;

      }
      $path = $file->store('system');

      $url = Storage::url($path);

        DB::table("legal_form")->where('id', $req->id)->update([
            'name' => $req->name,
            'url' => $url,
        ]);
        return Redirect()->route('genlegal-form-list')->with('notification', 'cập nhật thông tin thành công');
    }

    public function deleteForm(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
        // print($req);
        $data = $req->post();
        $flag = 0;
        foreach ($data as $key => $value){
            if(is_int($key)){
                // print($key);
                try{
                  
                    DB::table("legal_form")->where("id",intval($key))->delete();
                    DB::table("role_legal")->where("legal_id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->route('genlegal-form-list')->with('notification',' Đã xóa tất cả  quy trình');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa  quy trình');

        }
       
        

    }

    public function getFormInfo($id){
            // dd(Auth::user()->role_id);

    $roles = DB::table("role_legal")
    ->leftJoin('legal_form', 'legal_form.id', '=', 'role_legal.legal_id')
    ->leftJoin('department', 'department.id', '=', 'role_legal.user_role')
    ->where([['role_legal.legal_id',$id]])
    ->select("role_legal.id as id","legal_form.name as lname","department.name as dname"
    )->get();


    $legal = DB::table("legal_form")->where("id",$id)->first();
    $department = DB::table("department")->get();
   return view('genlegal.form-detail', compact('roles','department',"legal","id"));

        
    }

   public function addNewFormDetail(Request $req){
        DB::table("role_legal")->insert([
            'legal_id' => $req->id,
            'user_role' => $req->dept_id
        ]);
            return Redirect()->route('genlegal-form-detail', ['id' => $req->id])->with('notification',' Đã tạo quy trình thành công ');
    }

    // public function editStepTask(Request $req){
    //     DB::table("step_task")->where('id', $req->id)->update([
    //         'pos' => $req->pos
    //     ]);
    //     return Redirect()->route('genlegal-step-info', ['id' => $req->process_id])->with('notification', 'cập nhật thông tin thành công');
    // }

    public function deleteFormDetail(Request $req){
        // print($req);
        $data = $req->post();
        $flag = 0;
        foreach ($data as $key => $value){
            if(is_int($key)){
                // print($key);
                try{
                    DB::table("role_legal")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->route('genlegal-form-detail', ['id' => $req->substep_id])->with('notification',' Đã xóa tất cả  quy trình');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa  quy trình');

        }
       
        

    }



}