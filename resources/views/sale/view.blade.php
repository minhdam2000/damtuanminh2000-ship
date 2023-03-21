@extends('layouts.index')
@section('content')
<script src="js-css/js/d3.min.js"></script>
<meta name="csrf-token" content="{!! csrf_token() !!}">      
<!-- DataTables -->
<link rel="stylesheet" href="js-css/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="js-css/css/stepprogressbar.css">

<style>  .popover-header {
    color: black;
  }
  .progress{
    min-height: 30px;
    background-color: transparent;
}
.progress-bar{
    font-size: 15px;
  }
.bg-info{
  min-width: 200px;
}

@media(max-width:700px) {
.bg-info{
  min-width: 150px;
}
.mydanger{
  min-width: 150px;
}
}

  /* Popup container - can be anything you want */
  .list-group-item{
    background-color:transparent!important;
    text-align: left;
  }
  .fananci-element {
    list-style-type: none;
    width: 100%;
    display: table;
    table-layout: fixed;
  }

  .fananci-list {
    display: table-cell;
    width: 30%;
    font-size: 20px;
  }
  .popup {
    display: none;
    position: absolute;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  /* The actual popup */
  .popup .popuptext {
    width: 160px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 8px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -80px;
  }

  /* Popup arrow */
  .popup .popuptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
  }

  /* Toggle this class - hide and show the popup */
  .popup .show {
    visibility: visible;
    -webkit-animation: fadeIn 1s;
    animation: fadeIn 1s;
  }

  /* Add animation (fade in the popup) */
  @-webkit-keyframes fadeIn {
    from {opacity: 0;} 
    to {opacity: 100;}
  }

  @keyframes fadeIn {
    from {opacity: 0;}
    to {opacity:1 ;}
  }
</style>

<div class="content-camera">
  <div class="session">
    @if(Session::has('notification'))
    <input hidden="" notifi="{{Session::get('notification')}}" value="1" id="notice_success">
    @endif
    @if(Session::has('warning'))
    <input hidden="" notifi="{{Session::get('warning')}}" value="1" id="notice_warning">
    @endif
  </div>
  <div class="row-content">

 <div class="row row-content">
      <div class="row-title-proxy">
    <ul class="nav nav-tabs" id="tabs" role="tablist"><li class="nav-item margin_center">
          <a id="tab0" class="nav-link  color-a"  data-toggle="tab" role="tab" href="#contentl0"> Tổng quan </a>
      </li>
      <!-- <li class="nav-item margin_center">
          <a id="tab1" class="nav-link  color-a"  data-toggle="tab" role="tab" href="#contentl1"> Tiến độ </a>
      </li> -->
       <li class="nav-item margin_center">
          <a id="tab2" class="nav-link  color-a"  data-toggle="tab" role="tab" href="#contentl2"> Thảo luận </a>

      </li>


    </ul>  <br><hr><br>

 <div class="tab-content">

          <div id="contentl0" class="tab-pane  in active">


     <div class="card card-custom">
                                                         
                                      <div class="card-header" data-toggle="collapse" data-target="#target0">
                                        <h3 class="card-title">
   Thông tin giao dịch</h3>
</div>
                                    
                                      <div class="card-body collapse show"  id="target0" >
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
                <td >Tổng chi phí phải thu:</td>
                <td id="final_total">{{number_format(floatval($zone->final_price), 0, ",", ".") }} VND</td>

              </tr>
                      
                <td >Đã thu: </td>
                <td id="final_method">
                  {{number_format(floatval($zone->done), 0, ",", ".") }} VND</td>

                <tr>

                     <tr>
                <td >Còn phải thu: </td>
                <td id="final_method">
                  {{number_format(floatval($zone->dept), 0, ",", ".") }} VND</td>
                <tr>
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
     <div class="card card-custom">
                                         <div class="card-header" data-toggle="collapse" data-target="#target2">
                                        <h3 class="card-title">
   Chi tiết giá</h3>
</div>
                                    
                                      <div class="card-body collapse"  id="target2" >



<table class="table-edit table-model">
                    <tbody class="table-edit">
            <tr>

                <td >Đơn giá: </td>
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
                <td >Tổng giá bất động sản: </td>
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


                
            </tbody></table>
  

</div></div>
</div>



    <div class="col-md-8 col-12 col-sm-12">
<div class="card card-custom">
                                                         
                                      <div class="card-header" data-toggle="collapse" data-target="#targetc0">
                                        <h3 class="card-title">
   Thông tin khách hàng</h3>
</div>
                                    
                                      <div class="row card-body collapse show"  id="targetc0" >

    <div class="col-md-6 col-12 col-sm-12">
      <div class="card card-custom">   
 <div class="card-header"  data-toggle="collapse" data-target="#targetc1">
                                        <h3 class="card-title">Thông tin khách 1</h3>
                  </div>
                                      <div class="card-body collapse show" id="targetc1" >
                       
  <h3>Tên khách hàng: {{$infomation->cname}}</h3> 
  <h3>Ngày sinh: {{date("d-m-Y", strtotime($infomation->birth_date))}}</h3>
  <h3>Địa chỉ: {{$infomation->address}}</h3>
  <h3>Số điện thoại: {{$infomation->phone_number}}</h3>
  <h3>Email: {{$infomation->email}}</h3>

  <hr> 
  <h3>Chứng minh thư: {{$infomation->identify_card}}</h3> 
  <h3>Ngày cấp: {{date("d-m-Y", strtotime($infomation->iden_date))}}</h3> 
  <h3>Nơi cấp: {{$infomation->iden_location}}</h3>  
  <hr>
