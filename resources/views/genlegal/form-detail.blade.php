 @extends('../layouts/index')
@section('content')
    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6> {{ $legal->name }}</h6>
            </div>
            <div class="header-content-right" style="display: inline;">
                <a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i> Chi tiết biểu mẫu</h6></a>
                /
                <h6 class="display-inline">  {{ $legal->name }}</h6>
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

        <div class="tab-content">

          <div id="content1" class="tab-pane  in active">
              <form action="genlegal/delete-mul-form-detail" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="substep_id" value="<?=$id?>">
                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;</div>
                      <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-edge"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</button></div>
                      
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
                            <th>Biểu mẫu</th>
                            <th>Phòng ban</th>
                            <!-- <th></th> -->
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($roles as $role)
                            <tr class="color-add">
                              <td>
                                <input type="checkbox" id="{{$role->id}}" value="{{$role->id}}" name="{{$role->id}}" class="check-box" />
                                <label for="{{$role->id}}" class="add-cam"></label>
                              </td>
                              <td><div><a id="lname{{$role->id}}"> {{$role->lname}}</a></td>
                              <td><div><a id="dname{{$role->id}}"> {{$role->dname}}</a></td>


                            </tr>
                          @endforeach
                        </tbody>
                      </table>
              </form>

        </div>

          </div>
        </div>



    </div>

 <div class="tab-content modal-body">
                  <div id="InfoContent" class="tab-pane  in active">
                  </div>
                  <div id="proInfoContent"  class="tab-pane fade" >
                  </div>
                </div>
            </div>
          </div>
      </div>

      <div class="modal fade modol-text" id="new-edge" role="dialog">
          <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 55%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm</label>
              </div>
              <div class="notification"></div>
              <form action="genlegal/add-new-form-detail" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="{{$id}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                              <tr>
                                <td class="cam-properties">Thêm</td>
                                <td><select name="dept_id" class="custom-select select-profile  browser-default"  data-live-search="true" id="taskselect">
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


         <div class="modal fade modol-text" id="EditInfoModal" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Chỉnh sửa thông tin</label>
              </div>
              <div class="notification"></div>
              <form action="genlegal/add-new-form-detail" method="POST">
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
              <form action="genstaff/add-new-step-substep" method="POST" enctype="multipart/form-data">
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
              <form action="genstaff/edit-step-substep" method="POST">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  
  $('#taskselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});


</script>

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
