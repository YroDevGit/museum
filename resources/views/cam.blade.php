<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Camera App with Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('includes/baseURL')
    <script>
        const USERID = "{{ $userid }}";
        const ALBUMID = "{{ $albumid }}";
    </script>
    <link rel="stylesheet" href="{{asset('mycss/cam.css')}}">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" xintegrity="sha512-iecdLmaskl7CVs3e1Wq80Qk7F8Q0F8nE7/C2M6O6pXoD6Q5n8t5q7k2L2jD2v1h5r5j/s+P7N+w+P7k+x5u3a5O6w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div id="camera-container">
        <button id="backBtn">
            <i class="fas fa-arrow-left"></i>
        </button>
        <video id="video" autoplay playsinline></video>
        <!-- The capture button is now empty to match the CSS styling -->
        <button id="captureBtn"></button>
        <button id="flipBtn">
            <i class="fas fa-sync-alt"></i>
        </button>
        <img id="thumbnail" alt="Captured" />
        <canvas id="canvas"></canvas>
    </div>

    <div id="modal">
        <span id="modalClose">&times;</span>
        <img id="modalImage" src="" alt="Captured Preview" />
        <button id="uploadBtn">Upload</button>
    </div>


    


    <script src="{{ asset('jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('jspost.js') }}"></script>
    <script src="{{ asset('myscripts/cam.js') }}"></script>
</body>

</html>

<div id="loader" style="display: none;">
  <div class="spinner"></div>
</div>
