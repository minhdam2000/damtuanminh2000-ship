@extends('layouts.index')

@section('content')

   
<div class="content-camera">    

          <div class="card card-default  mb-2">
         


@if(Auth::id() == $discussions->user_id)
    <div class="proxy-add" title="New Edge"><a href="/discussions/delete/{{$discussions->id}}" class="camera-button"><i class="fa fa-plus" aria-hidden="true"></i> Xóa bài đăng </a></div>
    <div class="proxy-add" title="New Edge"><a href="/discussion/file/{{$discussions->id}}" class="camera-button"><i class="fa fa-plus" aria-hidden="true"></i> Sửa bài đăng </a></div>
@endif
<hr><br>
   <div class="card-header">
               <div class="media">
 <a style="margin-left: 2%;margin-right: 2%" class="pull-left" href="#">
                    <img width="50" src="{{$discussions->user->avatar}}" class="img-circle">
                </a>
                <div class="media-body">
                    <h5 class="media-heading">{{$discussions->title}}</h5>
                    <p>{!! ($discussions->content) !!} </p>
                    <div class="text-muted"><small> {{$discussions->user->name}}, {!! $discussions->created_at->diffForHumans() !!}</small></div></div></div>
            

            </div>


           <!--  <div class="card-body">
            <h5 class="">{{$discussions->title}}</h5>
            <hr>
                <p class="">{!! ($discussions->content) !!} </p> 

            <hr>
 -->

                <div class="form-group" id="listimg">
                 @foreach($files as $file)
<div class="col-12 col-sm-12 col-md-4">
<img style="width: 100%;height: auto" src="{{$file->url}}" id="listimg" class="preview"><br><br> </div>  

                            @endforeach
                  @if($file_count > 5)
                  <a href="discussion/file-icon/{{$discussions->id}}" type="button"  class="btn btn-model" > Chi tiết ảnh</a>
                  @endif
                
                </div>
            </div>

            
        <!--     <div class="card-footer">
              

              <p>{{$discussions->replies->count()}} Replies</p>
             
              </div> -->

          </div>



          @foreach($discussions->replies as $reply)

          <div class="card card-default  mb-2">
                <div class="card-header">
               
                posted by <span class="">{{$reply->user->name}}, Trưởng phòng kinh doanh </span>
    
               
    
                </div>
    
    
                <div class="card-body">
               
                    <p class="">{!! ($reply->content) !!}</p>

                <div class="form-group" id="listimg">
                    <?php
$files  = DB::table('replies_url')->where("blog_id",$reply->id)->get();
foreach ($files as $file) {
  ?>

<a target="_blank" href="{{$file->url}}"><img style="width: 400px;margin-left: 3%;" src="{{$file->url}}" id="listimg" class="preview"></a>
  <?php
}

                    ?>
                  </div>
                </div>
    
                
                <div class="card-footer">
                   @if($reply->is_liked_by_auth_user())

                  

                    <a href="{{route('reply.unlike',['id'=>$reply->id])}}" class="btn btn-danger btn-xs">Unliked <span class="badge"> {{$reply->likes()->count()}}</span></a>
                   @else

                <a href="{{route('reply.like',['id'=>$reply->id])}}" class="btn btn-success btn-xs">Liked <span class="badge"> {{$reply->likes()->count()}}</span></a>


                   @endif

                <a onclick="LikeDetail({{$reply->id}})" class="btn btn-success btn-xs">Chi tiết </a>
                   <a href="/reply/delete/{{$reply->id}}" class="btn btn-success btn-xs" href="" class="pull right">Xóa</a>

                  </div>
    
              </div>

          @endforeach


          <div class="card card-default">
            <div class="card-body">
                @if(Auth::check())

                <form action="{{route('discussions.reply', ['id' =>$discussions->id])}}"  enctype="multipart/form-data" method="POST">
                        {{csrf_field()}}
    
       <div class="form-group" id="preview-file"></div>
                        <div class="form-group">
                            <label>Trả lời</label>
                       <textarea  name="content" class="ckeditor form-control " cols="20" rows="5"></textarea>
                        </div>
                      
                    </div>
      <input style="display: none" type="file" name="file[]" class="file"
                    multiple>

                    <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Upload File" id="file">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Tệp...</button>
                        </div>
                    </div>

                     <div class="form-group" id="preview">
                </div>

             
                          <div class="form-group">
                            <input type="submit" name="submit" value="Trả lời" class="btn btn-primary">
                    </form>

               
                @else
                    <div class="text-center">
                    <h1>You need to login to leave a reply</h1>
                    </div>

                @endif
            </div>
          </div>

          
         


   </div>    

        
       


<div class="modal fade modol-text" id="InfoModal" role="dialog">
  <div class="modal-dialog model-right" >
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label>Danh sách người đã thích</label>
      </div>
      <div class="notification"></div>
      <ul id="likeInfo"></ul>
    </div>
  </div>
</div>

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
  function LikeDetail(id){
    $.ajax({
      type: "GET",
      url: 'discussions/like-detail/'+id,
      success: function (response) {
        var html = ""
        // console.log(response[0].role)
        for (var i = 0; i < response.length;i++){
          html = html + "<li>"+response[i].name +"("+response[i].role+")"+"</li>"
        }
        document.getElementById("likeInfo").innerHTML = html;


        $("#InfoModal").modal()
      }

    });
  }

        $(document).on("click", ".browse", function() {
          var file = $(this)
            .parent()
            .parent()
            .parent()
            .find(".file");
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


</script>
@endsection
