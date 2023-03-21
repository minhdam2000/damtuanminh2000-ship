@extends('layouts.index')
@section('content')
	<div class="content-camera">
		<div class="header-content">
			<div class="header-content-left">
				<h6>Quản lý đợt thành toán</h6>
			</div>
			<div class="header-content-right" style="display: inline;">
				
				<h6 class="display-inline">Quản lý  đợt thành toán</h6>
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
    <div class="row row-content">
      <div class="row-title-proxy">
         <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content1">Mã BDS: <?=$zone->name?> - Tiết độ đợt {{$pay_info->step}} (Số tiền {{number_format(floatval($pay_info->money), 0, ",", ".") }}  VND)</a>
      </li>    
    </ul>  
    <hr>

        <div class="tab-content">
        <div class="tab-content"> <label  class="preview" for="file-input">

          @if($zid >  0)
          <a href="/chatify/sale/{{$index}}" type="button"  class="btn btn-model" > Quay lại</a>
          @if($pay_info->status == 0)
<button type="button" class="btn btn-model" data-toggle="modal" data-target="#AddInfoModal">Thêm đợt mới</button>
@endif
<br><br>
@endif

          <div id="content1" class="tab-pane  in active">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="example" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th>Đầu mục </th>
                        <th>Số tiền </th>
                        <th>Ngày xác nhận </th>
                        <th> </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      <?php
                        $i = 0;
                      ?>
                      @foreach($pay_detail as $pay)
                      <?php
                        $i  = $i + 1;
                      ?>
                        <tr class="color-add">
                          <td>Hóa đơn đợt  {{$i}}</td>
                          <td>{{number_format(floatval($pay->money), 0, ",", ".") }}  VND</td>
                          
                          <td>{{$pay->date}}</td><td>
                          <a href="sale/pay-delete/<?=$pay->id?>" type="button"  class="preview" > <img src="/js-css/img/icon/delete.png"> </a></td>
                        </tr>

                        </tr>
                      @endforeach
                    </tbody>
                  </table>

          @if($zid >  0)
          @if($pay_info->status == 0)
                  <hr><br>
                   <a href="sale/pay-end/<?=$pay_info->id?>" type="button"   class="btn btn-model" > Kết thúc đợt  </a></td>
@endif
@endif
            </div>
          </div>

           

        </div>
      </div>
    </div>
    </div>
    <!-- end model --->
 <div class="modal fade modol-text" id="AddInfoModal" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm thanh toán</label>
              </div>
              <div class="notification"></div>
              <form action="sale/pay/add" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="id" value="{{$id}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                           
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
	<!-- end model --->

	<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
    </div>
    <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
     </div>


<div class="overlay-dark"></div>
<iframe class="img-overlay" src=""></iframe>

  <script>
    $('#example').DataTable({
        "paging":   false,
        "info":     false,
        "searching": false
      });
function downloadURI(uri, name) {
  var link = document.createElement("a");
  link.download = name;
  link.href = uri;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
  delete link;
}


   function  loadFile(name,$src){
       if (window.innerWidth <  800){
window.open(
  $src,
  '_blank' // <- This is what makes it open in a new window.
);
return 0;
}

      if ($src.includes(".doc")){
        downloadURI($src,name+".docx")
        return
      }else{
      console.log($src)
      $('.img-overlay').attr('src', $src);
      $(".overlay-dark").css('display', 'block');
      $('.img-overlay').css('display', 'block');
      $('.img-overlay').css('opacity', 1);
      $('.img-overlay').css('width', '90%');
      $('.img-overlay').css('height', '90%');
      $('.img-overlay').css('transform', 'translate(-50%, 0) scale(1, 1)');
      console.log("sone")
    }
    }


    $(".overlay-dark").on('click', function() {
      $(".overlay-dark").css('display', 'none');
      $('.img-overlay').css('display', 'none');
      setTimeout(function() {
        $('.img-overlay').css('transform', 'translate(-50%, 0) scale(0, 0)');
      }, 600);
    });


    function openfileupload(){
            document.getElementById("inputfile").click();
    }


 function uploadsubmit(){ 
      swal({
        title: "",
        text: " Bạn có chắc chắc tệp tin tải lên phù hợp ? ",
        type: "info",
        showCancelButton: true,
        confirmButtonText: "Có",
        cancelButtonText: "Không",
        closeOnConfirm: false,
        closeOnCancel: false,
        reverseButtons: true },
        function(isConfirm){
          if (isConfirm)
          {
      document.getElementById("uploadfile").submit();
            swal.close();
          }
          else {
            swal.close();
          }
        });

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
