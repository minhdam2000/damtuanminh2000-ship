@extends('layouts.index')
@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<style type="text/css">
  .job-content{
    font-size: 25px;
  }
.bootstrap-select{
  z-index: 100
}
  .progress{
    min-height: 30px;
    background-color: transparent;
}
.progress-bar{
    font-size: 15px;
  }
</style>

	<div class="content-camera">
		<div class="header-content">
			<div class="header-content-left">
				<h6>Chi tiết công việc {{$job->name}}</h6>
			</div> <div class="session">
            @if(Session::has('notification'))
              <input hidden="" notifi="{{Session::get('notification')}}" value="1" id="notice_success">
            @endif
            @if(Session::has('warning'))
              <input hidden="" notifi="{{Session::get('warning')}}" value="1" id="notice_warning">
            @endif
         </div>
			<div class="header-content-right" style="display: inline;">
				<a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i>  </h6></a>
				/
				<h6 class="display-inline">Chi tiết công việc</h6>
			</div>
		</div>
		      <div class="session">
            @if(Session::has('notification'))
              <input hidden="" notifi="{{Session::get('notification')}}" value="1" id="notice_success">
            @endif
            @if(Session::has('warning'))
              <input hidden="" notifi="{{Session::get('warning')}}" value="1" id="notice_warning">
            @endif
     
    <hr>  <?php $level = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->level;
    $depart = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->department_id;
    ?>

     <div class="row row-content">
      <div class="row-title-proxy">
    <ul class="nav nav-tabs" id="tabs" role="tablist"><li class="nav-item margin_center">
          <a id="tab0" class="nav-link  color-a"  data-toggle="tab" role="tab" href="#contentl0"> Tổng quan </a>
      </li>
      <!-- <li class="nav-item margin_center">
          <a id="tab1" class="nav-link  color-a"  data-toggle="tab" role="tab" href="#contentl1"> Tiến độ </a>
      </li> -->
       <li class="nav-item margin_center">
          <a id="tab2" class="nav-link  color-a"  data-toggle="tab" role="tab" href="#contentl2"> Thảo luận </a>

      </li>


    </ul>  <br><hr><br>

 <div class="tab-content">

          <div id="contentl0" class="tab-pane  in active">
          <div id= "info" class="row">
    <div class="col-md-8 col-12 col-sm-12"> 
     <div class="card card-custom">
                                         <div class="card-header" data-toggle="collapse" data-target="#target1">
                                        <h3 class="card-title">
   Thông tin cơ bản</h3>
</div>
                                    
                                      <div class="card-body collapse show"  id="target1" >     <?php


              $job_dept =  DB::table("department")->where("id", $job->did)->first()->name;

            ?>

            <h3> Tên công việc:  {{$job->name}}</h3>
            <h3> Phòng thực hiện: {{$job_dept}}</h3>
            <h3> Mô tả:</h3><div class="job-content"> {!! $job->des !!}</div>
            <h3> Tệp đính kèm</h3>
              <?php
   $files =  DB::table('job_imgs')->where('job_id', $job->id)->get();

            ?>

                <div class="row form-group" id="listimg">
              @foreach($files as $file)

                             <?php
                              if(strpos($file->url,".png") > 0 
                              || strpos( $file->url,".jpg") > 0 
                              || strpos($file->url,".jpeg") > 0 
                            ){
                            ?>

                           
<div class="col-12 col-sm-12 col-md-4">
  <a target="_blank" href="{{$file->url}}">
<img style="width: 100%;height: auto" src="{{$file->url}}" id="listimg" class="preview"></a><br><br> </div>  
                            <?php
          }
?>

                            @endforeach
                       </div>
        @foreach($files as $file)
           <?php

      $temp = explode("/", $file->url);
      $temp = end($temp);

                              if(strpos($file->url,".png") < 1 
                              && strpos( $file->url,".jpg") < 1
                              && strpos($file->url,".jpeg") < 1 
                            ){
                            ?>

        <p><img width="25" height = "25" src="/js-css/img/icon/write.png">
<a href="{{$file->url}}">{{$file->name}}</a><p>
                            <?php
          }
