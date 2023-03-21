{{-- Meta tags --}}
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="url" content="{{ url('').'/'.config('chatify.path') }}" data-user="{{ Auth::user()->id }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
{{-- scripts --}}
<?php
 $dark_mode =  Auth::user()->dark_mode < 1 ? 'light' : 'dark';
?>
<script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
<script src="{{ asset('js/chatify/autosize.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>
 <script src="js-css/js/jquery.min.js"></script>
        <script src="js-css/js/popper.min.js"></script>
        <script src="js-css/js/bootstrap.min.js"></script> <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
{{-- styles --}}
<link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css'/>
<link href="{{ asset('css/chatify/style.css') }}" rel="stylesheet" />
<link href="{{ asset('css/chatify/'.$dark_mode.'.mode.css') }}" rel="stylesheet" />
<link href="{{ asset('css/app.css') }}" rel="stylesheet" />

<form method="POST" action="/chatify/tran">
<div class="col-md-12">
<h3>Chuyển tiếp tin nhắn</h3>
    <!-- Subject Form Input -->
    <h5>Chia sẻ với</h5>
    <div class="form-group">

                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="id" value="{{$id}}">
                <input type="hidden" name="type" value="{{$type}}">

        {!! Form::label('Người nhận', 'Người nhận', ['class' => 'control-label']) !!}

      
        <select name="recipients[]" class=" form-control custom-select select-profile  browser-default"  data-live-search="true" id="staffselect" multiple>
                    @foreach($users as $user)

                     <?php
             $role = DB::table("roles")->where("id",$user->role_id)->first();
             if($role == null){
                continue;
             }
              $dept= DB::table("department")->where("id",$role->department_id)->count();

              if($dept > 0){
                $dept_name = DB::table("department")->where("id",$role->department_id)->first()->name;
              }else{
 $dept_name = "???";
              }
              
            ?>

                    <option value="{{$user->id}}">{{$user->name}}
                     - {{$role->name}} ({{$dept_name}}) </option>
                    @endforeach

</select>
</div>

    <div class="form-group">
        {!! Form::label('Nhóm nhận', 'Nhóm nhận', ['class' => 'control-label']) !!}
 <select name="groups[]" class=" form-control custom-select select-profile  browser-default"  data-live-search="true" id="groupselect" multiple>
                    @foreach($threads as $thread)

                    <option value="{{$thread->id}}">{{$thread->subject}}
                     (
{!! $thread->participantsString(Auth::id()) !!}) </option>
                    @endforeach

</select>

    </div>

    

    
    <!-- Submit Form Input -->
    <div class="form-group">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
    </div>


</form>
<script src="/js-css/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  
  $('#staffselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});

  $('#groupselect').selectpicker({
     noneResultsText: 'Chưa có nhân viên'
});

</script>


<script type="text/javascript">
        $(document).on("click", ".browse", function() {          
          $("#file").trigger("click");
        });
        $('input[type="file"]').change(function(e) {
            
          document.getElementById("preview").innerHTML =""
            for (var i = 0; i < e.target.files.length;i++){
          var fileName = e.target.files[i].name;
          console.log(fileName)
          // $("#file").val(fileName);
        if (fileName.includes(".png") || fileName.includes(".jpg") || fileName.includes(".jepg")){
          var reader = new FileReader();
          reader.onload = function(e) {
            // get loaded data and render thumbnail.
            console.log("oke")
          document.getElementById("preview").innerHTML  =  '<img width="250" src="'+e.target.result+'">';
          };
          reader.readAsDataURL(this.files[i]);
      }

          // read the image file as a data URL.
                }
        });

</script>

