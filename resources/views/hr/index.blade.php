@extends('../layouts/index')
@section('content')

<?php
  $allow_list = [28,180,179,191];
?>
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
  .subScheduleContent{
    margin-left:3%;
    overflow: auto;
   }
   #user-table_wrapper{
    overflow: auto!important;
   }
  </style>
    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6>Quản lý nhân sự</h6>
            </div>
            <div class="header-content-right" style="display: inline;">
                <h6 class="display-inline">Quản lý nhân sự</h6>
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
        <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> notifition</h6>
      </div>
      <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning</h6>
      </div>
                      </div>
              </div> <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#content1">Quản lý khung nhân sự</a>
      </li> 
      <li class="nav-item margin_center">
          <a id="tab0" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content2">Quản lý nhân viên</a>
      </li>
    </ul>
  <div class="row row-content">
 
  </div>
<div class="tab-content">
 
<div id="content1" class="tab-pane  in active">
          <div class="row row-content">
            <div class="row-title-proxy">
                      <div class="proxy-add" title="New Edge"><button type="button" class=" job-create camera-button" data-toggle="modal" data-target="#DeptAddInfoModal" ><i class="fa fa-plus" aria-hidden="true"></i>Phòng mới  </button></div>
                     
                      <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>
                    
                      </div>
              </div>

                <table id="camera-table" class="nvr-table"> 
                        <thead>
                        <tr class="thead">
                     <!--        <th class="check-all">
                              <input type="checkbox" id="select-all" value="select-all"  name="select-all" onclick="checkAll();" />
                              <label for="select-all" class="display-inline" id="label-all"></label>
                              <label class="display-inline"></label>
                             </th> -->
                            <!-- <th>ID </th> -->
                            <th style="width:50%">Phòng ban</th>
                            <!-- <th style="width:30%">MID</th> -->
                            <th></th>
                          </tr>
                        </thead>
                    </table>
                          @foreach($infos as $info)
           <div  id="Depart{{$info->id}}">
                        
                <table id="camera-table" class="nvr-table" onclick="showDetail1(this,{{$info->id}})"> 
                        <tbody class="tbody">
                            <tr class="color-add">
                              <!-- <td>
                                <input type="checkbox" id="{{$info->id}}" value="{{$info->id}}" name="{{$info->id}}" class="check-box" />
                                <label for="{{$info->id}}" class="add-cam"></label>
                              </td> -->

                       <!--        <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="id{{$info->id}}"> {{$info->id}}</span></a></div>

                              </td> -->
                              <td style="width:50%"><span style="display: none" id="id{{$info->id}}"> {{$info->id}}</span><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="name{{$info->id}}"> {{$info->name}}</span></a>
                                <span id="des{{$info->id}}" style="display: none">{!! $info->des !!}</span>

                                <span id="permiss{{$info->id}}" style="display: none">{{ $info->permiss }}</span>


                              </td>
                            <!--   <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="mid{{$info->id}}"> {{$info->mid}}</span></a></div></td> -->
                              <td><button style="color: white"  type="button" onclick="DeptUpdateInfo('{{$info->id}}')" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/notepad.png"></span></button>   

 <button style="color: white"  type="button" class="btn btn-del Disable">
                             <!-- <a href="/hr/delete-department/{{$info->id}}" > <span class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span></a>    -->
 <span onclick = "removeDepart({{$info->id}})"  class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span>
                                </button>


