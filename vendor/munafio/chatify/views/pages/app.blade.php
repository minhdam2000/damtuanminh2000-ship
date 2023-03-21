@include('Chatify::layouts.headLinks')
<style>
   
.direct-chat-infos {
    color: white;
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
}

.right .direct-chat-img {
    float: right;
}

 
    .input-edit {
    background: #272a2f;
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
@media (max-width: 680px){
   .messenger-messagingView{
       width:100%
    }
.messenger-listView {
width: 100%;
}




}

.list-group{
    background-color: gray;
}

.list-group-item{
    background-color:gray;
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
  white-space: nowrap;
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
    border: 1px solid white;
    color: red;
}

</style>
<div class="messenger">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView">
        {{-- Header and search bar --}}
        <div class="m-header">
            <nav>
                <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">Tin nhắn</span> </a>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="{{ route('home') }}"><i class="fas fa-home"></i></a>
                    <!-- <a href="#"><i class="fas fa-cog settings-btn"></i></a> -->
                    <a href="/messages/create/"><i class="fas fa-plus"></i></a>
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav>
            </nav>
            {{-- Search input --}}
            <input type="text" class="messenger-search" placeholder="Search" />
            {{-- Tabs --}}
            <div class="messenger-listView-tabs">
                <a href="#" @if($route == 'user') class="active-tab" @endif data-view="users">
                    <span class="far fa-user"></span> Cá nhân</a>
                <a href="#" @if($route == 'group') class="active-tab" @endif data-view="groups">
                    <span class="fas fa-users"></span> Nhóm</a>
            </div>
        </div>
        {{-- tabs and lists --}}
        <div class="m-body">
           {{-- Lists [Users/Group] --}}
           {{-- ---------------- [ User Tab ] ---------------- --}}
           <div class="@if($route == 'user') show @endif messenger-tab app-scroll" data-view="users">

               {{-- Favorites --}}
               <p class="messenger-title">Favorites</p>
                <div class="messenger-favorites app-scroll-thin"></div>

               {{-- Saved Messages --}}
               {!! view('Chatify::layouts.listItem', ['get' => 'saved','id' => $id])->render() !!}

               {{-- Contact --}}
               <div class="listOfContacts" style="width: 100%;height: calc(100% - 200px);"></div>
               
           </div>

           {{-- ---------------- [ Group Tab ] ---------------- --}}
           <div class="@if($route == 'group') show @endif messenger-tab app-scroll" data-view="groups">
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
             $dept_name  = DB::table("contractors")->where("id",($user->role_id)*-1)->first()->name;

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
                    <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                    <!-- <a href="{{ route('home') }}"><i class="fas fa-home"></i></a> -->
                           <button style="background-color: transparent;"><img onclick="showMessSearch()" style="width:20px;height: 20px;" src='/js-css/img/icon/search.png'></button>

                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
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
            <div class="messages">
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
@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
<script>
      
function fileFiller(element){
        var searchText = $(element).val();
        $('.file-item').each(function(){
            var currentLiText = $(this).text(),
                showCurrentLi = currentLiText.indexOf(searchText) !== -1;

            $(this).toggle(showCurrentLi);

        });     
    }
function jump(id){
  console.log("JUMP!!!!")
  var top = document.getElementById("mess"+id).offsetTop;
          $('.messenger-messagingView .m-body').animate({
                    scrollTop: top
                }, 100);

}
    function mymessengerSearch(element) {
    var val = document.getElementById("my-messenger-search").value
    console.log(val)
    console.log(messenger)
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
                html = '<button onclick="preSearch()" class="m-button ">Trước</button><span style="color:white"><span style="margin-left:2%" id="curIndex">1</span>/'+data.length+'<span><button onclick="nextSearch()" class="m-button">Sau</button>'
                jump(data[0])
                currentIndex = 0
                maxLength = data.length
                document.getElementById("messenger-search-results").innerHTML = html;
                document.getElementById("messenger-search-results").style.display ="block";
            }else{
                 document.getElementById("messenger-search-results").innerHTML = "";
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

</script>