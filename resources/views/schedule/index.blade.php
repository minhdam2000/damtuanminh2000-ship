@extends('../layouts/index')
@section('content')
    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6>Quản lý quy trình</h6>
            </div>
            <div class="header-content-right" style="display: inline;">
                <h6 class="display-inline">Quản lý quy trình</h6>
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
        <div class="">
          <div class="row row-content">
            <div class="row-title-proxy">
             
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;Danh sách công việc</div>
                      <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#create-job"><i class="fa fa-plus" aria-hidden="true"></i>công việc mới </button></div>
                      <div class="proxy-add" title="Delete"><button type="button" class="camera-button" id="device-remove"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button><button style="display: none;" id="remove-credential" type="submit"></button></div>
                      <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>
                     

                      <div class="search-input proxy-add" title="Serach">
                        <input type="text" class="textbox" id="search-input" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div>
              </div>
                      </div>
              </div>
                      </div>
              </div>
              <hr>
 <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content1">Công việcđang thực hiện</a>
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
                  <table id="camera-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th class="check-all">
                              <input type="checkbox" id="select-all" value="select-all"  name="select-all" onclick="checkAll();" />
                              <label for="select-all" class="display-inline" id="label-all"></label>
                              <label class="display-inline"></label>
                             </th>
                            <th>Tổng quan</th>
                            <th>Nôi dung chi tiết</th>
                            <th>Người giao</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($curent_schedule as $schedule)
                            <tr class="color-add">
                              <td>
                                <input type="checkbox" id="{{$schedule->id}}" value="{{$schedule->id}}" name="{{$schedule->id}}" class="check-box" />
                                <label for="{{$schedule->id}}" class="add-cam"></label>
                              </td>
                              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;">  </i>Tên công việc:<span id="title{{$schedule->id}}"> {{$schedule->title}}</span></a><br>
                                Ngày bắt đầu: 
                                <span id="sdate{{$schedule->id}}">{{$schedule->start_date}}</span><br>
                                Ngày kết thúc: 
                                <span id="edate{{$schedule->id}}">{{$schedule->end_date}}</span>

                                </td>


                              <td id="content{{$schedule->id}}">{!! $schedule->content !!}</td>
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

if(DB::table("users")->where("id",$schedule->user_id)->first()->id == Auth()->user()->id){

  ?>
                            <span class="job-update preview" data-toggle="modal" data-target="#edit-job-modal" id="{{$schedule->id}}"><img src="/js-css/img/icon/write.png"></span>
<?php
}
?>
                              <a style="color: white"  type="button" href="schedule-list/{{$schedule->id}}" class="btn btn-del Disable"><i class="fa fa-list" aria-hidden="true" style="font-size: 1.2rem;"></i></a>

                              <a style="color: white"  type="button" href="schedule/file/{{$schedule->id}}" class="btn btn-del Disable"><i class="fa fa-folder-open-o" aria-hidden="true" style="font-size: 1.2rem;"></i></a>
                            </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
<div id="content2" class="tab-pane ">
                  <table id="camera-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th class="check-all">
                              <input type="checkbox" id="select-all" value="select-all"  name="select-all" onclick="checkAll();" />
                              <label for="select-all" class="display-inline" id="label-all"></label>
                              <label class="display-inline"></label>
                             </th>
                            <th>Tổng quan</th>
                            <th>Nôi dung chi tiết</th>
                            <th>Người giao</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($complete_schedule as $schedule)
                            <tr class="color-add">
                              <td>
                                <input type="checkbox" id="{{$schedule->id}}" value="{{$schedule->id}}" name="{{$schedule->id}}" class="check-box" />
                                <label for="{{$schedule->id}}" class="add-cam"></label>
                              </td>
                              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;">  </i>Tên công việc:<span id="title{{$schedule->id}}"> {{$schedule->title}}</span></a><br>
                                Ngày bắt đầu: 
                                <span id="sdate{{$schedule->id}}">{{$schedule->start_date}}</span><br>
                                Ngày kết thúc: 
                                <span id="edate{{$schedule->id}}">{{$schedule->end_date}}</span>

                                </td>


                              <td id="content{{$schedule->id}}">{!! $schedule->content !!}</td>
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
                           
                      
                              <a style="color: white"  type="button" href="schedule-list/{{$schedule->id}}" class="btn btn-del Disable"><i class="fa fa-list" aria-hidden="true" style="font-size: 1.2rem;"></i></a>

                              <a style="color: white"  type="button" href="schedule/file/{{$schedule->id}}" class="btn btn-del Disable"><i class="fa fa-folder-open-o" aria-hidden="true" style="font-size: 1.2rem;"></i></a>
                            </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>

