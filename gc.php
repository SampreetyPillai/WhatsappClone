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
      <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        Group Chat


      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
      
        <!-- <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden> -->
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
        <a type = "button" target = "_blank" href = <?php echo 'http://localhost:3030/video';?> class = "fas fa-video"></a>

        <label for="file-upload" name class="custom-file-upload"><i class="fas fa-paperclip"></i></label>
       <input type="file" id="file-upload" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">


      </form>
      
      
    </section>
    
  </div>

  <script src="javascript/gc.js"></script>

</body>
</html>
