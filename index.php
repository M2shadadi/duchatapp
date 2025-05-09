<?php
// Show all errors
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
if (mysqli_num_rows($select) > 0) {
    $row = mysqli_fetch_assoc($select);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>duchat | home</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./fontawesome-free-6.6.0-web/css/all.css">
</head>
<body>
    <div class="container">
        <section class="users">
            <header class="profile">
                <div class="content">
                    <a href="update_profile.php"><img src="./imgs/<?php echo htmlspecialchars($row['image']); ?>" alt=""></a>
                    <div class="details">
                        <span><?php echo htmlspecialchars($row['names']); ?></span>
                        <p><?php echo htmlspecialchars($row['status']); ?></p>
                    </div>
                </div>
                <a href="logout.php" class="logout"><i class="fas fa-arrow-right-from-bracket"></i>Logout</a>
            </header>

            <form action="#" method="POST" class="search">
                <input type="text" name="search-box" placeholder="Enter user name or email to search">
                <button name="search-user"><i class="fas fa-search"></i></button>
            </form>

            <div class="all_user">
                <!-- User list will be inserted here by JS -->
            </div>
        </section>
    </div>
    <script src="./js/main.js"></script>
</body>
</html>