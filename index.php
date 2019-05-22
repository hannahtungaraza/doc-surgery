<!DOCTYPE html>
<html>
<body>
<div class="container">
<?php
//Appointment system
//Hannah Tungaraza 26th Jan 2018
session_start();
include 'head.php';

//making a DB connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aboutcare_v1";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "<p style='display:none'>Connected successfully</p>";


//saving signup details to DB
//staff
if (isset($_POST['submitStaff'])) {
  //first get & set variables
  $fullname = $_POST["fullnameStaff"];
  $password = $_POST["passwordStaff"];
  $phonenum = $_POST["phoneStaff"];
  $emailaddress = $_POST["emailStaff"];
  $login = "1010" . rand(10,90);

  //then insert into DB
  $sql = "INSERT INTO staff (fullname, pword, phonenum, email, login)
  VALUES ('$fullname', '$password', '$phonenum', '$emailaddress', '$login')";
  if ($conn->query($sql) === TRUE) {
    echo "Thank you for signing up with About Care!";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
//paient
else if (isset($_POST['submitPatient'])) {
  //first get & set variables
  $fullname = $_POST["fullnamePatient"];
  $password = $_POST["passwordPatient"];
  $dob = date($_POST["dateofbirthPatient"]);
  $emailaddress = $_POST["emailPatient"];
  $login = "1010" . rand(10,90);

  //then insert into DB
  $sql = "INSERT INTO patient (fullname, pword, dob, email, login)
  VALUES ('$fullname', '$password', '$dob' , '$emailaddress', '$login')";
  if ($conn->query($sql) === TRUE) {
    echo "Thank you for signing up with About Care!";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}




echo '<h1>Welcome to the About Care system!</h1>';
echo 'Registered staff and patients can login below:';
echo '
  <form action="" method="post">
  ID: <input type="text" name="login" class="signin id"><br>
  Password: <input type="password" name="password" class="signin password"><br>
  <input type="submit" name="submitLogin">
  </form>
';

//validating login
if (isset($_POST["submitLogin"])) {

  //verifcation only happens if username and password are NOT empty
  if (!empty($_POST["login"]) && !empty($_POST["password"])) {

    //get & set variables to verify
    $loginid = $_POST['login'];
    $loginpassword = $_POST['password'];

    //need to finalise verifcation with DB
    $result = $conn->query("SELECT * from staff login WHERE login = '$loginid' union all SELECT * from patient login WHERE login = '$loginid'");
    if ($result->num_rows == 0) {

      echo '<p>User with that login does not exist!</p>';
    }
    else {
      $user = $result->fetch_assoc();

      // echo '<pre>';
      // print_r($user);
      // echo '</pre>';
      // die('hi');
      if ($loginpassword == $user['pword']) {

        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['phone'] = $user['phonenum'];

        //setting a session for the user
        $_SESSION['logged_in'] = true;

        if ($user['role'] == "staff") {
          header("location: staff-panel.php");
        }
        else{
          header("location: patient-panel.php");
        }
      }
      else {
        echo '<p>You have entered the incorrect password, please try again.</p>';
      }
    }

  }
  else {
    echo"<p style='color:red;'>Please fill in both username and password!</p>";
  }
}
?>
  <!-- registee modal with a button -->
  <p>Not registered with us?</p>
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#register">Register now!</button>



<!-- Modal -->
<div class="modal fade" id="register" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">First, please enter a few details</h4>
      </div>
      <div class="modal-body">
          <label for="db">Choose type</label>
          <select name="dbType" id="dbType">
             <option>Which are you?</option>
             <option value="staff">Staff</option>
             <option value="patient">Patient</option>

          </select>

          <div id="staffReg" style="display:none;">
          <form name="staffSignup" id="staffSignup" method="post" action="">
           Full name:<br>
            <input type="text" name="fullnameStaff" >
            <br>
            Chose a password: <br>
            <input type="password" name="passwordStaff" >
            <br>
            Retype your password: <br>
            <input type="password" name="password" >
            <br>
            Enter your phone number: <br>
            <input type="tel" name="phoneStaff">
            <br>
            Enter your email address: <br>
            <input type="email" name="emailStaff" >
            <br>
            <input type="submit" value="Submit" name="submitStaff">
            </form>
          </div>



          <div id="patientReg" style="display:none;">
          <form name="patientSignup" id="patientSignup" method="post">
           Full name:<br>
            <input type="text" name="fullnamePatient" value="">
            <br>
             Date of birth:<br>
            <input type="date" name="dateofbirthPatient" value="">
            <br>
            Chose a password: <br>
            <input type="password" name="passwordPatient" value="">
            <br>
            Retype your password: <br>
            <input type="password" name="password" value="">
            <br>
            Enter your email address: <br>
            <input type="email" name="emailPatient" value="">
            <br>
            <input type="submit" value="Submit" name="submitPatient">
            </form>
          </div>
          <script>
          $('#dbType').on('change',function(){
            if( $(this).val()==="staff"){$("#staffReg").show()}
            else{$("#staffReg").hide()}
            if( $(this).val()==="patient"){$("#patientReg").show()}
            else{$("#patientReg").hide()}
            });
          </script>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>



  </div>
</div>
</div>
</body>
</html>
