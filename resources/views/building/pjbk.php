@extends('../layouts/index')
@section('content')
<?php
 $check = 0;
       $departs = DB::table("user_department")->where("user_id", Auth()->user()->id)->pluck("department_id")->toArray();

        foreach($departs as $depart){
            $mid = DB::table("department")->where("id",$depart)->first()->mid;
            // dd($hid);
            if ($mid < 1) {
              $check =1;
            }
        }

?>


<link rel="stylesheet" href="js-css/css/stepprogressbar.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style type="text/css">



.GoogleContent iframe{

    width: 100%;
    min-height: 400px;
      }


  .progress{
    min-height: 30px;
    background-color: transparent;
}
.progress-bar{
    font-size: 15px;
  }
  .popover-header {
    color: black;
  }

</style>
    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6>Quản lý tiến trình dự án</h6>
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
         <?php
          if($check== 1){

          ?>
                      <div class="proxy-add" title="Manual Add"><button type="button" class="camera-button" data-toggle="modal" data-target="#new-camera"><i class="fa fa-plus" aria-hidden="true"></i> Thêm dự án</button></div>
                      
                      <div class="proxy-add" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>
                     
                    <?php
                  }
         ?>
 </div>

                          @foreach($projects as $project)

        		<div class="row-title-proxy">
              



                  <table id="camera-table" class="nvr-table2">
                      <thead>
                        <tr class="thead">                           
                            <th>Tên dự án</th>
                           <!--  <th>Tiến độ dự án</th>
                            <th>Tiến độ nghiệm thu</th>
                            <th>Tiến độ thành toán</th> -->
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                            <tr class="color-add">
    	                        
    	                        <td><i id="project{{$project->id}}" class="fa fa-circle active-off cam-status" aria-hidden="true"></i> <img src="js-css/img/icon/map.png" width='32' height='32'><a href="/building/data/{{$project->id}}"><span id="name{{$project->id}}">{{$project->jname}}</span></a>


            <span style="display:none" id="duration{{$project->id}}">{{$project->duration}}</span>
                              <span style="display:none" id="start{{$project->id}}">{{$project->start}}</span>
                              <span style="display:none" id="end{{$project->id}}">{{$project->end}}</span>
                              <span style="display:none" id="pid{{$project->id}}">{{$project->pid}}</span>


                              </td>


                              <td>
                                
                                    <button onclick="Edit({{$project->id}})" class="preview" type="button"><img src="/js-css/img/icon/notepad.png"></button>


                          <button onclick="removeFile(<?=$project->id?>)" type="button"  class="preview" > <img src="/js-css/img/icon/recycle_bin.png"> </button></td>
                             

                            </tr>
                        </tbody>
                      </table>
<hr>
      <button type="button" class="btn btn-model  btn-lg"  onclick="ToggleNext({{$project->id}})">
                <h6>Các thông báo mới</h6>
              </button>


      <button type="button" class="btn btn-model  btn-lg"  onclick="ToggleNext2({{$project->id}})">

                <h6>Tìm kiếm</h6>
              </button>



    <div  style="display: none;width: 100%;" id="importantData{{$project->id}}">

<?php
    $data = DB::table('buildingg')->where("project_id",$project->id)->get();
?>
               <div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="sreachInput{{$project->id}}" onkeyup="search({{$project->id}})">
</div>
      <div id="DT{{$project->id}}" style="display:none">

                <table id="data-table{{$project->id}}" class="nvr-table2">
                        <thead>
                        <tr class="thead">                           
                            <th>Tên hạng mục</th>       
                        </tr>
                      </thead>
                      <tbody class="tbody">
                          @foreach($data as $row)

                          <tr class="color-add"> 
                            <td>
                            @if($row->last_id == 0)
                            <a href="/building/data/{{$row->project_id}}" type="button"  class="preview" > 
                              {{$row->title}} </a>
                              @else

                              <a href="/building/detail/{{$row->last_id}}" type="button"  class="preview" > 
                              {{$row->title}} </a>
                              @endif
                            </td>
                          
                          </tr>
                          @endforeach
                      </tbody>
              </table>
            </div>


            </div>


           <div style="max-width: 3000px;display: none;" class="container" id="importantMess{{$project->id}}">
<div class="row">

                <hr>

  <?php
// $colors = ["#FFC0CB", "#E6E6FA", "#DDA0DD", "#FFA07A", "#FFA500", " #FFFACD", "#ADFF2F", "#98FB98", "#8FBC8F", "#AFEEEE", "#B0C4DE", "#F5DEB3", "#A9A9A9", "#FFE4E1", "#F4A460"];


