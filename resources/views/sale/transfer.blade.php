@extends('../layouts/index')
@section('content')
    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6>Bản đồ dự án</h6>
            </div>
           
        </div>
        <div class="session"> <input value="" hidden="" notifi="Vui lòng kiểm tra lại các trường thông tin bị thiếu" value="1" id="my_notice">
            @if(Session::has('notification'))
              <input value="" hidden="" notifi="{{Session::get('notification')}}" value="1" id="notice_success">
            @endif
            @if(Session::has('warning'))
              <input hidden="" notifi="{{Session::get('warning')}}" value="1" id="notice_warning">
            @endif
        </div>

        <div class="row-content">

<!-- <div class="arrow-steps clearfix">
          <div class="step current" onclick="viewStep(this)"> <span> Step 1</span> </div>
          <div class="step" onclick="viewStep(this)"> <span>Step 2 some words</span> </div>
          <div class="step" onclick="viewStep(this)"> <span> Step 3</span> </div>
          <div class="step" onclick="viewStep(this)"> <span>Step 4</span> </div>
        </div> -->

  <!-- <ul  style="margin-top: 3%;" class="nav nav-tabs nav-justified" id="processtabs" role="tablist">


  </ul>  -->
  <hr>
    <hr><br>
 <div class="card card-custom">
                                                         
                                      <div class="card-header" data-toggle="collapse" data-target="#target0">
                                        <h3 class="card-title">
   Thông tin giao dịch</h3>
</div>
                                    
                                      <div class="card-body collapse"  id="target0" >
  <div id= "info" class="row">
    <div class="col-md-4 col-12 col-sm-12"> 
     <div class="card card-custom">
                                         <div class="card-header" data-toggle="collapse" data-target="#target1">
                                        <h3 class="card-title">
   Thông tin cơ bản</h3>
</div>
                                    
                                      <div class="card-body collapse show"  id="target1" >



<table class="table-edit table-model">
                    <tbody class="table-edit">
              
              <tr>

                <td >Mã BDS: </td>
                <td id="tran-zone">{{$zone->name}}</td>

              </tr>  
              <tr>
                <td >Diện tích: </td>
                <td id="acreage">{{$zone->acreage}} m<sup>2</sup></td>

              </tr>

              <tr>
                <td >Phương thức: </td>
                <td id="final_method">@if($zone->trans_type == 1)
  Đặt cọc
@elseif($zone->trans_type == 2)
Phân lô bán nền 
@elseif($zone->trans_type == 3)
 Mua bán nhà ở hình thành trong tương lai
 @endif</td>

                <tr>
                <td >Đơn giá dự kiến: </td><td id="final_unit">{{number_format(floatval($zone->unit_price), 0, ",", ".") }}  VND</td>
</tr>
<tr>
                <td >Giá dự kiến: </td><td id="final_unit">{{number_format(floatval($zone->unit_price)*$zone->acreage, 0, ",", ".") }}  VND</td>
              </tr>
         
              <tr>
                <td>Chiết khấu đất: </td>
                <td id="final_price_discount">{{number_format(floatval($zone->price_discount), 0, ",", ".") }} VND</td>

              </tr>

                        @if(strpos($zone->name,"LK") > -1)
              <tr id="con1">
                <td >Chi phí xây dựng:</td>
                <td id="final_con">

                        @if($zone->acreage > 120)
1,636,685,000 VND
                        @else
1,558,055,000 VND
                        @endif

                 </td>

              </tr>

              <tr id="con2">
                <td >Chiết khấu xây dựng:</td>
                <td id="final_con_discount">{{number_format(floatval($zone->con_discount), 0, ",", ".") }} VND</td>

              </tr>
              @endif
            
<tr>
                <td >Tổng chi phí:</td>
                <td id="final_total">{{number_format(floatval($zone->final_price), 0, ",", ".") }} VND</td>

              </tr>
              </tr>
                <tr>
                <td >Tình trạng giao dịch: </td>
                <td id="acreage"><span id="FinalStatus">
                  @if($zone->state < 3)
                  <h4 style="color: red">Đang tiến hành</h4>
                  @else
                  <h4 style="color: green">Đã hoàn thành</h4>
                  @endif

                </span></td>

              </tr>

            </tbody></table>
  
  <br><hr><br>
</div></div>
</div>

<div class="col-md-4 col-12 col-sm-12"> 
     <div class="card card-custom">
                                         <div class="card-header" data-toggle="collapse" data-target="#target1">
                                        <h3 class="card-title">
   Chi tiết giá</h3>
</div>
                                    
                                      <div class="card-body collapse show"  id="target1" >



