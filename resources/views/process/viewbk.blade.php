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

<style type="text/css">
  table.dataTable>thead .sorting,table.dataTable>thead .sorting_asc,table.dataTable>thead .sorting_desc,table.dataTable>thead .sorting_asc_disabled,table.dataTable>thead .sorting_desc_disabled{cursor:pointer;position:relative}table.dataTable>thead .sorting:before,table.dataTable>thead .sorting:after,table.dataTable>thead .sorting_asc:before,table.dataTable>thead .sorting_asc:after,table.dataTable>thead .sorting_desc:before,table.dataTable>thead .sorting_desc:after,table.dataTable>thead .sorting_asc_disabled:before,table.dataTable>thead .sorting_asc_disabled:after,table.dataTable>thead .sorting_desc_disabled:before,table.dataTable>thead .sorting_desc_disabled:after{position:absolute;bottom:.9em;display:block;opacity:.3}table.dataTable>thead .sorting:before,table.dataTable>thead .sorting_asc:before,table.dataTable>thead .sorting_desc:before,table.dataTable>thead .sorting_asc_disabled:before,table.dataTable>thead .sorting_desc_disabled:before{right:1em;content:"↑"}table.dataTable>thead .sorting:after,table.dataTable>thead .sorting_asc:after,table.dataTable>thead .sorting_desc:after,table.dataTable>thead .sorting_asc_disabled:after,table.dataTable>thead .sorting_desc_disabled:after{right:.5em;content:"↓"}table.dataTable>thead .sorting_asc:before,table.dataTable>thead .sorting_desc:after{opacity:1}table.dataTable>thead .sorting_asc_disabled:before,table.dataTable>thead .sorting_desc_disabled:after{opacity:0}div.dataTables_scrollHead table.dataTable{margin-bottom:0 !important}div.dataTables_scrollBody>table{border-top:none;margin-top:0 !important;margin-bottom:0 !important}div.dataTables_scrollBody>table>thead .sorting:before,div.dataTables_scrollBody>table>thead .sorting_asc:before,div.dataTables_scrollBody>table>thead .sorting_desc:before,div.dataTables_scrollBody>table>thead .sorting:after,div.dataTables_scrollBody>table>thead .sorting_asc:after,div.dataTables_scrollBody>table>thead .sorting_desc:after{display:none}div.dataTables_scrollBody>table>tbody tr:first-child th,div.dataTables_scrollBody>table>tbody tr:first-child td{border-top:none}div.dataTables_scrollFoot>.dataTables_scrollFootInner{box-sizing:content-box}div.dataTables_scrollFoot>.dataTables_scrollFootInner>table{margin-top:0 !important;border-top:none}@media screen and (max-width: 767px){div.dataTables_wrapper div.dataTables_length,div.dataTables_wrapper div.dataTables_filter,div.dataTables_wrapper div.dataTables_info,div.dataTables_wrapper div.dataTables_paginate{text-align:center}div.dataTables_wrapper div.dataTables_paginate ul.pagination{justify-content:center !important}}table.dataTable.table-sm>thead>tr>th:not(.sorting_disabled){padding-right:20px}table.dataTable.table-sm .sorting:before,table.dataTable.table-sm .sorting_asc:before,table.dataTable.table-sm .sorting_desc:before{top:5px;right:.85em}table.dataTable.table-sm .sorting:after,table.dataTable.table-sm .sorting_asc:after,table.dataTable.table-sm .sorting_desc:after{top:5px}table.table-bordered.dataTable{border-right-width:0}table.table-bordered.dataTable th,table.table-bordered.dataTable td{border-left-width:0}table.table-bordered.dataTable th:last-child,table.table-bordered.dataTable th:last-child,table.table-bordered.dataTable td:last-child,table.table-bordered.dataTable td:last-child{border-right-width:1px}table.table-bordered.dataTable tbody th,table.table-bordered.dataTable tbody td{border-bottom-width:0}div.dataTables_scrollHead table.table-bordered{border-bottom-width:0}div.table-responsive>div.dataTables_wrapper>div.row{margin:0}div.table-responsive>div.dataTables_wrapper>div.row>div[class^=col-]:first-child{padding-left:0}div.table-responsive>div.dataTables_wrapper>div.row>div[class^=col-]:last-child{padding-right:0}</style>


 <link rel="stylesheet" href="/js/taginputs/bootstrap-tagsinput.css"  />

    <script src="/js/taginputs/bootstrap.min.js" ></script>
    <script src="/js/taginputs/bootstrap-tagsinput.js"></script>
    <script src="/js/taginputs/bootstrap-tagsinput-angular.min.js"></script>

<script src="js-css/js/d3.min.js"></script>
<meta name="csrf-token" content="{!! csrf_token() !!}">      
<!-- DataTables -->
<link rel="stylesheet" href="js-css/css/stepprogressbar.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
  /* Popup container - can be anything you want */

      .label-info{
            background-color: red!important;

        }
        .bootstrap-tagsinput{
          width: 100%;
        }
        .label {
          position: inherit;

            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,
            border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    pointer-events: all;
        }

  .header-name{
    width:60%
  }

.header-addon{
    width:40%
  }
.col-sender{
  width: 20%;
}


@media(max-width:700px) {
  .header-name{
    width:100%
  }

.header-addon{
    display: none;
  }

  .col-sender{
    width: 40%;
  }


.addon{
    display: none;
  }


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
      width: 60%;
    }


    .myHeaderTags{
      width: 30%;
    }

    .mydate{
      width: 0%;
    }
}

