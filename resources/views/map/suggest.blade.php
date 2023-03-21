@extends('layouts.index')
@section('content')
<style type="text/css">
  
.bootstrap-select{
  z-index: 100
}  
.badge {
  border-radius: 50%;
  background-color: red;
  color: white;
}
h3{
  color: red;
}
</style>
  <div class="content-camera">
    <div class="header-content">
      <div class="header-content-left">
        <h6>Quản trị công việc </h6>
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
        
       
          <div class="clearfix"></div>
        </div>
        </div>
        <h4>Thống kê dự án {{$project->name}}</h4>
  <ul class="nav nav-tabs" id="tabs" role="tablist">

       <li class="nav-item margin_center">
          <a id="tab1" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content3">Thống kê theo căn</a>
      </li>

       <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content4">Thống kê theo diện tich</a>
      </li>
       <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content0">Thống kê theo Click</a>
      </li>

       <li class="nav-item margin_center">
          <a id="tab4" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content1">Thống kê theo tìm kiếm</a>
      </li>



    </ul>  


        <div class="tab-content">

        
    <div id="content3" class="tab-pane in active">
<table id="zone-statistic" class="nvr-table">
  <thead>
      <tr class="thead">
          <th>Khu vực</th>
          <th>Tổng số căn</th>
          <th>Diện tích</th>
          <th>Số căn còn</th>
          <th>Số căn đã bán</th>
          <th>Số căn đã thanh toán</th>
          <th>Doanh thu dự kiến</th>
          <th>Doanh thu thực</th>
          <th>Số tiền đã thu</th>
          <th>Số tiền còn nợ</th>
        </tr>
      </thead> 
       <tbody >

                        @foreach($zone as $zone)
                        <?php
                            $sell = $zone->total - $zone->nonsell;
                        ?>
                        <tr>
                          <td>{{$zone->bid}}  </td>

                          <td>{{$zone->total}}    </td>
                          <td>{{$zone->acreage}} m<sup>2</sup>  </td>
                          <td>{{$zone->nonsell}} ({{round($zone->nonsell/$zone->total*100,2) }}%)    </td>
                          <td>{{$sell}} ({{round($sell/$zone->total*100,2) }}%)    </td>
                          <td>{{$zone->done1}} ({{round($zone->done1/$zone->total*100,2) }}%)    </td>
                          <td>{{number_format($zone->final_price, 0, ",", ".") }} VND </td>
                          @if($zone->real_price > 0)
                          <td>{{number_format($zone->real_price, 0, ",", ".") }} VND </td>
                          @else

                          <td>{{number_format($zone->final_price, 0, ",", ".") }} VND </td>
                          @endif
                          <td>{{number_format($zone->done, 0, ",", ".") }} VND </td>
                          <td>{{number_format($zone->dept, 0, ",", ".") }} VND </td>

                        </tr>

                        @endforeach
        </tbody>
        @if($zone_total->total > 0)
     </table>
                      <table class="nvr-table">
  <thead>
      <tr class="thead">
          <th>Tổng</th>
          <th>Tổng số căn</th>
          <th>Diện tích</th>
          <th>Số căn còn</th>
          <th>Số căn đã bán</th>
          <th>Số căn đã thanh toán</th>
          <th>Doanh thu dự kiến</th>
          <th>Doanh thu thực</th>
          <th>Số tiền đã thu</th>
          <th>Số tiền còn nợ</th>
        </tr>
      </thead> 
  <tbody >
  <tr>
      <td>  </td>
                        <?php
                            $sell = $zone_total->total - $zone_total->nonsell;
                        ?>

      <td>{{$zone_total->total}}    </td>
      <td>{{$zone_total->acreage}}   m<sup>2</sup> </td>
      <td>{{$zone_total->nonsell}} ({{round($zone_total->nonsell/$zone_total->total*100,2) }}%)    </td>
      <td>{{$sell}} ({{round($sell/$zone_total->total*100,2) }}%)    </td>
      <td>{{$zone_total->done1}} ({{round($zone_total->done1/$zone_total->total*100,2) }}%)    </td>
      <td>{{number_format($zone_total->final_price, 0, ",", ".") }} VND </td>
      @if($zone_total->real_price > 0)
      <td>{{number_format($zone_total->real_price, 0, ",", ".") }} VND </td>
      @else

      <td>{{number_format($zone_total->final_price, 0, ",", ".") }} VND </td>
      @endif
      <td>{{number_format($zone_total->done, 0, ",", ".") }} VND </td>
      <td>{{number_format($zone_total->dept, 0, ",", ".") }} VND </td>

                        </tr>
        
        </tbody>
                      </table>
                      @endif