<!--   <h3>Biểu mẫu: <a  download="{{$infomation->cname}}.docx" href="/storage/word/{{$zone_id}}.docx">Dowload</a></h3>   -->


  </div>
</div>
</div> 
@if($infomation->married == 2)
 <div class="col-md-6 col-sm-12 col-12">
      <div class="card card-custom">   
 <div class="card-header"  data-toggle="collapse" data-target="#targetc2">
                                        <h3 class="card-title">Thông tin khách 2</h3>
                  </div>
                                      <div class="card-body collapse show" id="targetc2" >
        
  <h3>Tên khách hàng: {{$consumer2->name}}</h3> 
  <h3>Ngày sinh: {{date("d-m-Y", strtotime($consumer2->birth_date))}}</h3>
  <h3>Địa chỉ: {{$consumer2->address}}</h3>
  <h3>Số điện thoại: {{$consumer2->phone_number}}</h3>
  <h3>Email: {{$consumer2->email}}</h3>

  <hr> 
  <h3>Chứng minh thư: {{$consumer2->identify_card}}</h3> 
  <h3>Ngày cấp:{{date("d-m-Y", strtotime($consumer2->iden_date))}}</h3> 
  <h3>Nơi cấp: {{$consumer2->iden_location}}</h3>  
  <hr>
<!--   <h3>Biểu mẫu: <a  download="{{$infomation->cname}}.docx" href="/storage/word/{{$zone_id}}.docx">Dowload</a></h3>   -->



  </div>
</div>
</div>
@endif
</div>




</div>

</div>

</div>

</div>

 <div class="card card-custom"> 
   <div class="card-header"  data-toggle="collapse" data-target="#targetcontact">
                                        <h3 class="card-title">
   Liên hệ</h3>

                         </div>  
              <div class="card-body collapse"  id="targetcontact" >
                         <div class="row">
                         <div class="col-md-12 col-12">         




                <h4 style="text-align: center;">Công ty Đông Dương Thăng Long</h4>
                <h4  style="text-align: center;">Đường 8B, Khối 7, Thị Trấn Xuân An, Huyện Nghi Xuân, Tỉnh Hà Tĩnh, Việt Nam</h4>
                </div>
                            <div class="col-md-6 col-12">       


  <table class="table-edit table-model">
                    <tbody class="table-edit">

              <tr>
                <td>Điện thoại:</td>
                <td>02393565555</td>
              </tr>


              <tr>
                <td>Email</td>
                <td>phc.dongduongthanglong@gmail.com</td>
              </tr>

              <tr>
                <td>Tổng giám đốc</td>
                <td>Trần Thanh An</td>
              </tr>


              <tr>
                <td>Điện thoại:</td>
                <td>0377814088</td>
              </tr>


                            
                          </td>
                        </tr>
                      </tbody>
                    </table></div>
                         <div class="col-md-6 col-12">       


  <table class="table-edit table-model">
                    <tbody class="table-edit">
                        
              <tr>
                <td>Trưởng Phòng kinh doanh</td>
                <td>Trần Thị Nhung</td>
                           </tr>
                            
              <tr>
                <td>Điện thoại:</td>
                <td>0377814088</td>
              </tr>


              <tr>
                <td>Môi giới:</td>
                <td>{{$infomation->sname}}</td>
              </tr>
   
              <tr>
                <td>Điện thoại:</td>
                <td>{{$infomation->sphone}}</td>
              </tr>



                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
  <hr>

  <hr>
</div>
</div>


 <div class="card card-custom"> 
   <div class="card-header"  data-toggle="collapse" data-target="#target3">
                                        <h3 class="card-title">
   Tiến độ thanh toán chi tiết</h3>
</div>
              <div class="card-body collapse show"  id="target3" >

<?php
$step_total = $zone->done;
$total = $zone->final_price;
$dept = $zone->dept;
$done_flag = 1;

$percent =   round(floatval($zone->done/$zone->final_price),2)*100;
if ($percent > 10){
$text1 = 'Đã đóng: '.number_format(floatval($step_total)).' VND('.$percent.'%)';
}else{
  $text1 = "";
}

if (100 - $percent > 10){
  $p = 100 - $percent;
$text2 = 'Còn lại: '.number_format(floatval($dept)).' VND('.$p.'%)';
}else{
  $text2 = "";
}
?>


<div class="progress ">

  <div class="progress-bar bg-success mydanger" style="width:{{$percent}}%" title="Thông tin chi tiết" data-placement="bottom" data-trigger="hover" data-toggle="popover" 
   data-html="true"  data-content='Đã đóng: {{number_format(floatval($step_total))}} VND({{$percent}}%)'>
    {{$text1}}
  </div>
  <div class="progress-bar bg-danger mydanger" style="width:{{100-$percent}}%" title="Thông tin chi tiết" data-placement="bottom" data-trigger="hover" data-toggle="popover" 
   data-html="true"  data-content='Còn lại: {{number_format(floatval($dept))}} VND({{100 - $percent}}%)'>
   {{$text2}}
  </div>
  </div>

   <div class="progress">
  <?php
  $i  = 1;
