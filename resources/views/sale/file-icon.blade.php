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
          data-toggle="tab" role="tab" href="#content1">Mã BDS: <?=$zone->name?> - Thủ tục: <?=$task->name ?></a>
      </li>    
    </ul>  
    <hr>

        <div class="tab-content">
          <form id="uploadfile" action="sale/edit-task-file"  enctype="multipart/form-data" method="POST"><input type="hidden" name="_token" value="{{csrf_token()}}">  <label  class="preview" for="file-input">


          <a href="/sale/view/{{$index}}" type="button"  class="btn btn-model" > Quay lại</a>
            <button type="button"  class="btn btn-model" onclick="openfileupload()"> Thêm tệp mới </button>

          <a href="/sale/file/{{$index}}/{{$id}}" type="button"  class="btn btn-model" > Chế độ chỉnh sửa</a>
          <a href="/sale/file-icon/{{$index}}/{{$id}}" type="button"  class="btn btn-model" > Chế độ lưới </a>



          </label><input id= "inputfile" style="display:none" onchange="uploadsubmit()" value = "Tải lên" type="file" name="file[]" class="custom-file-input"" multiple> <input value = "<?=$id?>" type="hidden" name="id" class="form-control"><input value = "{{$index}}" type="hidden" name="index" class="form-control"></form> 
<br><br>
          <div id="content1" class="tab-pane  in active">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="example" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th style="width: 20%">
                        Đầu mục

                         </th>
                        <th style="text-align: center;">Xem trước </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($file as $file)
                        <tr class="color-add">
                          <td style="width: 20%">


                            {{$task->name}} {{$file->image_id}}<br>

                          <a href="<?=$file->url?>"  target="_blank" type="button"  class="btn btn-model" > Xem đẩy đủ </a>


                          </td>
                         
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

Không hỗ trợ
  
<?php
    }
?>
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

  </script>

@endsection
