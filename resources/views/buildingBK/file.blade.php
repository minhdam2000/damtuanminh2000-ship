@extends('layouts.index')
@section('content')'


<?php
$boss = 0;
$departs = DB::table("user_department")->where("user_id", Auth()->user()->id)->pluck("department_id")->toArray();
  
  foreach($departs as $depart){
      $mid = DB::table("department")->where("id",$depart)->first()->mid;
      // dd($hid);
      if ($mid < 1) {
          $boss = 1;
          break;
      }
  }
        
?>
<script src="js-css/js/d3.min.js"></script>
<meta name="csrf-token" content="{!! csrf_token() !!}">      
<!-- DataTables -->
<link rel="stylesheet" href="js-css/css/stepprogressbar.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<style>
input[type=checkbox]{

    position: inherit;
}
  /* Popup container - can be anything you want */
      #GoogleContent iframe{

    width: 100%;
    min-height: 400px;
      }



  .content-camera{
    overflow: inherit!important;
  }
  .job-content{
    overflow: inherit!important;

  }
  table{
    border: none;
  }

  table tr{
    border: none;
  }

  .list-group-item{
    background-color:transparent!important;
    text-align: left;
  }
  .fananci-element {
    list-style-type: none;
    width: 100%;
    display: table;
    table-layout: fixed;
  }

  .fananci-list {
    display: table-cell;
    width: 30%;
    font-size: 20px;
  }
  .popup {
    display: none;
    position: absolute;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  /* The actual popup */
  .popup .popuptext {
    width: 160px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 8px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -80px;
  }

  /* Popup arrow */
  .popup .popuptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
  }

  /* Toggle this class - hide and show the popup */
  .popup .show {
    visibility: visible;
    -webkit-animation: fadeIn 1s;
    animation: fadeIn 1s;
  }

  /* Add animation (fade in the popup) */
  @-webkit-keyframes fadeIn {
    from {opacity: 0;} 
    to {opacity: 100;}
  }

  @keyframes fadeIn {
    from {opacity: 0;}
    to {opacity:1 ;}
  }
</style>
<style type="text/css">
  @media(max-width:700px) {
    .icon-td {
       display: none;
    }
    .myname{
      min-width: 40vw!important;
    }
    .mydate{
      min-width: 30vw!important;
    }
}

.myname{
      min-width: 50vw!important;
    }
    .mydate{
      min-width: 10vw!important;
    }
.bg-info{
  min-width: 200px;
}
.mydanger{
  min-width: 200px;
}

@media(max-width:700px) {
.bg-info{
  min-width: 150px;
}
.mydanger{
  min-width: 150px;
}
}

.progress{
    min-height: 30px;
    background-color: transparent;
}
.progress-bar{
    font-size: 15px;
  }


</style>
<style type="text/css">
  
ul {
  list-style: none;
}
.chart-wrapper {
  /*max-width: 1150px;*/
  overflow-x: auto;
  overflow-y: clip;
  padding: 0 10px;
  margin: 0 auto;
}

/* CHART-VALUES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.chart-wrapper .chart-values {
  position: relative;
  display: flex;
  margin-bottom: 20px;
  font-weight: bold;
  font-size: 1.2rem;
}

.chart-wrapper .chart-values li {
  flex: 1;
  min-width: 280px;
  text-align: center;
}

.chart-wrapper .chart-values li:not(:last-child) {
  position: relative;
}

.chart-wrapper .chart-values li:not(:last-child)::before {
  content: '';
  position: absolute;
  right: 0;
  height: 510px;
  border-right: 1px solid var(--divider);
}


/* CHART-BARS
–––––––––––––––––––––––––––––––––––––––––––––––––– */

.chart-bars {
  overflow-y: auto;
  overflow-x: clip;
    max-height: 700px;
    width: max-content;
  }
.chart-wrapper .chart-bars li {
  position: relative;
  color: var(--white);
  margin-bottom: 15px;
  font-size: 16px;
  border-radius: 20px;
  padding: 10px 20px;
  width: 0;
  opacity: 0;
  transition: all 0.65s linear 0.2s;
    word-break: break-word;
}

@media screen and (max-width: 600px) {
  .chart-wrapper .chart-bars li {
    padding: 10px;
  }
}

.fc-content{
  border-radius: 20px;
}


