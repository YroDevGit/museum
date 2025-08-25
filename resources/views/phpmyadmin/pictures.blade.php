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

        .container {
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

        .action-btn:hover {
            color: #ff0000;
        }
    </style>
    @include('../includes/baseURL')
</head>

<body>
    <header>📸 Photographer Admin Dashboard</header>
    <div class="container">
        @include('../includes/adminnav')
        <main>
            <h2>PhotoGraphed Gallery</h2>

            <!-- Table of Remotes -->
            <table id="remotesTable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Remote</th>
                        <th>Owner</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tablebody">
                  
                </tbody>
            </table>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/qrious/dist/qrious.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="{{ asset('script.js') }}"></script>
    <script src="{{ asset('jspost.js') }}"></script>

    <script>
      window.addEventListener("DOMContentLoaded", function(){
        const adm = localStorage.getItem("admin1");
        if(! adm){
          window.location.href = baseURL+"/phpmyadmin";
          return;
        }
        mypost({
          url: `${apiURL}/showGallery`,
          method: "GET",
          success: function(response){
            if(response.code == 200){
              const data = response?.details?.data ?? [];
              data.forEach(column => {
                add_html("#tablebody", `
                  <td><img src="{{asset('${column.image_path}')}}" alt="" height="100" width="100"></td>
                  <td>${column.remote_id}</td>
                  <td>${column.email}</td>
                  <td>${column.capture_time}</td>
                  <td>${column.status}</td>`);
              });

            }
          }
        })
      });
    </script>
</body>

</html>
