<?php
// Show all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'php/connection.php'; // database connection
$image_rename = 'user1.jpg';

if (isset($_POST['signup'])) {
    $run_id = rand(time(), 1000000000);
    $names = mysqli_real_escape_string($conn, $_POST['names']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $c_password = mysqli_real_escape_string($conn, $_POST['c_password']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $image_name = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_rename = uniqid() . '_' . $image_name;
        $image_folder = 'imgs/' . $image_rename;
        $status = 'active now';

        $select = mysqli_query($conn, "SELECT * FROM `users` WHERE names='$names' AND password='$password' ");
        if (mysqli_num_rows($select) > 0) {
            $alert[] = "User already exists";
        } else {
            if ($password != $c_password) {
                $alert[] = "Passwords do not match!";
            } elseif ($image_size > 2000000) {
                $alert[] = "Image size is too large!";
            } else {
                $insert = mysqli_query($conn, "INSERT INTO `users`(`user_id`, `names`, `email`, `password`, `image`, `status`) 
                VALUES ('$run_id','$names','$email','$password','$image_rename','$status')");

                if ($insert) {
                    move_uploaded_file($image_tmp_name, $image_folder);  //move image file
                    header('Location: login.php');
                    exit();
                } else {
                    $alert[] = "MySQL Error: " . mysqli_error($conn);
                }
            }
        }
    } else {
        $alert[] = "$email is not a valid email";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:wght@100;300;400;500;600& display=swap');
        :root{
        --light-blk-bg:rgb(73, 73, 73);
        --dark-blue:rgb(14, 118, 204);
        --red:rgb(253, 35, 35);
        --red-dark:rgb(148, 11, 11);
        --light-bg:rgba(128, 128, 128, 0.562);
        --white:#fff;
        --lime:rgb(22, 211, 22);
        --box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.774);
        }
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
            font-size: 20px;
            /* font-family: 'Times New Roman', Times, serif; */
            font-family: 'Poppins' sans-serif;
        }
        *::-webkit-scrollbar{
            width: 10px;
        }
        *::-webkit-scrollbar-track{
            background-color: var(--dark-blue);
        }
        .form-container{
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;

        }
        .form-container form{
            width: 500px;
            padding: 20px;
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            border-radius: 5px;
        }
        .form-container form h1{
            margin-bottom: 10px;
            font-size: 30px;
            color: var(--dark-blue);
            text-transform: capitalize;
        }
        .alert{
            margin: 10px 0;
            width: 100%;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            background-color: var(--red);
            font-size: 20px;
            color: var(--white);
        }
        .form-container form .box{
            width: 100%;
            border-radius: 5px;
            padding: 12px 14px;
            color: var(--white);
            font-size: 18px;
            margin: 10px 0;
            background-color: var(--light-bg);
        }
        .form-container form .submit-btn input{
            border-radius: 5px;
            padding: 12px 14px;
            color: var(--white);
            font-size: 18px;
            margin: 10px 0;
            background-color: var(--lime);
        }
        .form-container form .submit-btn input:hover{
            background-color: rgb(70, 214, 70);
        }
        .form-container form p{
            margin-top: 15px;
            font-size: 20px;
            
        }
        .form-container form p a{
            color: var(--dark-blue);

        }
        .form-container form p a:hover{
            text-decoration: underline;
        } 
        @media (max-width:650px) {
    .form-container form{
        box-shadow:none;
        border:none;
        
    }
    }
    </style>
</head>
<body>

<div class="form-container">
    <form action="" method="POST" enctype="multipart/form-data">
          <h1>sign up</h1>

          <?php
             if(isset($alert)){
                foreach($alert as $alert){
                    echo '<div class="alert">'.$alert.'</div> ';
                }
             }
          ?>

        <!--  -->
        <div class="inputset">
            <!-- <label for="">full name:</label> -->
            <input type="text" name="names" class="box" placeholder="Enter your names" required>
        </div>
        
        <div class="inputset">
            <!-- <label for="">email:</label> -->
            <input type="email" name="email" class="box" placeholder="Enter your email" required>
        </div>
        <div class="inputset">
            <!-- <label for="">password:</label> -->
            <input type="password" name="password" class="box" placeholder="Create password" required>
        </div>
        <div class="inputset">
            <!-- <label for="">confirm password:</label> -->
            <input type="password" name="c_password" class="box" placeholder="Confirm password" required>
        </div>
        <div class="inputset">
            <input type="file" name="image"  class="box" accept="image/*" required>
        </div>

        <div class="submit-btn">
            <input type="submit" name="signup" value="sign up">
            <p>already have account click <a href="login.php">  login</a></p>
        </div>
    </form>
</div>

    
</body>
</html>