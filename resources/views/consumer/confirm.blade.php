@extends('../layouts/index')
@section('content')


<style type="text/css">
  @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
      .label-info{
            background-color: red!important;

        }
        
        .bootstrap-tagsinput{
          width: 100%;
        }
        .label {
            color: white;
            position: inherit;
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,
            border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    pointer-events: all;
        }
        .GoogleContent iframe{

    width: 100%;
    min-height: 400px;
      }
</style>

<style type="text/css">
  table.dataTable>thead .sorting,table.dataTable>thead .sorting_asc,table.dataTable>thead .sorting_desc,table.dataTable>thead .sorting_asc_disabled,table.dataTable>thead .sorting_desc_disabled{cursor:pointer;position:relative}table.dataTable>thead .sorting:before,table.dataTable>thead .sorting:after,table.dataTable>thead .sorting_asc:before,table.dataTable>thead .sorting_asc:after,table.dataTable>thead .sorting_desc:before,table.dataTable>thead .sorting_desc:after,table.dataTable>thead .sorting_asc_disabled:before,table.dataTable>thead .sorting_asc_disabled:after,table.dataTable>thead .sorting_desc_disabled:before,table.dataTable>thead .sorting_desc_disabled:after{position:absolute;bottom:.9em;display:block;opacity:.3}table.dataTable>thead .sorting:before,table.dataTable>thead .sorting_asc:before,table.dataTable>thead .sorting_desc:before,table.dataTable>thead .sorting_asc_disabled:before,table.dataTable>thead .sorting_desc_disabled:before{right:1em;content:"↑"}table.dataTable>thead .sorting:after,table.dataTable>thead .sorting_asc:after,table.dataTable>thead .sorting_desc:after,table.dataTable>thead .sorting_asc_disabled:after,table.dataTable>thead .sorting_desc_disabled:after{right:.5em;content:"↓"}table.dataTable>thead .sorting_asc:before,table.dataTable>thead .sorting_desc:after{opacity:1}table.dataTable>thead .sorting_asc_disabled:before,table.dataTable>thead .sorting_desc_disabled:after{opacity:0}div.dataTables_scrollHead table.dataTable{margin-bottom:0 !important}div.dataTables_scrollBody>table{border-top:none;margin-top:0 !important;margin-bottom:0 !important}div.dataTables_scrollBody>table>thead .sorting:before,div.dataTables_scrollBody>table>thead .sorting_asc:before,div.dataTables_scrollBody>table>thead .sorting_desc:before,div.dataTables_scrollBody>table>thead .sorting:after,div.dataTables_scrollBody>table>thead .sorting_asc:after,div.dataTables_scrollBody>table>thead .sorting_desc:after{display:none}div.dataTables_scrollBody>table>tbody tr:first-child th,div.dataTables_scrollBody>table>tbody tr:first-child td{border-top:none}div.dataTables_scrollFoot>.dataTables_scrollFootInner{box-sizing:content-box}div.dataTables_scrollFoot>.dataTables_scrollFootInner>table{margin-top:0 !important;border-top:none}@media screen and (max-width: 767px){div.dataTables_wrapper div.dataTables_length,div.dataTables_wrapper div.dataTables_filter,div.dataTables_wrapper div.dataTables_info,div.dataTables_wrapper div.dataTables_paginate{text-align:center}div.dataTables_wrapper div.dataTables_paginate ul.pagination{justify-content:center !important}}table.dataTable.table-sm>thead>tr>th:not(.sorting_disabled){padding-right:20px}table.dataTable.table-sm .sorting:before,table.dataTable.table-sm .sorting_asc:before,table.dataTable.table-sm .sorting_desc:before{top:5px;right:.85em}table.dataTable.table-sm .sorting:after,table.dataTable.table-sm .sorting_asc:after,table.dataTable.table-sm .sorting_desc:after{top:5px}table.table-bordered.dataTable{border-right-width:0}table.table-bordered.dataTable th,table.table-bordered.dataTable td{border-left-width:0}table.table-bordered.dataTable th:last-child,table.table-bordered.dataTable th:last-child,table.table-bordered.dataTable td:last-child,table.table-bordered.dataTable td:last-child{border-right-width:1px}table.table-bordered.dataTable tbody th,table.table-bordered.dataTable tbody td{border-bottom-width:0}div.dataTables_scrollHead table.table-bordered{border-bottom-width:0}div.table-responsive>div.dataTables_wrapper>div.row{margin:0}div.table-responsive>div.dataTables_wrapper>div.row>div[class^=col-]:first-child{padding-left:0}div.table-responsive>div.dataTables_wrapper>div.row>div[class^=col-]:last-child{padding-right:0}</style>


 <link rel="stylesheet" href="/js/taginputs/bootstrap-tagsinput.css"  />

    <script src="/js/taginputs/bootstrap.min.js" ></script>
    <script src="/js/taginputs/bootstrap-tagsinput.js"></script>
    <script src="/js/taginputs/bootstrap-tagsinput-angular.min.js"></script>



    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6></h6>
            </div>
            <div class="header-content-right" style="display: inline;">
                <a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i>  </h6></a>
                
                <h6 class="display-inline">Danh sách khách hàng</h6>
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

<ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab0" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#content0">Thông tin khách hàng</a>
      </li> 
  </ul>



<div class="tab-content" style="width:100%">
<div id="content0" class="tab-pane  in active">
        

                  <table id="camera-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Tên</th>
                            <th>Chứng minh thư</th>
                            <th>Số điện thoại </th>
                            <th>Tags</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($consumers as $consumer)
                            <tr class="color-add">

                              <td><div><a> <i class="fa fa-address-card" aria-hidden="true" style="font-size: 1.2rem;"></i><span id="cname{{$consumer->id}}"> {{$consumer->name}}</span></a></td>

                                <td> <span id="ciden{{$consumer->id}}">{{$consumer->identify_card}}</span></a></td>
                                <td><span id="cphone{{$consumer->id}}">{{$consumer->phone_number}}</span>
                              
                                <span style="display: none" id="cbd{{$consumer->id}}">{{$consumer->birth_date}}</span> 

                                <span style="display: none" id="cemail{{$consumer->id}}">{{$consumer->email}}</span> 


                                <span style="display: none" id="cidendate{{$consumer->id}}">{{$consumer->iden_date}}</span> 

                                <span style="display: none" id="clocation{{$consumer->id}}">{{$consumer->iden_location}} </span> 

                                <span style="display: none" id="caddress{{$consumer->id}}">{{$consumer->address}}</span> 

                                <span style="display: none"  id="tag{{$consumer->id}}"> {{$consumer->tags}}</span>
                              </td>
                              <td>
                                <span class="mytags">{{$consumer->tags}}</span>
                              </td>
                              <td> <input onclick="saveConfirm()" name="confirmBox" type="checkbox" id="{{$consumer->id}}" value="{{$consumer->id}}" name="{{$consumer->id}}" class="check-box" checked/>
<!-- 
                                <button style="color: white"  type="button" onclick="loadInfo('{{$consumer->id}}')" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/speech_balloon.png"></span></button>

                                <button style="color: white"  type="button" onclick="updateInfo('{{$consumer->id}}')" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/notepad.png"></span></button> -->

                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
