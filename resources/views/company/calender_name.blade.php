@extends('../layouts/index')
@section('content')

<style type="text/css">
	@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
	.modal-body{
		padding :1rem;
	}
	.model-right{ 
		height:auto;
	}
	.row {
		margin-left: 20px;
	}
	.label-info{
		background-color: red!important;

	}

	.bootstrap-tagsinput{
		width: 100%;
	}
	.label {
		color: white;
		position: inherit;
		display: inline-block;
		padding: .25em .4em;
		font-size: 75%;
		font-weight: 700;
		line-height: 1;
		text-align: center;
		white-space: nowrap;
		vertical-align: baseline;
		border-radius: .25rem;
		transition: color .15s ease-in-out,background-color .15s ease-in-out,
		border-color .15s ease-in-out,box-shadow .15s ease-in-out;
		pointer-events: all;
	}
	.GoogleContent iframe{

		width: 100%;
		min-height: 400px;
	}
	.row-title-proxy{
		margin-left: 0px;
	}
</style>
<link rel="stylesheet" href="/js/taginputs/bootstrap-tagsinput.css"  />

<script src="/js/taginputs/bootstrap.min.js" ></script>
<script src="/js/taginputs/bootstrap-tagsinput.js"></script>
<script src="/js/taginputs/bootstrap-tagsinput-angular.min.js"></script>
<div class="content-camera">
	<div class="header-content">
		<div class="header-content-left">
			<h6></h6>
		</div>
		<div class="header-content-right" style="display: inline;">
			<a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i>  </h6></a>
			<h6 class="display-inline">Danh sách lịch công </h6>
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
	<ul class="nav nav-tabs" id="tabs" role="tablist">

		<li class="nav-item margin_center">
			<a id="tab3" class="nav-link color-a" 
			data-toggle="tab" role="tab" href="#content2"> Danh sách lịch  </a>
		</li>
	</ul> 
	<div  class="row row-content">
		<hr><br>
		<div  class="tab-content" style="width: 100%;">
			<div id="content2" class="tab-pane  active in bigtab">
				<ul class="nav nav-tabs" id="tabs" role="tablist">
					<li class="nav-item margin_center">
						<h4 style="margin-top:1rem;">&nbsp; Lịch công ty </h4>
					</li>    
				</ul>
				<br>
				<button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-stepa">Thêm hạng mục</button>
				<br>
				<div class="proxy-add" id="tai" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>
				<ul class="nav nav-tabs" id="tabs" role="tablist">
					<li class="nav-item margin_center">
						<a id="tab0" class="nav-link active color-a"  data-toggle="tab" onclick="ToggleNext()" role="tab" href="#content0">Danh sách lịch công ty</a>
					</li> 

				</ul>
				<div class="active-view" id ="cv">
					<table id="camera-tag-table" class="nvr-table">
						<thead>
							<tr class="thead">
								<th>Tên </th>
								<th></th> 
							</tr>
						</thead>
						<tbody class="tbody">
							@foreach($companys as $company)

                            <tr class="color-add">
                             <td><a target="_blank" href= "canlender/calendar_list/{{$company->id}}" class="preview"><span  id="name{{$company->id}}">{{$company->name}}</span></a></td>
                               
                             
                              <td> 
                                <button style="color: white"  type="button" onclick="updatetag('{{$company->id}}')" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/notepad.png"></span></button>


                                      <a class="sicon" onclick="confirm_tag(this,{{$company->id}})">
                             <span class="preview"><img src="/js-css/img/icon/recycle_bin.png"></span>
                           </a>

                             
                            </td>
                            </tr>
                          @endforeach

						</tbody>
					</table>
				</div>

				 <!-- end model --->
          <div class="modal fade modol-text" id="new-stepa" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Tạo danh sách </label>
              </div>
              <div class="notification"></div>
              <form action="add-calenderct" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Tên </td>
                                <td><input type="" value="" name="name" class="input-edit modol-text" id="name" required=""></td>
                            </tr>

                                            
                            <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>

      <!-- Modal content-->
        <div class="modal fade modol-text" id="EditTagModal" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Chỉnh sửa thông tin  </label>
              </div>
              <div class="notification"></div>
              <form action="update-canlender" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="editTagId">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Tên</td>
                                <td><input type="" value="" name="name" class="input-edit modol-text" id="editTagName" required=""></td>

                            </tr>


                            <tr>
                                <td></td>
                                <td>

                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div> 

			</div>
		</div>
	</div>
</div>
</div>	
<script type="text/javascript">

     $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.bigtab').removeClass('active');

        $("#"+this.href.split("#")[1]).addClass('active');


    });

    $(document).ready(function() {
      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }
  });
  </script>
  <script>

  function confirm_remove() {
          var remove = document.getElementById('device-removea');
          remove.addEventListener('click', function(e){
              swal({
                  title: "",
                  text: " Bạn có muốn xóa không? ",
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
                    document.getElementById("EditDelete").click();
                    swal.close();
                  }
                  else {
                    swal.close();
                  }
                });
            });
        }
        confirm_remove();

        function removeFile(id) {
    console.log("Okoekqr");
              swal({
                  title: "",
                  text: " Bạn có muốn xóa tệp này không?1 ",
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
                    location.href  = "/delete-vip/"+id
                    swal.close();
                  }
                  else {
                    swal.close();
                  }
                });
           }
