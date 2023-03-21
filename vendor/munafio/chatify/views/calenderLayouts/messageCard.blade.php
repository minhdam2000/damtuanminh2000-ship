{{-- -------------------- The default card (white) -------------------- --}}
@if($viewType == 'default')
    @if($from_id != $to_id)
    <div class="direct-chat-msg" data-id="{{ $id }}"   id="mess{{$id}}" style="
    max-width: 50%;
    width: max-content;">
         


  @if(strlen($avatar) > 0) 
    <img class="direct-chat-img" src="{{$avatar}}" alt="message user image">
    @else
    <img class="direct-chat-img" src="/js-css/img/icon/avatar.png" alt="message user image">

    @endif
   <div class="direct-chat-text" style="background-color: transparent;border: none;background-color: gray;" onmouseover="addIcon({{$id}})" onmouseout="removeIcon({{$id}})">
        {!! ($message == null && $attachment != null && @$attachment[2] != 'file') ? $attachment[1] : "<p style='margin: 5px 0 0 0px;'>".nl2br($message)."</p>" !!}

         <!--    <sub title="{{ $fullTime }}">{{ $time }}</sub> -->
            {{-- If attachment is a file --}}
            @if(@$attachment[2] == 'file')
            <a href="/storage/public/attachments/{{$attachment[0]}}" target="_blank" style="color: white;" class="file-download">

                <span class="fas fa-file"></span> {{$attachment[1]}}</a>
            @endif
              <div class="direct-chat-infos clearfix" style="display: none;" id="iconDisplay{{$id}}">
                  <!--  <span class="direct-chat-name float-left" style="color:white;">{{$user_name}}</span>
                   <span class="direct-chat-timestamp float-right">{{ $fullTime }}</span> -->
                          <!-- <a class="preview" href="messages/tran/{{$id}}/build"><img style="width: 25px" src="/js-css/img/icon/forward.png"></a> -->
                     
                    </div>  


        </div>
    </div>
    {{-- If attachment is an image --}}
    @if(@$attachment[2] == 'image')
    <div>
        <div class="message-card">
            <div class="image-file chat-image" style="width: 250px; height: 150px;background-image: url('{{ asset('storage/'.config('chatify.attachments.folder').'/'.$attachment[0]) }}')">
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
  
   @if(strlen($avatar) > 0)
    <img class="direct-chat-img "  src="{{$avatar}}" alt="message user image">
    @else
    <img class="direct-chat-img "   src="/js-css/img/icon/avatar.png" alt="message user image">

    @endif
    
   <div class="direct-chat-text"  onmouseover="addIcon({{$id}})" onmouseout="removeIcon({{$id}})">
       {!! ($message == null && $attachment != null && @$attachment[2] != 'file') ? $attachment[1] : "<p style='margin: 5px 0 0 0px;'>".nl2br($message)."</p>" !!}
          <!--   <sub title="{{ $fullTime }}" class="message-time">
                <span class="fas fa-{{ $seen > 0 ? 'check-double' : 'check' }} seen"></span> {{ $time }}</sub> -->
                {{-- If attachment is a file --}}
            @if(@$attachment[2] == 'file')
             <a href="/storage/public/attachments/{{$attachment[0]}}" target="_blank" style="color: white;" class="file-download">

                <span class="fas fa-file"></span> {{$attachment[1]}}</a>
            @endif


<div class="direct-chat-infos clearfix" style="display: none;" id="iconDisplay{{$id}}">
                   <!-- <span class="direct-chat-name float-left" style="color:white">{{$user_name}}</span>  <span class="direct-chat-timestamp float-right">{{ $fullTime }}</span> -->
                     <!-- <a class="preview" href="messages/tran/{{$id}}/build"><img style="width: 25px" src="/js-css/img/icon/forward.png"></a> -->
                
        <button class="preview" onclick="deleteMess('{{ $id }}','build')"><img style="width: 25px" src="/js-css/img/icon/trash_can.png"></button>

                    </div>

        </div>
    </div>
    {{-- If attachment is an image --}}
    @if(@$attachment[2] == 'image')
    <div>
        <div class="message-card mc-sender">
            <div class="image-file chat-image" style="width: 250px; height: 150px;background-image: url('{{ asset('storage/'.config('chatify.attachments.folder').'/'.$attachment[0]) }}')">
            </div>
        </div>
    </div>
    @endif
@endif