.panel-body { padding:0px; }
.panel-footer .pagination { margin: 0; }
.panel .glyphicon,.list-group-item .glyphicon { margin-right:5px; }
.panel-body .radio, .checkbox { display:inline-block;margin:0px; }
.panel-body input[type=checkbox]:checked + label { text-decoration: line-through;color: rgb(128, 144, 160); }
.list-group-item:hover, a.list-group-item:focus {text-decoration: none;background-color: rgb(245, 245, 245);}
.list-group { margin-bottom:0px; }
</style>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<div class="content-camera">
  <div class="session">
    @if(Session::has('notification'))
    <input hidden="" notifi="{{Session::get('notification')}}" value="1" id="notice_success">
    @endif
    @if(Session::has('warning'))
    <input hidden="" notifi="{{Session::get('warning')}}" value="1" id="notice_warning">
    @endif
  </div>
  <div class="row-content">
           <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content1">Quản lý hợp đồng {{$total_job->name}}</a>
      </li>


    </ul>  


<!-- <div class="arrow-steps clearfix">
          <div class="step current" onclick="viewStep(this)"> <span> Step 1</span> </div>
          <div class="step" onclick="viewStep(this)"> <span>Step 2 some words</span> </div>
          <div class="step" onclick="viewStep(this)"> <span> Step 3</span> </div>
          <div class="step" onclick="viewStep(this)"> <span>Step 4</span> </div>
        </div> -->

         <ul class="nav nav-tabs" id="tabs" role="tablist">

      <li class="nav-item margin_center">
          <a onclick="" id="tabS" class="nav-link color-a"  data-toggle="tab" role="tab" href="#contentGantt">Tổng quan</a>
      </li>
      <li class="nav-item margin_center">
          <a  id="tab1" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content0">Lịch</a>
      </li> 

      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content1">Chi tiết</a>
      </li>
    </ul> 
<hr><br>
        <div class="tab-content">



<?php
// $colors = ["#FFC0CB", "#E6E6FA", "#DDA0DD", "#FFA07A", "#FFA500", " #FFFACD", "#ADFF2F", "#98FB98", "#8FBC8F", "#AFEEEE", "#B0C4DE", "#F5DEB3", "#A9A9A9", "#FFE4E1", "#F4A460"];


$colors = ["#FF1493", "#9932CC",  "#00FF00", "#FFA500", "#008B8B", "#4682B4", "#ccccf0", "#778899", "rgb(137,207,240)", "pink", "#DA70D6", "#FF8C00", "#CD5C5C", "#DDA0DD"];

$colorsSel = [0,0,0,0,0,0,0,0,0,0,0,0,0,0];
$colorsTask = [0,0,0,0,0,0,0,0,0,0,0,0,0,0];


?>

<div class="tab-content">
  
  <div id="contentGantt" class="tab-pane active in bigtab">
  
<div class="chart-wrapper">
  <ul class="chart-values">
    <?php
      $end_index = 0;
      $curMonth = $smonth;
      $curYear = $syear;

      while(1 > 0){
        $end_index = $end_index +1;
        echo '<li onclick="linkDate('."'".$curYear."-".$curMonth.'-01'."'".')">'.$curMonth."/".$curYear."</li>";
        $curMonth = $curMonth + 1;
        if($curMonth == 13){
          $curMonth = 1;
          $curYear = $curYear + 1;
        }

        if($curYear == $eyear && $curMonth == $emonth){
          break;
        }

      }

        echo '<li onclick="linkDate("'.$eyear."-".$curMonth.'-01")">'.$curMonth."/".$eyear."</li>";
    ?>
      
  </ul>
  <ul class="chart-bars">
    <?php
      $scount = 1;
    ?>
    @foreach($building as $built)

  <?php
$timestamp1 = strtotime($start);
$timestamp2 = strtotime($built->start);
$startMonth = intval(($timestamp2 - $timestamp1)/(60*60*24*30));
$startMonthGap =  ($timestamp2 - $timestamp1)/(60*60*24*30) - intval(($timestamp2 - $timestamp1)/(60*60*24*30));


$timestamp1 = strtotime($start);
$timestamp2 = strtotime($built->end);
$endMonth = intval(($timestamp2 - $timestamp1)/(60*60*24*30));
$endMonthGap =  ($timestamp2 - $timestamp1)/(60*60*24*30) - intval(($timestamp2 - $timestamp1)/(60*60*24*30));

