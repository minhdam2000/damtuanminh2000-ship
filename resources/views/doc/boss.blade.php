@extends('layouts.index')
@section('content')
<style type="text/css">
  .tab-content{
    width: 90%;
    margin-left: 5%;
  }
</style>
  <div class="content-camera">
    <div class="header-content">
      <div class="header-content-left">
        <h6>Hướng dẫn sử dụng</h6>
      </div>
      <div class="header-content-right" style="display: inline;">
        <a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i> Home </h6></a>
        /
        <h6 class="display-inline">Hướng dẫn sử dụng</h6>
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
      <li class="nav-item margin_center active">
          <a id="tab1" class="nav-link  color-a" 
          data-toggle="tab" href="#content1">Pháp lý hệ thống</a>
      </li>
     <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" href="#content2">Quản lý nhân sự </a>
      </li>
     <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" href="#content3">Module bán hàng </a>
      </li>
        <li class="nav-item margin_center">
          <a id="tab5" class="nav-link color-a" 
          data-toggle="tab" href="#content7">Module Xây dựng  </a>
      </li>

     <li class="nav-item margin_center">
          <a id="tab4" class="nav-link color-a" 
          data-toggle="tab" href="#content5">Giao việc </a>
      </li>
     <li class="nav-item margin_center">
          <a id="tab5" class="nav-link color-a" 
          data-toggle="tab" href="#content4">Tin nhắn </a>
      </li>
    
     <li class="nav-item margin_center">
          <a id="tab5" class="nav-link color-a" 
          data-toggle="tab" href="#content8"> Trang cá nhân và thông báo </a>
      </li>
    
   
    
     <li class="nav-item margin_center">
          <a id="tab5" class="nav-link color-a" 
          data-toggle="tab" href="#content6"> Khác </a>
      </li>
    
    
    
     


    </ul>  
    <hr>

        <div class="tab-content">

            <div id="content1" class="tab-pane active" >
              <h3>Hướng dẫn xem hệ thống pháp lý</h3>
          <iframe class ="youtube" src="https://www.youtube.com/embed/KVemPp8fzbs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

              <h3>Hướng dẫn xem hệ thống pháp lý trên điện thoại </h3>

              <iframe class ="youtube" src="https://www.youtube.com/embed/Tn2-CIEiU3Q" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

             <div id="content2" class="tab-pane" >
              <h3>Hướng dẫn xem hệ thống nhân sự</h3>
 <iframe class ="youtube" src="https://www.youtube.com/embed/-ZIx427RFGU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      

              <h3>Hướng dẫn xem chi tiết nhân sự từng nhân viên</h3>

 <iframe class ="youtube" src="https://www.youtube.com/embed/enBgmEq3yKo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

              <h3>Hướng dẫn xem quản lý nhân sự trên điện thoại </h3>

              <iframe class ="youtube" src="https://www.youtube.com/embed/3YIENGsgK9E" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

              <div id="content3" class="tab-pane" >
              <h3>Khóa lô và Khởi tạo hợp đồng mới</h3>
<iframe class ="youtube" src="https://www.youtube.com/embed/9RJFZ16OID4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      

              <h3>Hoàn thiện thủ tục bán hàng</h3>

<iframe class ="youtube" src="https://www.youtube.com/embed/LWUfaPdV4Zo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

              <h3>Hủy hợp đồng </h3>

          <iframe class ="youtube" src="https://www.youtube.com/embed/HexyO7U2w5U" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

              <h3>Xem thông báo, các sự kiện đến hạn</h3>

              <iframe class ="youtube" src="https://www.youtube.com/embed/3YIENGsgK9E" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

              <h3>Module bán hàng trên điện thoại</h3>

              <iframe class ="youtube" src="https://www.youtube.com/embed/B5YtgakqJYU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

            </div>

 <div id="content5" class="tab-pane" >
              <h3>Quản lý công việc</h3>
<iframe class ="youtube" src="https://www.youtube.com/embed/0W_-ICkDwes" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>      

              <h3>Quản lý công việc trên điện thoại</h3>

<iframe class ="youtube" src="https://www.youtube.com/embed/Xh2aaMDhs1M" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

           

            </div>

<div id="content4" class="tab-pane" >
              <h3>Tin nhắn</h3>
<iframe class ="youtube" src="https://www.youtube.com/embed/JXYBDStqs2k" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

              <h3>Tin nhắn trên điện thoại</h3>

<iframe class ="youtube" src="https://www.youtube.com/embed/d0dEWRHfYYs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

           

            </div>
<div id="content6" class="tab-pane" >
              <h3>Một số tính năng khác</h3>
<iframe class ="youtube" src="https://www.youtube.com/embed/E1_qBcTPC8M" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

           

            </div>
<div id="content7" class="tab-pane" >
              <h3>Quản lý tiến độ</h3>
<iframe class ="youtube" src="https://www.youtube.com/embed/Pp_3MKhzPME" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                      <h3>Module xây dựng cập nhật tiến độ trên điện thoại</h3>
                      <iframe class ="youtube" src="https://www.youtube.com/embed/3TPKq4uITdA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

              <h3>Quản lý tiến độ trên điện thoại</h3>
<iframe class ="youtube" src="https://www.youtube.com/embed/mROaduBJ9Fs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
           


            </div>

            <div id="content8" class="tab-pane" >

                      <h3>Chỉnh sửa thông tin cá nhân</h3>
<iframe class ="youtube" src="https://www.youtube.com/embed/tbupaIpyFbA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

              <h3>Đổi mật khẩu</h3>
<iframe class ="youtube" src="https://www.youtube.com/embed/kg9Dn2md49A" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

    <h3>Bật thông báo</h3>
<iframe class ="youtube" src="https://www.youtube.com/embed/apq0lOzIgi4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


<h3>Sử dụng trên điện thoại</h3>
          <iframe class ="youtube" src="https://www.youtube.com/embed/ko5J-pIOJZM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 


            </div>

            <div id="conten8" class="tab-pane" >
              <h3>Tin nhắn</h3>
<iframe class ="youtube" src="https://www.youtube.com/embed/JXYBDStqs2k" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

              <h3>Tin nhắn trên điện thoại</h3>

<iframe class ="youtube" src="https://www.youtube.com/embed/d0dEWRHfYYs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

           

            </div>

        </div>
      </div>
    </div>
    </div>
  <!-- end model --->

  <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
    </div>
    <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
     </div>

  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
  <script>
    $('#example1').DataTable();
    $('#example2').DataTable();


    $(document).ready(function(){
    $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');

        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });
});
  </script>


@endsection
