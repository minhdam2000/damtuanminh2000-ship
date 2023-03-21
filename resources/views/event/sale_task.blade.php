@extends('layouts.index')
@section('content')
	<div class="content-camera">
		<div class="header-content">
			<div class="header-content-left">
				<h6>Quản lý sự kiện</h6>
			</div>
			<div class="header-content-right" style="display: inline;">
				<a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i> Home </h6></a>
				/
				<h6 class="display-inline">Quản lý sự kiện</h6>
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
      <li class="nav-item margin_center active">
          <a id="tab2" class="nav-link  color-a" 
          data-toggle="tab" href="#content1">Tuần này</a>
      </li>
     <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" href="#content2">Tất cả </a>
      </li>
    


    </ul>  
    <hr>

        <div class="tab-content">
  
             <div id="content1" class="tab-pane active">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <h3>Tiện độ công việc </h3>
                  <table id="example1" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th><center><i class="fa fa-bell text-warning"></i></center></th>
                        <th>Mã BDS </th>
                        <th>Tên khách hàng </th>
                        <th>Số điện thoại </th>
                        <th>Việc đến hạn </th>
                        <th>Ngày đến hạn </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($task_near as $event)
                        <tr class="color-add">
                          <td><center><i class="fa fa-exclamation-triangle text-warning"></i></center></td>
                          <td><a href="/sale/view-by-zone/{{$event->id}}">{{$event->zname}}</a></td>
                          <td>{{$event->cname}}</td>
                          <td>{{$event->cphone}}</td>
                          <td>{{$event->sname}}</td>
                          <td>{{$event->date}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                  <h3>Tiện độ thanh toán</h3>
                  <table id="example2" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th><center><i class="fa fa-bell text-warning"></i></center></th>
                        <th>Mã BDS </th>
                        <th>Tên khách hàng </th>
                        <th>Số điện thoại </th>
                        <th>Nộp đợt </th>
                        <th>Số tiền</th>
                        <th>Ngày đến hạn </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($pay_near as $event)
                        <tr class="color-add">
                          <td><center><i class="fa fa-exclamation-triangle text-warning"></i></center></td>
                          <td><a href="/sale/view-by-zone/{{$event->id}}">{{$event->zname}}</a></td>
                          <td>{{$event->cname}}</td>
                          <td>{{$event->cphone}}</td>
                          <td>Đợt {{$event->step}}</td>
                          <td>{{number_format(floatval($event->money), 0, ",", ".") }}  VND</td>
                          <td>{{$event->date}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>

            <div id="content2" class="tab-pane">
          <h3>Bộ lọc thời gian</h3>
 <div class="form-inline">
  <label for="example-datetime-local-input" class="col-2 col-md-1 col-form-label">Từ </label>
  <div class="col-5 col-md-3">
    <input class="form-control" type="date" name="dt1" id="min" value="">
  </div>
  <label for="example-datetime-local-input" class="col-2 col-md-1 col-form-label">Đến </label>
  <div class="col-5 col-md-3">
    <input class="form-control" type="date" name="dt2" id="max" value="">


</div>
</div>
<br><hr><br>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <h3>Tiện độ công việc </h3>
                  <table id="example3" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th><center><i class="fa fa-bell text-warning"></i></center></th>
                        <th>Mã BDS </th>
                        <th>Tên khách hàng </th>
                        <th>Số điện thoại </th>
                        <th>Việc đến hạn </th>
                        <th>Ngày đến hạn </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($task as $event)
                        <tr class="color-add">
                          <td><center><i class="fa fa-exclamation-triangle text-warning"></i></center></td>
                          <td><a href="/sale/view-by-zone/{{$event->id}}">{{$event->zname}}</a></td>
                          <td>{{$event->cname}}</td>
                          <td>{{$event->cphone}}</td>
                          <td>{{$event->sname}}</td>
                          <td>{{$event->date}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                  <h3>Tiện độ thanh toán</h3>
                  <table id="example4" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th><center><i class="fa fa-bell text-warning"></i></center></th>
                        <th>Mã BDS </th>
                        <th>Tên khách hàng </th>
                        <th>Số điện thoại </th>
                        <th> Nộp đợt </th>
                        <th>Số tiền</th>
                        <th>Ngày đến hạn </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($pay as $event)
                        <tr class="color-add">
                          <td><center><i class="fa fa-exclamation-triangle text-warning"></i></center></td>
                          <td>{{$event->zname}}</td>
                          <td>{{$event->cname}}</td>
                          <td>{{$event->cphone}}</td>
                          <td>Đợt {{$event->step}}</td>
                          <td>{{number_format(floatval($event->money), 0, ",", ".") }}  VND</td>
                          <td>{{$event->date}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>

          <button  class="btn btn-model"><a href="/icon/sale/" > Quay lại</a></button>
        </div>
      </div>
    </div>
    </div>
	<!-- end model --->

	<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
    </div>
    <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
     </div>

  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
  <script>
    $('#example1').DataTable();
    $('#example2').DataTable();
    $('#example3').DataTable();
    $('#example4').DataTable();


    $(document).ready(function(){
    $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');

        $("#"+this.href.split("#")[1]).addClass('active');
        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });
});

    var minDate, maxDate;
 
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min =  document.getElementById("min").value
        var max = document.getElementById("max").value

        if(settings.sTableId == "example3"){

        var date = data[3];
      }else{

        var date = data[6];
      }
        console.log(settings.sTableId)

        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    // Create date inputs
    minDate = document.getElementById("min").value
    minDate = document.getElementById("max").value
 
    // DataTables initialisation
    var table = $('#example3').DataTable();
 
    var table2 = $('#example4').DataTable();
 
    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
        table2.draw();
    });
});

  </script>


@endsection
