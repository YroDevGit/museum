<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Camera App with Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: black;
            font-family: sans-serif;
            overflow: hidden;
            color: white;
        }

        #camera-container {
            position: relative;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: black;
            flex-direction: column;
        }

        video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            #camera-container {
                height: 100vh;
            }

            video {
                width: 100vw;
                height: 100vw;
            }
        }

        #captureBtn {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 25px;
            background: white;
            color: black;
            border: none;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            z-index: 2;
        }

        #thumbnail {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: 70px;
            height: 70px;
            border: 2px solid white;
            object-fit: cover;
            cursor: pointer;
            display: none;
            z-index: 2;
        }

        canvas {
            display: none;
        }

        #modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
            z-index: 99;
            flex-direction: column;
        }

        #modal img {
            max-width: 90vw;
            max-height: 90vh;
            border: 4px solid white;
            margin-bottom: 20px;
        }

        #modalClose {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 30px;
            color: white;
            cursor: pointer;
        }

        #uploadBtn {
            padding: 10px 20px;
            font-size: 18px;
            background: white;
            color: black;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        #backBtn {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 3;
            background: rgba(255, 255, 255, 0.8);
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            font-size: 22px;
            color: black;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
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
    <script>
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
                success: function(response) {
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
                error: function(error){
                  Swal.fire({
                        title: "ERROR",
                        text: "UPLOAD FAIKED",
                        icon: "error"
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
            
        });

        backBtn.addEventListener('click', () => {
            const home = localStorage.getItem("homeurl");
            window.location.href = "{{ url('') }}" + home;
        });
    </script>

</body>

</html>