$count = $built->id % count($colors);
while($colorsTask[$count] == 1){
  $count = $count + 1;

  if($count == count($colors) ){
    $count = 0;
  }
}
$colorsTask[$count] =1;



?>

    <li data-duration="<?=$startMonth?>-<?=$endMonth?>" data-color="<?=$colors[$count]?>" onclick="builtDetail({{$built->id}})">
      @if($startMonth != $endMonth)
      {{$built->title}}
      @endif

      <span id="startMonth{{$scount}}" style="display:none">{{round($startMonthGap,2)}}</span>
      <span id="endMonth{{$scount}}" style="display:none">{{round($endMonthGap,2)}}</span>
    </li>
<?php
$scount  = $scount  + 1;

?>
       @endforeach

    
    <li data-duration="0-{{$end_index+1}}"  data-color="white">123</li>

      <span id="startMonth{{$scount}}" style="display:none">0/span>
      <span id="endMonth{{$scount}}" style="display:none">0</span>
  </ul>


<div class="row">
    @foreach($building as $built)

    <div class="col-md-4 col-12">

            <div class="panel panel-primary">
                <div class="panel-heading">

                    <span class="glyphicon glyphicon-list"></span>
      <h4>{{$built->title}}</h4>
         </div>

                <div class="panel-body">
                    <div class="list-group" id="GoogleContent">

               <iframe src="/chatify/build/{{$built->id}}"></iframe>
        </div>
      </div>
    </div>
        <br>


    </div>
    @endforeach
  </div>
</div>


  </div>
  <div id="content0" class="tab-pane  in bigtab" >
<br><hr><br>
<div class="row" style="margin-left: 2%;">
      <div class="col-md-2 col-12" id="PcSel">
        <br>
        <hr>
        <h4 id="JobList" onclick="DisplayJob()">Danh sách công việc</h4>
        <br>
        <ul id="jobSelect" style="max-height:300px;overflow: auto;">

 @foreach($building as $built)

  <?php
$count = $built->id % count($colors);
while($colorsSel[$count] == 1){
  $count = $count + 1;

  if($count == count($colors) ){
    $count = 0;
  }
}
$colorsSel[$count] =1;



?>


       <li title="{{$built->title}}" data-placement="top" data-trigger="hover" data-toggle="popover" data-html="true"  style="color:<?=$colors[$count]?>"><input id="Sel{{$built->id}}" name="selector[]" class="form-check-input" onclick="CbChange({{$built->id}})" type="checkbox" value="{{$built->id}}" />  

        @if(strlen($built->title) > 15)

        <span onmouseenter="fulltext({{$built->id}})" onmouseleave="shorttext({{$built->id}})" id="text{{$built->id}}"> 
        {{substr($built->title,0,14)}}..
        @else

        <span id="text{{$built->id}}"> 
        {{$built->title}}
        @endif
      </span>


        <span style="display: none" id="color{{$built->id}}"><?=$colors[$count]?></span>

        <span style="display: none" id="longtext{{$built->id}}"> 
        {{$built->title}}
        </span>

        @if(strlen($built->title) > 15)

   <span style="display: none" id="shorttext{{$built->id}}"> 
         {{substr($built->title,0,15)}}..
        </span>
         @else
<span style="display: none" id="shorttext{{$built->id}}"> 
        {{$built->title}}
        </span>

        @endif



        </li>
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
<!-- <input name="selector[]" id="ad_Checkbox2" class="ads_Checkbox" type="checkbox" value="98" />92<br>
<input name="selector[]" id="ad_Checkbox3" class="ads_Checkbox" type="checkbox" value="1" />1<br>
<input name="selector[]" id="ad_Checkbox4" class="ads_Checkbox" type="checkbox" value="2" />2<br>
 -->

    </div>

          <div id="content1" class="tab-pane  in bigtab">

<br>

<button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-step">Thêm hạng mục</button>

