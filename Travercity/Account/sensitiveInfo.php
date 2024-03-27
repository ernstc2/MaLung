<?php 
  $pathToRoot = "../";
  $PageName = "Account - Sensitive Info";

  include($pathToRoot . "Resources/checkUserId.php");
?>

<!DOCTYPE html>
<html lang="en-us">
  <head>
    <title>Travercity | <?php echo($PageName) ?> </title>
    <link rel="stylesheet" href="<?php echo($pathToRoot) ?>Resources/style.css">
    <link rel="stylesheet" href="account.css">
    <link rel="stylesheet" href="sensitiveInfo.css">
    <link rel="icon" href="<?php echo($pathToRoot) ?>Resources/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo($pathToRoot) ?>Resources/favicon.png" type="image/x-icon">
    <script src="<?php echo($pathToRoot) ?>Resources/jquery-3.6.1.min.js"></script>
    <script src="<?php echo($pathToRoot) ?>Resources/HeaderAndFooter.js"></script>
    <script src="account.js"></script>
  </head>

  <body>
    <?php include($pathToRoot . "Resources/navbar.php") ?>

    <!-- Make sure to style the forms and actually make the password stuff functional -->
    <!-- Need to change sidebar to reload page when you click on a page you're on (it gets annoying when changing password and wanting to go back to sensitive info) -->

    <main>
      <span id = "sidebar">
        <div id = "accountInfo" class = "sidebarOption">Account Information</div>
        <div id = "sensitiveInfo" class = "sidebarOption">Sensitive Information</div>
        <!-- <div id = "posts" class = "sidebarOption">Posts</div> -->
        <div id = "travelLog" class = "sidebarOption">Travel Log</div>
      </span>

      <div id = "sensitiveInfoContent" class = "mainContent">
        <div id = "changePassword" class = "mainContentBlock sensitiveInfoBlock">
          <h1>Change Password</h1>
        </div>
        <div id = "deleteAccount" class = "mainContentBlock sensitiveInfoBlock">
          <h1>Delete Account</h1>
        </div>
      </div>
      
      <div id = "changePasswordForm">
        <form id = "changeForm1" onsubmit = "checkPassword('change1'); return false;">
          <div class = "insideForm">
            <span>
              <label for = "changePw1">Enter password: </label>
              <input type = "password" id = "changePw1" name = "changePw1" required>
            </span>
            <input class = "submitButton" name = "changePw1Submit" type = "submit" value = "Next"><br>
          </div>
          <div id = "changeError1" class = "errorDiv"></div>
        </form>
        <form id = "changeForm2" action = "#" onsubmit = "checkPassword('change2'); return false;">
          <div class = "insideForm">  
            <span>
              <label for = "changePw2">Re-enter password: </label>
              <input type = "password" id = "changePw2" name = "changePw2" required>
            </span>
            <input class = "submitButton" name = "changePw2Submit" type = "submit" value = "Next">
          </div>
          <div id = "changeError2" class = "errorDiv"></div>
        </form>
        <form id = "changeForm3" action = "#" onsubmit = "changePassword(); return false;">
          <div class = "insideForm">
            <span>
              <label for = "changePw3">Enter new password: </label>
              <input type = "password" id = "changePw3" name = "changePw3" required>
            </span>
            <input class = "submitButton" name = "changePw3Submit" type = "submit" value = "Submit">
          </div>
          <div id = "changeError3" class = "errorDiv"></div>
        </form>
      </div>

      <div id = "deleteAccountForm">
        <form id = "deleteForm1" action = "#" onsubmit = "checkPassword('delete1'); return false;">
          <div class = "insideForm">
            <span>
              <label for = "deletePw1">Enter password: </label>
              <input type = "password" id = "deletePw1" name = "deletePw1" required>
            </span>
            <input class = "submitButton" name = "deletePw1Submit" type = "submit" value = "Next">
          </div>
          <div id = "deleteError1" class = "errorDiv"></div>
        </form>
        <form id = "deleteForm2" action = "accountDeleted.php" onsubmit = "attemptDelete(this); return false;">
          <div class = "insideForm">
            <span>
              <label for = "deletePw2">Re-enter password: </label>
              <input type = "password" id = "deletePw2" name = "deletePw2" required>
            </span>
            <input class = "submitButton" name = "deletePw2Submit" type = "submit" value = "Next">  
          </div>
          <div id = "deleteError2" class = "errorDiv"></div>
        </form>
      </div>
    </main>

    <?php include($pathToRoot . "Resources/footer.php") ?>
  </body>
</html>