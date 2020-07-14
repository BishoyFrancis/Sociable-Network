<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "social_network") or die("Connect failed: %s\n" . $con->error);
$id = $_GET['id'];
$logged_in_email = $_SESSION['email'];
$get_logged_user = "select * from user where email='$logged_in_email'";
$logged_user = mysqli_query($con,$get_logged_user);
$row2=mysqli_fetch_array($logged_user);

$get_user = "select * from user where user_id='$id'";
$run_user = mysqli_query($con, $get_user);
$row = mysqli_fetch_array($run_user);

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


$logged_user_id = $row2['user_id'];
$logged_user_first_name = $row2['firstname'];
$logged_user_last_name = $row2['lastname'];
$logged_user_email = $row2['email'];
$logged_user_pass = $row2['password']; //hashed pass
$logged_user_phone_number = $row2['phonenumber'];
$logged_user_gender = $row2['gender'];
$logged_user_birth_date = $row2['birthdate'];
$logged_user_profile_picture = $row2['profilepicture'];
$logged_user_hometown = $row2['hometown'];
$logged_user_relationship_status = $row2['martialstatus'];
$logged_user_about_me = $row2['about_me'];

/*echo '<div>'.$user_id.'</div>';
echo '<div>'.$first_name.'</div>';
echo '<div>'.$last_name.'</div>';
echo '<div>'.$user_email.'</div>';
echo '<div>'.$user_phone_number.'</div>';
echo '<div>'.$user_gender.'</div>';
echo '<div>'.$user_birth_date.'</div>';
echo '<div>'.$user_profile_picture.'</div>';
echo '<div>'.$user_hometown.'</div>';
echo '<div>'.$user_relationship_status.'</div>';
echo '<div>'.$user_about_me.'</div>';*/

