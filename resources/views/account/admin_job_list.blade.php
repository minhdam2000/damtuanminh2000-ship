@extends('layouts.index')
@section('content')
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
            <i class="fa fa-list" aria-hidden="true"></i> &nbsp;Danh sách công việc 
          </div>
          <a>
            <div class="account-add"><button class="btn-add-account" data-toggle="modal" data-target="#create-user"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp; Tạo mới</button></div>
          </a>
          <div class="clearfix"></div>
        </div>
         <ul class="nav nav-tabs" id="tabs" role="tablist">
            <li class="nav-item margin_center">
                <ul class="nav nav-tabs" id="tabs" role="tablist">
            <li class="nav-item margin_center">
                <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#content0"> Tổng quan</a>
            </li>
                <a id="tab1" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content1"> Việc đang thực hiện
                  @if($job_all_count > 0)
                     <span class="badge">{{$job_all_count}}</span>
                    @endif
                    </a> 
            </li>
            <li class="nav-item margin_center">
                <a id="tab2" class="nav-link color-a" 
                data-toggle="tab" role="tab" href="#content2">Việc hoàn thành @if($job_success_count > 0)
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
                     <span class="badge">{{$job_all_count}}</span>
                    @endif
              </a>
            </li>
          
          </ul> 
</li></ul></div>
        <div class="tab-content">
 <div id="content0" class="tab-pane  in active">
<br><hr><br>
              <div class="row">

                <div   id="barCon"  class="col-md-6 col-sm-12 col-12">

    <canvas   id="barChart"></canvas>
 </div>
<div class="col-md-6 col-sm-12 col-12">
               <table id="input-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                         
                            <th> Đơn vị</th>
                            <th> Số việc đang làm</th>
                            <th> Tổng số lượng</th>
                            <th> Số lượng hoàn thành  </th>
                            <th> Số lượng không hoàn thành </th>
                            <th> Số lượng quá hạn</th>
                            <th> Tỷ lệ hoàn thành</th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($job_users as $job)
                             <tr>
                               <td>
                              
                              <a href="dept-job-list/{{$job->id}}">   {{$job->name}}</a>

                               </td>
                              
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
                             </tr>
                             @endforeach
                          
                        </tbody>
                      </table>
