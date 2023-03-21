@extends('layouts.index')
@section('content')

    <div class="content-camera">
          <div class="row row-content">
            <div class="row-title-proxy">
            <div class="session">
            @if(Session::has('notification'))
              <input hidden="" notifi="{{Session::get('notification')}}" value="1" id="notice_success">
            @endif
            @if(Session::has('warning'))
              <input hidden="" notifi="{{Session::get('warning')}}" value="1" id="notice_warning">
            @endif
          </div>
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="changepassword">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Mật khẩu cũ</label>

                            <div class="col-md-6">
                                @if(Session::has('notification'))
                                	<input id="name" type="password" class="form-control border-red @error('name') is-invalid @enderror" name="old_password" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <span class="invalid-feedback1" role="alert">
                                        <strong>{{Session::get('notification')}}</strong>
                                    </span>
                                @else
                                	<input id="name" type="password" class="form-control @error('name') is-invalid @enderror" name="old_password" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Mật khẩu mới</label>

                            <div class="col-md-6">
                                @if(Session::has('password'))
                                <input id="password" type="password" class="form-control border-red @error('password') is-invalid @enderror" name="new_password" required autocomplete="new-password">
                                    <span class="invalid-feedback1" role="alert">
                                        <strong>{{Session::get('password')}}</strong>
                                    </span>
                                @else
                                	<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="new_password" required autocomplete="new-password">
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Xác nhận</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="/personal-page" class="btn btn-model" style="width: 100px;">
                                    Quay lại
                                </a>
                                <button type="submit" class="btn btn-model" style="width: 100px;">
                                    Đổi mật khẩu
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning !</h6>
</div>
<script>
    $(document).ready(function() {
          if($("#notice_warning").val() == 1){
            notifiWarning($("#notice_warning").attr("notifi"));
          }
      });
      function notifiWarning(warning){
            console.log(warning);
          var x = document.getElementById("snackbar-warning");
          x.className = "show";
          x.childNodes[2].innerHTML = warning;
          setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
        }
</script>
<style>
    #snackbar-warning {
      visibility: hidden;
      min-width: 250px;
      margin-left: -125px;
      background-color: #333;
      color: #fff;
      text-align: center;
      border-radius: 2px;
      padding: 16px;
      position: fixed;
      z-index: 999;
      left: 50%;
      top: 30px;
      font-size: 17px;
      background: rgba(234,186,66,0.7);
    }

    #snackbar-warning.show {
      visibility: visible;
      -webkit-animation: fadein 0.5s, fadeout 0.5s 4.5s;
      animation: fadein 0.5s, fadeout 0.5s 4.5s;
    }

    @-webkit-keyframes fadein {
      from {top: 0; opacity: 0;} 
      to {30: 30px; opacity: 1;}
    }

    @keyframes fadein {
      from {top: 0; opacity: 0;}
      to {top: 30px; opacity: 1;}
    }

    @-webkit-keyframes fadeout {
      from {top: 30px; opacity: 1;} 
      to {top: 0; opacity: 0;}
    }

    @keyframes fadeout {
      from {top: 30px; opacity: 1;}
      to {top: 0; opacity: 0;}
    }
</style>
@endsection
