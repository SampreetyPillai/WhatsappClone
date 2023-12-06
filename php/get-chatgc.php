<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $output = "";
        $sql = "SELECT * FROM gc LEFT JOIN users ON users.unique_id = gc.outgoing_msg_id ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    if ($row['isimg']==0){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                <h6 style="color:gray;">'. $row['fname'] .'</h6>
                                    <p>'. $row['msg'] .'</p><h6 style="color:gray;">'. $row['timestamp'] .'</h6>
                                </div>
                                </div>';
                    }
                    else{
                        $output .= '<div class="chat outgoing">
                                <div class="details">
                                <h6 style="color:gray;">'. $row['fname'] .'</h6>
                                <p><img src="php/images/'.$row['msg'].'" alt="" width ="225" height="225" ></p><h6 style="color:gray;">'. $row['timestamp'] .'</h6>
                                </div>
                                </div>';
                    }
                }else{
                    if ($row['isimg']==0){
                    $output .= '<div class="chat incoming">
                                
                                <div class="details">
                                <h6 style="color:gray;">'. $row['fname'] .'</h6>
                                    <p>'. $row['msg'] .'</p><h6 style="color:gray;">'. $row['timestamp'] .'</h6>
                                </div>
                                </div>';
                    }
                    else{
                        $output .= '<div class="chat incoming">
                                
                                <div class="details">
                                <h6 style="color:gray;">'. $row['fname'] .'</h6>
                                <p><img src="php/images/'.$row['msg'].'" alt="" height="225" width="225" ></p><h6 style="color:gray;">'. $row['timestamp'] .'</h6>
                                </div>
                                </div>';
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