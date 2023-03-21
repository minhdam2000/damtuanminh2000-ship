@extends('layouts.index')
@section('content')
	<div class="content-camera">
		<div class="header-content">
			<div class="header-content-left">
				<h6>Notification Management</h6>
			</div>
			<div class="header-content-right" style="display: inline;">
				<a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i> Home </h6></a>
				/
				<h6 class="display-inline">Notification Management</h6>
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
        
        <div class="tab-list">
          <div class="title-list-user">
            <i class="fa fa-list" aria-hidden="true"></i> &nbsp;List of Events
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="tab-content1">
          <div class="row-content-nvr active-view" id="menu1">
			     <form action="removeadmin" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="example" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th><center><i class="fa fa-bell text-warning"></i></center></th>
                        <th>Event</th>
                        <th>time occurred</th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($eventList as $event)
                        <tr class="color-add">
	                        <td><center><i class="fa fa-exclamation-triangle text-warning"></i></center></td>
	                        <td>{{$event->event}}</td>
	                        <td><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; {{$event->created_at}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <!-- /.table -->
              </form>
          </div>
        </div>
    </div>
	<!-- end model --->

	<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
    </div>
    <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
     </div>

  <script>
    $('#example').DataTable({
        "paging":   false,
        "info":     false,
        "searching": false
      });
  </script>

@endsection
