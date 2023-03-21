@extends('../layouts/index')
@section('content')


<link rel="stylesheet" href="js-css/css/stepprogressbar.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style type="text/css">
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
                <h6>Quản lý công việc</h6>
            </div>
            <div class="header-content-right" style="display: inline;">
                <h6 class="display-inline">Quản lý công việc</h6>
            </div>
        </div>
        <div class="session">
            @if(Session::has('notification'))
              <input hidden="" notifi="{{Session::get('notification')}}" value="1" id="notice_success">
            @endif
            @if(Session::has('warning'))
              <input hidden="" notifi="{{Session::get('warning')}}" value="1" id="notice_warning">
            @endif
        </div>
        <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> notifition</h6>
      </div>
      <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning</h6>
      </div>
                      </div>
              </div>
 <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content1">Công việc đang thực hiện</a>
      </li> 
      <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content2">Công việc đã hoàn thành</a>
      </li>
     <li class="nav-item margin_center">
          <a id="tab4" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content3">Công việc đã hủy</a>
      </li>
    </ul> 
  <hr>


<div class="tab-content">
 
  <div id="content1" class="tab-pane  in active">
          <div class="row row-content">
            <div class="row-title-proxy">
                      <div class="proxy-add" title="New Edge"><button type="button" class=" job-create camera-button" data-toggle="modal" data-target="#create-job" id="{{$id}}"><i class="fa fa-plus" aria-hidden="true"></i>công việc mới </button></div>
                      <div class="proxy-add" title="Delete"><button type="button" class="camera-button" id="device-remove"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button><button style="display: none;" id="remove-credential" type="submit"></button></div>
                      <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>
                     

                      <div class="search-input proxy-add" title="Serach">
                        <input type="text" class="textbox" id="search-input" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div>
              </div>

              </div>
              <?php 
$i = 1;
              ?>
                          @foreach($curent_schedule as $schedule)
           <div  id="root{{$schedule->id}}">
                          <table id="bigtable"  class="root_table" onclick="ToggleTable(this)">
                        <thead>
                        <tr class="thead">
                          <th style="width:5%"></th>
                            <th style="width:25%">Tổng quan</th>
                           
                            <th style="width:25%">Người giao</th>
                            <th style="width:30%">Tiến độ</th>
                            <th ></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">  <?php 
try{

            $seen = DB::table('job_noti')->where("job_id",$schedule->id)
            ->where("user_id",Auth()->user()->id)->first()->seen;

          }catch (\Exception $e) {
            $seen = 1;
          }


          try{
            $jids = DB::table("schedule")->where("root_id",$schedule->id)->pluck("id")->toArray();

            $sub_seen = DB::table('job_noti')->whereIn("job_id",$jids)
            ->where("user_id",Auth()->user()->id)->where("seen","<",1)->count();

          }catch (\Exception $e) {
            $sub_seen = 0;
          }


                           ?>
                           @if($seen < 1 || $sub_seen > 0)
                            <tr class="color-add" style="background-color:cadetblue">
                          
                            @else
  <tr class="color-add">
                            @endif
                            <td><h4 id="index{{$schedule->id}}">{{$i}}</h4></td>
                            <?php 
                                $i = $i + 1;
                             ?>
                              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;">  </i>Tên công việc:<span id="title{{$schedule->id}}"> {{$schedule->title}}</span></a><br>
                                Ngày bắt đầu: 
                                <span id="sdate{{$schedule->id}}">{{$schedule->start_date}}</span><br>
                                Ngày kết thúc: 
                                <span id="edate{{$schedule->id}}">{{$schedule->end_date}}</span>
                                <span id="lastId{{$schedule->id}}" style="display: none">{{$schedule->last_id}}</span><a  target="_blank" href="/chatify/schedule/{{$schedule->id}}">  <br>(Ấn để xem chi tiết)
</a>

                                </td>
<td>Ngươi giao: 
                                <span id="user1{{$schedule->id}}">
