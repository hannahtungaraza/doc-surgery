<?php
//starting session in order to access patient details
session_start();


//checking session is set
if (isset ($_SESSION['fullname'])) {

  echo 'full name is set!';

}elseif (!isset ($_SESSION['fullname'])) {

  echo 'session is not set!';
}

include 'head.php';
echo 'Hi! Welcome to the patient panel';
?>
<html>
<body>
  <div class="container">
  <header>
    <h1>Welcome, <?php  $_SESSION['fullname'];?> NAME </h1>
  </header>
  <?php include 'patientnav.php'; ?>

<!-- the content -->
<article>
  <h1>Profile Overview</h1>
  <p>Using the left panel you can book, manage and cancel your appointments. If you need any help you can contact us.</p>
  <p>Health Tip of the Day: <?php /* echo $healthtip */?></p>
</article>


<?php include 'footer.php'; ?>
</div>
</body>
</html>
