@include('Chatify::layouts.headLinks')
<style>
/*    #myMessList{
            background-color: rgb(80,80,80);
    }*/
    .doc-link{
            overflow-wrap: anywhere;
    }
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


<?php
$boss = 0;
$departs = DB::table("user_department")->where("user_id", Auth()->user()->id)->pluck("department_id")->toArray();
  
  foreach($departs as $depart){
      $mid = DB::table("department")->where("id",$depart)->first()->mid;
      // dd($hid);
      if ($mid < 1) {
          $boss = 1;
          break;
      }
  }
        
?>


<div class="messenger">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView">
        {{-- Header and search bar --}}
        <div class="m-header">
            <nav>
                <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">Chi tiết công việc: {{$schedule->title}}</span> </a>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="{{ route('home') }}"><i class="fas fa-home"></i></a>
                   <!--  <a href="#"><i class="fas fa-cog settings-btn"></i></a> -->
                    <a href="/create-thread/{{$schedule->id}}/"><i class="fas fa-plus"></i></a>
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
           <div class=" messenger-tab app-scroll" data-view="users" style="color: black; display: block;">
  <div style="display: none;">

               {{-- Favorites --}}
               <p class="messenger-title">Favorites</p>
                <div class="messenger-favorites app-scroll-thin"></div>

               {{-- Saved Messages --}}
               {!! view('Chatify::layouts.listItem', ['get' => 'saved','id' => $id])->render() !!}

               {{-- Contact --}}
               <div class="listOfContacts" style="width: 100%;height: calc(100% - 200px);"></div>
               
           </div>
                                    
 

<br><hr>
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
                                          <div  id="addingInfo" style="display:none;" class="col-md-12 col-12">                              
                <h4 class="m-header">Thông tin thêm</h4>
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
          @if($boss == 1 || $schedule->user_id == Auth()->user()->id)
                                          <div class="col-md-12 col-12">
                                            <p>Cập nhật trạng thái</p>
<form action="/close-schedule"  enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input id="status_input_id" type="hidden" name="id" value="{{$schedule->id}}">

  <table class="table-edit table-model">
                    <tbody class="table-edit">
                        
              <tr>
                            <td> <select class="custom-select select-profile  browser-default" name="status" >
                        <option value="1">Hoàn thành </option>
                        <option value="2">Không hoàn thành </option>
                        <!-- <option value="3">Ngưng</option> -->
               </select>
                            </td> <td>
                            <button class="m-button"> Cập nhật </button>
                          </td>
                       
                         
                        </tr>
                      </tbody>
                    </table>
                  </form>
</div>
@endif
<br>

  <button class="m-button" onclick="showMess()">Nhắn tin</button>
            <button class="m-button" onclick="getToken()">Mời</button>


          @if($boss == 1 || $schedule->user_id == Auth()->user()->id)
             <button class="m-button" ><a style="color:white"  href="/edit-schedule/{{$schedule->id}}">Sửa thông tin</a></button>

             @endif
      <br><br>
            <div id="ShareLink"></div>
       
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
     <span><a style="color: white;" href="mailto:{{$user->email}}"> Email: {{$user->email}}</a></span><br>
     <span><a  style="color: white;" href="tel:{{$user->email}}"> Số điện thoại: {{$user->phone}}</a></span>
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
<?php
if(count($staffs) == 0){
   $did = DB::table("schedule_department")->where("schedule_id",$schedule->id)->pluck('department_id')->toArray();

    $departments = DB::table("department")->whereIn("id",$did)->get();

   // print_r($departments);
    if(count($departments) > 0){
        echo "<hr><h4>Phòng thực hiện: </h4>";
        foreach($departments as $department){
                echo "<p>".$department->name."</p>";
        }
        echo "<hr>";

        $uid = DB::table("user_department")->whereIn("department_id",$did)->pluck('user_id')->toArray();
            $staffs = DB::table("users")->whereIn("id",$uid)->get();
    }

}


