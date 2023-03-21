@extends('layouts.index')
@section('content')'


<?php
$boss = 0;
$departs = DB::table("user_department")->where("user_id", Auth()->user()->id)->pluck("department_id")->toArray();
  
  foreach($departs as $depart){
      $mid = DB::table("department")->where("id",$depart)->first()->mid;
      // dd($hid);
      if ($mid < 1) {
          $boss = 1;
          break;
      }
  }
        
?>
<script src="js-css/js/d3.min.js"></script>
<meta name="csrf-token" content="{!! csrf_token() !!}">      
<!-- DataTables -->
<link rel="stylesheet" href="js-css/css/stepprogressbar.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
  /* Popup container - can be anything you want */

  .content-camera{
    overflow: inherit!important;
  }
  .job-content{
    overflow: inherit!important;

  }
  table{
    border: none;
  }

  table tr{
    border: none;
  }

  .list-group-item{
    background-color:transparent!important;
    text-align: left;
  }
  .fananci-element {
    list-style-type: none;
    width: 100%;
    display: table;
    table-layout: fixed;
  }

  .fananci-list {
    display: table-cell;
    width: 30%;
    font-size: 20px;
  }
  .popup {
    display: none;
    position: absolute;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  /* The actual popup */
  .popup .popuptext {
    width: 160px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 8px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -80px;
  }

  /* Popup arrow */
  .popup .popuptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
  }

  /* Toggle this class - hide and show the popup */
  .popup .show {
    visibility: visible;
    -webkit-animation: fadeIn 1s;
    animation: fadeIn 1s;
  }

  /* Add animation (fade in the popup) */
  @-webkit-keyframes fadeIn {
    from {opacity: 0;} 
    to {opacity: 100;}
  }

  @keyframes fadeIn {
    from {opacity: 0;}
    to {opacity:1 ;}
  }
</style>
<style type="text/css">
  @media(max-width:700px) {
    .icon-td {
       display: none;
    }
    .myname{
      min-width: 40vw!important;
    }
    .mydate{
      min-width: 30vw!important;
    }
}

.myname{
      min-width: 50vw!important;
    }
    .mydate{
      min-width: 10vw!important;
    }
.bg-info{
  min-width: 200px;
}
.mydanger{
  min-width: 200px;
}

@media(max-width:700px) {
.bg-info{
  min-width: 150px;
}
.mydanger{
  min-width: 150px;
}
}

