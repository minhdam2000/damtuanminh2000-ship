@extends('../layouts/index')
@section('content')
<style type="text/css">
  @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        .GoogleContent iframe{

    width: 100%;
    min-height: 400px;
      }

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif
}



.results {
    font-weight: 600
}

select {
    border: none;
    outline: none;
    padding: 0px 4px;
    cursor: pointer;
    background: inherit
}

.mycard {
    border: 1px solid transparent!important;
    font-size: small;
    border: none;
    cursor: pointer;
    background-color: transparent !important;
}

.mycard:hover {
    transform: scale(1.08);
    transition: all 0.4s ease-in-out
}

.card-img-top {
    /*background-color: #fdf8f4;*/
    height: 100%;
    object-fit: contain;
    padding-top: 10px
}

.card-body {
    padding: 0.5rem;
    padding-top: 0.7rem;
    padding-right: 0.2rem
}

.fa-heart {
    font-size: 1.2rem
}

.h7 {
    margin: 0
}

.btn {
    padding-top: 0
}

.btn:hover {
    color: #fdaa4b
}

div.text-muted {
    font-size: 0.9rem
}

@media(max-width:372px) {
    .results {
        font-size: 0.9rem
    }
}

@media(max-width:330px) {
    .results {
        font-size: 0.85rem
    }
}

@media(min-height: 700px) {
    body {
        height: 100vh
    }
}
.card-body{

    text-align: center;
}
@media(max-width:768px) {
    body {
        height: 100%
    }
}


.badge {
    font-size: 35px;
  position: absolute;
  top: -10px;
  right: -10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}


@media(max-width:768px) {
     .badge {
        font-size: 15px;
    }
}


</style>

<script src="js-css/js/d3.min.js"></script>
<meta name="csrf-token" content="{!! csrf_token() !!}">  
<link rel="stylesheet" href="js-css/css/stepprogressbar.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
  /* Popup container - can be anything you want */

  .content-camera{
    overflow: inherit!important;
  }
  .job-content{
    overflow: inherit!important;

  }
  table{
    border: none;
  }

  table tr{
    border: none;
  }

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
<style type="text/css">
  @media(max-width:700px) {
    .icon-td {
       display: none;
    }
    .myname{
      min-width: 40vw!important;
    }
    .mydate{
      min-width: 30vw!important;
    }
}

.myname{
      min-width: 50vw!important;
    }
    .mydate{
      min-width: 10vw!important;
    }
