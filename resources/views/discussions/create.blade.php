@extends('layouts.index')

@section('content')



<div class="content-camera">
            <div class="card">
                <div class="card-header">Tạo khiền nại mới</div>

                <div class="card-body">
                <form  enctype="multipart/form-data"  action ="{{route('discussion.store')}}" method="post">
                        {{csrf_field()}}

                        <div class="form-group">
                           <label for="title">Tiêu đề</label>
                            <input type="text" value="{{old('title')}}" name="title" class="form-control" id="title">
                        </div>


                        <div class="form-group">
                            <label for="content">Nội dung</label>
                            <textarea name="content" cols="30" rows="10" class="ckeditor form-control ">{{old('content')}}</textarea>
                        </div>

                       
                        <div class="form-group">
                    <input style="display: none" type="file" name="file[]" class="file"
                    multiple>

                    <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Chọn tệp" id="file">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Tải lên</button>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="preview">
                </div>
                <div class="form-group" id="preview-file"></div>
 <div class="form-group">
                            <input type="submit" name="submit" value="save discussion" class="btn btn-primary">
                        </div>


                    </form>
                </div>
    </div>
</div>


<!-- <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script> -->


<script src="/js-css/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
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
