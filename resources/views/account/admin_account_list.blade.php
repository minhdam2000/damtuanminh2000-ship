@extends('layouts.index')
@section('content')
	<div class="content-camera">
		<div class="header-content">
			<div class="header-content-left">
				<h6>Quản trị người dùng</h6>
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
        
        <div class="tab-list">
          <div class="title-list-user">
            <i class="fa fa-list" aria-hidden="true"></i> &nbsp;Danh sách người dùng
          </div>
          <a>
            <div class="account-add"><button class="btn-add-account" data-toggle="modal" data-target="#create-user"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp; Tạo mới</button></div>
          </a>
          <div class="clearfix"></div>
        </div>
        <div class="tab-content1">
          <div class="row-content-nvr active-view" id="menu1">
			     <form action="removeadmin" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="scroll-auto">
                    <table id="example" class="nvr-table">
                      <thead>
                      <tr class="thead">
                          <th class="check-all">
                            <input type="checkbox" id="select-all" value=""  name="select-all" onclick="checkAll();" />
                						<label for="select-all" class="display-inline" id="label-all"></label>
                						<label class="display-inline"> </label>
      					           </th>
                          <th><center><i class="fa fa-clipboard" aria-hidden="true"></i></center></th>
                          <th><center>Trạng thái</center></th>
                          <th>Họ tên </th>
                          <th>Email</th>
                          <th>Trạng thái</th>
                          <th>Chi tiết</th>
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
                                <div class="dropdown">
                                  <i class="fa fa-user" aria-hidden="true" title="Admin"></i>
                                </div>
                              </center>
                            </td>
  	                        <td><center><i class="fa fa-star text-warning"></i></center></td>
                            <td>{{$user->name}}</td>
  	                        <td><i class="fa fa-envelope-o" aria-hidden="true"></i> {{$user->email}}</td>

                            @if($user->status == 0)
                            <td>Đã bỏ</td>
                            @else

                            <td>Kích hoạt</td>
                            @endif
                            <td>
                              <span class="edit-user btn" data-toggle="modal" data-target="#edit-user" id="{{$user->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                              <a href="hr/staff-info/{{$user->id}}" class="preview" type="button"><img src="/js-css/img/icon/write.png"></a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table -->
                  <div style="display: flex; padding: 10px;">
                  	<button style="display: none;" id="remove-admin" type="submit"></button>
                    <span class="btn-button btn-update" style="margin: auto; width: 100%; cursor: pointer;" id="adminRemove"><i class="fa fa-trash-o" aria-hidden="true"></i> &nbsp;Xóa tài khoản </span>
              	  </div>
              </form>
          </div>
        </div>
    </div>
	<!-- end model --->
  <!-- Modal -->
   <div class="modal fade modol-text" id="create-user" role="dialog">
        <form id="action-form" action="/hr/postuserregister" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="modal-dialog model-right" style="min-width: 70%;height: auto">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label><i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 1.2em;"></i>&nbsp; Tạo tài khoản mới</label>
              </div>
              <div class="notification"></div>
              <div class="modal-body modal-config">
                <div class="row">
                  <div class="col-md-6 col-sm-12 col-12">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                        <tr>
                            <td><i class="fa fa-user" aria-hidden="true"></i> Họ tên </td>
                            <td><input type="" value="" name="name" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        
                        <tr>
                            <td><i class="fa fa-envelope" aria-hidden="true"></i> Địa chỉ email</td>
                            <td><input type="email" value="" name="email" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-phone" aria-hidden="true"></i> Điện thoại</td>
                            <td><input type="" value="" name="phone_number" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-key" aria-hidden="true"></i> Mật khẩu </td>
                            <td><input type="password" value="" name="password" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-key" aria-hidden="true"></i> Xác nhận </td>
                            <td><input type="password" value="" name="password_confirmation" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-user" aria-hidden="true"></i> Khối</td>
                            <td>
                              <select onchange="LoadNewRole()" class="custom-select select-profile  browser-default" name="department" id="NewDepartment" >
                                  @foreach($department as $department)
                                      <option value="{{$department->id}}">{{$department->name}}</option>
                                      @endforeach
                            
                              </select>
                            </td>
                        </tr>

                         <tr>
                            <td><i class="fa fa-user" aria-hidden="true"></i> Vai trò</td>
                            <td>
                              <select class="custom-select select-profile  browser-default" name="role" id="newRole">
                               @foreach($roles as $role)
                                      <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach

                              </select>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
              </div>
              <div class="col-md-6 col-sm-12 col-12">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                       
                        <tr>
                            <td><i class="fa fa-credit-card" aria-hidden="true"></i> Số căn cước</td>
                            <td><input type="" value="" name="identify" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Ngày đăng kí</td>
                            <td><input type="date" value="" name="iden_date" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-home" aria-hidden="true"></i> Nơi cấp </td>
                            <td><input type="" value="" name="iden_location" class="input-edit create-user modol-text" required=""></td>
                        </tr>

                          <tr>
                            <td><i class="fa fa-card" aria-hidden="true"></i> Mã số thuế </td>
                            <td><input type="" value="" name="tax_code" class="input-edit create-user modol-text" required=""></td>
                        </tr>


                          <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Ngày sinh </td>
                            <td><input type="date" value="" name="birth_date" class="input-edit create-user modol-text" required=""></td>
                        </tr>

                          <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Ngày vào công ty </td>
                            <td><input type="date" value="" name="begin_date" class="input-edit create-user modol-text" required=""></td>
                        </tr>

                       
                    </tbody>
                </table>
              </div>
              </div></div>
              <div class="modal-footer" style="position: initial">
                <button class="btn btn-model" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Tạo</button>
                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>
            </div>
          </div>
        </form>
      </div>

      <!-- Modal edit-->
      <div class="modal fade modol-text" id="edit-user" role="dialog">
        <form id="action-edit" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="modal-dialog model-right" style="min-width: 70%;height: auto">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label><i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 1.2em;"></i>&nbsp; Thông tin tài khoản</label>
              </div>
              <div class="notification"></div>
              <div class="modal-body modal-config">
                <div class="row">
                  <div class="col-md-6 col-sm-12 col-12">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                        <tr>
                            <td><i class="fa fa-user" aria-hidden="true"></i> Họ tên </td>
                            <td><input id="full_name" type="" value="" name="full_name" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        
                        <tr>
                            <td><i class="fa fa-envelope" aria-hidden="true"></i> Địa chỉ email</td>
                            <td><input id="email" type="email" value="" name="email" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-phone" aria-hidden="true"></i> Điện thoại</td>
                            <td><input id="phone_number" type="" value="" name="phone_number" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-key" aria-hidden="true"></i> Mật khẩu </td>
                            <td><input type="password" value="" name="password" class="input-edit create-user modol-text"></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-key" aria-hidden="true"></i> Xác nhận </td>
                            <td><input type="password" value="" name="password_confirmation" class="input-edit create-user modol-text" ></td>
                        </tr>
                          <tr>
                            <td><i class="fa fa-user" aria-hidden="true"></i> Khối</td>
                            <td>
                              <select onchange="LoadEditRole()" class="custom-select select-profile  browser-default" name="department" id="EditDepartment" >
                                 
                              </select>
                            </td>
                        </tr>

                         <tr>
                            <td><i class="fa fa-user" aria-hidden="true"></i> Vai trò</td>
                            <td>
                              <select class="custom-select select-profile  browser-default" name="role" id="EditRole">
                              

                              </select>
                            </td>
                        </tr>


                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
              </div>
              <div class="col-md-6 col-sm-12 col-12">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                       
                        <tr>
                            <td><i class="fa fa-credit-card" aria-hidden="true"></i> Số căn cước</td>
                            <td><input id="identify" type="" value="" name="identify" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Ngày đăng kí</td>
                            <td><input id="iden_date" type="date" value="" name="iden_date" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-home" aria-hidden="true"></i> Nơi cấp </td>
                            <td><input id="iden_location" type="" value="" name="iden_location" class="input-edit create-user modol-text" required=""></td>
                        </tr>

                          <tr>
                            <td><i class="fa fa-card" aria-hidden="true"></i> Mã số thuế </td>
                            <td><input id="tax" type="" value="" name="tax_code" class="input-edit create-user modol-text" required=""></td>
                        </tr>


                          <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Ngày sinh </td>
                            <td><input id="birth_date" type="date" value="" name="birth_date" class="input-edit create-user modol-text" required=""></td>
                        </tr>

                          <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Ngày vào công ty </td>
                            <td><input id="begin_date" type="date" value="" name="begin_date" class="input-edit create-user modol-text" required=""></td>
                        </tr>

                       
                    </tbody>
                </table>
              </div>
              <div class="modal-footer" style="position: initial">
                <button class="btn btn-model" type="submit"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Cập nhật </button>
                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>
            </div>
          </div>
        </form>
      
      </div>

      <!-- Modal location access-->
      <div id="location" class="modal fade" role="dialog">
        <div class="modal-dialog" style="max-width: 900px;">

          <!-- Modal content-->
          <div class="modal-content" >
            <div class="modal-header">
              <label><i class="fa fa-clock-o" aria-hidden="true" style="font-size: 1.2em;"></i>&nbsp;&nbsp;Access History</label>
            </div>
            <div class="modal-body" id="mylocation" style=" overflow: auto;">

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
  