<div id="content3" class="tab-pane  ">
                  <table id="camera-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th class="check-all">
                              <input type="checkbox" id="select-all" value="select-all"  name="select-all" onclick="checkAll();" />
                              <label for="select-all" class="display-inline" id="label-all"></label>
                              <label class="display-inline"></label>
                             </th>
                            <th>Tổng quan</th>
                            <th>Nôi dung chi tiết</th>
                            <th>Người giao</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($stop_schedule as $schedule)
                            <tr class="color-add">
                              <td>
                                <input type="checkbox" id="{{$schedule->id}}" value="{{$schedule->id}}" name="{{$schedule->id}}" class="check-box" />
                                <label for="{{$schedule->id}}" class="add-cam"></label>
                              </td>
                              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;">  </i>Tên công việc:<span id="title{{$schedule->id}}"> {{$schedule->title}}</span></a><br>
                                Ngày bắt đầu: 
                                <span id="sdate{{$schedule->id}}">{{$schedule->start_date}}</span><br>
                                Ngày kết thúc: 
                                <span id="edate{{$schedule->id}}">{{$schedule->end_date}}</span>

                                </td>


                              <td id="content{{$schedule->id}}">{!! $schedule->content !!}</td>
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
                           

                              <a style="color: white"  type="button" href="schedule-list/{{$schedule->id}}" class="btn btn-del Disable"><i class="fa fa-list" aria-hidden="true" style="font-size: 1.2rem;"></i></a>

                              <a style="color: white"  type="button" href="schedule/file/{{$schedule->id}}" class="btn btn-del Disable"><i class="fa fa-folder-open-o" aria-hidden="true" style="font-size: 1.2rem;"></i></a>
                            </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>




          </div>
        </div>



    </div>
    <!-- Modal -->

      <div class="modal fade modol-text" id="create-job" role="dialog">
        <form id="action-form" action="add-new-schedule" method="POST"
         enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="type_id" value="0">
          <input type="hidden" name="id" value="{{$id}}">
          <div  class="modal-dialog model-right" style="min-width: 50%;height: auto">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Tạo việc </label>
              </div>
              <div class="notification"></div>
              <div class="modal-body modal-config">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                       <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tên </td>
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
                            <td><textarea  name="des" class="ckeditor form-control input-edit modol-text"  required=""></textarea></td>
                        </tr>




</tbody>

                    <tbody class="table-edit">
                       
                        
                       
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
<select name="did[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="departselect" multiple>

@foreach($dept as $dept)
<option value="{{$dept->id}}">{{$dept->name}}</option>
@endforeach  


</select>

                <select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffselect" multiple>
                        <div class="form-group">
                   <!--  <input style="display: none" type="file" name="file[]" class="file"
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
                


</select>
              <div  style="margin-top: 5%;">
                <button class="btn btn-model" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Tạo</button>
                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
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
    $(document).ready(function() {
        $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');

        //add the active class to the link we clicked
        // $(this).addClass('active');

        $("#"+this.href.split("#")[1]).addClass('active');
        // event.preventDefault();
    });

      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }
  });
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
 function getStaffList(){
  $.ajax({
    type: "GET",
    url: '/system/shedule-staff/{{$id}}',
    success: function (response) {
      response = (JSON.parse(response))
      console.log(response)
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


      html = ''
      for(var i =0; i < response.length; i++){
          html = html +'<option  value="'+response[i].id+'">'+response[i].name+ "-"+response[i].rname + "(" +  response[i].dname + ")" +'</option>'
      }
      console.log(html)
      document.getElementById("staffselect").innerHTML=html;
$('#staffselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
$('#departselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});



    }
  });
}
getStaffList()


 function getStaffSelectedList(id){
  $.ajax({
    type: "GET",
    url: '/schedule/staff-select/{{$id}}/'+id,
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


 function getDeptSelectedList(id){
  $.ajax({
    type: "GET",
    url: '/schedule/dept-select/{{$id}}/'+id,
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

    getStaffSelectedList(jobid)
    getDeptSelectedList(jobid)

  })
</script>
@endsection