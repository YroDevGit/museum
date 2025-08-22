<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>phpMyAdmin style - MySQL Login</title>
<style>
  body {
    font-family: Verdana, Arial, sans-serif;
    font-size: 11px;
    background: #f3f3f3;
    margin: 0;
    padding: 0;
  }

  /* top header bar */
  #topbar {
    background: #00618a;
    color: #fff;
    padding: 6px 10px;
    font-weight: bold;
    font-size: 12px;
  }

  /* login box */
  #login-box {
    width: 340px;
    margin: 80px auto;
    background: #fff;
    border: 1px solid #999;
    padding: 15px;
  }

  #login-box h2 {
    font-size: 13px;
    color: #00618a;
    margin: 0 0 10px;
    padding-bottom: 5px;
    border-bottom: 1px solid #ccc;
  }

  label {
    display: block;
    margin-top: 8px;
    font-size: 11px;
  }

  input[type="text"],
  input[type="password"] {
    width: 95%;
    padding: 4px;
    font-size: 11px;
    border: 1px solid #aaa;
    margin-top: 2px;
  }

  .btn {
    margin-top: 12px;
    padding: 5px 12px;
    font-size: 11px;
    background: #00618a;
    color: #fff;
    border: 1px solid #004466;
    cursor: pointer;
  }
  .btn:hover {
    background: #004466;
  }

  .error {
    color: red;
    margin-top: 10px;
    font-size: 11px;
  }
</style>
@include('../includes.baseURL');
</head>
<body>

<div id="topbar">phpMyAdmin – MySQL Login</div>

<div id="login-box">
  <h2>Log in</h2>
  <form id="adminloginform">
    <label for="username">Username:</label>
    <input type="text" id="username" placeholder="root" required>

    <label for="password">Password:</label>
    <input type="password" id="password" placeholder="••••••" required>

    <button type="submit" class="btn">Go</button>
  </form>

  <!-- Example error placeholder -->
  <!-- <div class="error">Access denied for user 'root'</div> -->
</div>

</body>
</html>
<script src="jquery-3.6.0.min.js"></script>
<script src="{{ asset('jspost.js') }}"></script>

<script>
    document.getElementById("adminloginform").addEventListener("submit", function(){
        event.preventDefault();
        mypost({
        url: apiURL+"/admin/login",
        data: JSON.stringify({username: username.value, password: password.value}),
        method: "POST",
        success: function(response){
            if(response.code==200){
                
                if(response.details.login == 1){
                    window.location.href = baseURL+"/dashboard";
                }else{
                    alert("Invalid Credentials");
                }
            }else{
                alert("Server error");
            }
        },
        error: function(error){
            alert("Server error");
        }
    });
    });
    
</script>