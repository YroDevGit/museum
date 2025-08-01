<script>
    localStorage.removeItem("homeurl");
    localStorage.setItem("album", "{{$album_id}}");
    localStorage.setItem("remote_id", "{{$remote_id}}");
    localStorage.setItem("remotetoken", "{{$remote_token}}");
    localStorage.setItem("shared", true);
    window.location.href = `{{url('')}}/register`;
</script>