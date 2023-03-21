@extends('layouts.index')
@section('content')
<script src="js-css/js/d3.min.js"></script>
<meta name="csrf-token" content="{!! csrf_token() !!}">
<style>
.mypopup {
  display: none;
  position: absolute;
}

.mypopupinfo {
  background-color: blue;
  border-radius: 50%;
  font-size: 15px;
  font-weight: 30px;
  display: none;
  position: absolute;
}


@media(max-width:800px) {
    .mypopupinfo {
        font-size: 9px!important;
    }
}

@media(max-width:500px) {
    .mypopupinfo {
        font-size: 5px!important;
    }
}
.sreach-content{
  margin-left: 1%;
}

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
    <!--  <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content2">Tìm kiếm</a>
      </li>  
 -->
    </ul>  
    
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
   
    <button class="btn btn-model" onclick="fixZone();" id="btnFixZone">Fix Zone</button>
  <!--   <a href="/area-contribute-information/{{$area->id}}" id="btnFixZone">Đổi sang chế đồ xây dựng </a> -->


<a  href="/mini-fix-list/{{$area->project_id}}"><button class="btn btn-model">Trở lại</button> </a>

<button type="button" id="refButton" class="btn btn-model" onclick="getZone()"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button>
  </div>
</div>
</div>
</div>



<div id="content2" class="tab-pane fade">
    <div class="row sreach-content">
  <div class="search-input proxy-add" title="Serach">
                      <label>Đơn Giá</label>
                      <label>Từ </label>
                          <input type="text" class="textbox" id="search-input-unit-price1_display"   onblur="formatForId('search-input-unit-price1')" placeholder="0.00">
                      <span>. (VND)</span>
                           <input value="-1" style="display:none" type="number" id="search-input-unit-price1" name="inner_tax">   
                    
                      <label>Đến </label>

                      <input type="text" class="textbox" id="search-input-unit-price2_display"   onblur="formatForId('search-input-unit-price2')" placeholder="Không giới hạn">
                           <input value="-1" style="display:none" type="number" id="search-input-unit-price2" name="inner_tax">  
                      <span>. (VND)</span>
                    
                      </div>

  
  <div class="search-input proxy-add" title="Serach">
                      <label>Tổng Giá</label>
                      <label>Từ </label>
                          <input type="text" class="textbox" id="search-input-price1_display"   onblur="formatForId('search-input-price1')" placeholder="0.00">
                      <span>. (VND)</span>
                           <input value="-1" style="display:none" type="number" id="search-input-price1" name="inner_tax">   
                    
                      <label>Đến </label>

                      <input type="text" class="textbox" id="search-input-price2_display"   onblur="formatForId('search-input-price2')" placeholder="Không giới hạn">
                           <input value="-1" style="display:none" type="number" id="search-input-price2" name="inner_tax">  
                      <span>. (VND)</span>
                    
                      </div>


  <div class="search-input proxy-add" title="Serach">
                      <label>Diện tích</label>
                      <label>Từ </label>
  <input style="display:none" type="number" id="search-input-area1"  value=-1 >
                     <input class="textbox"  type="text"   id="search-input-area1_display" name="inner_tax"  onblur="formatForId('search-input-area1')" placeholder="0.00">  <span>. (m<sup>2</sup>)</span>  
                      
                      <label>Đến </label>

                        <input type="text" class="textbox" id="search-input-area2_display" placeholder="Không giới hạn"  onblur="formatForId('search-input-area2')">
                   <span>. (m<sup>2</sup>)</span> <input value=10000 style="display:none" type="number" id="search-input-area2" name="inner_tax" >   
                      </div>

                        <div class="search-input proxy-add" title="Serach">
                      <label>Tên khách hàng</label>
                        <input type="text" class="textbox" id="search-input" placeholder="Search">
                      </div>
    <div class="search-input proxy-add" title="Serach">
                      <label>Trạng thái</label>
                       <select class="textbox" id="search-type">
                         <option value="-1">Tất cả</option>
                         <option value="Trống">Trống</option>
                         <option value="Đợi thanh Toán">Đợi thanh Toán</option>
                         <option value="Đã Thanh Toán">Đã Thanh Toán</option>
                       </select>
                      </div>
                       <div class="search-input proxy-add" title="Serach">
                      <label>Mã BDS</label>
                        <input type="text" class="textbox" id="search-input-bds" placeholder="Search"> <span>. (LK : liền kề, BT: Biệt thự)</span>
                      </div>
                   
      <div class="search-input proxy-add" title="Serach">
    <button class="btn btn-model" id ="search-input-btn">Tìm kiếm</button>
  </div>      </div>          
