@extends('layouts.index')
@section('content')

 <link rel="stylesheet" href="/js/taginputs/bootstrap-tagsinput.css"  />

    <script src="/js/taginputs/bootstrap.min.js" ></script>
    <script src="/js/taginputs/bootstrap-tagsinput.js"></script>
    <script src="/js/taginputs/bootstrap-tagsinput-angular.min.js"></script>

    <style type="text/css">
    /*  .dropdown-menu{
        transform: none !important;
      }*/

  .select-profile {
    /* font-size: 0.85em; */
    z-index: unset!important;
  }
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
 @media(max-width:700px) {
    .icon-td {
       display: none;
    }
}


/*the container must be positioned relative:*/

.autocomplete {
  position: relative;
  display: inline-block;
}
.autocomplete-items {
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9;
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
}

    </style>
  <div class="content-camera">
    <div class="header-content">
      <div class="header-content-left">
      </div>
      <div class="header-content-right" style="display: inline;">
        
        <h6 class="display-inline"></h6>
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
    <div class="row row-content">
      <div class="row-title-proxy">
         <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content1">Kho dữ liệu </a>
      </li>    
    </ul>  
        <div class="tab-content"> <label  class="preview" for="file-input">
          <button type="button"  class="btn btn-model"> <a href="/warehouse/list" > Quay lại</a></button>
<button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-url">Thêm tệp mới</button>
 <button type="button"  class="btn btn-model"><a  href="warehouse/image-list" >Kho dữ liệu hình ảnh</a></button>
 <button type="button"  class="btn btn-model"><a  href="warehouse/content" >Kho dữ liệu nội dung</a></button>
 <button type="button"  class="btn btn-model"><a  href="warehouse/mess" >Kho dữ liệu tin nhắn</a></button>


          </label>
          <div id="content1" class="tab-pane  in active">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="example" class="nvr-table">
                  <thead>
                    <tr class="thead">
                      <th style="width: 5%"></th>
                        <th style="width: 50%">Đầu mục </th>
                        <th style="display: none">Tag</th>
                        <th>Người tải lên</th>
                        <th>Ngày tải lên</th>
                        <th class="icon-td" > </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($file as $file)
                        <tr class="color-add">  

                          <?php

                          $filetype = (explode('.',$file->url));
                          $filetype = ($filetype[count($filetype)-1]); 
