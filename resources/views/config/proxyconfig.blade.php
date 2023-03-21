@extends('layouts.index')
@section('content')
<meta name="csrf-token" content="{!! csrf_token() !!}">
<div class="content-camera">
   <div class="header-content">
      <div class="header-content-left">
         <h6>Camera Management / Onvif Scan</h6>
      </div>
      <div class="header-content-right" style="display: inline;">
         <a href="/">
            <h6 class="display-inline link-active"><i class="fa fa-home"></i> Home </h6>
         </a>
         /
         <h6 class="display-inline">Device Management</h6>
      </div>
   </div>
   <div class="card card-color">
      <div class="table-container">
         <div class="wrapper" id="wrapper">
            @if(session()->get('failed') != NULL)
            <br>
            <div>{{session()->get('failed')}}</div>
            @endif
            <div class="header-form">
               <h6 class="button-left">List of Cameras</h6>
               <div class="button-right"><button class="btn-button btn-update" id="add_device" data-toggle="modal" data-target="#modalInput"><i class="fa fa-refresh"></i> &nbsp;Rescan</button></div>
            </div>
            <table id="div1" class="font-fix">
            <thead class="deader-color"> 
            <th class="cart_product">Name</th>
            <th>IP</th>
            <th>Manufacturer</th>
            <th>Firmware Version</th>
            <th>Serial Number</th>
            <th>Path</th>
            <th><center>Add</center></th>
            </thead>
            <tbody id="createTr">
            </tbody>
            </table>    
            <div id="add"></div>
            <div class="cart_navigation "></div>
         </div>
      </div>
      <center>
      <a id="background-loading">
      <img id="gif_load" src="js-css/img/loading.gif" width="100" height="100">
      </a>
      </center>
      <div class="info-footer">
         <i class="fa fa-info-circle"></i>
         <i>&nbsp; Each camera must have unique RTSP and ONVIF ports. These ports should be specified when a new camera is added. You must reboot DASCAM Protect for the changes to take effect.</i>
      </div>
   </div>
</div>
<!-- Modal-edit-camera -->
<div class="modal fade " id="myModal">
   <form id="action" method="POST">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <label>
               <i class="fa fa-pencil-square" aria-hidden="true" style="font-size: 1.2em;"></i>&nbsp; Camera configuration &nbsp;
               </label>
            </div>
            <div class="notification"></div>
            <div class="modal-body modal-config">
               <table class="table-edit table-model">
                  <tbody class="table-edit">
                     <tr>
                        <td><i class="fa fa-bookmark-o"></i> &nbsp; Camera name</td>
                        <td><input id="camname" type="text" name="name" class="input-edit modol-text input"></td>
                     </tr>
                     <tr>
                        <td><i class="fa fa-lock"></i> &nbsp; Login password</td>
                        <td><input id="pass_word" type="text" name="password" class="input-edit modol-text input"></td>
                     </tr>
                     <tr>
                        <td><i class="fa fa-map-marker"></i> &nbsp; Device Description</td>
                        <td><input id="location_device" type="text" name="location" class="input-edit modol-text input"></td>
                     </tr>
                     <tr>
                        <td><i class="fa fa-cog"></i> &nbsp; Path</td>
                        <td><input id="path" type="text" name="path" class="input-edit modol-text input"></td>
                     </tr>
                  </tbody>
               </table>
               <input hidden="" required="" class="input" type="text" name="IP" id="add_model">
               <input hidden="" required="" class="input" type="text" name="MAC" id="add_host">
               <input hidden="" required="" class="input" type="text" name="IFACE" id="add_manufacturer">
               <input hidden="" required="" class="input" type="text" name="IFACE" id="add_firmware_version">
               <input hidden="" required="" class="input" type="text" name="IFACE" id="add_serial_number">
               <input hidden="" required="" class="input" type="text" name="IFACE" id="add_path">
               <input hidden="" required="" class="input" type="text" name="IFACE" id="index_tr">

            </div>
            <div class="modal-footer">
               <button id="sign" name="signin" class="btn btn-model save"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save change</button>
               <button style="float: right;" id="sign1" name="signin1" class="btn btn-model closed" onclick="close_form()" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</button>
            </div>
         </div>
      </div>
   </form>
</div>


