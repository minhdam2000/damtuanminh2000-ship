@extends('../layouts/index')
@section('content')
<style>

.sreach-content{
  margin-left: 1%;
}


  /* Popup container - can be anything you want */
  .list-group-item{
    background-color:transparent!important;
  }
  h2{
    font-weight: 900
  }
  .popup {
    background-repeat:no-repeat;
    background-size:contain;
    background-position:center;
    text-align: center;
    color: black;
    font-weight: 100!important;
    display: block;
    position: absolute;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
  /* Toggle this class - hide and show the popup */
  
  </style>
    <div class="content-camera">
        <div class="header-content">
           
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
                <input type="hidden" name="_token" value="{{csrf_token()}}">
          			<div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;List of Area</div>
 

              </div></div>
 <div class="row-content">
<ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab1" class="nav-link active color-a"  data-toggle="tab" role="tab" href="#content1">Bản đồ dự án</a>
      </li>
       
  
    </ul>  
    <hr>
<div class="tab-content">
<div id="content1" class="tab-pane  in active">

<div  id="zone" role="dialog" data-backdrop="static">            <div class="modal-content">
  <div class="modal-body" id="zone-body">
    <img src="js-css/img/project/{{$project->url}}" style="width: 100%; height: 100%;" id="snapshot-zone">
  </div>
  <div class="option-zone">
    <input type="hidden" value="" id="zoneStatus">
    <?php
      if(Auth()->user()->role_id <= 2){
    ?>
    <button class="btn btn-model" onclick="fixZone();" id="btnFixZone">Fix Area</button>
 <button class="btn btn-model" onclick="deleteZone();" id="btnDetZone">
 Deleate Area</button>

    <?php
  }
    ?>


<button type="button" class="camera-button" onclick="getZone()"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button>
  </div>
</div>
</div>
</div>

</div>
</div>
                 
        	</div>
        </div>
    </div>
    <!-- Modal -->
      <div class="modal fade modol-text" id="new-camera" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
            <form id="create-form" action="add-new-camera" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
	              <div class="modal-header">
	                  <label>Manual Add Camera</label>
	              </div>
	              <div class="notification"></div>
	              <div class="modal-body">
	                <table class="table-edit table-model">
	                    <tbody class="table-edit table-manual-add">
	                        <tr>
	                            <td class="cam-properties"><b class="required">* </b>Device Name</td>
	                            <td><input type="" value="" name="device_name" class="input-edit modol-text" id="device-name" required=""></td>
	                        </tr>
	                        <tr>
	                            <td class="cam-properties"><b class="required">* </b>IP</td>
	                            <td><input type="" value="" name="ip_address" class="input-edit modol-text" id="ip" required=""></td>
	                        </tr>
	                        <tr>
	                            <td class="cam-properties">Port</td>
	                            <td><input type="number" value="" name="port" class="input-edit modol-text" id="port"></td>
	                        </tr>
	                        <tr>
	                            <td class="cam-properties">Camera Name</td>
	                            <td><input type="" value="" name="camera_name" class="input-edit modol-text" id="camera-name"></td>
	                        </tr>
	                        <tr>
	                            <td></td>
	                            <td><button class="btn btn-model" id="camera-add">&nbsp;&nbsp; Add &nbsp;&nbsp;</button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Cancel</button>
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

<!-- Modal -->
<div class="modal fade modol-text" id="new-area" role="dialog">
  <div class="modal-dialog model-right">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label>New Area</label>
      </div>
      <div class="notification"></div>
      <form action="add-new-minimap" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="modal-body">
          <table class="table-edit table-model">
            <tbody class="table-edit">
              <tr>
                <td class="cam-properties">Name</td>
                <td><input type="" value="" name="name" id="zone_name" class="input-edit modol-text" required=""></td>
                <td><input type="hidden" value="" name="zones" id="zone_input" class="input-edit modol-text" required=""></td><input type="hidden" value="{{$project->id}}" name="project_id"  class="input-edit modol-text" required=""></td>
              </tr>
               <tr>
                <td class="cam-properties">Description</td>
                <td><input type="" value="" name="description" id="zone_name" class="input-edit modol-text" required=""></td>
              </tr>
              <tr>
                <td></td>
                <td>
                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Add &nbsp;&nbsp; </button>
                  <button type="button" class="btn btn-model" data-dismiss="modal">Cancel</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>



<script  src="js-css/js/image-popup.js"></script>
<script src="js-css/js/d3.min.js"></script>
<script type="text/javascript">
  $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });

  $(document).ready(function(){
    $("#search-input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#camera-table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
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
  function confirm_remove(id) {
              swal({
                  title: "",
                  text: " Are you sure you want to delete this area? ",
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
                     $.get("delete-minimap/"+id, async function(res) {
                        console.log(res)
                        location.reload()
                       });
                    swal.close();
                  }
                  else {
                    swal.close();
                  }
                });
        }
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


</script>
<!-- ve zone camera -->

<script type="text/javascript">

  var dragging = false, drawing = false, startPoint;
  var svg = d3.select('#zone-body').append('svg')
  .attr('width', '100%');

  svg[0][0].setAttribute("style", "position: absolute; width: 100%; height: 100%;left: 0;top: 0;");
  var totalPoints = []
  var totalState = []
  var totalId = []
  var points = [], g;

  function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }

  async function getZone(){
    $('.popup').remove();
    myTimer = 1;
    // getSnapshot();
    console.log(":qewarqw")
    var pology;
    $.ajax({
      url: "get-area/"+{!! $project->id !!},
      success: async function(res) {

        console.log(res)
        res = JSON.parse(res)
        console.log(res)
        while(true){
          if($("svg").width() == 0){
            await sleep(10);
            continue;
          }
          else{
            pology = '';
            try{
              await res.forEach(createPology);
              await $("svg").html(pology);
              break;
            }
            catch(err) {
              console.log(err.message);
              break;
            }
          }
        }
      }
    });
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
    function createPology(data) {
      console.log(data)
      var zone = data.zone
      zone = zone.slice(1, zone.length-1);
      zone = zone.split(",")


      var ratio = ($("svg").width())/720;
      // console.log(ratio)
      // var zone = data.map(x => x * ratio);
      
      var binary_zone = [];
      var medium_x = 0;
      var medium_y = 0;
      var max_x = 0;
      var min_x = 10000;
      var max_y = 0;
      var min_y = 10000;
      

      for (i = 0; i <zone.length;i++){
        if (i %2 == 0){
          // console.log(zone[i])
          // console.log(zone[i+1])
          zone[i] = parseInt(zone[i])*ratio
          zone[i+1] = parseInt(zone[i+1])*ratio

          medium_x = medium_x + zone[i]
          medium_y = medium_y + zone[i+1]

          if(max_x < zone[i]){
            max_x = zone[i];
          }
          if(min_x > zone[i]){
            min_x = zone[i]
          }

           if(max_y < zone[i+1]){
            max_y = zone[i+1];
          }
          if(min_y > zone[i+1]){
            min_y = zone[i+1]
          }
          binary_zone.push([parseInt(zone[i]),parseInt(zone[i+1])]);
        }
      }

      medium_x = parseInt(medium_x/parseInt(zone.length/2))
      medium_y = parseInt(medium_y/parseInt(zone.length/2))


      totalPoints.push(binary_zone)
      totalId.push(data.id)
      totalState.push(data.state)
      <?php
       if(Auth()->user()->role_id <= 2){

          ?>
       pology = pology + '<g><polygon points="'+zone.toString()+'" style="fill: rgba(0, 0, 255, 0.5);"></polygon></g>';
      <?php
      } else{
      ?>

       pology = pology + '<g><polygon points="'+zone.toString()+'" style="fill: rgba(0, 0, 255, 0.0);"></polygon></g>';
      <?php
    }
      ?>



  var div = document.createElement('div');
  div.setAttribute("id", 'area' + data.id)
  div.setAttribute("class", 'popup')

  // document.body.appendChild(div);
  // var offset = $("#zone").offset();
  // $('#area' + data.id).css({width: (max_x - min_x)/2});
  // $('#area' + data.id).css({height: "100px"});
  // $('#area' + data.id).css({width: "100px"});
  // $('#area' + data.id).css({left: offset.left + medium_x -  (max_x - min_x)/6});
  // $('#area' + data.id).css({top:  offset.top + medium_y });
  // $('#area' + data.id).css({"background-image": "url('/js-css/img/house.png')"});
  // $('#area' + data.id).html('<h2>'+data.name+'</h2>')
  // console.log()

  // var checkPoint = $('#area' + data.id).offset();
  // var cp1 = [checkPoint.left - offset.left,checkPoint.top - offset.top]
  // console.log(cp1)
  // var cpFlag = 0;
  // if(pointInPolygon(cp1,binary_zone)){
  //   var  cp2 = [checkPoint.left - offset.left + $('#area' + data.id).width(),checkPoint.top  - offset.top + $('#area' + data.id).height()]

  //   if(pointInPolygon(cp2,binary_zone)){
  //     cpFlag = 1;
  //   }
  // }
  // console.log("CP")
  // console.log(cpFlag)
  // if (cpFlag == 0){
  //  $('#area' + data.id).css({'transform': "rotate(60deg)"});
  //    var cpFlag = 0;
  //   if(pointInPolygon(cp1,binary_zone)){
  //     var  cp2 = [checkPoint.left - offset.left + $('#area' + data.id).width(),checkPoint.top  - offset.top + $('#area' + data.id).height()]

  //     if(pointInPolygon(cp2,binary_zone)){
  //       cpFlag = 1;
  //     }
  //   }
  //   if (cpFlag == 0){
  //  $('#area' + data.id).css({'transform': "rotate(-60deg)"});

  //   }

  }




  popup(event,data.id,data.name)


   
  }

  


  function pointInPolygon(point, vs) {
    var xi, xj, i, intersect,
    x = point[0],
    y = point[1],
    inside = false;
    for (var i = 0, j = vs.length - 1; i < vs.length; j = i++) {
      xi = vs[i][0],
      yi = vs[i][1],
      xj = vs[j][0],
      yj = vs[j][1],
      intersect = ((yi > y) != (yj > y))
      && (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
      if (intersect) inside = !inside;
    }
    return inside;
  }

// behaviors
var dragger = d3.behavior.drag()
.on('drag', handleDrag)
.on('dragend', function(d){
  dragging = false;
});


svg.on('click', function(){

  status = document.getElementById("zoneStatus").value;
  if (status == 1){
    if(dragging) return;
    drawing = true;
    startPoint = [d3.mouse(this)[0], d3.mouse(this)[1]];
    if(svg.select('g.drawPoly').empty()) g = svg.append('g').attr('class', 'drawPoly');
    if(d3.event.target.hasAttribute('is-handle')) {
      closePolygon();
      return;
    };
    points.push(d3.mouse(this));
    console.log(points)
    g.select('polyline').remove();
    var polyline = g.append('polyline').attr('points', points)
    .style('fill', 'none')
    .attr('stroke', '#000');
    for(var i = 0; i < points.length; i++) {
      g.append('circle')
      .attr('cx', points[i][0])
      .attr('cy', points[i][1])
      .attr('r', 4)
      .attr('fill', 'yellow')
      .attr('stroke', '#000')
      .attr('is-handle', 'true')
      .style({cursor: 'pointer'});
    }
  }else if(status == 2){
    for (i = 0; i <totalPoints.length;i++){
      flag = pointInPolygon(d3.mouse(this),totalPoints[i])
      if (flag == true){
        index =i
        confirm_remove(totalId[i])
        break
      }
    }
  }
  else{
    res = false;
    var index = 0;
    for (i = 0; i <totalPoints.length;i++){
      flag = pointInPolygon(d3.mouse(this),totalPoints[i])
      if (flag == true){
        index =i

              
                <?php
          if(Auth()->user()->role_id == 5){

          ?>
        window.location.href = "/area-contribute-information/" + totalId[i]
          <?php
                    }else{
                ?>

        window.location.href = "/area-fix/" + totalId[i]
                 <?php
                    }
                ?>
        break
      }
    }
    console.log(res)
  //   if (res == true){
  //     popup(event,totalId[index],totalState[index])
  // }
}
});
function popup(event,id,name) {
  console.log(event)
  // console.log(event.clientX)
  // console.log(event.clientY)

}
function loadTransaction(id,state){
  if (state == 0){
    document.getElementById("tran_id").value = id;

    document.getElementById("tran-zone").innerHTML = document.getElementById("zone"+id+"name").innerHTML ;
    document.getElementById("tran-price").innerHTML = document.getElementById("zone"+id+"price").innerHTML ;

    $("#transaction-modal").modal('show');
  }else{
    alert("this zone has been on the process")
  }
}
function closePolygon() {
  svg.select('g.drawPoly').remove();
  var g = svg.append('g');
  g.append('polygon')
  .attr('points', points)
  .style('fill', getRandomColor());
  for(var i = 0; i < points.length; i++) {
    var circle = g.selectAll('circles')
    .data([points[i]])
    .enter()
    .append('circle')
    .attr('cx', points[i][0])
    .attr('cy', points[i][1])
    .attr('r', 4)
    .attr('fill', '#FDBC07')
    .attr('stroke', '#000')
    .attr('is-handle', 'true')
    .style({cursor: 'move'})
    .call(dragger);
  }

  var ratio = ($("svg").width())/720;
  let temp = points.slice();
  console.log(temp)
  temp = temp.map(x => [parseInt(x[0]) / ratio,parseInt(x[1]) / ratio]);
  console.log("!23123")
  console.log(temp)
  document.getElementById("zone_input").value = temp;
  totalPoints.push(temp)
  $("#new-area").modal('show');

  points.splice(0);
    // console.log("doine")
    // console.log(temp)
    // console.log(points)
    drawing = false;
  }
  svg.on('mousemove', function() {

    status = document.getElementById("zoneStatus").value;
    if (status == 1){
      if(!drawing) return;
      var g = d3.select('g.drawPoly');
      g.select('line').remove();
      var line = g.append('line')
      .attr('x1', startPoint[0])
      .attr('y1', startPoint[1])
      .attr('x2', d3.mouse(this)[0] + 2)
      .attr('y2', d3.mouse(this)[1])
      .attr('stroke', '#53DBF3')
      .attr('stroke-width', 1);
    }else{
      var test =1;
      // console.log([d3.mouse(this)[0], d3.mouse(this)[1]]);
    }
  })
  function handleDrag() {
    if(drawing) return;
    var dragCircle = d3.select(this), newPoints = [], circle;
    dragging = true;
    var poly = d3.select(this.parentNode).select('polygon');
    var circles = d3.select(this.parentNode).selectAll('circle');
    dragCircle
    .attr('cx', d3.event.x)
    .attr('cy', d3.event.y);
    for (var i = 0; i < circles[0].length; i++) {
      circle = d3.select(circles[0][i]);
      newPoints.push([circle.attr('cx'), circle.attr('cy')]);
    }
    poly.attr('points', newPoints);
  }
  function getRandomColor() {
    // var letters = '0123456789ABCDEF'.split('');
    // var color = '#';
    // for (var i = 0; i < 6; i++) {
    //     color += letters[Math.floor(Math.random() * 16)];
    // }
    return "#ff00004d";
  }


  function updateZone(){
    zones = [$("svg").width(),$("svg").height()];
    for(var i=0; i<$("svg g").length ; i++){
      zones.push(($("svg").children()[i]).childNodes[0].getAttribute('points'));
    }
    try{
      $.ajax({
        type: "POST",
        data : {"_token": $('meta[name="csrf-token"]').attr('content'),zones},
        url : "project-update-zone/"+{!! $project->id !!},
        success: function(msg){
          //close_loading()
          if(msg == "true"){
            $('#zone').modal('hide');
            myTimer = 0;
            notifiSuccess("Update successful.");
          }
          else{
            //close_loading()
            myTimer = 0;
            $('#zone').modal('hide');
            notifiWarning("Update failed.");
          }
        }
      })
    }
    catch(err) {
      close_loading()
      console.log(err.message);
      myTimer = 0;
      $('#zone').modal('hide');
      notifiWarning("Update failed.");
    }
  }

</script>

<script type="text/javascript">
  function fixZone(){
    status = document.getElementById("zoneStatus").value;
    if (status != 1){
      document.getElementById("zoneStatus").value = 1;
      document.getElementById("btnFixZone").innerHTML = "Done";
      document.getElementById("btnDetZone").innerHTML = "Delete Zone";
    }else{
      document.getElementById("zoneStatus").value = 0;
      document.getElementById("btnFixZone").innerHTML = "Fix Zone";
      document.getElementById("btnDetZone").innerHTML = "Delete Zone";

    }
  }
   function deleteZone(){
    status = document.getElementById("zoneStatus").value;
    if (status != 1){
      document.getElementById("zoneStatus").value = 2;
      document.getElementById("btnFixZone").innerHTML = "Fix Zone";
      document.getElementById("btnDetZone").innerHTML = "Done";
    }else{
      document.getElementById("zoneStatus").value = 0;
      document.getElementById("btnFixZone").innerHTML = "Fix Zone";
      document.getElementById("btnDetZone").innerHTML = "Delete Zone";

    }
  }


  $( ".icon-edge-detail" ).click(function() {
    if($("#edge-id").val() != 0){
      window.location.href = 'edge-information/'+$("#edge-id").val();
    }
  });

  $( ".icon-storage-detail" ).click(function() {
    if($("#nvr-id").val() != 0){
      window.location.href = 'listcamnvr/'+$("#nvr-id").val();
    }
  });
  getZone();
</script>

<script src="js-css/datatables/jquery.dataTables.js"></script>
<script src="js-css/datatables/dataTables.bootstrap4.js"></script>

<script type="text/javascript">

     $("#search-input-btn").on("click", function() {
      var value = $("#search-input").val().toLowerCase();
      var bdsValue = $("#search-input-bds").val().toLowerCase();
      var typeValue = $("#search-type").val().toLowerCase();
    
        areaMin = $("#search-input-area1").val()
        areaMax = $("#search-input-area2").val()
        console.log(areaMin)
        console.log(areaMax)
     
        priceUnitMin = $("#search-input-unit-price1").val()
        priceUnitMax = $("#search-input-unit-price2").val()

        priceMin = $("#search-input-price1").val()
        priceMax = $("#search-input-price2").val()


     
      $("#zone-table tbody tr").filter(function() {
        var consumer =  ($(this)[0].childNodes[3].innerHTML)
        var bds =  ($(this)[0].childNodes[0].innerHTML)
        var type =  ($(this)[0].childNodes[4].innerHTML)
        var area =  parseInt($(this)[0].childNodes[2].innerText.replaceAll(',', ''))
        var price =  parseInt($(this)[0].childNodes[5].innerText.replaceAll(',', ''))
      var unit_price =  parseInt($(this)[0].childNodes[1].innerText.replaceAll(',', ''))
        $(this).toggle(consumer.toLowerCase().indexOf(value) > -1
          && bds.toLowerCase().indexOf(bdsValue) > -1
          && ((type.toLowerCase().indexOf(typeValue) > -1)
              || (typeValue == -1))
          && (area < areaMax  || areaMax == -1)
          && (area > areaMin || areaMin == -1)

          && (price < priceMax  || priceMax == -1)
          && (price > priceMin || priceMin == -1)

          && (unit_price < priceUnitMax  || priceUnitMax == -1)
          && (unit_price > priceUnitMin || priceUnitMin == -1)


          )

      });

// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
     setTimeout(function(){
 var value = $("#search-input").val().toLowerCase();
      var bdsValue = $("#search-input-bds").val().toLowerCase();
      var typeValue = $("#search-type").val().toLowerCase();
    
        areaMin = $("#search-input-area1").val()
        areaMax = $("#search-input-area2").val()
        console.log(areaMin)
        console.log(areaMax)
     
        priceUnitMin = $("#search-input-unit-price1").val()
        priceUnitMax = $("#search-input-unit-price2").val()

        priceMin = $("#search-input-price1").val()
        priceMax = $("#search-input-price2").val()


     
      $("#zone-table tbody tr").filter(function() {
        var consumer =  ($(this)[0].childNodes[3].innerHTML)
        var bds =  ($(this)[0].childNodes[0].innerHTML)
        var type =  ($(this)[0].childNodes[4].innerHTML)
        var area =  parseInt($(this)[0].childNodes[2].innerText.replaceAll(',', ''))
        var price =  parseInt($(this)[0].childNodes[5].innerText.replaceAll(',', ''))
      var unit_price =  parseInt($(this)[0].childNodes[1].innerText.replaceAll(',', ''))
        $(this).toggle(consumer.toLowerCase().indexOf(value) > -1
          && bds.toLowerCase().indexOf(bdsValue) > -1
          && ((type.toLowerCase().indexOf(typeValue) > -1)
              || (typeValue == -1))
          && (area < areaMax  || areaMax == -1)
          && (area > areaMin || areaMin == -1)

          && (price < priceMax  || priceMax == -1)
          && (price > priceMin || priceMin == -1)

          && (unit_price < priceUnitMax  || priceUnitMax == -1)
          && (unit_price > priceUnitMin || priceUnitMin == -1)


          )

      });
      
     }, 3000);
             
}
    });
 $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });

// document.getElementById("close-menu-btn").onclick = function() {getZone()};


  $('#zone-table').DataTable()

      $('#zone-statistic').DataTable()
  $('#zone-statistic2').DataTable()
  
</script>


<style type="text/css">
  #zone .modal-dialog {
    max-width: 1000px;
  }

  #zone .modal-body {
    padding: 0em;
  }

  #zone .modal-content{
    padding: 1em;
  }

  #zone .modal-dialog {
    top: 150px;
  }

</style>



@endsection
