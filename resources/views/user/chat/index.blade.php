@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<style>
.chat-box{
    height:75vh;
    overflow-y:scroll;
    padding:15px;
    background:#f5f7f9;
    border-radius:10px;
}
.msg{
    padding:10px 15px;
    border-radius:10px;
    margin-bottom:8px;
    max-width:75%;
    position:relative;
    font-size:14px;
}
.msg.me{
    background:#d1ffd3;
    margin-left:auto;
}
.msg.them{
    background:white;
}
.msg-tick{
    font-size:11px;
    position:absolute;
    right:5px; bottom:-16px;
}
.msg img{
    width:180px;
    border-radius:8px;
}
.file-box a{
    font-size:14px;
    color:#007bff;
}
</style>

<div class="container mt-4">
    <h4>Chat dengan Admin</h4>
    <div id="chatBox" class="chat-box"></div>

    <form id="sendForm" enctype="multipart/form-data" class="d-flex mt-3">
        <input type="text" id="message" class="form-control me-2" placeholder="Tulis pesan...">
        <input type="file" name="file" id="file" class="form-control me-2" style="max-width:200px;">
        <button class="btn btn-primary">Kirim</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
function loadChat(){
    $.get("/chat/fetch", function(res){
        $("#chatBox").html('');
        res.forEach(msg=>{
            let tick = '';
            if(msg.is_read == 1){
                tick = `<span class="msg-tick" style="color:blue">✔✔</span>`;
            }else if(msg.is_delivered == 1){
                tick = `<span class="msg-tick" style="color:gray">✔✔</span>`;
            }

            let bubble = '';
            if(msg.type == 'image' && msg.file_path){
                bubble = `<img src="/storage/${msg.file_path}">`;
            }else if(msg.type == 'document'){
                bubble = `<div class="file-box">
                            <a href="/storage/${msg.file_path}" target="_blank">📄 Download File</a>
                          </div>`;
            }else{
                bubble = msg.message;
            }

            $("#chatBox").append(`
                <div class="msg ${msg.from_id == {{ auth()->id() }} ? 'me' : 'them'}">
                    ${bubble}
                    ${ msg.from_id == {{ auth()->id() }} ? tick : '' }
                </div>
            `);
        });

        $("#chatBox").scrollTop($("#chatBox")[0].scrollHeight);
    });
}

setInterval(loadChat, 1500);
loadChat();

$("#sendForm").submit(function(e){
    e.preventDefault();
    let formData = new FormData(this);

    $.ajax({
        type:'POST',
        url:'/chat/send',
        data:formData,
        cache:false,
        contentType:false,
        processData:false,
        success:function(){
            $("#message").val('');
            $("#file").val('');
            loadChat();
        }
    });
});
</script>
@endsection
