@extends('layouts.index')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-angular.min.js" integrity="sha512-KT0oYlhnDf0XQfjuCS/QIw4sjTHdkefv8rOJY5HHdNEZ6AmOh1DW/ZdSqpipe+2AEXym5D0khNu95Mtmw9VNKg==" crossorigin="anonymous"></script>

    <style type="text/css">
        .label-info{
            background-color: red!important;

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


/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}
.autocomplete-items {
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9;
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
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
          
      </li>    
    </ul>  
    <hr>

<button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-url">Thêm tệp mới</button>
@if($task_total->acceptance_status ==0 )
          <button style="color: white" type="button" class="btn btn-model Disable"><a href="building/task-acceptance/{{$id}}">Xác nhận nghiệm thu</a></button>
@else

          <button style="color: white;margin-top: 5%;" type="button" class="btn btn-primary Disable">Đã nghiệm thu</button>
@endif

          </label>
<br><br>
          <div id="content1" class="tab-pane  in active">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="example" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th>Đầu mục </th>
                        <th>Định danh</th>
                        <th> </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($files as $file)
                        <tr class="color-add">   
                          @if (strlen($file->name) > 0)
                          <td>
                               <a href="<?=$file->url?>" span id="name{{$file->id}}"> {{$file->name}}</a></td>
                          @else
                          <td><span id="name{{$file->id}}">{{$project->name}}</span> {{$file->image_id}}</td>

                          @endif

                          <td><span style="display: none"  id="tag{{$file->id}}"> {{$file->tags}}</span>

                            <span class="mytags"> {{$file->tags}}</span>

                        </td>


                          @if (strlen($file->url) > 0)
                          <td class = "center-td">
                            <button onclick="Edit({{$file->id}})" class="preview" type="button"><img src="/js-css/img/icon/write.png"></button>

                    
                               <a href="<?=$file->url?>"  target="_blank" type="button"  class="preview" > <img src="/js-css/img/icon/open.png"> </a>
 

                              @else <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/wait.png">
                         

                          </td>
                      @endif
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
            <label  class="preview" for="file-input">
  @if($display_type > 0)
          @if($preid > 0)
          <button type="button"  class="btn btn-model">
          <a href="/building/task/0/{{$preid}}"  > Quay lại</a></button>

          @else
          <button type="button"  class="btn btn-model">
          <a href="/building/data/{{$task_total->project_id}}" 
           > Quay lại</a></button>
          @endif
          @else
          
          <button  class="btn btn-model"><a href="/icon/build/" > Quay lại</a></button>
@endif


          </label>
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
               <form id="uploadfile" action="building/edit-task-file"  enctype="multipart/form-data" method="POST">
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
                                <td class="cam-properties">Định danh: </td>
                                <td class="tagTD">
                                
                            <input id="newTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags"></td>
                           
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
                  </div><input value = "<?=$id?>" type="hidden" name="id" class="form-control"></form> 
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
              <form action="building/edit-task-file-name" method="POST">
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
                                <td class="cam-properties">Định danh: </td>
                                
                                <td class="editTD">
                                 <input id="editTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags"></td>
                            </tr>
                          <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>
                                  <btuuon class="btn btn-model"  type="button"><a id="deleteBtn"> &nbsp;&nbsp; Xóa &nbsp;&nbsp; </a></btuuon>
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
  document.getElementById("deleteBtn").href = "building/task-file-delete/"+id
  // document.getElementById("editTag").value = document.getElementById("tag"+id).innerHTML



var rawhtml = $("#tag"+id).html();
     if (rawhtml.length > 1){
     rawhtml = rawhtml.split(',');
     for (var i = 0; i < rawhtml.length;i++){
    $('#editTag').tagsinput('add', rawhtml[i]);
    }
    }
$("#new-edge").modal()

}
</script>
<script type="text/javascript">
  function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
              b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}

</script>

  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
  <script>

    $('#example').DataTable({
    "drawCallback": function( settings ) {   $('.mytags').each(function(){

     var rawhtml = $(this).html();
     if (rawhtml.length > 1 && rawhtml.includes("bootstrap-tagsinput") == false){

     rawhtml = rawhtml.split(',');

     html = '<div class="bootstrap-tagsinput">'
     for (var i = 0; i < rawhtml.length;i++){
      html = html + '<span class="tag label label-info" style="display: inline-block;">'+rawhtml[i]+'</span>'
    }
    html = html + "</div>"
    console.log(html)
      $(this).html(html)
    }
 });
    }
});

$(document).ready(function(){
//         $('.mytags').each(function(){

//      var rawhtml = $(this).html();
//      if (rawhtml.length > 1){
//      rawhtml = rawhtml.split(',');

//      html = '<div class="bootstrap-tagsinput">'
//      for (var i = 0; i < rawhtml.length;i++){
//       html = html + '<span class="tag label label-info" style="display: inline-block;">'+rawhtml[i]+'</span>'
//     }
//     html = html + "</div>"
//     console.log(html)
//       $(this).html(html)
//     }
//  });



var tags = JSON.parse('{!! $tags !!}');
console.log(tags)
// console.log(document.querySelector("td.tagTD div input"))
autocomplete(document.querySelector("td.tagTD div input"), tags);
autocomplete(document.querySelector("td.editTD div input"), tags);


$('.bootstrap-tagsinput input').keydown(function( event ) {
    if ( event.which == 13 ) {
        $(this).blur();
        $(this).focus();
        return false;
    }
})

});
  </script>


@endsection
