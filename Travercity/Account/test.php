<?php
  //Delete this file before final submission
  $pathToRoot = "../";

  echo "'123abc' hash: " . password_hash("123abc", PASSWORD_DEFAULT) . "<br>";
  echo "'password' hash: " . password_hash("password", PASSWORD_DEFAULT) . "<br><br>";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Testing</title>
    <script src="<?php echo($pathToRoot) ?>Resources/jquery-3.6.1.min.js"></script>
    <script>
      function upload() {
        let files = document.getElementById("images").files;
        let data = new FormData();

        for (let i = 0; i < files.length; i++) {
          data.append("file" + i, files[i]);
        }

        $.ajax({
          url: "testUpload.php",
          type: "POST",
          contentType: false,
          processData: false,
          cache: false,
          data: data
        }).done(function(msg) {
          $("#output").append(msg);
        });
      }
    </script>
  </head>
  <body>
    <form onsubmit = "upload(); return false;">
      <input type = "file" accept = "image/*" name = "images" id = "images" multiple><br>
      <input type = "submit" value = "Finish">
    </form>
    <div id = "output"></div>
  </body>
</html>