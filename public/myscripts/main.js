//Hide image modal
inviteusericon.addEventListener("click", function() {
    fullemail.style.display = "";
});


//load all images
function loadAllImage() {
    mypost({
        url: `${baseURL}/upload/${albumid}`,
        method: "GET",
        success: function(response) {
            const data = response?.details?.data ?? [];
            const updates = response?.details?.data ?? [];
            const currentContent = localStorage.getItem("contentToken") ?? "";
            const newUpdate = JSON.stringify(updates);
            if (currentContent === newUpdate) {
                return;
            }
            localStorage.setItem("contentToken", newUpdate);

            document.querySelector("#cardcolumn").innerHTML = '';
            data.forEach(column => {
                console.log(column);
                document.querySelector("#cardcolumn").insertAdjacentHTML(
                    'beforeend', `
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card img-loaded">
                            <a onclick="displayIMG('${baseURL}/${column.image_path}', '${column.id}')">
                                <img class="card-img-top probootstrap-animate fadeInUp probootstrap-animated" src="${baseURL}/${column.image_path}" alt="Card image cap">
                            </a>
                        </div>
                    </div>
                    `);
            });
        },
        error: function(error) {
            console.log(error);
        }
    });
}

//window initiated
$(document).ready(function() {
    const albumcookie = localStorage.getItem("album");
    if(! albumcookie || albumcookie == null || albumcookie == "null"){
        localStorage.setItem("album", "{{$albumid}}")
    }
    localStorage.setItem("homeurl", window.location.pathname);
    localStorage.removeItem("contentToken");
    loadAllImage();
    setInterval(() => {
        loadAllImage();
    }, 7000);
});

//display image
function displayIMG(img, imgid) {
    document.getElementById('fullimg').style.display = '';
    document.getElementById('fullimg1').src = img;
    localStorage.setItem("mainIMGID", imgid);
}

//share
document.querySelector("#iconshare").addEventListener("click", function() {
    const remoteID = localStorage.getItem("remote_id");
    const token = localStorage.getItem("remotetoken");
    window.location.href = `${baseURL}/shareqr/` + remoteID + "/" + token;
});


//Delete image
document.querySelector("#delIMG").addEventListener("click", function() {
    Swal.fire({
        title: "Are you sure",
        text: "are you sure to delete selected image?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Okay, delete it.!"
    }).then((res) => {
        if (res.isConfirmed) {
            const imgID = localStorage.getItem("mainIMGID");
            mypost({
                url: `${baseURL}/img/delete/${imgID}`,
                method: "DELETE",
                success: function(response) {
                    if (response.code == 200) {
                        Swal.fire({
                            title: "SUCCESS",
                            text: "Capture deleted",
                            icon: "success"
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "ERROR",
                            text: response.message,
                            icon: "error"
                        });
                    }
                },
                error: function(error) {
                    console.log(response);
                }
            });
        }
    });
});

//Invite friends to album
invitebtn.addEventListener("click", function(){
    invitebtn = true;
    const email = emailadd.value;
    if(email==null || email == ""){
        Swal.fire({
            title: "Failed",
            text: "email field is required",
            icon: "error"
        });return;
    }

    mypost({
        url: `${baseURL}/share/email`,
        method:"POST",
        data:JSON.stringify({
            email: email.trim(),
            remote: localStorage.getItem("remote_id"),
            album: localStorage.getItem("album"),
            remtoken: localStorage.getItem("remotetoken")
        }),
        success: function(response){
            Swal.fire({
                title: "SUCCESS",
                text: `An invite email was sent to ${email.trim()}`,
                icon: "success"
            }).then(()=>{
                window.location.reload();
            });
        },
        error: function(error){
            console.log(error);
        }
    })
});



document.getElementById("saveimg").addEventListener("click", function(){
    const home = localStorage.getItem("homeurl");
    window.location.href = `${baseURL}/saved${home}`;
});

function saveIMG(){
    Swal.fire({
        title: "Are you ready?",
        text: "Ready to save this image?",
        icon: "question",
        showCancelButton: true,
        cancelButtonText: "Not now",
        confirmButtonText: "Yes, i see its beautiful"
    }).then((action)=>{
        if(action.isConfirmed){
            const selectedImage = localStorage.getItem("mainIMGID");
            mypost({
                url: `${baseURL}/saveimage/${selectedImage}`,
                method: "POST",
                success: function(response){
                    if(response.code==200){
                        Swal.fire({
                            title: "Success",
                            text: "Image has been saved",
                            icon: "success"
                        }).then(()=>{
                            window.location.reload();
                        });
                    }else{
                        Swal.fire({
                            title: "Failed",
                            text: response.message,
                            icon: "error"
                        });
                    }
                },
                error: function(error){
                    alert(error);
                }
            })
        }
    });
}