<table class="table-edit table-model">
                    <tbody class="table-edit">
              <tr>
                <td >Đơn giá dự kiến: </td>
                <td id="tran-zone">{{number_format(floatval($zone->unit_price), 0, ",", ".") }} VND </td>

              </tr> 
              <tr>
                <td >Giá dự kiến: </td>
                <td id="tran-zone">{{number_format(floatval($zone->final_price), 0, ",", ".") }} </td>

              </tr>  <tr>

                <td >Đơn giá thực tế: </td>
                <td id="acreage">
                  @if($zone->real_price > 0)
                  {{number_format(floatval($zone->real_price), 0, ",", ".") }}
                  @else
                  {{number_format(floatval($zone->unit_price), 0, ",", ".") }}
                  @endif

                  VND
                </td>

              </tr>
              <tr>
                <td >Giá thực tế: </td>
                <td id="acreage">
                   @if($zone->real_price > 0)
                   @if(strpos($zone->name,"LK") > -1)
                    @if($zone->acreage > 120)
                    {{number_format(floatval($zone->real_price)*$zone->acreage-floatval($zone->price_discount)-floatval($zone->con_discount) + 1636685000, 0, ",", ".") }}

                        @else
{{number_format(floatval($zone->real_price)*$zone->acreage-floatval($zone->price_discount)-floatval($zone->con_discount) + 1558055000, 0, ",", ".") }}
                        @endif
                   @else
                  {{number_format(floatval($zone->real_price)*$zone->acreage-floatval($zone->price_discount), 0, ",", ".") }}
                  @endif
                  @else
                  {{number_format(floatval($zone->final_price), 0, ",", ".") }}
                  @endif


                VND</td>

              </tr>

              <tr>
                @if($zone->vat > 0)
                <td >Thuế VAT: </td>
                <td id="final_method"> {{number_format($zone->vat, 0, ",", ".") }} VND</td></tr>
                @endif

                  @if($zone->tax > 0)
                 <tr>
                <td >Thuế trước bạ: </td>
                <td id="final_method"> {{number_format($zone->tax, 0, ",", ".") }} VND</td>

                <tr>
                  @endif

                  @if($zone->inner_tax > 0)
                 <tr>
                <td>Phí hợp đồng: </td>
                <td id="final_method"> {{number_format($zone->inner_tax, 0, ",", ".") }} VND</td>

                <tr>
                  @endif

                @if($zone->deposit > 0)
                <tr>

                <td >Hoa hồng: </td>
                <td id="final_method">{{$zone->deposit}} VND</td>

                <tr>
                  @endif
                     <tr>


                      
                <td >Đã thu: </td>
                <td id="final_method">
                  {{number_format(floatval($zone->done), 0, ",", ".") }} VND</td>

                <tr>

                     <tr>
                <td >Còn phải thu: </td>
                <td id="final_method">
                  {{number_format(floatval($zone->dept), 0, ",", ".") }} VND</td>
                <tr>
                
            </tbody></table>
  
  <br><hr><br>
@if($zone->gap > 0)
<table><tbody>
  <tr>
    <td>Hoa hồng</td>
    <td>{{number_format($zone->gap, 0, ",", ".") }} VND</td>

  </tr>


  <tr>
    <td>Người hưởng</td>
    <td>{{$infomation->sname}}</td>

  </tr>

</tbody></table>
  <br><hr><br>
  @endif
</div></div>
</div>

 <div class="col-md-4 col-12 col-sm-12">


 <div class="card card-custom"> 
   <div class="card-header"  data-toggle="collapse" data-target="#targeti">
                                        <h3 class="card-title">
   Huy hợp đồng </h3>

                         </div>           
              <div class="card-body collapse show"  id="targeti" >

<form action="reset-zone" method="post">
   <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" value=" {{$zone->id}}" id="rid" name="id" class="input-edit modol-text" >

        <input type="hidden" value=" {{$infomation->cid}}" id="cid" name="cid" class="input-edit modol-text" >


  <table class="table-edit table-model">
                    <tbody class="table-edit">
                        
              <tr>
                            <td><i class="fa fa-credit-card" aria-hidden="true"></i> Lý do hủy</td>
                            <td><input type="" value="" name="content" class="input-edit modol-text" required="">
 <input value="" style="display:none" type="number" id="vat" name="vat">    
                            </td>
                        </tr>
                      
 <input value="" style="display:none" type="number" id="real_price" name="real_price">  
                        </tr>
                        <tr>
                          <td>
                            <button class="btn btn-model">Hủy </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
</form>
  <hr>
</div>
</div>



</div>
</div>
</div>
   <form id="action-form" action="update-sale" method="POST">

   <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" value="{{$zone->id}}" id="rid" name="zone_id" class="input-edit modol-text" >

           <input type="hidden" value="{{$zone->trans_type}}" id="trans_type" name="trans_type" class="input-edit modol-text" >



