<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body style="gap:20px;">
  <div class = "wrapper users" style = "width:5%;" >
  <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
  <header class = "user_header_right" style="flex-direction:column;justify-content:space-between;gap:20px;">
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="fas fa-sign-out-alt logout"></a>
        <a id = "change-theme" class="far fa-sun logout"></a>
        <a href="gc.php" id = "group-chat" class="fas fa-plus logout"></a>
        <a href="edit_index.php" id = "settings" class="fas fa-pencil-alt logout"></a>
</header>
  </div>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
            $value = $row['fname'].'_'.$row['lname'];
            setcookie("curruser",$value, time()+86400, "/");
          ?>
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <p><?php echo $row['status']; ?></p>
            <h6 style="color:grey"><?php echo 'Last seen: '.$row['last_seen']; ?></h6>
          </div>
        </div>
        
        <!-- <div class = "user_header_right">
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="fas fa-sign-out-alt logout"></a>
        <a id = "change-theme" class="far fa-sun logout"></a>
        <a href="gc.php" id = "group-chat" class="fas fa-plus logout"></a>
        <a id = "settings" class="fas fa-bars logout"></a>
        </div> -->
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>
</html>
