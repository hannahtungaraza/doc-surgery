<?php
//starting session in order to access patient details
session_start();
include 'head.php';
echo 'Hi! Welcome to patient management';
?>


<div class="container">

  <h1>Use the form below to add a new patient: </h1>
  <form action="/action_page.php">
    <input type="text" name="firstname" placeholder="First Name">
    <br><br>
    <input type="text" name="lastname" placeholder="Last Name">
    <br><br>
    <input type="date" name="dateofbirth" placeholder="Date of Birth">
    <br><br>
    <textarea name="notes" rows="5">Additional Notes </textarea>
    <br><br>
    <input type="submit" value="Submit">
  </form>
</div>