</div>
            </div>
        </div>

          <div id="content1" class="tab-pane  fade">
           <form action="removeadmin" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="scroll-auto">
                    <table id="example" class="nvr-table">
                      <thead>
                      <tr class="thead">
                          <th><center>Trạng thái</center></th>
                          <th>Tên việc  </th>
                          <th>Phòng phụ trách</th>
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
                            <td>  <a class="preview" href="job-detail/{{$job->id}}"> <span id="jname{{$job->id}}">{{$job->name}}</span></a></td>
                            <td id="jdepart{{$job->id}}">{{$job->dname}}
                            <span style="display:none" id="jnames{{$job->id}}">{{$job->names}}</td>
                            <td id="jstartdate{{$job->id}}">{{$job->start_date}}</td>
                            <td id="jenddate{{$job->id}}">{{$job->end_date}}</td>
                           <td>
                              <span style="display:none" id="jdes{{$job->id}}" >{!! $job->des !!}</span>
                              @if ($job->status == 0)
                              <a class="preview" href="job-detail/{{$job->id}}"><img src="/js-css/img/icon/notepad.png"></a>
                            <span class="job-update preview" data-toggle="modal" data-target="#edit-job-modal" id="{{$job->id}}"><img src="/js-css/img/icon/write.png"></span>
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
                          <th>Phòng phụ trách</th>
                          <th>Bắt đầu </th>
                          <th>Kết thúc</th>
                          <th>Chi tiết</th>
                        </tr>
                      </thead>
                      <tbody class="tbody">
                        @foreach($job_success as $job)
   
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
                            <td>  <a class="preview" href="job-detail/{{$job->id}}"> <span id="jname{{$job->id}}">{{$job->name}}</span></a></td>
                            <td id="jdepart{$job->id}}">{{$job->dname}}
                            <span style="display:none" id="jnames{{$job->id}}">{{$job->names}}</td>
                            <td id="jstartdate{{$job->id}}">{{$job->start_date}}</td>
                            <td id="jenddate{{$job->id}}">{{$job->end_date}}</td>
                           <td>
                              
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
                          <th>Phòng phụ trách</th>
                          <th>Bắt đầu </th>
                          <th>Kết thúc</th>
                          <th>Chi tiết</th>
                        </tr>
                      </thead>
                      <tbody class="tbody">
                        @foreach($job_fail as $job)
   
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
                            <td>  <a class="preview" href="job-detail/{{$job->id}}"> <span id="jname{{$job->id}}">{{$job->name}}</span></a></td>
                           
                            <td id="jdepart{{$job->id}}">{{$job->dname}}
                            <span style="display:none" id="jnames{{$job->id}}">{{$job->names}}</td>
                            <td id="jstartdate{{$job->id}}">{{$job->start_date}}</td>
                            <td id="jenddate{{$job->id}}">{{$job->end_date}}</td>
                           <td>
                      
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
                          <th>Phòng phụ trách</th>
                          <th>Bắt đầu </th>
                          <th>Kết thúc</th>
                          <th>Chi tiết</th>
                        </tr>
                      </thead>
                      <tbody class="tbody">
                        @foreach($job_stop as $job)
   
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
                            <td>  <a class="preview" href="job-detail/{{$job->id}}"> <span id="jname{{$job->id}}">{{$job->name}}</span></a></td>
                            <td id="jdepart{{$job->id}}">{{$job->dname}}
                            <span style="display:none" id="jnames{{$job->id}}">{{$job->names}}</td>
                            <td id="jstartdate{{$job->id}}">{{$job->start_date}}</td>
                            <td id="jenddate{{$job->id}}">{{$job->end_date}}</td>
                           <td>
                            
                              <a class="preview" href="job-detail/{{$job->id}}"><img src="/js-css/img/icon/notepad.png"></a>

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
        <form id="action-form" action="add-job" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="type_id" value="1">
          <div  class="modal-dialog model-right" style="min-width: 50%;height: auto">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Tạo việc </label>
              </div>
              <div class="notification"></div>
              <div class="modal-body modal-config">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                       <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tên </td>
                            <td><input type="" value="" name="name" class="input-edit create-user modol-text" id="name" required=""></td>
                        </tr>
                         <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea  name="des" class="ckeditor form-control input-edit modol-text"  required=""></textarea></td>
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
                            <td><i class="fa fa-user" aria-hidden="true"></i> Khối</td>
                            <td>
                              <select class="custom-select select-profile  browser-default" name="department" id="NewDepartment" >
                                  @foreach($department as $department)
                                      <option value="{{$department->id}}">{{$department->name}}</option>
                                      @endforeach
                            
                              </select>
                            </td></tr>

</tbody>
</table>

                 
              </div><br><hr>
              <div class="modal-footer">

                <button class="btn btn-model" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Tạo</button>
                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>
            </div>
        </form>
      </div></div>
      <!-- Modal edit-->
      <div class="modal fade modol-text" id="edit-job-modal" role="dialog">
        <form id="update-jobs" method="POST" action="update-job">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="id" id="edit_id" value="">
          <div  class="modal-dialog model-right"  style="min-width: 50%;height: auto">
>
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label> Chỉnh sửa thông tin</label>
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
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea  name="des" class="ckeditor form-control input-edit modol-text"  required="" id="EditDes"></textarea></td>
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
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Khối </td>
                            <td><span id="edit_department" ></span></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
              </div>
