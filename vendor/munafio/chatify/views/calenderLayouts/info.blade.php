{{-- user info and avatar --}}
<div class="avatar av-l"></div>
<p class="info-name">{{ config('chatify.name') }}</p>
<div class="messenger-infoView-btns">
    {{-- <a href="#" class="default"><i class="fas fa-camera"></i> default</a> --}}
    <div id="mytest">
    <a href="#" class="danger delete-conversation"><i class="fas fa-trash-alt"></i> Xóa tin nhắn</a>


</div>

</div>
{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <div class="shared-photos-list"></div>


    <button class="m-button" id="EditBtn" style="float: right"><a style="color:white" target="_blank" href="">Sửa hạng mục</a></button>
</div>