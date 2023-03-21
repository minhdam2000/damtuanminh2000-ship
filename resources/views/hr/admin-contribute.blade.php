@extends('../layouts/index')
@section('content')
    <div class="content-camera">
        <div class="header-content">
            
            <div class="header-content-right" style="display: inline;">
                <a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i> Cấu hình nhà thầu </h6></a>
                /
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
              <form action="hr/delete-mul-admin-contractors" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;</div>
                      <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-edge"><i class="fa fa-plus" aria-hidden="true"></i>Thêm nhà thầu</button></div>
                      <div class="proxy-add" title="Delete"><button type="button" class="camera-button" id="device-remove"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button><button style="display: none;" id="remove-credential" type="submit"></button></div>
                      <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>
                     

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
                            <th>Nhà thầu</th>
                            <th>Người đại diện</th>
                            <th>Số điện thoại</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($infos as $info)
                            <tr class="color-add">
                              <td>
                                <input type="checkbox" id="{{$info->id}}" value="{{$info->id}}" name="{{$info->id}}" class="check-box" />
                                <label for="{{$info->id}}" class="add-cam"></label>
                              </td>
                              <td><a id="name{{$info->id}}"> {{$info->name}}</a></td>
                              <td><a id="proxy{{$info->id}}"> {{$info->proxy}}</a></td>
                              <td><a id="phone{{$info->id}}"> {{$info->phone}}</a></td>
                               <td><button style="color: white"  type="button" onclick="editDetail('{{$info->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem;"></i></button>
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

      <div class="modal fade modol-text" id="new-edge" role="dialog">
          <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 55%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm nhà thầu</label>
              </div>
              <div class="notification"></div>
              <form action="hr/add-new-admin-contractors" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                              <tr>
                                <td class="cam-properties"> Tên </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text"  required="" ></td>
                            </tr>
                              <tr>
                                <td class="cam-properties"> Người đại diện </td>
                                <td><input type="" value="" name="proxy" class="input-edit modol-text"  required="" > </td>
                            </tr>
                             <tr>
                                <td class="cam-properties"> Số điện thoại </td>
                                <td><input type="" value="" name="phone" class="input-edit modol-text"  required="" > </td>
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
              <form action="hr/edit-admin-contractors" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="EditId">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            
                           <tr>
                                <td class="cam-properties">Tên: </td>
                                <td>
                                <input class="input-edit modol-text" id="EditName"  name="name"></td>
                            </tr>
  <tr>
                                <td class="cam-properties">Người đại diện: </td>
                                <td>
                                <input class="input-edit modol-text" id="EditProxy"  name="proxy"></td>
                            </tr>
  <tr>
                                <td class="cam-properties">Số điện thoại: </td>
                                <td>
                                <input class="input-edit modol-text" id="EditPhone"  name="phone"></td>
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
  document.getElementById("EditName").value = document.getElementById("name"+id).innerHTML
  document.getElementById("EditProxy").value = document.getElementById("proxy"+id).innerHTML
  document.getElementById("EditPhone").value = document.getElementById("phone"+id).innerHTML
        $("#EditInfoModal").modal()

}
</script>



@endsection
