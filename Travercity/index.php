<?php 
  $pathToRoot = "./";
  $PageName = "Home";

  session_start();
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
    <script src="<?php echo($pathToRoot) ?>Resources/index.js"></script>
  </head>

  <body id="index_background">
    <?php include($pathToRoot . "Resources/navbar.php") ?>

    <!--<h1> Page: <?php //echo($PageName) ?> </h1>-->
    <div id="center-box">
      <h1 id="Homepage-Welcome">Welcome to Travercity!</h1>
      <h2 id="Homepage-Welcome-2">Your Home for Everything Travel</h2>
      <p class="Homepage-Text">Are you sick of having to go to 10 different sites to find 
        out what you should do for a trip? We are too. That is why we
        created Travercity to merge all of these things together!</p>
      <p class="Homepage-Text">With Travercity, you can go and find places to visit, find helpful reviews
       and find key information about local customs and laws so you spend less time researching and more
        time focusing on the fun!
      </p>
      <br>
      <div id="button-container">
        <button id="Signup" type="button" onclick="window.location.href='<?php echo($pathToRoot) ?>Account/Signup.php';">Join now!</button>
      </div>
      <br>
    </div>
    <?php include($pathToRoot . "Resources/footer.php") ?>
  </body>
</html>
