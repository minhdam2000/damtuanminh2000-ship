@extends('layouts.index')
@section('content')
<style type="text/css">
  .avatar {
    text-align: center;
    border-radius: 100%;
    overflow: hidden;
    background-color: rgb(238, 238, 238);
    background-image: url(style.css);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
}


</style>
<style type="text/css">
  
.bootstrap-select{
  z-index: 100
}
  
  .badge {
  border-radius: 50%;
  background-color: red;
  color: white;
}
</style>

  <div class="content-camera">
    <div class="header-content">
      <div class="header-content-left">
        <h6>Quản trị công việc </h6>
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
            <i class="fa fa-list" aria-hidden="true"></i> &nbsp;Danh sách công việc {{$dept->name}}
          </div>
          <a>
             @if ($level <3)
            <div class="account-add"><button class="btn-add-account" data-toggle="modal" data-target="#create-user"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp; Tạo mới</button></div>
            @endif
          </a>
          <div class="clearfix"></div>
        </div>
         <ul class="nav nav-tabs" id="tabs" role="tablist">
            <li class="nav-item margin_center">
                <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#content0"> Tổng quan</a>
            </li>
            <li class="nav-item margin_center">
                <a id="tab1" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content1"> Việc đang thực hiện
                 @if($job_all_count > 0)
                     <span class="badge">{{$job_all_count}}</span>
                    @endif

                     </a>
                 

            </li>
            <li class="nav-item margin_center">
                <a id="tab2" class="nav-link color-a" 
                data-toggle="tab" role="tab" href="#content2">Việc hoàn thành

                 @if($job_success_count > 0)
                     <span class="badge">{{$job_success_count}}</span>
                    @endif
                  </a>
            </li>
           <li class="nav-item margin_center">
                <a id="tab3" class="nav-link color-a" 
                data-toggle="tab" role="tab" href="#content3">Việc không hoàn thành

                 @if($job_fail_count > 0)
                     <span class="badge">{{$job_fail_count}}</span>
                    @endif
                  </a>
            </li>
           <li class="nav-item margin_center">
                <a id="tab5" class="nav-link color-a" 
                data-toggle="tab" role="tab" href="#content4">Việc đã tạm dừng

                 @if($job_stop_count > 0)
                     <span class="badge">{{$job_stop_count}}</span>
                    @endif
                  </a>
            </li>
          
          </ul> 

        <div class="tab-content">
          @if($level < 3)
          <div id="content0" class="tab-pane  in active">
<br><hr><br>
              <div class="row">
<div   id="barCon"   class="col-md-6 col-sm-12 col-12">

    <canvas   id="barChart"></canvas>
 </div>
 <div class="col-md-6 col-sm-12 col-12">
               <table id="input-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                         
                            <th> Nhân viên</th>
                            <th> Chức vụ</th>
                            <th> Số việc đang làm</th>
                            <th> Tổng số lượng</th>
                            <th> Số lượng hoàn thành  </th>
                            <th> Số lượng không hoàn thành </th>
                            <th> Số lượng quá hạn</th>
                            <th> Tỷ lệ hoàn thành</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($job_users as $job)
                             <tr>
                               <td>
                                <div class="avatar av-s header-avatar" style="float: left;margin: -5px 10px; background-image: url({{$job->avatar}});">
                    </div>
                                 {{$job->name}}

                               </td>
                               <td>{{$job->rname}}</td>
                               <td>
                                 {{$job->s0}}
                               </td>

                               <td>
                                 {{$job->s1}}
                               </td>

                               <td>
                                 {{$job->s2}}
                               </td>

                               <td>
                                 {{$job->s3}}
                               </td>

                               <td>
                                 {{$job->s4}}
                               </td>
                                 <td>
                                @if($job->s0 +$job->s1 + $job->s2 +$job->s3 > 0)
                                {{floatval($job->s2)/($job->s0 +$job->s1 + $job->s2 +$job->s3)*100 }}
                                @else
                                0
                                @endif
                                 %
                                </td>
                          <td>
                               <span class="preview" onclick="Bars(1, '{{$job->user_id}}')"><img src="/js-css/img/icon/eye.png"></span>
                            
                          </td>

                             </tr>
                             @endforeach
                        </tbody>
                      </table>
