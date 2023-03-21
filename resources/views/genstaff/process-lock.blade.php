@extends('../layouts/index')
@section('content')
    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6>Quản lý quy trình</h6>
            </div>
            <div class="header-content-right" style="display: inline;">
                <h6 class="display-inline">Quản lý quy trình</h6>
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
              <form action="/genstaff/delete-mul-process-lock" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;Danh sách quy trình</div>
                      <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-edge"><i class="fa fa-plus" aria-hidden="true"></i> Quy trình mới </button></div>
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
                             <th></th>
                            <th>Tên</th>
                            <th>Tệp tin</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($process as $process)
                            <tr class="color-add">
                              <td>
                                <input type="checkbox" id="{{$process->id}}" value="{{$process->id}}" name="{{$process->id}}" class="check-box" />
                                <label for="{{$process->id}}" class="add-cam"></label>
                              </td>
                              <td>{{$process->id}}</td>
                              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="cname{{$process->id}}"> {{$process->name}}</span></a></td>

                              
                              <td>
                                <a class="preview"  target="_blank"  href = "{{$process->url}}"><img src="/js-css/img/icon/open.png"></a>

                              </td>
                              <td><button style="color: white"  type="button" onclick="updateInfo('{{$process->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem;"></i></button>
                          
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
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Tạo quy trình mới  </label>
              </div>
              <div class="notification"></div>
              <form action="genstaff/add-new-process-lock" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="pid" value="{{$id}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Tên </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text" id="name" required=""></td>
                            </tr>

                <tr>
                <td class="cam-properties">Minh chứng </td>
                  <td><label  class="preview" for="file-input"><img onclick="openfileupload(1)"  src="/js-css/img/icon/upload.png"></label><input id= "inputfile1" style="display:none" type="file" name="file" class="form-control"
                    multiple>
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
      <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Notifition</h6>
      </div>
      <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning</h6>
      </div>


      <div class="modal fade modol-text" id="EditInfoModal" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Chỉnh sửa thông tin</label>
              </div>
              <div class="notification"></div>
              <form action="genstaff/edit-process-lock" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="pid" value="{{$id}}">
                  <input type="hidden" name="id" value="" id="EditId">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Tên </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text" id="EditName" required=""></td>
                            </tr>
    <tr>
                <td class="cam-properties">Minh chứng </td>
                  <td><label  class="preview" for="file-input"><img onclick="openfileupload(2)"  src="/js-css/img/icon/upload.png"></label><input   id= "inputfile2" style="display:none" type="file" name="file" class="form-control"
                    multiple>
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

          function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }


</script>

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
          document.getElementById("EditId").value = id
          document.getElementById("EditName").value = document.getElementById("cname"+id).innerHTML
        $("#EditInfoModal").modal()

}
</script>
@endsection
