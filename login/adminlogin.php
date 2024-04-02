<?php
session_start();

require("config.php");

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);


    if ($id === "superadmin" && $pass === "superadmin123") {
        $_SESSION["id"] = $id;
        header("Location: ../superadminpage/superadminBoard.php");
        exit();
    }

   
    $select_admin = "SELECT * FROM admin WHERE ID = '$id' AND pass = '$pass'";
    $result_admin = mysqli_query($conn, $select_admin);

    if (mysqli_num_rows($result_admin) == 1) {
        $_SESSION["id"] = $id;
        header("Location: ../adminpages/adminBoard.php");
        exit();
    }

    $error = "Invalid ID or password. Please try again.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>

   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      <h3>Login Now</h3>
      <?php if($error != ''): ?>
         <span class="error-msg"><?= $error ?></span>
      <?php endif; ?>
      <input type="text" name="id" required placeholder="Enter your ID">
      <input type="password" name="pass" required placeholder="Enter your password">
      <input type="submit" name="submit" value="Login Now" class="form-btn">
      <p> <a href="login.php"> Login as User</a></p>
   </form>

   
</div>

</body>
</html>
