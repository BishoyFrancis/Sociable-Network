<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="MainScreen.css">
    <title>Login</title>
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark" style="background-color: #7559A4 ; ">
    <a class="navbar-brand" href="Login.php" target="_blank">
        <img src="images/website-ico-29482-free-icons-and-png-backgrounds-website-icon-png-1200_1200.png" width="40"
             height="40" class="d-inline-block align-top" alt="website logo" style="position: relative ;left: 530px">
        <strong style="font-size: 24px ; position: relative ; left: 530px">Sociable Network</strong>
    </a>
</nav>
<form action="Login.php" method="post">
    <div>
        <div class="container-fluid"
             style="padding: 0px ; position: relative ; left: 850px ; top: 120px ; border: 2px #7559A4 solid ; width: 450px ; border-radius: 20px ;">
            <div class="row">
                <div class="col-lg-12"
                     style="text-align: center ; background-color: #7559A4 ; border-radius: 15px ; padding: 10px">
                    <label style="font-size: 20px ; color: white ; font-size: 23px ; font-weight: bold">Login</label>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" style="margin-top: 10px">
                    <input class="col-lg-12" type="text" placeholder="Enter Email" name="email"
                           style="border: 2px solid #7559A4; border-radius: 20px ; padding: 8px ; margin-top: 20px ; margin-bottom: 25px">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" style="margin-bottom: 40px ; margin-top: 10px">
                    <input class="col-lg-12" type="password" placeholder="Enter Password" name="password"
                           style="border: 2px solid #7559A4; border-radius: 20px ; padding: 8px">
                </div>
            </div>
            <div class="row">
                <div style="width: 496px">
                    <button class="btn btn-lg btn-block"
                            style="border:1px solid #7559A4 ; border-radius: 15px ;" type="submit"
                            name="login">Login
                    </button>
                </div>
            </div>
        </div>
        <img src="images/getty-video-call-chat.jpg"
             style="position: relative ; width: 600px ; height: 394px ; left: 50px ; top: -240px">
    </div>
</form>
</body>
</html>

<?php
$con = mysqli_connect("localhost", "root", "", "social_network") or die("Connect failed: %s\n" . $con->error);
if (isset($_POST['login'])) {
    session_start();
    $_SESSION['email'] = $_POST['email'];
    $email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
    $password = htmlentities(mysqli_real_escape_string($con, $_POST['password']));
    $new_pass = md5($password);
    $find_user = "select * from user where email='$email' AND password='$new_pass'";
    $query = mysqli_query($con, $find_user);
    $check_user = mysqli_num_rows($query);
    if ($check_user == 1) {
        echo "<script>window.open('Home.php', '_self')</script>";
    }
    else {
        echo "<script>alert('Your Email or Password is incorrect')</script>";
    }
}
?>