<script>
  
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
          var remove = document.getElementById('adminRemove');
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
                    document.getElementById("remove-admin").click();
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
    console.log(userid);
    $.ajax({
      url: 'getuseredit/'+userid,
      success: function(data) {

        document.getElementById("EditDepartment").innerHTML= document.getElementById("NewDepartment").innerHTML;
        var departmentID = data[0]
        // console.log(departmentID)


        $("#EditDepartment").val(departmentID);

        data = data[1]

        LoadEditRole(data.role_id)
        console.log(data.role_id);  
        $("#full_name").val(data.name);
        $("#email").val(data.email);
        $("#phone_number").val(data.phone);
        $("#identify").val(data.identify);
        $("#iden_location").val(data.iden_location);
        $("#iden_date").val(data.iden_date);
        $("#tax").val(data.tax_code);
        $("#birth_date").val(data.birth_date);
        $("#begin_date").val(data.begin_date);
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
  function LoadNewRole(){
    var index = document.getElementById("NewDepartment").value;
    $.ajax({
      url: 'listrole/'+index,
      success: function(data) {
           var html = ""
           for(var i = 0; i < data.length;i++){
            html = html +"<option value='"+data[i].id+"'>"+data[i].name+"</option>"
           }
           document.getElementById("newRole").innerHTML = html;
      }
    });
  }
 function LoadEditRole(roleID){
    if(roleID < 0){
roleID = roleID * -1
    }
    var index = document.getElementById("EditDepartment").value;
    $.ajax({
      url: 'listrole/'+index,
      success: function(data) {
           var html = ""
           for(var i = 0; i < data.length;i++){
            html = html +"<option value='"+data[i].id+"'>"+data[i].name+"</option>"
           }
           document.getElementById("EditRole").innerHTML = html;
            $("#EditRole").val(roleID);
      }
    });
  }

        

  </script>
  <script src="js-css/datatables/jquery.dataTables.js"></script>
<script src="js-css/datatables/dataTables.bootstrap4.js"></script>
<script type="text/javascript">
  
  $('#example').DataTable({
                    "order": [[ 0, "desc" ]]
                })


</script>

@endsection