<br>
<table id="example" class="nvr-table">
<thead>
                    <tr class="thead">
                        <th style="width: 40%">Tên công việc </th>
                        <th style="width: 15%;text-align: center;">Bắt đầu</th>
                        <th style="width: 15%;text-align: center;">Kết thúc</th>
                        <th style="width: 15%;text-align: center;">Thời gian (Ngày)</th>
                        <th> </th>
                      </tr>
                    </thead>

              </table>
 @foreach($building as $built)
 <li class="submenu list-group-item">
  <table id="inner-table{{$built->id}}" class="nvr-table " onclick="ToggleTable(this)">

<thead >
<tr class="thead">
<th style="width: 40%">
  
  <h5 >
@if($built->real_percent == 100)
<i style="color:green" class="fa fa-star" aria-hidden="true">
</i> <span id="subtabsmenu{{$built->id}}" style="color:green"><a target="_blank" href="/chatify/build/{{$built->id}}"><span id="stt{{$built->id}}" >{{$built->stt}}</span>. <span id="legalTitle{{$built->id}}" >{{$built->title}}</span></a></span>
@else
<i style="color:red" class="fa fa-star" aria-hidden="true">
</i> <span id="subtabsmenu{{$built->id}}" style="color:red"><a target="_blank" href="/chatify/build/{{$built->id}}"><span id="stt{{$built->id}}" >{{$built->stt}}</span>. <span id="legalTitle{{$built->id}}" >{{$built->title}}</span></a></span>
@endif

</h5>


</th>
<th style="width: 15%;text-align: center;" id="start{{$built->id}}">{{$built->start}}</th>

<th style="width: 15%;text-align: center;" id="end{{$built->id}}">{{$built->end}}</th>


<th style="width: 15%;text-align: center;" id="duration{{$built->id}}">{{$built->duration}} 
</th>



<th>

 <button style="color: white"  type="button" class="btn btn-del Disable">
                             <a href="/building/delete-step/{{$built->id}}" > <span class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span></a>      </button>

 <span id="EditBtn{{$built->id}}"><button style="color: white"  type="button" onclick="Edit({{$built->id}})"> <span class="preview"><img src="/js-css/img/icon/notepad.png"></span></button></span>

<button style="color: white"  type="button" onclick="BuiltAdd({{$built->id}})" class="btn btn-del Disable">
                             <span class="preview"><img src="/js-css/img/icon/plus.png"></span></button>
<!--                            
 <button style="color: white"  type="button" class="btn btn-del Disable">
                             <a href="/legal/change-status/{{$built->id}}" > <span class="preview"><img src="/js-css/img/icon/refresh.png"></span></a>      </button> -->

</th></tr>
</thead>
</table>

<div  id="subContent{{$built->id}}" style="display:none"><ul class="ul_submenu fananci-element"> <table id="inner-table" class="nvr-table ">

</table></ul>
</div>
</li>
@endforeach

          </div>

          </div>



</div>
</div>
<div class="popup" id="popup">
  <div class="popuptext" id="myPopup">

  </div>
</div>

<!-- Modal -->

<div class="modal fade modol-text" id="new-step" role="dialog">
          <div class="modal-dialog model-right" style="min-width: 100%;height: auto">
            <!-- Modal content-->
            <div class="modal-content" >
              <div class="modal-header">
                  <label>Thêm hạng mục</label>
              </div>
              <div class="notification"></div>
               <form id="uploadfile" action="bullding/add-step"  enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">  
                <input type="hidden" name="id" value="{{$id}}">  
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                             
                           <tr>
                                <td style="width: 15%" class="cam-properties">Tên: </td>
                                <td>
                                <input class="input-edit modol-text"  name="title" value="">
                           
                          </tr>
                              <tr>
                                <td class="cam-properties">Thời gian (ngày)</td>
                                 <td>
                                 
<input class="input-edit modol-text"  name="duration" value="">
                                 </td>

                            </tr>

                            <tr>
                            <td  class="cam-properties"><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian bắt đầu </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="start" id="new_start_date" required=""></td>
                        </tr>
                         <tr>
                            <td  class="cam-properties"><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian kết thúc </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="end" id="new_end_date"></td>
                        </tr>

 <tr>
                                <td class="cam-properties">STT: </td>
                                <td>
                                <input class="input-edit modol-text"  name="stt" value="">
                           
                          </tr>

             
                          <tr>
                                <td></td>
                                <td>
                            <button   class="button-77" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Tạo</button>
                <button   type="button" class="button-77" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div><input value = "<?=$id?>" type="hidden" name="id" class="form-control"></form> 
            </div>
          </div>
      </div>


