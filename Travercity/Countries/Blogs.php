<?php 
  $pathToRoot = "../";
  $PageName = "Blogs";

  //include($pathToRoot . "Resources/checkUserId.php");
?>

<!DOCTYPE html>
<html lang="en-us">
  <head>
    <title>Travercity | <?php echo($PageName) ?> </title>
    <link rel="stylesheet" href="<?php echo($pathToRoot) ?>Resources/style.css">
    <link rel="icon" href="<?php echo($pathToRoot) ?>Resources/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo($pathToRoot) ?>Resources/favicon.png" type="image/x-icon">
    <script src="<?php echo($pathToRoot) ?>Resources/jquery-3.6.1.min.js"></script>
    <script src="<?php echo($pathToRoot) ?>Resources/HeaderAndFooter.js"></script>
    <link rel="stylesheet" type="text/css" href="countriesStyle.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHYdx_zU3mpPD-qinHkXHHl-w0O-RPkkc&libraries=streetview"></script> <!-- Street View API -->
    <script src="getBusinesses.js"></script>
    <link rel="stylesheet" type="text/css" href="businesses.css">
  </head>

  <body>
<?php include($pathToRoot . "Resources/navbar.php"); include("showContentFunctions.php"); ?>

<?php include("updateNavBar.php"); ?>
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
  $conn = new PDO("mysql:host=localhost;dbname=WebSys", "root", "MyNewPass");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $param1Value = getCountryIDOfImportance($conn,($_GET['country']));
  ?>
  <div class="row">
    <div class="leftcolumn">
  <?php
  if ($dbOk) {
    $query = 'select * from posts order by ID';
    $result = $db->query($query);

    $numRecords = $result->num_rows;
    if($numRecords!=0)
    {
      for ($i=1; $i <= $numRecords; $i++) {
        $record = $result->fetch_assoc();
        if($record['CountryID']==$param1Value['ID']){
          $file = "Blog_Posts/".$record['Content'];
          $myfile = fopen($file, "r");
          //Seperate each item by it being on a newline
          $numbers = explode("\n", fread($myfile,filesize($file)));

          $wording = $numbers;
          $wording_3 = str_replace("\r", "\n", $wording[3]);
          echo '<div class="card">
          <h2>'. htmlspecialchars($wording[0]) .'</h2>
          <h5>'.htmlspecialchars($wording[1]).'</h5>
          <img src="Blog_Posts/'.htmlspecialchars($wording[2]).'" alt='.htmlspecialchars($wording[2]).'" style="height:200px;">
          <p>'.htmlspecialchars($wording_3).'</p>'
          ;
          for($k=4; $k < count($wording); $k++){
            $wording_k = str_replace("\r", "\n", $wording[$k]);
            echo '<p class="comments">'.htmlspecialchars($wording_k).'</p>';
          }
          echo '
          <form action="post.php?country='.$_GET['country'].'" method="post">
          <input type="text" id="Post_comment" name="Post_comment"><br>
          <input type="hidden" name="Post_Num" value="'.(int)($record['ID']).'"> 
          <input type="submit" value="Post Comment">
          </form>
          ';
          echo '</div>';
          fclose($myfile);

        }
      }  
    }
      
    $result->free();

    $db->close();
  }
  ?>
    </div>
    <div id="Blog_Add">
      <h3 id="Create_Post_h3">Create New Post</h3>
      <form action="blog_entry.php?country=<?php echo $_GET['country']?>" method="post" id="Create_Blog_Entry" enctype="multipart/form-data">
      <div class="forum_item">
        <label for="title">Title:</label>
        <br>
        <input type="text" id="title" name="title" placeholder="Enter blog post title" required>
        <br>
      </div>
      <div class="forum_item">
        <label for="sub_title">Header:</label>
        <br>
        <input type="text" id="sub_title" name="sub_title" placeholder="Enter Info About Blog Post" required>
        <br>
      </div>
      <div class="forum_item">
        <label for="image">Featured Image:</label>
        <br>
        <input type="file" id="image" name="image" accept="image/png, image/jpeg" required>
        <br>
      </div>
      <div class="forum_item">
        <label for="content">Content:</label>
        <br>
        <textarea id="content" name="content" placeholder="Write your blog post here" required></textarea>
        <br>
      </div>
      <div id="forum_item_button">
        <button type="submit">Upload Post</button>
      </div>
      </form>
    </div>
  </div>
  <?php include($pathToRoot . "Resources/footer.php") ?>
  </body>
</html>