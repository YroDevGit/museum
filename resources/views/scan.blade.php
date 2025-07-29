<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive QR Code Scanner</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        #reader {
            width: 100%; max-width: 500px; border: 2px solid #e2e8f0;
            border-radius: 0.5rem; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            display: none; /* Initially hidden */
        }
        #reader video { width: 100% !important; height: auto !important; border-radius: 0.5rem; }
        #message-box { min-height: 2.5rem; }
    </style>
</head>

<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-4 sm:p-6 md:p-8">
    <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-6 text-center">
        QR Code Scanner
    </h1>

    <div class="flex space-x-4 mb-6">
        <button id="start-scan-button"
            class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75 transition duration-150 ease-in-out">
            Start Scan
        </button>
        <button id="stop-scan-button"
            class="px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-75 transition duration-150 ease-in-out"
            style="display: none;">
            Stop Scan
        </button>
    </div>

    <div id="message-box"
        class="w-full max-w-md bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-2 rounded-lg mb-6 text-center shadow-sm">
        <p id="status-message" class="text-sm sm:text-base">Click "Start Scan" to begin.</p>
    </div>

    <div id="reader" class="bg-white p-4 rounded-lg shadow-lg mb-6">
        <video id="video" playsinline muted autoplay></video>
        <canvas id="canvas" style="display: none;"></canvas> </div>

    <div id="output" class="w-full max-w-md bg-white p-4 rounded-lg shadow-md text-center">
        <p class="text-gray-700 text-lg sm:text-xl">
            Scanned Value: <strong id="scanned-value" class="text-blue-600 font-semibold break-words">None yet</strong>
        </p>
    </div>

    <script src="jquery-3.6.0.min.js"></script>
    <script>
        window.addEventListener("DOMContentLoaded", function(){
            const hmurl = localStorage.getItem("homeurl");
            const albm = localStorage.getItem("album");
            if(hmurl && albm){
                window.location.href = `{{url('')}}${hmurl}`;return;
            }
            localStorage.removeItem("contentToken");
            localStorage.removeItem("homeurl");
            localStorage.removeItem("remote_id");
            localStorage.removeItem("mainIMGID");
            localStorage.removeItem("loggedin");
            localStorage.removeItem("album");
            localStorage.removeItem("shared");
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
                success: function(response) {
                    if (response.code == 200) {
                        const remote = response?.details?.remote;
                        const shared = response?.details?.shared;
                        
                        if (!remote) {
                            console.log("error");
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
                            window.location.href = "<?= url('register?rem=') ?>" + remote +"&shared="+shared;
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
                error: function(jqXHR, textStatus, errorThrown) { // Improved error handling for AJAX
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
    </script>
</body>

</html>