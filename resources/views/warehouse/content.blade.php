@extends('layouts.index')
@section('content')

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-angular.min.js" integrity="sha512-KT0oYlhnDf0XQfjuCS/QIw4sjTHdkefv8rOJY5HHdNEZ6AmOh1DW/ZdSqpipe+2AEXym5D0khNu95Mtmw9VNKg==" crossorigin="anonymous"></script>

    <style type="text/css">

.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 80%;
}
    </style>
	<div class="content-camera">
		
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
        <div class="tab-content"> <label  class="preview" for="file-input">
          <a href="/warehouse/data" type="button"  class="btn btn-model" > Quay lại</a>

          </label>
          <div id="content1" class="tab-pane  in active">
                    <table id="noteTable" class="table table-striped">
                  <thead>
                    <tr class="thead">
                        <th>Tên </th>
                        <th>Phòng </th>
                        <th>Ngày </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
      

                       @foreach($jobs as $job)
                        <tr class="color-add">  
                        <td><a href="/chatify/schedule/{{$job->id}}">{{$job->name}}</a></td> 
                     
                        <td>{{$job->dname}}</td> 
                          <td><span > {{$job->created_at}}

                    

                            <span id="job{{$job->id}}" style="display:none">
                              <h3>Mô tả công việc</h3>
                            <span>{!! $job->des !!}</span>
                            <h3>Bàn luận chi tiết</h3>
                            <span>{!! $job->content !!}</span>

                          </span>
                          </td>

                        </tr>
                      @endforeach

                    </tbody>
                  </table>
     </div>

 <div class="modal fade modol-text" id="myModal" role="dialog">
          <div class="modal-dialog model-right" style="width: 50%">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thông tin chi tiết</label>
              </div>
              <div class="notification"></div>
                  <div class="modal-body">
             
                     <div id="modalContent"></div>
                  </div>
            </div>
          </div>
      </div>

  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
 <script>

    function setCookie(cname, cvalue, mytime) {
  const d = new Date();
  d.setTime(d.getTime() + (mytime));
  let expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";


}

 $(document).ready(function(){
    var find = getCookie("find")
  $('#noteTable').DataTable(
{
     "oSearch": {"sSearch": find}
   }
    );
    $('.menu-link').click(function(event){
        //remove all pre-existing active classes
        $('.menu-pane').removeClass('active');
        $("#"+this.href.split("#")[1]).addClass('active');

        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });
  });

</script>


@endsection
