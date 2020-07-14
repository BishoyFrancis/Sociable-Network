<?php
$con = mysqli_connect("localhost", "root", "", "social_network") or die("Connect failed: %s\n" . $con->error);
$email = $_SESSION['email'];
$get_user = "select * from user where email='$email'";
$run_user = mysqli_query($con,$get_user);
$row=mysqli_fetch_array($run_user);

//FULL DETAILS OF USER LOGGED IN

$user_id = $row['user_id'];
$first_name = $row['firstname'];
$last_name = $row['lastname'];
$user_email = $row['email'];
$user_pass = $row['password']; //hashed pass
$user_phone_number = $row['phonenumber'];
$user_gender = $row['gender'];
$user_birth_date = $row['birthdate'];
$user_profile_picture = $row['profilepicture'];
$user_hometown = $row['hometown'];
$user_relationship_status = $row['martialstatus'];
$user_about_me = $row['about_me'];


?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="Home.css">
    <title>Home</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #7559A4 ; height: 65px;">
    <a class="navbar-brand" href="Home.php" target="_blank">
        <img src="images/website-ico-29482-free-icons-and-png-backgrounds-website-icon-png-1200_1200.png" width="40"
             height="40" class="d-inline-block align-top" alt="website logo">
        <strong style="font-size: 24px">Sociable Network</strong>
    </a>
    <form action="index.php" method="post">
        <div class="container h-100">
            <div class="d-flex justify-content-center h-100">
                <div class="searchbar">
                    <input class="search_input" type="text" name="search" placeholder="Search" style="color: black ;">
                    <input type="submit" class="search_icon" value="Search"
                           style="width: 100px ; border: none; background-color: white"><i class="fas fa-search"></i>
                </div>
    </form>
    <div>
        <div>
            <a href="Profile.php"><img src="<?php echo" profilepictures/$user_profile_picture" ?>" alt="profile picture"
                                       style="border-radius: 50% ; width: 55px ; height: 55px; position: absolute; left: 1110px ; top: 5px"></a>
        </div>
        <div>
            <a href="Profile.php" style="position: absolute; left: 1190px; top: 15px ; color: white ; text-decoration: none; font-size: 20px"<h5>
                <?php
                echo $first_name . " " . $last_name;
                ?>
            </h5></a>
        </div>
</nav>
</body>
</html>


