@extends('layouts.index')
@section('content')
<script src="js-css/js/d3.min.js"></script>
<meta name="csrf-token" content="{!! csrf_token() !!}">
<style>
  /* Popup container - can be anything you want */
  .list-group-item{
    background-color:transparent!important;
  }
  .display {
    background-repeat:no-repeat;
    background-size:contain;
    background-position:center;
    text-align: center;
    color: black;
    font-weight: 100!important;
    display: block;
    position: absolute;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
  .popup {
    z-index:600;
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
  <div class="header-content">
   <div class="header-content-left">
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
<div class="row-content">
<ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a onclick= "display(1)" id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#content1">Bản đồ khu vực</a>
      </li>
    <!--   <li class="nav-item margin_center">
          <a onclick= "display(0)" id="tab0" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content0">Bản đồ địa giới</a>
      </li>
      <li class="nav-item margin_center">
          <a onclick= "display(0)" id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content2">Tìm kiếm</a>
      </li> -->
      <!-- <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content3">Statistic</a>
      </li> -->
    
    </ul>  
    <hr>
<div class="tab-content">
<div id="content1" class="tab-pane  in active">

<div  id="zone" role="dialog" data-backdrop="static">            <div class="modal-content">
  <div class="modal-body" id="zone-body">
    <img src="js-css/img/project/{{$project->url}}" style="width: 100%; height: 100%;" id="snapshot-zone">
  </div>
  <div class="option-zone">
    <input type="hidden" value="" id="zoneStatus">
  
    <button class="btn btn-model" onclick="fixZone();" id="btnFixZone">Thêm nhà</button>


   

<button type="button" id="refButton" class="camera-button" onclick="getZone()"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button>
  </div>
</div>
</div>
</div>
<div id="content0" class="tab-pane fade">
 <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="945" id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3268.517080789128!2d105.71849511446976!3d18.643635287337354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3139cd612637a747%3A0x199c3f0e94efd054!2zS2h1IMSRw7QgdGjhu4sgWHXDom4gYW4gZ3JlZW4gcGFyaw!5e1!3m2!1sen!2sus!4v1614074527038!5m2!1sen!2sus" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://embedgooglemap.net/maps/6"></a><br><style>.mapouter{position:relative;text-align:right;height:100%;width:100%;}</style><a href="https://www.embedgooglemap.net">google maps embedded api</a><style>.gmap_canvas {overflow:hidden;background:none!important;width:100%;}</style></div></div>
</div>
<div id="content2" class="tab-pane fade">
  <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;List of Zone</div>
                      <div class="search-input proxy-add" title="Serach">
                        <input type="text" class="textbox" id="search-input" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div>
<table id="zone-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Mã BDS</th>
                            <th>Nhân viên</th>
                            <th>Khách hàng</th>
                            <th>Trạng thái</th>
                            <th>Giá tiền  </th>
                            <th>Ngày chốt</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody" id="zone_content">

                        </tbody>
                      </table>
</div>

<div id="content3" class="tab-pane fade">

</div>

</div>
</div>
</div>
<div class="popup" id="popup">
  <div class="popuptext" id="myPopup">
    
  </div>
</div>


<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
</div>
<div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
</div>


<!-- Modal -->
<div class="modal fade modol-text" id="new-zone" role="dialog">
  <div class="modal-dialog model-right">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label>Tạo khu mới </label>
      </div>
      <div class="notification"></div>
      <form action="add-map-config" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="id" value="{{$id}}}">
        <div class="modal-body">
          <table class="table-edit table-model">
            <tbody class="table-edit">
              <tr>
                <td class="cam-properties">Tên </td>
                <td><input value="test" type="" value="" name="name" id="zone_name" class="input-edit modol-text" required=""></td>

                <td><input type="hidden" value="" name="zones" id="zone_input" class="input-edit modol-text" required=""></td>
              </tr>

              <tr>
                <td></td>
                <td>
                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm  &nbsp;&nbsp; </button>
                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoát</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade modol-text" id="transaction-modal" role="dialog">
  <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 75%">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label>Lập giao dịch mới</label>
      </div>
      <div class="notification"></div>
      <form action="update-zone-consumer" method="POST">
      <div class="row">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" value="" id="tran_id" name="zone_id" class="input-edit modol-text" required="">
        <input type="hidden" value="" id="con_type" name="con_type" class="input-edit modol-text" required="">
        <div class="modal-body">
          <table class="table-edit table-model">
            <tbody class="table-edit">
              
              <tr>
                <td class="cam-properties">Mã BDS: </td>
                <td id="tran-zone"></td>

              </tr>
              <tr>
                <td class="cam-properties">Hướng: </td>
                <td id="tran-position"></td>

              </tr>
              <tr>
                <td class="cam-properties">Đặc điểm: </td>
                <td id="tran-view"></td>

              </tr>
              <tr>
                <td class="cam-properties">Giá bán: </td>
                <td id="tran-price"></td>

              </tr>
              <tr>
                <td class="cam-properties">Tiền cọc: </td>
                <td id="tran-deposit"></td>

              </tr>
              <tr>
                <td class="cam-properties"><button onclick="newConsumer(0)"  type="button" class="btn btn-model">Khách mới</button></td>
                <td class="cam-properties"><button onclick="newConsumer(1)" type="button" class="btn btn-model">Khách đã có</button></td>

              </tr>
                
            </tbody>
            <tbody id="conInputContent"></tbody>
          </table>
        </div>
          <table class="table-edit table-model">
            
             <tbody class="table-edit" >
                <td class="cam-properties">Đợt thanh toán: </td>
 <td><select onclick="loadPayContent()" class="custom-select select-profile  browser-default"  name="pay_step" id="payStep">
                  <option value="1"> 1 Đợt </option>
                  <option value="2"> 2 Đợt </option>
                  <option value="3"> 3 Đợt </option>
                  <option value="4"> 4 Đợt </option>
                  <option value="5"> 5 Đợt </option>
                </select></td>

            </tbody>

             <tbody class="table-edit" id="payContent">
              <tr><td class="cam-properties">Đợt 1: </td><td class="cam-properties"><input  type='currency' value="" name="pay1" class="input-edit modol-text" placeholder="$$$$" required=""></td><td class="cam-properties"> <input type="date" id="paydate1" class="input-edit modol-text form-control" name="pay_date1" id="" required=""></td></tr>
             </tbody>

             <tbody class="table-edit">
              <tr>
                  <td >
                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Cập nhật  &nbsp;&nbsp; </button></td>
                  <td>
                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoát</button>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
    </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade modol-text" id="chooseConsumer" role="dialog">
  <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 75%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">Chọn khách hàng</div>
              <div class="modal-body">
<div class="search-con-input proxy-add" title="Serach">
                        <input type="text" class="textbox" id="search-con-input" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div>

                  <table id="consumer-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Tên</th>
                            <th>Chứng minh thư</th>
                            <th>Số điện thoại </th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($consumers as $consumer)
                            <tr class="color-add">
                            
                              <td><a><span id="cname{{$consumer->id}}"> {{$consumer->name}}</span></a></td>

                                <td> <span id="cindetify{{$consumer->id}}">{{$consumer->identify_card}}</span></a></td>
                                <td id="cphone{{$consumer->id}}"> {{$consumer->phone_number}}</td>
                              
                              <td><button style="color: white"  type="button" onclick="getConsumer('{{$consumer->name}}','{{$consumer->id}}')" class="btn btn-del Disable"><i class="fa fa-check-circle" aria-hidden="true" style="font-size: 1.2rem;"></i></button>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
 </div>
            </div>
          </div>
      </div></div>
<!-- Thay doi cau hinh  -->


<!-- Modal -->
<div class="modal fade modol-text" id="zone-info" role="dialog">
  <div class="modal-dialog model-right" style="min-height: 100%important;max-width: 709px!important;height: auto!important">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" >
        <label>Thông tin chi tiết</label>
      </div>
      <div class="notification"></div>
      <form action="edit-map-config" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="id" id="confirm_id">
        <div class="modal-body">
         <ul id = "basic_info" class="list-group">
            <li class="list-group-item">
            <a>
            <b class="color-b">Tên:</b>
            <input value="oke" name="name" id="nameInfo" class="input-edit modol-text" required="">
            </li></ul>

                    <ul id = "confirm_info"  class="list-group">
            <li class="list-group-item">

             <button type="submit" class="btn btn-model"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>   


             <button type="button" class="btn btn-model" onclick="deleteZonePhp()" id="nvr-add"> &nbsp;&nbsp; Xoá &nbsp;&nbsp; </button>   


               <button type="button" class="btn btn-model" data-dismiss="modal" id="nvr-add"> &nbsp;&nbsp; Thoát &nbsp;&nbsp; </button>
            </li>
         </ul>
</form>

        </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="js-css/js/socket.io.js"></script>


<script type="text/javascript">
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
  var value_before;

  function listenForDoubleClick(element) {
    element.contentEditable = true;
    value_before = element.textContent;
    setTimeout(function() {
      if (document.activeElement !== element) {
        element.contentEditable = false;
      }
    }, 300);
  }

  function closeInput(element) {
    element.contentEditable=false;
  }

  function updateCamModel(element, cam_id) {
  //loading_nomal();
  element.contentEditable=false;
  if(element.textContent == ""){
    value = "value_is_null";
  }
  else{
    value = element.textContent;
    arrays = [value];
    try{
      $.ajax({
        type: "POST",
        data : {"_token": $('meta[name="csrf-token"]').attr('content'),arrays},
        url : "update-cam-model/"+cam_id,
        success: function(msg){
          //close_loading()
          if(msg == "true"){
            notifiSuccess("Update successful.");
          }
          else{
            //close_loading()
            notifiWarning("Update failed.");
            document.getElementById("model").textContent = value_before;
          }
        }
      })
    }
    catch(err) {
      close_loading()
      console.log(err.message);
    }
  }
}

function updateLocation(element, cam_id) {
  //loading_nomal();
  element.contentEditable=false;
  if(element.textContent == ""){
    value = "value_is_null";
  }
  else{
    value = element.textContent;
    arrays = [value];
    try{
      $.ajax({
        type: "POST",
        data : {"_token": $('meta[name="csrf-token"]').attr('content'),arrays},
        url : "update-cam-location/"+cam_id,
        success: function(msg){
          //close_loading()
          if(msg == "true"){
            notifiSuccess("Update successful.");
          }
          else{
            //close_loading()
            notifiWarning("Update failed.");
            document.getElementById("location").textContent = value_before;
          }
        }
      })
    }
    catch(err) {
      close_loading()
      console.log(err.message);
    }
  }
}


function updateRTSPLink(element, cam_id) {
  //loading_nomal();
  element.contentEditable=false;
  if(element.textContent == ""){
    value = "value_is_null";
  }
  else{
    value = element.textContent;
    arrays = [value];
    try{
      $.ajax({
        type: "POST",
        data : {"_token": $('meta[name="csrf-token"]').attr('content'),arrays},
        url : "update-cam-rtsp-link/"+cam_id,
        success: function(msg){
          //close_loading()
          if(msg == "true"){
            notifiSuccess("Update successful.");
          }
          else{
            //close_loading()
            notifiWarning("Update failed.");
            document.getElementById("rtsp_link").textContent = value_before;
          }
        }
      })
    }
    catch(err) {
      close_loading()
      console.log(err.message);
    }
  }
}

function updateCamName(element, cam_id) {
  //loading_nomal();
  element.contentEditable=false;
  if(element.textContent == ""){
    value = "value_is_null";
  }
  else{
    value = element.textContent;
    arrays = [value];
    try{
      $.ajax({
        type: "POST",
        data : {"_token": $('meta[name="csrf-token"]').attr('content'),arrays},
        url : "update-cam-name/"+cam_id,
        success: function(msg){
          //close_loading()
          if(msg == "true"){
            notifiSuccess("Update successful.");
          }
          else{
            //close_loading()
            notifiWarning("Update failed.");
            document.getElementById("cam_name").textContent = value_before;
          }
        }
      })
    }
    catch(err) {
      close_loading()
      console.log(err.message);
    }
  }
}

function updateCamPass(element, cam_id) {
  //loading_nomal();
  element.contentEditable=false;
  if(element.textContent == ""){
    value = "value_is_null";
  }
  else{
    value = element.textContent;
    arrays = [value];
    try{
      $.ajax({
        type: "POST",
        data : {"_token": $('meta[name="csrf-token"]').attr('content'),arrays},
        url : "update-cam-pass/"+cam_id,
        success: function(msg){
          //close_loading()
          if(msg == "true"){
            notifiSuccess("Update successful.");
          }
          else{
            //close_loading()
            notifiWarning("Update failed.");
            document.getElementById("cam_pass").textContent = value_before;
          }
        }
      })
    }
    catch(err) {
      close_loading()
      console.log(err.message);
    }
  }
}

var edge_id_current = $("#edge-id").val();

function updateCamEdgeID(cam_id) {
  //loading_nomal();
  edge_id = $("#edge-id").val();
  try{
    $.get("update-cam-edgeid/"+cam_id+"/"+edge_id, async function(res) {
        //close_loading()
        if(res == "true"){
          notifiSuccess("Update successful.");
          edge_id_current = edge_id;
        }
        else{
          //close_loading()
          notifiWarning("Update failed.");
          $('#edge-id').val(edge_id_current);
        }
      })


  }
  catch(err) {
    close_loading()
    console.log(err.message);
  }
}

var curent_encode = $("#encode").val();
function updateEncode(cam_id) {
  //loading_nomal();
  encode = $("#encode").val();
  try{
    $.get("update-cam-encode/"+cam_id+"/"+encode, async function(res) {
        //close_loading()
        if(res == "true"){
          notifiSuccess("Update successful.");
          curent_encode = encode;
        }
        else{
          //close_loading()
          notifiWarning("Update failed.");
          $('#encode').val(curent_encode);
        }
      })


  }
  catch(err) {
    close_loading()
    console.log(err.message);
  }
}


var nvr_id_current = $("#edge-id").val();
function updateCamNvrID(cam_id) {
  //loading_nomal();
  nvr_id = $("#nvr-id").val();
  JSconfirmUpdateCamNvr(" Are you sure? ",cam_id, nvr_id)
}


function JSconfirmUpdateCamNvr(text, cam_id, nvr_id){
  swal({ 
   title: "",   
   text: text,   
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
       loading_nomal();
       try{
        $.get("update-cam-nvrid/"+cam_id+"/"+nvr_id, async function(res) {
          if(res == "true"){
            notifiSuccess("Update successful.");
            nvr_id_current = nvr_id;
          }
          else{
                //close_loading()
                notifiWarning("Update failed.");
                $('#nvr-id').val(nvr_id_current);
              }
              close_loading();
              swal.close(); 
            })


      }
      catch(err) {
        close_loading();
        swal.close(); 
        $('#nvr-id').val(nvr_id_current);
        console.log(err.message);
      }
    } 
    else {  
      $('#nvr-id').val(nvr_id_current);
      swal.close();  
    } 
  });
  $(".btn-primary").css('border', 'none');
  $(".showSweetAlert").attr('style', 'display: block;');
  $(".text-muted").attr('style', 'color: #fff !important');
}

function confirmDeal(){
  var id = document.getElementById("confirm_id").value
  swal({ 
   title: "",   
   text: "Comfirm this deal?",   
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
       loading_nomal();
       try{
        $.get("confirm-deal/"+id, async function(res) {
          location.reload()
         });

      }
      catch(err) {
        close_loading();
        swal.close(); 
      }
    } 
    else {  
      swal.close();  
    } 
  });
}

