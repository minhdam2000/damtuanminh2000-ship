
 @extends('../layouts/index')
@section('content')
    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-right" style="display: inline;">
                <a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i>Quản lý hạng mục tài chính</h6></a>
                
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
          data-toggle="tab" role="tab" href="#content1">Hạng mục thu</a>
      </li>

       <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content2">Hạng mục chi</a>
      </li>

     <li class="nav-item margin_center">
      </li>
    
    </ul>  
    <hr>

        <div class="tab-content">

          <div id="content1" class="tab-pane in active">
              <form action="gen/delete-mul-step-task" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">


                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;</div>
                      <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-task"><i class="fa fa-plus" aria-hidden="true"></i>Thêm hang mục</button></div>

                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;</div>
                  
                      <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>
                     

                      <div class="search-input proxy-add" title="Serach">
                        <input type="text" class="textbox" id="search-input" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div>

                  <table id="camera-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            
                            <th>ID </th>
                            <th> Hạng mục</th>
                            <th></th>
                            <!-- <th></th> -->
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($inputs as $info)
                            <tr class="color-add">
                              
                              <td><div><a id="iid{{$info->id}}"> {{$info->id}}</a></td>
                              <td><div><a id="iname{{$info->id}}"> {{$info->name}}</a></td>

                             
                               <td><button style="color: white"  type="button" onclick="editDetail('{{$info->id}}',0)" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem;"></i></button>

                            </tr>
                          @endforeach
                        </tbody>
                      </table>
              </form>

        </div>

         <div id="content2" class="tab-pane fade">
              <form action="gen/delete-mul-step-task" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">


                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;</div>
                      <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-task"><i class="fa fa-plus" aria-hidden="true"></i>Thêm hang mục</button></div>

                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;</div>
                  
                      <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>
                     

                      <div class="search-input proxy-add" title="Serach">
                        <input type="text" class="textbox" id="search-input" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div>

                  <table id="camera-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            
                            <th>ID </th>
                            <th> Hạng mục</th>
                            <th></th>
                            <!-- <th></th> -->
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($outputs as $info)
                            <tr class="color-add">
                              
                              <td><div><a id="id{{$info->id}}"> {{$info->id}}</a></td>
                              <td><div><a id="oname{{$info->id}}"> {{$info->name}}</a></td>

                             
                             
                               <td><button style="color: white"  type="button" onclick="editDetail('{{$info->id}}',1)" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem;"></i></button>

                            </tr>
                          @endforeach
                        </tbody>
                      </table>
              </form>

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
                  <label>Sửa hạng mục</label>
              </div>
              <div class="notification"></div>
              <form action="finance/edit-type" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="EditId">
                  <input type="hidden" name="type" value="" id="EditType">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                              <tr>
                                <td class="cam-properties">Tên hạng mục</td>
                                <td>
                                <input class="input-edit modol-text" id="EditName"  name="name" required=""></td>
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
  $(document).ready(function() {
          if($("#notice_success").val() == 1){
            notifiSuccess($("#notice_success").attr("notifi"));
          }
          if($("#notice_warning").val() == 1){
            notifiWarning($("#notice_warning").attr("notifi"));
          }
        });
</script>



@endsection
