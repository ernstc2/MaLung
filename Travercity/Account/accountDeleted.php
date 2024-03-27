<?php 
  $pathToRoot = "../";
  $PageName = "Account Deleted";
?>

<!DOCTYPE html>
<html lang="en-us">
  <head>
    <title>Travercity | <?php echo($PageName) ?> </title>
    <link rel="stylesheet" href="<?php echo($pathToRoot) ?>Resources/style.css">
    <link rel="stylesheet" href="account.css">
    <link rel="icon" href="<?php echo($pathToRoot) ?>Resources/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo($pathToRoot) ?>Resources/favicon.png" type="image/x-icon">
    <script src="<?php echo($pathToRoot) ?>Resources/jquery-3.6.1.min.js"></script>
    <script src="<?php echo($pathToRoot) ?>Resources/HeaderAndFooter.js"></script>
    <script src="account.js"></script>
  </head>

  <body>
    <?php include($pathToRoot . "Resources/navbar.php") ?>

    <main>
      <div id = "accountDeleted">Your account has been deleted</div>
    </main>

    <?php include($pathToRoot . "Resources/footer.php") ?>
  </body>
</html>