function mypost(object){
    object.headers = {
        'Content-Type': 'application/json',
        'apikey' : "tyroneleeemz"
    }
    return $.ajax(object);
}

function resetCookies() {
    localStorage.removeItem("contentToken");
    localStorage.removeItem("homeurl");
    localStorage.removeItem("remote_id");
    localStorage.removeItem("mainIMGID");
    localStorage.removeItem("loggedin");
    localStorage.removeItem("album");
    localStorage.removeItem("shared");
    localStorage.removeItem("remotetoken");
}