<?=DB::table("users")->where("id",$schedule->user_id)->first()->name?>
                                </span><br>
                                Phòng thực hiện: 
                                <span id="dept{{$schedule->id}}">
<?php
$did = DB::table("schedule_department")->where("schedule_id",$schedule->id)->pluck('department_id')->toArray();
$dname = DB::table("department")->whereIn("id",$did)->pluck('name')->toArray();

$html = "";
foreach($dname as $dname){
  $html = $html . $dname . ",";
}

$html = substr($html, 0, -1); 

?>
<?=$html?>
                                </span><br>
                                Người phụ trách: 
                                <span id="user{{$schedule->id}}">
<?php
$uid = DB::table("schedule_user")->where("schedule_id",$schedule->id)->pluck('user_id')->toArray();
$uname = DB::table("users")->whereIn("id",$uid)->pluck('name')->toArray();

$html = "";
foreach($uname as $uname){
  $html = $html .$uname .",";
}

$html = substr($html, 0, -1); 

?>
<?=$html?>
                                </span>
                              </td>
<td>
  <?php
  $total = DB::table("schedule")->where("last_id",$schedule->id)->where("status","<",2)->count();
  $com = DB::table("schedule")->where("last_id",$schedule->id)->where("status",1)->count();
  if($total >0){
  $percent = round($com/$total*100,2);
}else{
  if ($schedule->status == 0){
 $percent = 0;
  }else{
 $percent = 100;
  }
}
  ?>
  <span class="progress">
  <span class="progress-bar bg-success" style="width:{{$percent}}%";>
    Hoàn thành: {{$percent}}%
  </span>
  <span class="progress-bar bg-danger" style="width:{{100 - $percent}}%">   
  </span>
</span>

</td>
                             <td>
                           
                          <?php

if(DB::table("users")->where("id",$schedule->user_id)->first()->id == Auth()->user()->id){

  ?>
                           <span class="job-create preview" data-toggle="modal" data-target="#create-job" id="{{$schedule->id}}"><img src="/js-css/img/icon/plus.png"></span> 

                        <!--    <a href="/schedule/done/{{$schedule->id}}">
                             <span class="preview"><img src="/js-css/img/icon/success.png"></span>
                           </a>
 -->
                           <a href="/schedule/drop/{{$schedule->id}}">
                             <span class="preview"><img src="/js-css/img/icon/stop.png"></span>
                           </a>
                      <!-- <a href="/schedule/detail/{{$schedule->id}}">
                             <span class="preview"><img src="/js-css/img/icon/eye.png"></span>
                           </a> -->
                          <!--  <span style="margin-left: 2%" class="job-update preview" data-toggle="modal" data-target="#edit-job-modal" id="{{$schedule->id}}"><img src="/js-css/img/icon/write.png"></span> -->
<?php
}
?>
                            <!--   <a style="color: white"  type="button" href="schedule-list/{{$schedule->id}}" class="btn btn-del Disable"><i class="fa fa-list" aria-hidden="true" style="font-size: 1.2rem;"></i></a>

                              <a style="color: white"  type="button" href="schedule/file/{{$schedule->id}}" class="btn btn-del Disable"><i class="fa fa-folder-open-o" aria-hidden="true" style="font-size: 1.2rem;"></i></a> -->
                            </td>
                            </tr>   </tbody>
                      </table>
                      <div style="display:none" id="subScheduleContent{{$schedule->id}}" class="subScheduleContent">
                        
                      </div>
                    </div>
@endforeach
                    </div>

<div id="content2" class="tab-pane fade">


              <?php 
$i = 1;
              ?>
        
                          @foreach($complete_schedule as $schedule)
           <div  id="root{{$schedule->id}}">
                          <table id="bigtable"  class="root_table" onclick="ToggleTable(this)">
                        <thead>
                        <tr class="thead">
                            <th style="width:5%"></th>
                            <th style="width:25%">Tổng quan</th>
                           
                            <th style="width:25%">Người giao</th>
                            <th style="width:30%">Tiến độ</th>
                            <th ></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">  <?php 