<button style="color: white"  type="button" onclick="RoleaddUser('{{$info->id}}')" class="btn btn-del Disable">
                             <span class="preview"><img src="/js-css/img/icon/plus.png"></span></i></button>
                            </td>
                            </tr>
                        </tbody>
                      </table>
                      <div style="display:none" id="RoleContent{{$info->id}}" class="subScheduleContent">

                          <?php
                            $uids = DB::table("user_department")->where("department_id",$info->id)->pluck("user_id")->toArray();
                            $users = DB::table("users")->whereIn("id",$uids)->get();
                            if(count($users) < 1){
                                ?>
                                <script>
                                    document.getElementById("roleCheck{{$info->id}}").innerHTML= "Chưa có thành viên"
                                </script>
                                <?php
                            }else{
                          ?>
                           <table id="staff-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th style="width:20%">Tên</th>
                            <th style="width:20%">Email</th>
                            <th style="width:20%">Chứng minh thư</th>
                            <th style="width:20%">Số điện thoại </th>
                              @if($level < 3)
                            <th></th>
                              @endif
                          </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach($users as $staff)
                            <?php
                              if($staff->status == 0){
                                continue;
                              }
                            ?>
                            <tr class="color-add">
                              <td> <a target="_blank" href= "hr/staff-info/{{$staff->id}}" class="preview">{{$staff->name}}</a></td>
                              <td> {{$staff->email}}</td>
                                <td> <span>{{$staff->identify}}</span></td>
                                <td> {{$staff->phone}}</td>
                              @if($level < 3)
                              <td>
                              <!--   <span class="edit-user btn" data-toggle="modal" data-target="#UserEditModal" onclick="EditUser({{$staff->id}},{{$info->id}})"><span class="preview"><img src="/js-css/img/icon/plus.png"></span>

                              </span> -->
                                 <button class="edit-user btn"  ><a href="/hr/remove-department/{{$staff->id}}/{{$info->id}}">

                                  <span class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span></a>

                              </td></button>
                              @endif

                            </tr>
                          @endforeach
                        </tbody>
                      </table>
              <?php 
}
               ?>    
                        </div>      
                      </div>
@endforeach
                    </div>



                    <div id="content2" class="tab-pane fade">

                         <div class="row-title-proxy">
                      <div class="proxy-add" title="New Edge"><button type="button" class=" job-create camera-button" data-toggle="modal" data-target="#UserAddInfoModal" ><i class="fa fa-plus" aria-hidden="true"></i>Thêm nhân viên </button></div>
                     
                      <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>
                    
                      </div>
           
<br><hr>
  <div style="overflow: true;">
                        <table id="user-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Chứng minh thư</th>
                            <th>Số điện thoại </th>
                          
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($staffList as $staff)
                            <tr class="color-add">
                              
                              <td><a target="_blank" href= "hr/staff-info/{{$staff->id}}" class="preview"> {{$staff->name}}</a></td>
                              <td> {{$staff->email}}</td>
                                <td> {{$staff->identify}}</td>
                                <td> {{$staff->phone}}</td>
                        
                               <td>
                                <span class="edit-user btn" data-toggle="modal" data-target="#UserEditModal" onclick="EditUser({{$staff->id}},{{$info->id}})"><span class="preview"><img src="/js-css/img/icon/notepad.png"></span></span>
                                <span onclick = "removeAccount({{$staff->id}})"  class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span>


                                </td>
                                
 

                            </tr>
                          @endforeach
                        </tbody>
                      </table>
  </div>
 
                    </div>
                    </div>

     <div class="modal fade modol-text" id="AddUserRole" role="dialog">
        <form id="action-form" action="hr/add-user-department" method="POST"
         enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" id="create_id" name="id" value="0">
         
          <div  class="modal-dialog model-right" style="min-width: 100%;height: auto">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
        <h5 class="modal-title" style="font-size: 31px;">Thêm nhân sự cho phòng </h5>
                 <button type="button" class="btn-close" data-dismiss="modal" onclick="close_form()" aria-label="Close"></button>

              </div>
              <div class="notification"></div>
              <div class="modal-body modal-config">
                <table class="table-edit table-model" style="font-size: 22px;">
                    <tbody class="table-edit">
                        <tr>
                            <td><i class="fa fa-user" aria-hidden="true"></i> Phòng ban</td>
                            <td>
                                <input type="hidden" name="department" id="UserDepartID" value="">
                                <p id="UserDept"></p>
                            </td>
                        </tr>

                       <!--   <tr>
                            <td><i class="fa fa-user" aria-hidden="true"></i>Chức vụ</td>
                             <td>
                                <input type="hidden" name="role" id="UserRoleID" value="">
                                <p id="UserRole"></p>
                            </td>
                        </tr> -->

