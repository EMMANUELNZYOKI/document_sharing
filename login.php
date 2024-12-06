<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Online Document Sharing System</title>
    <?php include('./header.php'); ?>
    <?php 
    if(isset($_SESSION['login_id']))
    header("location:index.php?page=home");
    ?>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url(assets/dist/img/night.jpg) no-repeat;
            background-size: cover;
            background-position: center;
        }
        .wrapper {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px;
        }
        .wrapper h1 {
            font-size: 36px;
            text-align: center;
        }
        .wrapper .input-box {
            width: 100%;
            height: 60px;
            position: relative;
            margin-top: 20px;
        }
        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 40px 20px 20px;
        }
        .input-box input::placeholder {
            color: #fff;
        }
        .wrapper .remember-forgot {
            display: flex;
            justify-content: space-between;
            font-size: 14.5px;
            margin: 15px 5px 15px;
        }
        .remember-forgot label input {
            accent-color: #fff;
            margin-right: 3px;
        }
        .remember-forgot a {
            color: #fff;
            text-decoration: none;
        }
        .remember-forgot a:hover {
            text-decoration: underline;
            color: red;
        }
        .wrapper .btn {
            width: 100%;
            height: 45px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            color: #333;
            font-weight: 700;
        }
        .wrapper .register-link {
            font-size: 14.5px;
            text-align: center;
            margin: 20px 0 15px;
        }
        .register-link p a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }
        .register-link p a:hover {
            text-decoration: underline;
            color: blue;
        }
    </style>
</head>
<body>
    <main id="main">
        <div class="wrapper">
            <form id="login-form">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-box">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox">Remember me
                    </label>
                    <!-- <a href="#">Forgot password?</a> -->
                </div>
                <button class="btn" type="submit">Login</button>
            </form>
        </div>
    </main>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script>
        $('#login-form').submit(function(e){
            e.preventDefault();
            $('#login-form button').attr('disabled',true).html('Logging in...');
            if($(this).find('.alert-danger').length > 0 )
                $(this).find('.alert-danger').remove();
            $.ajax({
                url:'ajax.php?action=login',
                method:'POST',
                data:$(this).serialize(),
                error:err=>{
                    console.log(err);
                    $('#login-form button').removeAttr('disabled').html('Login');
                },
                success:function(resp){
                    if(resp == 1){
                        location.href ='index.php?page=home';
                    }else{
                        $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>');
                        $('#login-form button').removeAttr('disabled').html('Login');
                    }
                }
            });
        });
    </script>
</body>
</html>
