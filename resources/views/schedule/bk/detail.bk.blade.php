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


  .direct-chat-messages{
    height: 550px;
  }
  .mylink{
    color: white;

  }
  .mylink:hover{
    color: white;
  }
  .img-chat-view{
    width: 300px;
    height:auto;
    float: right;
  }

</style>

	<div class="content-camera">
		<div class="header-content">
			<div class="header-content-left">
				<h6>Chi tiết công việc {{$schedule->title}}</h6>
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
     
    <?php $level = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->level;
    $depart = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->department_id;
    ?>

     <div class="row row-content">
      <div class="row-title-proxy">
  

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

 $did = DB::table("schedule_department")->where("schedule_id",$schedule->id)->pluck('department_id')->toArray();
            $dname = DB::table("department")->whereIn("id",$did)->pluck('name')->toArray();

            $html = "";
            foreach($dname as $dname){
              $html = $html . $dname . ",";
            }

            $html = substr($html, 0, -1); 
            ?>

            <h3> Tên công việc:  {{$schedule->title}}</h3>
            <h3> Phòng thực hiện: {{$html}}</h3>
            <h3> Mô tả:</h3><div class="job-content"> {!! $schedule->content !!}</div>

          <!--   <hr>
            <button class="btn btn-primary" onclick="getToken()">Chia sẻ công việc</button>
            <p id="ShareLink"></p>
            <hr> -->
            <h3> Tệp đính kèm</h3>

                     
