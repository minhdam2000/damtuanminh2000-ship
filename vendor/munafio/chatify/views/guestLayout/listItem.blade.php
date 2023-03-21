{{-- -------------------- Saved Messages -------------------- --}}
@if($get == 'saved')
    <table class="messenger-list-item m-li-divider @if('user_'."0" == $id && $id != "0") m-list-active @endif">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
            <div class="avatar av-m" style="background-color: #d9efff; text-align: center;">
                <span class="far fa-bookmark" style="font-size: 22px; color: #68a5ff; margin-top: calc(50% - 10px);"></span>
            </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ 'user_'."0" }}"> Tin nhắn riêng tư </p>
                <span>Tin nhắn cho riêng bạn</span>
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- All users/group list -------------------- --}}
@if($get == 'users')
<table class="messenger-list-item @if($user->id == $id && $id != "0") m-list-active @endif" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td style="position: relative">
            @if($user->active_status)
                <span class="activeStatus"></span>
            @endif
        <div class="avatar av-m" 
        style="background-image: url('{{ $user->avatar }}');">
        </div>
        </td>
        {{-- center side --}}
        <td>
        <p data-id="{{ $type.'_'.$user->id }}">
           <?php
             $role = DB::table("roles")->where("id",$user->role_id)->count();
             if($role > 0){
             $role = DB::table("roles")->where("id",$user->role_id)->first();
              $dept= DB::table("department")->where("id",$role->department_id)->count();
              $role_name = $role->name;
              if($dept > 0){
                $dept_name = DB::table("department")->where("id",$role->department_id)->first()->name;

              }else{
 $dept_name = "???";
              }
          }else{
            $role_name = "Đại diện";
             $dept_name  = DB::table("contractors")->where("id",($user->role_id)*-1)->first()->name;

          }
              ?>

            {{ strlen($user->name) > 50 ? trim(substr($user->name,0,50)).'..' : $user->name }} - {{$role_name}} ({{$dept_name}}) 
            <span>{{ $lastMessage->created_at->diffForHumans() }}</span></p>
        <span>
            {{-- Last Message user indicator --}}
            {!!
                $lastMessage->from_id == "0" 
                ? '<span class="lastMessageIndicator">Bạn :</span>'
                : ''
            !!}
            {{-- Last message body --}}
            @if($lastMessage->attachment == null)
            {{
                strlen($lastMessage->body) > 30 
                ? trim(substr($lastMessage->body, 0, 30)).'..'
                : $lastMessage->body
            }}
            @else
            <span class="fas fa-file"></span> Attachment
            @endif
        </span>
        {{-- New messages counter --}}
            {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
        </td>
        
    </tr>
</table>
@endif


@if($get == 'groups' || $get == 'schedule')
<table class="messenger-list-item @if($user->id == $id && $id != "0") m-list-active @endif" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td style="position: relative">
                <span class="activeStatus"></span>
        <div class="avatar av-m" 
        style="background-image: url('{{$thead->url}}');">
        </div>
        </td>
        {{-- center side --}}
        <td>
        <p data-id="{{ $type .'_'.$thead->id }}">
            {{ strlen($thead->name) > 50 ? trim(substr($thead->name,0,50)).'..' : $thead->name }} 
            <span>{{ $lastMessage->created_at->diffForHumans() }}</span></p>
        <span>
            {{-- Last Message user indicator --}}
            {!!
                $lastMessage->user_id == "0" 
                ? '<span class="lastMessageIndicator">You :</span>'
                : ''
            !!}
            {{-- Last message body --}}
            @if($lastMessage->attachment == null)
            {{
                strlen($lastMessage->body) > 30 
                ? trim(substr($lastMessage->body, 0, 30)).'..'
                : $lastMessage->body
            }}
            @else
            <span class="fas fa-file"></span> Attachment
            @endif
        </span>
        {{-- New messages counter --}}
            {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
        </td>
        
    </tr>
</table>
@endif

{{-- -------------------- Search Item -------------------- --}}
@if($get == 'search_item')
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td>
        <div class="avatar av-m"
        style="background-image: url('{{ asset('/storage/'.config('chatify.user_avatar.folder').'/'.$user->avatar) }}');">
        </div>
        </td>
        {{-- center side --}}
        <td> <?php
             $role = DB::table("roles")->where("id",$user->role_id)->count();
             if($role > 0){
             $role = DB::table("roles")->where("id",$user->role_id)->first();
              $dept= DB::table("department")->where("id",$role->department_id)->count();
              $role_name = $role->name;
              if($dept > 0){
                $dept_name = DB::table("department")->where("id",$role->department_id)->first()->name;

              }else{
 $dept_name = "???";
              }
          }else{
            $role_name = "Đại diện";
             $dept_name  = DB::table("contractors")->where("id",($user->role_id)*-1)->first()->name;

          }
              ?>
        <p data-id="{{ $type.'_'.$user->id }}">
            {{ strlen($user->name) > 50 ? trim(substr($user->name,0,50)).'..' : $user->name }} - {{$role_name}} ({{$dept_name}}) 
        </td>
        
    </tr>
</table>
@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if($get == 'sharedPhoto')
<div class="shared-photo chat-image" style="background-image: url('{{ $image }}')"></div>
@endif