<div class="modal fade modol-text" id="new-substep" role="dialog">
          <div class="modal-dialog model-right" style="min-width: 100%;height: auto">
            <!-- Modal content-->
            <div class="modal-content" >
              <div class="modal-header">
                  <label>Thêm hạng mục</label>
              </div>
              <div class="notification"></div>
               <form id="uploadfile" action="bullding/add-substep"  enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">  
                <input type="hidden" name="id" value="{{$id}}">  
                <input type="hidden" name="root_id" value="{{$id}}" id="insertStepID">  
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                             
                           <tr>
                                <td style="width: 15%" class="cam-properties">Tên: </td>
                                <td>
                                <input class="input-edit modol-text"  name="title" value="">
                           
                          </tr>
                              <tr>
                                <td class="cam-properties">Thời gian (ngày)</td>
                                 <td>
                                 
<input class="input-edit modol-text"  name="duration" value="">
                                 </td>

                            </tr>

                            <tr>
                            <td  class="cam-properties"><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian bắt đầu </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="start" id="new_start_date" required=""></td>
                        </tr>
                         <tr>
                            <td  class="cam-properties"><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian kết thúc </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="end" id="new_end_date" ></td>
                        </tr>

 <tr>
                                <td class="cam-properties">STT: </td>
                                <td>
                                <input class="input-edit modol-text"  name="stt" value="">
                           
                          </tr>


                
                          <tr>
                                <td></td>
                                <td>
                            <button   class="button-77" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Tạo</button>
                <button   type="button" class="button-77" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div><input value = "<?=$id?>" type="hidden" name="id" class="form-control"></form> 
            </div>
          </div>
      </div>



<div class="modal fade modol-text" id="step-detail" role="dialog">
          <div class="modal-dialog model-right" style="min-width: 30%;height: auto">
            <!-- Modal content-->
            <div class="modal-content" >
              <div class="modal-header">
                  <label>Tiến độ</label>
              </div>
              <div class="notification"></div>  
                  <div class="modal-body">
                    <h3 id="GoogleName"></h3>
                    <div id="GoogleContent">
               </div>


                <button   type="button" class="button-77" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>  


                <div style="height: 200px;">
                </div>
                  </div><input value = "<?=$id?>" type="hidden" name="id" class="form-control"></form> 
            </div>
          </div>
      </div>

<input type="hidden"  value="2" id="tempType">    
<input type="hidden"  value="1" id="tempDate">   


<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
</div>
<div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
</div>

<!-- Thay doi cau hinh  -->

<script src="/js-css/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="js-css/js/socket.io.js"></script>

<div class="overlay-dark"></div>
<embed class="img-overlay" id="img-overlay"></embed> 

 <script type="text/javascript">

$('#staffselect').selectpicker({
     noneResultsText: 'Chưa có nhà thầu'
});

    function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }

    $("#search-input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#zone-table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  </script>

  <!-- DataTables -->

 <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>


  <script type="text/javascript">
    $('#cv1').DataTable({
      "order": [[ 1, "desc" ]]
    })
    $('#cv2').DataTable({
      "order": [[ 1, "desc" ]]
    })
    $('#cv').DataTable({
      "order": [[ 1, "desc" ]]
    })
    // $('.dataTables_length').addClass('bs-select');
   

  function downloadURI(uri, name) {
  var link = document.createElement("a");
  link.download = name;
  link.href = uri;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
  delete link;
}

    function  loadFile(name,$src){  
      if (window.innerWidth <  800){
window.open(
  $src,
  '_blank' // <- This is what makes it open in a new window.
);
return 0;
}
      if ($src.includes(".doc")){
        downloadURI($src,name+".docx")
        return
      }else{
      console.log($src)
      $('.img-overlay').attr('src', $src);
      $(".overlay-dark").css('display', 'block');
      $('.img-overlay').css('display', 'block');
      $('.img-overlay').css('opacity', 1);
      $('.img-overlay').css('width', '90%');
      $('.img-overlay').css('height', '90%');
      $('.img-overlay').css('transform', 'translate(-50%, 0) scale(1, 1)');
      console.log("sone")
    }
    }

    $(".overlay-dark").on('click', function() {
      $(".overlay-dark").css('display', 'none');
      $('.img-overlay').css('display', 'none');
      $('.img-overlay').attr('src', "asdf.png");

      $('.img-overlay').attr('src', $('.img-overlay').attr('src'));
      setTimeout(function() {
        $('.img-overlay').css('transform', 'translate(-50%, 0) scale(0, 0)');
      }, 600);
    });

    $("#SystemContent").on("click", "h5", function(e) {
      e.preventDefault();
      $(this).closest("li").find("[class^='ul_submenu']").slideToggle();
    });
   
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
    $(document).ready(function() {
      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }



        var tab_url = getCookie("tab_url");
        var step_url = getCookie("step_url");
        var current_id = getCookie("current_id");
        console.log("begin")

        // if(tab_url != ""){
        //     $(tab_url).click()
        // }


        //     if(step_url != ""){
        //       // alert(current_id)
        //     $(step_url).click()
        //     $(current_id).click()
        //     }
// alert("bgein")


        var SITEURL = "{{url('/')}}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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
            events: SITEURL + "/building/calendar",
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
                $("#new-step").modal();
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
             
            document.getElementById("GoogleContent").innerHTML = 
           '<iframe src="/chatify/build/' + event.id+'"></iframe>'

           $("#step-detail").modal()

            // let a= document.createElement('a');
            // a.target= '_blank';
            // a.href= "/chatify/build/" + event.id
            // a.click();
                  
                }

              
                });





    });

  </script>



