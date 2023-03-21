
 @extends('../layouts/index')
@section('content')
    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6> {{ $step_name }}</h6>
            </div>
            <div class="header-content-right" style="display: inline;">
                <a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i> Chi tiết nhiệm vụ </h6></a>
                /
                <h6 class="display-inline">  {{ $step_name }}</h6>
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
                <ul class="nav nav-tabs" id="tabs" role="tablist">
     <!--  <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content1">Khung pháp lý</a>
      </li> -->
     <li class="nav-item margin_center">
      </li>
    
    </ul>  
    <hr>

        <div class="tab-content">

          <div id="content1" class="tab-pane fade">
              <form action="gen/delete-mul-step-task" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="substep_id" value="<?=$id?>">


                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;</div>
                      <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-task"><i class="fa fa-plus" aria-hidden="true"></i>Thêm cơ sở</button></div>

                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;</div>
                      <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-edge"><i class="fa fa-plus" aria-hidden="true"></i>Thêm cơ sở đã có</button></div>
                      
                      <div class="proxy-add" title="Delete"><button type="button" class="camera-button" id="device-remove"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button><button style="display: none;" id="remove-credential" type="submit"></button></div>
                      <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>
                     

                      <div class="search-input proxy-add" title="Serach">
                        <input type="text" class="textbox" id="search-input" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div>

                  <table id="camera-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th class="check-all">
                              <input type="checkbox" id="select-all" value="select-all"  name="select-all" onclick="checkAll();" />
                              <label for="select-all" class="display-inline" id="label-all"></label>
                              <label class="display-inline"></label>
                             </th>
                            <
                            <th>Đầu mục </th>
                            <th>Bước</th>
                            <th>STT</th>
                            <th></th>
                            <!-- <th></th> -->
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($step_task as $info)
                            <tr class="color-add">
                              <td>
                                <input type="checkbox" id="{{$info->id}}" value="{{$info->id}}" name="{{$info->id}}" class="check-box" />
                                <label for="{{$info->id}}" class="add-cam"></label>
                              </td>
                              <td><div><a id="pname{{$info->id}}"> {{$info->step_name}}</a></td>
                              <td><div><a id="sname{{$info->id}}"> {{$info->task_name}}</a></td>

                               @if($info->pos > 0)
                              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="pos{{$info->id}}"> {{$info->pos}}</span></a></div></td>
                              @else
                               <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i></a> Không</div></td>
                               <span style="display: none" id="pos{{$info->id}}"> {{$info->pos}}</span>
                              @endif
                               <td><button style="color: white"  type="button" onclick="editDetail('{{$info->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem;"></i></button>

                              <a style="color: white"  type="button" href="gen/task-detail/{{$info->tid}}" class="btn btn-del Disable"><i class="fa fa-list" aria-hidden="true" style="font-size: 1.2rem;"></i></a>
