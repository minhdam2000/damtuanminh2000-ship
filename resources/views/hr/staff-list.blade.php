@extends('../layouts/index')
@section('content')
    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6>Danh sách nhân viên</h6>
            </div>
            <div class="header-content-right" style="display: inline;">
         
                
               
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

      <li class="nav-item margin_center">
          <a id="tab0" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content2">Nhân viên hệ thống</a>
      </li>
     
    </ul> </div> 
<div class="tab-content">

<div id="content2" class="tab-pane active">

                  <table id="user-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Tên</th>
                            <th>Email</th>
                            <th>phòng</th>
                            <th>Chứng minh thư</th>
                            <th>Số điện thoại </th>
                          
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($users as $staff)
                            <tr class="color-add">
                              
                              <td> {{$staff->name}}</td>
                              <td> <a href="mailto:{{$staff->phone}}"> {{$staff->email}}</a></td>
                                <td> {{$staff->dname}}</td>
                                <td> {{$staff->identify}}</td>
                                <td><a href="tel:{{$staff->phone}}"> {{$staff->phone}}</a></td>
                                  
                          @endforeach
                        </tbody>
                      </table>
          </div>


</div>

    </div>
  <div class="modal fade modol-text" id="create-user" role="dialog">
        <form id="action-form" action="postuserregister" method="POST">
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

<script src="js-css/datatables/jquery.dataTables.js"></script>
<script src="js-css/datatables/dataTables.bootstrap4.js"></script>
<script type="text/javascript">
     $('#staff-table').DataTable({
                    "order": [[ 0, "desc" ]]
                })

        $('#user-table').DataTable({
                    "order": [[ 0, "desc" ]]
                })
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

</script>


@endsection
