@extends('layouts.index')
@section('content')
<script src="js-css/js/d3.min.js"></script>
<meta name="csrf-token" content="{!! csrf_token() !!}">      
  <!-- DataTables -->
 <link rel="stylesheet" href="js-css/datatables/dataTables.bootstrap4.css">
       
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
      <div class="row-title-proxy">
         <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content1">Danh sách công việc </a>
      </li>
     <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content2"> Quy trình tổng quan 1</a>
      </li>
       <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content3">Quy trình tổng quan 2</a>
      </li>

    
    </ul>  
    <hr>

        <div class="tab-content">

          <div id="content1" class="tab-pane  in active">
            <table id="inner-table"  class="nvr-table "><thead><tr class="thead"><th  style= "width: 70%">Yêu cầu</th><th style= "width: 15%" class = "center-th">Tệp đính kèm</th><th style= "width: 15%" class = "center-th">Xác nhận hoàn thành </th> </tr></thead></table>
            <div id="tasksList"></div>
            <div id="subtasksList"></div>
          </div>

            <div id="content2" class="tab-pane  fade">
 <li class="submenu list-group-item"><a>
      <h5><i class="fa fa-star" aria-hidden="true"></i>Bước 1: Đặt cọc</h5></a>
      <ul class="ul_submenu fananci-element" style="display: none;"><h6>Làm hợp đồng đặt cọc theo biểu mẫu</h6></ul></li>


    <li class="submenu list-group-item"><a>
      <h5><i class="fa fa-star" aria-hidden="true"></i>Bước 2:  Kí kết hợp đồng</h5></a>
      <ul class="ul_submenu fananci-element" style="display: none;"><h6>Thời điểm ký kết hợp đồng chuyển nhượng đã thỏa thuận trong hợp đồng đặt cọc. CĐT đã đủ điều kiện)</h6></ul></li>


    <li class="submenu list-group-item"><a>
      <h5><i class="fa fa-star" aria-hidden="true"></i>Bước 3:  Quản lý tiến độ</h5></a>
      <ul class="ul_submenu fananci-element" style="display: none;">
<li class="fananci-list margin_center"><p> Khách hàng thanh toán 95%</p></li><li class="fananci-list margin_center"><p>Làm thủ tục sang tên; khi khách hàng nhận sổ lấy nốt 5% còn lại</p></li></ul>
<ul class="ul_submenu fananci-element" style="display: none;">
<li class="fananci-list margin_center"><p>  Khách hàng không lên ký và đóng nốt tiền coi như đã bỏ cọc</p></li><li class="fananci-list margin_center"><p>Khách hàng mất tiền cọc; chủ đầu tư tìm khách hàng khác</p></li></ul>
<ul class="ul_submenu fananci-element" style="display: none;">
<li class="fananci-list margin_center"><p> Khách hàng vi phạm nghĩa vụ thanh toán</p></li><li class="fananci-list margin_center"><p>Khách hàng mất tiền cọc; chủ đầu tư tìm khách hàng khác</p></li>
</ul>
    <li class="submenu list-group-item"><a>
      <h5><i class="fa fa-star" aria-hidden="true"></i>Bước 4: Kết thúc bán hàng</h5></a>
      <ul class="ul_submenu fananci-element" style="display: none;"><h6>Thu nốt 5% hợp đồng, bàn giao sổ đỏ cho khách hàng</h6></ul></li>

          </div>
  <div id="content3" class="tab-pane  fade">
    <li class="submenu list-group-item"><a>
      <h5><i class="fa fa-star" aria-hidden="true"></i>Bước 1: Đặt cọc</h5></a>
      <ul class="ul_submenu fananci-element" style="display: none;"><h6>Làm hợp đồng đặt cọc theo biểu mẫu</h6></ul></li>


    <li class="submenu list-group-item"><a>
      <h5><i class="fa fa-star" aria-hidden="true"></i>Bước 2:  Kí kết hợp đồng</h5></a>
      <ul class="ul_submenu fananci-element" style="display: none;"><h6>Thời điểm ký kết hợp đồng chuyển nhượng đã thỏa thuận trong hợp đồng đặt cọc. CĐT đã đủ điều kiện), thu 95% tiền nhà</h6></ul></li>


    <li class="submenu list-group-item"><a>
      <h5><i class="fa fa-star" aria-hidden="true"></i>Bước 3:  Quản lý tiến độ</h5></a>
      <ul class="ul_submenu fananci-element" style="display: none;">
<li class="fananci-list margin_center"><p> Khách hàng thanh toán 95%</p></li><li class="fananci-list margin_center"><p>Làm thủ tục sang tên; khi khách hàng nhận sổ lấy nốt 5% còn lại</p></li></ul>
<ul class="ul_submenu fananci-element" style="display: none;">
<li class="fananci-list margin_center"><p>  Khách hàng không lên ký và đóng nốt tiền coi như đã bỏ cọc</p></li><li class="fananci-list margin_center"><p>Khách hàng mất tiền cọc; chủ đầu tư tìm khách hàng khác</p></li></ul>
<ul class="ul_submenu fananci-element" style="display: none;">
<li class="fananci-list margin_center"><p> Khách hàng vi phạm nghĩa vụ thanh toán</p></li><li class="fananci-list margin_center"><p>Khách hàng mất tiền cọc; chủ đầu tư tìm khách hàng khác</p></li>
</ul>
    <li class="submenu list-group-item"><a>
      <h5><i class="fa fa-star" aria-hidden="true"></i>Bước 4: Kí hợp đồng mới</h5>
    </a>
      <ul class="ul_submenu fananci-element" style="display: none;"><h6>Đợi văn bản mẫu hợp đồng chính thức của nhà nước </h6></ul>
      <ul class="ul_submenu fananci-element" style="display: none;">
<li class="fananci-list margin_center"><p> Khách hàng muốn
chuyển nhượng hợp đồng
cho người khác</p></li><li class="fananci-list margin_center"><p>Thanh lý hợp đồng
cũ; ký hợp đồng mới với
khách mới</p></li></ul>
<ul class="ul_submenu fananci-element" style="display: none;">
<li class="fananci-list margin_center"><p> Khách hàng hoàn thành nghĩa vụ tài chính</p></li><li class="fananci-list margin_center"><p>ký hợp đồng
mới theo mẫu nhà nước, thanh lý hợp đồng cũ.</p></li></ul>
</li>
    <li class="submenu list-group-item"><a>
      <h5><i class="fa fa-star" aria-hidden="true"></i>Bước 5: Kết thúc bán hàng</h5></a>
      <ul class="ul_submenu fananci-element" style="display: none;"><h6>Thu nốt 5% hợp đồng, bàn giao sổ đỏ cho khách hàng</h6></ul></li>


          </div>

        </div>
      </div>
                      </div>
                    </div>
                      </div>

</div>
<div class="popup" id="popup">
  <div class="popuptext" id="myPopup">
    
  </div>
</div>


<input type="hidden"  value="2" id="tempType">    
<input type="hidden"  value="1" id="tempDate">   


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