<table id="zone-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Mã BDS</th>
                            <th>Đơn giá</th>
                            <th>Diện tích</th>
                            <th>Khách hàng</th>
                            <th>Trạng thái</th>
                            <th>Giá dự kiến </th>
                            <th>Giá thực tế </th>
                            <th>Đã thu</th>
                            <th>Còn nợ </th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody" id="zone_content">

                        </tbody>
                      </table>
</div>


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
      <form action="add-area-config" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">

        <input type="hidden" name="project_id" value="{{$area->project_id}}" id="project_id">
        <div class="modal-body">
          <table class="table-edit table-model">
            <tbody class="table-edit">
              <tr>
                <td class="cam-properties">Tên </td>
                <td><input value="test" type="" value="" name="name" id="zone_name" class="input-edit modol-text" required=""></td>
                <td><input type="hidden" value="" name="zones" id="zone_input" class="input-edit modol-text" required=""></td><input type="hidden" value="{{$area->id}}" name="area_id"  class="input-edit modol-text" required=""></td>
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


<div class="modal fade modol-text" id="zone-info" role="dialog">
  <div class="modal-dialog model-right" style="min-height: 100%important;max-width: 709px!important;height: auto!important">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" >
        <label>Thông tin chi tiết</label>
      </div>
      <div class="notification"></div>
      <form action="edit-area-config" method="POST">
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


             <a href="remove-area-config" type="button" class="btn btn-model" id="removeLink"> &nbsp;&nbsp; Xoá &nbsp;&nbsp; </a>   


               <button type="button" class="btn btn-model" data-dismiss="modal" id="nvr-add"> &nbsp;&nbsp; Thoát &nbsp;&nbsp; </button>
            </li>
         </ul>
</form>

        </div>
    </div>
  </div>
</div>

<div class="mypopup" style="" onclick='$(".mypopup").hide();'>
   <img class="preview" width="25" height="25" src="/js-css/img/icon/position.png">
</div>

<div class="mypopupinfo" style="" onclick='$(".mypopupinfo").hide();'>
      <div class="modal-body" id="popupdetail">
      </div>

</div>
<script type="text/javascript" src="js-css/js/socket.io.js"></script>


<script>
  function zoomOutMobile(flag) {
  
    var viewport = document.querySelector("meta[name='viewport']");
    viewport.content = "width=400, maximum-scale=0.635";
    setTimeout(function() {
        viewport.content = "width=400, maximum-scale=10";
        if (flag == 0){

  // $("#zone_content").empty();
            getZone();


     setTimeout(function(){ $('#zone-table').DataTable({
                paging: false
                }) }, 3000);
             


            if (window.innerWidth >500 && window.innerWidth <  750){
            menu_close()
          }
        }
    }, 350);
  

  // $(".popup").remove();
  //   getZone()
  }
zoomOutMobile(0) 

var ZonePosition = []
var ZonePositionIndex = []

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



<script src="js-css/datatables/jquery.dataTables.js"></script>
<script src="js-css/datatables/dataTables.bootstrap4.js"></script>
<!-- ve zone camera -->
<script type="text/javascript">

  var dragging = false, drawing = false, startPoint;
  var svg = d3.select('#zone-body').append('svg')
  .attr('width', '100%'); 

  svg[0][0].setAttribute("style", "position: absolute; width: 100%; height: 100%;left: 0;top: 0;");
