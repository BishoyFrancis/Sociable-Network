<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "social_network") or die("Connection failed %s\n" . $con->error);
include("getuserdata.php");

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
<div class="col-lg-11"
     style="background-color:#FFC056 ; height: auto ; position: relative ; left: 50px ; top: 50px ; border-radius: 20px">
     <?php
    $query = mysqli_query($con, "Select * from posts ORDER BY time DESC");
     $count = mysqli_num_rows($query);
     if ($count == 0) {
         echo "<html>
        <h3 style='position: relative ; left: 280px'>There are no Posts Yet</h3>
         </html>";
     }
     while ($row = mysqli_fetch_array($query)) {
         $content = $row['caption'];
         $image = $row['image'];
         $time = $row['time'];
         $state = $row['state'];
         if($content == "" && strlen($image)>1){
             echo "
			<div class='row'>
						<img src='profilepictures/$user_profile_picture' style='border-radius: 50% ; width: 50px ; height: 50px ; margin-left: 5px ; margin-top: 5px' >
							<h3><a style='text-decoration:none; cursor:pointer;color darkgreen; position: relative; top: 12px ; left: 3px ;  ' href='user_profile.php?u_id=$user_id'>$first_name $last_name</a></h3>
							<h4><small style='color:black; position: relative ; top: 60px ; left: -200px'>Updated a post on <strong>$time</strong></small></h4>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<img id='posts-img' src='postimages/$image' style='height:350px; margin-top: 50px; position: relative;left: 200px ; margin-bottom: 50px'>
						</div>
					</div>
			";
         }
         elseif (strlen($content) >1 && strlen($image)>1){
             echo "
			        <div class='row'>
						<img src='profilepictures/$user_profile_picture' style='border-radius: 50% ; width: 50px ; height: 50px ; margin-left: 25px ; margin-top: 5px' >
							<h3><a style='text-decoration:none; cursor:pointer;color darkgreen; position: relative; top: 12px ; left: 3px ;  ' href='user_profile.php?u_id=$user_id'>$first_name $last_name </a></h3><h6 style='position: relative ; top: 25px ; margin-left:7px '>$state</h6>
							<h4><small style='color:black; position: relative ; top: 60px ; left: -200px'>Updated a post on <strong>$time</strong></small></h4>
					</div>
					<div class='row'>
							<p style='position: relative ; top: 50px ; margin-left: 25px ;width: 850px'>$content</p>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<img id='posts-img' src='postimages/$image' style='height:350px; margin-top: 50px; position: relative;left: 100px ; margin-bottom: 30px'>
						</div>
					</div>
			";
         }
         elseif (strlen($content)>1 && strlen($image)==0){
             echo "
			        <div class='row' style='margin-bottom: 25px'>
						<img src='profilepictures/$user_profile_picture' style='border-radius: 50% ; width: 50px ; height: 50px ; margin-left: 25px ; margin-top: 5px' >
							<h3><a style='text-decoration:none; cursor:pointer;color darkgreen; position: relative; top: 7px ; left: 3px ;  ' href='user_profile.php?u_id=$user_id'>$first_name $last_name </a></h3><h6 style='position: relative ; top: 20px ; margin-left:7px '>$state</h6>
							<h4><small style='color:black; position: relative ; top: 42px ; left: -232px ; font-size: 14px'>Updated a post on <strong>$time</strong></small></h4>
					</div>
					<div class='row'>
						<p style='width: 1100px ; word-wrap: break-word; margin-left:25px'>$content</p>
					</div>
			";
         }
     }
    ?>
</div>
</body>
</html>