foreach($pays as $pay){

  $percent  = round(floatval($pay->money/$zone->final_price),2)*100;
  if($percent < 10){
    $text = "";
  }else{

   $text =  'Tiến độ đợt '.$i.'('.number_format(floatval($pay->money), 0, ",", ".").' VND)';
  }
?>
 <div class="progress-bar" style="width:{{$percent}}%;border-right: 3px solid;" title="Thông tin chi tiết" data-placement="bottom" data-trigger="hover" data-toggle="popover" 
   data-html="true"  data-content='Tiến độ đợt {{$i}} <br>Số tiền ({{number_format(floatval($pay->money), 0, ",", ".")}} VND)<br><i class="fa fa-calendar" aria-hidden="true"></i> Ngày kết thúc: {{date("d-m-Y", strtotime($pay->date))}}<br>' >
   {{$text}}
  </div>
<?php

  $i  = $i + 1;
}
  ?>
  
  </div>
<hr><br><hr>


     <table id="camera-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                           
                            <th>Tiến độ đợt</th>
                            <th>Số tiền</th>
                            <th>Đã đóng</th>
                            <th>Hạn cuối</th>
                            <th  class = "center-td">Chi tiết</th>
                          </tr>
                        </thead>
                        <tbody class="tbody">

 @foreach($pays as $pay)


                          <tr>
 <td> <span  > Tiến độ đợt {{$pay->step}} </span></a></td>
<?php
if($step_total > $pay->money ){
  $done =  $pay->money;
  $step_total = $step_total-$pay->money; 
}else if($done_flag > 0){
  $done  = $step_total;
  $done_flag = 0;

}else{
  $done = 0;
}


?>

 
<td>{{number_format(floatval($pay->money), 0, ",", ".")}} VND</td>
<td>{{number_format(floatval($done), 0, ",", ".")}} VND</td>

<td>{{date("d-m-Y", strtotime($pay->date))}}</td>
    <td class = "center-td"><a href="sale/pay/{{$index}}/<?=$pay->id?>" type="button"  class="preview" > <img src="/js-css/img/icon/open.png"> </a></td>


</tr>
 @endforeach
</tbody>
</table>

              </div>
            </div>

 <div class="card card-custom"> 
   <div class="card-header"  data-toggle="collapse" data-target="#target4">
                                        <h3 class="card-title">
   Tiến độ giao dịch</h3>
</div>


              <div class="card-body collapse show"  id="target4" >

<div class="tab-content">
<div id="content1" class="tab-pane  in active">

  <div id="SystemContent">

  </div>

</div>



</div>
</div>

</div>


<?php
 if(Auth()->user()->role_id != 27){

  ?>

  <div class="card card-custom"> 
   <div class="card-header"  data-toggle="collapse" data-target="#targeti">
                                        <h3 class="card-title">
   Chi tiết hoa hồng </h3>

                         </div>           
              <div class="card-body collapse"  id="targeti" >
<h4>Người hưởng:{{$infomation->sname}} </h4>


  <table class="table-edit table-model">

                    <tbody class="table-edit">
                        <thead>
                          <tr>
                            <td></td>
                            <td>Số tiền</td>
                            <td>Chi tiết</td>
                          </tr>
                        </thead>
         <tr>
    <td>Tổng </td>
    <td>{{number_format($zone->gap, 0, ",", ".") }} VND</td>
    <td></td>
  </tr>

  <tr>
    <td>Đã nhận</td>
    <td>{{number_format($zone->gap*($zone->done/$zone->final_price), 0, ",", ".") }} VND</td>
    <td><a href="sale/gap/{{$index}}" type="button" class="preview"> <img src="/js-css/img/icon/open.png"> </a></td>

  </tr>
                      </tbody>
                    </table>


</div>
</div>

<?php

}
 ?>


 <?php
          if(Auth()->user()->role_id != 5 && Auth()->user()->role_id != 27){

          ?>
 <div class="card card-custom"> 
   <div class="card-header"  data-toggle="collapse" data-target="#targetedit">
                                        <h3 class="card-title">
   Chỉnh sửa hợp đồng </h3>

                         </div>           
              <div class="card-body collapse"  id="targetedit" >

<form action="reset-zone" method="post">
   <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" value=" {{$zone->id}}" id="rid" name="id" class="input-edit modol-text" >

        <input type="hidden" value=" {{$infomation->cid}}" id="cid" name="cid" class="input-edit modol-text" >


  <table class="table-edit table-model">
                    <tbody class="table-edit">
                        
              <tr>
                            <td><i class="fa fa-credit-card" aria-hidden="true"></i>Hủy hợp đông || Lý do</td>
                            <td><input type="" value="" name="content" class="input-edit modol-text" required="">
 <input value="" style="display:none" type="number" id="vat" name="vat">    
                            <button class="btn btn-model">Hủy </button>
                            </td>
                        </tr>
                      
 <input value="" style="display:none" type="number" id="real_price" name="real_price">  
                        </tr>
                    
                        <tr>
                          <td>
                            <a href="/sale/update/{{$index}}" class="btn btn-model">Sửa khách hàng </a>
                          <!--   <a href="/sale/create-consumer/{{$index}}" class="btn btn-model">Tạo tài khoản khách hàng </a>
                             -->
                          </td>
                        </tr>
                      </tbody>
                    </table>
</form>
  <hr>
</div>
</div>
<?php
}
?>
</div>
</div> <div id="contentl2" class="tab-pane  fade">
           
            <div id="job_detail2"></div>
            <h4>Danh sách bình luận</h4>
          <table id="job-cmt" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Người bình luận </th>
                            <th>Nội dung </th>
                            <th>Thời gian</th>
                          </tr>
                        </thead>
                        <tbody class="tbody" id="job_history">
                          @foreach($zone_cmt as $zone_cmt)
                        <tr class="color-add">
                          <?php
                          $temp_user = DB::table("users")->where("id",$zone_cmt->user_id)->first()->name
                          ?>
                          <td>{{$temp_user}}</td>
                          <td>
                            {!! $zone_cmt->content !!}
                            <?php 
                            $url = DB::table("zone_comments_url")->where("cmt_id",$zone_cmt->id)->pluck('url')->toArray();
                            ?>
                <div class="form-group" id="listimg">
                          @foreach($url as $url)
                          
