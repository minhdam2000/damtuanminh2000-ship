@extends('layouts.index')
@section('content')
<script src="js-css/js/d3.min.js"></script>
<meta name="csrf-token" content="{!! csrf_token() !!}">

<style>
  /* Popup container - can be anything you want */
  .list-group-item{
    background-color:transparent!important;
  }
  h2{
    font-weight: 900
  }
  .popup {
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
  /* Toggle this class - hide and show the popup */
  
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
          <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#content1">Bản đồ khu vực </a>
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
  <div class="modal-body" id="zone-body">
    <img src="js-css/img/area/{{$area->url}}" style="width: 100%; height: 100%;" id="snapshot-zone">
  </div>
  <div class="option-zone">
    <input type="hidden" value="" id="zoneStatus">
    <?php
      if(Auth()->user()->role_id <= 2){
    ?>
    <button class="btn btn-model" onclick="fixZone();" id="btnFixZone">Thêm zone</button>
<a class="camera-button" href="/area-information/{{$area->id}}" >Đổi về bản đồ bán hàng</a>

    <?php
  }
    ?>
<!-- 
<a class="camera-button" href="/area-list/{{$area->project_id}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Trở lại</a>

<button type="button" id="refButton" class="camera-button" onclick="getZone()"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button> -->

          <button  type="button"  class="btn btn-model"><a href="/icon/build/" > Quay lại</a></button>
          
<button type="button" id="testButton" class="camera-button" onclick="getZone()"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button>
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
<div class="modal fade modol-text" id="new-history-zone" role="dialog">
  <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 55%">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label>Quản lý tiến độ</label>
      </div>
      <div class="notification"></div>
      <form action="add-history-zone"  enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="modal-body">
              <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#contentl1"> Xem lịch sử thi công </a>
      </li>
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#contentl2">Cập nhật tiến độ</a>
      </li>
    
    </ul>  
    <hr>
 <div class="tab-content">

          <div id="contentl1" class="tab-pane  in active">
            <h3 id= "zone_name1"></h3>
                      <div class="search-input proxy-add" title="Serach">
                        <input type="text" class="textbox" id="search-input" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div>
<table id="zone-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Sự kiện </th>
                            <th>Giai đoạn</th>
                            <th>Thời gian</th>
                            <th>Minh chứng </th>
                          </tr>
                        </thead>
                        <tbody class="tbody" id="zone_history">

                        </tbody>
                      </table>
          </div>
<div id="contentl2" class="tab-pane fade">
          <table class="table-edit table-model">
            
            <tbody class="table-edit">
              <tr>

                <td  class="cam-properties"> Tên: </td>
                <td><b id= "zone_name"></b></td>
              </tr>
              <tr>

                <td class="cam-properties">Mô tả</td>
                <td><input value="" type="" value="" name="des" class="input-edit modol-text" required=""></td>
                <input type="hidden" value="" name="id" id="zone_id" class="input-edit modol-text" required=""></td>
              </tr>
              <tr>
                <td class="cam-properties">Giai đoạn</td>
                 <td>
                  <select name="state" id="contribute_state">
                    <option value="1">Làm móng</option>
                    <option value="2">Xây dựng cơ bản</option>
                    <option value="3">Hoàn thiện</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="cam-properties">Minh chứng </td>
                 <td><label  class="preview" for="file-input"><img onclick="openfileupload(1)"  src="/js-css/img/icon/upload.png"></label><input  id= "inputfile1" style="display:none" type="file" name="file[]" class="form-control" multiple>
                </td>
              </tr>

              <tr>
                <td></td>
                <td>
                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm  &nbsp;&nbsp; </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>
    </div></div>
     <div class="modal-footer" style="    position: inherit;">

                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>

    </div>
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
                <td class="cam-properties">Area: </td>
                <td> {{$area->name}} </td>
              </tr>
              <tr>
                <td class="cam-properties">Zone: </td>
                <td id="tran-zone"></td>

              </tr>
              <tr>
                <td class="cam-properties">Price: </td>
                <td id="tran-price"></td>

              </tr>
              <tr>
                <td class="cam-properties"> Consumer name</td>
                <td>
                  <input type="hidden" value="" id="tran_id" name="zone_id" class="input-edit modol-text" required="">
                  <input value="" name="name" class="input-edit modol-text" required="">
                </td>
                </tr>
                <tr>
                <td class="cam-properties"> Consumer Phone</td>
                <td><input value="" id="" name="phone" class="input-edit modol-text" required=""></td>
              </tr>

              <tr>
                <td class="cam-properties"> Consumer ID card</td>
                <td><input value="" id="" name="identify" class="input-edit modol-text" required=""></td>
              </tr>
              <tr>
                <td></td>
                <td>
                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Update &nbsp;&nbsp; </button>
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

<!-- Thay doi cau hinh  -->


<!-- Modal -->
<div class="modal fade modol-text" id="zone-info" role="dialog">
  <div class="modal-dialog model-right" style="min-height: 100%important;max-width: 709px!important;height: auto!important">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" >
        <label>Zone detail</label>
      </div>
      <div class="notification"></div>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="modal-body">
         <ul id = "basic_info" class="list-group">
            <li class="list-group-item">
            <a>
            <b class="color-b">Name:</b>
            </a>  <i id="nameInfo"> </i> 
            </li>

            <li class="list-group-item">
            <a>
            <b class="color-b">Price:</b>
            </a>  <i id="priceInfo"> </i> 
            </li>

            <li class="list-group-item">
            <a>
            <b class="color-b">State:</b>
            </a>  <i id="stateInfo"> </i> 
            </li>
         </ul>
         <hr>
         <ul id = "consumer_info" class="list-group">
            <li class="list-group-item">
            <a>
            <b class="color-b">Consumer Name:</b>
            </a>  <i id="ConsumerNameInfo"> </i> 
            </li>

            <li class="list-group-item">
            <a>
            <b class="color-b">Consumer phone number:</b>
            </a>  <i id="ConsumerPhoneInfo"> </i> 
            </li>
         </ul>

         <hr>
         <ul id = "staff_info" class="list-group">
            <li class="list-group-item">
            <a>
            <b class="color-b">Staff Name:</b>
            </a>  <i id="StaffNameInfo"> </i> 
            </li>

            <li class="list-group-item">
            <a>
            <b class="color-b">Staff phone number:</b>
            </a>  <i id="StaffPhoneInfo"> </i> 
            </li>
         </ul>

         <hr>
         <ul id = "accountant_info" class="list-group">
            <li class="list-group-item">
            <a>
            <b class="color-b">Accountant Name:</b>
            </a>  <i id="AccountantNameInfo"> </i> 
            </li>

            <li class="list-group-item">
            <a>
            <b class="color-b">Accountant phone number:</b>
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
             <button class="btn btn-model" onclick="confirmDeal()" id="nvr-add"> &nbsp;&nbsp; Confirm &nbsp;&nbsp; </button>
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
</form>
</div>

<div class="overlay-dark"></div>
<embed class="img-overlay">

<script type="text/javascript">
  
    function  loadFile($src){
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

    $(".overlay-dark").on('click', function() {
      $(".overlay-dark").css('display', 'none');
      $('.img-overlay').css('display', 'none');
      setTimeout(function() {
        $('.img-overlay').css('transform', 'translate(-50%, 0) scale(0, 0)');
      }, 600);
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


<!-- show image preview -->
<script type="text/javascript">
  $( ".preview" ).click(function() {
    $(this).parent().children( ".img-popup" ).click();
  });
</script>

<!-- ve zone camera -->
<script type="text/javascript">

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
  var totalName = []
  var totalContribute = []
  var points = [], g;

  function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }

  async function getZone(){
    myTimer = 1;
  $(".popup").remove();
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

       var table = document.getElementById("zone_content"); 
    var row = table.insertRow();

    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
    var cell1 = row.insertCell(0);
    var cell3 = row.insertCell(1);
    var cell4 = row.insertCell(2);
    var cell5 = row.insertCell(3);
    var cell6 = row.insertCell(4);
    var cell7 = row.insertCell(5);
    var cell8 = row.insertCell(6);

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


    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"position' value='"+ZonePosition[ZonePositionIndex.indexOf(data.position)]+"'>"


    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"deposit' value='"+data.deposit+"'>"


    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"view' value='"+data.view+"'>"




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

      medium_x = parseInt(medium_x/parseInt(zone.length/2))
      medium_y = parseInt(medium_y/parseInt(zone.length/2))


      totalPoints.push(binary_zone)
      totalId.push(data.id)
      totalState.push(data.state)
      totalName.push(data.name)
      totalContribute.push(data.contribute_state)

     pology = pology + '<g><polygon points="'+zone.toString()+'" style="fill: rgba(255, 0, 0, 0.0);"></polygon></g>';
       var div = document.createElement('div');


    if (data.state > -1){
       
      div.setAttribute("id", 'area' + data.id)
      div.setAttribute("class", 'popup')

      document.body.appendChild(div);
      var offset = $("#zone").offset();
      if (data.display == 0){
      if (window.innerWidth <  500){

      if (data.name.includes("BT")){
      $('#area' + data.id).css({width: (max_x - min_x)/3});
      $('#area' + data.id).css({height: (max_x - min_x)/3});
      $('#area' + data.id).css({left: offset.left + medium_x+15});
      $('#area' + data.id).css({top:  offset.top + medium_y+10});
      }else{
      $('#area' + data.id).css({width: (max_x - min_x)/3});
      $('#area' + data.id).css({height: (max_x - min_x)/3});
      $('#area' + data.id).css({left: offset.left + medium_x+16});
      $('#area' + data.id).css({top:  offset.top + medium_y+18});
      }

      }else if (window.innerWidth <  800){

      if (data.name.includes("BT")){
      $('#area' + data.id).css({width: (max_x - min_x)/3});
      $('#area' + data.id).css({height: (max_x - min_x)/3});
      $('#area' + data.id).css({left: offset.left + medium_x});
      $('#area' + data.id).css({top:  offset.top + medium_y+10});
      }else{
      $('#area' + data.id).css({width: (max_x - min_x)/3});
      $('#area' + data.id).css({height: (max_x - min_x)/3});
      $('#area' + data.id).css({left: offset.left + medium_x});
      $('#area' + data.id).css({top:  offset.top + medium_y+10});
      }
      }else{
      if (data.name.includes("BT")){
      $('#area' + data.id).css({width: (max_x - min_x)/2.5});
      $('#area' + data.id).css({height: (max_x - min_x)/2.5});
      $('#area' + data.id).css({left: offset.left + medium_x});
      $('#area' + data.id).css({top:  offset.top + medium_y-10});
      }else{
      $('#area' + data.id).css({width: (max_x - min_x)/3});
      $('#area' + data.id).css({height: (max_x - min_x)/3});
      $('#area' + data.id).css({left: offset.left + medium_x+15});
      $('#area' + data.id).css({top:  offset.top + medium_y +15});

      }
    }
  }else{
     if (window.innerWidth <  600){

      if (data.name.includes("BT")){
      $('#area' + data.id).css({width: (max_x - min_x)/3});
      $('#area' + data.id).css({height: (max_x - min_x)/3});
      $('#area' + data.id).css({left: offset.left + medium_x+15});
      $('#area' + data.id).css({top:  offset.top + medium_y+10});
      }else{
      $('#area' + data.id).css({width: (max_x - min_x)/3});
      $('#area' + data.id).css({height: (max_x - min_x)/3});
      $('#area' + data.id).css({left: offset.left + medium_x+10});
      $('#area' + data.id).css({top:  offset.top + medium_y+15});
      }

      }else if (window.innerWidth <  1300){

  document.getElementById("testButton").innerHTML = window.innerWidth+ " 800 good";
      if (data.name.includes("BT")){
      $('#area' + data.id).css({width: (max_x - min_x)/3});
      $('#area' + data.id).css({height: (max_x - min_x)/3});
      $('#area' + data.id).css({left: offset.left + medium_x});
      $('#area' + data.id).css({top:  offset.top + medium_y+12});
      }else{
      $('#area' + data.id).css({width: (max_x - min_x)/3});
      $('#area' + data.id).css({height: (max_x - min_x)/3});
      $('#area' + data.id).css({left: offset.left + medium_x});
      $('#area' + data.id).css({top:  offset.top + medium_y+20});
      }
      }else{
  document.getElementById("testButton").innerHTML = window.innerWidth+ " 800 not good";
      if (data.name.includes("BT")){
      $('#area' + data.id).css({width: (max_x - min_x)/2.5});
      $('#area' + data.id).css({height: (max_x - min_x)/2.5});
      $('#area' + data.id).css({left: offset.left + medium_x-20});
      $('#area' + data.id).css({top:  offset.top + medium_y-20});
      }else{
      $('#area' + data.id).css({width: (max_x - min_x)/3});
      $('#area' + data.id).css({height: (max_x - min_x)/3});
      $('#area' + data.id).css({left: offset.left + medium_x+10});
      $('#area' + data.id).css({top:  offset.top + medium_y -10});

      }
    }
  }
        if (data.contribute_state < 2){
          console.log("right here")
      $('#area' + data.id).css({"background-image": "url('/js-css/img/contribute/step1.png')"});
      

        }else if (data.contribute_state == 2){    
        
      $('#area' + data.id).css({"background-image": "url('/js-css/img/contribute/step2.png')"});
        }else if (data.contribute_state == 3){  
        $('#area' + data.id).css({"background-image": "url('/js-css/img/contribute/step3.png')"});
        }
      }
    }
  }

  function loadZoneData(contribute,name,id,state){
          $("#zone_history").empty();
          var table = document.getElementById("zone_history"); 
          // for(var i=0; i < table.rows.length;  i++)
          //       table.deleteRow(0);
    $.ajax({
        type: "GET",
        url : "history-contribute-zone/"+id,
        success: function(msg){

          msg = JSON.parse(msg)
          console.log(msg)
          for (i = 0; i <msg.length;i++){
          var row = table.insertRow();
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);
          var cell4 = row.insertCell(3);

          cell1.innerHTML = msg[i].description
          var state = ""
          if (msg[i].state == 1){
            state = "Giai đoạn làm móng "
          }else if (msg[i].state == 2){
            state = "Giai đoạn xây cơ bản"
          }else{
            state = "Giai đoạn hoàn thiện"

          }
          cell2.innerHTML = state
          cell3.innerHTML = msg[i].time
          cell4.innerHTML = '<td><button onclick="loadFile('+"'"+msg[i].url+"'"+')" class="preview" type="button"><img src="/js-css/img/icon/play.png"></td>'
          }
        }
      });


  document.getElementById("zone_name1").innerHTML = "Lịch sử tiến độ "+ name;
  document.getElementById("zone_name").innerHTML = name;
  document.getElementById("zone_id").value = id;
  document.getElementById("contribute_state").value = contribute;
  $("#new-history-zone").modal('show');

        // getZone()
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
  // $(".popup").hide();

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
      popup(totalContribute[index],totalName[index],totalId[index],totalState[index])
  }
}
});
function popup(contribute,name,id,state) {

    zoomOutMobile(1)
    if (state == -1){
    temp = document.getElementById("zone"+id+"price").innerHTML ;
    console.log(document.getElementById("zone"+id+"name").innerHTML)
    // console.log(temp)
    window.location.href = "/area-contribute-information/" + temp
  }

  loadZoneData(contribute,name,id,state)
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
    $(document).ready(function() {
      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }
  });
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



    function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }
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

function zoomOutMobile(flag) {
    var viewport = document.querySelector("meta[name='viewport']");
    viewport.content = "width="+ window.innerWidth+", maximum-scale=0.635";
    setTimeout(function() {
        viewport.content = "width="+ window.innerWidth+", maximum-scale=10";
        if (flag == 0){
            getZone();
            // if (window.innerWidth >500 && window.innerWidth <  800){
            // menu_close()
          // }
        }
    }, 350);
  

  //   getZone()
  }
zoomOutMobile(0) 
// $('#new-history-zone').modal({backdrop: 'static', keyboard: false})  
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
