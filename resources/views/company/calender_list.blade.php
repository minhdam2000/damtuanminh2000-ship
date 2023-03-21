@extends('layouts.index')
@section('content')
<link rel="stylesheet" href="js-css/css/stepprogressbar.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<style type="text/css">
  .GoogleContent iframe{

    width: 100%;
    min-height: 400px;
      }
 

  .progress{
    min-height: 30px;
    background-color: transparent;
}
.progress-bar{
    font-size: 15px;
  }
  .popover-header {
    color: black;
  }
  .fc-content{
    font-size: 16px;
  }
  .fc-content{
    white-space: normal!important;
  }

  input[type=checkbox], input[type=radio] {


    position: inherit;
  }
  .fc-basic-view .fc-body .fc-row {
    min-height: 12em;
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
  .fc-day-grid-event{
    background-color: transparent;
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
	<div class="session">
		@if(Session::has('notification'))
		<input hidden="" notifi="{{Session::get('notification')}}" value="1" id="notice_success">
		@endif
		@if(Session::has('warning'))
		<input hidden="" notifi="{{Session::get('warning')}}" value="1" id="notice_warning">
		@endif
	</div>
	<div class="row row-content">
		<div class="row-title-proxy">
			<ul class="nav nav-tabs" id="tabs" role="tablist">
        <li class="nav-item margin_center">
          <a id="tab2" class="nav-link active color-a" 
          data-toggle="tab" role="tab" href="#content2"> Lịch </a>
        </li>
        <li class="nav-item margin_center">
         <a id="tab1" class="nav-link  color-a"  data-toggle="tab" role="tab" href="#content1"> Chi tiết sự kiện</a>
       </li>
     </ul> 
     <hr>
     <?php
// $colors = ["#FFC0CB", "#E6E6FA", "#DDA0DD", "#FFA07A", "#FFA500", " #FFFACD", "#ADFF2F", "#98FB98", "#8FBC8F", "#AFEEEE", "#B0C4DE", "#F5DEB3", "#A9A9A9", "#FFE4E1", "#F4A460"];


     $colors = ["#FF1493", "#9932CC",  "#00FF00", "#FFA500", "#008B8B", "#4682B4", "#ccccf0", "#778899", "rgb(137,207,240)", "pink", "#DA70D6", "#FF8C00", "#CD5C5C", "#DDA0DD"];

     $colorsSel = [0,0,0,0,0,0,0,0,0,0,0,0,0,0];


     ?>
     <div class="tab-content">
      <div id="content2" class="tab-pane  in active">
        <br><hr><br>
        <div class="row" style="margin-left: 2%;">
          <div class="col-md-2 col-12" id="PcSel">
            <ul id="jobSelect" style="max-height:300px;overflow: auto;">
              @foreach($calendar_event as $event)

              <?php
              $count = $event->id % count($colors);
              $i = 0;
              while($colorsSel[$count] == 1){
                $i = $i + 1;
                if($i > 100){
                  $count = 0;
                  break;
                }
                $count = $count + 1;
                if($count == count($colors) ){
                  $count = 0;
                  break;
                }
              }
              $colorsSel[$count] =1;



              ?>


              @if(strlen($event->name) > 15)

              <span onmouseenter="fulltext({{$event->id}})" onmouseleave="shorttext({{$event->id}})" id="text{{$event->id}}"> 

                @else

                <span id="text{{$event->id}}"> 

                  @endif
                </span>


                <span style="display: none" id="color{{$event->id}}"><?=$colors[$count]?></span>

                <span style="display: none" id="longtext{{$event->id}}"> 
                  {{$event->name}}
                </span>

                @if(strlen($event->name) > 15)

                <span style="display: none" id="shorttext{{$event->id}}"> 

                </span>
                @else
                <span style="display: none" id="shorttext{{$event->id}}"> 
                  {{$event->name}}
                </span>

                @endif


                @endforeach

              </ul>
              
              
              
              <!-- <input type="button" id="save_value" name="save_value" value="Lọc" class="camera-button" /> -->
            </div>
            <div style="margin-left: 2px;" class="col-md-12 col-12">
              <div id='calendar'></div>
              <div id='calendarNoti' style="display:none;">
                <h4>Vui lòng chọn thiết bị có kích thước to hơn hoặc xoay màn hình để sử dụng</h4>
                <button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button>
              </div>
            </div>

            <div class="col-md-1 col-12" id="mobileSel" style="display:none">
            </div>
          </div>
        </div>

        <div id="content1" class="tab-pane  in">
          <div class="active-view" id="menu1">
           <h5 style="margin-left: 20px;"> Tên: {{$companys->name}}</h5>
           <form action="vip/delete-khach-hang" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div ></div>
            <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-edge"><i class="fa fa-plus" aria-hidden="true"></i> Sự kiện mới </button></div>
            <div class="proxy-add" title="Delete"><!-- <button type="button" class="camera-button" id="device-remove"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button> --><button style="display: none;" id="remove-credential" type="submit"></button></div>
            <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>
            <table id="example" class="nvr-table">
             <thead>

              <tr class="thead">
               <th class="check-all">
                <input type="checkbox" id="select-all" value="select-all"  name="select-all" onclick="checkAll();" />
                <label for="select-all" class="display-inline" id="label-all"></label>
                <label class="display-inline"></label>
              </th>

              <th>Tên sự kiện </th>
              <th>Ghi chú</th>
              <th>Lịch </th>
              <th>Lặp lại </th>
              <th>Ngày bắt đầu</th>
              <th>Ngày kết thúc</th>
              <th>Thời gian bắt đầu</th>
              <th>Thời gian kết thúc</th>
              <th></th>

            </tr>
          </thead>
          <tbody class="tbody"> 
            @foreach($calendar_event as $event)
            <tr class="color-add">
             <td>
              <input type="checkbox" id="{{$event->id}}" value="{{$event->id}}" name="{{$event->id}}" class="check-box" />
              <label for="{{$event->id}}" class="add-cam"></label>
            </td>
            <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="name{{$event->id}}"> {{$event->name}}</span></a></td>

              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="note{{$event->id}}"> {{$event->note}}</span></a></td>

                <td><span style="display:none"   id="calendar_lunar{{$event->id}}">{{$event->calendar_lunar}}</span> 
                 @if($event->calendar_lunar == 0)
                 Lịch âm
                 @else
                 Lịch dương
                 @endif 
               </td>
               <td><span style="display:none"   id="calendar_preply{{$event->id}}">{{$event->calendar_preply}}</span> 
                 @if($event->calendar_preply == 0)
                 không
                 @elseif($event->calendar_preply == 1)
                 Lặp theo tuần
                 @elseif($event->calendar_preply == 2)
                 Lặp theo tháng
                 @elseif($event->calendar_preply == 3)
                 Lặp theo năm
                 @endif 
               </td>

               <td> <span id="date{{$event->id}}">{{$event->date}}</span></a></td>
               <td> <span id="end_date{{$event->id}}">{{$event->end_date}}</span></a></td>
               <td> <span id="start_time{{$event->id}}">{{$event->start_time}}</span></a></td>
               <td> <span id="end_time{{$event->id}}">{{$event->end_time}}</span></a></td>

               <td><button style="color: white"  type="button" onclick="updateInfo('{{$event->id}}')" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/notepad.png"></span></button>
                 <a class="sicon" onclick="confirm_remove(this,{{$event->id}})">
                  <span class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span>
                </a>
              </td>

            </tr>
            @endforeach
          </tbody>
        </table>
      </form>
    </div>
  </div>
</div>
</div>
</div>
<!-- Modal -->

<div class="modal fade modol-text" id="new-edge" role="dialog">
  <div class="modal-dialog model-right">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label>Tạo sự kiện  </label>
      </div>
      <div class="notification"></div>
      <form action="canlender/add-new-canlender-event" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="id" value="{{$id}}">
        <div class="modal-body">
          <table class="table-edit table-model">
            <tbody class="table-edit">
              <tr>
                <td class="fa fa-pencil-square-o">Sự kiện </td>
                <td><input type="" value="" name="name" class="input-edit modol-text" id="name" required=""></td>
              </tr>  
              <tr>
                <td class="fa fa-pencil-square-o">Ghi chú </td>
                <td><input type="" value="" name="note" class="input-edit modol-text" id="note" required=""></td>
              </tr> 

              <tr>
               <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Lịch </td>
               <td><select onchange="changeLunar()" value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="calendar_lunar" id="createLunar">
                <option value="1">Lịch dương</option>
                <option value="0"> Lịch âm </option>
              </select></td>
            </tr>
            <tr>
             <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Lặp lại</td>
             <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="calendar_preply" id="EditPreply">
              <option value="0"> Không </option>
              <option value="1">Lặp theo tuần</option>
              <option value="2">Lặp theo tháng</option>
              <option value="3">Lặp theo năm</option>
            </select></td>
          </tr>
        </tbody>
      </table>

      <table class="table-edit table-model">
        <tbody>
          <tr>


            <td><i id="my" onchange="updateDate()" class="fa fa-calendar"  aria-hidden="true"></i> Ngày bắt đầu </td>
            <td> <input onchange="updateDate()" value="date" type="date"  class="input-edit modol-text form-control" name="date" id="new_date" ></td>
            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian bắt đầu </td>

            <td> <input type="time" class="input-edit modol-text form-control" id="new_time" name="start_time" min="00:00" max="24:00"></td>
          </tr>

          <tr>


            <td><i class="fa fa-calendar" aria-hidden="true"></i> Ngày kết thúc</td>
            <td> <input type="date" class="input-edit modol-text form-control" name="end_date" id="end_date" required=""></td>

            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian kết thúc   </td>
            <td> <input type="time" class="input-edit modol-text form-control" id="end_time" name="end_time" min="00:00" max="24:00"></td>
          </tr>

          <tr>
            <td></td>
            <td>
              <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
            </td>
            <td>
              <button type="button" class="btn btn-model" data-dismiss="modal">Thoát </button>
            </td>
          </tr>
          <tr><td>
          <div  class="GoogleContent" id="iframe">
                    <button id="myBtn{{$event->id}}" type="button" class="btn btn-model" onclick="changeIframe({{$event->id}})">Hồ sơ tài liệu</button>
                 </div> 
          </td>

        </tr>
        
      </tbody>
    </table>
  </div>
</form>
</div>
</div>
</div>
</div>

</div>
<div class="modal fade modol-text" id="EditInfoModal" role="dialog">
  <div class="modal-dialog model-right">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label>Chỉnh sửa thông tin</label>
      </div>
      <div class="notification"></div>
      <form action="edit-canlender" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="id" value="" id="EditId">
        <div class="modal-body">
          <table class="table-edit table-model">
            <tbody class="table-edit">
              <tr>
                <td class="fa fa-pencil-square-o">Sự kiện </td>
                <td><input type="" value="" name="name" class="input-edit modol-text" id="EditName" required=""></td>
              </tr>
              <tr>
                <td class="fa fa-pencil-square-o">Ghi chú </td>
                <td><input type="" value="" name="note" class="input-edit modol-text" id="EditNote" required=""></td>
              </tr>

              <tr>

                <tr>
                  <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Lịch </td>
                  <td><select onchange="changeLunarEdit()" value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="calendar_lunar" id= "EditLunar">
                    <option value="0"> Lịch âm </option>
                    <option value="1"> Lịch dương </option>
                  </select></td>
                </tr>
                <tr>
                  <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Lặp </td>
                  <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="calendar_preply" id= "EditPreply">
                    <option value="0"> Không </option>
                    <option value="1">Lặp theo tuần</option>
                    <option value="2">Lặp theo tháng</option>
                    <option value="3">Lặp theo năm</option>
                  </select></td>
                </tr>
              </tr>

            </tbody>
          </table>

          <table class="table-edit table-model">
            <tbody>
              <tr>
                <td><i class="fa fa-calendar" aria-hidden="true"></i> Ngày bắt đầu </td>
                <td> <input type="date" class="input-edit modol-text form-control" name="date" id="EditDate" required=""></td>
                <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian bắt đầu </td>
                <td> <input type="time" class="input-edit modol-text form-control" name="start_time" id="EditStartTime"  min="00:00" max="24:00" ></td>
              </tr>
              <tr>
                <td><i class="fa fa-calendar" aria-hidden="true"></i> Ngày kết thúc </td>
                <td> <input type="date" class="input-edit modol-text form-control" name="end_date" id="EditEnd" required=""></td>
                <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian kết thúc </td>
                <td> <input type="time" class="input-edit modol-text form-control" name="end_time" id="EditEndTime"  min="00:00" max="24:00" ></td>
              </tr>

              <tr>
                <td></td>
                <td>
                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>
                  <a class="btn btn-model" id="delete_btn"> &nbsp;&nbsp; Xóa &nbsp;&nbsp; </a>
                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoát </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
</div>
<div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
</div>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
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
    if(window.innerWidth < 500){
      document.getElementById("calendar").style.display="none";
      document.getElementById("calendarNoti").style.display="block";

    }
    var SITEURL = "{{url('/')}}";
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   // var colors = ["#FFC0CB", "#E6E6FA", "#DDA0DD", "#FFA07A", "#FFA500", " #FFFACD", "#ADFF2F", "#98FB98", "#8FBC8F", "#AFEEEE", "#B0C4DE", "#F5DEB3", "#A9A9A9", "#FFE4E1", "#F4A460"]

    var calendarinit_ck = getCookie("calender-init")

    if(calendarinit_ck =="" || !calendarinit_ck.includes("-")){
      calendarinit = new Date()
      calendarinit.toISOString().split('T')[0] 
    }else{
      calendarinit = calendarinit_ck;
    }
// alert(calendarinit)

    var calendar = $('#calendar').fullCalendar({

      defaultDate: calendarinit,
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
      events: SITEURL + "/calendar/event/{{$companys->id}}",
      displayEventTime: true,
      editable: true,
      viewRender: function (view, element) {
    // alert(formatDate(view.start))
        setCookie("calender-init", NextformatDate(view.start), 3600*24, "/", false);
    // alert("2")
        
      },
      eventRender: function (event, element, view) {
    // alert(calendar.getDate())
              // console.log("123123")
              // alert(event.status)
             // console.log((element.parentElement()).html())
       html = $(element).closest('.fc-event-container');
              // console.log(colors.length)
              // alert(event.id)
              // var count = event.id % colors.length
              // alert(count)


       element.find('.fc-content').css('border', 'none');

       if(event.status == 9){
        element.css('border', 'none');
        element.find('.fc-content').css('background-color', 'none');
        element.find('.fc-content').css('float', 'right');
        element.find('.fc-content').css('color', 'red');
        html = event.title
      }
      else 


      if(event.status == 3){
        element.find('.fc-content').css('background-color', 'red');
      }
      else{
        var mycolor = document.getElementById("color"+event.id).innerHTML;
        element.find('.fc-content').css('background-color', mycolor);
        if(event.start_time){
          html = String(event.start_time).substring(0, event.start_time.length - 3)+ " " + event.title;
        }else{
          html = event.title;
        }
              // html = String(event.start_time).substring(0, str.length - 2);+" "+ event.title;

      }
              // console.log("!23")
              // console.log(html)
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


                // var dateHTML = $.fullCalendar.formatDate(start, "DD-MM-Y");
                // document.getElementById("dateAdd").innerHTML = dateHTML;

            // if (!IsDateHasEvent(start)) {
            //    $('#historyModal').modal();
            //  }
    }, 
    dayClick: function (start, end, allDay) {
              // alert("??11??")

      calendar.fullCalendar('unselect');

      var date = $.fullCalendar.formatDate(start, "Y-MM-DD");
                //console.log(date)
                // document.getElementById("new_start_date").value = date
      document.getElementById("new_date").value = date;
      document.getElementById("end_date").value = date;
      $("#new-edge").modal()

                // $("#create-job").modal();
                // $("#0").click()

                // var dateHTML = $.fullCalendar.formatDate(start, "DD-MM-Y");
                // document.getElementById("dateAdd").innerHTML = dateHTML;

            // if (!IsDateHasEvent(start)) {
            //    $('#historyModal').modal();
            //  }
    },

    eventDrop: function (event, delta) {
      alert("1")
      console.log(event)
      start=moment(event.start).format('Y-MM-DD');
      end=moment(event.end).format('Y-MM-DD');

      $.ajax({
        url: '/calendar/event/drag-update',
        data: {"_token": "{{ csrf_token() }}",'start': start, 'id': event.id},
        type: "POST",
        success: function (response) {  
          console.log("okie")
        }
      });
      alert("2")
    },
    eventClick: function (event) {
              // $("#EditInfoModal")  .modal()
      updateInfo(event.id)


    }


  });
function changeIframe(id){  
  // alert(id)
   document.getElementById("myBtn"+id).innerHTML = 
           '<iframe src="/chatify/calender/' + id+'"></iframe>'
}
function NextformatDate(date) {
  var d = new Date(date),
  month = '' + (d.getMonth() + 2),
  day = 20,
  year = d.getFullYear();

  if(month > 12){
    month = 12;
  }

  if (month.length < 2) 
    month = '0' + month;
  if (day.length < 2) 
    day = '0' + day;

  return [year, month, day].join('-');
}

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


function shorttext(id){
  if(id != "-99"){
   var curSelect = getCookie("sid")
   if(curSelect.includes(id) == false){
    console.log(id)
    document.getElementById("text"+id).innerHTML = document.getElementById("shorttext"+id).innerHTML 
  }


}
}

function changeLunar(){
  var value = document.getElementById("createLunar").value;
    // alert(value)
  var date = document.getElementById("new_date").value;
  if(value == 0){
    $.ajax({
      url: '/fullcalendar/convert/'+value+"/"+date,
      type: "GET",
      success: function (response) {
                // alert(response)
        document.getElementById("new_date").value = response;
        document.getElementById("end_date").value = document.getElementById("new_date").value;
      }
    });

  }else{

  }
}


function changeLunarEdit(){
  var value = document.getElementById("EditLunar").value;
    // alert(value)
  var date = document.getElementById("EditDate").value;
  if(value == 0){
    $.ajax({
      url: '/fullcalendar/convert/'+value+"/"+date,
      type: "GET",
      success: function (response) {
                // alert(response)
        document.getElementById("EditDate").value = response;
        document.getElementById("EditEnd").value = document.getElementById("EditDate").value;
      }
    });

  }else{

  }
}

function shortftext(id){
  if(id != "-99"){
    document.getElementById("text"+id).innerHTML = document.getElementById("shorttext"+id).innerHTML 
  }

}
function fulltext(id){
  if(id != "-99"){
    document.getElementById("text"+id).innerHTML = document.getElementById("longtext"+id).innerHTML 
  }
}

function CbChange(id){
        // alert("123s")
  shortftext(id)

  var val = [];
  $(':checkbox:checked').each(function(i){
    val[i] = $(this).val();
          // alert(val[i])
    fulltext(val[i])
  });
  $(":checkbox:not(:checked)").each(function(i){
          // alert($(this).val())
          // shorttext($(this).val())
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

<script>
 document.getElementById("EditDate").onchange = function(){
  var value = document.getElementById("EditEnd").value;
};
</script>

<script>

  document.getElementById('new_date').valueAsDate = new Date();

  $('#example').DataTable({
    "paging":   false,
    "info":     false,
    "searching": false
  });


  function updateDate() 
  {
    document.getElementById("end_date").value = document.getElementById("new_date").value;
  }


  function updateInfo(id){
    document.getElementById("EditId").value = id
    document.getElementById("EditName").value = document.getElementById("name"+id).innerHTML
    document.getElementById("EditNote").value = document.getElementById("note"+id).innerHTML
    document.getElementById("EditDate").value = document.getElementById("date"+id).innerHTML
    document.getElementById("EditLunar").value = document.getElementById("calendar_lunar"+id).innerHTML
    document.getElementById("EditPreply").value = document.getElementById("calendar_preply"+id).innerHTML
    document.getElementById("EditEnd").value = document.getElementById("end_date"+id).innerHTML
    document.getElementById("EditStartTime").value = document.getElementById("start_time"+id).innerHTML
    document.getElementById("EditEndTime").value = document.getElementById("end_time"+id).innerHTML

    document.getElementById("delete_btn").onclick = function() {
      confirm_remove("123",id)
    };

    
           // var type = document.getElementById("Edittype"+id).innerHTML
    // $("#EditDes").val(des);

//           CKEDITOR.instances.EditType.setData( document.getElementById("Edittype"+id).innerHTML, function()
// {
//     this.checkDirty();  // true


// });
    $("#EditInfoModal").modal()
  }
</script>
<script type="text/javascript">

  function confirm_remove(ele,id) {
              // ele.preventDefault()
    swal({ 
      title: "",   
      text: " Bạn có chắc muốn xóa không !",   
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
          location.href="canlender/delete-list/"+id
          swal.close(); 
        } 
        else {     
          swal.close();  
        } 
      });
  }
</script>
@endsection