.myname{
      width: 50%;
    }

     .myHeaderTags{
      width: 30%;
    }


    .mydate{
      width: 20%;
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
  <div class="row-content">
    <h2>{{$process->name}}</h2>
           <ul class="nav nav-tabs" id="tabs" role="tablist">
     
     <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content2"> Công văn đến </a>
      </li>
     <li class="nav-item margin_center">
          <a id="tab4" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content3"> Công văn đi</a>
      </li>
      @if($process->project_id > 0)
      <li class="nav-item margin_center">
           <a id="tab5" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content4">Hồ sơ pháp lý</a>
      </li>

       <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content1">Khung pháp lý</a>
      </li>
      

  <!--      <li class="nav-item margin_center">
          <a id="tab4" class="nav-link color-a"href="/storage/final/{{$process->id}}.pdf" download > Hồ sơ pháp lý</a>
      </li>
       -->
      @endif
    
    </ul>  


<!-- <div class="arrow-steps clearfix">
          <div class="step current" onclick="viewStep(this)"> <span> Step 1</span> </div>
          <div class="step" onclick="viewStep(this)"> <span>Step 2 some words</span> </div>
          <div class="step" onclick="viewStep(this)"> <span> Step 3</span> </div>
          <div class="step" onclick="viewStep(this)"> <span>Step 4</span> </div>
        </div> -->
<hr><br>
        <div class="tab-content">

          <div id="content1" class="tab-pane  fade bigtab">


<div class="arrow-steps clearfix" id="">
  <a class="myprocess step job-link job-init" id="p1"  data-toggle="tab" role="tab" href="#job-content1" style="color: yellow;"> <span>CHUẨN BỊ ĐẦU TƯ</span></a>
  <a class="myprocess step job-link" id="p2"  data-toggle="tab" role="tab" href="#job-content2" style="color: white;">
 <span>ĐẦU TƯ</span></a>
 <a class="myprocess step job-link" id="p3"  data-toggle="tab" role="tab" href="#job-content3" style="color: white;"> <span>KẾT THÚC VÀ BÀN GIAO</span></a></div>
<br>

  <!-- <ul  style="margin-top: 3%;" class="nav nav-tabs nav-justified" id="processtabs" role="tablist">


  </ul>  -->

  <hr>
<button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-step" onclick="newBigStep()">Thêm bước mới</button>
  <div class="tab-content">

          <div id="job-content1" class="tab-pane job-content in active">

            
            <div class="w3-light-grey"><div class="w3-container w3-green w3-center" id="ProgressBar" style="width: {{$legal1_percent}}%;">{{$legal1_percent}}%</div></div>

              
 @foreach($legal1 as $legal)
 <li class="submenu list-group-item">
  <table id="inner-table{{$legal->id}}" class="nvr-table " onclick="ToggleTable(this)">

<thead >
<tr class="thead">
<th class="header-name">
  
  <h5 >
@if($legal->status)
<i style="color:green" class="fa fa-star" aria-hidden="true">
</i> <span id="subtabsmenu{{$legal->id}}" style="color:green"><a ondblclick="BigLinkFun({{$legal->id}})" target="_blank"  id="BigLink{{$legal->id}}" ><span id="stt{{$legal->id}}" >{{$legal->stt}}</span>. <span id="legalTitle{{$legal->id}}" >{{$legal->title}}</span></a></span>
@else
<i style="color:red" class="fa fa-star" aria-hidden="true">
</i> <span id="subtabsmenu{{$legal->id}}" style="color:red"><a ondblclick="BigLinkFun({{$legal->id}})" target="_blank"  id="BigLink{{$legal->id}}" ><span id="stt{{$legal->id}}" >{{$legal->stt}}</span>. <span id="legalTitle{{$legal->id}}" >{{$legal->title}}</span></a></span>
@endif

</h5>


</th>
<th class="header-addon">
  @if($boss > 0)
  <span id="sender{{$legal->id}}" style="display:none">{{$legal->sender}}</span>
   <button style="color: white"  type="button" onclick="LegalUpdate({{$legal->id}})" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/notepad.png"></span></button>   

 <button style="color: white"  type="button" class="btn btn-del Disable" onclick="removeStep({{$legal->id}})"><span class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span>      </button>

<button style="color: white"  type="button" onclick="LegalAdd({{$legal->id}})" class="btn btn-del Disable">
                             <span class="preview"><img src="/js-css/img/icon/plus.png"></span><</button>
                           
 <button style="color: white"  type="button" class="btn btn-del Disable">
                             <a href="/legal/change-status/{{$legal->id}}" > <span class="preview"><img src="/js-css/img/icon/refresh.png"></span></a>      </button>

  @endif
</th></tr>
</thead>
</table>

<div  id="subContent{{$legal->id}}" style="display:none"><ul class="ul_submenu fananci-element"> <table id="inner-table" class="nvr-table ">
<thead>
<tr class="thead">
<th style="width: 60%">Yêu cầu</th>
<th class="col-sender">Đơn vị thực hiện</th>
<th></th>
</tr>
</thead>
</table></ul>
</div>
</li>
@endforeach

          </div>

           <div id="job-content2" class="tab-pane job-content fade">

            
            <div class="w3-light-grey"><div class="w3-container w3-green w3-center" id="ProgressBar" style="width: {{$legal2_percent}}%;">{{$legal2_percent}}%</div></div>

              
 @foreach($legal2 as $legal)
 <li class="submenu list-group-item">
  <table id="inner-table{{$legal->id}}" class="nvr-table " onclick="ToggleTable(this)">

<thead >
<tr class="thead">
<th  class="header-name">
  
  <h5 >
@if($legal->status)
<i style="color:green" class="fa fa-star" aria-hidden="true">
</i><a ondblclick="BigLinkFun({{$legal->id}})" target="_blank"  id="BigLink{{$legal->id}}"><span id="subtabsmenu{{$legal->id}}" style="color:green"><span id="stt{{$legal->id}}" >{{$legal->stt}}</span>. <span id="legalTitle{{$legal->id}}" >{{$legal->title}}</span></span></a>
@else
<i style="color:red" class="fa fa-star" aria-hidden="true">
</i><a target="_blank" ondblclick="BigLinkFun({{$legal->id}})" target="_blank"  id="BigLink{{$legal->id}}"><span id="subtabsmenu{{$legal->id}}" style="color:red"><span id="stt{{$legal->id}}" >{{$legal->stt}}</span>. <span id="legalTitle{{$legal->id}}" >{{$legal->title}}</span></span></a>
@endif

</h5>


</th>
<th class="header-addon">
  @if($boss > 0)
  <span id="sender{{$legal->id}}" style="display:none">{{$legal->sender}}</span>
   <button style="color: white"  type="button" onclick="LegalUpdate({{$legal->id}})" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/notepad.png"></span></button>   

 <button style="color: white"  type="button" class="btn btn-del Disable" onclick="removeStep({{$legal->id}})"><span class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span>      </button>

<button style="color: white"  type="button" onclick="LegalAdd({{$legal->id}})" class="btn btn-del Disable">
                             <span class="preview"><img src="/js-css/img/icon/plus.png"></span><</button>
                           
 <button style="color: white"  type="button" class="btn btn-del Disable">
                             <a href="/legal/change-status/{{$legal->id}}" > <span class="preview"><img src="/js-css/img/icon/refresh.png"></span></a>      </button>

  @endif
</th></tr>
</thead>
</table>

<div  id="subContent{{$legal->id}}" style="display:none"><ul class="ul_submenu fananci-element"> <table id="inner-table" class="nvr-table ">
<thead>
<tr class="thead">
<th style="width: 60%">Yêu cầu</th>
<th  class="col-sender">Đơn vị thực hiện</th>
<th></th>
</tr>
</thead>
</table></ul>
</div>
</li>
@endforeach

          </div>

           <div id="job-content3" class="tab-pane job-content fade">

              
            <div class="w3-light-grey"><div class="w3-container w3-green w3-center" id="ProgressBar" style="width: {{$legal3_percent}}%;">{{$legal3_percent}}%</div></div>
 @foreach($legal3 as $legal)


            

 <li class="submenu list-group-item">
  <table id="inner-table{{$legal->id}}" class="nvr-table " onclick="ToggleTable(this)">

<thead >
<tr class="thead">
<th  class="header-name">
  
  <h5 >
@if($legal->status)
<i style="color:green" class="fa fa-star" aria-hidden="true">
</i><a ondblclick="BigLinkFun({{$legal->id}})" target="_blank"  id="BigLink{{$legal->id}}"> <span id="subtabsmenu{{$legal->id}}" style="color:green"><span id="stt{{$legal->id}}" >{{$legal->stt}}</span>. <span id="legalTitle{{$legal->id}}" >{{$legal->title}}</span></span></a>
@else
<i style="color:red" class="fa fa-star" aria-hidden="true">
</i> <a ondblclick="BigLinkFun({{$legal->id}})" target="_blank"  id="BigLink{{$legal->id}}"><span id="subtabsmenu{{$legal->id}}" style="color:red"><span id="stt{{$legal->id}}" >{{$legal->stt}}</span>. <span id="legalTitle{{$legal->id}}" >{{$legal->title}}</span></span></a>
@endif

</h5>


</th>
<th class="header-addon">
  @if($boss > 0)
  <span id="sender{{$legal->id}}" style="display:none">{{$legal->sender}}</span>
   <button style="color: white"  type="button" onclick="LegalUpdate({{$legal->id}})" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/notepad.png"></span></button>   

 <button style="color: white"  type="button" class="btn btn-del Disable" onclick="removeStep({{$legal->id}})"><span class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span>      </button>

<button style="color: white"  type="button" onclick="LegalAdd({{$legal->id}})" class="btn btn-del Disable">
                             <span class="preview"><img src="/js-css/img/icon/plus.png"></span><</button>
                           
 <button style="color: white"  type="button" class="btn btn-del Disable">
                             <a href="/legal/change-status/{{$legal->id}}" > <span class="preview"><img src="/js-css/img/icon/refresh.png"></span></a>      </button>

  @endif
</th></tr>
</thead>
</table>

<div  id="subContent{{$legal->id}}" style="display:none"><ul class="ul_submenu fananci-element"> <table id="inner-table" class="nvr-table ">
<thead>
<tr class="thead">
<th style="width: 60%">Yêu cầu</th>
<th class="col-sender">Đơn vị thực hiện</th>
<th></th>
</tr>
</thead>
</table></ul>
</div>
</li>
@endforeach

          </div>
        </div>
  <div id="SystemContent">

  </div>
</div>

  <div id="content2" class="tab-pane  active bigtab">
          <div class="active-view" id="menu1">

<button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-url1" onclick="closeFile()">Thêm tệp mới</button>

      <a  class="btn btn-model" target="_blank" href="/tag-group">Quản lý tag</a>

                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="cv1" class="nvr-table">
                  <thead>
                    <tr class="thead">
                            
                        <th class="myname">Đầu mục </th>
                        <th class="myHeaderTags">Tags</th>
                        <th>
                          
                        </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">

                         @foreach($user_cv1 as $form)
                         @if($form->seen < 1)
                        <tr style="background-color:cadetblue" class="color-add">
                          @else
                        <tr class="color-add">

                          @endif

                          <?php

                          if(strpos($form->name,"_")> 0){
                            $date = explode("_",$form->name)[0];
                            $dataArr = explode(".",$date);
                             if(count($dataArr) > 2){
                              $year = $dataArr[0];
                              $month = $dataArr[1];
                              $day = $dataArr[2];

                              if(intval($month) < 10){
                                $month = "0".$month;
                              }

                              if(intval($day) < 10){
                                $day = "0".$day;
                              }
                            }else{
                               $month = 0;
                              $year = 0;
                              $day = 0;
                            }

                          }else{
                            $month = 0;
                            $year = 0;
                            $day = 0;
                          }

                          ?>
                          <td><span style="display: none"><?=$year.".".$month.".".$day?></span><a  target="_blank" href="{{$form->url}}"><span id="iname{{$form->id}}">{{$form->name}}</span> </a></td>
                           <td><span style="display: none"  id="tag{{$form->id}}">{{$form->tags}}</span>
                          <span  style="display: none" id="type{{$form->id}}"> 
                                                      <?php
                                     $tagArr = explode(",", $form->tags);
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
                                  ?> {{$display_tag}}
                                </span>
                            <span class="mytags">{{$form->tags}}</span>

                      
                          <span style="display: none">{{$form->created_at}}
                          <span style="display: none" id="link{{$form->id}}">{{$form->url}}
                            <?php
$old_date_timestamp = strtotime($form->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?> </span>
 
                          </td>
                             

                          <td>
                            
                                 <button style="color: white"  type="button" onclick="editInputDetail('{{$form->id}}')" class="btn btn-del Disable preview" > <img src="/js-css/img/icon/edit.png"> </button>
                          <a href="legal/file-delete/<?=$form->id?>" type="button"  class="preview" > <img src="/js-css/img/icon/recycle_bin.png"> </a>

                          </td>
                       
                        </tr>
                      @endforeach

                      @foreach($cv1 as $form)
                        <tr class="color-add">
                           <?php

                          if(strpos($form->name,"_")> 0){
                            $date = explode("_",$form->name)[0];
                            $dataArr = explode(".",$date);
                            if(count($dataArr) > 2){
                              $year = $dataArr[0];
                              $month = $dataArr[1];
                              $day = $dataArr[2];

                              if(intval($month) < 10){
                                $month = "0".$month;
                              }

                              if(intval($day) < 10){
                                $day = "0".$day;
                              }
                            }else{
                               $month = 0;
                              $year = 0;
                              $day = 0;
                            }

                          }else{
                            $month = 0;
                            $year = 0;
                            $day = 0;
                          }

                          ?>
                          <td><span style="display: none"><?=$year.".".$month.".".$day?></span><a  target="_blank" href="{{$form->url}}"><span id="iname{{$form->id}}">{{$form->name}}</span> </a></td>

<td ><span style="display: none"  id="tag{{$form->id}}"> {{$form->tags}}</span>
                          <span id="type{{$form->id}}">
                           <?php
                                     $tagArr = explode(",", $form->tags);
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
                            <span class="mytags">{{$display_tag}}</span>

                          <span style="display: none">{{$form->created_at}} 
                            <?php
$old_date_timestamp = strtotime($form->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp);
 ?>
 </span>
  <span style="display: none" id="link{{$form->id}}">{{$form->url}}

 
                          </td>
                              

                          <td>
                            
                                 <button style="color: white"  type="button" onclick="editInputDetail('{{$form->id}}')" class="btn btn-del Disable preview" > <img src="/js-css/img/icon/edit.png"> </button>
                          <a href="legal/file-delete/<?=$form->id?>" type="button"  class="preview" > <img src="/js-css/img/icon/recycle_bin.png"> </a>

                          </td>
                       
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
          </div>

            <div id="content3" class="tab-pane  fade bigtab">

         
<button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-url2" onclick="closeFile()">Thêm tệp mới</button>

      <a  class="btn btn-model" target="_blank" href="/tag-group">Quản lý tag</a>

          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="cv2" class="nvr-table">
                  <thead>
                    <tr class="thead">
                            
                        <th class="myname">Đầu mục </th>
                        <th class="myHeaderTags">Tags</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody class="tbody">


                         @foreach($user_cv2 as $form)
                         @if($form->seen < 1)
                        <tr style="background-color:cadetblue" class="color-add">
                          @else
                        <tr class="color-add">

                          @endif
                           <?php

                          if(strpos($form->name,"_")> 0){
                            $date = explode("_",$form->name)[0];
                            $dataArr = explode(".",$date);
                             if(count($dataArr) > 2){
                              $year = $dataArr[0];
                              $month = $dataArr[1];
                              $day = $dataArr[2];

                              if(intval($month) < 10){
                                $month = "0".$month;
                              }

                              if(intval($day) < 10){
                                $day = "0".$day;
                              }
                            }else{
                               $month = 0;
                              $year = 0;
                              $day = 0;
                            }

                          }else{
                            $month = 0;
                            $year = 0;
                            $day = 0;
                          }

                          ?>
                          <td><span style="display: none"><?=$year.".".$month.".".$day?></span><a  target="_blank" href="{{$form->url}}"><span id="oname{{$form->id}}">{{$form->name}}</span> </a></td>


                              <td ><span style="display: none"  id="tag{{$form->id}}"> {{$form->tags}}</span>
                          <span id="type{{$form->id}}"> 
                                                       <?php
                                     $tagArr = explode(",", $form->tags);
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
                            <span class="mytags">{{$display_tag}}</span>

                                  <span style="display: none">{{$form->created_at}} 
                            <?php
$old_date_timestamp = strtotime($form->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp);
 ?>
 </span> <span style="display: none" id="link{{$form->id}}">{{$form->url}}
 
                          </td>



                          <td>
                            
                                 <button style="color: white"  type="button" onclick="editOutputDetail('{{$form->id}}')" class="btn btn-del Disable preview" > <img src="/js-css/img/icon/edit.png"> </button>
                          <a href="legal/file-delete/<?=$form->id?>" type="button"  class="preview" > <img src="/js-css/img/icon/recycle_bin.png"> </a>

                          </td>
                       
                        </tr>
                      @endforeach

                      @foreach($cv2 as $form)
                        <tr class="color-add">
                           <?php

                          if(strpos($form->name,"_")> 0){
                            $date = explode("_",$form->name)[0];
                            $dataArr = explode(".",$date);
                            if(count($dataArr) > 2){
                              $year = $dataArr[0];
                              $month = $dataArr[1];
                              $day = $dataArr[2];

                              if(intval($month) < 10){
                                $month = "0".$month;
                              }

                              if(intval($day) < 10){
                                $day = "0".$day;
                              }
                            }else{
                               $month = 0;
                              $year = 0;
                              $day = 0;
                            }

                          }else{
                            $month = 0;
                            $year = 0;
                            $day = 0;
                          }

                          ?>
                          <td><span style="display: none"><?=$year.".".$month.".".$day?></span><a  target="_blank" href="{{$form->url}}"><span id="oname{{$form->id}}">{{$form->name}}</span></a></td>

                               <td ><span style="display: none"  id="tag{{$form->id}}"> {{$form->tags}}</span>
                          <span id="type{{$form->id}}"> 
                                                       <?php
                                     $tagArr = explode(",", $form->tags);
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
                            <span class="mytags">{{$display_tag}}</span>

          <span style="display: none">{{$form->created_at}} 
                            <?php
$old_date_timestamp = strtotime($form->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp);
 ?>
 </span>
  <span style="display: none" id="link{{$form->id}}">{{$form->url}}
</td>
  

<td>
   <button style="color: white"  type="button" onclick="editOutputDetail('{{$form->id}}')" class="btn btn-del Disable preview" > <img src="/js-css/img/icon/edit.png"> </button>
           <a href="legal/file-delete/<?=$form->id?>" type="button"  class="preview" > <img src="/js-css/img/icon/recycle_bin.png"> </a>


</td>
                       
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
          </div>

          <div id="content4" class="tab-pane  fade bigtab">
    <!--      <div class="active-view" id="menu1">
 
            <div class="form-inline">  <div class="col-5 col-md-3">
  <label for="example-datetime-local-input" class="col-2 col-md-1 col-form-label">Từ </label>

    <input class="form-control" type="date" name="dt1" id="min" value="">
  </div>  <div class="col-5 col-md-3">
  <label for="example-datetime-local-input" class="col-2 col-md-1 col-form-label">Đến </label>

    <input class="form-control" type="date" name="dt2" id="max" value="">

</div>
</div>
 -->

                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="cv" class="nvr-table">
                  <thead>
                    <tr class="thead">
                            
                        <th class="myname">Đầu mục </th>
                        <th class="myHeaderTags">Tags</th>
                        <th>
                          
                        </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($cv1 as $form)
                        <tr class="color-add">
                           <?php

                          if(strpos($form->name,"_")> 0){
                            $date = explode("_",$form->name)[0];
                            $dataArr = explode(".",$date);
                             if(count($dataArr) > 2){
                              $year = $dataArr[0];
                              $month = $dataArr[1];
                              $day = $dataArr[2];

                              if(intval($month) < 10){
                                $month = "0".$month;
                              }

                              if(intval($day) < 10){
                                $day = "0".$day;
                              }
                            }else{
                               $month = 0;
                              $year = 0;
                              $day = 0;
                            }

                          }else{
                            $month = 0;
                            $year = 0;
                            $day = 0;
                          }

                          ?>
                          <td><span style="display: none"><?=$year.".".$month.".".$day?></span><a  target="_blank" href="{{$form->url}}" id="allname{{$form->id}}">{{$form->name}}</a></td>


                          <td ><span style="display: none"  id="tag{{$form->id}}"> {{$form->tags}}</span>
                          <span id="type{{$form->id}}"> 
                                                      <?php
                                     $tagArr = explode(",", $form->tags);
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
                            <span class="mytags">{{$display_tag}}</span>

                                  <span style="display: none">{{$form->created_at}} 
                            <?php
$old_date_timestamp = strtotime($form->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp);
 ?>
 </span>
  <span style="display: none" id="link{{$form->id}}">{{$form->url}}
                          </td>

                          <td>
                            
                                 <button style="color: white"  type="button" onclick="editAllDetail('{{$form->id}}')" class="btn btn-del Disable preview" > <img src="/js-css/img/icon/edit.png"> </button>
                          <a href="legal/file-delete/<?=$form->id?>" type="button"  class="preview" > <img src="/js-css/img/icon/recycle_bin.png"> </a>

                          </td>
                       
                        </tr>
                      @endforeach

                       @foreach($user_cv1 as $form)
                        <tr class="color-add">
                           <?php

                          if(strpos($form->name,"_")> 0){
                            $date = explode("_",$form->name)[0];
                            $dataArr = explode(".",$date);
                             if(count($dataArr) > 2){
                              $year = $dataArr[0];
                              $month = $dataArr[1];
                              $day = $dataArr[2];

                              if(intval($month) < 10){
                                $month = "0".$month;
                              }

                              if(intval($day) < 10){
                                $day = "0".$day;
                              }
                            }else{
                               $month = 0;
                              $year = 0;
                              $day = 0;
                            }

                          }else{
                            $month = 0;
                            $year = 0;
                            $day = 0;
                          }

                          ?>
                          <td><span style="display: none"><?=$year.".".$month.".".$day?></span><a  target="_blank" href="{{$form->url}}" id="allname{{$form->id}}">{{$form->name}}</a></td>


                          <td ><span style="display: none"  id="tag{{$form->id}}"> {{$form->tags}}</span>
                          <span id="type{{$form->id}}"> 
                                                       <?php
                                     $tagArr = explode(",", $form->tags);
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
                            <span class="mytags">{{$display_tag}}</span>
          <span style="display: none">{{$form->created_at}} 
                            <?php
$old_date_timestamp = strtotime($form->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp);
 ?>
 </span>
  <span style="display: none" id="link{{$form->id}}">{{$form->url}}
 
                          </td>

                          <td>
                            
                                 <button style="color: white"  type="button" onclick="editAllDetail('{{$form->id}}')" class="btn btn-del Disable preview" > <img src="/js-css/img/icon/edit.png"> </button>
                          <a href="legal/file-delete/<?=$form->id?>" type="button"  class="preview" > <img src="/js-css/img/icon/recycle_bin.png"> </a>

                          </td>
                       
                        </tr>
                      @endforeach


                        @foreach($cv2 as $form)
                        <tr class="color-add">
                           <?php

                          if(strpos($form->name,"_")> 0){
                            $date = explode("_",$form->name)[0];
                            $dataArr = explode(".",$date);
                            if(count($dataArr) > 2){
                              $year = $dataArr[0];
                              $month = $dataArr[1];
                              $day = $dataArr[2];

                              if(intval($month) < 10){
                                $month = "0".$month;
                              }

                              if(intval($day) < 10){
                                $day = "0".$day;
                              }
                            }else{
                               $month = 0;
                              $year = 0;
                              $day = 0;
                            }
                          }else{
                            $month = 0;
                            $year = 0;
                            $day = 0;
                          }

                          ?>
                          <td><span style="display: none"><?=$year.".".$month.".".$day?></span><a  target="_blank" href="{{$form->url}}" id="allname{{$form->id}}">{{$form->name}}</a></td>

                          <td ><span style="display: none"  id="tag{{$form->id}}"> {{$form->tags}}

                          </span>
                          <span id="type{{$form->id}}"> 
                                                       <?php
                                     $tagArr = explode(",", $form->tags);
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
                            <span class="mytags">{{$display_tag}}</span>

             <span style="display: none">{{$form->created_at}} 
                            <?php
$old_date_timestamp = strtotime($form->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp);
 ?>
 </span> <span style="display: none" id="link{{$form->id}}">{{$form->url}}

</td>
    

<td>
   <button style="color: white"  type="button" onclick="editAllDetail('{{$form->id}}')" class="btn btn-del Disable preview" > <img src="/js-css/img/icon/edit.png"> </button>
           <a href="legal/file-delete/<?=$form->id?>" type="button"  class="preview" > <img src="/js-css/img/icon/recycle_bin.png"> </a>


</td>
                       
                        </tr>
                      @endforeach


                        @foreach($user_cv2 as $form)
                        <tr class="color-add">
                           <?php

                          if(strpos($form->name,"_")> 0){
                            $date = explode("_",$form->name)[0];
                            $dataArr = explode(".",$date);
                            if(count($dataArr) > 2){
                              $year = $dataArr[0];
                              $month = $dataArr[1];
                              $day = $dataArr[2];

                              if(intval($month) < 10){
                                $month = "0".$month;
                              }

                              if(intval($day) < 10){
                                $day = "0".$day;
                              }
                            }else{
                               $month = 0;
                              $year = 0;
                              $day = 0;
                            }

                          }else{
                            $month = 0;
                            $year = 0;
                            $day = 0;
                          }

                          ?>
                          <td><span style="display: none"><?=$year.".".$month.".".$day?></span><a  target="_blank" href="{{$form->url}}" id="allname{{$form->id}}">{{$form->name}}</a></td>

                          <td ><span style="display: none"  id="tag{{$form->id}}"> {{$form->tags}}

                          </span>
                          <span id="type{{$form->id}}"> 
                                                       <?php
                                     $tagArr = explode(",", $form->tags);
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
                            <span class="mytags">{{$display_tag}}</span>
          <span style="display: none">{{$form->created_at}} 
                            <?php
$old_date_timestamp = strtotime($form->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp);
 ?>
 </span>
  <span style="display: none" id="link{{$form->id}}">{{$form->url}}
</td>
    

<td>
   <button style="color: white"  type="button" onclick="editAllDetail('{{$form->id}}')" class="btn btn-del Disable preview" > <img src="/js-css/img/icon/edit.png"> </button>
           <a href="legal/file-delete/<?=$form->id?>" type="button"  class="preview" > <img src="/js-css/img/icon/recycle_bin.png"> </a>


</td>
                       
                        </tr>
                      @endforeach

                    </tbody>
                  </table>


               <button  type="button"  class="btn btn-model"><a href="/legal/merge-all-pdf/{{$index}}" > Tải toàn bộ</a></button>

               <button  type="button"  class="btn btn-model"><a href="/legal/merge-select-pdf/{{$index}}" > Tải theo tìm kiếm</a></button>
             
<!-- 
<button type="button" class="btn btn-model" data-toggle="modal" data-target="#merge-pdf" onclick="mergePDF()">Tải theo ngày</button> -->


<!-- <button type="button" class="btn btn-model" onclick="mergePDF()">Tải theo ngày</button> -->
            </div>
          </div>



</div>
</div>
<div class="popup" id="popup">
  <div class="popuptext" id="myPopup">

  </div>
</div>

<!-- Modal -->


<div class="modal fade modol-text" id="merge-pdf" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
              </div>
              <div class="notification"></div>
                   
            </div>
          </div>
      </div>



<div class="modal fade modol-text" id="edit-step" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Sửa bước</label>
              </div>
              <div class="notification"></div>
               <form id="uploadfile" action="legal/edit-step"  enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">  
                <input type="hidden" name="id" value="0" id="EditLegalID">  
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                             
                           <tr>
                                <td class="cam-properties">Tên: </td>
                                <td>
                                <input class="input-edit modol-text"  name="title" value="" id="EditLegalTitle">
                                <input style="display:none" class="input-edit modol-text"  name="sender" value="" >
                           
                          </tr>
                             
 <tr>
                                <td class="cam-properties">STT: </td>
                                <td>
                                <input class="input-edit modol-text"  name="stt" value="" id="EditLegalStt">
                           
                          </tr>


                          <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoat </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div></form> 
            </div>
          </div>
      </div>
<div class="modal fade modol-text" id="edit-sub-step" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Sửa bước</label>
              </div>
              <div class="notification"></div>
               <form id="uploadfile" action="legal/edit-step"  enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">  
                <input type="hidden" name="id" value="0" id="EditSubLegalID">  
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                             
                           <tr>
                                <td class="cam-properties">Tên: </td>
                                <td>
                                <input class="input-edit modol-text"  name="title" value="" id="EditSubLegalTitle">
                           
                          </tr>  <tr>
                                <td class="cam-properties">Nơi cấp: </td>
                                <td>
                                <input class="input-edit modol-text"  name="sender" value="" id="EditSubLegalSender">
                           
                          </tr>
                             
 <tr>
                                <td class="cam-properties">STT: </td>
                                <td>
                                <input class="input-edit modol-text"  name="stt" value="" id="EditSubLegalStt">
                           
                          </tr>


                          <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoat </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div></form> 
            </div>
          </div>
      </div>


<div class="modal fade modol-text" id="new-step" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm bước</label>
              </div>
              <div class="notification"></div>
               <form id="uploadfile" action="legal/add-step"  enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">  
                <input type="hidden" name="id" value="{{$index}}">  
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                             
                           <tr>
                                <td class="cam-properties">Tên: </td>
                                <td>
                                <input class="input-edit modol-text"  name="title" value="">
                           
                          </tr>
                              <tr>
                                <td class="cam-properties">Bước</td>
                                 <td>
                                  <select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="step" id= "bigStepSel">
                                  <option value="1"> CHUẨN BỊ ĐẦU TƯ </option>
                                  <option value="2"> ĐẦU TƯ </option>
                                  <option value="3"> KẾT THÚC VÀ BÀN GIAO </option>
                                
                                </select></td>

                            </tr>
 <tr>
                                <td class="cam-properties">STT: </td>
                                <td>
                                <input class="input-edit modol-text"  name="stt" value="">
                           
                          </tr>


                          <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoat </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div><input value = "<?=$index?>" type="hidden" name="id" class="form-control"></form> 
            </div>
          </div>
      </div>


<div class="modal fade modol-text" id="new-substep" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm bước</label>
              </div>
              <div class="notification"></div>
               <form id="uploadfile" action="legal/add-substep"  enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">  
                <input type="hidden" name="id" value="" id="insertStepID">  
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                             
                           <tr>
                                <td class="cam-properties">Tên: </td>
                                <td>
                                <input class="input-edit modol-text"  name="title" value="">
                           
                          </tr>

                             <tr>
                                <td class="cam-properties">Nơi cấp </td>
                                <td>
                                <input class="input-edit modol-text"  name="sender" value="">
                           
                          </tr>

                             
 <tr>
                                <td class="cam-properties">STT: </td>
                                <td>
                                <input class="input-edit modol-text"  name="stt" value="">
                           
                          </tr>


                          <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoat </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div></form> 
            </div>
          </div>
      </div>


<div class="modal fade modol-text" id="new-url1" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm tệp</label>
              </div>
              <div class="notification"></div>
               <form id="uploadfile" action="legal/edit-task-file"  enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">  
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                             
                           <tr>
                                <td class="cam-properties">Tên: </td>
                                <td>
                                <input class="input-edit modol-text"  name="title" value="">
                           
                          </tr>

                            <tr>
                                <td class="cam-properties">Tags: </td>
                                <td>
             <input id="newTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">


                           
                          </tr>

                              <tr>
                                <td class="cam-properties">Loại công văn</td>
                                 <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "">
                                  <option value="1"> Công văn đến </option>
                                
                                </select></td>

                            </tr>


                           <tr>
                <td class="cam-properties">Tệp tin  </td>
                  <td><label  class="preview" for="file-input"><img onclick="openfileupload(1)"  src="/js-css/img/icon/upload.png"></label><input  id= "inputfile1" style="display:none" type="file" name="file[]" class="form-control"
                    multiple>
                </td>
              </tr>
<tr>
  <td></td>
  <td>
                <span class="form-group" id="preview-file1"></span>
      </td>         
                          <tr>
                          <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoat </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div><input value = "<?=$index?>" type="hidden" name="id" class="form-control"></form> 
            </div>
          </div>
      </div>

      <div class="modal fade modol-text" id="new-url2" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm tệp</label>
              </div>
              <div class="notification"></div>
               <form id="uploadfile" action="legal/edit-task-file"  enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">  
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                             
                           <tr>
                                <td class="cam-properties">Tên: </td>
                                <td>
                                <input class="input-edit modol-text"  name="title" value="">
                           
                          </tr>

                           <tr>
                                <td class="cam-properties">Tags: </td>
                                <td>
             <input id="newTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">


                           
                          </tr>


                              <tr>
                                <td class="cam-properties">Loại công văn</td>
                                 <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "">
                                  <option value="2"> Công văn đi </option>
                           
                                </select></td>

                            </tr>


                           <tr>
                <td class="cam-properties">Tệp tin </td>
                  <td><label  class="preview" for="file-input"><img onclick="openfileupload(2)"  src="/js-css/img/icon/upload.png"></label><input  id= "inputfile2" style="display:none" type="file" name="file[]" class="form-control"
                    multiple>
                </td>
              </tr>
<tr>
  <td></td>
  <td>
                <span class="form-group" id="preview-file2"></span>
      </td>         
                          <tr>
                          <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoat </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div><input value = "<?=$index?>" type="hidden" name="id" class="form-control"></form> 
            </div>
          </div>
      </div>

   <div class="modal fade modol-text" id="new-edge" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Sửa tệp</label>
              </div>
              <div class="notification"></div>
              <form action="legal/edit-task-file-name" method="POST"  enctype="multipart/form-data"> 
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                             
                           <tr>
                                <td class="cam-properties">Tên: </td>
                                <td>
                                <input class="input-edit modol-text"  name="title" id="editName" value="">
                                <input type="hidden" name="id" id="editId" value=""></td>
                            </tr>
                         
                           <tr>
                                <td class="cam-properties">Tags: </td>
                                <td>
                                <input id="editTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">
                                </td>
                          </tr>

                    

                          <tr>
  <td class="cam-properties">Tải tệp khác  </td>
                  <td><label  class="preview" for="file-input"><img onclick="openfileupload(3)"  src="/js-css/img/icon/upload.png"></label><input  id= "inputfile3" style="display:none" type="file" name="file[]" class="form-control"
                    multiple>
                </td>
                </tr>
                <tr>
  <td></td>
  <td>
                <span class="form-group" id="preview-file3"></span>
      </td>         
                          </tr>

                          <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>

                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoat </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>


     <div class="modal fade" id="infomation" role="dialog">
          <div class="modal-dialog" style="max-width: 1000px;">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label id="partitionTitle"><h3>Cơ sở pháp lý</h3></label>
              </div>
              <div class="notification"></div>
                  <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#InfoContent"> Cơ sở pháp luật  </a>
      </li>
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#proInfoContent">Quy trình tổng quan</a>
      </li>
    
    </ul>  

 <div class="tab-content modal-body">
                  <div id="InfoContent" class="tab-pane  in active">
                  </div>
                  <div id="proInfoContent"  class="tab-pane fade" >
                  </div>
                </div>
            </div>
          </div>
      </div>


  <div class="modal fade modol-text" id="taskModal" role="dialog">
          <div class="modal-dialog model-right" style="max-width: 800px">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Chỉnh sửa yêu cầu </label>
              </div>
              <div class="notification"></div>
              <form action="process/update-task-info" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" id="TaskIdInput" name="id" value="">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                          
                             

                            <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Add &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Cancel</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
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

<script type="text/javascript" src="js-css/js/socket.io.js"></script>

<div class="overlay-dark"></div>
<embed class="img-overlay" id="img-overlay"></embed> 

 <script type="text/javascript">

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
      "order": [[ 0, "desc" ]],
    "drawCallback": function( settings ) { 
      $('.mytags').each(function(){
     var rawhtml = $(this).html();
     if (rawhtml.length > 1 && rawhtml.includes("bootstrap-tagsinput") == false){
     rawhtml = rawhtml.split(',');

     html = '<div class="bootstrap-tagsinput">'
     for (var i = 0; i < rawhtml.length;i++){
      html = html + '<span class="tag label label-info" style="display: inline-block;">'+rawhtml[i]+'</span>'
    }
    html = html + "</div>"
    console.log(html)
      $(this).html(html)
     }
 });
    }
});

    $('#cv2').DataTable({
      "order": [[ 0, "desc" ]],

    "drawCallback": function( settings ) {   $('.mytags').each(function(){

     var rawhtml = $(this).html();
     if (rawhtml.length > 1 && rawhtml.includes("bootstrap-tagsinput") == false){

     rawhtml = rawhtml.split(',');

     html = '<div class="bootstrap-tagsinput">'
     for (var i = 0; i < rawhtml.length;i++){
      html = html + '<span class="tag label label-info" style="display: inline-block;">'+rawhtml[i]+'</span>'
    }
    html = html + "</div>"
    console.log(html)
      $(this).html(html)
       }
 });
    }
});

    var CvTable = $('#cv').DataTable({
      "order": [[ 0, "desc" ]],
    "drawCallback": function( settings ) {   $('.mytags').each(function(){

     var rawhtml = $(this).html();
     if (rawhtml.length > 1 && rawhtml.includes("bootstrap-tagsinput") == false){

     rawhtml = rawhtml.split(',');

     html = '<div class="bootstrap-tagsinput">'
     for (var i = 0; i < rawhtml.length;i++){
      html = html + '<span class="tag label label-info" style="display: inline-block;">'+rawhtml[i]+'</span>'
    }
    html = html + "</div>"
    console.log(html)
      $(this).html(html)
      }
 });
    }
});