<script type="text/javascript">

function linkDate(date){
  // alert("???")
  date = moment(date, "YYYY-MM-DD");
$("#calendar").fullCalendar( 'gotoDate', date );
$("#tab1").click()

$("input[type='checkbox']").prop('checked', true)
CbChange(0)
}
  
  
   function  loadFile(name,$src){
       if (window.innerWidth <  800){
window.open(
  $src,
  '_blank' // <- This is what makes it open in a new window.
);
return 0;
}

      if ($src.includes(".doc")){
        downloadURI($src,name+".docx")
        return
      }else{
      console.log($src)
      $('.img-overlay').attr('src', $src);
      $(".overlay-dark").css('display', 'block');
      $('.img-overlay').css('display', 'block');
      $('.img-overlay').css('opacity', 1);
      $('.img-overlay').css('width', '90%');
      $('.img-overlay').css('height', '90%');
      $('.img-overlay').css('transform', 'translate(-50%, 0) scale(1, 1)');
      console.log("sone")
    }
    }


    $(".overlay-dark").on('click', function() {
      $(".overlay-dark").css('display', 'none');
      $('.img-overlay').css('display', 'none');
      setTimeout(function() {
        $('.img-overlay').css('transform', 'translate(-50%, 0) scale(0, 0)');
      }, 600);
    });


    function openfileupload(){
            document.getElementById("inputfile").click();
    }


 function uploadsubmit(){ 
      swal({
        title: "",
        text: " Bạn có chắc chắc tệp tin tải lên phù hợp ? ",
        type: "info",
        showCancelButton: true,
        confirmButtonText: "Có",
        cancelButtonText: "Không",
        closeOnConfirm: false,
        closeOnCancel: false,
        reverseButtons: true },
        function(isConfirm){
          if (isConfirm)
          {
      document.getElementById("uploadfile").submit();
            swal.close();
          }
          else {
            swal.close();
          }
        });

    }
function  Edit(id){
var start = document.getElementById("start"+id).innerHTML;
var end = document.getElementById("end"+id).innerHTML;
var duration = document.getElementById("duration"+id).innerHTML;

document.getElementById("start"+id).innerHTML = "<input id='startInput"+id+"' type='date' value = '"+start+"'>"
document.getElementById("end"+id).innerHTML = "<input id='endInput"+id+"' type='date' value = '"+end+"'>"
document.getElementById("duration"+id).innerHTML = "<input id='durationInput"+id+"' value = '"+duration+"'>"

document.getElementById("EditBtn"+id).innerHTML = '<button style="color: white"  type="button" onclick="Save('+id+')"> <span class="preview"><img src="/js-css/img/icon/success.png"></span></button>'
}


