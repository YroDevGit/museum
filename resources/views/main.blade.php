<!DOCTYPE html>
<html lang="en">

<head>
    <title>PHOTO-GRAPHED</title>
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

    <link rel="stylesheet" href="{{ asset('mycss/main.css') }}">
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('includes.baseURL');
    <script>
        const albumid = "{{ $albumid }}";
        const utoken = "{{ $utoken }}";
        const userID = "{{$userid}}";
        const captureID = "{{ url('/cam/' . $userid . '/' . $albumid . '/' . $utoken) }}";
    </script>

</head>

<body>

    <aside class="probootstrap-aside js-probootstrap-aside">
        <a href="#" class="probootstrap-close-menu js-probootstrap-close-menu d-md-none"><span
                class="oi oi-arrow-left"></span> Close</a>
        <div class="probootstrap-site-logo probootstrap-animate" data-animate-effect="fadeInLeft">

            <a href="index.html" class="mb-2 d-block probootstrap-logo">PHOTO-GRAPHED</a>
            <p class="mb-0">Images here is not yet saved. to save images, click the image to open, when expanded press
                the image to save.</p>
        </div>

        <div class="probootstrap-overflow">
            <nav class="probootstrap-nav">
                <ul>
                    <a href="#" id="capturebtn"><button
                            class="btn btn-primary">CAPTURE</button></a>
                </ul>
            </nav>
            <footer class="probootstrap-aside-footer probootstrap-animate" data-animate-effect="fadeInLeft">
                <ul class="list-unstyled d-flex probootstrap-aside-social">
                    <li><a href="#" class="p-2" id="saveimg"><span class="fa-solid fa-download"></span></a>
                    </li>
                    <li><a href="#" id="inviteusericon" class="p-2"><span
                                class="fa-solid fa-user-plus"></span></a></li>
                    <li><a href="#" id="iconshare" class="p-2"><span class="fa-solid fa-qrcode"></span></a>
                    </li>
                    <li><a id="logout" href="#" class="p-2"><span class="fa-solid fa-sign-out"></span></a>
                    </li>
                </ul>
                <p>&copy; {{ date('Y') }} <a href="#" target="_blank">Tyrone Malocon</a>. <br>
                    All Rights
                    Reserved.</p>
            </footer>
        </div>
    </aside>


    <main role="main" class="probootstrap-main js-probootstrap-main">
        <div class="probootstrap-bar">
            <a href="#" class="probootstrap-toggle js-probootstrap-toggle"><span class="oi oi-menu"></span></a>
            <div class="probootstrap-main-site-logo"><a
                    href="#"><small>{{ explode(' ', $codename)[0] }}</small></a></a>
            </div>
        </div>
        <div class="container-fluid">
            <div style="padding-top: 5px;">
                <div align='right' style="padding:10px 0px;"><span id="refresh" class="fa-solid fa-refresh" style="font-size: 20px;"></span></div>
                 <div class="row" id="cardcolumn" ></div>
            </div>
        </div>


        <div class="container-fluid d-md-none">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-unstyled d-flex probootstrap-aside-social">

                    </ul>
                    <p>&copy; 2017 <a href="#" target="_blank">TyroneLeeEmz</a>. <br> All
                        Rights Reserved. Designed by <a href="#" target="_blank">TyroneLeeEmz</a>
                    </p>
                </div>
            </div>
        </div>

    </main>

    <div class="full-img" id="fullimg" style="display: none;">
        <div class="img-body-v1">
            <img onclick="saveIMG()" id="fullimg1" src="/dad.jpg" alt="Preview" />
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

    <div class="full-img" id="fullemail" style="display: none;">
        <div style="background: white;padding: 20px;">
            <div class="img-body-v1">
                <div>
                    <div>
                        <label for="">Email: </label>
                    </div>
                    <div>
                        <input class="form-control" style="width:300px;" type="text" id="emailadd"
                            placeholder="Enter email...">
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
    <script src="{{ asset('myscripts/custom.js') }}"></script>
    <script src="{{ asset('myscripts/main.js') }}"></script>
    <script src="https://yrodevgit.github.io/injector/special.js"></script>

</body>

</html>

<div id="loader" style="display: none;">
  <div class="spinner"></div>
</div>