if (isset($_POST['submit'])) {
    $u_image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    if ($u_image == '') {
        echo "<script>alert('Please Select Profile Image on clicking on your profile image')</script>";
        echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
        exit();
    } else {
        move_uploaded_file($image_tmp, "profilepictures/$u_image");
        move_uploaded_file($image_tmp, "postimages/$u_image");
        $update = "update user set profilepicture='$u_image' where user_id='$user_id'";
        $run = mysqli_query($con, $update);
        if ($run) {
            echo "<script>alert('Your Profile Updated')</script>";
            echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
            //add post to database
            $profilepicture = mysqli_query($con, "Insert into posts(user_id,caption,image,time,state) values ('$user_id','Profile Picture Has Been Updated', '$u_image' , CURRENT_TIMESTAMP ,'Private')") or die(mysqli_error());
        }
    }
}
if (isset($_POST['post'])) {
    $content = $_POST['content'];
    $upload_image = $_FILES['upload_image']['name'];
    $image_tmp = $_FILES['upload_image']['tmp_name'];

    if (strlen($content) > 250) {
        echo "<script>alert('Please Use 250 or less than 250 words!')</script>";
        echo "<script>window.open('Profile.php', '_self')</script>";
    } else {

        move_uploaded_file($image_tmp, "postimages/$upload_image");
        $post = mysqli_query($con, "Insert into posts(user_id,caption,image,time,state) values ('$user_id','$content','$upload_image',CURRENT_TIMESTAMP ,'Private')");
        if ($post) {
            echo "<script>alert('Posted Successfully!')</script>";
        }
    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
          id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
          crossorigin="anonymous">
    <link rel="stylesheet" href="Home.css">
    <title>Profile</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #7559A4 ; height: 65px;">
    <a class="navbar-brand" href="Login.php" target="_blank">
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
            <a href="Profile.php"><img src="<?php echo" profilepictures/$logged_user_profile_picture" ?>" alt="profile picture"
                                       style="border-radius: 50% ; width: 55px ; height: 55px; position: absolute; left: 1110px ; top: 5px"></a>
        </div>
        <div>
            <a href="Profile.php" style="position: absolute; left: 1190px; top: 15px ; color: white ; text-decoration: none; font-size: 20px"<h5>
                <?php
                echo $logged_user_first_name . " " . $logged_user_last_name;
                ?>
            </h5></a>
        </div>
</nav>
<div class="col-lg-3"
     style="background-color: #FFC056 ; text-align: center;width:300px ; height: auto ; margin-bottom: 50px; position: relative ; top: 20px; left: 15px ; border-radius: 20px">
    <div>
        <img src="<?php echo "profilepictures/$user_profile_picture" ?>" alt=""
             style="border-radius: 50% ; width: 250px; height: 250px; position: relative ; top: 10px">
        <div style="margin-bottom: 20px">
            <strong STYLE="color: #FF6A70 ; font-size: 30px ; position: relative ; top: 7px ">
                <?php
                echo $first_name . " " . $last_name;
                ?>
            </strong>
        </div>
        <div style="margin-bottom: 10px">Update Profile Picture</div>
        <div class="row" style="; margin-left: 30px ;">
            <form action="Profile.php" method="post" enctype="multipart/form-data">
                <input type="file" name="image" value="Update" style="margin-bottom: 20px ; position: relative ; left: -36px ">
                <button type="submit" class="btn btn-success" name="submit" value="Upload Photo"
                        style="position: relative ; top: -70px ; left: 10px; height: 50px ; padding: 3px ; width: 182px">
                    Upload photo
                </button>
            </form>
        </div>
        <div class="row">
        <button type="submit" class="btn btn-danger" style="position: relative ; left: 7px ; top: -75px ;width: 95%;">Remove Profile Picture</button>
        </div>
        <div style="margin-bottom: 20px ; margin-top: -50px">Gender:
            <?php
            echo $user_gender;
            ?>
        </div>
        <div style="margin-bottom: 20px">Phone number:
            <?php
            echo $user_phone_number;
            ?>
        </div>
        <div style="margin-bottom: 20px">Hometown:
            <?php
            echo $user_hometown;
            ?>
        </div>
        <div style="margin-bottom: 20px"> Relationship status:
            <?php
            echo $user_relationship_status;
            ?>
        </div>
        <div style="margin-bottom: 20px ; padding-bottom: 20px">Date of Birth:
            <?php
            echo $user_birth_date;
            ?>
        </div>
    </div>
</div>
<div class="col-lg-8" style="position: relative ; left: 360px ; top: -717px">

    <div class="row" style="">
        <form action="Profile.php" method="post" enctype="multipart/form-data">
            <textarea id="content" rows="4" name="content" placeholder=" What's in your mind?"
                      style="width: 900px ; border-radius: 10px"></textarea><br>
            <span style="position: relative ; left: 550px">Upload Photo</span>
            <input type="file" name="upload_image" value="Update"
                   style="position: relative ; left: 567px ; top: 3px ">
            <button type="submit" class="btn btn-success" name="post"
                    style="position: relative ; top: 0px ; left: 370px; height: 50px ; padding: 3px ; width: 130px">
                Post
            </button>
        </form>
    </div>
</div>
<
<div class="col-lg-8"
     style="background-color:#FFC056 ; height: auto ; position: relative ; left: 360px ; top: -715px ; border-radius: 20px">
    <?php
    $query = mysqli_query($con, "Select * from posts where user_id = $user_id ORDER BY time DESC");

    $count = mysqli_num_rows($query);
    if ($count == 0) {
        echo "<html>
        <h3 style='position: relative ; left: 280px ; padding: 8px'>There are no Posts Yet</h3>
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
							<img id='posts-img' src='postimages/$image' style='height:350px; margin-top: 50px; position: relative;left: 70px'>
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
							<p style='position: relative ; top: 50px ; margin-left: 25px ; word-wrap: break-word ; width: 850px'>$content</p>
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
			        <div class='row'>
						<img src='profilepictures/$user_profile_picture' style='border-radius: 50% ; width: 50px ; height: 50px ; margin-left: 25px ; margin-top: 5px' >
							<h3><a style='text-decoration:none; cursor:pointer;color darkgreen; position: relative; top: 12px ; left: 3px ;  ' href='user_profile.php?u_id=$user_id'>$first_name $last_name </a></h3><h6 style='position: relative ; top: 25px ; margin-left:7px '>$state</h6>
							<h4><small style='color:black; position: relative ; top: 60px ; left: -200px'>Updated a post on <strong>$time</strong></small></h4>
					</div>
					<div class='row' style='margin: 50px'>
						$content
					</div>
			";
        }
    }
    ?>
</div>
