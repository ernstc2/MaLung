<?php 
  $pathToRoot = "../";
  $PageName = "Account";
  
  try {
    session_start();
    if (isset($_SESSION['id'])) {
      header("Location: index.php");
      die();
    }
    
    require_once('db_connect.php');
  
    $registrationError = "";
  
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
      $email = trim($_POST['email']);
      $password = $_POST['pw'];
      $confirm_password = $_POST['confirm'];
  
      $sql = "SELECT userid, email, pw FROM accounts WHERE email = ?";
      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param("s", $email);
      
      if ($stmt->execute()) {
        $stmt->store_result();
  
        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $registrationError = "Invalid email address.";
        } elseif ($stmt->num_rows > 0) {
          $registrationError = "An account with this email already exists.";
        } elseif(empty($password) || $password !== $confirm_password) {
          $registrationError = "Passwords do not match.";
        } else {
          $stmt->close();
  
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          $sql = "INSERT INTO accounts (email, pw) VALUES (?, ?)";
    
          if($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("ss", $email, $hashed_password);
            if($stmt->execute()) {
              header("location: Signin.php");
              exit();
            } else {
              $registrationError = "Something went wrong. Please try again later.";
            }
            $stmt->close();
          }
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
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
    <link rel="stylesheet" href="Signup.css">
  </head>

  <body>
    <?php include($pathToRoot . "Resources/navbar.php") ?>
    <?php if(!empty($registrationError)): ?>
    <p class="error"><?php echo $registrationError; ?></p>
    <?php endif; ?>

    
    
    <button type="button" id="back-button" onclick="history.back(-1)">Go Back</button>
    <div id="signup-box">
      <p id="signupp">Sign up</p>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return onSubmit()" id="signupForm">
        <label for="email"></label>
        <input type="text" name="email" id="email" placeholder="Email" required>
        <label for="email" id="email-error" class="error"></label>

        <label for="pw"></label>
        <input type="password" name="pw" id="pw" placeholder="password" required>
        <label for="password" id="password-error" class="error"></label>

        <label for="confirm"></label>
        <input type="password" name="confirm" id="confirm" placeholder="Confirm Password" required>
        <label for="email" id="confirm-error" class="error"></label>

        <button type="submit" name="signup" id="signup">Sign up</button>
        <label for="signup" id="signup-error" class="error"></label>

      </form>
      <div id="to-signin">
        <p id="have">Already have an account?</p>
        <button id="noacc" onclick="location.replace('Signin.php')">Sign in here.</a>
      </div>
    </div>

    <?php include($pathToRoot . "Resources/footer.php") ?>
  </body>
</html>