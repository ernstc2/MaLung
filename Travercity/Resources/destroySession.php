<?php
  session_start();
  try {
    session_destroy();
    echo json_encode(array());
  } catch (Exception $e) {
    header("HTTP/1.0 500 Server error in destroySession.php");
    echo json_encode(array("error" => $e->getMessage()));
  }
?>