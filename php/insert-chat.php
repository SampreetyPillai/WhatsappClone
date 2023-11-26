<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if ($_FILES['image']['error'] == 0) {
            $img_name = $_FILES['image']['name'];
            $img_type = $_FILES['image']['type'];
            $tmp_name = $_FILES['image']['tmp_name'];
            
            $img_explode = explode('.',$img_name);
            $img_ext = end($img_explode);
  // 1 for image
            $extensions = ["jpeg", "png", "jpg"];
            if(in_array($img_ext, $extensions) === true){
                $types = ["image/jpeg", "image/jpg", "image/png"];
                if(in_array($img_type, $types) === true){
                    $time = time();
                    $new_img_name = $time.$img_name;
                    if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                        $ran_id = rand(time(), 100000000);
                        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, isimg)
                        VALUES ({$incoming_id}, {$outgoing_id},'{$new_img_name}', 1)") or die();
                       
                    }}}
        }
        if(!empty($message)){
            $insert_query = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, isimg)
            VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', 0)");
           
        }
    }else{
        header("location: ../login.php");
    }


    
?>