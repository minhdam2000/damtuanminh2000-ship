@extends('../layouts/index')
@section('content')
  <div class="content-camera">
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
            <a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i> Home </h6></a>
        /
        <h6 class="display-inline">Config Management</h6>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="row-content">
          <div class="row" style="height: 84vh;">
            <div class="col-sm-2 border-right-group">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                @foreach($json_config as $group => $val)
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#{{$group}}" role="tab" aria-controls="v-pills-settings" aria-selected="false">{{$group}}</a>
                @endforeach
              </div>
            </div>
            <div class="col-sm-10">
              <div style="height: 45px;">
                <a style="float: left;">
                  <div class="account-add" style="float: none;"><button class="camera-button" data-toggle="modal" data-target="#create-group"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp; New Group</button>
                  </div>
                </a>
                <a link="/sendConfig" id="send-config" style="float:right;"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Send config to AI Detect</a>
                <a href="/config/12760.json" download style="float:right; float:right;margin-right: 30px;"><i class="fa fa-download" aria-hidden="true"></i> export to file</a>
              </div>
              <div class="tab-content" id="v-pills-tabContent">
                @foreach($json_config as $group => $val)
                <div class="tab-pane fade" id="{{$group}}" role="tabpanel" aria-labelledby="v-pills-settings">
                  <div class="card card-config">
                    <div class="card-body">
                      <div id="table" class="table-editable">
                        <table class="table table-bordered table-responsive-md table-striped text-center table-config" style="margin-top: 10px;">
                          <thead class="deader-color">
                            <tr>
                              <th class="text-center">Key</th>
                              <th class="text-center">Value</th>
                              <th class="text-center">Meaning</th>
                              <th class="text-center"><span class="table-remove"><button class="btn btn-success btn-rounded btn-sm my-0" data-toggle="modal" data-target="#create-key" onclick="getInfoGroup('{{$group}}')"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp; New</button></span></th>
                            </tr>
                          </thead>
                          <tbody id="tbody-{{$group}}">
                            @foreach($json_config[$group] as $key => $val)
                            <tr>
                              <td class="pt-3-half">{{$key}}</td>
                              <td class="pt-3-half" onclick="listenForDoubleClick(this);" onblur="updateConfig(this,'{{$group}}','{{$key}}')">
                                {{$json_config[$group][$key]["value"]}}
                              </td>
                              <td class="pt-3-half">{{$json_config[$group][$key]["Meaning"]}}</td>
                              <td class="pt-3-half option">
                                <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0" onclick="removeKey(this,'{{$group}}','{{$key}}')">Remove</button></span>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <div class="account-add remove-group"><u onclick="removeGroup('{{$group}}')">Remove Group</u></div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>

  <!-- Modal -->
      <div class="modal fade modol-text" id="create-group" role="dialog">
        <form id="create-form" action="create-group/{{$edge_profile_id}}" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Create New Group</label>
              </div>
              <div class="notification"></div>
              <div class="modal-body modal-config">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                        <tr>
                            <td class="cam-properties">Group Name</td>
                            <td><input type="" value="" name="group_name" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        <tr>
                            <td class="cam-properties">Meaning</td>
                            <td><textarea type="text" value="" name="group_meaning" class="input-edit create-user modol-text"></textarea></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>
                            <button class="btn btn-model" type="submit">Create Group</button>
                            <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form()">Cancel</button>
                          </td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
      </div>


    <!-- Modal -->
      <div class="modal fade modol-text" id="create-key" role="dialog">
        <form id="create-key-form" action="create-key/{{$edge_profile_id}}" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Create New Key</label>
              </div>
              <div class="notification-key"></div>
              <div class="modal-body modal-config" style="padding-bottom: 0px;">
                <table class="table-edit table-model">
                    <tbody class="table-edit">
                        <tr>
                            <td class="cam-properties">Group</td>
                            <td><input type="" value="" id="current-group-label" name="group_name-label" class="input-edit create-user modol-text" disabled=""></td>
                            <input type="" value="" id="current-group" name="group_name" hidden="">
                        </tr>
                        <tr>
                            <td class="cam-properties">Key Name</td>
                            <td><input type="" value="" name="key_name" class="input-edit create-user modol-text" required=""></td>
                        </tr>
                        <tr>
                            <td class="cam-properties">Value</td>
                            <td><input type="" value="" name="key_value" class="input-edit create-user modol-text"></td>
                        </tr>
                        <tr>
                            <td class="cam-properties">Meaning</td>
                            <td><textarea type="text" value="" name="key_meaning" class="input-edit create-user modol-text"></textarea></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>
                            <button class="btn btn-model" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Create</button>
                            <button type="button" class="btn btn-model" data-dismiss="modal" onclick="close_form_key()"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Cancel</button>
                          </td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
      </div>

  <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
    </div>
    <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
     </div>


<script type="text/javascript">
  function notifiWarning(warning){
    var x = document.getElementById("snackbar-warning");
    x.className = "show";
    x.childNodes[2].innerHTML = warning;
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
  }

  function notifiSuccess(success){
    var x = document.getElementById("snackbar");
    x.className = "show";
    x.childNodes[2].innerHTML = success;
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
  }

  if($("#notice_warning").val() == 1){
    notifiWarning($("#notice_warning").attr("notifi"));
  }
  if($("#notice_success").val() == 1){
    notifiSuccess($("#notice_success").attr("notifi"));
  }
</script>

<!-- Thay doi cau hinh  -->
<script>

function listenForDoubleClick(element) {
  element.contentEditable = true;
  setTimeout(function() {
    if (document.activeElement !== element) {
      element.contentEditable = false;
    }
  }, 300);
}

