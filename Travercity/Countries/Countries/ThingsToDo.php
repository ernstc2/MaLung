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
    <a href="#diving">Diving</a>
    <a href="#eat-drink">Eat And Drink</a>
    <a href="#health-wellness">Health And Wellness</a>
    <a href="#nature-adventure">Nature And Adventure</a>
</div>

<img src="../banner/Lucia2.jpg" alt="Saint Lucia Caribbean Island">

<!-- Sections with content -->
<section class = "InformationBox" id="diving">
    <h2>DIVING</h2>
    <p>Saint Lucia is paradise for novice and experienced divers alike. There are dozens of top-notch dive spots to explore the vibrant Caribbean waters. Snorkelers and free divers can swim with sea turtles in the shallows, while divers can explore reefs around the island.</p>
    <button class="learn-more">Learn More</button>
</section>

<section class = "InformationBox" id="eat-drink">
    <h2>EAT AND DRINK</h2>
    <p>Food is an essential part of Caribbean culture. From high-end restaurants led by professional chefs to home cooks hiding their secret recipes, the Saint Lucia cuisine is what sets this island apart from the rest. For the culturally adventurous, make sure you add some Baron’s West Indian Hot Sauce to your meal to give it that extra kick!</p>
    <button class="learn-more">Learn More</button>
</section>

<section class = "InformationBox" id="health-wellness">
    <h2>HEALTH AND WELLNESS</h2>
    <p>Taking a vacation doesn’t mean giving up your health routine! There are plenty of opportunities to stay fit on the island, from daily excursions to high-end gym facilities. Sign up for a sunrise yoga class to stretch on the beach, or head out rock climbing for a challenging full-body workout.</p>
    <p>Visitors will also appreciate the restorative properties of wellness on Saint Lucia. The island offers a variety of spa options and retreats to relax and recharge. From couples massages to mud baths, you will feel like a new person when you return home.</p>
    <button class="learn-more">Learn More</button>
</section>

<section class = "InformationBox" id="nature-adventure">
    <h2>NATURE AND ADVENTURE</h2>
    <p>Most Saint Lucia activities are centered around nature. Depending on how adventurous you feel, you can hike through the rainforest, or zip through the canopy on an 800-foot zip line. You can snorkel in the shallows along the beach, or dive amongst tropical fish a few miles off shore. Find activities you feel comfortable with, or push yourself to experience a rush of adrenaline like no other!</p>
    <button class="learn-more">Learn More</button>
</section>

    <?php include($pathToRoot . "Resources/footer.php") ?>
  </body>
</html>