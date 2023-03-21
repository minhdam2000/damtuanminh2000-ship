@extends('../layouts/index')
@section('content')
    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6></h6>
            </div>
            <div class="header-content-right" style="display: inline;">
                <a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i>  </h6></a>
                
                <h6 class="display-inline">Dánh sách nhà thầu</h6>
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
              <form action="delete-mul-consumer" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;Danh sách nhà thầu</div>
                      <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-edge"><i class="fa fa-plus" aria-hidden="true"></i> Nhà thầu mới </button></div>
                      <div class="proxy-add" title="Delete"><button type="button" class="camera-button" id="device-remove"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button><button style="display: none;" id="remove-credential" type="submit"></button></div>
                      <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>
                     
<!-- 
                      <div class="search-input proxy-add" title="Serach">
                        <input type="text" class="textbox" id="search-input" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div> -->
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
                            <th>Đại diện</th>
                            <th>Số điện thoại </th>
                            <th>Email</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($contractors as $contractor)
                            <tr class="color-add">
                                 <td>
                                <input type="checkbox" id="{{$contractor->id}}" value="{{$contractor->id}}" name="{{$contractor->id}}" class="check-box" />
                                <label for="{{$contractor->id}}" class="add-cam"></label>
                              </td>

                              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="cname{{$contractor->id}}"> {{$contractor->name}}</span></a></td>

                                <td> <span id="cproxy{{$contractor->id}}">{{$contractor->proxy}}</span></a></td>
                                <td><span id="cphone{{$contractor->id}}">{{$contractor->phone}}</span>

                            

                              

                              </td>
                              <td>
                                
                                    <span  id="cemail{{$contractor->id}}">{{$contractor->email}}</span> 

                              </td>
                              
                              <td><button style="color: white"  type="button" onclick="updateInfo('{{$contractor->id}}')"  class="preview" type="button"><img src="/js-css/img/icon/notepad.png"></button></td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
          <button  class="btn btn-model"><a href="/icon/sale/" > Quay lại</a></button>
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
                  <label>Tạo nhà thầu mới </label>
              </div>
              <div class="notification"></div>
              <form action="add-new-contractor" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Tên nhà thầu </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text" id="name" required=""></td>
                            </tr>

                          <tr>
                                <td class="cam-properties">Đại diện </td>
                                <td><input type="proxy" class="input-edit modol-text form-control" name="proxy" id="proxy" required=""></td>
                            </tr>


                            <tr>
                                <td class="cam-properties">Số điện thoại</td>
                                <td><input type="" value="" name="phone" class="input-edit modol-text" id="phone" required=""></td>
                            </tr>

                            <tr>
                                <td class="cam-properties">Email</td>
                                <td><input type="" value="" name="email" class="input-edit modol-text" id="email" required=""></td>
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
              <form action="edit-contractor" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="EditId">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Tên nhà thầu </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text" id="EditName" required=""></td>

                            </tr>
    <tr>
                                <td class="cam-properties">Đại diện </td>
                                <td><input type="" value="" name="proxy" class="input-edit modol-text" id="EditProxy" required=""></td>
                            </tr>

                            <tr>
                                <td class="cam-properties">Số điện thoại </td>
                                <td><input type="" value="" name="phone" class="input-edit modol-text" id="EditPhone" required=""></td>
                            </tr>

                            <tr>
                                <td class="cam-properties">Email</td>
                                <td><input type="" value="" name="email" class="input-edit modol-text" id="EditEmail" required="" Disable></td>
                            </tr>
                  
                          
                            <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>

                                  <a class="btn btn-model" id="EditDelete"> &nbsp;&nbsp; xóa &nbsp;&nbsp; </a>

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
      <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Notifition</h6>
      </div>
      <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning</h6>
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

<script type="text/javascript">
  function loadInfo(id){
     $.ajax({
      type: "GET",
      url: '/consumer-detail/'+id,
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

          if(response[i].state == 1){
            var status = "Đã đặt cọc"
          }else if(response[i].state == 2){
            var status = "Đang thanh toán"

          }else{
            var status = "Đã hoàn thành"

          }
          cell2.innerHTML = '<a href="/sale/view/'+response[i].id+'"> '+status+'</a>'
          
        }
        $("#ConsumerInfoModal").modal()
      }

    });
}

function updateInfo(id){
          document.getElementById("EditId").value = id
          document.getElementById("EditName").value = document.getElementById("cname"+id).innerHTML
          document.getElementById("EditPhone").value = document.getElementById("cphone"+id).innerHTML


          // document.getElementById("editBd").value = document.getElementById("cbd"+id).innerHTML

          document.getElementById("EditEmail").value = document.getElementById("cemail"+id).innerHTML

          document.getElementById("EditProxy").value = document.getElementById("cproxy"+id).innerHTML


          document.getElementById("EditDelete").href = "/contractor-delete/" + id
          // document.getElementById("EditDelete").value = document.getElementById("caddress"+id).innerHTML

        
        $("#EditInfoModal").modal()

}
</script>

  <!-- DataTables -->
  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
  <script type="text/javascript">
    
    $('#camera-table').DataTable();

  </script>
@endsection
