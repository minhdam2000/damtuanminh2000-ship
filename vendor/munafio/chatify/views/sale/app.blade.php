@include('Chatify::saleLayouts.headLinks')

<link rel="stylesheet" href="/js-css/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="/js-css/css/stepprogressbar.css">
<style>

  @media screen and (-webkit-min-device-pixel-ratio:0) { 
  select:focus,
  textarea:focus,
  input:focus {
    font-size: 16px;
  }
}

@media screen and (-webkit-min-device-pixel-ratio:0) { 
  select,
  textarea,
  input {
    font-size: 16px;
  }
}


    a {
    color: #3490dc;
    text-decoration: none;
    background-color: transparent;
}

   table {
    font-size:18px;
  border-collapse: collapse;
  width: 100%;
  color: #dcf3ff;
}



td, th {
/*  border: 1px solid #afafaf;*/
  text-align: left;
  padding: 10px 8px 10px 20px;
  color:  black;
}
th{
  color: red;
}

.thead th {
  padding-top: 15px;
  padding-bottom: 15px;
}

.thead th:hover {
  /*background-color: #4c5d6b;*/
  cursor: pointer;
} 
    .table-edit tr:nth-child(even) {
  background-color: transparent;
}

.table-container {
  margin-bottom: 20px;
}

.table-edit {
  background-color: transparent;
}

.input-edit {
  /*color: #ffffff;*/
  width: 100%;
  padding: 5px;
  border: 0px;
}


</style>

<style> 

 .popover-header {
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

<style>
/*    #myMessList{
            background-color: rgb(80,80,80);
    }*/
@media screen and (-webkit-min-device-pixel-ratio:0) { 
  select:focus,
  textarea:focus,
  input:focus {
    font-size: 16px;
  }
}

@media screen and (-webkit-min-device-pixel-ratio:0) { 
  select,
  textarea,
  input {
    font-size: 16px;
  }
}
#addingInfo h3{
    color: black;
}
#addingInfo p{
    color: black;
}

.direct-chat-infos {
    color: black;
    display: block;
    font-size: 0.875rem;
    margin-bottom: 2px;
}

.direct-chat-img {
    border-radius: 50%;
    float: left;
    height: 40px;
    width: 40px;
}

.direct-chat-text {
    border-radius: 0.3rem;
    background: #d2d6de;
    border: 1px solid #d2d6de;
    color: #444;
    margin: 5px 0 0 50px;
    padding: 5px 10px;
    position: relative;
    background: #007bff;
    border-color: #007bff;
    color: #ffffff;
}

.right .direct-chat-text {
    margin-left: 0;
    margin-right: 50px;
    width: fit-content;
}

.right .direct-chat-img {
    float: right;
}

.direct-chat-infos{
    width: fit-content;
}

.m-header svg {
    font-size: 30px;
}

.input-edit {
    color: black;
    width: 100%;
    padding: 5px;
    border: 0px;
}

.float-left {
float: left !important;
}
    .preview {
    border: 0px;
    background: none;
}
.preview img{
    width: 25px;
    height: 25px;
}
.messenger-listView {
width: 45%;
}

.messenger-messagingView{
width:55%
}
@media (max-width: 1500px){
 .messenger-messagingView{
       width: 98%;
       max-width: unset;
       margin-right: 4%;
    }
.messenger-listView {
    display: none;
width: 100%;
max-width:initial;


}

.right{
    margin-left: 10%!important;
}
.direct-chat-msg{
    max-width:90%!important;
}




}

.direct-chat-msg{
    margin-top: 1%;
   } 
   

.list-group{
    background-color: #E4E6EB;
}

.list-group-item{
    background-color:#E4E6EB;
}

.copy-btn{
    float: right;
}
.av-l {
display: none;
}
/* CSS */
.m-button {
  background-color: #0095ff;
  border: 1px solid transparent;
  border-radius: 3px;
  box-shadow: rgba(255, 255, 255, .4) 0 1px 0 0 inset;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-family: -apple-system,system-ui,"Segoe UI","Liberation Sans",sans-serif;
  font-size: 13px;
  font-weight: 400;
  line-height: 1.15385;
  margin: 0;
  outline: none;
  padding: 8px .8em;
  position: relative;
  text-align: center;
  text-decoration: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: baseline;
  black-space: nowrap;
    margin-left: 2%!important;
}