try{

            $seen = DB::table('job_noti')->where("job_id",$schedule->id)
            ->where("user_id",Auth()->user()->id)->first()->seen;

          }catch (\Exception $e) {
            $seen = 1;
          }

                           ?>
                           @if($seen < 1)
                            <tr class="color-add" style="background-color:cadetblue">
                          
                            @else
  <tr class="color-add">
                            @endif 
                             <td><h4 id="index{{$schedule->id}}">{{$i}}</h4></td>
                            <?php 
                                $i = $i + 1;
                             ?>

                              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;">  </i>Tên công việc:<span id="title{{$schedule->id}}"> {{$schedule->title}}</span></a><br>
                                Ngày bắt đầu: 
                                <span id="sdate{{$schedule->id}}">{{$schedule->start_date}}</span><br>
                                Ngày kết thúc: 
                                <span id="edate{{$schedule->id}}">{{$schedule->end_date}}</span><a  target="_blank" href="/chatify/schedule/{{$schedule->id}}">  <br>(Ấn để xem chi tiết)
</a>
                                <span id="lastId{{$schedule->id}}" style="display: none">{{$schedule->last_id}}</span>

                                </td>
<td>Ngươi giao: 
                                <span id="user1{{$schedule->id}}">
<?=DB::table("users")->where("id",$schedule->user_id)->first()->name?>
                                </span><br>
                                Phòng thực hiện: 
                                <span id="dept{{$schedule->id}}">
<?php
$did = DB::table("schedule_department")->where("schedule_id",$schedule->id)->pluck('department_id')->toArray();
$dname = DB::table("department")->whereIn("id",$did)->pluck('name')->toArray();

$html = "";
foreach($dname as $dname){
  $html = $html . $dname . ",";
}

$html = substr($html, 0, -1); 

?>
<?=$html?>
                                </span><br>
                                Người phụ trách: 
                                <span id="user{{$schedule->id}}">
<?php
$uid = DB::table("schedule_user")->where("schedule_id",$schedule->id)->pluck('user_id')->toArray();
$uname = DB::table("users")->whereIn("id",$uid)->pluck('name')->toArray();

$html = "";
foreach($uname as $uname){
  $html = $html .$uname .",";
}

$html = substr($html, 0, -1); 

?>
<?=$html?>
                                </span>
                              </td>
<td>
  <?php
  $total = DB::table("schedule")->where("last_id",$schedule->id)->where("status","<",2)->count();
  $com = DB::table("schedule")->where("last_id",$schedule->id)->where("status",1)->count();
  if($total >0){

  $percent = round($com/$total*100,2);
}else{
  if ($schedule->status == 0){
 $percent = 0;
  }else{
 $percent = 100;
  }
}
  ?>
  <span class="progress">
  <span class="progress-bar bg-success" style="width:{{$percent}}%";>
    Hoàn thành: {{$percent}}%
  </span>
  <span class="progress-bar bg-danger" style="width:{{100 - $percent}}%">   
  </span>
</span>

</td>
                             <td>
                           
                          <?php

if(DB::table("users")->where("id",$schedule->user_id)->first()->id == Auth()->user()->id){

  ?>
                           <span class="job-create preview" data-toggle="modal" data-target="#create-job" id="{{$schedule->id}}"><img src="/js-css/img/icon/plus.png"></span> 


                          <!--  <span style="margin-left: 2%" class="job-update preview" data-toggle="modal" data-target="#edit-job-modal" id="{{$schedule->id}}"><img src="/js-css/img/icon/write.png"></span> -->
<?php
}
?>
                            <!--   <a style="color: white"  type="button" href="schedule-list/{{$schedule->id}}" class="btn btn-del Disable"><i class="fa fa-list" aria-hidden="true" style="font-size: 1.2rem;"></i></a>

                              <a style="color: white"  type="button" href="schedule/file/{{$schedule->id}}" class="btn btn-del Disable"><i class="fa fa-folder-open-o" aria-hidden="true" style="font-size: 1.2rem;"></i></a> -->
                            </td>
                            </tr>   </tbody>
                      </table>
                      <div style="display:none" id="subScheduleContent{{$schedule->id}}" class="subScheduleContent">
                        
                      </div>
                    </div>
