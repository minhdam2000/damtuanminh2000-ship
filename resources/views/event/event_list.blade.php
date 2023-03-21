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
          data-toggle="tab" href="#content1">Sự kiện chung</a>
      </li>
     <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" href="#content2">Sự kiện cá nhân </a>
      </li>
    
     <li class="nav-item margin_center">
          <a id="tab4" class="nav-link color-a" 
          data-toggle="tab" href="#content3">Công việc đến hạn </a>
      </li>


     <li class="nav-item margin_center">
          <a id="tab5" class="nav-link color-a" 
          data-toggle="tab"  href="#content4">Giao dịch đến hạn </a>
      </li>


    </ul>  
    <hr>

        <div class="tab-content">

          <div id="content1" class="tab-pane  in active">
          
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="example1" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th><center><i class="fa fa-bell text-warning"></i></center></th>
                        <th>Sự kiện </th>
                        <th>Mô tả </th>
                        <th>Thời gian</th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($group_events as $event)
                        <tr class="color-add">
                          <td><center><i class="fa fa-exclamation-triangle text-warning"></i></center></td>
                          <td>{{$event->title}}</td>
                          <td>{{$event->description}}</td>
                          <td><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; {{$event->created_at}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>

            <div id="content2" class="tab-pane">
          
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="example2" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th><center><i class="fa fa-bell text-warning"></i></center></th>
                        <th>Sự kiện </th>
                        <th>Mô tả </th>
                        <th>Thời gian</th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($personal_events as $event)
                        <tr class="color-add">
                          <td><center><i class="fa fa-exclamation-triangle text-warning"></i></center></td>
                          <td>{{$event->title}}</td>
                          <td>{!! $event->description !!}</td>
                          <td><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; {{$event->created_at}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
<div id="content3" class="tab-pane ">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="scroll-auto">
                    <table id="example3" class="nvr-table">
                      <thead>
                      <tr class="thead">
                          <th>Tên việc  </th>
                          <th>Người giao</th>
                          <th>Người phụ trách</th>
                          <th>Bắt đầu </th>
                          <th>Kết thúc</th>
                          <th>Chi tiết</th>
                        </tr>
                      </thead>
                      <tbody class="tbody">
                        @foreach($job as $job)
                        <tr class="color-add">
                            <td id="jname{{$job->id}}">{{$job->name}}</td>
                            <td>
                              <?php
                                $uif = DB::table("users")->where("id",$job->user_id)->first();
                              ?>
                              <span id="juname{{$job->id}}"><?=$uif->name?></span>
                              <span style="display: none" id="juemail{{$job->id}}"><?=$uif->email?></span>
                              <span style="display: none" id="juphone{{$job->id}}"><?=$uif->phone?></span>

                            </td>
                            <td id="jnames{{$job->id}}">{{$job->names}}</td>
                            <td id="jstartdate{{$job->id}}">{{$job->start_date}}</td>
                            <td id="jenddate{{$job->id}}">{{$job->end_date}}</td>
                           <td>
                            <a class="job-update preview" href="/job-list"><img src="/js-css/img/icon/write.png"></a>
                             </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
        </div></div>
             <div id="content4" class="tab-pane">
          
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <h3>Tiện độ công việc </h3>
                  <table id="example4" class="nvr-table">
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
                          <td>{{$event->zname}}</td>
                          <td>{{$event->cname}}</td>
                          <td>{{$event->cphone}}</td>
                          <td>{{$event->sname}}</td>
                          <td>{{$event->date}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                  <h3>Tiện độ thanh toán</h3>
                  <table id="example5" class="nvr-table">
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
  

    $(document).ready(function(){
        $('#example1').DataTable( {
        "order": [[ 4, "desc" ]]
    });
    $('#example2').DataTable( {
        "order": [[ 4, "desc" ]]
    });
    $('#example3').DataTable( {
        "order": [[ 4, "desc" ]]
    });
    $('#example4').DataTable( {
        "order": [[ 4, "desc" ]]
    });
    $('#example5').DataTable( {
        "order": [[ 4, "desc" ]]
    });


    $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');

        //add the active class to the link we clicked
        $("#"+this.href.split("#")[1]).addClass('active');

        // event.preventDefault();
    });
});
  </script>


@endsection