<a target="_blank" href="{{$url}}"><img style="width: 300px;margin-left: 3%;" src="{{$url}}" id="listimg" class="preview"></a>
                      @endforeach
                      </div>
                          </td>
                          <td>{{$zone_cmt->created_at}}</td>
                          
                        </tr>
                      @endforeach
                        </tbody>
                      </table>
                      <hr><br>
               <form action="/zone-comments"  enctype="multipart/form-data" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" id="zone_id" value="{{$zone_id}}" name="zone_id">
                        <div class="form-group">
                            <label>Bình luận mới</label>
                       <textarea  name="content" class="ckeditor form-control " cols="20" rows="5"></textarea>
                        </div>
                        
            
                        <div class="form-group">
                    <input style="display: none" type="file" name="file[]" class="file"
                    multiple>

                    <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Tải tệp lên" id="file">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Chọn</button>
                        </div>
                    </div>
                <div class="form-group" id="preview">
                </div>
                <div class="form-group" id="preview-file"></div>

                </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Trả lời" class="btn btn-primary">
                    </div>
    
                    </form>



          </div>
</div>
</div>

<div class="popup" id="popup">
  <div class="popuptext" id="myPopup">

  </div>
</div>

<!-- Modal -->
     <div class="modal fade" id="infomation" role="dialog">
          <div class="modal-dialog" style="max-width: 1000px;">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label id="partitionTitle"></label>
              </div>
              <div class="notification"></div>
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div id="InfoContent" class="modal-body">
                  </div>
            </div>
          </div>
      </div>


  <div class="modal fade modol-text" id="taskModal" role="dialog">
          <div class="modal-dialog model-right" style="max-width: 800px">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Chỉnh sửa yêu cầu </label>
              </div>
              <div class="notification"></div>
              <form action="process/update-task-info" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" id="TaskIdInput" name="id" value="">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties"><b class="required">* </b>Thời gian bắt đầu</td>
                                <td>
<input type="date" class="input-edit modol-text form-control" name="start_date" id="TaskSdateInput" required="">

                                  <!-- <input type="" value="" name="start_date" class="input-edit modol-text" id="TaskSdateInput" required=""></td> -->
                            <tr>
                            </tr>
                                <td class="cam-properties"><b class="required">* </b> Số ngày</td>
                                <td><input type="" value="" name="duration" class="input-edit modol-text" id="TaskDurationInput" required=""></td>
                                <input value = "{{$index}}" type="hidden" name="index" class="form-control">
                            </tr>
                            </tr>
                                <td class="cam-properties"><b class="required">* </b> Thông tin thêm </td>
                                <td><textarea  type="" value="" name="moreinfo" class="input-edit modol-text form-control" id="partition" >
</textarea></td>
                            </tr>
                             

                            <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Add &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Cancel</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>
<input type="hidden"  value="2" id="tempType">    
<input type="hidden"  value="1" id="tempDate">   


<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
</div>
<div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
</div>

<!-- Thay doi cau hinh  -->

<script type="text/javascript" src="js-css/js/socket.io.js"></script>

<style type="text/css">
  #zone .modal-dialog {
    max-width: 1000px;
  }

  #zone .modal-body {
    padding: 0em;
  }

  #zone .modal-content{
    padding: 1em;
  }

  #zone .modal-dialog {
    top: 150px;
  }

</style>

