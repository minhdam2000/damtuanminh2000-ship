@extends('../layouts/index')
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
.fc-view-container {
    font-size: 1.5em;
}
.fc {
  font-size: 1.5em;
}
  @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
  .modal-body{
    padding :1rem;
  }
  .model-right{ 
    height:auto;
  } 
  .row {
    margin-left: 20px;
  }
  .label-info{
    background-color: red!important;

  }

  .bootstrap-tagsinput{
    width: 100%;
  }
  .label {
    color: white;
    position: inherit;
    display: inline-block;
    padding: .25em .4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1.5;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,
    border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    pointer-events: all;
  }
  .GoogleContent iframe{

    width: 100%;
    min-height: 400px;
  }
  .row-title-proxy{
    margin-left: 0px;
  }
  .fc-row .fc-content-skeleton td, .fc-row .fc-helper-skeleton td {
    border-bottom: inherit;
  }
</style>

<div class="content-camera">
 <div class="header-content">
  <div class="header-content-left">
    <h6></h6>
  </div>
  <div class="header-content-right" style="display: inline;">
    <a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i>  </h6></a>
    <h6 class="display-inline">Danh sách khách hàng vip</h6>
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
<ul class="nav nav-tabs" id="tabs" role="tablist">

 <li class="nav-item margin_center">
  <a id="tab3" class="nav-link color-a" 
  data-toggle="tab" role="tab" href="#content2"> Danh sách khách hàng vip  </a>
</li>
<li class="nav-item margin_center">
  <a id="tab4" class="nav-link color-a" 
  data-toggle="tab" role="tab" href="#content3">Danh Sách Tag</a>
</li>  
<li class="nav-item margin_center">
  <a id="tab5" class="nav-link color-a" 
  data-toggle="tab" role="tab" href="#content1">Lịch</a>
</li> 
</ul> 
<div  class="row row-content">
  <hr><br>
  <div  class="tab-content" style="width: 100%;">

    <div id="content2" class="tab-pane  active in bigtab">
      <ul class="nav nav-tabs" id="tabs" role="tablist">
        <li class="nav-item margin_center">
          <h4 style="margin-top:1rem;">&nbsp; Danh sách khách hàng vip</h4>
        </li>    
      </ul> 
      <br>
      <button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-stepa">Thêm hạng mục</button>
      <br>
      <div class="form-inline">
    <!-- <form action="/vip/import" method="POST" enctype="multipart/form-data" id="inputform">
    {{ csrf_field() }}
    <input style="display: none" id="inputfile" onchange="uploadsubmit()" type="file" name="user_file" class="hidden" accept=".xlsx, .xls, .csv, .ods">
    <button onclick="openfileupload('')" class=" form-control " style="background-color: red;color: white" type="button">Nhập dữ liệu từ Excel</button>
    <button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-url1"> Tìm kiếm</button>
    
  </form> -->



</div>

<div class="proxy-add" id="tai" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>

<ul class="nav nav-tabs" id="tabs" role="tablist">
  <li class="nav-item margin_center">
    <a id="tab0" class="nav-link active color-a"  data-toggle="tab" onclick="ToggleNext()" role="tab" href="#content0">Danh sách vip</a>
  </li> 

</ul>
<?php
// $colors = ["#FFC0CB", "#E6E6FA", "#DDA0DD", "#FFA07A", "#FFA500", " #FFFACD", "#ADFF2F", "#98FB98", "#8FBC8F", "#AFEEEE", "#B0C4DE", "#F5DEB3", "#A9A9A9", "#FFE4E1", "#F4A460"];


$colors = ["#FF1493", "#9932CC",  "#00FF00", "#FFA500", "#008B8B", "#4682B4", "#ccccf0", "#778899", "rgb(137,207,240)", "pink", "#DA70D6", "#FF8C00", "#CD5C5C", "#DDA0DD"];

$colorsSel = [0,0,0,0,0,0,0,0,0,0,0,0,0,0];