.m-button:hover,
.m-button:focus {
  background-color: #07c;
}

.m-button:focus {
  box-shadow: 0 0 0 4px rgba(0, 149, 255, .15);
}

.m-button:active {
  background-color: #0064bd;
  box-shadow: none;
}

#ShareLink{
        display: none;
    min-height: 45px;
    font-size: 18px;
    border: 1px solid black;
    color: red;
    margin-top:3%;
}

</style>
<div class="messenger">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView">
        {{-- Header and search bar --}}
        <div class="m-header">
            <nav>
                <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">Chi tiết giao dịch</span> </a>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="{{ route('home') }}"><i class="fas fa-home"></i></a>
                   <!--  <a href="#"><i class="fas fa-cog settings-btn"></i></a> -->
                   
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav>
            </nav>
            {{-- Search input --}}
            <!-- <input type="text" class="messenger-search" placeholder="Search" />--> 
            {{-- Tabs --}}
            <div class="messenger-listView-tabs">
                <a style="color: black;" href="#" @if($route == 'user') class="active-tab" @endif data-view="users">
                </span > Tổng quan</a>
                <a style="color: black;" href="#" @if($route == 'schedule') class="active-tab" @endif data-view="schedule">
                    <span   class="fas fa-file"></span> Nội bộ</a>
            </div>
        </div>
        {{-- tabs and lists --}}
        <div class="m-body">
           <div class=" messenger-tab app-scroll" data-view="users" style="color: black; display: block;">
  <div style="display: none;">

               {{-- Favorites --}}
               <p class="messenger-title">Favorites</p>
                <div class="messenger-favorites app-scroll-thin"></div>

               {{-- Saved Messages --}}
               @if($infomation != null)
               {!! view('Chatify::saleLayouts.listItem', ['get' => 'saved','id' => $infomation->id])->render() !!}
               @endif

               {{-- Contact --}}
               <div class="listOfContacts" style="width: 100%;height: calc(100% - 200px);"></div>
               
           </div>
    



          <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="jtab1" class="nav-link active color-a job-link"  data-toggle="tab" role="tab" href="#job-content1">Thông tin cơ bản</a>
      </li> 
      <li class="nav-item margin_center">
          <a id="jtab2" class="nav-link color-a job-link "  data-toggle="tab" role="tab" href="#job-content2">Thông tin khách hàng</a>
      </li>  
<!--   <li class="nav-item margin_center">
          <a id="jtab3" class="nav-link color-a job-link "  data-toggle="tab" role="tab" href="#job-content3">Tiến độ thanh toán</a>
      </li>   -->

    <!--   <li class="nav-item margin_center">
          <a id="mtab3" class="nav-link color-a mess-link"  data-toggle="tab" role="tab" href="#mess-content3">Tệp</a>
      </li>  -->
    </ul> 

<div class="tab-content">
     <div class="job-content tab-pane in active" id="job-content1" style="
    font-size: 20px!important;">
<div class="col-md-12 col-12">
    <hr>
    <table class="table-edit table-model">
                    <tbody class="table-edit">
              
              <tr>
                <hr>

                <td style="width:30%" >Mã BDS: </p></td>
                <td id="tran-zone">{{$zone->name}}</p></td>

              </tr>  
              <tr>
                <td >Diện tích: </p></td>
                <td id="acreage">{{$zone->acreage}} m<sup>2</sup></p></td>

              </tr>

              <tr>
                <td >Phương thức: </p></td>
                <td id="final_method">@if($zone->trans_type == 1)
  Đặt cọc
@elseif($zone->trans_type == 2)
Phân lô bán nền 
@elseif($zone->trans_type == 3)
 Mua bán nhà ở hình thành trong tương lai
 @else

 Đặt cọc
 @endif

</p></td>

