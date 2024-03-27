<?php 
  $pathToRoot = "../";
  $PageName = "Account - Travel Log";

  include($pathToRoot . "Resources/checkUserId.php");
?>

<!DOCTYPE html>
<html lang="en-us">
  <head>
    <title>Travercity | <?php echo($PageName) ?> </title>
    <link rel="stylesheet" href="<?php echo($pathToRoot) ?>Resources/style.css">
    <link rel="stylesheet" href="account.css">
    <link rel="stylesheet" href="travelLog.css">
    <link rel="icon" href="<?php echo($pathToRoot) ?>Resources/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo($pathToRoot) ?>Resources/favicon.png" type="image/x-icon">
    <script src="<?php echo($pathToRoot) ?>Resources/jquery-3.6.1.min.js"></script>
    <script src="<?php echo($pathToRoot) ?>Resources/HeaderAndFooter.js"></script>
    <script src="account.js"></script>
    <script src="travelLog.js"></script>
  </head>

  <body>
    <?php include($pathToRoot . "Resources/navbar.php") ?>

    <main>
      <span id = "sidebar">
        <div id = "accountInfo" class = "sidebarOption">Account Information</div>
        <div id = "sensitiveInfo" class = "sidebarOption">Sensitive Information</div>
        <!-- <div id = "posts" class = "sidebarOption">Posts</div> -->
        <div id = "travelLog" class = "sidebarOption">Travel Log</div>
      </span>

      <div id = "error"></div>

      <div id = "travelLogContent" class = "mainContent">
        <div id = "newEntry" class = "mainContentBlock travelLogBlock">
          <h1>New Entry</h1>
        </div>
        <div id = "entries"></div>
      </div>

      <div id = "contents"></div>

      <form id = "newEntryForm" action = "travelLog.php" method = "post" onsubmit = "makeNewEntry(this); return false" enctype = "multipart/form-data">
        <img id = "entryFormBackButton" class = "backButton" src = "<?php echo($pathToRoot) ?>Resources/Images/back_button.png">
        <label for = "entryTitle" class = "entryFormLabel">Title: </label><input type = "text" id = "entryTitle" class = "entryFormInput" name = "entryTitle" required><br>
        <div id = "content">
          <label for = "entryContent" class = "entryFormLabel">Content: </label><textarea id = "entryContent" class = "entryFormInput" name = "entryContent"></textarea><br>
        </div>        
        <label for = "entryImages" class = "entryFormLabel">Images: </label><input type = "file" accept = "image/*" value = "Upload Images" id = "entryImages" name = "entryImages" multiple><br>
        <input class = "submitButton" type = "submit" value = "Finish">
        <div id = "newEntryError"></div>
      </form>
    </main>

    <?php include($pathToRoot . "Resources/footer.php") ?>

  </body>
</html>