</div>
            </div>
        </div>
        @endif
          <div id="content1" class="tab-pane  fade">
           <form action="removeadmin" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="scroll-auto">
                    <table id="example" class="nvr-table">
                      <thead>
                      <tr class="thead">
                          <th><center>Trạng thái</center></th>
                          <th>Tên việc  </th>
                          <th>Người giao</th>
                              @if ($level <3)
                          <th>Người phụ trách</th>
                          @endif
                          <th>Bắt đầu </th>
                          <th>Kết thúc</th>
                          <th>Chi tiết</th>
                        </tr>
                      </thead>
                      <tbody class="tbody">
                        @foreach($job_all as $job)

                          @if($job->seen < 1)
                            <tr style="background-color: dodgerblue;">
                          @else
                          <tr>
                          @endif
                          @if ($job->status == 0)
                            <td><center><i class="fa fa-star text-warning"></i></center></td>
                          @elseif ($job->status == 1)
                            <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/success.png"></td>

                          @elseif ($job->status == 2)
                            <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/close.png"></td>
                         @else 
                                  
                            <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/stop.png"></td>
                            @endif
                           
                            <td>  <a class="preview" href="job-detail/{{$job->id}}"> <span id="jname{{$job->id}}">{{$job->name}}</span></a></td> <td>
                              <?php
                                $uif = DB::table("users")->where("id",$job->user_id)->first();
                              ?>
                              <span id="juname{{$job->id}}"><?=$uif->name?></span>
                              <span style="display: none" id="juemail{{$job->id}}"><?=$uif->email?></span>
                              <span style="display: none" id="juphone{{$job->id}}"><?=$uif->phone?></span>

                            </td>

                              @if ($level <3)
                            <td id="jnames{{$job->id}}">{{$job->names}}</td>
                            @endif
                            <td id="jstartdate{{$job->id}}">{{$job->start_date}}</td>
                            <td id="jenddate{{$job->id}}">{{$job->end_date}}</td>
                           <td>
                              <span style="display:none" id="jdes{{$job->id}}" >{!! $job->des !!}</span>
                              @if ($job->status == 0)
                                 <a class="preview" href="job-detail/{{$job->id}}"><img src="/js-css/img/icon/notepad.png"></a>
                              @if ($level <3)
                            <span class="job-update preview" data-toggle="modal" data-target="#edit-job-modal" id="{{$job->id}}"><img src="/js-css/img/icon/write.png"></span>
                            @endif
                            @endif

                             </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </form>
        </div>

         <div id="content2" class="tab-pane fade">
           <form action="removeadmin" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="scroll-auto">
                    <table id="example" class="nvr-table">
                      <thead>
                      <tr class="thead">
                          <th><center>Trạng thái</center></th>
                          <th>Tên việc  </th>
                          <th>Người giao</th>
                              @if ($level <3)
                          <th>Người phụ trách</th>
                          @endif
                          <th>Bắt đầu </th>
                          <th>Kết thúc</th>
                          <th>Chi tiết</th>
                        </tr>
                      </thead>
                      <tbody class="tbody">
                        @foreach($job_success as $job)

                          @if ($job->status == 0)
                            <td><center><i class="fa fa-star text-warning"></i></center></td>

                          @elseif ($job->status == 1)
                            <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/success.png"></td>

                          @elseif ($job->status == 2)
                            <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/close.png"></td>

                             @else 
                                  
                            <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/stop.png"></td>
                            @endif
                            
                            <td>  <a class="preview" href="job-detail/{{$job->id}}"> <span id="jname{{$job->id}}">{{$job->name}}</span></a></td> <td>
                              <?php
                                $uif = DB::table("users")->where("id",$job->user_id)->first();
                              ?>
                              <span id="juname{{$job->id}}"><?=$uif->name?></span>
                              <span style="display: none" id="juemail{{$job->id}}"><?=$uif->email?></span>
                              <span style="display: none" id="juphone{{$job->id}}"><?=$uif->phone?></span>

                            </td>
                           
                              @if ($level <3)
                            <td id="jnames{{$job->id}}">{{$job->names}}</td>
                            @endif
                            <td id="jstartdate{{$job->id}}">{{$job->start_date}}</td>
                            <td id="jenddate{{$job->id}}">{{$job->end_date}}</td>
                           <td>
                              <span style="display:none" id="jdes{{$job->id}}" >{!! $job->des !!}</span>
                                 
                              <a class="preview" href="job-detail/{{$job->id}}"><img src="/js-css/img/icon/notepad.png"></a>

                             </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </form>
        </div>

         <div id="content3" class="tab-pane fade">
           <form action="removeadmin" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="scroll-auto">
                    <table id="example" class="nvr-table">
                      <thead>
                      <tr class="thead">
                          <th><center>Trạng thái</center></th>
                          <th>Tên việc  </th>
                          <th>Người giao</th>
                              @if ($level <3)
                          <th>Người phụ trách</th>
                          @endif
                          <th>Bắt đầu </th>
                          <th>Kết thúc</th>
                          <th>Chi tiết</th>
                        </tr>
                      </thead>
                      <tbody class="tbody">
                        @foreach($job_fail as $job)

                          @if ($job->status == 0)
                            <td><center><i class="fa fa-star text-warning"></i></center></td>

                          @elseif ($job->status == 1)
                            <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/success.png"></td>

                          @elseif ($job->status == 2)
                            <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/close.png"></td>

                             @else 
                                  
                            <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/stop.png"></td>
                            @endif
                            <td id="jname{{$job->id}}">{{$job->name}}</td>
                             <td>
                              <?php
                                $uif = DB::table("users")->where("id",$job->user_id)->first();
                              ?>
                              <span id="juname{{$job->id}}"><?=$uif->name?></span>
                              <span style="display: none" id="juemail{{$job->id}}"><?=$uif->email?></span>
                              <span style="display: none" id="juphone{{$job->id}}"><?=$uif->phone?></span>

                            </td>
                            
                              @if ($level <3)
                            <td id="jnames{{$job->id}}">{{$job->names}}</td>
                            @endif
                            <td id="jstartdate{{$job->id}}">{{$job->start_date}}</td>
                            <td id="jenddate{{$job->id}}">{{$job->end_date}}</td>
                           <td>
                              <span style="display:none" id="jdes{{$job->id}}" >{!! $job->des !!}</span>
                                
                              <a class="preview" href="job-detail/{{$job->id}}"><img src="/js-css/img/icon/notepad.png"></a>

                        

                             </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </form>
        </div>

         <div id="content4" class="tab-pane fade">
           <form action="removeadmin" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="scroll-auto">
                    <table id="example" class="nvr-table">
                       <thead>
                      <tr class="thead">
                          <th><center>Trạng thái</center></th>
                          <th>Tên việc  </th>
                          <th>Người giao</th>
                              @if ($level <3)
                          <th>Người phụ trách</th>
                          @endif
                          <th>Bắt đầu </th>
                          <th>Kết thúc</th>
                          <th>Chi tiết</th>
                        </tr>
                      </thead>
                      <tbody class="tbody">
                        @foreach($job_stop as $job)

                          @if ($job->status == 0)
                            <td><center><i class="fa fa-star text-warning"></i></center></td>

                          @elseif ($job->status == 1)
                            <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/success.png"></td>

                          @elseif ($job->status == 2)
                            <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/close.png"></td>

                             @else 
                                  
                            <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/stop.png"></td>
                            @endif
                           
                            <td>  <a class="preview" href="job-detail/{{$job->id}}"> <span id="jname{{$job->id}}">{{$job->name}}</span></a></td>  <td>
                              <?php
                                $uif = DB::table("users")->where("id",$job->user_id)->first();
                              ?>
                              <span id="juname{{$job->id}}"><?=$uif->name?></span>
                              <span style="display: none" id="juemail{{$job->id}}"><?=$uif->email?></span>
                              <span style="display: none" id="juphone{{$job->id}}"><?=$uif->phone?></span>

                            </td>
                            
                              @if ($level <3)
                            <td id="jnames{{$job->id}}">{{$job->names}}</td>
                            @endif
                            <td id="jstartdate{{$job->id}}">{{$job->start_date}}</td>
                            <td id="jenddate{{$job->id}}">{{$job->end_date}}</td>
                           <td>
                              <span style="display:none" id="jdes{{$job->id}}" >{!! $job->des !!}</span>
                              <a class="job-moniter preview" href="job-detail/{{$job->id}}"><img src="/js-css/img/icon/notepad.png"></a>
                            

                             </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </form>
        </div>

      </div>
    </div>
  <!-- end model --->
  <!-- Modal -->
      <div class="modal fade modol-text" id="create-user" role="dialog">
        <form id="action-form" action="add-job" method="POST"
         enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="type_id" value="0">
          <input type="hidden" name="department" value="{{$did}}">
          <div  class="modal-dialog model-right" style="min-width: 50%;height: auto">
            <!-- Modal content-->
            <div class="modal-content">
               @if ($level <3)
              <div class="modal-header">
                  <label>Tạo việc </label>
              </div>
              @endif
              <div class="notification"></div>
              <div class="modal-body modal-config">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                       <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tên </td>
                            <td><input type="" value="" name="name" class="input-edit create-user modol-text" id="name" required=""></td>
                        </tr>
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian bắt đầu </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="start_date" id="new_start_date" required=""></td>
                        </tr>
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian kết thúc </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="end_date" id="new_end_date" required=""></td>
                        </tr>

                         <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea  name="des" class="ckeditor form-control input-edit modol-text"  required=""></textarea></td>
                        </tr>




