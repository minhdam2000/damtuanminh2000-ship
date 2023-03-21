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
    color: red!important;

  }
  .mylink:hover{
    color: white;
  }
  .img-chat-view{
    width: 300px;
    height:auto;
  }
.card-title{
  font-size:30px;
  font-weight: 600;
}
.direct-chat-msg{
    width: 50%!important;
  }
.right{
    margin-left: 50%;
  }
  @media(max-width:600px) {
    .direct-chat-msg{
    width: 100%!important;
  }
  .right{
    margin-left: 0%;
  }
}

.MImgList{
  max-height: 300px;
  overflow: auto;
}
  
.MFileList{
  max-height: 200px;
  overflow: auto;
}


.direct-chat-messages{
  height: 900px;
}

#ShareLink{
    width: 100%;
    font-size: 0.85em;
    background-color: wheat;
    height: 50px;
    font-size: 25px;
    color: blue;
    display: none;
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
     <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> notifition</h6>
      </div>
      <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning</h6>
      </div>
    <?php $level = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->level;
    $depart = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->department_id;
    ?>

     <div class="row row-content">
      <div class="row-title-proxy">
  

 <div class="tab-content">

          <div id="contentl0" >
          <div id= "info" class="row">
    <div class="col-md-8 col-12 col-sm-12"> 
     <div class="card card-custom">
                                         <div class="card-header" data-toggle="collapse" data-target="#target1">
                                        <h3 class="card-title">
   Thông tin cơ bản</h3>
</div>
                                    
                                      <div class="card-body collapse show"  id="target1" > 
                                        <div class="row">
                                          <div class="col-md-6 col-12">
            <h3> Tên công việc:  {{$schedule->title}}</h3>
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

          </div>
                                          <div class="col-md-6 col-12">
                                            <h4>Cập nhật trạng thái</h4>
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

          <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="jtab1" class="nav-link active color-a job-link"  data-toggle="tab" role="tab" href="#job-content1">Nội dung</a>
      </li> 
      <li class="nav-item margin_center">
          <a id="jtab2" class="nav-link color-a job-link "  data-toggle="tab" role="tab" href="#job-content2">Hình ảnh và file</a>
      </li>  

    <!--   <li class="nav-item margin_center">
          <a id="mtab3" class="nav-link color-a mess-link"  data-toggle="tab" role="tab" href="#mess-content3">Tệp</a>
      </li>  -->
    </ul> 

