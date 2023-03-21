@extends('layouts.index')
@section('content')
<script src="js-css/js/d3.min.js"></script>
<meta name="csrf-token" content="{!! csrf_token() !!}">      
  <!-- DataTables -->
 <link rel="stylesheet" href="js-css/datatables/dataTables.bootstrap4.css">

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



@media (max-width: 500px) {
.fananci-list {
  font-size: 10px;
}

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
  <div class="header-content">
  <div class="header-content-right" style="display: inline;">
    <a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i>  </h6></a>
    
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
<div class="row-content">
<ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a  onclick="auditChart(0)"  class="nav-link color-a " >Tháng này
            
          </a>
      </li>
      <li class="nav-item margin_center">
         
          <a  onclick="auditChart(1)"  class="nav-link color-a" >Tháng Trước </a>
      </li>
     <li class="nav-item margin_center">
          
          <a  onclick="auditChart(2)"  class="nav-link color-a" >Quý  này</a>
      </li>
       <li class="nav-item margin_center">
          
          <a  onclick="auditChart(3)"  class="nav-link color-a" >Tất cả</a>
      </li>
    
    </ul>  
    <hr>
                  </div>
                      <div class="col-sm-12">
                        <h2 id="chartTitle"></h2>
                        </div>
                        <div id="test"></div>
                    <div class="row">
                      <div id="con1" class="col-md-6 col-sm-12 chart-circle">
                      <canvas id="log1"></canvas>
                      </div>
                      <div id="con2" class="col-md-6 col-sm-12 chart-circle">
                      <canvas  id="log2"></canvas>
                      </div>
                        <div id="con3" class="col-md-12 col-sm-12 chart-circle">
                        <div class="row row-content">
                      <div class="col-sm-12">


                       <h3 style="text-align: left;">Bảng thống kê</h3>
                       <br><hr>
                       <table>
                       <tbody id="intable"></tbody>

</table>
                       <br><hr>
                       <table>
                       <tbody id="outtable"></tbody>

</table>
                       <h3 style="text-align: left;">Chi tiết các khoản thu chi</h3>
                       <br><hr>
                     </div>
      <div class="row-title-proxy">
         <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content1">Chi tiết thu theo nhóm</a>
      </li>
     <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content2">Chi tiết thu theo ngày tháng</a>
      </li>
       <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content3">Chi tiết chi theo nhóm</a>
      </li>
     <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content4">Chi tiết chi theo ngày tháng</a>
      </li>

    
    </ul>  
    <hr>

        <div class="tab-content">

          <div id="content1" class="tab-pane  in active">
          </div>

            <div id="content2" class="tab-pane  fade">
          </div>
  <div id="content3" class="tab-pane  fade">
          </div>
  <div id="content4" class="tab-pane  fade">
          </div>

        </div>
      </div>
                      </div>
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

     

     function auditChart(type){
       $(document).ready(function () {
        $('#log1').remove();
        $('#log2').remove();
        $('#con1').append('<canvas id="log1"><canvas>');
        $('#con2').append('<canvas id="log2"><canvas>');

        

          $.ajax({
            type: "GET",
            url: '/finance-audit-chart/'+type + "/",
            success: function (response) {
              response = (JSON.parse(response))

              let output = response[0]
              output = JSON.parse(output);

              let input = response[1]
              input = JSON.parse(input);

              let output_data = response[2]
              output_data = JSON.parse(output_data);
              // console.log(output_data)
              output_html = ""
              temp_type = ""


              let salary = response[7]
              salary = JSON.parse(salary);


              let gap = response[8]
              gap = JSON.parse(gap);
              $("#content3").empty();
              for(i = 0; i < output_data.length; i ++){
                 if (output_data[i].type_name != temp_type){
                      temp_type = output_data[i].type_name
                    if (i > 0){
                      output_html = output_html + "</li>";
                    }
                    output_html =output_html +  '<li class="submenu list-group-item"><a><h3><i class="fa fa-money" aria-hidden="true"></i> '+output_data[i].type_name+'</h3></a>';
                 }
                 output_html = output_html + '<ul class="ul_submenu fananci-element" style="display: none;"><li class="fananci-list margin_center"><b>'+output_data[i].title+'</b></li>'
                 output_html = output_html + '<li class="fananci-list margin_center">'+formatMoney(output_data[i].amount)+' VND</li>'
                 output_html = output_html + '<li class="fananci-list margin_center"><i class="fa fa-clock-o" aria-hidden="true"> </i> '+output_data[i].time+'</li></ul>'


              }

                      output_html = output_html + "</ul></li>";
              $("#content3").append(output_html);

              output_data = response[3]
              output_data = JSON.parse(output_data);
              // console.log(output_data)
              output_html = ""
              temp_type = ""

              $("#content4").empty();
              for(i = 0; i < output_data.length; i ++){
                 if (output_data[i].timegroup != temp_type){
                      temp_type = output_data[i].timegroup
                    if (i > 0){
                      output_html = output_html + "</li>";
                    }
                    output_html =output_html +  '<li class="submenu list-group-item"><a><h3><i class="fa fa-money" aria-hidden="true"></i> '+output_data[i].timegroup+'</h3></a>';
                 }
                 output_html = output_html + '<ul class="ul_submenu fananci-element" style="display: none;"><li class="fananci-list margin_center"><b>'+output_data[i].title+'</b></li>'
                 output_html = output_html + '<li class="fananci-list margin_center">'+formatMoney(output_data[i].amount)+' VND</li>'
                 output_html = output_html + '<li class="fananci-list margin_center"><i class="fa fa-clock-o" aria-hidden="true"> </i> '+output_data[i].time+'</li></ul>'


              }

                      output_html = output_html + "</ul></li>";
              $("#content4").append(output_html);


              output_data = response[4]
              output_data = JSON.parse(output_data);
              // console.log(output_data)
              output_html = ""
              temp_type = ""  
              $("#content1").empty();
              for(i = 0; i < output_data.length; i ++){
                 if (output_data[i].type_name != temp_type){
                      temp_type = output_data[i].type_name
                    if (i > 0){
                      output_html = output_html + "</li>";
                    }
                    output_html =output_html +  '<li class="submenu list-group-item"><a><h3><i class="fa fa-money" aria-hidden="true"></i> '+output_data[i].type_name+'</h3></a>';
                 }
                 output_html = output_html + '<ul class="ul_submenu fananci-element" style="display: none;"><li class="fananci-list margin_center"><b>'+output_data[i].title+'</b></li>'
                 output_html = output_html + '<li class="fananci-list margin_center">'+formatMoney(output_data[i].amount)+' VND</li>'
                 output_html = output_html + '<li class="fananci-list margin_center"><i class="fa fa-clock-o" aria-hidden="true"> </i> '+output_data[i].time+'</li></ul>'


              }

                      output_html = output_html + "</ul></li>";
              $("#content1").append(output_html);

              
              output_data = response[5]
              output_data = JSON.parse(output_data);
              // console.log(output_data)
              output_html = ""
              temp_type = ""

              $("#content2").empty();
              for(i = 0; i < output_data.length; i ++){
                 if (output_data[i].timegroup != temp_type){
                      temp_type = output_data[i].timegroup
                    if (i > 0){
                      output_html = output_html + "</li>";
                    }
                    output_html =output_html +  '<li class="submenu list-group-item"><a><h3><i class="fa fa-money" aria-hidden="true"></i> '+output_data[i].timegroup+'</h3></a>';
                 }
                 output_html = output_html + '<ul class="ul_submenu fananci-element" style="display: none;"><li class="fananci-list margin_center"><b>'+output_data[i].title+'</b></li>'
                 output_html = output_html + '<li class="fananci-list margin_center">'+formatMoney(output_data[i].amount)+' VND</li>'
                 output_html = output_html + '<li class="fananci-list margin_center"><i class="fa fa-clock-o" aria-hidden="true"> </i> '+output_data[i].time+'</li></ul>'


              }

                      output_html = output_html + "</ul></li>";
              $("#content2").append(output_html);

              let input_data = response[4]
              input_data = JSON.parse(input_data);

              document.getElementById("chartTitle").innerHTML = response[6]

            var colors = ["#0074D9", "#FF4136", "#2ECC40", "#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]
            /* 3 donut charts */
            if (window.innerWidth >500 ){
            var size = window.innerWidth/125;
           }else{
            var size = window.innerWidth/25;

           }
           var donutOptions = {
              responsive: false,
              cutoutPercentage: 55,
              legend: {
                position: 'bottom', padding: 5, labels: {
                  pointStyle: 'circle', usePointStyle: true,fontSize:size
                }
              },
            responsive: true,
            maintainAspectRatio: false,

            };
     

            let methods = []
            let labels = []
            let labels2 = []
            for(const [method, value] of Object.entries(output)){
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                labels.push(value.type_name +": " +formatMoney(value.amount) + "VND");
                labels2.push(value.type_name);
                methods.push(value.amount)
            }
            console.log(methods, labels)

             var intable =""
            var total = 0;
            for (var i = 0; i < labels.length;i++){
            intable =  intable +  "<tr>"

            intable =  intable +  "<td>"+labels2[i]+"</td>"
            intable =  intable +  "<td>"+formatMoney(methods[i]) + " VND"+"</td>"
            intable =  intable +  "</tr>"
            total = total + methods[i]
          }

            intable =  intable +  "<tr>"

            intable =  intable +  "<td>Tổng</td>"
            intable =  intable +  "<td>"+formatMoney(total) + " VND"+"</td>"
            intable =  intable +  "</tr>"
            document.getElementById("intable").innerHTML = intable

            var chDonutDataMethod = {
              labels: labels,
              datasets: [
                {
                  backgroundColor: colors,
                  borderWidth: 0,
                  data: methods
                }
              ]
            };
            var chDonutMethod = document.getElementById("log1");
            if (chDonutMethod) {
              logChart1 = new Chart(chDonutMethod, {
                type: 'pie',
                data: chDonutDataMethod,
                options: donutOptions
              });
              Chart.defaults.global.defaultFontColor = '#dcf3ff';
            }
            // donnut
            methods = []
            labels = []
            labels2 = []
           for(const [method, value] of Object.entries(input)){
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                labels.push(value.type_name +": " +formatMoney(value.amount) + "VND");
                labels2.push(value.type_name);
                methods.push(value.amount)
            }

            var salaryval = parseInt(salary.salary) + parseInt(salary.kpi) - parseInt(salary.penalty)
              console.log(salaryval)
            labels.push("Tiền lương : " +formatMoney(salaryval) + " VND");
            methods.push(salaryval)
            labels2.push("Tiền lương : " );

            labels.push("Tiền hoa hồng : " +formatMoney(parseInt(gap.gap)) + " VND");
            methods.push(parseInt(gap.gap))
            labels2.push("Tiền hoa hồng : ")

            var outtable =""
            var total = 0;
            for (var i = 0; i < labels.length;i++){
            outtable =  outtable +  "<tr>"

            outtable =  outtable +  "<td>"+labels2[i]+"</td>"
            outtable =  outtable +  "<td>"+formatMoney(methods[i]) + "VND"+"</td>"
            outtable =  outtable +  "</tr>"
            total = total + methods[i]
          }

            outtable =  outtable +  "<tr>"

            outtable =  outtable +  "<td>Tổng</td>"
            outtable =  outtable +  "<td>"+formatMoney(total) + "VND"+"</td>"
            outtable =  outtable +  "</tr>"
            document.getElementById("outtable").innerHTML = outtable
            var chDonutDataPort = {
              labels: labels,
              datasets: [
                {
                  backgroundColor: colors,
                  borderWidth: 0,
                  data: methods
                }
              ]
            };
            var chDonutPort = document.getElementById("log2");
            if (chDonutPort) {
              logChart2  = new Chart(chDonutPort, {
                type: 'pie',
                data: chDonutDataPort,
                options: donutOptions
              });
              Chart.defaults.global.defaultFontColor = '#dcf3ff';
            }
              
            }
          });
        });
     }

     auditChart(0)
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

     $(document).ready(function() {
          if($("#notice_success").val() == 1){
            notifiSuccess($("#notice_success").attr("notifi"));
          }
          if($("#notice_warning").val() == 1){
            notifiWarning($("#notice_warning").attr("notifi"));
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
