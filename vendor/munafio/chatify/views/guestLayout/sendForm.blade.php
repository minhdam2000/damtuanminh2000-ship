<div class="messenger-sendCard">
    <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data">
        @csrf
        <label><span class="fas fa-paperclip"></span><input disabled='disabled' type="file" multiple class="upload-attachment" name="file[]"/></label>
        <textarea readonly='readonly' name="message" class="m-send app-scroll" placeholder="Type a message.."></textarea>
        <button disabled='disabled'><span class="fas fa-paper-plane"></span></button>
    </form>
</div>

<script>

        messageInput.removeAttr('readonly');
        $('#message-form button').removeAttr('disabled');
        $('.upload-attachment').removeAttr('disabled');

        $('.messenger-sendCard').show(); 
</script>
