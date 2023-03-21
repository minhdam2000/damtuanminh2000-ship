@extends('layouts.index')
@section('content')
<script src="js-css/js/d3.min.js"></script>
<meta name="csrf-token" content="{!! csrf_token() !!}">      
  <!-- DataTables -->
 <link rel="stylesheet" href="js-css/datatables/dataTables.bootstrap4.css">
              <style type="text/css">
  .tab-content{
    width: 90%;
    margin-left: 5%;
  }
</style>
<style>
  canvas{
    min-height: 400px;
    min-width: 350px;
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

    <hr>
<div class="tab-content">
<div id="content1" class="tab-pane  in active">
<div class="row">
                     
                      <div class="col-md-12 col-12">
                        <div class="wrapper">
                    <div class="row">
                      <h3  class="col-md-12 col-sm-12" > Biểu đồ thống kê căn và diện tích các dự án</h3>
                      <br>
                      <div id="month_con1" class="col-md-6 col-sm-12 chart-circle">
                      <canvas id="month_log1" ></canvas>
                      </div>
                      <div id="month_con2" class="col-md-6 col-sm-12 chart-circle">
                      <canvas  id="month_log2"></canvas>
                      </div>
                      <h3 class="col-md-12 col-sm-12" > Biểu đồ thống kê tài chính các dự án</h3>
                      <br>
                      <div id="month_con3" class="col-md-6 col-sm-12 chart-circle">
                      <canvas  id="month_log3"></canvas>
                      </div>

                        <div id="month_con4" class="col-md-6 col-sm-12 chart-circle">
                      <canvas  id="month_log4"></canvas>
                      </div>
                      <div class="col-md-12 col-sm-12 col-12">
                        <h3>Thống kê chi tiết theo căn</h3>
     <div style="overflow: auto;width: 100%">
                        <table id="zone-statistic" class="nvr-table">
  <thead>
      <tr class="thead">
          <th>Dự án</th>
          <th>Tổng số căn</th>
          <th>Diện tích</th>
          <th>Số căn còn</th>
          <th>Số căn đã bán</th>
          <th>Số căn đã thanh toán</th>
          <th>Doanh thu dự kiến</th>
          <th>Doanh thu thực</th>
          <th>Số tiền đã thu</th>
          <th>Số tiền còn nợ</th>
        </tr>
      </thead> 
       <tbody >
                        @foreach($zone as $zone)
                        <?php
                        if( $zone->total > 0){
                          $zonetotal =  $zone->total; 
                        }else{
                          $zonetotal =  1; 
                        }
                            $sell = $zone->total - $zone->nonsell;
                        ?>
                        <tr>
                          <td><a href="/statistic/{{$zone->id}}">{{$zone->name}} </a> </td>

                          <td>{{$zone->total}}    </td>
                          <td>{{$zone->acreage}} m<sup>2</sup>  </td>
                          <td>{{$zone->nonsell}} ({{round($zone->nonsell/$zonetotal*100,2) }}%)    </td>
                          <td>{{$sell}} ({{round($sell/$zonetotal*100,2) }}%)    </td>
                          <td>{{$zone->done1}} ({{round($zone->done1/$zonetotal*100,2) }}%)    </td>
                          <td>{{number_format($zone->final_price, 0, ",", ".") }} VND </td>
                          @if($zone->real_price > 0)
                          <td>{{number_format($zone->real_price, 0, ",", ".") }} VND </td>
                          @else

                          <td>{{number_format($zone->final_price, 0, ",", ".") }} VND </td>
                          @endif
                          <td>{{number_format($zone->done, 0, ",", ".") }} VND </td>
                          <td>{{number_format($zone->dept, 0, ",", ".") }} VND </td>

                        </tr>

                        @endforeach
        </tbody>
      </table></div>

                      </div>
                    </div></div>
                      </div>
                  </div>

     <div style="overflow: auto;width: 100%">
                  <table id="zone-statistic2" class="nvr-table">
                        <h3>Thống kê chi tiết theo diện tich</h3>
  <thead>
      <tr class="thead">
          <th>Dự án</th>
          <th>Tổng diện tích</th> 
          <th>Diện tích đã bán</th>
          <th>Diện tích còn lại</th>
          <th>Diện tích đã thanh toán</th>
          <th>Doanh thu dự kiến</th>
          <th>Doanh thu thực</th>
          <th>Số tiền đã thu</th>
          <th>Số tiền còn nợ</th>
        </tr>
      </thead> 
       <tbody >

                        @foreach($acreage as $zone)
                        <?php
                        if( $zone->total > 0){
                          $zonetotal =  $zone->total; 
                        }else{

                          $zonetotal =  1; 
                        }
                            $sell = $zone->total - $zone->nonsell;
                        ?>
                        <tr>
                          <td><a href="/statistic/{{$zone->id}}">{{$zone->name}}</a>  </td>

                          <td>{{$zone->total}}   m<sup>2</sup> </td>
                         
                          <td>{{$sell}} m<sup>2</sup>({{round(floatval($sell)/$zonetotal*100,2) }}%)    </td>


                          <td>{{$zone->nonsell}} m<sup>2</sup>({{round(floatval($zone->nonsell)/$zonetotal*100,2) }}%)    </td>
                          
                          <td>{{$zone->done1}} m<sup>2</sup> ({{round($zone->done1/$zonetotal*100,2) }}%)    </td>
                          <td>{{number_format($zone->final_price, 0, ",", ".") }} VND </td>
                          @if($zone->real_price > 0)
                          <td>{{number_format($zone->real_price, 0, ",", ".") }} VND </td>
                          @else

                          <td>{{number_format($zone->final_price, 0, ",", ".") }} VND </td>
                          @endif
                          <td>{{number_format($zone->done, 0, ",", ".") }} VND </td>
                          <td>{{number_format($zone->dept, 0, ",", ".") }} VND </td>

                        </tr>

                        @endforeach
        </tbody>
</table></div>
</div>

<div id="content2" class="tab-pane fade">
<!--    <div class="search-input proxy-add" title="Serach">
                        <input type="text" class="textbox" id="search-input" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div> -->
 <table id="staff-table"  class="nvr-table ">
                        <thead>
                        <tr class="thead">
                           
                            <th>Tên nhân viên</th>
                            <th>Số lượng nhà bán được</th>
                            <th>Doanh thu đạt được</th>
                            <th>Xếp loại</th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                            <tr class="color-add">                              
                              <td>Nguyên Hoàng Sơn</td>
                              <td>50</td>
                              <td>68,000,000,000 VND</td>
                              <td><span style="color: green">Tốt</span></td>
                            </tr> 
                            <tr>                           
                              <td>Trương Tiến Dũng</td>
                              <td>48</td>
                              <td>56,000,000,000 VND</td>
                              <td><span style="color: green">Tốt</span></td>
                            </tr> 
                            <tr>                               
                              <td>Đặng Đức Huy</td>
                              <td>51</td>
                              <td>60,000,000,000 VND</td>
                              <td><span style="color: green">Tốt</span></td>
                            </tr>
                            <tr>    
                              <td>Nguyên văn A</td>
                              <td>20</td>
                              <td>30,000,000,000 VND</td>
                              <td><span style="color: blue">Khá</span></td>
                            </tr>  
                            <tr>                              
                              <td>Hoàng Văn B</td>
                              <td>12</td>
                              <td>15,000,000,000 VND</td>
                              <td><span style="color: red">Chưa hiệu quả</span></td>
                            </tr>   
                            <tr>                             
                              <td>Nguyên Thi D</td>
                              <td>14</td>
                              <td>17,000,000,000 VND</td>
                              <td><span style="color: red">Chưa hiệu quả</span></td>
                            </tr>   
                            <tr>                             
                              <td>Trần đức C</td>
                              <td>10</td>
                              <td>18,000,000,000 VND</td>
                              <td><span style="color: red">Chưa hiệu quả</span></td>
                            </tr>
                                                      
                        </tbody>
                      </table>
                  
</div>

<div id="content3" class="tab-pane fade">
 <table id="area-table"  class="nvr-table ">
                        <thead>
                        <tr class="thead">
                           
                            <th>Tên khu vực</th>
                            <th>Tỷ lệ bán</th>
                            <th>Doanh thu đạt được</th>
                            <th>Xếp loại</th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                            <tr class="color-add">                              
                              <td>Xuân An 1</td>
                              <td>75 %</td>
                              <td>68,000,000,000 VND</td>
                              <td><span style="color: green">Tốt</span></td>
                            </tr>  
                            <tr>                          
                              <td>Xuân An 2</td>
                              <td>80 %</td>
                              <td>56,000,000,000 VND</td>
                              <td><span style="color: green">Tốt</span></td>
                            </tr>   
                            <tr>                             
                              <td>Xuân An 3</td>
                              <td>51 %</td>
                              <td>60,000,000,000 VND</td>
                              <td><span style="color: green">Tốt</span></td>
                            </tr>    
                            <tr>                            
                              <td>Xuân An 4</td>
                              <td>20 %</td>
                              <td>30,000,000,000 VND</td>
                              <td><span style="color: blue">Khá</span></td>
                            </tr>   
                            <tr>                             
                              <td>Xuân An 5</td>
                              <td>15 %</td>
                              <td>35,000,000,000 VND</td>
                              <td><span style="color: blue">Khá</span></td>
                            </tr>  
                            <tr>                              
                              <td>Xuân An 6</td>
                              <td>18 %</td>
                              <td>27,000,000,000 VND</td>
                              <td><span style="color: red">Chưa hiệu quả</span></td>
                            </tr>
                                                      
                        </tbody>
                      </table>
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


<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
</div>
<div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
</div>


<!-- Thay doi cau hinh  -->

<script type="text/javascript" src="js-css/js/socket.io.js"></script>


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


<!-- 
<script type="text/javascript">
    $("#search-input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#staff-table tbody tr").filter(function() {
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



</script> -->


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
      function auditBar(input_data,input_type) {
        console.log(input_data)

        var tempType = document.getElementById("tempType").value
        var tempDate = document.getElementById("tempDate").value
        $('#month_log3').remove();
        $('#month_con3').append('<canvas id = "month_log3"><canvas>');
        var chartName = ""
        var xAxesLabel = ""
        if (input_type == "area"){
          chartName = "Thống kê sản lưởng theo khu vực"
        }else{
          chartName = "Thống kê sản lưởng theo nhân viên"

        }

         $(document).ready(function () {
            $.ajax({
            type: "GET",
            url: '/audit-bar/'+ input_type + "/" + input_data,
            success: function (response) {
            console.log(response)
            let res = JSON.parse(response);
            hourKey = res.key
            hourValue = res.value
            var ylabel = "Tháng"
            console.log(hourKey, hourValue)
            console.log(tempType + "_log3")
            var ctx = document.getElementById("month_log3");
            var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: hourKey,
                datasets: [{
                  label: chartName,
                  data: hourValue,
                backgroundColor: '#23885a',
                  borderWidth: 1
                }]
              },
              options: {
                responsive: false,
                scales: {
                  xAxes: [{
                     scaleLabel: {
                        display: true,
                        labelString: ylabel
                      },
                    ticks: {
                      maxRotation: 90,
                      minRotation: 80
                    }
                  }],
                  yAxes: [{
                     scaleLabel: {
                        display: true,
                        labelString: 'Số lượng nhà được giao dịch'
                      },
                    ticks: {
                      beginAtZero: false
                    }
                  }]
                }
              }
            });
            Chart.defaults.global.defaultFontColor = '#dcf3ff';
            console.log("why error ?????")



         }
      });
    }); 
   }
     function auditChart(type,file){
       $(document).ready(function () {
        $('#'+type + "_log1").remove();
        $('#'+type + "_log2").remove();
        $('#'+type + "_log3").remove();
        $('#'+type + "_log4").remove();
        $('#'+type + "_con1").append('<canvas id="'+type + '_log1"><canvas>');
        $('#'+type + "_con2").append('<canvas id="'+type + '_log2"><canvas>');

            $('#'+type + "_con3").append('<canvas id="'+type + '_log3"><canvas>');
        $('#'+type + "_con4").append('<canvas id="'+type + '_log4"><canvas>');

        document.getElementById("tempType").value = type
        document.getElementById("tempDate").value = file
  
        

          $.ajax({
            type: "GET",
            url: '/audit-chart/'+type + "/" +file,
            success: function (response) {
              console.log(response)
              response = JSON.parse(response);
              res =response[0]
              total = response[1][0]
              console.log(res)
              console.log(total)


              console.log(res)
            var colors = ["#0074D9", "#FF4136", "#2ECC40", "#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]
            /* 3 donut charts */
           
            if (window.innerWidth >500 ){
            var size = window.innerWidth/125;
           }else{
            var size = window.innerWidth/40;

           }
           
           var donutOptions = {
              responsive: false,
              cutoutPercentage: 55,
              legend: {
                position: 'bottom', padding: 5, labels: {
                  pointStyle: 'circle', usePointStyle: true,fontSize:size
                }
              },
            responsive: true,
                title: {
                display: true,
                text: 'Thông kê dự án theo căn',

              
            },
            maintainAspectRatio: false,

            };
     

            let methods = []
            let labels = []
            for(const [method, value] of Object.entries(res)){
                methods.push(value.count);
                labels.push(value.name + " ("+value.count+" căn)")
                // (${Number(value/res.total_ip*100).toFixed(2)}%)`)
            }
            console.log(methods, labels)
            var chDonutDataMethod = {
              labels: labels,
              datasets: [
                {
                  backgroundColor: colors,
                  borderWidth: 0,
                  data: methods
                }
              ]
            };
            var chDonutMethod = document.getElementById(type + "_log1");
            if (chDonutMethod) {
              logChart1 = new Chart(chDonutMethod, {
                type: 'pie',
                data: chDonutDataMethod,
                options: donutOptions
              });
              Chart.defaults.global.defaultFontColor = '#dcf3ff';
            }
            // donnut


           var donutOptions = {
              responsive: false,
              cutoutPercentage: 55,
              legend: {
                position: 'bottom', padding: 5, labels: {
                  pointStyle: 'circle', usePointStyle: true,fontSize:size
                }
              },
            responsive: true,
                title: {
                display: true,
                text: 'Thông kê dự án theo diện tích'
              
            },
            maintainAspectRatio: false,

            };
     

            methods = []
            labels = []
            for(const [method, value] of Object.entries(res)){
                methods.push(value.acreage);
                labels.push(value.name + " ("+value.acreage+" m2)")
            }
            var chDonutDataPort = {
              labels: labels,
              datasets: [
                {
                  backgroundColor: colors,
                  borderWidth: 0,
                  data: methods
                }
              ]
            };
            var chDonutPort = document.getElementById(type + "_log2");
            if (chDonutPort) {
              logChart2  = new Chart(chDonutPort, {
                type: 'pie',
                data: chDonutDataPort,
                options: donutOptions,
                title: {
                display: true,
                text: 'Thông kê dự án theo diện tích'
              }
              });
              Chart.defaults.global.defaultFontColor = '#dcf3ff';
            }
          

 // donnut
   var donutOptions = {
              responsive: false,
              cutoutPercentage: 55,
              legend: {
                position: 'bottom', padding: 5, labels: {
                  pointStyle: 'circle', usePointStyle: true,fontSize:size
                }
              },
            responsive: true,
                title: {
                display: true,
                text: 'Thông kê dự án theo tiền đã thu'
              
            },
            maintainAspectRatio: false,

            };
            methods = []
            labels = []
            for(const [method, value] of Object.entries(res)){
                methods.push(value.done);
                labels.push(value.name + " ("+formatMoney(value.done)+" VND)")
            }
            var chDonutDataPort = {
              labels: labels,
              datasets: [
                {
                  backgroundColor: colors,
                  borderWidth: 0,
                  data: methods
                }
              ]
            };
            var chDonutPort = document.getElementById(type + "_log3");
            if (chDonutPort) {
              logChart2  = new Chart(chDonutPort, {
                type: 'pie',
                data: chDonutDataPort,
                options: donutOptions
               
              });
              Chart.defaults.global.defaultFontColor = '#dcf3ff';
            }
          

           // donnut
             var donutOptions = {
              responsive: false,
              cutoutPercentage: 55,
              legend: {
                position: 'bottom', padding: 5, labels: {
                  pointStyle: 'circle', usePointStyle: true,fontSize:size
                }
              },
            responsive: true,
                title: {
                display: true,
                text: 'Thông kê dự án theo tiền còn nợ'
              
            },
            maintainAspectRatio: false,

            };

            methods = []
            labels = []
            for(const [method, value] of Object.entries(res)){
                methods.push(value.dept);
                labels.push(value.name + " ("+formatMoney(value.dept)+" VND)")
            }
            var chDonutDataPort = {
              labels: labels,
              datasets: [
                {
                  backgroundColor: colors,
                  borderWidth: 0,
                  data: methods
                }
              ]
            };
            var chDonutPort = document.getElementById(type + "_log4");
            if (chDonutPort) {
              logChart2  = new Chart(chDonutPort, {
                type: 'pie',
                data: chDonutDataPort,
                options: donutOptions
              });
              Chart.defaults.global.defaultFontColor = '#dcf3ff';
            }
          


              
            }
          });
        });
     }

     auditChart('month','12')

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

  </script>

        <!-- DataTables -->
<script src="js-css/datatables/jquery.dataTables.js"></script>
<script src="js-css/datatables/dataTables.bootstrap4.js"></script>

  <script type="text/javascript">
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


<?php
          if(Auth()->user()->role_id !== 1 && Auth()->user()->role_id !== 6 ){

            ?>

            if (window.innerWidth <  750){
              menu_close()
            }
              <?php
          }
          ?>
    </script>


    <style type="text/css">
      #staff-table_filter{
        float: right
      }

      #area-table_filter{
        float: right;
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
