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

class GenstaffprocessController extends Controller
{	
	public function getProcess(){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

            // dd(Auth::user()->role_id);
            $process = DB::table("staff_process")->get();
            return view('genstaff.process', compact('process'));
        
    }
  public function getProcessLock($id){
           if(!$this->checkAdmin()){
                return redirect("/");
            }
            $process = DB::table("staff_process_lock")->get();
            return view('genstaff.process-lock', compact('process',"id"));
  }

    public function getProcessInfo($id){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

            // dd(Auth::user()->role_id);
    $proccess_name =  DB::table("staff_process")->where("id",$id)->first()->name;
    $processstep = DB::table("staff_process_step")
     ->leftJoin('staff_process', 'staff_process_step.process_id', '=', 'staff_process.id')
    ->leftJoin('staff_step', 'staff_process_step.step_id', '=', 'staff_step.id')
    ->where([['staff_process.id',$id]])
    ->select("staff_process_step.id as id", "staff_process.id as pid", "staff_step.id as sid"
    ,"staff_process.name as process_name", "staff_step.name as step_name","staff_process_step.pos as pos")->get();

    $step_arr = DB::table("staff_process_step")
     ->leftJoin('staff_process', 'staff_process_step.process_id', '=', 'staff_process.id')
    ->leftJoin('staff_step', 'staff_process_step.step_id', '=', 'staff_step.id')
    ->where([['staff_process.id',$id]])
    ->pluck('staff_step.id')->toArray();

    $step = DB::table("staff_step")->whereNotIn('id', $step_arr)
                    ->get();
   return view('genstaff.process-detail', compact('id','proccess_name','processstep','step'));

        
    }
  
  
	public function addNewProcess(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
        DB::table("staff_process")->insert([
            'name' => $req->name,
        ]);
            return Redirect()->route('genstaff-process-list')->with('notification',' Đã tạo quy trình thành công ');
	}

    public function editProcess(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }  

        DB::table("staff_process")->where('id', $req->id)->update([
            'name' => $req->name,
        ]);
        return Redirect()->route('genstaff-process-list')->with('notification', 'cập nhật thông tin thành công');
    }

    public function deleteProcess(Request $req){
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
                  
                    DB::table("staff_process")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->route('genstaff-process-list')->with('notification',' Đã xóa tất cả  quy trình');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa  quy trình');

        }
       
        

    }

public function addNewProcessLock(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
      $file = $req->file;
      $path = $file->store('system');
      $url = Storage::url($path);

        DB::table("staff_process_lock")->insert([
            'name' => $req->name,
            'process_id' => $req->pid,
            'url' => $url,
        ]);
            return Redirect()->back()->with('notification',' Đã tạo quy trình thành công ');
    }

    public function editProcessLock(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

      $file = $req->file;
      $path = $file->store('system');
      $url = Storage::url($path);


        DB::table("staff_process_lock")->where('id', $req->id)->update([
            'name' => $req->name,
            'url' => $url,
        ]);
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

public function deleteProcessLock(Request $req){
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
                  
                    DB::table("staff_process_lock")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->route('genstaff-process-list')->with('notification',' Đã xóa tất cả  quy trình');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa  quy trình');

        }
       
        

    }

        public function addNewProcessStep(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

        DB::table("staff_process_step")->insert([
            'process_id' => $req->process_id,
            'step_id' => $req->step,
            'pos' => $req->pos,
        ]);
            return Redirect()->route('genstaff-process-info', ['id' => $req->process_id])->with('notification',' Đã tạo quy trình thành công ');
    }

     public function addNewProcessStep2(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
              $step_id =    DB::table("staff_step")->insertGetId([
                            'name' => $req->step
                        ]);


        DB::table("staff_process_step")->insert([
            'process_id' => $req->process_id,
            'step_id' => $step_id,
            'pos' => $req->pos,
        ]);
            return Redirect()->route('genstaff-process-info', ['id' => $req->process_id])->with('notification',' Đã tạo quy trình thành công ');
    }


    public function editProcessStep(Request $req){
    if(!$this->checkAdmin()){
        return redirect("/");
      }

        DB::table("staff_process")->where('id', $req->process_id)->update([

            'name'=>$req->pname
        ]);

        $step_id = DB::table("staff_process_step")->where('id', $req->id)->first()->step_id;
        DB::table("staff_step")->where('id', $step_id)->update([

            'name'=>$req->sname
        ]);

        DB::table("staff_process_step")->where('id', $req->id)->update([
            'pos' => $req->pos,
        ]);

        return Redirect()->route('genstaff-process-info', ['id' => $req->process_id])->with('notification', 'cập nhật thông tin thành công');
    }

    public function deleteProcessStep(Request $req){
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
                  
                    DB::table("staff_process_step")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->route('genstaff-process-info', ['id' => $req->process_id])->with('notification',' Đã xóa tất cả quy trình');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa quy trình');

        }
       
        

    }


