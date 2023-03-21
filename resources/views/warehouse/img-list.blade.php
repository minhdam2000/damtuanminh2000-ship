@extends('layouts.index')
@section('content')

<?php

$find_cookie = "";

if(isset($_COOKIE['find'])){
  $find_cookie = $_COOKIE['find'];
}


?>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-angular.min.js" integrity="sha512-KT0oYlhnDf0XQfjuCS/QIw4sjTHdkefv8rOJY5HHdNEZ6AmOh1DW/ZdSqpipe+2AEXym5D0khNu95Mtmw9VNKg==" crossorigin="anonymous"></script>

    <style type="text/css">
      .bootstrap-tagsinput {
  width: 100% !important;
}

      h4{
            font-family: 'Didact Gothic', sans-serif !important;
    font-weight: 900;
      }
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

    <style type="text/css">
  @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif
}

.badge {
    font-size: 35px;
  position: absolute;
  top: -10px;
  right: -10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}

.results {
    font-weight: 600
}

.select {
    border: none;
    outline: none;
    padding: 0px 4px;
    cursor: pointer;
    background: inherit
}

.card {
    font-size: small;
    border: none;
    cursor: pointer
}

.card:hover {
    transform: scale(1.08);
    transition: all 0.4s ease-in-out
}

.card-img-top {
    /*background-color: #fdf8f4;*/
    padding-top: 10px
}

.card-body {
    padding: 0.5rem;
    padding-top: 0.7rem;
    padding-right: 0.2rem
}

.fa-heart {
    font-size: 1.2rem
}

.h7 {
    margin: 0
}

.btn {
    font-size: 16px;
    margin-right: 15px;
}

.btn:hover {
    color: #fdaa4b
}

.div.text-muted {
    font-size: 0.9rem
}

@media(max-width:372px) {
    .results {
        font-size: 07rem
    }
    .
    .badge {
        font-size: 15px;
    }
}

@media(max-width:330px) {
    .results {
        font-size: 0.6rem
    }
}

@media(min-height: 700px) {
    body {
        height: 100vh
    }
}
.card-body{

    text-align: center;
}
@media(max-width:768px) {
    body {
        height: 100%
    }
     .badge {
        font-size: 15px;
    }
    
}
.pagination { 
    display: inline-flex;
}

</style>

    <!-- <link href="js/search/css/sreach.css" rel="stylesheet" /> -->


    <link href="js/search/css/main.css" rel="stylesheet" />

    <style type="text/css">


    </style>
    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
            </div>
            <div class="header-content-right" style="display: inline;">
                
                <h6 class="display-inline"></h6>
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
   <!--    <li class="nav-item margin_center">
          <h4 id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content1">Kho dữ liệu </h4>
      </li>  -->   
    </ul>  
    <hr>

        <div class="tab-content">
 <div class="s013" style="min-height: auto;">
            <form id="sForm"  onSubmit="function(e){ e.preventDefault(); }">
        <div class="inner-form">
          <div class="left">
            <div class="input-wrap first" onclick="inputOpen()">
              <div class="input-field first">
                <label>Tìm kiếm kho dữ liệu </label>
                <input class="form-control"  type="hidden" name="_token" value="{{csrf_token()}}">  
                 

                 @if(($find_cookie !== "lopital_null"))

                <input onkeyup="search()" id="myinput" type="text" name="tags"  value="{{$find_cookie}}" autocomplete="off" />
                @else

                <input onkeyup="search()"  id="myinput" type="text"  name="tags" placeholder="ví dụ: Xuân An, Hòa Bình, Xem tags"  autocomplete="off" />

                @endif


              </div>
            </div>
            <div class="input-wrap second">
              <div class="input-field second">
               <div> <label>Loại</label></div>
          <div class="input-select">
                  <select  onchange="changeType()" name="type" data-trigger="" name="choices-single-defaul" id="sType">
                    <option value="1">Hình ảnh </option>
                    <option value="2" >Văn bản</option>
                  </select>
                </div>
                </div>
              </div>
            </div>
          </div>
      <button type="button"  class="btn btn-model" data-toggle="modal" data-target="#new-url">Thêm tệp mới</button>


    <!--   <a  class="btn btn-model" target="_blank" href="/tag-group">Quản lý từ đồng nghĩa</a> -->

      <!-- <a  class="btn btn-model" id="allTagBtn" onclick="showAllTag()">Xem Tags</a> -->

     <!--  <button type="button" class="btn btn-model" onclick="location.reload()" > <i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button> -->
          <!-- <button class="btn-search" type="submit">TÌM KIẾM</button> -->
        </div>
      </form>

          <div id="content1" class="tab-pane  in active">
          <div class="active-view" id="menu1">


           
            <div class="container">
            
         <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700" rel="stylesheet" />
    <link href="js/search/css/main.css" rel="stylesheet" />

        
    <script src="js/search/js/extention/choices.js"></script>
    <script>
      const choices = new Choices('[data-trigger]',
      {
        searchEnabled: false,
        itemSelectText: '',
      });

    </script>
    <hr>
    <div class="row">


                      @foreach($file as $file)
<?php
$check = 0;
 if(strpos($file->url,".png") > 0 
            || strpos($file->url,".jpg") > 0 
            || strpos($file->url,".jpeg") > 0 
          ){
           $check =1;   

              }