<div class="overlay-dark"></div>
<embed class="img-overlay">
 <script type="text/javascript">
  var DepartmentNameList = []
  var DepartmentIndex = []
  var StepList = []
  var StepIndex = []
  var StepAction = []
  var StepPos = []
  var StepDes= []
  var StepLegal = []
  var StepCase= []


  var SubStepList = []
  var SubStepIndex = []
  var SubStepDes = []
  var SubStepLegal = []

  function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
    try {
      decimalCount = Math.abs(decimalCount);
      decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

      const negativeSign = amount < 0 ? "-" : "";

      let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
      let j = (i.length > 3) ? i.length % 3 : 0;

      return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
    } catch (e) {
      console.log(e)
    }
  };



  function getProcess(){
    $.ajax({
      type: "GET",
      url: '/process/process-list/',
      success: function (response) {
        console.log("process list")
        response = (JSON.parse(response))
        console.log(response)
      }

    });
  }

  function getProcessDetail(id){

    $.ajax({
      type: "GET",
      url: '/sale/process-detail/' + id+"/{{$zone_id}}",
      success: function (response) {
        console.log("process detail")
        response = (JSON.parse(response))
        console.log(response)
        html = '<div class="arrow-steps clearfix" id="processtabs">'

        for(var i =0; i < response.length; i++){
          StepCase.push(response[i].case)
          StepList.push(response[i].status)
          StepIndex.push(response[i].sid)
          StepAction.push(response[i].action)
          StepPos.push(response[i].pos)
          StepDes.push(response[i].des)
          StepLegal.push(response[i].legal)
          // html = html +'<li class="nav-item margin_center"><a  onclick="getStepDetail('+response[i].sid+')"  class="nav-link color-a " >'+response[i].step_name+'</a></li>'
          // html = html + '<div class="myprocess step" id="myprocess'+response[i].sid+'" onclick="getStepDetail('+response[i].sid+','+"'myprocess'"+')"> <span>'+response[i].step_name+'</span></div>' 

        html = html + "<h2 id='myprocess"+response[i].sid+"'>Giai đoạn "+(i+1).toString()+": "+response[i].step_name+"</h2><hr>"
         html = html +"<div id = 'processContent"+response[i].sid+"'></div><hr><br>" 

        }


        html = html + "</div>"

        document.getElementById("SystemContent").innerHTML = html;
         for(var i =0; i < response.length; i++){       


        getStepDetail(response[i].sid,"myprocess")
          }




        // if(StepList.includes(0)){
        //   document.getElementById("FinalStatus").innerHTML = "<span style='color:red'>Đang tiến hành</span>"
        // }else{
        //   document.getElementById("FinalStatus").innerHTML = "<span style='color:green'>Đã hoàn thành</span>"

        // }
      }


    });
  }

  function getStepDetail(id,prefix){

        console.log("step detail")
    console.log(StepList)
    console.log(pos)
   console.log(StepList)
    $("."+prefix).removeClass('current')
    $("#"+prefix+id).addClass('current');
    var pos = StepIndex.indexOf(id);
    // for (var i = 0; i < StepIndex.length; i ++){
    //   console.log(StepIndex[i]);
    //   document.getElementById(prefix+StepIndex[i]).style.color =   "white";

    // }
    // document.getElementById(prefix+id).style.color =   "yellow";
    // for (var i = 0; i < pos; i ++){
    //   if (StepList[i] == 1){
    //     document.getElementById(prefix+StepIndex[i]).style.color =   "green";

    //   }else if (StepList[i] == 2){
    //     document.getElementById(prefix+StepIndex[i]).style.color = "green";
        
    //   }else if (StepList[i] == 3){
    //     document.getElementById(prefix+StepIndex[i]).style.color = "red";
        
    //   }
    // }
    document.getElementById("processContent"+id).innerHTML=""

   // StepList= []
   // StepIndex= []
   // StepAction= []
   // StepPos = []
  SubStepList = []
   SubStepIndex = []
   SubStepDes = []
   SubStepLegal = []
    $.ajax({
      type: "GET",
      url: 'sale/step-detail/' + id+"/{{$zone_id}}",
      success: function (response) {
        response = (JSON.parse(response))
              // console.log(response)
              if (response[0] != 0){
                var content = ''
                for(var i =1; i < response.length; i++){
                  SubStepIndex.push(response[i][0])
                  SubStepList.push(response[i][2])
                  SubStepDes.push(response[i][3])
                  SubStepLegal.push(response[i][4])
                  console.log(response[i][1])

                  if (response[i][2] == 0){
                    name = '<i style="color:red" class="fa fa-star" aria-hidden="true"></i> <span id="subtabsmenu'+response[i][0]+'" style="color:red">'+response[i][1]+'</span>'
                  }else if (response[i][2] == 3){
                    name = '<i style="color:red" class="fa fa-star" aria-hidden="true"></i> <span id="subtabsmenu'+response[i][0]+'" style="color:green">'+response[i][1]+'</span>'
                  }else{
                    name = '<i style="color:green" class="fa fa-star" aria-hidden="true"></i> <span id="subtabsmenu'+response[i][0]+'" style="color:green">'+response[i][1]+'</span>'
                  }

                  // content = content +'<li class="nav-item margin_center"><a id="tab1"  onclick="getSubstepDetail('+response[i][0]+','+response[i][2]+')" >'+name+'</a></li>'
                  content = content + 
                '<li class="submenu list-group-item"><a> <h3>'+name+'</h3></a> <ul class="ul_submenu fananci-element" id = "subcontent'+response[i][0]+'"  style="display: none;"></ul></li>'
                }
                // console.log(content)
                document.getElementById("processContent"+id).innerHTML = content

                for(var i =1; i < response.length; i++){

                getSubstepDetail(response[i][0],response[i][2])
              }
                //  for(var i =1; i < response.length; i++){
                //   console.log(response[i][0])
                //   if(response[i].length > 0){
                //     var inner = JSON.parse(response[i][2])
                //      if (inner.length > 0){
                //     genInnerTasks("innerContent",inner)    
                //   }
                //     var outner = JSON.parse(response[i][3])
                //      if (outner.length > 0){
                //     genInnerTasks("outerContent",outner)    
                //   }

                //     var out_process = JSON.parse(response[i][4])
                //      if (out_process.length > 0){
                //     genInnerTasks("processContent",out_process)    
                //   }


                //     // console.log("inner")
                //     // console.log(inner)
                //     // console.log("outner")
                //     // console.log(outner)
                //     // console.log("out_process")
                //     // console.log(out_process)

                //   }
                // }
              }else{
                // var html = '<div id = "innerContent"></div>'
                // if(StepList[StepIndex.indexOf(id)] != 2){
                //   html = html  + ' <button type="button" onclick="showStepInfo('+id+')" style="float:right" class="camera-button my-custom-button"> Chi tiết </button>'
                // }
                // document.getElementById("processContent"+id).innerHTML = html
                // console.log("demo")
                // console.log(pos)
                if (JSON.parse(response[1]).length > 0){
                  console.log("begin inner task")
                  console.log(id)
                  console.log(JSON.parse(response[1]))
                  genInnerTasks("processContent"+id,JSON.parse(response[1]),0,0)    
                }else{
                 html ='<div class="row">'
                 html = html + '<div class="col-md-6 col-12">'  

 html =html + '<h3>Khách hàng</h3>'

                html = html +  ' <table id="inner-table"  class="nvr-table "><thead><tr class="thead"><th  style= "width: 60%">Đợt thanh toán</th><th   class = "center-th" style= "width: 25%" >Hạn chót</th><th   class = "center-th" style= "width: 15%" >Chi tiết</th></tr></thead><tbody class="tbody">'

 @foreach($pays as $pay)
 html =html + '<tr >'
 html =html + '<td> <span > Tiến độ đợt {{$pay->step}} ({{number_format(floatval($pay->money), 0, ",", ".")}} VND) </span></a></td>'


 html =html + '<td class="center-td"> <span > {{date("d-m-Y", strtotime($pay->date))}}</span></a></td>'
  html =html +'<td class = "center-td"><a href="sale/pay/{{$index}}/<?=$pay->id?>" type="button"  class="preview" > <img src="/js-css/img/icon/open.png"> </a></td>'
html =html +'</tr>'
@endforeach



                html = html + '</tbody></table></div>'


                 html = html + '<div class="col-md-6 col-12">'  

 html =html + '<h3>Công ty</h3>'


                html = html +  ' <table id="inner-table"  class="nvr-table "><thead><tr class="thead"><th  style= "width: 75%">Tên tài liệu</th><th   class = "center-th" style= "width: 25%" >Chi tiết</th></tr></thead><tbody class="tbody">'

 @foreach($lock as $lock)
 html =html + '<tr >'
 html =html + '<td> <span >  {{$lock->name}} </span></a></td>'

  html =html +'<td class = "center-td"><a target="_blank" href="<?=$lock->url?>" type="button"  class="preview" > <img src="/js-css/img/icon/open.png"> </a></td>'
html =html +'</tr>'
@endforeach



                html = html + '</tbody></table></div>'

                html = html + "</div>"
                  document.getElementById("processContent"+id).innerHTML = html
                }
                // if (JSON.parse(response[2]).length > 0){
                //   genOuterTasks("outerContent",JSON.parse(response[2]),0)    
                // }
                // if (JSON.parse(response[3]).length > 0){
                //   genProcessTasks("processContent",JSON.parse(response[3]),0)    
                // }
              }
            }
            
          });
}




