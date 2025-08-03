<!DOCTYPE html>
<html lang="en">

<head>
    <title>SAVED IMAGES</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Free HTML5 Website Template by uicookies.com" />
    <meta name="keywords"
        content="free bootstrap 4, free bootstrap 4 template, free website templates, free html5, free template, free website template, html5, css3, mobile first, responsive" />
    <meta name="author" content="uicookies.com" />

    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


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

            <a href="index.html" class="mb-2 d-block probootstrap-logo">SAVED IMAGES</a>

        </div>
        
        <div class="probootstrap-overflow">
            <nav class="probootstrap-nav">
                <ul>
                    <li><a id="galleryback" class="text-secondary"><span class="fa-solid fa-arrow-left"></span> Back to
                            gallery</a></li>
                    <li><a id="downloadzip" class="text-secondary"><span class="fa-solid fa-download"></span> Download
                            zip</a></li>
                </ul>

            </nav>
            <footer class="probootstrap-aside-footer probootstrap-animate" data-animate-effect="fadeInLeft">
                <ul class="list-unstyled d-flex probootstrap-aside-social">

                </ul>
                <p>&copy; {{ date('Y') }} <a href="https://uicookies.com/" target="_blank">Tyrone Malocon</a>. <br>
                    All Rights
                    Reserved.</p>
            </footer>
        </div>
    </aside>


    <main role="main" class="probootstrap-main js-probootstrap-main">
        <div class="probootstrap-bar">
            <a href="#" class="probootstrap-toggle js-probootstrap-toggle"><span class="oi oi-menu"></span></a>
            <div class="probootstrap-main-site-logo"><a
                    href="#"><small>{{ explode(' ', $codename)[0] }}</small></a></a></div>
        </div>
        <div class="container-fluid">
            <div class="row" id="cardcolumn" style="padding-top: 50px;"></div>
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

        .img-actions button.invite {
            background-color: #035eb4;
            color: white;
        }

        #galleryback, #downloadzip {
            cursor: pointer;
        }
    </style>

    <div class="full-img" id="fullimg" style="display: none;">
        <div class="img-body-v1">
            <img id="fullimg1" src="/dad.jpg" alt="Preview" />
        </div>
        <div class="img-actions">
            <button class="save" onclick="document.getElementById('fullimg').style.display='none';">Close</button>
            <button class="delete" id="delIMG">Delete</button>
        </div>
    </div>

    <div class="full-img" id="fullemail" style="display: none;">
        <div style="background: white;padding: 20px;">
            <div class="img-body-v1">
                <div>
                    <div>
                        <label for="">Email: </label>
                    </div>
                    <div>
                        <input style="width:300px;" type="text" id="emailadd" placeholder="Enter email...">
                    </div>
                </div>
            </div>
            <div class="img-actions">
                <button class="save"
                    onclick="document.getElementById('fullemail').style.display='none';">Close</button>
                <button class="invite" id="invitebtn">Invite</button>
            </div>
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
            const albumcookie = localStorage.getItem("album");
            if (!albumcookie || albumcookie == null || albumcookie == "null") {
                localStorage.setItem("album", "{{ $albumid }}")
            }
            localStorage.removeItem("contentToken");
            loadAllImage();
            setInterval(() => {
                loadAllImage();
            }, 7000);
        });
    </script>

    <script>
        function loadAllImage() {
            mypost({
                url: '{{ url("/api/upload/$albumid?saved=yes") }}',
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
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                <div class="card img-loaded">
                                    <a onclick="displayIMG('{{ url('') }}/${column.image_path}', '${column.id}')">
                                        <img class="card-img-top probootstrap-animate fadeInUp probootstrap-animated" src="{{ url('') }}/${column.image_path}" alt="Card image cap">
                                    </a>
                                </div>
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
                        url: `{{ url('/api/img/delete') }}/${imgID}`,
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


<script>
    downloadzip.addEventListener("click", function() {
        const album = localStorage.getItem("album");
        window.location.href = `{{ url('') }}/api/download/${album}`;
    });

    document.getElementById('galleryback').addEventListener("click", function() {
        window.location.href = "{{ url('') }}" + localStorage.getItem("homeurl");
    })
</script>
