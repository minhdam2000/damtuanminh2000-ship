@extends('../layouts/index')
@section('content')
    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6>Recycle Bin</h6>
            </div>
            <div class="header-content-right display-inline">
                <a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i> Home </h6></a>
                /
                <h6 class="display-inline">Recycle Bin</h6>
            </div>
        </div>

        <div class="">
          <div class="session">
            @if(Session::has('notification'))
              <input hidden="" notifi="{{Session::get('notification')}}" value="1" id="notice_success">
            @endif
            @if(Session::has('warning'))
              <input hidden="" notifi="{{Session::get('warning')}}" value="1" id="notice_warning">
            @endif
          </div>
          @foreach($all_proxies as $proxy)
        	<div class="row row-content">
        		<div class="row-title-proxy">
        			<div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;{{$proxy->proxy_name}}</div>
        		</div>
                @foreach($all_cameras as $camera)
                  @if($camera->proxy_id == $proxy->id)
              		<div class="col-content-cam">
                    <div class="info-cam">
                      <label><center> {{$camera->cam_name}}</center></label>
                      <label class="label-port"><i class="fa fa-key text-blue" aria-hidden="true"></i> &nbsp;RTSP Port: {{$camera->cam_rtspport}}</label>
                      <label class="label-port"><i class="fa fa-key text-blue" aria-hidden="true"></i> &nbsp;ONVIF Port: {{$camera->cam_onvifport}}</label>
                      <hr style="margin-bottom: 0.5rem;">
                      <div class="box-flex">
                        <div class="content-cam">
                          <label>{{$camera->cam_name}}</label>
                          <label>{{$camera->cam_pass}}</label>
                          <label>{{$camera->cam_rtspport}}</label>
                          <label>{{$camera->cam_onvifport}}</label>
                        </div>
                        <a link="permanentlydeleted/{{$camera->id}}/{{$proxy->id}}" class="camera-del"><button type="" class="btn model-cam del-permanently"><i class="fa fa-trash-o" aria-hidden="true"></i><br>Delete</button></a>
                        <a link="restore-camera/{{$camera->id}}/{{$proxy->id}}" class="camera-restore"><button class="btn model-cam edit-camera cam-restore" id="{{$camera->id}}"><i class="fa fa-refresh" aria-hidden="true"></i><br>Restore</button></a>
                      </div>
                    </div>
                    <div class="status-device" id="{{$camera->ip}}" status="{{$camera->cam_status}}">
                        <div class='cam-off'>DELETED</div>
                    </div>
              			<div class="icon-info">
              				<img src="/js-css/img/icon/webcam1.png" class="icon-custom-proxy">
              			</div>
              			<div class="title-content-proxy">
                      <label style="font-size: 0.8em;">{{$camera->cam_name}}</label>
              				<p>{{$camera->ip}}</p>
              			</div>
              		</div>
                  @endif
                @endforeach
        	</div>
          @endforeach
        </div>
    </div> 


      <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
      </div>
      <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
      </div>

<script>
$(document).ready(function() {
  if($("#notice_warning").val() == 1){
            notifiWarning($("#notice_warning").attr("notifi"));
          }
          if($("#notice_success").val() == 1){
            notifiSuccess($("#notice_success").attr("notifi"));
          }
})


      function confirm_del_camera() {
          $(".camera-del").click(function() {
            var link = this.getAttribute("link");
            JSconfirm("Are you sure you want to delete this camera?\n* Deleting the camera does not remove its recording in the Edge Storage.", link);
          });
        }
        confirm_del_camera();

        function confirm_restore_camera() {
          $(".camera-restore").click(function() {
            var link = this.getAttribute("link");
            JSconfirm("Are you sure you want to restore this camera ?", link);
          });
        }
        confirm_restore_camera();
      </script>
      </script>

@endsection