var totalPoints = []
  var totalMedium = []
  var totalState = []
  var totalContribute = []
  var totalId = []
  var lastID = -1
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
      $('#zone-statistic').DataTable()
  $('#zone-statistic2').DataTable()
  

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


      var ratio1 = ($("svg").width())/720;
      var ratio2 = ($("svg").height())/720;
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
          zone[i] = parseInt(zone[i])*ratio1
          zone[i+1] = parseInt(zone[i+1])*ratio2

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
      totalMedium.push([medium_x/zone.length*2,medium_y/zone.length*2])
      totalId.push(data.id)
      totalState.push(data.state)

    var table = document.getElementById("zone_content"); 
    var row = table.insertRow();

    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
     var cell1 = row.insertCell(0);
    var cell3 = row.insertCell(1);
    var cell2 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    var cell8 = row.insertCell(7);
    var cell9 = row.insertCell(8);
    var cell10 = row.insertCell(9);

    var staff = ""
    var consumer = ""
    var state = ""
    var info  = ""
    cell1.innerHTML = "<span id='zone" +data.id +"name'>"+data.name+"</span>"
  if (data.state == 0){
      staff = "<span style='display:none'>Trống</span>"
      consumer = "<span>Trống</span>"
      state = "<span id='zone" +data.id +"state'>Trống</span>"
      info ="<span style='display:none'  id='zone" +data.id +"date'>None</span>"
   }else if (data.state == 1){
      staff = "<span style='display:none' id='zone" +data.id +"staff'>"+data.staff_name+"</span>"
      consumer = "<span id='zone" +data.id +"consumer'>"+data.consumer_name+"</span>"
      state = "<span id='zone" +data.id +"state'>Đợi thanh toán</span>"
      info = "<span style='display:none'  id='zone" +data.id +"date'> Ngày đặt: "+data.deposit_date +"</span>"
      } else if (data.state == 2){
      staff = "<span style='display:none' id='zone" +data.id +"staff'>"+data.staff_name+"</span>"
      consumer = "<span id='zone" +data.id +"consumer'>"+data.consumer_name+"</span>"
      state = "<span id='zone" +data.id +"state'>Đợi thanh toán</span>"
      info = "<span style='display:none'  id='zone" +data.id +"date'> Ngày đặt: "+data.deposit_date +"</span>"
   } else if (data.state == 3){
      staff = "<span style='display:none' id='zone" +data.id +"staff'>"+data.staff_name+"</span>"
      consumer = "<span id='zone" +data.id +"consumer'>"+data.consumer_name+"</span>"
      state = "<span id='zone" +data.id +"state'>Đã thanh toán</span>"
      info = "<span style='display:none'  id='zone" +data.id +"date'> Ngày đặt: "+data.deposit_date+"<br> Ngày thành toán: "+data.complete_date +"</span>"
   } 

    cell3.innerHTML = staff + "<span id='zone" +data.id +"unit'>"+formatMoney(data.unit_price)+" VND </span>"
    cell4.innerHTML = consumer
    cell5.innerHTML = state
    cell6.innerHTML = "<span id='zone" +data.id +"final_price'>"+formatMoney(data.final_price)+" VND</span>"
    if(data.real_price > 0){
    cell7.innerHTML = "<span id='zone" +data.id +"real_price'>"+formatMoney(parseInt(data.real_price)*parseInt(data.acreage))+" VND</span>"
  }else{
    cell7.innerHTML = "<span id='zone" +data.id +"real_price'>"+formatMoney(data.final_price)+" VND</span>"

  }
    cell8.innerHTML = "<span id='zone" +data.id +"done'>"+formatMoney(data.done)+" VND</span>"
    cell9.innerHTML = "<span id='zone" +data.id +"dept'>"+formatMoney(data.dept)+" VND</span>"+info
