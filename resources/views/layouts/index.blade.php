<?php
// $name = "Lopital - Đông Dương Thăng Long";

$name ="Lopital - Onsen Hội Vân"
?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{$name}}</title>
        <link rel="icon" type="image/ico" href="js-css/img/title_logo.png" />
        <base href="{{asset('')}}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" /> -->

    <link rel="icon" href="{{ url('js-css/img/favicon.png') }}">
        <link rel="stylesheet" href="js-css/css/adminlte.css">
        <link rel="stylesheet" href="js-css/css/bootstrap.min.css">
        <script src="js-css/js/jquery.min.js"></script>
        <script src="js-css/js/popper.min.js"></script>
        <script src="js-css/js/bootstrap.min.js"></script> <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
                             
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
        <link rel="stylesheet" href="js-css/font/font-awesome.min.css">
      <!--   @if(Auth()->user()->display == 1)
            <link rel="stylesheet" href="js-css/css/css.css">
        @else
            <link rel="stylesheet" href="js-css/css/css2.css">
        @endif -->
            <link rel="stylesheet" href="js-css/css/css2.css">
        <link rel="stylesheet" href="js-css/css/custom.css">
        <script src="js-css/js/jquery.dataTables.min.js"></script>
        <script src="js-css/js/sweetalert.js"></script>
        <link rel="stylesheet" href="js-css/css/sweetalert.css">

        <script src="js-css/js/script.js"></script>
        <script src="js-css/js/Chart.js"></script>
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<?php

  $agent = new Jenssegers\Agent\Agent();

$platform = $agent->platform();
// dd("123");
if(Auth()->user()->role_id == 14){
    // dd($_SERVER['REQUEST_URI']);
    if($_SERVER['REQUEST_URI'] == "/draw-map" ||
strpos($_SERVER['REQUEST_URI'], 'map-config') > 0 ||
strpos($_SERVER['REQUEST_URI'], 'mini-fix-list') > 0 ||
strpos($_SERVER['REQUEST_URI'], 'area-fix') > 0
){
        $a=1;
    }else{
      
    ?>
<script type="text/javascript">
    window.location.href = '/draw-map';
</script>
<?php
dd('Không có quyền truy cập hệ thống');
    return 0;
}
}
?>

<script>

// alert("<?=$platform?>")
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "e935d517-019c-48b1-a3da-982624168815",
    });
  });