</tbody>

                    <tbody class="table-edit">
                       
                        
                       
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>


                        <div class="form-group">
                    <input style="display: none" type="file" name="file[]" class="file"
                    multiple>

                    <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Tải tệp lên" id="file">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Chọn</button>
                        </div>
                    </div>
                <div class="form-group" id="preview">
                </div>
                <div class="form-group" id="preview-file"></div>
                </div>
                

                <select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffselect" multiple>

</select>
              </div><br><hr>
              <div class="modal-footer">

                <button class="btn btn-model" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Tạo</button>
                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- Modal edit-->
      <div class="modal fade modol-text" id="edit-job-modal" role="dialog">
        <form id="update-jobs" method="POST" action="update-job" 
         enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="id" id="edit_id" value="">
          <div  class="modal-dialog model-right"  style="min-width: 50%;height: auto">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label><i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 1.2em;"></i>&nbsp; Thông tin người dùng</label>
              </div>
              <div class="notification"></div>
              <div class="modal-body">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                         <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tên </td>
                            <td><input type="" value="" name="name" class="input-edit create-user modol-text" id="edit_name" required=""></td>
                        </tr>
                      
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian bắt đầu </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="start_date" id="edit_start_date" required="" value="01-01-2021"></td>
                        </tr>
                         <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian kết thúc </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="end_date" id="edit_end_date" required=""  value=""></td>
                        </tr>
                           <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea  name="des" class="ckeditor form-control input-edit modol-text"  required="" id="EditDes"></textarea></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                                        <div class="form-group">
                    <input style="display: none" type="file" name="file[]" class="file"
                    multiple>

                    <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Tải tệp lên" id="file">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Chọn</button>
                        </div>
                    </div>
                <div class="form-group" id="preview">
                </div>
                <div class="form-group" id="preview-file"></div>
                </div>
              </div>
              <div id="staffEditDiv"></div>
