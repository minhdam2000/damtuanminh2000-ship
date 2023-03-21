@extends('layouts.index')
@section('content')
<style type="text/css">


  @media(max-width:700px) {
    .icon-td {
       display: none;
    }
    .myname{
      min-width: 60vw!important;
    }
    .mydate{
      min-width: 40vw!important;
    }
}

</style>
	<div class="content-camera">
		<div class="header-content">
			<div class="header-content-left">
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
          data-toggle="tab" role="tab" href="#content1">Văn bản pháp lý cho {{$project->name}}</a>
      </li>    
    </ul>  
 <ul class="nav nav-tabs" id="tabs" role="tablist">
     
     <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a active" 
          data-toggle="tab" role="tab" href="#content2"> Công văn đến </a>
      </li>
     <li class="nav-item margin_center">
          <a id="tab4" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content3"> Công văn đi</a>
      </li>
    
    
    </ul>  

        <div class="tab-content">

         <label  class="preview" for="file-input">
         
          <button  type="button"  class="btn btn-model"><a href="/legal/list" > Quay lại</a></button>
<button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-url">Thêm tệp mới</button>



          </label>
<br><br>

         <div id="content2" class="tab-pane  active">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="cv1" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        
                        <th class="myname">Đầu mục </th>
                        <th class="mydate">Ngày tài lên</th>
                        <th class="icon-td"> </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($cv1 as $form)
                        <tr class="color-add">
                          <td ><a  target="_blank" download="<?=$form->name.".pdf"?>" href="{{$form->url}}">{{$form->name}}</a>


                            <span style="display: none" id="iname{{$form->id}}">{{$form->name}}</span>
                          </td>
                          <td>
<span style="display: none">{{$form->created_at}}></span>

                                                        <?php
$old_date_timestamp = strtotime($form->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?></td>
                          @if (strlen($form->url) > 0)
                          <td class = "center-td icon-td"><a  target="_blank" download="<?=$form->name.".pdf"?>" href="{{$form->url}}" class="preview" type="button"><img src="/js-css/img/icon/dowload.png"></a>

                               <button style="color: white"  type="button" onclick="editInputDetail('{{$form->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem;"></i></button>
                          <a href="legal/file-delete/<?=$form->id?>" type="button"  class="preview" > <img src="/js-css/img/icon/delete.png"> </a>

</td>
                            @else <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/wait.png"></td>
                      @endif
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
          </div>

            <div id="content3" class="tab-pane  fade">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="cv2" class="nvr-table">
                  <thead>
                    <tr class="thead">
                     
                        <th class="myname">Đầu mục </th>
                        <th class="mydate">Ngày tài lên</th>
                        <th class="icon-td"> </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($cv2 as $form)
                        <tr class="color-add">
                          <td ><a  target="_blank" download="<?=$form->name.".pdf"?>" href="{{$form->url}}">{{$form->name}}</a>

                            <span style="display: none" id="oname{{$form->id}}">{{$form->name}}</span>

                          </td>
                               <td>
<span style="display: none">{{$form->created_at}}></span>
                                                        <?php
$old_date_timestamp = strtotime($form->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp)
 ?></td>
                          @if (strlen($form->url) > 0)
                          <td class = "icon-td center-td"><a  target="_blank" download="<?=$form->name.".pdf"?>" href="{{$form->url}}" class="preview" type="button"><img src="/js-css/img/icon/dowload.png"></a>

                             <button style="color: white"  type="button" onclick="editOutputDetail('{{$form->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem;"></i></button>
                          <a href="legal/file-delete/<?=$form->id?>" type="button"  class="preview" > <img src="/js-css/img/icon/delete.png"> </a>

                          </td>
                            @else <td class = "center-td icon-id"><button class="preview" type="button"><img src="/js-css/img/icon/wait.png"></td>
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
 <div class="modal fade modol-text" id="new-url1" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm tệp</label>
              </div>
              <div class="notification"></div>
               <form id="uploadfile" action="legal/edit-task-file"  enctype="multipart/form-data" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">  
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                             
                           <tr>
                                <td class="cam-properties">Tên: </td>
                                <td>
                                <input class="input-edit modol-text"  name="title" value="">
                           
                          </tr>
                              <tr>
                                <td class="cam-properties">Loại công văn</td>
                                 <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "">
                                  <option value="1"> Công văn đến </option>
                                  <option value="2"> Công văn đi </option>
                           
                                </select></td>

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
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoat </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div><input value = "<?=$index?>" type="hidden" name="id" class="form-control"></form> 
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
    $('#cv1').DataTable({
      "order": [[ 1, "desc" ]]
    })
    $('#cv2').DataTable({
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
});

  </script>

@endsection
