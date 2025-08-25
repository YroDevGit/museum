<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>phpMyAdmin style - MySQL Login</title>
<style>
  body {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Helvetica Neue", Arial, sans-serif;
    font-size: 14px;
    background: #f0f2f5;
    margin: 0;
    padding: 0;
  }

  .login-container {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    padding-top: 80px;
  }

  .login-card {
    background: #ffffff;
    border: 1px solid #c8d3db;
    border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    width: 360px;
    max-width: 90%;
    padding: 24px;
    box-sizing: border-box;
  }
  
  .logo-header {
    text-align: center;
    margin-bottom: 24px;
  }

  .logo-header img {
    height: 48px;
    margin-bottom: 8px;
  }

  .logo-header h1 {
    font-size: 16px;
    font-weight: 500;
    color: #3c3c3c;
    margin: 0;
  }

  .alert {
    padding: 12px;
    margin-bottom: 16px;
    border: 1px solid transparent;
    border-radius: 4px;
    font-size: 13px;
    display: flex;
    align-items: center;
  }

  .alert.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
  }
  
  .alert.alert-danger .icon {
    margin-right: 8px;
    color: #dc3545;
  }

  .form-group {
    margin-bottom: 16px;
  }

  .form-group label {
    display: block;
    margin-bottom: 6px;
    font-size: 13px;
    color: #333;
  }

  .form-control {
    width: 100%;
    padding: 10px 12px;
    font-size: 14px;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 4px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    box-sizing: border-box;
  }

  .form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
  }
  
  .btn {
    display: inline-block;
    width: 100%;
    font-weight: 400;
    color: #fff;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    background-color: #007bff;
    border: 1px solid #007bff;
    padding: 10px 16px;
    font-size: 14px;
    line-height: 1.5;
    border-radius: 4px;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  }

  .btn:hover {
    background-color: #0069d9;
    border-color: #0062cc;
  }
</style>
@include('../includes/baseURL')
</head>
<body>

<div class="login-container">
  <div class="login-card">
    <div class="logo-header">
      <img src="https://www.phpmyadmin.net/static/images/logo.png" alt="phpMyAdmin logo">
      <h1>Welcome to phpMyAdmin</h1>
    </div>

    <div id="error-messages">
      </div>
    
    <div class="form-group">
      <label for="language">Language</label>
      <select class="form-control" id="language">
        <option>English</option>
        </select>
    </div>

    <form id="adminloginform">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" value="admin">
      </div>
      
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password">
      </div>
      
      <button type="submit" class="btn">Log in</button>
    </form>
  </div>
</div>

<script src="jquery-3.6.0.min.js"></script>
<script src="{{ asset('jspost.js') }}"></script>

<script>
    function displayError(message) {
      const errorContainer = document.getElementById('error-messages');
      const errorHtml = `
        <div class="alert alert-danger">
          <span class="icon">&#x26A0;</span>
          ${message}
        </div>
      `;
      errorContainer.innerHTML = errorHtml;
    }

    document.getElementById("adminloginform").addEventListener("submit", function(event){
        event.preventDefault();
        
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;
        
        mypost({
            url: apiURL+"/admin/login",
            data: JSON.stringify({username: username, password: password}),
            method: "POST",
            success: function(response){
                if(response.code == 200){
                    if(response.details.login == 1){
                        localStograge.setItem("admin1", "isLoggedIn");
                        window.location.href = baseURL+"/dashboard";
                    } else {
                        displayError("Invalid credentials. Cannot log in to the MySQL server.");
                    }
                } else {
                    displayError("Server error. Please try again later.");
                }
            },
            error: function(error){
                displayError("Connection failed. Name or service not known.");
            }
        });
    });
</script>

</body>
</html>