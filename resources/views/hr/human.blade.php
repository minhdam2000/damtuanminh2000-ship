@extends('layouts.index')
@section('content')
	<div class="content-camera">
		<div class="header-content">
			<div class="header-content-left">
				<h6>Thông tin chi tiết</h6>
			</div>
			<div class="header-content-right" style="display: inline;">
				<a href="/"><h6 class="display-inline link-active">
				<h6 class="display-inline">Nhân sự</h6>
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
    <div class="row row-content">
      <div class="row-title-proxy">

        <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#content1"> Thông tin cơ bản</a>
      </li>
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content2"> Đánh giá công việc </a>
      </li>
     <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content3"> Hiệu quả kinh doanh </a>
      </li>
      <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content4"> Chi tiết lương </a>
      </li>
    </ul>  
    <hr>
        <div class="tab-content">

          <div id="content1" class="tab-pane  in active">
          <div class="active-view" id="menu1">
              <h5> Họ tên: {{$user_info->name}}</h5>
            <h5> Email: {{$user_info->email}}</h5>
            <h5> Số điện thoại: {{$user_info->phone}}</h5>
            <h5> Chứng minh thư: {{$user_info->identify}}</h5>
            <h5> Ngày bắt đầu làm việc : {{date("d-m-Y", strtotime($user_info->begin_date))}}</h5>
            <h5> Phòng làm việc :  {{$user_info->dname}}</h5>
            <h5> Vị trí :  {{$user_info->rname}} </h5>
            <h5> Các mốc công việc đáng nhớ: </h5>

              <form action="hr/delete-mul-staff-event" method="POST">
			          <input type="hidden" name="_token" value="{{csrf_token()}}">
                   <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;Danh sách khách hàng</div>
                      <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-edge"><i class="fa fa-plus" aria-hidden="true"></i> Sự kiện mới </button></div>
                      <div class="proxy-add" title="Delete"><button type="button" class="camera-button" id="device-remove"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button><button style="display: none;" id="remove-credential" type="submit"></button></div>
                      <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>
                     


                  <table id="example" class="nvr-table">
                  <thead>

                    <tr class="thead">
                            <th class="check-all">
                              <input type="checkbox" id="select-all" value="select-all"  name="select-all" onclick="checkAll();" />
                              <label for="select-all" class="display-inline" id="label-all"></label>
                              <label class="display-inline"></label>
                             </th>

                        <th>Tên sự kiện </th>
                        <th>Mô tả </th>
                        <th>Thời gian</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody class="tbody"> 
                        @foreach($events as $event)
                            <tr class="color-add">
                              <td>
                                <input type="checkbox" id="{{$event->id}}" value="{{$event->id}}" name="{{$event->id}}" class="check-box" />
                                <label for="{{$event->id}}" class="add-cam"></label>
                              </td>
                              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="name{{$event->id}}"> {{$event->name}}</span></a></td>

                                <td> <span id="des{{$event->id}}">{!! $event->des !!}</span></a></td>
                                <td> <span id="date{{$event->id}}">{{$event->date}}</span></a></td>
                              
                              <td><button style="color: white"  type="button" onclick="updateInfo('{{$event->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem;"></i></button></td>
                            </tr>
                          @endforeach
                    </tbody>
                  </table>

                    </form>
            </div>
          </div>

            <div id="content2" class="tab-pane  fade">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <h5>Thống kê hiệu năng làm việc </h5>
                  <table id="example" class="nvr-table">
                  <thead>
                    <tr class="thead">
                       
                        <th> Trạng thái </th>
                        <th> Số lượng  </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      <?php
                        $success = 0;
                        $fail = 0;
                      ?>
                      @foreach($job_stas as $job)
                        <tr class="color-add">
                         
                          @if($job->status ==0)
                          <td><span style="color: green"> Đang làm</span></td>
                          <td>{{$job->num}}</td>
                          @elseif($job->status ==1)
                          <td><span style="color: green"> Hoàn thành</span></td>
                          <?php
                            $success = $job->num;
                          ?>
                          <td>{{$job->num}}</td>
                          @elseif($job->status ==2)
                          <td><span style="color: red">Thất bại </span></td>
                          <td>{{$job->num}}</td>
                          <?php
                            $fail = $job->num;
                          ?>
                          @else
                          <td><span style="color: red"> Đã tạm ngưng</span></td>
                          <td>{{$job->num}}</td>
                          @endif


                          

                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <br>
                  @if($fail !=0)
                  <h5>Tỷ lệ thành công: <?=floatval($success)/$fail*100?>%</h5>
                  @else
                  <h5>Tỷ lệ thành công: 100%</h5>

                  @endif
                  <hr>
                  <br>
                  <h5>Thống kê hiệu năng làm việc </h5>
                  <table id="example" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th> Công việc </th>
                        <th> Ngày bắt dầu </th>
                        <th> Ngày kết thúc </th>
                        <th> Trạng thái </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($job_info as $job)
                        <tr class="color-add">    
                          <td>{{$job->name}}</td>
                          <td>{{$job->sdate}}</td>
                          <td>{{$job->edate}}</td>                      
                          @if($job->status ==0)
                          <td><span style="color: green"> Đang làm</span></td>
                          @elseif($job->status ==1)
                          <td><span style="color: green"> Hoàn thành</span></td>
                          @elseif($job->status ==2)
                          <td><span style="color: red">Thất bại </span></td>
                          @else
                          <td><span style="color: red"> Đã tạm ngưng</span></td>
                          @endif


                          

                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
          </div>

            <div id="content3" class="tab-pane  fade">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
              <h5> Tổng số căn bán được: {{$num_sale}}</h5>
              @if($num_sale > 0)
             
           </h5>
           <hr>
             @endif
                  <table id="example" class="nvr-table">
                  <thead>
                    <tr class="thead">
                       
                        <th>Mã bất động sản </th>
                        <th>Giá tiền </th>
                        <th>Hoa Hồng</th>
                        <th>Ngày hoàn thành </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($sale_info as $info)
                        <tr class="color-add">
                          <td>{{$info->name}}</td>
                          <td>{{number_format(floatval($info->price), 0, ",", ".") }} VNĐ</td>

                              <td>{{number_format(floatval($info->gap), 0, ",", ".") }} VNĐ</td>

                          <td>{{$info->date}}
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <hr><br>
                  <h4>Tương tác mạng xã hội</h4>

             <h5> Tổng tương tác: {{$reply}}</h5>
             <h5> Tổng sao: {{$likes}} </h5>
            </div>
          </div>
   <div id="content4" class="tab-pane  fade">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
              <h5> Chi tiết lương hàng tháng</h5>
              
                  <table id="example" class="nvr-table">
                  <thead>
                    <tr class="thead">
                       
                        <th>Lương </th>
                        <th>Hoa hồng </th>
                        <th>Thưởng </th>
                        <th>Phạt </th>
                        <th>Bào hiểm </th>
                        <th>Thực lĩnh </th>
                        <th>Thời gian </th>

                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($salary as $user)
                        <tr class="color-add">
                          <td><div><a > {{number_format($user->salary, 0, ",", ".") }} VND</a>
                                <span id="salary{{$user->id}}" style="display: none">{{$user->salary}}</span>
                              </td>

                              <td><div><a id="gap{{$user->id}}">   @if($user->gap > 0)
                              {{number_format($user->gap, 0, ",", ".") }} VND
                              @else
                              Không 
                              @endif</a></td>

                              <td><div><a> {{number_format($user->kpi, 0, ",", ".") }} VND</a>
                                <span id="kpi{{$user->id}}" style="display: none">{{$user->kpi}}</span>
                              </td>
                              <td><div><a> {{number_format($user->penalty, 0, ",", ".") }} VND</a>

                                <span id="penalty{{$user->id}}" style="display: none">{{$user->penalty}}</span>
                              </td>


                                <td></td>

                                <td>
                                   @if($user->gap > 0)
                                  {{number_format($user->salary +$user->kpi + $user->gap + $user->penalty, 0, ",", ".") }} 
                                  @else

                                  {{number_format($user->salary +$user->kpi  + $user->penalty, 0, ",", ".") }}
                                  @endif

                                VND</td>

                                  <td>{{$user->month}}/{{$user->year}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
          </div>
           
        </div>
      </div>
    </div>
    </div>
	<!-- end model --->
<!-- Modal -->

      <div class="modal fade modol-text" id="new-edge" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Tạo sự kiện </label>
              </div>
              <div class="notification"></div>
              <form action="hr/add-new-staff-event" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="{{$id}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Sự kiện </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text" id="name" required=""></td>
                            </tr>
 <tr>
    <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea  name="des" class="ckeditor form-control input-edit modol-text"  required="" id=""></textarea></td>
                        </tr>


                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="date" id="new_date" required=""></td>
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

        <div class="modal fade modol-text" id="EditInfoModal" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Chỉnh sửa thông tin</label>
              </div>
              <div class="notification"></div>
              <form action="hr/edit-staff-event" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="EditId">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Sự kiện </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text" id="EditName" required=""></td>
                            </tr>
<tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea id="EditDes"  name="des" class="ckeditor form-control input-edit modol-text"  required="" id=""></textarea></td>
                        </tr>

                          <tr>
                            <td><i class="fa fa-calendar" aria-hidden="true"></i> Thời gian </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="date" id="EditDate" required=""></td>
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

	<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
    </div>
    <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
     </div>


<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }
  });
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
  $("#search-con-input").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#con-table tbody tr").filter(function() {
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
                  text: " Bạn có muốn xóa khách khôn? ",
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

document.getElementById('new_date').valueAsDate = new Date();

    $('#example').DataTable({
        "paging":   false,
        "info":     false,
        "searching": false
      });

    function updateInfo(id){
          document.getElementById("EditId").value = id
          document.getElementById("EditName").value = document.getElementById("name"+id).innerHTML
          document.getElementById("EditDate").value = document.getElementById("date"+id).innerHTML

           var des = document.getElementById("des"+id).innerHTML
    // $("#EditDes").val(des);

          CKEDITOR.instances.EditDes.setData( document.getElementById("des"+id).innerHTML, function()
{
    this.checkDirty();  // true

        $("#EditInfoModal").modal()

});
}

  </script>

@endsection
