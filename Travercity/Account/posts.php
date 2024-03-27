<?php 
  $pathToRoot = "../";
  $PageName = "Account";

  include($pathToRoot . "Resources/checkUserId.php");
?>

<!DOCTYPE html>
<html lang="en-us">
  <head>
    <title>Travercity | <?php echo($PageName) ?> </title>
    <link rel="stylesheet" href="<?php echo($pathToRoot) ?>Resources/style.css">
    <link rel="stylesheet" href="account.css">
    <link rel="stylesheet" href="postsInfo.css">
    <link rel="icon" href="<?php echo($pathToRoot) ?>Resources/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo($pathToRoot) ?>Resources/favicon.png" type="image/x-icon">
    <script src="<?php echo($pathToRoot) ?>Resources/jquery-3.6.1.min.js"></script>
    <script src="<?php echo($pathToRoot) ?>Resources/HeaderAndFooter.js"></script>
    <script src="account.js"></script>
  </head>

  <body>
    <?php include($pathToRoot . "Resources/navbar.php") ?>

    <main>
      <span id = "sidebar">
        <div id = "accountInfo" class = "sidebarOption">Account Information</div>
        <div id = "sensitiveInfo" class = "sidebarOption">Sensitive Information</div>
        <div id = "posts" class = "sidebarOption">Posts</div>
        <div id = "travelLog" class = "sidebarOption">Travel Log</div>
      </span>

      <!-- 
        Made quick static posts to show in midterm presentation. 
        Plan on making it so that when you click on a post, it directs you to the actual post page. These past posts should just be a quick summary.
      -->

      <div id = "postsContent" class = "mainContent">
        <div class = "mainContentBlock post">
          <span>
            <h1 class = "title">Borf</h1>
            <span class = "description">borf borf</span>
          </span>
          <span class = "date">10/16/23</span>
        </div>
        <div class = "mainContentBlock post">
          <span>
            <h1 class = "title">Borf</h1>
            <span class = "description">borf borf</span>
          </span>
          <span class = "date">10/15/23</span>
        </div>
        <div class = "mainContentBlock post">
          <span>
            <h1 class = "title">Borf</h1>
            <span class = "description">borf borf</span>
          </span>
          <span class = "date">10/14/23</span>
        </div>
        <div class = "mainContentBlock post">
          <span>
            <h1 class = "title">Borf</h1>
            <span class = "description">borf borf</span>
          </span>
          <span class = "date">10/13/23</span>
        </div>
        <div class = "mainContentBlock post">
          <span>
            <h1 class = "title">Borf</h1>
            <span class = "description">borf borf</span>
          </span>
          <span class = "date">10/12/23</span>
        </div>
        <div class = "mainContentBlock post">
          <span>
            <h1 class = "title">Borf</h1>
            <span class = "description">borf borf</span>
          </span>
          <span class = "date">10/11/23</span>
        </div>
        <div class = "mainContentBlock post">
          <span>
            <h1 class = "title">Borf</h1>
            <span class = "description">borf borf</span>
          </span>
          <span class = "date">10/10/23</span>
        </div>
        <div class = "mainContentBlock post">
          <span>
            <h1 class = "title">Borf</h1>
            <span class = "description">borf borf</span>
          </span>
          <span class = "date">10/09/23</span>
        </div>
        <div class = "mainContentBlock post">
          <span>
            <h1 class = "title">Borf</h1>
            <span class = "description">borf borf</span>
          </span>
          <span class = "date">10/08/23</span>
        </div>
        <div class = "mainContentBlock post">
          <span>
            <h1 class = "title">Borf</h1>
            <span class = "description">borf borf</span>
          </span>
          <span class = "date">10/07/23</span>
        </div>
        <div class = "mainContentBlock post">
          <span>
            <h1 class = "title">Borf</h1>
            <span class = "description">borf borf</span>
          </span>
          <span class = "date">10/06/23</span>
        </div>
      </div>      
    </main>

    <?php include($pathToRoot . "Resources/footer.php") ?>
  </body>
</html>