@endforeach
                    </div>

<div id="content3" class="tab-pane fade">

              <?php 
$i = 1;
              ?>
                          @foreach($stop_schedule as $schedule)
           <div  id="root{{$schedule->id}}">
                          <table id="bigtable"  class="root_table" onclick="ToggleTable(this)">
                        <thead>
                       <tr class="thead">
                            <th style="width:5%"></th>
                            <th style="width:25%">Tổng quan</th>
                           
                            <th style="width:25%">Người giao</th>
                            <th style="width:30%">Tiến độ</th>
                            <th ></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">  <?php 
try{

            $seen = DB::table('job_noti')->where("job_id",$schedule->id)
            ->where("user_id",Auth()->user()->id)->first()->seen;

          }catch (\Exception $e) {
            $seen = 1;
          }

                           ?>
                           @if($seen < 1)
                            <tr class="color-add" style="background-color:cadetblue">
                          
                            @else
  <tr class="color-add">
                            @endif
                              <td><h4 id="index{{$schedule->id}}">{{$i}}</h4></td>
                            <?php 
                                $i = $i + 1;
                             ?>
                              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;">  </i>Tên công việc:<span id="title{{$schedule->id}}"> {{$schedule->title}}</span></a><br>
                                Ngày bắt đầu: 
                                <span id="sdate{{$schedule->id}}">{{$schedule->start_date}}</span><br>
                                Ngày kết thúc: 
                                <span id="edate{{$schedule->id}}">{{$schedule->end_date}}</span><a  target="_blank" href="/chatify/schedule/{{$schedule->id}}">  <br>(Ấn để xem chi tiết)
</a>
                                <span id="lastId{{$schedule->id}}" style="display: none">{{$schedule->last_id}}</span>

                                </td>
<td>Ngươi giao: 
                                <span id="user1{{$schedule->id}}">
<?=DB::table("users")->where("id",$schedule->user_id)->first()->name?>
                                </span><br>
                                Phòng thực hiện: 
                                <span id="dept{{$schedule->id}}">
<?php
$did = DB::table("schedule_department")->where("schedule_id",$schedule->id)->pluck('department_id')->toArray();
$dname = DB::table("department")->whereIn("id",$did)->pluck('name')->toArray();

$html = "";
foreach($dname as $dname){
  $html = $html . $dname . ",";
}

$html = substr($html, 0, -1); 

?>
<?=$html?>
                                </span><br>
                                Người phụ trách: 
                                <span id="user{{$schedule->id}}">
<?php
$uid = DB::table("schedule_user")->where("schedule_id",$schedule->id)->pluck('user_id')->toArray();
$uname = DB::table("users")->whereIn("id",$uid)->pluck('name')->toArray();

$html = "";
foreach($uname as $uname){
  $html = $html .$uname .",";
}

$html = substr($html, 0, -1); 

?>
<?=$html?>
                                </span>
                              </td>
<td>
  <?php
  $total = DB::table("schedule")->where("last_id",$schedule->id)->where("status","<",2)->count();
  $com = DB::table("schedule")->where("last_id",$schedule->id)->where("status",1)->count();
  if($total >0){

  $percent = round($com/$total*100,2);
}else{
  if ($schedule->status == 0){
 $percent = 0;
  }else{
 $percent = 100;
  }
}
  ?>
  <span class="progress">
  <span class="progress-bar bg-success" style="width:{{$percent}}%";>
    Hoàn thành: {{$percent}}%
  </span>
  <span class="progress-bar bg-danger" style="width:{{100 - $percent}}%">   
  </span>
</span>

</td>
                             <td>
                           
                          <?php

