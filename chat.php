
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat area</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./fontawesome-free-6.6.0-web/css/all.css">
</head>
<body>
    <div class="container">
        <section class="chat-area">
            <header>
                <a href="index.php" class="back-icon"><i class="fas fa-arrow-left-long"></i></a> <br><br>
                <img src="./imgs/user1.jpg" alt="">
                    <div class="details">
                        <span>basag</span>
                        <p> Active now</p>
                    </div>
            </header>

            <div class="chatbox">
                 <!-- <div class="text">
                    <img src="./imgs/user1.jpg" alt="">
                    <span>no messege are available</span>
                 </div> -->

                 <div class="chat outgoing">
                   <!-- <img src="./imgs/user1.jpg" alt=""> -->
                    <div class="details">
                        <p> hi</p>
                    </div>
                 </div>
                 <div class="chat incoming">
                   <img src="./imgs/user1.jpg" alt="">
                    <div class="details">
                        <p> hi</p>
                    </div>
                 </div>
                 <div class="chat incoming">
                   <img src="./imgs/user1.jpg" alt="">
                    <div class="details">
                        <p> <img src="./imgs/user1.jpg" alt=""></p>
                    </div>
                 </div>
                 <div class="chat outgoing">
                   <!--  -->
                    <div class="details">
                        <p><img src="./imgs/user1.jpg" alt=""></p>
                    </div>
                 </div>
            </div>
            <form action="" class="typing-area" method="post">
                <input type="text" name="incaming_id" class="incaming_id" hiden>
                <input type="text" name="message" class="input-field" placeholder="type message hare...">
                <button class="image"> <i class="fas fa-photo-film"></i></button>
                <input type="file" name="send_image" accept="image/*" class="upload_image" id="" hidden>
                <button class="send-btn active" name="send-btn"><i class="fas fa-paper-plane"></i> </button>
            </form>
        </section>
    </div>
    
</body>
</html>