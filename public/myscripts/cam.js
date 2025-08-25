// initialize elements
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const captureBtn = document.getElementById('captureBtn');
const thumbnail = document.getElementById('thumbnail');
const modal = document.getElementById('modal');
const modalImage = document.getElementById('modalImage');
const modalClose = document.getElementById('modalClose');
const uploadBtn = document.getElementById('uploadBtn');
const backBtn = document.getElementById('backBtn');
const flipBtn = document.getElementById('flipBtn'); // New flip button

let currentFacingMode = "environment"; // back camera default
let currentStream = null;

// Start camera with facingMode
async function startCamera(facingMode = "environment") {
    if (currentStream) {
        currentStream.getTracks().forEach(track => track.stop());
    }

    try {
        const constraints = {
            video: {
                facingMode: { exact: facingMode }
            }
        };

        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        currentStream = stream;
        video.srcObject = stream;
    } catch (err) {
        console.warn("Exact facingMode failed, trying ideal fallback.");
        try {
            const fallbackConstraints = {
                video: {
                    facingMode: { ideal: facingMode }
                }
            };
            const stream = await navigator.mediaDevices.getUserMedia(fallbackConstraints);
            currentStream = stream;
            video.srcObject = stream;
        } catch (err2) {
            alert("Camera access denied or unsupported.");
            console.error(err2);
        }
    }
}

// Start default camera on load
startCamera(currentFacingMode);

// Flip camera on click
flipBtn.addEventListener('click', () => {
    currentFacingMode = currentFacingMode === "environment" ? "user" : "environment";
    startCamera(currentFacingMode);
});


function loaderLoad(loading) {
    if (loading == "yes") {
        loader.style.display = '';
    } else {
        loader.style.display = 'none';
    }
}

// Capture frame
captureBtn.addEventListener('click', () => {
    const ctx = canvas.getContext('2d');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    const dataURL = canvas.toDataURL('image/png');
    thumbnail.src = dataURL;
    thumbnail.style.display = 'block';
    thumbnail.setAttribute('data-image', dataURL);
    thumbnail.click();
});

// Open modal
thumbnail.addEventListener('click', () => {
    const imageSrc = thumbnail.getAttribute('data-image');
    modalImage.src = imageSrc;
    modal.style.display = 'flex';
});

// Close modal
modalClose.addEventListener('click', () => {
    modal.style.display = 'none';
});

modal.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.style.display = 'none';
    }
});

// Upload to server
uploadBtn.addEventListener('click', () => {
    loaderLoad("yes");
    const imageData = thumbnail.getAttribute('data-image');
    const remid = localStorage.getItem("remote_id");

    mypost({
        url: apiURL + "/upload",
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        data: JSON.stringify({
            image: imageData,
            user_id: `${USERID}`,
            album_id: `${ALBUMID}`,
            remote_id: remid
        }),
        success: function (response) {
            if (response.code == 200) {
                Swal.fire({
                    title: "SUCCESS",
                    text: "Image uploaded",
                    icon: "success"
                }).then(() => {
                    modal.style.display = 'none';
                });
            }
            loaderLoad("no");
        },
        error: function (error) {
            Swal.fire({
                title: "ERROR",
                text: "UPLOAD FAILED",
                icon: "error"
            }).then(() => {
                window.location.reload();
            });
            loaderLoad("no");
        }
    });

});


// Back to home album gallery
backBtn.addEventListener('click', () => {
    const home = localStorage.getItem("homeurl");
    window.location.href = `${baseURL}` + home;
});

// Check album on load
window.addEventListener("DOMContentLoaded", function () {
    const alb = localStorage.getItem("album");
    mypost({
        url: `${apiURL}/checkAlbum/${alb}`,
        method: "GET",
        success: function (response) {
            if (response.code == 200) {
                // Proceed
            } else {
                Swal.fire({
                    title: "ERROR",
                    text: response.details.error,
                    icon: "error"
                }).then(() => {
                    window.location.href = localStorage.getItem("homeurl");
                });
            }
        },
        error: function (error) {
            alert(error);
        }
    });
});
