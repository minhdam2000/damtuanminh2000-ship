<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Center Management System</title>
        <link rel="icon" type="image/ico" href="js-css/img/title_logo.png" />
        <base href="{{asset('')}}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="js-css/css/bootstrap.min.css">
        <script src="js-css/js/jquery.min.js"></script>
        <script src="js-css/js/popper.min.js"></script>
        <script src="js-css/js/bootstrap.min.js"></script> <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
                             
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
        <link rel="stylesheet" href="js-css/font/font-awesome.min.css">
       
            <link rel="stylesheet" href="js-css/css/css.css">
        
        <link rel="stylesheet" href="js-css/css/custom.css">
        <script src="js-css/js/jquery.dataTables.min.js"></script>
        <script src="js-css/js/sweetalert.js"></script>
        <link rel="stylesheet" href="js-css/css/sweetalert.css">

        <script src="js-css/js/script.js"></script>
        <script src="js-css/js/Chart.js"></script>
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>

<style>
  /* Popup container - can be anything you want */
  .list-group-item{
    background-color:transparent!important;
  }
 .header-camera{
    display: none;
 }
  h2{
    font-weight: 900
  }
  .popup {
    background-repeat:no-repeat;
    background-size:contain;
    background-position:center;
    text-align: center;
    color: black;
    font-weight: 100!important;
    display: block;
    position: absolute;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
  /* Toggle this class - hide and show the popup */
  
  </style> </head>
    <body> <div id="content">
    <div class="content-camera">
        <div class="header-content">
           
        </div>
        <div class="">
          <div class="row row-content">
            <div class="row-title-proxy">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;</div>
 

              </div></div>
 <div class="row-content">
    <div class="" style="display:block" id="create-user" role="dialog">
        
              <div class="modal-header">
              </div>
              <div class="notification"></div>
              <div class="modal-body" style="text-align: center;">
                <h2>Cảm ơn bạn đã đăng kí làm công tác viên</h2>
                <h2>Vui lòng kiểm tra Email để biết thêm chi tiết</h2>
              </div>
              
            </div>
          </div>
        </form>
      </div>

</div>

<div class="overlay-dark"></div>
<embed class="img-overlay">

  
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
<script>
  $(document).ready(function() {
      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }

    });
</script>

<script type="text/javascript">
      function openfileupload(id){
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
          var myElement =  $("#preview-file");
          reader.onload = function(e) {
            // get loaded data and render thumbnail.
          html  = html + '<img style="width: 200px;margin-left: 3%;" src="'+e.target.result+'" id="preview" class="preview">';
        console.log(html)
             console.log(myElement.html())
           myElement.html(html);
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