$colors = ["#FF1493", "#9932CC",  "#00FF00", "#FFA500", "#008B8B", "#4682B4", "#ccccf0", "#778899", "rgb(137,207,240)", "pink", "#DA70D6", "#FF8C00", "#CD5C5C", "#DDA0DD"];

$colorsSel = [0,0,0,0,0,0,0,0,0,0,0,0,0,0];
$colorsTask = [0,0,0,0,0,0,0,0,0,0,0,0,0,0];
$colorsTaskMess = [0,0,0,0,0,0,0,0,0,0,0,0,0,0];


$last_project_id = 0;

    $build_arr = DB::table("build_noti")
    ->select("building_id")
    ->where("user_id",Auth()->user()->id)
    ->distinct()->pluck("building_id")->toArray();

    // dd($build_arr);
    $building =DB::table("buildingg")->whereIn("id",$build_arr)
                ->where('project_id', $project->id)->get();


?>

    @foreach($building as $built)

<?php


$count = $built->id % count($colors);
while($colorsTaskMess[$count] == 1){
  $count = $count + 1;

  if($count == count($colors) ){
    $count = 0;
  }
}

$fulltitle = $built->title;
$project_name = "";
foreach($projects as $project){
  if($built->project_id == $project->id){
    $fulltitle  = $fulltitle ." (".$project->jname.")";
    $project_name = $project->jname;
    break;
  }
}


$colorsTaskMess[$count] =1;

?>


    <div class="col-md-4 col-12" id="boxMess{{$built->id}}">
  
<div class="card" style="background-color: {{$colors[ $count]}};">
  <div class="card-body">

<?php 

if(strlen($fulltitle) > 200){

$shorttitle = '<span onclick="fullMessTitle('.$built->id.')">'.substr($fulltitle,0, 200).'<span style="color:black"> ...</span></span>';

$fulltitle= ' <span onclick="shortMessTitle('.$built->id.')">'.$fulltitle.'<span style="color:black">  <--</span></span>';

}else{
  $shorttitle = $fulltitle;
}

?>
    <div class="card-myhead">
      <span style='display:none' id="fullTitle{{$built->id}}">{!! $fulltitle !!}</span>
      <span style='display:none' id="shortTitle{{$built->id}}">{!! $shorttitle !!}</span>
    <h4 id="messTitle{{$built->id}}" style="font-weight: 900">{!! $shorttitle !!}</h4>
     <?php
      $date1 = date("Y-m-d H:i:s");
      $date2 = $built->end;
      $timestamp1 = strtotime($date1);
      $timestamp2 = strtotime($date2);
      $remainDay = intval(($timestamp2 - $timestamp1)/(60*60*24));
   
     ?>
     <h5 style="font-weight: 700;">Còn: {{$remainDay}} Ngày</h5>
     <button type="button" class="btn btn-model"><a href="building/remove_noti/{{$built->id}}">Bỏ theo dõi</a></button>
     <button type="button" class="btn btn-model"><a target="_blank" href="building/warehouse/{{$built->id}}">Hồ sơ tài liệu</a></button>
      <hr>
  <!--   <hr>
    <p> Hiện thị <input id="Sel{{$built->id}}" name="selector[]" onclick="CbChange({{$built->id}})" type="checkbox" value="{{$built->id}}" checked /> </p> -->
     
</div>
      <div  class="GoogleContent" id="iframe{{$built->id}}">
        </div>
  </div>
</div>
        </div>
    @endforeach
  </div>
</div>

          </div>


