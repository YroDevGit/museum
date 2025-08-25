
<link rel="shortcut icon" href="ico.png" type="image/x-icon">
<script>
    baseURL = "{{url('')}}";
    apiURL = "{{url('')}}/api"
</script>
<script>
    function logOut(){
        localStorage.removeItem("admin1");
        window.location.href = baseURL+"/phpmyadmin";
    }
</script>