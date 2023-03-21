<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Lopital</title>
        <link rel="icon" type="image/ico" href="js-css/img/title_logo.png" />
        <base href="{{asset('')}}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="js-css/css/bootstrap.min.css">
        <script src="js-css/js/jquery.min.js"></script>
        <script src="js-css/js/popper.min.js"></script>
        <script src="js-css/js/bootstrap.min.js"></script>

         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700">

                             
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
        <link rel="stylesheet" href="js-css/font/font-awesome.min.css">
       
            <link rel="stylesheet" href="js-css/css/css2.css">
        
        <link rel="stylesheet" href="js-css/css/custom.css">
        <script src="js-css/js/jquery.dataTables.min.js"></script>
        <script src="js-css/js/sweetalert.js"></script>
        <link rel="stylesheet" href="js-css/css/sweetalert.css">

        <script src="js-css/js/script.js"></script>
        <script src="js-css/js/Chart.js"></script>
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>

<style>

.search-input{
    float: left;
    min-width: 294px;
    max-width: 550px;
}
.sreach-content{
  margin-left: 1%;
}


  .GoogleContent iframe{

    width: 100%;
    min-height: 400px;
      }
/* ---------- LIVE-CHAT ---------- */

#live-chat {
  bottom: 0;
  font-size: 12px;
  right: 24px;
  position: fixed;
  width: 20%;
}

#live-chat header {
  background: #293239;
  border-radius: 5px 5px 0 0;
  color: #fff;
  cursor: pointer;
  padding: 16px 24px;
}

#live-chat h4:before {
  background: #1a8a34;
  border-radius: 50%;
  content: "";
  display: inline-block;
  height: 8px;
  margin: 0 8px 0 0;
  width: 8px;
}

#live-chat h4 {
  font-size: 20px;
}

#live-chat h5 {
  font-size:20px;
}

#live-chat form {
  padding: 24px;
}

#live-chat input[type="text"] {
  border: 1px solid #ccc;
  border-radius: 3px;
  padding: 8px;
  outline: none;
  width: 234px;
}

.chat-message-counter {
  background: #e62727;
  border: 1px solid #fff;
  border-radius: 50%;
  display: none;
  font-size: 12px;
  font-weight: bold;
  height: 28px;
  left: 0;
  line-height: 28px;
  margin: -15px 0 0 -15px;
  position: absolute;
  text-align: center;
  top: 0;
  width: 28px;
}

.chat-close {
  background: #1b2126;
  border-radius: 50%;
  color: #fff;
  display: block;
  float: right;
  font-size: 10px;
  height: 16px;
  line-height: 16px;
  margin: 2px 0 0 0;
  text-align: center;
  width: 16px;
}

.chat {
  background: #fff;
}

.chat-history {
  height: 252px;
  padding: 8px 24px;
  overflow-y: scroll;
}

.chat-message {
  margin: 16px 0;
}

.chat-message img {
  border-radius: 50%;
  float: left;
}

.chat-message-content {
  margin-left: 56px;
}

.chat-time {
  float: right;
  font-size: 10px;
}