</script>



        @yield('header')
    </head>
    <body>
        <div class="lds-roller-div">
            <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
        <a id="loading-nomal" class="loading-nomal">
        <img id="gif_load" src="js-css/img/loading2.gif" width="50" height="50">
        </a>
        <div class="body-content">
            <div class="header-camera dropdown1">
                <div class="dropdown">
                    <div class="text-logo">
                        @if(Auth()->user()->display == 1)
                        <img src="js-css/img/logo.png" width="100" height="auto">
                        @else
                        <img src="js-css/img/logo.png" width="100" height="auto">
                        @endif
                    </div>
                    <p hidden="" id="close-menu" value="1">1</p>
                        @if(Auth()->user()->admin_id < 2)
                    <div class="close-menu" id="close-menu-btn" style="display: block!important" onclick="menu_close();">
                        <i class="fa fa-outdent" aria-hidden="true"></i>
                    </div>
                    @endif
                    <!-- <div class="search-header">
                        <div class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></div>
                        <input class="search" type="search" placeholder="Search" id="myInputSearch">
                    </div> -->
                    <div class="user1" id="account" status="1" >
                        <span class="header-item event-class" hidden="">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                            <i class="fa fa-info exists-noti" aria-hidden="true" hidden=""></i>
                        </span>
                        <p hidden="" id="events" status="0"></p>
                        <span class="header-item account-header"  id="dropBtn">
                            {{ Auth::user()->name}} &nbsp;<i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="dropdown-content">
                        <div class="user-login user-name">
                            <span class="span-avatar"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;{{ Auth::user()->name }}</span>
                        </div>
                        <a href="changepassword" class="white-color">
                            <div class="user-setting">
                                <small><i class="fa fa-unlock-alt white-color"></i> &nbsp;Đổi mật khẩu </small>
                            </div>
                        </a>
                        <!-- <a href="discoloration" class="white-color">
                            <div class="user-setting">
                                <small><i class="fa fa-lightbulb-o" aria-hidden="true"></i> &nbsp; Discoloration</small>
                            </div>
                        </a> -->
                        <a href="logoutkms" class="white-color">
                            <div class="user-setting">
                                <small><i class="fa fa-sign-out white-color"></i> &nbsp;Đăng xuất</small>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-content-event">
                        <div id="dropdown-event">

                        </div>
                        <a href="/listevent" class="white-color">
                            <div style="text-align: center;">
                                <div class="user-setting">
                                    <small>
                                        <i class="fa fa-folder-open-o white-color"></i> &nbsp;See All
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

                        @if(Auth()->user()->admin_id < 2)
            <div class="sidenav">
                <a href="/map" id="version" class="item-menu"><i class="fa fa-map-marker  text-red"></i> &nbsp; Bản đồ dự án</a>
                <?php
          if(Auth()->user()->role_id == 1 || Auth()->user()->role_id == 6  || Auth()->user()->role_id == 3){
            ?>
                <a href="/consumer-list" id="version" class="item-menu"><i class="fa fa-users text-red"></i> &nbsp; Quản trị khách hàng </a>
                <a href="/sale/index" id="version" class="item-menu"><i class="fa fa-archive" text-red"></i> &nbsp; Quản trị giao dịch </a>
     <a href="/genlegal/form-list" id="version" class="item-menu "><i class="fa fa-archive text-red"></i> &nbsp; Quản lý biểu mẫu </a>
              
                <?php
                    }
                ?>

                <?php
          if(Auth()->user()->role_id == 1 || Auth()->user()->role_id == 6 ){

          ?>
  <button class="dropdown-btn item-menu"><i class="fa fa-bar-chart-o" aria-hidden="true"></i> &nbsp; <span class="option-text"> Thống kê, báo cáo <i class="fa fa-caret-down"></i></span></button>
    <div class="dropdown-container" style="display: none;">
        <a href="statistic" id="version" class="item-menu  item-chil"><i class="fa fa-circle-o text-red"></i> &nbsp; Thống kê bán hàng </a>
     <a href="finance" id="version" class="item-menu  item-chil"><i class="fa fa-circle-o text-red"></i> &nbsp; Thống kê tài chính </a>
     <a href="finance/statistic" id="version" class="item-menu  item-chil"><i class="fa fa-circle-o text-red"></i> &nbsp; Biểu đồ tài chính </a>
     <a href="finance/type" id="version" class="item-menu  item-chil"><i class="fa fa-circle-o text-red"></i> &nbsp;Cấu hình thu chi</a>

    </div>
    <a href="/process/index" id="version" class="item-menu"><i class="fa fa-cog text-red"></i> &nbsp; Danh sách quy trình</a>

    <button class="dropdown-btn item-menu"><i class="fa fa-cogs" aria-hidden="true"></i> &nbsp; <span class="option-text"> Quy trình hệ thống  <i class="fa fa-caret-down"></i></span></button>
    <div class="dropdown-container" style="display: none;">
        <a href="gen/process-list" id="version" class="item-menu  item-chil"><i class="fa fa-circle-o text-red"></i> &nbsp; Quản lý quy trình  </a>
     <a href="gen/step-list" id="version" class="item-menu  item-chil"><i class="fa fa-circle-o text-red"></i> &nbsp; Quản lý nhiệm vụ </a>
     <a href="gen/substep-list" id="version" class="item-menu  item-chil"><i class="fa fa-circle-o text-red"></i> &nbsp; Quản lý nhiệm vụ con</a>
     <a href="gen/task-list" id="version" class="item-menu  item-chil"><i class="fa fa-circle-o text-red"></i> &nbsp; Quản lý điều kiện pháp lý </a>
    </div>

     <button class="dropdown-btn item-menu"><i class="fa fa-cogs" aria-hidden="true"></i> &nbsp; <span class="option-text"> Quy trình nhân viên  <i class="fa fa-caret-down"></i></span></button>
    <div class="dropdown-container" style="display: none;">
        <a href="genstaff/process-list" id="version" class="item-menu  item-chil"><i class="fa fa-circle-o text-red"></i> &nbsp; Quản lý quy trình  </a>
     <a href="genstaff/step-list" id="version" class="item-menu  item-chil"><i class="fa fa-circle-o text-red"></i> &nbsp; Quản lý nhiệm vụ </a>
     <a href="genstaff/task-list" id="version" class="item-menu  item-chil"><i class="fa fa-circle-o text-red"></i> &nbsp; Quản lý điều kiện pháp lý </a>
    </div>


             <!--    <a href="process/index" id="version" class="item-menu"><i class="fa fa-bar-chart-o text-red"></i> &nbsp; Quản lý quy trình  </a> -->
                <a href="hr/admin-department" id="account-management" class="item-menu"><i class="fa fa-cog" aria-hidden="true"></i> &nbsp; Quản lý khung nhân sự </a>
                <a href="accountlist" id="account-management" class="item-menu"><i class="fa fa-user" aria-hidden="true"></i> &nbsp; Quản lý người dùng </a>
                 <a href="hr/plot" id="account-management" class="item-menu"><i class="fa fa-user" aria-hidden="true"></i> &nbsp; Sơ đồ nhân sự </a>

                <?php
                    }else{
                ?> 

                <a href="/consumer-legal" id="version" class="item-menu"><i class="fa fa-archive"></i> &nbsp; Pháp lý và biểu mẫu  </a>
                <a href="personal/job" id="version" class="item-menu"><i class="fa fa-bar-chart-o text-red"></i> &nbsp; Việc cần làm  </a>
                <?php
                    }
                ?> 
                <a href="/job-list" id="icon-nocation" class="item-menu"><i class="fa fa-trello" aria-hidden="true"></i> &nbsp; Giao việc
                </a> <a href="/forum" id="icon-nocation" class="item-menu"><i class="fa fa-comments-o" aria-hidden="true"></i> &nbsp; Thảo luận </a>
                <a href="/listevent" id="icon-nocation" class="item-menu"><i class="fa fa-bell text-amber" aria-hidden="true"></i> &nbsp; Thông báo</a>
            </div>
            <script type="text/javascript">
                
            // menu_close()
        </script>
        @endif
            <div id="content">
                @yield('content')
            </div>
        </div>
        <div class="setting">
            
                <div style="height:200px">
                    
                </div>
        </div>
        <div id="background-black"></div>
        <script>
            $(".dropdown-content-event").click(function() {
                console.log("test")
              $(".exists-noti").attr("hidden",true);
              eventWatched();
              if($("#events").attr("status") == '1'){

                $.ajax({
                  url: 'getevents/'+{!! Auth()->user()->id !!},
                  success: function(data) {
                    for(var i=0; i<data.length; i++){
                        var a = document.createElement("a");
                        a.classList.add('white-color');
                        a.setAttribute("href", "#");
                        a.innerHTML = 
                            '<div class="user-setting">'+
                                '<small><i class="fa fa-exclamation-triangle text-danger"></i> &nbsp;'+ data[i].event +'</small>'+ 
                                '<small style="display:block;"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;'+ data[i].created_at +'</small>'       
                            '</div>';
                        document.getElementById("dropdown-event").appendChild(a);
                    }            
                  }
                });

                $("#events").attr("status", "0");
                $(".dropdown-content-event").css('display','block');
              }
              else{
                $("#events").attr("status", "1");
                $(".dropdown-content-event").css('display','none');
                $("#dropdown-event").html('');
              }
            });
        </script>

        <!-- <script type="text/javascript" src="js-css/js/socket.io.js"></script>
        <script>
        var socket = io('localhost:6001')
        socket.on('kafka',function(data){
          console.log(data);
        })
        </script> -->


        <script>
            function eventWatched(){
                $.ajax({
                url: 'eventwatched',
                success: function(data) {
                        
                }
            });
            }
        </script>
        <script type="text/javascript">
            
let exteranlUserId = "<?=Auth()->user()->id."PF".$platform?>";

      console.log("Push notifications1");
OneSignal.push(function() {
      console.log("Push notifications2");
  OneSignal.isPushNotificationsEnabled(function(isEnabled) {
    if (isEnabled){
      console.log("Push notifications are enabled!");
      OneSignal.setExternalUserId(exteranlUserId);
    }else{
      console.log("Push notifications are not enabled yet.");    
    }
  });
});

        </script>
        <script src="js-css/js/config.js"></script>
        <script src="js-css/js/script.js"></script>
        <script type="text/javascript">
                menu_close()
            if (window.innerWidth <  800){
                menu_close()
            }
    $(".responsvie").css("width","100%");
        </script>
            </body>
</html>