<tr>
                <td >Tổng chi phí phải thu:</p></td>
                <td id="final_total">{{number_format(floatval($zone->final_price), 0, ",", ".") }} VND</p></td>

              </tr>
                      
                <td >Đã thu: </p></td>
                <td id="final_method">
                  {{number_format(floatval($zone->done), 0, ",", ".") }} VND</p></td>

                <tr>

                     <tr>
                <td >Còn phải thu: </p></td>
                <td id="final_method">
                  {{number_format(floatval($zone->dept), 0, ",", ".") }} VND</p></td>
                <tr>
              </tr>
                <tr>
                <td >Tình trạng giao dịch: </p></td>
                <td id="acreage"><span id="FinalStatus">
                  @if($zone->state < 3)
                  <h4 style="color: red">Đang tiến hành</h4>
                  @else
                  <h4 style="color: green">Đã hoàn thành</h4>
                  @endif

                </span></p></td>

              </tr>

            </tbody></table>

<br>
<h3>Chi tiết giá</h3>
      <table class="table-edit table-model">
                    <tbody class="table-edit">
            <tr>

                <td style="width:30%" >Đơn giá: </p></td>
                <td id="acreage"><p>
                  @if($zone->real_price > 0)
                  {{number_format(floatval($zone->real_price), 0, ",", ".") }}
                  @else
                  {{number_format(floatval($zone->unit_price), 0, ",", ".") }}
                  @endif

                  VND
                </p></td>

              </tr>
              <tr>
                <td >Tổng giá bất động sản: </p></td>
                <td id="acreage"><p>
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


                VND</p></td>

              </tr>

                        @if(strpos($zone->name,"LK") > -1)
              <tr id="con1">
                <td >Chi phí xây dựng:</p></td>
                <td id="final_con">
<p>
                        @if($zone->acreage > 120)
1,636,685,000 VND
                        @else
1,558,055,000 VND
                        @endif

                 </p></td>

              </tr>

              <tr id="con2">
                <td >Chiết khấu xây dựng:</p></td>
                <td id="final_con_discount"><p>{{number_format(floatval($zone->con_discount), 0, ",", ".") }} VND</p></td>

              </tr>



              @endif
            

              <tr>
                @if($zone->vat > 0)
                <td >Thuế VAT: </p></td>
                <td id="final_method"><p> {{number_format($zone->vat, 0, ",", ".") }} VND</p></td></tr>
                @endif

                  @if($zone->tax > 0)
                 <tr>
                <td >Thuế trước bạ: </p></td>
                <td id="final_method"><p> {{number_format($zone->tax, 0, ",", ".") }} VND</p></td>

                <tr>
                  @endif

                  @if($zone->inner_tax > 0)
                 <tr>
                <td><p>Phí hợp đồng: </p></td>
                <td id="final_method"><p> {{number_format($zone->inner_tax, 0, ",", ".") }} VND</p></td>

                <tr>
                  @endif

                @if($zone->deposit > 0)
                <tr>

                <td >Hoa hồng: </p></td>
                <td id="final_method"><p>{{$zone->deposit}} VND</p></td>

                <tr>
                  @endif
                     <tr>


                
            </tbody></table>
            <hr>
  <h3>Liên hệ</h3>
  <table class="table-edit table-model">
   <tbody class="table-edit">
 <tr>
                <td style="width:30%"><p></p></td>
                <td><p>Công ty Đông Dương Thăng Long</p></td>
              </tr> <tr>
                <td style="width:30%"><p>Địa chỉ:</p></td>
                <td><p>Đường 8B, Khối 7, Thị Trấn Xuân An, Huyện Nghi Xuân, Tỉnh Hà Tĩnh, Việt Nam</p></td>
              </tr>
              <tr>
                <td style="width:30%"><p>Điện thoại:</p></td>
                <td><p>02393565555</p></td>
              </tr>


              <tr>
                <td><p>Email</p></td>
                <td><p>phc.dongduongthanglong@gmail.com</p></td>
              </tr>

              <tr>
                <td><p>Tổng giám đốc: </p></td>
                <td><p>Trần Thanh An</p></td>
              </tr>


              <tr>
                <td><p>Điện thoại:</p></td>
                <td><p>0377814088</p></td>
              </tr>


                            
                          </p></td>
                        </tr>
                      </tbody>
                    </table>

  <hr> 
  <h2>Hoặc</h2>
  <table class="table-edit table-model">
                    <tbody class="table-edit">
                        
              <tr>
                <td style="width:30%">Trưởng Phòng kinh doanh</td>
                <td>Trần Thị Nhung</td>
                           </tr>
                            
              <tr>
                <td>Điện thoại:</td>
                <td>0377814088</td>
              </tr>