.chat-feedback {
  font-style: italic; 
  margin: 0 0 0 80px;
}

  /* Popup container - can be anything you want */
  .mypopupinfo {

  background-color: blue;
  border-radius: 50%;
  font-size: 15px;
  font-weight: 30px;
  display: none;
  position: absolute;
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
        	<div class="row row-content">
        		<div class="row-title-proxy">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
          			<div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;</div>
 

              </div></div>
 <div class="row-content">
<ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#content1">Bản đồ dự án</a>
      </li> 


      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content2">Tìm kiếm</a>
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
                      <label>Trạng thái</label>
                       <select class="textbox" id="search-type">
                         <option value="-1">Tất cả</option>
                         <option value="Trống">Trống</option>
                       </select>
                      </div>
                       <div class="search-input proxy-add" title="Serach">
                      <label>Mã BDS</label>
                        <input type="text" class="textbox" id="search-input-bds" placeholder="Search"> <span>. (LK : liền kề, BT: Biệt thự)</span>
                      </div>
                   
      <div class="search-input proxy-add" title="Serach">
    <button class="btn btn-model" id ="search-input-btn">Tìm kiếm</button>
  </div>      </div>  


  <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;List of Zone</div>
                     


                     <div class="search-input proxy-add" title="Serach">
                        <input type="text" class="textbox" id="search-input" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div>
<table id="zone-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>ID</th>
                            <th>Mã BDS</th>
                            <th>Đơn giá</th>
                            <th>Diện tích</th>
                            <th>Trạng thái</th>
                            <th>Giá dự kiến </th>
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

  <div id="live-chat">
    
    <header class="clearfix">
      
      <h4>Tư vấn trực tuyến</h4>

    </header>

    <div class="chat">

      <div  class="GoogleContent">
        <iframe src="/chatify/consumer/{{$cid}}"></iframe>

        </div>
      </div>
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

            <li style="display:none" class="list-group-item">
            <b class="color-b">Hướng:</b>
            </a>  <i id="positionInfo"> </i> 
            </li>

            <li style="display:none" class="list-group-item" >
            <b class="color-b">Đặc điểm:</b>
              <p id="viewInfo"> </p> 
            </li>

            <li class="list-group-item">
            <a>
            <b class="color-b">Đơn giá dự kiến:</b>
            </a>  <i id="priceInfo"> </i> 
            </li>

            <li class="list-group-item">
            <a>
            <b class="color-b">Trạng thái:</b>
            </a>  <i id="stateInfo"> </i> </li>
            </li>

            <li style="display:none" id="lock_info" class="list-group-item">
            <a>
            <b class="color-b">Còn:</b>
            </a>  <i id="lockInfo"> </i> Phút</li>
            </li>
          </ul>
   
          <ul id = "confirm_info"  class="list-group">
            <li class="list-group-item">
              <input value="" type="hidden" id="confirm_id" name="confirm_id">
              <input value="" type="hidden" id="confirm_state" name="confirm_state">
  
            
            </li>
              </ul>

          <ul id = "confirm_info"  class="list-group">
           
              <a href="" class="btn btn-model" id="LinkInfo"> &nbsp;&nbsp; Chi tiết &nbsp;&nbsp; </a>

    
   <a style="display: none" href="" class="btn btn-model" id="UpdateLinkInfo"> &nbsp;&nbsp; Hoàn thành&nbsp;&nbsp; </a>


   <a  style="display: none"  href="" class="btn btn-model" id="LockLinkInfo"> &nbsp;&nbsp; Khóa lô&nbsp;&nbsp; </a>

    <a style="display: none"  href="" class="btn btn-model" id="DepositLinkInfo"> &nbsp;&nbsp; Đặt cọc thiện chí &nbsp;&nbsp; </a>

    <a style="display: none"  href="" class="btn btn-model" id="TransLinkInfo"> &nbsp;&nbsp; Kí hợp đồng &nbsp;&nbsp; </a>


 
 <a href="" target="_blank" class="btn btn-model" style="display:block;" id="ShareLink" > &nbsp;&nbsp; Chia sẻ &nbsp;&nbsp; </a>

 <button style="
    width: 100%;" class="btn btn-model" data-dismiss="modal" id="nvr-add"> &nbsp;&nbsp; Thoát &nbsp;&nbsp; </button>
  </div>
</div>



<div class="mypopupinfo" style="" onclick='$(".mypopupinfo").hide();'>
      <div class="modal-body" id="popupdetail">
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
  var lastID = -1
  var totalId = []
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
      async: false,
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
    var cell0 = row.insertCell(0);
    var cell1 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell2 = row.insertCell(3);
    var cell4 = row.insertCell(4);
    var cell5 = row.insertCell(5);
    var cell6 = row.insertCell(6);
    var cell7 = row.insertCell(7);
    var cell8 = row.insertCell(8);
    var cell9 = row.insertCell(9);
    var cell10 = row.insertCell(10);

    var staff = ""
    var consumer = ""
    var state = ""
    var info  = ""

    cell0.innerHTML = data.id
    if({{$cid}} == data.customer_id){
    cell1.innerHTML = "<span id='zone" +data.id +"name'>"+data.name+"(Đã kí hợp đồng)</span>"

  }else{

    cell1.innerHTML = "<span id='zone" +data.id +"name'>"+data.name+" </span>"
  }
  if (data.state == 0){
      staff = "<span style='display:none'>Trống</span>"
      consumer = "<span>Trống</span>"
      state = "<span id='zone" +data.id +"state'>Trống</span>"
      info ="<span style='display:none'  id='zone" +data.id +"date'>None</span>"
   }else if (data.state == 1){
      staff = "<span style='display:none' id='zone" +data.id +"staff'>"+data.staff_name+"</span>"
      consumer = "<span id='zone" +data.id +"consumer'>"+data.consumer_name+"</span>"
      state = "<span id='zone" +data.id +"state'>Đã đặt</span>"
      info = "<span style='display:none'  id='zone" +data.id +"date'> Ngày đặt: "+data.deposit_date +"</span>"
      } else if (data.state == 2){
      staff = "<span style='display:none' id='zone" +data.id +"staff'>"+data.staff_name+"</span>"
      consumer = "<span id='zone" +data.id +"consumer'>"+data.consumer_name+"</span>"
      state = "<span id='zone" +data.id +"state'>Đã đặt</span>"
      info = "<span style='display:none'  id='zone" +data.id +"date'> Ngày đặt: "+data.deposit_date +"</span>"
   } else if (data.state == 3){
      staff = "<span style='display:none' id='zone" +data.id +"staff'>"+data.staff_name+"</span>"
      consumer = "<span id='zone" +data.id +"consumer'>"+data.consumer_name+"</span>"
      state = "<span id='zone" +data.id +"state'>Đã đặt</span>"
      info = "<span style='display:none'  id='zone" +data.id +"date'> Ngày đặt: "+data.deposit_date+"<br> Ngày thanh toán: "+data.complete_date +"</span>"
   } 

    cell3.innerHTML = staff + "<span id='zone" +data.id +"unit'>"+formatMoney(data.unit_price)+"VND </span>"
    cell4.innerHTML = state
    cell5.innerHTML = "<span id='zone" +data.id +"final_price'>"+formatMoney(data.final_price)+" VND</span>"
  
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

    hidden_input = hidden_input + "<input type='hidden' id='zone"+data.id+"customer_id' value="+data.customer_id+">"

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
    if({{$cid}} == data.customer_id){
pology = pology + '<g><polygon id="pzone'+data.id+'" points="'+zone.toString()+'" style="fill: rgba(0, 255, 255, 0.4);"></polygon></g>'
     }else if (data.lock > 0){
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

        
    console.log(id)
  document.getElementById("LinkInfo").href = "/sale/view-by-zone/" + id

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
        if (lastID > 0){
          console.log("here")
        var cid  = document.getElementById("zone"+myLastId+"customer_id").value
        console.log(cid)
}else{
  cid = 0
}

 if({{$cid}} == cid){

        document.getElementById("pzone"+myLastId).style.fill = "rgba(0, 255, 255, 0.4)";
     }
        else
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

        lastID = index
        myId  = totalId[index]
        document.getElementById("pzone"+myId).style.fill = "rgba(255, 102, 153, 0.5)";
        var html  = (document.getElementById("zone"+myId+"name").innerHTML)
        html = html + "("+(document.getElementById("zone"+myId+"acreage").innerHTML) +")"

        $(".mypopupinfo").css({left: d3.event.pageX+50});
        $(".mypopupinfo").css({top: d3.event.pageY});
        $("#popupdetail").html(html)
        $(".mypopupinfo").show()


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
        $("#search-input-btn").on("click", function() {

      // getZone()

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


        const formData = new FormData();
        formData.append('unit_price_low', priceUnitMin);
        formData.append('unit_price_high', priceUnitMax);
        formData.append('total_price_low', priceMin);
        formData.append('total_price_high', priceMax);

        formData.append('type', bdsValue);
        formData.append('area_low', areaMin);
        formData.append('area_high', areaMax);
        console.log("from copelete!!!!")


         formData.append('_token', '{{csrf_token()}}');
        $.ajax({
            url: "/save-search",
            method: 'POST',
            data: formData,
            dataType: 'JSON',
            processData: false,
            contentType: false,

          });


      $("#zone-table tbody tr").filter(function() {
        var bds =  ($(this)[0].childNodes[1].innerHTML)
        var type =  ($(this)[0].childNodes[4].innerHTML)
        var area =  parseInt($(this)[0].childNodes[3].innerText.replaceAll(',', ''))
        var price =  parseInt($(this)[0].childNodes[5].innerText.replaceAll(',', ''))
      var unit_price =  parseInt($(this)[0].childNodes[2].innerText.replaceAll(',', ''))



        $(this).toggle(bds.toLowerCase().indexOf(bdsValue) > -1
          && ((type.toLowerCase().indexOf(typeValue) > -1)
              || (typeValue == -1))
          && (area < areaMax  || areaMax == -1)
          && (area > areaMin || areaMin == -1)

          && (price < priceMax  || priceMax == -1)
          && (price > priceMin || priceMin == -1)

          && (unit_price < priceUnitMax  || priceUnitMax == -1)
          && (unit_price > priceUnitMin || priceUnitMin == -1)


          )

   if( bds.toLowerCase().indexOf(bdsValue) > -1
          && ((type.toLowerCase().indexOf(typeValue) > -1)
              || (typeValue == -1))
          && (area < areaMax  || areaMax == -1)
          && (area > areaMin || areaMin == -1)

          && (price < priceMax  || priceMax == -1)
          && (price > priceMin || priceMin == -1)

          && (unit_price < priceUnitMax  || priceUnitMax == -1)
          && (unit_price > priceUnitMin || priceUnitMin == -1)

        ){
        HighlightArea($(this)[0].childNodes[0].innerHTML)
      }
      });


      $("#tab1").click()

   

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
    console.log("ADSFasdf")
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




function HighlightArea(id){

  
  console.log("highlist!!")

        document.getElementById("pzone"+id).style.fill = "rgba(255, 102, 153, 0.5)";
}

</script>





        <!-- DataTables -->
<script type="text/javascript">
 $(document).ready(function(){
    $('.nav-link').click(function(event){
        //remove all pre-existing active classes

        if ( this.href.split("#")[1] != "content1" && this.href.split("#")[1] == "content2"){
          // alert("????")
            getZone()

        }

        $('.tab-pane').removeClass('active');
        $("#"+this.href.split("#")[1]).addClass('active');





        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });
});

  $('#live-chat header').on('click', function() {

    $('.chat').slideToggle(300, 'swing');
    $('.chat-message-counter').fadeToggle(300, 'swing');

  });

  $('.chat-close').on('click', function(e) {

    e.preventDefault();
    $('#live-chat').fadeOut(300);

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