function editTask(id){
        document.getElementById("TaskIdInput").value = id
        document.getElementById("TaskSdateInput").value = document.getElementById("start_date"+id).innerHTML
        document.getElementById("TaskDurationInput").value = document.getElementById("duration"+id).innerHTML
        $("#taskModal").modal()
}

function showStepInfo(id){
        document.getElementById("InfoContent").innerHTML = '<div>'+StepDes[StepIndex.indexOf(id)]+'</div><div>'+StepLegal[StepIndex.indexOf(id)]+'</div>'
        $("#infomation").modal()
}
function showSubstepInfo(id){
  // console.log("++++++++++++++++++++++++++++++++++++++")
  // console.log(SubStepIndex.indexOf(id))
  // console.log(SubStepDes[SubStepIndex.indexOf(id)])
  // console.log(SubStepLegal[SubStepIndex.indexOf(id)])
  document.getElementById("InfoContent").innerHTML = '<div>'+SubStepDes[SubStepIndex.indexOf(id)]+'</div><div>'+SubStepLegal[SubStepIndex.indexOf(id)]+'</div>'
  $("#infomation").modal()
}

// showSubstepInfo
function getSubstepDetail(id,status){
  // console.log("test")
  // console.log(id)
  // var prefix="subtabsmenu"
  // var pos = SubStepIndex.indexOf(id);
  // for (var i = 0; i < SubStepIndex.length; i ++){
  //   document.getElementById(prefix+SubStepIndex[i]).style.color =   "white";

  // }
  // document.getElementById(prefix+id).style.color =   "yellow";

  // for (var i = 0; i < pos; i ++){
  //   if (SubStepList[i] == 1){
  //     document.getElementById(prefix+SubStepIndex[i]).style.color =   "blue";

  //   }else if (SubStepList[i] == 2){
  //     document.getElementById(prefix+SubStepIndex[i]).style.color = "green";

  //   }else if (SubStepList[i] == 3){
  //     document.getElementById(prefix+SubStepIndex[i]).style.color = "red";

  //   }
  // }
  // document.getElementById("subtabsmenu"+id).style.color =   "yellow";

  var html  = ""
  // console.log(status)
  // if (status ==  0){
  //   html = '<form id="UpdateStep'+id+'" action="process/update-step-status"  enctype="multipart/form-data" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}"><input value = "'+id+'" type="hidden" name="step_id" class="form-control"><input value = "{{$index}}" type="hidden" name="index" class="form-control"><input value = "1" type="hidden" name="type" class="form-control"> <br><button type="button" onclick="UpdateStep('+id+')" style="float:right" class="camera-button my-custom-button"> Triển khai </button><button type="button" onclick="showSubstepInfo('+id+')" style="float:right" class="camera-button my-custom-button"> Chi tiết </button> </form>'
  // }else if(status ==  3){
  //   html = '<form  id="UpdateStep'+id+'" action="process/update-final-status"  enctype="multipart/form-data" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}"><input value = "'+id+'" type="hidden" name="step_id" class="form-control"><input value = "{{$index}}" type="hidden" name="index" class="form-control"><input value = "1" type="hidden" name="type" class="form-control"> <br><button  type="button" onclick="UpdateStep('+id+')" style="float:right" class="camera-button my-custom-button"> Cập nhật  </button> <button type="button" onclick="showSubstepInfo('+id+')" style="float:right" class="camera-button my-custom-button"> Chi tiết </button></form>'

  // }
  // document.getElementById("subUpdateBtn").innerHTML = html;
  $.ajax({
    type: "GET",
    url: '/sale/substep-detail/' + id,
    success: function (response) {
      console.log("substep detail")
      // console(response)
      response = (JSON.parse(response))
      // console.log(response)
    var pos = StepIndex.indexOf(id);
      if (response.length > 0)
      genInnerTasks("subcontent"+id,response,1,html,pos)    
      
    }


  });
}
function getFormattedDate(mydate) {
  var date = new Date(mydate);
    let year = date.getFullYear();
    let month = (1 + date.getMonth()).toString().padStart(2, '0');
    let day = date.getDate().toString().padStart(2, '0');
  
    return day + '-' + month + '-' + year;
}


