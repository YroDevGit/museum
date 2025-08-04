$(document).ready(function () {
    const albumcookie = localStorage.getItem("album");
    if (!albumcookie || albumcookie == null || albumcookie == "null") {
        localStorage.setItem("album", `${albumID}`);
    }
    localStorage.removeItem("contentToken");
    loadAllImage();
    setInterval(() => {
        loadAllImage();
    }, 7000);
});



function loadAllImage() {
    mypost({
        url: `${apiURL}/upload/${albumID}?saved=yes`,
        method: "GET",
        success: function (response) {
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
        error: function (error) {
            console.log(error);
        }
    });
}


function displayIMG(img, imgid) {
    document.getElementById('fullimg').style.display = '';
    document.getElementById('fullimg1').src = img;
    localStorage.setItem("mainIMGID", imgid);
}



document.querySelector("#delIMG").addEventListener("click", function () {
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
                url: `${apiURL}/img/delete/${imgID}`,
                method: "DELETE",
                success: function (response) {
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
                error: function (error) {
                    console.log(response);
                }
            });
        }
    });
});


downloadzip.addEventListener("click", function () {
    const album = localStorage.getItem("album");
    window.location.href = `${baseURL}/api/download/${album}`;
});

document.getElementById('galleryback').addEventListener("click", function () {
    window.location.href = `${baseURL}` + localStorage.getItem("homeurl");
})