<div class="tab-content">
     <div class="job-content tab-pane in active" id="job-content1">

          {!! $schedule->content !!}</div>
     <div class="job-content tab-pane fade" id="job-content2">
            <h4 style="display: none;" id="imgFile"> Hình ảnh</h4>

                <div class="row form-group" id="listimg">
              <?php
                $flag = 0;
              ?>
              @foreach($files as $file)
               <?php
            if(strpos($file->url,".png") > 0 
            || strpos( $file->url,".jpg") > 0 
            || strpos($file->url,".jpeg") > 0 
          ){
              if($flag == 0){
                $flag == 1;
                ?>

            <script>
              document.getElementById("imgFile").style.display="block";
            </script>
                <?php
              }
            ?>

  <a target="_blank" href="{{$file->url}}">
<img style="width: auto;height: 200px" src="{{$file->url}}" id="listimg" class="preview"></a><br><br> 

<?php
}
?>

                            @endforeach
                       </div>


             
            <h4 style="display: none;" id="otherFile"> Khác</h4>
            <?php

           $flag =0;
            ?>
                          @foreach($files as $file)
           <?php

            if(strpos($file->url,".png") > 0 
            || strpos( $file->url,".jpg") > 0 
            || strpos($file->url,".jpeg") > 0 
          ){
              continue;
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

          if ($flag == 0){
            $flag =1;
            ?>
            <script>
              document.getElementById("otherFile").style.display="block";
            </script>
            <?php
          }




                              ?>

                               <span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span>
                            <a target="_blank" href="{{$file->url}}">{{$file->title}}
                            </a>
         

                      @endforeach

            </div>
        </div>


 <button class="btn btn-model" data-toggle="modal" data-target="#edit-job-modal" id="{{$schedule->id}}">Sửa thông tin</button>

            <button class="btn btn-model" onclick="getToken()">Chia sẻ công việc</button>
         <br>
            <p id="ShareLink"></p>
       <hr>
   <div class="card direct-chat direct-chat-primary">
              <div class="card-header">
                <h1 class="card-title">Trao đổi trực tuyến</h1>

                <div class="card-tools">
                 
                </div>
              </div>
              <!-- /.card-header -->
               <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="mtab1" class="nav-link active color-a mess-link"  data-toggle="tab" role="tab" href="#mess-content1">Tin nhắn</a>
      </li> 
      <li class="nav-item margin_center">
          <a id="mtab2" class="nav-link color-a mess-link "  data-toggle="tab" role="tab" href="#mess-content2">Cuộc trò chuyện con</a>
      </li>  

    <!--   <li class="nav-item margin_center">
          <a id="mtab3" class="nav-link color-a mess-link"  data-toggle="tab" role="tab" href="#mess-content3">Tệp</a>
      </li>  -->
    </ul> 

<div class="tab-content">
  <div id="mess-content1" class=" mess-pane  tab-pane  in active">
              <div class="card-body">
                <hr>
                <!-- Conversations are loaded here -->
                <div id="mymessages2" class="direct-chat-messages" style="background-color:white;">
                  @foreach($messages as $message)
                  @if($message->user_id == Auth()->user()->id)
                  <div class="direct-chat-msg right" id="mess{{$message->id }}">
                  @else
                  <div class="direct-chat-msg" id="mess{{$message->id }}">
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
                         @if($message->user_id == Auth()->user()->id)
                    <a class="preview" href="/schedule/delete-mess/{{$message->id}}"><img src="js-css/img/icon/recycle_bin.png"></a>

                  
                  @endif  @if($message->pin == 0) 
                    <a class="preview" href="/schedule/pin-mess/{{$message->id}}"><img src="js-css/img/icon/pin.png"></a>
                    @else

                    <a class="preview" href="/schedule/unpin-mess/{{$message->id}}"><img src="js-css/img/icon/pin2.png"></a>
                    @endif
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

                  @if($message->user_id == Auth()->user()->id)
   <a class="mylink" target="_blank" href="{{$message->attachment}}"><img style="float: right;" class="img-chat-view" src="{{$message->attachment}}"></a>
   @else

   <a class="mylink" target="_blank" href="{{$message->attachment}}"><img class="img-chat-view" src="{{$message->attachment}}"></a>
   @endif

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
                    <input id="mymess2" value="" type="text" name="message" placeholder="Nhập tin nhắn ..." class="form-control">
                    <span class="input-group-append">
                      <button onclick="ConnectDB()" type="button" class="btn btn-primary">Gửi </button>
                    </span>


                    <button onclick="openfileupload(11)" type="button" class="btn btn-success" style="
                    margin-left: 2%;"><i class="fa fa-upload" aria-hidden="true"></i> </button>

                  </div>              </div>
              <!-- /.card-footer-->
            <form id="UploadForm" enctype="multipart/form-data" action="mess/upload" method="post">

<input type="hidden" name="id" value="{{$schedule->id}}"> 
<input type="hidden" name="_token" value="{{csrf_token()}}"> 
<input type="hidden" name="name" value="" id="filename2"> 
            <input onchange="uploadsubmit()"  id= "inputfile11" style="display:none" type="file" name="file[]" class="form-control"
                    multiple>
                  </form>
   

</div>
  <div id="mess-content2" class="mess-pane tab-pane fade">
    <div class="row">
      <div class="col-md-4 col-12">
        <br>
        <h3>Chủ đề cuộc trò chuyện</h3>
 <ul  class="list-group"> 

  <?php 
$fid = 0;
   ?>
  @foreach($chat_pin as $mess)
<?php
if($fid == 0){
$fid = $mess->id;
}
?>
 <li  onclick="LoadSubMess({{$mess->id}})" style="color:black;" class="list-group-item" >   
       <span>{{$mess->body}}</span>

       <span style="display:none" id = "smDate{{$mess->id}}">{{$mess->time}}</span>
       <span style="display:none" id = "smFile{{$mess->id}}"> 

                      @if(strlen($mess->attachment) > 0)
        <a target="_blank" href="{{$mess->attachment}}">

        {{$mess->body}}

    </a>
    @else
    Không
    @endif
    </span>

                     </li>

                    
    @endforeach
 </ul>
      </div>
      <div id="SubMessContent" class="col-md-8 col-12">
        <div class="row">
          <div class="col-md-6 col-12">
            <h3>Thời gian: <span id="SubMessDate"></span></h3></div>
          <div class="col-md-6 col-12">
            <h3>Tệp đính kèm: <span id="SubMessFile"></span></h3></div>
        </div>

<hr>
              <div class="card-body">
                <!-- Conversations are loaded here -->
                <div id="submessages" class="direct-chat-messages" style="background-color:white;">
                </div>
              </div>
                 <!-- /.card-body -->
              <div class="card-footer" style="background-color: antiquewhite">
                  <div class="input-group">
                    <input id="submess" type="text" name="message" placeholder="Nhập tin nhắn ..." class="form-control">
                    <span class="input-group-append">
                      <button onclick="ConnectSubDB()" type="button" class="btn btn-primary">Gửi </button>
                    </span>


                    <button onclick="openfileupload(12)" type="button" class="btn btn-success" style="
                    margin-left: 2%;"><i class="fa fa-upload" aria-hidden="true"></i> </button>

                  </div>              </div>
   <form id="UploadSubForm" enctype="multipart/form-data" action="sub-mess/upload" method="post">

<input type="hidden" id="MessID" name="id" value="0"> 
<input type="hidden" name="_token" value="{{csrf_token()}}"> 
<input type="hidden" name="name" value="" id="subfilename"> 
            <input onchange="uploadsubsubmit()"  id= "inputfile12" style="display:none" type="file" name="file[]" class="form-control"
                    multiple>
                  </form>
      </div>

    </div>
   
    </div>
  
  
        </div>
          </div></div>
</div></div>
           <div class="col-md-4 col-12 col-sm-12">     
       

     <div class="card card-custom">
                                         <div class="card-header" data-toggle="collapse" data-target="#target2">
                   <h3 class="card-title">
    Thông tin chi tiết:</h3>                     
</div>

            <div class="card-body collapse show"  id="target2" > 
                                    
                                                <!--  <ul class="nav nav-tabs" id="tabs" role="tablist"> -->
   <!--    <li class="nav-item margin_center">
          <a id="jtab1" class="nav-link active color-a job-link"  data-toggle="tab" role="tab" href="#job-content1">Phòng thực hiện</a>
      </li> 
      <li class="nav-item margin_center">
          <a id="jtab2" class="nav-link color-a job-link "  data-toggle="tab" role="tab" href="#job-content2">Người giao</a>
      </li>  <li class="nav-item margin_center">
          <a id="jtab3" class="nav-link color-a job-link"  data-toggle="tab" role="tab" href="#job-content3">Người phụ trách</a>
      </li> 
    </ul>  -->
<hr>

<div class="tab-content"  style="height: 450px;overflow: auto;">

  <div class="job-pane container  in active">
    <?php

 $did = DB::table("schedule_department")->where("schedule_id",$schedule->id)->pluck('department_id')->toArray();
            $dname = DB::table("department")->whereIn("id",$did)->pluck('name')->toArray();

            $html = "Phòng giao việc: ";
            foreach($dname as $dname){
              $html = $html . $dname . ", ";
            }

            $html = substr($html, 0, -1); 
            ?>
 <h3> {{$html}}</h3>

           
          </div> 
<hr>

  <div  class="container  job-pane ">
<?php
$user = DB::table("users")->where("id",$schedule->user_id)->first(); 
?>
            <h3> Người giao việc: {{$user->name}}</h3>
            <h3><a href="mailto:{{$user->email}}"> Email: {{$user->email}}</a></h3>
            <h3><a href="tel: {{$user->phone}}"> Số điện thoại: {{$user->phone}}
            </a></h3>


           <!--  <a href="chatify" class="job-update preview"  ><img src="/js-css/img/icon/write.png"> Nhắn tin</a> -->
            </div>

                            <hr>             
  <div class=" container job-pane">
<?php
  $uid = DB::table("schedule_user")->where("schedule_id",$schedule->id)->pluck('user_id')->toArray();
            $staffs = DB::table("users")->whereIn("id",$uid)->get();
$i = 1;
?>
@foreach($staffs as $staff)
<h3> Người phụ trách {{$i}}: {{$staff->name}}</h3>
            <h3><a href="mailto:{{$user->email}}"> Email: {{$staff->email}}</a></h3>
            <h3><a href="tel: {{$user->phone}}"> Số điện thoại: {{$staff->phone}}
            </a></h3>
            <hr>
            <?php
$i = $i+1;
            ?>
@endforeach
          </div>

        </div>
@if(Auth()->user()->id == $user->id && $schedule->status !==1 )
<!-- <div class="card card-custom"> 
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
                      <option value="3">Ngưng</option> 
               </select>
                            </td> <td>
                            <button class="btn btn-model"> Cập nhật </button>
                          </td>
                       
                         
                        </tr>
                      </tbody>
                    </table>
</form>
</div>
</div> -->
@endif
</div>
</div>

                <div class="pin" >
<ul class="list-group" onclick="ToggleTable(this)">  
 <li class="list-group-item" style="color:black;background-color: antiquewhite" >
   <p>Danh sách ghim <i class="fa fa-arrow-down" aria-hidden="true"></i> </p>
 </li>   
</ul>
<ul  class="list-group" style="width:100%;z-index: 1000;height: 200px;overflow: auto;"> 
 @foreach($chat_pin as $mess)
 <li  onclick="jump({{$mess->id}})" style="color:black;width:100%!important;" class="list-group-item direct-chat-msg" > 

                    <div class="direct-chat-infos clearfix">
                   <span class="direct-chat-name float-left" style="color:black">{{$mess->name}}</span>
                      <span class="direct-chat-timestamp float-right">{{$mess->time}}</span>
                    </div>  
    <img class="direct-chat-img" src="{{$mess->avatar}}" alt="message user image">
                    <div class="direct-chat-text">
     <span>{{$mess->body}}</span>
   </div>
                     </li>

                    
    @endforeach
 </ul>

            </div>

            <hr>

            <ul class="list-group" onclick="ToggleDiv(this)">  
 <li class="list-group-item" style="color:black;background-color: antiquewhite" >
   <p>Danh sách tệp (tin nhắn) <i class="fa fa-arrow-down" aria-hidden="true"></i> </p>
 </li>   
</ul> 
<div class="filelist">
<h4 style="display: none;" id="messImgFile">Hình ảnh</h4>
<div class="MImgList">
   
    <?php
      $flag = 0;
    ?>
  @foreach($attachment as $atm)
               <?php
            if(strpos($atm->attachment,".png") > 0 
            || strpos( $atm->attachment,".jpg") > 0 
            || strpos($atm->attachment,".jpeg") > 0 
          ){
               if($flag == 0){
                $flag = 1;
                ?>

            <script>
              document.getElementById("messImgFile").style.display="block";
            </script>
                <?php
}
            ?> <a target="_blank" href="{{$atm->attachment}}">
<img style="width: auto;height: 200px" src="{{$atm->attachment}}" id="listimg" class="preview"></a> 

<?php
}
?>

                            @endforeach
                              @foreach($subattachment as $atm)
               <?php
            if(strpos($atm->attachment,".png") > 0 
            || strpos( $atm->attachment,".jpg") > 0 
            || strpos($atm->attachment,".jpeg") > 0 
          ){
               if($flag == 0){
                $flag = 1;
                ?>

            <script>
              document.getElementById("messImgFile2").style.display="block";
            </script>
                <?php
}
            ?> <a target="_blank" href="{{$atm->attachment}}">
<img style="width: auto;height: 200px" src="{{$atm->attachment}}" id="listimg" class="preview"></a> 

<?php
}
?>

                            @endforeach
</div>
    <h4 id="messOtherFile" style="display:none">Khác</h4>
<div class="MFileList">
    <ul  class="list-group">
    <?php
      $flag = 0;
    ?>
      @foreach($attachment as $attachment)
 <?php

            if(strpos($attachment->attachment,".png") > 0 
            || strpos( $attachment->attachment,".jpg") > 0 
            || strpos($attachment->attachment,".jpeg") > 0 
          ){
              continue;
          }elseif (strpos($attachment->attachment,".pdf")> 0) {
              $type = "pdf.png";
          }elseif (strpos($attachment->attachment,".doc")> 0) {
              $type = "word.png";
          }elseif (strpos($attachment->attachment,".ppt")> 0) {
              $type = "pp.png";
          }elseif (strpos($attachment->attachment,".xls")> 0
            || strpos( $attachment->attachment,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "photo.jpg";
          }

          if ($flag == 0){
            $flag =1;
            ?>
            <script>
              document.getElementById("messOtherFile").style.display="block";
            </script>
            <?php
          }
          ?>
        <li style="color:black;" class="list-group-item" >   <span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> <a style="color:black;" class="mylink" target="_blank" href="{{$attachment->attachment}}">

                    {{$attachment->body}}</a> </li>
      @endforeach
      @foreach($subattachment as $attachment)
 <?php

            if(strpos($attachment->attachment,".png") > 0 
            || strpos( $attachment->attachment,".jpg") > 0 
            || strpos($attachment->attachment,".jpeg") > 0 
          ){
              continue;
          }elseif (strpos($attachment->attachment,".pdf")> 0) {
              $type = "pdf.png";
          }elseif (strpos($attachment->attachment,".doc")> 0) {
              $type = "word.png";
          }elseif (strpos($attachment->attachment,".ppt")> 0) {
              $type = "pp.png";
          }elseif (strpos($attachment->attachment,".xls")> 0
            || strpos( $attachment->attachment,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "photo.jpg";
          }

          if ($flag == 0){
            $flag =1;
            ?>
            <script>
              document.getElementById("messOtherFile2").style.display="block";
            </script>
            <?php
          }
          ?>
        <li style="color:black;" class="list-group-item" >   <span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> <a style="color:black;" class="mylink" target="_blank" href="{{$attachment->attachment}}">

                    {{$attachment->body}}</a> </li>
      @endforeach
    </ul>
<hr>
  
          </div>
        </div>



                </div>
</div>

          
          <div id="contentl2" class="tab-pane  fade">
           
            <div id="job_detail2">
            <h4>Trao đổi công việc</h4>
                      
             
                    </div>



          </div>


   <div class="modal fade modol-text" id="edit-job-modal" role="dialog">

        <form id="edit-schedule" method="POST" action="edit-schedule" 
         enctype="multipart/form-data">

          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="id" id="edit_id" value="{{$schedule->id}}">
          <div  class="modal-dialog model-right"  style="min-width: 100%;height: auto">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label  style="font-size: 31px;"> Chỉnh sửa thông tin</label>
              </div>
              <div class="notification"></div>
              <div class="modal-body">
                <table class="table-edit table-model">
                    <tbody class="table-edit" style="font-size: 22px;">
                         <tr>
                            <td  style="width: 15%"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tên </td>
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
                            <td><textarea rows="100"  value="213123"  name="des" class="ckeditor form-control input-edit modol-text"  required="" id="EditDes"></textarea></td>
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
                <button   type="button" class="button-77" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
                
                <button   class="button-77"  type="submit"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Cập nhật </button>
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

    $('.mess-link').click(function(event){
        //remove all pre-existing active classes
        $('.mess-pane').removeClass('active');

        //add the active class to the link we clicked
        $("#"+this.href.split("#")[1]).addClass('active');

        // event.preventDefault();
    });

     $('.job-link').click(function(event){
        //remove all pre-existing active classes
        $('.job-content').removeClass('active');

        //add the active class to the link we clicked
        $("#"+this.href.split("#")[1]).addClass('active');

        // event.preventDefault();
    });

});

     function openfileupload(id){
      if (id == 11){

            document.getElementById("filename2").value = document.getElementById("mymess2").value 
      }else{

            document.getElementById("subfilename").value = document.getElementById("submess").value 
      }
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

      $("#mymessages2").animate({
                    scrollTop: $('#mymessages2').get(0).scrollHeight
                }, 2000);
       <?php 
  $content = (str_replace("\n","",$schedule->content));
            $content = (str_replace("\t","",$content));
            $content = (str_replace("\r","",$content));
 ?>

          CKEDITOR.instances.EditDes.setData('<?=$content?>', function()
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

  var guestNameList = []
  var guestIdList = []

  function LoadGuest(){
    console.log("qojwroqwr")
 $.ajax({
            url: 'schedule/load-guest/{{$schedule->id}}',
            type: 'GET',
            success: function (data) {
              console.log(data)
              for(var i = 0; i < data.length; i++){
guestNameList.push(data[i].name)
guestIdList.push(data[i].id)
              }
            }
  });
}
LoadGuest();
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
              document.getElementById("ShareLink").innerHTML = "<span style='width: 80%;' id='TokenText' >https://hoivan.lopital.vn/schedule/guest-detail/"+data +"</span><button onclick='CopyToken()'><span class='preview'><img src='/js-css/img/icon/copy.png'></span></button>";
              document.getElementById("ShareLink").style.display="block";
            }
        });
}