</div>


<div id="content4" class="tab-pane fade">
<table id="zone-statistic2" class="nvr-table">
  <thead>
      <tr class="thead">
          <th>Khu vực</th>
          <th>Tổng diện tích</th> 
          <th>Diện tích đã bán</th>
          <th>Diện tích còn lại</th>
          <th>Diện tích đã thanh toán</th>
          <th>Doanh thu dự kiến</th>
          <th>Doanh thu thực</th>
          <th>Số tiền đã thu</th>
          <th>Số tiền còn nợ</th>
        </tr>
      </thead> 
       <tbody >

                        @foreach($acreage as $zone)
                        <?php
                            $sell = $zone->total - $zone->nonsell;
                        ?>
                        <tr>
                          <td>{{$zone->bid}}  </td>

                          <td>{{$zone->total}}   m<sup>2</sup> </td>
                         
                          <td>{{$sell}} m<sup>2</sup>({{round(floatval($sell)/$zone->total*100,2) }}%)    </td>


                          <td>{{$zone->nonsell}} m<sup>2</sup>({{round(floatval($zone->nonsell)/$zone->total*100,2) }}%)    </td>
                          
                          <td>{{$zone->done1}} m<sup>2</sup> ({{round($zone->done1/$zone->total*100,2) }}%)    </td>
                          <td>{{number_format($zone->final_price, 0, ",", ".") }} VND </td>
                          @if($zone->real_price > 0)
                          <td>{{number_format($zone->real_price, 0, ",", ".") }} VND </td>
                          @else

                          <td>{{number_format($zone->final_price, 0, ",", ".") }} VND </td>
                          @endif
                          <td>{{number_format($zone->done, 0, ",", ".") }} VND </td>
                          <td>{{number_format($zone->dept, 0, ",", ".") }} VND </td>

                        </tr>

                        @endforeach
        </tbody>

        @if($acreage_total->total > 0)
     </table>
                      <table class="nvr-table">
  <thead>
      <tr class="thead">
          <th>Tổng</th>
          <th>Tổng diện tích</th>
          <th>Diện tích đã bán</th>
          <th>Diện tích còn lại</th>
          <th>Diện tích đã thanh toán</th>
          <th>Doanh thu dự kiến</th>
          <th>Doanh thu thực</th>
          <th>Số tiền đã thu</th>
          <th>Số tiền còn nợ</th>
        </tr>
      </thead> 
  <tbody >
  <tr>
      <td>  </td>
                        <?php
                            $sell = $acreage_total->total - $acreage_total->nonsell;
                        ?>

      <td>{{$acreage_total->total}}     m<sup>2</sup> </td>
      <td>{{$sell}}   m<sup>2</sup>({{round($sell/$acreage_total->total*100,2) }}%)    </td>
      <td>{{$acreage_total->nonsell}} m<sup>2</sup>({{round(floatval($acreage_total->nonsell)/$acreage_total->total*100,2) }}%)    </td>
      <td>{{$acreage_total->done1}}   m<sup>2</sup>({{round($acreage_total->done1/$acreage_total->total*100,2) }}%)    </td>
      <td>{{number_format($acreage_total->final_price, 0, ",", ".") }} VND </td>
      @if($zone_total->real_price > 0)
      <td>{{number_format($acreage_total->real_price, 0, ",", ".") }} VND </td>
      @else

      <td>{{number_format($acreage_total->final_price, 0, ",", ".") }} VND </td>
      @endif
      <td>{{number_format($acreage_total->done, 0, ",", ".") }} VND </td>
      <td>{{number_format($acreage_total->dept, 0, ",", ".") }} VND </td>

                        </tr>
        
        </tbody>
                      </table>
                      @endif
</div>



 <div id="content0" class="tab-pane  fade">
<br><hr><br>
              <div class="row">

       
