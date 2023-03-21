@extends('layouts.index')
@section('content')
<style type="text/css">
  
  .badge {
  border-radius: 50%;
  background-color: red;
  color: white;
}

</style>
	<div class="content-camera">
		<div class="header-content">
			
			<div class="header-content-right" style="display: inline;">
				<a href="/"><h6 class="display-inline link-active">
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
      <li class="nav-item margin_center">
          <a onclick="Noti(1)"  id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#content1"> Sự kiện bán hàng
             @if($sale_count > 0)
                     <span class="badge">{{$sale_count}}</span>
                    @endif </a>
      </li>
     <li class="nav-item margin_center">
          <a onclick="Noti(3)" id="tab3" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content3">Sự kiện pháp lý  
             @if($system_count > 0)
                     <span class="badge">{{$system_count}}</span>
                    @endif </a>
      </li>

      <li class="nav-item margin_center">
          <a onclick="Noti(2)"  id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content2">Sự kiện thi công
             @if($contribute_count > 0)
                     <span class="badge">{{$contribute_count}}</span>
                    @endif 
                    </a>
      </li>     <li class="nav-item margin_center">
          <a id="tab5" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content4">Khác</a>
      </li>
    
    </ul>  
    <hr>
        <div class="tab-content">

          <div id="content1" class="tab-pane  in active">
          <div class="active-view" id="menu1">
			          <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="example1" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th><center><i class="fa fa-bell text-warning"></i></center></th>
                        <th>Tên sự kiện </th>
                        <th>Mô tả </th>
                        <th>Người thực hiện </th>
                        <th>Thời gian</th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($sale_events as $event)
                          @if($event->seen == 0)
                            <tr style="background-color: dodgerblue;">
                          @else
                        <tr class="color-add">
                          @endif
	                        <td><center><i class="fa fa-exclamation-triangle text-warning"></i></center></td>
                          <td>{{$event->title}}</td>
                          <td>{{$event->description}}</td>
                          <td>{{$event->staff_name}}
                            <br>{{$event->accountant_name}}
                          </td>
	                        <td><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; {{$event->time}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
          </div>

            <div id="content2" class="tab-pane  fade">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="example2" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th><center><i class="fa fa-bell text-warning"></i></center></th>
                        <th>Tên sự kiện </th>
                        <th>Mô tả </th>
                        <th>Người thực hiện </th>
                        <th>Thời gian</th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($contribute_events as $event)
                        @if($event->seen == 0)
                            <tr style="background-color: dodgerblue;">
                          @else
                        <tr class="color-add">
                          @endif
                          <td><center><i class="fa fa-exclamation-triangle text-warning"></i></center></td>
                          <td>{{$event->title}}</td>
                          <td>{{$event->description}}</td>
                          <td>{{$event->con_name}}</td>
                          <td><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; {{$event->time}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
          </div>

            <div id="content3" class="tab-pane  fade">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="example3" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th><center><i class="fa fa-bell text-warning"></center></i></th>
                        <th>Tên sự kiện </th>
                        <th>Mô tả </th>
                        <th>Người thực hiện </th>
                        <th>Thời gian</th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($system_events as $event)
                        @if($event->seen == 0)
                            <tr style="background-color: dodgerblue;">
                          @else
                        <tr class="color-add">
                          @endif
                          <td><center><i class="fa fa-exclamation-triangle text-warning"></i></center></td>
                          <td>{{$event->title}}</td>
                          <td>{!! $event->description !!}</td>
                          <td>{{$event->email}}</td>
                          <td><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; {{$event->time}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
          </div>

            <div id="content4" class="tab-pane  fade">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="example4" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th><i class="fa fa-bell text-warning"></i></th>
                        
                        <th>Tên sự kiện </th>
                        <th>Mô tả </th>
                        <th>Thời gian</th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($other_events as $event)
                        <tr class="color-add">
                          <td><center><i class="fa fa-exclamation-triangle text-warning"></i></center></td>
                          <td><center><i class="fa fa-exclamation-triangle text-warning"></i></center></td>
                          <td>{{$event->content}}</td>
                          <td><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp; {{$event->time}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
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
  <script>   $('#example1').DataTable( {
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


    $(document).ready(function(){
    $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');
        $("#"+this.href.split("#")[1]).addClass('active');
        $(this).find(".badge").html("")
        


        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });
});

 function Noti(type){
      $.ajax({
              url: 'event_noti/'+type,
              success: function(data) {
                console.log(data);  
                 }
            });
 }

  </script>

@endsection
