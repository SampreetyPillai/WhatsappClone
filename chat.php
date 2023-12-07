<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
       
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details" style="align:left">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
          <h6 style="color:grey"><?php echo 'Last seen: '.$row['last_seen']; ?></h6>
          <?php 
          $tname = $row['fname']. "_" . $row['lname'];
          setcookie($tname, "no", time()+86400, "/");
          ?>
                  
        <form action="php/export.php" method="post">

        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <!-- Add any data you want to send via POST in hidden input fields -->
        <!-- <input type="hidden" name="param1" value="value1">
        <input type="hidden" name="param2" value="value2"> -->

        <!-- The button with the download icon -->
        <button type="submit" style="padding-left: 250px; color: black; background: none; border: none;">
            <i class="fas fa-download" ></i>
        </button>
        
        
    </form>
    <button id="disappearing" style="padding-left: 250px; color: black; background: none; border: none;">
            <i class="fas fa-minus-circle" ></i>
    </button>



      </header>

      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
      
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
        <a type = "button" target = "_blank" href = <?php echo 'http://localhost:3030/video';?> class = "fas fa-video"></a>


        <label for="file-upload" name class="custom-file-upload"><i class="fas fa-paperclip"></i></label>
       <input type="file" id="file-upload" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">


      </form>
      
      
    </section>
    
    
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>
