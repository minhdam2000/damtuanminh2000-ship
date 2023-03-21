@extends('layouts.index')
@section('content')
	<div class="content-camera">
		<div class="header-content">
			<div class="header-content-left">
				<h6>Đặt cọc</h6>
			</div>
			<div class="header-content-right" style="display: inline;">
				
				<h6 class="display-inline">Đặt cọc</h6>
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
          
    </ul>  
    <hr>
 <form id="action-form" action="add-deposit"
  enctype="multipart/form-data"  method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" value=" {{$zone->id}}" id="zone_id" name="zone_id" >
 <div id= "info" class="row">
    <div class="col-md-6 col-12 col-sm-12"> 
     <div class="card card-custom">
                                         <div class="card-header" data-toggle="collapse" data-target="#target1">
                                        <h3 class="card-title">
   Thông tin cơ bản</h3>
</div>
                                    
                                      <div class="card-body collapse show"  id="target1" >

<table class="table-edit table-model">
                    <tbody class="table-edit">
              
              <tr>
                <td >Mã BDS: </td>
                <td id="tran-zone">{{$zone->name}}</td>

              </tr>  
              <tr>
                <td >Diện tích: </td>
                <td id="acreage">{{$zone->acreage}}</td>

              </tr>
         
              <tr>
                <td >Giá đặt cọc:</td>
               <td id="tran-price">
                        @if(strpos("LK",$zone->name))
                      50,000,000
                        @endif
                        100,000,000
                </td>
               VND </tbody>

</table>

  <br><hr><br>
</div>



</div>
</div>

          <div class="col-md-6 col-sm-12 col-sm-12" id="c1">  
           <div class="card card-custom">
                                         <div class="card-header" data-toggle="collapse" data-target="#target1">
                                        <h3 class="card-title">
   Thêm khách hàng</h3>
</div>
                                    
                                      <div class="card-body collapse show"  id="target1" >
          <table><tbody>
<td > Thêm khách hàng</td>
<td>  <input value="" id="cname" name="cname" class="input-edit modol-text" required="">
</td>
</tr>
<tr>
<td >Điện thoại</td>
<td>
<input value="" id="cphone" name="cphone" class="input-edit modol-text" required="">
</td>
</tr>
<tr>
<td >Email: </td>
<td>
<input value="" id="cemail" name="cemail" class="input-edit modol-text" required="">
</td>
</tr>
  <tr>
                        <td> Biên nhận chuyển tiền  </td>
                        <td> <label  class="preview" for="file-input"><img onclick="openfileupload(1)"  src="/js-css/img/icon/upload.png"></label><input  id= "inputfile1" style="display:none" type="file" name="file" class="form-control"></td>
                        
                      </tr>

</tbody></table> 

 <input class="btn btn-model form-control" type="submit" value="Xác nhận">
  
</form>
      
                </div>
              </div></div>

          <div class="col-md-12 col-sm-12 col-sm-12">  
<table>
            <thead>
            <tr>
              <td>Tên khách hàng</td>
              <td>Số điện thoại</td>
              <td>Email</td>
              <td>Minh chứng</td>
            </tr>
          </thead>
          <tbody>
            @foreach($cts as $con)
            <tr>
              <td>{{$con->name}}</td>
              <td><a href="tel:{{$con->phone_number}}">{{$con->phone_number}}</a></td>
              <td><a href="mailto:{{$con->email}}">{{$con->email}}</a></td>
              <td><a target="_blank" href="{{$con->url}}">
<i class="fa fa-eye"></i></a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
          </div>

</div>
        
       

	<div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Update successful !</h6>
    </div>
    <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
     </div>


<div class="overlay-dark"></div>
<embed class="img-overlay">

  <script>
    $('#example').DataTable({
        "paging":   false,
        "info":     false,
        "searching": false
      });
function downloadURI(uri, name) {
  var link = document.createElement("a");
  link.download = name;
  link.href = uri;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
  delete link;
}


   function  loadFile(name,$src){
       if (window.innerWidth <  800){
window.open(
  $src,
  '_blank' // <- This is what makes it open in a new window.
);
return 0;
}

      if ($src.includes(".doc")){
        downloadURI($src,name+".docx")
        return
      }else{
      console.log($src)
      $('.img-overlay').attr('src', $src);
      $(".overlay-dark").css('display', 'block');
      $('.img-overlay').css('display', 'block');
      $('.img-overlay').css('opacity', 1);
      $('.img-overlay').css('width', '90%');
      $('.img-overlay').css('height', '90%');
      $('.img-overlay').css('transform', 'translate(-50%, 0) scale(1, 1)');
      console.log("sone")
    }
    }


    $(".overlay-dark").on('click', function() {
      $(".overlay-dark").css('display', 'none');
      $('.img-overlay').css('display', 'none');
      setTimeout(function() {
        $('.img-overlay').css('transform', 'translate(-50%, 0) scale(0, 0)');
      }, 600);
    });


 function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }
  </script>


@endsection
