<style>
    
@media (max-width: 900px){
    .messenger-sendCard svg {
            margin: 9px 23px;
    }
}
</style>

<div class="messenger-sendCard">
    <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data">
        @csrf
        <label><span class="fas fa-paperclip"></span><input disabled='disabled' type="file" multiple class="upload-attachment" name="file[]"/></label>
        <textarea onclick="zoomOutMobile(1)" readonly='readonly' name="message" class="m-send app-scroll" placeholder="Type a message.."></textarea>
        <button disabled='disabled'><span class="fas fa-paper-plane"></span></button>
    </form>
</div>

<script type="text/javascript">
  function zoomOutMobile(flag) {
    console.log("Zoomn!!!")
    var viewport = document.querySelector("meta[name='viewport']");
    viewport.content = "width=400, maximum-scale=0.635";
    setTimeout(function() {
        viewport.content = "width=400, maximum-scale=10";
     
    }, 350);
  
  }
  </script>