<div class="col-md-12 col-sm-12 col-12">


  <table id="input-table" class="nvr-table">
    <thead>
    <tr class="thead">
     
        <th> </th>
        <th> Tổng số tìm kiếm</th>
        <th> Diện tích trung bình </th>
        <th> Đơn giá trung bình  </th>
        <th> Tổng giá trung bình  </th>
      </tr>
    </thead>

      <tbody class="tbody">
      <tr>
        <td> Giá trị trung binh</td>
        <td> {{round($click_sum->count,2)}} </td>
        <!-- <td> {{$click_sum->acreage1}}  m <sup>2</sup></td> -->
        <td> {{round($click_sum->acreage2,2)}}  m <sup>2</sup></td>
        <td> {{number_format(round($click_sum->unit_price,2), 0, ",", ".")}} VND</td>
        <td> {{number_format(round($click_sum->final_price,2), 0, ",", ".")}} VND</td>
      </tr>
    </tbody>
  </table>


    <h4>Chi tiết</h4>
  <table id="detailTable" class="nvr-table" >
    <thead>
    <tr class="thead">
     
        
        <th> Tên khu vực</th>
        <th> Tổng số tìm kiếm</th>
        <th> Diện tích trung bình </th>
        <th> Đơn giá trung bình  </th>
        <th> Tổng giá trung bình  </th>
      </tr>
    </thead>

      <tbody class="tbody">
        @foreach($click_bid as $bid)
      <tr>
        <td> {{$bid->name}}</td>
        <td> {{$bid->count}}</td>
        <!-- <td> {{$bid->acreage1}}  m <sup>2</sup></td> -->
        <td> {{round($bid->acreage2,2)}}  m <sup>2</sup></td>
        <td> {{number_format(round($bid->unit_price,2), 0, ",", ".")}} VND</td>
        <td> {{number_format(round($bid->final_price,2), 0, ",", ".")}} VND</td>
      </tr>
        @endforeach
    </tbody>
  </table>

</div>
</div>
</div>
 <div id="content1" class="tab-pane  in fade">
               <table id="input-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                         
                            <th> </th>
                            <th> Đơn giá thấp</th>
                            <th> Đơn giá cao</th>
                            <th> Tổng giá thấp</th>
                            <th> Tổng giá cao</th>
                            <th> Diện tích thấp nhất   </th>
                            <th> Diện tích cao nhất   </th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                        <tr>
                          
                            <td> Số lượng tìm kiếm</td>
                            <td> {{number_format(round($overall->unit_price_low,2), 0, ",", ".")}} VND</td>
                            <td> {{number_format(round($overall->unit_price_high,2), 0, ",", ".")}} VND</td>
                            <td> {{number_format(round($overall->total_price_low,2), 0, ",", ".")}} VND</td>
                            <td> {{number_format(round($overall->total_price_high,2), 0, ",", ".")}} VND</td>
                            <td> {{round($overall->area_low,2)}}   </td>
                            <td> {{round($overall->area_high,2)}} </td>

                        </tr>
                        <tr>
                            <td> Giá trị trung binh</td>
                            <td> {{number_format(round($overall2->unit_price_low,2), 0, ",", ".")}} VND</td>
                            <td> {{number_format(round($overall2->unit_price_high,2), 0, ",", ".")}} VND</td>
                            <td> {{number_format(round($overall2->total_price_low,2), 0, ",", ".")}} VND</td>
                            <td> {{number_format(round($overall2->total_price_high,2), 0, ",", ".")}} VND</td>
                            <td> {{round($overall2->area_low,2)}}   m <sup>2</sup></td>
                            <td> {{round($overall2->area_high,2)}} m <sup>2</sup></td>
                        </tr>
                        </tbody>
                      </table>

            
<hr>


<hr>
                     <div   id="barCon"  class="col-md-12 col-sm-12 col-12">

    <canvas  height="500"   id="barChart"></canvas>
 </div>
<hr>
<h4>Thống kê tìm kiếm theo đơn giá</h4>
<hr>
                     <div   id="barCon"  class="col-md-12 col-sm-12 col-12">

    <canvas   height="800"  id="barChart2"></canvas>
 </div>
<hr>
<h4>Thống kê tìm kiếm theo tổng giá</h4>
<hr>
                     <div   id="barCon"  class="col-md-12 col-sm-12 col-12">

    <canvas    height="800" id="barChart3"></canvas>
 </div>


      </div>


<script>
  function close_form(){
      var inputs = document.getElementsByClassName('create-user');
      for(i=0; i<inputs.length; i++){
        inputs[i].value = '';
      }
      document.getElementsByClassName('notification')[0].innerHTML ='';
      document.getElementsByClassName('notification')[0].classList.remove('notification-color');
    }
</script>


<script src="/js-css/js/bootstrap-select.min.js"></script>
<script src="/js-css/js/ckeditor/ckeditor.js"></script>

  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>

