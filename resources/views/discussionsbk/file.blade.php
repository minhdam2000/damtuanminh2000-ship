@extends('layouts.index')
@section('content')
	<div class="content-camera">
		<div class="header-content">
			<div class="header-content-left">
				<h6>Quản lý sự kiện</h6>
			</div>
			<div class="header-content-right" style="display: inline;">
				
				<h6 class="display-inline">Quản lý minh chứng</h6>
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
     <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content1">{{$discussions->title}}</a>
      </li>    
    </ul>  
    <hr>

                <p class="">{!! ($discussions->content) !!} </p> 

        <div class="tab-content">
      <label  class="preview" for="file-input">


             <form id="uploadfile" action="/discussions/edit-file"  enctype="multipart/form-data" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}">  <label  class="preview" for="file-input">


          <a href="/discussion/{{$id}}" type="button"  class="btn btn-model" > Quay lại</a>
          <button type="button"  class="btn btn-model" onclick="openfileupload()"> Thêm tệp mới </button>
<button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-url">Sửa thông tin</button>



          </label><input id= "inputfile" style="display:none" onchange="uploadsubmit()" value = "Tải lên" type="file" name="file[]" class="custom-file-input"" multiple> <input value = "<?=$id?>" type="hidden" name="id" class="form-control"><input value = "{{$id}}" type="hidden" name="id" class="form-control"></form> 


          </label>
<br><br>
          <div id="content1" class="tab-pane  in active">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                 <table id="example" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th style="text-align: center;width: 90%"> </th>
                        <th style="text-align: center;"> </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">

                      @foreach($files as $file)
                        <tr class="color-add">
                         
                          <td class = "center-td">

                            <br>
                                                        <?php
                              if(strpos($file->url,".png") > 0 
                              || strpos( $file->url,".jpg") > 0 
                              || strpos($file->url,".jpeg") > 0 
                            ){
                            ?>

                            <img src="<?=$file->url?>" style="width: 100%;height: auto">
                            <?php
          }else{
?>
<a  target="_blank" href="{{$file->url}}" class="preview" type="button"><img src="/js-css/img/icon/dowload.png"></a>
  
<?php
    }
?>
                              </td>
                              <td>

<a  href="/discussions/delete-file/{{$file->id}}" class="preview" type="button"><img src="/js-css/img/icon/delete.png"></a>
                              </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
          </div>

           

        </div>
      </div>
    </div>
    </div>
	<!-- end model --->
  
   <div class="modal fade modol-text" id="new-edge" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Sửa tệp</label>
              </div>
              <div class="notification"></div>
              <form action="process/edit-task-file-name" method="POST">
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
  <div class="modal fade modol-text" id="new-url" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label> Sửa thông tin</label>
              </div>
              <div class="notification"></div>
               <form id="uploadfile" action="/discussions/edit-submit"  enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">  
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                             
                           <tr>
                                <td class="cam-properties">Tên: </td>
                                <td>
                                <input class="input-edit modol-text"  name="title" value="{{$discussions->title}}">
                           </td>
                          </tr>
                          <tr>
                                <td class="cam-properties">Nội dung: </td>
                                <td> <textarea name="content" cols="30" rows="10" class="ckeditor form-control ">{{ ($discussions->content) }}</textarea></td>
                           
                          </tr>
                           <tr>
               
              </tr>

                          <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoat </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div><input value = "<?=$id?>" type="hidden" name="id" class="form-control"><input value = "{{$id}}" type="hidden" name="id" class="form-control"></form> 
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
    $('#example').DataTable({
        "paging":   false,
        "info":     false,
        "searching": false
      });
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
  document.getElementById("editId").value = id
  document.getElementById("editName").value = document.getElementById("name"+id).innerHTML
$("#new-edge").modal()

}
  </script>

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
@endsection
