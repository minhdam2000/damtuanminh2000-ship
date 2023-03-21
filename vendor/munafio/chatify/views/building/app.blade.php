@include('Chatify::buildLayouts.headLinks')

<?php
$company = "Onsen Hội Vân";
$phone = "090421214125";

?>

<style>
/*    #myMessList{
            background-color: rgb(80,80,80);
    }*/
.chat-date {
    color: var(--white-300);
    contain: content;
    margin: 0 60px 10px;
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    font-size: 13px;
    justify-content: center;
    position: relative;
}

.chat-date .line {
    content: "";
    width: 100%;
    height: 0;
    border-top: 1px solid var(--black-600);
    z-index: 0;
    margin-top: 11px;
}
.chat-date>span {
    background: var(--black-600);
    border-radius: 10px;
    padding: 2px 10px 3px;
    z-index: 2;
}



    .doc-link{
        color:white;
    }

 .doc-link:hover{
        color:red;
    }
    
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
@media (max-width: 900px){
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
                <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">Chi tiết hạng mục</span> </a>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="{{ route('home') }}"><img style="width:40px;height: 40px;" src="/js-css/img/icon/home.png">
                   <!--  <a href="#"><i class="fas fa-cog settings-btn"></i></a> -->
                   
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav>
            </nav>
            {{-- Search input --}}
            <!-- <input type="text" class="messenger-search" placeholder="Search" />--> 
            {{-- Tabs --}}
           <!--  <div class="messenger-listView-tabs">
                <a href="#" @if($route == 'user') class="active-tab" @endif data-view="users">
                </span> Tổng quan</a>
                <a href="#" @if($route == 'schedule') class="active-tab" @endif data-view="schedule">
                    <span class="fas fa-file"></span> Nội bộ</a>
            </div> -->
        </div>
        {{-- tabs and lists --}}
        <div class="m-body">
           <div class=" messenger-tab app-scroll" data-view="users" style="color: black; display: block;">
  <div style="display: none;">

               {{-- Favorites --}}
               <p class="messenger-title">Favorites</p>
                <div class="messenger-favorites app-scroll-thin"></div>

               {{-- Saved Messages --}}
               {!! view('Chatify::buildLayouts.listItem', ['get' => 'saved','id' => $built->id])->render() !!}

               {{-- Contact --}}
               <div class="listOfContacts" style="width: 100%;height: calc(100% - 200px);"></div>
               
           </div>
                                    




          <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="jtab1" class="nav-link active color-a job-link"  data-toggle="tab" role="tab" href="#job-content1">Thông tin cơ bản</a>
      </li> 
      
    </ul> 

<div class="tab-content">
     <div class="job-content tab-pane in active" id="job-content1" style="
    font-size: 20px!important;">
<div class="col-md-12 col-12">
    <hr>

  <button class="m-button" style="float: right" onclick="showMess()">Nhắn tin</button>
  <!-- <button class="m-button" style="float: right"><a style="color:white" href="/building/edit/{{$built->id}}">Sửa hạng mục</a></button> -->
  <br>
    <table class="table-edit table-model">
                    <tbody class="table-edit">
              
              <tr>
                <hr>

                <td style="width:30%" >Tên hạng mục: </p></td>
                <td id="tran-zone">{{$built->title}}</p></td>

              </tr>  
              <tr>
                <td >Dự án: </p></td>
                <td id="acreage">{{$project->name}} </p></td>

              </tr>
               <tr>
                <td >Chủ đầu tư: </p></td>
                <td id="acreage">{{$company}}</p></td>

              </tr>
               <tr>
                <td >Số điện thoại: </p></td>
                <td id="acreage"> <a href="tel:{{$phone}}">{{$phone}}</a></p></td>

              </tr>
               <tr>
                <td >Nhà thầu: </p></td>
                <td id="acreage">
                    @foreach($contractors as $contractor)
                   <p> {{$contractor->name}} (<a href="tel:{{$contractor->phone}}">{{$contractor->phone}}</a>) </p>
                    @endforeach
                </td>

              </tr>

              <tr>
                <td >Thời gian (ngày): </p></td>
                <td id="final_method">{{$built->duration}} </td>
</tr>
<tr>
                <td >Ngày bắt đầu: </p></td>
                <td id="final_method">{{$built->start}} </td>
</tr>
<tr>
                <td >Ngày kết thúc: </p></td>
                <td id="final_method">{{$built->end}} </td>
</tr>
<tr>
                <td >Ghi chú: </p></td>
                <td id="final_method">{!! $built->des !!} </td>
</tr>

<?php 

$date1 = $built->start;
$date2 = $built->end;
$timestamp1 = strtotime($date1);
$timestamp2 = strtotime($date2);
$fixhour = intval(($timestamp2 - $timestamp1)/(60*60));

$date1 = $built->start;
$date2 = date("Y-m-d H:i:s");
$timestamp1 = strtotime($date1);
$timestamp2 = strtotime($date2);
$curhour = intval(($timestamp2 - $timestamp1)/(60*60));
if ($curhour < 0){
  $curhour = 0;
}

if ($curhour < 1){
  $percent = 0;
}if($curhour > $built->duration*24){
  $percent = 100;
}else{
  $percent = floatval($curhour/$fixhour);
}
?>




            </tbody></table>
            <h3>Tiến độ</h3>
  <form action="/building/edit-detail-process" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                   <input type="hidden" name="id" id="id" value="<?=$built->id?>">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                      <tr>
                                <td><h4>Tiến độ dự kiến: <h4></td>
                                <td>
    <div class="range-value" id="rangeV"></div>
          <input  type="range" class="form-range slider"   id="range" value="<?=$percent?>">
                               </td>
                            </tr>
                            <tr>
                                <td><h4>Phần trăm: <h4></td>
                              <td>
        <h4>  <output for="foo" value = ""><?=$percent?></output>%</h4>
</td></tr>


       
                           <tr>
                                <td><h4>Tiến độ thi công: <h4></td>
                                <td>
    <div class="range-value" id="rangeV"></div>
          <input onchange="percentDisplay()" type="range" class="form-range slider" id="real_percent_input" name="real_percent" id="range" value="<?=$built->real_percent?>">
                               </td>
                            </tr>
                            <tr>
                                <td><h4>Phần trăm: <h4></td>
                              <td>
        <h4>  <output id="real_percent_display" for="foo" value = ""><?=$built->real_percent?></output>%</h4>
</td></tr>



 <tr>
                                <td><h4>Tiến độ nghiệm thu: <h4></td>
                                <td>
    <div class="range-value" id="rangeV"></div>
          <input onchange="acceptanceDisplay()" type="range" class="form-range slider" id="acceptance_input" name="acceptance_percent" id="range" value="<?=$built->acceptance_percent?>">
                               </td>
                            </tr>

 <tr>
                            <tr>
                                <td><h4>Phần trăm: <h4></td>
                              <td>
        <h4>  <output id="acceptance_display" for="foo" value = ""><?=$built->acceptance_percent?></output>%</h4>
</td></tr>
                                <td><h4>Tiến độ thanh toán: <h4></td>
                                <td>
    <div class="range-value" id="rangeV"></div>
          <input onchange="paymentDisplay()" type="range" class="form-range slider" id="payment_input" name="payment_percent" id="range" value="<?=$built->payment_percent?>">
                               </td>
                            </tr>
                            <tr>
                                <td><h4>Phần trăm: <h4></td>
                              <td>
        <h4>  <output id="payment_display" for="foo" value = ""><?=$built->payment_percent?></output>%</h4>
</td></tr>

                          <tr>
                                <td></td>
                                <td>
                                  <button class="m-button" id="nvr-add"> &nbsp;&nbsp; Lưu &nbsp;&nbsp; </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
<br>



                         

            </div>
</div>
    <div class="job-content tab-pane fade" id="job-content2">



     <table id="camera-table" class="nvr-table">
                        <thead>
                        <tr class="thead" style="color:red!important">
                           <th></th>
                            <th>Tên</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">

 @foreach($contract as $file)

<?php

            if(strpos($file->url,".png") > 0 
            || strpos($file->url,".jpg") > 0 
            || strpos($file->url,".jpeg") > 0 
          ){
              
              $type = "photo.jpg";
          }elseif (strpos($file->url,".pdf")> 0) {
              $type = "pdf.png";
          }elseif (strpos($file->url,".doc")> 0) {
              $type = "word.png";
          }elseif (strpos($file->url,".ppt")> 0) {
              $type = "pp.png";
          }elseif (strpos($file->url,".xls")> 0
            || strpos($file->url,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }


                          ?>

                          <td style="width:10%"><span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> </td>

                          <td style="width:70%" ><a  target="_blank" download="<?=$file->name.".".$filetype?>" href="{{$file->url}}">{{$file->name}} </a></td>
                          <td>
                            
                             <button style="color: white"  type="button" class="btn btn-del Disable">
                             <a href="/building/delete-contract/{{$file->id}}" > <span class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span></a>      </button>
                          </td>
                          
 @endforeach
</tbody>
</table>


</div>

     <div class="job-content tab-pane fade" id="job-content2">



     <table id="camera-table" class="nvr-table">
                        <thead>
                        <tr class="thead" style="color:red!important">
                           
                            <th>Tiến độ đợt</th>
                            <th>Số tiền</th>
                            <th>Đã đóng</th>
                            <th>Hạn cuối</th>
                            <th  class = "center-td">Chi tiết</th>
                          </tr>
                        </thead>
                        <tbody class="tbody">

</tbody>
</table>


</div>
</div>

           {{-- ---------------- [ Group Tab ] ---------------- --}}
           <div class="@if($route == 'schedule') show @endif messenger-tab app-scroll" data-view="schedule">
                {{-- Contact --}}
               <div class="listOfGroups col-md-12 col-12" style="color:black;width: 100%;height: calc(100% - 200px);">
                         <h2 class="card-title">
  34234
<hr>



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
  </h2></div>

    {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView">
        {{-- header title [conversation name] amd buttons --}}
        <div class="m-header m-header-messaging">
            <nav>
                {{-- header back button, avatar and user name --}}
                <div style="display: inline-flex;">
                 <!--    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                    </div>
                    <a href="#" class="user-name">{{ config('chatify.name') }}</a> -->
                </div>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <!-- <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a> -->
                    <!-- <a href="{{ route('home') }}"><i class="fas fa-home"></i></a> -->
                    <!-- <button style="background-color: transparent;"><img onclick="showMessSearch()" style="width:20px;height: 20px;" src='/js-css/img/icon/search.png'></button>

                    <a href="#" class="show-infoSide"><img style="width:40px;height: 40px;" src='/js-css/img/icon/info2.png'></a> -->
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
        <div class="m-body app-scroll" style="width: 100%;">
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
            @include('Chatify::buildLayouts.sendForm')
        </div>
    </div>
    {{-- ---------------------- Info side ---------------------- --}}
    <div class="messenger-infoView app-scroll">
        {{-- nav actions --}}
        <nav>
            <a href="#" style="color:blue">X</a>
        </nav>
        {!! view('Chatify::buildLayouts.info')->render() !!}
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

    fetchMessages({{$built->id}},"build")
    messenger = "build_{{$built->id}}";
    getSharedPhotos({{$built->id}},"build")
        console.log(window.innerWidth)
        $('.messenger-listView').hide();
    
}
</script>
@include('Chatify::buildLayouts.modals')
@include('Chatify::buildLayouts.footerLinks')


        <script src="/js-css/js/jquery.min.js"></script>
<script>
    

fetchMessages({{$built->id}},"build")
messenger = "build_{{$built->id}}";
messenger_schedule = "build_{{$built->id}}";
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
        data: { '_token': access_token, 'input': val,"id": messenger.split('_')[1],"type": "build"},
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

function percentDisplay(){
  $("#real_percent_display").html($("#real_percent_input").val());
}
function acceptanceDisplay(){
  $("#acceptance_display").html($("#acceptance_input").val());
}

function paymentDisplay(){
  $("#payment_display").html($("#payment_input").val());
}

  function addIcon(id){
console.log(document.getElementById("iconDisplay"+id))

   document.getElementById("iconDisplay"+id).style.display = "block";
    }

    function removeIcon(id){

   document.getElementById("iconDisplay"+id).style.display = "none";
    }

document.getElementById("EditBtn").href = "/building/edit/{{$built->id}}"

</script>