<div class="card card-custom">
                                                         
                                      <div class="card-header" data-toggle="collapse" >
                                        <h3 class="card-title bigstepBtn2">
  Chuyển nhượng</h3>
</div>
                                    
                                      <div class="card-body  bigstep2"  id=" " >
<div class="row">
 <div class="col-md-12 col-12 col-sm-12">

  <button onclick="chooseConsumer()" type="button" class="btn btn-model">Khách đã có</button>

  <br><hr><br>
                <div>
                  <tr>
          <div class="row">
          <div class="col-md-6 col-sm-12 col-sm-12" id="c1"> 
          <table><tbody>
<td > Tên khách hàng</td>
<td>  <input value="" id="cname1" name="cname1" class="input-edit modol-text" required="">
</td>
</tr>
<tr>
<td > Ngày sinh </td>
<td> <input value="{{$infomation->birth_date}}" type="date" class="input-edit modol-text form-control" name="birth_day1" id="birth_day1" required="">
</td>
</tr>
<tr>
<td >Điện thoại</td>
<td>
<input value="{{$infomation->phone_number}}" id="cphone1" name="cphone1" class="input-edit modol-text" required="">
</td>
</tr>
<tr>
<td >Email: </td>
<td>
<input value=" {{$infomation->email}}" id="cemail1" name="cemail1" class="input-edit modol-text" required="">
</td>
</tr>
<tr>
<td >Tình trạng hôn nhân: </td>
<td>
<select  value ="{{$infomation->married}}" onchange="marriedCheck()" class="custom-select select-profile  browser-default"  name="married" id="married">
                  <option value="1"> Độc thân </option>
                  <option value="2"> Đã kết hôn </option>
                </select>
</td>
</tr>

<tr>
<td >Vai trờ: </td>
<td>
<select style="display: none" onchange="marriedRole()" class="custom-select select-profile  browser-default"  name="married_role" id="married_role">
                  <option value="1"> Chồng  </option>
                  <option value="2"> Vợ </option>
                </select>
</td>
</tr>
<tr>
<td > Số căn cước</td>
<td>
<input value="" id="cidentify1" name="cidentify1" class="input-edit modol-text" required="">
</td>
</tr>
<tr>
<td > Ngày cấp </td>
<td> <input value="" type="date" class="input-edit modol-text form-control" name="ciden_date1" id="ciden_date1" required="">
</td>
</tr>
<tr>
<td >Nơi cấp</td>
<td>
<input value="" id="clocation1" name="clocation1" class="input-edit modol-text" required="">
</td>
</tr>
<tr>
<td >Địa chỉ</td>
<td>
<input value="" id="caddress1" name="caddress1" class="input-edit modol-text" required="">
</td>
</tr>
</tbody></table>      
<br><hr>
                </div>





                 <div class="col-md-6 col-sm-12 col-sm-12" id="c2"
input type="hidden" value="-1" id="con_id" name="con_id" class="input-edit modol-text" required=""
@if($infomation->married < 2)
                  style="display: none;">
@else
>
@endif
       
                  <table><tbody>
<td id="married_title"> Tên khách hàng</td>
<td>  <input value="" name="cname2" id="cname2" class="input-edit modol-text" >
</td>
</tr>
<tr>
<td > Ngày sinh </td>
<td> <input value="" type="date" class="input-edit modol-text form-control" name="birth_day2" id="birth_day2" >
</td>
</tr>
<tr>
<td >Điện thoại</td>
<td>
<input value="" id="cphone2" name="cphone2" class="input-edit modol-text">
</td>
</tr>
<tr>
<td >Email: </td>
<td>
<input value="" id="cemail2" name="cemail2" class="input-edit modol-text" >
</td>
</tr>



<tr>
<td > Số căn cước</td>
<td>
<input value="" id="cidentify2" name="cidentify2" class="input-edit modol-text">
</td>
</tr>
<tr>
<td > Ngày cấp </td>
<td> <input value="" type="date" class="input-edit modol-text form-control" name="ciden_date2" id="ciden_date2" >
</td>
</tr>
<tr>
<td >Nơi cấp</td>
<td>
<input value="" id="clocation2" name="clocation2" class="input-edit modol-text">
</td>
</tr>
<tr>
<td >Địa chỉ</td>
<td>
<input value="" id="caddress2" name="caddress2" class="input-edit modol-text" >
</td>
</tr>
</tbody></table>
<br><hr>
                </div>
              </div>      <hr><br>
</div>
</div>
</tr></div></div>

 <div id = "conInputContent" style="display: none"></div>


<div class="form-group">
        <input id="form_submit_btn" class="btn btn-model form-control" type="submit" value="Xác nhận">
    </div>
  </form>
</div>


</div>
</div>