if(DB::table("users")->where("id",$schedule->user_id)->first()->id == Auth()->user()->id){

  ?>
                           <span class="job-create preview" data-toggle="modal" data-target="#create-job" id="{{$schedule->id}}"><img src="/js-css/img/icon/plus.png"></span> 


                          <!--  <span style="margin-left: 2%" class="job-update preview" data-toggle="modal" data-target="#edit-job-modal" id="{{$schedule->id}}"><img src="/js-css/img/icon/write.png"></span> -->
<?php
}
?>
                            <!--   <a style="color: white"  type="button" href="schedule-list/{{$schedule->id}}" class="btn btn-del Disable"><i class="fa fa-list" aria-hidden="true" style="font-size: 1.2rem;"></i></a>

                              <a style="color: white"  type="button" href="schedule/file/{{$schedule->id}}" class="btn btn-del Disable"><i class="fa fa-folder-open-o" aria-hidden="true" style="font-size: 1.2rem;"></i></a> -->
                            </td>
                            </tr>   </tbody>
                      </table>
                      <div style="display:none" id="subScheduleContent{{$schedule->id}}" class="subScheduleContent">
                        
                      </div>
                    </div>
@endforeach
                    </div>




          </div>
        </div>



    </div>
    <!-- Modal -->

     <div class="modal fade modol-text" id="create-job" role="dialog">
        <form id="action-form" action="add-new-schedule" method="POST"
         enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" id="create_id" name="id" value="0">
         
          <div  class="modal-dialog model-right" style="min-width: 100%;height: auto">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
        <h5 class="modal-title" style="font-size: 31px;">Tạo việc  mới </h5>
                 <button type="button" class="btn-close" data-dismiss="modal" onclick="close_form()" aria-label="Close"></button>

              </div>
              <div class="notification"></div>
              <div class="modal-body modal-config">
                <table class="table-edit table-model" style="font-size: 22px;">
                    <tbody class="table-edit">
                       <tr>
                            <td style="width: 15%"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tên </td>
                            <td><input type="" value="" name="name" class="input-edit create-user modol-text" id="name" required=""></td>
                        </tr>
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian bắt đầu </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="start_date" id="new_start_date" required=""></td>
                        </tr>
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian kết thúc </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="end_date" id="new_end_date" required=""></td>
                        </tr>

                         <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea rows="100"  name="des" class="ckeditor form-control input-edit modol-text"  required=""></textarea></td>
                        </tr>




</tbody>

                    <tbody class="table-edit">
                       
                        
                       
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>



              <div  style="margin-top: 3%;">


                        <div class="form-group">
                    <input style="display: none" type="file" name="file[]" class="file"
                    multiple>

                    <div >
                        
                        <div>
                            <button type="button" class="browse btn button-43">Tải tệp lên</button>
                        </div>
                    </div>
                <div class="form-group" id="preview">
                </div>
                <div class="form-group" id="preview-file"></div>
                </div>
                

                <button class="button-77" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Tạo</button>
                <button type="button" class="button-77" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>
        </form>
      </div>
      </div>
      </div>
      </div>
      </div>

<div class="modal fade modol-text" id="edit-job-modal" role="dialog">
        <form id="edit-schedule" method="POST" action="edit-schedule" 
         enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="id" id="edit_id" value="">
          <div  class="modal-dialog model-right"  style="min-width: 50%;height: auto">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label><i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 1.2em;"></i>&nbsp; Thông tin người dùng</label>
              </div>
              <div class="notification"></div>
              <div class="modal-body">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                         <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tên </td>
                            <td><input type="" value="" name="name" class="input-edit create-user modol-text" id="edit_name" required=""></td>
                        </tr>
                      
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian bắt đầu </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="start_date" id="edit_start_date" required="" value="01-01-2021"></td>
                        </tr>
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian kết thúc </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="end_date" id="edit_end_date" required=""  value=""></td>
                        </tr>
                           <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea  name="des" class="ckeditor form-control input-edit modol-text"  required="" id="EditDes"></textarea></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                     <!--                    <div class="form-group">
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
              </div> -->
              <div id="deptEditDiv"></div>
              <div id="staffEditDiv"></div>
              <hr><br>
              <div class="form-group"  id="status">
                <select class="form-select" name="status">
  <option selected>Chọn</option>
  <option value="1">Đã hoàn thành</option>
  <option value="2">Không hoàn thành</option>
  <option value="3">Hủy</option>
