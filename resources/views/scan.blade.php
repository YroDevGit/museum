<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Remote</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link rel="shortcut icon" href="ico.png" type="image/x-icon">
    @include('includes.baseURL')
    <script>
        const loggedOut = "{{ $logout ?? 'no' }}";
    </script>
</head>


<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-4 sm:p-6 md:p-8">

<div class="mb-4">
    <img src="{{ asset('images/mylogo.png') }}" height="300" width="300" alt="Logo" class="">
</div>

    <div class="flex space-x-4 mb-6">
        <button id="start-scan-button"
            class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75 transition duration-150 ease-in-out">
            Scan remote
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

    <div id="reader" class="bg-transparent p-4 rounded-lg shadow-lg mb-6" style="display: none;">
        <video id="video" playsinline muted autoplay class="w-full max-w-md h-auto max-h-[60vh] object-contain rounded-md border border-gray-300"></video>
        <canvas id="canvas" style="display: none;"></canvas>
    </div>

    <div style="display: none;" id="output" class="w-full max-w-md bg-white p-4 rounded-lg shadow-md text-center">
        <p class="text-gray-700 text-lg sm:text-xl">
            Scanned Value: <strong id="scanned-value" class="text-blue-600 font-semibold break-words">None yet</strong>
        </p>
    </div>

    <footer class="w-full text-center bg-transparent py-4 border-t border-gray-300 shadow-inner">
        <p class="text-sm text-gray-500">
            © 2025 CodeYro. All rights reserved.
        </p>
    </footer>

    <script src="jquery-3.6.0.min.js"></script>
    <script src="{{ asset('jspost.js') }}"></script>
    <script src="{{ asset('myscripts/custom.js') }}"></script>
    <script src="{{ asset('myscripts/scan.js') }}"></script>
</body>

</html>
