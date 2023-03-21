@extends('../layouts/index')
@section('content')
    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6> {{ $substep_name }}</h6>
            </div>
            <div class="header-content-right" style="display: inline;">
                <a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i> Chi tiết nhiệm vụ con </h6></a>
                /
                <h6 class="display-inline">  {{ $substep_name }}</h6>
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
              <form action="gen/delete-mul-substep-task" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="substep_id" value="<?=$id?>">
                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;</div>
                      <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;</div>
                      <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-task"><i class="fa fa-plus" aria-hidden="true"></i>Thêm cơ sở</button></div>

                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;</div>
                      <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-edge"><i class="fa fa-plus" aria-hidden="true"></i>Thêm cơ sở đã có</button></div>
                      
                      <div class="proxy-add" title="Delete"><button type="button" class="camera-button" id="device-remove"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button><button style="display: none;" id="remove-credential" type="submit"></button></div>
                      <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>
                     
   <div class="proxy-add" title="Refresh"><a href="/gen/step-detail/{{$pid}}/{{$sid}}" type="button" class="camera-button" ><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại</a></div>

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
                            
                            <th>Đầu mục </th>
                            <th>Bước</th>
                            <th>STT</th>
                            <th></th>
                            <!-- <th></th> -->
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($supstep_task as $info)
                            <tr class="color-add">
                              <td>
                                <input type="checkbox" id="{{$info->id}}" value="{{$info->id}}" name="{{$info->id}}" class="check-box" />
                                <label for="{{$info->id}}" class="add-cam"></label>
                              </td>
                              <td><div><a id="pname{{$info->id}}"> {{$info->substep_name}}</a></td>
                              <td><div><a id="sname{{$info->id}}"> {{$info->task_name}}</a></td>

                              @if($info->pos > 0)
                              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="pos{{$info->id}}"> {{$info->pos}}</span></a></div></td>
                              @else
                               <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i></a> Không</div></td>
                               <span style="display: none" id="pos{{$info->id}}"> {{$info->pos}}</span>
                              @endif
                               <td><button style="color: white"  type="button" onclick="editDetail('{{$info->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem;"></i></button>


                                 <a style="color: white"  type="button" href="gen/task-detail/{{$info->tid}}" class="btn btn-del Disable"><i class="fa fa-list" aria-hidden="true" style="font-size: 1.2rem;"></i></a>


                                    <a style="color: white"  type="button" href="/process/admin-file/{{$pid}}/{{$sid}}/{{$info->sid}}/{{$info->tid}}" class="btn btn-del Disable"><i class="fa fa-folder-open" aria-hidden="true" style="font-size: 1.2rem;"></i></a>


<!--                               <td><button type="button" onclick="editDetail('{{$info->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem; color: white;"></i></button></td> -->
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
              </form>
          </div>
        </div>



    </div>
    <!-- Modal -->


     <div class="modal fade" id="infomation" role="dialog">
          <div class="modal-dialog" style="max-width: 750px;">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="notification"></div>
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="modal-body" style="padding-left: 25px; padding-right: 25px;">
                    <table id="camera-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>ID</th>
                            <th>IP Address</th>
                            <th>Type</th>
                            <th>Date created</th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                        
                        </tbody>
                      </table>
                  </div>
            </div>
          </div>
      </div>


<div class="modal fade modol-text" id="new-task" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm nhiệm vụ</label>
              </div>
              <div class="notification"></div>
              <form action="gen/add-new-substep-task2" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="step_id" value="{{$id}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                              <tr>
                                <td class="cam-properties">Cơ sở pháp lý</td>
                                <td>
                                <input class="input-edit modol-text"  name="task" required=""></td></td>
                            </tr>
                             <tr>
                                <td class="cam-properties">Nơi cấp: </td>
                                <td>
                                <input class="input-edit modol-text"  name="type" required=""></td>
                            </tr>

                           <tr>
                                <td class="cam-properties">Bước: </td>
                                <td>
                                <input class="input-edit modol-text"  name="pos" required=""></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal"> Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>

      <div class="modal fade modol-text" id="new-edge" role="dialog">
          <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 55%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm nhiệm vụ</label>
              </div>
              <div class="notification"></div>
              <form action="gen/add-new-substep-task" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="{{$id}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                              <tr>
                                <td class="cam-properties">Thêm</td>
                                <input type="hidden" name="process_id" value="<?=$id?>">
                                <td><select name="task" class="custom-select select-profile  browser-default"  data-live-search="true" id="taskselect">
                                @foreach($task as $task)
                                  <option value="<?=$task->id?>"><?=$task->name?></option>
                                @endforeach
                                </select></td>
                            </tr>
                              <tr>
                                <td class="cam-properties"> STT </td>
                                <td><input type="" value="" name="pos" class="input-edit modol-text"  required="" ></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal"> Thoát </button>
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
              <form action="gen/edit-substep-task" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="EditId">
                  <input type="hidden" name="process_id" value="<?=$id?>">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Quy trình: </td>
                                <td id="" class="cam-properties">
 <input class="input-edit modol-text" id="pInfo"  name="pname" ></td>
                                 </td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Nhiệm vụ: </td>

                                <td  id="" class="cam-properties"> 

                                 <input class="input-edit modol-text" id="sInfo"  name="sname"></td>
                                 
                                 </td>
                            </tr>
                                <td class="cam-properties">STT: </td>
                                <td>
                                <input class="input-edit modol-text" id="posInfo"  name="pos"></td>
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

      <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Notifition</h6>
      </div>
      <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning</h6>
      </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  
  $('#taskselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});


</script>

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
   $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });
   
  function confirm_remove() {
          var remove = document.getElementById('device-remove');
          remove.addEventListener('click', function(e){
              swal({
                  title: "",
                  text: " bạn có chắc muốn xóa? ",
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

function editDetail(id){
  document.getElementById("EditId").value = id
  document.getElementById("pInfo").value = document.getElementById("pname"+id).innerHTML
  document.getElementById("sInfo").value = document.getElementById("sname"+id).innerHTML
  document.getElementById("posInfo").value = document.getElementById("pos"+id).innerHTML
$("#EditInfoModal").modal()

}
</script>



@endsection