<br><hr>
              <div class="modal-footer">
                <button class="btn btn-model" type="submit"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Cập nhật </button>
                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>
            </div>
          </div>
        </form>
      </div>




<!-- Modal -->
<div class="modal fade modol-text" id="job-modal" role="dialog">
  <div class="modal-dialog model-right" style="min-width: 80%;height: auto" >
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label>Theo dõi tiến độ công việc </label>
      </div>
      <div class="notification"></div>
        <div class="modal-body">
              <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab1" class="nav-link  color-a"  data-toggle="tab" role="tab" href="#contentl1"> Tiến độ </a>
      </li>
       <li class="nav-item margin_center">
          <a id="tab2" class="nav-link  color-a"  data-toggle="tab" role="tab" href="#contentl2"> Thảo luận </a>

      </li>


      <li class="nav-item margin_center">
          <a id="tab5" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#contentl4">Cập nhật tiến độ</a>
      </li>
 @if ($level <3)
      <li class="nav-item margin_center">
          <a id="tab6" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#contentl5">Kết thúc</a>
      </li>
@endif

    </ul>  
    <hr>
 <div class="tab-content">

          <div id="contentl1" class="tab-pane  in active">
            <div id="job_detail">
            <h5> Tên công việc:  <span id="job_name_detail"></span></h5>
            <h5> Mô tả: <span id="job_des"></span></h5>
            <hr>
            <h5> Người giao việc: <span id="job_contact_name"></span></h5>
            <h5> Email: <span id="job_contact_email"></span></h5>
            <h5> Số điện thoại: <span id="job_contact_phone"></span></h5>

            <hr>
            <h5> Người phụ trách: <span id="job_user_detail"></span></h5>
            <h5> Ngày bắt đầu: <span id="job_start_date"></span></h5>
            <h5> Ngày kết thúc:  <span id="job_end_date"></span></h5>
          </div>

