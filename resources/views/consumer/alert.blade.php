@extends('layouts.index')
@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

 <link rel="stylesheet" href="/js/taginputs/bootstrap-tagsinput.css"  />

 <script src="/js/taginputs/bootstrap.min.js" ></script>
    <script src="/js/taginputs/bootstrap-tagsinput.js"></script>
    <script src="/js/taginputs/bootstrap-tagsinput-angular.min.js"></script>


<style type="text/css">

    .bootstrap-tagsinput{
          width: 100%;
        }

    .dropdown-menu{
        transform: none!important;
      }

  .job-content{
    font-size: 25px;
  }
.bootstrap-select{
  z-index: 100
}
  .progress{
    min-height: 30px;
    background-color: transparent;
}
.progress-bar{
    font-size: 15px;
  }


  .direct-chat-messages{
    height: 550px;
  }
  .mylink{
    color: red!important;

  }
  .mylink:hover{
    color: white;
  }
  .img-chat-view{
    width: 300px;
    height:auto;
  }
.card-title{
  font-size:30px;
  font-weight: 600;
}
.direct-chat-msg{
    width: 50%!important;
  }
.right{
    margin-left: 50%;
  }
  @media(max-width:600px) {
    .direct-chat-msg{
    width: 100%!important;
  }
  .right{
    margin-left: 0%;
  }
}

.MImgList{
  max-height: 300px;
  overflow: auto;
}
  
.MFileList{
  max-height: 200px;
  overflow: auto;
}


.direct-chat-messages{
  height: 900px;
}

#ShareLink{
      width: 100%;
    font-size: 0.85em;
    background-color: wheat;
    height: 50px;
    font-size: 25px;
    color: blue;
    display: none;
}

 .label {
          position: inherit;

            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,
            border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    pointer-events: all;
        }
          .label-info{
            background-color: red!important;

        }

</style>


<div class="tab-content" style="height:2000px">


        <form id="edit-schedule" method="POST" action="consumer-alert/create" 
         enctype="multipart/form-data">

          <input type="hidden" name="_token" value="{{csrf_token()}}">
       
          <div  class="modal-dialog model-right"  style="min-width: 100%;height: auto">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label  style="font-size: 31px;"> Tạo thông báo mới</label>
              </div>
              <div class="notification"></div>
              <div class="modal-body">
                <table class="table-edit table-model">
                    <tbody class="table-edit" style="font-size: 22px;">
                         <tr>
                            <td  style="width: 15%"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tên </td>
                            <td><input type="" value="" name="title" class="input-edit create-user modol-text" id="edit_name" required="" autocomplete="off"></td>
                        </tr>
                      
                          <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Nội dung</td>
                            <td><textarea rows="100"   name="content" class="ckeditor form-control input-edit modol-text"  required="" id="EditDes"></textarea></td>
                        </tr>
                        <tr>
                            <td> <h4>Tag</h4></td>
                            <td>
             <input id="newTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags"></td>
                        </tr>
                    </tbody>
                </table>
              </div>
<br><hr>
            
             
  <div class="modal-footer" style="    position: inherit;">
   <button   class="button-77"  type="button"><a href="/icon/sale">Quay lại</a> </button>
   <button   class="button-77"  type="submit"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Cập nhật </button>
              </div>
            </div>
          </div>
        </form>
    </div>
      </div>


    

	<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
    </div>
    <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
     </div>

<script src="/js-css/js/bootstrap-select.min.js"></script>
<script src="/js-css/js/ckeditor/ckeditor.js"></script>
  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
  <script>

    $('#job-cmt').DataTable();


    $(document).ready(function(){

    $('.mess-link').click(function(event){
        //remove all pre-existing active classes
        $('.mess-pane').removeClass('active');

        //add the active class to the link we clicked
        $("#"+this.href.split("#")[1]).addClass('active');

        // event.preventDefault();
    });

     $('.job-link').click(function(event){
        //remove all pre-existing active classes
        $('.job-content').removeClass('active');

        //add the active class to the link we clicked
        $("#"+this.href.split("#")[1]).addClass('active');

        // event.preventDefault();
    });

});

     function openfileupload(id){
      if (id == 11){

            document.getElementById("filename2").value = document.getElementById("mymess2").value 
      }else{

            document.getElementById("subfilename").value = document.getElementById("submess").value 
      }
            document.getElementById("inputfile"+id).click();
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
            // get loaded data and render thumbnail.
        console.log(fileName)
          html  = html + '<p><img width="25" height = "25" src="/js-css/img/icon/write.png">' + fileName+ "<p>"; 
            $(this)
            .parent()
            .find("#preview-file").html( $(this).parent().find("#preview-file").html()+html);
          
  }
 


          // read the image file as a data URL.
                }
              
        });


  </script>
  
<script>




      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }

</script>
<script type="text/javascript">



</script>




@endsection
