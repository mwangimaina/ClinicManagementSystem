<?php
  session_start();
  //check if there is a session
  if (isset($_SESSION['username'])) {
    //pull it out
      $username = $_SESSION['username'];
      echo "Welcome : $username";
      echo "<a href='logout.php'>Logout</a>";
  }
  //if session not set
  else if (!isset($_SESSION['username'])) {
   header("location: login.php");
   exit();// kill
  }

  else {
      header("location: login.php");
      exit(); //kill
  }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

</head>
<body>
      <center>
     <h1>Clinic Management</h1>
      <p>Better Health Care</p>
      <a href="addpatient.php">Add Patient</a>  /
      <a href="">Add Doctor</a>  /
      <a href="psearch.php">Search Patients</a>  /
      <a href="">Search Doctor</a>  /
      <a href="checkup.php">Patient CheckUp</a>  /
    </center>
     
  <h1>Search Patients</h1>
 <fieldset>
   <legend>Search Patients</legend>
    <form action="" method="POST">
    	<input type="text" name="patient_id" 
    	placeholder = "Enter ID">
    	<br><br>     
    	<input type="submit" value="Search Patient" class="btn btn-dark">
    </form>
</fieldset>
</body>
</html>

  <?php
    if (empty($_POST)) {
      exit();//quit if button is not clicked
    }

  $object = new PatientSearch($_POST['patient_id']);   
  $object->search();

  class PatientSearch{
        function  __construct($patient_id){
           $this->patient_id = $patient_id;          
        }//end
        function search(){
             $conn = mysqli_connect("localhost","root","","clinic_db");  
             $response = mysqli_query($conn, "SELECT * FROM table_patients 
             	WHERE patient_id = '$this->patient_id'");
             
             //count your response
              if (mysqli_num_rows($response) == 0) {
                      	echo "No Patient Found!. Try Again";
                      	exit();
                } 
               else {
               	//get all colms for the first row found
                  echo "<table border=1 width = 100% class='table table-dark'>";
                  while($colm = mysqli_fetch_array($response))
                  {
                  echo "<tr>";
                  echo "<td> $colm[0]  </td>";
                  echo "<td> $colm[1] </td>";
                  echo "<td> $colm[2] </td>";
                  echo "<td> $colm[3] </td> ";
                  echo "<td> $colm[4] </td>";
                  echo "<td> $colm[5] </td>";
                  echo "<td> $colm[6] </td>";
                  echo "<td> $colm[7] </td>";
                  echo "<td> $colm[8] </td>";
                  echo "</tr>";
               }//end while
               echo "</table>";
              //search 
               }//end else 
        } //end function search
  } //end   class PatientSearch
  ?>








