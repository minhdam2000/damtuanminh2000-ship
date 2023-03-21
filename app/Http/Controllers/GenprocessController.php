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

class GenprocessController extends Controller
{	
	public function getProcess(){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
            // dd(Auth::user()->role_id);
            $process = DB::table("process")->get();
            return view('generation.process', compact('process'));
        
    }


    public function getProcessInfo($id){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
            // dd(Auth::user()->role_id);
    $proccess_name =  DB::table("process")->where("id",$id)->first()->name;
    $processstep = DB::table("process_step")
     ->leftJoin('process', 'process_step.process_id', '=', 'process.id')
    ->leftJoin('step', 'process_step.step_id', '=', 'step.id')
    ->where([['process.id',$id]])
    ->select("process_step.id as id", "process.id as pid", "step.id as sid"
    ,"process.name as process_name", "step.name as step_name","process_step.pos as pos"
    ,"step.state as state")->get();

    $step_arr = DB::table("process_step")
     ->leftJoin('process', 'process_step.process_id', '=', 'process.id')
    ->leftJoin('step', 'process_step.step_id', '=', 'step.id')
    ->where([['process.id',$id]])
    ->pluck('step.id')->toArray();

    $step = DB::table("step")->whereNotIn('id', $step_arr)
                    ->get();
   return view('generation.process-detail', compact('id','proccess_name','processstep','step'));

        
    }
  
  
	public function addNewProcess(Request $req){
           if(!$this->checkLead()){
        return redirect("/");
      }
        DB::table("process")->insert([
            'name' => $req->name,
            'project_id' => $req->pid
        ]);
            return Redirect()->back()->with('notification',' Đã tạo quy trình thành công ');
	}

