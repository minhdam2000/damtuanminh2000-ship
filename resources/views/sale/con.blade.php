@extends('../layouts/index')
@section('content')
    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6>Thông tin giao dịch</h6>
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
        <div class="">
        	<div class="row row-content">
        		<div class="row-title-proxy">
              <form action="#" method="POST" id="form-camera">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
          			<div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;Thông tin giao dịch</div>

         <?php
          if(Auth()->user()->admin_id < 2){

          ?>
                      <div class="proxy-add" title="Manual Add"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-camera"><i class="fa fa-plus" aria-hidden="true"></i> Manual Add</button></div>
                      <div class="proxy-add" title="Delete"><button type="button" class="camera-button" id="device-remove"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button><button style="display: none;" id="submit-action" type="submit"></button></div>
                      <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</button></div>
                     
                       
                    <?php
                  }
         ?>
  
  <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#content1">Giao dịch của tôi</a>
      </li> 
     
    </ul> 
  <hr>

<div class="tab-content">
  <div id="content1" class="tab-pane  in active">

                  <table id="zone-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                           
                            <th>Tên nhà</th>
                            <th>Diện tích</th>
                            <th>Hợp đồng</th>
                            <th>Đã trả </th>
                            <th>Còn nợ</th>
                            <th>Trạng thái</th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($myzone as $zone)
                            <tr class="color-add">
                              
                              <td><i id="project{{$zone->id}}" class="fa fa-circle active-off cam-status" aria-hidden="true"></i> <img src="js-css/img/icon/map.png" width='32' height='32'><a href="/sale/view/{{$zone->id}}"> {{$zone->name}}</a></td>

                              <td>{{$zone->acreage}} m <sup>2</sup></td>
                              <td>{{$zone->deposit_date}}</td>
                              <td>{{number_format(floatval($zone->done))}} VND</td>
                              <td>{{number_format(floatval($zone->dept))}} VND</td>
                              @if($zone->state < 2)

                              <td>Đã đặt cọc</td>
                              @elseif($zone->state == 2)

                              <td>Đang thanh toán</td>


                              @endif


                             
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
    <!-- Modal -->
      <div class="modal fade modol-text" id="new-camera" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
            <form id="create-form" action="add-new-camera" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
	              <div class="modal-header">
	                  <label>Manual Add Camera</label>
	              </div>
	              <div class="notification"></div>
	              <div class="modal-body">
	                <table class="table-edit table-model">
	                    <tbody class="table-edit table-manual-add">
	                        <tr>
	                            <td class="cam-properties"><b class="required">* </b>Device Name</td>
	                            <td><input type="" value="" name="device_name" class="input-edit modol-text" id="device-name" required=""></td>
	                        </tr>
	                        <tr>
	                            <td class="cam-properties"><b class="required">* </b>IP</td>
	                            <td><input type="" value="" name="ip_address" class="input-edit modol-text" id="ip" required=""></td>
	                        </tr>
	                        <tr>
	                            <td class="cam-properties">Port</td>
	                            <td><input type="number" value="" name="port" class="input-edit modol-text" id="port"></td>
	                        </tr>
	                        <tr>
	                            <td class="cam-properties">Camera Name</td>
	                            <td><input type="" value="" name="camera_name" class="input-edit modol-text" id="camera-name"></td>
	                        </tr>
	                        <tr>
	                            <td></td>
	                            <td><button class="btn btn-model" id="camera-add">&nbsp;&nbsp; Add &nbsp;&nbsp;</button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Cancel</button>
                              </td>
	                        </tr>
	                    </tbody>
	                </table>
	              </div>
	              <div class="modal-footer">
	                
	              </div>
          	</form>
            </div>
          </div>
      </div>
      <div class="overlay-dark"></div>
      <img class="img-overlay">
      <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> notifition</h6>
      </div>
      <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning</h6>
      </div>
<script  src="js-css/js/image-popup.js"></script>
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
      $("#camera-table tbody tr").filter(function() {
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
  function confirm_remove() {
          var remove = document.getElementById('device-remove');
          remove.addEventListener('click', function(e){
              $("#form-camera").attr("action","remove-camera");
              swal({
                  title: "",
                  text: " Are you sure you want to delete this cameras? ",
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
                    document.getElementById("submit-action").click();
                    swal.close();
                  }
                  else {
                    swal.close();
                  }
                });
            });
        }
        confirm_remove();
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

 $(document).ready(function(){
    $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');

        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });
});
</script>

<script src="js-css/datatables/jquery.dataTables.js"></script>
<script src="js-css/datatables/dataTables.bootstrap4.js"></script>
<script type="text/javascript">
  
  $('#zone-table').DataTable({
                    "order": [[ 0, "desc" ]]
                })

  $('#zone-table2').DataTable({
                    "order": [[ 0, "desc" ]]
                })

  $('#zone-done-table').DataTable({
                    "order": [[ 0, "desc" ]]
                })
</script>

@endsection