@endforeach
<br>
          <button  class="btn btn-model"><a href="/" > Quay lại</a></button>
        	</div>
        </div>
    </div>
    <!-- Modal -->
      <div class="modal fade modol-text" id="new-camera" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
            <form id="create-form" action="/building/new-job" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="pid" value="0">
	              <div class="modal-header">
	                  <label>Dự án mới</label>
	              </div>
	              <div class="notification"></div>
	              <div class="modal-body">
	                <table class="table-edit table-model">
	                    <tbody class="table-edit table-manual-add">
	                        <tr>
	                            <td class="cam-properties">Tên</td>
	                            <td><input type="" value="" name="name" class="input-edit modol-text" required="" autocomplete="off"></td>
	                        </tr>
	                        <tr>
	                            <td class="cam-properties">Số ngày</td>
	                            <td><input type="" value="" name="duration" class="input-edit modol-text" required="" autocomplete="off"></td>
	                        </tr>
	                        <tr>
                            <td  class="cam-properties"><i class="fa fa-calendar" aria-hidden="true"></i> Ngày bắt đầu </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="start" required=""></td>
                        </tr>   <tr>
                            <td  class="cam-properties"><i class="fa fa-calendar" aria-hidden="true"></i> Ngày kết thúc </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="end" ></td>
                        </tr>

	                        <tr>
	                            <td></td>
	                            <td><button class="btn btn-model" id="camera-add">&nbsp;&nbsp; Thêm &nbsp;&nbsp;</button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoát</button>
                              </td>
	                        </tr>
	                    </tbody>
	                </table>
	              </div>
	              <div class="modal-footer">
	                
	              </div>
          	</form>
            </div>
          </div>
      </div>

       <div class="modal fade modol-text" id="new-edge" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
            <form id="create-form" action="/building/edit-job" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id" value="" id="editId">
            <input type="hidden" name="pid" value="0">
                <div class="modal-header">
                    <label>Sửa hợp đồng</label>
                </div>
                <div class="notification"></div>
                <div class="modal-body">
                  <table class="table-edit table-model">
                      <tbody class="table-edit table-manual-add">
                          <tr>
                              <td class="cam-properties">Tên</td>
                              <td><input type="" value="" name="name" id="editName" class="input-edit modol-text" required=""></td>
                          </tr>
                          <tr>
                              <td class="cam-properties">Thời gian</td>
                              <td><input type="" value="" name="duration" id="editDuration"  class="input-edit modol-text" required=""></td>
                          </tr>
                          <tr>
                            <td  class="cam-properties"><i class="fa fa-calendar" aria-hidden="true"></i> Ngày bắt đầu </td>
                            <td> <input type="date" class="input-edit modol-text form-control" id="editStart" name="start" required=""></td>
                        </tr>
                        <tr>
                            <td  class="cam-properties"><i class="fa fa-calendar" aria-hidden="true"></i> Ngày kết thúc </td>
                            <td> <input type="date" class="input-edit modol-text form-control" id="editEnd" name="end" ></td>
                        </tr>


                          <tr>
                              <td></td>
                              <td><button class="btn btn-model" id="camera-add">&nbsp;&nbsp; Sửa &nbsp;&nbsp;</button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoát</button>
                              </td>
                          </tr>
                      </tbody>
                  </table>
                </div>
                <div class="modal-footer">
                  
                </div>
            </form>
            </div>
          </div>
      </div>

      <div class="overlay-dark"></div>
      <img class="img-overlay">
      <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> notifition</h6>
      </div>
      <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning</h6>
      </div>
<script  src="js-css/js/image-popup.js"></script>

 <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>

