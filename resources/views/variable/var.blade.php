@extends('../layouts/index')
@section('content')
    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6>Quản lý cấu hình</h6>
            </div>
            <div class="header-content-right" style="display: inline;">
                <h6 class="display-inline">Quản lý cấu hình</h6>
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
              <form action="/delete-mul-config" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;Danh sách cấu hình</div>
                      <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-edge"><i class="fa fa-plus" aria-hidden="true"></i> Cấu hình mới </button></div>
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
                            <th>Tên</th>
                            <th>Giá trị</th>

                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($config as $config)
                            <tr class="color-add">
                              <td>
                                <input type="checkbox" id="{{$config->id}}" value="{{$config->id}}" name="{{$config->id}}" class="check-box" />
                                <label for="{{$config->id}}" class="add-cam"></label>
                              </td>
                              <td><div><a> <i class="fa fa-cog" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="cname{{$config->id}}"> {{$config->cname}}</span></a></td>
                                <td><span id="value{{$config->id}}"> {{$config->value}}</span></td>
                               

                              
                              <td>
                         

                                <button style="color: white"  type="button" onclick="updateInfo('{{$config->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem;"></i></button>
                             
                            </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </form>
          </div>
        </div>



    </div>
    <!-- Modal -->

       <div class="modal fade modol-text" id="new-edge" role="dialog">
          <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 55%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm cấu hình</label>
              </div>
              <div class="notification"></div>
              <form action="add-config" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                                <td class="cam-properties">Tên: </td>
                                
                                <td><input type="" value="" name="name" class="input-edit modol-text"  required="" id=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Biến: </td>
                                
                                <td><input type="" value="" name="var" class="input-edit modol-text"  required="" id=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Giá trị: </td>
                                
                                <td><input type="" value="" name="value" class="input-edit modol-text"  required="" id=""></td>
                            </tr>
                            <td></td>
                                <td>

                                  <select name="dept_id" class="custom-select select-profile  browser-default"  data-live-search="true" id="taskselect">
                                @foreach($department as $department)
                                  <option value="<?=$department->id?>"><?=$department->name?></option>
                                @endforeach
                                </select></td>
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

         <div class="modal fade modol-text" id="edit-edge" role="dialog">
          <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 55%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Sửa thông tin</label>
              </div>
              <div class="notification"></div>
              <form action="edit-config-value" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" id="idInput" value="">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                           
                            <tr>
                                <td class="cam-properties">Giá trị: </td>
                                
                                <td><input type="" value="" name="value" class="input-edit modol-text"  required="" id="valueInput"></td>
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


      <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Notifition</h6>
      </div>
      <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning</h6>
      </div>

<div class="modal fade modol-text" id="ConsumerInfoModal" role="dialog">
  <div class="modal-dialog model-right" >
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label>Danh sách giao dịch</label>
      </div>
      <div class="notification"></div>
      <form action="add-history-zone"  enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="modal-body">
           <h5> Họ tên: <span id="ConsumerName"></span></h5>
           <h5> Số điện thoai: <span id="ConsumerPhone"></span></h5>
                      <div class="search-input proxy-add" title="Serach">
                        <input type="text" class="textbox" id="search-input" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div>
<table id="zone-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Tên căn hộ </th>
                            <th>Trạng thái</th>
                          </tr>
                        </thead>
                        <tbody class="tbody" id="consumerInfo">

                        </tbody>
                      </table>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  
  document.getElementById("taskselect2").innerHTML = document.getElementById("taskselect").innerHTML
  $('#taskselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});

  $('#taskselect2').selectpicker({
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


<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
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

function updateInfo(id){
          document.getElementById("idInput").value = id
          document.getElementById("valueInput").value = document.getElementById("value"+id).innerHTML


        $("#edit-edge").modal()

}


    function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }
</script>
@endsection
