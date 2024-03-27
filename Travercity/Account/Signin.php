<?php 
  $pathToRoot = "../";
  $PageName = "Account"
?>

<?php
try {
  session_start();
  
  if (isset($_SESSION['id'])) {
    header("Location: index.php");
    die();
  }
  
  require_once('db_connect.php'); 
  
  $loginError = "";
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = trim($_POST['email']);
      $password = $_POST['password'];
  
      if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $loginError = "Please enter a valid email address.";
      } else if (empty($password)) {
          $loginError = "Please enter your password.";
      } else {
          $sql = "SELECT userid, email, pw FROM accounts WHERE email = ?";
  
          if ($stmt = $mysqli->prepare($sql)) {
              $stmt->bind_param("s", $email);
  
              if ($stmt->execute()) {
                  $stmt->store_result();
  
                  if ($stmt->num_rows == 1) {
                      $stmt->bind_result($id, $email, $hashed_password);
  
                      if ($stmt->fetch()) {
                          if (password_verify($password, $hashed_password)) {
                              $_SESSION['loggedin'] = true;
                              $_SESSION['id'] = $id;
                              $_SESSION['email'] = $email;
                              header("Location: ../Countries/index.php");
                          } else {
                              $loginError = "Invalid email/password."; //dont wanna tell people which they got wrong for security reasons
                          }
                      }
                  } else {
                      $loginError = "Invalid email/password.";
                  }
              } else {
                  echo "Oops! Something went wrong. Please try again later.";
              }
  
              $stmt->close();
          }
      }
  
      $mysqli->close();
  }
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en-us">
  <head>
    <title>Travercity | <?php echo($PageName) ?> </title>
    <link rel="stylesheet" href="<?php echo($pathToRoot) ?>Resources/style.css">
    <link rel="icon" href="<?php echo($pathToRoot) ?>Resources/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo($pathToRoot) ?>Resources/favicon.png" type="image/x-icon">
    <script src="<?php echo($pathToRoot) ?>Resources/jquery-3.6.1.min.js"></script>
    <script src="<?php echo($pathToRoot) ?>Resources/HeaderAndFooter.js"></script>
    <link rel="stylesheet" href="Signin.css">
  </head>

  <body>
    <?php include($pathToRoot . "Resources/navbar.php") ?>

    
    
    <button type="button" id="back-button" onclick="history.back(-1)">Go Back</button>
    <div id="signin-box">
      <p id="signinn">Sign in</p>
      <form action="Signin.php" method="post" onsubmit="" id="signinForm">
        <label for="email"></label>
        <input type="text" name="email" id="email" placeholder="Email" required>
        <label for="email" id="email-error" class="error"></label>

        <label for="password"></label>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <label for="password" id="password-error" class="error"></label>

        <button type="submit" name="signin" id="signin">Sign in</button>
        <label for="signin" id="signin-error" class="error"></label>
      </form>
      <div id="to-signup">
        <p id="donthave">Don't have an account?</p>
        <button id="noacc" onclick="location.replace('Signup.php')">Sign up here.</a>
      </div>
    </div>
    <div><?php echo $loginError ?></div>

    <?php include($pathToRoot . "Resources/footer.php") ?>
  </body>
</html>