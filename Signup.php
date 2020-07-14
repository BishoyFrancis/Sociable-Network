<!
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="MainScreen.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <title>Social Network</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="https://www.google.com" target="_blank">
        <img src="images/website-ico-29482-free-icons-and-png-backgrounds-website-icon-png-1200_1200.png" width="40"
             height="40" class="d-inline-block align-top" alt="website logo">
        <strong style="font-size: 24px ;">Sociable Network</strong>
    </a>


</body>
</html>

<?php
$con = mysqli_connect("localhost", "root", "", "social_network") or die("Connect failed: %s\n" . $con->error);

if ($con) {
    echo "Connected\n";
} else
    echo "failed";


if (isset($_POST['sign_up'])) {

    $first_name = htmlentities(mysqli_real_escape_string($con, $_POST['firstname']));
    $last_name = htmlentities(mysqli_real_escape_string($con, $_POST['lastname']));
    $email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
    $birthdate = htmlentities(mysqli_real_escape_string($con, $_POST['birthdate']));
    $password = htmlentities(mysqli_real_escape_string($con, $_POST['password']));
    $confirm_password = htmlentities(mysqli_real_escape_string($con, $_POST['confirmpassword']));
    $phonenumber = htmlentities(mysqli_real_escape_string($con, $_POST['phonenumber']));
    $gender = htmlentities(mysqli_real_escape_string($con, $_POST['gender']));
    $martialstatus = htmlentities(mysqli_real_escape_string($con, $_POST['martialstatus']));
    $hometown = htmlentities(mysqli_real_escape_string($con, $_POST['hometown']));

    $find_user = "select * from user where email='$email'";
    $query = mysqli_query($con, $find_user);
    $check_user = mysqli_num_rows($query);
    if ($check_user != 0) {
        echo "<script>alert('Email already exist, Please try using another email')</script>";
        echo "<script>window.open('MainScreen.html', '_self')</script>";
        exit();
    } else {
        if ($gender == "Male") {
            $profile_picture = "default_male.jpg";
        }
        if ($gender == "Female") {
            $profile_picture = "default_female.jpg";
        }
        $insert = "insert into user (firstname,lastname,email,password,phonenumber,gender,birthdate,profilepicture,hometown,martialstatus) values ('$first_name','$last_name','$email','" . md5($password) . "','$phonenumber','$gender','$birthdate','$profile_picture','$hometown','$martialstatus')";
        $insert_query = mysqli_query($con, $insert);
        if ($insert_query) {
            echo "<script> alert ('You Have Successfully Signed up' )</script>";
            echo "<script>window.open('Login.php', '_self')</script>";
        }
    }
}