$('#cv').on('search.dt', function() {
    var value = $('#cv_filter input').val();
    setCookie("cv_temp",value,3600*60)
}); 



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

        console.log($(current_id))
        // alert(current_id)
        if(tab_url != ""){
            $(tab_url).click()
        }


            if(step_url != ""){
              // alert(current_id)
            $(step_url).click()
            }

            // alert(current_id)
            // id = current_id.split("inner-table")[1]
            // document.getElementById("BigLink"+id).href= "/legal/process-file/"+id
            $(current_id).click()
    });
  </script>



<script type="text/javascript">
  
  
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
  document.getElementById("editId").value = id
  document.getElementById("editName").value = document.getElementById("name"+id).innerHTML



$("#new-edge").modal()

}

function editAllDetail(id){
  console.log(id)
  document.getElementById("editId").value = id

  var url = document.getElementById("link"+id).innerHTML
    var filename = "<a target='_blank' href = '"+url+"' >"+document.getElementById("allname"+id).innerHTML+"</a>"
  document.getElementById("preview-file3").innerHTML = '<p><img width="25" height = "25" src="/js-css/img/file_type/pdf.png"> ' + filename+ " <span style='color:red' onclick='closeEditFile()'>x</span><p>"


  document.getElementById("editName").value = document.getElementById("allname"+id).innerHTML


  $("#editTag").tagsinput('removeAll');
var rawhtml = $("#tag"+id).html();
     if (rawhtml.length > 1){
     rawhtml = rawhtml.split(',');
     for (var i = 0; i < rawhtml.length;i++){
    $('#editTag').tagsinput('add', rawhtml[i]);
    }
  }


$("#new-edge").modal()

}

