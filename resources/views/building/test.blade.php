@extends('../layouts/index')
@section('content')

<link rel="stylesheet" href="js-css/css/stepprogressbar.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style type="text/css">
  .progress{
    min-height: 30px;
    background-color: transparent;
}
.progress-bar{
    font-size: 15px;
  }
  .popover-header {
    color: black;
  }

</style>
<div class="content-camera">
  <div class="header-content">
  </div>
  <div class="session">
  	@if(Session::has('notification'))
  	<input hidden="" notifi="{{Session::get('notifcation')}}" value="1" id="notice_success">
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
  	  	<?php
  	  	  if(Auth()->user()->role_id<=2){
  	  	?>
  	     <div class="proxy-add" title="Manual Add">
  	     	<button class="camera-button" type="button" data-toggle="modal" data-target="#new-camera"><i class="fa fa-plus" aria-hidden="true"></i>Manual Add</button></div>

  	     <div class="proxy-add" title="Delete"><button class="camera-button" type="button" id="device-remove"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</button><button style="display: none;" id="submit-action" type="submit"></button></div>

  	     <div class="proxy-add" title="Refresh"><button class="camera-button" type="button" onclick="location.reload()"; ><i class="fa fa-refresh" aria-hidden="true"></i>Refresh</button> </div>
  	      	<div class="search-input proxy-add" title="Serach">
  	      	<input type="text" class="textbox" id="search-input" placeholder="Search">
  	      	<input title ="Search" value="" type="button" class="button">
  	      	</div>
  	     <?php
  	      }
  	     ?>
  	     </div>
  	     <table class="nvr-table" id="camera-table">
  	     	<thead>
  	     		<tr class="thead">
  	     			<th>ten du an</th>
  	     			<th>tien do xay dung</th>
  	     			<th>tien do nghiem thu </th>
  	     			<th>tien do thanh toan</th>
  	     		</tr>
  	     	</thead>
  	     	<tbody class="tbody">
  	     		@foreach($projects as $project)
                            <tr class="color-add">
    	                        
    	                        <td><i id="project{{$project->id}}" class="fa fa-circle active-off cam-status" aria-hidden="true"></i> <img src="/js-css/img/icon/map.png" width='32' height='32'><a href="/building/data/{{$project->id}}"> {{$project->jname}}</a></td>
    	                        <td>
<?php
$date1 = $project->start;
$date2 = $project->end;
$timestamp1 = strtotime($date1);
$timestamp2 = strtotime($date2);
$fixhour = intval(($timestamp2 - $timestamp1)/(60*60));
if ($fixhour < 0){
  $fixhour = 0;
}

$date1 = $project->start;
$date2 = date("Y-m-d H:i:s");
$timestamp1 = strtotime($date1);
$timestamp2 = strtotime($date2);
$curhour = intval(($timestamp2 - $timestamp1)/(60*60));
if ($curhour < 0){
  $curhour = 0;
}

if ($curhour < 0){
  $percent = 1;
}if($curhour > $fixhour){
  $percent = 100;
}else{
  $percent = floatval($curhour/$fixhour);
}


?>
{{round($project->real_percent,2)}}% / {{round($percent,2)}}%               

                              </td>
                               <td>
                                {{$project->acceptance_percent}} % /100 %
                      
                              </td>
                               <td>
                                {{$project->payment_percent}} % /100 %
                      
                              </td>

                           
                            </tr>              
    	        @endforeach                
  	     	</tbody>
  	     </table>
  	     <button class="btn btn-model"><a href="/icon/build"></a>Quay lại</button>
  	  </form>	
  	 </div>	
  	</div>
  </div>
  <!-- Modal -->
  <div class="modal fade modol-text" id="new-camera" rola="dialog">
  	<div class="modal-dialog model-right">
  		<!-- Modal content -->
  		<div class="modal-content">
  		  <form id="create-form" action="add-new-camera" method="POST">
  		  	<input type="hidden" name="_token" value="{{csrf_token()}}">
  		  	<div class="modal-header">
  		  		<label>Manual add camera</label>
  		  	</div>
  		  	<div class="notification"></div>
  		  	<div class="modal-body">
  		  		<table class="table-edit table-model">
  		  			<tbody class="table-edit table-manual-add">
  		  				<tr>
  		  					<td class="cam-properties"><b class="required">*</b>Device Name</td>
  		  					<td><input type="" name="device_name" class="input-edit modol-text" id="device-name modol-text" id="ib" required=""></td>
  		  				</tr>
  		  				<tr>
  		  					<td class="cam-properties"><b class="required"*></b>ID</td>
  		  					<td><input type="" name="id_address" class="input-edit" id="device-name modal-text"></td>
  		  				</tr>
  		  				<tr>
  		  					<td class="cam-properties">Port</td>
  		  					<td><input type="number" name="port" class="input-edit modol-text" id="device-name modol-text"></td>
  		  				</tr>
  		  				<tr>
  		  					<td class="cam-properties">Camera Name</td>
  		  					<td><input type="" name="camera_name" class="input-edit modol-text" id="camera-name"></td>
  		  				</tr>
  		  				<tr>
  		  					<td></td>
  		  					<td><button class="btn btn-model" id="camera-add">&nbsp;&nbsp;Add&nbsp;&nbsp;</button>
  		  						<button type="button" class="btn btn-model" data-dismiss> Cancel</button>
  		  					</td>
  		  				</tr>
  		  			</tbody>
  		  		</table>
  		  	</div>
  		  </form>	
  		</div>
  	</div>
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

    $('[data-toggle="popover"]').popover();   
    
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
</div>