function CopyToken(){
  text = document.getElementById("TokenText").innerHTML;
  const elem = document.createElement('textarea');
   elem.value = text;
   document.body.appendChild(elem);
   elem.select();
   document.execCommand('copy');
   document.body.removeChild(elem);
        notifiSuccess("Đã copy thành công vào đường dẫn tạm thời");
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

  
        // $("#mymessages2").animate({
        //             scrollTop: $('#mymessages2').get(0).scrollHeight
        //         }, 2000);
         $.ajax({

      type: "POST",
      url: '/schedule/mess-save-db',
      data: {id: {{$schedule->id}},mess: mymess, _token: '{{csrf_token()}}'},
      success: function(data) {
        console.log(data)
      html = '  <div class="direct-chat-msg right"><div class="direct-chat-infos clearfix">  <span class="direct-chat-name float-left" style="color:black">{{Auth()->user()->name}} </span>  <span class="direct-chat-timestamp float-right">'+dateTime+'</span><a class="preview" href="/schedule/delete-mess/{'+data+'"><img src="js-css/img/icon/recycle_bin.png"></a><a class="preview" href="/schedule/pin-mess/'+data+'"><img src="js-css/img/icon/pin.png"></a></div><img class="direct-chat-img" src="{{Auth()->user()->avatar}}" alt="message user image"><div class="direct-chat-text"> '+mymess+'</div></div>'

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

document.querySelector("#submess").addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
        ConnectSubDB()
    }
});


var MTid = {{$chat_id}}

function newMess(){
  // console.log("chat iddd")
  console.log(MTid)
var html = ""
  var content = ""
     $.ajax({

      type: "get",
      url: '/schedule/get-mess/{{$schedule->id}}/'+MTid,
      success: function(data) {
        // console.log(data)
        data = JSON.parse(data);
        // console.log(data)
        MTid = data[1]
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
    var guest_name = guestNameList[guestIdList.indexOf(data[i].user_id*-1)]
        html = html + '<div class="direct-chat-msg"><div class="direct-chat-infos clearfix">  <span style="color:black" class="direct-chat-name float-left">'+guest_name+'</span>  <span class="direct-chat-timestamp float-right">'+data[i].time+'</span></div><img class="direct-chat-img" src="/js-css/img/icon/avatar.png" alt="message user image"><div class="direct-chat-text"> '+content+'</div></div>'
  }else{
        html = html + '<div class="direct-chat-msg"><div class="direct-chat-infos clearfix">  <span class="direct-chat-name float-left" style="color:black">'+data[i].name+'</span>  <span class="direct-chat-timestamp float-right">'+data[i].time+'</span></div><img class="direct-chat-img" src="'+data[i].avatar+'" alt="message user image"><div class="direct-chat-text"> '+content+'</div></div>'

  }

        html = html + addon
}
      document.getElementById("mymessages2").innerHTML = 
      document.getElementById("mymessages2").innerHTML + html
      //  $("#mymessages2").animate({
      //               scrollTop: $('#mymessages2').get(0).scrollHeight
      //           }, 2000);
      }
    });
}



