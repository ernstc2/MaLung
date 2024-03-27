<?php
  //Delete this file before final submission
  $userID = 1;

  $path = "../Uploads/$userID/test/";
  if (!file_exists($path)) {
    mkdir($path, 0777, true);
  }
  foreach ($_FILES as $key) {
    if($key['error'] == UPLOAD_ERR_OK ){
      $name = $key['name'];
      $temp = $key['tmp_name'];
      $size= ($key['size'] / 1000)."Kb";
      move_uploaded_file($temp, $path . $name);
      echo "
          <div>
              <h12><strong>File Name: $name</strong></h2><br />
              <h12><strong>Size: $size</strong></h2><br />
              <hr>
          </div>
          ";
      try {
        $user = "root";
        $pw = "MyNewPass";
        $conn = new PDO("mysql:host=localhost;dbname=WebSys", $user, $pw, array(
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ));

        $entryID = 13;
        $query = "INSERT INTO travel_log_images (entryid, fn) VALUES ($entryID, :fn)";
        $pstmt = $conn->prepare($query);
        $pstmt->execute(array(":fn" => $path . $name));
      } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    } else{
      echo $key['error'];
    }
  }
?>