</select>

              </div>

            </div>
            <br><hr><br>
              <div class="modal-footer">
                <button class="btn btn-model" type="submit"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Cập nhật </button>
                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>
            </div>
          </div>
        </form>
      </div>



<div class="modal fade modol-text" id="ConsumerInfoModal" role="dialog">
  <div class="modal-dialog model-right" >
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label>Danh sách giao dịch</label>
      </div>
      <div class="notification"></div>
      <form action="add-history-zone"  enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="modal-body">
           <h5> Họ tên: <span id="ConsumerName"></span></h5>
           <h5> Số điện thoai: <span id="ConsumerPhone"></span></h5>
                      <div class="search-input proxy-add" title="Serach">
                        <input type="text" class="textbox" id="search-input" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div>
<table id="zone-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Tên căn hộ </th>
                            <th>Trạng thái</th>
                          </tr>
                        </thead>
                        <tbody class="tbody" id="consumerInfo">

                        </tbody>
                      </table>
    </div>
  </div>
</div>

        
<script type="text/javascript">
  $(document).on("click", ".browse", function() {
          console.log($(this))
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


    $(document).ready(function() {

        if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }

        $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');

        $("#"+this.href.split("#")[1]).addClass('active');
        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });

    
  });

      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }
</script>

<script type="text/javascript">
  $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });
  
  $("#search-input").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#camera-table tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });

    function checkAll() {
      if($('#select-all').is(':checked') == true){
        $('.check-box').prop('checked', true);
      }
      else{
        $('.check-box').prop('checked', false);
      }
    }
</script>

<script>
  function confirm_remove() {
          var remove = document.getElementById('device-remove');
          remove.addEventListener('click', function(e){
              swal({
                  title: "",
                  text: " Bạn có muốn xóa quy trình không? ",
                  type: "info",
                  showCancelButton: true,
                  confirmButtonText: "Yes",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false,
                  reverseButtons: true },
                  function(isConfirm){
                  if (isConfirm)
                  {
                    loading_nomal()
                    document.getElementById("remove-credential").click();
                    swal.close();
                  }
                  else {
                    swal.close();
                  }
                });
            });
        }
        confirm_remove();
</script>

<script src="/js-css/js/bootstrap-select.min.js"></script>
<script src="/js-css/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  function 
  loadInfo(id){
     $.ajax({
      type: "GET",
      url: '/consumer-info/'+id,
      success: function (response) {

          $("#consumerInfo").empty();
          document.getElementById("ConsumerName").innerHTML = document.getElementById("cname"+id).innerHTML
          document.getElementById("ConsumerPhone").innerHTML = document.getElementById("cphone"+id).innerHTML
          var table = document.getElementById("consumerInfo"); 
        console.log("process list")
        response = (JSON.parse(response))

        for (var i = 0;i < response.length;i++){
            var row = table.insertRow();
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          cell1.innerHTML = response[i].name
          cell2.innerHTML = '<a href="/sale/view/'+response[i].id+'"> '+response[i].status+'</a>'
          
        }
        $("#ConsumerInfoModal").modal()
      }

    });
}

