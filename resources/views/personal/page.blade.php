@extends('layouts.index')
@section('content')
<script src="js-css/js/d3.min.js"></script>
<meta name="csrf-token" content="{!! csrf_token() !!}">      
  <!-- DataTables -->

 <link rel="stylesheet" href="/js/taginputs/bootstrap-tagsinput.css"  />

    <script src="/js/taginputs/bootstrap.min.js" ></script>
    <script src="/js/taginputs/bootstrap-tagsinput.js"></script>
    <script src="/js/taginputs/bootstrap-tagsinput-angular.min.js"></script>

    <style type="text/css">

    tr{
      border: none;
    }
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

       
<style>
  ::-webkit-scrollbar {
    width: 12px;
}
 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    border-radius: 10px;
}
 
::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}

  /* Popup container - can be anything you want */
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
    /*left: 50%;*/
    margin-left: -80px;
  }

  /* Popup arrow */
  .popup .popuptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    /*margin-left: -5px;*/
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

<div class="content-camera"><div class="session">
            @if(Session::has('notification'))
              <input hidden="" notifi="{{Session::get('notification')}}" value="1" id="notice_success">
            @endif
            @if(Session::has('warning'))
              <input hidden="" notifi="{{Session::get('warning')}}" value="1" id="notice_warning">
            @endif
         </div>
   <form  enctype="multipart/form-data" id="action-form" action="update-personal" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="row">
            <!-- Modal content-->
            <div class="col-md-12 col-12">
              <div class="modal-header">
                  <label>&nbsp; Thông tin cá nhân</label>
              </div>
              <div class="notification"></div>
              <div class="modal-body modal-config">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                      <tr>
                            <td><i class="fa fa-user" aria-hidden="true"></i>Ảnh đại diện </td>
                            @if(strlen(Auth::user()->avatar) > 2)
                            <td id="preview"><img style="width: 50%" src="{{Auth::user()->avatar}}"></td>
                            @else
                            <td id="preview"><img  style="width: 50%"src="/js-css/img/user.png"></td>
                            @endif
                            <td></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-user" aria-hidden="true"></i> Họ tên </td>
                            <td><input type="" value="{{Auth::user()->name}}" name="name" class="input-edit create-user modol-text" required=""></td>
                            <td> <button  class="btn btn-model" >Thay đổi thông tin</button></td>
                        </tr>

                        <tr>
                            <td><i class="fa fa-credit-card" aria-hidden="true"></i> Số căn cước</td>
                            <td><input type="" value="{{Auth::user()->identify}}" name="identify" class="input-edit create-user modol-text" required=""></td> 
                             <td>
 <h4> Đổi ảnh đại diện: </h4><input type="file" name="file" class="file">
                           </td>
                        </tr>
                       

                        <tr>
                            <td><i class="fa fa-envelope" aria-hidden="true"></i> Địa chỉ email</td>
                            <td>{{Auth::user()->email}}</td>
                              <td><a href="changepassword"  class="btn btn-model" >Đổi mật khẩu</a></td>

                        </tr>
                        <tr>
                            <td><i class="fa fa-phone" aria-hidden="true"></i> Điện thoại</td>
                            <td><input type="" value="{{Auth::user()->phone}}" name="phone" class="input-edit create-user modol-text" required=""></td>
                             <td><button class="btn btn-model"><a href="/hr/staff-info/{{Auth::user()->id}}"> Chi tiết nhân viên</a></button></td>
                        </tr>

                        </tr>
                        <tr>
                            <td><i class="fa fa-user" aria-hidden="true"></i> Khối</td>
                            <td>
                              {{$department}}
                            </td> </tr>

                        </tr>


                        <tr>
                            
                           
                        </tr>

                         <!-- <tr>
                            <td><a href="/noti/active"  class="btn btn-model" >Kích hoạt tài khoản</a></td>
                            <td><a href="/noti/send-test"  class="btn btn-model" >Test</a></td>
                        </tr> -->
                         
                           
                    </tbody>
                </table>
              </div>
              
          </div>
        <div class="col-md-8 col-12" style="display:none">
                <div class="modal-header">
                  <label>&nbsp; Kho dữ liệu cá nhân</label>
              </div>
              <button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-url">Thêm tệp mới</button>
              <table id="example" class="nvr-table">
                  <thead>
                    <tr class="thead">
                      <th style="width: 5%"></th>
                        <th style="width: 50%">Đầu mục </th>
                        <th style="display: none">Tag</th>
                        <th>Ngày tải lên</th>
                        <th class="icon-td" > </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($file as $file)
                      <?php

                        $k1 = DB::table('contribute_file_user')->where("file_id",$file->id)->count();

                        $k2 = DB::table('contribute_file_department')->where("file_id",$file->id)->count();

                      if($k1 > 0 || $k2 > 0){
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

                          @if($file->num > 1)<td ><a target="_blank" href="warehouse/detail/{{$file->id}}" >{{$file->name}} </a>
                          @else

                          <td ><a  target="_blank" download="<?=$file->name.".".$filetype?>" href="{{$file->url}}">{{$file->name}} </a>
                          
                          @endif
                            <span style="display: none" id="name{{$file->id}}"> {{$file->name}}</span>

                            <span style="display: none" id="open{{$file->id}}">{{$file->open}}</span>
                          </td>
                         

                          <td style="display: none"><span style="display: none"  id="tag{{$file->id}}"> {{$file->tags}}</span>
<span style="display: none" id="type{{$file->id}}"> 
                            <span class="mytags"> {{$file->tags}}</span>

                        </td>
                
                               <td>
<span style="display: none">{{$file->time}}></span>
<?php
$old_date_timestamp = strtotime($file->time);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
?>
 </td>

                          @if (strlen($file->url) > 0)
                          <td class = "center-td icon-td ">
                            <button onclick="Edit({{$file->id}})" class="preview" type="button"><img src="/js-css/img/icon/notepad.png"></button>

                    
                            <!--    <button type="button"  class="preview"><a href="<?=$file->url?>"  target="_blank"  > <img src="/js-css/img/icon/open.png"> </a></button>
   -->

                               <button type="button"  class="preview"><a href="warehouse/file-delete/<?=$file->id?>" > <img src="/js-css/img/icon/recycle_bin.png"> </a></button>

                              @else <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/wait.png">
                         
                              </button>
                         @endif
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                        
              </div>

        </form>
</div>


 <div class="modal fade modol-text" id="new-url" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm tệp</label>
              </div>
              <div class="notification"></div>
               <form id="uploadfile" action="warehouse/edit-private-task-file"  enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">  
                  <div class="modal-body">
                   
                   <h4>Tên</h4>
              <input class="input-edit modol-text"  name="title" value="">
  <h4>Tag</h4>
             <input id="newTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">




              <div id="OpenDiv">

<input type="hidden" name ="open" value="0">
             
              </div>
  
  

   <input style="display: none" id="file" type="file" name="file[]" class="file">

                    <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Tải tệp tin" id="file">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Chọn</button>
                        </div>
                    </div>
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
                  <label>Sửa tệp</label>
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

              <div id="deptDiv"></div>
      <h4>Danh sách người được xem</h4>
              
              <div id="staffDiv"></div>
    
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


<div class="overlay-dark"></div>
<embed class="img-overlay">

  
<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
</div>
<div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
</div>


<!-- Thay doi cau hinh  -->

<script type="text/javascript" src="js-css/js/socket.io.js"></script>

<style type="text/css">
  #zone .modal-dialog {
    max-width: 1000px;
  }

  #zone .modal-body {
    padding: 0em;
  }

  #zone .modal-content{
    padding: 1em;
  }

  #zone .modal-dialog {
    top: 150px;
  }

