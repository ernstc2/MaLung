<?php
  $dbOk = false;
  @ $db = new mysqli('localhost', 'root', 'MyNewPass', 'WebSys');

  if ($db->connect_error) {
    echo '<div class="messages">Could not connect to the database. Error: ';
    echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
  } else {
    $dbOk = true;
  }
  $havePost = isset($_POST["save"]);
  $errors = '';
  if ($dbOk) {
    if(isset($_POST['Post_comment'])) {
      $pre_C = str_replace("\n", "\r", $_POST['Post_comment']);
      $add_C = "\r\n".$pre_C;
      $query = "SELECT * FROM `posts` WHERE `ID` = ?";
      $binder = $db->prepare($query);
      $binder->bind_param("s",$_POST['Post_Num']);
      $binder->execute();
      $result = $binder->get_result();
      $numRecords = $result->num_rows;
      $record = $result->fetch_assoc();
      $file = "Blog_Posts/".$record['Content'];
      $myfile = fopen($file, "a");
      fwrite($myfile,$add_C);
      fclose($myfile);
      header('Location: Blogs.php?country='.$_GET['country']);
    }  
  }
  $db->close();
?>