<div class="modal fade modol-text" id="modalInput" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>
                    <i class="fa fa-pencil-square" aria-hidden="true" style="font-size: 1.2em;"></i>&nbsp; Enter username, password &nbsp;
                    </a>
                  </label>
              </div>
              <div class="modal-body">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                        <tr>
                          <td><i class="fa fa-bookmark-o" aria-hidden="true"></i> Username</td>
                          <td><input type="" value="" name="cam_name" class="input-edit modol-text" id="cam_name"></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-bookmark-o" aria-hidden="true"></i> Password</td>
                            <td><input type="" value="" name="cam_pass" class="input-edit modol-text" id="cam_pass"></td>
                        </tr>
                    </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button class="btn btn-model a-model" onclick="scanDevice()"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Scan</button>
                <button type="button" class="btn btn-model" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</button>
              </div>
            </div>   
          </div>
      </div>
      <!-- end modal --->


<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Add camera successful !</h6>
</div>
<div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
</div>
<script>
   $(document).ready(function() {
       $("#myModal").modal({
           show: false,
           backdrop: 'static'
       });
   });
   
   function close_form(){
   	var inputs = document.getElementsByClassName('input');
   	for(i=0; i<inputs.length; i++){
   		inputs[i].value = '';
   	}
   	document.getElementsByClassName('notification')[0].innerHTML ='';
   	document.getElementsByClassName('notification')[0].classList.remove('notification-color');
   }
