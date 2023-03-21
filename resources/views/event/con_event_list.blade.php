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
          data-toggle="tab" href="#content3"> Việc được giao </a>
      </li>


    
     <li class="nav-item margin_center">
          <a id="tab5" class="nav-link color-a" 
          data-toggle="tab" href="#content4"> Tiến trình xây dựng</a>
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
                          <td>{{$event->description}}</td>
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
                  <table id="example2" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th><center><i class="fa fa-bell text-warning"></i></center></th>
                        <th>Mã bất động sản </th>
                        <th>Tiến độ </th>
                        <th>Minh chứng</th>
                        <th>Thời gian</th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($contribute as $contribute)
                        <tr class="color-add">
                          <td><center><i class="fa fa-exclamation-triangle text-warning"></i></center></td>
                          <td>{{$contribute->name}}</td>
                          <td>{{$contribute->des}}</td>
                          <td><a href="{{$contribute->url}}" target="blank_"><img style="width: 300px;height: auto" src="{{$contribute->url}}"></a></td>
                          <td><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; {{$contribute->updated_at}}</td>
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
    $('#example1').DataTable();
    $('#example2').DataTable();
    $('#example3').DataTable();


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
  </script>


@endsection