?>
                            @endforeach
            </div>
          </div></div>

           <div class="col-md-4 col-12 col-sm-12"> 
     <div class="card card-custom">
                                         <div class="card-header" data-toggle="collapse" data-target="#target2">
                                        <h3 class="card-title">
   Thời gian </h3>
</div>
                                    
                                      <div class="card-body collapse show"  id="target2" >

            <h3> Ngày bắt đầu: {{$job->start_date}}</h3>
            <h3> Ngày kết thúc: {{$job->end_date}}</h3>

            <?php
$date1 = date("Y-m-d H:i:s");
$date2 = $job->end_date;
$timestamp1 = strtotime($date1);
$timestamp2 = strtotime($date2);
$hour = intval(($timestamp2 - $timestamp1)/(60*60));
if ($hour < 0){
  $hour = 0;
}
?>

            <h3> Thơi gian còn lại: {{$hour}} Giờ</h3>
            <h3> Trạng thái:
              @if($job->status ==1)
              <span style="color: green">Đã hoàn thành</span>
              @elseif($job->status ==2)

              <span style="color: red"> Không hoàn thành</span>
              @elseif($job->status ==3)
              <span style="color: red"> Tạm ngưng</span>
              @else
              <span style="color: red"> Đang thực hiện</span>
              @endif
            </h3>
          </div> <div class="card-header" data-toggle="collapse" data-target="#target9">
                                        <h3 class="card-title">
   Người giao việc </h3>
</div>
                                                   <div class="card-header" data-toggle="collapse" data-target="#target9">
         
                                    
                                      <div class="card-body collapse show"  id="target9" >

            <h3> Người giao việc: {{$user->name}}</h3>
            <h3><a href="mailto:{{$user->email}}"> Email: {{$user->email}}</a></h3>
            <h3><a href="tel: {{$user->phone}}"> Số điện thoại: {{$user->phone}}
            </a></h3>


            <a href="chatify" class="job-update preview"  ><img src="/js-css/img/icon/write.png"> Nhắn tin</a>
            </div>
              </div>

                                         <div class="card-header" data-toggle="collapse" data-target="#target3">
                                        <h3 class="card-title">
   Thông tin người phụ trách </h3>
</div>
                                    
                                      <div class="card-body collapse show"  id="target3" >

            <h3> Người phụ trách: {{$job->names}}</h3>
           
            <a href="hr/staff-list" class="job-update preview"  ><img src="/js-css/img/icon/write.png"> Chi tiết phụ trách</a>
            <span onclick="getStaffSelectedList('{{$job->id}}')" class="job-update preview" data-toggle="modal" data-target="#edit-job-modal" ><img src="/js-css/img/icon/write.png"> Sửa thông tin</span>
          </div></div>
@if(Auth()->user()->id == $user->id && $job->status !==1 )
<div class="card card-custom"> 
   <div class="card-header"  data-toggle="collapse" data-target="#targeth">
                                        <h3 class="card-title">
   Cập nhật trạng thái  </h3>

                         </div>           
              <div class="card-body collapse show"  id="targeth" >

<form action="close-job"  enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input id="status_input_id" type="hidden" name="id" value="{{$job->id}}">

  <table class="table-edit table-model">
                    <tbody class="table-edit">
                        
              <tr>
                            <td><i class="fa fa-credit-card" aria-hidden="true"></i> Trạng thái</td>
                            <td> <select class="custom-select select-profile  browser-default" name="status" >
                        <option value="1">Hoàn thành </option>
                        <option value="2">Không hoàn thành </option>
                        <option value="3">Ngưng</option>
               </select>
                            </td> <td>
                            <button class="btn btn-model"> Cập nhật </button>
                          </td>
                       
                         
                        </tr>
                      </tbody>
                    </table>
</form>
  <hr>
</div>
</div>
@endif
            </div>

     
</div>
<hr>
<h3>Chi tiết công việc </h3>
       <span class="progress">
  <span class="progress-bar bg-success" style="width:{{$percent}}%;min-width: 100px" >
   {{$percent}}%
  </span>
  <span class="progress-bar bg-danger" style="width:{{100 - $percent}}%;">
   
  </span>
</span>
                @if ($permis == 1)
 <button class="btn btn-model" data-toggle="modal" data-target="#add-task-modal"    type="button">Thêm công việc</button>
