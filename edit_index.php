<?php 
  session_start();
//   if(isset($_SESSION['unique_id'])){
//     header("location: users.php");
//   }
include_once "php/config.php";
  $outgoing_id = $_SESSION['unique_id'];
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
  $row = mysqli_fetch_assoc($sql);

  if (isset($_POST["submit"])){
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    if(isset($_FILES['image'])){
      $img_name = $_FILES['image']['name'];
      $img_type = $_FILES['image']['type'];
      $tmp_name = $_FILES['image']['tmp_name'];
      
      $img_explode = explode('.',$img_name);
      $img_ext = end($img_explode);

      $extensions = ["jpeg", "png", "jpg"];
      if(in_array($img_ext, $extensions) === true){
          $types = ["image/jpeg", "image/jpg", "image/png"];
          if(in_array($img_type, $types) === true){
              $time = time();
              $new_img_name = $time.$img_name;
          }
          if(move_uploaded_file($tmp_name,"php/images/".$new_img_name)){
            $sql = mysqli_query($conn, "UPDATE users SET fname = '{$fname}', lname='{$lname}', email='{$email}', img='{$new_img_name}' WHERE unique_id = {$outgoing_id}");
          }
        }
      }
      else{
        $sql = mysqli_query($conn, "UPDATE users SET fname = '{$fname}', lname='{$lname}', email='{$email}' WHERE unique_id = {$outgoing_id}");
      }
    // $password = mysqli_real_escape_string($conn, $_POST['password']);
   
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
  $row = mysqli_fetch_assoc($sql);
  }

?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>
      <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>  Edit profile</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" value="<?php echo $row['fname'] ?>" >
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" value="<?php echo $row['lname'] ?>" >
          </div>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" value="<?php echo $row['email'] ?>" >
        </div>
        <div class="field input">
          <label>Change Password</label>
          <input type="password" name="password"  >
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Change Profile</label>
          <input type="file" name="image" value="key.jpg" accept="image/x-png,image/gif,image/jpeg,image/jpg" >
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Update profile">
        </div>
      </form>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <!-- <script src="javascript/signup.js"></script> -->

</body>
</html>
