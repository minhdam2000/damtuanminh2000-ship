<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Center Management System</title>
        <link rel="icon" type="image/ico" href="js-css/img/title_logo.png" />
        <base href="{{asset('')}}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="js-css/css/bootstrap.min.css">
        <script src="js-css/js/jquery.min.js"></script>
        <script src="js-css/js/popper.min.js"></script>
        <script src="js-css/js/bootstrap.min.js"></script> <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
                             
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
        <link rel="stylesheet" href="js-css/font/font-awesome.min.css">
       
            <link rel="stylesheet" href="js-css/css/css.css">
        
        <link rel="stylesheet" href="js-css/css/custom.css">
        <script src="js-css/js/jquery.dataTables.min.js"></script>
        <script src="js-css/js/sweetalert.js"></script>
        <link rel="stylesheet" href="js-css/css/sweetalert.css">

        <script src="js-css/js/script.js"></script>
        <script src="js-css/js/Chart.js"></script>
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>

<style>
  /* Popup container - can be anything you want */
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
  .list-group-item{
    background-color:transparent!important;
  }
 .header-camera{
    display: none;
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
  
  </style> </head>
    <body> <div id="content">
    <div class="content-camera">
        <div class="header-content">
           
        </div>
        <div class="session">
            @if(Session::has('notification'))
              <input hidden="" notifi="{{Session::get('notification')}}" value="1" id="notice_success">
            @endif
            @if(Session::has('warning'))
              <input hidden="" notifi="{{Session::get('warning')}}" value="1" id="notice_warning">
            @endif
        </div>
        <div class="">
        	
 <div class="row-content">
<ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#content1">Bản đồ dự án</a>
      </li> 
      <li class="nav-item margin_center">
          <a id="tab0" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content0">Bản đồ địa giới</a>
      </li>
    
  
    
    </ul>  
    <hr>

   
<div class="tab-content">
<div id="content1" class="tab-pane  in active">

<div  id="zone" role="dialog" data-backdrop="static">            <div class="modal-content">
  <div class="modal-body" id="zone-body">
    <img src="js-css/img/project/{{$project->url}}" style="width: 100%; height: auto;" id="snapshot-zone">
  </div>
  <div class="option-zone">
    <input type="hidden" value="" id="zoneStatus">
    <input type="hidden" value="" id="lockStatus">
   

<form id="lock_form" style="display: none" method="POST" action="/lock-zone">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
  <input type="text" name="sid[]" id="lock_input">
  <input type="text" name="type" id="lock_type">

</form>

<button type="button" class="camera-button" onclick="getZone()"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button>


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
    <!-- Modal -->
      <div class="overlay-dark"></div>
      <img class="img-overlay">
      <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> notifition</h6>
      </div>
      <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning</h6>
      </div>

<!-- Modal -->
<div class="modal fade modol-text" id="new-area" role="dialog">
  <div class="modal-dialog model-right">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label>New Area</label>
      </div>
      <div class="notification"></div>
      <form action="add-new-area" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="modal-body">
          <table class="table-edit table-model">
            <tbody class="table-edit">
              <tr>
                <td class="cam-properties">Name</td>
                <td><input type="" value="" name="name" id="zone_name" class="input-edit modol-text" required=""></td>
                <td><input type="hidden" value="" name="zones" id="zone_input" class="input-edit modol-text" required=""></td><input type="hidden" value="{{$project->id}}" name="project_id"  class="input-edit modol-text" required=""></td>
              </tr>
               <tr>
                <td class="cam-properties">Description</td>
                <td><input type="" value="" name="description" id="zone_name" class="input-edit modol-text" required=""></td>
              </tr>
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


<!-- Modal -->
<div class="modal fade modol-text" id="zone-edit" role="dialog">
  <div class="modal-dialog model-right" style="min-height: 100%important;max-width: 709px!important;height: auto!important">
    <!-- Modal content-->
    <form action="/edit-zone" method="POST"  enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header" >
        <label>Sửa khu vực</label>
      </div>
      <div class="notification"></div>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="modal-body">
                     <table><tbody>
                      <tr>
<td > Tên </td>
<td>  <input value="" name="name" id="zone_edit_name" class="input-edit modol-text" > 
  <input type="hidden" value="" name="id" id="zone_edit_id" class="input-edit modol-text" >
</td>
</tr>

                   <tr>
<td> Hướng: </td>
<td> <select class="custom-select select-profile  browser-default"  name="pos" id="zone_edit_pos">
                  <option value="1"> Bắc  </option>
                  <option value="2"> Nam </option>
                  <option value="3"> Đông </option>
                  <option value="4"> Tây </option>
                  <option value="5"> Đông bắc </option>
                  <option value="6"> Tây Bắc </option>
                  <option value="7"> Đông Nam </option>
                  <option value="8"> Tây Nam </option>
                </select>  </td>
</tr>

<tr>
<td > Diện tích: </td>
<td> <input value="" name="acreage" id="zone_edit_acreage" class="input-edit modol-text" >
</td>
</tr>
<tr>
<td >Đặc điểm: </td>
<td>
<input value="" id="zone_edit_view" name="view" class="input-edit modol-text">
</td>
</tr>
<tr>
 <td >Ảnh minh họa </td>
                 <td><label  class="preview" for="file-input"><img onclick="openfileupload(1)"  src="/js-css/img/icon/upload.png"></label><input  id= "inputfile1" style="display:none" type="file" name="file" class="form-control">
                </td>

</tr>
<tr>
</tr>
</tbody></table>
               <button class="btn btn-model" type="submit"> &nbsp;&nbsp; Cập nhật &nbsp;&nbsp; </button>
               <button class="btn btn-model" type="button" data-dismiss="modal" id="nvr-add"> &nbsp;&nbsp; Thoát &nbsp;&nbsp; </button>
     </form>     
        </div>
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
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="modal-body">
         <ul id = "basic_info" class="list-group">
            <li class="list-group-item">
            <a>
            <b class="color-b">Tên:</b>
            </a>  <i id="nameInfo"> </i> 
            </li>

            <li class="list-group-item">
            <b class="color-b">Hướng:</b>
            </a>  <i id="positionInfo"> </i> 
            </li>

            <li class="list-group-item" >
            <b class="color-b">Đặc điểm:</b>
              <p id="viewInfo"> </p> 
            </li>

            <li class="list-group-item">
            <a>
            <b class="color-b">Trạng thái:</b>
            </a>  <i id="stateInfo"> </i> 
            </li>
          </ul>
 
<ul>
            <li class="list-group-item">
            <b class="color-b">Ảnh minh họa:</b>
              <img src="" id="zoneImg" style="
    max-width: 300px;">
            </li>


            <li class="list-group-item">
            <b class="color-b">Ảnh mô phỏng:</b>
              <img src="js-css/img/preview.jpg" style="
    max-width: 300px;">
            </li>

         </ul>
         <hr>
      
         <hr>
        
         <hr>
        
          <ul id = "confirm_info"  class="list-group">
            <li class="list-group-item">
              <input value="" type="hidden" id="confirm_id" name="confirm_id">
              <input value="" type="hidden" id="confirm_state" name="confirm_state">
             <button class="btn btn-model" onclick="confirmDeal()" id="nvr-add"> &nbsp;&nbsp; Xác nhận &nbsp;&nbsp; </button>
            </li>
              </ul>

    <!--       <ul id = "confirm_info"  class="list-group">
            <li class="list-group-item">  
              <a href="" class="btn btn-model" id="LinkInfo"> &nbsp;&nbsp; Chi tiết &nbsp;&nbsp; </a> 
            </li><li class="list-group-item">  
              <a href="" class="btn btn-model" id="MapInfo"> &nbsp;&nbsp; Định vị &nbsp;&nbsp; </a>
            </li>
          </ul> -->

                    <ul id = "confirm_info"  class="list-group">
            <li class="list-group-item">
              <input value="" type="hidden" id="confirm_id" name="confirm_id">

        

 <a href="" target="_blank" class="btn btn-model" style="display:block;" id="ShareLink" > &nbsp;&nbsp; Chia sẻ &nbsp;&nbsp; </a>
               <button class="btn btn-model" data-dismiss="modal" id="nvr-add"> &nbsp;&nbsp; Thoát &nbsp;&nbsp; </button>
            </li>
         </ul>
      
        </div>
    </div>
  </div>
</div>
<div class="mypopupinfo" style="" onclick='$(".mypopupinfo").hide();'>
      <div class="modal-body" id="popupdetail" style="color:white;">
      </div>


<script  src="js-css/js/image-popup.js"></script>
<script src="js-css/js/d3.min.js"></script>
<script type="text/javascript">
  $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });

  $(document).ready(function(){
    $("#search-input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#zone-table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
<script>
    $(document).ready(function() {
           document.addEventListener("mousewheel", event => {
  console.log(`wheel`);

  if(event.ctrlKey == true)
  {
    event.preventDefault();
   
  }
}, { passive: false });
          if($("#notice_success").val() == 1){
            notifiSuccess($("#notice_success").attr("notifi"));
          }
          if($("#notice_warning").val() == 1){
            notifiWarning($("#notice_warning").attr("notifi"));
          }
        });
    $("#camera-add").click(function(){
        var ip = document.getElementById('ip').value;
        var rtsp_link = document.getElementById('rtsp-link').value;
        if(ip == '' || rtsp_link == ''){
            $("#new-camera").addClass("shake-model");
            setTimeout(function() {
                $("#new-camera").removeClass("shake-model");
            }, 1000);
            document.getElementsByClassName('notification')[0].innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Cannot leave an id or password blank !";
            document.getElementsByClassName('notification')[0].classList.add('notification-color');
        }
        else{
            $("#create-form").submit(function(event){
			      event.preventDefault(); //prevent default action
			      var post_url = $(this).attr("action"); //get form action url
			      var request_method = $(this).attr("method"); //get form GET/POST method
			      var form_data = new FormData(this); //Creates new FormData object
			      $.ajax({
			      url : post_url,
			      type: request_method,
			      data : form_data,
			      contentType: false,
			      cache: false,
			      processData:false
			      }).done(function(response){ //
			        console.log(response);
			        if(response == 'true'){
			          window.location.href = 'create-camera-success';
			        }
			        else{
			          snakeModel();
			          document.getElementsByClassName('notification')[0].innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> There was a error in too process of process. ";
			          document.getElementsByClassName('notification')[0].classList.add('notification-color');
			        }
			      });


			});


        }
    });
</script>

<script>
  function checkAll() {
      if($('#select-all').is(':checked') == true){
        $('.check-box').prop('checked', true);
      }
      else{
        $('.check-box').prop('checked', false);
      }
    }
</script>

<script>
    function snakeModel(){
      $("#create-user").addClass("shake-model");
            setTimeout(function() {
                $("#create-user").removeClass("shake-model");
            }, 1000);
        }
</script>

<script> 
  function confirm_remove(id) {
              swal({
                  title: "",
                  text: " Are you sure you want to delete this area? ",
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
                     $.get("delete-area/"+id, async function(res) {
                        console.log(res)
                        location.reload()
                       });
                    swal.close();
                  }
                  else {
                    swal.close();
                  }
                });
        }
</script>


<!-- show image preview -->
<script type="text/javascript">
  $( ".preview" ).click(function() {
    $(this).parent().children( ".img-popup" ).click();
  });
</script>


<script type="text/javascript">
  function selectNvr(){
    var nvr_name = $("#nvrs option:selected").text();
    console.log(nvr_name)
    $("#form-camera").attr("action","add-cam-to-nvr/"+$("#nvrs").val());
    var message = "You want to record these cameras in "+nvr_name+" device.";
    JSconfirmAddCamToNvr(message);
  }



  function JSconfirmAddCamToNvr(text){
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
          document.getElementById("submit-action").click();
       } 
       else {   
        $("#nvrs").val("-1");
        swal.close();  
       } 
     });
     $(".btn-primary").css('border', 'none');
     $(".showSweetAlert").attr('style', 'display: block;');
     $(".text-muted").attr('style', 'color: #fff !important');
   }


