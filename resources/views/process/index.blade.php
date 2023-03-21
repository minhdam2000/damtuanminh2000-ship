@extends('layouts.index')
@section('content')
<script src="js-css/js/d3.min.js"></script>
<meta name="csrf-token" content="{!! csrf_token() !!}">      
<!-- DataTables -->
<link rel="stylesheet" href="js-css/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="js-css/css/stepprogressbar.css">

<style>
  /* Popup container - can be anything you want */
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

<div class="content-camera">
<div class="session">
  @if(Session::has('notification'))
  <input hidden="" notifi="{{Session::get('notification')}}" value="1" id="notice_success">
  @endif
  @if(Session::has('warning'))
  <input hidden="" notifi="{{Session::get('warning')}}" value="1" id="notice_warning">
  @endif
</div>
<div class="notification"></div>
<div class="row-content">


<!-- 
<ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#content1">Chi tiết quy trình</a>
      </li>
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content2">Sơ đồ thực hiện</a>
      </li>
    
    </ul>  
  -->
  <hr>

<div class="tab-content">
<div id="content1" class="tab-pane  in active">
  
</div>


<div id="content2" class="tab-pane fade">


</div>
</div>

</div>
<div class="popup" id="popup">
  <div class="popuptext" id="myPopup">

  </div>
</div>


<input type="hidden"  value="2" id="tempType">    
<input type="hidden"  value="1" id="tempDate">   


<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
</div>
<div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
</div>

<!-- Thay doi cau hinh  -->

<script type="text/javascript" src="js-css/js/socket.io.js"></script>

<style type="text/css">
  #zone .modal-dialog {
    max-width: 1000px;
  }

  #zone .modal-body {
    padding: 0em;
  }

  #zone .modal-content{
    padding: 1em;
  }

  #zone .modal-dialog {
    top: 150px;
  }

</style>

<div class="overlay-dark"></div>
<embed class="img-overlay">

 <script type="text/javascript">
  var DepartmentNameList = []
  var DepartmentIndex = []

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



  function getProcess(){
    $.ajax({
      type: "GET",
      url: '/process/process-list/',
      success: function (response) {
        response = (JSON.parse(response))
        var html = ""

        for(var i =0; i < response.length; i++){
          html = html + "<h3>"+response[i].name+"</h3>"
          html = html + '<div id= "process'+response[i].id+'"></div><a href="/process/view/'+response[i].id+'" style="float:right" class="camera-button my-custom-button"> Chi tiết   </a>'
          html = html + "<br><hr>"
        }
        document.getElementById("content1").innerHTML= html
        for(var i =0; i < response.length; i++){
          getProcessDetail(response[i].id)
        }
      }

    });
  }

  function getProcessDetail(id){

    $.ajax({
      type: "GET",
      url: '/process/process-index-detail/' + id,
      success: function (response) {
        console.log("process detail")
        var responseall = (JSON.parse(response))
        var response = responseall[0]
        var curstep = responseall[1]
        console.log(responseall)
        html = '<div class="arrow-steps clearfix" id="processtabs">'
        
        for(var i =0; i < response.length; i++){
          console.log(response[i].sid)
          if (response[i].sid == curstep){
            name = '<span style="color:yellow">'+response[i].step_name+'</span>'

          }else if (response[i].state == 2){
            name = '<span style="color:green">'+response[i].step_name+'</span>'

            
          }else if (response[i].state == 3){
            name = '<span style="color:red">'+response[i].step_name+'</span>'

            
          }else{
            name = '<span style="color:white">'+response[i].step_name+'</span>'

          }
          html = html + '<div class="myprocess step" id="myprocess'+response[i].sid+'" onclick="getStepDetail('+response[i].sid+','+"'myprocess'"+')"> '+name+'</div>' 

        }
        html = html +  "</div>"
        document.getElementById("process"+id).innerHTML = html;
      }


    });
  }

     getProcess()
    

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
    $('#staff-table').DataTable({
      "order": [[ 3, "desc" ]]
    })
    $('#area-table').DataTable({
      "order": [[ 3, "desc" ]]
    })
    $('.dataTables_length').addClass('bs-select');
    $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });


    function  loadFile($src){
      $('.img-overlay').attr('src', $src);
      $(".overlay-dark").css('display', 'block');
      $('.img-overlay').css('display', 'block');
      $('.img-overlay').css('opacity', 1);
      $('.img-overlay').css('width', '90%');
      $('.img-overlay').css('height', '90%');
      $('.img-overlay').css('transform', 'translate(-50%, 0) scale(1, 1)');
    }

    $(".overlay-dark").on('click', function() {
      $(".overlay-dark").css('display', 'none');
      $('.img-overlay').css('display', 'none');
      setTimeout(function() {
        $('.img-overlay').css('transform', 'translate(-50%, 0) scale(0, 0)');
      }, 600);
    });

    $("#content1").on("click", "li", function(e) {
      e.preventDefault();
      $(this).closest("li").find("[class^='ul_submenu']").slideToggle();
    });
    $("#content2").on("click", "li", function(e) {
      e.preventDefault();
      $(this).closest("li").find("[class^='ul_submenu']").slideToggle();
    });
    $("#content3").on("click", "li", function(e) {
      e.preventDefault();
      $(this).closest("li").find("[class^='ul_submenu']").slideToggle();
    });
    $("#content4").on("click", "li", function(e) {
      e.preventDefault();
      $(this).closest("li").find("[class^='ul_submenu']").slideToggle();
    });
  </script>
<script type="text/javascript">
  /**/
function viewStep(event){
  $(".step").removeClass('current')
  console.log(event)
  event.classList.add('current');
}

</script>
<script type="text/javascript">
    $(document).ready(function() {
      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }
  });
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
  @endsection
