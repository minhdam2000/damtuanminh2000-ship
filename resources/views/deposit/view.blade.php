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
                <td >Giá đặc cọc:</td>
               <td id="tran-price">
                        @if(strpos("LK",$zone->name))
                      50,000,000
                        @endif
                        100,000,000
                </td>
               VND </tbody>

</table>
                  <table id="example" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th> Đầu mục </th>
                        <th> Minh chứng</th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      <tr>
                        <td>Phiếu cọc  </td>
                        <td> <a  target="_blank" href="{{$deposit->url1}}" class="preview" type="button"><img src="/js-css/img/icon/dowload.png"></a></td>
                       

                      </tr>

                      <tr>
                        <td> Biên nhận chuyển tiền  </td>
                    <td> <a  target="_blank" href="{{$deposit->url2}}" class="preview" type="button"><img src="/js-css/img/icon/dowload.png"></a></td>
                       
                      </tr>

                     
                    </tbody>
                  </table>
         
</div></div></div>

          <div class="col-md-6 col-sm-12 col-sm-12" id="c1">  
           <div class="card card-custom">
                                         <div class="card-header" data-toggle="collapse" data-target="#target1">
                                        <h3 class="card-title">
   Thông tin khách hàng</h3>
</div>
                                    
                                      <div class="card-body collapse show"  id="target1" >
    <table><tbody>
            <tr>
<td id="confirm_role1" >Tên khách hàng</td>
   <td id="confirm_name1">{{$consumer->name}}</td>


</tr>
<tr>
<td > Ngày sinh </td>
 <td id="confirm_bd1">{{$consumer->birth_date}}</td>

</tr>
<tr>
<td >Điện thoại</td>
 <td id="confirm_phone1">{{$consumer->phone_number}}</td>
</tr>
<tr>
<td >Email: </td>

 <td id="confirm_email1">{{$consumer->email}}</td>
</tr>

<tr>
<td > Số căn cước</td>


 <td id="confirm_iden1">{{$consumer->identify_card}}</td>
</tr>
</tbody></table>      
<form action="update-deposit" method="post">
   <input type="hidden" name="_token" value="{{csrf_token()}}">

        <input type="hidden" value=" {{$deposit->id}}" id="id" name="id" class="input-edit modol-text" >


  <table class="table-edit table-model">
                    <tbody class="table-edit">
                        
              <tr>
                            <td> Thời gian book</td>
                            <td><input type="date" value="" name="content" class="input-edit modol-text" > 
                            </td>
                       <td>
                            <button type="submit" class="btn btn-model">Đặt </button>
                          </td>
                        </tr>
                        
                          
                      </tbody>
                    </table>
</form>    

<form action="remove-deposit" method="post">
   <input type="hidden" name="_token" value="{{csrf_token()}}">

        <input type="hidden" value=" {{$deposit->id}}" id="id" name="id" class="input-edit modol-text" >


  <table class="table-edit table-model">
                    <tbody class="table-edit">
                        
              <tr>
                            <td> Hủy cọc</td>
                            <td><input type="" value="" name="content" class="input-edit modol-text" >
 <input value="" style="display:none" type="number" id="vat" name="vat">    
                            </td>
                       <td>
                            <button type="submit" class="btn btn-model">Hủy </button>
                          </td>
                        </tr>
                        <tr>
                          <td>
                             <a href="deposit-trans/{{$deposit->id}}" class="btn btn-model"> Kí hợp đồng </a>

                          </td>
                        </tr>
                          
                      </tbody>
                    </table>
</form>      
                </div>
              </div></div>

</div>
       
          <br><hr><br>

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