<table id="job-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Sự kiện </th>
                            <th>Người phụ trách </th>
                            <th>Thời gian</th>
                            <th>Minh chứng </th>
                          </tr>
                        </thead>
                        <tbody class="tbody" id="job_history">

                        </tbody>
                      </table>
          </div>


          <div id="contentl2" class="tab-pane  fade">
           
            <div id="job_detail2"></div>
            <h4>Danh sách bình luận</h4>
            <div id="comment_content"></div>
               <form action="/job-comments"  enctype="multipart/form-data" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" id="job_id" value="" name="job_id">
    
                        <div class="form-group">
                            <label>Bình luận mới</label>
                       <textarea  name="content" class="ckeditor form-control " cols="20" rows="5"></textarea>
                        </div>
                        
            
                        <div class="form-group">
                    <input style="display: none" type="file" name="file[]" class="file"
                    multiple>

                    <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Upload File" id="file">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Tệp...</button>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="preview">
                </div>
                <div class="form-group" id="preview-file"></div>

                        <div class="form-group">
                            <input type="submit" name="submit" value="Trả lời" class="btn btn-primary">
                    </div>
    
                    </form>



          </div>

<div id="contentl4" class="tab-pane fade">
      <form action="add-history-jobs"  enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
          <table class="table-edit table-model">
            
            <tbody class="table-edit">

                <td class="cam-properties">Mô tả</td>
                <td><input value="" type="" value="" name="des" class="input-edit modol-text" required=""></td>
                <input type="hidden" value="" name="id" id="job_input_id" class="input-edit modol-text" required=""></td>
              </tr>
              <tr>
                <td class="cam-properties">Minh chứng </td>
                  <td><label  class="preview" for="file-input"><img onclick="openfileupload(1)"  src="/js-css/img/icon/upload.png"></label><input  id= "inputfile1" style="display:none" type="file" name="file[]" class="form-control"
                    multiple>
                </td>
              </tr>

              <tr>
                <td></td>
                <td>
                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>

