function mypost(object){
    object.headers = {
        'Content-Type': 'application/json'
    }
    return $.ajax(object);
}