</script>
<script type="text/javascript">
   function closeForm() {
   	document.getElementById("myForm").style.display = "none";
   }

   function sendArp() {
    var cam_name = document.getElementById("cam_name").value;
    var cam_pass = document.getElementById("cam_pass").value;
    if(cam_name == ""){
      cam_name = "null";
    }
    if(cam_pass == ""){
      cam_pass = "null";
    }
    try {
      $.get('get-cam-onvif/'+ {!!$proxyid!!} + "/"+cam_name+"/"+cam_pass, async function(res) {
        $('#createTr').remove();
        $('#add').remove();
        var new_tbody = document.createElement("tbody");
        new_tbody.id = 'createTr';
        var div1 = document.getElementById("div1");
        div1.appendChild(new_tbody);
        var add = document.createElement("div");
        add.id = "add";
        var d = document.getElementById("wrapper");
        d.appendChild(add);
        var div2 = [];
        var form = [];
        var wrapper = document.getElementById("add");
        var input = [];
        var button1 = [];
        var button2 = [];
        var elementsButton = [];
        var elementsTr = await generatedTable(res);
        await setUpDefault();
        await addCam();      

        var count = document.getElementsByClassName('count').length;
        for (var t = 0; t < count; t++) {
            document.getElementById("tr" + t + "td6").addEventListener('click', function(t) {
                var plus_button = this;
                signClick(plus_button);          
            })
        }
      })
    }
    catch(err) {
      console.log(err);
      setUpDefault();
    }
    
}
   	
   
   $(document).ready(function () { 
   	$("#background-loading").hide();
   });     


   function scanDevice(){
      $('#modalInput').modal('hide');
      var addButton = document.getElementsByClassName('add-button');
      for(i = 0; i<addButton.length; i++){
        addButton[i].disabled = true;         
      }
      document.getElementById('add_device').disabled = true;
      $("#background-loading").show();
      document.getElementById('createTr').innerHTML='';
      sendArp();      
    };
   

   function generatedTable(res) {
    console.log(res)
      var elementsTr = [];
      for(var i = 0; i < res.length; i++){
   
               elementsTr[i] = document.createElement("tr");
               elementsTr[i].id = "tr" + i;
               elementsTr[i].classList.add("count");;
               var div = document.getElementById("createTr");
               div.appendChild(elementsTr[i]);
   
               var elementsTd = [];
               elementsTd[0] = document.createElement("td");
               elementsTd[1] = document.createElement("td");
               elementsTd[2] = document.createElement("td");
               elementsTd[3] = document.createElement("td");
               elementsTd[4] = document.createElement("td");
               elementsTd[5] = document.createElement("td");
               elementsTd[6] = document.createElement("td");
               elementsTd[0].id = "tr"+i+"td0";
               elementsTd[1].id = "tr"+i+"td1";
               elementsTd[2].id = "tr"+i+"td2";
               elementsTd[3].id = "tr"+i+"td3";
               elementsTd[4].id = "tr"+i+"td4";
               elementsTd[5].id = "tr"+i+"td5";
               elementsTd[6].id = "tr"+i+"td6";
   
               var tds = document.getElementById("tr"+i);
   
               tds.appendChild(elementsTd[0]);
               tds.appendChild(elementsTd[1]);
               tds.appendChild(elementsTd[2]);
               tds.appendChild(elementsTd[3]);
               tds.appendChild(elementsTd[4]);
               tds.appendChild(elementsTd[5]);
               tds.appendChild(elementsTd[6]);

               document.getElementById("tr"+i+"td0").innerHTML = res[i]['model'];
               document.getElementById("tr"+i+"td1").innerHTML = res[i]['host'];
               document.getElementById("tr"+i+"td2").innerHTML = res[i]['manufacturer'];
               document.getElementById("tr"+i+"td3").innerHTML = res[i]['firmware_version'];
               document.getElementById("tr"+i+"td4").innerHTML = res[i]['serial_number'];
               document.getElementById("tr"+i+"td5").innerHTML = res[i]['first live tcp stream'];
               document.getElementById("tr"+i+"td6").innerHTML = "<center>" +
                  "<button class='custom-button add-button click-me btn-model' href='#signup'" +
                   "data-toggle='modal' data-target='.log-sign' title='Add' ><i class='fa fa-plus-circle'></i></button>" +
                  "</center>";
               document.getElementById("tr"+i+"td6").setAttribute('name',res[i]['host']);
            }
            return elementsTr;
   }


   


   function setUpDefault() {
      $("#background-loading").hide();
        var addButton = document.getElementsByClassName('add-button');
        for (i = 0; i < addButton.length; i++) {
            addButton[i].disabled = false;
        }
        document.getElementById('add_device').disabled = false;
        document.getElementById('add_device').disabled = false;
        document.getElementById('add_device').classList.add('btn-button');
   }

   function addCam() {
      $(".add-button").click(function() {
                  $("#myModal").modal("show");
                  var cha = this.parentElement.parentElement.parentElement;
                  var model = cha.childNodes[0].textContent;
                  var host = cha.childNodes[1].textContent;
                  var manufacturer = cha.childNodes[2].textContent;
                  var firmware_version = cha.childNodes[3].textContent;
                  var serial_number = cha.childNodes[4].textContent;
                  var path = cha.childNodes[5].textContent;
                  

                  input1 = document.getElementById("add_model").value = model;
                  input2 = document.getElementById("add_host").value = host;
                  input3 = document.getElementById("add_manufacturer").value = manufacturer;
                  input4 = document.getElementById("add_firmware_version").value = firmware_version;
                  input5 = document.getElementById("add_serial_number").value = serial_number;
                  input6 = document.getElementById("add_path").value = path;
                  inputIndexTr = document.getElementById("index_tr").value = cha.id
            
               })  
   }


   function signClick(plus_button){
      var model = document.getElementById("add_model").value;
      var host = document.getElementById("add_host").value;
      var manufacturer = document.getElementById("add_manufacturer").value;
      var firmware_version = document.getElementById("add_firmware_version").value;
      var serial_number = document.getElementById("add_serial_number").value;
      var path = document.getElementById("add_path").value;
      document.getElementById("sign").onclick = function(e) {
                    e.preventDefault();
                    password = document.getElementById("pass_word").value;
                    model = document.getElementById("add_model").value;
                    host = document.getElementById("add_host").value;
                    manufacturer = document.getElementById("add_manufacturer").value;
                    firmware_version = document.getElementById("add_firmware_version").value;
                    serial_number = document.getElementById("add_serial_number").value;
                    path = document.getElementById("add_path").value;
                    var proxyid = {!!$proxyid!!};

                    if (password == '') {
                        snakeModel();
                        document.getElementsByClassName('notification')[0].innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> The entry already exists or its port is contained by another one.";
                        document.getElementsByClassName('notification')[0].classList.add('notification-color');
                    } else { 
                      loading_nomal();
                      saveToDb(model, host, manufacturer, firmware_version, serial_number, path);
                    }

                }
   }

    function saveToDb(model, host, manufacturer, firmware_version, serial_number, path){
      var camera_selected = $("#"+document.getElementById("index_tr").value);
      arrays =[model, host, manufacturer, firmware_version, serial_number, path];
      var proxyid = {!! $proxyid !!};
      $.ajax({
        type: "POST",
        data : {"_token": $('meta[name="csrf-token"]').attr('content'),arrays},
        url : "sendconfig/"+proxyid,
        success: function(msg){
          close_loading()
          $('#myModal').modal('hide');
          close_form();
          if(msg == "true"){
            notifiSuccess("Add camera successful.");
            camera_selected.remove();
          }
          else{
            notifiWarning("Add camera failed.");
          }
        }
      })
    }


   
</script>
<script>
   function snakeModel(){
   	$("#myModal").addClass("shake-model");
             setTimeout(function() { 
                 $("#myModal").removeClass("shake-model");
             }, 1000);
         }
</script>
@endsection