@if($infomation != null)
              @if(strlen($infomation->sname) > 0)
              <tr>
                <td>Môi giới:</td>
                <td>{{$infomation->sname}}</td>
              </tr>
   
              <tr>
                <td>Điện thoại:</td>
                <td>{{$infomation->sphone}}</td>
              </tr>
              @endif
              @endif


                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <hr>
</div>
  <button class="m-button" onclick="showMess()">Nhắn tin</button>
             

       </div>
     <div class="job-content tab-pane fade" id="job-content2">
          
@if($infomation != null)
 <table class="table-edit table-model">
   <tbody class="table-edit">
<tr>
                <td style="width:30%"><p>Tên khách hàng:</p></td>
                <td><p>{{$infomation->cname}}</p></td>
              </tr><tr>
                <td style="width:30%"><p>Ngày sinh:</p></td>
                <td><p>{{date("d-m-Y", strtotime($infomation->birth_date))}}</p></td>
              </tr>

              <tr>
                <td style="width:30%"><p>Địa chỉ:</p></td>
                <td><p>{{$infomation->address}}</p></td>
              </tr>


              <tr>
                <td style="width:30%"><p>Điện thoại:</p></td>
                <td><p>{{$infomation->phone_number}}</p></td>
              </tr>


              <tr>
                <td><p>Email</p></td>
                <td><p>{{$infomation->email}}</p></td>
              </tr>

              <tr>
                <td><p>Chứng minh thư: </p></td>
                <td><p>{{$infomation->identify_card}}</p></td>
              </tr>


              <tr>
                <td><p>Ngày cấp:</p></td>
                <td><p>{{date("d-m-Y", strtotime($infomation->iden_date))}}</p></td>
              </tr>  <tr>
                <td><p>Nơi cấp: </p></td>
                <td><p>{{$infomation->iden_location}}</p></td>
              </tr>


                            
                          </p></td>
                        </tr>
                      </tbody>
                    </table>


@if($infomation->married == 2)
<hr>
                     <table class="table-edit table-model">
     <tbody class="table-edit">
<tr>
                <td style="width:30%"><p>Tên khách hàng:</p></td>
                <td><p>{{$consumer2->cname}}</p></td>
              </tr><tr>
                <td style="width:30%"><p>Ngày sinh:</p></td>
                <td><p>{{date("d-m-Y", strtotime($consumer2->birth_date))}}</p></td>
              </tr>

              <tr>
                <td style="width:30%"><p>Địa chỉ:</p></td>
                <td><p>{{$consumer2->address}}</p></td>
              </tr>


              <tr>
                <td style="width:30%"><p>Điện thoại:</p></td>
                <td><p>{{$consumer2->phone_number}}</p></td>
              </tr>


              <tr>
                <td><p>Email</p></td>
                <td><p>{{$consumer2->email}}</p></td>
              </tr>

              <tr>
                <td><p>Chứng minh thư: </p></td>
                <td><p>{{$consumer2->identify_card}}</p></td>
              </tr>


              <tr>
                <td><p>Ngày cấp:</p></td>
                <td><p>{{date("d-m-Y", strtotime($consumer2->iden_date))}}</p></td>
              </tr>  <tr>
                <td><p>Nơi cấp: </p></td>
                <td><p>{{$consumer2->iden_location}}</p></td>
              </tr>


                            
                          </p></td>
                        </tr>
                      </tbody>
                    </table>
@endif
    
              @endif
            </div>
    



</div>
</div>

           {{-- ---------------- [ Group Tab ] ---------------- --}}
           <div class="@if($route == 'schedule') show @endif messenger-tab app-scroll" data-view="schedule">
                {{-- Contact --}}
               <div class="listOfGroups col-md-12 col-12" style="color:black;width: 100%;height: calc(100% - 200px);">
                         <h2 class="card-title">
                          @if($infomation!= null && $zone->final_price > 0)
   Chi tiết hoa hồng </h2>
<h3>Người hưởng:{{$infomation->sname}} </h3>

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
    <td><a href="/sale/gap/{{$index}}" type="button" class="preview"> <img src="/js-css/img/icon/open.png"> </a></td>

  </tr>
                      </tbody>
                    </table>
