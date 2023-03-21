
 @extends('../layouts/index')
@section('content')
    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-right" style="display: inline;">
                <a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i>Quản lý hoa hồng</h6></a>
                
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
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content1">Hoa hồng tháng này</a>
      </li>

       
     <li class="nav-item margin_center">
      </li>
    
    </ul>  
    <hr>

        <div class="tab-content">

          <div id="content1" class="tab-pane in active">
                <input type="hidden" name="_token" value="{{csrf_token()}}">


              
                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;</div>
                  
                     <div class="proxy-add" title="New Edge"><button  type="button" class=" form-control " style="background-color: red;color: white" ><a href="/finance/salary" > Quay lại</a></button>
</div>
                      <div class="proxy-add" title="Refresh"><button  type="button"  class=" form-control " style="background-color: red;color: white" onclick="location.reload();"> Tải lại</button></div>

<br><hr><br>
                  <table id="table1" class="nvr-table">
                        <thead>
                        <tr class="thead">
                           
                            <th>Tên nhân viên </th>
                            <th>Chức vụ</th>
                            <th>Lương</th>
                            <th>Hoa hồng</th>
                            <th>Thưởng</th>
                            <th>Phạt</th>
                            <th>Bảo hiểm</th>
                            <th>Thực lĩnh</th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($users_near as $user)
                            <tr class="color-add">
                              
                              <td><div><a id="name{{$user->id}}"> {{$user->name}}</a></td>
                              <td><div><a id="role{{$user->id}}"> {{$user->rname}} - {{$user->dname}}</a></td>

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
                        
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                  
        </div>

         
  


          </div>
        </div>



    </div>
<!-- Modal -->
 <div class="modal fade modol-text" id="infomation" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label id="partitionTitle"><h3>Thông tin chi tiết</h3></label>
              </div>
              <div class="notification"></div>

 <div class="tab-content modal-body">
                  <div id="InfoContent" class="tab-pane  in active">
                  </div>

                    <table id="con-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Tên căn hộ </th>
                            <th>Hoa hồng</th>
                            <th>Ngày đặt</th>
                            <th>Trạng thái</th>
                          </tr>
                        </thead>
                        <tbody class="tbody" id="zoneInfo">

                        </tbody>
                      </table><br><hr><br>

                                                        <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal"> Thoát </button>

                  </div>
            </div>
          </div>
      </div>
 <div class="modal fade modol-text" id="new-task" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm hạng mục</label>
              </div>
              <div class="notification"></div>
              <form action="finance/add-type" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                              <tr>
                                <td class="cam-properties">Tên hạng mục</td>
                                <td>
                                <input class="input-edit modol-text"  name="name" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Loại</td>
                               <td><select name="type" class="custom-select select-profile  browser-default"  data-live-search="true" id="taskselect">
                                  <option value="0">Hạng mục thu</option>
                                  <option value="1">Hạng mục chi</option>
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

 <div class="modal fade modol-text" id="EditInfoModal" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Sửa thông tin</label>
              </div>
              <div class="notification"></div>
              <form action="finance/edit-salary" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="EditId">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                              <tr>
                                <td class="cam-properties">Tên nhân viên</td>
                                <td>
                                  <span id="EditName"></span>
                               
                              </td>
                            </tr>
                           <tr>
                                <td class="cam-properties">Chức vụ</td>
                                <td>
                                  <span id="EditRole"></span>
                               
                              </td>
                            </tr>
                             <tr>
                                <td class="cam-properties">Lương</td>
                                <td>

                                   <input type="" value="" id="EditSalaryDisplay" name="" class="input-edit create-user modol-text" required="salary" onblur="formatForId('EditSalary')">
                              <input value="0" style="display:none" type="number" id="EditSalary" name="salary"> 


                              </td>
                            </tr>
                                <tr>
                                <td class="cam-properties">Thưởng</td>
                                <td>

                                  <input type="" value="" id="EditKpiDisplay" name="" class="input-edit create-user modol-text" required="kpi" onblur="formatForId('EditKpi')">
                              <input value="0" style="display:none" type="number" id="EditKpi" name="kpi"> 

                              </td>
                            </tr>
                             <tr>
                                <td class="cam-properties">Phạt</td>
                                <td>

                                  <input type="" value="" id="EditPenaltyDisplay" name="penalty" class="input-edit create-user modol-text" required="" onblur="formatForId('EditPenalty')">
                              <input value="0" style="display:none" type="number" id="EditPenalty" name="penalty"> 
                              </td>
                            </tr>


                           
                            <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>

                                     <a  class="btn btn-model" id="deleteButton"> &nbsp;&nbsp; Xóa &nbsp;&nbsp; </a>

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


      <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Notifition</h6>
      </div>
      <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning</h6>
      </div>