</script>
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
    $('.popup').remove();
    myTimer = 1;
    // getSnapshot();
    var pology;
    $.ajax({
      url: "get-all-public/"+{!! $project->id !!},
      success: async function(res) {
        res = JSON.parse(res)
        // console.log(res)
        while(true){
          if($("svg").width() == 0){
            await sleep(10);
            continue;
          }
          else{
            pology = '';
            try{
              // console.log(res)
              await res.forEach(createPology);

              console.log("done")
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

    cell3.innerHTML = staff + "<span id='zone" +data.id +"unit'>"+formatMoney(data.unit_price)+"VND </span>"
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
cell2.innerHTML = "<span id='zone" +data.id +"acreage'>"+data.acreage+" m </span>"
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


    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"position' value='"+ZonePosition[ZonePositionIndex.indexOf(data.position)]+"'>"


    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"deposit' value='"+data.deposit+"'>"


    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"view' value='"+data.view+"'>"

    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"img' value='"+data.image_name+"'>"

    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"lock' value='"+data.lock+"'>"
    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"lockuser' value='"+data.lock_user+"'>"




    cell10.innerHTML = hidden_input + '<i class="fa fa-eye" aria-hidden="true" onclick = "loadDisplayZoneData('+data.id+','+data.state+')"></i>'
      // console.log(data.state)
      if (data.lock > 0){
          if (data.lock == 1){
 pology = pology + '<g><polygon id="pzone'+data.id+'" points="'+zone.toString()+'" style="fill: rgba(0, 0, 0, 0.3);"></polygon></g>';
          }else{
             pology = pology + '<g><polygon id="pzone'+data.id+'" points="'+zone.toString()+'" style="fill: rgba(0, 0, 0, 0.7);"></polygon></g>';
          }
      }

      else if(data.state == 0){

        

      pology = pology + '<g><polygon id="pzone'+data.id+'" points="'+zone.toString()+'" style="fill: rgba(255, 0, 0, 0.0);"></polygon></g>';
    
      }else if (data.state == 1){    
      pology = pology + '<g><polygon id="pzone'+data.id+'" points="'+zone.toString()+'" style="fill: rgba(0, 0, 255, 0.2);"></polygon></g>';
      }
      else if (data.state == 2){    
      pology = pology + '<g><polygon id="pzone'+data.id+'" points="'+zone.toString()+'" style="fill: rgba(0, 0, 255, 0.2);"></polygon></g>';
      }
      else if (data.state == 3){    
      pology = pology + '<g><polygon id="pzone'+data.id+'" points="'+zone.toString()+'" style="fill: rgba(0, 255, 0, 0.2);"></polygon></g>';
      }
      // console.log(pology)

// medium_x = parseInt(medium_x/parseInt(zone.length/2))
//       medium_y = parseInt(medium_y/parseInt(zone.length/2))


//       totalContribute.push(data.contribute_state)

//      // pology = pology + '<g><polygon points="'+zone.toString()+'" style="fill: rgba(255, 0, 0, 0.1);"></polygon></g>';
//        var div = document.createElement('div');

//     if (data.state > -1){
       
//       div.setAttribute("id", 'area' + data.id)
//       div.setAttribute("class", 'display')

//       document.body.appendChild(div);
//       var offset = $("#zone").offset();
//       if (data.display == 0){
//       if (window.innerWidth <  500){

//       if (data.name.includes("BT")){
//       $('#area' + data.id).css({width: (max_x - min_x)/3});
//       $('#area' + data.id).css({height: (max_x - min_x)/3});
//       $('#area' + data.id).css({left: offset.left + medium_x+15});
//       $('#area' + data.id).css({top:  offset.top + medium_y+10});
//       }else{
//       $('#area' + data.id).css({width: (max_x - min_x)/3});
//       $('#area' + data.id).css({height: (max_x - min_x)/3});
//       $('#area' + data.id).css({left: offset.left + medium_x+16});
//       $('#area' + data.id).css({top:  offset.top + medium_y+18});
//       }

//       }else if (window.innerWidth <  800){

//       if (data.name.includes("BT")){
//       $('#area' + data.id).css({width: (max_x - min_x)/3});
//       $('#area' + data.id).css({height: (max_x - min_x)/3});
//       $('#area' + data.id).css({left: offset.left + medium_x});
//       $('#area' + data.id).css({top:  offset.top + medium_y+10});
//       }else{
//       $('#area' + data.id).css({width: (max_x - min_x)/3});
//       $('#area' + data.id).css({height: (max_x - min_x)/3});
//       $('#area' + data.id).css({left: offset.left + medium_x});
//       $('#area' + data.id).css({top:  offset.top + medium_y+10});
//       }
//       }else{
//       if (data.name.includes("BT")){
//       $('#area' + data.id).css({width: (max_x - min_x)/2.5});
//       $('#area' + data.id).css({height: (max_x - min_x)/2.5});
//       $('#area' + data.id).css({left: offset.left + medium_x});
//       $('#area' + data.id).css({top:  offset.top + medium_y-10});
//       }else{
//       $('#area' + data.id).css({width: (max_x - min_x)/3});
//       $('#area' + data.id).css({height: (max_x - min_x)/3});
//       $('#area' + data.id).css({left: offset.left + medium_x+15});
//       $('#area' + data.id).css({top:  offset.top + medium_y +15});

//       }
//     }
//   }else{
//      if (window.innerWidth <  600){

//       if (data.name.includes("BT")){
//       $('#area' + data.id).css({width: (max_x - min_x)/3});
//       $('#area' + data.id).css({height: (max_x - min_x)/3});
//       $('#area' + data.id).css({left: offset.left + medium_x+15});
//       $('#area' + data.id).css({top:  offset.top + medium_y+10});
//       }else{
//       $('#area' + data.id).css({width: (max_x - min_x)/3});
//       $('#area' + data.id).css({height: (max_x - min_x)/3});
//       $('#area' + data.id).css({left: offset.left + medium_x+10});
//       $('#area' + data.id).css({top:  offset.top + medium_y+15});
//       }

//       }else if (window.innerWidth <  1300){

//   // document.getElementById("testButton").innerHTML = window.innerWidth+ " 800 good";
//       if (data.name.includes("BT")){
//       $('#area' + data.id).css({width: (max_x - min_x)/3});
//       $('#area' + data.id).css({height: (max_x - min_x)/3});
//       $('#area' + data.id).css({left: offset.left + medium_x});
//       $('#area' + data.id).css({top:  offset.top + medium_y+12});
//       }else{
//       $('#area' + data.id).css({width: (max_x - min_x)/3});
//       $('#area' + data.id).css({height: (max_x - min_x)/3});
//       $('#area' + data.id).css({left: offset.left + medium_x});
//       $('#area' + data.id).css({top:  offset.top + medium_y+20});
//       }
//       }else{
//   // document.getElementById("testButton").innerHTML = window.innerWidth+ " 800 not good";
//       if (data.name.includes("BT")){
//       $('#area' + data.id).css({width: (max_x - min_x)/2.5});
//       $('#area' + data.id).css({height: (max_x - min_x)/2.5});
//       $('#area' + data.id).css({left: offset.left + medium_x-20});
//       $('#area' + data.id).css({top:  offset.top + medium_y-20});
//       }else{
//       $('#area' + data.id).css({width: (max_x - min_x)/3});
//       $('#area' + data.id).css({height: (max_x - min_x)/3});
//       $('#area' + data.id).css({left: offset.left + medium_x+10});
//       $('#area' + data.id).css({top:  offset.top + medium_y -10});

//       }
//     }
//   }
//         if (data.contribute_state == 0){
//           console.log("right here")
//       $('#area' + data.id).css({"background-image": "url('/js-css/img/contribute/step1.png')"});
      

//         }else if (data.contribute_state == 1){    
        
//       $('#area' + data.id).css({"background-image": "url('/js-css/img/contribute/step2.png')"});
//         }else if (data.contribute_state == 2){  
//         $('#area' + data.id).css({"background-image": "url('/js-css/img/contribute/step3.png')"});
//         }
//       }
}
  }
  function loadZoneEdit(id,state){


  document.getElementById("zone_edit_id").value = id
console.log(document.getElementById("zone"+id+"name").innerHTML)
console.log("1234124")
document.getElementById("zone_edit_name").value = document.getElementById("zone"+id+"name").innerHTML ;
      document.getElementById("zone_edit_pos").value = document.getElementById("zone"+id+"position").innerHTML ;

      document.getElementById("zone_edit_acreage").value = parseInt(document.getElementById("zone"+id+"acreage").innerHTML) ;

      document.getElementById("zone_edit_view").value = document.getElementById("zone"+id+"view").innerHTML ;

      

  $("#zone-edit").modal('show');

  }

  function loadZoneData(id,state){

         $.ajax({
    type: "GET",
    url: '/save-click/'+id,
    success: function (response) {
        console.log(response)
    }
  });
    console.log(id)

  document.getElementById("confirm_id").value = id
  lock = document.getElementById("zone"+id+"lock").value
  lockuser = document.getElementById("zone"+id+"lockuser").value
  
  document.getElementById("ShareLink").href = "/public-map/{!! $project->id !!}/" + id

  document.getElementById("confirm_state").value = state

document.getElementById("nameInfo").innerHTML = document.getElementById("zone"+id+"name").innerHTML ;
var imgsrc = "js-css/img/preview.jpg"
if(document.getElementById("zone"+id+"img").value.toString().length > 3){
imgsrc = document.getElementById("zone"+id+"img").value
}
document.getElementById("zoneImg").src = imgsrc ;

      document.getElementById("stateInfo").innerHTML = document.getElementById("zone"+id+"state").innerHTML ;
      document.getElementById("positionInfo").innerHTML = document.getElementById("zone"+id+"position").value ;
      // document.getElementById("depositInfo").innerHTML = document.getElementById("zone"+id+"deposit").innerHTML ;
      document.getElementById("viewInfo").innerHTML = document.getElementById("zone"+id+"view").value ;
    if (state == 1){      
  document.getElementById("UpdateLinkInfo").style.display = "none";

  document.getElementById("TransLinkInfo").style.display = "none";
  document.getElementById("LockLinkInfo").style.display = "none";
        document.getElementById("consumer_info").style.display = "block";
        document.getElementById("staff_info").style.display = "block";
        document.getElementById("date_info").style.display = "block";

     


    }
    else if (state > 1){  
  console.log(document.getElementById("zone"+id+"staff").innerHTML)
 
      

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

svg.on('mouseover', function(e){

  $(".mypopupinfo").hide()
 for (i = 0; i <totalPoints.length;i++){
      flag = pointInPolygon(d3.mouse(this),totalPoints[i])
      if (flag == true){
        index =i
        lastState = totalState[lastID]
        myLastId  = totalId[lastID]
        console.log(lastState)
        console.log(myLastId)

        if(lastState == 0){


        document.getElementById("pzone"+myLastId).style.fill = "rgba(255, 0, 0, 0.0)";
    
      }else if (lastState== 1){    
        document.getElementById("pzone"+myLastId).style.fill = "rgba(0, 0, 255, 0.2)";
      }
      else if (lastState == 2){    
        document.getElementById("pzone"+myLastId).style.fill = "rgba(0, 0, 255, 0.2)";
      }
      else if (lastState == 3){    
        document.getElementById("pzone"+myLastId).style.fill = "rgba(0, 255, 0, 0.2)";
      }

        lastID = index
        myId  = totalId[index]
        document.getElementById("pzone"+myId).style.fill = "rgba(255, 102, 153, 0.5)";
        var html  = (document.getElementById("zone"+myId+"name").innerHTML)
        html = html + "("+(document.getElementById("zone"+myId+"acreage").innerHTML) +")"
 if (window.innerWidth >  600){
      if(window.innerWidth >  900){
        $(".mypopupinfo").css({left: d3.event.pageX+50});
        $(".mypopupinfo").css({top: d3.event.pageY});
      }else{

        $(".mypopupinfo").css({left: d3.event.pageX+30});
        $(".mypopupinfo").css({top: d3.event.pageY});
      }
        $("#popupdetail").html(html)
        $(".mypopupinfo").show()
}

        res = true
        break
      }

    }

});

svg.on('click', function(){

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
  }else if(status == 2){
    for (i = 0; i <totalPoints.length;i++){
      flag = pointInPolygon(d3.mouse(this),totalPoints[i])
      if (flag == true){
        index =i
        confirm_remove(totalId[i])
        break
      }
    }
  }
  else{
      res = false;
    var index = 0;
    // console.log(d3.mouse(this))
    // console.log(totalPoints[0])
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
    status = document.getElementById("zoneStatus").value;
    if (status == 3){
        loadZoneEdit(id,state)

    }else{
        loadZoneData(id,state)
      }
      }
  
  // $("#zone_content").empty();
  //   getZone()

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

  drawing = false;

  var ratio = ($("svg").width())/720;
  let temp = points.slice();
  console.log(temp)
  var lockZone = temp.map(x => [parseInt(x[0]),parseInt(x[1])]);
  temp = temp.map(x => [parseInt(x[0]) / ratio,parseInt(x[1]) / ratio]);
  console.log("!23123")


  var lock = document.getElementById("lockStatus").value;
  if(lock == 1){
    sid = []
  console.log(lockZone)
  console.log(totalMedium[0])

for (i = 0; i <totalPoints.length;i++){
      flag = pointInPolygon(totalMedium[i],lockZone)
      if (flag == true){
        sid.push(totalId[i])
      }
    }
    console.log(sid)
    document.getElementById("lock_input").value = sid;
    document.getElementById("lock_type").value = 2;
    document.getElementById("lock_form").submit();
  }else if (lock == 2){
       sid = []
  console.log(lockZone)
  console.log(totalMedium[0])

for (i = 0; i <totalPoints.length;i++){
      flag = pointInPolygon(totalMedium[i],lockZone)
      if (flag == true){
        sid.push(totalId[i])
      }
    }
    console.log(sid)
    document.getElementById("lock_input").value = sid;
    document.getElementById("lock_type").value = 0;
    document.getElementById("lock_form").submit();

  }else{

  document.getElementById("zone_input").value = temp;
  totalPoints.push(temp)
  $("#new-area").modal('show');

  }
  points.splice(0);    // console.log("doine")
    // console.log(temp)
    // console.log(points)
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
    }

    else{
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


  function updateZone(){
    zones = [$("svg").width(),$("svg").height()];
    for(var i=0; i<$("svg g").length ; i++){
      zones.push(($("svg").children()[i]).childNodes[0].getAttribute('points'));
    }
    try{
      $.ajax({
        type: "POST",
        data : {"_token": $('meta[name="csrf-token"]').attr('content'),zones},
        url : "project-update-zone/"+{!! $project->id !!},
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
  function lockZone(){
    status = document.getElementById("zoneStatus").value;
    document.getElementById("lockStatus").value = 1;
    if (status != 1){
      document.getElementById("zoneStatus").value = 1;
      document.getElementById("lockBtn").innerHTML = '<i class="fa fa-lock" aria-hidden="true">Hủy';

    }else{
      document.getElementById("zoneStatus").value = 0;
      document.getElementById("lockBtn").innerHTML = '<i class="fa fa-lock" aria-hidden="true">Khóa';
      ;

    }
  }

  function openZone(){
    status = document.getElementById("zoneStatus").value;
    document.getElementById("lockStatus").value = 2;
    if (status != 1){
      document.getElementById("zoneStatus").value = 1;
      document.getElementById("openBtn").innerHTML = '<i class="fa fa-unlock" aria-hidden="true">Hủy';

    }else{
      document.getElementById("zoneStatus").value = 0;
      document.getElementById("openBtn").innerHTML = '<i class="fa fa-unlock" aria-hidden="true">Mở khóa';
      ;

    }
  }

 function fixZone(){
    status = document.getElementById("zoneStatus").value;
    document.getElementById("lockStatus").value = 0;
    if (status != 1){
      document.getElementById("zoneStatus").value = 1;
      document.getElementById("btnFixZone").innerHTML = "Done";
    }else{
      document.getElementById("zoneStatus").value = 0;
      document.getElementById("btnFixZone").innerHTML = "Fix Zone";

    }
  }

   function deleteZone(){
    status = document.getElementById("zoneStatus").value;
    if (status != 2){
      document.getElementById("zoneStatus").value = 2;
      document.getElementById("btnFixZone").innerHTML = "Fix Zone";
      document.getElementById("btnDetZone").innerHTML = "Done";
    }else{
      document.getElementById("zoneStatus").value = 0;
      document.getElementById("btnFixZone").innerHTML = "Fix Zone";
      document.getElementById("btnDetZone").innerHTML = "Delete Zone";

    }
  }

     function editZone(){
    status = document.getElementById("zoneStatus").value;
    if (status != 3){
      document.getElementById("zoneStatus").value = 3;
      document.getElementById("btnEditZone").innerHTML = "Done";
    }else{
      document.getElementById("zoneStatus").value = 0;
      document.getElementById("btnEditZone").innerHTML = "Edit Zone";

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

<script>

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

var ZonePosition = []
var ZonePositionIndex = []

   function getZPList(){
  $.ajax({
    type: "GET",
    url: '/system/zone-position-list/',
    success: function (response) {
      response = (JSON.parse(response))
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'



      for(var i =0; i < response.length; i++){

        ZonePositionIndex.push(response[i].id)
        ZonePosition.push(response[i].name)         
      }


    }
  });
}

getZPList()
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
//    function displayZone(data) {
//       // console.log(data)
//       var zone = data.zone

//     var table = document.getElementById("zone_content"); 
//     var row = table.insertRow();

//     // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
//     var cell1 = row.insertCell(0);
//     var cell3 = row.insertCell(1);
//     var cell2 = row.insertCell(2);
//     var cell4 = row.insertCell(3);
//     var cell5 = row.insertCell(4);
//     var cell6 = row.insertCell(5);
//     var cell7 = row.insertCell(6);
//     var cell8 = row.insertCell(7);
//     var cell9 = row.insertCell(8);
//     var cell10 = row.insertCell(9);

//     var staff = ""
//     var consumer = ""
//     var state = ""
//     var info  = ""
//     cell1.innerHTML = "<span id='zone" +data.id +"name'>"+data.name+"</span>"
//   if (data.state == 0){
//       staff = "<span style='display:none'>None</span>"
//       consumer = "<span>None</span>"
//       state = "<span id='zone" +data.id +"state'>Trống</span>"
//       info ="<span style='display:none'  id='zone" +data.id +"date'>None</span>"
//    }else if (data.state == 1){
//       staff = "<span style='display:none' id='zone" +data.id +"staff'>"+data.staff_name+"</span>"
//       consumer = "<span id='zone" +data.id +"consumer'>"+data.consumer_name+"</span>"
//       state = "<span id='zone" +data.id +"state'>Đợi thanh toán</span>"
//       info = "<span style='display:none'  id='zone" +data.id +"date'> Ngày đặt: "+data.deposit_date +"</span>"
//       } else if (data.state == 2){
//       staff = "<span style='display:none' id='zone" +data.id +"staff'>"+data.staff_name+"</span>"
//       consumer = "<span id='zone" +data.id +"consumer'>"+data.consumer_name+"</span>"
//       state = "<span id='zone" +data.id +"state'>Đợi thanh toán</span>"
//       info = "<span style='display:none'  id='zone" +data.id +"date'> Ngày đặt: "+data.deposit_date +"</span>"
//    } else if (data.state == 3){
//       staff = "<span style='display:none' id='zone" +data.id +"staff'>"+data.staff_name+"</span>"
//       consumer = "<span id='zone" +data.id +"consumer'>"+data.consumer_name+"</span>"
//       state = "<span id='zone" +data.id +"state'>Đã thanh toán</span>"
//       info = "<span style='display:none'  id='zone" +data.id +"date'> Ngày đặt: "+data.deposit_date+"<br> Ngày thành toán: "+data.complete_date +"</span>"
//    } 
// cell2.innerHTML = "<span id='zone" +data.id +"acreage'>"+data.acreage+" m </span>"
//     cell3.innerHTML = staff + "<span id='zone" +data.id +"unit'>"+formatMoney(data.unit_price)+"VND </span>"
//     cell4.innerHTML = consumer
//     cell5.innerHTML = state
//     cell6.innerHTML = "<span id='zone" +data.id +"final_price'>"+formatMoney(data.final_price)+" VND</span>"
//     if(data.real_price > 0){
//     cell7.innerHTML = "<span id='zone" +data.id +"real_price'>"+formatMoney(parseInt(data.real_price)*parseInt(data.acreage))+" VND</span>"
//   }else{
//     cell7.innerHTML = "<span id='zone" +data.id +"real_price'>"+formatMoney(data.final_price)+" VND</span>"

//   }
//     cell8.innerHTML = "<span id='zone" +data.done +"price'>"+formatMoney(data.done)+" VND</span>"
//     cell9.innerHTML = "<span id='zone" +data.dept +"price'>"+formatMoney(data.dept)+" VND</span>"+info

//     hidden_input = ""

//     hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"consumer_phone_number' value='"+data.consumer_phone_number+"'>"


//     hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"aid' value='"+data.aid+"'>"


//     hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"consumer_identify_card' value='"+data.consumer_identify_card+"'>"

//     hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"staff_phone_number' value='"+data.staff_phone_number+"'>"

//     hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"staff_identify_card' value='"+data.staff_identify_card+"'>"

//     hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"accountant_name' value='"+data.accountant_name+"'>"

//     hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"accountant_phone_number' value='"+data.accountant_phone_number+"'>"


//     hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"deposit_date' value='"+data.deposit_date+"'>"


//     hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"complete_date' value='"+data.complete_date+"'>"


//     hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"position' value='"+ZonePosition[ZonePositionIndex.indexOf(data.position)]+"'>"


//     hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"deposit' value='"+data.deposit+"'>"


//     hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"view' value='"+data.view+"'>"




//     cell10.innerHTML = hidden_input + '<i class="fa fa-eye" aria-hidden="true" onclick = "loadDisplayZoneData('+data.id+','+data.state+')"></i>'
 
//     }
  

  function loadDisplayZoneData(id,state){
    console.log(id)
  document.getElementById("confirm_id").value = id
  document.getElementById("LinkInfo").href = "/sale/view-by-zone/" + id
  
  // document.getElementById("MapInfo").href = "/area-information/" + document.getElementById("zone"+id+"aid").value ;

  document.getElementById("confirm_state").value = state
  document.getElementById("consumer_info").style.display = "none";
  document.getElementById("staff_info").style.display = "none";
  document.getElementById("accountant_info").style.display = "none";
  document.getElementById("date_info").style.display = "none";
  document.getElementById("confirm_info").style.display = "none";

document.getElementById("nameInfo").innerHTML = document.getElementById("zone"+id+"name").innerHTML ;
      document.getElementById("priceInfo").innerHTML = document.getElementById("zone"+id+"final_price").innerHTML ;
      document.getElementById("stateInfo").innerHTML = document.getElementById("zone"+id+"state").innerHTML ;
      document.getElementById("positionInfo").innerHTML = document.getElementById("zone"+id+"position").innerHTML ;
      // document.getElementById("depositInfo").innerHTML = document.getElementById("zone"+id+"deposit").innerHTML ;
      document.getElementById("viewInfo").innerHTML = document.getElementById("zone"+id+"view").innerHTML ;
    if (state == 1){    
  document.getElementById("TransLinkInfo").style.display = "none";
        document.getElementById("consumer_info").style.display = "block";
        document.getElementById("staff_info").style.display = "block";
        document.getElementById("date_info").style.display = "block";

    

      document.getElementById("ConsumerNameInfo").innerHTML = document.getElementById("zone"+id+"consumer").innerHTML ;
      document.getElementById("ConsumerPhoneInfo").innerHTML = document.getElementById("zone"+id+"consumer_phone_number").value ;

      document.getElementById("StaffNameInfo").innerHTML = document.getElementById("zone"+id+"staff").innerHTML  ;
      document.getElementById("StaffPhoneInfo").innerHTML = document.getElementById("zone"+id+"staff_phone_number").value ;


      document.getElementById("DepositDateInfo").innerHTML =document.getElementById("zone"+id+"deposit_date").value ;
      document.getElementById("CompleteDateInfo").innerHTML = "None";



    }
    else if (state == 2){  
  document.getElementById("TransLinkInfo").style.display = "none";
        document.getElementById("consumer_info").style.display = "block";
        document.getElementById("staff_info").style.display = "block";
        document.getElementById("accountant_info").style.display = "block";
        document.getElementById("date_info").style.display = "block";

      document.getElementById("nameInfo").innerHTML = document.getElementById("zone"+id+"name").innerHTML ;
      document.getElementById("priceInfo").innerHTML = document.getElementById("zone"+id+"final_price").innerHTML ;
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
</script>
<script type="text/javascript">
  

    function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }
</script>
<script src="js-css/datatables/jquery.dataTables.js"></script>
<script src="js-css/datatables/dataTables.bootstrap4.js"></script>
<script type="text/javascript">
function getDisplayZone(){
    myTimer = 1;
    $.ajax({
      url: "get-all-zone/",
      success: async function(res) {
        res = JSON.parse(res)
        // console.log(res)
        while(true){
            try{
              await res.forEach(displayZone);
              break;
             
            }
            catch(err) {
              console.log(err.message);
              break;
            }
          
        }
          // $('#zone-table').DataTable({
          //           "order": [[ 3, "desc" ]]
          //       })

            $('#zone-statistic').DataTable({
                    "order": [[ 3, "desc" ]]
                })

      }
    });
  }

// getDisplayZone()
 $('#zone-statistic').DataTable({
                    "order": [[ 3, "desc" ]]
                })
  $('#zone-statistic2').DataTable({
                    "order": [[ 3, "desc" ]]
                })

</script>

        <!-- DataTables -->
<script type="text/javascript">
 $(document).ready(function(){
    $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');
        $("#"+this.href.split("#")[1]).addClass('active');

        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });
});
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

