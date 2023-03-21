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
@if ($zone_id > 0)
          <a href="/sale/view/{{$index}}" type="button"  class="btn btn-model" > Quay lại</a>
            <button type="button"  class="btn btn-model" onclick="openfileupload()"> Thêm tệp mới </button>

          <a href="/sale/file/{{$index}}/{{$id}}" type="button"  class="btn btn-model" > Chế độ chỉnh sửa</a>
          <a href="/sale/file-icon/{{$index}}/{{$id}}" type="button"  class="btn btn-model" > Chế độ lưới </a>

@endif

          </label><input id= "inputfile" style="display:none" onchange="uploadsubmit()" value = "Tải lên" type="file" name="file[]" class="custom-file-input"" multiple> <input value = "<?=$id?>" type="hidden" name="id" class="form-control"><input value = "{{$index}}" type="hidden" name="index" class="form-control"></form> 
<br><br>
          <div id="content1" class="tab-pane  in active">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="example" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th>Đầu mục </th>
                        <th> </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($file as $file)
                        <tr class="color-add">
                          <td>{{$task->name}} {{$file->image_id}}</td>
                          @if (strlen($file->url) > 0)
                          <td class = "center-td">
                            <button onclick="loadFile('{{$task->name."".$file->image_id}}<','{{$file->url}}')" class="preview" type="button"><img src="/js-css/img/icon/open.png"></button>

                               <a href="<?=$file->url?>"  target="_blank" type="button"  class="preview" > <img src="/js-css/img/icon/plus.png"> </a>

                          <a href="sale/file-delete/{{$index}}/<?=$file->id?>" type="button"  class="preview" > <img src="/js-css/img/icon/delete.png"> </a></td>

                              @else <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/wait.png">
                         

                          </td>
                      @endif
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
<iframe class="img-overlay" src=""></iframe>

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
    window.open(
  $src,
  '_blank' // <- This is what makes it open in a new window.
);
return 0;


    const userAgent = navigator.userAgent.toLowerCase();
const isTablet = /(ipad|tablet|(android(?!.*mobile))|(windows(?!.*phone)(.*touch))|kindle|playbook|silk|(puffin(?!.*(IP|AP|WP))))/.test(userAgent);

       if (isTablet){
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

  </script>

@endsection