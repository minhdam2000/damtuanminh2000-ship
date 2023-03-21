
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
          data-toggle="tab" role="tab" href="#content1">Theo tháng </a>
      </li>

       <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content2">Chi tiết</a>
      </li>

     <li class="nav-item margin_center">
      </li>
    
    </ul>  
    <hr>

        <div class="tab-content">
          <h3>Bộ lọc thời gian</h3>
 <div class="form-inline">  <div class="col-5 col-md-3">
  <label for="example-datetime-local-input" class="col-2 col-md-1 col-form-label">Từ </label>

    <input class="form-control" type="date" name="dt1" id="min" value="">
  </div>  <div class="col-5 col-md-3">
  <label for="example-datetime-local-input" class="col-2 col-md-1 col-form-label">Đến </label>

    <input class="form-control" type="date" name="dt2" id="max" value="">


</div>

</div>
<br><hr><br>
          <div id="content1" class="tab-pane in active">
            <hr><br>

<hr><br>

                  <table id="input-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th> Tiêu đề</th>
                            <th> Số tiền </th>
                            <th> Ngày </th>
                            <!-- <th></th> -->
                          </tr>
                        </thead>
                        <tbody class="tbody">
                       



       @foreach($data as $info)
                            <tr class="color-add">
                              
                              <td><a > Tiền thu bán hàng {{$info->time_display}}</a></td>
                              
                              <td><a> {{number_format(floatval($info->done), 0, ",", ".") }}  VND</a></td>

                              <td><a >{{$info->time}}</a></td>
                             

                             
                            </tr>
                          @endforeach

                        </tbody>
                      </table>
              </form>

        </div>
 <div id="content2" class="tab-pane fade">
            <hr><br>

<hr><br>

                  <table id="input-table2" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th> Tiêu đề</th>
                            <th> Số tiền </th>
                            <th> Ngày </th>
                            <!-- <th></th> -->
                          </tr>
                        </thead>
                        <tbody class="tbody">
                      

       @foreach($detail as $info)
                            <tr class="color-add">
                              
                              <td><a > Tiền thu {{$info->name}}</a></td>
                              <td><a> {{number_format(floatval($info->done), 0, ",", ".") }}  VND</a></td>

                              <td><a>{{$info->time}}</a></td>
                             


                             
                            </tr>
                          @endforeach

                        </tbody>
                      </table>
              </form>

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
<div class="modal fade modol-text" id="AddInfoModal" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Sửa hạng mục</label>
              </div>
              <div class="notification"></div>
              <form action="finance/add" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="table_type" value="0" >
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                <td><span id="modelType">Hạng mục thu</span></td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Tên hạng mục</td>
                                <td>
                                <input class="input-edit modol-text" id=""  name="name" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Mô tả</td>
                                <td>
                                <input class="input-edit modol-text" id=""  name="des" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                 <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "">

                             
                                </select></td>

                            </tr>

                            <tr>
                                <td class="cam-properties">Số tiền</td>
                                <td>
                               <input type="" value="" id="NewAmountDisplay" name="" class="input-edit create-user modol-text" required="" onblur="formatForId('NewAmount')">
                              <input value="0" style="display:none" type="number" id="NewAmount" name="amount"> 
                            </td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Ngày</td>
                                <td>
                                <input type="date" class="input-edit modol-text form-control" name="date" id="" required="">
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