<hr>
   <h2 class="card-title">Danh sách biểu mẫu </h2>
     <table id="camera-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                           
                            <th style="width:80%">Tên tệp</th>
                            <th>Hạn cuối</th>
                          </tr>
                        </thead>
                        <tbody class="tbody">

 @foreach($step as $step)


<tr>
    <td><a download="{{$infomation->cname.$step->url}}.docx" href="/storage/word/{{$step->url.'-'.$zone_id}}.docx" class="preview">{{$step->name}}</a></td>
    <td>
        {{$step->end_date}}

    </td>
        

</tr>
 @endforeach
</tbody>
</table>


 <?php
          if(Auth()->user()->role_id != 5 && Auth()->user()->role_id != 27){

          ?>
<hr>
<h3>Hủy hợp đông</h3>
<form action="reset-zone" method="post">
   <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" value=" {{$zone->id}}" id="rid" name="id" class="input-edit modol-text" >

        <input type="hidden" value=" {{$infomation->cid}}" id="cid" name="cid" class="input-edit modol-text" >


  <table class="table-edit table-model">
                    <tbody class="table-edit">
                        
              <tr>
                            <td><i class="fa fa-credit-card" aria-hidden="true"></i> Lý do</td>
                            <td><input style="border: 1px solid black;" type="" value="" name="content" class="input-edit modol-text" required="">   
                            </td>
                        </tr>
                      
 
                        </tr>
                    
                        <tr>
                          <td>
                            <button class="m-button">Hủy </button>
                            <a class="m-button" href="/sale/update/{{$infomation->pid}}" class="btn btn-model">Sửa khách hàng </a>
                            <a  class="m-button" href="/sale/create-consumer-by-zone/{{$index}}" class="btn btn-model">Tạo tài khoản khách hàng </a>
                            
                          </td>
                        </tr>
                      </tbody>
                    </table>
</form>

<?php
}
?>
@else
 <a class="m-button" href="/trans/{{$index}}" class="btn btn-model">Tạo giao dịch </a>
