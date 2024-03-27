<?php 
  $pathToRoot = "../";
  $PageName = "About";

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
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <?php include($pathToRoot . "Resources/navbar.php") ?>
    <div id="body1">
    <h1 id="title">Discover the World with Travercity</h1>

    <div id="box-1">
      <img src="image/image1.jpg" class="i1_l" alt="Description of Image 1">
      <br>
      <div id="color">
      <li>Dive deep into the wonders of every corner of the world:</li>
      <br>
      <li>Explore breathtaking sights and attractions.</li>
      <br>
      <li>Immerse yourself in the local arts and culture.</li>
      <br>
      <br>
      </div>
      <img src="image/image3.png" class="i1_r" alt="Description of Image 2">
        <div id="space">
      <p>Search and Review: From hidden gems to popular landmarks, find them all. 
        Plus, get firsthand experiences from fellow travelers!</p>
        <p>Virtual Tours with Google Earth: Explore by landmarks and take
        a virtual journey even before you set foot there.</p>
        <p>Plan Like a Pro: From visa guides to accommodations, from 
        transportation options&nbsp&nbsp&nbsp to the latest weather updates – we've got you covered.
        </p>
        <p>Know Before You Go: Dive into the rich 
        history, culture, and religion of each country 
        before you visit.
        </p>
        </div>
      </div>
    </div>

    <?php include($pathToRoot . "Resources/footer.php") ?>
  </body>
</html>