<!--                               <td><button type="button" onclick="editDetail('{{$info->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem; color: white;"></i></button></td> -->
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
              </form>

        </div>
  <div id="content2" class="tab-pane  in active">
          <div class="active-view" id="menu1"> 
            <form action="gen/delete-mul-step-substep" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="step_id" value="{{$id}}">
                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;</div>
                      <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-substep"><i class="fa fa-plus" aria-hidden="true"></i>Thêm nhiệm vụ</button></div>

                      <div class="proxy-add" title="Delete"><button type="button" class="camera-button" id="step-remove"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button><button style="display: none;" id="remove-step" type="submit"></button></div>

                      <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>


                      <div class="proxy-add" title="Refresh"><a href="/gen/process-detail/{{$pid}}" type="button" class="camera-button" ><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại</a></div>
                     

                      <div class="search-input proxy-add" title="Serach">
                        <input type="text" class="textbox" id="search-input-step" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div>

                  <table id="step-table" class="nvr-table">
                 <thead>
                        <tr class="thead">
                               <th class="check-all">
                              <input type="checkbox" id="select-all" value="select-all"  name="select-all" onclick="checkAll();" />
                              <label for="select-all" class="display-inline" id="label-all"></label>
                              <label class="display-inline"></label>
                             </th>
                            <th style="width: 35%">Đầu mục</th>
                            <th style="width: 35%">Ưu tiên</th>
                            <th style="width: 10%">STT</th>
                            <th style="width: 20%"></th>
                            <!-- <th></th> -->
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($substep as $info)
                            <tr class="color-add">
                          <td>
                                <input type="checkbox" id="{{$info->id}}" value="{{$info->id}}" name="{{$info->id}}" class="check-box" />
                                <label for="{{$info->id}}" class="add-cam"></label>
                              </td>
                              <td><div><a id="pname{{$info->id}}"> {{$step_name}}</a></td>
                              <td><div><a id="name{{$info->id}}"> {{$info->name}}</a>


                                 <div style="display: none" id="tid{{$info->id}}"> {!! $info->id !!}</div>
                                 <div style="display: none" id="des{{$info->id}}"> {!! $info->des !!}</div>
                                <div style="display: none" id="legal{{$info->id}}"> {!! $info->legal !!}</div>
                                <span style="display: none" id="urlfull{{$info->id}}"> {{$info->urlfull}}</span>
                                <span style="display: none" id="urlnonfull{{$info->id}}"> {{$info->urlnonfull}}</span>
                              </td>

                              
                              @if($info->pos > 0)
                              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="pos{{$info->id}}"> {{$info->pos}}</span></a></div></td>
                              @else
                               <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i></a> Không</div></td>
                               <span style="display: none" id="pos{{$info->id}}"> {{$info->pos}}</span>
                              @endif
                               <td><button style="color: white"  type="button" onclick="showInfo('{{$info->id}}')" class="btn btn-del Disable"><i class="fa fa-eye" aria-hidden="true" style="font-size: 1.2rem;"></i></button><button style="color: white"  type="button" onclick="updateInfo('{{$info->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem;"></i></button>

                                 <a style="color: white"  type="button" href="gen/substep-detail/{{$pid}}/{{$id}}/{{$info->id}}" class="btn btn-del Disable"><i class="fa fa-list" aria-hidden="true" style="font-size: 1.2rem;"></i></a>

                            </td>

<!--                               <td><button type="button" onclick="editDetail('{{$info->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem; color: white;"></i></button></td> -->
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                  </form>
            </div>
          </div>

          </div>
        </div>



    </div>
<!-- Modal -->
     <div class="modal fade" id="infomation" role="dialog">
          <div class="modal-dialog" style="max-width: 1000px;">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label id="partitionTitle"><h3>Cơ sở pháp lý</h3></label>
              </div>
              <div class="notification"></div>
                  <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#InfoContent"> Cơ sở pháp luật  </a>
      </li>
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#proInfoContent">Quy trình tổng quan</a>
      </li>
    
    </ul>  

 <div class="tab-content modal-body">
                  <div id="InfoContent" class="tab-pane  in active">
                  </div>
                  <div id="proInfoContent"  class="tab-pane fade" >
                  </div>
                </div>
            </div>
          </div>
      </div>
 <div class="modal fade modol-text" id="new-task" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm cơ sở</label>
              </div>
              <div class="notification"></div>
              <form action="gen/add-new-step-task2" method="POST">
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
                  <label>Thêm cơ sở</label>
              </div>
              <div class="notification"></div>
              <form action="gen/add-new-step-task" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="step_id" value="{{$id}}">
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
              <form action="gen/edit-step-task" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="IdInfo">
                  <input type="hidden" name="step_id" value="{{$id}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Quy trình: </td>
                                <td id="pInfo" class="cam-properties"> </td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Nhiệm vụ: </td>
                                <td  id="sInfo" class="cam-properties"> </td>
                            </tr>
                           <tr>
                                <td class="cam-properties"> STT </td>
                                <td><input type="" value="" name="pos" class="input-edit modol-text"  required="" id="posInfo"></td>
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


  <div class="modal fade modol-text" id="new-substep" role="dialog">
          <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 55%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Tạo nhiệm vụ con </label>
              </div>
              <div class="notification"></div>
              <form action="gen/add-new-step-substep" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="step_id" value="{{$id}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit"><tr>
                                <td class="cam-properties">Tên </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text"  required=""></td>
                            </tr>
                            
                            <tr>
                                <td class="cam-properties">Cơ sở pháp lý </td>
                                <td><textarea type="" value="" name="des" class="ckeditor form-control input-edit modol-text" id="name" required=""></textarea></td>
                            </tr>
                             <tr>
                                <td class="cam-properties">STT</td>
                                <td><input type="" value="" name="pos" class="input-edit modol-text"  required="" ></td>
                            </tr>

                            <tr>
                                <td class="cam-properties">Quy trình đủ điều kiện </td>
                                <td>
