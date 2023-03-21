{{-- -------------------- The default card (white) -------------------- --}}
@if($viewType == 'default')
    @if($from_id != $to_id)
    <div class="direct-chat-msg" data-id="{{ $id }}"   id="mess{{$id}}" style="
    max-width: 50%;
    width: max-content;">
         
  <div class="direct-chat-infos clearfix">
                   <span class="direct-chat-name float-left" style="color:white;">{{$user_name}}</span>
                   <span class="direct-chat-timestamp float-right">{{ $fullTime }}</span>
                          <!-- <a class="preview" href="messages/tran/{{$id}}/sale"><img style="width: 25px" src="/js-css/img/icon/forward.png"></a> -->
                           @if($pin == 0) 
                    <a class="preview" href="/sale/pin-mess/{{$id}}"><img src="/js-css/img/icon/pin3.png"></a>
                    @else

                    <a class="preview" href="/sale/unpin-mess/{{$id}}"><img src="/js-css/img/icon/pin2.png"></a>
                    @endif
   @if($storage == 0) 
                    <a class="preview" href="/sale/save-mess/{{$id}}"><img src="/js-css/img/icon/blue-box.png"></a>
                    @else

                    <a class="preview" href="/sale/unsave-mess/{{$id}}"><img src="/js-css/img/icon/red-box.png"></a>
                    @endif

                    </div>  


  @if(strlen($avatar) > 0) 
    <img class="direct-chat-img" src="{{$avatar}}" alt="message user image">
    @else
    <img class="direct-chat-img" src="/js-css/img/icon/avatar.png" alt="message user image">

    @endif
   <div class="direct-chat-text" style="background-color: transparent;border: none;background-color: gray;">
        {!! ($message == null && $attachment != null && @$attachment[2] != 'file') ? $attachment[1] : "<p style='margin: 5px 0 0 0px;'>".nl2br($message)."</p>" !!}

         <!--    <sub title="{{ $fullTime }}">{{ $time }}</sub> -->
            {{-- If attachment is a file --}}
            @if(@$attachment[2] == 'file')
            <a href="{{ route(config('chatify.attachments.route'),['fileName'=>$attachment[0]]) }}" style="color: #595959;" class="file-download">
                <span class="fas fa-file"></span> {{$attachment[1]}}</a>
            @endif
        </div>
    </div>
    {{-- If attachment is an image --}}
    @if(@$attachment[2] == 'image')
    <div>
        <div class="message-card">
            <div class="image-file chat-image" style="width: 250px; height: 150px;background-image: url('{{ asset('storage/public/'.config('chatify.attachments.folder').'/'.$attachment[0]) }}')">
            </div>
        </div>
    </div>
    @endif
    @endif
@endif

{{-- -------------------- Sender card (owner) -------------------- --}}
@if($viewType == 'sender')
    <div class="direct-chat-msg mc-sender right" data-id="{{ $id }}" id="mess{{$id}}" style="
    margin-left: 50%;
    max-width: 50%;">
              
<div class="direct-chat-infos clearfix">
                   <span class="direct-chat-name float-left" style="color:white">{{$user_name}}</span>  <span class="direct-chat-timestamp float-right">{{ $fullTime }}</span>
                     <!-- <a class="preview" href="messages/tran/{{$id}}/sale"><img style="width: 25px" src="/js-css/img/icon/forward.png"></a> -->
                  @if($pin == 0) 
                    <a class="preview" href="/sale/pin-mess/{{$id}}"><img src="/js-css/img/icon/pin3.png"></a>
                    @else

                    <a class="preview" href="/sale/unpin-mess/{{$id}}"><img src="/js-css/img/icon/pin2.png"></a>
                    @endif
 @if($storage == 0) 
                    <a class="preview" href="/sale/save-mess/{{$id}}"><img src="/js-css/img/icon/blue-box.png"></a>
                    @else

                    <a class="preview" href="/sale/unsave-mess/{{$id}}"><img src="/js-css/img/icon/red-box.png"></a>
                    @endif
        <button class="preview" onclick="deleteMess('{{ $id }}','sale')"><img style="width: 25px" src="/js-css/img/icon/trash_can.png"></button>

                    </div>  
   @if(strlen($avatar) > 0)
    <img class="direct-chat-img "  src="{{$avatar}}" alt="message user image">
    @else
    <img class="direct-chat-img "   src="/js-css/img/icon/avatar.png" alt="message user image">

    @endif
    
   <div class="direct-chat-text">
       {!! ($message == null && $attachment != null && @$attachment[2] != 'file') ? $attachment[1] : "<p style='margin: 5px 0 0 0px;'>".nl2br($message)."</p>" !!}
          <!--   <sub title="{{ $fullTime }}" class="message-time">
                <span class="fas fa-{{ $seen > 0 ? 'check-double' : 'check' }} seen"></span> {{ $time }}</sub> -->
                {{-- If attachment is a file --}}
            @if(@$attachment[2] == 'file')
            <a href="{{ route(config('chatify.attachments.route'),['fileName'=>$attachment[0]]) }}" class="file-download">
                <span class="fas fa-file"></span> {{$attachment[1]}}</a>
            @endif
        </div>
    </div>
    {{-- If attachment is an image --}}
    @if(@$attachment[2] == 'image')
    <div>
        <div class="message-card mc-sender">
            <div class="image-file chat-image" style="width: 250px; height: 150px;background-image: url('{{ asset('storage/public/'.config('chatify.attachments.folder').'/'.$attachment[0]) }}')">
            </div>
        </div>
    </div>
    @endif
@endif