function editInputDetail(id){
  console.log(id)
  document.getElementById("editId").value = id
  var url = document.getElementById("link"+id).innerHTML  
  var filename = "<a target='_blank' href = '"+url+"' >"+document.getElementById("iname"+id).innerHTML+"</a>"
  document.getElementById("preview-file3").innerHTML = '<p><img width="25" height = "25" src="/js-css/img/file_type/pdf.png"> ' + filename+ " <span style='color:red' onclick='closeEditFile()'>x</span><p>"
  document.getElementById("editName").value = document.getElementById("iname"+id).innerHTML



  $("#editTag").tagsinput('removeAll');
var rawhtml = $("#tag"+id).html();
     if (rawhtml.length > 1){
     rawhtml = rawhtml.split(',');
     for (var i = 0; i < rawhtml.length;i++){
    $('#editTag').tagsinput('add', rawhtml[i]);
    }
  }

$("#new-edge").modal()

}

function editOutputDetail(id){
  document.getElementById("editId").value = id
  var url = document.getElementById("link"+id).innerHTML
  var filename = "<a target='_blank' href = '"+url+"' >"+document.getElementById("oname"+id).innerHTML+"</a>"
  document.getElementById("preview-file3").innerHTML = '<p><img width="25" height = "25" src="/js-css/img/file_type/pdf.png"> ' + filename+ " <span style='color:red' onclick='closeEditFile()'>x</span><p>"
  document.getElementById("editName").value = document.getElementById("oname"+id).innerHTML


  $("#editTag").tagsinput('removeAll');
var rawhtml = $("#tag"+id).html();
     if (rawhtml.length > 1){
     rawhtml = rawhtml.split(',');
     for (var i = 0; i < rawhtml.length;i++){
    $('#editTag').tagsinput('add', rawhtml[i]);
    }
  }


$("#new-edge").modal()

}

