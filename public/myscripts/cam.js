//initialize elements
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const captureBtn = document.getElementById('captureBtn');
const thumbnail = document.getElementById('thumbnail');
const modal = document.getElementById('modal');
const modalImage = document.getElementById('modalImage');
const modalClose = document.getElementById('modalClose');
const uploadBtn = document.getElementById('uploadBtn');
const backBtn = document.getElementById('backBtn');

// Start camera
navigator.mediaDevices.getUserMedia({
    video: true
})
    .then(stream => {
        video.srcObject = stream;
    })
    .catch(err => {
        alert("Camera access denied.");
        console.error(err);
    });

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
    const imageData = thumbnail.getAttribute('data-image');
    const remid = localStorage.getItem("remote_id");

    mypost({
        url: "/upload",
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        data: JSON.stringify({
            image: imageData,
            user_id: '{{ $userid }}',
            album_id: '{{ $albumid }}',
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
        },
        error: function (error) {
            Swal.fire({
                title: "ERROR",
                text: "UPLOAD FAILED",
                icon: "error"
            }).then(() => {
                window.location.reload();
            });
        }
    });

});


//Back to home album gallery
backBtn.addEventListener('click', () => {
    const home = localStorage.getItem("homeurl");
    window.location.href = `${baseURL}` + home;
});