</div>


      <div class="modal fade modol-text" id="chooseConsumer" role="dialog">
  <div class="modal-dialog model-right" style="height: auto;min-height: 100%;min-width: 75%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">Chọn khách hàng</div>
              <div class="modal-body">

                  <table id="consumer-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Tên</th>
                            <th>Chứng minh thư</th>
                            <th>Số điện thoại </th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($consumers as $consumer)
                            <tr class="color-add">
                            
                              <td><a><span id="cname{{$consumer->id}}"> {{$consumer->name}}</span></a></td>

                                <td> <span id="cindetify{{$consumer->id}}">{{$consumer->identify_card}}</span></a></td>
                                <td id="cphone{{$consumer->id}}"> {{$consumer->phone_number}}</td>
                              
                              <td><button style="color: white"  type="button" onclick="getConsumer('{{$consumer->id}}')" class="btn btn-del Disable"><i class="fa fa-check-circle" aria-hidden="true" style="font-size: 1.2rem;"></i></button>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
 </div>
            </div>
          </div>
      </div></div> 
      <div class="overlay-dark"></div>
      <img class="img-overlay">
      <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> notifition</h6>
      </div>
      <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning</h6>
      </div>
<script  src="js-css/js/image-popup.js"></script>
<script type="text/javascript">
  $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });

  $(document).ready(function(){
    $("#search-input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#camera-table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
<script>
    $(document).ready(function() {
          if($("#notice_success").val() == 1){
            notifiSuccess($("#notice_success").attr("notifi"));
          }
          if($("#notice_warning").val() == 1){
            notifiWarning($("#notice_warning").attr("notifi"));
          }
        });
    $("#camera-add").click(function(){
        var ip = document.getElementById('ip').value;
        var rtsp_link = document.getElementById('rtsp-link').value;
        if(ip == '' || rtsp_link == ''){
            $("#new-camera").addClass("shake-model");
            setTimeout(function() {
                $("#new-camera").removeClass("shake-model");
            }, 1000);
            document.getElementsByClassName('notification')[0].innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Cannot leave an id or password blank !";
            document.getElementsByClassName('notification')[0].classList.add('notification-color');
        }
        else{
            $("#create-form").submit(function(event){
            event.preventDefault(); //prevent default action
            var post_url = $(this).attr("action"); //get form action url
            var request_method = $(this).attr("method"); //get form GET/POST method
            var form_data = new FormData(this); //Creates new FormData object
            $.ajax({
            url : post_url,
            type: request_method,
            data : form_data,
            contentType: false,
            cache: false,
            processData:false
            }).done(function(response){ //
              console.log(response);
              if(response == 'true'){
                window.location.href = 'create-camera-success';
              }
              else{
                snakeModel();
                document.getElementsByClassName('notification')[0].innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> There was a error in too process of process. ";
                document.getElementsByClassName('notification')[0].classList.add('notification-color');
              }
            });


      });


        }
    });
</script>

<script>
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
    function snakeModel(){
      $("#create-user").addClass("shake-model");
            setTimeout(function() {
                $("#create-user").removeClass("shake-model");
            }, 1000);
        }
</script>

<script>
  function confirm_remove() {
          var remove = document.getElementById('device-remove');
          remove.addEventListener('click', function(e){
              $("#form-camera").attr("action","remove-camera");
              swal({
                  title: "",
                  text: " Are you sure you want to delete this cameras? ",
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
                    document.getElementById("submit-action").click();
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


<!-- show image preview -->
<script type="text/javascript">
  $( ".preview" ).click(function() {
    $(this).parent().children( ".img-popup" ).click();
  });
</script>


<script type="text/javascript">
  function selectNvr(){
    var nvr_name = $("#nvrs option:selected").text();
    console.log(nvr_name)
    $("#form-camera").attr("action","add-cam-to-nvr/"+$("#nvrs").val());
    var message = "You want to record these cameras in "+nvr_name+" device.";
    JSconfirmAddCamToNvr(message);
  }



  function JSconfirmAddCamToNvr(text){
    swal({ 
       title: "",   
       text: text,   
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
          document.getElementById("submit-action").click();
       } 
       else {   
        $("#nvrs").val("-1");
        swal.close();  
       } 
     });
     $(".btn-primary").css('border', 'none');
     $(".showSweetAlert").attr('style', 'display: block;');
     $(".text-muted").attr('style', 'color: #fff !important');
   }
function chooseConsumer(){
  console.log("oke")
  $("#chooseConsumer").modal()
}

function newConsumerBtn(){
  document.getElementById("con_id").value = -1;
 document.getElementById("cname1").value = "";


  document.getElementById("birth_day1").value ="";


  document.getElementById("cphone1").value =  "";

  document.getElementById("cemail1").value = "";


  document.getElementById("married").value =  "";


  document.getElementById("married_role").value =  "";


  document.getElementById("cidentify1").value = "";


  document.getElementById("ciden_date1").value = "";

  document.getElementById("clocation1").value =  "";


  document.getElementById("caddress1").value =  "";
  document.getElementById("c2").style.display = "none";

  document.getElementById("cname2").value = "";


  document.getElementById("birth_day2").value ="";

  document.getElementById("cphone2").value =  "";

  document.getElementById("cemail2").value =  "";


  document.getElementById("cidentify2").value =  "";


  document.getElementById("ciden_date2").value =  "";
  
  document.getElementById("clocation2").value = "";


  document.getElementById("caddress2").value =  "";

}
function newConsumer(){
    // document.getElementById("con_type").value = type 

    document.getElementById("conInputContent").innerHTML = '<h4>Tên khách hàng: <span id="tran-consumer_name"><span></h4><br><input type="hidden" value="<?=$zone->staff_id?>" id="con_id" name="con_id" class="input-edit modol-text" required=""><button type="button" onclick="chooseConsumer()" class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Chọn &nbsp;&nbsp; </button>' 

  
}
 newConsumer()

function getConsumer(id){
  document.getElementById("con_id").value = id;
   $.ajax({
      type: "GET",
      url: '/consumer-info/'+id,
      success: function (response) {
        response = (JSON.parse(response))
        var consumer1 = response[0]
        var consumer2 = response[1]

  document.getElementById("cname1").value = consumer1.name;


  document.getElementById("birth_day1").value = consumer1.birth_date;


  document.getElementById("cphone1").value =  consumer1.phone_number;

  document.getElementById("cemail1").value =  consumer1.email;


  document.getElementById("married").value =  consumer1.married;


  document.getElementById("married_role").value =  consumer1.married_role;


  document.getElementById("cidentify1").value =  consumer1.identify_card;


  document.getElementById("ciden_date1").value =  consumer1.iden_date;

  document.getElementById("clocation1").value =  consumer1.iden_location;


  document.getElementById("caddress1").value =  consumer1.address;

if(consumer1.married == 2){

  document.getElementById("c2").style.display = "block";
  if(consumer1.married_role == 1){
  document.getElementById("married_title").innerHTML = "Họ tên vợ"
  }else{
  document.getElementById("married_title").innerHTML = "Họ tên chồng"

  }

  document.getElementById("cname2").value = consumer2.name;


  document.getElementById("birth_day2").value = consumer2.birth_date;

  document.getElementById("cphone2").value =  consumer2.phone_number;

  document.getElementById("cemail2").value =  consumer2.email;


  document.getElementById("cidentify2").value =  consumer2.identify_card;


  document.getElementById("ciden_date2").value =  consumer2.iden_date;
  
  document.getElementById("clocation2").value =  consumer2.iden_location;


  document.getElementById("caddress2").value =  consumer2.address;
}else{

  document.getElementById("c2").style.display = "none";
}
      }

    });
  }
  // document.getElementById("con_id").value = id;
  // console.log(name)
  // document.getElementById("tran-consumer_name").innerHTML = name

function loadPayContent(){
  var pay = document.getElementById("payStep").value
  var html = ""
  for (i = 2; i < parseInt(pay) + 1;i++){
    html = html  + '<tr><td >Đợt '+i+': </td><td ><input value="" id="paytext'+i+'" name="paytext'+i+'" class="input-edit modol-text" placeholder="VND" required=" "  onblur="formatMoney()" '
    if(i == parseInt(pay)){
      html =html + "Disabled"
    }
    html =html + '><input value="" style="display:none" type="number" id="pay'+i+'" name="pay'+i+'"></td><td > <input type="date" class="input-edit modol-text form-control" name="pay_date'+i+'" id="" required=""></td></tr>'
  }
  document.getElementById("payContent").innerHTML = html;
}

function formatMoney(){
  var pay = document.getElementById("payStep").value
 var con = 0
 var con_discount = 0

  if("{{$zone->name}}".includes('LK')){

 if(parseInt("{{$zone->acreage}}") > 125){
    con = 1636685000
  }else{
    con = 1558055000

  }

var con_discount = document.getElementById("con_discount").value
}
    final_price =  parseInt(document.getElementById("unit-price").value)*parseFloat(document.getElementById("acreage").innerHTML) + con -con_discount - parseFloat(document.getElementById("price_discount").value)+ parseFloat(document.getElementById("vat").value) -parseFloat(document.getElementById("gap_drop").value) + parseFloat(document.getElementById("inner_tax").value)
   

   for (i = 1; i < parseInt(pay);i++){
    var value = document.getElementById("paytext"+i).value
    value = parseFloat(value.replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
   console.log("??:)))")
   console.log(value.replace(/,/g, ""))
    if(value.replace(/,/g, "") > 0){
      console.log("wtwet")
    }else{
      value ="0";
    }
    document.getElementById("paytext"+i).value = value
    document.getElementById("pay"+i).value = value.replace(/,/g, "")
    final_price = final_price - parseInt(value.replace(/,/g, ""))
  
  }
   document.getElementById("pay"+pay).value = final_price
    final_price = parseFloat(final_price.toString().replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
    document.getElementById("paytext"+pay).value = final_price

}

function formatReal(){
    var value = document.getElementById("real").value
    value = parseFloat(value.replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    console.log(value)
    console.log(value.replace(/,/g, ""))
    document.getElementById("real").value = value
    
    document.getElementById("real-price").value = value.replace(/,/g, "") 

    var final_price = parseInt(value.replace(/,/g, ""))*parseFloat(document.getElementById("acreage").innerHTML)

     final_price = parseFloat(final_price.toString().replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    // console.log("VAT")
    // console.log((value -2664284))

     var vat =  (value.replace(/,/g, "") -2664284)*parseFloat(document.getElementById("acreage").innerHTML)*0.1
    document.getElementById("vat").value = vat

    var vat_str = parseFloat(vat.toString().replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    document.getElementById("vatDisplay").innerHTML = vat_str +"VND"

    console.log("test");

    tax =  (parseFloat(final_price.replace(/,/g, ""))+parseFloat(document.getElementById("vat").value))*0.5/100
    if(document.getElementById("mytype").value == 2){
        tax = tax *1.2;
    }

    // document.getElementById("tax").value = 124124;
    console.log(tax)


    document.getElementById("tax").value = tax





    var tax_str = parseFloat(tax.toString().replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");


    console.log(tax_str)
    document.getElementById("taxDisplay").innerHTML = tax_str +"VND"

    var real_final = parseFloat(final_price.replace(/,/g, "")) + vat




    var real_final = parseFloat(real_final.toString().replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");


    document.getElementById("real-tran-price").innerHTML = real_final + " VND"

  
}

function formatUnit(){
    var value = document.getElementById("unit").value
    value = parseFloat(value.replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    console.log(value)
    console.log(value.replace(/,/g, ""))
    document.getElementById("unit").value = value
    
    document.getElementById("unit-price").value = value.replace(/,/g, "") 

    var final_price = parseInt(value.replace(/,/g, ""))*parseFloat(document.getElementById("acreage").innerHTML)+parseInt(document.getElementById("vat").value)

     final_price = parseFloat(final_price.toString().replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");


    gap =  parseInt(value.replace(/,/g, ""))*parseFloat(document.getElementById("acreage").innerHTML)*0.03

   gap = parseFloat(gap.toString().replace(/,/g, ""))
              .toFixed(0)
              .toString()
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",");


    document.getElementById("gap").innerHTML = gap

    document.getElementById("tran-price").innerHTML = final_price + " VND"

   var gap_final = parseFloat(document.getElementById("gap").innerHTML.replace(/,/g, ""))

      document.getElementById("gap_final").value = gap_final

      gap_final = parseFloat(gap_final.toString().replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementById("gap_final_display").innerHTML = gap_final


    final_price =  parseInt(document.getElementById("unit-price").value)*parseFloat(document.getElementById("acreage").innerHTML)  - parseFloat(document.getElementById("price_discount").value)+ parseFloat(document.getElementById("vat").value) -parseFloat(document.getElementById("gap_drop").value) + parseFloat(document.getElementById("inner_tax").value)
   

console.log("final")
console.log(final_price)
  document.getElementById("pay1").value = final_price;

  final_price = parseFloat(final_price.toString().replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");


  document.getElementById("paytext1").value = final_price;

}

function formatForId(id){
    var value = document.getElementById(id+"_display").value
    value = parseFloat(value.replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    console.log(value)
    console.log(value.replace(/,/g, ""))
    document.getElementById(id+"_display").value = value
    
    document.getElementById(id).value = value.replace(/,/g, "") 

    if(id=="price_discount"){
      var new_price = parseFloat(document.getElementById("pay1").value) - value.replace(/,/g, "") 
      console.log(new_price);
      document.getElementById("pay1").value = new_price

      new_price = parseFloat(new_price.toString().replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementById("paytext1").value = new_price


    }


    if(id =="gap_drop"){
      var gap_final = parseFloat(document.getElementById("gap").innerHTML.replace(/,/g, "")) - value.replace(/,/g, "") 

      document.getElementById("gap_final").value = gap_final

      gap_final = parseFloat(gap_final.toString().replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementById("gap_final_display").innerHTML = gap_final
var con = 0
 var con_discount = 0

  if("{{$zone->name}}".includes('LK')){

 if(parseInt("{{$zone->acreage}}") > 125){
    con = 1636685000
  }else{
    con = 1558055000

  }

var con_discount = document.getElementById("con_discount").value
}
    final_price =  parseInt(document.getElementById("unit-price").value)*parseFloat(document.getElementById("acreage").innerHTML) + con -con_discount - parseFloat(document.getElementById("price_discount").value)+ parseFloat(document.getElementById("vat").value) -parseFloat(document.getElementById("gap_drop").value) + parseFloat(document.getElementById("inner_tax").value)
   

console.log("final")
console.log(final_price)
  document.getElementById("pay1").value = final_price;

  final_price = parseFloat(final_price.toString().replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");


  document.getElementById("paytext1").value = final_price;


    }
  
}
var checkglole = 1;
function marriedCheck(){
  var check = document.getElementById("married").value
  var role = document.getElementById("married_role").value
  if (check ==1){
  document.getElementById("married_role").style.display = "none";
  document.getElementById("c2").style.display = "none";

  }else{

  document.getElementById("married_role").style.display = "block";
  document.getElementById("c2").style.display = "block";

  if(role == 1){
  document.getElementById("married_title").innerHTML = "Họ tên vợ"
  }else{
  document.getElementById("married_title").innerHTML = "Họ tên chồng"

  }
  }
}


function marriedRole(){
 var check = document.getElementById("married_role").value
  if (check ==1){
  document.getElementById("married_title").innerHTML = "Họ tên vợ"

  }else{

  document.getElementById("married_title").innerHTML = "Họ tên chồng"
  }
}

function loadData(){
  var con = 0;
  var con_discount = 0;

  document.getElementById("con1").style.display = "none";
  document.getElementById("con2").style.display = "none";
  var method = document.getElementById("trans_type").value; 
  if (method == 1){
  document.getElementById("final_method").innerHTML = " Đặt cọc "
  }else if(method == 2){
  document.getElementById("final_method").innerHTML = " Phân lô bán nền "



  }else{

  document.getElementById("final_method").innerHTML = " Mua bán nhà ở hình thành trong tương lai "


  if("{{$zone->name}}".includes('LK')){
  document.getElementById("con1").style.display = "block";
  document.getElementById("con2").style.display = "block";

  if(parseInt("{{$zone->acreage}}") > 125){
    document.getElementById("final_con").innerHTML = document.getElementById("con_discount_display").value+ "  1,636,685,000 VND"; 
    con = 1636685000
  }else{
    document.getElementById("final_con").innerHTML = document.getElementById("con_discount_display").value+ " 1,558,055,000 VND"; 
    con = 1558055000

  }
con_discount = document.getElementById("con_discount").value
  document.getElementById("final_con_discount").innerHTML = document.getElementById("con_discount_display").value+ "VND"; 

  }

  }


    document.getElementById("final_real").innerHTML = document.getElementById("real").value+ " VND"; 



    document.getElementById("final_real_total").innerHTML = document.getElementById("real-tran-price").innerHTML+ " VND"; 

  document.getElementById("final_unit").innerHTML = document.getElementById("unit").value;+ " VND" 
  document.getElementById("final_price").innerHTML = document.getElementById("tran-price").innerHTML;
  document.getElementById("final_price_discount").innerHTML = document.getElementById("price_discount_display").value+ " VND"; 

    document.getElementById("final_vat").innerHTML = document.getElementById("vatDisplay").innerHTML+ " VND"; 

      document.getElementById("final_tax").innerHTML = document.getElementById("taxDisplay").innerHTML+ " VND"; 



  final_price =  parseInt(document.getElementById("unit-price").value)*parseFloat(document.getElementById("acreage").innerHTML) + con -con_discount - parseFloat(document.getElementById("price_discount").value)+ parseFloat(document.getElementById("vat").value) -parseFloat(document.getElementById("gap_drop").value)+ parseFloat(document.getElementById("inner_tax").value)

    
    document.getElementById("final_input").value = final_price
  final_price = parseFloat(final_price.toString().replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
    document.getElementById("final_total").innerHTML = final_price + " VND"

  
 var check = document.getElementById("married").value
 var role = document.getElementById("married_role").value
 console.log(check)

document.getElementById("confirm_name1").innerHTML = document.getElementById("cname1").value


document.getElementById("confirm_bd1").innerHTML = document.getElementById("birth_day1").value


document.getElementById("confirm_phone1").innerHTML = document.getElementById("cphone1").value


document.getElementById("confirm_email1").innerHTML = document.getElementById("cemail1").value


document.getElementById("confirm_iden1").innerHTML = document.getElementById("cidentify1").value


document.getElementById("confirm_iden_date1").innerHTML = document.getElementById("ciden_date1").value


document.getElementById("confirm_location1").innerHTML = document.getElementById("clocation1").value

document.getElementById("confirm_address1").innerHTML = document.getElementById("caddress1").value



  if (check ==1){
  document.getElementById("confirm2").style.display = "none";
      document.getElementById("confirm_role1").innerHTML = "Tên khách hàng";

  }else{

    document.getElementById("confirm2").style.display = "block";
    document.getElementById("confirm_name2").innerHTML = document.getElementById("cname2").value


document.getElementById("confirm_bd2").innerHTML = document.getElementById("birth_day2").value


document.getElementById("confirm_phone2").innerHTML = document.getElementById("cphone2").value


document.getElementById("confirm_email2").innerHTML = document.getElementById("cemail2").value


document.getElementById("confirm_iden2").innerHTML = document.getElementById("cidentify2").value


document.getElementById("confirm_iden_date2").innerHTML = document.getElementById("ciden_date2").value


document.getElementById("confirm_location2").innerHTML = document.getElementById("clocation2").value

document.getElementById("confirm_address2").innerHTML = document.getElementById("caddress2").value
    if(role == 1){
      document.getElementById("confirm_role1").innerHTML = "Họ và tên chồng";
      document.getElementById("confirm_role2").innerHTML = "Họ và tên vợ";
    }else{
      document.getElementById("confirm_role1").innerHTML = "Họ và tên chồng";
      document.getElementById("confirm_role2").innerHTML = "Họ và tên vợ";

    }

  }
}

function loadAddon(){
  var id = document.getElementById("trans_type").value;
  $.ajax({
      type: "GET",
      url: '/trans-type-info/'+id,
      success: function (response) {
        html = '<td>Tùy biến</td><select name="task[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="taskselect" multiple>'
        for(i = 0; i < response.length;i++){
            html = html + '<option value='+response[i].id+'>'+response[i].name+'</option>'
        }
        html = html +"<option value='0'>Không</option></select><td>"
        document.getElementById("Addon").innerHTML = document.getElementById("Addon").innerHTML + html;

  $('#taskselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});

        document.getElementById("Addon").style.display="revert"
      }
    });
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  
function ChangePay(){
  var deposit = document.getElementById("deposit").value;
  if(deposit != 1){
    return;
  }

  pay = document.getElementById("payStep").value;
  document.getElementById("payStep").value = parseInt(document.getElementById("payStep").value) + 1;
  loadPayContent()
  for (i =1;i< parseInt(pay)+1; i++){
    var value = document.getElementById("paytext"+i).value
   
    document.getElementById("paytext"+(i+1).toString()).value = document.getElementById("paytext"+(i).toString()).value
    
    document.getElementById("pay"+(i+1).toString()).value = document.getElementById("pay"+(i).toString()).value 

    console.log("?????")
    console.log(document.getElementById("pay"+(i+1).toString()).value)
  }
  val = 200000000

  document.getElementById("pay1").value = val.toFixed(0);

  var val =  parseFloat(val.toString().replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");


  document.getElementById("paytext1").value = val;


  var newval = document.getElementById("pay2").value -document.getElementById("pay1").value ;

  document.getElementById("pay2").value = newval.toFixed(0);;

   var newval =  parseFloat(newval.toString().replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");


  document.getElementById("paytext2").value = newval;



}


  $(document).ready(function(){
    $('.bigstepBtn1').click(function(event){
      console.log("?????")
        //remove all pre-existing active classes
        $('.bigstep2').removeClass('show');
        $('.bigstep1').addClass('show');

        $('.bigstep3').removeClass('show');
        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });
    $('.bigstepBtn2').click(function(event){
      console.log("?????")
        //remove all pre-existing active classes
        $('.bigstep1').removeClass('show');
        $('.bigstep2').addClass('show');

        $('.bigstep3').removeClass('show');
        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });

    $('.bigstepBtn3').click(function(event){
        //remove all pre-existing active classes
        $('.bigstep1').removeClass('show');

        $('.bigstep2').removeClass('show');
        $('.bigstep3').addClass('show');
        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });
});

  $('#form_submit_btn').click(function(){
    console.log(document.getElementById("pay1").value);
    $('input').each(function() {
    if($(this).prop('required')){
        if(!$(this).val()){
            document.getElementById("my_notice").value="Vui lòng kiểm tra lại các trường thời gian còn thiếu"
            notifiWarning($("#my_notice").attr("notifi"));
           $(this).css({'border': '1px solid red'});
           return false;
        }else{
           $(this).css({'border': 'none'});
        }
      }
    });
});
</script>
  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
<script type="text/javascript">

    $('#consumer-table').DataTable();
</script>


<script src="/js-css/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  
  $('#staffselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});


</script>

@endsection