function deleteZonePhp(){
  var id = document.getElementById("confirm_id").value
  var state = 0
  if(state == 0){
  swal({ 
   title: "",   
   text: "Delete this zone?",   
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
       loading_nomal();
       try{
        $.get("delete-map-config/"+id, async function(res) {
          location.reload()
         });

      }
      catch(err) {
        close_loading();
        swal.close(); 
      }
    } 
    else {  
      swal.close();  
    } 
  });
  }
  else{
     swal({ 
   title: "",   
   text: "Can not delete zone in process?",   
   type: "info",   });
  }
}


$("#brightness").on('input', function() {
  console.log(this.value);
});


</script>

<script type="text/javascript">
  var myTimer = 1;
  function getSnapshot(){
    $("#snapshot-zone").attr("src", "snapshot.jpg");

  }

  function stopgetSnapshot(){
    myTimer = 0;
  }

  
</script>



<script src="js-css/datatables/jquery.dataTables.js"></script>
<script src="js-css/datatables/dataTables.bootstrap4.js"></script>
<!-- ve zone camera -->
<script type="text/javascript">

document.getElementById('paydate1').valueAsDate = new Date();
  var ZonePosition = []
  var ZonePositionIndex = []

   function getZPList(){
  $.ajax({
    type: "GET",
    url: '/system/zone-position-list/',
    success: function (response) {
      response = (JSON.parse(response))
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


        html = '<select class="custom-select select-profile  browser-default" name="position">'


      for(var i =0; i < response.length; i++){
          html = html +'<option  value="'+response[i].id+'">'+response[i].name+'</option>'

        ZonePositionIndex.push(response[i].name)
        ZonePosition.push(response[i].id)         
      }

        html = html + '</select>'
        document.getElementById("PosInput").innerHTML=html;

    }
  });
}

