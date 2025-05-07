
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'php/connection.php';
session_start();
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    header('Location: login.php');
    exit();
}

$select = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id='$user_id'");
$row = mysqli_fetch_assoc($select);

$alert = [];

if (isset($_POST['update_profile'])) {
    $update_name = mysqli_real_escape_string($conn, $_POST['updatename']);
    $update_email = mysqli_real_escape_string($conn, $_POST['updatemail']);

    mysqli_query($conn, "UPDATE `users` SET names='$update_name', email='$update_email' WHERE user_id='$user_id'");

    // Image upload
    if (!empty($_FILES['update_image']['name'])) {
        $image_name = $_FILES['update_image']['name'];
        $image_size = $_FILES['update_image']['size'];
        $image_tmp = $_FILES['update_image']['tmp_name'];
        $image_new_name = uniqid() . '_' . $image_name;
        $image_path = 'imgs/' . $image_new_name;

        if ($image_size > 2000000) {
            $alert[] = "Image size too large!";
        } else {
            move_uploaded_file($image_tmp, $image_path);
            mysqli_query($conn, "UPDATE `users` SET image='$image_new_name' WHERE user_id='$user_id'");
        }
    }

    // Password update
    $old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['newpassword']);
    $c_password = mysqli_real_escape_string($conn, $_POST['confirmpassword']);

    if (!empty($old_password) || !empty($new_password) || !empty($c_password)) {
        if ($old_password !== $row['password']) {
            $alert[] = "Old password not matched!";
        } elseif ($new_password !== $c_password) {
            $alert[] = "Confirm password not matched!";
        } else {
            mysqli_query($conn, "UPDATE `users` SET password='$c_password' WHERE user_id='$user_id'");
            $alert[] = "Password updated successfully!";
        }
    }

    if (empty($alert)) {
        header('Location: update_profile.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update profile</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./fontawesome-free-6.6.0-web/css/all.css">
</head>
<body>

    <div class="update-profile">
        
        <form action="" method="POST" enctype="multipart/form-data" >
          <img src="./imgs/<?php echo $row['image'];?>" alt="">
          <?php
             if(isset($alert)){
                foreach($alert as $alert){
                    echo '<div class="alert">'.$alert.'</div> ';
                }
             }
          ?>
             <!-- <div class="alert">can't update profile</div> -->
                <div class="flex">
                    <div class="inputbox">
                        <div class="inputset">
                            <span>User name:</span>
                            <input type="text" name="updatename" value="<?php echo $row['names'];?>" class="box" id="" require>
                        </div>
                        <div class="inputset">
                            <span>Email:</span>
                            <input type="email" name="updatemail" value="<?php echo $row['email'];?>" class="box"  id="" require>
                        </div>
                        <div class="inputset">
                            <span>Update image</span>
                            <input type="file" name="update_image"  class="box"  accept="image/jpg,image/jpeg,image/png" require>
                        </div>

                        
                    </div>
                    <div class="inputbox">
                        <div class="inputset">
                            <span>Old pssword:</span>
                            <input type="password" name="old_password" value="shegi coder" class="box" id="" require>
                        </div>
                        <div class="inputset">
                            <span>New password:</span>
                            <input type="password" name="newpassword" value="shegi@gmail.com" class="box"  id="" require>
                        </div>
                        <div class="inputset">
                            <span>Confirm password </span>
                            <input type="password" name="confirmpassword"  class="box" placeholder="confirm password" require>
                        </div>
                    </div>
                    

                </div>
                <div class="flex btn">
                        <input type="submit" name="update_profile" value="update profile"  id="submit-btn">
                        <a href="index.php">go back</a>
                    </div>
         </form>
    </div>
    
</body>
</html>