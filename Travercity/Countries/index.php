<?php

use function PHPSTORM_META\type;

  $pathToRoot = "../";
  $PageName = "Countries";

  $country = "";
  $activity = "";
  if (isset($_GET['country'])) {
    $country = $_GET['country'];
  }
  if (isset($_GET['type'])) {
    $activity = $_GET['type'];
  }
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
    <link rel="stylesheet" type="text/css" href="countriesStyle.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHYdx_zU3mpPD-qinHkXHHl-w0O-RPkkc&libraries=streetview"></script> <!-- Street View API -->
    <script src="getBusinesses.js"></script>
    <link rel="stylesheet" type="text/css" href="businesses.css">
  </head>

  <body>
    <?php include($pathToRoot . "Resources/navbar.php"); include("showContentFunctions.php"); ?>

    <?php include("updateNavBar.php"); ?>

    <?php
      if (!isset($_GET['country'])) {
        if (!isset($_GET['search'])) {
          showSearchBar();
        } else {
          showSearchBar($_GET['search']);
        }
      } else {
        if (!isset($_GET['type'])) {
          showCountryInformation();
        } else {
          if ($_GET['type']=="Blog") {
            header('Location: Blogs.php?country='.$_GET['country']);
          }
          else {
            showCountryInformation($_GET['type']);
          }
        }
      }
    ?>

    <div id = "content"></div>

    <?php
      if (isset($_GET['country']) && isset($_GET['type']) && removeEscapeCharacters($_GET['type']) != "Explore Country"  && removeEscapeCharacters($_GET['type']) != "Cultural Event" && removeEscapeCharacters($_GET['type']) != "News") {
        echo '<script>
        $(document).ready(function() {
          x = "'.$country.'";
          y = "'.$activity.'";
          yelpAPICall(x, y);
        });
      </script>';
        echo '<button class="learn-more" onclick="LoadMore();">Load more</button>';
      }
    ?>

    <?php include($pathToRoot . "Resources/footer.php") ?>
  </body>
</html>