<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>QR Code Generator</title>
    <script src="https://cdn.jsdelivr.net/npm/qrious/dist/qrious.min.js"></script>
    

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.5em;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1em;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 1em;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .qr-container {
            margin-top: 20px;
            text-align: center;
        }

        canvas {
            max-width: 100%;
            height: auto;
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px 20px;
            }
        }
    </style>
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

    
    <script>
        const qr = new QRious({
            element: document.getElementById('qrCanvas'),
            size: 250,
            value: ''
        });

        function generateQRCode() {
            const text = document.getElementById('qrText').value.trim();
            if (!text) {
                alert("Please enter text or a URL.");
                return;
            }
            qr.value = text;
        }
    </script>
</body>

</html>
