<?php

     $output .= '<a href="../gc.php">
     <div class="content">
     <img src="php/images/1700979401key.png" alt="">
     <div class="details">
         <span>Our Group</span>
        
     </div>
     </div>
     <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
 </a>';
    while($row = mysqli_fetch_assoc($query)){
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

        $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'">
                    <div class="content">
                    <img src="php/images/'. $row['img'] .'" alt="">
                    <div class="details">
                        <span>'. $row['fname']. " " . $row['lname'] .'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                </a>';
        $tname = $row['fname']. "_" . $row['lname'];
       // echo $tname;
        //echo $_COOKIE[$tname];
        //if(isset()){echo "asdfsd";};
        //echo "<script type=\"text/javascript\">alert('Your message Here');</script>"; 
        if($_COOKIE[$tname]=="notify"){
            //setcookie($tname, "no", time()+86400, "/");
            //echo "asfarfwererqerqwer";
            echo '<div class = "content details">
            <p><span style = "color:blue;"> You have notifications from '.$tname.'</span> </p><br>
            </div>';

        }
    }
?>