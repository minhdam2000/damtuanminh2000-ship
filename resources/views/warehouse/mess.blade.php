@extends('layouts.index')
@section('content')

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-angular.min.js" integrity="sha512-KT0oYlhnDf0XQfjuCS/QIw4sjTHdkefv8rOJY5HHdNEZ6AmOh1DW/ZdSqpipe+2AEXym5D0khNu95Mtmw9VNKg==" crossorigin="anonymous"></script>

    <style type="text/css">

.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 80%;
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
    <div class="row row-content">
      <div class="row-title-proxy">
        <div class="tab-content"> <label  class="preview" for="file-input">
          <a href="/warehouse/data" type="button"  class="btn btn-model" > Quay lại</a>

          </label>
          <div id="content1" class="tab-pane  in active">
                    <table id="noteTable" class="table table-striped">
                  <thead>
                    <tr class="thead">
                        <th>Người đăng </th>
                        <th style="width:30%">Nội dung </th>
                        <th>Tệp đính kèm </th>
                        <th>Chi tiết </th>
                        <th>Ngày </th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($schedule_messages as $mess)
                        <tr class="color-add">  <td>
                          @if($mess->user_id > 0)
                            {{$mess->name}}
                            <img class="direct-chat-img" src="{{$mess->avatar}}" alt="message user image">
                          @else
                          <?php
                            $name  = DB::table("schedule_guest")->where("id",$mess->user_id*-1)->first()->name;
                          ?>
                          {{$name}}
                          <img class="direct-chat-img" src="/js-css/img/icon/avatar.png" alt="message user image">

                          @endif
                          </td>
                            <td>{!! $mess->body !!}</td>
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
                            <td><a style="color:white" target="_blank" download="{{$content[1]}}" href="/storage/public/attachments/{{$content[0]}}" class="preview" type="button">{{$content[1]}}</a></td>
                            @else
                            <td>Không</td>
                            @endif
                            <td>Công việc : {{$mess->title}}</td>
                            <td>{{$mess->time}}</td>
                            <td><a target="_blank"  href="/chatify/schedule/{{$mess->sid}}" class="preview" type="button"><img src="/js-css/img/icon/write.png"></a></td>
                        </tr>
                      @endforeach
                      @foreach($thread_messages as $mess)
                        <tr class="color-add">  
                            <td>{{$mess->name}}</td>
                            <td>{!! $mess->body !!}</td>
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
                            <td><a style="color:white" target="_blank" download="{{$content[1]}}" href="/storage/public/attachments/{{$content[0]}}" class="preview" type="button">{{$content[1]}}</a></td>
                            @else
                            <td>Không</td>
                            @endif
                            <td>Công việc : {{$mess->title}}</td>
                            <td>{{$mess->time}}</td>
                            <td><a  target="_blank"  href="/chatify/schedule/{{$mess->sid}}" class="preview" type="button"><img src="/js-css/img/icon/write.png"></a></td>
                        </tr>
                      @endforeach

                      @foreach($zone_mess as $mess)
                        <tr class="color-add">  
                            <td>{!! $mess->name !!}
                            <img class="direct-chat-img" src="{{$mess->avatar}}" alt="message user image"></td>
                            <td>{!! $mess->body !!}</td>
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
                            <td><a style="color:white" target="_blank" download="{{$content[1]}}" href="/storage/public/attachments/{{$content[0]}}" class="preview" type="button">{{$content[1]}}</a></td>
                            @else
                            <td>Không</td>
                            @endif
                            <td>Hợp đồng : {{$mess->zname}}</td>
                            <td>{{$mess->time}}</td>
                            <td><a target="_blank"  href="/chatify/sale/{{$mess->zid}}" class="preview" type="button"><img src="/js-css/img/icon/write.png"></a></td>
                        </tr>
                      @endforeach


                    </tbody>
                  </table>
     </div>

 <div class="modal fade modol-text" id="myModal" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thông tin chi tiết</label>
              </div>
              <div class="notification"></div>
                  <div class="modal-body">
             
                     <div id="modalContent"></div>
                  </div>
            </div>
          </div>
      </div>

  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
 <script>


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

 $(document).ready(function(){
    var find = getCookie("find")  


    $('#noteTable').DataTable(
{
     "oSearch": {"sSearch": find}
   }
    );
    $('.menu-link').click(function(event){
        //remove all pre-existing active classes
        $('.menu-pane').removeClass('active');
        $("#"+this.href.split("#")[1]).addClass('active');

        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });
  });


</script>


@endsection
