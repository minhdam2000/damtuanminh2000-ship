@extends('../layouts/index')
@section('content')

        <link rel="stylesheet" href="js-css/treant/Treant.css">
        <link rel="stylesheet" href="js-css/treant/connectors.css">

        <script src="js-css/treant/vendor/raphael.js"></script>
        <script src="js-css/treant/Treant.js"></script>

    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6>Quản lý phòng ban</h6>
            </div>
            <div class="header-content-right" style="display: inline;">
                <h6 class="display-inline">Quản lý phòng ban</h6>
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
          <a onclick= "" id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#content1">Danh sách</a>
      </li>
      <li class="nav-item margin_center">
          <a onclick= "loadChart()" id="tab2" class="nav-link color-a"  data-toggle="tab" role="tab" href="#content2">Biểu đồ</a>
      </li>
    
    </ul>  
    <hr>
<div class="tab-content">

<div id="content1" class="tab-pane  in active">

              <form action="/hr/delete-mul-admin-department" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;Danh sách phòng ban</div>
                      <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-edge"><i class="fa fa-plus" aria-hidden="true"></i> Phòng ban mới</button></div>
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
                            <th>ID </th>
                            <th>Phòng ban</th>
                            <th>MID</th>
                            <th>HID</th>
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

                              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="id{{$info->id}}"> {{$info->id}}</span></a></div></td>
                              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="name{{$info->id}}"> {{$info->name}}</span></a></div>
                                <span id="des{{$info->id}}" style="display: none">{!! $info->des !!}</span>


                              </td>
                              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="mid{{$info->id}}"> {{$info->mid}}</span></a></div></td> <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="hid{{$info->id}}"> {{$info->hid}}</span></a></div></td>
                              <td>
                             </button><button style="color: white"  type="button" onclick="updateInfo('{{$info->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem;"></i></button>
                              <a style="color: white"  type="button" href="hr/admin-department-info/{{$info->id}}" class="btn btn-del Disable"><i class="fa fa-list" aria-hidden="true" style="font-size: 1.2rem;"></i></a>
                            </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </form>
          </div>
           <div  id="content2" class="tab-pane fade">
  <div class="chart" id="OrganiseChart-big-commpany"></div>
        </div>

        </div>
          

        </div>
       


    </div>
    <!-- Modal -->

      <div class="modal fade modol-text" id="new-edge" role="dialog">
          <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 55%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Tạo nhiệm vụ</label>
              </div>
              <div class="notification"></div>
              <form action="hr/add-new-admin-department" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit"><tr>
                                <td class="cam-properties">Tên </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text"  required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Mô tả </td>

                            <td><textarea  name="des" class="ckeditor form-control input-edit modol-text"  required=""></textarea></td></tr>
                            <tr>
                                <td class="cam-properties">Mid </td>
                                <td><input type="" value="" name="mid" class="input-edit modol-text"  required=""></td>
                            </tr>
  <tr>
                                <td class="cam-properties">Hid </td>
                                <td><input type="" value="" name="hid" class="input-edit modol-text"  required=""></td>
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
          <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 55%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Chỉnh sửa thông tin</label>
              </div>
              <div class="notification"></div>
              <form action="hr/edit-admin-department" method="POST"  enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="EditId">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                          <tr>
                                <td class="cam-properties">Tên </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text"  required="" id="EditName"></td>
                           <tr>
                            <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Mô tả </td>
                            <td><textarea  name="des" class="ckeditor form-control input-edit modol-text"  required="" id="EditDes"></textarea></td>
                        </tr>

                             <tr>
                                <td class="cam-properties">Mid </td>
                                <td><input type="" value="" name="mid" class="input-edit modol-text"  required="" id="EditMid"></td>
                           <tr>

     <tr>
                                <td class="cam-properties">Hid </td>
                                <td><input type="" value="" name="hid" class="input-edit modol-text"  required="" id="EditHid"></td>
                           <tr>

                      

            
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

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  
  $('#stepselect').selectpicker({
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
          document.getElementById("EditName").value = document.getElementById("name"+id).innerHTML
          document.getElementById("EditMid").value = document.getElementById("mid"+id).innerHTML
           document.getElementById("EditHid").value = document.getElementById("hid"+id).innerHTML

 var des = document.getElementById("des"+id).innerHTML
    // $("#EditDes").val(des);

          CKEDITOR.instances.EditDes.setData( document.getElementById("des"+id).innerHTML, function()
{
    this.checkDirty();  // true
});  
        $("#EditInfoModal").modal()
  

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
    
    function openeditfileupload(id){
            document.getElementById("editfile"+id).click();
    }
</script>

<script>
function loadChart(){

     setTimeout(function(){
    new Treant( chart_config ); }, 300);
}
  </script>

@endsection
