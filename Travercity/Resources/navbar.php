<?php
  $accountOptions = "<a href = '" . $pathToRoot . "Account'>Account Page</a> <a href = '#' onclick = 'logout()'>Logout</a>";
  if (!isset($_SESSION['id'])) {
    $accountOptions = "<a href = '" . $pathToRoot . "Account/Signin.php'>Sign In</a> <a href = '" . $pathToRoot . "Account/Signup.php'>Sign Up</a>";
  }
?>

<header>
  <div id = "Header_navClicker" onclick="showFullNavBar('#Header_NavBar');">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>

  <a href = "<?php echo($pathToRoot) ?>" id = "Header_OurNameAndLogo">
    <img alt="Website Logo" src="<?php echo($pathToRoot) ?>Resources/favicon.png">
    <h1> Travercity </h1>
  </section>

  <section id = "Header_OtherLinks">
    <a href="<?php echo($pathToRoot) ?>Countries"> <img alt="Search page link" src="<?php echo($pathToRoot) ?>Resources/Images/Search.png"> </a>
    <a href="<?php echo($pathToRoot) ?>Help"> <img alt="Help page link" src="<?php echo($pathToRoot) ?>Resources/Images/Help.png"> </a>
    <img alt="Account page link" onclick="showFullNavBar('#Header_NavBar_Account');" src="<?php echo($pathToRoot) ?>Resources/Images/Account.png">
  </section>
</header>

<nav id = "Header_NavBar">
  <a href = "<?php echo($pathToRoot) ?>"> Home </a>
  <a href = "<?php echo($pathToRoot) ?>Account"> Account </a>
  <a href = "<?php echo($pathToRoot) ?>Help"> Help </a>
  <a href = "<?php echo($pathToRoot) ?>Countries"> Countries </a>
</nav>

<nav id = "Header_NavBar_Account">
  <?php echo $accountOptions ?>
</nav>