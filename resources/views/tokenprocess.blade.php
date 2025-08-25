
@if ($inactive ?? false)
<script>
    localStorage.setItem("album", "{{$album}}");
    localStorage.setItem("remote_id", "{{$remote_id}}");
    localStorage.setItem("remotetoken", "{{$remotetoken}}");
    localStorage.setItem("dasayu3db6434", "11133");
    window.location.href = `{{url('')}}/photographer/album/{{$album}}/user/{{$user}}/{{$token}}`;
</script>
@else
<script>
    const em = "{{$email}}";
    localStorage.removeItem("homeurl");
    localStorage.setItem("album", "{{$album_id}}");
    localStorage.setItem("remote_id", "{{$remote_id}}");
    localStorage.setItem("remotetoken", "{{$remote_token}}");
    localStorage.setItem("shared", true);
    //window.location.href = `{{url('')}}/register?em=${em}`;
</script> 
@endif