.progress{
    min-height: 30px;
    background-color: transparent;
}
.progress-bar{
    font-size: 15px;
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
  <div class="row-content">
       
<hr><br>
        <div class="tab-content">

        
          <div id="content0" class="tab-pane active in bigtab">



<br>

<br>
<table id="example" class="nvr-table">
<thead>
                    <tr class="thead">
                        <th style="width: 70%"><h2>Tên hạng mục: {{$cur_list->title}}</h2> </th>
                        <th></th>
                      </tr>
                    </thead>

              </table>
<button type="button" class="btn btn-model" onclick="BuiltAdd({{$cur_list->id}})">Thêm hạng mục</button>

 @foreach($finance_sheet as $fin)
 <li class="submenu list-group-item">
  <table id="inner-table{{$fin->id}}" class="nvr-table " onclick="ToggleTable(this)">

<thead >
<tr class="thead">
<th style="width: 70%">
  
<i style="color:green" class="fa fa-star" aria-hidden="true">
  @if($fin->stt > 0)
</i> <span id="subtabsmenu{{$fin->id}}" style="color:green"><span id="stt{{$fin->id}}" >{{$fin->stt}}</span>. <span id="legalTitle{{$fin->id}}" >{{$fin->title}}</span></a></span>
@else

</i> <span id="subtabsmenu{{$fin->id}}" style="color:green">{{$fin->title}}</span></a></span>
@endif

</th>
<th style="width: 30%;">

  @if($fin->status  ==2)
      @if($fin->amount > 0)
        <span style="color:green">
     {{number_format(floatval($fin->amount), 0, ",", ".") }} VND</span> 
      @else

        <span style="color:red">
     {{number_format(floatval($fin->amount), 0, ",", ".") }} VND</span>
      @endif
  @elseif($fin->amount > 0)
     {{number_format(floatval($fin->amount), 0, ",", ".") }} VND
  @endif
</th>





<th>

<!--  <button style="color: white"  type="button" class="btn btn-del Disable">
                             <a href="/building/delete-step/{{$fin->id}}" > <span class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span></a>      </button> -->

<button style="color: white"  type="button" onclick="BuiltAdd({{$fin->id}})" class="btn btn-del Disable">
                             <span class="preview"><img src="/js-css/img/icon/plus.png"></span></button>

</th>


</tr>
</thead>
</table>

<div  id="subContent{{$fin->id}}" style="display:none"><ul class="ul_submenu fananci-element"> <table id="inner-table" class="nvr-table ">

</table></ul>
</div>
</li>
@endforeach

          </div>

          </div>



</div>
</div>
<div class="popup" id="popup">
  <div class="popuptext" id="myPopup">

  </div>
</div>

<!-- Modal -->

<div class="modal fade modol-text" id="new-step" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm hạng mục</label>
              </div>
              <div class="notification"></div>
              <form action="finance/add" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                              <tr>
                                <td class="cam-properties">Tên hạng mục</td>
                                <td>
                                <input class="input-edit modol-text" id=""  name="name" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Ghi chú</td>
                                <td>
                                <input class="input-edit modol-text" id=""  name="des" required=""></td>
                            </tr>
                           
                            <tr>
                                <td class="cam-properties">Số tiền</td>
                                <td>
                               <input type="" value="" id="NewAmountDisplay" name="" class="input-edit create-user modol-text" required="" onblur="formatForId('NewAmount')">
                              <input value="0" style="display:none" type="number" id="NewAmount" name="amount"> 
                            </td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Ngày</td>
                                <td>
                                <input type="date" class="input-edit modol-text form-control" name="date" id="" required="">
                              </td>
                            </tr>

                           
                            <tr>
                                <td></td>
                                <td>
                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;float:left;margin-right: 5%;"  id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>

                                   

                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;"  class="btn btn-model" data-dismiss="modal"> Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>


<div class="modal fade modol-text" id="new-substep" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm hạng mục</label>
              </div>
              <div class="notification"></div>
              <form action="finance/addsub" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="insertStepID" >
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                              <tr>
                                <td class="cam-properties">Tên hạng mục</td>
                                <td>
                                <input class="input-edit modol-text" id=""  name="name" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Ghi chú</td>
                                <td>
                                <input class="input-edit modol-text" id=""  name="des" required=""></td>
                            </tr>
                           
                            <tr>
                                <td class="cam-properties">Số tiền</td>
                                <td>
                               <input type="" value="" id="NewAmount2Display" name="" class="input-edit create-user modol-text" required="" onblur="formatForId('NewAmount2')">
                              <input value="0" style="display:none" type="number" id="NewAmount2" name="amount"> 
                            </td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Ngày</td>
                                <td>
                                <input type="date" class="input-edit modol-text form-control" name="date" id="" required="">
                              </td>
                            </tr>

                           
                            <tr>
                                <td></td>
                                <td>
                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;float:left;margin-right: 5%;"  id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>

                                   

                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;"  class="btn btn-model" data-dismiss="modal"> Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>


<input type="hidden"  value="2" id="tempType">    
<input type="hidden"  value="1" id="tempDate">   


<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
</div>
<div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
</div>

<!-- Thay doi cau hinh  -->

<script src="/js-css/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="js-css/js/socket.io.js"></script>

<div class="overlay-dark"></div>
<embed class="img-overlay" id="img-overlay"></embed> 

 <script type="text/javascript">

$('#staffselect').selectpicker({
     noneResultsText: 'Chưa có nhà thầu'
});

    function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }

    $("#search-input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#zone-table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  </script>

  <!-- DataTables -->

 <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>


  <script type="text/javascript">
    $('#cv1').DataTable({
      "order": [[ 1, "desc" ]]
    })
    $('#cv2').DataTable({
      "order": [[ 1, "desc" ]]
    })
    $('#cv').DataTable({
      "order": [[ 1, "desc" ]]
    })
    // $('.dataTables_length').addClass('bs-select');
   

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
      $('.img-overlay').attr('src', "asdf.png");

      $('.img-overlay').attr('src', $('.img-overlay').attr('src'));
      setTimeout(function() {
        $('.img-overlay').css('transform', 'translate(-50%, 0) scale(0, 0)');
      }, 600);
    });

    $("#SystemContent").on("click", "h5", function(e) {
      e.preventDefault();
      $(this).closest("li").find("[class^='ul_submenu']").slideToggle();
    });
   
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }



        var current_id = getCookie("current_id");
        $(current_id).click()


    });
  </script>



<script type="text/javascript">
  
  
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

function ToggleTable(elmt){
  // console.log("testtt123")
    // console.log(elmt.id)
    if(elmt.id.includes("inner-table")){
      // alert("okoek")
    setCookie("current_id","#"+elmt.id,3600*60)
  }
      $(elmt).next("div").slideToggle();
      // var nextEle =  $(elmt).next("div").children();

      //   // console.log(nextEle.length);
      // for (var i = 0; i < nextEle.length; i++) {
      //   // console.log(nextEle[i].children()[0]);
      //     $(nextEle[i]).children()[0].click();
      // }
}