</div>

                    </div>
                  </div>
              <form action="add-consumer-alert" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">

                <input type="hidden" id="cid" name="cid" value="">
                <input type="hidden" id="fid" name="fid" value="{{$fid}}">
          <button type="submit"  class="btn btn-model">Xác nhận</button>
          <button type="button"  class="btn btn-model"><a href="/icon/sale/" > Quay lại</a></button>
                    </form>
          </div>
        



    </div>
    <!-- Modal -->

      <div class="modal fade modol-text" id="new-edge" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Tạo khách mới </label>
              </div>
              <div class="notification"></div>
              <form action="add-new-consumer" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Họ tên </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text" id="name" required=""></td>
                            </tr>

                          <tr>
                                <td class="cam-properties">Ngày sinh </td>
                                <td><input type="date" class="input-edit modol-text form-control" name="bd" id="bd" required=""></td>
                            </tr>


                            <tr>
                                <td class="cam-properties">Số điện thoại</td>
                                <td><input type="" value="" name="phone_number" class="input-edit modol-text" id="phone_number" required=""></td>
                            </tr>

                            <tr>
                                <td class="cam-properties">Email</td>
                                <td><input type="" value="" name="email" class="input-edit modol-text" id="email" required=""></td>
                            </tr>
                      <tr>
                                <td class="cam-properties">Chưng minh thư </td>
                                <td><input type="" value="" name="identify" class="input-edit modol-text" id="identify" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Ngày cấp</td>
                                <td><input type="date" class="input-edit modol-text form-control" name="iden_date" id="iden_date" required=""></td>
                            </tr>

                            <tr>
                                <td class="cam-properties">Nơi cấp</td>
                                <td><input type="" value="" name="location" class="input-edit modol-text" id="location" required=""></td>
                            </tr>

                            <tr>
                                <td class="cam-properties">Địa chỉ</td>
                                <td><input type="" value="" name="address" class="input-edit modol-text" id="address" required=""></td>
                            </tr>
                               <tr>
                                <td class="cam-properties">Tags: </td>
                                <td>
             <input id="newTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">


                           
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
              <form action="edit-consumer" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="EditId">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Họ tên </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text" id="EditName" required=""></td>

                            </tr>

                           <tr>
                                <td class="cam-properties">Ngày sinh </td>
                                <td><input value="" type="date" class="input-edit modol-text form-control" name="bd" id="editBd" required=""></td>
                            </tr>


                            <tr>
                                <td class="cam-properties">Số điện thoại </td>
                                <td><input type="" value="" name="phone_number" class="input-edit modol-text" id="EditPhone" required=""></td>
                            </tr>

                            <tr>
                                <td class="cam-properties">Email</td>
                                <td><input type="" value="" name="email" class="input-edit modol-text" id="EditEmail" required=""></td>
                            </tr>
                      <tr>
                                <td class="cam-properties">Chưng minh thư </td>
                                <td><input type="" value="" name="identify" class="input-edit modol-text" id="EditIdentify" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Ngày cấp</td>
                                <td><input value="" type="date" class="input-edit modol-text form-control" name="iden_date" id="EditIdendate" required=""></td>
                            </tr>

                            <tr>
                                <td class="cam-properties">Nơi cấp</td>
                                <td><input type="" value="" name="location" class="input-edit modol-text" id="EditLocation" required=""></td>
                            </tr>

                            <tr>
                                <td class="cam-properties">Địa chỉ</td>
                                <td><input type="" value="" name="address" class="input-edit modol-text" id="EditAddress" required=""></td>
                            </tr>

                               <tr>
                                <td class="cam-properties">Tags: </td>
                                <td>
                                <input id="editTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">
                                </td>
                          </tr>


                            <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>

                                  <a class="btn btn-model" id="EditDelete"> &nbsp;&nbsp; xóa &nbsp;&nbsp; </a>

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
                        <input type="text" class="textbox" id="search-con-input" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div>
<table id="con-table" class="nvr-table">
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


          document.getElementById("editBd").value = document.getElementById("cbd"+id).innerHTML

          document.getElementById("EditEmail").value = document.getElementById("cemail"+id).innerHTML

          document.getElementById("EditIdentify").value = document.getElementById("ciden"+id).innerHTML

          document.getElementById("EditIdendate").value = document.getElementById("cidendate"+id).innerHTML
          document.getElementById("EditLocation").value = document.getElementById("clocation"+id).innerHTML

          document.getElementById("EditAddress").value = document.getElementById("caddress"+id).innerHTML

  $("#editTag").tagsinput('removeAll');
var rawhtml = $("#tag"+id).html();
     if (rawhtml.length > 1){
     rawhtml = rawhtml.split(',');
     for (var i = 0; i < rawhtml.length;i++){
    $('#editTag').tagsinput('add', rawhtml[i]);
    }
  }


          document.getElementById("EditDelete").href = "/consumer-delete/" + id
          // document.getElementById("EditDelete").value = document.getElementById("caddress"+id).innerHTML

        
        $("#EditInfoModal").modal()

}
</script>

  <!-- DataTables -->
  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
  <script type="text/javascript">
    
    $('#camera-table').DataTable({

    "drawCallback": function( settings ) { 
      $('.mytags').each(function(){
     var rawhtml = $(this).html();
     if (rawhtml.length > 1 && rawhtml.includes("bootstrap-tagsinput") == false){
     rawhtml = rawhtml.split(',');

     html = '<div class="bootstrap-tagsinput">'
     for (var i = 0; i < rawhtml.length;i++){
      html = html + '<span class="tag label label-info" style="display: inline-block;">'+rawhtml[i]+'</span>'
    }
    html = html + "</div>"
    console.log(html)
      $(this).html(html)
     }
 });
    }
});


function saveConfirm(){
          var val = [];

$(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });

console.log(val)
document.getElementById("cid").value=val


}

saveConfirm()




  </script>

@endsection