<table id="job-url" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Tên tệp </th>
                            <th>Loại tệp</th>
                            <th>Người tải lên </th>
                            <th>Thời gian</th>
                          </tr>
                        </thead>
                        <tbody class="tbody" id="job_history">
                          @foreach($files as $file)
                        <tr class="color-add">
                          <td>
           <?php
            if(strpos($file->url,".png") > 0 
            || strpos( $file->url,".jpg") > 0 
            || strpos($file->url,".jpeg") > 0 
          ){
              $type = "photo.jpg";
          }elseif (strpos($file->url,".pdf")> 0) {
              $type = "pdf.png";
          }elseif (strpos($file->url,".doc")> 0) {
              $type = "word.png";
          }elseif (strpos($file->url,".ppt")> 0) {
              $type = "pp.png";
          }elseif (strpos($file->url,".xls")> 0
            || strpos( $file->url,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "photo.jpg";
          }

                              ?>

                               <span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span>
                            <a target="_blank" href="{{$file->url}}">{{$file->title}}<a>

                            </td>
                          <td>
                            @if($file->type == 1)
                              Yêu cầu
                            @else
                              Kết quả
                            @endif

                          </td>
                          @if($file->user_id   < 0)
                  <?php
                   $guest = DB::table("schedule_guest")->where("id",$file->user_id *-1)->first();
                  ?>
                          <td>{{$guest->name}}</td>
                  @else
                          <td>{{$file->uname}}</td>

                  @endif
                          <td>{{$file->time}}</td>
                          
                        </tr>
                      @endforeach
                        </tbody>
                      </table>


@if( $schedule->status !==1)
<div class="card card-custom"> 
   <div class="card-header"  data-toggle="collapse" data-target="#targeti">
                                        <h3 class="card-title">
   Thêm tệp  </h3>

                         </div>           
              <div class="card-body"  id="targeti" >

 <form action="schedule/add-file"  enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">

  <table class="table-edit table-model">
                    <tbody class="table-edit">
                        
              <tr>
                            <td>Tên tệp tin</td>
                            <td><input value="" type="" value="" name="title" class="input-edit modol-text" required="">
                            </td>
                        </tr>
                  <tr>
                    <td>Loại</td>
<td> <select class="custom-select select-profile  browser-default" name="type" >
                        <option value="1"> Yêu cầu </option>
                        <option value="2"> Kết quả </option>
                        <!-- <option value="3">Ngưng</option> -->
               </select>
                            </td> 
                  </tr>
                        <tr>
                <td >Tải lên </td>
                  <td> <input type="hidden" value="{{$schedule->id}}" name="id" id="job_input_id" class="input-edit modol-text" required=""><label  class="preview" for="file-input"><img onclick="openfileupload(1)"  src="/js-css/img/icon/upload.png"></label><input  id= "inputfile1" style="display:none" type="file" name="file[]" class="form-control"
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
</div>
</div>
@endif
            </div>
          </div></div>

           <div class="col-md-4 col-12 col-sm-12"> 
     <div class="card card-custom">
                                         <div class="card-header" data-toggle="collapse" data-target="#target2">
                                        <h3 class="card-title">
   Thời gian </h3>
</div>
                                    
                                      <div class="card-body collapse show"  id="target2" >

            <h3> Ngày bắt đầu: {{$schedule->start_date}}</h3>
            <h3> Ngày kết thúc: {{$schedule->end_date}}</h3>

            <?php
$date1 = date("Y-m-d H:i:s");
$date2 = $schedule->end_date;
$timestamp1 = strtotime($date1);
$timestamp2 = strtotime($date2);
$hour = intval(($timestamp2 - $timestamp1)/(60*60));
if ($hour < 0){
  $hour = 0;
}
?>

            <h3> Thơi gian còn lại: {{$hour}} Giờ</h3>
            <h3> Trạng thái:
              @if($schedule->status ==1)
              <span style="color: green">Đã hoàn thành</span>
              @elseif($schedule->status ==2)

              <span style="color: red"> Không hoàn thành</span>
              @elseif($schedule->status ==3)
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
<?php
$user = DB::table("users")->where("id",$schedule->user_id)->first(); 
?>
            <h3> Người giao việc: {{$user->name}}</h3>
            <h3><a href="mailto:{{$user->email}}"> Email: {{$user->email}}</a></h3>
            <h3><a href="tel: {{$user->phone}}"> Số điện thoại: {{$user->phone}}
            </a></h3>


           <!--  <a href="chatify" class="job-update preview"  ><img src="/js-css/img/icon/write.png"> Nhắn tin</a> -->
            </div>
              </div>

                                         <div class="card-header" data-toggle="collapse" data-target="#target3">
                                        <h3 class="card-title">
   Thông tin người phụ trách </h3>
</div>
                                    
                                      <div class="card-body collapse show"  id="target3" >
<?php
  $uid = DB::table("schedule_user")->where("schedule_id",$schedule->id)->pluck('user_id')->toArray();
            $uname = DB::table("users")->whereIn("id",$uid)->pluck('name')->toArray();

            $html = "";
            foreach($uname as $uname){
              $html = $html .$uname .",";
            }

            $html = substr($html, 0, -1); 
?>
            <h3> Người phụ trách: {{$html}}</h3>
           
            <span class="job-update preview" data-toggle="modal" data-target="#edit-job-modal" id="{{$schedule->id}}"><img src="/js-css/img/icon/write.png"> Sửa thông tin</span>
          </div></div>
@if(Auth()->user()->id == $user->id && $schedule->status !==1 )
<div class="card card-custom"> 
   <div class="card-header"  data-toggle="collapse" data-target="#targeth">
                                        <h3 class="card-title">
   Cập nhật trạng thái  </h3>

                         </div>           
              <div class="card-body collapse show"  id="targeth" >

<form action="close-schedule"  enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input id="status_input_id" type="hidden" name="id" value="{{$schedule->id}}">

  <table class="table-edit table-model">
                    <tbody class="table-edit">
                        
              <tr>
                            <td><i class="fa fa-credit-card" aria-hidden="true"></i> Trạng thái</td>
                            <td> <select class="custom-select select-profile  browser-default" name="status" >
                        <option value="1">Hoàn thành </option>
                        <option value="2">Không hoàn thành </option>
                        <!-- <option value="3">Ngưng</option> -->
               </select>
                            </td> <td>
                            <button class="btn btn-model"> Cập nhật </button>
                          </td>
                       
                         
                        </tr>
                      </tbody>
                    </table>
</form>
</div>
</div>
@endif
            </div>

     
</div>

            <div class="card direct-chat direct-chat-primary">
              <div class="card-header">
                <h1 class="card-title">Trao đổi trực tuyến</h1>

                <div class="card-tools">
                 
                </div>
              </div>
              <!-- /.card-header -->
<div class="row">
  <div class="col-12 col-md-8">
              <div class="card-body">
                <!-- Conversations are loaded here -->
                <div id="mymessages2" class="direct-chat-messages" style="background-color:white;">
                  @foreach($messages as $message)
                  @if($message->user_id == Auth()->user()->id)
                  <div class="direct-chat-msg right">
                  @else
                  <div class="direct-chat-msg">
                  @endif
                   @if($message->user_id   < 0)
                  <?php 
                    $guest = DB::table("schedule_guest")->where("id",$message->user_id *-1)->first();
                    ?>
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left" style="color:black">{{$guest->name}}</span>
                      <span class="direct-chat-timestamp float-right">{{$message->time}}</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="js-css/img/icon/avatar.png" alt="message user image">
                    @else
                     <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left" style="color:black">{{$message->name}}</span>
                      <span class="direct-chat-timestamp float-right">{{$message->time}}</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="{{$message->avatar}}" alt="message user image">
                    @endif
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      @if(strlen($message->attachment) > 0)
                      <a class="mylink" target="_blank" href="{{$message->attachment}}">

                    {{$message->body}}</a> 
                      @else
                    {{$message->body}}
                    @endif

                    </div>
                  </div>
                      @if(strlen($message->attachment) > 0)
                      <?php 
                         if(strpos($message->attachment,".png") > 0 
            || strpos( $message->attachment,".jpg") > 0 
            || strpos($message->attachment,".jpeg") > 0 
          ){

                       ?>
   <a class="mylink" target="_blank" href="{{$message->attachment}}"><img class="img-chat-view" src="{{$message->attachment}}"></a>

<?php
}
?>
                    @endif
                    <!-- /.direct-chat-text -->

                   
                  @endforeach

                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer" style="background-color: antiquewhite">
                  <div class="input-group">
                    <input id="mymess2" type="text" name="message" placeholder="Nhập tin nhắn ..." class="form-control">
                    <button onclick="openfileupload(11)" type="button" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> </button>
                    <span class="input-group-append">
                      <button onclick="ConnectDB()" type="button" class="btn btn-primary">Gửi </button>
                    </span>
                  </div>              </div>
              <!-- /.card-footer-->
            </div><form id="UploadForm" enctype="multipart/form-data" action="mess/upload" method="post">

<input type="hidden" name="id" value="{{$schedule->id}}"> 
<input type="hidden" name="_token" value="{{csrf_token()}}"> 
            <input onchange="uploadsubmit()"  id= "inputfile11" style="display:none" type="file" name="file[]" class="form-control"
                    multiple>
                  </form>
   

<div class="col-12 col-md-4">
    <h3>Danh sách tệp đính kèm</h3>
    <ul  class="list-group">
      @foreach($attachment as $attachment)
        <li style="color:black;" class="list-group-item" > <a style="color:black; class="mylink" target="_blank" href="{{$attachment->attachment}}">

                    {{$attachment->body}}</a> </li>
      @endforeach
    </ul>
          </div>

  

  </div>
        </div>
          <div id="contentl2" class="tab-pane  fade">
           
            <div id="job_detail2">
            <h4>Trao đổi công việc</h4>
                      
             
                    </div>



          </div>
      <div class="modal fade modol-text" id="add-task-modal" role="dialog">

        <form id="edit-schedule" method="POST" action="add-task" 
         enctype="multipart/form-data">

          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="job_id" id="edit_id" value="{{$schedule->id}}">
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
                            <td> <input type="date" class="input-edit modol-text form-control" name="start_date" id="edit_start_date" required="" value="{{$schedule->start_date}}"></td>
                        </tr>
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian kết thúc </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="end_date" id="edit_end_date" required=""  value="{{$schedule->end_date}}"></td>
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

                      <!--   <div class="form-group">
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
                </div> -->


  <select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffselect" multiple>


</select>
            

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
                            <td> <input type="date" class="input-edit modol-text form-control" name="end_date" id="EditEnd" required=""  value="{{$schedule->end_date}}"></td>
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
<!--    <div class="form-group">
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
                </div> -->
                
                <br>
  <select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffselectEdit" multiple>

                      
</select>
            

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

        <form id="edit-schedule" method="POST" action="edit-schedule" 
         enctype="multipart/form-data">

          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="id" id="edit_id" value="{{$schedule->id}}">
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
                            <td><input type="" value="{{$schedule->title}}" name="name" class="input-edit create-user modol-text" id="edit_name" required=""></td>
                        </tr>
                      
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian bắt đầu </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="start_date" id="edit_start_date" required="" value="{{$schedule->start_date}}"></td>
                        </tr>
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian kết thúc </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="end_date" id="edit_end_date" required=""  value="{{$schedule->end_date}}"></td>
                        </tr>
                          <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea value="{!! $schedule->content !!}"  name="des" class="ckeditor form-control input-edit modol-text"  required="" id="EditDes"></textarea></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
   <!-- <div class="form-group">
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
                </div> -->

            
              <div id="deptEditDiv"></div>
              <div id="staffEditDiv"></div>

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

          CKEDITOR.instances.EditDes.setData("{!! $schedule->content !!}", function()
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
<script type="text/javascript">
  

 function getStaffSelectedList(id,sid){
  console.log('/schedule/staff-select/'+id)
  $.ajax({
    type: "GET",
    url: '/schedule/staff-select/'+id,
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



getStaffSelectedList({{$schedule->id}})
getDeptSelectedList({{$schedule->last_id}},{{$schedule->id}})



</script>
<script type="text/javascript">
  
  function getToken(){
    $.ajax({
            url: 'schedule/get-token/{{$schedule->id}}',
            type: 'GET',
            success: function (data) {
              document.getElementById("ShareLink").innerHTML = "http://localhost/schedule/guest-detail/"+data
            }
        });
}

</script>
<script type="text/javascript">
  

       function ConnectDB(){
        console.log("was it here???")
        var mymess =  document.getElementById("mymess2").value
        document.getElementById("mymess2").value = ""

var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = date+' '+time;

        html = '  <div class="direct-chat-msg right"><div class="direct-chat-infos clearfix">  <span class="direct-chat-name float-right">{{Auth()->user()->name}} </span>  <span class="direct-chat-timestamp float-left">'+dateTime+'</span></div><img class="direct-chat-img" src="{{Auth()->user()->avatar}}" alt="message user image"><div class="direct-chat-text"> '+mymess+'</div></div>'

         document.getElementById("mymessages2").innerHTML = 
      document.getElementById("mymessages2").innerHTML + html

        $("#mymessages2").animate({
                    scrollTop: $('#mymessages2').get(0).scrollHeight
                }, 2000);
         $.ajax({

      type: "POST",
      url: '/schedule/mess-save-db',
      data: {id: {{$schedule->id}},mess: mymess, _token: '{{csrf_token()}}'},
      success: function(data) {
        console.log(data)
        data = JSON.parse(data);
        console.log(data)

        var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = date+' '+time;
var html =  ""
for(i = 0; i < data.length;i++){
        html = html + '<div class="direct-chat-msg"><div class="direct-chat-infos clearfix">  <span class="direct-chat-name float-left">'+data[i].name+'</span>  <span class="direct-chat-timestamp float-right">'+dateTime+'</span></div><!-- /.direct-chat-infos --><img class="direct-chat-img" src="'+data[i].avatar+'" alt="message user image"><div class="direct-chat-text"> '+data[i].text.replaceAll('\n', '<br>')+'</div></div>'
}
      document.getElementById("mymessages2").innerHTML = 
      document.getElementById("mymessages2").innerHTML + html
      }
    });




      }




document.querySelector("#mymess2").addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
        ConnectDB()
    }
});


var id = {{$chat_id}}

function newMess(){
  console.log(id)
var html = ""
  var content = ""
     $.ajax({

      type: "get",
      url: '/schedule/get-mess/{{$schedule->id}}/'+id,
      success: function(data) {
        // console.log(data)
        data = JSON.parse(data);
        // console.log(data)
        id = data[1]
        data = data[0]
for(i = 0; i < data.length;i++){
addon =""
  if(data[i].attachment !== null){
    content ='<a class="mylink" target="_blank" href="'+data[i].attachment+'">'+ data[i].body.replaceAll('\n', '<br>')+'</a>'

    if  (data[i].attachment.includes(".png")
      || data[i].attachment.includes(".jpg")
      || data[i].attachment.includes(".jpeg")){
      addon = '<a class="mylink" target="_blank" href="'+data[i].attachment+'"><img class="img-chat-view" src="'+data[i].attachment+'"></a>'
    }

  }else{
    content = data[i].body.replaceAll('\n', '<br>')
  }
  if(data[i].user_id < 0){
    console.log(data[i].user_id)
        html = html + '<div class="direct-chat-msg"><div class="direct-chat-infos clearfix">  <span style="color:black" class="direct-chat-name float-left">'+'GUEST'+'</span>  <span class="direct-chat-timestamp float-right">'+data[i].time+'</span></div><img class="direct-chat-img" src="/js-css/img/icon/avatar.png" alt="message user image"><div class="direct-chat-text"> '+content+'</div></div>'
  }else{
        html = html + '<div class="direct-chat-msg"><div class="direct-chat-infos clearfix">  <span class="direct-chat-name float-left" style="color:black">'+data[i].name+'</span>  <span class="direct-chat-timestamp float-right">'+data[i].time+'</span></div><img class="direct-chat-img" src="'+data[i].avatar+'" alt="message user image"><div class="direct-chat-text"> '+content+'</div></div>'

  }

        html = html + addon
}
      document.getElementById("mymessages2").innerHTML = 
      document.getElementById("mymessages2").innerHTML + html

      }
    });
}

$(function(){
setInterval(newMess, 2000);
});


 function openfileupload(id){
        document.getElementById("inputfile"+id).click();
}


function uploadsubmit(){
  console.log("function in")
        var formData = new FormData($("#UploadForm")[0]);
  console.log("ajax in")

        $.ajax({
            url: 'schedule/upload',
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function (data) {
                    data = JSON.parse(data);
html = ""
for(i = 0; i < data.length;i++){

addon =""
  if(data[i].attachment !== null){
    content ='<a class="mylink" target="_blank" href="'+data[i].attachment+'">'+ data[i].body.replaceAll('\n', '<br>')+'</a>'
    if  (data[i].attachment.includes(".png")
      || data[i].attachment.includes(".jpg")
      || data[i].attachment.includes(".jpeg")){
      addon = '<a class="mylink" target="_blank" href="'+data[i].attachment+'"><img class="img-chat-view" src="'+data[i].attachment+'"></a>'
    }
  }else{
    content = data[i].body.replaceAll('\n', '<br>')
  }
        html = html + '<div class="direct-chat-msg right"><div class="direct-chat-infos clearfix">  <span class="direct-chat-name float-left">'+data[i].name+'</span>  <span class="direct-chat-timestamp float-right">'+data[i].time+'</span></div><img class="direct-chat-img" src="'+data[i].avatar+'" alt="message user image"><div class="direct-chat-text"> '+content+'</div></div>'


          html = html + addon


}
      console.log(html)
      document.getElementById("mymessages2").innerHTML = 
      document.getElementById("mymessages2").innerHTML + html
            $("#mymessages2").animate({
                    scrollTop: $('#mymessages2').get(0).scrollHeight
                }, 2000);


            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;

      // document.getElementById("uploadfile"+id).submit();
    }

  </script>
@endsection