<div id="contentl5" class="tab-pane fade">
  <form action="close-job"  enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input id="status_input_id" type="hidden" name="id" value="">
          <table class="table-edit table-model">
            
          <tr>

              <td> Vai trờ</td>
              <td>

                <select class="custom-select select-profile  browser-default" name="status" >
                        <option value="1">Hoàn thành </option>
                        <option value="2">Không hoàn thành </option>
                        <option value="3">Ngưng</option>
               </select>
              </td>
          </tr>
            <tbody class="table-edit">

                
              </tr>
            </tbody>
          </table>  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Cập nhật  &nbsp;&nbsp; </button>
               
        </div>
      </form>
</div>
</div>
  <div class="modal-footer" style="    position: inherit;">

                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>

    </div>
  </div>
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


<div class="overlay-dark"></div>
<embed class="img-overlay">

<script type="text/javascript">
function downloadURI(uri, name) {
  var link = document.createElement("a");
  link.download = name;
  link.href = uri;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
  delete link;
}

    function  loadFile(name,$src){  
      if (window.innerWidth <  800){
window.open(
  $src,
  '_blank' // <- This is what makes it open in a new window.
);
return 0;
}
      if ($src.includes(".doc")){
        downloadURI($src,name+".docx")
        return
      }else{
      console.log($src)
      $('.img-overlay').attr('src', $src);
      $(".overlay-dark").css('display', 'block');
      $('.img-overlay').css('display', 'block');
      $('.img-overlay').css('opacity', 1);
      $('.img-overlay').css('width', '90%');
      $('.img-overlay').css('height', '90%');
      $('.img-overlay').css('transform', 'translate(-50%, 0) scale(1, 1)');
      console.log("sone")
    }
    }

    $(".overlay-dark").on('click', function() {
      $(".overlay-dark").css('display', 'none');
      $('.img-overlay').css('display', 'none');
      setTimeout(function() {
        $('.img-overlay').css('transform', 'translate(-50%, 0) scale(0, 0)');
      }, 600);
    });


</script>
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