function ToggleTable(elmt){
  // console.log("testtt123")
    // console.log(elmt.id)
    if(elmt.id.includes("inner-table")){
      // alert("#"+elmt.id)
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

    function BigLinkFun(id){
 let a= document.createElement('a');
a.target= '_blank';
a.href= "/legal/process-file/" + id
a.click();
}

    function getSubList(id,index){
      // index = index+"abc"
      // console.log("______________________?????_")
      // console.log(index)
      // console.log(id)
  $.ajax({
    type: "GET",
    url: 'legal/get-sub-as-json/'+id,
    success: function (response) {
      res = (JSON.parse(response))
      response = res

      for(i=0;i<response.length;i++) { 
        myid = i + 1
        var html = ' <div style="margin-left:3%"  id="root'+response[i].id+'"> <table class="root_table" onclick="ToggleTable(this)"><tbody class="tbody">'

        // html = html + '<tr class="color-add"><td>  <input type="checkbox" id="'+response[i].id+'" value="'+response[i].id+'" name="'+response[i].id+'" class="check-box" />  <label for="'+response[i].id+'" class="add-cam"></label></td>'
       
          html = html + '<tr class="color-add">'
        


if(response[i].status > 0){
html =html + '<td style="width: 60%"><a target="_blank" href="/legal/process-file/'+response[i].id+'"><i style="color:green" class="fa fa-star" aria-hidden="true"></i> <span id="subtabsmenu'+response[i].id+'" style="color:green">'+index+'.<span id="stt'+response[i].id+'" >'+response[i].stt+'</span>.<span id="legalTitle'+response[i].id+'" >'+response[i].title+'</span></a></span></td>'
}else{
html =html + '<td style="width: 60%"><a target="_blank" href="/legal/process-file/'+response[i].id+'"><i style="color:red" class="fa fa-star" aria-hidden="true"></i> <span id="subtabsmenu'+response[i].id+'" style="color:red">'+index+'.<span id="stt'+response[i].id+'" >'+response[i].stt+'</span>.<span id="legalTitle'+response[i].id+'" >'+response[i].title+'</span></a></span></td>'
}

        html = html + "<td class='col-sender'><span id='sender"+response[i].id+"'>"+response[i].sender+"</span></td>"

        html = html + "<td class='addon'>"

  @if($boss > 0)
        html = html+ '<button style="color: white"  type="button" onclick="SubLegalUpdate('+response[i].id+')" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/notepad.png"></span></button>'

        html = html + ' <button style="color: white"  type="button" class="btn btn-del Disable" onclick="removeStep('+response[i].id+')"> <span class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span></button>'

        html = html + '<button style="color: white"  type="button" onclick="LegalAdd('+response[i].id+')" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/plus.png"></span></button>'



 html = html + '<button style="color: white"  type="button" class="btn btn-del Disable"><a href="/legal/change-status/'+response[i].id+'" > <span class="preview"><img src="/js-css/img/icon/refresh.png"></span></a>      </button>'


 @endif
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


@foreach($legal_list as $lid)

getSubList({{$lid->id}},{{$lid->stt}})

@endforeach

function LegalUpdate(id){
  document.getElementById("EditLegalID").value = id;
  document.getElementById("EditLegalTitle").value = document.getElementById("legalTitle"+id).innerHTML;
  document.getElementById("EditLegalStt").value = document.getElementById("stt"+id).innerHTML;

        $("#edit-step").modal()
}

function SubLegalUpdate(id){
  document.getElementById("EditSubLegalID").value = id;
  document.getElementById("EditSubLegalTitle").value = document.getElementById("legalTitle"+id).innerHTML;
  document.getElementById("EditSubLegalSender").value = document.getElementById("sender"+id).innerHTML;
  document.getElementById("EditSubLegalStt").value = document.getElementById("stt"+id).innerHTML;

        $("#edit-sub-step").modal()
}





function LegalAdd(id){
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

$('input[type="file"]').change(function(e) {
            // alert("oke")
          var html = ""
            for (var i = 0; i < e.target.files.length;i++){
          var fileName = e.target.files[i].name;
          console.log(fileName)
          // $("#file").val(fileName);
        if (fileName.includes(".png") || fileName.includes(".jpg") || fileName.includes(".jepg")){
          var reader = new FileReader();
          reader.onload = function(e) {
            // get loaded data and render thumbnail.
          html  = html + '<img style="width: 200px;margin-left: 3%;" src="'+e.target.result+'" id="preview" class="preview">';
          
            $("#preview-file1").html(html);
            $("#preview-file2").html(html);

          };
       
          reader.readAsDataURL(this.files[i]);
      }else{
        // alert(fileName)
            // get loaded data and render thumbnail.
        console.log(fileName)
          html  = html + '<p><img width="25" height = "25" src="/js-css/img/file_type/pdf.png"> ' + fileName+ " <span style='color:red' onclick='closeFile()'>x</span><p>"; 
            $("#preview-file1").html(html);
            $("#preview-file2").html(html);
            $("#preview-file3").html(html);
          
  }



          // read the image file as a data URL.
                }
              
        });


  function closeFile(){
     $("#preview-file1").html("");
     $("#preview-file2").html("");
      $("#preview-file3").html("");
  }
  function closeEditFile(){
     $("#preview-file3").html("");
  }



 

  function removeStep(id) {
    console.log("Okoekqr");
              swal({
                  title: "",
                  text: " Bạn có muốn xóa bước này không? ",
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
                    location.href  = "/legal/delete-process/"+id
                    swal.close();
                  }
                  else {
                    swal.close();
                  }
                });
           }

function newBigStep(){
        var step_url = getCookie("step_url");
        // alert(step_url);
var step = step_url.split('#p')[1];

$("#bigStepSel").val(step);
} 




function mergePDF(){

      var today = new Date();
      var date = today.getFullYear()
      if(today.getMonth() + 1 < 10){
      date = date + '-0'+(today.getMonth()+1)
    }else{
      date = date +'-'+(today.getMonth()+1)

    }

      if(today.getDate() < 10){
      date = date + '-0'+today.getDate();
    }else{
      date = date +'-'+today.getDate();

    }
    console.log(document.getElementById("min").value)
    console.log(date)

        if(document.getElementById("max").value != ""){
        document.getElementById("inputdate1").value =  document.getElementById("min").value
        document.getElementById("inputdate2").value = document.getElementById("max").value
        }else{
        document.getElementById("inputdate1").value =  document.getElementById("min").value
        document.getElementById("inputdate2").value = date

        }
        $("#Sbutton").click()
}

</script>

  @endsection