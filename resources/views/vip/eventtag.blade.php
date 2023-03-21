@extends('layouts.index')
@section('content')
<style type="text/css">
  @media(max-width:500px) {
    .fc-toolbar .fc-right{
      font-size: 1em;
    }
    td, th {
      font-size: 0.5em;
    }
  }

  @media(max-width:400px) {
    .fc-toolbar .fc-right{
      font-size: 0.5em;
    }
    .fc-left{
      font-size: 10px;
    }
    td, th {
      font-size: 0.3em;
    }
  }


</style>

<link rel="stylesheet" href="js-css/css/stepprogressbar.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<style type="text/css">

  input[type=checkbox], input[type=radio] {


    position: inherit;  
  }

 
.fc-content{
  font-size: 16px;
}
.fc-content{
  white-space: normal!important;
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
.fc-view-container {
    font-size: 1.5em;
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
        <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#content1"> Thông tin tag</a>
      </li>
      <li class="nav-item margin_center">
        <a id="tab2" class="nav-link color-a" 
        data-toggle="tab" role="tab" href="#content2"> Lịch </a>
      </li>
    </ul> 
    <hr>
    <?php
// $colors = ["#FFC0CB", "#E6E6FA", "#DDA0DD", "#FFA07A", "#FFA500", " #FFFACD", "#ADFF2F", "#98FB98", "#8FBC8F", "#AFEEEE", "#B0C4DE", "#F5DEB3", "#A9A9A9", "#FFE4E1", "#F4A460"];


    $colors = ["#FF1493", "#9932CC",  "#00FF00", "#FFA500", "#008B8B", "#4682B4", "#ccccf0", "#778899", "rgb(137,207,240)", "pink", "#DA70D6", "#FF8C00", "#CD5C5C", "#DDA0DD"];

    $colorsSel = [0,0,0,0,0,0,0,0,0,0,0,0,0,0];


    ?>
    <div class="tab-content">
      <div id="content2" class="tab-pane  in">
        <br><hr><br>
        <div class="row" style="margin-left: 2%;">
          <div class="col-md-2 col-12" id="PcSel">
            <br>
            <hr>
            <h4 id="JobList" onclick="DisplayJob()">Danh sách công việc  </h4>
            <br>
            <h6 id="JobList" onclick="DisplayJob()">Dương lịch</h6>
            <ul id="jobSelect" style="max-height:300px;overflow: auto;">
              @foreach($vip_eventtag as $event)

                <?php
                $count = $event->id % count($colors);
                while($colorsSel[$count] == 1){
                  $count = $count + 1;
                  if($count == count($colors) ){
                    $count = 0;
                  }
                }
                $colorsSel[$count] =1;



                ?>
                @if(($event->is_lunar)==1)


                <li  title="{{$event->name}}" data-placement="top" data-trigger="hover" data-toggle="popover" data-html="true"  style="color:<?=$colors[$count]?>"><input id="Sel{{$event->id}}" name="selector[]" class="form-check-input" onclick="CbChange({{$event->id}})" type="checkbox" value="{{$event->id}}" />  
                  
                  @if(strlen($event->name) > 15)

                  <span onmouseenter="fulltext({{$event->id}})" onmouseleave="shorttext({{$event->id}})" id="text{{$event->id}}"> 
                    {{substr($event->name,0,15)}}..
                    @else

                    <span id="text{{$event->id}}"> 
                      {{$event->name}}
                      @endif
                    </span>


                    <span style="display: none" id="color{{$event->id}}"><?=$colors[$count]?></span>

                    <span style="display: none" id="longtext{{$event->id}}"> 
                      {{$event->name}}
                    </span>

                    @if(strlen($event->name) > 15)

                    <span style="display: none" id="shorttext{{$event->id}}"> 
                     {{substr($event->name,0,15)}}..
                   </span>
                   @else
                   <span style="display: none" id="shorttext{{$event->id}}"> 
                    {{$event->name}}
                  </span>

                  @endif



                </li>
                @endif


                @endforeach

              </ul>
              <h6 id="JobList" onclick="DisplayJob()">Âm lịch </h6>
              <ul id="jobSelect" style="max-height:300px;overflow: auto;">
                @foreach($vip_eventtag as $event)

                <?php
                $count = $event->id % count($colors);
                while($colorsSel[$count] == 1){
                  $count = $count + 1;
                  if($count == count($colors) ){
                    $count = 0;
                  }
                }
                $colorsSel[$count] =1;



                ?>
                @if(($event->is_lunar)==0)


                <li  title="{{$event->name}}" data-placement="top" data-trigger="hover" data-toggle="popover" data-html="true"  style="color:<?=$colors[$count]?>"><input id="Sel{{$event->id}}" name="selector[]" class="form-check-input" onclick="CbChange({{$event->id}})" type="checkbox" value="{{$event->id}}" />  
                  
                  @if(strlen($event->name) > 15)

                  <span onmouseenter="fulltext({{$event->id}})" onmouseleave="shorttext({{$event->id}})" id="text{{$event->id}}"> 
                    {{substr($event->name,0,15)}}..
                    @else

                    <span id="text{{$event->id}}"> 
                      {{$event->name}}
                      @endif
                    </span>


                    <span style="display: none" id="color{{$event->id}}"><?=$colors[$count]?></span>

                    <span style="display: none" id="longtext{{$event->id}}"> 
                      {{$event->name}}
                    </span>

                    @if(strlen($event->name) > 15)

                    <span style="display: none" id="shorttext{{$event->id}}"> 
                     {{substr($event->name,0,15)}}..
                   </span>
                   @else
                   <span style="display: none" id="shorttext{{$event->id}}"> 
                    {{$event->name}}
                  </span>

                  @endif



                </li>
                @endif


                @endforeach

              </ul>
              
              
            
            <!-- <input type="button" id="save_value" name="save_value" value="Lọc" class="camera-button" /> -->
          </div>
          <div class="col-md-10 col-12">
            <div id='calendar'></div>
          </div>

          <div class="col-md-1 col-12" id="mobileSel" style="display:none">
          </div>
        </div>
      </div>
      <div id="content1" class="tab-pane  in active">
        <div class="active-view" id="menu1">
          <h5 style="margin-left: 20px; margin-top: 10px;"> tên: {{$vips->name}}</h5>
          <form action="vip/delete-khach-hang" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;Danh sách khách hàng VIP</div>
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
                @foreach($vip_eventtag as $event)
                <tr class="color-add">
                  <td>
                    <input type="checkbox" id="{{$event->id}}" value="{{$event->id}}" name="{{$event->id}}" class="check-box" />
                    <label for="{{$event->id}}" class="add-cam"></label>
                  </td>
                  <!-- <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="name{{$event->id}}"> {{$event->name}}</span></a></td> -->
                   <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="name{{$event->id}}">{{$event->name}}</span></a></td>
                    <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="note{{$event->id}}">{{$event->note}}</span></a></td>
                   <!--  <td><span style="display:none"   id="type{{$event->id}}">{{$event->type}}</span> 
                      @if($event->type == 0)
                      Gia đình
                      @else
                      Công Việc
                      @endif 
                    </td> -->
                    <td><span style="display:none"   id="is_lunar{{$event->id}}">{{$event->is_lunar}}</span> 
                      @if($event->is_lunar == 0)
                      Lịch âm
                      @else
                      Lịch dương
                      @endif 
                    </td>
                    <td><span style="display:none"   id="is_preply{{$event->id}}">{{$event->is_preply}}</span> 
                      @if($event->is_preply == 0)
                    không
                    @elseif($event->is_preply == 1)
                    Lặp theo tuần
                    @elseif($event->is_preply == 2)
                    Lặp theo tháng
                    @elseif($event->is_preply == 3)
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
 <div class="modal fade modol-text" id="new-edge" role="dialog">
  <div class="modal-dialog model-right">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label>Tạo sự kiện  </label>
      </div>
      <div class="notification"></div>
      <form action="vip/add-new-vip-event-tag" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="id" value="{{$id}}">
        <div class="modal-body">
          <table class="table-edit table-model">
            <tbody class="table-edit">
                          <tr>
                                <td class="fa fa-pencil-square-o">Tên sự kiện </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text" id="" required=""></td>
                              </tr>  
                              <tr>
                                <td class="fa fa-pencil-square-o">Ghi chú</td>
                                <td><input type="" value="" name="note" class="input-edit modol-text" id="" required=""></td>
                              </tr> 
                              
                             <!--  <tr>
                                <td class="fa fa-pencil-square-o">Tên Sự kiện </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text" id="name" required=""></td>
                              </tr> --> 
                            <!--   <tr>
                               <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                               <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id="Edittype">
                                <option value="0"> gia đình  </option>
                                <option value="1">công việc</option>
                              </select></td>
                            </tr> -->
                            
                            <tr>
                             <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Lịch </td>
                             <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="is_lunar" id="is_lunar">
                              <option value="0"> Lịch âm </option>
                              <option value="1">Lịch dương</option>
                            </select></td>
                          </tr>
                          <tr>
                           <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Lặp lại</td>
                           <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="is_preply" id="EditPreply">
                             <option value="0"> Không </option>
            <option value="1">Lặp theo tuần</option>
            <option value="2">Lặp theo tháng</option>
            <option value="3">Lặp theo năm</option>
                          </select></td>
                        </tr>
                        <tr>


                          <td><i class="fa fa-calendar" aria-hidden="true"></i> Ngày bắt đầu </td>
                          <td> <input type="date" class="input-edit modol-text form-control" name="date" id="new_date" required=""></td>
                          <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian bắt đầu </td>
                          <td> <input type="time" class="input-edit modol-text form-control" id="new_time" name="start_time" min="00:00" max="24:00"></td>
                        </tr>
                        <tr>


                          <td><i class="fa fa-calendar" aria-hidden="true"></i> Ngày kết thúc</td>
                          <td> <input type="date" class="input-edit modol-text form-control" name="end_date" id="new_date" required=""></td>
                          <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian kết thúc   </td>
                          <td> <input type="time" class="input-edit modol-text form-control" id="end_time" name="end_time" min="00:00" max="24:00"></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>
                            <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
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
            <form action="vip/edit-vip-event-tag" method="POST">
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
                    

                      <!-- <tr>
                        <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                        <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "Edittype">
                          <option value="0"> Gia đình </option>
                          <option value="1">Công việc</option>
                        </select></td>
                      </tr> -->
                      <tr>
                        <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Lịch </td>
                        <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="is_lunar" id= "EditLunar">
                          <option value="0"> Lịch âm </option>
                          <option value="1"> Lịch dương </option>
                        </select></td>
                      </tr>
                      <tr>
                        <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Lặp </td>
                        <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="is_preply" id= "EditPreply">
                          <option value="0"> Không </option>
                          <option value="1">Lặp theo tuần</option>
                          <option value="2">Lặp theo tháng</option>
                          <option value="3">Lặp theo năm</option>
                        </select></td>
                      </tr>
                    </tr>

                    <tr>
                      <td><i class="fa fa-calendar" aria-hidden="true"></i> Ngày bắt đầu </td>
                      <td> <input type="date" class="input-edit modol-text form-control" name="date" id="EditDate" required=""></td>
                      <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian bắt đầu </td>
                      <td> <input type="time" class="input-edit modol-text form-control" name="start_time" id="EditStartTime"  min="00:00" max="24:00" ></td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian kết thúc </td>
                      <td> <input type="date" class="input-edit modol-text form-control" name="end_date" id="EditEnd" required=""></td>
                      <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian kết thúc </td>
                      <td> <input type="time" class="input-edit modol-text form-control" name="end_time" id="EditEndTime"  min="00:00" max="24:00" ></td>
                    </tr>

                    <tr>
                      <td></td>
                      <td>
                        <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>
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
  events: SITEURL + "/viptag/calendar/{{$vips->id}}",
  displayEventTime: true,
  editable: true,
  viewRender: function (view, element) {
    // alert(formatDate(view.start))
    setCookie("calender-init", NextformatDate(view.start), 3600*24, "/", false);
    // alert("2")
        
        },
  eventRender: function (event, element, view) {
              // console.log("123123")
              // alert(event.status)
             // console.log((element.parentElement()).html())
             html = $(element).closest('.fc-event-container');
              // console.log(colors.length)
              // alert(event.id)
              // var count = event.id % colors.length
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


              if(event.status == 9){
                // console.log("lich am")
              element.find('.fc-content').css('background-color', 'rgba(46, 138, 138, 0.2)');
              }
              else if(event.status == 3){
              element.find('.fc-content').css('background-color', 'red');
              }
              else{
                var mycolor = document.getElementById("color"+event.id).innerHTML;
                element.find('.fc-content').css('background-color', mycolor);
              
              }
              html = event.title
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
              // console.log(event.id)
              updateInfo(event.id)
            }


          });
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
        // console.log(id)
        document.getElementById("text"+id).innerHTML = document.getElementById("shorttext"+id).innerHTML 
      }


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

  document.getElementById('new_date').valueAsDate = new Date();

  $('#example').DataTable({
    "paging":   false,
    "info":     false,
    "searching": false
  });

function updateInfo(id){
    document.getElementById("EditId").value = id
    document.getElementById("EditName").value = document.getElementById("name"+id).innerHTML
    document.getElementById("EditNote").value = document.getElementById("note"+id).innerHTML
    document.getElementById("EditDate").value = document.getElementById("date"+id).innerHTML
    document.getElementById("EditLunar").value = document.getElementById("is_lunar"+id).innerHTML
    document.getElementById("EditPreply").value = document.getElementById("is_preply"+id).innerHTML
    document.getElementById("EditEnd").value = document.getElementById("end_date"+id).innerHTML
     document.getElementById("EditStartTime").value = document.getElementById("start_time"+id).innerHTML
    document.getElementById("EditEndTime").value = document.getElementById("end_time"+id).innerHTML
   
    
       
$("#EditInfoModal").modal()
}
</script>

<script type="text/javascript">

  function confirm_remove(ele,id) {
              // ele.preventDefault()
              swal({ 
                title: "",   
                text: " Bạn có chắc muốn xóa tệp tin này ",   
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
                    location.href="vip/vip-file-delete-tag/"+id
                    swal.close(); 
                  } 
                  else {     
                    swal.close();  
                  } 
                });
            }
          </script>
          @endsection