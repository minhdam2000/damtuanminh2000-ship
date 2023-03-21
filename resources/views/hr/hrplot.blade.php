@extends('../layouts/index')
@section('content')

        <link rel="stylesheet" href="js-css/treant/Treant.css">
        <link rel="stylesheet" href="js-css/treant/connectors.css">
        <script src="js-css/treant/vendor/raphael.js"></script>
        <script src="js-css/treant/Treant.js"></script>

    <div class="content-camera">
        <div class="header-content">
            <div class="header-content-left">
                <h6>Sơ đồ nhân sự</h6>
            </div>
            <div class="header-content-right" style="display: inline;">
                <h6 class="display-inline">Sơ đồ nhân sự</h6>
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
        <div class="">
          <div class="row row-content">
            <div class="row-title-proxy">

  <div class="chart" id="OrganiseChart-big-commpany"></div>

        </div>
          

        </div>
       


    </div>

    <!-- Modal -->
<div class="modal fade modol-text" id="job-modal" role="dialog">
  <div class="modal-dialog model-right">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label>Theo dõi tiến độ công việc </label>
      </div>
      <div class="notification"></div>
        <div class="modal-body">
              <ul class="nav nav-tabs" id="tabs" role="tablist">

                 <li class="nav-item margin_center">
          <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#contentl0"> Mô tả </a>
      </li>

      <li class="nav-item margin_center">
          <a id="tab1" class="nav-link color-a"  data-toggle="tab" role="tab" href="#contentl1"> Danh sách nhân sự  </a>
      </li>
      
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#contentl3">Tuyển dụng </a>
      </li>
    </ul>  
    <hr>
 <div class="tab-content">

          <div id="contentl0" class="tab-pane  in active">

          </div>
          <div id="contentl1" class="tab-pane  in fade">
                     
<table id="staff-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Họ tên </th>
                            <th>Chức vụ</th>
                            <th> </th>
                          </tr>
                        </thead>
                        <tbody class="tbody" id="job_history">

                        </tbody>
                      </table>
          </div>
<div id="contentl3" class="tab-pane fade">

  <form action="close-job"  enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input id="status_input_id" type="hidden" name="id" value="">
          <table class="table-edit table-model">
            
          <tr>
              <td>

                 <select onchange="LoadNewRole()" class="custom-select select-profile  browser-default" name="department" id="EditRole" >

  </select>
              </td>

          </tr>
            <tbody class="table-edit">

              
                <td>
                  <button type="button" class="btn btn-model" data-dismiss="modal">Tuyển dụng </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>
</div>
<div class="modal-footer" style="    position: inherit;">

                <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Thoát</button>
              </div>
</div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-detail" role="dialog">
          <div class="modal-dialog" style="max-width: 1000px;">
            <!-- Modal content-->
            <div class="modal-content">

              <div class="modal-header">Thông tin chi tiết</div>
              <div class="modal-body">
                  <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#contentd1"> Thông tin cơ bản </a>
      </li>
      
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#contentd2"> Đánh giá công việc </a>
      </li>

      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#contentd3"> Hiệu quả kinh doanh </a>
      </li>


      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#contentd4"> Giao tiếp </a>
      </li>

    
    </ul>  
    <hr>
 <div class="tab-content">

          <div id="contentd1" class="tab-pane  in active">
            <h5> Họ tên:  <span id="job_name_detail"></h5>
            <h5> Email: <span id="job_des"></h5>
            <h5> Số điện thoại: <span id="job_user_detail"></h5>
            <h5> Chứng minh thư: <span id="job_start_date"></h5>
            <h5> Ngày bắt đầu làm việc :  <span id="job_end_date"></h5>
            <h5> Phòng làm việc :  <span id="job_end_date"></h5>
            <h5> Vị trí :  <span id="job_end_date"></h5>>
            <h5> Các mốc công việc đáng nhớ: </h5>
          </div>

<div id="contentd2" class="tab-pane fade">
<div class="search-con-input proxy-add" title="Serach">
                        <input type="text" class="textbox" id="search-con-input" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div>

                  <table id="consumer-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Tên</th>
                            <th>Chứng minh thư</th>
                            <th>Số điện thoại </th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          
                        </tbody>
                      </table>
 </div>

