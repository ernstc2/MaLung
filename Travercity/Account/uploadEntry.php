<?php
   // check if post vars are set and if they are, then add to table
   $user = "root";
   $pw = "MyNewPass";
 
   try {
     session_start();

     $conn = new PDO("mysql:host=localhost;dbname=WebSys", $user, $pw, array(
       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
     ));
 
     $userID = $_SESSION['id'];
 
     if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['entryTitle']) && isset($_POST['entryContent'])) {
      $title = trim($_POST['entryTitle']);
      $content = trim($_POST['entryContent']);

      if (strlen($title) > 255) {
        throw new Exception("Title too long");
      }
      if (strlen($content) > 16777215) {
        throw new Exception("Content too long");
      }

      $query = "INSERT INTO travel_log_entries (userid, title, content) VALUES ($userID, :title, :content)";
      $pstmt = $conn->prepare($query);
      $pstmt->execute(array(":title" => $title, ":content" => $content));
      $entryID = $conn->lastInsertId();      

      
      // once you get the file upload and table updated, you will need to make changes in travelLog.php in order to display the user's entries. you should just have some basic
      // display of their stuff
      $path = "../Uploads/$userID/travelLog/$entryID/";
      if (!file_exists($path)) {
        mkdir($path, 0777, true);
      }
      foreach ($_FILES as $img) {
        $name = $img['name'];
        $temp = $img['tmp_name'];
        $fileDest = $path . $name;
        
        $query = "INSERT INTO travel_log_images (entryid, fn) VALUES ($entryID, :fn)";
        $pstmt = $conn->prepare($query);
        $pstmt->execute(array(":fn" => $fileDest));
        
        move_uploaded_file($temp, $path . $name);
      }

      $stmt = null;
      $pstmt = null;
      $conn = null;

      echo json_encode(array()); //must return json or else the ajax request will result in an error
     }
   } catch (Exception $e){
     header("HTTP/1.0 500 Server error in uploadEntry.php");
     echo json_encode(array("error" => $e->getMessage()));
   }
?>