</style>


 <script type="text/javascript">


  function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    const negativeSign = amount < 0 ? "-" : "";

    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;

    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e)
  }
};

     
function genTask(){
   $.ajax({
    type: "GET",
    url: '/process/staff-outer-task/1',
    success: function (response) {
      console.log("substep detail")
      response = (JSON.parse(response))
      console.log(response)
      genInnerTasks("tasksList",JSON.parse(response[0]),0)     
      genInnerTasks("subtasksList",JSON.parse(response[1]),1)       
      
    }


  });
}
genTask()
function genInnerTasks(objectid, innerList,type){
  var html = ""
  html = html +  ' <table id="inner-table"  class="nvr-table "><thead style="display:none"><tr class="thead"><th  style= "width: 70%">Yêu cầu</th><th style= "width: 15%" class = "center-th">Tệp đính kèm</th><th style= "width: 15%" class = "center-th">Xác nhận hoàn thành </th> </tr></thead><tbody class="tbody">'
  for(var i = 0;i < innerList.length; i++){

    if (innerList[i].type == 0){
      html = html + "<td><b style= 'color:red'>" +innerList[i].name +"</b></td>"
    }else{
      html = html + "<td><b style= 'color:green'>" +innerList[i].name +"</b></td>"
    }
    if (innerList[i].file_flag == 0){
     html = html + "<td class = 'center-td'>Không</td>"
   }else{
    if (innerList[i].url  == null ){
      html = html + '<td class = "center-td"> <form id="uploadfile'+innerList[i].id+'" action="process/add-staff-task-file"  enctype="multipart/form-data" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}">  <label  class="preview" for="file-input"><img onclick="openfileupload('+innerList[i].id+')"  src="/js-css/img/icon/upload.png"></label><input id= "inputfile'+innerList[i].id+'" style="display:none" onchange="uploadsubmit('+innerList[i].id+')" value = "Tải lên" type="file" name="file" class="custom-file-input"" > <input value = "'+innerList[i].id+'" type="hidden" name="step_id" class="form-control"><input value = "'+type+'" type="hidden" name="type" class="form-control"></form> </td>'
    }else{
      html = html + '<td class = "center-td"><button onclick="loadFile('+"'"+innerList[i].url+"'"+')" class="preview" type="button"><img src="/js-css/img/icon/open.png"></td>'
    }
  }
  if (innerList[i].status == 0){
   html = html + '<td class = "center-td"><form id="updateStatus'+innerList[i].id+'" action="process/update-staff-task"  enctype="multipart/form-data" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}"> <input onchange="updateStatus('+innerList[i].id+')" type="checkbox" id="_checkbox'+innerList[i].id+'" ><label style="margin-left:45%" for="_checkbox'+innerList[i].id+'"><div id="tick_mark"></div></label><input value = "'+innerList[i].id+'" type="hidden" name="id" class="form-control"><input value = "'+type+'" type="hidden" name="type" class="form-control"></form></td>'
 }else{
   html = html + '<td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/success.png"></td>'

 }

 html = html + "</tr>"
}

html = html + '</tbody></table>'

document.getElementById(objectid).innerHTML = html;     
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
    function  loadFile($src){
      $('.img-overlay').attr('src', $src);
      $(".overlay-dark").css('display', 'block');
      $('.img-overlay').css('display', 'block');
      $('.img-overlay').css('opacity', 1);
      $('.img-overlay').css('width', '90%');
      $('.img-overlay').css('height', '90%');
      $('.img-overlay').css('transform', 'translate(-50%, 0) scale(1, 1)');
    }

    $(".overlay-dark").on('click', function() {
      $(".overlay-dark").css('display', 'none');
      $('.img-overlay').css('display', 'none');
      setTimeout(function() {
        $('.img-overlay').css('transform', 'translate(-50%, 0) scale(0, 0)');
      }, 600);
    });

  $('#staff-table').DataTable({
        "order": [[ 3, "desc" ]]
    })
    $('#area-table').DataTable({
        "order": [[ 3, "desc" ]]
    })
  $('.dataTables_length').addClass('bs-select');
 $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });
 
  $("#content1").on("click", "li", function(e) {
  e.preventDefault();
  $(this).closest("li").find("[class^='ul_submenu']").slideToggle();
});
 $("#content2").on("click", "li", function(e) {
  e.preventDefault();
  $(this).closest("li").find("[class^='ul_submenu']").slideToggle();
});
  $("#content3").on("click", "li", function(e) {
  e.preventDefault();
  $(this).closest("li").find("[class^='ul_submenu']").slideToggle();
});
   $("#content4").on("click", "li", function(e) {
  e.preventDefault();
  $(this).closest("li").find("[class^='ul_submenu']").slideToggle();
});
  function uploadsubmit(id){ 
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
      document.getElementById("uploadfile"+id).submit();
            swal.close();
          }
          else {
            swal.close();
          }
        });

    }
    function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }
    function updateStatus($id){ 
      swal({
        title: "",
        text: " Bạn có chắc chắc điều kiện đã hoàn thành ? ",
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
            document.getElementById("updateStatus"+$id).submit();
            swal.close();
          }
          else {
            swal.close();
          }
        });
    }