?>

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
     <span><a  style="color: white;" href="mailto:{{$staff->email}}"> Email: {{$staff->email}}</a></span><br>
     <span><a  style="color: white;" href="tel:{{$staff->email}}"> Số điện thoại: {{$staff->phone}}</a></span>
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
            $role_name = "";
 $dept_name = "";

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
                    <!-- <a href="{{ route('home') }}"><i class="fas fa-home"></i></a> -->
                    <button style="background-color: transparent;"><img onclick="showMessSearch()" style="width:20px;height: 20px;" src='/js-css/img/icon/search.png'></button>

                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                </nav>
<nav id="messenger-search-nav" style="display:none;position: relative;margin-top: 2%;">
             <input  type="text" onkeyup="mymessengerSearch(this)" class="my-messenger-search input-edit" id="my-messenger-search" placeholder="Tìm kiếm" value="" /> 
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
              document.getElementById("ShareLink").innerHTML = "<p><span id='TokenText' >http://localhost/chatify/guest-schedule/"+ data +"</span><span class='m-button copy-btn preview' onclick='CopyToken()'><img src='/js-css/img/icon/copy.png'></span></p>";
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
        $('.direct-chat-msg').css("background-color", "transparent");
    document.getElementById("mess"+id).style.backgroundColor = "lightskyblue";
    // alert("change!!!")
  var top = document.getElementById("mess"+id).offsetTop-200;
  if(top < 0){
    top =0
  }
          $('.messenger-messagingView .m-body').animate({
                    scrollTop: top
                }, 100);

}

function showMess(){
     if (window.innerWidth <  800){

    // alert("????")
        $('.messenger-listView').hide();
    }
    fetchMessages({{$schedule->id}},"schedule")
    messenger = "schedule_{{$schedule->id}}";
    getSharedPhotos({{$schedule->id}},"schedule")

}


</script>
@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')


        <script src="/js-css/js/jquery.min.js"></script>
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

        $('.messenger-listView').show();
 <?php
}

?>
fetchMessages({{$schedule->id}},"schedule")
messenger = "schedule_{{$schedule->id}}";
messenger_schedule = "schedule_{{$schedule->id}}";
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
        data: { '_token': access_token, 'input': val,"id": messenger.split('_')[1],"type": messenger.split('_')[0]},
        dataType: 'JSON',
        beforeSend: () => {
            $('.search-records').html(listItemLoading(4));
        },
        success: (data) => {
            console.log(data)
            if (data.length  > 0){
                myList  = data
                html = '<button onclick="preSearch()" class="m-button ">Trước</button><span style="color:black"><span style="margin-left:2%" id="curIndex">1</span>/'+data.length+'<span><button onclick="nextSearch()" class="m-button">Sau</button>'
                
                currentIndex = 0
                maxLength = data.length
            // alert(html)
                document.getElementById("messenger-search-results").innerHTML = html;
                document.getElementById("messenger-search-results").style.display ="block";
                jump(data[0])
            }
            // $('.search-records').find('svg').remove();
            // data.addData == 'append'
            //     ? $('.search-records').append(data.records)
            //     : $('.search-records').html(data.records);
            // // update data-action required with [responsive design]
            // cssMediaQueries();
        }
    });
}

function preSearch(){
    if(currentIndex > 0){
        currentIndex = currentIndex - 1
        document.getElementById("curIndex").innerHTML = currentIndex + 1;
        // alert(myList[currentIndex])
        jump(myList[currentIndex]);
    }
}

function nextSearch(){
    if(currentIndex < maxLength-1){
        currentIndex = currentIndex + 1
        document.getElementById("curIndex").innerHTML = currentIndex + 1;
        console.log(myList[currentIndex])
        jump(myList[currentIndex]);
    }
}

function showMessSearch(){
      $("#messenger-search-nav").slideToggle();
}



    function setCookie(cname, cvalue, mytime) {
  const d = new Date();
  d.setTime(d.getTime() + (mytime));
  let expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";


}


    var find = getCookie("find")
    // alert(find)
    if(find !=""){
        showMessSearch()
   document.getElementById("my-messenger-search").value = find

   mymessengerSearch($("#my-messenger-search"))
    }


    function addIcon(id){
        // alert("123")
console.log("OKE")
console.log(document.getElementById("iconDisplay"+id))

   document.getElementById("iconDisplay"+id).style.display = "block";
    }

    function removeIcon(id){

   document.getElementById("iconDisplay"+id).style.display = "none";
    }

</script>