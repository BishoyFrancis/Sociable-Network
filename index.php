<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Search</title>
</head>
<body>
<!--<nav class="navbar navbar-expand-lg fixed-top navbar-dark" style="background-color: #7559A4 ; ">
    <a class="navbar-brand" href="Login.php" target="_blank">
        <img src="images/website-ico-29482-free-icons-and-png-backgrounds-website-icon-png-1200_1200.png" width="40"
             height="40" class="d-inline-block align-top" alt="website logo" style="position: relative ;left: 530px">
        <strong style="font-size: 24px ; position: relative ; left: 530px">Sociable Network</strong>
    </a>
</nav>-->
</body>
</html>



<?php
include("getuserdata.php");
$con = mysqli_connect("localhost", "root", "", "social_network") or die("Connect failed: %s\n" . $con->error);
if(isset($_POST['search'])) {
    $output="";
    $searchq = htmlentities(mysqli_real_escape_string($con, $_POST['search']));
    $query = mysqli_query($con,"Select * from user Where firstname LIKE '%$searchq%' OR lastname LIKE '%$searchq%' OR email LIKE '%$searchq%' OR phonenumber LIKE '%$searchq%' OR hometown LIKE '%$searchq%'") or die("Search Could not be completed");
     $count = mysqli_num_rows($query);
     if ($count == 0){
         echo 'There was no search results!';
     }
     else{
         while($row = mysqli_fetch_array($query)){
             $fname = $row['firstname'];
             $lname = $row['lastname'];
             $u_id = $row['user_id'];
             echo '<div><a href="profile_search.php?id='.$u_id.'"> '.$fname." ".$lname.' </a></div>';
         }
     }
}