<br><br>
@endif

 

<table id="job-task" class="nvr-table">
 <thead>
                        <tr class="thead">
                            <th>Công việc </th>
                            <th>Người được giao </th>
                            <th>Bắt đầu </th>
                            <th>Kết thúc</th>
                            <th>Trạng thái</th>
                @if ($permis == 1)
                            <th></th>
                            @endif
                          </tr>
                        </thead>
                        <tbody class="tbody" id="">
  @foreach($tasks as $task)
                        <tr class="color-add">
                          <td><span class="job-content" id="content{{$task->id}}">
                            {!! $task->content !!}</span>
            <?php
   $files =  DB::table('job_task_imgs')->where('task_id', $task->id)->get();

            ?>

                <span class="row form-group" id="listimg">
              @foreach($files as $file)

                             <?php
                              if(strpos($file->url,".png") > 0 
                              || strpos( $file->url,".jpg") > 0 
                              || strpos($file->url,".jpeg") > 0 
                            ){
                            ?>

                           
<span class="col-12 col-sm-12 col-md-4">
<img style="width: 100%;height: auto" src="{{$file->url}}" id="listimg" class="preview"><br><br> </span>  
                            <?php
          }
?>

                            @endforeach
                       </span>
        @foreach($files as $file)
           <?php


                              if(strpos($file->url,".png") < 1 
                              && strpos( $file->url,".jpg") < 1
                              && strpos($file->url,".jpeg") < 1 
                            ){
                            ?>

        <p><img width="25" height = "25" src="/js-css/img/icon/write.png">
<a href="{{$file->url}}">{{$file->name}}</a><p>
                            <?php
          }
?>
                            @endforeach
            </span>
                          </td>

                          <td>
                            @if(strlen($task->names) > 0)
                            {!! $task->names !!}
                            @else
                            Tất cả
                            @endif
                          </td>
                          
                          <td id="start{{$task->id}}">{{$task->start_date}}</td>
                          <td id="end{{$task->id}}">{{$task->end_date}}</td>
                        
                          <td>

              @if($task->flag ==0)
                <a class="btn btn-model" href="update-task-flag/{{$task->id}}">Xác nhận</a>
              @elseif($task->flag ==1)
                @if ($permis == 0)
                    <a class="btn btn-primary" href="update-task-flag/{{$task->id}}">Đang đợi chấp nhận</a>
                @else
                    <a class="btn btn-model" href="update-task-flag/{{$task->id}}">Yêu cầu xác nhận</a>
                @endif
              @elseif($task->flag ==2)
                <a class="btn btn-primary">Đã xác nhận</a>
              @endif
                          </td>
                          <td>
                            
                @if ($permis == 1)
                              <button onclick="EditTask({{$task->id}})" class="preview" type="button"><img src="/js-css/img/icon/write.png"></button>

                    

                               <a href="delete-job-task/<?=$task->id?>" type="button"  class="preview" > <img src="/js-css/img/icon/delete.png"> </a>

                @endif
                          </td>
                        </tr>
                      @endforeach
                        </tbody>
                      </table>
                      <br><hr>

                  <h3 class="card-title">
   Danh sách minh chứng </h3>         
<table id="job-url" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Sự kiện </th>
                            <th>Người phụ trách </th>
                            <th>Thời gian</th>
                            <th>Minh chứng </th>
                          </tr>
                        </thead>
                        <tbody class="tbody" id="job_history">
                          @foreach($job_url as $job_url)
                        <tr class="color-add">
                          <td>{{$job_url->content}}</td>
                          <td>{{$job_url->name}}</td>
                          <td>{{$job_url->time}}</td>
                          <td>
                            @if(strpos($job_url->link,"png") ||
                            strpos($job_url->link,"jpg") ||
                            strpos($job_url->link,"jpeg") 
                            )
                            <a target="blank_" href="{{$job_url->link}}">
                            <img style="width: 200px;height: auto" src="{{$job_url->link}}"></a>
                            @else