if(parseInt(data.acreage)>0){
cell2.innerHTML = "<span id='zone" +data.id +"acreage'>"+formatMoney(data.acreage)+" m<sup>2</sup></span>"
}else{
cell2.innerHTML = "<span id='zone" +data.id +"acreage'> Trống </span>"
      consumer = "<span id='zone" +data.id +"consumer'>Trống</span>"
    cell6.innerHTML = "<span id='zone" +data.id +"final_price'>Trống</span>"
    cell7.innerHTML = "<span id='zone" +data.id +"real_price'>Trống</span>"
    cell8.innerHTML = "<span id='zone" +data.id +"done'>Trống</span>"
    cell9.innerHTML = "<span id='zone" +data.id +"dept'>Trống</span>"+info

}
    hidden_input = ""

    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"consumer_phone_number' value='"+data.consumer_phone_number+"'>"


    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"aid' value='"+data.aid+"'>"


    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"consumer_identify_card' value='"+data.consumer_identify_card+"'>"

    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"staff_phone_number' value='"+data.staff_phone_number+"'>"

    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"staff_identify_card' value='"+data.staff_identify_card+"'>"

    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"accountant_name' value='"+data.accountant_name+"'>"

    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"accountant_phone_number' value='"+data.accountant_phone_number+"'>"


    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"deposit_date' value='"+data.deposit_date+"'>"


    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"complete_date' value='"+data.complete_date+"'>"


    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"position' value='"+ZonePositionIndex.indexOf(data.position)+"'>"


    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"posname' value='"+ZonePosition[ZonePositionIndex.indexOf(data.position)]+"'>"


    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"deposit' value='"+data.deposit+"'>"


    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"view' value='"+data.view+"'>"

    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"img' value='"+data.image_name+"'>"

    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"lock' value='"+data.lock+"'>"
    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"lockuser' value='"+data.lock_user+"'>"
    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"locktime' value='"+data.lock_time+"'>"




    cell10.innerHTML = hidden_input + '<i class="fa fa-eye" aria-hidden="true" onclick = "loadDisplayZoneData('+data.id+','+data.state+')"></i> <i class="fa fa-location-arrow" aria-hidden="true"></i>'
      // console.log(data.state)
  pology = pology + '<g><polygon id="pzone'+data.id+'"  points="'+zone.toString()+'" style="fill: rgba(0, 0, 255, 0.2);"></polygon></g>';



}
  }
  function loadZoneEdit(id,state){


  document.getElementById("zone_edit_id").value = id
console.log(document.getElementById("zone"+id+"name").innerHTML)
console.log("1234124")
document.getElementById("zone_edit_name").value = document.getElementById("zone"+id+"name").innerHTML ;
      document.getElementById("zone_edit_pos").value = document.getElementById("zone"+id+"position").value ;

      document.getElementById("zone_edit_acreage").value = parseInt(document.getElementById("zone"+id+"acreage").innerHTML) ;

      document.getElementById("zone_edit_view").value = document.getElementById("zone"+id+"view").innerHTML ;

      document.getElementById("zone_edit_price").value = document.getElementById("zone"+id+"unit").innerHTML ;

      

  $("#zone-edit").modal('show');

  }

  function loadZoneData(id,state){
    document.getElementById("confirm_id").value = id
      document.getElementById("nameInfo").value = document.getElementById("zone"+id+"name").innerHTML ;
      document.getElementById("removeLink").href = "remove-area-config/"+id
       $("#zone-info").modal('show');

  }

