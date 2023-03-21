@extends('layouts.index')
@section('content')


<?php

$find_cookie = "";

if(isset($_COOKIE['find'])){
  $find_cookie = $_COOKIE['find'];
}
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

<?php

function vn_to_str2 ($str){
 
 if(!$str) return false;
    $unicode = array('a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|á|ấ',
                     'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
                     'd'=>'đ','D'=>'Đ',
                     'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
                     'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
                     'i'=>'í|ì|ỉ|ĩ|ị',
                     'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
                     'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ồ|ò',
                     'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
                     'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
                     'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
                     'y'=>'ý|ỳ|ỷ|ỹ|ỵ','Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ');

    foreach($unicode as $khongdau=>$codau) {
        $arr=explode("|",$codau);$str = str_replace($arr,$khongdau,$str);
    }

    foreach($unicode as $khongdau=>$codau) {
        $arr=explode("|",$codau);$str = str_replace($arr,$khongdau,$str);
    }

return $str;
}

function vn_to_str($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|ấ'|ấ|á)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|ồ|ò)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);

    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);

      $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|ấ'|ấ|á)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|ồ|ò)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);

    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    
    $str =  vn_to_str2($str);

       $trans = array ('à' => 'a', 'á' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẫ' => 'a', 'ẩ' => 'a', 'ậ' => 'a', 'ú' => 'a', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'à' => 'a', 'á' => 'a', 'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o', 'ê' => 'e', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e', 'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i', 'ơ' => 'o', 'ớ' => 'o', 'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'ư' => 'u', 'ừ' => 'u', 'ứ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'đ' => 'd', 'À' => 'A', 'Á' => 'A', 'Ả' => 'A', 'Ã' => 'A', 'Ạ' => 'A', 'Â' => 'A', 'Ấ' => 'A', 'À' => 'A', 'Ẫ' => 'A', 'Ẩ' => 'A', 'Ậ' => 'A', 'Ú' => 'U', 'Ù' => 'U', 'Ủ' => 'U', 'Ũ' => 'U', 'Ụ' => 'U', 'Ô' => 'O', 'Ố' => 'O', 'Ồ' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O', 

        'Ê' => 'E', 'Ế' => 'E', 'Ề' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E', 'Í' => 'I', 'Ì' => 'I', 'Ỉ' => 'I', 'Ĩ' => 'I', 'Ị' => 'I', 'Ơ' => 'O', 'Ớ' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O', 'Ư' => 'U', 'Ừ' => 'U', 'Ứ' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ự' => 'U', 'Đ' => 'D', 'Ý' => 'Y', 'Ỳ' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y', 'Ỵ' => 'Y', 

        'á' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'ă' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a', 'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a', 'ú' => 'u', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i', 'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o', 'ô' => 'o', 'ố' => 'o', 'ồ' => 'ô', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'đ' => 'd', 'Đ' => 'D', 'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y', 'Á' => 'A', 'À' => 'A', 'Ả' => 'A', 'Ã' => 'A', 'Ạ' => 'A', 'Ă' => 'A', 'Ắ' => 'A', 'Ẳ' => 'A', 'Ẵ' => 'A', 'Ặ' => 'A', 'Â' => 'A', 'Ấ' => 'A', 'Ẩ' => 'A', 'Ẫ' => 'A', 'Ậ' => 'A', 'É' => 'E', 'È' => 'E', 'Ẻ' => 'E', 'Ẽ' => 'E', 'Ẹ' => 'E', 'Ế' => 'E', 'Ề' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E', 'Ú' => 'U', 'Ù' => 'U', 'Ủ' => 'U', 'Ũ' => 'U', 'Ụ' => 'U', 'Ư' => 'U', 'Ứ' => 'U', 'Ừ' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ự' => 'U', 'Í' => 'I', 'Ì' => 'I', 'Ỉ' => 'I', 'Ĩ' => 'I', 'Ị' => 'I', 'Ó' => 'O', 'Ò' => 'O', 'Ỏ' => 'O', 'Õ' => 'O', 'Ọ' => 'O', 'Ô' => 'O', 'Ố' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O', 'Ơ' => 'O', 'Ớ' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O', 'Ý' => 'Y', 'Ỳ' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y', 'Ỵ' => 'Y' )

        ;
        
        // Dịch Tiếng Việt có dấu thành không dấu theo 2 bảng mã Unicode va window cp 1258
        $str = strtr ( $str,  $trans); // Chuỗi đã được bỏ dấu 
        return  $str;
}





?>


 <link rel="stylesheet" href="/js/taginputs/bootstrap-tagsinput.css"  />

    <script src="/js/taginputs/bootstrap.min.js" ></script>
    <script src="/js/taginputs/bootstrap-tagsinput.js"></script>
    <script src="/js/taginputs/bootstrap-tagsinput-angular.min.js"></script>

    <link href="js/search/css/sreach.css" rel="stylesheet" />



    <style type="text/css">
    /*  .dropdown-menu{
        transform: none !important;
      }*/
      .sbutton{
        margin-left: 5%;
        border-radius: 5%;
      }
a{
  
   
    color: black;
    font-family: "Times New Roman";

}
      h4{
            font-family: 'Didact Gothic', sans-serif !important;
    font-weight: 900;
      }
      #GoogleContent iframe{

    width: 100%;
    min-height: 800px;
      }

      #time{
        color:blue;
        font-size:10px
      }

.preview img {
  margin-right: 2%;
}

  .select-profile {
    /* font-size: 0.85em; */
    z-index: unset!important;
  }
        .label-info{
            background-color: red!important;

        }
        .bootstrap-tagsinput{
          width: 100%;
        }
        .label {
          position: inherit;

            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,
            border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    pointer-events: all;
        }
 @media(max-width:700px) {
    .icon-td {
       display: none;
    }
}


/*the container must be positioned relative:*/

.autocomplete {
  position: relative;
  display: inline-block;
}
.autocomplete-items {
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9;
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
}

    </style>
  <div class="content-camera">
    <div class="header-content">
      <div class="header-content-left">
      </div>
      <div class="header-content-right" style="display: inline;">
        
        <h6 class="display-inline"></h6>
      </div>
    </div>
          <div class="session">
            @if(Session::has('notification'))
              <input hidden="" notifi="{{Session::get('notification')}}" value="1" id="notice_success">
            @endif
            @if(Session::has('warning'))
              <input hidden="" notifi="{{Session::get('warning')}}" value="1" id="notice_warning">
            @endif
         </div>
    <div class="row row-content">
      <div class="row-title-proxy">
         <ul class="nav nav-tabs" id="tabs" role="tablist">
     <!--  <li class="nav-item margin_center">
          <h1 id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content1">Kho dữ liệu </h1>
      </li>   -->  
    </ul>  
        <div class="tab-content"> <label  class="preview" for="file-input">
<!--           <button type="button"  class="btn btn-model"> <a href="/warehouse/list" > Quay lại</a></button>
<button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-url">Thêm tệp mới</button>
<hr> -->

<!--

Follow me on
Dribbble: https://dribbble.com/supahfunk
Twitter: https://twitter.com/supahfunk
Codepen: https://codepen.io/supah/

-->


          <div id="content1" class="tab-pane  in active" >