</tbody>
                </table>

<h3>Danh sách nhân viên</h3>
                <select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffselect" multiple>
 @foreach($staffList as $staff)
<option value='{{$staff->id}}'>{{$staff->name}}</option>
 @endforeach

</select>

              <div  style="margin-top: 3%;">


                        <div class="form-group">
                 
                    <div >
                        
                  
                    </div>
                <div class="form-group" id="preview">
                </div>
                <div class="form-group" id="preview-file"></div>
                </div>
                

                <button class="btn btn-model" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Tạo</button>
                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>
        </form>
      </div>
      </div>
      </div>
      </div>
      </div>
 <div class="modal fade modol-text" id="DeptEditInfoModal" role="dialog">
          <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 100%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Chỉnh sửa thông tin</label>
              </div>
              <div class="notification"></div>
              <form action="hr/edit-admin-department" method="POST"  enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="DeptEditId">
                  <div class="modal-body">
                    <table class="table-edit table-model" style="font-size:20px">
                        <tbody class="table-edit">
                          <tr>
                                <td style = "width:15%">Tên </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text"  required="" id="DeptEditName"></td>
                           <tr>
                            <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea  name="des" class="ckeditor form-control input-edit modol-text"  required="" id="DeptEditDes"></textarea></td>
                        </tr>

                        @if(in_array(Auth()->user()->id, $allow_list))

                        <tr>
                          <td>Quyền</td>
                          <td>
                            
                              <select name="pid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="permissEditSelected" multiple>
 @foreach($permission as $permis)
<option value='{{$permis->hid}}'>{{$permis->name}}</option>
 @endforeach

</select>

                          </td>
                        </tr>

                        @endif
                            <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoat </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>
 

  <div class="modal fade modol-text" id="RoleEditInfoModal" role="dialog">
          <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 100%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Chỉnh sửa thông tin</label>
              </div>
              <div class="notification"></div>
              <form action="hr/edit-admin-role" method="POST"  enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="RoleEditId">
                  <div class="modal-body">
                    <table class="table-edit table-model" style="font-size:20px">
                        <tbody class="table-edit"> <tr>
                                <td class="cam-properties">Phòng ban </td>
                                <td id="RoleEditDept"></td>
                           <tr>
                          <tr>
                                <td class="cam-properties">Tên vị trí </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text"  required="" id="RoleEditName"></td>
                           <tr>
                            <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea  name="des" class="ckeditor form-control input-edit modol-text"  required="" id="RoleEditDes"></textarea></td>
                        </tr>
                      
                        <tr>
                            <td class="cam-properties">Vị trí </td>
                                <td>
                                    <select name="level" id="RoleEditLevel" class="form-select custom-select" aria-label="Default select example">
  <option value="1">Quản lý</option>
  <option value="3">Nhân viên</option>
</select>
                                </td>

                        </tr>
                            <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoat </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>
        
<div class="modal fade modol-text" id="DeptAddInfoModal" role="dialog">
          <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 100%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm phòng ban</label>
              </div>
              <div class="notification"></div>
              <form action="/hr/add-new-admin-department" method="POST"  enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="DeptEditId">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                          <tr>
                                <td class="cam-properties">Tên </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text"  required="" ></td>
                           <tr>
                            <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea  name="des" class="ckeditor form-control input-edit modol-text"  required="" ></textarea></td>
                        </tr>

                        @if(in_array(Auth()->user()->id, $allow_list))
                        <tr>

                          <td>Quyền</td>
                          <td>
                            
                                            <select name="pid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="permissselect" multiple>
 @foreach($permission as $permis)
<option value='{{$permis->hid}}'>{{$permis->name}}</option>
 @endforeach