function HighlightZoneData(id, state){
  $("#tab1").click();
 index =i
        lastState = totalState[lastID]
        myLastId  = totalId[lastID]

        if(lastState == 0){

         <?php
          if(Auth()->user()->admin_id == 1){

          ?>

        document.getElementById("pzone"+myLastId).style.fill = "rgba(0, 0, 0, 0.1)";
      <?php
      } else{
      ?>

        document.getElementById("pzone"+myLastId).style.fill = "rgba(255, 0, 0, 0.0)";
    
      <?php
    }
      ?>
      }else if (lastState== 1){    
        document.getElementById("pzone"+myLastId).style.fill = "rgba(0, 0, 255, 0.2)";
      }
      else if (lastState == 2){    
        document.getElementById("pzone"+myLastId).style.fill = "rgba(0, 0, 255, 0.2)";
      }
      else if (lastState == 3){    
        document.getElementById("pzone"+myLastId).style.fill = "rgba(0, 255, 0, 0.2)";
      }

        document.getElementById("pzone"+id).style.fill = "rgba(255, 102, 153, 0.5)";


   $('html,body').scrollTop(0);

     rect =    document.getElementById("pzone"+id).getBoundingClientRect();
  

     if (window.innerWidth >  600){
  $(".mypopup").css({left: rect.left+30});
  $(".mypopup").css({top: rect.top+30});
}else{
  $(".mypopup").css({left: rect.left});
  $(".mypopup").css({top: rect.top});

}
  $(".mypopup").show();

       
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
      console.log(d3.mouse(this))
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
  viewport = jQuery("meta[name='viewport']");
original = viewport.attr("content");
force_scale = original + ", maximum-scale=1";
viewport.attr("content", force_scale); // IGNORED!
viewport.attr("content", original);
loadZoneData(id,state)
  
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

     $("#search-input-btn").on("click", function() {
      var value = $("#search-input").val().toLowerCase();
      var bdsValue = $("#search-input-bds").val().toLowerCase();
      var typeValue = $("#search-type").val().toLowerCase();
    
        areaMin = $("#search-input-area1").val()
        areaMax = $("#search-input-area2").val()
        console.log(areaMin)
        console.log(areaMax)
     
        priceUnitMin = $("#search-input-unit-price1").val()
        priceUnitMax = $("#search-input-unit-price2").val()

        priceMin = $("#search-input-price1").val()
        priceMax = $("#search-input-price2").val()


     
      $("#zone-table tbody tr").filter(function() {
        var consumer =  ($(this)[0].childNodes[3].innerHTML)
        var bds =  ($(this)[0].childNodes[0].innerHTML)
        var type =  ($(this)[0].childNodes[4].innerHTML)
        var area =  parseInt($(this)[0].childNodes[2].innerText.replaceAll(',', ''))
        var price =  parseInt($(this)[0].childNodes[5].innerText.replaceAll(',', ''))
      var unit_price =  parseInt($(this)[0].childNodes[1].innerText.replaceAll(',', ''))
        $(this).toggle(consumer.toLowerCase().indexOf(value) > -1
          && bds.toLowerCase().indexOf(bdsValue) > -1
          && ((type.toLowerCase().indexOf(typeValue) > -1)
              || (typeValue == -1))
          && (area < areaMax  || areaMax == -1)
          && (area > areaMin || areaMin == -1)

          && (price < priceMax  || priceMax == -1)
          && (price > priceMin || priceMin == -1)

          && (unit_price < priceUnitMax  || priceUnitMax == -1)
          && (unit_price > priceUnitMin || priceUnitMin == -1)


          )

      });

// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
     setTimeout(function(){
 var value = $("#search-input").val().toLowerCase();
      var bdsValue = $("#search-input-bds").val().toLowerCase();
      var typeValue = $("#search-type").val().toLowerCase();
    
        areaMin = $("#search-input-area1").val()
        areaMax = $("#search-input-area2").val()
        console.log(areaMin)
        console.log(areaMax)
     
        priceUnitMin = $("#search-input-unit-price1").val()
        priceUnitMax = $("#search-input-unit-price2").val()

        priceMin = $("#search-input-price1").val()
        priceMax = $("#search-input-price2").val()


     
      $("#zone-table tbody tr").filter(function() {
        var consumer =  ($(this)[0].childNodes[3].innerHTML)
        var bds =  ($(this)[0].childNodes[0].innerHTML)
        var type =  ($(this)[0].childNodes[4].innerHTML)
        var area =  parseInt($(this)[0].childNodes[2].innerText.replaceAll(',', ''))
        var price =  parseInt($(this)[0].childNodes[5].innerText.replaceAll(',', ''))
      var unit_price =  parseInt($(this)[0].childNodes[1].innerText.replaceAll(',', ''))
        $(this).toggle(consumer.toLowerCase().indexOf(value) > -1
          && bds.toLowerCase().indexOf(bdsValue) > -1
          && ((type.toLowerCase().indexOf(typeValue) > -1)
              || (typeValue == -1))
          && (area < areaMax  || areaMax == -1)
          && (area > areaMin || areaMin == -1)

          && (price < priceMax  || priceMax == -1)
          && (price > priceMin || priceMin == -1)

          && (unit_price < priceUnitMax  || priceUnitMax == -1)
          && (unit_price > priceUnitMin || priceUnitMin == -1)


          )

      });
      
     }, 3000);
             
}
    });
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
  getZone();
</script>
<script type="text/javascript">
    $("#search-input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#zone-table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });

   if (window.innerWidth >600 ){
            var displayBtn = "initial";

          }else{

            var displayBtn = "block";
          }

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