<form class="search-form" onclick="inputOpen()">


                 @if(($find_cookie !== "lopital_null"))
   

  <input id="myinput"  type="search" placeholder="Tìm kiếm" class="search-input"  value="{{$find_cookie}}" autocomplete="off" >
  
    @else

      <input  id="myinput"  type="search" placeholder="Tìm kiếm" class="search-input"  value="" autocomplete="off" >


      @endif

  <div class="search-option">
   
    
    <div>

      <button type="button" class="btn btn-model sbutton" data-toggle="modal" data-target="#new-url">Thêm tệp mới</button>
        </div>
    <div>
      <input name="type" type="radio" value="type-posts" id="type-posts">
      <label for="type-posts">

        <a href="/warehouse/">
        <svg class="edit-pen-title">
          <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#post"></use>
        </svg>
        <span>Tài liệu</span>
      </label></a>
    </div>
    <div>
      <input name="type" type="radio" value="type-images" id="type-images">
      <label for="type-images">
        <a href="/warehouse/image-list"><svg class="edit-pen-title">
          <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#images"></use>
        </svg>
        <span>Hình ảnh</span>
      </label></a>
    </div>
    
  </div>
</form>

<svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" display="none">
  <symbol id="search" viewBox="0 0 32 32">
    <path d="M 19.5 3 C 14.26514 3 10 7.2651394 10 12.5 C 10 14.749977 10.810825 16.807458 12.125 18.4375 L 3.28125 27.28125 L 4.71875 28.71875 L 13.5625 19.875 C 15.192542 21.189175 17.250023 22 19.5 22 C 24.73486 22 29 17.73486 29 12.5 C 29 7.2651394 24.73486 3 19.5 3 z M 19.5 5 C 23.65398 5 27 8.3460198 27 12.5 C 27 16.65398 23.65398 20 19.5 20 C 15.34602 20 12 16.65398 12 12.5 C 12 8.3460198 15.34602 5 19.5 5 z" />
  </symbol>
  <symbol id="user" viewBox="0 0 32 32">
    <path d="M 16 4 C 12.145852 4 9 7.1458513 9 11 C 9 13.393064 10.220383 15.517805 12.0625 16.78125 C 8.485554 18.302923 6 21.859881 6 26 L 8 26 C 8 21.533333 11.533333 18 16 18 C 20.466667 18 24 21.533333 24 26 L 26 26 C 26 21.859881 23.514446 18.302923 19.9375 16.78125 C 21.779617 15.517805 23 13.393064 23 11 C 23 7.1458513 19.854148 4 16 4 z M 16 6 C 18.773268 6 21 8.2267317 21 11 C 21 13.773268 18.773268 16 16 16 C 13.226732 16 11 13.773268 11 11 C 11 8.2267317 13.226732 6 16 6 z" /></symbol>
  <symbol id="images" viewbox="0 0 32 32">
    <path d="M 2 5 L 2 6 L 2 26 L 2 27 L 3 27 L 29 27 L 30 27 L 30 26 L 30 6 L 30 5 L 29 5 L 3 5 L 2 5 z M 4 7 L 28 7 L 28 20.90625 L 22.71875 15.59375 L 22 14.875 L 21.28125 15.59375 L 17.46875 19.40625 L 11.71875 13.59375 L 11 12.875 L 10.28125 13.59375 L 4 19.875 L 4 7 z M 24 9 C 22.895431 9 22 9.8954305 22 11 C 22 12.104569 22.895431 13 24 13 C 25.104569 13 26 12.104569 26 11 C 26 9.8954305 25.104569 9 24 9 z M 11 15.71875 L 20.1875 25 L 4 25 L 4 22.71875 L 11 15.71875 z M 22 17.71875 L 28 23.71875 L 28 25 L 23.03125 25 L 18.875 20.8125 L 22 17.71875 z" />
  </symbol>
  <symbol id="post" viewbox="0 0 32 32">
    <path d="M 3 5 L 3 6 L 3 23 C 3 25.209804 4.7901961 27 7 27 L 25 27 C 27.209804 27 29 25.209804 29 23 L 29 13 L 29 12 L 28 12 L 23 12 L 23 6 L 23 5 L 22 5 L 4 5 L 3 5 z M 5 7 L 21 7 L 21 12 L 21 13 L 21 23 C 21 23.73015 21.221057 24.41091 21.5625 25 L 7 25 C 5.8098039 25 5 24.190196 5 23 L 5 7 z M 7 9 L 7 10 L 7 13 L 7 14 L 8 14 L 18 14 L 19 14 L 19 13 L 19 10 L 19 9 L 18 9 L 8 9 L 7 9 z M 9 11 L 17 11 L 17 12 L 9 12 L 9 11 z M 23 14 L 27 14 L 27 23 C 27 24.190196 26.190196 25 25 25 C 23.809804 25 23 24.190196 23 23 L 23 14 z M 7 15 L 7 17 L 12 17 L 12 15 L 7 15 z M 14 15 L 14 17 L 19 17 L 19 15 L 14 15 z M 7 18 L 7 20 L 12 20 L 12 18 L 7 18 z M 14 18 L 14 20 L 19 20 L 19 18 L 14 18 z M 7 21 L 7 23 L 12 23 L 12 21 L 7 21 z M 14 21 L 14 23 L 19 23 L 19 21 L 14 21 z" />
  </symbol>
  <symbol id="special" viewbox="0 0 32 32">
    <path d="M 4 4 L 4 5 L 4 27 L 4 28 L 5 28 L 27 28 L 28 28 L 28 27 L 28 5 L 28 4 L 27 4 L 5 4 L 4 4 z M 6 6 L 26 6 L 26 26 L 6 26 L 6 6 z M 16 8.40625 L 13.6875 13.59375 L 8 14.1875 L 12.3125 18 L 11.09375 23.59375 L 16 20.6875 L 20.90625 23.59375 L 19.6875 18 L 24 14.1875 L 18.3125 13.59375 L 16 8.40625 z M 16 13.3125 L 16.5 14.40625 L 17 15.5 L 18.1875 15.59375 L 19.40625 15.6875 L 18.5 16.5 L 17.59375 17.3125 L 17.8125 18.40625 L 18.09375 19.59375 L 17 19 L 16 18.40625 L 15 19 L 14 19.59375 L 14.3125 18.40625 L 14.5 17.3125 L 13.59375 16.5 L 12.6875 15.6875 L 13.90625 15.59375 L 15.09375 15.5 L 15.59375 14.40625 L 16 13.3125 z" />
  </symbol>
</svg>

    <hr>

            <div class="container">
              <div class="row">
                <div class="col-md-8 col-12 offset-md-2">
                  <div id="sreachContent">
                    

                  </div>   
                  <div id="link">
                   
                  </div>
                </div>
              </div>

            </div>
          </div>


          </label>
          <div id="content1" class="tab-pane  in active" style="display: none">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                  <div class="col-md-6 col-12" style="max-height: 800px;overflow: auto;" >
<!-- <h3>Tệp tin</h3> -->
<div class="table-hide" >
                  <table id="example" class="nvr-table" >
                  <thead>
                    <tr class="thead">
                      <th style="width: 5%">Loại</th>
                        <th style="width: 50%">Đầu mục </th>
                        <th class="icon-td" > </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">

                      @foreach($private_file as $pfile)
                        <tr class="color-add">  

                          <?php

                          $filetype = (explode('.',$pfile->url));
                          $filetype = ($filetype[count($filetype)-1]); 
