<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>QR Code Generator</title>
    <script src="https://cdn.jsdelivr.net/npm/qrious/dist/qrious.min.js"></script>
    <link rel="stylesheet" href="{{asset('mycss/shareqr.css')}}">
    @include('includes.baseURL')
</head>

<body>
    <div class="container">
        
        <input type="hidden" value="{{'photographer/remote'.'/'.$remote.'/'."$token"."?shared=yes"}}" id="qrText" placeholder="Enter text or URL" />
        <button id="toclickqr" style="display: none" onclick="generateQRCode()">Generate QR Code</button>
        <p><span>Scan this QR code to open the same live album on a
different phone</span></p>
        <div class="qr-container">
            <canvas id="qrCanvas"></canvas>
        </div>
        <div style="padding-top: 20px;">
            <a id="backbtn" style="text-decoration: underline;"><button class="btn btn-primary">Done</button></a>
        </div>
    </div>
<script src="{{asset('myscripts/shareqr.js')}}"></script>
</body>
</html>

