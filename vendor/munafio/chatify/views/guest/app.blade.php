@include('Chatify::guestLayout.headLinks')
<style>

    .doc-link{
            overflow-wrap: anywhere;
    }
    .doc-link{
        color:white;
    }

 .doc-link:hover{
        color:red;
    }
    
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
@media (max-width: 900px){
 .messenger-messagingView{
       width: 98%;
       max-width: unset;
       margin-right: 4%;
    }
.messenger-listView {
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
                <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">Chi tiết công việc: {{$schedule->title}}<</span> </a>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="{{ route('home') }}"><i class="fas fa-home"></i></a>
                   <!--  <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                    <a href="/create-thread/{{$schedule->id}}/"><i class="fas fa-plus"></i></a> -->
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav>
            </nav>
            {{-- Search input --}}
            <!-- <input type="text" class="messenger-search" placeholder="Search" />--> 
            {{-- Tabs --}}
            <div class="messenger-listView-tabs">
                <a href="#" @if($route == 'user') class="active-tab" @endif data-view="users">
                    <span class="far fa-user"></span> Tổng quan</a>
                <a href="#" @if($route == 'schedule') class="active-tab" @endif data-view="schedule">
                    <span class="fas fa-users"></span> Cụôc trò chuyện con</a>
            </div>
        </div>
        {{-- tabs and lists --}}
        <div class="m-body">
           <div class=" messenger-tab app-scroll" data-view="users" style="color:black; display: block;">
  <div style="display: none;">

               {{-- Favorites --}}
               <p class="messenger-title">Favorites</p>
                <div class="messenger-favorites app-scroll-thin"></div>

               {{-- Saved Messages --}}
               {!! view('Chatify::guestLayout.listItem', ['get' => 'saved','id' => $id])->render() !!}

               {{-- Contact --}}
               <div class="listOfContacts" style="width: 100%;height: calc(100% - 200px);"></div>
               
           </div>
                                    
    <?php 
    $level = 0;
    $depart =0;
    ?>


          <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="jtab1" class="nav-link active color-a job-link"  data-toggle="tab" role="tab" href="#job-content1">Nội dung</a>
      </li> 
      <li class="nav-item margin_center">
          <a id="jtab2" class="nav-link color-a job-link "  data-toggle="tab" role="tab" href="#job-content2">Hình ảnh và file</a>
      </li>  
  <li class="nav-item margin_center">
          <a id="jtab3" class="nav-link color-a job-link "  data-toggle="tab" role="tab" href="#job-content3">Danh sách thảnh viên</a>
      </li>  

    <!--   <li class="nav-item margin_center">
          <a id="mtab3" class="nav-link color-a mess-link"  data-toggle="tab" role="tab" href="#mess-content3">Tệp</a>
      </li>  -->
    </ul> 

<div class="tab-content">
       <div class="job-content tab-pane in active" id="job-content1" style="
    font-size: 20px!important;">

                                          <div class="col-md-12 col-12">
          {!! $schedule->content !!}

      </div>

                                      <div class="card-body collapse show"  id="target1" > 
                                        <div class="row">
                                          <div id="addingInfo" style="display:none;"  class="col-md-12 col-12">                              
                <h4  class="m-header">Thông tin thêm</h4>
                              <hr>
            <!-- <p> Tên công việc: <span style="color: red">  {{$schedule->title}}</span></p> -->
            <p> Ngày bắt đầu: <span style="color: red">  {{$schedule->start_date}}</span></p>
            <p> Ngày kết thúc:<span style="color: red">   {{$schedule->end_date}} </span></p>

            <?php
$date1 = date("Y-m-d H:i:s");
$date2 = $schedule->end_date;
$timestamp1 = strtotime($date1);
$timestamp2 = strtotime($date2);
$hour = intval(($timestamp2 - $timestamp1)/(60*60));
if ($hour < 0){
  $hour = 0;
}
?>

            <p> Thơi gian còn lại: <span style="color: red"> {{$hour}} Giờ</span></p>
            <p> Trạng thái:
              @if($schedule->status ==1)
              <span style="color: green">Đã hoàn thành</span>
              @elseif($schedule->status ==2)

              <span style="color: red"> Không hoàn thành</span>
              @elseif($schedule->status ==3)
              <span style="color: red"> Tạm ngưng</span>
              @else
              <span style="color: red"> Đang thực hiện</span>
              @endif
            </p>

          </div>
<br>

  <button class="m-button" onclick="showMess()">Nhắn tin</button>
          

       </div>
       </div>
   </div>
     <div class="job-content tab-pane fade" id="job-content2">
            <h4 style="display: none;" id="imgFile"> Hình ảnh</h4>

                <div class="row form-group" id="listimg">
              <?php
                $flag = 0;
              ?>
              @foreach($files as $file)
               <?php
            if(strpos($file->url,".png") > 0 
            || strpos( $file->url,".jpg") > 0 
            || strpos($file->url,".jpeg") > 0 
          ){
              if($flag == 0){
                $flag == 1;
                ?>

            <script>
              document.getElementById("imgFile").style.display="block";
            </script>
                <?php
              }
            ?>

  <a target="_blank" href="{{$file->url}}">
<img style="width: auto;height: 400px" src="{{$file->url}}" id="listimg" class="preview"></a><br><br> 

<?php
}
?>

                            @endforeach
                       </div>


             
            <h4 style="display: none;" id="otherFile"> Khác</h4>
            <?php

           $flag =0;
            ?>
                          @foreach($files as $file)
           <?php

            if(strpos($file->url,".png") > 0 
            || strpos( $file->url,".jpg") > 0 
            || strpos($file->url,".jpeg") > 0 
          ){
              continue;
          }elseif (strpos($file->url,".pdf")> 0) {
              $type = "pdf.png";
          }elseif (strpos($file->url,".doc")> 0) {
              $type = "word.png";
          }elseif (strpos($file->url,".ppt")> 0) {
              $type = "pp.png";
          }elseif (strpos($file->url,".xls")> 0
            || strpos( $file->url,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "photo.jpg";
          }

          if ($flag == 0){
            $flag =1;
            ?>
            <script>
              document.getElementById("otherFile").style.display="block";
            </script>
            <?php
          }




                              ?>

                               <span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span>
                            <a target="_blank" href="{{$file->url}}">{{$file->title}}
                            </a>
         

                      @endforeach

            </div>
    
     <div class="job-content tab-pane fade" id="job-content3">

        <div  class="container  job-pane ">
<?php
$user = DB::table("users")->where("id",$schedule->user_id)->first(); 
?>
<br>
<h4>Người giao việc</h4>
<ul  class="list-group"> 
 <li  style="color:black;width:100%!important;" class="list-group-item direct-chat-msg" > 

                    <div class="direct-chat-infos clearfix">
                   <span class="direct-chat-name float-left" style="color:black">{{$user->name}}</span>
                     
                    </div>  
                    @if(strlen($user->avatar) > 0)
    <img class="direct-chat-img" src="{{$user->avatar}}" alt="message user image">
    @else
    <img class="direct-chat-img" src="/js-css/img/icon/avatar.png" alt="message user image">

    @endif
                    <div class="direct-chat-text">
     <span><a style="color:white;" href="mailto:{{$user->email}}"> Email: {{$user->email}}</a></span><br>
     <span><a  style="color:white;" href="tel:{{$user->phone}}"> Số điện thoại: {{$user->phone}}</a></span>
   </div>
                     </li>

 
 </ul>

            </div>
        
  <div class=" container job-pane">
<?php
  $uid = DB::table("schedule_user")->where("schedule_id",$schedule->id)->pluck('user_id')->toArray();
            $staffs = DB::table("users")->whereIn("id",$uid)->get();
$i = 1;
?>
<br>
<h4>Người phụ trách</h4>
<ul  class="list-group" style="width:100%;z-index: 1000;height: 500px;overflow: auto;"> 
@foreach($staffs as $staff)
 <li  style="color:black;width:100%!important;" class="list-group-item direct-chat-msg" > 

                    <div class="direct-chat-infos clearfix">
                   <span class="direct-chat-name float-left" style="color:black">{{$staff->name}}</span>
                     
                    </div>  
                    @if(strlen($staff->avatar) > 0)
    <img class="direct-chat-img" src="{{$staff->avatar}}" alt="message user image">
    @else
    <img class="direct-chat-img" src="/js-css/img/icon/avatar.png" alt="message user image">

    @endif
                    <div class="direct-chat-text">
     <span><a  style="color:white;" href="mailto:{{$staff->email}}"> Email: {{$staff->email}}</a></span><br>
     <span><a  style="color:white;" href="tel:{{$staff->phone}}"> Số điện thoại: {{$staff->phone}}</a></span>
   </div>
                     </li>

                    
    @endforeach
 </ul>

          </div>

     </div>

</div>
</div>

           {{-- ---------------- [ Group Tab ] ---------------- --}}
           <div class="@if($route == 'schedule') show @endif messenger-tab app-scroll" data-view="schedule">
                {{-- Contact --}}
               <div class="listOfGroups" style="width: 100%;height: calc(100% - 200px);"></div>
               
             </div>

             {{-- ---------------- [ Search Tab ] ---------------- --}}
           <div class="messenger-tab app-scroll" data-view="search">
                {{-- items --}}
                <p class="messenger-title">Tìm kiếm</p>
                <div class="search-records">

            <?php $user = DB::table("users")->where("status",">",0)->where("admin_id",">",1)->get() ?>
                      @foreach($user as $user)
                    <table class="messenger-list-item " >
                        <tr data-action="0">
        
        <td style="position: relative">
                    <div class="avatar av-m" style="background-image: url('{{$user->avatar}}');">
        </div>
        </td>
        
        <td>
      <?php
             $role = DB::table("roles")->where("id",$user->role_id)->count();
             if($role > 0){
             $role = DB::table("roles")->where("id",$user->role_id)->first();
              $dept= DB::table("department")->where("id",$role->department_id)->count();
              $role_name = $role->name;
              if($dept > 0){
                $dept_name = DB::table("department")->where("id",$role->department_id)->first()->name;

              }else{
 $dept_name = "???";
              }
          }else{
            $role_name = "Đại diện";
             $dept_name  = "";

          }
              ?>
        <p data-id="user_{{$user->id}}">
            {{$user->name}} - {{$role_name}} ({{$dept_name}})

            
        </p>
        </td>
        
    </tr>

                    </table>
                      @endforeach
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
                    <a href="{{ route('home') }}"><i class="fas fa-home"></i></a>
                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
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
            @include('Chatify::layouts.sendForm')
        </div>
    </div>
    {{-- ---------------------- Info side ---------------------- --}}
    <div class="messenger-infoView app-scroll">
        {{-- nav actions --}}
        <nav>
            <a href="#"><i class="fas fa-times"></i></a>
        </nav>
        {!! view('Chatify::layouts.info')->render() !!}
    </div>
</div>

<script type="text/javascript">
  
  function getToken(){
    $.ajax({
            url: '/schedule/get-token/{{$schedule->id}}',
            type: 'GET',
            success: function (data) {
              document.getElementById("ShareLink").innerHTML = "<p id='TokenText' >http://localhost/schedule/guest-detail/"+ data +"'<span class='m-button copy-btn preview' onclick='CopyToken()'><img src='/js-css/img/icon/copy.png'></span></p>";
              document.getElementById("ShareLink").style.display="block";
            }
        });
}

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
                }, 2000);

}

function showMess(){

    fetchMessages({{$schedule->id}},"schedule")
    messenger = "schedule_{{$schedule->id}}";
    getSharedPhotos({{$schedule->id}},"schedule")
     if (window.innerWidth <  800){
        console.log(window.innerWidth)
        $('.messenger-listView').hide();
        console.log("why not thsow")
        $(".messenger-messagingView").show();
    }
}
</script>
@include('Chatify::guestLayout.modals')
@include('Chatify::guestLayout.footerLinks')
<script>
     <?php 
if(isset($_COOKIE['mess_flag']) && $_COOKIE['mess_flag'] == 1){

 ?>
 // alert("how")
 // console.log("show_mess")
 if (window.innerWidth <  800){

        $('.messenger-listView').hide();
    }
<?php 
}else{
 ?>  
 // alert("????")

 //        $('.messenger-listView').show();
 <?php
}

?>

fetchMessages({{$schedule->id}},"schedule")
messenger = "schedule_{{$schedule->id}}";
messenger_schedule = "schedule_{{$schedule->id}}";
disableOnLoad(false);
$('.messenger-infoView-shared').show();
$('.messenger-infoView-btns').hide();

getSharedPhotos({{$schedule->id}},"schedule")


</script>