    public function editProcess(Request $req){
           if(!$this->checkLead()){
        return redirect("/");
      }
        DB::table("process")->where('id', $req->id)->update([
            'name' => $req->name,
            'project_id' => $req->pid
        ]);
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

    public function deleteProcess(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
        // print($req);
        $data = $req->post();
        $flag = 0;
        // dd($data);
        foreach ($data as $key => $value){
            if(is_int($key)){
                // print($key);
                try{
                  
                    DB::table("process")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->route('gen-process-list')->with('notification',' Đã xóa tất cả  quy trình');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa  quy trình');

        }
       
        

    }
        public function addNewProcessStep(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
        DB::table("process_step")->insert([
            'process_id' => $req->process_id,
            'step_id' => $req->step,
            'pos' => $req->pos,
        ]);
            return Redirect()->route('gen-process-info', ['id' => $req->process_id])->with('notification',' Đã tạo quy trình thành công ');
    }

     public function addNewProcessStep2(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
              $step_id =    DB::table("step")->insertGetId([
                            'name' => $req->step,
                            'des' => "Bước tự động",
                            'action' => "Triển khai",
                            'urlfull' => "",
                            'urlnonfull' => ""
                        ]);


        DB::table("process_step")->insert([
            'process_id' => $req->process_id,
            'step_id' => $step_id,
            'pos' => $req->pos,
        ]);
            return Redirect()->route('gen-process-info', ['id' => $req->process_id])->with('notification',' Đã tạo quy trình thành công ');
    }

    public function editProcessStep(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

        DB::table("process")->where('id', $req->process_id)->update([

            'name'=>$req->pname
        ]);

        $step_id = DB::table("process_step")->where('id', $req->id)->first()->step_id;
        DB::table("step")->where('id', $step_id)->update([

            'name'=>$req->sname
        ]);

        DB::table("process_step")->where('id', $req->id)->update([
            'pos' => $req->pos,
        ]);
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
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
                  
                    DB::table("process_step")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->route('gen-process-info', ['id' => $req->process_id])->with('notification',' Đã xóa tất cả quy trình');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa quy trình');

        }
       
        

    }




//substep

    public function getSubstep(){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
        // dd(Auth::user()->role_id);
        $step = DB::table("step")->get();
        $substep = DB::table("substep")
        ->leftJoin('step', 'substep.step_id', '=', 'step.id')
        ->select("step.id as sid","step.name as sname","substep.id as id","substep.name as name","substep.pos as pos",
            "substep.des as des","substep.legal as legal","substep.urlfull as urlfull",
            "substep.urlnonfull as urlnonfull")->get();
        return view('generation.substep', compact('step','substep')); 
    }


    public function getSubstepInfo($pid,$sid,$id){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
            // dd(Auth::user()->role_id);
    $substep_name =  DB::table("substep")->where("id",$id)->first()->name;
    $supstep_task = DB::table("substep_task")
    ->leftJoin('task', 'substep_task.task_id', '=', 'task.id')
    ->leftJoin('substep', 'substep_task.step_id', '=', 'substep.id')
    ->where([['substep.id',$id]])
    ->select("substep_task.id as id","substep.name as substep_name","task.id as tid",'substep.id as sid'
        ,"task.name as task_name","task.file_flag as file_flag","task.url as url","substep_task.pos as pos",
    "task.des as des","task.legal as legal","task.status as status","task.type as type",
    "task.department_id as department_id","task.legal_type as legal_type","task.start_date as start_date","task.duration as duration"
    )->get();

    $task_arr =  DB::table("substep_task")
    ->leftJoin('task', 'substep_task.task_id', '=', 'task.id')
    ->leftJoin('substep', 'substep_task.step_id', '=', 'substep.id')
    ->where([['substep.id',$id]])
    ->pluck('task.id')->toArray();

    $task = DB::table("task")->whereNotIn('id', $task_arr)
                    ->get();
   return view('generation.substep-detail', compact('pid','sid','id','substep_name','supstep_task','task'));

        
    }
  
  
    public function addNewSubstep(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

    if ($req->file1 != null){
      $path = $req->file1->store('system');

      $url = Storage::url($path);
      
    }else{
        $url = null;
    }
    if ($req->file2 != null){
      $path2 = $req->file2->store('system');

      $url2 = Storage::url($path2);
      
    }else{
        $url2 = null;
    }



      // print_r(DB::table( $table)->where('id', $id)->first());

      // DB::table($table)->where('id', $id)->update([
      //       'url' => '/files/system/'.$file_name
      //   ]);



        DB::table("substep")->insert([
            'step_id' => $req->step,
            'pos' => $req->pos,
            'name' => $req->name,
            'des' => $req->des,
            'urlfull' => $url,
            'urlnonfull' => $url2
        ]);
            return Redirect()->back()->with('notification',' Đã tạo quy trình thành công ');
    }

    public function editSubstep(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

     $destinationPath = public_path().'/files/system/';
     if ($req->file1 != null){
      $path = $req->file1->store('system');

      $url = Storage::url($path);

    DB::table("substep")->where('id', $req->id)->update([
        'urlfull' => $url 
    ]);
    }else{
        $file_name1 = null;
    }
    if ($req->file2 != null){
      $path2 = $req->file2->store('system');

      $url2 = Storage::url($path2);

    DB::table("substep")->where('id', $req->id)->update([
            'urlnonfull' => $url2
    ]);
    }else{
        $file_name2 = null;
    }

        DB::table("substep")->where('id', $req->id)->update([
            'step_id' => $req->step,
            'pos' => $req->pos,
            'name' => $req->name,
            'des' => $req->des
        ]);
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

    public function deleteSubstep(Request $req){
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
                  
                    DB::table("substep")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->back()->with('notification',' Đã xóa tất cả nhiệm vụ');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa nhiệm vụ');

        }
       
        

    }
        public function addNewSubstepTask(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
        DB::table("substep_task")->insert([
            'step_id' => $req->id,
            'pos' => $req->pos,
            'task_id' => $req->task
        ]);
            return Redirect()->back()->with('notification',' Đã tạo quy trình thành công ');
    }

    public function editSubstepTask(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

        DB::table("substep")->where('id', $req->process_id)->update([

            'name'=>$req->pname
        ]);

        $task_id = DB::table("substep_task")->where('id', $req->id)->first()->task_id;
        DB::table("task")->where('id', $task_id)->update([

            'name'=>$req->sname
        ]);

        DB::table("substep_task")->where('id', $req->id)->update([
            'pos' => $req->pos
        ]);
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

    public function deleteSubstepTask(Request $req){
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
                    DB::table("substep_task")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->back()->with('notification',' Đã xóa tất cả  quy trìn');
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
        $task = DB::table("task")->get();
        return view('generation.task', compact('task')); 
    }


  
  
    public function addNewTask(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

      DB::table("task")->insert([
            'name' => $req->name,
            'legal_type' => $req->type
        ]);
            return Redirect()->back()->with('notification',' Đã tạo quy trình thành công ');
    }

    public function editTask(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
  DB::table("task")->where('id', $req->id)->update([
            'name' => $req->name,
            'legal_type' => $req->type
        ]);
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
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
                  
                    DB::table("task")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->back()->with('notification',' Đã xóa tất cả nhiệm vụ');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa nhiệm vụ');

        }
       
        

    }



    public function getTaskInfo($id){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
            // dd(Auth::user()->role_id);

    $roles = DB::table("department_legal")
    ->leftJoin('task', 'task.id', '=', 'department_legal.task_id')
    ->leftJoin('department', 'department.id', '=', 'department_legal.dept_id')
    ->where([['department_legal.task_id',$id]])
    ->select("department_legal.id as id","task.name as tname","department.name as dname"
    )->get();


    $task = DB::table("task")->where("id",$id)->first();
    $department = DB::table("department")->get();
   return view('generation.task-detail-legal', compact('roles','department',"task","id"));

        
    }

   public function addNewTaskDetail(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
        DB::table("department_legal")->insert([
            'task_id' => $req->id,
            'dept_id' => $req->dept_id
        ]);
            return Redirect()->back()->with('notification',' Đã tạo quy trình thành công ');
    }

    // public function editStepTask(Request $req){
    //     DB::table("step_task")->where('id', $req->id)->update([
    //         'pos' => $req->pos
    //     ]);
    //     return Redirect()->route('genlegal-step-info', ['id' => $req->process_id])->with('notification', 'cập nhật thông tin thành công');
    // }

    public function deleteTaskDetail(Request $req){
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
                    DB::table("department_legal")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->back()->with('notification',' Đã xóa tất cả  quy trình');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa  quy trình');

        }
       
        

    }


//step

    public function getStep(){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
        // dd(Auth::user()->role_id);
        $step = DB::table("step")->get();
        return view('generation.step', compact('step')); 
    }


  
  
    public function addNewStep(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

     if ($req->file1 != null){
      $path = $req->file1->store('system');

      $url = Storage::url($path);
      
    }else{
        $url = null;
    }
    if ($req->file2 != null){
      $path2 = $req->file2->store('system');

      $url2 = Storage::url($path2);
      
    }else{
        $url2 = null;
    }



      // print_r(DB::table( $table)->where('id', $id)->first());

      // DB::table($table)->where('id', $id)->update([
      //       'url' => '/files/system/'.$file_name
      //   ]);



        DB::table("step")->insert([
            'name' => $req->name,
            'des' => $req->des,
            'action' => $req->action,
            'urlfull' => $url,
            'urlnonfull' => $url2
        ]);
            return Redirect()->back()->with('notification',' Đã tạo quy trình thành công ');    }

    public function editStep(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

   $destinationPath = public_path().'/files/system/';
   // dd($req->file1 );
     if ($req->file1 != null){
      $path = $req->file1->store('system');

      $url = Storage::url($path);
      // dd($url);
    DB::table("step")->where('id', $req->id)->update([
        'urlfull' => $url
    ]);
    }else{
        $file_name1 = null;
    }
    if ($req->file2 != null){
      $path2 = $req->file2->store('system');

      $url2 = Storage::url($path2);

    DB::table("step")->where('id', $req->id)->update([
            'urlnonfull' => $url2
    ]);
    }else{
        $file_name2 = null;
    }

        DB::table("step")->where('id', $req->id)->update([
            'name' => $req->name,
            'action' => $req->action,
            'des' => $req->des
        ]);
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
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
                  
                    DB::table("step")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->back()->with('notification',' Đã xóa tất cả nhiệm vụ');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa nhiệm vụ');

        }
       
        

    }
    public function getStepInfo($pid,$id){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

            // dd(Auth::user()->role_id);
    $step_name =  DB::table("step")->where("id",$id)->first()->name;

    $step_task = DB::table("step_task")
    ->leftJoin('task', 'step_task.task_id', '=', 'task.id')
    ->leftJoin('step', 'step_task.step_id', '=', 'step.id')
    ->where([['step.id',$id]])
    ->select("step_task.id as id","step.name as step_name","task.id as tid","task.name as task_name","task.file_flag as file_flag","task.url as url","step_task.pos as pos",
    "task.des as des","task.legal as legal","task.status as status","task.type as type",
    "task.department_id as department_id","task.legal_type as legal_type","task.start_date as start_date","task.duration as duration"
    )->get();




    $task_arr =  DB::table("step_task")
    ->leftJoin('task', 'step_task.task_id', '=', 'task.id')
    ->leftJoin('step', 'step_task.step_id', '=', 'step.id')
    ->where([['step.id',$id]])
    ->pluck('task.id')->toArray();

    $task = DB::table("task")->whereNotIn('id', $task_arr)
                    ->get();


    $substep = DB::table("substep")->where('step_id', $id)
                    ->get();
   return view('generation.step-detail', compact('pid','id','step_name','step_task','task','substep'));

        
    }


public function addNewSubstepTask2(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

      $task_id = DB::table("task")->insertGetId([
            'name' => $req->task,
            'legal_type' => $req->type
        ]);

        DB::table("substep_task")->insert([
            'step_id' => $req->step_id,
            'task_id' => $task_id,
            'pos' => $req->pos
        ]);
            return Redirect()->back()->with('notification',' Đã tạo quy trình thành công ');
    }

