@extends('layouts.index')
@section('content')
	<div class="content-camera">
		<div class="header-content">
			<div class="header-content-left">
				<h6>Quản lý sự kiện</h6>
			</div>
			<div class="header-content-right" style="display: inline;">
				
				<h6 class="display-inline">Quản lý sự kiện</h6>
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
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content1">Khung pháp lý</a>
      </li>
     <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content2"> Biểu mẫu </a>
      </li>
    
    </ul>  
    <hr>

        <div class="tab-content">

          <div id="content1" class="tab-pane  in active">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="example" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        <th>Đầu mục </th>
                        <th> </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($legal_list as $legal)
                        <tr class="color-add">
                          <td>{{$legal->name}}</td>
                          @if (strlen($legal->url) > 0)
                           <td class = "center-td"><a  target="_blank" download="<?=$form->name.".".explode(".",$form->url,2)[1]?>" href="{{$form->url}}" class="preview" type="button"><img src="/js-css/img/icon/dowload.png"></a></td>
                              @else <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/wait.png"></td>
                      @endif
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
          </div>

            <div id="content2" class="tab-pane  fade">
          <div class="active-view" id="menu1">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <table id="example" class="nvr-table">
                  <thead>
                    <tr class="thead">
                        
                        <th>Đầu mục </th>
                        <th> </th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      @foreach($form_list as $form)
                        <tr class="color-add">
                          <td>{{$form->name}}</td>
                          @if (strlen($form->url) > 0)
                          <td class = "center-td"><a  target="_blank" download="<?=$form->name.".".explode(".",$form->url,2)[1]?>" href="{{$form->url}}" class="preview" type="button"><img src="/js-css/img/icon/dowload.png"></a></td>
                            @else <td class = "center-td"><button class="preview" type="button"><img src="/js-css/img/icon/wait.png"></td>
                      @endif
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
          </div>

        </div>
      </div>
    </div>
    </div>
	<!-- end model --->

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

  </script>

@endsection