function genInnerTasks(objectid, innerList,type,pos){
  html = ""
  html = html +  ' <table id="inner-table"  class="nvr-table "><thead><tr class="thead"><th  style= "width: 40%">Yêu cầu</th><th   class = "center-th" style= "width: 15%" >Ngày ký</th><th   class = "center-th" style= "width: 15%" >Ngày đến hạn</th><th style= "width: 10%" class = "center-th">Biểu mẫu</th><th style= "width: 10%" class = "center-th">Minh chứng</th><th style= "width: 10%" class = "center-th">Trạng thái </th></td></tr></thead><tbody class="tbody">'
  for(var i = 0;i < innerList.length; i++){

    if (innerList[i].status == 1){
      html = html + "<td><b style= 'color:green'>" +innerList[i].name +"</b></td>"
    }else{
      html = html + "<td><b style= 'color:red'>" +innerList[i].name +"</b></td>"
    }
    
     if(innerList[i].start_date == null){
     html = html + "<td id='start_date"+innerList[i].id+"'' class = 'center-td'></td>"
}else{
html = html + "<td id='start_date"+innerList[i].id+"'' class = 'center-td'>"+getFormattedDate(innerList[i].start_date)+"</td>"
}
 if(innerList[i].end_date == null){
     html = html + "<td id='end_date"+innerList[i].id+"'' class = 'center-td'></td>"
}else{
html = html + "<td id='end_date"+innerList[i].id+"'' class = 'center-td'>"+getFormattedDate(innerList[i].end_date)+"</td>"
}
html =  html + '<td class = "center-td"><a download="{{$infomation->cname}}'+innerList[i].url+'.docx" href="/storage/word/'+innerList[i].url+'-{{$zone_id}}.docx" class="preview"><img src="/js-css/img/icon/dowload.png"></a></td>'
    if (innerList[i].file_flag == 0){
     html = html + "<td class = 'center-td'>Không</td>"
   }else{
    if (innerList[i].status == 0 ){
      html = html + '<td class = "center-td"> <form id="uploadfile'+innerList[i].id+'" action="sale/add-task-file"  enctype="multipart/form-data" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}">  <label  class="preview" for="file-input"><img onclick="openfileupload('+innerList[i].id+')"  src="/js-css/img/icon/upload.png"></label><input id= "inputfile'+innerList[i].id+'" style="display:none" onchange="uploadsubmit('+innerList[i].id+')" value = "Tải lên" type="file" name="file[]" class="custom-file-input"" multiple> <input value = "'+innerList[i].id+'" type="hidden" name="step_id" class="form-control"><input value = "'+type+'" type="hidden" name="type" class="form-control"><input value = "{{$index}}" type="hidden" name="index" class="form-control"></form> </td>'
   html = html + '<td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/close.png"></td>'
    }else{
      html = html + '<td class = "center-td"></button><a class="preview" href = "sale/file/{{$index}}/'+innerList[i].id+'"><img src="/js-css/img/icon/open.png"></a></td>'
   html = html + '<td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/success.png"></td>'
    }
  }
// <button onclick="loadFile('+"'"+innerList[i].name+"'"+','+"'"+innerList[i].url+"'"+')" class="preview" type="button"><img src="/js-css/img/icon/file.png">

   // html = html + '<td class = "center-td"><button onclick="editTask('+innerList[i].id+')" class="preview" type="button"><img src="/js-css/img/icon/write.png"></td>'
 html = html + "</tr>"

}

html = html + '</tbody></table>'
if ({{$index}} ==1 || type == 0) {
document.getElementById(objectid).innerHTML = html  

}else{
document.getElementById(objectid).innerHTML = html+ myhtml;     
}
}

               function getDepartmentHtml(id,type){
                var html = '<td ><form id="chooseDepartment'+id+'"  action="process/update-outner-department"  enctype="multipart/form-data" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}"> <select  onchange="updateDepartment('+id+')" class="custom-select select-profile  browser-default" name="department_id"><option  value="">Không</option>'

                for(var i =0; i < DepartmentNameList.length; i++){
                  html = html +'<option  value="'+DepartmentIndex[i]+'">'+DepartmentNameList[i]+'</option>'
                }

                html = html + '</select><input value = "'+id+'" type="hidden" name="id" class="form-control"><input value = "'+type+'" type="hidden" name="type" class="form-control"><input value = "{{$index}}" type="hidden" name="index" class="form-control"></form></td>'
                return html;

              }

           
     // getProcess()
     console.log("test")
     getProcessDetail({{$process_id}})
     // getStepDetail(2)

     function UpdateStep(id){ 
      swal({
        title: "",
        text: " Bạn có chắc chắc muốn cấp nhật tiến độ? ",
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
            document.getElementById("UpdateStep"+id).submit();
            swal.close();
          }
          else {
            swal.close();
          }
        });

    }
     function uploadsubmit(id){ 
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
      document.getElementById("uploadfile"+id).submit();
            swal.close();
          }
          else {
            swal.close();
          }
        });

    }
    
     function uploadPaysubmit(id){ 
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
      document.getElementById("uploadPayfile"+id).submit();
            swal.close();
          }
          else {
            swal.close();
          }
        });

    }

    function updateDepartment(id){
      swal({
        title: "",
        text: " Bạn có chắc chắc với lựa chọn này ? ",
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
            document.getElementById("chooseDepartment"+id).submit();
            swal.close();
          }
          else {
            swal.close();
          }
        });
    }
    function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }


    function openPayupload(id){
            document.getElementById("inputpay"+id).click();
    }
    function updateStatus($id){ 
      swal({
        title: "",
        text: " Bạn có chắc chắc điều kiện đã hoàn thành ? ",
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
            document.getElementById("updateStatus"+$id).submit();
            swal.close();
          }
          else {
            swal.close();
          }
        });
    }

    $("#search-input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#zone-table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  </script>

  <!-- DataTables -->
  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>

  <script type="text/javascript">
    $('#staff-table').DataTable({
      "order": [[ 3, "desc" ]]
    })
    $('#area-table').DataTable({
      "order": [[ 3, "desc" ]]
    })
    $('.dataTables_length').addClass('bs-select');
    $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
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

    $("#SystemContent").on("click", "h3", function(e) {
      e.preventDefault();
      $(this).closest("li").find("[class^='ul_submenu']").slideToggle();
    });
   
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
    $('[data-toggle="popover"]').popover();   
      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }
    });