@endif



               </div>
               
             </div>

             {{-- ---------------- [ Search Tab ] ---------------- --}}
           <div class="messenger-tab app-scroll" data-view="search">
                {{-- items --}}
                <p class="messenger-title">Tìm kiếm</p>
                <div class="search-records">

      
                </div>
             </div>
        </div>
    </div>

    {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView">
        {{-- header title [conversation name] amd buttons --}}
        <div class="m-header m-header-messaging">
            <nav>
                {{-- header back button, avatar and user name --}}
                <div style="display: inline-flex;">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                    </div>
                    <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                </div>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <!-- <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a> -->
                    <!-- <a href="{{ route('home') }}"><i class="fas fa-home"></i></a> -->
                    <button style="background-color: transparent;"><img onclick="showMessSearch()" style="width:20px;height: 20px;" src='/js-css/img/icon/search.png'></button>

                    <a href="#" class="show-infoSide"><span class="preview"><img src="/js-css/img/icon/info2.png"></span></a>
                </nav>
<nav id="messenger-search-nav" style="display:none;position: relative;margin-top: 2%;">
             <input style="background-color:white" type="text" onkeyup="mymessengerSearch(this)" class="my-messenger-search input-edit" id="my-messenger-search" placeholder="Tìm kiếm" value="" /> 
             <div id= "messenger-search-results" style="display:none"></div>
         </nav>
            </nav>
        </div>
        {{-- Internet connection --}}
        <div class="internet-connection">
            <span class="ic-connected">Đã kết nối</span>
            <span class="ic-connecting">Đang kết nối...</span>
            <span class="ic-noInternet">Không có kết nối</span>
        </div>
        {{-- Messaging area --}}
        <div class="m-body app-scroll">
            <div class="messages" id="myMessList">
                <p class="message-hint" style="margin-top: calc(30% - 126.2px);"><span>Vui lòng tìm người để nhắn tin</span></p>
            </div>
            {{-- Typing indicator --}}
            <div class="typing-indicator">
                <div class="message-card typing">
                    <p>
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </p>
                </div>
            </div>
            {{-- Send Message Form --}}
            @include('Chatify::saleLayouts.sendForm')
        </div>
    </div>
    {{-- ---------------------- Info side ---------------------- --}}
    <div class="messenger-infoView app-scroll">

        {{-- nav actions --}}
        <nav>
            <a href="#" style="color:blue">X</a>
        </nav>
        {!! view('Chatify::saleLayouts.info')->render() !!}
    </div>
</div>

<script type="text/javascript">
  
 
function CopyToken(){
  text = document.getElementById("TokenText").innerHTML;
  const elem = document.createElement('textarea');
   elem.value = text;
   document.body.appendChild(elem);
   elem.select();
   document.execCommand('copy');
   document.body.removeChild(elem);
        notifiSuccess("Đã copy thành công vào đường dẫn tạm thời");
}

function ToggleTable(elmt){
      $(elmt).next("ul").slideToggle();
}
function ToggleDiv(elmt){
      $(elmt).next("div").slideToggle();
}
  
function jump(id){
  console.log("JUMP!!!!")
     if (window.innerWidth <  800){
        $('.messenger-infoView').hide();
        $('.show-infoSide').show();
        

    }
  var top = document.getElementById("mess"+id).offsetTop;
          $('.messenger-messagingView .m-body').animate({
                    scrollTop: top
                }, 100);

}

function showMess(){
  // alert("???")
    fetchMessages({{$zone_id}},"sale")
    messenger = "sale_{{$zone_id}}";
    @if($infomation != null)
    getSharedPhotos({{$infomation->id}},"sale")
    @endif
     if (window.innerWidth <  800){
        $('.messenger-listView').hide();
        console.log(window.innerWidth)
    }
}
</script>
@include('Chatify::saleLayouts.modals')
@include('Chatify::saleLayouts.footerLinks')


        <script src="/js-css/js/jquery.min.js"></script>
<script>
    

fetchMessages({{$zone_id}},"sale")
messenger = "sale_{{$zone_id}}";
messenger_schedule = "sale_{{$zone_id}}";
disableOnLoad(false);
$('.messenger-infoView-shared').show();
$('.messenger-infoView-btns').hide();


function fileFiller(element){
        var searchText = $(element).val();
        $('.file-item').each(function(){
            var currentLiText = $(this).text(),
                showCurrentLi = currentLiText.indexOf(searchText) !== -1;

            $(this).toggle(showCurrentLi);

        });     
    }

var currentIndex = 0
var maxLength = 0
var myList = []


function mymessengerSearch(element) {
    var val = document.getElementById("my-messenger-search").value
    console.log(messenger)
    console.log(messenger.split('_')[0])
    $.ajax({
        url: url + '/my-search',
        method: 'POST',
        data: { '_token': access_token, 'input': val,"id": messenger.split('_')[1],"type": "sale"},
        dataType: 'JSON',
        beforeSend: () => {
            $('.search-records').html(listItemLoading(4));
        },
        success: (data) => {
            console.log(data)
            if (data.length  > 0){
                myList  = data
                html = '<button onclick="preSearch()" class="m-button ">Trước</button><span style="color:white"><span style="margin-left:2%" id="curIndex">1</span>/'+data.length+'<span><button onclick="nextSearch()" class="m-button">Sau</button>'
                jump(data[0])
                currentIndex = 0
                maxLength = data.length
                document.getElementById("messenger-search-results").innerHTML = html;
                document.getElementById("messenger-search-results").style.display ="block";
            }else{

                document.getElementById("messenger-search-results").style.display ="none";
            }
            // $('.search-records').find('svg').remove();
            // data.addData == 'append'
            //     ? $('.search-records').append(data.records)
            //     : $('.search-records').html(data.records);
            // // update data-action required with [responsive design]
            // cssMediaQueries();
        },
        error: () => {
            console.error('Server error, check your response');
        }
    });
}

function preSearch(){
    if(currentIndex > 0){
        currentIndex = currentIndex - 1
        document.getElementById("curIndex").innerHTML = currentIndex + 1;
        jump(myList[currentIndex]);
    }
}

function nextSearch(){
    if(currentIndex < maxLength-1){
        currentIndex = currentIndex + 1
        document.getElementById("curIndex").innerHTML = currentIndex + 1;
        console.log()
        jump(myList[currentIndex]);
    }
}

function showMessSearch(){
      $("#messenger-search-nav").slideToggle();
}
    window.setTimeout(function () {

showMess()
}, 1500);
    

</script>