var id = {{$sub_chat_id}}

function newSubMess(){
        var subID =  document.getElementById("MessID").value
        if (subID == 0){
          return 0;
        }
  console.log(id)
var html = ""
  var content = ""
     $.ajax({

      type: "get",
      url: '/schedule/get-sub-mess/'+subID+'/'+id,
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
    var guest_name = guestNameList[guestIdList.indexOf(data[i].user_id*-1)]
        html = html + '<div class="direct-chat-msg"><div class="direct-chat-infos clearfix">  <span style="color:black" class="direct-chat-name float-left">'+guest_name+'</span>  <span class="direct-chat-timestamp float-right">'+data[i].time+'</span></div><img class="direct-chat-img" src="/js-css/img/icon/avatar.png" alt="message user image"><div class="direct-chat-text"> '+content+'</div></div>'
  }else{
        html = html + '<div class="direct-chat-msg"><div class="direct-chat-infos clearfix">  <span class="direct-chat-name float-left" style="color:black">'+data[i].name+'</span>  <span class="direct-chat-timestamp float-right">'+data[i].time+'</span></div><img class="direct-chat-img" src="'+data[i].avatar+'" alt="message user image"><div class="direct-chat-text"> '+content+'</div></div>'

  }

        html = html + addon
}
      document.getElementById("submessages").innerHTML = 
      document.getElementById("submessages").innerHTML + html
      //  $("#mymessages2").animate({
      //               scrollTop: $('#mymessages2').get(0).scrollHeight
      //           }, 2000);
      }
    });
}