</select>

                          </td>
                        </tr>
                        @endif
                            <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm 1 &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>
 

  <div class="modal fade modol-text" id="RoleAddInfoModal" role="dialog">
          <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 100%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm chức vụ</label>
              </div>
              <div class="notification"></div>
              <form action="/hr/add-new-admin-role" method="POST"  enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="DepartID">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit"> <tr>
                                <td class="cam-properties">Phòng ban: </td>
                                <td id="RoleAddDept"></td>
                           <tr>
                          <tr>
                                <td class="cam-properties">Tên vị trí </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text"  required="" ></td>
                           <tr>
                            <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea  name="des" class="ckeditor form-control input-edit modol-text"  required="" ></textarea></td>
                        </tr>
                      
                        <tr>
                            <td class="cam-properties">Vị trí </td>
                                <td>
                                    <select name="level" class="form-select custom-select " aria-label="Default select example">
  <option value="1">Quản lý</option>
  <option value="3">Nhân viên</option>
</select>
                                </td>

                        </tr>
                            <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoat </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>

 <div class="modal fade modol-text" id="UserAddInfoModal" role="dialog">
        <form id="action-form" action="hr/postuserregister" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="modal-dialog model-right" style="min-width: 100%;height: auto">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label><i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 1.2em;"></i>&nbsp; Tạo tài khoản mới</label>
              </div>
              <div class="notification"></div>
              <div class="modal-body modal-config">
                <div class="row">
                  <div class="col-md-6 col-sm-12 col-12">
                <table class="table-edit table-model" style="font-size:20px">
                    <tbody class="table-edit">
                        <tr>
                            <td style = "width: 20%"><i class="fa fa-user" aria-hidden="true"></i> Họ tên </td>
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
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Ngày sinh </td>
                            <td><input type="date" value="" name="birth_date" class="input-edit create-user modol-text" required=""></td>
                        </tr>

                          <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Ngày vào công ty </td>
                            <td><input type="date" value="" name="begin_date" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                      

                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
              </div>
              <div class="col-md-6 col-sm-12 col-12">
                <table class="table-edit table-model" style="font-size:20px">
                    <tbody class="table-edit">
                       
                        <tr>
                            <td style="width:20%"><i class="fa fa-credit-card" aria-hidden="true"></i> Số căn cước</td>
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
                            <td><i class="fa fa-card" aria-hidden="true"></i>Tài khoản ngân hàng </td>
                            <td><input type="" value="" name="bank" class="input-edit create-user modol-text" required=""></td>
                        </tr> 
                        <tr>
                            <td><i class="fa fa-card" aria-hidden="true"></i> Tên ngân hàng </td>
                            <td><input type="" value="" name="bank_name" class="input-edit create-user modol-text" required=""></td>
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
      <div class="modal fade modol-text" id="UserEditModal" role="dialog">
        <form id="action-edit" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="modal-dialog model-right" style="min-width: 100%;height: auto">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label><i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 1.2em;"></i>&nbsp; Thông tin tài khoản</label>
              </div>
              <div class="notification"></div>
              <div class="modal-body modal-config">
                <div class="row">
                  <div class="col-md-6 col-sm-12 col-12">
                <table class="table-edit table-model" style="font-size:20px">
                    <tbody class="table-edit">
                        <tr>
                            <td style="width: 25%"><i class="fa fa-user" aria-hidden="true"></i> Họ tên </td>
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
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Ngày sinh </td>
                            <td><input id="birth_date" type="date" value="" name="birth_date" class="input-edit create-user modol-text" required=""></td>
                        </tr>

                          <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Ngày vào công ty </td>
                            <td><input id="begin_date" type="date" value="" name="begin_date" class="input-edit create-user modol-text" required=""></td>
                        </tr>



                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
              </div>
              <div class="col-md-6 col-sm-12 col-12">
                <table class="table-edit table-model" style="font-size:20px">
                    <tbody class="table-edit">
                       
                        <tr>
                            <td style="width: 15%"><i class="fa fa-credit-card" aria-hidden="true"></i> Số căn cước</td>
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
                            <td><i class="fa fa-card" aria-hidden="true"></i> Tài khoản ngân hàng </td>
                            <td><input id="bank" type="" value="" name="bank" class="input-edit create-user modol-text" required=""></td>
                        </tr>

                          <tr>
                            <td><i class="fa fa-card" aria-hidden="true"></i> Sô tài khoản </td>
                            <td><input id="bank_name" type="" value="" name="bank_name" class="input-edit create-user modol-text" required=""></td>
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
      
      </div> <div class="proxy-add" title="Delete"><button type="button" class="camera-button" id="device-remove"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button><button style="display: none;" id="submit-action" type="submit"></button></div>
