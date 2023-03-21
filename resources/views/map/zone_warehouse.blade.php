@extends('layouts.index')
@section('content')
<style type="text/css">
  @media(max-width:700px) {
    .icon-td {
       display: none;
    }
}
</style>
<style type="text/css">
  table.dataTable>thead .sorting,table.dataTable>thead .sorting_asc,table.dataTable>thead .sorting_desc,table.dataTable>thead .sorting_asc_disabled,table.dataTable>thead .sorting_desc_disabled{cursor:pointer;position:relative}table.dataTable>thead .sorting:before,table.dataTable>thead .sorting:after,table.dataTable>thead .sorting_asc:before,table.dataTable>thead .sorting_asc:after,table.dataTable>thead .sorting_desc:before,table.dataTable>thead .sorting_desc:after,table.dataTable>thead .sorting_asc_disabled:before,table.dataTable>thead .sorting_asc_disabled:after,table.dataTable>thead .sorting_desc_disabled:before,table.dataTable>thead .sorting_desc_disabled:after{position:absolute;bottom:.9em;display:block;opacity:.3}table.dataTable>thead .sorting:before,table.dataTable>thead .sorting_asc:before,table.dataTable>thead .sorting_desc:before,table.dataTable>thead .sorting_asc_disabled:before,table.dataTable>thead .sorting_desc_disabled:before{right:1em;content:"↑"}table.dataTable>thead .sorting:after,table.dataTable>thead .sorting_asc:after,table.dataTable>thead .sorting_desc:after,table.dataTable>thead .sorting_asc_disabled:after,table.dataTable>thead .sorting_desc_disabled:after{right:.5em;content:"↓"}table.dataTable>thead .sorting_asc:before,table.dataTable>thead .sorting_desc:after{opacity:1}table.dataTable>thead .sorting_asc_disabled:before,table.dataTable>thead .sorting_desc_disabled:after{opacity:0}div.dataTables_scrollHead table.dataTable{margin-bottom:0 !important}div.dataTables_scrollBody>table{border-top:none;margin-top:0 !important;margin-bottom:0 !important}div.dataTables_scrollBody>table>thead .sorting:before,div.dataTables_scrollBody>table>thead .sorting_asc:before,div.dataTables_scrollBody>table>thead .sorting_desc:before,div.dataTables_scrollBody>table>thead .sorting:after,div.dataTables_scrollBody>table>thead .sorting_asc:after,div.dataTables_scrollBody>table>thead .sorting_desc:after{display:none}div.dataTables_scrollBody>table>tbody tr:first-child th,div.dataTables_scrollBody>table>tbody tr:first-child td{border-top:none}div.dataTables_scrollFoot>.dataTables_scrollFootInner{box-sizing:content-box}div.dataTables_scrollFoot>.dataTables_scrollFootInner>table{margin-top:0 !important;border-top:none}@media screen and (max-width: 767px){div.dataTables_wrapper div.dataTables_length,div.dataTables_wrapper div.dataTables_filter,div.dataTables_wrapper div.dataTables_info,div.dataTables_wrapper div.dataTables_paginate{text-align:center}div.dataTables_wrapper div.dataTables_paginate ul.pagination{justify-content:center !important}}table.dataTable.table-sm>thead>tr>th:not(.sorting_disabled){padding-right:20px}table.dataTable.table-sm .sorting:before,table.dataTable.table-sm .sorting_asc:before,table.dataTable.table-sm .sorting_desc:before{top:5px;right:.85em}table.dataTable.table-sm .sorting:after,table.dataTable.table-sm .sorting_asc:after,table.dataTable.table-sm .sorting_desc:after{top:5px}table.table-bordered.dataTable{border-right-width:0}table.table-bordered.dataTable th,table.table-bordered.dataTable td{border-left-width:0}table.table-bordered.dataTable th:last-child,table.table-bordered.dataTable th:last-child,table.table-bordered.dataTable td:last-child,table.table-bordered.dataTable td:last-child{border-right-width:1px}table.table-bordered.dataTable tbody th,table.table-bordered.dataTable tbody td{border-bottom-width:0}div.dataTables_scrollHead table.table-bordered{border-bottom-width:0}div.table-responsive>div.dataTables_wrapper>div.row{margin:0}div.table-responsive>div.dataTables_wrapper>div.row>div[class^=col-]:first-child{padding-left:0}div.table-responsive>div.dataTables_wrapper>div.row>div[class^=col-]:last-child{padding-right:0}</style>


 <link rel="stylesheet" href="/js/taginputs/bootstrap-tagsinput.css"  />

    <script src="/js/taginputs/bootstrap.min.js" ></script>
    <script src="/js/taginputs/bootstrap-tagsinput.js"></script>
    <script src="/js/taginputs/bootstrap-tagsinput-angular.min.js"></script>



