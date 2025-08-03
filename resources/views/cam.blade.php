<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Camera App with Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{asset('mycss/cam.css')}}">
    @include('includes.baseURL')
    <script>
        const USERID = "{{ $userid }}";
        const ALBUMID = "{{ $albumid }}";
    </script>
</head>

<body>

    <div id="camera-container">
        <button id="backBtn">←</button>
        <video id="video" autoplay playsinline></video>
        <button id="captureBtn">📸</button>
        <img id="thumbnail" alt="Captured" />
        <canvas id="canvas"></canvas>
    </div>

    <div id="modal">
        <span id="modalClose">&times;</span>
        <img id="modalImage" src="" alt="Captured Preview" />
        <button id="uploadBtn">📤 Upload</button>
    </div>

    <script src="{{ asset('jquery-3.6.0.min.js') }}"></script>
    <script src="{{asset('jspost.js')}}"></script>
    <script src="{{asset('myscripts/cam.js')}}"></script>
</body>

</html>