getZPList()

  var dragging = false, drawing = false, startPoint;
  var svg = d3.select('#zone-body').append('svg')
  .attr('width', '100%'); 

  svg[0][0].setAttribute("style", "z-index:500;position: absolute; width: 100%; height: 100%;left: 0;top: 0;");
  var totalPoints = []
  var totalState = []
  var totalId = []
  var totalContribute = []
  var points = [], g;

  function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }

  async function getZone(){

  $(".display").remove();
  $("#zone_content").empty();
    myTimer = 1;
    // $("#zone_content").empty();
    // getSnapshot();
    var pology;
    $.ajax({
      url: "get-map-config/{{$id}}",
      success: async function(res) {
        res = JSON.parse(res)
        console.log(res)
        while(true){
          if($("svg").width() == 0){
            await sleep(10);
            continue;
          }
          else{
            pology = '';
            try{
              await res.forEach(createPology);
              await $("svg").html(pology);
              break;
            }
            catch(err) {
              console.log(err.message);
              break;
            }
          }
        }
// $('#zone-table').DataTable({
//                     "order": [[ 3, "desc" ]]
//                 })
         
      }
    });
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
    function createPology(data) {
      // console.log(data)
      var zone = data.zone
      zone = zone.slice(1, zone.length-1);
      zone = zone.split(",")


      var ratio = ($("svg").width())/720;
      // console.log(ratio)
      // var zone = data.map(x => x * ratio);
      
       var binary_zone = [];
      var medium_x = 0;
      var medium_y = 0;
      var max_x = 0;
      var min_x = 10000;
      var max_y = 0;
      var min_y = 10000;
      

      for (i = 0; i <zone.length;i++){
        if (i %2 == 0){
          // console.log(zone[i])
          // console.log(zone[i+1])
          zone[i] = parseInt(zone[i])*ratio
          zone[i+1] = parseInt(zone[i+1])*ratio

          medium_x = medium_x + zone[i]
          medium_y = medium_y + zone[i+1]

          if(max_x < zone[i]){
            max_x = zone[i];
          }
          if(min_x > zone[i]){
            min_x = zone[i]
          }

           if(max_y < zone[i+1]){
            max_y = zone[i+1];
          }
          if(min_y > zone[i+1]){
            min_y = zone[i+1]
          }
          binary_zone.push([parseInt(zone[i]),parseInt(zone[i+1])]);
        }
      }

      totalPoints.push(binary_zone)
      totalId.push(data.id)
      totalState.push(data.name)

    // Insert new cells (<td> elements) at the 1st and 2nd 
      // console.log(zone)
       pology = pology + '<g><polygon points="'+zone.toString()+'" style="fill: rgba(255, 255, 0, 0.8);"></polygon></g>';

medium_x = parseInt(medium_x/parseInt(zone.length/2))
      medium_y = parseInt(medium_y/parseInt(zone.length/2))


      totalContribute.push(data.contribute_state)

     pology = pology + '<g><polygon points="'+zone.toString()+'" style="fill: rgba(255, 0, 0, 0.0);"></polygon></g>';
       var div = document.createElement('div');

}
  }

  function loadZoneData(id,state){
    console.log(id)
    console.log(document.getElementById("nameInfo").value)
  document.getElementById("confirm_id").value = id

document.getElementById("nameInfo").value = state

  $("#zone-info").modal('show');

  }

  function pointInPolygon(point, vs) {
    var xi, xj, i, intersect,
    x = point[0],
    y = point[1],
    inside = false;
    for (var i = 0, j = vs.length - 1; i < vs.length; j = i++) {
      xi = vs[i][0],
      yi = vs[i][1],
      xj = vs[j][0],
      yj = vs[j][1],
      intersect = ((yi > y) != (yj > y))
      && (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
      if (intersect) inside = !inside;
    }
    return inside;
  }

// behaviors
var dragger = d3.behavior.drag()
.on('drag', handleDrag)
.on('dragend', function(d){
  dragging = false;
});


svg.on('click', function(){
  $(".popup").hide();

  status = document.getElementById("zoneStatus").value;
  if (status == 1){
    if(dragging) return;
    drawing = true;
    startPoint = [d3.mouse(this)[0], d3.mouse(this)[1]];
    if(svg.select('g.drawPoly').empty()) g = svg.append('g').attr('class', 'drawPoly');
    if(d3.event.target.hasAttribute('is-handle')) {
      closePolygon();
      return;
    };
    points.push(d3.mouse(this));
    console.log(points)
    g.select('polyline').remove();
    var polyline = g.append('polyline').attr('points', points)
    .style('fill', 'none')
    .attr('stroke', '#000');
    for(var i = 0; i < points.length; i++) {
      g.append('circle')
      .attr('cx', points[i][0])
      .attr('cy', points[i][1])
      .attr('r', 4)
      .attr('fill', 'yellow')
      .attr('stroke', '#000')
      .attr('is-handle', 'true')
      .style({cursor: 'pointer'});
    }
  }else{
    res = false;
    var index = 0;
    for (i = 0; i <totalPoints.length;i++){
      flag = pointInPolygon(d3.mouse(this),totalPoints[i])
      if (flag == true){
        index =i
        res = true
        break
      }
    }
    console.log(res)
    if (res == true){
      popup(event,totalId[index],totalState[index])
  }
}
});
function popup(event,id,state) {
zoomOutMobile(1);
 
// document.body.style.zoom="100%"
// console.log("123213")
  // console.log(event.clientX)
  // console.log(event.clientY)
  if (state == -1){
    temp = document.getElementById("zone"+id+"price").innerHTML ;

    window.location.href = "/area-information/" + temp
  }else{
  <?php
    $depart = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->department_id;
  ?>
  if (parseInt("0"+ "{{$depart}}") == 1){
  $(".popup").css({left: event.pageX + $(window).height()*0.01});
  $(".popup").css({top: event.pageY + $(window).height()*0.01 });
  $(".popup").show();
    $("#myPopup").html('<div class = "row"><div class="col-8"><img src= "js-css/img/preview.jpg" style="width:100px;height:100px" ></div><div class="col-2><button class="preview" onclick ="loadZoneData('+id+','+state+')"> <i class="fa fa-eye" aria-hidden="true"></i></button><br><hr><button class="preview" onclick ="loadTransaction('+id+','+state+')" > <i class="fa fa-info" aria-hidden="true"></i></button></div></div>')

      }else{
        loadZoneData(id,state)
      }
  }
  // $("#zone_content").empty();
  //   getZone()

}
function loadTransaction(id,state){
  if (state == 0){
  location.href="/trans/"+id
    document.getElementById("tran_id").value = id;

    document.getElementById("tran-zone").innerHTML = document.getElementById("zone"+id+"name").innerHTML ;
    document.getElementById("tran-price").innerHTML = document.getElementById("zone"+id+"price").innerHTML ;

    document.getElementById("tran-deposit").innerHTML = document.getElementById("zone"+id+"deposit").innerHTML ;

    document.getElementById("tran-view").innerHTML = document.getElementById("zone"+id+"view").innerHTML ;

    document.getElementById("tran-position").innerHTML = document.getElementById("zone"+id+"position").innerHTML;




    $("#transaction-modal").modal('show');
  }else{
    alert("this zone has been on the process")
  }
}
function closePolygon() {
  svg.select('g.drawPoly').remove();
  var g = svg.append('g');
  g.append('polygon')
  .attr('points', points)
  .style('fill', getRandomColor());
  for(var i = 0; i < points.length; i++) {
    var circle = g.selectAll('circles')
    .data([points[i]])
    .enter()
    .append('circle')
    .attr('cx', points[i][0])
    .attr('cy', points[i][1])
    .attr('r', 4)
    .attr('fill', '#FDBC07')
    .attr('stroke', '#000')
    .attr('is-handle', 'true')
    .style({cursor: 'move'})
    .call(dragger);
  }

  var ratio = ($("svg").width())/720;
  let temp = points.slice();
  console.log(temp)
  temp = temp.map(x => [parseInt(x[0]) / ratio,parseInt(x[1]) / ratio]);
  console.log("!23123")
  console.log(temp)
  document.getElementById("zone_input").value = temp;
  totalPoints.push(temp)
  $("#new-zone").modal('show');

  points.splice(0);
    // console.log("doine")
    // console.log(temp)
    // console.log(points)
    drawing = false;
  }
  svg.on('mousemove', function() {

    status = document.getElementById("zoneStatus").value;
    if (status == 1){
      if(!drawing) return;
      var g = d3.select('g.drawPoly');
      g.select('line').remove();
      var line = g.append('line')
      .attr('x1', startPoint[0])
      .attr('y1', startPoint[1])
      .attr('x2', d3.mouse(this)[0] + 2)
      .attr('y2', d3.mouse(this)[1])
      .attr('stroke', '#53DBF3')
      .attr('stroke-width', 1);
    }else{
      var test =1;
      // console.log([d3.mouse(this)[0], d3.mouse(this)[1]]);
    }
  })
  function handleDrag() {
    if(drawing) return;
    var dragCircle = d3.select(this), newPoints = [], circle;
    dragging = true;
    var poly = d3.select(this.parentNode).select('polygon');
    var circles = d3.select(this.parentNode).selectAll('circle');
    dragCircle
    .attr('cx', d3.event.x)
    .attr('cy', d3.event.y);
    for (var i = 0; i < circles[0].length; i++) {
      circle = d3.select(circles[0][i]);
      newPoints.push([circle.attr('cx'), circle.attr('cy')]);
    }
    poly.attr('points', newPoints);
  }
  function getRandomColor() {
    // var letters = '0123456789ABCDEF'.split('');
    // var color = '#';
    // for (var i = 0; i < 6; i++) {
    //     color += letters[Math.floor(Math.random() * 16)];
    // }
    return "#ff00004d";
  }

  function deleteZone(){
    var coutChild = $("svg g").length;
    $("svg").children()[coutChild-1].remove();
  }

  function updateZone(){
    zones = [$("svg").width(),$("svg").height()];
    for(var i=0; i<$("svg g").length ; i++){
      zones.push(($("svg").children()[i]).childNodes[0].getAttribute('points'));
    }
    try{
      $.ajax({
        type: "POST",
        data : {"_token": $('meta[name="csrf-token"]').attr('content'),zones},
        url : "update-zone/"+{!! $area->id !!},
        success: function(msg){
          //close_loading()
          if(msg == "true"){
            $('#zone').modal('hide');
            myTimer = 0;
            notifiSuccess("Update successful.");
          }
          else{
            //close_loading()
            myTimer = 0;
            $('#zone').modal('hide');
            notifiWarning("Update failed.");
          }
        }
      })
    }
    catch(err) {
      close_loading()
      console.log(err.message);
      myTimer = 0;
      $('#zone').modal('hide');
      notifiWarning("Update failed.");
    }
  }

</script>

<script type="text/javascript">
  function fixZone(){
    status = document.getElementById("zoneStatus").value;
    if (status != 1){
      document.getElementById("zoneStatus").value = 1;
      document.getElementById("btnFixZone").innerHTML = "Done";
    }else{
      document.getElementById("zoneStatus").value = 0;
      document.getElementById("btnFixZone").innerHTML = "Fix Zone";

    }
  }

  $( ".icon-edge-detail" ).click(function() {
    if($("#edge-id").val() != 0){
      window.location.href = 'edge-information/'+$("#edge-id").val();
    }
  });

  $( ".icon-storage-detail" ).click(function() {
    if($("#nvr-id").val() != 0){
      window.location.href = 'listcamnvr/'+$("#nvr-id").val();
    }
  });
  // getZone();
</script>
<script type="text/javascript">
    $("#search-input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#zone-table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });


    $("#search-con-input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#consumer-table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
 $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });

// document.getElementById("close-menu-btn").onclick = function() {getZone()};

function getConsumer(name,id){
  document.getElementById("con_id").value = id;
  document.getElementById("tran-consumer_name").innerHTML = name
}

function chooseConsumer(){
  console.log("oke")
  $("#chooseConsumer").modal()
}

function newConsumer(type){
    document.getElementById("con_type").value = type 
  if (type == 0){
    document.getElementById("conInputContent").innerHTML = '<tr><td class="cam-properties"> Tên khách hàng</td><td>  <input value="" name="name" class="input-edit modol-text" required=""></td></tr><tr><td class="cam-properties">Điện thoại</td><td><input value="" id="" name="phone" class="input-edit modol-text" required=""></td></tr><tr><td class="cam-properties"> Số căn cước</td><td><input value="" id="" name="identify" class="input-edit modol-text" required=""></td></tr>'
  }else{

    document.getElementById("conInputContent").innerHTML = '<td>Tên khách hàng: </td><td id="tran-consumer_name"></td><input type="hidden" value="" id="con_id" name="con_id" class="input-edit modol-text" required=""></td><td><button type="button" onclick="chooseConsumer()" class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Chọn &nbsp;&nbsp; </button></td></td>' 

  }
}
newConsumer(0)
function zoomOutMobile(flag) {
  
    var viewport = document.querySelector("meta[name='viewport']");
    viewport.content = "width=400, maximum-scale=0.635";
    setTimeout(function() {
        viewport.content = "width=400, maximum-scale=10";
        if (flag == 0){

  // $("#zone_content").empty();
            getZone();


     // setTimeout(function(){ $('#zone-table').DataTable({
     //                "order": [[ 3, "desc" ]]
     //            }) }, 3000);
             


            if (window.innerWidth >500 && window.innerWidth <  750){
            menu_close()
          }
        }
    }, 350);
  

  // $(".popup").remove();
  //   getZone()
  }
zoomOutMobile(0) 

function display(flag){
  if (flag == 0){
$('.display').hide();
$('.popup').hide();
  }else{
    $('.display').show();
  }
}

function loadPayContent(){
  var pay = document.getElementById("payStep").value
  var html = ""
  for (i = 1; i < parseInt(pay) + 1;i++){
    html = html  + '<tr><td class="cam-properties">Đợt '+i+': </td><td class="cam-properties"><input  type="currency" value="" id="view" name="pay'+i+'" class="input-edit modol-text" placeholder="$$$$" required=""></td><td class="cam-properties"> <input type="date" class="input-edit modol-text form-control" name="pay_date'+i+'" id="" required=""></td></tr>'
  }
  document.getElementById("payContent").innerHTML = html;
}

var currencyInput = document.querySelector('input[type="currency"]')
var currency = 'VND' // https://www.currency-iso.org/dam/downloads/lists/list_one.xml

 // format inital value
onBlur({target:currencyInput})

// bind event listeners
currencyInput.addEventListener('focus', onFocus)
currencyInput.addEventListener('blur', onBlur)


function localStringToNumber( s ){
  return Number(String(s).replace(/[^0-9.-]+/g,""))
}

function onFocus(e){
  var value = e.target.value;
  e.target.value = value ? localStringToNumber(value) : ''
}

function onBlur(e){
  var value = e.target.value

  var options = {
      maximumFractionDigits : 2,
      currency              : currency,
      style                 : "currency",
      currencyDisplay       : "symbol"
  }
  
  e.target.value = (value || value === 0) 
    ? localStringToNumber(value).toLocaleString(undefined, options)
    : ''
}

</script>


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



@endsection