<a  target="_blank" download="<?=$job_url->content.".".explode(".",$job_url->link,2)[1]?>" href="{{$job_url->link}}" class="preview" type="button"><?=$job_url->content.".".explode(".",$job_url->link,2)[1]?></a>
                          @endif
                          </td>
                        </tr>
                      @endforeach
                        </tbody>
                      </table>


@if( $job->status !==1)
<div class="card card-custom"> 
   <div class="card-header"  data-toggle="collapse" data-target="#targeti">
                                        <h3 class="card-title">
   Thêm minh chứng  </h3>

                         </div>           
              <div class="card-body"  id="targeti" >

 <form action="add-history-jobs"  enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">

  <table class="table-edit table-model">
                    <tbody class="table-edit">
                        
              <tr>
                            <td><i class="fa fa-credit-card" aria-hidden="true"></i> Mô tả</td>
                            <td><input value="" type="" value="" name="des" class="input-edit modol-text" required="">
                            </td>
                        </tr>
                        <tr>

                <td >Minh chứng </td>
                  <td> <input type="hidden" value="{{$job->id}}" name="id" id="job_input_id" class="input-edit modol-text" required=""><label  class="preview" for="file-input"><img onclick="openfileupload(1)"  src="/js-css/img/icon/upload.png"></label><input  id= "inputfile1" style="display:none" type="file" name="file[]" class="form-control"
                    multiple>
                </td>
                        </tr>
                        <tr>
                          <td>
                            <button class="btn btn-model"> Cập nhật </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
</form>
  <hr>
</div>
</div>
@endif


          </div>


          <div id="contentl2" class="tab-pane  fade">
           
            <div id="job_detail2"></div>
            <h4>Danh sách bình luận</h4>
          <table id="job-cmt" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Người bình luận </th>
                            <th>Nội dung </th>
                            <th>Thời gian</th>
                          </tr>
                        </thead>
                        <tbody class="tbody" id="job_history">
                          @foreach($job_cmt as $job_cmt)
                        <tr class="color-add">
                          <?php
                          $temp_user = DB::table("users")->where("id",$job_cmt->user_id)->first()->name
                          ?>
                          <td>{{$temp_user}}</td>
                          <td>
                            {!! $job_cmt->content !!}
                            <?php 
                            $url = DB::table("job_comments_url")->where("job_id",$job_cmt->id)->pluck('url')->toArray();
                            ?>
                <div class="form-group" id="listimg">
                          @foreach($url as $url)
                          
<a target="_blank" href="{{$url}}"><img style="width: 300px;margin-left: 3%;" src="{{$url}}" id="listimg" class="preview"></a>
                      @endforeach
                      </div>
                          </td>
                          <td>{{$job_cmt->created_at}}</td>
                          
                        </tr>
                      @endforeach
                        </tbody>
                      </table>
                      <hr><br>
               <form action="/job-comments"  enctype="multipart/form-data" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" id="job_id" value="{{$job->id}}" name="job_id">
                        <div class="form-group">
                            <label>Bình luận mới</label>
                       <textarea  name="content" class="ckeditor form-control " cols="20" rows="5"></textarea>
                        </div>
                        
            
                        <div class="form-group">
                    <input style="display: none" type="file" name="file[]" class="file"
                    multiple>

                    <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Tải tệp lên" id="file">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Chọn</button>
                        </div>
                    </div>
                <div class="form-group" id="preview">
                </div>
                <div class="form-group" id="preview-file"></div>

                </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Trả lời" class="btn btn-primary">
                    </div>
    
                    </form>



          </div>
      <div class="modal fade modol-text" id="add-task-modal" role="dialog">

        <form id="update-jobs" method="POST" action="add-task" 
         enctype="multipart/form-data">

          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="job_id" id="edit_id" value="{{$job->id}}">
          <div  class="modal-dialog model-right"  style="min-width: 50%;height: auto">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label> Thêm việc con</label>
              </div>
              <div class="notification"></div>
              <div class="modal-body">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                        
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian bắt đầu </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="start_date" id="edit_start_date" required="" value="{{$job->start_date}}"></td>
                        </tr>
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian kết thúc </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="end_date" id="edit_end_date" required=""  value="{{$job->end_date}}"></td>
                        </tr>
                      <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea value=""  name="des" class="ckeditor form-control input-edit modol-text"  required="" id="EditDes"></textarea></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                        <div class="form-group">
                    <input style="display: none" type="file" name="file[]" class="file"
                    multiple>

                    <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Tải tệp lên" id="file">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Chọn</button>
                        </div>
                    </div>
                <div class="form-group" id="preview">
                </div>
                <div class="form-group" id="preview-file"></div>
                </div>


  <select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffselect" multiple>

                          @foreach($staffs as $staff)
                          <option value="{{$staff->id}}">{{$staff->name}}</option>

                          @endforeach