?>
<div class="modal fade modol-text" id="new-url1"  role="dialog">
  <div class="modal-dialog model-right" style="width: 50%; ">
    <div class="modal-content">
      <div class="modal-header">
       <label>Tìm kiếm </label>
     </div>
     <div class="notification"></div>
     <input type="hidden" name="_token" value="{{csrf_token()}}">
     <div class="modal-body">
      <table class="table-edit table-model"  style="margin-left: -13%;"  >

        <tbody class="table-edit">
          <div class="modal-body1">
            <tr>
              <td class="cam-properties"><h5>Ngày Tháng</h5></td>
              <td></td>
            </tr>
            <tr>
              <td class="cam-properties">Từ </td>
              <td> <input type="date" class="input-edit modol-text form-control" name="start" id="date1" required=""></td>


              <tr>    
                <td class="cam-properties"> Đến </td>
                <td> <input type="date" class="input-edit modol-text form-control" name="end" id="date2"></td>
              </tr>
            </tr>


            <td class="cam-properties"> Tên khách hàng vip </td>
            <td>
              <input id="search-input" type="text" data-role="" name="" value="" class="form-control tags" placeholder="Search"> 
            </td>        
          </tr>

          <tr>
            <td class="cam-properties"> Describe</td>
            <td>
              <input id="search-input1" type="text" data-role="" name="tags" value="" class="form-control tags" placeholder="Search"> 
            </td>        
          </tr>

          <tr>
            <td class="cam-properties">Tag</td>
            <td>
              <input id="search-input3" type="text" data-role="" name="tags" value="" class="form-control tags" placeholder="Search"> 
            </td>        
          </tr>
        </div>
        <tr>
          <td></td>
          <td >

            <button class="btn btn-model" id ="search-input-btn" data-dismiss="modal">Tìm kiếm </button>
            <button type="button" class="btn btn-model" data-dismiss="modal">Thoát </button>

          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>  

<div class="active-view" id ="cv">
  <table id="camera-table" class="nvr-table">
    <thead>
      <tr class="thead">
        <th>Tên khách hàng vip</th>
        <th>Mô tả</th>
        <th>Đối tượng</th>
        <th>Tag</th>
        <th></th> 
      </tr>
    </thead>
    <tbody class="tbody">
      @foreach($vips as $vip)

      <tr class="color-add">
        <td><a target="_blank" href= "vip/detail/{{$vip->id}}" class="preview"><span  id="name{{$vip->id}}">{{$vip->name}}</span></a></td>
        <td>  <span style="display:none"  id="describe{{$vip->id}}">{{$vip->describe}}</span>
          
          <?php 


            $mystrings = explode("{", $vip->describe);
            $display_string = "";
            $display_target = "";
            foreach($mystrings as $mystr){
              if(strpos($mystr, "}") >-1){
                $temp = explode("}", $mystr);
                $display_target = $display_target.$temp[0].", ";
                $display_string =  $display_string .'<b style="color:red">'. $temp[0].'</b> '
                .$temp[1]
                ;
              }else{
                  $display_string =  $display_string .$mystr;
              }
            }
          ?>
            {!! $display_string !!}
        </td>
        <td>{{$display_target}}</td>
        
        <td><span  style="display:none;"  id="tag{{$vip->id}}"> {{$vip->vip_tag}}</span>

          <span class="mytags" >

            <?php
            $tagArr = explode(",", $vip->vip_tag);
            $display_tag="";
            if($tagArr[0]!=""){
              foreach ($tagArr as $single_tag) {
                $display_tag =   $display_tag.$single_tag;

                foreach($tag_groups_arr as $example_tag){
                  if(strpos($example_tag,";".trim($single_tag)) > -1
                    ||  strpos($example_tag,trim($single_tag).";") > -1){
                    $display_tag = $display_tag."(".$example_tag.")";
                    break;
                  }
                }

                $display_tag = $display_tag.",";
              }
            }
            $display_tag = substr($display_tag, 0, -1);
            ?>
            {{$display_tag}}
          </span>
        </td>
        <td>

          <button style="color: white"  type="button" onclick="updateInfo('{{$vip->id}}')" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/notepad.png"></span></button>



        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

</div>

<div id="content1" class="tab-pane  in">
          <br><hr><br>
          <div class="row" style="margin-left: 1%;">
            <div class="col-md-2 col-12" id="PcSel">
              <br>
              <hr>
              <br>

                 
              <ul id="jobSelect" style="max-height:300px;overflow: auto;">
                @foreach($vips as $event)

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
                <li title="{{$event->name}}" data-placement="top" data-trigger="hover" data-toggle="popover" data-html="true"  style="color:<?=$colors[$count]?>"><input id="Sel{{$event->id}}" name="selector[]" class="form-check-input" onclick="CbChange({{$event->id}})" type="checkbox" value="{{$event->id}}" />  
                  
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
                @endforeach
              </ul>

             
              
            </div>
            <div class="col-md-10 col-12">
              <div id='calendar'></div>
            </div>

            <div class="col-md-1 col-12" id="mobileSel" style="display:none">
            </div>
          </div>
        </div>