if($check == 0){
    continue;
}
?>
       
 <div class="col-lg-2 col-md-3 col-sm-4 col-6  my-6">
          <a onclick="Edit({{$file->id}})">
          <!-- <a href="<?=$file->url?>"  target="_blank" > -->
              <?php
                      if($file->type < -1){

            $myurl = explode(',',$file->url);
            $url = "/storage/attachments/".$myurl[0];

}else{


      if (strlen($file->url_resize) > 1){
        $url = $file->url_resize;
      }
      else{
        $url = $file->url;
    }
        
}

            ?>


            <div class="card"> <img class="card-img-top" src="{{$url}}" width="300" height="170">
                <div class="card-body">
                           <span style="display: none" id="tag{{$file->id}}">{{$file->tags}}</span> 
                           <span style="display: none" id="type{{$file->id}}">{{$file->type}}</span>
                           <span style="display: none" id="resize{{$file->id}}">{{$url}}</span>
                           <span style="display: none" id="url{{$file->id}}">{{$url}}</span>
                </div>
            </div>
          </a>
        </div>
                      @endforeach
            </div>
<div class="text-center">
                @if(isset($_GET['page']))
               <ul class="pagination">
            
                            <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                    <span class="page-link" aria-hidden="true"><</span>
                </li>                 
                @if($_GET['page'] > 1)
  <li class="page-item" aria-current="page"><span class="page-link">
<a  href="/warehouse/image-list?page=<?=$_GET['page'] - 1?>" >
                  <?=$_GET['page'] - 1?>
</a>
                </span></li>
                @endif
                   <li class="page-item active" aria-current="page"><span class="page-link"><?=$_GET['page']?></span></li>   
                 <li class="page-item" aria-current="page"><span class="page-link">
<a  href="/warehouse/image-list?page=<?=$_GET['page'] + 1?>" >
                  <?=$_GET['page'] + 1?>
</a>
                </span></li>
            <li class="page-item">
                    <a class="page-link" href="/warehouse/image-list?page=<?=$_GET['page'] + 1?>" rel="next" aria-label="Next »">></a>
                </li>
                    </ul>
@else

<ul class="pagination">  <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>   
                 <li class="page-item" aria-current="page"><span class="page-link">
<a  href="/warehouse/image-list?page=2" >
                2
</a>
                </span></li>
            <li class="page-item">
                    <a class="page-link" href="/warehouse/image-list?page=2" rel="next" aria-label="Next »">›</a>
                </li>
                    </ul>
@endif
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
               <form id="uploadfile" action="warehouse/edit-task-file"  enctype="multipart/form-data" method="POST">
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
                                <td class="cam-properties">Tag: </td>
                                <td class="tagTD">
                                
                            <input id="newTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">

                           
                          </tr>
                          

                           <tr>
                <td class="cam-properties">Minh chứng </td>
                  <td><label  class="preview" for="file-input"><img onclick="openfileupload()"  src="/js-css/img/icon/upload.png"></label><input accept="image/*"  id= "inputfile" style="display:none" type="file" name="file[]" class="form-control"
                    multiple>
                </td>
              </tr>

                          <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div><input value = "0" type="hidden" name="id" class="form-control"><input value = "0" type="hidden" name="type" class="form-control"></form> 
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
              <form action="warehouse/edit-tag" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">

                                <input type="hidden" name="id" id="editId" value=""><input type="hidden" name="type" id="editType" value="">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                             
                           <tr>
                                <td class="cam-properties">Hình ảnh: </td>
                                <td>
                                  <img id="editUrl" src="" width="300" height="auto">
                                </td>
                            </tr>
                          <tr>
                                <td class="cam-properties">Tag: </td>
                                <td class="editTD">
                                 <input id="editTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">
                            </tr>
                             
                          
                          <tr>

                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>
                                     <a href="" id="ShowLinkInfo"  target="_blank"  type="button" class="btn btn-model" >Ảnh gốc </a>
                                      <a id="DeleteLinkInfo" type="button" class="btn btn-model">Xóa </a>

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
  document.getElementById("editType").value = document.getElementById("type"+id).innerHTML ;
document.getElementById("editUrl").src = document.getElementById("resize"+id).innerHTML ;
var url = document.getElementById("url"+id).innerHTML ;


  document.getElementById("ShowLinkInfo").href = url;

  document.getElementById("DeleteLinkInfo").href = "warehouse/file-delete/"+id;

$('#editTag').tagsinput({
  allowDuplicates: true,
  trimValue: true
});

$('#editTag').tagsinput('removeAll');
var rawhtml = $("#tag"+id).html();
     if (rawhtml.length > 1){
     rawhtml = rawhtml.split(',');
     for (var i = 0; i < rawhtml.length;i++){
    $('#editTag').tagsinput('add', rawhtml[i]);
    }
    }



  // document.getElementById("editTag").value = document.getElementById("tag"+id).innerHTML
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

    $('.bootstrap-tagsinput').find(".label-info").last().remove();
  
$('.bootstrap-tagsinput input').focusout()
    $('.bootstrap-tagsinput input').focus();

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
document.querySelector("td.editTD div input").click(function( event ) {
console.log("test124")
})

$('.bootstrap-tagsinput input').keydown(function( event ) {
    // $('#editTag').tagsinput("remove", { id: 1});
    if ( event.which == 13 ) {
        $(this).blur();
        $(this).focus();
        return false;
    }
})

});


function changeType(){
  // alert('oke')
  type =  document.getElementById("sType").value;
  if(type == 2){
    window.location.href="/warehouse"
  }
}


function inputOpen(){
  // alert("1");
  // document.getElementById("myinput").click();
  $("#myinput").focus()
}



  </script>


@endsection