</select>
              @if($depart !==5 && $depart !== 10)
              <div id="staffEditDiv"></div>
              @endif

              </div>
<br><hr>
              <div class="modal-footer">
                <button class="btn btn-model" type="submit"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Cập nhật </button>
              </div>
            </div>
          </div>
  <div class="modal-footer" style="    position: inherit;">

                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>

        </form>
    </div>


     <div class="modal fade modol-text" id="edit-task-modal" role="dialog">

        <form id="update-jobs" method="POST" action="edit-task" 
         enctype="multipart/form-data">

          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="id" id="EditID" value="">
          <div class="modal-dialog model-right"  style="min-width: 50%;height: auto">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label> Sửa việc con</label>
              </div>
              <div class="notification"></div>
              <div class="modal-body">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                         
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian bắt đầu </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="start_date" id="EditStart" required="" value=""></td>
                        </tr>
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian kết thúc </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="end_date" id="EditEnd" required=""  value="{{$job->end_date}}"></td>
                        </tr>
                     <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea value=""  name="des" class="ckeditor form-control input-edit modol-text"  required="" id="EditContent"></textarea></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
   <div class="form-group">
                    <input style="display: none" type="file" name="file[]" class="file"
                    multiple>

                    <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Tải tệp lên" id="file">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Chọn</button>
                        </div>
                    </div>
                <div class="form-group" id="preview">
                </div>
                <div class="form-group" id="preview-file"></div>
                </div>
                
                <br>
  <select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffselectEdit" multiple>

                          @foreach($staffs as $staff)
                          <option value="{{$staff->id}}">{{$staff->name}}</option>

                          @endforeach
</select>
              @if($depart !==5 && $depart !== 10)
              <div id="staffEditDiv"></div>
              @endif

              </div>
<br><hr>
              <div class="modal-footer">
                <button class="btn btn-model" type="submit"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Cập nhật </button>
              </div>
            </div>
          </div>
  <div class="modal-footer" style="    position: inherit;">

                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>

        </form>
    </div>

	<!-- end model --->

      <!-- Modal edit-->
      <div class="modal fade modol-text" id="edit-job-modal" role="dialog">

        <form id="update-jobs" method="POST" action="update-job" 
         enctype="multipart/form-data">

          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="id" id="edit_id" value="{{$job->id}}">
          <div  class="modal-dialog model-right"  style="min-width: 50%;height: auto">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label> Chỉnh sửa thông tin</label>
              </div>
              <div class="notification"></div>
              <div class="modal-body">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                         <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tên </td>
                            <td><input type="" value="{{$job->name}}" name="name" class="input-edit create-user modol-text" id="edit_name" required=""></td>
                        </tr>
                      
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian bắt đầu </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="start_date" id="edit_start_date" required="" value="{{$job->start_date}}"></td>
                        </tr>
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian kết thúc </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="end_date" id="edit_end_date" required=""  value="{{$job->end_date}}"></td>
                        </tr>
                        @if($depart ==5 || $depart == 10)

                        <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Khối </td>
                            <td><span id="edit_department" > {{$job_dept}}</span></td>
                        </tr>


                        @endif   <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea value="{!! $job->des !!}"  name="des" class="ckeditor form-control input-edit modol-text"  required="" id="EditDes"></textarea></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
   <div class="form-group">
                    <input style="display: none" type="file" name="file[]" class="file"
                    multiple>

                    <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Tải tệp lên" id="file">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Chọn</button>
                        </div>
                    </div>
                <div class="form-group" id="preview">
                </div>
                <div class="form-group" id="preview-file"></div>
                </div>

              @if($depart !==5 && $depart !== 10)
              <div id="staffEditDiv"></div>
              @endif

              </div>
