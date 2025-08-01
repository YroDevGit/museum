<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>QR Code Generator</title>
    <script src="https://cdn.jsdelivr.net/npm/qrious/dist/qrious.min.js"></script>
    <link rel="stylesheet" href="{{asset('mycss/qrgen.css')}}">
    @include('includes.baseURL')
</head>

<body>
    <div class="container">
        <h1>QR Code Generator</h1>
        <input type="text" id="qrText" placeholder="Enter text or URL" />
        <button onclick="generateQRCode()">Generate QR Code</button>
        <div class="qr-container">
            <canvas id="qrCanvas"></canvas>
        </div>
    </div>
    <script src="{{ asset('jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('jspost.js') }}"></script>

    <script src="{{asset('myscript/qrgen.js')}}"></script>
</body>

</html>