function Save(id){
  var start = document.getElementById("startInput"+id).value;
  var end = document.getElementById("endInput"+id).value;
  var duration = document.getElementById("durationInput"+id).value;

  var form_data = new FormData(); 
  form_data.append("id", id);
  form_data.append("start", start);
  form_data.append("end", end);
  form_data.append("duration", duration);
  form_data.append("_token", '{{csrf_token()}}');


          document.getElementById("start"+id).innerHTML = start
          document.getElementById("end"+id).innerHTML = end
          document.getElementById("duration"+id).innerHTML = duration
document.getElementById("EditBtn"+id).innerHTML = '<button style="color: white"  type="button" onclick="Edit('+id+')"> <span class="preview"><img src="/js-css/img/icon/notepad.png"></span></button>'

      $.ajax({
      url: "/building/edit-mini",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        start:start,
        end:end,
        duration:duration,
        id:id,
      },
      success:function(response){
        console.log(response);
      }
      });
    
}
function editInputDetail(id){
  console.log(id)
  document.getElementById("editId").value = id
  document.getElementById("editName").value = document.getElementById("iname"+id).innerHTML
$("#new-edge").modal()

}

function editOutputDetail(id){
  document.getElementById("editId").value = id
  document.getElementById("editName").value = document.getElementById("oname"+id).innerHTML

$("#new-edge").modal()

}

function ToggleTable(elmt){
  // console.log("testtt123")
    // console.log(elmt.id)
    if(elmt.id.includes("inner-table")){
      // alert("okoek")
    setCookie("current_id","#"+elmt.id,3600*60)
  }
      $(elmt).next("div").slideToggle();
      var nextEle =  $(elmt).next("div").children();

        // console.log(nextEle.length);
      for (var i = 0; i < nextEle.length; i++) {
        // console.log(nextEle[i].children()[0]);
          $(nextEle[i]).children()[0].click();
      }
}

</script>


  <style type="text/css">
    #staff-table_filter{
      float: right
    }
    .chart-circle {
      text-align: center;
      padding: 20px;
    }

    .chart-circle canvas {
      display: inline; 
      width: 100%; 
      height: auto;
    }

    .chart_ {
      padding: 20px;
      text-align: center;
    }

    .card-header .wrapper {
      background: #2b3c46;
      margin-bottom: 15px;
    }

    .line-col {
      display: inline; width: 100%;
    }



  </style>

  <script type="text/javascript">
    function getSubList(id,index){
      console.log("______________________?????_")
      console.log(index)
      console.log(id)
  $.ajax({
    type: "GET",
    url: 'building/get-sub-as-json/'+id,
    success: function (response) {
      res = (JSON.parse(response))
      response = res
      for(i=0;i<response.length;i++) { 
        myid = i + 1
        var html = ' <div style="margin-left:3%"  id="root'+response[i].id+'"> <table class="root_table" onclick="ToggleTable(this)"><tbody class="tbody">'

        // html = html + '<tr class="color-add"><td>  <input type="checkbox" id="'+response[i].id+'" value="'+response[i].id+'" name="'+response[i].id+'" class="check-box" />  <label for="'+response[i].id+'" class="add-cam"></label></td>'
       
          html = html + '<tr class="color-add">'
        


if(response[i].status > 0){
html =html + '<td style="width: 40%"><a target="_blank" href="/chatify/build/'+response[i].id+'"><i style="color:green" class="fa fa-star" aria-hidden="true"></i> <span id="subtabsmenu'+response[i].id+'" style="color:green">'+index+'.<span id="stt'+response[i].id+'" >'+response[i].stt+'</span>.<span id="legalTitle'+response[i].id+'" >'+response[i].title+'</span></a></span></td>'
}else{
html =html + '<td style="width: 40%"><a target="_blank" href="/chatify/build/'+response[i].id+'"><i style="color:red" class="fa fa-star" aria-hidden="true"></i> <span id="subtabsmenu'+response[i].id+'" style="color:red">'+index+'.<span id="stt'+response[i].id+'" >'+response[i].stt+'</span>.<span id="legalTitle'+response[i].id+'" >'+response[i].title+'</span></a></span></td>'
}

        html = html + "<td style='width: 15%'>"+response[i].real_percent+" %</td>"
        html = html + "<td style='width: 15%'>"+response[i].acceptance_percent+" %</td>"
        html = html + "<td style='width: 15%'>"+response[i].payment_percent+" %</td>"

        html = html + "<td>"



        html = html + ' <button style="color: white"  type="button" class="btn btn-del Disable"><a href="/building/delete-step/'+response[i].id+'" > <span class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span></a></button>'

        html = html + '<button style="color: white"  type="button" onclick="BuiltAdd('+response[i].id+')" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/plus.png"></span></button>'


        html = html + "</td>"
        html = html +'</tr></tbody></table><div style="display:none" id="subContent'+response[i].id+'" class="subContent">'
        // console.log(html)
        document.getElementById("subContent"+id).innerHTML = 
document.getElementById("subContent"+id).innerHTML + html

        getSubList(response[i].id,index+'.'+response[i].stt)

      }

    }
  });
}