<script src="/js-css/js/bootstrap-select.min.js"></script>
<script src="/js-css/js/ckeditor/ckeditor.js"></script>

<script type="text/javascript">


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

function editDetail(id,type){
  document.getElementById("EditId").value = id
  document.getElementById("EditType").value = type
  if(type == 0){
  document.getElementById("EditName").value = document.getElementById("iname"+id).innerHTML
}else{
  document.getElementById("EditName").value = document.getElementById("oname"+id).innerHTML
}  
  document.getElementById("deleteButton").href = "finance/delete-type/"+type+"/"+id


$("#EditInfoModal").modal()

}


function updateInfo(id){
  document.getElementById("EditId").value = id
  document.getElementById("EditName").innerHTML = document.getElementById("name"+id).innerHTML
  document.getElementById("EditRole").innerHTML = document.getElementById("role"+id).innerHTML

  // console.log(document.getElementById("salary"+id).innerHTML)

  document.getElementById("EditSalaryDisplay").value = parseFloat(document.getElementById("salary"+id).innerHTML)


  document.getElementById("EditPenaltyDisplay").value = parseFloat(document.getElementById("penalty"+id).innerHTML)


  document.getElementById("EditKpiDisplay").value = parseFloat(document.getElementById("kpi"+id).innerHTML)

  formatForId("EditSalary")
  formatForId("EditPenalty")
  formatForId("EditKpi")

  $("#EditInfoModal").modal()



}
function showInfo(id){
        document.getElementById("InfoContent").innerHTML = '<h3>Tên nhân viên: '+document.getElementById("name"+id).innerHTML+'</h3><h3>Chức vụ: '+document.getElementById("role"+id).innerHTML+'</h3><h3>Hoa hồng: '+document.getElementById("gap"+id).innerHTML+'</h3>'
  $.ajax({
      type: "GET",
      url: 'finance/human-detail/'+id,
      success: function (response) {

          $("#zoneInfo").empty();
        console.log("process list")
          var table = document.getElementById("zoneInfo"); 
        response = (JSON.parse(response))
        console.log(response)

        for (var i = 0;i < response.length;i++){
            var row = table.insertRow();
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);
          var cell4 = row.insertCell(3);
          cell1.innerHTML = response[i].name

          var gap = response[i].gap
          gap = parseFloat(gap.replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

          cell2.innerHTML = gap + " VND"


          cell3.innerHTML = response[i].date

          if(response[i].state == 1){
            var status = "Đã đặt cọc"
          }else if(response[i].state == 2){
            var status = "Đang thanh toán"

          }else{
            var status = "Đã hoàn thành"

          }
          cell4.innerHTML = '<a href="/sale/view/'+response[i].id+'"> '+status+'</a>'
          
        }
      }

    });


        $("#infomation").modal()
}


    function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }

</script>

  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
  <script>
      $(document).ready(function() {
          if($("#notice_success").val() == 1){
            notifiSuccess($("#notice_success").attr("notifi"));
          }
          if($("#notice_warning").val() == 1){
            notifiWarning($("#notice_warning").attr("notifi"));
          }
        });
      
    $('#table1').DataTable();

    function formatForId(id){
    var value = document.getElementById(id+"Display").value
    value = parseFloat(value.replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    console.log(value)
    console.log(value.replace(/,/g, ""))
    document.getElementById(id+"Display").value = value
    
    document.getElementById(id).value = value.replace(/,/g, "") 
}
function salaryHistory(){
  var month = document.getElementById("month").value
  var year =  document.getElementById("year").value

   window.location.href= "/finance/salary-detail/"+year+"/"+month
}
  </script>





@endsection
