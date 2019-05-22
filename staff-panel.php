<?php
//starting session in order to access patient details
session_start();
include 'head.php';
echo 'Hi! Welcome to the staff panel';

?>
<html>
<body>
  <div class="container">
  <header>
    <h1>Welcome, <?php /* $_SESSION['fullname'];*/?> NAME </h1>
  </header>
  <?php include 'staffnav.php'; ?>

<!-- the content -->
<article>
  <h1>Profile Overview</h1>
  <p>Using the left panel you can manage leave ad patient appoinements. If you need any help you can contact us.</p>
  <p>Health Tip of the Day: <?php /* echo $healthtip */?></p>
</article>


<?php include 'footer.php'; ?>
</div>
</body>
</html>