function updateInfo(id){
          document.getElementById("EditId").value = id
          document.getElementById("EditName").value = document.getElementById("cname"+id).innerHTML
          document.getElementById("EditPid").value = document.getElementById("pid"+id).innerHTML
        $("#EditInfoModal").modal()

}
 function getStaffList(id){

  console.log('/system/shedule-staff/'+id)
  $.ajax({
    type: "GET",
    url: '/system/shedule-staff/'+id,
    success: function (response) {
      res = (JSON.parse(response))
      response = res[0]
      
      dept = res[1]
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


      html = ''
      for(var i =0; i < response.length; i++){
          html = html +'<option  value="'+response[i].id+'">'+response[i].name+ "-"+response[i].rname + "(" +  response[i].dname + ")" +'</option>'
      }
      document.getElementById("staffselect").innerHTML=html;

      console.log(document.getElementById("staffselect").innerHTML)
      $("#staffselect").selectpicker("refresh");
$('#staffselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});

html = ''

console.log(dept)
      for(var i =0; i < dept.length; i++){
        console.log("why not here")
          html = html +'<option  value="'+dept[i].id+'">'+dept[i].name+'</option>'
      }
      document.getElementById("departselect").innerHTML=html;

      $("#departselect").selectpicker("refresh");
$('#departselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});



    }
  });
}
// getStaffList({{$id}})

 function getStaffSelectedList(id,sid){
  $.ajax({
    type: "GET",
    url: '/schedule/staff-select/'+id+"/"+sid,
    success: function (response) {
      response = (JSON.parse(response))
      console.log(response)
      var data = response[0]
      var sel = response[1]
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


     var  html = '<select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffEditSelected" multiple>'
      for(var i =0; i < data.length; i++){
          if (sel.includes(data[i].id)){
          html = html +'<option  value="'+data[i].id+'" selected>'+data[i].name+ "-"+data[i].rname + "(" +  data[i].dname + ")" +'</option>'
          }else{
          html = html +'<option  value="'+data[i].id+'">'+data[i].name+ "-"+data[i].rname + "(" +  data[i].dname + ")" +'</option>'

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


 function getDeptSelectedList(id,sid){
  $.ajax({
    type: "GET",
    url: '/schedule/dept-select/id/'+sid,
    success: function (response) {
      response = (JSON.parse(response))
      console.log(response)
      var data = response[0]
      var sel = response[1]
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


     var  html = '<select name="did[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="deptEditSelected" multiple>'
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
      document.getElementById("deptEditDiv").innerHTML=html;
$('#deptEditSelected').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
    }
  });
}
 $(".job-create").click(function(){
    console.log("okoe123123")
    var jobid = this.id; 
    $("#create_id").val(jobid);
    // var lastID = document.getElementById("lastId"+jobid).innerHTML;
    // getStaffList(jobid)
    // getDeptSelectedList(lastID,jobid)

  });


   $(".job-update").click(function(){
    console.log("okoe")
    var jobid = this.id;
    $("#edit_id").val(jobid);
    var name = document.getElementById("title"+jobid).innerHTML
    $("#edit_name").val(name);
    var des = document.getElementById("content"+jobid).innerHTML
    // $("#EditDes").val(des);

          CKEDITOR.instances.EditDes.setData( document.getElementById("content"+jobid).innerHTML, function()
{
    this.checkDirty();  // true
});  
    // var names = document.getElementById("jnames"+jobid).innerHTML
    // $("#job_user_detail").val(names);
    var jstartdate = document.getElementById("sdate"+jobid).innerHTML
    console.log(jstartdate)
    document.getElementById("edit_start_date").value =jstartdate;

    var jenddate = document.getElementById("edate"+jobid).innerHTML
    $("#edit_end_date").val(jenddate);
    var lastID = document.getElementById("lastId"+jobid).innerHTML;

    getStaffSelectedList(lastID,jobid)
    getDeptSelectedList(lastID,jobid)

  })
</script>
<script type="text/javascript">
    function getSubScheduleList(id,index){
      console.log("begin")
      console.log(id)
   
  $.ajax({
    type: "GET",
    url: 'schedule/get-subshedule-for-staff-as-json/'+id,
    success: function (response) {
      res = (JSON.parse(response))
      console.log(id)

      response = res[0]
      console.log(response)
      dept_list = res[1]
      name_list = res[2]
      fix_list = res[3]
      percent_list = res[4]
      seen = res[5];
      // console.log(response);
      for(i=0;i<response.length;i++) {

        var myid = i + 1;
        var html = ' <div style="margin-left:3%"  id="root'+response[i].id+'"> <table class="root_table" onclick="ToggleTable(this)"><tbody class="tbody">'

        // html = html + '<tr class="color-add"><td>  <input type="checkbox" id="'+response[i].id+'" value="'+response[i].id+'" name="'+response[i].id+'" class="check-box" />  <label for="'+response[i].id+'" class="add-cam"></label></td>'
 if(seen[i] <1){
            html = html + ' <tr class="color-add" style="background-color:cadetblue">'
        }else{
          html = html + '<tr class="color-add">'
        } 
         if (index.toString().includes(".") == false){
          console.log("index"+id)
          index = document.getElementById("index"+id).innerHTML;
        }
        html = html + '<td style="width:5%"><h4>'+index+"."+myid+'<h4><div>'
        html = html + '<td style="width:25%"><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;">  </i>Tên công việc:<span id="title'+response[i].id+'+"> '+response[i].title+'</span></a><br>  Ngày bắt đầu:   <span id="sdate'+response[i].id+'">'+response[i].start_date+'</span><br>  Ngày kết thúc:   <span id="edate'+response[i].id+'">'+response[i].end_date+'</span><br><a  target="_blank" href="/chatify/schedule/'+response[i].id+'">Ẫn để xem chi tiết</a><span id="lastId'+response[i].id+'" style="display: none">'+response[i].last_id+'</span></td>'


        // html = html +'<td id="content'+response[i].id+'">'+response[i].content+'</td>'


if (dept_list[i] != false){
  var dept = dept_list[i] 
}else{

  var dept = "Không"
}
   if (name_list[i] != false){
  var myname = name_list[i] 
}else{

  var myname = "Không"
}
         html = html +'<td style="width:25%">Phòng thực hiện: '+dept+'<br>Người phụ trách: '+myname+'</td>'


        remain = 100 - percent_list[i]
        html = html +'<td style="width:30%"><span class="progress"><span class="progress-bar bg-success" style="width:'+percent_list[i]+'%";>  Hoàn thành: '+percent_list[i]+'%</span><span class="progress-bar bg-danger" style="width:'+remain+'%"></span></span></td>'

        html = html + "<td>"

        html = html + fix_list[i]

        // html = html + '<a style="color: white"  type="button" href="schedule-list/'+response[i].id+'" class="btn btn-del Disable"><i class="fa fa-list" aria-hidden="true" style="font-size: 1.2rem;"></i></a><a style="color: white"  type="button" href="schedule/file/'+response[i].id+'" class="btn btn-del Disable"><i class="fa fa-folder-open-o" aria-hidden="true" style="font-size: 1.2rem;"></i></a>'
        html = html + "<td>"


        html = html + "</td>"
        html = html +'</tr></tbody></table><div style="display:none" id="subScheduleContent'+response[i].id+'" class="subScheduleContent">'
        console.log(html)
        console.log("subScheduleContent"+id)
        document.getElementById("subScheduleContent"+id).innerHTML = 
document.getElementById("subScheduleContent"+id).innerHTML + html

        getSubScheduleList(response[i].id,index+"."+myid)

      }

    }
  });
}
  // $(".root_table").on("click", function(e) {
  //     e.preventDefault();
  //     console.log("okoek")
  //     $(this).next("div").slideToggle();
  //   });

function ToggleTable(elmt){
      $(elmt).next("div").slideToggle();
      var nextEle =  $(elmt).next("div").children();

        console.log(nextEle.length);
      for (var i = 0; i < nextEle.length; i++) {
        // console.log(nextEle[i].children()[0]);
          $(nextEle[i]).children()[0].click();
      }
}



<?php 
$i = 1;
 ?>
@foreach($schedule_list as $sid)

getSubScheduleList({{$sid}},{{$i}})


<?php 
$i = $i + 1;
 ?>
@endforeach


</script>
@endsection
