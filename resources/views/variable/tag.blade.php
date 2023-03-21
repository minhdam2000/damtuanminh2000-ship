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



 <link rel="stylesheet" href="/js/taginputs/bootstrap-tagsinput.css"  />

    <script src="/js/taginputs/bootstrap.min.js" ></script>
    <script src="/js/taginputs/bootstrap-tagsinput.js"></script>
    <script src="/js/taginputs/bootstrap-tagsinput-angular.min.js"></script>

    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6>Quản lý từ đồng nghĩa</h6>
            </div>
            <div class="header-content-right" style="display: inline;">
                <h6 class="display-inline">Quản lý từ đồng nghĩa</h6>
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
                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;Danh sách nhóm tag</div>
                      <div class="proxy-add" title="New Edge"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-edge"><i class="fa fa-plus" aria-hidden="true"></i> Nhóm mới </button></div>
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
                            <th>Tên</th>
                            <th>Giá trị</th>

                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($tags as $tag)
                            <tr class="color-add">
                              <td><div><span id="name{{$tag->id}}"> {{$tag->name}}</span></td>
                                <td>
                          <span style="display: none"  id="tag{{$tag->id}}"> {{$tag->str}}</span>
                            <span class="mytags"> {{$tag->str}}</span>
                                </td>
                               

                              
                              <td>
                         

                                <button style="color: white"  type="button" onclick="updateInfo('{{$tag->id}}')" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/notepad.png"></span></button>


                                   <a style="color: white" href="/tag-group/delete/{{$tag->id}}"><span class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span></a>

                             
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
              <form action="add-tag-group" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                                <td class="cam-properties">Tên: </td>
                                
                                <td><input type="" value="" name="name" class="input-edit modol-text"  required="" id=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Từ đồng nghĩa: </td>
                                
                                <td>
                                  
             <input id="newTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">

                                </td>
                            </tr>
                            <td></td>
                              
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
              <form action="edit-tag-group" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" id="idInput" value="">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Tên: </td>
                                   <td><input type="" value="" name="name" class="input-edit modol-text"  required="" id="editName"></td>
                                   </td>
                             </tr>
                            <tr>
                                <td class="cam-properties">Từ đồng nghĩa: </td>
                                   <td>
                                <input id="editTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">
                                </td>
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

<button class="btn btn-model"><a href="/">quay lai</a> </button>
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
      <form action="edit-tag-group"  enctype="multipart/form-data" method="POST">
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

 <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>

<script type="text/javascript">

    $('#camera-table ').DataTable({
      "order": [[ 0, "desc" ]],
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
          document.getElementById("editName").value = document.getElementById("name"+id).innerHTML;

            $("#editTag").tagsinput('removeAll');
            var rawhtml = $("#tag"+id).html();
                 if (rawhtml.length > 1){
                 rawhtml = rawhtml.split(',');
                 for (var i = 0; i < rawhtml.length;i++){
                $('#editTag').tagsinput('add', rawhtml[i]);
                }
              }


        $("#edit-edge").modal()

}


    function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }
</script>
@endsection
