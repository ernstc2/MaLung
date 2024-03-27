<?php
  $pathToRoot = "../";
  session_start();
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
    if(isset($_POST['title'])) {
      $title = $_POST['title'];
      $sub_title = "\r\n".$_POST['sub_title'];
      $pre_content = str_replace("\n", "\r", $_POST['content']);
      $content = "\r\n".$pre_content;
      $image = $_FILES['image'];
      if(!isset($_SESSION['id']))
      {
        header('Location: http://itws2110-team10.eastus.cloudapp.azure.com/iit/Travercity/Account/Signin.php');
      }
      try {
        $userID = $_SESSION['id'];
      }
      catch (Exception $e) {
        echo $e->getMessage();
        exit(1);
      }
      $query = 'select * from posts order by ID DESC';
      $result = $db->query($query);
      $LastID = $result->fetch_assoc();
      $ID_num = $LastID['ID']+1;


      if($image['type']=="image/jpeg")
      {
        $fileName = "".$ID_num.".jpg";
      }
      else
      {
        $fileName = "".$ID_num.".png";
      }
      move_uploaded_file($_FILES['image']['tmp_name'], $pathToRoot."Countries/Blog_Posts/".$fileName);
      $fileName = "\r\n".$fileName;
      

      include("showContentFunctions.php");
      $conn = new PDO("mysql:host=localhost;dbname=WebSys", "root", "MyNewPass");
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $param1Value = getCountryIDOfImportance($conn,($_GET['country']));
      $CID=$param1Value['ID'];
      $query2="INSERT INTO `posts` (`ID`, `CountryID`, `ActivityID`, `UserID`, `Content`) VALUES (NULL, $CID, '1', $userID, 'ID".$ID_num.".txt')";
      $result = $db->query($query2);
      $file = "Blog_Posts/ID".$ID_num.".txt";
      $myfile = fopen($file, "a");
      fwrite($myfile,$title);
      fwrite($myfile,$sub_title);
      fwrite($myfile,$fileName);
      fwrite($myfile,$content);
      fclose($myfile);
      header('Location: Blogs.php?country='.$_GET['country']);
    }  
  }
  $db->close();
?>