$(document).ready(function() {
      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }
    });

    </script>

<script src="/js-css/js/bootstrap-select.min.js"></script>
<script src="/js-css/js/ckeditor/ckeditor.js"></script>
  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
<script type="text/javascript">
  var table1 = $('#example').DataTable({
    "pageLength": 20,
});

        $(document).on("click", ".browse", function() {
          console.log("oke")
          
          $("#file").trigger("click");
        });
        $('input[type="file"]').change(function(e) {
            
          document.getElementById("preview").innerHTML =""
            for (var i = 0; i < e.target.files.length;i++){
          var fileName = e.target.files[i].name;
          console.log(fileName)
          // $("#file").val(fileName);
        if (fileName.includes(".png") || fileName.includes(".jpg") || fileName.includes(".jepg")){
          var reader = new FileReader();
          reader.onload = function(e) {
            // get loaded data and render thumbnail.
            console.log("oke")
          document.getElementById("preview").innerHTML  =  '<img style="width: 100%" src="'+e.target.result+'">';
          };
          reader.readAsDataURL(this.files[i]);
      }

          // read the image file as a data URL.
                }
        });
function  Edit(id){


  document.getElementById("editId").value = id
  // document.getElementById("editOpen").value = document.getElementById("open"+id).innerHTML

  $("#editOpen").val(document.getElementById("open"+id).innerHTML);

  document.getElementById("editName").value = document.getElementById("name"+id).innerHTML
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
@endsection
