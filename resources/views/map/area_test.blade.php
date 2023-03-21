@extends('layouts.index')
@section('content')
<script src="js-css/js/d3.min.js"></script>
<meta name="csrf-token" content="{!! csrf_token() !!}">
<style>
  /* Popup container - can be anything you want */
  .list-group-item{
    background-color:transparent!important;
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
  #container{
  width:100%;
  height:100%;
  overflow:hidden;
}
#slide{
  width:100%;
  height:100%;
  transition: transform .3s;
}
#img_test{
  width:auto;
  height:auto;
  max-width:100%;
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
          <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#content1">Bản đồ khu vực</a>
      </li>
      <!-- <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content2">Table</a>
      </li>
      <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content3">Statistic</a>
      </li> -->
    
    </ul>  
    <hr>
<div class="tab-content">
<div id="content1" class="tab-pane  in active">

<div  id="zone" role="dialog" data-backdrop="static">            <div class="modal-content">
  <div class="modal-body">
  <div id="container">
  <div id="slide">
    <img id= "img_test" src="js-css/img/area/{{$area->url}}">
  </div></div>
</div>
    <script src="js-css/js/dragZoom.js"></script>
    <script type="text/javascript">
    $(function() {
        $('#img_test').dragZoom({
            scope: $("body"),
            zoom: 2,
            onWheelStart: function() {

            }
        }, function() {});
    });
</script>
 <!--  <div class="modal-body" id="zone-body">
    <img src="js-css/img/area/{{$area->url}}" style="width: 100%; height: 100%;" id="snapshot-zone">
 -->
  </div>
  <div class="option-zone">
    <input type="hidden" value="" id="zoneStatus">
    <?php
      if(Auth()->user()->role_id <= 2){
    ?>
    <button class="btn btn-model" onclick="fixZone();" id="btnFixZone">Fix Zone</button>
    <a href="/area-contribute-information/{{$area->id}}" id="btnFixZone">Đổi sang chế đồ xây dựng </a>

    <?php
  }
    ?>

<a class="camera-button" href="/area-list/{{$area->project_id}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Trở lại </a>

<button type="button" id="refButton" class="camera-button" onclick="getZone()"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button>
  </div>
