<?php
session_start();

require("config.php");

$error = [];

if(isset($_POST['submit'])){

   $studentid = mysqli_real_escape_string($conn, $_POST['studentid']);
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $campusID = $_POST['campusID']; // Update variable name to match database field

   $select = "SELECT * FROM user WHERE studentid = '$studentid'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'User already exists!';
   } else {
      if($pass != $cpass){
         $error[] = 'Passwords do not match!';
      } else {
         $insert = "INSERT INTO user (studentid, name, email, password, campusID) VALUES ('$studentid', '$name', '$email', '$pass', '$campusID')"; // Update query to insert into `user` table
         mysqli_query($conn, $insert);
         $_SESSION['user_name'] = $name;
         $_SESSION['campusID'] = $campusID; // Store selected campus ID in session
         header('location: login.php');
      }
   }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Register Now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error_msg){
            echo '<span class="error-msg">'.$error_msg.'</span>';
         }
      }
      ?>
      <input type="text" name="studentid" required placeholder="Enter your Student ID">
      <input type="text" name="name" required placeholder="Enter your Fullname">
      <input type="email" name="email" required placeholder="Enter your Email">
      <input type="password" name="password" required placeholder="Enter your Password">
      <input type="password" name="cpassword" required placeholder="Confirm your Password">
      <select name="campusID"> <!-- Update name attribute to match database field -->
         <option value="">SELECT PSU CAMPUS</option>
         <option value="CAMP1001">Urdaneta</option>
         <option value="CAMP1002">Asingan</option>
         <option value="CAMP1003">Lingayen</option>
         <option value="CAMP1004">Binmaley</option>
      </select>
      <input type="submit" name="submit" value="Register Now" class="form-btn">
      <p>Already have an account? <a href="login.php">Login Now</a></p>
   </form>

</div>

</body>
</html>
