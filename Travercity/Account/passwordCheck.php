<?php
  $user = "root";
  $pw = "MyNewPass";

  try {
    $conn = new PDO("mysql:host=localhost;dbname=WebSys", $user, $pw, array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
    
    // Gonna need to change the error checking on this and all the other stuff later
    
    session_start();
    $userID = $_SESSION['id']; //would instead be getting userID based on the user logged in
    
    $query = "SELECT pw FROM accounts WHERE userid = $userID";
    $stmt = $conn->query($query)->fetchAll();
    if (count($stmt) == 0) { //make sure you only look at one user. if for some reason multiple users with the same id or no users with this id are found, give an error and don't let anything else happen
      throw new Exception("No user found");
    } elseif (count($stmt) > 1) {
      throw new Exception("Multiple users found with same userid");
    }
    
    // changePw3 and deletePw2 should be a post request (changing password/deleting an entire record), changePw1-2 and deletePw1 should be a get request (not changing anything)
    if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['password'])) { //checking password
      $enteredPw = $_GET['password'];
      $record = $stmt[0];
      $hashedPw = $record['pw'];
      
      if (password_verify($enteredPw, $hashedPw)) { //return true if password matches, false otherwise (returning json to check in account.js)
        echo json_encode(array("returnVal" => true));
      } else {
        echo json_encode(array("returnVal" => false));
      }
    } elseif ($_SERVER['REQUEST_METHOD'] == "PATCH") { //changing password
      parse_str(file_get_contents('php://input'), $_PATCH);
      if (isset($_PATCH['newPassword'])) {
        // Need to validate password here to make sure it meets requirements we want (check for certain characters and password length)
        if (true) { //return false if password doesnt pass validation (need to meet requirements and not let password be the same as before)
          $query = "UPDATE accounts SET pw = :pw WHERE userid = $userID";
          $stmt = $conn->prepare($query);
          $stmt->execute(array(":pw" => password_hash($_PATCH['newPassword'], PASSWORD_DEFAULT)));
          echo json_encode(array("returnVal" => true));
        } else {
          echo json_encode(array("returnVal" => false));
        }
      }
    } elseif ($_SERVER['REQUEST_METHOD'] == "DELETE") { //deleting account
      parse_str(file_get_contents('php://input'), $_DELETE);
      if (isset($_DELETE['password'])) {
        // check the password and then if it's correct, do a delete query. otherwise return false
        $enteredPw = $_DELETE['password'];
        $record = $stmt[0];
        $hashedPw = $record['pw'];
        
        if (password_verify($enteredPw, $hashedPw)) {
          $query = "SELECT * FROM travel_log_entries WHERE userid = $userID";
          $stmt = $conn->query($query);
          if ($stmt) {
            foreach ($stmt->fetchAll() as $entry) {
              $entryID = $entry['entryid'];
              $query = "DELETE FROM travel_log_images WHERE entryid = $entryID";
              $conn->query($query);
            }
            $query = "DELETE FROM travel_log_entries WHERE userid = $userID";
            $conn->query($query);
          }

          $query = "DELETE FROM accounts WHERE userid = $userID";
          $conn->query($query);
          session_destroy(); //logout 
          echo json_encode(array("returnVal" => true));
        } else {
          echo json_encode(array("returnVal" => false));
        }
      }
    }
  
    $stmt = null;
    $conn = null;
  } catch (Exception $e) {
    header("HTTP/1.0 500 Server error in passwordCheck.php");
    echo json_encode(array("error" => $e->getMessage()));
  }
?>