.bg-info{
  min-width: 200px;
}
.mydanger{
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

.progress{
    min-height: 30px;
    background-color: transparent;
}
.progress-bar{
    font-size: 15px;
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

   <ul class="nav nav-tabs" id="tabs" role="tablist" style="width: :100%;">
             <li class="nav-item margin_center">
          <a id="tab0" class="nav-link nav-big-link color-a" 
          data-toggle="tab" role="tab" href="#content0">Tổng quan</a>
      </li>


      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link nav-big-link color-a" 
          data-toggle="tab" role="tab" href="#content1">Chi tiết</a>
      </li>


    </ul>  



          <div class="row row-content">
            <hr><br>
        <div class="tab-content" style="width: 100%;">

          <div id="content0" class="tab-pane  active in bigtab">
  <table id="example4" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th><center><i class="fa fa-bell text-warning"></i></center></th>
                        <th>Tiêu đề </th>
                        <th>Ngày thông báo</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($event_list as $evt)
                      <?php

                        $tags = explode(",",$evt->tags);

                        $check = 0;

                        foreach($tags as $tag){
                            if(strpos($owner,trim($tag)) > -1){
                                $check =1;
                                break;
                            }
                            try{
                                if(strpos($tag, "(") > 0){

                                        $tag_arr = explode("(",$tag);
                                        $name = trim($tag_arr[0]);
                                        $totalnum = trim(explode(")",$tag_arr[1])[0]);
                                        if(strpos($owner,trim($name)) > -1){
                                            $start = intval(explode("-",$totalnum)[0]);
                                            $end = intval(explode("-",$totalnum)[1]);
                                            for ($i = $start;$i < $end;$i++){
                                                if($i < 10){
                                                    $temp = "0".$i;
                                                }else{
                                                    $temp = "".$i;
                                                }
                                                 if(strpos($owner,trim($temp)) > -1){
                                                        $check =1;
                                                        break;        
                                                 }

                                            }
                                        }
                                }
                            }    catch (\Exception $e){
                                   continue;
                                }

                        }
                        if($check ==0){
                            continue;
                        }
                      ?>
                        <tr class="color-add">
                          <td><center><i class="fa fa-exclamation-triangle text-warning"></i></center></td>
                          <td>{{$evt->title}} </td>
                          <td>{{$evt->time}}</td>
                          <td><a href="sale/alert/view/{{$evt->id}}" class="preview" type="button"><img src="/js-css/img/icon/eye.png"></a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <br><hr>
                     
           <div style="max-width: 3000px;" class="container" id="importantMess">
<div class="row">

                <hr>

  <?php
// $colors = ["#FFC0CB", "#E6E6FA", "#DDA0DD", "#FFA07A", "#FFA500", " #FFFACD", "#ADFF2F", "#98FB98", "#8FBC8F", "#AFEEEE", "#B0C4DE", "#F5DEB3", "#A9A9A9", "#FFE4E1", "#F4A460"];


$colors = ["#FF1493", "#9932CC",  "#00FF00", "#FFA500", "#008B8B", "#4682B4", "#ccccf0", "#778899", "rgb(137,207,240)", "pink", "#DA70D6", "#FF8C00", "#CD5C5C", "#DDA0DD"];

$colorsSel = [0,0,0,0,0,0,0,0,0,0,0,0,0,0];
$colorsTask = [0,0,0,0,0,0,0,0,0,0,0,0,0,0];
$colorsTaskMess = [0,0,0,0,0,0,0,0,0,0,0,0,0,0];


?>

    @foreach($zones as $zone)
<?php
$count = $zone->id % count($colors);
while($colorsTaskMess[$count] == 1){
  $count = $count + 1;

  if($count == count($colors) ){
    $count = 0;
  }
}
$colorsTaskMess[$count] =1;
?>

    <div class="col-md-4 col-12" id="boxMess{{$zone->id}}">
  
<div class="card" style="background-color: {{$colors[ $count]}};">
  <div class="card-body">

    <div class="card-myhead">
    <h4 style="font-weight: 900">{{$zone->name}}</h4>
     <a type="button" class="btn btn-model" href="/chatify/zone-sale/{{$zone->id}}">Chi tiết</a>
      <hr>

     
</div>
      <div  class="GoogleContent" id="iframe{{$zone->id}}">
        </div>
  </div>
</div>
        </div>
    @endforeach
  </div>
</div>
<hr><br>

          </div>



          <div id="content1" class="tab-pane  in bigtab">
            <div class="row-title-proxy">
<div class="container mt-3">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
          <a href="/consumer-projects/">
            <div class="mycard"> <img class="card-img-top"src="js-css/img/icon/bigmap.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Bản đồ số</h7>
                    
                </div>
            </div>
          </a>
        </div>

         <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
            <a href="/personal-page">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/person.png">
                <div class="card-body">
                            <h7 class="font-weight-bold"> Trang cá nhân</h7>
                    
                </div>
            </div>
        </a>
        </div>



        <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
            <a href="/doc">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/info.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">  Hướng dẫn sử dụng</h7>
                    
                </div>
            </div>
        </a>
        </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">

          <a href="/logoutkms">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/logout.png">
                <div class="card-body">
                            <h7 class="font-weight-bold"> Đăng xuất</h7>
                    
                </div>
            </div>
        </a>
        </div>


       
    </div>
</div></div>
</div>
</div></div>

<script type="text/javascript">
//     window.setTimeout(function () {
//   window.location.reload();
// }, 30000);
    
    menu_close()

function loadIframe(id){  
   document.getElementById("iframe"+id).innerHTML = 
           '<iframe src="/chatify/zone-sale/' + id+'"></iframe>'

}


    $('#example4').DataTable( {
        "order": [[ 4, "desc" ]]
    });

</script>
<script type="text/javascript">
@foreach($zones as $zone)
// alert("!23");
try {
loadIframe({{$zone->id}})

} catch (error) {
  console.error(error);
}

@endforeach
</script>
@endsection
