function mypost(object){
    object.headers = {
        'Content-Type': 'application/json',
        'apikey' : "tyroneleeemz"
    }
    return $.ajax(object);
}