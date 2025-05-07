<?php

include 'connection.php';

while($row2 = mysqli_fetch_assoc($run)){

    $user_id = $row2['user_id'];

    $sql2 = "SELECT * FROM `messages` WHERE 
            (incoming_msg_id = {$user_id} OR outgoing_msg_id = {$user_id}) 
            AND (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id}) 
            ORDER BY msg_id DESC LIMIT 1";

    $run2 = mysqli_query($conn, $sql2);

    if(mysqli_num_rows($run2) > 0){
        $row3 = mysqli_fetch_assoc($run2);

        if($row3['msg'] == '' && !empty($row3['msg_image'])){
            $result = 'Image';
        } else {
            $result = $row3['msg'];
        }

        $you = ($outgoing_id == $row3['outgoing_msg_id']) ? "You: " : "";
    } else {
        $result = "No message available";
        $you = "";
    }

    $msg = (strlen($result) > 28) ? substr($result, 0, 28) . "..." : $result;

    $offline = ($row2['status'] == "offline now") ? "offline" : "";
    $hide_me = ($outgoing_id == $row2['user_id']) ? "hide" : "";

    $output .= '<a href="#">
        <div class="content">
            <img src="./imgs/' . $row2['image'] . '" alt="">
            <div class="details">
                <span>' . $row2['names'] . '</span>
                <p>' . $you . $msg . '</p>
            </div>
        </div>
        <div class="status-dot ' . $offline . '">
        </div>
    </a>';
}
?>