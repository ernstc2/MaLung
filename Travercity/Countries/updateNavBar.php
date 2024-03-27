<?php
    $servername = "localhost";
    $username = "root";
    $password = "MyNewPass";
    $dbname = "WebSys";
    $urlWithoutQuestionMark = getURLNoQuestionMark()."index.php?country=";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['country'])) {
            $param1Value = removeEscapeCharacters($_GET['country']);
            $urlWithoutQuestionMark = $urlWithoutQuestionMark.$param1Value;
        } else {
            return;
        }
        $countryIDOfRelevance = getCountryIDOfImportance($conn, $param1Value)['ID'];

        $tableName = "activities";
        // $sql = "SELECT * FROM $tableName WHERE `country_id` = '$countryIDOfRelevance' AND `activity_type` IN (SELECT DISTINCT `activity_type` FROM $tableName);";
        $sql = "SELECT DISTINCT `activity_type` FROM $tableName WHERE `country_id` = '$countryIDOfRelevance';";
        $result = $conn->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            echo '<div class="navbar">';

            $url = $urlWithoutQuestionMark;
            echo "<a href=\"".$url."\">Home</a>";
            while($row = $result->fetch()) {
                if ($row['activity_type'] == "Home") { continue; }
                $text = $row['activity_type'];
                $url = $urlWithoutQuestionMark."&type=".$text;                
                echo "<a href=\"".$url."\">".$text."</a>";
            }
            $text = "&type=Blog";
            $url = $urlWithoutQuestionMark.$text;                
            echo "<a href=\"".$url."\">"."Blog"."</a>";

            echo '</div>';
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>