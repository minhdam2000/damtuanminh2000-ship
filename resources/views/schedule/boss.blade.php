@extends('../layouts/index')
@section('content')


<link rel="stylesheet" href="js-css/css/stepprogressbar.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<style type="text/css">

  input[type=checkbox], input[type=radio] {


    position: inherit;
}


.fc-row .fc-content-skeleton td, .fc-row .fc-helper-skeleton td {
    border-bottom: inherit;
}

.fc-row .fc-week .fc-widget-content{
  border: 1px solid;
}
  .preview{
  margin-right: 5%;
}

.form-check-input {
    position: inherit;
}
#calendar{
  overflow: auto;
}
  .progress{
    min-height: 30px;
    background-color: transparent;
}
}
.progress-bar{
    font-size: 15px;
  }

  .sicon{    
    margin-left: 5%;
  }

  
  .select-profile {
    /* font-size: 0.85em; */
    z-index: unset!important;
  }
  .cke_dialog_ui_vbox_child {
    background-color: white;
}

.cke_centered {
    background-color: white;
}

.link-detail{
  color: red!important;
}

.myspace{
  min-height: 300px;
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

              <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> notifition</h6>
      </div>
      <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning</h6>
      </div>
      
        </div>
                      </div>
              </div>
 <ul class="nav nav-tabs" id="tabs" role="tablist">

      <li class="nav-item margin_center">
          <a id="tabS" class="nav-link color-a"  data-toggle="tab" role="tab" href="#contentS">Tổng quan</a>
      </li>

      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content1">Chi tiết công việc</a>
      </li> 
      <li class="nav-item margin_center">
          <a id="tab" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content0">Lịch</a>
      </li> 
  <!--    <li class="nav-item margin_center">
          <a id="tab4" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content3">Công việc đã hủy</a>
      </li> -->
    </ul> 
  <hr>

<?php
// $colors = ["#FFC0CB", "#E6E6FA", "#DDA0DD", "#FFA07A", "#FFA500", " #FFFACD", "#ADFF2F", "#98FB98", "#8FBC8F", "#AFEEEE", "#B0C4DE", "#F5DEB3", "#A9A9A9", "#FFE4E1", "#F4A460"];


$colors = ["#FF1493", "#9932CC",  "#00FF00", "#FFA500", "#008B8B", "#4682B4", "#ccccf0", "#778899", "rgb(137,207,240)", "pink", "#DA70D6", "#FF8C00", "#CD5C5C", "#DDA0DD"];

$colorsSel = [0,0,0,0,0,0,0,0,0,0,0,0,0,0];


?>

<div class="tab-content">
  <div id="content0" class="tab-pane  in">
<br><hr><br>
<div class="row" style="margin-left: 2%;">
      <div class="col-md-2 col-12" id="PcSel">
        <br>
        <hr>
        <h4 id="JobList" onclick="DisplayJob()">Danh sách công việc</h4>
        <br>
        <ul id="jobSelect" style="max-height:300px;overflow: auto;">
  @foreach($curent_schedule as $schedule)

  <?php
$count = $schedule->id % count($colors);
while($colorsSel[$count] == 1){
  $count = $count + 1;
  if($count == count($colors) ){
    $count = 0;
  }
}
$colorsSel[$count] =1;



?>


       <li title="{{$schedule->title}}" data-placement="top" data-trigger="hover" data-toggle="popover" data-html="true"  style="color:<?=$colors[$count]?>"><input id="Sel{{$schedule->id}}" name="selector[]" class="form-check-input" onclick="CbChange({{$schedule->id}})" type="checkbox" value="{{$schedule->id}}" />  

        @if(strlen($schedule->title) > 15)

        <span onmouseenter="fulltext({{$schedule->id}})" onmouseleave="shorttext({{$schedule->id}})" id="text{{$schedule->id}}"> 
        {{substr($schedule->title,0,15)}}..
        @else

        <span id="text{{$schedule->id}}"> 
        {{$schedule->title}}
        @endif
      </span>


        <span style="display: none" id="color{{$schedule->id}}"><?=$colors[$count]?></span>

        <span style="display: none" id="longtext{{$schedule->id}}"> 
        {{$schedule->title}}
        </span>

        @if(strlen($schedule->title) > 15)

   <span style="display: none" id="shorttext{{$schedule->id}}"> 
         {{substr($schedule->title,0,15)}}..
        </span>
         @else
<span style="display: none" id="shorttext{{$schedule->id}}"> 
        {{$schedule->title}}
        </span>

        @endif



        </li>
       @endforeach



</ul>
<li style="color:red;">
  <input  id="SelVN" name="selector[]" class="form-check-input" onclick="CbChange('-99')" type="checkbox" value="-99"/> Lịch Việt Nam
</li>
<!-- <input type="button" id="save_value" name="save_value" value="Lọc" class="camera-button" /> -->
</div>
      <div class="col-md-10 col-12">
      <div id='calendar'></div>
</div>

      <div class="col-md-1 col-12" id="mobileSel" style="display:none">
        </div>
     </div>
<!-- <input name="selector[]" id="ad_Checkbox2" class="ads_Checkbox" type="checkbox" value="98" />92<br>
<input name="selector[]" id="ad_Checkbox3" class="ads_Checkbox" type="checkbox" value="1" />1<br>
<input name="selector[]" id="ad_Checkbox4" class="ads_Checkbox" type="checkbox" value="2" />2<br>
 -->

    </div>
  <div id="contentS" class="tab-pane active  in">



<br><hr><br>
              <div class="row">

                <div   id="barCon"  class="col-md-6 col-sm-12 col-12">

    <canvas   id="barChart"></canvas>
 </div>
<div class="col-md-6 col-sm-12 col-12">
               <table id="input-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                         
                            <th> Đơn vị</th>
                            <th> Số việc đang làm</th>
                            <th> Số lượng hoàn thành  </th>
                            <th> Số lượng không hoàn thành </th>
                            <th> Tổng số lượng</th>
                            <th> Tỷ lệ hoàn thành</th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($job_users as $job)
                             <tr>
                               <td>
                              
                              <a href="dept-job-list/{{$job->id}}">   {{$job->name}}</a>

                               </td>
                               <td>
                                 {{$job->s0}}
                               </td>
                               <td>
                                 {{$job->s1}}
                               </td>

                            
                               <td>
                                 {{$job->s2}}
                               </td>

                               <td>
                                 {{$job->s0 + $job->s1 +$job->s2}}
                               </td>
                               <td>
                                @if($job->s0 +$job->s0 + $job->s1 > 0)
                                {{round(floatval($job->s0)/($job->s0 +$job->s1)*100,2) }}
                                @else
                                0
                                @endif
                                 %
                                </td>
                             </tr>
                             @endforeach
                          
                        </tbody>
                      </table>


</div>
       

<br><br>
        
     

    </div>
  </div>
  <div id="content1" class="tab-pane  fade">
          <div>
            <div class="row-title-proxy">
                      <div class="proxy-add" title="New Edge"><button onclick="zoomOutMobile(1)" type="button" class=" job-create camera-button" data-toggle="modal" data-target="#create-job" id="{{$id}}"><i class="fa fa-plus" aria-hidden="true"></i>công việc mới </button></div>
                      <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>
                     

                    
              </div>

              </div>
              <?php 
$i = 1;
              ?>
                <table id="bigtable"  class="root_table" onclick="ToggleTable(this)">
                        <thead>
                        <tr class="thead">
                          <th style="width:5%"></th>
                            <th style="width:50%">Tên công việc</th>
                            <th style="width:30%">Người giao</th>
                            <!-- <th style="width:30%">Tiến độ</th> -->
                            <th ></th>
                          </tr>
                        </thead>
                      </table>
                          @foreach($curent_schedule as $schedule)

           <div  id="root{{$schedule->id}}">
                          <table id="bigtable{{$schedule->id}}"  class="root_table" onclick="ToggleTable(this)">
                        
                        <tbody class="tbody">
                          <?php 
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
                            <td style="width:5%" ><h4 id="index{{$schedule->id}}">{{$i}}</h4></td>

                            <?php 
                                $i = $i + 1;
                             ?>
                              <td style="width:50%"><div><h4><a ondblclick="BigLinkFun({{$schedule->id}})" target="_blank"  id="BigLink{{$schedule->id}}" ><i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;">  </i> <span id="title{{$schedule->id}}">{{$schedule->title}}</span></a></h4><br>
                               <!--  Ngày bắt đầu: 
                                <span id="sdate{{$schedule->id}}">{{$schedule->start_date}}</span><br>
                                Ngày kết thúc: 
                                <span id="edate{{$schedule->id}}">{{$schedule->end_date}}</span>
                                <span id="lastId{{$schedule->id}}" style="display: none">{{$schedule->last_id}}</span><a  target="_blank" href="/chatify/schedule/{{$schedule->id}}" class="link-detail">  <br>(Ấn để xem chi tiết) -->
</a>
                                </td>
<td style="width:30%">
                                <span id="user1{{$schedule->id}}">



<?php
if(DB::table("users")->where("id",$schedule->user_id)->first()){
  echo DB::table("users")->where("id",$schedule->user_id)->first()->name;
}else{
  echo "Không";
}

?>
                                </span><br>
                           <!--      Phòng thực hiện: 
                                <span id="dept{{$schedule->id}}"> -->
<?php
$did = DB::table("schedule_department")->where("schedule_id",$schedule->id)->pluck('department_id')->toArray();
$dname = DB::table("department")->whereIn("id",$did)->pluck('name')->toArray();

$html = "";
foreach($dname as $dname){
  $html = $html . $dname . ",";
}

$html = substr($html, 0, -1); 

?>
                               <!--  </span><br>
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
                                </span>
                              </td>
<!-- <td> -->
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
<!--   <span class="progress">
  <span class="progress-bar bg-success" style="width:{{$percent}}%";>
    Hoàn thành: {{$percent}}%
  </span>
  <span class="progress-bar bg-danger" style="width:{{100 - $percent}}%">   
  </span>
</span>

</td> -->
                             <td>
                           
    
                           <span class="job-create preview sicon" data-toggle="modal" data-target="#create-job" id="{{$schedule->id}}"><img src="/js-css/img/icon/plus.png"></span> 

                        <!--    <a class="sicon" href="/schedule/done/{{$schedule->id}}">
                             <span class="preview"><img src="/js-css/img/icon/success.png"></span>
                           </a>
 -->
                           <!-- <a class="sicon" onclick="confirm_remove(this)" href="/schedule/drop/{{$schedule->id}}"> -->
                             <a class="sicon" onclick="confirm_remove(this,{{$schedule->id}})">
                             <span class="preview"><img src="/js-css/img/icon/stop.png"></span>
                           </a>
                  <!--     <a href="/schedule/detail/{{$schedule->id}}" class="link-detail">
                             <span class="preview"><img src="/js-css/img/icon/eye.png"></span>
                           </a> -->
                          <!--  <span style="margin-left: 2%" class="job-update preview" data-toggle="modal" data-target="#edit-job-modal" id="{{$schedule->id}}"><img src="/js-css/img/icon/write.png"></span> -->

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
                            <td><input type="" value="" name="name" class="input-edit create-user modol-text" id="name" required="" autocomplete="off"></td>
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

<h3>Phòng thực hiện</h3>
<select name="did[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="departselect" multiple>

@foreach($dept as $dept)
<option value="{{$dept->id}}">{{$dept->name}}</option>
@endforeach  

</select>
<h3>Nhân viên thực hiện</h3>
                <select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffselect" multiple>
</select>


              <div  style="margin-top: 3%;">


                        <div class="form-group">
                    <input style="display: none" type="file" name="file[]" class="file"
                    multiple>

                    <div >
                        
                        <div>
                            <button   type="button" class="browse button-43">Tải tệp lên</button>
                        </div>
                    </div>
                <div class="form-group" id="preview">
                </div>
                <div class="form-group" id="preview-file"></div>
                </div>
                

                <button   class="button-77" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Tạo</button>
                <button   type="button" class="button-77" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>
        </form>
        <div class="myspace"></div>
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
                            <td><input type="" value="" name="name" class="input-edit create-user modol-text" id="edit_name" required="" autocomplete="off"></td>
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
  

        function Bars(type,id){

            if (window.innerWidth <800 ){
            var size = 15;

          }else{

            var size = 20;
          }
        $('#barChart').remove();
        $('#barCon').append('<canvas  height="500" + id="barChart"><canvas>');
       
             $.ajax({
            type: "GET",
            url: "/job-bar-admin",
            success: function (response) {
              //console.log(response)
  listID = []
  methods = []
  methods2 = []
            labels = []
           for(const [method, value] of Object.entries(response)){
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                labels.push(value.name + "("+value.s0 + " việc )");
                methods2.push(value.d1*24);
                methods.push(value.d0*24)
                listID.push(value.id)
            }

            var ctx = document.getElementById("barChart");
            var myChart = new Chart(ctx, {
              type: 'horizontalBar',
              data: {
                labels: labels,
                datasets: [{
                  label: 'Tổng thời gian thực hiện',
                  data: methods,
                backgroundColor: '#28a745',
                  borderWidth: 1
                },
                {
                  label: 'Thời gian còn lại',
                  data: methods2,
                backgroundColor: '#dc3545',
                  borderWidth: 1
                }
                ]
              },
              options: {
    maintainAspectRatio: false,
                responsive: true,
                onClick: function(e) {
                  //console.log(this.scales['y-axis-0'])
  var xLabel = this.scales['y-axis-0'].getValueForPixel(e.offsetY);
  //console.log(xLabel)
  //console.log(listID[xLabel])
  if(Number.isInteger(listID[xLabel])){
    let a= document.createElement('a');
a.target= '_blank';
a.href= "/schedule/dept/" + listID[xLabel];
a.click();
  }
},
                scales: {
                  xAxes: [{
            stacked: true,
                     scaleLabel: {
                        display: true,
                        labelString: 'Thời gian (giờ)'
                      },
                    ticks: {
                      maxRotation: 90,
                      minRotation: 0,
                fontSize: size
                    }
                  }],
                  yAxes: [{
            stacked: true,
                    ticks: {
                      beginAtZero: false,
                fontSize: size
                    }
                  }]
                }
              }
            });
            Chart.defaults.global.defaultFontColor = 'black';

             $("#barChart").click( 
          function(evt){
              var activePoints = myChart.getElementsAtEvent(evt);
              //console.log(activePoints);
              var input_ip = activePoints[0]._view.label
              //console.log(input_ip);
          }
      );    



        }

          });
     }
        Bars(0,0);
</script>
<script type="text/javascript">

    var colors =  ["#FF1493", "#9932CC",  "#00FF00", "#FFA500", "#008B8B", "#4682B4", "#ccccf0", "#778899", "rgb(137,207,240)", "pink", "#DA70D6", "#FF8C00", "#CD5C5C", "#DDA0DD"];

    var colorsSel = [0,0,0,0,0,0,0,0,0,0,0,0,0,0];

<?php
    $js = "[";
    foreach($colorsSel as $sel){
      $js = $js.$sel.",";
    }

    $js = substr($js, 0, -1);

    $js  = $js ."]";


?>
    var colorsSubSel = <?=$js?>;

    // alert(colorsSubSel)


    $(document).ready(function() {


      if (window.innerWidth <  700){
        document.getElementById("mobileSel").innerHTML = 
        document.getElementById("PcSel").innerHTML
        document.getElementById("PcSel").innerHTML=""

         document.getElementById("mobileSel").style.display = "block";
          document.getElementById("PcSel").style.display = "none";

      }
        var SITEURL = "{{url('/')}}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
   // var colors = ["#FFC0CB", "#E6E6FA", "#DDA0DD", "#FFA07A", "#FFA500", " #FFFACD", "#ADFF2F", "#98FB98", "#8FBC8F", "#AFEEEE", "#B0C4DE", "#F5DEB3", "#A9A9A9", "#FFE4E1", "#F4A460"]

   
// alert('???')
//console.log('???')
        var calendar = $('#calendar').fullCalendar({
          firstDay:1,
          header: {
    left:   'title',
    center: '',
    right:  'prev,next '
},
eventDisplay:"block",
monthNames: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9',
'Tháng 10','Tháng 11','Tháng 12'],
monthNamesShort: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9',
'Tháng 10','Tháng 11','Tháng 12'],
dayNames: ['Chủ nhật','Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy'],
dayNamesShort:  ['Chủ nhật','Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy'],
  buttonText: {
    today: "Hôm nay"
  },

            editable: true,
            events: SITEURL + "/schedule/calendar",
            displayEventTime: true,
            editable: true,
            eventRender: function (event, element, view) {

              // console.log(event)
              // alert(event.status)
             // console.log((element.parentElement()).html())
              html = $(element).closest('.fc-event-container');
              console.log(colors.length)
              // alert(event.id)
              var count = event.id % colors.length
              // alert(count)
             
              // if(event.status != 3){
              // if(colorsSel[count] > 0){
              //   while(colorsSel[count] !== event.id && colorsSel[count] > 0){
              //     count = count + 1;
              //     if(count > colors.length){
              //       count =0;
              //     }
              //   }
              // }
              // // alert(colors[count])
              // colorsSel[count] = event.id;
              // }


              if(event.status == 3){
              element.find('.fc-content').css('background-color', 'red');
              }else{
                var mycolor = document.getElementById("color"+event.id).innerHTML;
                element.find('.fc-content').css('background-color', mycolor);
             
              }
              html = event.title
             // element.style.backgroundColor = "red"
                element.find('.fc-title').html(html)
         
            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                calendar.fullCalendar('unselect');

                var date = $.fullCalendar.formatDate(start, "Y-MM-DD");
                //console.log(date)
                document.getElementById("edit_date").value = date


                var dateHTML = $.fullCalendar.formatDate(start, "DD-MM-Y");
                document.getElementById("dateAdd").innerHTML = dateHTML;

            // if (!IsDateHasEvent(start)) {
            //    $('#historyModal').modal();
            //  }
            }, 
            dayClick: function (start, end, allDay) {
              // alert("??11??")

                calendar.fullCalendar('unselect');

                var date = $.fullCalendar.formatDate(start, "Y-MM-DD");
                //console.log(date)
                document.getElementById("new_start_date").value = date
                // $("#create-job").modal();
                $("#0").click()

                // var dateHTML = $.fullCalendar.formatDate(start, "DD-MM-Y");
                // document.getElementById("dateAdd").innerHTML = dateHTML;

            // if (!IsDateHasEvent(start)) {
            //    $('#historyModal').modal();
            //  }
            },

            eventDrop: function (event, delta) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                $.ajax({
                    url: SITEURL + '/fullcalendar/update',
                    data: {'title': event.title, 'start': start, 'end': end, 'id': event.id},
                    type: "POST",
                    success: function (response) {
                        displayMessage("Updated Successfully");
                    }
                });
            },
            eventClick: function (event) {
              // alert("cleci")
              console.log(event.id)
              // window.location.href="/chatify/schedule/" + event.id
             
            let a= document.createElement('a');
            a.target= '_blank';
            a.href= "/chatify/schedule/" + event.id
            a.click();
                  
                }

              
                });


      var job_flag = getCookie("job_flag2")
      // alert(job_flag)
      if(job_flag  != ""){
          $("#"+job_flag).click()
          // alert("click!!")
      }
      
      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }

     
      
  });
       $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');
        // alert(this.id)
          setCookie("job_flag2",this.id,3600*60)
        $("#"+this.href.split("#")[1]).addClass('active');
        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });


    //   $(".form-check-input").change(function() {
    //     var val = [];
    //     $(':checkbox:checked').each(function(i){
    //       val[i] = $(this).val();
    //     });
    //       // alert(val)
    //       setCookie("sid",val,3600*60)
    // $('#calendar').fullCalendar('refetchEvents');
    //   });



      function CbChange(id){
        shortftext(id)
          var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
          // alert(val[i])
          fulltext(val[i])
        });
      $(":checkbox:not(:checked)").each(function(i){
          // alert($(this).val())
          shorttext($(this).val())
        });
          // alert(val)
          setCookie("sid",val,3600*60)
    $('#calendar').fullCalendar('refetchEvents');
    // CbChange()
      }

  function myTest(id){
        setCookie("sid","98,2,3",3600*60)
    $('#calendar').fullCalendar('refetchEvents');
  }

  CbChange("-99")
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
        //console.log("process list")
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

  //console.log('/system/shedule-staff/'+id)
  $.ajax({
    type: "GET",
    url: '/system/shedule-staff/0',
    // url: '/system/shedule-staff/'+id,
    success: function (response) {
      res = (JSON.parse(response))
      response = res[0]
      
      dept = res[1]
      // //console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


      html = ''
      for(var i =0; i < response.length; i++){
          html = html +'<option  value="'+response[i].id+'">'+response[i].name+  "(" +  response[i].dname + ")" +'</option>'
      }
      document.getElementById("staffselect").innerHTML=html;

      //console.log(document.getElementById("staffselect").innerHTML)
      $("#staffselect").selectpicker("refresh");
$('#staffselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});

html = ''

//console.log(dept)
      for(var i =0; i < dept.length; i++){
        //console.log("why not here")
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
    // url: '/schedule/staff-select/'+id+"/"+sid,

    url: '/schedule/staff-select/'+id,
    success: function (response) {
      response = (JSON.parse(response))
      //console.log(response)
      var data = response[0]
      var sel = response[1]
      // //console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


     var  html = '<select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffEditSelected" multiple>'
      for(var i =0; i < data.length; i++){
          if (sel.includes(data[i].id)){
          html = html +'<option  value="'+data[i].id+'" selected>'+data[i].name+ "-"+data[i].rname + "(" +  data[i].dname + ")" +'</option>'
          }else{
          html = html +'<option  value="'+data[i].id+'">'+data[i].name+ "-"+data[i].rname + "(" +  data[i].dname + ")" +'</option>'

          }
      }
     hhtml = html + '</select>'
      // //console.log(html)
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
      //console.log(response)
      var data = response[0]
      var sel = response[1]
      // //console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


     var  html = '<select name="did[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="deptEditSelected" multiple>'
      for(var i =0; i < data.length; i++){
          if (sel.includes(data[i].id)){
          html = html +'<option  value="'+data[i].id+'" selected>'+data[i].name+'</option>'
          }else{
          html = html +'<option  value="'+data[i].id+'">'+data[i].name+'</option>'

          }
      }
     hhtml = html + '</select>'
      // //console.log(html)
      // document.getElementsByClassName("filter-option-inner-inner")[1].innerHTML = ""
      document.getElementById("deptEditDiv").innerHTML=html;
$('#deptEditSelected').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
    }
  });
}
 $(".job-create").click(function(){
    //console.log("okoe123123")
    //console.log("?????")
    var jobid = this.id; 
    $("#create_id").val(jobid);
    // var lastID = document.getElementById("lastId"+jobid).innerHTML;
    getStaffList(jobid)
    // getDeptSelectedList(lastID,jobid)

  });

 function BtnJobClick(element){
//console.log("okoe123123")
    //console.log("?????")
    var jobid = element.id; 
    $("#create_id").val(jobid);
    // var lastID = document.getElementById("lastId"+jobid).innerHTML;
    getStaffList(jobid)
 }


   $(".job-update").click(function(){
    //console.log("okoe")
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
    //console.log(jstartdate)
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
      //console.log("______________________?????_")
      //console.log(index)
      //console.log(id)
  $.ajax({
    type: "GET",
    url: 'schedule/get-subshedule-as-json/'+id,
    success: function (response) {
      res = (JSON.parse(response))
      response = res[0]
      dept_list = res[1]
      name_list = res[2]
      fix_list = res[3]
      percent_list = res[4]
      seen = res[5]
      //console.log(response);
      for(i=0;i<response.length;i++) { 
        myid = i + 1
        var html = ' <div style="margin-left:3%"  id="root'+response[i].id+'"> <table class="big_table" onclick="ToggleTable(this)"><tbody class="tbody">'

        // html = html + '<tr class="color-add"><td>  <input type="checkbox" id="'+response[i].id+'" value="'+response[i].id+'" name="'+response[i].id+'" class="check-box" />  <label for="'+response[i].id+'" class="add-cam"></label></td>'
        if(seen[i] <1){
            html = html + ' <tr class="color-add" style="background-color:cadetblue">'
        }else{
          html = html + '<tr class="color-add">'
        }
        if (index.toString().includes(".") == false){
          // console.log(index)
          index = document.getElementById("index"+index).innerHTML;
        }
        html = html + '<td style="width:5%"><h4 id="index">'+index+"."+myid+'<h4><div>'
        html = html + '<td style="width:50%"><div> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;">  </i>'
        if(percent_list[i] == 100){
        html =html + '<h4><a style="color:green" target="_blank" href="/chatify/schedule/'+response[i].id+'"><span style="color:green"  id="title'+response[i].id+'+"> '+response[i].title+'</span></a></h4></td>'
      }else{
        html =html + '<h4><a style="color:red" target="_blank" href="/chatify/schedule/'+response[i].id+'"><span style="color:red" id="title'+response[i].id+'+"> '+response[i].title+'</span></a></h4></td>'

      }


   
      
              // html =html +' Ngày bắt đầu:   <span id="sdate'+response[i].id+'">'+response[i].start_date+'</span><br>  Ngày kết thúc:   <span id="edate'+response[i].id+'">'+response[i].end_date+'</span><span id="lastId'+response[i].id+'" style="display: none">'+response[i].last_id+'</span><br> <a  class="link-detail"  target="_blank" href="/chatify/schedule/'+response[i].id+'"> (Ấn để xem chi tiết)</a></td>'
      

        // html = html +'<td id="content'+response[i].id+'">'+response[i].content+'</td>'

if (dept_list[i] == false){
  var dept = "Không"
}else{
  var dept = dept_list[i] 

}
   if (name_list[i] == false){
  var myname = "Không" 
}else{

  var myname = name_list[i]
}
   // myname = name_list[i] 
         // html = html +'<td style="width:25%">Phòng thực hiện: '+dept
         html = html +'<td style="width:30%">Người phụ trách: '+myname+'</td>'

        remain = 100 - percent_list[i]
        // html = html +'<td style="width:30%"><span class="progress"><span class="progress-bar bg-success" style="width:'+percent_list[i]+'%";>  Hoàn thành: '+percent_list[i]+'%</span><span class="progress-bar bg-danger" style="width:'+remain+'%"></span></span></td>'

        html = html + "<td>"

        html = html + fix_list[i]

        // html = html + '<a style="color: white"  type="button" href="schedule-list/'+response[i].id+'" class="btn btn-del Disable"><i class="fa fa-list" aria-hidden="true" style="font-size: 1.2rem;"></i></a><a style="color: white"  type="button" href="schedule/file/'+response[i].id+'" class="btn btn-del Disable"><i class="fa fa-folder-open-o" aria-hidden="true" style="font-size: 1.2rem;"></i></a>'
        html = html + "<td>"


        html = html + "</td>"
        html = html +'</tr></tbody></table><div style="display:none" id="subScheduleContent'+response[i].id+'" class="subScheduleContent">'
        // //console.log(html)
        document.getElementById("subScheduleContent"+id).innerHTML = 

document.getElementById("subScheduleContent"+id).innerHTML + html

let today = new Date().toISOString().slice(0, 10)
if(response[i].end_date > today){


   // var colors = ["#FFC0CB", "#E6E6FA", "#DDA0DD", "#FFA07A", "#FFA500", " #FFFACD", "#ADFF2F", "#98FB98", "#8FBC8F", "#AFEEEE", "#B0C4DE", "#F5DEB3", "#A9A9A9", "#FFE4E1", "#F4A460"]


  
   var count = response[i].id % colors.length

   if(colorsSubSel[count] > 0){
                while(colorsSubSel[count] >0){
                  count = count + 1;
                  if(count > colors.length){
                    count =0;
                  }
                }
              }
              // alert(count)
              colorsSubSel[count] = event.id;

   document.getElementById("jobSelect").innerHTML = document.getElementById("jobSelect").innerHTML + '<li title="'+response[i].title+'" data-placement="top" data-trigger="hover" data-toggle="popover" data-html="true" style="color:'+colors[count]+'"><input  id="Sel'+response[i].id+'"  name="selector[]" class="form-check-input" onclick="CbChange('+response[i].id+')" type="checkbox" value="'+response[i].id+'" /><span id="text'+response[i].id+'">'+response[i].title.substring(0,15)+'</span><span style="display: none" id="longtext'+response[i].id+'">'+response[i].title+'</span> <span style="display: none" id="shorttext'+response[i].id+'">'+response[i].title.substring(0,15)+'</span><span style="display: none" id="color'+response[i].id+'">'+colors[count]+'</span></li>'
}


        



        getSubScheduleList(response[i].id,index+"."+myid)

      }

    }
  });
}
  // $(".root_table").on("click", function(e) {
  //     e.preventDefault();
  //     //console.log("okoek")
  //     $(this).next("div").slideToggle();
  //   });


function ToggleTable(elmt){

      // alert("it in")

      if(elmt.id != ""){
        setCookie("elmt",elmt.id,3600*60)
      }

      $(elmt).next("div").slideToggle();
      var nextEle =  $(elmt).next("div").children();
      // alert()
        //console.log(nextEle.length);
      for (var i = 0; i < nextEle.length; i++) {
        // //console.log(nextEle[i].children()[0]);
          $(nextEle[i]).children()[0].click();
      }
}


function setCookie(cname, cvalue, mytime) {
  const d = new Date();
  d.setTime(d.getTime() + (mytime));
  let expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}


<?php 
$i = 1;
 ?>
@foreach($schedule_list as $sid)

getSubScheduleList({{$sid}},{{$sid}})


<?php 
$i = $i + 1;
 ?>
@endforeach
var elmt = getCookie("elmt")
      // alert(elmt)
      if(elmt != ""){ 

        // setTimeout( function(){alert("oke")}, 10000);
        setTimeout(function(){ToggleTable($("#"+elmt))}, 1000);
        
      }

</script>
<script type="text/javascript">
 $(document).on("click", ".browse", function() {
          //console.log($(this))
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
          //console.log(fileName)
          // $("#file").val(fileName);
        if (fileName.includes(".png") || fileName.includes(".jpg") || fileName.includes(".jepg")){
          var reader = new FileReader();
          var myElement =  $(this).parent()
            .find("#preview-file")
          reader.onload = function(e) {
            // get loaded data and render thumbnail.
          html  = html + '<img style="width: 200px;margin-left: 3%;" src="'+e.target.result+'" id="preview" class="preview">';
             //console.log(myElement.html())
           myElement.html( myElement.html()+html);
          //console.log(myElement.html())

          };
       
          reader.readAsDataURL(this.files[i]);
      }else{
            // get loaded data and render thumbnail.
        //console.log(fileName)
          html  = html + '<p><img width="25" height = "25" src="/js-css/img/icon/write.png">' + fileName+ "<p>"; 
            $(this)
            .parent()
            .find("#preview-file").html( $(this).parent().find("#preview-file").html()+html);
          
  }
 


          // read the image file as a data URL.
                }
              
        });



  </script>

  <script type="text/javascript">
  
        function confirm_remove(ele,id) {
              // ele.preventDefault()
              swal({ 
                  title: "",   
                  text: " Bạn có chắc muốn xóa công việc ",   
                  type: "info",   
                  showCancelButton: true,     
                  confirmButtonText: "Có ",   
                  cancelButtonText: "Không",   
                  closeOnConfirm: false,   
                  closeOnCancel: false,
                  reverseButtons: true }, 
                  function(isConfirm){   
                  if (isConfirm) 
                  {   
                    loading_nomal()
                    location.href="schedule/drop/"+id
                    swal.close(); 
                  } 
                  else {     
                    swal.close();  
                  } 
                });
        }
</script>

<script>

  function zoomOutMobile(flag) {
    //console.log("Zoomn!!!")
  
    var viewport = document.querySelector("meta[name='viewport']");
    viewport.content = "width=400, maximum-scale=0.635";
    setTimeout(function() {
        viewport.content = "width=400, maximum-scale=10";
     
    }, 350);
  
  }
</script>



 <script>

  function BigLinkFun(id){
 let a= document.createElement('a');
a.target= '_blank';
a.href= "/chatify/schedule/" + id
a.click();
   
}

      // check if this day has an event before
    function IsDateHasEvent(date) {
        var allEvents = [];
        allEvents = $('#calendar').fullCalendar('clientEvents');
        var event = $.grep(allEvents, function (v) {
            if(v.title == "0"){
            return +v.start === +date
            }
            return 0
        });
        return event.length > 0;
    }


//console.log('???')

    function displayMessage(message) {
        $(".response").html("<div class='success'>"+message+"</div>");
        setInterval(function() { $(".success").fadeOut(); }, 1000);
    }

    function DisplayJob(){
  $("#jobSelect").slideToggle();
}

function fulltext(id){
  if(id != "-99"){
  document.getElementById("text"+id).innerHTML = document.getElementById("longtext"+id).innerHTML 
  }
}

function shorttext(id){
  if(id != "-99"){
     var curSelect = getCookie("sid")
  if(curSelect.includes(id) == false){
      console.log(id)
      document.getElementById("text"+id).innerHTML = document.getElementById("shorttext"+id).innerHTML 
  }


  }
}
function shortftext(id){
  if(id != "-99"){
      document.getElementById("text"+id).innerHTML = document.getElementById("shorttext"+id).innerHTML 
  }

}

function loadCalender(argument) {
   var curSelect = getCookie("sid")
    curSelect = curSelect.split(',');
    // alert(curSelect)
    // alert(curSelect.length)
    if(curSelect != ""){
        for(var i =0; i < curSelect.length; i++){
          // alert(curSelect[i])
          if(curSelect[i] == "-99"){
          document.getElementById("SelVN").checked = true;
        }else{
          fulltext(curSelect[i])
          document.getElementById("Sel"+curSelect[i]).checked = true;
        }
      }
  }
}

setTimeout(loadCalender, 1000);
</script>


@endsection
