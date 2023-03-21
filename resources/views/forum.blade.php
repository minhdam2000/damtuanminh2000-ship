@extends('layouts.index')

@section('content')

<div class="content-camera">
    <div class="proxy-add" title="New Edge"><a href="/discussions/create" class="camera-button"><i class="fa fa-plus" aria-hidden="true"></i> Tạo khiếu nại mới </a></div>
<hr><br>  
        @foreach($discussions as $discussion)
        
            
          <div class="card card-default mb-2">
            <div class="card-header">
            <?php
              $id = $discussion->user->role_id;

              $role = DB::table("roles")->where("id",$id)->first();
              $dept= DB::table("department")->where("id",$role->department_id)->first();
            ?>
            <h3><span class="">{{$discussion->user->name}}, {{$role->name}}, {{$dept->name}}  </span></h3>

            <div class="text-right top">
            <a href="{{route('discussion',['id' =>$discussion->id])}}" class="btn">Chi tiết</a>
            </div>
            </div>


            <div class="card-body">
            <h5 class="">{{$discussion->title}}</h5>
            <hr>
                <p class="">{!! $discussion->content !!}</p> 
            </div>
            <?php
   $files =  DB::table('discussions_url')->where('blog_id', $discussion->id ) ->limit(5)->get();

            ?>

                <div class="row form-group" id="listimg">
              @foreach($files as $file)
<div class="col-12 col-sm-12 col-md-4">
<img style="width: 100%;height: auto" src="{{$file->url}}" id="listimg" class="preview"><br><br> </div>  

                            @endforeach
                       </div>
            <div class="card-footer">
              @if($discussion->replies->count() < 1)

              <p>{{$discussion->replies->count()}} Câu trả lời </p>
              @else

              <p>{{$discussion->replies->count()}} câu trả lời </p>
              @endif

              
            
              </div>

          </div>

          
         


        @endforeach

        <div class="text-center">
          {{$discussions->links()}}
        </div>
       
</div>
@endsection
