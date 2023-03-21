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
           <div class="session">
            @if(Session::has('notification'))
              <input hidden="" notifi="{{Session::get('notification')}}" value="1" id="notice_success">
            @endif
            @if(Session::has('warning'))
              <input hidden="" notifi="{{Session::get('warning')}}" value="1" id="notice_warning">
            @endif
         </div>
            <div class="header-content">
                  <div class="header-content-left">
                  </div>
                  <div class="header-content-right" style="display: inline;">
                        
                        <h6 class="display-inline">Danh sách trùng lặp kho dữ liệu </h6>
                  </div>
            </div>
               
    <div class="row row-content">
      <div class="row-title-proxy">
         <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <h5>Danh sách trùng lặp kho dữ liệu </h5>
      </li>    
    </ul>  
    <div class="tab-content">
         

         <div id="content2" class="tab-pane  active">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="mytable" class="nvr-table">
                  <thead>
                        <tr>
                        <th>File gốc</th>
                        <th>File giống</th>
                        <th></th>
                  </tr>
                  </thead>
                   <tbody class="tbody">
                         @foreach($display_data as $data)
                          <tr>
                              <td>{{$data->name}}</td> 
                              <td>{{$data->same_name}}</td> 
                              <td>
                                 <button  class="btn btn-model"><a href="/warehouse/fuzzy/update/{{$data->id}}" > Xác nhận</a></button>     
                              </td>

                          @endforeach   
                          </tr>
                   </tbody>
                  </table>
            </div>
          </div>

        </div>
           

        </div>
      </div>
    </div>
    </div>
  </div>
      </div>
    </div>
    </div>
    <button  class="btn btn-model"><a href="/warehouse" > Quay lại</a></button>
      <!-- end model --->
      <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
</div>
<div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
</div>

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
    $('#mytable').DataTable({
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

    $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');

        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });
});


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


@endsection