?>
<?php

            if(strpos($file->url,".png") > 0 
            || strpos($file->url,".jpg") > 0 
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
            || strpos($file->url,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }


                          ?>

                          <td><span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> </td>

                          @if($file->num > 1)<td ><a target="_blank" href="warehouse/detail/{{$file->id}}" >{{$file->name}} </a>
                          @else

                          <td ><a  target="_blank" download="<?=$file->name.".".$filetype?>" href="{{$file->url}}">{{$file->name}} </a>
                          
                          @endif
                            <span style="display: none" id="name{{$file->id}}"> {{$file->name}}</span>

                            <span style="display: none" id="open{{$file->id}}">{{$file->open}}</span>
                          </td>
                         

                          <td style="display: none"><span style="display: none"  id="tag{{$file->id}}"> {{$file->tags}}</span>
<span id="type{{$file->id}}"> 
                            <span class="mytags"> {{$file->tags}}</span>

                        </td>
                          <td><span id="uname{{$file->id}}"> {{$file->uname}}</td>

                               <td>
<span style="display: none">{{$file->time}}></span>
<?php
$old_date_timestamp = strtotime($file->time);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
?>
 </td>

                          @if (strlen($file->url) > 0)
                          <td class = "center-td icon-td ">
                            <button onclick="Edit({{$file->id}})" class="preview" type="button"><img src="/js-css/img/icon/notepad.png">

                              
                            </button>

                    
                            <!--    <button type="button"  class="preview"><a href="<?=$file->url?>"  target="_blank"  > <img src="/js-css/img/icon/open.png"> </a></button>
   -->

                               <button type="button"  class="preview"><a href="warehouse/file-delete/<?=$file->id?>" > <img src="/js-css/img/icon/recycle_bin.png"> </a></button>

                              @else <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/wait.png">
                         

                          </td>
                      @endif
                        </tr>
                      @endforeach

                        @foreach($file2 as $file)
                        <?php

                        if(strlen($file->url) == 0){
  continue;
} 
?>
                        <tr class="color-add">  

                          <?php

                          $filetype = (explode('.',$file->url));
                          $filetype = ($filetype[count($filetype)-1]); 
?>
<?php

            if(strpos($file->url,".png") > 0 
            || strpos($file->url,".jpg") > 0 
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
            || strpos($file->url,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }


                          ?>

                          <td><span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> </td>


                          <td ><a target="_blank" href="warehouse/detail/{{$file->id}}" >
                            @if(strlen($file->fname) > 0)
                            {{$file->fname}} ({{$file->name}}) PLHT
                            @else
                               {{$file->name}}
                            @endif
                          </a>

                        
                            <span style="display: none" id="name{{$file->id}}"> {{$file->fname}}</span>

                            <span style="display: none" id="open{{$file->id}}"><span>
                          </td>
                         

                          <td style="display: none">
                        </td>


                          <td>PLHT </td>

                               <td>
<span style="display: none">{{$file->created_at}}></span>
<?php
$old_date_timestamp = strtotime($file->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
?>
 </td>

                          @if (strlen($file->url) > 0)
                          <td class = "center-td icon-td ">
                            <button onclick="Edit({{$file->id}})" class="preview" type="button"><img src="/js-css/img/icon/notepad.png">

                              
                            </button>

                    
                            <!--    <button type="button"  class="preview"><a href="<?=$file->url?>"  target="_blank"  > <img src="/js-css/img/icon/open.png"> </a></button>
   -->

                               <button type="button"  class="preview"><a href="warehouse/file-delete/<?=$file->id?>" > <img src="/js-css/img/icon/recycle_bin.png"> </a></button>

                              @else <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/wait.png">
                         

                      @endif
                          </td>
                        </tr>
                      @endforeach

                          @foreach($cv as $form)
 <?php

                          $filetype = (explode('.',$form->url));
                          $filetype = ($filetype[count($filetype)-1]);
                          ?>
<?php

            if(strpos($form->url,".png") > 0 
            || strpos($form->url,".jpg") > 0 
            || strpos($form->url,".jpeg") > 0 
          ){
              
              $type = "photo.jpg";
          }elseif (strpos($form->url,".pdf")> 0) {
              $type = "pdf.png";
          }elseif (strpos($form->url,".doc")> 0) {
              $type = "word.png";
          }elseif (strpos($form->url,".ppt")> 0) {
              $type = "pp.png";
          }elseif (strpos($form->url,".xls")> 0
            || strpos($form->url,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }


                          ?>


                        <tr class="color-add">
                          <td><span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> </td>
                          <td ><a  target="_blank" download="<?=$form->name.".".$filetype?>" href="{{$form->url}}">{{$form->name}}</a>

                            <span style="display: none" id="oname{{$form->id}}">{{$form->name}}</span>

                          </td>
                          <td style="display: none"></td>
                          <td>Hệ thống</td>
                               <td>
<span style="display: none">{{$form->created_at}}></span>
                                                        <?php
$old_date_timestamp = strtotime($form->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?></td>
                          <td class = "center-td">
                            Văn bản
                          
                          </td>
                           
                        </tr>
                      @endforeach

   @foreach($schedule_files as $file)
 <?php

                          $filetype = (explode('.',$file->url));
                          $filetype = ($filetype[count($filetype)-1]);
                          ?>

<?php

            if(strpos($file->url,".png") > 0 
            || strpos($file->url,".jpg") > 0 
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
            || strpos($file->url,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }


                          ?>
 <tr class="color-add">
                          <td><span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> </td>
                       
                          <td ><a target="_blank" href="/chatify/schedule/{{$file->sid}}" >{{$file->title}} (Công việc:{{$file->stitle}} )</a>

                            <span style="display: none" id="yname{{$file->id}}">{{$file->title}} </span>

                          </td>
                          <td style="display: none"></td>
                          <td>Hệ thống</td>
                               <td>
<span style="display: none">{{$file->time}}></span>
                                                        <?php
$old_date_timestamp = strtotime($file->time);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?></td>
                          <td class = "center-td">
                            Tài liệu công việc
                          
                          </td>
                           
                        </tr>
                      @endforeach

               

   @foreach($schedule_attachment as $file)
 <?php

                          $filetype = (explode('.',$file->url));
                          $filetype = ($filetype[count($filetype)-1]);
                          ?>

<?php

            if(strpos($file->url,".png") > 0 
            || strpos($file->url,".jpg") > 0 
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
            || strpos($file->url,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }


                          ?>
  <tr class="color-add">
                          <td><span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> </td>
                      
                          <td ><a target="_blank" href="/chatify/schedule/{{$file->sid}}" >{{$file->title}} (Công việc:{{$file->stitle}} )</a>

                            <span style="display: none" id="yname{{$file->id}}">{{$file->title}} </span>

                          </td>
                          <td style="display: none"></td>
                          <td>Hệ thống</td>
                               <td>
<span style="display: none">{{$file->time}}></span>
                                                        <?php
$old_date_timestamp = strtotime($file->time);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?></td>
                          <td class = "center-td">
                            Tài liệu công việc
                          
                          </td>
                           
                        </tr>
                      @endforeach

                       


   @foreach($schedule_subattachment as $file)
 <?php

                          $filetype = (explode('.',$file->url));
                          $filetype = ($filetype[count($filetype)-1]);
                          ?>
<?php

            if(strpos($file->url,".png") > 0 
            || strpos($file->url,".jpg") > 0 
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
            || strpos($file->url,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }


                          ?>

                        <tr class="color-add">
                          <td><span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> </td>

                          <td ><a target="_blank" href="/chatify/schedule/{{$file->sid}}" >{{$file->title}} (Công việc:{{$file->stitle}} )</a>

                            <span style="display: none" id="yname{{$file->id}}">{{$file->title}} </span>

                          </td>
                          <td style="display: none"></td>
                          <td>Hệ thống</td>
                               <td>
<span style="display: none">{{$file->time}}></span>
                                                        <?php
$old_date_timestamp = strtotime($file->time);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?></td>
                          <td class = "center-td">
                            Tài liệu công việc
                          
                          </td>
                           
                        </tr>
                      @endforeach

 @foreach($schedules as $schedule)

                        <tr class="color-add">

                          <td><span class="preview"><img src="/js-css/img/file_type/other.png"></span> </td>
                          <td ><a target="_blank" href="/chatify/schedule/{{$schedule->id}}" >{{$schedule->title}} </a>

                            <span style="display: none" id="yname{{$schedule->id}}">{{$schedule->title}} </span>

                          </td>
                          <td style="display: none"></td>
                          <td>Công việc</td>
                               <td>
<span style="display: none">{{$file->time}}></span>
                                                        <?php
$old_date_timestamp = strtotime($file->time);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?></td>
                          <td class = "center-td">
                            Công việc
                          
                          </td>
                           
                        </tr>
                      @endforeach

                                      
 @foreach($zone_history as $file)
 <?php

                          $filetype = (explode('.',$file->url));
                          $filetype = ($filetype[count($filetype)-1]);
                          ?>

<?php

            if(strpos($file->url,".png") > 0 
            || strpos($file->url,".jpg") > 0 
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
            || strpos($file->url,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }


                          ?>
<tr class="color-add">
                          <td><span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> </td>
                        
                          <td ><a  target="_blank" download=" <?=$file->description." ".$file->name.".".$filetype?> " href="{{$file->url}}">{{$file->description}} {{$file->name}} </a>

                            <span style="display: none" id="yname{{$file->id}}">{{$file->name}} </span>

                          </td>
                          <td style="display: none"></td>
                          <td>Hệ thống</td>
                               <td>
<span style="display: none">{{$file->created_at}}></span>
                                                        <?php
$old_date_timestamp = strtotime($file->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?></td>
                          <td class = "center-td">
                            Nhật ký xây dựng
                          
                          </td>
                           
                        </tr>
                      @endforeach
@foreach($build_history as $file)
 <?php

                          $filetype = (explode('.',$file->url));
                          $filetype = ($filetype[count($filetype)-1]);
                          ?>

<?php

            if(strpos($file->url,".png") > 0 
            || strpos($file->url,".jpg") > 0 
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
            || strpos($file->url,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }


                          ?>    <tr class="color-add">

                          <td><span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> </td>
                    
                          <td ><a  target="_blank" download=" <?=$file->name.".".$filetype?> " href="{{$file->url}}">{{$file->name}}  </a>

                            <span style="display: none" id="yname{{$file->id}}">{{$file->name}} </span>

                          </td>
                          <td style="display: none"></td>
                          <td>Hệ thống</td>
                               <td>
<span style="display: none">{{$file->created_at}}></span>
                                                        <?php
$old_date_timestamp = strtotime($file->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?></td>
                          <td class = "center-td">
                            Nhật ký xây dựng
                          
                          </td>
                           
                        </tr>
                      @endforeach

                    </tbody>
                  </table>
            </div>
          </div>

           

        </div>
      </div>
    </div>
  <!-- end model --->
 <div class="modal fade modol-text" id="new-url" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm tệp</label>
              </div>
              <div class="notification"></div>
               <form id="uploadfile" action="warehouse/edit-task-file"  enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">  
                  <div class="modal-body">
                   
                   <h4>Tên</h4>
              <input class="input-edit modol-text"  name="title" value="">
  <h4>Tag</h4>
             <input id="newTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">




              <h4>Công khai (Cho tất cả mọi người, kể cả khách)</h4>
              <div id="OpenDiv">

<div class="form-group">
  <select class="form-control" name="open">
                  <option value="0">Không</option>
                  <option value="1">Có</option>
  </select>
</div>
             
              </div>

   <h4>Danh sách phòng ban được xem</h4>

              <div id="deptDiv"></div>
      <h4>Danh sách người được xem</h4>
              
              <div id="staffDiv"></div>

   <input style="display: none" id="fileinput" type="file" name="file[]" class="file">

                    <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Tải tệp tin" id="file">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Chọn</button>
                        </div>
                    </div>

                <div class="form-group" id="preview-file"></div>
<br><hr><br>

 <div class="form-group" id="preview">
</div>

    
              </div>
<br><hr>
            
             
  <div class="modal-footer" style="    position: inherit;">
   <button   class="button-77"  type="submit"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Cập nhật </button>
                <button type="button-77" class="button-77" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>
            </div>
          </div>
        </form>
    </div>

          </div>
      </div>
   <div class="modal fade modol-text" id="new-edge" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm tệp</label>
              </div>
              <div class="notification"></div>
              <form action="warehouse/edit-task-file-name" method="POST">
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
                                <td class="cam-properties">Tag: </td>
                                <td class="editTD">
                                 <input id="editTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags"></td><input value = "0" type="hidden" name="type" class="form-control">
                            </tr>
                               </tbody>
                    </table>
                 


              <h4>Công khai (Cho tất cả mọi người, kể cả khách)</h4>
              <div id="OpenDiv">

<div class="form-group">
  <select class="form-control" name="open" id="editOpen">
                  <option value="0">Không</option>
                  <option value="1">Có</option>
  </select>
</div>
             
              </div>

      <h4>Danh sách phòng ban được xem</h4>

              <div id="deptEditDiv"></div>
      <h4>Danh sách người được xem</h4>
              
              <div id="staffEditDiv"></div>


    
              </div>
<br><hr>
            
             
  <div class="modal-footer" style="    position: inherit;">
   <button   class="button-77"  type="submit"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Thêm </button>

                <button type="button-77" class="button-77" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>
            </div>
          </div>
        </form>
            </div>
          </div>
      </div>


  <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
    </div>
    <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
     </div>


<div class="overlay-dark"></div>
<embed class="img-overlay">

  <script>
   
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


  document.getElementById("editId").value = id
  // document.getElementById("editOpen").value = document.getElementById("open"+id).innerHTML

  $("#editOpen").val(document.getElementById("open"+id).innerHTML);

  document.getElementById("editName").value = document.getElementById("name"+id).innerHTML
  getDeptList2(id)
  getStaffList2(id)
  // document.getElementById("editType").value = parseInt(document.getElementById("type"+id).innerHTML)

var rawhtml = $("#tag"+id).html();
     if (rawhtml.length > 1){
     rawhtml = rawhtml.split(',');
     for (var i = 0; i < rawhtml.length;i++){
    $('#editTag').tagsinput('add', rawhtml[i]);
    }
    }
  // document.getElementById("editTag").value = document.getElementById("tag"+id).innerHTML
$("#new-edge").modal()

}
  </script>
<script type="text/javascript">
  function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
              b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}

</script>

  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
  <script>

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

    var find = getCookie("find")
    // alert(find)
    $('#example').DataTable({
     "oSearch": {"sSearch": find},
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

$(document).ready(function(){
//         $('.mytags').each(function(){

//      var rawhtml = $(this).html();
//      if (rawhtml.length > 1){
//      rawhtml = rawhtml.split(',');

//      html = '<div class="bootstrap-tagsinput">'
//      for (var i = 0; i < rawhtml.length;i++){
//       html = html + '<span class="tag label label-info" style="display: inline-block;">'+rawhtml[i]+'</span>'
//     }
//     html = html + "</div>"
//     console.log(html)
//       $(this).html(html)
//     }
//  });



var tags = JSON.parse('{!! $tags !!}');
console.log(tags)
// console.log(document.querySelector("td.tagTD div input"))
autocomplete(document.querySelector("td.tagTD div input"), tags);
autocomplete(document.querySelector("td.editTD div input"), tags);


$('.bootstrap-tagsinput input').keydown(function( event ) {
    if ( event.which == 13 ) {
        $(this).blur();
        $(this).focus();
        return false;
    }
})

});
  </script>

<script src="/js-css/js/bootstrap-select.min.js"></script>
<script src="/js-css/js/ckeditor/ckeditor.js"></script>
  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
<script type="text/javascript">



 function getStaffList(id){
  console.log('/schedule/staff-select/'+id)
  $.ajax({
    type: "GET",
    url: '/file/staff-select/'+id,
    success: function (response) {
      response = (JSON.parse(response))
      console.log(response)
      var data = response[0]
      var sel = response[1]
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


     var  html = '<select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffSelected" multiple>'
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
      console.log(html)
      document.getElementById("staffDiv").innerHTML=html;
$('#staffSelected').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
    }
  });
}


 function getDeptList(id){
  $.ajax({
    type: "GET",
    url: '/file/dept-select/'+id+'/',
    success: function (response) {
      response = (JSON.parse(response))
      console.log(response)
      var data = response[0]
      var sel = response[1]
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


     var  html = '<select name="did[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="deptSelected" multiple>'
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
      document.getElementById("deptDiv").innerHTML=html;
$('#deptSelected').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
    }
  });
}


getStaffList(0)
getDeptList(0)

 function getStaffList2(id){
  console.log('/schedule/staff-select/'+id)
  $.ajax({
    type: "GET",
    url: '/file/staff-select/'+id,
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
      console.log(html)
      document.getElementById("staffEditDiv").innerHTML=html;
$('#staffEditSelected').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
    }
  });
}


 function getDeptList2(id){
  $.ajax({
    type: "GET",
    url: '/file/dept-select/'+id+'/',
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


</script>
<script type="text/javascript">
 $(document).on("click", ".browse", function() {
          console.log($(this))
          var file = $("#fileinput")
          file.trigger("click");
        });
      
 $('input[type="file"]').change(function(e) {
            // alert("oke")
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
        alert(fileName)
            // get loaded data and render thumbnail.
        console.log(fileName)
          html  = html + '<p><img width="25" height = "25" src="/js-css/img/file_type/pdf.png"> ' + fileName+ " <span style='color:red' onclick='closeFile()'>x</span><p>"; 
        console.log(html)
            $("#preview-file").html($("#preview-file").html()+html);
          
  }



          // read the image file as a data URL.
                }
              
        });
  function closeFile(){
     $("#preview-file").html("");
  }
 

      </script>


@endsection
