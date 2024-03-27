<?php 
  $pathToRoot = "../../";
  $PageName = "Countries";
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
    <link rel="stylesheet" type="text/css" href="../countriesStyle.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHYdx_zU3mpPD-qinHkXHHl-w0O-RPkkc&libraries=streetview"></script> <!-- Street View API -->
    <script src="../getBusinesses.js"></script>
    <link rel="stylesheet" type="text/css" href="../businesses.css">
    <script>
      $(document).ready(function() {
        yelpAPICall("France", "Nature");
      });
    </script>
  </head>

  <body>
    <?php include($pathToRoot . "Resources/navbar.php"); include("../showContentFunctions.php"); ?>

    <?php include("../updateNavBar.php"); ?>
    <?php showCountryInformation(false); ?>

    <section class = "InformationBox">
      <h2>Diving</h2>
      <p>description</p>
    </section>
    <div id = "content"></div>


    <?php include($pathToRoot . "Resources/footer.php") ?>
  </body>
</html>