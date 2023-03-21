@extends('layouts.index')
@section('content')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<style type="text/css">
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
</style>




        <form id="create-thread" method="POST" action="create-thread" 
         enctype="multipart/form-data">

          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="schedule_id" id="schedule_id" value="{{$id}}">
          <div  class="modal-dialog model-right"  style="min-width: 100%;height: auto">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label  style="font-size: 31px;"> Thêm cuộc trò chuyện</label>
              </div>
              <div class="notification"></div>
              <div class="modal-body">

   <!-- <div class="form-group">
                    <input style="display: none" type="file" name="file[]" class="file"
                    multiple>

                    <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Tải tệp lên" id="file">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Chọn</button>
                        </div>
                    </div>
                <div class="form-group" id="preview">
                </div>
                <div class="form-group" id="preview-file"></div>
                </div> -->

              <h4>Danh sách thành viên</h4>
              <div id="staffEditDiv"></div>



              <h4>Công khai (Cho tất cả mọi người, kể cả khách)</h4>
              <div id="OpenDiv">
 <table class="table-edit table-model">
                    <tbody class="table-edit" style="font-size: 22px;">
                         <tr>
                            <td  style="width: 15%"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tiêu đề </td>
                            <td><input type="" name="name" class="input-edit create-user modol-text" id="edit_name" required=""></td>
                        </tr>
                      
                    
                          <tr>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Nội dung tin nhắn </td>
                            <td><input type="" name="des" class="input-edit create-user modol-text" id="edit_name" required=""></td>
                        </tr>
                    </tbody>
                </table>
<div class="form-group">
  <select class="form-control" name="open">
                  <option value="0">Không</option>
                  <option value="1">Có</option>
  </select>
</div>
             
              </div>

   <input style="display: none" id="file" type="file" name="file" class="file">

                    <div class="input-group my-3">
                        <input  type="text" class="form-control" disabled placeholder="Ảnh đại diện nhóm" id="file">
                        <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Chọn</button>
                        </div>
                    </div>
<br><hr><br>

 <div class="form-group" id="preview">
</div>

    
              </div>
<br><hr>
            
             
  <div class="modal-footer" style="    position: inherit;">   <button   class="button-77"  type="button"><a href="/chatify/schedule/{{$id}}">Quay lại</a> </button>
   <button   class="button-77"  type="submit"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Tạo </button>
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

function EditTask(id){
  document.getElementById("EditID").value = id

  document.getElementById("EditStart").value = (document.getElementById("start"+id).innerHTML)

   document.getElementById("EditEnd").value = (document.getElementById("end"+id).innerHTML)

      
// $('#staffselectEdit[value=17]').attr('selected','selected');


  $.ajax({
        type: "GET",
        url: "get-task-user-list/" + id,
        success: function (response) {
          // console.log(response)      
$("#staffselectEdit").val(response).change();     
}

  });


 $('#staffselectEdit').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
$("#edit-task-modal").modal()

}

    $('#staffselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});

    $('#job-url').DataTable( {
  "pageLength": 3
});
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


    
function getStaffSelectedList(id){
  $.ajax({
    type: "GET",
    url: '/system/staff-edit-list/'+id,
    success: function (response) {
      response = (JSON.parse(response))
      console.log(response)
      var data = response[0]
      var sel = response[1]
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


     var  html = '<select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffEditSelected" multiple>'
      for(var i =0; i < data.length; i++){
          html = html +'<option  value="'+data[i].id+'">'+data[i].name+'</option>'

          }
      
     hhtml = html + '</select>'
      // console.log(html)
      // document.getElementsByClassName("filter-option-inner-inner")[1].innerHTML = ""
      document.getElementById("staffEditDiv").innerHTML=html;
$('#staffEditSelected').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
    }
  });
}
  </script>
  
</script>
<script type="text/javascript">




 function getStaffSelectedList(id,sid){
  console.log('/schedule/staff-select/'+id)
  $.ajax({
    type: "GET",
    url: '/thread-staff-select/{{$id}}',
    success: function (response) {
      response = (JSON.parse(response))
      console.log(response)
      var data = response[0]
      var sel = response[1]
      // console.log(response)var html = '<td ><select  class="custom-select select-profile  browser-default" name="position_id">'


     var  html = '<select name="sid[]" class="custom-select select-profile  browser-default"  data-live-search="true" id="staffEditSelected" multiple>'
      for(var i =0; i < data.length; i++){
        
          html = html +'<option  value="'+data[i].id+'">'+data[i].name+ "-"+data[i].rname + "(" +  data[i].dname + ")" +'</option>'

          
      }
     hhtml = html + '</select>'
      // console.log(html)
      // document.getElementsByClassName("filter-option-inner-inner")[1].innerHTML = ""
      document.getElementById("staffEditDiv").innerHTML=html;
$('#staffEditSelected').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});
    }
  });
}



getStaffSelectedList(0)



</script>




@endsection
