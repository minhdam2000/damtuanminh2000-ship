@extends('layouts.index')

@section('content')
    @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {!! Session::get('error_message') !!}
        </div>
    @endif
<br><br>
     <table id="example" class="nvr-table">
                      <thead>
                      <tr class="thead">
                          <th style="width: 10%"></th>
                          <th style="width: 90%"></th>
                        </tr>
                      </thead>

                      <tbody class="tbody">
    @if($threads->count() > 0)
        @foreach($threads as $thread)
                          <tr class="color-add">
                            <td> 
                                 @if(strlen($thread->url) > 2)
                    <img width="50" src="{{$thread->url}}"  class="img-circle">
                    @else
                    @if( $thread->participantsCount(Auth::id()) > 2)
                      <img width="50" src="/js-css/img/icon/users.png"  class="img-circle">
                    @elseif( $thread->participantsCount(Auth::id()) > 1)
                      <img width="50" src="{{$thread->participantsAvatar(Auth::id())}}"  class="img-circle">

                    @endif
                    @endif
                            </td>
                            

        <td>
                                <span>{!! link_to('messages/' . $thread->id, $thread->subject) !!}

        @if($thread->participantsString(Auth::id()))
                                    ({!! $thread->participantsString(Auth::id()) !!}) 
                                    @endif


                                </span>
                                <br>
        @if($thread->isUnread($currentUserId))
 <span style="font-size: 30px;font-weight: 900" >{!! $thread->latestMessage->body !!}</span>
        @else

 <span style="font-size: 30px;font-weight: 300" >{!! $thread->latestMessage->body !!}</span>
        @endif
        </td>
       
    </tr>
        @endforeach
                      </tbody>
                    </table>
    @endif
@stop