<script>
  $(document).ready(function() {
      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }

      // $('#example').DataTable({
      //   "paging":   false,
      //   "info":     false,
      //   "searching": false
      // });
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
        // confirm_remove();
</script>

<script>
  $(".edit-user").click(function(){
    var userid = this.id;
    console.log(userid);
    $.ajax({
      url: 'getuseredit/'+userid,
      success: function(data) {
        console.log(data);  
        $("#full_name").val(data.name);
        $("#email").val(data.email);
        $("#phone_number").val(data.phone_number);
        $("#role").val(data.role_id);
        $("#password").val('');
        $("#identify").val(data.identify_card);
        $("#action-edit").attr('action', '/postuseredit/'+userid);      
      }
    });
  })
</script>


<script>

document.getElementById('edit_start_date').valueAsDate = new Date();

document.getElementById('edit_end_date').valueAsDate = new Date();

document.getElementById('new_start_date').valueAsDate = new Date();

document.getElementById('new_end_date').valueAsDate = new Date();

  $(".job-moniter").click(function(){
    var jobid = this.id;
    $("#job_input_id").val(jobid);

    $("#status_input_id").val(jobid);
    var name = document.getElementById("jname"+jobid).innerHTML
    $("#job_name_detail").html(name);

    var cname = document.getElementById("juname"+jobid).innerHTML

    $("#job_contact_name").html(cname);

    var cemail = document.getElementById("juemail"+jobid).innerHTML
    $("#job_contact_email").html(cemail);

    var cphone = document.getElementById("juphone"+jobid).innerHTML
    $("#job_contact_phone").html(cphone);

    var des = document.getElementById("jdes"+jobid).innerHTML
    $("#job_des").html(des);
    var names = document.getElementById("jnames"+jobid).innerHTML
    $("#job_user_detail").html(names);
    var jstartdate = document.getElementById("jstartdate"+jobid).innerHTML
    $("#job_start_date").html(jstartdate);
    var jenddate = document.getElementById("jenddate"+jobid).innerHTML
    $("#job_end_date").html(jenddate);


        $("#job_history").empty();
          var table = document.getElementById("job_history"); 
          // for(var i=0; i < table.rows.length;  i++)
          //       table.deleteRow(0);
    $.ajax({
        type: "GET",
        url : "history-jobs/"+jobid,
        success: function(msg){

          msg = JSON.parse(msg)
          console.log(msg)
          for (i = 0; i <msg.length;i++){
          var row = table.insertRow();
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);
          var cell4 = row.insertCell(3);

          cell1.innerHTML = msg[i].content
          cell2.innerHTML = msg[i].name
          cell3.innerHTML = msg[i].time
          cell4.innerHTML = '<button onclick="loadFile('+"'"+msg[i].content+"'"+','+"'"+msg[i].link+"'"+')" class="preview" type="button"><img src="/js-css/img/icon/play.png">'
          // cell3.innerHTML = '<a href="'+msg[i].link+'" ><i class="fa fa-download" aria-hidden="true"></i></a>'
          }
        }
      });

     $.ajax({
        type: "GET",
        url : "job-comments/"+jobid,
        success: function(msg){

          // msg = JSON.parse(msg)
          console.log(msg)
          var html = ""
          for (i = 0; i <msg.length;i++){
            var title = msg[i].name +", " + msg[i].dname + " - " + msg[i].rname  
            html = html + '<div class="card card-default  mb-2"><div class="card-header"><span class="">'+title+'</span> </div> <div class="card-body"> <p class="">'+msg[i].content+'</p></div></div>'
          }
          document.getElementById("comment_content").innerHTML = html
        }
      });

    document.getElementById("jid").value = jobid
    document.getElementById("job_detail2").innerHTML = document.getElementById("job_detail").innerHTML 

  })


   $(".job-update").click(function(){
    console.log("okoe")
    var jobid = this.id;
    $("#edit_id").val(jobid);
    var name = document.getElementById("jname"+jobid).innerHTML
    $("#edit_name").val(name);
    var des = document.getElementById("jdes"+jobid).innerHTML
    // $("#EditDes").val(des);

          CKEDITOR.instances.EditDes.setData( document.getElementById("jdes"+jobid).innerHTML, function()
{
    this.checkDirty();  // true
});  
    // var names = document.getElementById("jnames"+jobid).innerHTML
    // $("#job_user_detail").val(names);
    var jstartdate = document.getElementById("jstartdate"+jobid).innerHTML
    console.log(jstartdate)
    // document.getElementById("edit_start_date").value ="2021-01-01";

    var jenddate = document.getElementById("jenddate"+jobid).innerHTML
    $("#edit_end_date").val(jenddate);

    getStaffSelectedList(jobid)

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


<script src="/js-css/js/bootstrap-select.min.js"></script>
<script src="/js-css/js/ckeditor/ckeditor.js"></script>

<script>
    function snakeModel(){
      $("#create-user").addClass("shake-model");
            setTimeout(function() { 
                $("#create-user").removeClass("shake-model");
            }, 1000);
        }

 function getStaffList(){
  $.ajax({
    type: "GET",
    url: '/system/staff-depart/{{$did}}',
    success: function (response) {
      response = (JSON.parse(response))
      console.log(response)
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


      html = ''
      for(var i =0; i < response.length; i++){
          html = html +'<option  value="'+response[i].id+'">'+response[i].name+'</option>'
      }
      console.log(html)
      document.getElementById("staffselect").innerHTML=html;
$('#staffselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
    }
  });
}
getStaffList()

 function getStaffSelectedList(id){
  $.ajax({
    type: "GET",
    url: '/system/staff-edit-depart/{{$did}}'+did,
    success: function (response) {
      response = (JSON.parse(response))
      console.log(response)
      var data = response[0]
      var sel = response[1]
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


     var  html = '<select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffEditSelected" multiple>'
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
      document.getElementById("staffEditDiv").innerHTML=html;
$('#staffEditSelected').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
    }
  });
}


    function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }
    
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


        function Bars(type,id){

            if (window.innerWidth >800 ){
            var size = window.innerWidth/125;

          }else{

            var size = window.innerWidth/25;
          }
        $('#barChart').remove();
        $('#barCon').append('<canvas id="barChart"><canvas>');
        var url ="";
        if (type == 0){
          url = '/job-bar-dept/{{$did}}/'
        }else{
          url = '/job-bar-staff/'+id+'/'
        }
             $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
              console.log(response)
  methods = []
  methods2 = []
            labels = []
           for(const [method, value] of Object.entries(response)){
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                labels.push(value.time_display);
                methods2.push(value.s1);
                methods.push(value.s0)
            }

            var ctx = document.getElementById("barChart");
            var myChart = new Chart(ctx, {
              type: 'horizontalBar',
              data: {
                labels: labels,
                datasets: [{
                  label: 'Thống kê lượng công việc đang thực hiện',
                  data: methods,
                backgroundColor: 'blue',
                  borderWidth: 1
                },
                {
                  label: 'Thống kê lượng công việc đã hoàn thành',
                  data: methods2,
                backgroundColor: '#5caceb',
                  borderWidth: 1
                }
                ]
              },
              options: {

                responsive: true,
                scales: {
                  xAxes: [{
                     scaleLabel: {
                        display: true,
                        labelString: "Tháng"
                      },
                    ticks: {
                      maxRotation: 90,
                      minRotation: 80,
                fontSize: 20
                    }
                  }],
                  yAxes: [{
                     scaleLabel: {
                        display: true,
                        labelString: 'Số công việc'
                      },
                    ticks: {
                      beginAtZero: false,
                fontSize: 20
                    }
                  }]
                }
              }
            });
            Chart.defaults.global.defaultFontColor = '#dcf3ff';


        }

          });
     }

     function InitBars(type,id){

            if (window.innerWidth >800 ){
            var size = 20;
            var myratio = false

          }else{

            var size = 15;
            var myratio = true
          }
        $('#barChart').remove();
        $('#barCon').append('<canvas height="500" id="barChart"><canvas>');
       
          url = '/job-bar-dept/{{$did}}/'
        
             $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
              console.log(response)
  methods = []
  methods2 = []
            labels = []
           for(const [method, value] of Object.entries(response)){
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                
                labels.push(value.name + "("+value.s0 + " việc )");
                methods2.push(value.d1*24);
                methods.push(value.d0*24 - value.d1*24)
            }

            var ctx = document.getElementById("barChart");
            var myChart = new Chart(ctx, {
              type: 'horizontalBar',
              data: {
                labels: labels,
                datasets: [{
                  label: 'Thời gian đã sử dụng',
                  data: methods,
                backgroundColor: '#28a745',
                  borderWidth: 3
                },
                {
                  label: 'Thời gian còn lại',
                  data: methods2,
                backgroundColor: '#dc3545',
                  borderWidth: 3
                }
                ]
              },
              options: {

                responsive: true,
    maintainAspectRatio: myratio,
                scales: {
                  xAxes: [{
            barPercentage: 1,

            stacked: true,
                     scaleLabel: {
                        display: true,
                        labelString: 'Thời gian (giờ)'
                      },
                    ticks: {
                      maxRotation: 90,
                      minRotation: 0,
                fontSize: size,

                    }
                  }],
                  yAxes: [{
            stacked: true,
                    ticks: {
                      beginAtZero: false,
                fontSize: size,
                    }
                  }]
                }
              }
            });
            Chart.defaults.global.defaultFontColor = '#dcf3ff';


        }

          });
     }

        InitBars();

  </script>

  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
  <script>
    $('#input-table').DataTable();
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
@endsection
