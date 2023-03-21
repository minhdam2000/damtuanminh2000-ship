@extends('layouts.index')
@section('content')
	<div class="content-camera">
		<div class="header-content">
			<div class="header-content-left">
				<h6>User Management</h6>
			</div>
			<div class="header-content-right" style="display: inline;">
				<a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i> Home </h6></a>
				/
				<h6 class="display-inline">User Management</h6>
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
              <form action="removeuser" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div>
                        <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;List of Devices</div>
                        <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#create-user"><i class="fa fa-plus" aria-hidden="true"></i> New User</button></div>
                        <div class="proxy-add" title="Delete"><button type="button" class="camera-button" id="userRemove"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button><button style="display: none;" id="remove-edge" type="submit"></button></div>
                        <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</button></div>
                        <div class="search-input proxy-add" title="Serach">
                          <input type="text" class="textbox" id="search-input" placeholder="Search">
                          <input title="Search" value="" type="button" class="button">
                        </div>
                  </div>

                <table id="camera-table" class="nvr-table">
                      <thead>
                      <tr class="thead">
                          <th class="check-all">
                            <input type="checkbox" id="select-all" value="select-all"  name="select-all" onclick="checkAll();" />
                            <label for="select-all" class="display-inline" id="label-all"></label>
                            <label class="display-inline"></label>
                           </th>
                          <th><center><i class="fa fa-clipboard" aria-hidden="true"></i></center></td></th>
                          <th><center>Status</center></th>
                          <th>Full Name</th>
                          <th>Email Address</th>
                          <th>More</th>
                        </tr>
                      </thead>
                      <tbody class="tbody">
                        @foreach($users as $user)
                          <tr class="color-add">
                            <td>
                              <input type="checkbox" id="{{$user->id}}" value="{{$user->id}}" name="{{$user->id}}" class="check-box" />
                               <label for="{{$user->id}}" class="add-cam"></label>
                            </td>
                            <td>
                              <center>
                                <i class="fa fa-users" aria-hidden="true"></i>
                              </center>
                            </td>
                            <td><center><i class="fa fa-star text-warning"></i></center></td> 
                            <td data-toggle="modal" data-target="#location" userid="{{$user->id}}" onclick="getLog(this.getAttribute('userid'));" class="location-map"><i class="fa fa-map-marker"></i>&nbsp;{{$user->name}}</td>
                            <td><i class="fa fa-envelope-o" aria-hidden="true"></i> {{$user->email}}</td>
                            <td>
                              <span class="edit-user btn" data-toggle="modal" data-target="#edit-user" id="{{$user->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                </table>
                <button style="display: none;" id="remove-user" type="submit"></button>
              </form>
          </div>
        </div>




    </div>
	<!-- end model --->
  <!-- Modal -->
      <div class="modal fade modol-text" id="create-user" role="dialog">
        <form id="action-form" action="postuserregister" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label><i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 1.2em;"></i>&nbsp; New User</label>
              </div>
              <div class="notification"></div>
              <div class="modal-body modal-config">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                        <tr>
                            <td><i class="fa fa-user" aria-hidden="true"></i> Full Name</td>
                            <td><input type="" value="" name="name" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-envelope" aria-hidden="true"></i> Email Address</td>
                            <td><input type="email" value="" name="email" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-key" aria-hidden="true"></i> Password</td>
                            <td><input type="password" value="" name="password" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-key" aria-hidden="true"></i> Confirm Password</td>
                            <td><input type="password" value="" name="password_confirmation" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                    </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button class="btn btn-model" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Create User</button>
                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Cancel</button>
              </div>
            </div>
          </div>
        </form>
      </div>

      <!-- Modal edit-->
      <div class="modal fade modol-text" id="edit-user" role="dialog">
        <form id="action-edit" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label><i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 1.2em;"></i>&nbsp; Edit User</label>
              </div>
              <div class="notification"></div>
              <div class="modal-body">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                        <tr>
                            <td><i class="fa fa-user" aria-hidden="true"></i> Full Name</td>
                            <td><input type="" value="" name="full_name" class="input-edit create-user modol-text" id="full_name" required=""></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-envelope" aria-hidden="true"></i> Email</td>
                            <td><input type="email" value="" name="email" class="input-edit create-user modol-text" required="" id="email"></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-key" aria-hidden="true"></i> Password</td>
                            <td><input type="password" value="" name="password" class="input-edit create-user modol-text" id="password"></td>
                        </tr>
                    </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button class="btn btn-model" type="submit"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Update</button>
                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Cancel</button>
              </div>
            </div>
          </div>
        </form>
      </div>

      <!-- Modal location access-->
      <div id="location" class="modal fade" role="dialog">
        <div class="modal-dialog" style="max-width: 900px;">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <label><i class="fa fa-map-marker" aria-hidden="true" style="font-size: 1.2em;"></i>&nbsp;&nbsp;Access History</label>
            </div>
            <div class="modal-body" id="mylocation" style="overflow: auto;">
      
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-model" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Close</button>
            </div>
          </div>

        </div>
      </div>


	<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
    </div>
    <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
     </div>