<style>
  /* Popup container - can be anything you want */

#cv1_length{
  display: none;
}

.header-camera{
  display: none;
}
      .label-info{
            background-color: red!important;

        }
        .bootstrap-tagsinput{
          width: 100%;
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


        </style>
  <div class="content-camera">
    <div class="header-content">
      <div class="header-content-left">
      </div>
      <div class="header-content-right" style="display: inline;">
        
        <h6 class="display-inline">Danh sách hồ sơ </h6>
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

    </ul>  


        <div class="tab-content">
         
<button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-url">Thêm tệp mới</button>


         <div id="content2" class="tab-pane  active">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="cv1" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        
                        <th style="width: 60%">Đầu mục </th>
                        <th>Tag</th>
                        <th class="icon-id"> </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($cv as $form)
                         <tr class="color-add">
                           <?php

                          if(strpos($form->name,"_")> 0){
                            $date = explode("_",$form->name)[0];
                            $dataArr = explode(".",$date);
                            if(count($dataArr) > 2){
                              $year = $dataArr[0];
                              $month = $dataArr[1];
                              $day = $dataArr[2];

                              if(intval($month) < 10){
                                $month = "0".$month;
                              }

                              if(intval($day) < 10){
                                $day = "0".$day;
                              }
                            }else{
                               $month = 0;
                              $year = 0;
                              $day = 0;
                            }

                          }else{
                            $month = 0;
                            $year = 0;
                            $day = 0;
                          }

                          ?>
                          <td><span style="display: none"><?=$year.".".$month.".".$day?></span><a  target="_blank" href="{{$form->url}}"><span id="iname{{$form->id}}">{{$form->name}}</span> </a></td>

<td >

<span style="display: none" id="testgrouptag">
                          <?php
                          foreach($tag_groups_arr as $example_tag){
                              $my_tag_array = explode(";", $example_tag);
                              foreach($my_tag_array as $mytag){
                                if(strpos($form->name,$mytag) > -1){
                                    echo $example_tag." ";
                                    break;
                                }
                              }
                          }
                          ?>
                          </span>
  <span style="display: none"  id="tag{{$form->id}}"> {{$form->tags}}</span>
                          <span  style="display: none" id="type{{$form->id}}">
                           <?php
                                     $tagArr = explode(",", $form->tags);
                                     $display_tag="";
                                    if($tagArr[0]!=""){
                                      foreach ($tagArr as $single_tag) {
                                      $display_tag =   $display_tag.$single_tag;

                                        foreach($tag_groups_arr as $example_tag){
                                          if(strpos($example_tag,";".trim($single_tag)) > -1
                                          ||  strpos($example_tag,trim($single_tag).";") > -1){
                                            $display_tag = $display_tag."(".$example_tag.")";
                                            break;
                                          }
                                        }

                                        $display_tag = $display_tag.",";
                                      }
                                    }
                                    $display_tag = substr($display_tag, 0, -1);
                                  ?> {{$display_tag}}</span>
                            <span class="mytags">{{$form->tags}}</span>

                          <span style="display: none">{{$form->created_at}} 
                            <?php
$old_date_timestamp = strtotime($form->created_at);
 echo date('d-m-Y H:i:s', $old_date_timestamp);
 ?>
 </span>
  <span style="display: none" id="link{{$form->id}}">{{$form->url}}

 
                          </td>
                              

                          <td>
                            
                                 <button style="color: white"  type="button" onclick="editInputDetail('{{$form->id}}')" class="btn btn-del Disable preview" > <img src="/js-css/img/icon/edit.png"> </button>
                          
                          <button class="btn btn-del Disable preview" onclick="confirm_remove(this,{{$form->id}})">
                             <img src="/js-css/img/icon/recycle_bin.png">
                           </button>
                          </td>
                       
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>

               <button  type="button"  class="btn btn-model"><a href="/zone/merge-all-pdfs/{{$id}}" > Tải toàn bộ</a></button>

               <button  type="button"  class="btn btn-model"><a href="/zone/merge-select-pdfs/{{$id}}" > Tải theo tìm kiếm</a></button>
             
 
          </div>

        </div>
           

        </div>
      </div>
    </div>
    
  <!-- end model --->

<div class="modal fade modol-text" id="new-url" role="dialog">
          <div class="modal-dialog model-right" style="min-width: 100%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm tệp</label>
              </div>
              <div class="notification"></div>
               <form id="uploadfile" action="/area/edit-files"  enctype="multipart/form-data" method="POST">
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
                                <td class="cam-properties">Tags: </td>
                                <td>
             <input id="newTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">


                           
                          </tr>

                          

                           <tr>
                <td class="cam-properties">Tệp tin  </td>
                  <td><label  class="preview" for="file-input"><img onclick="openfileupload(1)"  src="/js-css/img/icon/upload.png"></label><input  id= "inputfile1" style="display:none" type="file" name="file[]" class="form-control"
                    multiple>
                </td>
              </tr>
<tr>
  <td></td>
  <td>
                <span class="form-group" id="preview-file1"></span>
      </td>         
                          <tr>
                          <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm&nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoat </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div><input value = "<?=$id?>" type="hidden" name="id" class="form-control">
                <input value = "<?=$type?>" type="hidden" name="type" class="form-control">
              </form> 
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
              <form action="/zone/edit-file-names" method="POST"  enctype="multipart/form-data"> 
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
                                <td class="cam-properties">Tags: </td>
                                <td>
                                <input id="editTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">
                                </td>
                          </tr>

                    

                          <tr>
  <td class="cam-properties">Tải tệp khác  </td>
                  <td><label  class="preview" for="file-input"><img onclick="openfileupload(3)"  src="/js-css/img/icon/upload.png"></label><input  id= "inputfile3" style="display:none" type="file" name="file[]" class="form-control"
                    multiple>
                </td>
                </tr>
                <tr>
  <td></td>
  <td>
                <span class="form-group" id="preview-file3"></span>
      </td>         
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



    function openfileupload(id){
            document.getElementById("inputfile"+id).click();
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
   
       $(document).ready(function(){


      if($("#notice_warning").val() == 1){
        // alert("123")
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }
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
  <script type="text/javascript">
   var CvTable = $('#cv1').DataTable({
      "order": [[ 0, "desc" ]],
    "drawCallback": function( settings ) {  
     $('.mytags').each(function(){

     var rawhtml = $(this).html();
     if (rawhtml.length > 1 && rawhtml.includes("bootstrap-tagsinput") == false){
      console.log("1")

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


$('#cv1').on('search.dt', function() {
    var value = $('#cv1_filter input').val();
    console.log(value)
    setCookie("cv_temp",value,3600*60)
}); 

       $(document).ready(function(){
    $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');

        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });
});


function setCookie(cname, cvalue, mytime) {
  const d = new Date();
  d.setTime(d.getTime() + (mytime));
  let expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}


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
 
 function editInputDetail(id){
  console.log(id)
  document.getElementById("editId").value = id
  var url = document.getElementById("link"+id).innerHTML  
  var filename = "<a target='_blank' href = '"+url+"' >"+document.getElementById("iname"+id).innerHTML+"</a>"
  document.getElementById("preview-file3").innerHTML = '<p><img width="25" height = "25" src="/js-css/img/file_type/pdf.png"> ' + filename+ " <span style='color:red' onclick='closeEditFile()'>x</span><p>"
  document.getElementById("editName").value = document.getElementById("iname"+id).innerHTML



  $("#editTag").tagsinput('removeAll');
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
                    location.href="zone/{{$delete_route}}/"+id
                    swal.close(); 
                  } 
                  else {     
                    swal.close();  
                  } 
                });
        }
</script>

@endsection