<div id="contentd2" class="tab-pane fade"></div>

<div id="contentd3" class="tab-pane fade"></div>
            </div>

          </div>
          </div>
      </div></div>

</script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }
  });
</script>

<script type="text/javascript">
  $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });
  
  $("#search-input").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#camera-table tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });

    function checkAll() {
      if($('#select-all').is(':checked') == true){
        $('.check-box').prop('checked', true);
      }
      else{
        $('.check-box').prop('checked', false);
      }
    }
</script>

<script src="js-css/datatables/jquery.dataTables.js"></script>
<script src="js-css/datatables/dataTables.bootstrap4.js"></script>

<script type="text/javascript">
  
  // fix arrow end issues:
// https://github.com/DmitryBaranovskiy/raphael/issues/471

var chart_config = {
  chart: {
    container: "#OrganiseChart-big-commpany",
    levelSeparation: 45,

    rootOrientation: "NORTH",

    nodeAlign: "BOTTOM",

    connectors: {
      type: "step",
      style: {
        "stroke-width": 2
      }
    },
    node: {
      HTMLclass: "big-commpany"
    }
  },

  nodeStructure: {
    text: { name: "{{$root->name}}",
              type: "0",
              id: "{{$root->id}}" },
    connectors: {
      style: {
        'stroke': '#bbb',
        'arrow-end': 'oval-wide-long'
      }
    },
    children: [
      
            <?php
            foreach ($chartData as $chartData) {
              // print_r($chartData[0][1]);
            ?>
      {
        text: { name: "{{$chartData[0]}}" ,
              type: "0",
              id: "{{$chartData[1]}}"},
        stackChildren: true,
        connectors: {
          stackIndent: 30,
          style: {
            'stroke': '#bbb',
            'arrow-end': 'oval-wide-long'
          }
        },
        children: [
            <?php
            foreach ($chartData[2] as $data) {
              // print_r($chartData[0][1]);
            ?>
          {
            text: {

              name{{$data[2]}}: "{{$data[1]}}",
              type: "1",
              id: "{{$data[0]}}"
            },
            
          },
         <?php

              # code...
            }
      ?>
        ]
      },
      <?php

              # code...
            }
      ?>
    ]
  }
};

 function LoadEditRole(index){
    $.ajax({
      url: 'listrole/'+index,
      success: function(data) {
           var html = ""
           for(var i = 0; i < data.length;i++){
            html = html +"<option value='"+data[i].id+"'>"+data[i].name+"</option>"
           }
           document.getElementById("EditRole").innerHTML = html;
      }
    });
  }


function loadInfo(id){
  $.ajax({
      url: 'hr/staff-info/'+id,
      success: function(data) {
        console.log(data)
        var html = ""
        $("#modal-detail").modal()
      }
    });
  }



$('body').on('click', '.Treant .node', function() {


    var id = $(this).find(".node-id").text();
    LoadEditRole(id)
     $.ajax({
    type: "GET",
    url: '/hr/get-staff-by-department/'+id,
    success: function (response) {
      // response = (JSON.parse(response))
      var des = response[1]
      var img = response[2]
      console.log(response)
      response = response[0]
      if(img.length > 2){
      document.getElementById("contentl0").innerHTML = "<img style='width:100%;height:auto' src='"+img+"'>"
      }else{
        console.log( response[1])
      document.getElementById("contentl0").innerHTML = "<div style='width:300px;overflow: auto;'>"+des+"</div>"

      }
        $("#job_history").empty();
          var table = document.getElementById("job_history"); 
          for (i = 0; i <response.length;i++){
          var row = table.insertRow();
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);

          cell1.innerHTML = response[i].name
          cell2.innerHTML = response[i].rname
          cell3.innerHTML = '<a href= "hr/staff-info/'+response[i].id+'" class="preview" type="button"><img src="/js-css/img/icon/write.png"></a>'

          // cell3.innerHTML = '<a href="'+msg[i].link+'" ><i class="fa fa-download" aria-hidden="true"></i></a>'
          }

          // $("#staff-table").DataTable().fnDestroy();
          //  $('#staff-table').DataTable()
      }
           
      
    

  });
     $("#job-modal").modal()
    
});
</script>
<script>
    new Treant( chart_config );
  </script>



@endsection
