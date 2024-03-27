<?php 
  $pathToRoot = "../";
  $PageName = "Account - General Info";
  
  $user = "root";
  $pw = "MyNewPass";
  
  include($pathToRoot . "Resources/checkUserId.php");
  
  try {
    // Posts aren't included in the accounts table, will need to connect to the other database and grab all posts related to a user from there
    
    $conn = new PDO("mysql:host=localhost;dbname=WebSys", $user, $pw, array( //change dbname back to WebSys before pushing
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //make sures that if an error is found, it's always thrown instead of a possible silent error
    ));

    $userID = $_SESSION['id'];

    // need to ask about what requirements we want for usernames and stuff. will need to verify that user input meets requirements here
    if (isset($_POST['saveName'])) {
      $name = trim($_POST['newDisplayName']);
      $query = "UPDATE accounts SET displayname = :displayName WHERE userid = :id";
      $pstmt = $conn->prepare($query);
      $pstmt->execute(array(":displayName" => $name, ":id" => $userID)); //should throw an exception if something goes wrong
    } elseif (isset($_POST['savePronouns'])) {
      $pronouns = trim($_POST['newPronouns']);
      $query = "UPDATE accounts SET pronouns = :pronouns WHERE userid = :id";
      $pstmt = $conn->prepare($query);
      $pstmt->execute(array(":pronouns" => $pronouns, ":id" => $userID));
    } elseif (isset($_POST['saveCountry'])) {
      $country = trim($_POST['newCountry']);
      $query = "UPDATE accounts SET country = :country WHERE userid = :id";
      $pstmt = $conn->prepare($query);
      $pstmt->execute(array(":country" => $country, ":id" => $userID));
    } // elseif (isset($_POST['saveEmail'])) {
    //   $email = trim($_POST['newEmail']);
    //   $query = "UPDATE accounts SET email = :email WHERE userid = :id";
    //   $pstmt = $conn->prepare($query);
    //   $pstmt->execute(array(":email" => $email, ":id" => $userID));
    // }

    $query = "SELECT displayname, pronouns, country, email FROM accounts WHERE userid = $userID";
    $stmt = $conn->query($query)->fetchAll();
    if (count($stmt) == 0) {
      throw new Exception("No user found");
    } elseif (count($stmt) > 1) {
      throw new Exception("Multiple users found with same userid");
    }
    $record = $stmt[0];
    $displayName = $record['displayname'];
    $pronouns = $record['pronouns'];
    $country = $record['country'];
    $email = $record['email'];

    $pstmt = null;
    $stmt = null;
    $conn = null; //closing connection
  } catch (Exception $e) {
    echo $e->getMessage();
    exit(1);
  }
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
      <span id = "sidebar">
        <div id = "accountInfo" class = "sidebarOption">Account Information</div>
        <div id = "sensitiveInfo" class = "sidebarOption">Sensitive Information</div>
        <!-- <div id = "posts" class = "sidebarOption">Posts</div> -->
        <div id = "travelLog" class = "sidebarOption">Travel Log</div>
      </span>

      <!-- Will want to style the forms instead of letting them look ugly af -->

      <div id = "accountInfoContent" class = "mainContent">
        <div class = "mainContentBlock">
          <h1>Name: <span id = "fullName"><?php echo($displayName) ?></span></h1> <img id = "editName" class = "editButton" src = "<?php echo($pathToRoot) ?>Resources/Images/edit_button.png">
          <form id = "nameForm" action = "index.php" method = "post">
            <span class = "formContent">
              <span>
                <label for = "newFName">Display name: </label>
                <input type = "text" id = "newFName" name = "newDisplayName" required>
              </span>
              <input class = "submitButton" name = "saveName" type = "submit" value = "Save">
            </span>
          </form>
        </div>

        <div class = "mainContentBlock">
          <h1>Pronouns: <span id = "pronouns"><?php echo($pronouns) ?></span></h1> <img id = "editPronouns" class = "editButton" src = "<?php echo($pathToRoot) ?>Resources/Images/edit_button.png">
          <form id = "pronounsForm" action = "index.php" method = "post">
            <span class = "formContent">
              <span>
                <label for = "pronouns">Pronouns: </label>
                <input type = "text" id = "newPronouns" name = "newPronouns" required>
              </span>
              <input class = "submitButton" name = "savePronouns" type = "submit" value = "Save">
            </span>
          </form>
        </div>

        <div class = "mainContentBlock">
          <h1>Home Country: <span id = "homeCountry"><?php echo($country) ?></span></h1> <img id = "editHomeCountry" class = "editButton" src = "<?php echo($pathToRoot) ?>Resources/Images/edit_button.png">
          <form id = "homeCountryForm" action = "index.php" method = "post">
            <span class = "formContent">
              <span>
                <label for = "newCountry">Home Country: </label>
                <input type = "text" id = "newCountry" name = "newCountry" required>
              </span>
              <input class = "submitButton" name = "saveCountry" type = "submit" value = "Save">
            </span>
          </form>
        </div>

        <!-- <div class = "mainContentBlock">
          <h1>Email: <span id = "email"><? //php echo($email) ?></span></h1> <img id = "editEmail" class = "editButton" src = "<? //php echo($pathToRoot) ?>Resources/Images/edit_button.png">
          <form id = "emailForm" action = "index.php" method = "post">
            <span class = "formContent">
              <span>
                <label for = "newEmail">Email: </label>
                <input type = "text" id = "newEmail" name = "newEmail" required>
              </span>
              <input class = "submitButton" name = "saveEmail" type = "submit" value = "Save">
            </span>
          </form>
        </div>
      </div> -->
    </main>

    <?php include($pathToRoot . "Resources/footer.php") ?>

  </body>
</html>

<!-- 
- Update the way errors are printed to be put in divs in red text instead
- Test all the account pages to make sure they work properly
 -->