<script src="/js-css/js/bootstrap-select.min.js"></script>


<script src="js-css/datatables/jquery.dataTables.js"></script>
<script src="js-css/datatables/dataTables.bootstrap4.js"></script>
<script type="text/javascript">
  $(document).on("click", ".browse", function() {
          console.log($(this))
          var file = $(this)
            .parent()
            .parent()
            .parent()
            .find(".file");
          file.trigger("click");
        });
        $('input[type="file"]').change(function(e) {
            
          var html = ""
            for (var i = 0; i < e.target.files.length;i++){
          var fileName = e.target.files[i].name;
          console.log(fileName)
          // $("#file").val(fileName);
        if (fileName.includes(".png") || fileName.includes(".jpg") || fileName.includes(".jepg")){
          var reader = new FileReader();
          var myElement =  $(this).parent()
            .find("#preview-file")
          reader.onload = function(e) {
            // get loaded data and render thumbnail.
          html  = html + '<img style="width: 200px;margin-left: 3%;" src="'+e.target.result+'" id="preview" class="preview">';
             console.log(myElement.html())
           myElement.html( myElement.html()+html);
          console.log(myElement.html())

          };
       
          reader.readAsDataURL(this.files[i]);
      }else{
            // get loaded data and render thumbnail.
        console.log(fileName)
          html  = html + '<p><img width="25" height = "25" src="/js-css/img/icon/write.png">' + fileName+ "<p>"; 
            $(this)
            .parent()
            .find("#preview-file").html( $(this).parent().find("#preview-file").html()+html);
          
  }
 


          // read the image file as a data URL.
                }
              
        });


    $(document).ready(function() {

       $('#user-table').DataTable({
                    "order": [[ 0, "desc" ]]
                })

        var department_flag = getCookie("department_flag");
        var role_flag = getCookie("role_flag");
        console.log("begin")

        if(department_flag > 0){
            document.getElementById("RoleContent"+department_flag).style.display = "block";
            document.getElementById("UserContent"+role_flag).style.display = "block";
            
            var top = document.getElementById("UserContent"+role_flag).offsetTop;
            console.log(top)
            window.scrollTo(0, top);
        }
        else if(department_flag > 0){
            document.getElementById("RoleContent"+department_flag).style.display = "block";
            var top = document.getElementById("RoleContent"+department_flag).offsetTop;
            console.log(top)
            window.scrollTo(0, top);
        }



        if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }

        $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');

        $("#"+this.href.split("#")[1]).addClass('active');
        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });

    
  });

      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }
</script>

