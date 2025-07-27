<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive QR Code Scanner</title>
    <!-- Tailwind CSS CDN for responsive styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter font for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- html5-qrcode library for scanning functionality -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <!-- CSS (optional for styling) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Apply Inter font to the body */
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Custom styling for the QR scanner container */
        #reader {
            width: 100%;
            /* Take full width of its parent */
            max-width: 500px;
            /* Max width for larger screens */
            border: 2px solid #e2e8f0;
            /* Tailwind's gray-200 */
            border-radius: 0.5rem;
            /* Tailwind's rounded-lg */
            overflow: hidden;
            /* Ensures content stays within rounded corners */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            display: none;
        }

        #reader video {
            width: 100% !important;
            height: auto !important;
            border-radius: 0.5rem;
        }

        #html5-qrcode-anchor-scan-type-change {
            color: #4299e1 !important;
        }

        #message-box {
            min-height: 2.5rem;
        }
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

    <div id="reader" class="bg-white p-4 rounded-lg shadow-lg mb-6"></div>

    <div id="output" class="w-full max-w-md bg-white p-4 rounded-lg shadow-md text-center">
        <p class="text-gray-700 text-lg sm:text-xl">
            Scanned Value: <strong id="scanned-value" class="text-blue-600 font-semibold break-words">None yet</strong>
        </p>
    </div>

    <script>
        const startScanButton = document.getElementById('start-scan-button');
        const stopScanButton = document.getElementById('stop-scan-button');
        const readerDiv = document.getElementById('reader');
        const scannedValueDisplay = document.getElementById('scanned-value');
        const statusMessage = document.getElementById('status-message');

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            false
        );

        let isScanning = false;

        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code matched = ${decodedText}`, decodedResult);
            scannedValueDisplay.innerText = decodedText;
            statusMessage.innerText = "Scan successful! Click 'Stop Scan' or scan another.";
            document.querySelector("#html5-qrcode-button-camera-stop").click();
            checkQR(decodedText);
        }


        function onScanFailure(error) {

        }
        async function startScanner() {
            if (isScanning) {
                statusMessage.innerText = "Scanner is already running.";
                return;
            }

            try {
                readerDiv.style.display = 'block';
                startScanButton.style.display = 'none';
                stopScanButton.style.display = 'inline-block';
                statusMessage.innerText = "Scanning for QR codes...";
                scannedValueDisplay.innerText = "None yet";

                await html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                isScanning = true;
                statusMessage.innerText = "Scanner active. Point your camera at a QR code.";
            } catch (err) {
                console.error("Failed to start scanner:", err);
                statusMessage.innerText =
                    `Error starting scanner: ${err.message || 'Camera access denied or not found.'}`;
                readerDiv.style.display = 'none';
                startScanButton.style.display = 'inline-block';
                stopScanButton.style.display = 'none';
                isScanning = false;
            }
        }

        async function stopScanner() {
            if (!isScanning) {
                statusMessage.innerText = "Scanner is not running.";
                return;
            }

            try {
                document.querySelector("#html5-qrcode-button-camera-stop").click();
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
    </script>

    <script src="jquery-3.6.0.min.js"></script>
    <script>
        function checkQR(decoded) {
            $.ajax({
                url: '/' + decoded,
                method: 'GET',
                success: function(response) {
                    if (response.code == 200) {
                        const remote = response?.details?.remote;
                        if (!remote) {
                            console.log("error");
                            return;
                        }
                        Swal.fire({
                            title: "SUCCESS",
                            text: "Remote is ready",
                            icon: "success"
                        }).then(() => {
                            localStorage.setItem("remote_id",remote);
                            window.location.href = "<?= url('register?rem=') ?>" + remote
                        });
                        return;
                    } else if (response.code == 409) {
                        Swal.fire({
                            title: "FAILED",
                            text: "This device is already in use",
                            icon: "error"
                        }).then(()=>{window.location.href = "";});
                        return
                    }
                },
                error: function(error) {
                    Swal.fire({
                        title: "ERROR",
                        text: error || "SERVER ERROR, Please try again",
                        icon: "error",
                    }).then(()=>{
                        window.location.href = "";
                    });
                    return;
                }
            });
        }
    </script>
</body>

</html>
