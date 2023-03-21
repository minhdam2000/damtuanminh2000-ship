
@extends('layouts.index')

@section('content')
<style type="text/css">
  @media(max-width:700px) {
    .icon-td {
       display: none;
    }
}

</style>
	<div class="content-camera">
		<div class="header-content">
			<div class="header-content-left">
			</div>
			<div class="header-content-right" style="display: inline;">
				
				<h6 class="display-inline">Danh sách quy định</h6>
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
          <h4>Quy định công ty</h4>
      </li>    
    </ul>  


        <div class="tab-content">
         
<button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-url">Thêm tệp </button>


         <div id="content2" class="tab-pane  active">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="cv" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        
                        <th style="width: 60%">Đầu mục </th>

                        <th>Ngày tải lên</th>
                        <th class="icon-id"> </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($cv as $form)
                        <tr class="color-add">
                          <td ><a  target="_blank" href="{{$form->url}}">{{$form->name}}</a>

                            <span style="display: none" id="iname{{$form->id}}">{{$form->name}}</span>
                          
                          </td>
                          <td>
<span style="display: none">{{$form->created_at}}></span>
                                                        <?php
$old_date_timestamp = strtotime($form->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?></td>
                          @if (strlen($form->url) > 0)
                          <td>
                               <button style="color: white"  type="button" onclick="editInputDetail('{{$form->id}}')" class="preview"><<img src="/js-css/img/icon/notepad.png"></button>
                          <!-- <a  href="legal/file-delete/<?=$form->id?>" type="button"  class="preview" > <img src="/js-css/img/icon/recycle_bin.png"> </a> -->
                          <a class="sicon" onclick="confirm_remove(this,{{$form->id}})">
                             <span class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span>
                           </a>

</td>
                            @else <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/wait.png"></td>
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
    </div>
	<!-- end model --->
 <div class="modal fade modol-text" id="new-url" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm tệp</label>
              </div>
              <div class="notification"></div>
               <form id="uploadfile" action="edit-regulation-file"  enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">  
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                             
                           <tr>
                                <td class="cam-properties">Tên1: </td>
                                <td>
                                <input class="input-edit modol-text"  name="title" value="">
                           
                          </tr>


                           <tr>
                <td class="cam-properties">Minh chứng </td>
                  <td><label  class="preview" for="file-input"><img onclick="openfileupload()"  src="/js-css/img/icon/upload.png"></label><input  id= "inputfile" style="display:none" type="file" name="file[]" class="form-control"
                    multiple>
                </td>
              </tr>
<tr>
  <td></td>
  <td>
                <span class="form-group" id="preview-file"></span>
      </td>     </tr>
                          <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm1  &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div></form> 
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
              <form action="legal/edit-task-file-name" method="POST">
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

                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>

<button  class="btn btn-model"><a href="/" > Quay lại</a></button>

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

function editInputDetail(id){
  console.log(id)
  document.getElementById("editId").value = id
  document.getElementById("editName").value = document.getElementById("iname"+id).innerHTML
$("#new-edge").modal()

}

function editOutputDetail(id){
  document.getElementById("editId").value = id
  document.getElementById("editName").value = document.getElementById("oname"+id).innerHTML

$("#new-edge").modal()

}

  </script>


 <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>

  <script type="text/javascript">
     $('#cv').DataTable({
      "order": [[ 1, "desc" ]]
    })
       $(document).ready(function(){


      if($("#notice_warning").val() == 1){
        // alert("123")
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }
      });
    /*$('#cv').DataTable({
      "order": [[ 1, "desc" ]]
    })
       $(document).ready(function(){
    $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');

        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });
});*/


 $('input[type="file"]').change(function(e) {
            // alert("oke")
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
          html  = html + '<img style="width: 200px;margin-left: 3%;" src="'+e.target.result+'" id="preview" class="preview">';
             console.log(myElement.html())
           myElement.html( myElement.html()+html);
          console.log(myElement.html())

          };
       
          reader.readAsDataURL(this.files[i]);
      }else{
        // alert(fileName)
            // get loaded data and render thumbnail.
        console.log(fileName)
          html  = html + '<p><img width="25" height = "25" src="/js-css/img/file_type/pdf.png"> ' + fileName+ " <span style='color:red' onclick='closeFile()'>x</span><p>"; 
            $("#preview-file").html( $("#preview-file").html()+html);
          
  }



          // read the image file as a data URL.
                }
              
        });
  function closeFile(){
     $("#preview-file").html("");
  }
 
 

  </script>
<script type="text/javascript">
  
        function confirm_remove(ele,id) {
              // ele.preventDefault()
              swal({ 
                  title: "",   
                  text: " Bạn có chắc muốn xóa tệp tin này ",   
                  type: "info",   
                  showCancelButton: true,     
                  confirmButtonText: "Có ",   
                  cancelButtonText: "Không",   
                  closeOnConfirm: false,   
                  closeOnCancel: false,
                  reverseButtons: true }, 
                  function(isConfirm){   
                  if (isConfirm) 
                  {   
                    loading_nomal()
                    location.href="legal/file-delete/"+id
                    swal.close(); 
                  } 
                  else {     
                    swal.close();  
                  } 
                });
        }
</script>

@endsection