<script>
var table1 = $('#detailTable').DataTable();

 $('#zone-statistic').DataTable({
                    "order": [[ 3, "desc" ]]
                })
  $('#zone-statistic2').DataTable({
                    "order": [[ 3, "desc" ]]
                })

    function snakeModel(){
      $("#create-user").addClass("shake-model");
            setTimeout(function() { 
                $("#create-user").removeClass("shake-model");
            }, 1000);
        }




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

    function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }
    

        function Bars(type,id){

            if (window.innerWidth <800 ){
            var size = 15;

          }else{

            var size = 20;
          }
        $('#barChart').remove();
        $('#barCon').append('<canvas  height="500" + id="barChart"><canvas>');
       
             $.ajax({
            type: "GET",
            url: "/zone-suggest-json/{{$id}}",
            success: function (response) {
              // reponse = JSON.parse(response)
              console.log(response[0])

  methods = []
            labels = []
          var i = 0;
          var left = 0;
          var right = 0;
           for (i = 0;i < response[0].length;i++){
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                left = i * 300;
                right = (i+1) *300
                labels.push(left + " - "+ right + " m2");
                methods.push(response[0][i])
            }

            var ctx = document.getElementById("barChart");
            var myChart = new Chart(ctx, {
              type: 'horizontalBar',
              data: {
                labels: labels,
                datasets: [
                {
                  label: 'Số lượng tìm kiếm',
                  data: methods,
                backgroundColor: '#dc3545',
                  borderWidth: 1
                }
                ]
              },
              options: {
    maintainAspectRatio: false,
                responsive: true,
                scales: {
                  xAxes: [{
            stacked: true,
                     scaleLabel: {
                        display: true,
                        labelString: ''
                      },
                    ticks: {
                      maxRotation: 90,
                      minRotation: 0,
                fontSize: size
                    }
                  }],
                  yAxes: [{
            stacked: true,
                    ticks: {
                      beginAtZero: false,
                fontSize: size
                    }
                  }]
                }
              }
            });
  methods = []
            labels = []
  for (i = 0;i < response[1].length;i++){
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                left = formatMoney(i * 1000000);
                right = formatMoney((i+1) *1000000);
                labels.push(left + " - "+ right + " VND");
                methods.push(response[1][i])
            }

            var ctx = document.getElementById("barChart2");
            var myChart = new Chart(ctx, {
              type: 'horizontalBar',
              data: {
                labels: labels,
                datasets: [
                {
                  label: 'Số lượng tìm kiếm',
                  data: methods,
                backgroundColor: 'blue',
                  borderWidth: 1
                }
                ]
              },
              options: {
    maintainAspectRatio: false,
                responsive: true,
                scales: {
                  xAxes: [{
            stacked: true,
                     scaleLabel: {
                        display: true,
                        labelString: ''
                      },
                    ticks: {
                      maxRotation: 90,
                      minRotation: 0,
                fontSize: size
                    }
                  }],
                  yAxes: [{
            stacked: true,
                    ticks: {
                      beginAtZero: false,
                fontSize: size
                    }
                  }]
                }
              }
            });

  methods = []
            labels = []
              for (i = 0;i < response[2].length;i++){
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                left = formatMoney(i * 300000000);
                right = formatMoney((i+1) *300000000);
                labels.push(left + " - "+ right + " VND");
                methods.push(response[2][i])
            }

            var ctx = document.getElementById("barChart3");
            var myChart = new Chart(ctx, {
              type: 'horizontalBar',
              data: {
                labels: labels,
                datasets: [
                {
                  label: 'Số lượng tìm kiếm',
                  data: methods,
                backgroundColor: 'green',
                  borderWidth: 1
                }
                ]
              },
              options: {
    maintainAspectRatio: false,
                responsive: true,
                scales: {
                  xAxes: [{
            stacked: true,
                     scaleLabel: {
                        display: true,
                        labelString: ''
                      },
                    ticks: {
                      maxRotation: 90,
                      minRotation: 0,
                fontSize: size
                    }
                  }],
                  yAxes: [{
            stacked: true,
                    ticks: {
                      beginAtZero: false,
                fontSize: size
                    }
                  }]
                }
              }
            });


            Chart.defaults.global.defaultFontColor = 'black';

          



        }

          });
     }
        Bars(0,0);
 $(document).ready(function(){
    $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');
        $("#"+this.href.split("#")[1]).addClass('active');
        // type = 
         
    });
});
  </script>
@endsection