// $(function(){
// setInterval(newMess, 2000);
// setInterval(newSubMess, 5000);
// });


//  function openfileupload(id){
//         document.getElementById("inputfile"+id).click();
// }


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
      addon = '<a class="mylink" target="_blank" href="'+data[i].attachment+'"><img style="float:right" class="img-chat-view" src="'+data[i].attachment+'"></a>'
    }
  }else{
    content = data[i].body.replaceAll('\n', '<br>')
  }
        html = html + '<div class="direct-chat-msg right"><div class="direct-chat-infos clearfix">  <span class="direct-chat-name float-left">'+data[i].name+'</span>  <span class="direct-chat-timestamp float-right">'+data[i].time+'  <a class="preview" href="/schedule/delete-mess/'+data[i].id+'"><img src="js-css/img/icon/recycle_bin.png"></a><a class="preview" href="/schedule/pin-mess/'+data[i].id+'"><img src="js-css/img/icon/pin.png"></a></span></div><img class="direct-chat-img" src="'+data[i].avatar+'" alt="message user image"><div class="direct-chat-text"> '+content+'</div></div>'


          html = html + addon


}
      console.log(html)
      document.getElementById("mymessages2").innerHTML = 
      document.getElementById("mymessages2").innerHTML + html
            // $("#mymessages2").animate({
            //         scrollTop: $('#mymessages2').get(0).scrollHeight
            //     }, 2000);


            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;

      // document.getElementById("uploadfile"+id).submit();
    }
