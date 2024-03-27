<?php
    function getURLNoQuestionMark() {
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $i = strpos($url, "Countries/");
        if ($i) {
            $url = substr($url, 0, $i + strlen("Countries/"));
        }

        return $url;
    }
    function getURLNoQuestionMarkBlogs() {
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        for ($i = 0; $i < strlen($url); $i++) {
            if ($url[$i] == "?") {
                $url = substr($url, 0, $i-9);
                break;
            }
        }
        return $url;
    }
    function showSearchBar($search = "") {
        $moveToTop = "";
        if ($search != "") {
            $moveToTop = 'style="margin-top: 5%;"';
        }
        echo '<h1 id="searchText"'.$moveToTop.'>Travercity</h1>';
        echo '<form>';
        echo '<input type="text" id="searchBar" name="search" placeholder="Type a country\'s name"></input>';
        echo '</form>';


        if ($search == "") { return; }

        

        $servername = "localhost";
        $username = "root";
        $password = "MyNewPass";
        $dbname = "WebSys";
        $urlWithoutQuestionMark = getURLNoQuestionMark()."index.php?country="; //update this line
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM `countries` WHERE name LIKE :name";
            $result = $conn->prepare($sql);
            $result->execute(array(":name" => "%" . $search . "%"));
            
            if ($result->rowCount() > 0) {
                echo '<div id="ResultsOfSearch">';
                while($row = $result->fetch()) {
                    $filename = $row['FlagImage'];
                    $fileContents = "flags/" . $filename;
                    $countryName = $row['name'];
                    echo '<img alt="'.$countryName.'\'s flag" src="'.$fileContents.'">';
                    echo '<a href="'.$urlWithoutQuestionMark.$countryName.'"> '.$countryName.' </a>';
                }
                echo '</div>';
            } else {
                echo '<div id="noCountryFound">No country found for your search.</div>';
            }
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function getCountryIDOfImportance($conn, $countryInUrl) {
        $tableName = "countries";
        $sql = "SELECT * FROM $tableName WHERE `name` = :name";
        $result = $conn->prepare($sql);
        $result->execute(array(":name" => $countryInUrl));
        $fetched = NULL;
        if ($result->rowCount() == 0) {
            $countryIDOfRelevance = NULL;
            echo "No country found";
            return;
        }
        return $result->fetch();
    }

    //$showAll will decide whether or not to go into the database and display country info from there (this is needed for specific pages in Things To Do)
    function showCountryInformation($type = "", $showAll = true) {
        $servername = "localhost";
        $username = "root";
        $password = "MyNewPass";
        $dbname = "WebSys";
        
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            if (isset($_GET['country'])) {
                $param1Value = removeEscapeCharacters($_GET['country']);
            } else {
                die("country is not set in the URL.<br>");
            }

            $fetched = getCountryIDOfImportance($conn, $param1Value);
            $countryIDOfRelevance = $fetched['ID'];

            if (!isset($_GET['type'])) {
                echo '<img id="banner-image" src="banner/'.$fetched['bannerImage'].'" alt="' . $param1Value . '\'s banner">';
            } else {
                if (removeEscapeCharacters($_GET['type']) != "News") {
                    echo '<img id="banner-image" src="banner/'.$fetched['bannerImage'].'" alt="' . $param1Value . '\'s banner">';
                }
            }
            
            if ($showAll) {
                $tableName = "activities";
                if (isset($_GET['type'])) {
                    $sql = "SELECT * FROM $tableName WHERE `country_id` = '$countryIDOfRelevance' AND `activity_type` = :type";
                    $result = $conn->prepare($sql);
                    $result->execute(array(":type" => removeEscapeCharacters($_GET['type'])));
                } else {
                    $sql = "SELECT * FROM $tableName WHERE `country_id` = '$countryIDOfRelevance' AND (`activity_type` = 'Explore Country' OR `activity_type` = 'Home')"; //if we aren't having uniform home pages for each country for some reason, add a column to the countries table called home_page and put a file name where the default info is taken from
                    $result = $conn->query($sql);
                }
                if ($result->rowCount() > 0) {
                    while($row = $result->fetch()) {
                        $filename = $row['filename'] . ".html";
                        $fileContents = file_get_contents("Info/" . $filename);
                        echo $fileContents;
                    }
                }
            }

            $conn = null;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function removeEscapeCharacters($text) {
        for ($i = 0; $i < strlen($text); $i++) {
            $x = $text[$i];
            if ($x == '`' || $x == '\'' || $x == '"' || $x == ':' || $x == ';' ||
            $x == '(' || $x == ')' || $x == '[' || $x == ']' || $x == '{' || $x == '}' ||
            $x == '\\' || $x == '|' || $x == '<' || $x == '>' || $x == '/' || $x == '!') {
                $text = substr($text, 0, $i) . substr($text, $i + 1);
            }
        }
        return $text;
    }
?>