<script type="text/javascript">

          @foreach($projects as $project)
    var table  = $('#data-table{{$project->id}}').DataTable();
    @endforeach
  $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });

  $(document).ready(function(){


                          @foreach($projects as $project)
      $('#data-table{{$project->id}}').on( 'search.dt', function () {
    var info = $('#data-table{{$project->id}}').DataTable().page.info();
 
    console.log( 'Rows shown', info.recordsDisplay);
    
    if (info.recordsDisplay > 0) {
      $('#DT{{$project->id}}').show();
    }  else {
      $('#DT{{$project->id}}').hide();
    }
  } );
   @endforeach

    $('[data-toggle="popover"]').popover();   
    
    $("#search-input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#camera-table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });

  function search(id){
    var value = document.getElementById("sreachInput"+id).value
    console.log(value)
    $('#data-table'+id).DataTable().search(value).draw();
    if(value.length <2){
       $('#DT'+id).hide();
    }
  }
</script>
<script>
    $(document).ready(function() {
          if($("#notice_success").val() == 1){
            notifiSuccess($("#notice_success").attr("notifi"));
          }
          if($("#notice_warning").val() == 1){
            notifiWarning($("#notice_warning").attr("notifi"));
          }
        });
    $("#camera-add").click(function(){
        var ip = document.getElementById('ip').value;
        var rtsp_link = document.getElementById('rtsp-link').value;
        if(ip == '' || rtsp_link == ''){
            $("#new-camera").addClass("shake-model");
            setTimeout(function() {
                $("#new-camera").removeClass("shake-model");
            }, 1000);
            document.getElementsByClassName('notification')[0].innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Cannot leave an id or password blank !";
            document.getElementsByClassName('notification')[0].classList.add('notification-color');
        }
        else{
            $("#create-form").submit(function(event){
			      event.preventDefault(); //prevent default action
			      var post_url = $(this).attr("action"); //get form action url
			      var request_method = $(this).attr("method"); //get form GET/POST method
			      var form_data = new FormData(this); //Creates new FormData object
			      $.ajax({
			      url : post_url,
			      type: request_method,
			      data : form_data,
			      contentType: false,
			      cache: false,
			      processData:false
			      }).done(function(response){ //
			        console.log(response);
			        if(response == 'true'){
			          window.location.href = 'create-camera-success';
			        }
			        else{
			          snakeModel();
			          document.getElementsByClassName('notification')[0].innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> There was a error in too process of process. ";
			          document.getElementsByClassName('notification')[0].classList.add('notification-color');
			        }
			      });


			});


        }
    });
</script>

<script>
  function checkAll() {
      if($('#select-all').is(':checked') == true){
        $('.check-box').prop('checked', true);
      }
      else{
        $('.check-box').prop('checked', false);
      }
    }
</script>

<script>
    function snakeModel(){
      $("#create-user").addClass("shake-model");
            setTimeout(function() {
                $("#create-user").removeClass("shake-model");
            }, 1000);
        }
</script>

<script>
  function confirm_remove() {
          var remove = document.getElementById('device-remove');
          remove.addEventListener('click', function(e){
              $("#form-camera").attr("action","remove-camera");
              swal({
                  title: "",
                  text: " Are you sure you want to delete this cameras? ",
                  type: "info",
                  showCancelButton: true,
                  confirmButtonText: "Yes",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false,
                  reverseButtons: true },
                  function(isConfirm){
                  if (isConfirm)
                  {
                    loading_nomal()
                    document.getElementById("submit-action").click();
                    swal.close();
                  }
                  else {
                    swal.close();
                  }
                });
            });
        }
        confirm_remove();
</script>


<!-- show image preview -->
<script type="text/javascript">
  $( ".preview" ).click(function() {
    $(this).parent().children( ".img-popup" ).click();
  });
</script>


<script type="text/javascript">
  function selectNvr(){
    var nvr_name = $("#nvrs option:selected").text();
    console.log(nvr_name)
    $("#form-camera").attr("action","add-cam-to-nvr/"+$("#nvrs").val());
    var message = "You want to record these cameras in "+nvr_name+" device.";
    JSconfirmAddCamToNvr(message);
  }



  function JSconfirmAddCamToNvr(text){
    swal({ 
       title: "",   
       text: text,   
       type: "info",   
       showCancelButton: true,     
       confirmButtonText: "Yes",   
       cancelButtonText: "No",   
       closeOnConfirm: false,   
       closeOnCancel: false,
       reverseButtons: true }, 
       function(isConfirm){   
       if (isConfirm) 
       {   
          document.getElementById("submit-action").click();
       } 
       else {   
        $("#nvrs").val("-1");
        swal.close();  
       } 
     });
     $(".btn-primary").css('border', 'none');
     $(".showSweetAlert").attr('style', 'display: block;');
     $(".text-muted").attr('style', 'color: #fff !important');
   }



   function  Edit(id){
  document.getElementById("editId").value = id
  document.getElementById("editName").value = document.getElementById("name"+id).innerHTML
  document.getElementById("editDuration").value = document.getElementById("duration"+id).innerHTML
  document.getElementById("editStart").value = document.getElementById("start"+id).innerHTML
  document.getElementById("editEnd").value = document.getElementById("end"+id).innerHTML
  // alert(document.getElementById("type"+id).innerHTML)
  // $('#editPid').val(document.getElementById("pid"+id).innerHTML);


$("#new-edge").modal()

}



  function removeFile(id) {
    console.log("Okoekqr");
              swal({
                  title: "",
                  text: " Bạn có muốn xóa tệp này không? ",
                  type: "info",
                  showCancelButton: true,
                  confirmButtonText: "Yes",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false,
                  reverseButtons: true },
                  function(isConfirm){
                  if (isConfirm)
                  {
                    loading_nomal()
                    location.href  = "/building/delete-job/"+id
                    swal.close();
                  }
                  else {
                    swal.close();
                  }
                });
           }



function loadIframe(id){  
   // document.getElementById("iframe"+id).innerHTML = 
   //         '<iframe src="/chatify/build/' + id+'"></iframe>'
   document.getElementById("iframe"+id).innerHTML = 
           '<iframe src="/building/warehouse/' + id+'"></iframe>'

}

@foreach($build_arr as $lid)
//alert({{$lid}})

try {
loadIframe({{$lid}})

} catch (error) {
  console.error(error);
}


@endforeach

function ToggleNext(id){
  $("#importantMess"+id).slideToggle();
  document.getElementById("importantData"+id).style.display="none";
}


function ToggleNext2(id){
  $("#importantData"+id).slideToggle();
  document.getElementById("importantMess"+id).style.display="none";
}

function fullMessTitle(id){
  document.getElementById("messTitle"+id).innerHTML = document.getElementById("fullTitle"+id).innerHTML 
}

function shortMessTitle(id){
  document.getElementById("messTitle"+id).innerHTML = document.getElementById("shortTitle"+id).innerHTML 
}

function openProjectNoti(id){
  $("#projectNoti"+id).slideToggle();


}

</script>


@endsection
