<?php
// Show all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'php/connection.php'; // database connection
 session_start();

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $select = mysqli_query($conn, "SELECT * FROM `users` WHERE  email='$email' AND password='$password' ");
        if (mysqli_num_rows($select) > 0) {
            $row=mysqli_fetch_assoc($select);
            $status = 'active now';

            $update=  mysqli_query($conn, "UPDATE  `users` SET status='$status' WHERE user_id='{$row['user_id']}' ");
                
              if($update){
                   $_SESSION['user_id'] = $row['user_id'];

                   header('Location: index.php');
              }

        }else{
            $alert[] = "incorrect password or user name";
        }

      }else{
          $alert[] = " $email is not a valid email";
     }
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
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
          <h1>login</h1>

        <!-- <div class="alert">error please try again</div> -->
        <?php
             if(isset($alert)){
                foreach($alert as $alert){
                    echo '<div class="alert">'.$alert.'</div> ';
                }
             }
          ?>
        
        <div class="inputset">
            <!-- <label for="">user name:</label> -->
            <input type="email" name="email" class="box" placeholder="Enter your email" require>
        </div>
        <div class="inputset">
            <!-- <label for="">password:</label> -->
            <input type="password" name="password" class="box" placeholder="enter your password" require>
        </div>

        <div class="submit-btn">
            <input type="submit" name="login" value="login">
            <p>if you dont have account click <a href="signup.php">  login</a></p>
        </div>
    </form>
</div>

    
</body>
</html>