function formatForId(id){
    var value = document.getElementById(id+"_display").value
    value = parseFloat(value.replace(/,/g, ""))
                    .toFixed(2)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    console.log(value)
    console.log(value.replace(/,/g, ""))
    document.getElementById(id+"_display").value = value
    
    document.getElementById(id).value = value.replace(/,/g, "") 
  
}
  function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }
    
        $(document).on("click", ".browse", function() {
          var file = $(this)
            .parent()
            .parent()
            .parent()
            .find(".file");
          file.trigger("click");
        });
      
        $('input[type="file"]').change(function(e) {
            
          var html = ""
            for (var i = 0; i < e.target.files.length;i++){
          var fileName = e.target.files[i].name;
          console.log(fileName)
          // $("#file").val(fileName);
        if (fileName.includes(".png") || fileName.includes(".jpg") || fileName.includes(".jepg")){
          var reader = new FileReader();
          var myElement =  $(this).parent()
            .find("#preview-file")
          reader.onload = function(e) {
            // get loaded data and render thumbnail.
          html  = html + '<img style="width: 200px;margin-left: 3%;" src="'+e.target.result+'" id="preview" class="preview">';
             console.log(myElement.html())
           myElement.html( myElement.html()+html);
          console.log(myElement.html())

          };
       
          reader.readAsDataURL(this.files[i]);
      }else{
            // get loaded data and render thumbnail.
        console.log(fileName)
          html  = html + '<p><img width="25" height = "25" src="/js-css/img/icon/write.png">' + fileName+ "<p>"; 
            $(this)
            .parent()
            .find("#preview-file").html( $(this).parent().find("#preview-file").html()+html);
          
  }
}
});
  </script>
  <script type="text/javascript">
    /**/
    function viewStep(event){
      $(".step").removeClass('current')
      // console.log(event)
      event.classList.add('current');
    }

  </script>

  <style type="text/css">
    #staff-table_filter{
      float: right
    }
    .chart-circle {
      text-align: center;
      padding: 20px;
    }

    .chart-circle canvas {
      display: inline; 
      width: 100%; 
      height: auto;
    }

    .chart_ {
      padding: 20px;
      text-align: center;
    }

    .card-header .wrapper {
      background: #2b3c46;
      margin-bottom: 15px;
    }

    .line-col {
      display: inline; width: 100%;
    }
  </style>
  @endsection