   public function addNewStepTask(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

        DB::table("step_task")->insert([
            'step_id' => $req->step_id,
            'task_id' => $req->task,
            'pos' => $req->pos
        ]);
            return Redirect()->back()->with('notification',' Đã tạo quy trình thành công ');
    }

   public function addNewStepTask2(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

        DB::table("step_task")->insert([
            'step_id' => $req->step_id,
            'task_id' => $req->task,
            'pos' => $req->pos
        ]);
            return Redirect()->back()->with('notification',' Đã tạo quy trình thành công ');
    }

    public function editStepTask(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

        DB::table("step_task")->where('id', $req->id)->update([
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
                    DB::table("step_task")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->back()->with('notification',' Đã xóa tất cả  quy trình');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa  quy trình');

        }
       
        

    }


  public function addNewStepSubstep(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

       
     $destinationPath = public_path().'/files/system/';
   if ($req->file1 != null){
      $path = $req->file1->store('system');

      $url = Storage::url($path);
      
    }else{
        $url = null;
    }
    if ($req->file2 != null){
      $path2 = $req->file2->store('system');

      $url2 = Storage::url($path2);
      
    }else{
        $url2 = null;
    }



        DB::table("substep")->insert([
            'step_id' => $req->step_id,
            'pos' => $req->pos,
            'name' => $req->name,
            'des' => $req->des,
            'urlfull' => $url,
            'urlnonfull' => $url2,
        ]);
            return Redirect()->back()->with('notification',' Đã tạo quy trình thành công ');
    }

    public function editStepSubstep(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

       

     $destinationPath = public_path().'/files/system/';
     if ($req->file1 != null){
   
      $path = $req->file1->store('system');

      $url = Storage::url($path);

        DB::table("substep")->where('id', $req->id)->update([
            'urlfull' => $url 
    ]);
    }else{
        $file_name1 = null;
    }
    if ($req->file2 != null){
   
      $path2 = $req->file2->store('system');

      $url2 = Storage::url($path2);

    DB::table("substep")->where('id', $req->id)->update([
            'urlnonfull' => $url2
    ]);
    }else{
        $file_name2 = null;
    }

        DB::table("substep")->where('id', $req->id)->update([
            'step_id' => $req->step_id,
            'pos' => $req->pos,
            'name' => $req->name,
            'des' => $req->des
        ]);
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

    
        
 public function deleteStepSubstep(Request $req){
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
                  
                    DB::table("substep")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
         }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa nhiệm vụ');

        }
       
        

    }