</div>
</div>
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
                            <th>Name</th>
                            <th>Area</th>
                            <th>Staff</th>
                            <th>Consumer</th>
                            <th>State</th>
                            <th>Price</th>
                            <th>Info</th>
                            <th>Deal</th>
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
      <form action="add-new-zone" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="modal-body">
          <table class="table-edit table-model">
            <tbody class="table-edit">
              <tr>
                <td class="cam-properties">Tên </td>
                <td><input value="test" type="" value="" name="name" id="zone_name" class="input-edit modol-text" required=""></td>
                <td><input type="hidden" value="" name="zones" id="zone_input" class="input-edit modol-text" required=""></td><input type="hidden" value="{{$area->id}}" name="area_id"  class="input-edit modol-text" required=""></td>
              </tr>
              <tr>
                <td class="cam-properties">Giá ước lượng (VND)</td>
                <td><input value="100000000" id="zone_price" name="price" class="input-edit modol-text" required=""></td>
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
  <div class="modal-dialog model-right">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label>New Transaction</label>
      </div>
      <div class="notification"></div>
      <form action="update-zone-consumer" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="modal-body">
          <table class="table-edit table-model">
            <tbody class="table-edit">
              <tr>
                <td class="cam-properties">Vị trí: </td>
                <td> {{$area->name}} </td>
              </tr>
              <tr>
                <td class="cam-properties">Khu vực: </td>
                <td id="tran-zone"></td>

              </tr>
              <tr>
                <td class="cam-properties">Giá: </td>
                <td id="tran-price"></td>

              </tr>
              <tr>
                <td class="cam-properties"> Tên khách hàng</td>
                <td>
                  <input type="hidden" value="" id="tran_id" name="zone_id" class="input-edit modol-text" required="">
                  <input value="" name="name" class="input-edit modol-text" required="">
                </td>
                </tr>
                <tr>
                <td class="cam-properties">Điện thoại</td>
                <td><input value="" id="" name="phone" class="input-edit modol-text" required=""></td>
              </tr>

              <tr>
                <td class="cam-properties"> Số căn cước</td>
                <td><input value="" id="" name="identify" class="input-edit modol-text" required=""></td>
              </tr>
              <tr>
                <td></td>
                <td>
                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Cập nhật  &nbsp;&nbsp; </button>
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
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="modal-body">
         <ul id = "basic_info" class="list-group">
            <li class="list-group-item">
            <a>
            <b class="color-b">Tên:</b>
            </a>  <i id="nameInfo"> </i> 
            </li>

            <li class="list-group-item">
            <a>
            <b class="color-b">Giá:</b>
            </a>  <i id="priceInfo"> </i> 
            </li>

            <li class="list-group-item">
            <a>
            <b class="color-b">Trạng thái:</b>
            </a>  <i id="stateInfo"> </i> 
            </li>
         </ul>
         <hr>
         <ul id = "consumer_info" class="list-group">
            <li class="list-group-item">
            <a>
            <b class="color-b">Tên khách hàng:</b>
            </a>  <i id="ConsumerNameInfo"> </i> 
            </li>

            <li class="list-group-item">
            <a>
            <b class="color-b">Điện thoại:</b>
            </a>  <i id="ConsumerPhoneInfo"> </i> 
            </li>
         </ul>

         <hr>
         <ul id = "staff_info" class="list-group">
            <li class="list-group-item">
            <a>
            <b class="color-b">Tên nhân viên:</b>
            </a>  <i id="StaffNameInfo"> </i> 
            </li>

            <li class="list-group-item">
            <a>
            <b class="color-b">Điện thoại:</b>
            </a>  <i id="StaffPhoneInfo"> </i> 
            </li>
         </ul>

         <hr>
         <ul id = "accountant_info" class="list-group">
            <li class="list-group-item">
            <a>
            <b class="color-b">Kiểm toán:</b>
            </a>  <i id="AccountantNameInfo"> </i> 
            </li>

            <li class="list-group-item">
            <a>
            <b class="color-b">Điện thoại:</b>
            </a>  <i id="AccountantPhoneInfo"> </i> 
            </li>
         </ul>
         <hr>
         <ul id = "date_info"  class="list-group">
            <li class="list-group-item">
            <a>
            <b class="color-b">Ngày đặt :</b>
            </a>  <i id="DepositDateInfo"> </i> 
            </li>

            <li class="list-group-item">
            <a>
            <b class="color-b">Ngày chuyển tiền:</b>
            </a>  <i id="CompleteDateInfo"> </i> 
            </li>
         </ul>
          <ul id = "confirm_info"  class="list-group">
            <li class="list-group-item">
              <input value="" type="hidden" id="confirm_id" name="confirm_id">
              <input value="" type="hidden" id="confirm_state" name="confirm_state">
             <button class="btn btn-model" onclick="confirmDeal()" id="nvr-add"> &nbsp;&nbsp; Xác nhận &nbsp;&nbsp; </button>
            </li>
          </ul>
         <?php
          if(Auth()->user()->role_id <= 2){

          ?>
          <ul id = "confirm_info"  class="list-group">
            <li class="list-group-item">
              <input value="" type="hidden" id="confirm_id" name="confirm_id">
             <button class="btn btn-model" onclick="deleteZonePhp()" id="nvr-add"> &nbsp;&nbsp; Delete Zone &nbsp;&nbsp; </button>
            </li>
         </ul>
         <?php
                  }
         ?>

        </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="js-css/js/socket.io.js"></script>

