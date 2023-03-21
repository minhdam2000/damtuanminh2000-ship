{{-- Meta tags --}}

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="route" content="{{ $route }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<?php 
// setcookie("guest_name", "", time()-3600);
if(!isset($_COOKIE['guest_id'])){

 ?>
<meta name="url" content="{{ url('').'/'.config('chatify.path') }}" data-user="0">
<?php 
}else{
 ?>

<meta name="url" content="{{ url('').'/'.config('chatify.path') }}" data-user="{{$_COOKIE['guest_id']*-1}}">
 <?php
}
?>
{{-- scripts --}}
<script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
<script src="{{ asset('js/chatify/autosize.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>

{{-- styles --}}
<link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css'/>
<link href="{{ asset('css/chatify/style.css') }}" rel="stylesheet" />
<link href="{{ asset('css/chatify/'.$dark_mode.'.mode.css') }}" rel="stylesheet" />
<link href="{{ asset('css/app.css') }}" rel="stylesheet" />
<script type="text/javascript">
  auth_id = 0;
</script>
<?php 
// setcookie("guest_name", "", time()-3600);
if(!isset($_COOKIE['guest_name'])){

 ?>
<script type="text/javascript">
var guestNameList = []
  var guestIdList = []

  function LoadGuest(){
    console.log("qojwroqwr")
 $.ajax({
            url: '/schedule/load-guest/{{$schedule->id}}',
            type: 'GET',
            success: function (data) {
              console.log(data)
              for(var i = 0; i < data.length; i++){
guestNameList.push(data[i].name)
guestIdList.push(data[i].id)

  auth_id = data[i].id;
              }
            }
  });
}
LoadGuest();

  function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function myFunction() {
  var person = prompt("Xin chào, vui lòng nhập tên");
  if (person != null) {
    // alert("????");
    setCookie("guest_name", person, 0.5); 
    location.href = "http://localhost/schedule/guest-login";
    
  }else{
    // alert("?????")
    myFunction()
  }
}
myFunction();
</script>
 <?php 
 }
  ?>
  
{{-- Messenger Color Style--}}
@include('Chatify::guestLayout.messengerColor')