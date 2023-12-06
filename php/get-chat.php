<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $date1 = new DateTime($row['timestamp']);
                $date = new DateTime("now");
                $interval = $date->diff($date);
                //echo $interval->days;
                $display = true;
                if($_COOKIE["disappearing_messages"]=="on" and ($interval->days>=1)) {
                    $display = false;
                }

                if($display){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    if ($row['isimg']==0){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p><h6 style="color:gray;">'. $row['timestamp'] .'</h6>
                                </div>
                                </div>';
                    }
                    else{
                        $output .= '<div class="chat outgoing">
                                <div class="details">
                                <p><img src="php/images/'.$row['msg'].'" alt="" width ="225" height="225" ></p><h6 style="color:gray;">'. $row['timestamp'] .'</h6>
                                </div>
                                </div>';
                    }
                }else{
                    if ($row['isimg']==0){
                    $output .= '<div class="chat incoming">
                                <img src="php/images/'.$row['img'].'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p><h6 style="color:gray;">'. $row['timestamp'] .'</h6>
                                </div>
                                </div>';
                    }
                    else{
                        $output .= '<div class="chat incoming">
                                <img src="php/images/'.$row['img'].'" alt="">
                                <div class="details">
                                <p><img src="php/images/'.$row['msg'].'" alt="" height="225" width="225" ></p><h6 style="color:gray;">'. $row['timestamp'] .'</h6>
                                </div>
                                </div>';
                    }
                }
            }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>