<div id="content3" class="tab-pane bigtab fade">
  <div class="row-title-proxy">
    <br>
    <button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-stepa-tag">Thêm danh sách tag</button>
    <input type="hidden" name="_token" value="{{csrf_token()}}">                 
    <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>



  </div>

  <table id="camera-tag-table" class="nvr-table">
    <thead>
      <tr class="thead">  
        <th>Tên</th>
        <th></th>
      </tr>
    </thead>
    <tbody class="tbody">
     @foreach($tags as $tag)
     <tr class="color-add">
      <!-- <td><div><span id="name{{$tag->id}}"> {{$tag->name}}</span></td> -->
        <td><a target="_blank" href= "vip/eventtag/{{$tag->id}}" class="preview"><span  id="name{{$tag->id}}">{{$tag->name}}</span></a></td>
        <td> 
          <button style="color: white"  type="button" onclick="updatetag('{{$tag->id}}')" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/notepad.png"></span></button>


          <a class="sicon" onclick="confirm_tag(this,{{$tag->id}})">
           <span class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span>
         </a>


       </td>
     </tr>
     @endforeach
   </tbody>
 </table>

</div></div>
</div>

<!-- Modal content-->
<div class="modal fade modol-text" id="EditInfoModal" role="dialog">
  <div class="modal-dialog model-right">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label>Chỉnh sửa thông tin khách hàng Vip </label>
      </div>
      <div class="notification"></div>
      <form action="edit-Vip" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="id" value="" id="EditId">
        <div class="modal-body">
          <table class="table-edit table-model">
            <tbody class="table-edit">
              <tr>
                <td class="cam-properties">Tên khách hàng Vip</td>
                <td><input type="" value="" name="name" class="input-edit modol-text" id="editname" required=""></td>

              </tr>

              <tr>
                <td class="cam-properties"> Mô tả </td>
                <td><input value="" type="" class="input-edit modol-text form-control" name="describe" id="editdescribe" required=""></td>
              </tr>



              <tr>
                <td class="cam-properties">Tag: </td>
                <td>
                  <input id="editTag" type="text" data-role="tagsinput" name="tag" value="" class="form-control tags">
                </td>

                <tr>
                  <td class="cam-properties"> </td>
                                <!-- <td>
                                   <a target="_blank" href="/tag-group" class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Quản lý tags &nbsp;&nbsp; </a>
                                 </td> -->
                               </tr>

                             </tr>

                             <tr>
                              <td></td>
                              <td>

                                <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>

                                <button type="button" class="btn btn-model" id="device-removea"><a id="vipDelete">&nbsp; &nbsp; Xóa&nbsp; &nbsp;</a></button>

                                <button style="display: none;" id="remove-credential" type="button">
                                  <a id="EditDelete" href=""></a>
                                </button>


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
              <!-- Modal content-->
              <div class="modal fade modol-text" id="EditTagModal" role="dialog">
                <div class="modal-dialog model-right">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <label>Chỉnh sửa thông tin tag </label>
                    </div>
                    <div class="notification"></div>
                    <form action="update-vip-tag" method="POST">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <input type="hidden" name="id" value="" id="editTagId">
                      <div class="modal-body">
                        <table class="table-edit table-model">
                          <tbody class="table-edit">
                            <tr>
                              <td class="cam-properties">Tên</td>
                              <td><input type="" value="" name="name" class="input-edit modol-text" id="editTagName" required=""></td>

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


              <!-- end model --->
              <div class="modal fade modol-text" id="new-stepa" role="dialog">
                <div class="modal-dialog model-right">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <label>Tạo danh sách Vip</label>
                    </div>
                    <div class="notification"></div>
                    <form action="add-name-vip" method="POST">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <div class="modal-body">
                        <table class="table-edit table-model">
                          <tbody class="table-edit">
                            <tr>
                              <td class="cam-properties">Tên </td>
                              <td><input type="" value="" name="name" class="input-edit modol-text" id="name" required=""></td>
                            </tr>

                            <tr>
                              <td class="cam-properties">Sự kiện </td>
                              <td><input type="" class="input-edit modol-text form-control" name="describe" id="describe" required=""></td>
                            </tr>


                            <tr>
                              <td class="cam-properties">Tag: </td>
                              <td>
                               <input id="newTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">

                             </tr>
                             <tr>
                              <td class="cam-properties"> </td>
                                <!-- <td>
                                   <a target="_blank" href="/tag-group" class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Quản lý tags  &nbsp;&nbsp; </a>
                                 </td> -->
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


                <div class="modal fade modol-text" id="new-stepa-tag" role="dialog">
                  <div class="modal-dialog model-right">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <label>Tạo danh sách vip tag</label>
                      </div>
                      <div class="notification"></div>
                      <form action="add-tag-vip-tag" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="modal-body">
                          <table class="table-edit table-model">
                            <tbody class="table-edit">
                              <tr>
                                <td class="cam-properties">Tên </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text" id="name" required=""></td>
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
  events: SITEURL + "/user/calendar/",
  displayEventTime: true,
  editable: true,
  eventRender: function (event, element, view) {
              // console.log("123123")
              // alert(event.status)
             // console.log((element.parentElement()).html())
             html = $(element).closest('.fc-event-container');
              // console.log(colors.length)
              // alert(event.id)
              // var count = event.id % colors.length
              // alert(count)
              


              if(event.status == 9){
                console.log("lich am")
                element.find('.fc-content').css('background-color', 'rgba(46, 138, 138, 0.2)');
                 html = event.title+" (Lịch âm)"
              }
              else if(event.status == 3){
                element.find('.fc-content').css('background-color', 'red');
                 html = event.title+" (Lịch âm)"
              }
              else{
                var mycolor = document.getElementById("color"+event.vip_id).innerHTML;
                element.find('.fc-content').css('background-color', mycolor);
 if(event.start_time){
                  html = String(event.start_time).substring(0, event.start_time.length - 3)+ " " + event.title;
                }else{
                  html = event.title
                }
              }
              

              // html = event.title
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
              // $("#EditInfoModal")  .modal()
              updateInfo(event.id)


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
<script type="text/javascript">

 $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.bigtab').removeClass('active');

        $("#"+this.href.split("#")[1]).addClass('active');


      });

 $(document).ready(function() {
  if($("#notice_warning").val() == 1){
    notifiWarning($("#notice_warning").attr("notifi"));
  }
  if($("#notice_success").val() == 1){
    notifiSuccess($("#notice_success").attr("notifi"));
  }
});
</script>
<script>

  function confirm_remove() {
    var remove = document.getElementById('device-removea');
    remove.addEventListener('click', function(e){
      swal({
        title: "",
        text: " Bạn có muốn xóa không? ",
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
            document.getElementById("EditDelete").click();
            swal.close();
          }
          else {
            swal.close();
          }
        });
    });
  }
  confirm_remove();

  function removeFile(id) {
    console.log("Okoekqr");
    swal({
      title: "",
      text: " Bạn có muốn xóa tệp này không?1 ",
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
          location.href  = "/delete-vip/"+id
          swal.close();
        }
        else {
          swal.close();
        }
      });
  }
