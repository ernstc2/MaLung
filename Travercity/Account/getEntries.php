<?php
  $user = "root";
  $pw = "MyNewPass";

  try {
    session_start();

    $conn = new PDO("mysql:host=localhost;dbname=WebSys", $user, $pw, array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //make sures that if an error is found, it's always thrown instead of a possible silent error
    ));

    $json_array = array();

    $userID = $_SESSION['id'];
    $query = "SELECT * FROM travel_log_entries WHERE userid = $userID";
    $stmt = $conn->query($query);
    $entries = $stmt->fetchAll();
    $ind = 0;
    foreach ($entries as $entry) {
      $json_array[$ind] = array("entryid" => $entry['entryid'], "title" => $entry['title'], "content" => $entry['content'], "timeCreated" => $entry['created'], "images" => array());
      
      $entryID = $entry['entryid'];
      $query = "SELECT * FROM travel_log_images WHERE entryid = $entryID";
      $stmt = $conn->query($query);
      $images = $stmt->fetchAll();

      $imgInd = 0;
      foreach ($images as $image) {
        $json_array[$ind]["images"][$imgInd] = $image['fn'];

        $imgInd = $imgInd + 1;
      }
      $ind = $ind + 1;
    }

    $stmt = null;
    $conn = null;
    echo json_encode($json_array);
  } catch (Exception $e) {
    header("HTTP/1.0 500 Server error in passwordCheck.php");
    echo json_encode(array("error" => $e->getMessage()));
  }
?>