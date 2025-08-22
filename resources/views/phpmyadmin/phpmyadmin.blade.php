<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Photographer Admin Dashboard</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        header {
            background: #006699;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .container1 {
            display: flex;
        }

        nav {
            width: 220px;
            background: #eee;
            padding: 15px;
            border-right: 1px solid #ccc;
            height: 100vh;
        }

        nav h3 {
            margin-top: 0;
            font-size: 14px;
            margin-bottom: 10px;
        }

        nav a {
            display: block;
            padding: 6px 8px;
            text-decoration: none;
            color: #333;
            font-size: 13px;
        }

        nav a:hover {
            background: #ddd;
        }

        main {
            flex: 1;
            padding: 20px;
        }

        h2 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 8px 10px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: #f0f0f0;
        }

        .form-box {
            background: #fff;
            padding: 15px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        .form-box label {
            display: block;
            margin: 6px 0 4px;
            font-size: 13px;
        }

        .form-box input {
            width: 100%;
            padding: 6px;
            border: 1px solid #aaa;
            border-radius: 3px;
        }

        .form-box select {
            width: 20%;
            padding: 6px;
            border: 1px solid #aaa;
            border-radius: 3px;
        }

        .form-box button {
            margin-top: 10px;
            background: #006699;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 3px;
            cursor: pointer;
        }

        .form-box button:hover {
            background: #004466;
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            color: #cc0000;
        }

        .action-btn-qr {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            color: #595757;
        }

        .action-btn:hover {
            color: #ff0000;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('../includes.baseURL')
</head>

<body>
    <header>📸 Photographer Admin Dashboard</header>
    <div class="container1">
        <nav>
            <h3>Navigation</h3>
            <a href="#">Dashboard</a>
            <a href="#">Manage Remotes</a>
            <a href="#">Settings</a>
        </nav>
        <main>
            <h2>Manage Remotes</h2>

            <!-- Add Remote Form -->
            <div class="form-box">
                <form id="remoteform">
                    <h3>Add New Remote</h3>
                    <label for="remoteName">Remote ID</label>
                    <input type="text" id="remoteid" required>

                    <label for="remoteURL">Remote Venue</label>
                    <select id="venue" required></select>

                    <button type="submit">Add Remote</button>
                </form>
            </div>

            <!-- Table of Remotes -->
            <table id="remotesTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Remote ID</th>
                        <th>Venue</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tablebody">

                </tbody>
            </table>
        </main>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Remote QR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="qr-container" align="center">
                        <canvas id="qrCanvas"></canvas>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/qrious/dist/qrious.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="jquery-3.6.0.min.js"></script>
<script src="{{ asset('script.js') }}"></script>
<script src="{{ asset('jspost.js') }}"></script>

<script>
    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    const qr = new QRious({
        element: document.getElementById('qrCanvas'),
        size: 250,
        value: ''
    });
    window.addEventListener("DOMContentLoaded", function() {
        mypost({
            url: apiURL + "/venue/getall",
            method: "GET",
            success: function(response) {
                if (response.code == 200) {
                    const data = response.details.data;
                    data.forEach(column => {
                        add_html("#venue",
                            `<option value='${column.id}'>${column.name}</option>`);
                    });
                }
            }
        });
        getRemotes();
    });


    function generateQRCode(id) {
        const text = id;
        if (!text) {
            alert("Please enter text or a URL.");
            return;
        }
        let qrtext = null;
        mypost({
            url: `${apiURL}/qr/get/` + text,
            method: "GET",
            success: function(response) {
                if (response.code == 200) {
                    const data = response.details.data;
                    const token = response.details.token;
                    const qrtextresult = `photographer/remote/${data.id}/${token}`;
                    qr.value = qrtextresult;
                    //console.log(qrtextresult);
                    myModal.show();
                } else {
                    alert(response.details.error);
                }
            },
            error: function(error) {
                alert(error);
            }
        });
    }


    function getRemotes() {
        mypost({
            url: apiURL + "/remote/getAll",
            method: "GET",
            success: function(response) {
                if (response.code == 200) {
                    const data = response.details.data;
                    let count = 1;
                    data.forEach(column => {
                        let online = `<button title="offline" class="action-btn-qr"><i class="fas fa-circle text-gray"></i></button>`;
                        if(column.online == 1){
                            online = `<button title="live" class="action-btn"><i class="fas fa-circle text-danger"></i></button>`
                        }
                        add_html("#tablebody",
                            `<tr>
                        <td>${count}</td>
                        <td>${online} ${column.id}</td>
                        <td>${column.name}</td>
                        <td><button class="action-btn"><i class="fa-solid fa-trash"></i></button><button class="action-btn-qr" onclick="generateQRCode(${column.id})"><i class="fa-solid fa-qrcode"></i></button></td>
                    </tr>`);
                        count += 1;
                    });
                }
            }
        });
    }

    document.getElementById("remoteform").addEventListener("submit", function() {
        event.preventDefault();
        mypost({
            url: apiURL + "/remote/add",
            method: "POST",
            data: JSON.stringify({
                remoteid: remoteid.value,
                venue: venue.value
            }),
            success: function(response) {
                if (response.code == 200) {
                    Swal.fire({
                        title: "Success",
                        text: "Remote added",
                        icon: "success"
                    }).then(() => {
                        window.location.reload();
                    })
                } else if (response.code == 409) {
                    alert(response.details.error);
                }
            }
        });
    });
</script>