<script type="text/javascript">

  $("#search-input").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#camera-table tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });


  function getLog(userid){
    $.ajax({
      url: 'getlog/'+userid,
      success: function(data) {
        $("#mylocation").html('');
        if(data.length == 0) {
          document.getElementById("mylocation").innerHTML = '<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;There is no access history !';
        }
        else{
          console.log(data);
          for(var i=0; i<data.length; i++){
            var row = document.createElement("div");
            row.innerHTML = 
                            "<div class='row'>" +
                              "<div class='col-sm-3'>" +
                                "<small class='timestamp'><i class='fa fa-clock-o'></i>&nbsp;" +data[i].created_at+ "</small>" +
                              "</div>" +
                              "<div class='col-sm-2'>" +
                                "<span>" +data[i].ip+"</span>" +
                              "</div>" +
                              "<div class='col-sm-3 location-map' id='"+data[i].id+"'>" +
                                "<span><img src='js-css/img/icon/map.png' width='25' height='25'>&nbsp;" +data[i].city+"</span>" +
                              "</div>" +
                              "<div class='col-sm-4'>" +
                                "<span>" +data[i].isp+"</span>" +
                              "</div>" +
                            "</div>" +
                            "<div id='map"+data[i].id+"' class='map-location'></div>";
            document.getElementById("mylocation").appendChild(row);
          }
        }


        $(".location-map").click(function() {
          var mapId = this.id;
          var mapInfo = data.find((res) => res.id == mapId);
          var map = new google.maps.Map(document.getElementById('map'+mapId), {
            center: {lat: mapInfo.latitude, lng: mapInfo.longitude},
            zoom: 8
          });
          $("#map"+mapId).css('height','300');
        });
      }
    });
  }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLqUZ7Au9giqWePedXFBr6FBItLJk8kTs" async defer></script>

<script>
  $(document).ready(function() {
      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }

      $('#example').DataTable({
        "paging":   false,
        "info":     false,
        "searching": false
      });
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
    function confirm_remove() {
          var remove = document.getElementById('userRemove');
          remove.addEventListener('click', function(e){
              swal({ 
                  title: "",   
                  text: " Are you sure you want to delete this users? ",   
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
                    document.getElementById("remove-user").click();
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

<script>
  $(".edit-user").click(function(){
    var userid = this.id;
    $.ajax({
      url: 'getuseredit/'+userid,
      success: function(data) {
        console.log(data);  
        $("#full_name").val(data.name);
        $("#email").val(data.email);
        $("#password").val('');
        $("#action-edit").attr('action', '/postuseredit/'+userid);      
      }
    });
  })
</script>

<script>
  function close_form(){
      var inputs = document.getElementsByClassName('create-user');
      for(i=0; i<inputs.length; i++){
        inputs[i].value = '';
      }
      document.getElementsByClassName('notification')[0].innerHTML ='';
      document.getElementsByClassName('notification')[0].classList.remove('notification-color');
    }
</script>

<script>
  $("#action-form").submit(function(event){
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
        if(response == 'true'){
          window.location.href = 'createusersuccess';
        }
        else if(response == 'Email already exist'){
          snakeModel();
          document.getElementsByClassName('notification')[0].innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> User already exists.";
          document.getElementsByClassName('notification')[0].classList.add('notification-color');
        }
        else if(response == 'The password confirmation does not match'){
          snakeModel();
          document.getElementsByClassName('notification')[0].innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Passwords do not match, Please re-enter password.";
          document.getElementsByClassName('notification')[0].classList.add('notification-color');
        }
      });
  });
</script>

<script>
    function snakeModel(){
      $("#create-user").addClass("shake-model");
            setTimeout(function() { 
                $("#create-user").removeClass("shake-model");
            }, 1000);
        }
  </script>
@endsection