<br><hr>
              <div class="modal-footer">
                <button class="btn btn-model" type="submit"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Cập nhật </button>
              </div>
            </div>
          </div>
  <div class="modal-footer" style="    position: inherit;">

                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
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

      <li class="nav-item margin_center">
          <a id="tab6" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#contentl5">Kết thúc</a>
      </li>

    
    </ul>  
    <hr>
 <div class="tab-content">

          <div id="contentl1" class="tab-pane  in active">
            <div id="job_detail">
            <h5> Tên công việc:  <span id="job_name_detail"></span></h5>
            <h5> Mô tả: <span id="job_des"></span></h5>
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
               <form action="/job-comments" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" id="jid" name="job_id">
    
                        <div class="form-group">
                            <label>Bình luận mới</label>
                       <textarea  name="content" class="ckeditor form-control " cols="20" rows="5"></textarea>
                        </div>
                        
    
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
                  <td><label  class="preview" for="file-input"><img onclick="openfileupload(1)"  src="/js-css/img/icon/upload.png"></label><input  id= "inputfile1" style="display:none" type="file" name="file[]" class="form-control" multiple>
                </td>
              </tr>

              <tr>
                <td></td>
                <td>
                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoát </button>
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

              
                <td>
                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Cập nhật  &nbsp;&nbsp; </button>
                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoát</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>
</div>
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
    $("#edit_department").html(document.getElementById("jdepart"+jobid).innerHTML);

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





    function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }
    

        function Bars(type,id){

            if (window.innerWidth <800 ){
            var size = 15;

          }else{

            var size = 20;
          }
        $('#barChart').remove();
        $('#barCon').append('<canvas  height="500" + id="barChart"><canvas>');
       
             $.ajax({
            type: "GET",
            url: "/job-bar-admin",
            success: function (response) {
              console.log(response)
  listID = []
  methods = []
  methods2 = []
            labels = []
           for(const [method, value] of Object.entries(response)){
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                labels.push(value.name + "("+value.s0 + " việc )");
                methods2.push(value.d1*24);
                methods.push(value.d0*24)
                listID.push(value.id)
            }

            var ctx = document.getElementById("barChart");
            var myChart = new Chart(ctx, {
              type: 'horizontalBar',
              data: {
                labels: labels,
                datasets: [{
                  label: 'Tổng thời gian thực hiện',
                  data: methods,
                backgroundColor: '#28a745',
                  borderWidth: 1
                },
                {
                  label: 'Thời gian còn lại',
                  data: methods2,
                backgroundColor: '#dc3545',
                  borderWidth: 1
                }
                ]
              },
              options: {
    maintainAspectRatio: false,
                responsive: true,
                onClick: function(e) {
                  console.log(this.scales['y-axis-0'])
  var xLabel = this.scales['y-axis-0'].getValueForPixel(e.offsetY);
  // console.log(xLabel)
  // console.log(listID[xLabel])
  if(Number.isInteger(listID[xLabel])){
    window.location.href = "dept-job-list/" + listID[xLabel]
  }
},
                scales: {
                  xAxes: [{
            stacked: true,
                     scaleLabel: {
                        display: true,
                        labelString: 'Thời gian (giờ)'
                      },
                    ticks: {
                      maxRotation: 90,
                      minRotation: 0,
                fontSize: size
                    }
                  }],
                  yAxes: [{
            stacked: true,
                    ticks: {
                      beginAtZero: false,
                fontSize: size
                    }
                  }]
                }
              }
            });
            Chart.defaults.global.defaultFontColor = '#dcf3ff';

             $("#barChart").click( 
          function(evt){
              var activePoints = myChart.getElementsAtEvent(evt);
              console.log(activePoints);
              var input_ip = activePoints[0]._view.label
              console.log(input_ip);
          }
      );    



        }

          });
     }
        Bars(0,0);
 $(document).ready(function(){
    $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');
        $("#"+this.href.split("#")[1]).addClass('active');
        // type = 
         
    });
});
  </script>
@endsection