function LoadSubMess(id){
 $.ajax({
            url: 'schedule/load-sub-mess/'+id,
            type: 'GET',
            success: function (data) {
                    data = JSON.parse(data);
                    html = ""
                    document.getElementById("SubMessDate").innerHTML = document.getElementById("smDate"+id).innerHTML;
                    document.getElementById("SubMessFile").innerHTML = document.getElementById("smFile"+id).innerHTML;
                    document.getElementById("MessID").value = id;


for(i = 0; i < data.length;i++){
addon =""
  if(data[i].attachment !== null){
    content ='<a class="mylink" target="_blank" href="'+data[i].attachment+'">'+ data[i].body.replaceAll('\n', '<br>')+'</a>'

    if  (data[i].attachment.includes(".png")
      || data[i].attachment.includes(".jpg")
      || data[i].attachment.includes(".jpeg")){

  if(data[i].user_id == {{Auth()->user()->id}}){
      addon = '<a class="mylink" target="_blank" href="'+data[i].attachment+'"><img style="float:right" class="img-chat-view" src="'+data[i].attachment+'"></a>'
    }else{
      addon = '<a class="mylink" target="_blank" href="'+data[i].attachment+'"><img class="img-chat-view" src="'+data[i].attachment+'"></a>'

    }
    }

  }else{
    content = data[i].body.replaceAll('\n', '<br>')
  }
  if(data[i].user_id < 0){
    console.log(data[i].user_id)
    var guest_name = guestNameList[guestIdList.indexOf(data[i].user_id*-1)]
        html = html + '<div class="direct-chat-msg"><div class="direct-chat-infos clearfix">  <span style="color:black" class="direct-chat-name float-left">'+guest_name+'</span>  <span class="direct-chat-timestamp float-right">'+data[i].time+'</span></div><img class="direct-chat-img" src="/js-css/img/icon/avatar.png" alt="message user image"><div class="direct-chat-text"> '+content+'</div></div>'
  }else{
  if(data[i].user_id == {{Auth()->user()->id}}){

    html = html + '<div class="direct-chat-msg right"><div class="direct-chat-infos clearfix">  <span class="direct-chat-name float-left" style="color:black">'+data[i].name+'</span>  <span class="direct-chat-timestamp float-right">'+data[i].time+'<a class="preview" href="/schedule/delete-sub-mess/'+data[i].id+'"><img src="js-css/img/icon/recycle_bin.png"></a><a class="preview" href="/schedule/pin-sub-mess/'+data[i].id+'"><img src="js-css/img/icon/pin.png"></a></span></div><img class="direct-chat-img" src="'+data[i].avatar+'" alt="message user image"><div class="direct-chat-text"> '+content+'</div></div>'
    }else{
      html = html + '<div class="direct-chat-msg"><div class="direct-chat-infos clearfix">  <span class="direct-chat-name float-left" style="color:black">'+data[i].name+'</span>  <span class="direct-chat-timestamp float-right">'+data[i].time+'</span></div><img class="direct-chat-img" src="'+data[i].avatar+'" alt="message user image"><div class="direct-chat-text"> '+content+'</div></div>'
    }
    }     

  

        html = html + addon
}
      document.getElementById("submessages").innerHTML =  html


                  }
        });
}


