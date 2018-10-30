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

</body>
</html>

  <?php

  $object = new PatientSearch();   
  $object->search();

  class PatientSearch{
        function  __construct(){          
        }//end
        function search(){
             $conn = mysqli_connect("localhost","root","","clinic_db");  
             $response = mysqli_query($conn, "SELECT * FROM table_patients 
             	");
             
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
                  echo "<td> $colm[7] </td>";
                  echo "<td> $colm[8] </td>";

                  echo "<td>  <a href ='delete.php?patient_id=$colm[5]' 
                  class='btn btn-danger'>DELETE</a> </td>";
                  
                  echo "<td>  <a href ='' class='btn btn-info'>ALLOCATE</a> </td>";
                  echo "</tr>";
               }//end while
               echo "</table>";
              //search 
               }//end else 
        } //end function search
  } //end   class PatientSearch
  ?>