<script type="text/javascript">
  $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });
  
  $("#search-input").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#camera-table tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });

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
          var remove = document.getElementById('device-remove');
          remove.addEventListener('click', function(e){
              swal({
                  title: "",
                  text: " Bạn có muốn xóa quy trình không? ",
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
                    document.getElementById("remove-credential").click();
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
  function removeAccount(id) {
    console.log("Okoekqr");
              swal({
                  title: "",
                  text: " Bạn có muốn xóa tài khoản không? ",
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
                    location.href  = "/hr/remove-account/"+id
                    swal.close();
                  }
                  else {
                    swal.close();
                  }
                });
           }


        function removeDepart(id) {
              swal({
                  title: "",
                  text: " Bạn có muốn xóa phòng không? ",
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
                    location.href  = "/hr/delete-department/"+id
                    swal.close();
                  }
                  else {
                    swal.close();
                  }
                });
           }
</script>

</script>



<script src="/js-css/js/bootstrap-select.min.js"></script>
<script src="/js-css/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  function 
  loadInfo(id){
     $.ajax({
      type: "GET",
      url: '/consumer-info/'+id,
      success: function (response) {

          $("#consumerInfo").empty();
          document.getElementById("ConsumerName").innerHTML = document.getElementById("cname"+id).innerHTML
          document.getElementById("ConsumerPhone").innerHTML = document.getElementById("cphone"+id).innerHTML
          var table = document.getElementById("consumerInfo"); 
        console.log("process list")
        response = (JSON.parse(response))

        for (var i = 0;i < response.length;i++){
            var row = table.insertRow();
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          cell1.innerHTML = response[i].name
          cell2.innerHTML = '<a href="/sale/view/'+response[i].id+'"> '+response[i].status+'</a>'
          
        }
        $("#ConsumerInfoModal").modal()
      }

    });
}


 function getStaffList(id){

  console.log('/system/shedule-staff/'+id)
  $.ajax({
    type: "GET",
    url: '/system/shedule-staff/'+id,
    success: function (response) {
      res = (JSON.parse(response))
      response = res[0]
      
      dept = res[1]
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


      html = ''
      for(var i =0; i < response.length; i++){
          html = html +'<option  value="'+response[i].id+'">'+response[i].name+ "-"+response[i].rname + "(" +  response[i].dname + ")" +'</option>'
      }
      document.getElementById("staffselect").innerHTML=html;

      console.log(document.getElementById("staffselect").innerHTML)
      $("#staffselect").selectpicker("refresh");
$('#staffselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});

html = ''

console.log(dept)
      for(var i =0; i < dept.length; i++){
        console.log("why not here")
          html = html +'<option  value="'+dept[i].id+'">'+dept[i].name+'</option>'
      }
      document.getElementById("departselect").innerHTML=html;

      $("#departselect").selectpicker("refresh");
$('#departselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});



    }
  });
}


 function getStaffSelectedList(id,sid){
  $.ajax({
    type: "GET",
    url: '/schedule/staff-select/'+id+"/"+sid,
    success: function (response) {
      response = (JSON.parse(response))
      console.log(response)
      var data = response[0]
      var sel = response[1]
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


     var  html = '<select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffEditSelected" multiple>'
      for(var i =0; i < data.length; i++){
          if (sel.includes(data[i].id)){
          html = html +'<option  value="'+data[i].id+'" selected>'+data[i].name+ "-"+data[i].rname + "(" +  data[i].dname + ")" +'</option>'
          }else{
          html = html +'<option  value="'+data[i].id+'">'+data[i].name+ "-"+data[i].rname + "(" +  data[i].dname + ")" +'</option>'

          }
      }
     hhtml = html + '</select>'
      // console.log(html)
      // document.getElementsByClassName("filter-option-inner-inner")[1].innerHTML = ""
      document.getElementById("staffEditDiv").innerHTML=html;
$('#staffEditSelected').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
    }
  });
}


 function getDeptSelectedList(id,sid){
  $.ajax({
    type: "GET",
    url: '/schedule/dept-select/id/'+sid,
    success: function (response) {
      response = (JSON.parse(response))
      console.log(response)
      var data = response[0]
      var sel = response[1]
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


     var  html = '<select name="did[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="deptEditSelected" multiple>'
      for(var i =0; i < data.length; i++){
          if (sel.includes(data[i].id)){
          html = html +'<option  value="'+data[i].id+'" selected>'+data[i].name+'</option>'
          }else{
          html = html +'<option  value="'+data[i].id+'">'+data[i].name+'</option>'

          }
      }
     hhtml = html + '</select>'
      // console.log(html)
      // document.getElementsByClassName("filter-option-inner-inner")[1].innerHTML = ""
      document.getElementById("deptEditDiv").innerHTML=html;
$('#deptEditSelected').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
    }
  });
}
 $(".job-create").click(function(){
    console.log("okoe123123")
    var jobid = this.id; 
    $("#create_id").val(jobid);
    // var lastID = document.getElementById("lastId"+jobid).innerHTML;
    // getStaffList(jobid)
    // getDeptSelectedList(lastID,jobid)

  });


   $(".job-update").click(function(){
    console.log("okoe")
    var jobid = this.id;
    $("#edit_id").val(jobid);
    var name = document.getElementById("title"+jobid).innerHTML
    $("#edit_name").val(name);
    var des = document.getElementById("content"+jobid).innerHTML
    // $("#EditDes").val(des);

          CKEDITOR.instances.EditDes.setData( document.getElementById("content"+jobid).innerHTML, function()
{
    this.checkDirty();  // true
});  
    // var names = document.getElementById("jnames"+jobid).innerHTML
    // $("#job_user_detail").val(names);
    var jstartdate = document.getElementById("sdate"+jobid).innerHTML
    console.log(jstartdate)
    document.getElementById("edit_start_date").value =jstartdate;

    var jenddate = document.getElementById("edate"+jobid).innerHTML
    $("#edit_end_date").val(jenddate);
    var lastID = document.getElementById("lastId"+jobid).innerHTML;

    getStaffSelectedList(lastID,jobid)
    getDeptSelectedList(lastID,jobid)

  })

      $('#permissselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});

</script>
<script type="text/javascript">
    function getSubScheduleList(id){
  $.ajax({
    type: "GET",
    url: 'schedule/get-subshedule-as-json/'+id,
    success: function (response) {
      res = (JSON.parse(response))
      response = res[0]
      dept_list = res[1]
      name_list = res[2]
      fix_list = res[3]
      percent_list = res[4]
      seen = res[5]
      console.log(response);
      for(i=0;i<response.length;i++) {
        var html = ' <div style="margin-left:3%"  id="root'+response[i].id+'"> <table class="root_table" onclick="ToggleTable(this)"><tbody class="tbody">'

        // html = html + '<tr class="color-add"><td>  <input type="checkbox" id="'+response[i].id+'" value="'+response[i].id+'" name="'+response[i].id+'" class="check-box" />  <label for="'+response[i].id+'" class="add-cam"></label></td>'
 if(seen[i] <1){
            html = html + ' <tr class="color-add" style="background-color:cadetblue">'
        }else{
          html = html + '<tr class="color-add">'
        }
        html = html + '<td style="width:25%"><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;">  </i>Tên công việc:<span id="title'+response[i].id+'+"> '+response[i].title+'</span></a><br>  Ngày bắt đầu:   <span id="sdate'+response[i].id+'">'+response[i].start_date+'</span><br>  Ngày kết thúc:   <span id="edate'+response[i].id+'">'+response[i].end_date+'</span><span id="lastId'+response[i].id+'" style="display: none">'+response[i].last_id+'</span></td>'


        // html = html +'<td id="content'+response[i].id+'">'+response[i].content+'</td>'


if (dept_list[i] == "false"){
  var dept = dept_list[i] 
}else{

  var dept = "Không"
}
   if (name_list[i] == "false"){
  var myname = name_list[i] 
}else{

  var myname = "Không"
}
         html = html +'<td style="width:25%">Phòng thực hiện: '+dept+'<br>Người phụ trách: '+myname+'</td>'


        remain = 100 - percent_list[i]
        html = html +'<td style="width:30%"><span class="progress"><span class="progress-bar bg-success" style="width:'+percent_list[i]+'%";>  Hoàn thành: '+percent_list[i]+'%</span><span class="progress-bar bg-danger" style="width:'+remain+'%"></span></span></td>'

        html = html + "<td>"

        html = html + fix_list[i]

        // html = html + '<a style="color: white"  type="button" href="schedule-list/'+response[i].id+'" class="btn btn-del Disable"><i class="fa fa-list" aria-hidden="true" style="font-size: 1.2rem;"></i></a><a style="color: white"  type="button" href="schedule/file/'+response[i].id+'" class="btn btn-del Disable"><i class="fa fa-folder-open-o" aria-hidden="true" style="font-size: 1.2rem;"></i></a>'
        html = html + "<td>"


        html = html + "</td>"
        html = html +'</tr></tbody></table><div style="display:none" id="subScheduleContent'+response[i].id+'" class="subScheduleContent">'
        // console.log(html)
        document.getElementById("subScheduleContent"+id).innerHTML = 
document.getElementById("subScheduleContent"+id).innerHTML + html

        getSubScheduleList(response[i].id)

      }

    }
  });
}
  // $(".root_table").on("click", function(e) {
  //     e.preventDefault();
  //     console.log("okoek")
  //     $(this).next("div").slideToggle();
  //   });

function ToggleTable(elmt){
      $(elmt).next("div").slideToggle();
}

function DeptUpdateInfo(id){
          document.getElementById("DeptEditId").value = id
          document.getElementById("DeptEditName").value = document.getElementById("name"+id).innerHTML
          // document.getElementById("EditMid").value = document.getElementById("mid"+id).innerHTML
 var des = document.getElementById("des"+id).innerHTML
    // $("#EditDes").val(des);

          CKEDITOR.instances.DeptEditDes.setData( document.getElementById("des"+id).innerHTML, function()
{
    this.checkDirty();  // true
});  


$('#permissEditSelected option').attr("selected",false);
  var mygroup =document.getElementById("permiss"+id).innerHTML;
  mygroup = mygroup.split(",");
  for(var i =0; i< mygroup.length;i++){
    $('#permissEditSelected option[value='+parseInt(mygroup[i])+']').attr('selected','selected');
  }

$('#permissEditSelected').selectpicker('refresh');


        $("#DeptEditInfoModal").modal()
  

}

function RoleUpdateInfo(id){
          document.getElementById("RoleEditId").value = id
          document.getElementById("RoleEditDept").innerHTML = document.getElementById("roledept"+id).innerHTML
          document.getElementById("RoleEditName").value = document.getElementById("rolename"+id).innerHTML

          var level =  document.getElementById("rolelevel"+id).innerHTML
// $('#RoleEditLevel').val(level)
;document.querySelector('#RoleEditLevel').value = level
          // document.getElementById("EditMid").value = document.getElementById("mid"+id).innerHTML
 // var des = document.getElementById("des"+id).innerHTML
    // $("#EditDes").val(des);

          CKEDITOR.instances.RoleEditDes.setData( document.getElementById("roledes"+id).innerHTML, function()
{
    this.checkDirty();  // true
});  
        $("#RoleEditInfoModal").modal()
  

}
function DeptAddRole(id){
          document.getElementById("DepartID").value = id
          document.getElementById("RoleAddDept").innerHTML = document.getElementById("name"+id).innerHTML
        $("#RoleAddInfoModal").modal()

}

function RoleaddUser(did){
     document.getElementById("UserDepartID").value = did
     // document.getElementById("UserRoleID").value = rid
      document.getElementById("UserDept").innerHTML = document.getElementById("name"+did).innerHTML
      // document.getElementById("UserRole").innerHTML = document.getElementById("rolename"+rid).innerHTML

      $('#staffselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});

    $("#AddUserRole").modal()
}

</script>

<script>
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




  function EditUser(id,did ){
    var userid = id;
    console.log(userid);
    $.ajax({
      url: 'getuseredit/'+userid,
      success: function(data) {

        $("#EditDepartment").val(did);

        data = data[1]

        // LoadEditRole(data.role_id)
        console.log(data.role_id);  
        $("#full_name").val(data.name);
        $("#email").val(data.email);
        $("#phone_number").val(data.phone);
        $("#identify").val(data.identify);
        $("#iden_location").val(data.iden_location);
        $("#bank").val(data.bank);
        $("#bank_name").val(data.bank_name);
        $("#iden_date").val(data.iden_date);
        $("#tax").val(data.tax_code);
        $("#birth_date").val(data.birth_date);
        $("#begin_date").val(data.begin_date);
        $("#action-edit").attr('action', '/postuseredit/'+userid);      
      }
    });
  }



function setCookie(cname, cvalue, mytime) {
  const d = new Date();
  d.setTime(d.getTime() + (mytime));
  let expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function showDetail1(element, id){
    ToggleTable(element)
    setCookie("department_flag",id,3600*60)
    console.log(getCookie("department_flag"))

}

function showDetail2(element, id){
    ToggleTable(element)
    setCookie("role_flag",id,3600*60)

}



</script>

@endsection