<br><hr>
              <div class="modal-footer">
                <button class="btn btn-model" type="submit"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Cập nhật </button>
              </div>
            </div>
          </div>
  <div class="modal-footer" style="    position: inherit;">

                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>

        </form>
    </div>
      </div>

	<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
    </div>
    <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
     </div>

<script src="/js-css/js/bootstrap-select.min.js"></script>
<script src="/js-css/js/ckeditor/ckeditor.js"></script>
  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
  <script>

function EditTask(id){
  document.getElementById("EditID").value = id

  document.getElementById("EditStart").value = (document.getElementById("start"+id).innerHTML)

   document.getElementById("EditEnd").value = (document.getElementById("end"+id).innerHTML)

          CKEDITOR.instances.EditContent.setData(document.getElementById("content"+id).innerHTML, function()
{
    this.checkDirty();  // true
});  
// $('#staffselectEdit[value=17]').attr('selected','selected');


  $.ajax({
        type: "GET",
        url: "get-task-user-list/" + id,
        success: function (response) {
          // console.log(response)      
$("#staffselectEdit").val(response).change();     
}

  });


 $('#staffselectEdit').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
$("#edit-task-modal").modal()

}

    $('#staffselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});

    $('#job-url').DataTable( {
  "pageLength": 3
});
    $('#job-cmt').DataTable();


    $(document).ready(function(){
    $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');

        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });
});

     function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }
    
        $(document).on("click", ".browse", function() {
          var file = $(this)
            .parent()
            .parent()
            .parent()
            .find(".file");
          file.trigger("click");
        });
      
        $('input[type="file"]').change(function(e) {
            
          var html = ""
            for (var i = 0; i < e.target.files.length;i++){
          var fileName = e.target.files[i].name;
          console.log(fileName)
          // $("#file").val(fileName);
        if (fileName.includes(".png") || fileName.includes(".jpg") || fileName.includes(".jepg")){
          var reader = new FileReader();
          var myElement =  $(this).parent()
            .find("#preview-file")
          reader.onload = function(e) {
            // get loaded data and render thumbnail.
          html  = html + '<img style="width: 200px;margin-left: 3%;" src="'+e.target.result+'" id="preview" class="preview">';
             console.log(myElement.html())
           myElement.html( myElement.html()+html);
          console.log(myElement.html())

          };
       
          reader.readAsDataURL(this.files[i]);
      }else{
            // get loaded data and render thumbnail.
        console.log(fileName)
          html  = html + '<p><img width="25" height = "25" src="/js-css/img/icon/write.png">' + fileName+ "<p>"; 
            $(this)
            .parent()
            .find("#preview-file").html( $(this).parent().find("#preview-file").html()+html);
          
  }
 


          // read the image file as a data URL.
                }
              
        });


         $(document).ready(function(){
    $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');

        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });
});
function getStaffSelectedList(id){
  $.ajax({
    type: "GET",
    url: '/system/staff-edit-list/'+id,
    success: function (response) {
      response = (JSON.parse(response))
      console.log(response)
      var data = response[0]
      var sel = response[1]
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


     var  html = '<select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffEditSelected" multiple>'
      for(var i =0; i < data.length; i++){
          if (sel.includes(data[i].id)){
          html = html +'<option  value="'+data[i].id+'" selected>'+data[i].name+'</option>'
          }else{
          html = html +'<option  value="'+data[i].id+'">'+data[i].name+'</option>'

          }
      }
     hhtml = html + '</select>'
      // console.log(html)
      // document.getElementsByClassName("filter-option-inner-inner")[1].innerHTML = ""
      document.getElementById("staffEditDiv").innerHTML=html;
$('#staffEditSelected').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
    }
  });
}
  </script>
  
<script>



 if (window.innerWidth  < 800 ){
        $('.card-body').removeClass('show');

          }

  $(document).ready(function() {

          CKEDITOR.instances.EditDes.setData("{!! $job->des !!}", function()
{
    this.checkDirty();  // true
});  


      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }

      // $('#example').DataTable({
      //   "paging":   false,
      //   "info":     false,
      //   "searching": false
      // });
    });
</script>
@endsection
