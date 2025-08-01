//reset cookies
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



window.addEventListener("DOMContentLoaded", function () {
    const logout = "{{$logout??'no'}}";
    if (logout && logout == "yes") {
        resetCookies();
    }
    const hmurl = localStorage.getItem("homeurl");
    const albm = localStorage.getItem("album");
    if (hmurl && albm) {
        window.location.href = `${baseURL}${hmurl}`; return;
    }
    resetCookies();

})
const startScanButton = document.getElementById('start-scan-button');
const stopScanButton = document.getElementById('stop-scan-button');
const readerDiv = document.getElementById('reader');
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');
const scannedValueDisplay = document.getElementById('scanned-value');
const statusMessage = document.getElementById('status-message');

let isScanning = false;
let stream;
let animationFrameId;

async function startScanner() {
    if (isScanning) {
        statusMessage.innerText = "Scanner is already running.";
        return;
    }

    try {
        // Request camera access
        stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } });
        video.srcObject = stream;
        video.setAttribute("playsinline", true); // required for iOS
        video.play();

        readerDiv.style.display = 'block';
        startScanButton.style.display = 'none';
        stopScanButton.style.display = 'inline-block';
        statusMessage.innerText = "Scanning for QR codes...";
        scannedValueDisplay.innerText = "None yet";

        isScanning = true;
        requestAnimationFrame(tick); // Start scanning loop
        statusMessage.innerText = "Scanner active. Point your camera at a QR code.";

    } catch (err) {
        console.error("Failed to start scanner:", err);
        statusMessage.innerText = `Error starting scanner: ${err.message || 'Camera access denied or not found.'}`;
        readerDiv.style.display = 'none';
        startScanButton.style.display = 'inline-block';
        stopScanButton.style.display = 'none';
        isScanning = false;
        Swal.fire({
            title: "Camera Error",
            text: "Could not access camera. Please ensure camera permissions are granted and try again.",
            icon: "error"
        });
    }
}

function tick() {
    if (!isScanning || video.readyState !== video.HAVE_ENOUGH_DATA) {
        animationFrameId = requestAnimationFrame(tick);
        return;
    }

    canvas.height = video.videoHeight;
    canvas.width = video.videoWidth;
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
    const code = jsQR(imageData.data, imageData.width, imageData.height, {
        inversionAttempts: "dontInvert",
    });

    if (code) {
        console.log("Found QR code", code.data);
        scannedValueDisplay.innerText = code.data;
        statusMessage.innerText = "Scan successful! Click 'Stop Scan' or scan another.";
        stopScanner(); // Stop scanning after successful scan
        checkQR(code.data);
    } else {
        animationFrameId = requestAnimationFrame(tick);
    }
}

async function stopScanner() {
    if (!isScanning) {
        statusMessage.innerText = "Scanner is not running.";
        return;
    }

    try {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
            video.srcObject = null;
        }
        cancelAnimationFrame(animationFrameId); // Stop the animation loop
        isScanning = false;
        readerDiv.style.display = 'none';
        startScanButton.style.display = 'inline-block';
        stopScanButton.style.display = 'none';
        statusMessage.innerText = "Scanner stopped. Click 'Start Scan' to resume.";
    } catch (err) {
        console.error("Failed to stop scanner:", err);
        statusMessage.innerText = `Error stopping scanner: ${err.message}`;
    }
}

startScanButton.addEventListener('click', startScanner);
stopScanButton.addEventListener('click', stopScanner);
statusMessage.innerText = "Click 'Start Scan' to begin.";

// Your existing checkQR function (ensure `url()` is defined or removed for static testing)
function checkQR(decoded) {
    $.ajax({
        url: '/' + decoded,
        method: 'GET',
        success: function (response) {
            if (response.code == 200) {
                const remote = response?.details?.remote;
                const shared = response?.details?.shared;

                if (!remote) {
                    alert("No remote found.!");
                    return;
                }
                const albumid = response?.details?.album?.id ?? null;
                const remotetoken = response?.details?.remotetoken ?? null;

                Swal.fire({
                    title: "SUCCESS",
                    text: "Remote is ready",
                    icon: "success"
                }).then(() => {
                    localStorage.setItem("remote_id", remote);
                    localStorage.setItem("shared", shared);
                    localStorage.setItem("album", albumid);
                    localStorage.setItem("remotetoken", remotetoken);
                    window.location.href = baseURL + "/register?rem=" + remote + "&shared=" + shared;
                });
                return;
            } else if (response.code == 409) {
                Swal.fire({
                    title: "FAILED",
                    text: response.details.error,
                    icon: "error"
                }).then(() => { window.location.href = ""; });
                return
            }
        },
        error: function (jqXHR, textStatus, errorThrown) { // Improved error handling for AJAX
            let errorMessage = "SERVER ERROR, Please try again";
            if (jqXHR.responseJSON && jqXHR.responseJSON.details && jqXHR.responseJSON.details.error) {
                errorMessage = jqXHR.responseJSON.details.error;
            } else if (errorThrown) {
                errorMessage = errorThrown;
            }
            Swal.fire({
                title: "ERROR",
                text: errorMessage,
                icon: "error",
            }).then(() => {
                window.location.href = "";
            });
            return;
        }
    });
}