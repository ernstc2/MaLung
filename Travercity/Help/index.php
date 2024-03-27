<?php 
  $pathToRoot = "../";
  $PageName = "Help";
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
    <script src="collapsible.js"></script>

  </head>

  <body>
    <?php include($pathToRoot . "Resources/navbar.php") ?>
    <div id="body1">
    <h1>Need help?</h1>
    <div class="container">
    <div id="left-box">
    <div class="box-1">
    <button class="collapsible-btn">How do I search for a specific tourist attraction?</button>
      <div class="collapsible-content">
        <p>We may provide specific tourist attractions but additional information may be limited, sorry for the inconvenience.</p>
      </div>

      <button class="collapsible-btn">How to use map</button>
      <div class="collapsible-content">
        <p>We use Google Maps API throughout the site, for more information on usage, please visit:</p>
        <a href="https://support.google.com/maps/answer/3273406?hl=en&co=GENIE.Platform%3DAndroid">Here</a>
      </div>

      <button class="collapsible-btn">How do I use the "Google Earth" feature to explore landmarks?</button>
      <div class="collapsible-content">
        <p>On our "explore" page we provide specific examples of landmarks to explore. The landmarks given are based on popularity.</p>
      </div>    
    </div>
    </div>
    <div id="right-box">

    <div class="box-1">
    <button class="collapsible-btn">A country I searched dosnt appear?</button>
      <div class="collapsible-content">
        <p>Travercity is in its early stages of development, a country might not have been added</p>
      </div>

      <button class="collapsible-btn">I dont like your web application and I hate you</button>
      <div class="collapsible-content">
        <p>We hate you too.</p>
      </div>

      <button class="collapsible-btn">I forgot my password, where can I reset my password when logging in?</button>
      <div class="collapsible-content">
        <p>Currently, Travercity does not have this feature but it is being added very soon! If you have any suggestions for features please contact us.</p>
      </div>    
    </div>
    </div>

</div>

    <div id="help">
      <button class="collapsible-btn">Not resolved?</button>
      <div class="collapsible-content">
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          contact us<p>
        <img src="image/arrow.png" id ="arrow"></img>
      </div>
      </div>
      
    </div>


    <?php include($pathToRoot . "Resources/footer.php") ?>
  </body>
</html>
