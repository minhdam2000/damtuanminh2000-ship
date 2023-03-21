@extends('layouts.index')
@section('content')

<style type="text/css">
    form {
    display: flex;
}

textarea {
  display: inline-block;
  width: 90%;
  resize: none;
}

#submit {
  display: inline-block;
}


</style><div class="content-camera">
<div class="session">
  @if(Session::has('notification'))
  <input hidden="" notifi="{{Session::get('notification')}}" value="1" id="notice_success">
  @endif
  @if(Session::has('warning'))
  <input hidden="" notifi="{{Session::get('warning')}}" value="1" id="notice_warning">
  @endif
</div>
<div class="row-content">
    <div class="col-md-12">

        <h1>      @if(strlen($thread->url) > 2)
                    <img width="100" src="{{$thread->url}}"  class="img-circle">
                    @else
                    @if( $thread->participantsCount(Auth::id()) > 2)
                      <img width="100" src="/js-css/img/icon/users.png"  class="img-circle">
                    @elseif( $thread->participantsCount(Auth::id()) > 1)
                      <img width="100" src="{{$thread->participantsAvatar(Auth::id())}}"  class="img-circle">

                    @endif
                    @endif{!! $thread->subject !!} 
                    @if($thread->participantsString(Auth::id()))
                                    ({!! $thread->participantsString(Auth::id()) !!}) 
                                    @endif
                                </h1>

<button class="btn btn-primary" data-toggle="modal" data-target="#add-user" type="button">Thêm thành viên</button>


<a class="btn btn-primary"  href="/messages/file/{{$thread->id}}">Xem danh sách tệp</a>
<button class="btn btn-primary"  onclick="openfileupload()">Cập nhật ảnh bìa</button>
<hr>
          <form id="uploadfile" action="messages/edit-avatar"  enctype="multipart/form-data" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}">  <label  class="preview" for="file-input">