//task

    public function getTask(){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

        // dd(Auth::user()->role_id);
        $task = DB::table("staff_task")->get();
        return view('genstaff.task', compact('task')); 
    }


  
  
    public function addNewTask(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }


      DB::table("staff_task")->insert([
            'name' => $req->name,
        ]);
            return Redirect()->route('genstaff-task-list')->with('notification',' Đã tạo quy trình thành công ');
    }

    public function editTask(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

  DB::table("staff_task")->where('id', $req->id)->update([
            'name' => $req->name,
        ]);
        return Redirect()->route('genstaff-task-list')->with('notification', 'cập nhật thông tin thành công');
    }

    public function deleteTask(Request $req){
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
                  
                    DB::table("staff_task")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->route('genstaff-task-list')->with('notification',' Đã xóa tất cả nhiệm vụ');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa nhiệm vụ');

        }
       
        

    }



//step

    public function getStep(){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

        // dd(Auth::user()->role_id);
        $step = DB::table("staff_step")->get();
        return view('genstaff.step', compact('step')); 
    }

  public function addNewStep(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

        DB::table("staff_step")->insert([
            'name' => $req->name,
        ]);
            return Redirect()->route('genstaff-process-list')->with('notification',' Đã tạo quy trình thành công ');
    }

    public function editStep(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

        DB::table("staff_step")->where('id', $req->id)->update([
            'name' => $req->name,
        ]);
        return Redirect()->route('genstaff-process-list')->with('notification', 'cập nhật thông tin thành công');
    }

    public function deleteStep(Request $req){
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
                  
                    DB::table("staff_step")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->route('genstaff-process-list')->with('notification',' Đã xóa tất cả  quy trình');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa  quy trình');

        }
       
        

    }

    public function getStepInfo($pid,$id){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

            // dd(Auth::user()->role_id);
    $step_name =  DB::table("staff_step")->where("id",$id)->first()->name;

    $step_task = DB::table("staff_step_task")
    ->leftJoin('staff_task', 'staff_step_task.task_id', '=', 'staff_task.id')
    ->leftJoin('staff_step', 'staff_step_task.step_id', '=', 'staff_step.id')
    ->where([['staff_step.id',$id]])
    ->select("staff_step_task.id as id","staff_step_task.pos as pos","staff_step.name as step_name","staff_task.name as task_name",
        "staff_task.type as type"
    )->get();

    $task_arr =  DB::table("staff_step_task")
    ->leftJoin('staff_task', 'staff_step_task.task_id', '=', 'staff_task.id')
    ->leftJoin('staff_step', 'staff_step_task.step_id', '=', 'staff_step.id')
    ->where([['staff_step.id',$id]])
    ->pluck('staff_task.id')->toArray();

    $task = DB::table("staff_task")->whereNotIn('id', $task_arr)
                    ->get();

   return view('genstaff.step-detail', compact('pid','id','step_name','step_task','task'));

    }

   public function addNewStepTask(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

        DB::table("staff_step_task")->insert([
            'step_id' => $req->step_id,
            'task_id' => $req->task
        ]);
            return Redirect()->back()->with('notification',' Đã tạo quy trình thành công ');
    }

    public function addNewStepTask2(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }    
      $task_id =    DB::table("staff_task")->insertGetId([
                            'name' => $req->task
                        ]);



        DB::table("staff_step_task")->insert([
            'step_id' => $req->step_id,
            'task_id' => $task_id,
                            'pos' => $req->pos
        ]);
            return Redirect()->back()->with('notification',' Đã tạo quy trình thành công ');
    }


    public function editStepTask(Request $req){
        
        $task_id = DB::table("staff_step_task")->where('id', $req->id)->first()->task_id;
        DB::table("staff_task")->where('id', $task_id)->update([
            'name'=>$req->sname
        ]);

        DB::table("staff_step_task")->where('id', $req->id)->update([
            'pos' => $req->pos
        ]);
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

    public function deleteStepTask(Request $req){
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
                    DB::table("staff_step_task")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->route('genstaff-step-info', ['id' => $req->substep_id])->with('notification',' Đã xóa tất cả  quy trình');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa  quy trình');

        }
       
        

    }



}