    public function tempate($id){
           if(!$this->checkAdmin()){
        return redirect("/");
      }

        $tem_process = DB::table("temp_process")->where("id",$id)->first();

        $process_id =  DB::table("process")->insertGetId([
            'name' => $tem_process->name
        ]);

        $temp_process_step = DB::table("temp_process_step")->where("id",$tem_process->id)->get();

        // foreach ($tem_process_step as $ps) {
        //     DB::table("process_step")->insertGetId([
        //             'process_id' => $ps->process_id,
        //             'step_id' => $ps->step_id,
        //             'pos' => $ps->pos,
                   
        //     ]);
        // }

        $step_arr = DB::table("temp_process_step")
          ->leftJoin('temp_process', 'temp_process_step.task_id', '=', 'temp_process.id')
          ->leftJoin('temp_step', 'temp_process_step.step_id', '=', 'temp_step.id')
          ->where([['temp_step.id',$id]])
          ->pluck('temp_step.id')->toArray();

        foreach ($step_arr as $step_id) {
            $step = DB::table("temp_process")->where("id",$step_id)->first();

             $sid =  DB::table("step")->insertGetId([
                    'name' => $step->name,
                    'des' => $step->des,
                    'action' => $step->action,
                    'urlfull' => $step->urlfull,
                    'urlnonfull' => $step->urlnonfull
                    ]);
               $temp_pos = DB::table("temp_process_step")->where("process_id",$id)
           ->where("step_id",$sid)->first()->pos;
                  DB::table("process_step")->insertGetId([
                    'process_id' => $id,
                    'step_id' => $sid,
                    'pos' => $temp_pos

 ]);
            $task_arr = DB::table("temp_step_task")
              ->leftJoin('temp_task', 'temp_step_task.task_id', '=', 'temp_task.id')
              ->leftJoin('temp_step', 'temp_step_task.step_id', '=', 'temp_step.id')
              ->where([['temp_step.id',$sid]])
              ->pluck('step.id')->toArray();

            foreach($task_arr as $task_id){
                $temp_task = DB::table("temp_task")->first();
                $tid = DB::table("task")->insertGetId([
                        'name' => $temp_task->name
                    ]);
                 DB::table("step_task")->insertGetId([
                            'task_id' => $tid,
                            'step_id' => $sid
                    ]);

            }

            $substep_arr = DB::table("temp_substep")->where("id",$sid)->get();

            foreach ($substep_arr as $substep) {
                $ssid =  DB::table("substep")->insertGetId([
                        'step_id' => $substep->step,
                        'pos' => $substep->pos,
                        'name' => $substep->name,
                        'des' => $substep->des,
                        'urlfull' => $substep->urlfull,
                        'urlnonfull' => $substep->urlnonfull
                    ]);

              $task_arr = DB::table("temp_substep_task")
              ->leftJoin('temp_task', 'temp_substep_task.task_id', '=', 'temp_task.id')
              ->leftJoin('temp_substep', 'temp_substep_task.step_id', '=', 'temp_substep.id')
              ->where([['temp_substep.id',$ssid]])
              ->pluck('step.id')->toArray();

                foreach($task_arr as $task_id){
                    $temp_task = DB::table("temp_task")->first();
                    $tid = DB::table("task")->insertGetId([
                            'name' => $temp_task->name
                        ]);
                     DB::table("substep_task")->insertGetId([
                            'task_id' => $tid,
                            'step_id' => $ssid
                    ]);

                }



              
            }



           
            
        }





    }
    
}