?>
<?php

            if(strpos($pfile->url,".png") > 0 
            || strpos($pfile->url,".jpg") > 0 
            || strpos($pfile->url,".jpeg") > 0 
          ){
              
              $type = "photo.jpg";
          }elseif (strpos($pfile->url,".pdf")> 0) {
              $type = "pdf.png";
          }elseif (strpos($pfile->url,".doc")> 0) {
              $type = "word.png";
          }elseif (strpos($pfile->url,".ppt")> 0) {
              $type = "pp.png";
          }elseif (strpos($pfile->url,".xls")> 0
            || strpos($pfile->url,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }


                          ?>

                          <td style="width:10%"><span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> </td>

                          @if($pfile->num > 1)<td style="width:70%" >


<span style="display: none">{{vn_to_str($pfile->name)}}</span>
                            <a target="_blank" href="warehouse/detail/{{$pfile->id}}" >{{$pfile->name}} </a>
                          @else

                          <td style="width:70%" >
                            <!-- <a  target="_blank" download="<?=$pfile->name.".".$filetype?>" href="{{$pfile->url}}"> -->


                            <a  target="_blank" href="{{$pfile->url}}">



<span style="display: none">{{vn_to_str($pfile->name)}}</span>
{{$pfile->name}} </a>
                          
                          @endif
                            <span style="display: none" id="name{{$pfile->id}}"> {{$pfile->name}}</span>

                            <span style="display: none" id="open{{$pfile->id}}">{{$pfile->open}}</span>
                           <span style="display: none">{{$pfile->time}}></span>
                           <span style="display: none"  id="tag{{$pfile->id}}">{{trim($pfile->tags)}}</span>
                           <span style="display: none"  id="tagVN{{$pfile->id}}">{{vn_to_str(trim($pfile->tags))}}</span>
<span style="display: none" id="uname{{$pfile->id}}"> {{$pfile->uname}}</span>

<span style="display: none" id="link{{$pfile->id}}">{{($pfile->url)}}</span>

<span id="time">
<?php
$old_date_timestamp = strtotime($pfile->time);
 echo date('d-m-Y H:i:s', $old_date_timestamp);
?>
</span>

                          </td>
                         <td>
                          @if($boss == 1 || Auth()->user()->id == $pfile->user_id)

                            <button onclick="Edit({{$pfile->id}})" class="preview" type="button"><img src="/js-css/img/icon/notepad.png"></button>

                          @endif
                               

                          </td>
                        </tr>
                      @endforeach


@foreach($private_dept_file as $pfile)
                        <tr class="color-add">  

                          <?php

                          $filetype = (explode('.',$pfile->url));
                          $filetype = ($filetype[count($filetype)-1]); 
?>
<?php

            if(strpos($pfile->url,".png") > 0 
            || strpos($pfile->url,".jpg") > 0 
            || strpos($pfile->url,".jpeg") > 0 
          ){
              
              $type = "photo.jpg";
          }elseif (strpos($pfile->url,".pdf")> 0) {
              $type = "pdf.png";
          }elseif (strpos($pfile->url,".doc")> 0) {
              $type = "word.png";
          }elseif (strpos($pfile->url,".ppt")> 0) {
              $type = "pp.png";
          }elseif (strpos($pfile->url,".xls")> 0
            || strpos($pfile->url,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }


                          ?>

                          <td style="width:10%"><span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> </td>

                          @if($pfile->num > 1)<td style="width:70%" >


<span style="display: none">{{vn_to_str($pfile->name)}}</span>
                            <a target="_blank" href="warehouse/detail/{{$pfile->id}}" >{{$pfile->name}} </a>
                          @else

                          <td style="width:70%" >
                            <!-- <a  target="_blank" download="<?=$pfile->name.".".$filetype?>" href="{{$pfile->url}}"> -->


                            <a  target="_blank" href="{{$pfile->url}}">



<span style="display: none">{{vn_to_str($pfile->name)}}</span>
{{$pfile->name}} </a>
                          
                          @endif
                            <span style="display: none" id="name{{$pfile->id}}"> {{$pfile->name}}</span>

                            <span style="display: none" id="open{{$pfile->id}}">{{$pfile->open}}</span>
                           <span style="display: none">{{$pfile->time}}></span>
                           <span style="display: none"  id="tag{{$pfile->id}}">{{trim($pfile->tags)}}</span>
                           <span style="display: none"  id="tagVN{{$pfile->id}}">{{vn_to_str(trim($pfile->tags))}}</span>
<span style="display: none" id="uname{{$pfile->id}}"> {{$pfile->uname}}</span>

<span style="display: none" id="link{{$pfile->id}}">{{($pfile->url)}}</span>
<span id="time">
<?php
$old_date_timestamp = strtotime($pfile->time);
 echo date('d-m-Y H:i:s', $old_date_timestamp);
?>
</span>

                          </td>
                         <td>
                          @if($boss == 1 || Auth()->user()->id == $pfile->user_id)

                            <button onclick="Edit({{$pfile->id}})" class="preview" type="button"><img src="/js-css/img/icon/notepad.png"></button>

                          @endif
                               

                          </td>
                        </tr>
                      @endforeach

                      @foreach($file as $file)
                        <tr class="color-add">  

                          <?php

                          $filetype = (explode('.',$file->url));
                          $filetype = ($filetype[count($filetype)-1]); 
?>
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

                          @if($file->num > 1)<td style="width:70%" >


<span style="display: none">{{$file->id}}</span>
<span style="display: none">{{vn_to_str($file->name)}}</span>
                            <a target="_blank" href="warehouse/detail/{{$file->id}}" >{{$file->name}} </a>
                          @else

                          <td style="width:70%" >

                            <!-- <a  target="_blank" download="<?=$file->name.".".$filetype?>" href="{{$file->url}}"> -->
                                 <a  target="_blank" href="{{$file->url}}">


<span style="display: none">{{$file->id}}</span>
<span style="display: none">{{vn_to_str($file->name)}}</span>

{{$file->name}} </a>


                          
                          @endif
                            <span style="display: none" id="name{{$file->id}}">{{$file->name}}</span>

                            <span style="display: none" id="open{{$file->id}}">{{$file->open}}</span>
                           <span style="display: none">{{$file->time}}></span>
                           <span style="display: none"  id="tag{{$file->id}}">{{trim($file->tags)}}</span>
                           <span style="display: none"  id="tagVN{{$file->id}}">{{vn_to_str(trim($file->tags))}}</span>
<span style="display: none" id="uname{{$file->id}}"> {{$file->uname}}</span>
<span style="display: none" id="link{{$file->id}}">{{($file->url)}}</span>
<span id="time">
<?php
$old_date_timestamp = strtotime($file->time);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
?>
</span>

                          </td>
                         <td>
                          @if($boss == 1 || Auth()->user()->id == $file->user_id)

                            <button onclick="Edit({{$file->id}})" class="preview" type="button"><img src="/js-css/img/icon/notepad.png"></button>

                          @endif
                               

                          </td>
                        </tr>
                      @endforeach
                          @foreach($cv as $form)
 <?php

                          $filetype = (explode('.',$form->url));
                          $filetype = ($filetype[count($filetype)-1]);
                          ?>
<?php

            if(strpos($form->url,".png") > 0 
            || strpos($form->url,".jpg") > 0 
            || strpos($form->url,".jpeg") > 0 
          ){
              
              $type = "photo.jpg";
          }elseif (strpos($form->url,".pdf")> 0) {
              $type = "pdf.png";
          }elseif (strpos($form->url,".doc")> 0) {
              $type = "word.png";
          }elseif (strpos($form->url,".ppt")> 0) {
              $type = "pp.png";
          }elseif (strpos($form->url,".xls")> 0
            || strpos($form->url,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }


                          ?>


                        <tr class="color-add">
                          <td style="width:10%"><span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> </td>
                          <td style="width:70%" >
                            <!-- <a  target="_blank" download="<?=$form->name.".".$filetype?>" href="{{$form->url}}"> -->
                            <a  target="_blank" href="{{$form->url}}">

<span style="display: none" id="cvname{{$form->id}}">{{($form->name)}}</span>

<span style="display: none">{{vn_to_str($form->name)}}</span>
                            {{$form->name}}</a>

 <span style="display: none"  id="cvtag{{$form->id}}">{{trim($form->tags)}}</span>
                           <span style="display: none"  id="fileTagVN{{$form->id}}">{{vn_to_str($form->tags)}}</span>

                            <span style="display: none" id="oname{{$form->id}}">{{$form->name}}</span>
<span style="display: none">{{$form->created_at}}></span>

<span style="display: none" id="cvlink{{$form->id}}">{{$form->url}}</span>
     <span id="time">                                                   <?php
$old_date_timestamp = strtotime($form->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?>
</span>
                          </td>
                         
                          <td class = "center-td">
                            <!-- Văn bản -->
                           <td>
                          @if($boss == 1)

                            <button onclick="EditCV({{$form->id}})" class="preview" type="button"><img src="/js-css/img/icon/notepad.png"></button>

                          @endif
                               

                          </td>
                          </td>
                           
                        </tr>
                      @endforeach
  @foreach($file2 as $form)
  <?php

                        if(strlen($form->url) == 0){
  continue;
} 
  ?>
 <?php

                          $filetype = (explode('.',$form->url));
                          $filetype = ($filetype[count($filetype)-1]);
                          ?>
<?php

            if(strpos($form->url,".png") > 0 
            || strpos($form->url,".jpg") > 0 
            || strpos($form->url,".jpeg") > 0 
          ){
              
              $type = "photo.jpg";
          }elseif (strpos($form->url,".pdf")> 0) {
              $type = "pdf.png";
          }elseif (strpos($form->url,".doc")> 0) {
              $type = "word.png";
          }elseif (strpos($form->url,".ppt")> 0) {
              $type = "pp.png";
          }elseif (strpos($form->url,".xls")> 0
            || strpos($form->url,".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }


                          ?>


                        <tr class="color-add">
                          <td style="width:10%"><span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> </td>
                          <td style="width:70%" >
                            <!-- <a  target="_blank" download="<?=$form->name.".".$filetype?>" href="{{$form->url}}"> -->
 <a  target="_blank" href="{{$form->url}}">
                            @if(strlen($form->fname) > 0)
                            {{$form->fname}} ({{$form->name}})
                            @else
                               {{$form->name}}
                            @endif
                          </a>

                              <span style="display: none">{{vn_to_str($form->name)}}</span>

                            <span style="display: none" id="oname{{$form->id}}">{{$form->name}}</span>
<span style="display: none">{{$form->created_at}}></span>
<span style="display: none" id="link{{$form->id}}">{{$form->url}}></span>

     <span id="time">                                                   <?php
$old_date_timestamp = strtotime($form->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?>
</span>
                          </td>
                         
                          <td class = "center-td">
                            <!-- Văn bản -->
                          
                          </td>
                           
                        </tr>
                      @endforeach

 @foreach($zone_history as $file)
 <?php

                          $filetype = (explode('.',$file->url));
                          $filetype = ($filetype[count($filetype)-1]);
                          ?>

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
<tr class="color-add">
                          <td style="width:10%"><span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> </td>
                        
                          <td style="width:70%">
                            <!-- <a  target="_blank" download=" <?=$file->description." ".$file->name.".".$filetype?> " href="{{$file->url}}"> -->

                            <a  target="_blank" href="{{$file->url}}">

<span style="display: none">{{vn_to_str($file->name)}}</span>
<span style="display: none">{{vn_to_str($file->description)}}</span>
                            {{$file->description}} {{$file->name}} </a>

                            <span style="display: none" id="yname{{$file->id}}">{{$file->name}} </span>
<span style="display: none">{{$file->created_at}}></span>
           <span id="time">                                             <?php
$old_date_timestamp = strtotime($file->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?></span>
                          </td>
                         
                          <td class = "center-td">
                           
                          </td>
                           
                        </tr>
                      @endforeach
@foreach($build_history as $file)
 <?php

                          $filetype = (explode('.',$file->url));
                          $filetype = ($filetype[count($filetype)-1]);
                          ?>

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


                          ?>    <tr class="color-add">

                          <td style="width:10%"><span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> </td>
                    
                          <td style="width:70%">
                            <!-- <a  target="_blank" download=" <?=$file->name.".".$filetype?> " href="{{$file->url}}"> -->

<a  target="_blank" href="{{$file->url}}">
<span style="display: none">{{vn_to_str($file->name)}}</span>

                            {{$file->name}}  </a>

                            <span style="display: none" id="yname{{$file->id}}">{{$file->name}} </span>
<span style="display: none">{{$file->created_at}}></span>
          <span id="time">                                              <?php
$old_date_timestamp = strtotime($file->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?></span>
                          </td>
                        
                          <td class = "center-td">
                          
                          </td>
                           
                        </tr>
                      @endforeach



</tbody></table></div>
<h3>Công việc</h3>
  <table id="scheduleTable" class="nvr-table">
    <thead>
                    <tr class="thead">
                      <th style="width: 5%"></th>
                        <th >Đầu mục </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">

   @foreach($schedule_files as $file)
 <?php

                          $filetype = (explode('.',$file->url));
                          $filetype = ($filetype[count($filetype)-1]);
                          ?>

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
 <tr class="color-add">
                          <td style="width:10%"><span class="preview"><img src="/js-css/img/file_type/{{$type}}"></span> </td>
                       
                          <td style="width:70%" ><a target="_blank" href="/chatify/schedule/{{$file->sid}}" >


<span style="display: none">{{vn_to_str($file->title)}}</span>


<span style="display: none">{{vn_to_str($file->stitle)}}</span>


                            {{$file->title}} (Công việc:{{$file->stitle}} )</a>

                            <span style="display: none" id="yname{{$file->id}}">{{$file->title}} </span>
<span style="display: none">{{$file->time}}></span>
                <span id="time">                                        <?php
$old_date_timestamp = strtotime($file->time);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?>
</span>
                          <span style="display: none"></span>
                          <span style="display: none">Hệ thống</span>
                          </td>

                        
                           
                        </tr>
                      @endforeach

               
 @foreach($schedules as $schedule)

                        <tr class="color-add">

                          <td style="width:10%"><span class="preview"><img src="/js-css/img/file_type/other.png"></span> </td>
                          <td style="width:70%"><a target="_blank" href="/chatify/schedule/{{$schedule->id}}" >
<span style="display: none">{{vn_to_str($schedule->title)}}</span>


                            {{$schedule->title}} </a>

                            <span style="display: none" id="yname{{$schedule->id}}">{{$schedule->title}} </span>
<span style="display: none">{{$schedule->created_at}}></span>
            <span id="time">                                            <?php
$old_date_timestamp = strtotime($schedule->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?></span>
                          <span style="display: none"></span>
                          <span style="display: none">Công việc</span>
                                                  </td>
                           
                        </tr>
                      @endforeach


                    </tbody>
                  </table>
                  <hr>
                  <h3 onclick="ToggleMess(this)">Tin nhắn</h3>

                   <table id="noteTable" style="display: none;" class="table table-striped">
                  <thead>
                    <tr class="thead">
                        <th style="width:70%">Nội dung </th>
                        <th>Tệp đính kèm </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($schedule_messages as $mess)
                        <tr class="color-add">  
                            <td><a target="_blank"  href="/chatify/schedule/{{$mess->sid}}" class="preview" type="button">
                              @if($mess->avatar)
                              <img   class="direct-chat-img" src="{{$mess->avatar}}">
                              @else
                              <img class="direct-chat-img" src="/js-css/img/icon/avatar.png">

                              @endif

<span style="display: none">{{vn_to_str($mess->body)}}</span>

<span style="display: none">{{vn_to_str($mess->title)}}</span>

                              {{$mess->body}} ({{$mess->title}}) 



                              <span id="time">                                                   <?php
$old_date_timestamp = strtotime($mess->time);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?>
</span></a> </td>
                       
                            @if(strlen($mess->attachment) > 0)
                            <?php

 $content = explode(',',$mess->attachment);
            // dd($content);

               if(strpos($content[1],".png") > 0 
            || strpos($content[1],".jpg") > 0 
            || strpos($content[1],".jpeg") > 0 
          ){
              
              $type = "photo.jpg";
          }elseif (strpos($content[1],".pdf")> 0) {
              $type = "pdf.png";
          }elseif (strpos($content[1],".doc")> 0) {
              $type = "word.png";
          }elseif (strpos($content[1],".ppt")> 0) {
              $type = "pp.png";
          }elseif (strpos($content[1],".xls")> 0
            || strpos($content[1],".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }
                            ?>
                            <td>

                              <!-- <a style="color:red" target="_blank" download="{{$content[1]}}" href="/storage/public/attachments/{{$content[0]}}" class="preview" type="button">{{$content[1]}}</a> -->
  <a style="color:red" target="_blank" href="/storage/public/attachments/{{$content[0]}}" class="preview" type="button">{{$content[1]}}</a>
                            </td>
                            @else
                            <td>Không</td>
                            @endif
                        </tr>
                      @endforeach
                      @foreach($thread_messages as $mess)
                        <tr class="color-add">  
                             <td><a  target="_blank"  href="/chatify/schedule/{{$mess->sid}}" class="preview" type="button">
  @if($mess->avatar)
                              <img   class="direct-chat-img" src="{{$mess->avatar}}">
                              @else
                              <img class="direct-chat-img" src="/js-css/img/icon/avatar.png">

                              @endif
<span style="display: none">{{vn_to_str($mess->body)}}</span>

<span style="display: none">{{vn_to_str($mess->title)}}</span>
                              {{$mess->body}} ({{$mess->title}}) <span id="time">                                                   <?php
$old_date_timestamp = strtotime($mess->time);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?>
</span></a> </td>
                            @if(strlen($mess->attachment) > 0)
                            <?php

 $content = explode(',',$mess->attachment);
            // dd($content);

               if(strpos($content[1],".png") > 0 
            || strpos($content[1],".jpg") > 0 
            || strpos($content[1],".jpeg") > 0 
          ){
              
              $type = "photo.jpg";
          }elseif (strpos($content[1],".pdf")> 0) {
              $type = "pdf.png";
          }elseif (strpos($content[1],".doc")> 0) {
              $type = "word.png";
          }elseif (strpos($content[1],".ppt")> 0) {
              $type = "pp.png";
          }elseif (strpos($content[1],".xls")> 0
            || strpos($content[1],".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }
                            ?>
                            <td>

                              <!-- <a style="color:black" target="_blank" download="{{$content[1]}}" href="/storage/public/attachments/{{$content[0]}}" class="preview" type="button">{{$content[1]}}</a> -->

                              <a style="color:black" target="_blank" href="/storage/public/attachments/{{$content[0]}}" class="preview" type="button">{{$content[1]}}</a>
                            </td>
                            @else
                            <td>Không</td>
                            @endif
                            
                        </tr>
                      @endforeach

                      @foreach($zone_mess as $mess)
                        <tr class="color-add">  
                             <td><a target="_blank"  href="/chatify/sale/{{$mess->zid}}" class="preview" type="button">
  @if($mess->avatar)
                              <img   class="direct-chat-img" src="{{$mess->avatar}}">
                              @else
                              <img class="direct-chat-img" src="/js-css/img/icon/avatar.png">

                              @endif


<span style="display: none">{{vn_to_str($mess->body)}}</span>

<span style="display: none">{{vn_to_str($mess->zname)}}</span>

                              {{$mess->body}} ({{$mess->zname}}) <span id="time">                                                   <?php
$old_date_timestamp = strtotime($mess->time);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?>
</span></a> </td>
                            @if(strlen($mess->attachment) > 0)
                            <?php

 $content = explode(',',$mess->attachment);
            // dd($content);

               if(strpos($content[1],".png") > 0 
            || strpos($content[1],".jpg") > 0 
            || strpos($content[1],".jpeg") > 0 
          ){
              
              $type = "photo.jpg";
          }elseif (strpos($content[1],".pdf")> 0) {
              $type = "pdf.png";
          }elseif (strpos($content[1],".doc")> 0) {
              $type = "word.png";
          }elseif (strpos($content[1],".ppt")> 0) {
              $type = "pp.png";
          }elseif (strpos($content[1],".xls")> 0
            || strpos($content[1],".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }
                            ?>
                            <td>
                              <!-- <a style="color:black" target="_blank" download="{{$content[1]}}" href="/storage/public/attachments/{{$content[0]}}" class="preview" type="button">{{$content[1]}}</a> -->

                              <a style="color:black" target="_blank" href="/storage/public/attachments/{{$content[0]}}" class="preview" type="button">{{$content[1]}}</a>

                            </td>
                            @else
                            <td>Không</td>
                            @endif
                            
                        </tr>
                      @endforeach


 @foreach($build_mess as $mess)
                        <tr class="color-add">  
                             <td>
  @if($mess->avatar)
                              <img   class="direct-chat-img" src="{{$mess->avatar}}">
                              @else
                              <img class="direct-chat-img" src="/js-css/img/icon/avatar.png">

                              @endif


<span style="display: none">{{vn_to_str($mess->body)}}</span>

<span style="display: none">{{vn_to_str($mess->btitle)}}</span>

                              {{$mess->body}} ({{$mess->btitle}}) <span id="time">                                                   <?php
$old_date_timestamp = strtotime($mess->time);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?>
</span></a> </td>
                            @if(strlen($mess->attachment) > 0)
                            <?php

 $content = explode(',',$mess->attachment);
            // dd($content);

               if(strpos($content[1],".png") > 0 
            || strpos($content[1],".jpg") > 0 
            || strpos($content[1],".jpeg") > 0 
          ){
              
              $type = "photo.jpg";
          }elseif (strpos($content[1],".pdf")> 0) {
              $type = "pdf.png";
          }elseif (strpos($content[1],".doc")> 0) {
              $type = "word.png";
          }elseif (strpos($content[1],".ppt")> 0) {
              $type = "pp.png";
          }elseif (strpos($content[1],".xls")> 0
            || strpos($content[1],".csv") > 0 )
           {
              $type = "excel.png";
          }else{
            
              $type = "other.png";
          }
                            ?>
                            <td>
                              <!-- <a style="color:black" target="_blank" download="{{$content[1]}}" href="/storage/public/attachments/{{$content[0]}}" class="preview" type="button">{{$content[1]}}</a> -->

                              <a style="color:black" target="_blank" href="/storage/public/attachments/{{$content[0]}}" class="preview" type="button">{{$content[1]}}</a>

                            </td>
                            @else
                            <td>Không</td>
                            @endif
                            
                        </tr>
                      @endforeach



                    </tbody>
                  </table>
                </div>
                  <div class="col-md-6 col-12">

                  <h3>Liên kết ngoài</h3>
                 @if((Cookie::get('find')!== "lopital_null"))
                  <div id="GoogleContent">
<iframe src="https://www.google.com/search?igu=1&q={{Cookie::get('find')}}"></iframe>
@else

<iframe src="https://www.google.com/search?igu=1"></iframe>
@endif
                  ]</div>
                </div>
              </div>
            </div>
          </div>

           

        </div>
      </div>
    </div>
  <!-- end model --->
 <div class="modal fade modol-text" id="new-url" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%;height:2000px">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm tệp</label>
              </div>
              <div class="notification"></div>
               <form id="uploadfile" action="warehouse/edit-task-file"  enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">  
                  <div class="modal-body">
                   
                   <h4>Tên</h4>
              <input class="input-edit modol-text"  name="title" value="">
  <h4>Tag</h4>
             <input id="newTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">




              <h4>Công khai (Cho tất cả mọi người, kể cả khách)</h4>
              <div id="OpenDiv">

<div class="form-group">
  <select class="form-control" name="open">
                  <option value="0">Không</option>
                  <option value="1">Có</option>
  </select>
</div>
             
              </div>

   <h4>Danh sách phòng ban được xem</h4>

              <div id="deptDiv"></div>
      <h4>Danh sách người được xem</h4>
              
              <div id="staffDiv"></div>

   <input style="display: none" id="fileinput" type="file" name="file[]" class="file" multiple>

                    <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Tải tệp tin" id="file" >
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Chọn</button>
                        </div>
                    </div>

                <div class="form-group" id="preview-file"></div>
<br><hr><br>

 <div class="form-group" id="preview">
</div>

    
              </div>
<br><hr>
            
             
  <div class="modal-footer" style="    position: inherit;">
   <button   class="button-77"  type="submit"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Cập nhật </button>
                <button type="button-77" class="button-77" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>
            </div>
          </div>
        </form>
    </div>

          </div>
      </div>
   <div class="modal fade modol-text" id="new-edge" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Sửa tệp</label>
              </div>
              <div class="notification"></div>
              <form action="warehouse/edit-task-file-name" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                             
                           <tr>
                                <td class="cam-properties">Tên: </td>
                                <td>
                                <input class="input-edit modol-text"  name="title" id="editName" value="">
                                <input type="hidden" name="id" id="editId" value=""></td>
                            </tr>
                          <tr>
                                <td class="cam-properties">Tag: </td>
                                <td class="editTD">
                                 <input id="editTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags"></td><input value = "0" type="hidden" name="type" class="form-control">
                            </tr>
                               </tbody>
                    </table>
                 


              <h4>Công khai (Cho tất cả mọi người, kể cả khách)</h4>
              <div id="OpenDiv">

<div class="form-group">
  <select class="form-control" name="open" id="editOpen">
                  <option value="0">Không</option>
                  <option value="1">Có</option>
  </select>
</div>
             
              </div>

      <h4>Danh sách phòng ban được xem</h4>

              <div id="deptEditDiv"></div>
      <h4>Danh sách người được xem</h4>
              
              <div id="staffEditDiv"></div>


    
  <input style="display: none" id="fileinputEdit" type="file" name="file[]" class="file" multiple>

                 <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Tải tệp tin mới" id="file2" >
                        <div class="input-group-append">
                            <button type="button" class="browse-edit btn btn-primary">Chọn</button>
                        </div>
                    </div>

                <div class="form-group" id="preview-file-edit"></div>
              </div>
<br><hr>
   

         
             
  <div class="modal-footer" style="    position: inherit;">
   <button   class="button-77"  type="submit"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Cập nhật </button>

   <button id="removeBtn" class="button-77"   class="preview"><a style="color: white;" href="" id="removeLink" > Xóa </a></button>

                <button type="button-77" class="button-77" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>
            </div>
          </div>
        </form>
            </div>
          </div>
      </div>



<div class="modal fade modol-text" id="new-edge2" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Sửa tệp</label>
              </div>
              <div class="notification"></div>
              <form action="legal/edit-task-file-name" method="POST"  enctype="multipart/form-data"> 
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                             
                           <tr>
                                <td class="cam-properties">Tên: </td>
                                <td>
                                <input class="input-edit modol-text"  name="title" id="editCvName" value="">
                                <input type="hidden" name="id" id="editCvId" value=""></td>
                            </tr>
                         
                           <tr>
                                <td class="cam-properties">Tags: </td>
                                <td>
                                <input id="editCvTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">
                                </td>
                          </tr>
                          <tr>
  <td class="cam-properties">Tải tệp khác  </td>
                  <td><label  class="preview" for="file-input"><img onclick="openfileupload(3)"  src="/js-css/img/icon/upload.png"></label><input  id= "inputfile3" style="display:none" type="file" name="file[]" class="form-control"
                    multiple>
                </td>
                </tr>

                <tr>
  <td></td>
  <td>
                <span class="form-group" id="preview-file3"></span>
      </td>         
                          </tr>

                          <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>

                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoat </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>


  <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
    </div>
    <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
     </div>


<div class="overlay-dark"></div>
<embed class="img-overlay">

  <script>
   
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


    function openfileupload(){
            document.getElementById("inputfile").click();
    }


 function uploadsubmit(){ 
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
      document.getElementById("uploadfile").submit();
            swal.close();
          }
          else {
            swal.close();
          }
        });

    }
function  Edit(id){

  var url = document.getElementById("link"+id).innerHTML

  var filename = "<a target='_blank' href = '"+url+"' >"+document.getElementById("name"+id).innerHTML+"</a>"
  document.getElementById("preview-file-edit").innerHTML = '<p><img width="25" height = "25" src="/js-css/img/file_type/pdf.png"> ' +filename + " <span style='color:red' onclick='closeEditFile()'>x</span><p>"

  document.getElementById("editId").value = id

document.getElementById("removeLink").href = "warehouse/file-delete/"+id

  // document.getElementById("editOpen").value = document.getElementById("open"+id).innerHTML

  $("#editOpen").val(document.getElementById("open"+id).innerHTML);

  document.getElementById("editName").value = document.getElementById("name"+id).innerHTML
  getDeptList2(id)
  getStaffList2(id)
  // document.getElementById("editType").value = parseInt(document.getElementById("type"+id).innerHTML)
$("#editTag").tagsinput('removeAll');
var rawhtml = $("#tag"+id).html();
     if (rawhtml.length > 1){
     rawhtml = rawhtml.split(',');
     for (var i = 0; i < rawhtml.length;i++){
    $('#editTag').tagsinput('add', rawhtml[i]);
    }
    }
  // document.getElementById("editTag").value = document.getElementById("tag"+id).innerHTML
$("#new-edge").modal()

}


function  EditCV(id){
  document.getElementById("editCvId").value = id
  var url = document.getElementById("cvlink"+id).innerHTML
    var filename = "<a target='_blank' href = '"+url+"' >"+document.getElementById("cvname"+id).innerHTML+"</a>"
  document.getElementById("preview-file3").innerHTML = '<p><img width="25" height = "25" src="/js-css/img/file_type/pdf.png"> ' + filename+ " <span style='color:red' onclick='closeEditFile()'>x</span><p>"



  document.getElementById("editCvName").value = document.getElementById("cvname"+id).innerHTML


  $("#editCvTag").tagsinput('removeAll');
var rawhtml = $("#cvtag"+id).html();
     if (rawhtml.length > 1){
     rawhtml = rawhtml.split(',');
     for (var i = 0; i < rawhtml.length;i++){
    $('#editCvTag').tagsinput('add', rawhtml[i]);
    }
  }


$("#new-edge2").modal()

}

  </script>
<script type="text/javascript">
  function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
              b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}

</script>

  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
  <script>

    // alert("being")



    // alert("124")

    var table1 = $('#example').DataTable({
    "pageLength": 100,
    @if((Cookie::get('find')!== "lopital_null"))
     "oSearch": {"sSearch": "{{Cookie::get('find')}}"},

    @endif
});

     var table2 =  $('#scheduleTable').DataTable({
    "pageLength": 100,
    @if((Cookie::get('find')!== "lopital_null"))
     "oSearch": {"sSearch": "{{Cookie::get('find')}}"},

    @endif
});

       var table3 =   $('#noteTable').DataTable({
    "pageLength": 100,
    @if((Cookie::get('find')!== "lopital_null"))
     "oSearch": {"sSearch": "{{Cookie::get('find')}}"},

    @endif
    <?php

    if((Cookie::get('find')!== null)){
      Cookie::queue('find', "lopital_null", 10);
    }
    ?>
});

$(document).ready(function(){



var tags = JSON.parse('{!! $tags !!}');
console.log(tags)
// console.log(document.querySelector("td.tagTD div input"))
autocomplete(document.querySelector("td.tagTD div input"), tags);
autocomplete(document.querySelector("td.editTD div input"), tags);


$('.bootstrap-tagsinput input').keydown(function( event ) {
    if ( event.which == 13 ) {
        $(this).blur();
        $(this).focus();
        return false;
    }
})

});
  </script>

<script src="/js-css/js/bootstrap-select.min.js"></script>
<script src="/js-css/js/ckeditor/ckeditor.js"></script>
  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
<script type="text/javascript">

 function getStaffList(id){
  console.log('/schedule/staff-select/'+id)
  $.ajax({
    type: "GET",
    url: '/file/staff-select/'+id,
    success: function (response) {
      response = (JSON.parse(response))
      console.log(response)
      var data = response[0]
      var sel = response[1]
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


     var  html = '<select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffSelected" multiple>'
      for(var i =0; i < data.length; i++){
        if(data[i].dname ==null){
          continue;
        }
          if (sel.includes(data[i].id)){
          html = html +'<option  value="'+data[i].id+'" selected>'+data[i].name+ "-"+data[i].dname +'</option>'
          }else{
          html = html +'<option  value="'+data[i].id+'">'+data[i].name+ "-"+data[i].dname +'</option>'

          }
      }
     hhtml = html + '</select>'
      // console.log(html)
      // document.getElementsByClassName("filter-option-inner-inner")[1].innerHTML = ""
      console.log(html)
      document.getElementById("staffDiv").innerHTML=html;
$('#staffSelected').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
    }
  });
}


 function getDeptList(id){
  $.ajax({
    type: "GET",
    url: '/file/dept-select/'+id+'/',
    success: function (response) {
      response = (JSON.parse(response))
      console.log(response)
      var data = response[0]
      var sel = response[1]
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


     var  html = '<select name="did[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="deptSelected" multiple>'
      for(var i =0; i < data.length; i++){
          if (sel.includes(data[i].id)){
          html = html +'<option  value="'+data[i].id+'" selected>'+data[i].name+'</option>'
          }else{
          html = html +'<option  value="'+data[i].id+'">'+data[i].name+'</option>'

          }
      }
     hhtml = html + '</select>'
      // console.log(html)
      // document.getElementsByClassName("filter-option-inner-inner")[1].innerHTML = ""
      document.getElementById("deptDiv").innerHTML=html;
$('#deptSelected').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
    }
  });
}


getStaffList(0)
getDeptList(0)

 function getStaffList2(id){
  console.log('/schedule/staff-select/'+id)
  $.ajax({
    type: "GET",
    url: '/file/staff-select/'+id,
    success: function (response) {
      response = (JSON.parse(response))
      console.log(response)
      var data = response[0]
      var sel = response[1]
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


     var  html = '<select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffEditSelected" multiple>'
      for(var i =0; i < data.length; i++){
          if (sel.includes(data[i].id)){
          html = html +'<option  value="'+data[i].id+'" selected>'+data[i].name+ "-"+data[i].rname + "(" +  data[i].dname + ")" +'</option>'
          }else{
          html = html +'<option  value="'+data[i].id+'">'+data[i].name+ "-"+data[i].rname + "(" +  data[i].dname + ")" +'</option>'

          }
      }
     hhtml = html + '</select>'
      // console.log(html)
      // document.getElementsByClassName("filter-option-inner-inner")[1].innerHTML = ""
      console.log(html)
      document.getElementById("staffEditDiv").innerHTML=html;
$('#staffEditSelected').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
    }
  });
}


 function getDeptList2(id){
  $.ajax({
    type: "GET",
    url: '/file/dept-select/'+id+'/',
    success: function (response) {
      response = (JSON.parse(response))
      console.log(response)
      var data = response[0]
      var sel = response[1]
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


     var  html = '<select name="did[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="deptEditSelected" multiple>'
      for(var i =0; i < data.length; i++){
          if (sel.includes(data[i].id)){
          html = html +'<option  value="'+data[i].id+'" selected>'+data[i].name+'</option>'
          }else{
          html = html +'<option  value="'+data[i].id+'">'+data[i].name+'</option>'

          }
      }
     hhtml = html + '</select>'
      // console.log(html)
      // document.getElementsByClassName("filter-option-inner-inner")[1].innerHTML = ""
      document.getElementById("deptEditDiv").innerHTML=html;
$('#deptEditSelected').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
    }
  });
}


</script>
<script type="text/javascript">


function removeAccents(str) {
  var AccentsMap = [
    "aàảãáạăằẳẵắặâầẩẫấậ",
    "AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬ",
    "dđ", "DĐ",
    "eèẻẽéẹêềểễếệ",
    "EÈẺẼÉẸÊỀỂỄẾỆ",
    "iìỉĩíị",
    "IÌỈĨÍỊ",
    "oòỏõóọôồổỗốộơờởỡớợ",
    "OÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢ",
    "uùủũúụưừửữứự",
    "UÙỦŨÚỤƯỪỬỮỨỰ",
    "yỳỷỹýỵ",
    "YỲỶỸÝỴ"    
  ];
  for (var i=0; i<AccentsMap.length; i++) {
    var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
    var char = AccentsMap[i][0];
    str = str.replace(re, char);
  }
  return str;
}



function search(){
  alert("oke")
  var val = removeAccents(document.getElementById("myinput").value)
  console.log(val)

            $('input[type="search"]').val(val);
            table1.search(val).draw()
            table2.search(val).draw()
            table3.search(val).draw()
//             document.getElementById("GoogleContent").innerHTML = 
// '<iframe src="https://www.google.com/search?igu=1&q='+val+'"></iframe>'
mytest(val)


}

$('input[type="search"]').keyup(function() {
  // alert("oker")
            var val = this.value;
            $('input[type="search"]').val(val);
            table1.search(val).draw()
            table2.search(val).draw()
            table3.search(val).draw()
//             document.getElementById("GoogleContent").innerHTML = 
// '<iframe src="https://www.google.com/search?igu=1&q='+val+'"></iframe>'



mytest(val)

});





function mytest(val){
   var html = ""
  var temp = ""
  var temp2 = ""
  

   var limit = 7;

   if (window.innerWidth <  600){
    limit =3;
   }
 var count = 0;
 $('#example > tbody  > tr').each(function(index, tr) { 
   if (count < limit){
    if(tr.innerHTML.includes("No matching records found") == false){
     temp = temp + tr.innerHTML+ "<br><br>"
     count = count +1
   }
   }else{
    temp2 = temp2 + tr.innerHTML+ "<br><br>"
   }
});
 if(temp !=""){

   html = html + "<h4>Tệp tin</h4>" + temp
   html = html + "<a style='color:blue' id='fileTitle' onclick='fileShow()'>+ Xem thêm</a>"
   html = html + "<div style='display: none' id='fileContent'>"+temp2+"<br><br><a  style='color:blue' onclick='fileClosed()'>Đóng</a></div>"

   html =html +"<br><br>"

 }

temp = ""
temp2 = ""
count = 0;
 $('#scheduleTable > tbody  > tr').each(function(index, tr) { 
   if (count < limit){
    if(tr.innerHTML.includes("No matching records found") == false){
     temp = temp + tr.innerHTML+ "<br><br>"
     count = count +1
   }
   }else{
    temp2 = temp2 + tr.innerHTML+ "<br><br>"
   }
});
 if(temp !=""){

   html = html + '<hr><h4 onclick="ToggleJob(this)">Công việc<div style="display:none"  id="jobTable">' + temp
  html = html + "<a style='color:blue' id='scheduleTitle' onclick='scheduleShow()'>+ Xem thêm</a>"
  html = html + "<div style='display: none' id='scheduleContent'>"+temp2+"<br><br><a  style='color:blue' onclick='scheduleClosed()'>Đóng</a></div></div>"

  html =html +"<br><br>"
 }


count = 0;
temp = ""
temp2 = ""
 $('#noteTable > tbody  > tr').each(function(index, tr) { 

   if (count < limit){
  
    if(tr.innerHTML.includes("No matching records found") == false){
     temp = temp + tr.innerHTML+ "<br><br>"
     count = count +1
   }
   }else{
    temp2 = temp2 + tr.innerHTML+ "<br><br>"
   }

});

  if(temp !=""){

    html = html + '<hr><h4 onclick="ToggleMess(this)">Tin nhắn</h4><div style="display:none"  id="MessTable">' + temp 
    html = html + "<a style='color:blue' id='messTitle' onclick='messShow()'>+ Xem thêm</a>"
    html = html + "<div style='display: none' id='messContent'>"+temp2+"<br><br><a  style='color:blue' onclick='messClosed()'>Đóng</a></div></div>"

    html =html +"<br><br>"

 }


   document.getElementById("sreachContent").innerHTML =  html 

  setCookie("find", val, 3600*24, "/", false);


 }
 $('#sForm').submit(false);


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

function changeType(){
  // alert('oke')
  type =  document.getElementById("sType").value;
  if(type == 2){
    window.location.href="/warehouse/image-list"
  }
}


function fileShow(){


   document.getElementById("fileTitle").style.display = "none";
   document.getElementById("fileContent").style.display = "block";
}

function fileClosed(){

   document.getElementById("fileTitle").style.display = "block";
   document.getElementById("fileContent").style.display = "none";

}

function scheduleShow(){


   document.getElementById("scheduleTitle").style.display = "none";
   document.getElementById("scheduleContent").style.display = "block";
}

function scheduleClosed(){

   document.getElementById("scheduleTitle").style.display = "block";
   document.getElementById("scheduleContent").style.display = "none";

}

function messShow(){


   document.getElementById("messTitle").style.display = "none";
   document.getElementById("messContent").style.display = "block";
}

function messClosed(){

   document.getElementById("messTitle").style.display = "block";
   document.getElementById("messContent").style.display = "none";

}

      </script>
      <script type="text/javascript">
 $(document).on("click", ".browse", function() {
          console.log($(this))
          var file = $("#fileinput")
          file.trigger("click");
        });


  $(document).on("click", ".browse-edit", function() {
          console.log($(this))
          var file = $("#fileinputEdit")
          file.trigger("click");
        });

      
 $('input[type="file"]').change(function(e) {
            // alert(e.target.files.length)
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
          html  = html + '<img style="width: 50px;margin-left: 3%;" src="'+e.target.result+'" id="preview" class="preview">';
             console.log(myElement.html())
           myElement.html(html);
          console.log(myElement.html())

          };
       
          reader.readAsDataURL(this.files[i]);
      }else{
            // get loaded data and render thumbnail.
        console.log(fileName)
          html  = html + '<p><img width="25" height = "25" src="/js-css/img/file_type/pdf.png"> ' + fileName+ " <span style='color:red' onclick='closeFile()'>x</span><p>"; 
        // alert(fileName)
        // console.html(html)
            $("#preview-file").html(html);
            $("#preview-file-edit").html(html);
          
  }



          // read the image file as a data URL.
                }
              
        });
  function closeFile(){
     $("#preview-file").html("");
     $("#preview-file-edit").html("");
  }
 
function hideKeyboard(element) {
    element.attr('readonly', 'readonly'); // Force keyboard to hide on input field.
    element.attr('disabled', 'true'); // Force keyboard to hide on textarea field.
    setTimeout(function() {
        element.blur();  //actually close the keyboard
        // Remove readonly attribute after keyboard is hidden.
        element.removeAttr('readonly');
        element.removeAttr('disabled');
    }, 100);
}

$("#sForm").on('keyup', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
       // alert("done")
       hideKeyboard($("#myinput"));

         var top = document.getElementById("sreachContent").offsetTop+300;
         // alert(top)
  if(top < 0){
    top =0
  }
  setTimeout(function() {
         $(window).scrollTop(top);
       });

    }
});


  function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }

function inputOpen(){
  // alert("1");
  // document.getElementById("myinput").click();
  $("#myinput").focus()
}

function ToggleMess(element){
  $("#MessTable").slideToggle();
}

function ToggleJob(element){
  $("#jobTable").slideToggle();
}

var val = removeAccents(document.getElementById("myinput").value)

if(val.length > 0){
            $('input[type="search"]').val(val);
            table1.search(val).draw()
            table2.search(val).draw()
            table3.search(val).draw()
          mytest(val)
}
      </script>


@endsection