</script>
<script type="text/javascript">
  
        function confirm_tag(ele,id) {
              // ele.preventDefault()
              swal({ 
                  title: "",   
                  text: " Bạn có chắc muốn xóa không !",   
                  type: "info",   
                  showCancelButton: true,     
                  confirmButtonText: "Có ",   
                  cancelButtonText: "Không",   
                  closeOnConfirm: false,   
                  closeOnCancel: false,
                  reverseButtons: true }, 
                  function(isConfirm){   
                  if (isConfirm) 
                  {   
                    loading_nomal()
                    location.href="canlender/delete/"+id
                    swal.close(); 
                  } 
                  else {     
                    swal.close();  
                  } 
                });
        }
</script>
  <script src="/js-css/js/bootstrap-select.min.js"></script>
  <script src="/js-css/js/ckeditor/ckeditor.js"></script>
  <script type="text/javascript">

      function updatetag(id){
         
  document.getElementById("editTagId").value = id
  document.getElementById("editTagName").value = document.getElementById("name"+id).innerHTML
$("#EditTagModal").modal()
}
    function updateInfo(id){
          document.getElementById("EditId").value = id

          document.getElementById("editname").value = document.getElementById("name"+id).innerHTML

  $("#cv").tagsinput('removeAll');
var rawhtml = $("#tag"+id).html();
     if (rawhtml.length > 1){
     rawhtml = rawhtml.split(',');
     for (var i = 0; i < rawhtml.length;i++){
    $('#cv').tagsinput('add', rawhtml[i]);
    }
  }
  document.getElementById("EditDelete").href = "/delete-vip/" + id 
        
        $("#EditInfoModal").modal()




   function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }

  function  Edit(id){
  document.getElementById("editId").value = id
  document.getElementById("editName").value = document.getElementById("name"+id).innerHTML
$("#EditInfoModal").modal()

}  


}
</script>
<!-- DataTables -->
  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
  <script type="text/javascript">
    


    $('#camera-tag-table').DataTable()


    $('#camera-table').DataTable({

    "drawCallback": function( settings ) { 
      $('.mytags').each(function(){
     var rawhtml = $(this).html();
     if (rawhtml.length > 1 && rawhtml.includes("bootstrap-tagsinput") == false){
     rawhtml = rawhtml.split(',');

     html = '<div class="bootstrap-tagsinput">'
     for (var i = 0; i < rawhtml.length;i++){
      html = html + '<span class="tag label label-info" style="display: inline-block;">'+rawhtml[i]+'</span>'
    }
    html = html + "</div>"
      $(this).html(html)
     }
 });

     $('.mygrouptags').each(function(){
     var rawhtml = $(this).html();
     if (rawhtml.length > 1 && rawhtml.includes("bootstrap-tagsinput") == false){
     rawhtml = rawhtml.split(',');

     html = '<div class="bootstrap-tagsinput">'
     for (var i = 0; i < rawhtml.length;i++){
      html = html + '<span class="tag label label-info" style="display: inline-block;">'+rawhtml[i]+'</span>'
    }
    html = html + "</div>"
      $(this).html(html)
     }
     
 });
    }
});
   
function formatForId(id){
    var value = document.getElementById(id+"_display").value
    value = parseFloat(value.replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    console.log(value)
    console.log(value.replace(/,/g, ""))
    if (isNaN(parseInt(value))){
    if(id.includes("1")){
    document.getElementById(id+"_display").value = 0
    }else{
    document.getElementById(id+"_display").value = "Không giới hạn"

    }
    document.getElementById(id).value = -1 
    }else{
    document.getElementById(id+"_display").value = value
    
    document.getElementById(id).value = value.replace(/,/g, "") 
  }
}

  </script>
  <script type="text/javascript">
    $("#search-input-btn").on("click", function() {

      // getZone()

      var value = $("#search-input").val().toLowerCase();
      var targetValue = $("#search-input1").val().toLowerCase();
      var typeValue = $("#search-input2").val().toLowerCase();
      var noteValue = $("#search-input3").val().toLowerCase();
      var tagsValue = $("#search-type").val().toLowerCase();
    
   
     
        priceUnitMin = $("#search-input-unit-price1").val()
        priceUnitMax = $("#search-input-unit-price2").val()

        document.getElementById("camera-table-old").style.display="block"
        document.getElementById("camera-table-old").classList.add("d-md-table");
        document.getElementById("camera-table").style.display="none"
        document.getElementById("tai1").style.display="block"
        document.getElementById("cv").style.display="none"
        document.getElementById("tai").style.display="none"
      $("#camera-table-old tbody tr").filter(function() {
        
        var content =  ($(this)[0].childNodes[1].innerHTML)
        // console.log(priceUnitMax)
        // console.log(priceUnitMin)
        var target =  ($(this)[0].childNodes[3].innerHTML)
        var unit_price =  parseInt(($(this)[0].childNodes[5].childNodes[1].nodeValue).replaceAll(',', ''))

        var type =  ($(this)[0].childNodes[7].innerText)
        var note =  ($(this)[0].childNodes[9].innerText)
      var date =  ($(this)[0].childNodes[11].innerText)
      var tags =  ($(this)[0].childNodes[13].innerText)
        $(this).toggle(
          (content.toLowerCase().indexOf(value) > -1 ||
          target.toLowerCase().indexOf(value) > -1||
          note.toLowerCase().indexOf(value) > -1||
          tags.toLowerCase().indexOf(value) > -1
          || (typeValue == -1))
          && (unit_price < priceUnitMax  || priceUnitMax == -1)
          && (unit_price > priceUnitMin || priceUnitMin == -1)


          )

      });
      

      });

 $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });

// document.getElementById("close-menu-btn").onclick = function() {getZone()};

function ToggleNext(){
  $("#new-url1").slideToggle();
  
}

</script>

@endsection