</script>


  <style type="text/css">
    #staff-table_filter{
      float: right
    }
    .chart-circle {
      text-align: center;
      padding: 20px;
    }

    .chart-circle canvas {
      display: inline; 
      width: 100%; 
      height: auto;
    }

    .chart_ {
      padding: 20px;
      text-align: center;
    }

    .card-header .wrapper {
      background: #2b3c46;
      margin-bottom: 15px;
    }

    .line-col {
      display: inline; width: 100%;
    }



  </style>

  <script type="text/javascript">
    function getSubList(id,index){
      console.log("______________________?????_")
      console.log(index)
      console.log(id)
  $.ajax({
    type: "GET",
    url: 'finance/get-sub-as-json/'+id,
    success: function (response) {
      res = (JSON.parse(response))
      response = res
      for(i=0;i<response.length;i++) { 
        myid = i + 1
        var html = ' <div style="margin-left:3%"  id="root'+response[i].id+'"> <table class="root_table" onclick="ToggleTable(this)"><tbody class="tbody">'

        // html = html + '<tr class="color-add"><td>  <input type="checkbox" id="'+response[i].id+'" value="'+response[i].id+'" name="'+response[i].id+'" class="check-box" />  <label for="'+response[i].id+'" class="add-cam"></label></td>'
       
          html = html + '<tr class="color-add">'
        

if(response[i].status > 0){

  if(response[i].stt > 0){
html =html + '<td style="width: 40%"><a target="_blank" href="/legal/process-file/'+response[i].id+'"><i style="color:green" class="fa fa-star" aria-hidden="true"></i> <span id="subtabsmenu'+response[i].id+'" style="color:green">'+index+'.<span id="stt'+response[i].id+'" >'+response[i].stt+'</span>.<span id="legalTitle'+response[i].id+'" >'+response[i].title+'</span></a></span></td>'
}else{
  html =html + '<td style="width: 40%"><a target="_blank" href="/legal/process-file/'+response[i].id+'"><i style="color:green" class="fa fa-star" aria-hidden="true"></i> <span id="subtabsmenu'+response[i].id+'" style="color:green"><span id="legalTitle'+response[i].id+'" >'+response[i].title+'</span></a></span></td>'
}

if(response[i].amount > 0){
        html = html + '<td style="width: 40%">'+ formatMoney(response[i].amount)+" VND</td>"
}else{
        html = html + '<td style="width: 40%"></td>'
}

}else{
html =html + '<td style="width: 40%"><a target="_blank" href="/legal/process-file/'+response[i].id+'"><i style="color:green" class="fa fa-star" aria-hidden="true"></i> <span id="subtabsmenu'+response[i].id+'" style="color:green"><span id="legalTitle'+response[i].id+'" >'+response[i].title+'</span></a></span></td>'
       

        html = html + "<td>"+ formatMoney(response[i].amount)+" VND</td>"

        html = html + "<td>"+ response[i].date+"</td>"

}



         html = html + "<td>"


        html = html + '<button style="color: white"  type="button" onclick="BuiltAdd('+response[i].id+')" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/plus.png"></span></button>'


if(response[i].status == 0){
        html = html + ' <button style="color: white"  type="button" class="btn btn-del Disable"><a href="/finance/delete-step/'+response[i].id+'" > <span class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span></a></button>'
}

        html = html + "</td>"



        html = html +'</tr></tbody></table><div style="display:none" id="subContent'+response[i].id+'" class="subContent">'
        // console.log(html)
        document.getElementById("subContent"+id).innerHTML = 
document.getElementById("subContent"+id).innerHTML + html

        getSubList(response[i].id,index+'.'+response[i].stt)

      }

    }
  });
}


@foreach($finance_list as $lid)

getSubList({{$lid->id}},{{$lid->stt}})

@endforeach


  function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    const negativeSign = amount < 0 ? "-" : "";

    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;

    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e)
  }
};


function BuiltUpdate(id){
  document.getElementById("EditLegalID").value = id;
  document.getElementById("EditLegalTitle").value = document.getElementById("legalTitle"+id).innerHTML;
  document.getElementById("EditLegalStt").value = document.getElementById("stt"+id).innerHTML;

        $("#edit-step").modal()
}

function BuiltAdd(id){
  document.getElementById("insertStepID").value = id;

        $("#new-substep").modal()
}


     $('.job-link').click(function(event){
        //remove all pre-existing active classes
        $('.job-link').css("color", "white");
        $('.job-content').removeClass('active');



        $(this).css("color", "yellow");
        // alert("#"+this.href.split("#")[1]);
        //add the active class to the link we clicked
        $("#"+this.href.split("#")[1]).addClass('active');
    setCookie("step_url","#"+this.id,3600*60)


        // event.preventDefault();
    });

     $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.bigtab').removeClass('active');

        $("#"+this.href.split("#")[1]).addClass('active');


    setCookie("tab_url","#"+this.id,3600*60)


        // alert(this.id)
        if(this.id == "tab2"){
        $('.job-link').css("color", "white");
        $('.job-init').css("color", "yellow");

          $("#job-content1").addClass('active');
        }
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

function formatForId(id){
    var value = document.getElementById(id+"Display").value
    value = parseFloat(value.replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    console.log(value)
    console.log(value.replace(/,/g, ""))
    document.getElementById(id+"Display").value = value
    
    document.getElementById(id).value = value.replace(/,/g, "") 
}
</script>
<script src="/js-css/js/bootstrap-select.min.js"></script>
<script src="/js-css/js/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
  

  function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    const negativeSign = amount < 0 ? "-" : "";

    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;

    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e)
  }
};

     
</script>
  @endsection