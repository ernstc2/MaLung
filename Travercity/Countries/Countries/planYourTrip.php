<?php 
  $pathToRoot = "../";
  $PageName = "Countries"
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
  </head>

  <body>
    <?php include($pathToRoot . "Resources/navbar.php") ?>

    <div class="navbar">
      <a href="index.php">Home</a>
      <a href="#safety">Safety</a>
      <a href="#weather">Weather</a>
      <a href="#accommodation">Accommodation</a>
    </div>


    <img src="rodney-bay-saint-lucia.webp" alt="Saint Lucia Caribbean Island">

    <section class = "InformationBox" id="safety">
        <h2>SAFETY</h2>
        <p>Saint Lucia is paradise for novice and experienced divers alike. There are dozens of top-notch dive spots to explore the vibrant Caribbean waters. Snorkelers and free divers can swim with sea turtles in the shallows, while divers can explore reefs around the island.</p>
        <button class="learn-more">Learn More</button>
    </section>

    <section class = "InformationBox" id="weather">
        <h2>WEATHER</h2>
        <p>Food is an essential part of Caribbean culture. From high-end restaurants led by professional chefs to home cooks hiding their secret recipes, the Saint Lucia cuisine is what sets this island apart from the rest. For the culturally adventurous, make sure you add some Baron’s West Indian Hot Sauce to your meal to give it that extra kick!</p>
        <button class="learn-more">Learn More</button>
    </section>

    <section class = "InformationBox" id="accommodation">
        <h2>Accommodation</h2>
        <p>Taking a vacation doesn’t mean giving up your health routine! There are plenty of opportunities to stay fit on the island, from daily excursions to high-end gym facilities. Sign up for a sunrise yoga class to stretch on the beach, or head out rock climbing for a challenging full-body workout.</p>
        <p>Visitors will also appreciate the restorative properties of wellness on Saint Lucia. The island offers a variety of spa options and retreats to relax and recharge. From couples massages to mud baths, you will feel like a new person when you return home.</p>
        <button class="learn-more">Learn More</button>
    </section>


    <?php include($pathToRoot . "Resources/footer.php") ?>
  </body>
</html>