function updateConfig(element, group, key) {
  element.contentEditable=false;
  
  if(element.textContent == ""){
    value = "value_is_null";
  }
  else{
    value = element.textContent.split("/");
    if(value.length != 1){
      value = value.join('@@@@@');
      value = value.replace(/\?/g, "ky_tu_hoi");
      url = 'updateconfigfile/'+{!!$edge_profile_id!!}+'/'+group+'/'+key+'/'+value;
      $.ajax({
        url: url,
        success: function(res) {
          console.log(res);         
        }
      });
    }
    else{
      value = value[0]
      url = 'updateconfigfile/'+{!!$edge_profile_id!!}+'/'+group+'/'+key+'/'+value;
      $.ajax({
        url: url,
        success: function(res) {
          console.log(res);         
        }
      });
    }
  }
  
  


}
</script>

<!-- Them group cau hinh -->
<script>
  $("#create-form").submit(function(event){
      event.preventDefault(); //prevent default action 
      var post_url = $(this).attr("action"); //get form action url
      var request_method = $(this).attr("method"); //get form GET/POST method
      var form_data = new FormData(this); //Creates new FormData object
      group = form_data.get('group_name');
      if((group.split(" ").length)>1){
        snakeModel();
        document.getElementsByClassName('notification')[0].innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Invalid group.";
        document.getElementsByClassName('notification')[0].classList.add('notification-color');
      }
      else{
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
            window.location.href = 'create-group-success/'+{!! $edge_profile_id !!};
          }
          else{
            snakeModel();
            document.getElementsByClassName('notification')[0].innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Group already exists.";
            document.getElementsByClassName('notification')[0].classList.add('notification-color');
          }
        });  
      }
      
  });
</script>

<!-- Them key-value trong tung group -->

<script type="text/javascript">
  function getInfoGroup(group){
    $("#current-group-label").val(group);
    $("#current-group").val(group);

    $('input[name="key_name"]').val('');
    $('input[name="key_value"]').val('');
    $('textarea[name="key_meaning"]').val('');
  }

  $("#create-key-form").submit(function(event){
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
        if(response != 'key already exist'){
          group = form_data.get('group_name');
          key = form_data.get('key_name');
          value = form_data.get('key_value');
          meaning = form_data.get('key_meaning');
          $('#tbody-'+response).append(
            '<tr>'+
              '<td class="pt-3-half">'+key+'</td>'+
              '<td class="pt-3-half" onclick="listenForDoubleClick(this);" onblur="updateConfig(this,\''+group+'\',\''+key+'\')">'+value+'</td>'+
              '<td class="pt-3-half">'+meaning+'</td>'+
              '<td class="pt-3-half option">'+
                '<span class="table-remove">'+
                  '<button type="button" class="btn btn-danger btn-rounded btn-sm my-0" onclick="removeKey(this,\''+group+'\',\''+key+'\')">Remove</button>'+
                '</span>'+
            '</tr>'
          );
          $("#create-key").modal("hide");
        }
        else{
          snakeModelKey();
          document.getElementsByClassName('notification-key')[0].innerHTML = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Key already exists.";
          document.getElementsByClassName('notification-key')[0].classList.add('notification-color');
        }
      });
  });
</script>


<!-- xoa key trong tung group -->
<script type="text/javascript">
  function removeKey(element, group, key){
    $.ajax({
      url: 'remove-key/'+{!!$edge_profile_id!!}+'/'+group+'/'+key,
      success: function(res) {
        if(res = 'true'){
          element.parentElement.parentElement.parentElement.remove()
        }          
      }
    });
  }
</script>

<script type="text/javascript">
  function confirmDeleteGroup(text, edge_profile_id, group){
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
      loading_nomal()
      console.log('remove-group/'+edge_profile_id+'/'+group)
      $.ajax({
          url: 'remove-group/'+edge_profile_id+'/'+group,
          success: function(res) {
            if(res = 'true'){
              window.location.href = 'remove-group-success/'+edge_profile_id;
            }
          }
        });
      swal.close(); 
    } 
    else {     
      swal.close();  
    } 
  });
  $(".btn-primary").css('border', 'none');
  $(".showSweetAlert").attr('style', 'display: block; background-image: url(/js-css/img/gray.jpg);');
  $(".text-muted").attr('style', 'color: #fff !important');
}
</script>

<!-- xoa group trong file cau hinh -->
<script type="text/javascript">
  function removeGroup(group){
    confirmDeleteGroup('* are you sure?.',{!!$edge_profile_id!!},group);
  }
</script>

<script>
  function close_form(){
      document.getElementsByClassName('notification')[0].innerHTML ='';
      document.getElementsByClassName('notification')[0].classList.remove('notification-color');
    }

  function close_form_key(){
    document.getElementsByClassName('notification-key')[0].innerHTML ='';
    document.getElementsByClassName('notification-key')[0].classList.remove('notification-color');
  }
</script>

<script>
    function snakeModel(){
      $("#create-group").addClass("shake-model");
            setTimeout(function() { 
                $("#create-group").removeClass("shake-model");
            }, 1000);
        }

      function snakeModelKey(){
      $("#create-key").addClass("shake-model");
            setTimeout(function() { 
                $("#create-key").removeClass("shake-model");
            }, 1000);
        }
  </script>

  <!-- xac nhan gui file cau hinh -->
  <script type="text/javascript">
      var link = document.getElementById('send-config').getAttribute("link");
      document.getElementById('send-config').addEventListener('click', function(e){
        JSconfirm("Please confirm to update the Edge Storage.", link);
      });
  </script>

@endsection