</script>
<script type="text/javascript">

  function confirm_tag(ele,id) {
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
                    location.href="vip/vip-tag-delete/"+id
                    swal.close(); 
                  } 
                  else {     
                    swal.close();  
                  } 
                });
            }
          </script>


 <link rel="stylesheet" href="/js/taginputs/bootstrap-tagsinput.css"  />

    <script src="/js/taginputs/bootstrap.min.js" ></script>
    <script src="/js/taginputs/bootstrap-tagsinput.js"></script>
    <script src="/js/taginputs/bootstrap-tagsinput-angular.min.js"></script>
    
          <script src="/js-css/js/bootstrap-select.min.js"></script>
          <script src="/js-css/js/ckeditor/ckeditor.js"></script>
          <script type="text/javascript">

            function updatetag(id){

              document.getElementById("editTagId").value = id
              document.getElementById("editTagName").value = document.getElementById("name"+id).innerHTML
              $("#EditTagModal").modal()
            }
            function updateInfo(id){
              document.getElementById("EditId").value = id

              document.getElementById("editname").value = document.getElementById("name"+id).innerHTML

              document.getElementById("editdescribe").value = document.getElementById("describe"+id).innerHTML

              $("#editTag").tagsinput('removeAll');
              var rawhtml = $("#tag"+id).html();
              if (rawhtml.length > 1){
               rawhtml = rawhtml.split(',');
               for (var i = 0; i < rawhtml.length;i++){
                $('#editTag').tagsinput('add', rawhtml[i]);
              }
            }
            document.getElementById("EditDelete").href = "/delete-vip/" + id 

            $("#EditInfoModal").modal()




            function openfileupload(id){
              document.getElementById("inputfile"+id).click();
            }

            function  Edit(id){
              document.getElementById("editId").value = id
              document.getElementById("editName").value = document.getElementById("name"+id).innerHTML
              $("#EditInfoModal").modal()

            }  


          }
        </script>
        <!-- DataTables -->
        <script src="js-css/datatables/jquery.dataTables.js"></script>
        <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
        <script type="text/javascript">



          $('#camera-tag-table').DataTable()


          $('#camera-table').DataTable({
            "order": [[ 0, "desc" ]],
            "drawCallback": function( settings ) { 
              $('.mytags').each(function(){
               var rawhtml = $(this).html();
               console.log("13123")
               console.log(rawhtml)
               if (rawhtml.length > 1 && rawhtml.includes("bootstrap-tagsinput") == false){
                 rawhtml = rawhtml.split(',');

                 html = '<div class="bootstrap-tagsinput">'
                 for (var i = 0; i < rawhtml.length;i++){
                  html = html + '<span class="tag label label-info" style="display: inline-block;">'+rawhtml[i]+'</span>'
                }
                html = html + "</div>"
                $(this).html(html)
              }
            });

            }
          });

          function formatForId(id){
            var value = document.getElementById(id+"_display").value
            value = parseFloat(value.replace(/,/g, ""))
            .toFixed(0)
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            console.log(value)
            console.log(value.replace(/,/g, ""))
            if (isNaN(parseInt(value))){
              if(id.includes("1")){
                document.getElementById(id+"_display").value = 0
              }else{
                document.getElementById(id+"_display").value = "Không giới hạn"

              }
              document.getElementById(id).value = -1 
            }else{
              document.getElementById(id+"_display").value = value

              document.getElementById(id).value = value.replace(/,/g, "") 
            }
          }

        </script>
        <script type="text/javascript">
          $("#search-input-btn").on("click", function() {

      // getZone()

      var value = $("#search-input").val().toLowerCase();
      var targetValue = $("#search-input1").val().toLowerCase();
      var typeValue = $("#search-input2").val().toLowerCase();
      var noteValue = $("#search-input3").val().toLowerCase();
      var tagsValue = $("#search-type").val().toLowerCase();



      priceUnitMin = $("#search-input-unit-price1").val()
      priceUnitMax = $("#search-input-unit-price2").val()

      document.getElementById("camera-table-old").style.display="block"
      document.getElementById("camera-table-old").classList.add("d-md-table");
      document.getElementById("camera-table").style.display="none"
      document.getElementById("tai1").style.display="block"
      document.getElementById("cv").style.display="none"
      document.getElementById("tai").style.display="none"
      $("#camera-table-old tbody tr").filter(function() {

        var content =  ($(this)[0].childNodes[1].innerHTML)
        // console.log(priceUnitMax)
        // console.log(priceUnitMin)
        var target =  ($(this)[0].childNodes[3].innerHTML)
        var unit_price =  parseInt(($(this)[0].childNodes[5].childNodes[1].nodeValue).replaceAll(',', ''))

        var type =  ($(this)[0].childNodes[7].innerText)
        var note =  ($(this)[0].childNodes[9].innerText)
        var date =  ($(this)[0].childNodes[11].innerText)
        var tags =  ($(this)[0].childNodes[13].innerText)
        $(this).toggle(
          (content.toLowerCase().indexOf(value) > -1 ||
            target.toLowerCase().indexOf(value) > -1||
            note.toLowerCase().indexOf(value) > -1||
            tags.toLowerCase().indexOf(value) > -1
            || (typeValue == -1))
          && (unit_price < priceUnitMax  || priceUnitMax == -1)
          && (unit_price > priceUnitMin || priceUnitMin == -1)


          )

      });
      

    });

          $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });

// document.getElementById("close-menu-btn").onclick = function() {getZone()};

function ToggleNext(){
  $("#new-url1").slideToggle();
  
}

</script>
@endsection
