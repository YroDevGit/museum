<!DOCTYPE html>
<html lang="en">

<head>
    <title>Aside - Free HTML5 Bootstrap 4 Template by uicookies.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Free HTML5 Website Template by uicookies.com" />
    <meta name="keywords"
        content="free bootstrap 4, free bootstrap 4 template, free website templates, free html5, free template, free website template, html5, css3, mobile first, responsive" />
    <meta name="author" content="uicookies.com" />

    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>

    <aside class="probootstrap-aside js-probootstrap-aside">
        <a href="#" class="probootstrap-close-menu js-probootstrap-close-menu d-md-none"><span
                class="oi oi-arrow-left"></span> Close</a>
        <div class="probootstrap-site-logo probootstrap-animate" data-animate-effect="fadeInLeft">

            <a href="index.html" class="mb-2 d-block probootstrap-logo">Aside</a>
            <p class="mb-0">Another free html5 bootstrap 4 template by <a href="https://uicookies.com/"
                    target="_blank">uiCookies</a></p>
        </div>
        <div class="probootstrap-overflow">
            <nav class="probootstrap-nav">
                <ul>
                    <a href="{{ url('/cam/' . $userid . '/' . $albumid) }}"><button
                            class="btn btn-primary">CAPTURE</button></a>
                </ul>
            </nav>
            <footer class="probootstrap-aside-footer probootstrap-animate" data-animate-effect="fadeInLeft">
                <ul class="list-unstyled d-flex probootstrap-aside-social">
                    <li><a href="#" class="p-2"><span class="icon-download"></span></a></li>
                    <li><a href="#" class="p-2"><span class="icon-link"></span></a></li>
                    <li><a href="#" id="iconshare" class="p-2"><span class="icon-share"></span></a></li>
                </ul>
                <p>&copy; 2017 <a href="https://uicookies.com/" target="_blank">uiCookies:Aside</a>. <br> All Rights
                    Reserved.</p>
            </footer>
        </div>
    </aside>


    <main role="main" class="probootstrap-main js-probootstrap-main">
        <div class="probootstrap-bar">
            <a href="#" class="probootstrap-toggle js-probootstrap-toggle"><span class="oi oi-menu"></span></a>
            <div class="probootstrap-main-site-logo"><a href="index.html">Aside</a></a></div>
        </div>
        <div class="card-columns d-flex flex-wrap gap-2" id="cardcolumn">

        </div>

        <div class="container-fluid d-md-none">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-unstyled d-flex probootstrap-aside-social">

                    </ul>
                    <p>&copy; 2017 <a href="https://uicookies.com/" target="_blank">uiCookies:Aside</a>. <br> All
                        Rights Reserved. Designed by <a href="https://uicookies.com/" target="_blank">uicookies.com</a>
                    </p>
                </div>
            </div>
        </div>

    </main>

    <style>
        @media (max-width: 768px) {
            .card.img-loaded {
                width: calc(50% - 10px);
                /* 2 per row */
            }
        }

        @media (max-width: 480px) {
            .card.img-loaded {
                width: 100%;
                /* full width on phones */
            }
        }



        #cardcolumn {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: start;
        }

        .card.img-loaded {
            width: calc(33.333% - 10px);
            /* 3 per row */
            box-sizing: border-box;
            border: none;
        }

        .card.img-loaded img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 6px;
        }

        .full-img {
            position: fixed;
            /* changed to fixed */
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.7);
            height: 100%;
            width: 100%;
            z-index: 100;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            overflow: auto;
            padding: 1rem;
            box-sizing: border-box;
        }

        .img-body-v1 {
            max-width: 100%;
            max-height: 100%;
            text-align: center;
        }

        #fullimg1 {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .img-actions {
            margin-top: 1rem;
            text-align: center;
        }

        .img-actions button {
            margin: 0 10px;
            padding: 8px 16px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .img-actions button.save {
            background-color: #4CAF50;
            color: white;
        }

        .img-actions button.delete {
            background-color: #f44336;
            color: white;
        }
    </style>

    <div class="full-img" id="fullimg" style="display: none;">
        <div class="img-body-v1">
            <img id="fullimg1" src="/dad.jpg" alt="Preview" />
        </div>
        <div class="img-actions">
            <button class="save" onclick="document.getElementById('fullimg').style.display='none';">Close</button>
            <button class="delete" id="delIMG">Delete</button>
            <p style="padding: 7px; color:white;">
                <span>long click on the image
                    and click save to camera roll</span>
            </p>
        </div>
    </div>



    <script src="{{ asset('js/jquery-3.2.1.slim.min.js') }}"></script>
    <script src="{{ asset('jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('jspost.js') }}"></script>


    <script>
        $(document).ready(function() {
            localStorage.setItem("homeurl", window.location.pathname);
            localStorage.removeItem("contentToken");
            loadAllImage();
            setInterval(() => {
                loadAllImage();
            }, 7000);
        });
    </script>

    <script>
        function loadAllImage() {
            $.ajax({
                url: '{{ url("/upload/$albumid") }}',
                method: "GET",
                success: function(response) {
                    const data = response?.details?.data ?? [];
                    const updates = response?.details?.data ?? [];
                    const currentContent = localStorage.getItem("contentToken") ?? "";
                    const newUpdate = JSON.stringify(updates);
                    if (currentContent === newUpdate) {
                        return;
                    }
                    localStorage.setItem("contentToken", newUpdate);

                    document.querySelector("#cardcolumn").innerHTML = '';
                    data.forEach(column => {
                        console.log(column);
                        document.querySelector("#cardcolumn").insertAdjacentHTML(
                            'beforeend', `
                    <div class="card img-loaded">
                        <a onclick="displayIMG('{{ url('') }}/${column.image_path}', '${column.id}')">
                            <img class="card-img-top probootstrap-animate fadeInUp probootstrap-animated" src="{{ url('') }}/${column.image_path}" alt="Card image cap">
                        </a>
                    </div>
                    `);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>

    <script>
        function displayIMG(img, imgid) {
            document.getElementById('fullimg').style.display = '';
            document.getElementById('fullimg1').src = img;
            localStorage.setItem("mainIMGID", imgid);
        }
    </script>

    <script>
        document.querySelector("#iconshare").addEventListener("click", function() {
            const remoteID = localStorage.getItem("remote_id");
            const token = localStorage.getItem("remotetoken");
            window.location.href = "{{ url('/shareqr') }}/" + remoteID + "/" + token;
        });
    </script>

    <script>
        document.querySelector("#delIMG").addEventListener("click", function() {
            Swal.fire({
                title: "Are you sure",
                text: "are you sure to delete selected image?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Okay, delete it.!"
            }).then((res) => {
                if (res.isConfirmed) {
                    const imgID = localStorage.getItem("mainIMGID");
                    mypost({
                        url: `{{ url('/img/delete') }}/${imgID}`,
                        method: "DELETE",
                        success: function(response) {
                            if (response.code == 200) {
                                Swal.fire({
                                    title: "SUCCESS",
                                    text: "Capture deleted",
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "ERROR",
                                    text: response.message,
                                    icon: "error"
                                });
                            }
                        },
                        error: function(error) {
                            console.log(response);
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>