<div class="modal fade modol-text" id="AddInfoModal1" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>
                  Thêm hạng mục</label>
              </div>
              <div class="notification"></div>
              <form action="finance/add" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="table_type" value="1" >
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                <td><span id="modelType">Hạng mục thu</span></td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Tên hạng mục</td>
                                <td>
                                <input class="input-edit modol-text" id=""  name="name" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Mô tả</td>
                                <td>
                                <input class="input-edit modol-text" id=""  name="des" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                 <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "">

                                </select></td>

                            </tr>

                            <tr>
                                <td class="cam-properties">Số tiền</td>
                                <td>
                               <input type="" value="" id="NewAmount1Display" name="" class="input-edit create-user modol-text" required="" onblur="formatForId('NewAmount1')">
                              <input value="0" style="display:none" type="number" id="NewAmount1" name="amount"> 
                            </td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Ngày</td>
                                <td>
                                <input type="date" class="input-edit modol-text form-control" name="date" id="" required="">
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


 <div class="modal fade modol-text" id="EditInfoModal" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Sửa hạng mục</label>
              </div>
              <div class="notification"></div>
              <form action="finance/edit" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="EditId">
                  <input type="hidden" name="table_type" value="1" >
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                <td><span id="modelType">Hạng mục thu</span></td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Tên hạng mục</td>
                                <td>
                                <input class="input-edit modol-text" id="EditName"  name="name" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Mô tả</td>
                                <td>
                                <input class="input-edit modol-text" id="EditDes"  name="des" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                 <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "EditType">

                                </select></td>

                            </tr>

                            <tr>
                                <td class="cam-properties">Số tiền</td>
                                <td>
                               <input type="" value="" id="EditAmountDisplay" name="" class="input-edit create-user modol-text" required="" onblur="formatForId('EditAmount')">
                              <input value="0" style="display:none" type="number" id="EditAmount" name="amount"> 
                            </td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Ngày</td>
                                <td>
                                <input type="date" class="input-edit modol-text form-control" name="date" id="Editdate" required="">
                              </td>
                            </tr>

                           
                            <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>

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

 <div class="modal fade modol-text" id="EditInfoModal1" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Sửa hạng mục</label>
              </div>
              <div class="notification"></div>
              <form action="finance/edit" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="EditId1">
                  <input type="hidden" name="table_type" value="2" >
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                <td><span id="modelType">Hạng mục chi</span></td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Tên hạng mục</td>
                                <td>
                                <input class="input-edit modol-text" id="EditName1"  name="name" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Mô tả</td>
                                <td>
                                <input class="input-edit modol-text" id="EditDes1"  name="des" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                 <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "EditType1">

                             
                                </select></td>

                            </tr>

                           <tr>
                                <td class="cam-properties">Số tiền</td>
                                <td>
                               <input type="" value="" id="EditAmount1Display" name="" class="input-edit create-user modol-text" required="" onblur="formatForId('EditAmount1')">
                              <input value="0" style="display:none" type="number" id="EditAmount1" name="amount"> 
                            </td>
                            </tr>
                              <tr>
                                <td class="cam-properties">Ngày</td>
                                <td>
                                <input type="date" class="input-edit modol-text form-control" name="date" id="Editdate1" required="">
                              </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>

                                     <a  class="btn btn-model" id="deleteButton1"> &nbsp;&nbsp; Xóa &nbsp;&nbsp; </a>

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

function editInputDetail(id){
  document.getElementById("EditId").value = id
  document.getElementById("EditName").value = document.getElementById("iname"+id).innerHTML
  document.getElementById("EditType").value = parseInt(document.getElementById("itype"+id).innerHTML)
  document.getElementById("Editdate").value = (document.getElementById("idate"+id).innerHTML)
  document.getElementById("EditDes").value = document.getElementById("ides"+id).innerHTML
  document.getElementById("EditAmountDisplay").value = document.getElementById("inum"+id).innerHTML
  formatForId("EditAmount")

  document.getElementById("deleteButton").href = "finance/delete/0/"+id


$("#EditInfoModal").modal()

}

function editOutputDetail(id){



  document.getElementById("EditId1").value = id
  document.getElementById("EditName1").value = document.getElementById("oname"+id).innerHTML
  // document.getElementById("EditType1").value = document.getElementById("otype"+id).innerHTML

  console.log(document.getElementById("otype"+id).innerHTML)
            $("#EditType1").val(parseInt(document.getElementById("otype"+id).innerHTML)
);
  document.getElementById("EditDes1").value = document.getElementById("odes"+id).innerHTML
  document.getElementById("EditAmount1Display").value = document.getElementById("onum"+id).innerHTML
  console.log(document.getElementById("odate"+id).innerHTML)
  document.getElementById("Editdate1").value = (document.getElementById("odate"+id).innerHTML)
  formatForId("EditAmount1")
  document.getElementById("deleteButton1").href = "finance/delete/1/"+id


$("#EditInfoModal1").modal()

}

function showInfo(id,type){
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
</script>


  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>

  <script>
    $('#input-table').DataTable();
    $('#input-table2').DataTable();
var minDate, maxDate;
 
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min =  document.getElementById("min").value
        var max = document.getElementById("max").value
        var date = data[2];
        console.log(min)
        console.log(max)
        console.log(date)
        if (
            ( min === "" && max === "" ) ||
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    // Create date inputs
    minDate = document.getElementById("min").value
    minDate = document.getElementById("max").value
 
    // DataTables initialisation
    var table = $('#input-table').DataTable();
    var table2 = $('#input-table2').DataTable();
 
 
    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
        table2.draw();
    });
});
  </script>

@endsection