<label  class="preview" for="file-input"><img onclick="openfileupload(1)"  src="/js-css/img/icon/upload.png"></label><input id= "inputfile1" style="display:none" value = "Tải lên" type="file" name="file1" class="custom-file-input" >
                              </td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Quy trình thiểu điều kiện  </td>
                                <td><label  class="preview" for="file-input"><img onclick="openfileupload(2)"  src="/js-css/img/icon/upload.png"></label><input id= "inputfile2" style="display:none" value = "Tải lên" type="file" name="file2" class="custom-file-input" ></td>
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
      <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Notifition</h6>
      </div>
      <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning</h6>
      </div>


      <div class="modal fade modol-text" id="EditSubstepModal" role="dialog">
          <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 55%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Chỉnh sửa thông tin</label>
              </div>
              <div class="notification"></div>
              <form action="gen/edit-step-substep" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="EditId">
                  <input type="hidden" name="step_id" value="{{$id}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit"><tr>
                                <td class="cam-properties">Tên </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text"  required="" id="EditName"></td>
                           <tr>

                            <tr>
                                <td class="cam-properties">Cơ sở pháp lý </td>
                                <td><textarea  name="des" class="ckeditor form-control input-edit modol-text"  required="" id="EditDes"></textarea></td>
                            </tr>
                           



                             <tr>
                                <td class="cam-properties">STT</td>
                                <td><input type="" value="" name="pos" class="input-edit modol-text"  required="" id="EditPos"></td>
                            </tr>

                            <tr>
                                <td class="cam-properties">Quy trình đủ điều kiện </td>
                                <td>
<label  class="preview" for="file-input"><img onclick="openfileupload(1)"  src="/js-css/img/icon/upload.png"></label><input id= "inputfile1" style="display:none" value = "Tải lên" type="file" name="file1" class="custom-file-input" >
                              </td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Quy trình thiểu điều kiện  </td>
                                <td><label  class="preview" for="file-input"><img onclick="openfileupload(2)"  src="/js-css/img/icon/upload.png"></label><input id= "inputfile2" style="display:none" value = "Tải lên" type="file" name="file2" class="custom-file-input" ></td>
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


<script src="/js-css/js/bootstrap-select.min.js"></script>
<script src="/js-css/js/ckeditor/ckeditor.js"></script>

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
$("#search-input-step").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#step-table tbody tr").filter(function() {
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
        

         var remove = document.getElementById('step-remove');
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
                    document.getElementById("remove-step").click();
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
  document.getElementById("IdInfo").value = id
  document.getElementById("pInfo").innerHTML = document.getElementById("pname"+id).innerHTML
  document.getElementById("sInfo").innerHTML = document.getElementById("sname"+id).innerHTML
  document.getElementById("posInfo").value = document.getElementById("pos"+id).innerHTML
$("#EditInfoModal").modal()

}


function updateInfo(id){
  document.getElementById("EditId").value = id
  document.getElementById("EditName").value = document.getElementById("name"+id).innerHTML
  console.log(document.getElementById("pos"+id).innerHTML)
  document.getElementById("EditPos").value = document.getElementById("pos"+id).innerHTML
CKEDITOR.instances.EditDes.setData( document.getElementById("des"+id).innerHTML, function()
{
    this.checkDirty();  // true
});        

        $("#EditSubstepModal").modal()



}
function showInfo(id){
  console.log(document.getElementById("des"+id).innerHTML)
        document.getElementById("InfoContent").innerHTML = '<div>'+document.getElementById("des"+id).innerHTML+'</div><div>'+document.getElementById("legal"+id).innerHTML+'</div>'


  html = ""
  if (document.getElementById("urlfull"+id).innerHTML != " ")
    html = html + "<img style='width: 100%;' src= '"+document.getElementById("urlfull"+id).innerHTML +"'><hr>"


  if (document.getElementById("urlnonfull"+id).innerHTML  != " ")
    html = html + "<img style='width: 100%;' src= '"+ document.getElementById("urlnonfull"+id).innerHTML +"'><hr>"

  console.log(html)
  document.getElementById("proInfoContent").innerHTML = html

        $("#infomation").modal()
}


    function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }

</script>



@endsection