<!-- <script type="text/javascript">

  $(document).ready(function (){
  var scroll_zoom = new ScrollZoom($('#container'),4,0.5)
})

  function ScrollZoom(container,max_scale,factor){
    console.log("oke")
  max_scale = 3;
  var target = container.children().first()
  var size = {w:target.width(),h:target.height()}
  var pos = {x:0,y:0}
  var zoom_target = {x:0,y:0}
  var zoom_point = {x:0,y:0}
  var scale = 1
  target.css('transform-origin','0 0')
  // target.on("mousewheel DOMMouseScroll",scrolled)
  target.on("click DOMMouseScroll",scrolled)
  // target.addEventListener("click", scrolled);

  function scrolled(e){
    console.log("????")
    var offset = container.offset()
    zoom_point.x = e.pageX - offset.left
    zoom_point.y = e.pageY - offset.top

    e.preventDefault();
    var delta = e.delta || e.originalEvent.wheelDelta;
    if (delta === undefined) {
        //we are on firefox
        delta = e.originalEvent.detail;
      }
      delta = Math.max(-1,Math.min(1,delta)) // cap the delta to [-1,1] for cross browser consistency

      // determine the point on where the slide is zoomed in
      zoom_target.x = (zoom_point.x - pos.x)/scale
      zoom_target.y = (zoom_point.y - pos.y)/scale

      // apply zoom
      scale += delta*factor * scale
      scale = Math.max(1,Math.min(max_scale,scale))
      // scale = max_scale

      // calculate x and y based on zoom
      pos.x = -zoom_target.x * scale + zoom_point.x
      pos.y = -zoom_target.y * scale + zoom_point.y


      // Make sure the slide stays in its container area when zooming out
      if(pos.x>0)
          pos.x = 0
      if(pos.x+size.w*scale<size.w)
        pos.x = -size.w*(scale-1)
      if(pos.y>0)
          pos.y = 0
       if(pos.y+size.h*scale<size.h)
        pos.y = -size.h*(scale-1)

      update()
  }

  function update(){
    target.css('transform','translate('+(pos.x)+'px,'+(pos.y)+'px) scale('+scale+','+scale+')')
  }
}
</script> -->
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
  var state = document.getElementById("confirm_state").value
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
        $.get("delete-zone/"+id, async function(res) {
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



<!-- ve zone camera -->
<script type="text/javascript">

  var dragging = false, drawing = false, startPoint;
  var svg = d3.select('#zone-body').append('svg')
  .attr('width', '100%'); 

  svg[0][0].setAttribute("style", "position: absolute; width: 100%; height: 100%;left: 0;top: 0;");
  var totalPoints = []
  var totalState = []
  var totalId = []
  var points = [], g;

  function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }

  async function getZone(){
    myTimer = 1;
    // getSnapshot();
    var pology;
    $.ajax({
      url: "get-zone/"+{!! $area->id !!},
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
      console.log(data)
      var zone = data.zone
      zone = zone.slice(1, zone.length-1);
      zone = zone.split(",")


      var ratio = ($("svg").width())/720;
      // console.log(ratio)
      // var zone = data.map(x => x * ratio);
      
      var binary_zone = [];
      for (i = 0; i <zone.length;i++){
        if (i %2 == 0){
          // console.log(zone[i])
          // console.log(zone[i+1])
          zone[i] = parseInt(zone[i])*ratio
          zone[i+1] = parseInt(zone[i+1])*ratio
          binary_zone.push([parseInt(zone[i]),parseInt(zone[i+1])]);
        }
      }
      totalPoints.push(binary_zone)
      totalId.push(data.id)
      totalState.push(data.state)

     var table = document.getElementById("zone_content"); 
    var row = table.insertRow();

    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    var cell8 = row.insertCell(7);

    var staff = ""
    var consumer = ""
    var state = ""
    var info  = ""
    cell1.innerHTML = "<span id='zone" +data.id +"name'>"+data.name+"</span>"
  if (data.state == 0){
      staff = "<span>None</span>"
      consumer = "<span>None</span>"
      state = "<span id='zone" +data.id +"state'>Trống</span>"
      info ="<span id='zone" +data.id +"date'>None</span>"
   } else if (data.state == 1){
      staff = "<span id='zone" +data.id +"staff'>"+data.staff_name+"</span>"
      consumer = "<span id='zone" +data.id +"consumer'>"+data.consumer_name+"</span>"
      state = "<span id='zone" +data.id +"state'>Đợi thanh toán</span>"
      info = "<span id='zone" +data.id +"date'> Ngày đặt: "+data.deposit_date +"</span>"
   } else if (data.state == 2){
      staff = "<span id='zone" +data.id +"staff'>"+data.staff_name+"</span>"
      consumer = "<span id='zone" +data.id +"consumer'>"+data.consumer_name+"</span>"
      state = "<span id='zone" +data.id +"state'>Đã thanh toán</span>"
      info = "<span id='zone" +data.id +"date'> Ngày đặt: "+data.deposit_date+"<br> Ngày thành toán: "+data.complete_date +"</span>"
   } 

    cell2.innerHTML = "<span>{!! $area->name !!}</span>"
    cell3.innerHTML = staff
    cell4.innerHTML = consumer
    cell5.innerHTML = state
    cell6.innerHTML = "<span id='zone" +data.id +"price'>"+formatMoney(data.price)+" VND</span>"
    cell7.innerHTML = info

    hidden_input = ""

    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"consumer_phone_number' value='"+data.consumer_phone_number+"'>"

    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"consumer_identify_card' value='"+data.consumer_identify_card+"'>"

    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"staff_phone_number' value='"+data.staff_phone_number+"'>"

    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"staff_identify_card' value='"+data.staff_identify_card+"'>"

    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"accountant_name' value='"+data.accountant_name+"'>"

    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"accountant_phone_number' value='"+data.accountant_phone_number+"'>"


    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"deposit_date' value='"+data.deposit_date+"'>"


    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"complete_date' value='"+data.complete_date+"'>"



    cell8.innerHTML = hidden_input + '<i class="fa fa-eye" aria-hidden="true" onclick = "loadZoneData('+data.id+','+data.state+')"></i>'
      // console.log(zone)
      if (data.state == 0){

         <?php
          if(Auth()->user()->role_id <= 2){

          ?>
      pology = pology + '<g><polygon points="'+zone.toString()+'" style="fill: rgba(255, 0, 0, 0.3);"></polygon></g>';
      <?php
      } else{
      ?>

      pology = pology + '<g><polygon points="'+zone.toString()+'" style="fill: rgba(255, 0, 0, 0.0);"></polygon></g>';
      <?php
    }
      ?>
      }else if (data.state == 1){    
      pology = pology + '<g><polygon points="'+zone.toString()+'" style="fill: rgba(0, 0, 255, 0.3);"></polygon></g>';
      }
      else if (data.state == 2){    
      pology = pology + '<g><polygon points="'+zone.toString()+'" style="fill: rgba(0, 0, 255, 1);"></polygon></g>';
      }
      else if (data.state == 3){    
      pology = pology + '<g><polygon points="'+zone.toString()+'" style="fill: rgba(0, 255, 0, 0.5);"></polygon></g>';
      }
    }
  }

  function loadZoneData(id,state){
    console.log(id)
  document.getElementById("confirm_id").value = id
  document.getElementById("confirm_state").value = state
  document.getElementById("consumer_info").style.display = "none";
  document.getElementById("staff_info").style.display = "none";
  document.getElementById("accountant_info").style.display = "none";
  document.getElementById("date_info").style.display = "none";
  document.getElementById("confirm_info").style.display = "none";

document.getElementById("nameInfo").innerHTML = document.getElementById("zone"+id+"name").innerHTML ;
      document.getElementById("priceInfo").innerHTML = document.getElementById("zone"+id+"price").innerHTML ;
      document.getElementById("stateInfo").innerHTML = document.getElementById("zone"+id+"state").innerHTML ;
    if (state == 1){    
        document.getElementById("consumer_info").style.display = "block";
        document.getElementById("staff_info").style.display = "block";
        document.getElementById("date_info").style.display = "block";

      if (parseInt("0"+ "{{Auth()->user()->role_id}}") == 4){
        document.getElementById("confirm_info").style.display = "block";
      }
        

      document.getElementById("ConsumerNameInfo").innerHTML = document.getElementById("zone"+id+"consumer").innerHTML ;
      document.getElementById("ConsumerPhoneInfo").innerHTML = document.getElementById("zone"+id+"consumer_phone_number").value ;

      document.getElementById("StaffNameInfo").innerHTML = document.getElementById("zone"+id+"staff").innerHTML  ;
      document.getElementById("StaffPhoneInfo").innerHTML = document.getElementById("zone"+id+"staff_phone_number").value ;


      document.getElementById("DepositDateInfo").innerHTML =document.getElementById("zone"+id+"deposit_date").value ;
      document.getElementById("CompleteDateInfo").innerHTML = "None";



    }
    else if (state == 2){  
        document.getElementById("consumer_info").style.display = "block";
        document.getElementById("staff_info").style.display = "block";
        document.getElementById("accountant_info").style.display = "block";
        document.getElementById("date_info").style.display = "block";

      document.getElementById("nameInfo").innerHTML = document.getElementById("zone"+id+"name").innerHTML ;
      document.getElementById("priceInfo").innerHTML = document.getElementById("zone"+id+"price").innerHTML ;
      document.getElementById("stateInfo").innerHTML = document.getElementById("zone"+id+"state").innerHTML ;

      document.getElementById("ConsumerNameInfo").innerHTML = document.getElementById("zone"+id+"consumer").innerHTML ;
      document.getElementById("ConsumerPhoneInfo").innerHTML = document.getElementById("zone"+id+"consumer_phone_number").value ;

      document.getElementById("StaffNameInfo").innerHTML = document.getElementById("zone"+id+"staff").innerHTML  ;
      document.getElementById("StaffPhoneInfo").innerHTML = document.getElementById("zone"+id+"staff_phone_number").value ;

      document.getElementById("AccountantNameInfo").innerHTML = document.getElementById("zone"+id+"accountant_name").value ;
      document.getElementById("AccountantPhoneInfo").innerHTML = document.getElementById("zone"+id+"accountant_phone_number").value ;

      document.getElementById("DepositDateInfo").innerHTML =document.getElementById("zone"+id+"deposit_date").value ;
      document.getElementById("CompleteDateInfo").innerHTML =document.getElementById("zone"+id+"complete_date").value ;


    }


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

  // console.log(event.clientX)
  // console.log(event.clientY)
  if (state == -1){
    temp = document.getElementById("zone"+id+"price").innerHTML ;

    window.location.href = "/area-information/" + temp
  }else{
  if (parseInt("0"+ "{{Auth()->user()->role_id}}") == 3){
  $(".popup").css({left: event.pageX + $(window).height()*0.01});
  $(".popup").css({top: event.pageY + $(window).height()*0.01 });
  $(".popup").show();
    $("#myPopup").html('<ul class="list-group"><li class="list-group-item"> <button onclick ="loadZoneData('+id+','+state+')" class="btn btn-model"> Chi tiết</button> </li><li class="list-group-item"><button  class="btn btn-model" style="background-color: blue" onclick ="loadTransaction('+id+','+state+')" > Hợp đồng </button> </li></ul>')

      }else{
        loadZoneData(id,state)
      }
  }
}
function loadTransaction(id,state){
  if (state == 0){
    document.getElementById("tran_id").value = id;

    document.getElementById("tran-zone").innerHTML = document.getElementById("zone"+id+"name").innerHTML ;
    document.getElementById("tran-price").innerHTML = document.getElementById("zone"+id+"price").innerHTML ;

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
 $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });

// document.getElementById("close-menu-btn").onclick = function() {getZone()};



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