function uploadsubsubmit(){
  console.log("function in")
        var formData = new FormData($("#UploadSubForm")[0]);
  console.log("ajax in")

        $.ajax({
            url: 'schedule/sub-upload',
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
      addon = '<a class="mylink" target="_blank" href="'+data[i].attachment+'"><img style="float:right" class="img-chat-view" src="'+data[i].attachment+'"></a>'
    }
  }else{
    content = data[i].body.replaceAll('\n', '<br>')
  }
        html = html + '<div class="direct-chat-msg right"><div class="direct-chat-infos clearfix">  <span class="direct-chat-name float-left">'+data[i].name+'</span>  <span class="direct-chat-timestamp float-right">'+data[i].time+' </span> <a class="preview" href="/schedule/delete-mess/'+data[i].id+'"><img src="js-css/img/icon/recycle_bin.png"></a><a class="preview" href="/schedule/sub-pin-mess/'+data[i].id+'"><img src="js-css/img/icon/pin.png"></a></div><img class="direct-chat-img" src="'+data[i].avatar+'" alt="message user image"><div class="direct-chat-text"> '+content+'</div></div>'


          html = html + addon


}
      console.log(html)
      document.getElementById("submessages").innerHTML = 
      document.getElementById("submessages").innerHTML + html
            // $("#mymessages2").animate({
            //         scrollTop: $('#mymessages2').get(0).scrollHeight
            //     }, 2000);


            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;

      // document.getElementById("uploadfile"+id).submit();
    }
   function ConnectSubDB(){
        // console.log("was it here???")
        var subID =  document.getElementById("MessID").value
        console.log(subID)
        var mymess =  document.getElementById("submess").value
        document.getElementById("submess").value = ""

var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = date+' '+time;

  
        // $("#mymessages2").animate({
        //             scrollTop: $('#mymessages2').get(0).scrollHeight
        //         }, 2000);
         $.ajax({

      type: "POST",
      url: '/schedule/mess-save-sub-db',
      data: {id: subID,mess: mymess, _token: '{{csrf_token()}}'},
      success: function(data) {
        console.log(data)
      html = '  <div class="direct-chat-msg right"><div class="direct-chat-infos clearfix">  <span class="direct-chat-name float-left" style="color:black">{{Auth()->user()->name}} </span>  <span class="direct-chat-timestamp float-right">'+dateTime+'</span><a class="preview" href="/schedule/delete-mess/{'+data+'"><img src="js-css/img/icon/recycle_bin.png"></a><a class="preview" href="/schedule/sub-pin-mess/'+data+'"><img src="js-css/img/icon/pin.png"></a></div><img class="direct-chat-img" src="{{Auth()->user()->avatar}}" alt="message user image"><div class="direct-chat-text"> '+mymess+'</div></div>'

         document.getElementById("submessages").innerHTML = 
      document.getElementById("submessages").innerHTML + html

     }
    });




      }

 LoadSubMess({{$fid}})


function ToggleTable(elmt){
      $(elmt).next("ul").slideToggle();
}
function ToggleDiv(elmt){
      $(elmt).next("div").slideToggle();
}
  
function jump(id){
  console.log("JUMP!!!!")
  var top = document.getElementById("mess"+id).offsetTop;
          $("#mymessages2").animate({
                    scrollTop: top
                }, 2000);

}
  </script>

@endsection