@foreach($built_list as $lid)

getSubList({{$lid->id}},{{$lid->stt}})

@endforeach

function BuiltUpdate(id){
  document.getElementById("EditLegalID").value = id;
  document.getElementById("EditLegalTitle").value = document.getElementById("legalTitle"+id).innerHTML;
  document.getElementById("EditLegalStt").value = document.getElementById("stt"+id).innerHTML;

        $("#edit-step").modal()
}

function BuiltAdd(id){
  document.getElementById("insertStepID").value = id;

        $("#new-substep").modal()
}


     $('.job-link').click(function(event){
        //remove all pre-existing active classes
        $('.job-link').css("color", "white");
        $('.job-content').removeClass('active');



        $(this).css("color", "yellow");
        // alert("#"+this.href.split("#")[1]);
        //add the active class to the link we clicked
        $("#"+this.href.split("#")[1]).addClass('active');
    setCookie("step_url","#"+this.id,3600*60)


        // event.preventDefault();
    });

     $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.bigtab').removeClass('active');

        $("#"+this.href.split("#")[1]).addClass('active');


    setCookie("tab_url","#"+this.id,3600*60)


        // alert(this.id)
        if(this.id == "tab2"){
        $('.job-link').css("color", "white");
        $('.job-init').css("color", "yellow");

          $("#job-content1").addClass('active');
        }
    });




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


    function CbChange(id){
        shorttext(id)
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
  function loadCalender(argument) {
   var curSelect = getCookie("sid")
    curSelect = curSelect.split(',');
    // alert(curSelect)
    // alert(curSelect.length)
    if(curSelect != ""){
        for(var i =0; i < curSelect.length; i++){
          // alert(curSelect[i])
        
          fulltext(curSelect[i])
          document.getElementById("Sel"+curSelect[i]).checked = true;
        
      }
  }
}

setTimeout(loadCalender, 1000);


</script>
<script type="text/javascript">
  
  function createChart(e) {
  const days = document.querySelectorAll(".chart-values li");
  const tasks = document.querySelectorAll(".chart-bars li");
  const daysArray = [...days];

  var count = 1
  tasks.forEach(el => {
    const duration = el.dataset.duration.split("-");
    const startDay = duration[0];
    const endDay = duration[1];
    let left = 0,
      width = 0;



      var sgap = parseFloat(document.getElementById("startMonth"+count).innerHTML)

      var egap = parseFloat(document.getElementById("endMonth"+count).innerHTML)
           if(parseInt(startDay) == parseInt(endDay)){
        left = days[startDay];
        width = days[startDay].offsetWidth*egap
      }else{
      left = days[startDay].offsetLeft+ days[startDay].offsetWidth*sgap;
      width = days[endDay-1].offsetLeft+ days[startDay].offsetWidth*(1+egap) - left;
      }
      count = count + 1





    // apply css
    el.style.left = `${left}px`;
    el.style.width = `${width}px`;
    if (e.type == "load") {
      el.style.backgroundColor = el.dataset.color;
      el.style.opacity = 1;
    }
  });
}

window.addEventListener("load", createChart);
window.addEventListener("resize", createChart);

function builtDetail(id){
   document.getElementById("GoogleName").innerHTML = 
   document.getElementById("legalTitle"+id).innerHTML 
   document.getElementById("GoogleContent").innerHTML = 
           '<iframe src="/chatify/build/' + id+'"></iframe>'

           $("#step-detail").modal()
}
</script>

<script src="/js-css/js/bootstrap-select.min.js"></script>
<script src="/js-css/js/ckeditor/ckeditor.js"></script>
  @endsection