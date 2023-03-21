@extends('../layouts/index')
@section('content')
<style type="text/css">
  @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif
}



.results {
    font-weight: 600
}

select {
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
    height: 100%;
    object-fit: contain;
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
    padding-top: 0
}

.btn:hover {
    color: #fdaa4b
}

div.text-muted {
    font-size: 0.9rem
}

@media(max-width:372px) {
    .results {
        font-size: 0.9rem
    }
}

@media(max-width:330px) {
    .results {
        font-size: 0.85rem
    }
}

@media(min-height: 700px) {
    body {
        height: 100vh
    }
    .chart{
      min-height: 400px;
    }
}
.card-body{

    text-align: center;
}
@media(max-width:768px) {
    body {
        height: 100%
    }
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


@media (max-width: 500px) {
.fananci-list {
  font-size: 10px;
}

}

</style>
<hr><br><hr>
 <div class="row-title-proxy">
         <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a active" 
          data-toggle="tab" role="tab" href="#content1">Tổng quan</a>
      </li>


     <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content2"> Chi tiết</a>
      </li>
      </ul>
  </div>
   <div class="tab-content">

          <div id="content1" class="tab-pane  in active">
            <hr>
            <div class="row">
             <div class="col-md-6 col-12 col-sm-12"> 
     <div class=" card-custom">
                                         <div class="card-header" data-toggle="collapse" data-target="#target1">
                                        <h3 class="card-title">
   Tổng tài sản: {{number_format(floatval($fin_input) +floatval($total_buy) , 0, ",", ".") }}  VND + Diện tích: {{$total_acreage}}   m<sup>2</sup></h3>
</div>
                                    
                                      <div style="text-align: left;" class="card-body collapse show"  id="target1" >


<!--                       @foreach($input as $row)
         <li class="submenu list-group-item"><h3><i class="fa fa-money" aria-hidden="true"></i> <a href="finance/detail/1/{{$row->type_id}}"> {{$row->type_name}} ( {{number_format(floatval($row->amount)  , 0, ",", ".") }} VND)</a></h3>
         </li>
         @endforeach

           <li class="submenu list-group-item"><a><h3><i class="fa fa-money" aria-hidden="true"></i><a href="finance/detail/sale"> Tiền bán hàng ( {{number_format(floatval($total_buy) , 0, ",", ".") }}  VND)</a></h3><hr>
          
         </li> -->
<div class="chartBtn"></div>
<canvas class="chart" style="max-height: 500px" id="log1"></canvas>


</div></div></div>

    <div class="col-md-6 col-12 col-sm-12"> 
     <div class=" card-custom">
                                         <div class="card-header" data-toggle="collapse" data-target="#target2">
                                        <h3 class="card-title">
   Các khoản chi 
{{number_format(floatval($fin_output) , 0, ",", ".") }}  VND</h3>
</div>
                                    
                                      <div style="text-align: left;" class="card-body collapse show"  id="target2" >

                   <!--    @foreach($output as $row)
         <li class="submenu list-group-item"><h3><i class="fa fa-money" aria-hidden="true"></i> <a href="finance/detail/2/{{$row->type_id}}"> {{$row->type_name}} ( {{number_format(floatval($row->amount)  , 0, ",", ".") }}  VND)</a></h3>
         </li>
         @endforeach -->

        <!--   <li class="submenu list-group-item"><h3><i class="fa fa-money" aria-hidden="true"></i><a href="finance/detail/daily"> Chi phí hoạt động ({{number_format(floatval($daily) , 0, ",", ".") }}  VND)</a> </h3>
          
         </li> -->
<!-- 
          <li class="submenu list-group-item"></li> -->

<div class="chartBtn"></div>
<canvas class="chart" style="max-height: 500px" id="log2"></canvas>

</div></div></div>

  <div class="col-md-12 col-12 col-sm-12"> 
    <br><hr><br>
     <div class=" card-custom">
                                         <div class="card-header" >
                                        <h3 class="card-title">
   Chênh lệch Thu - Chi: {{number_format(floatval($fin_input) +floatval($total_buy) - floatval($fin_output) , 0, ",", ".") }}  VND </h3>
</div>
      <div   id="barCon"  class="col-md-6 col-sm-12 col-12">

    <canvas   id="barChart"  style="min-height: 500px;width: 100%;"></canvas>
 </div>

          </div>
</div></div></div>
            <div id="content2" class="tab-pane  fade">

    <div class="content-camera">
          <div class="row row-content">
            <div class="row-title-proxy">
<div class="container mt-3">
    <div class="row">
        <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-0 col-sm-3  col-3 offset-sm-1 my-lg-0 my-2">
          <a href="/finance">
            <div class="card"> <img class="card-img-top"src="js-css/img/icon/finance.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Tài chính nội bộ</h7>
                    
                </div>
            </div>
          </a>
        </div>
<!-- 
         <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-0 col-sm-3  col-3 offset-sm-1 my-lg-0 my-2">
          <a href="/finance/tax">
            <div class="card"> <img class="card-img-top"src="js-css/img/icon/finance.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Tài chính thuế</h7>
                    
                </div>
            </div>
          </a>
        </div>
 -->
      <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-0 col-sm-3  col-3 offset-sm-1 my-lg-0 my-2">
          <a href="/finance/statistic">
            <div class="card"> <img class="card-img-top"src="js-css/img/icon/statistic.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Thống kê tài chính</h7>
                    
                </div>
            </div>
          </a>
        </div>

    <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-1 col-sm-3 col-3 offset-sm-1 my-lg-0 my-2">
          <a href="/finance/salary">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/bill.webp">
                <div class="card-body">
                            <h7 class="font-weight-bold">Danh sách lương</h7>
                     
                </div>
            </div>
          </a>
        </div>

        <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-1 col-sm-3 col-3 offset-sm-1 my-lg-0 my-2">
          <a href="/finance/human">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/gap.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Danh sách hoa hồng</h7>
                     
                </div>
            </div>
          </a>
        </div>

            <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-1 col-sm-3 col-3 offset-sm-1 my-lg-0 my-2">

          <a href="/">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/logout.png">
                <div class="card-body">
                            <h7 class="font-weight-bold"> Quay lại</h7>
                    
                </div>
            </div>
        </a>
        </div>


       
    </div></div>
</div></div>

 

</div></div>

<script type="text/javascript">

    menu_close()
</script>

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

     function switchChart(){
      var check = 
        document.getElementById("log1").style.display;
        if (check == "none"){

        document.getElementById("log1").style.display = "block";

        document.getElementById("log2").style.display = "block";

        }else{

        document.getElementById("log1").style.display = "none";

        document.getElementById("log2").style.display = "none";

        }
     }

     function auditChart(){
      

            var colors = ["#0074D9", "#FF4136", "#2ECC40", "#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]
            /* 3 donut charts */
            console.log("width")
            console.log(window.innerWidth )
            if (window.innerWidth >800 ){
            var size = window.innerWidth/125;

        document.getElementById("log1").style.display = "block";

        document.getElementById("log2").style.display = "block";

        document.getElementsByClassName("chartBtn")[0].innerHTML = '';

        document.getElementsByClassName("chartBtn")[1].innerHTML = '';
           }else{
            var size = window.innerWidth/25;
            $('.collapse').removeClass('show');

        document.getElementById("log1").style.display = "none";

        document.getElementById("log2").style.display = "none";

        document.getElementsByClassName("chartBtn")[0].innerHTML = '<button onclick = "switchChart()"  class="btn btn-model" id="camera-add">&nbsp;&nbsp; Biểu đồ &nbsp;&nbsp;</button>';

        document.getElementsByClassName("chartBtn")[1].innerHTML = '<button onclick = "switchChart()" class="btn btn-model" id="camera-add">&nbsp;&nbsp; Biểu đồ &nbsp;&nbsp;</button>';
        switchChart()
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
            
            @foreach($input as $row)
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                labels.push("{{$row->type_name}}: " +formatMoney({{floatval($row->amount)}}) + "VND");
                labels2.push("{{$row->type_name}}");
                methods.push(parseFloat("{{floatval($row->amount)}}"))

            @endforeach


   labels.push("Tiền bán hàng " +formatMoney({{floatval($total_buy)}}) + " VND");
                labels2.push("Tiền bán hàng");
                methods.push(parseFloat("{{floatval($total_buy)}}"))

            console.log(methods, labels)


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
             
            @foreach($output as $row)
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                labels.push("{{$row->type_name}}: " +formatMoney({{floatval($row->amount)}}) + " VND");
                labels2.push("{{$row->type_name}}");
                methods.push(parseFloat("{{floatval($row->amount)}}"))

            @endforeach

            var daily = parseFloat("{{$daily}}")

            labels.push("Chi phí hàng tháng : " +formatMoney(daily) + " VND");
            methods.push(daily)
            labels2.push("Chi phí hàng tháng  : " );
        
           
          

            console.log(methods, labels)
         
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
     auditChart()
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

  function Bars(){

            if (window.innerWidth <800 ){
            var size = 15;

          }else{

            var size = 20;
          }
        // $('#barChart').remove();
        // $('#barCon').append('<canvas  height="500" + id="barChart"><canvas>');
       
             $.ajax({
            type: "GET",
            url: "/icon/finance-line",
            success: function (response) {
                response = JSON.parse(response)
              console.log(response)

              time = response[0];
              done = response[1];
              dept = response[2]

var options = {
    responsive: true,
   tooltips: {
     callbacks: {
            label: (tooltipItem, data) => {
              // data for manipulation
              return formatMoney(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]) + "VND";
            },
          },

      mode: 'index'
   },
    stacked: false,
};

            var ctx = document.getElementById("barChart");
            var myChart = new Chart(ctx, {
              type: 'line',
              data: {
                labels: time,
                datasets: [{
                  label: 'Khoản thu dự kiến',
                 data : done,
                borderColor: 'red'
                },
                {
                  label: 'Khoảng thu thực',
                  data: dept,
                borderColor: 'blue'
                }
                ]
              },
              options: options
            });
            Chart.defaults.global.defaultFontColor = '#dcf3ff';

         



        }

          });
     }
        // Bars();

  </script>


@endsection