<input type="hidden" name="id" value="{{$thread->id}}">
<input id= "inputfile" style="display:none" onchange="uploadsubmit()" value = "Tải lên" type="file" name="file" class="custom-file-input"></form> 

        @foreach($thread->messages as $message)
            @if($message->user->id == Auth()->user()->id)
            <div class="media" style="text-align: right;">

                <div class="media-body">
                    <h5 class="media-heading">{!! $message->user->name !!}</h5>
                    <p>{!! $message->body !!}</p>
                    <div class="text-muted"><small>Posted {!! $message->created_at->diffForHumans() !!}</small></div>
                </div>
                 <a style="margin-left: 2%;margin-right: 2%"  class="pull-left" href="#">
                    @if(strlen($message->user->avatar) > 2)
                    <img width="50" src="{{$message->user->avatar}}"  class="img-circle">
                    @else
                    <img width="50" src="/js-css/img/user.png"  class="img-circle">

                    @endif
                </a>
            </div>
            @else
             <div class="media">
 <a style="margin-left: 2%;margin-right: 2%"  class="pull-left" href="#">
                   
                    @if(strlen($message->user->avatar) > 2)
                    <img width="50" src="{{$message->user->avatar}}"  class="img-circle">
                    @else
                    <img width="50" src="/js-css/img/user.png"  class="img-circle">

                    @endif
                </a>
                <div class="media-body">
                    <h5 class="media-heading">{!! $message->user->name !!}</h5>
                    <p>{!! $message->body !!}</p>
                    <div class="text-muted"><small>Posted {!! $message->created_at->diffForHumans() !!}</small></div></div></div>
            @endif
               
        @endforeach

        {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
        <!-- Message Form Input -->
   

<textarea name="message" id="val" onkeyup="changeMode()" class="form-control" cols="30" rows="1" placeholder="..."></textarea>
<input type="hidden" id="type" name="type" value="">
<button class="preview" type="submit" id="submit"><img width="150" src="/js-css/img/icon/like.png"></button>
<button class="preview" data-toggle="modal" data-target="#add-file" type="button"><img width="150" src="/js-css/img/icon/bupload.png"></button>
</form>

<!-- 
        @if($users->count() > 0)
        <div class="checkbox">
            @foreach($users as $user)
                <label title="{!! $user->name !!}"><input  style="position: inherit;" type="checkbox" name="recipients[]" value="{!! $user->id !!}">{!! $user->name !!}</label>
            @endforeach
        </div>
        @endif -->

        <!-- Submit Form Input -->
      
        {!! Form::close() !!}
    </div></div></div>
  <div class="modal fade modol-text" id="add-file" role="dialog">
        <form id="action-form" action="messages/add-file" method="POST" enctype="multipart/form-data"> 
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="type_id" value="0">
          <div  class="modal-dialog model-right" style="min-width: 50%;height: auto">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm tệp </label>
              </div>
              <div class="notification"></div>
              <div class="modal-body modal-config">
<input style="display: none" id="file" type="file" name="file[]" class="file" multiple>

<input type="hidden" name="id" value="{{$thread->id}}">
                    <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Upload File" id="file">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Tệp...</button>
                        </div>
                    </div>
<br><hr><br>
 <div class="form-group" id="preview">
                </div>
                <div class="form-group" id="preview-file"></div>


                

</select>
              </div><br><hr>
              <div class="modal-footer" style="position: inherit;">

                <button class="btn btn-primary" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Tạo</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>
            </div>
          </div>
        </form>
      </div>


      <div class="modal fade modol-text" id="add-user" role="dialog">
        <form id="action-form" action="messages/add-user" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="type_id" value="0">
          <div  class="modal-dialog model-right" style="min-width: 50%;height: auto">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <h3>Thêm thành viên </h3></div>
              <div class="notification"></div>
              <div class="modal-body modal-config">
                  <p> Thành viên hiện tại
                    @if($thread->participantsString(Auth::id()))
                                    {!! $thread->participantsString(Auth::id()) !!}
                                    @endif
                                </p>
                <select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffselect" multiple>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach

</select>
<input type="hidden" name="id" value="{{$thread->id}}">
              </div><br><hr>
              <div class="modal-footer" style="position: inherit;">

                <button class="btn btn-primary" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Tạo</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>
            </div>
          </div>
        </form>
      </div>



<script type="text/javascript">
    function changeMode(){
        val = document.getElementById("val").value;
        if (val.length > 0){    
            document.getElementById("type").value = 1;
            document.getElementById("submit").innerHTML = '<img style="width: 50px" src="/js-css/img/icon/send.png">';
        }else{
            document.getElementById("type").value = 0;
            document.getElementById("submit").innerHTML = '<img style="width: 50px" src="/js-css/img/icon/like.png">';

        }
    }

</script>
<script src="/js-css/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  
  $('#staffselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});


</script>

<script type="text/javascript">
        $(document).on("click", ".browse", function() {
            console.log("oke")
          var file = $("#file")
          file.trigger("click");
        });
        $('input[type="file"]').change(function(e) {
            
          document.getElementById("preview").innerHTML =""
          document.getElementById("preview-file").innerHTML =""
            for (var i = 0; i < e.target.files.length;i++){
          var fileName = e.target.files[i].name;
          console.log(fileName)
          // $("#file").val(fileName);
        if (fileName.includes(".png") || fileName.includes(".jpg") || fileName.includes(".jepg")){
          var reader = new FileReader();
          reader.onload = function(e) {
            // get loaded data and render thumbnail.
            console.log("oke")
          document.getElementById("preview").innerHTML  = document.getElementById("preview").innerHTML + '<img style="width: 200px;margin-left: 3%;" src="'+e.target.result+'" id="preview" class="preview">';
          };
          reader.readAsDataURL(this.files[i]);
      }else{
            // get loaded data and render thumbnail.
        console.log(fileName)
          document.getElementById("preview-file").innerHTML  = document.getElementById("preview-file").innerHTML + '<p><img width="25" height = "25" src="/js-css/img/icon/write.png">' + fileName+ "<p>";
          
  }

          // read the image file as a data URL.
                }
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
</script>

<script src="/js-css/js/ckeditor/ckeditor.js"></script>

@stop