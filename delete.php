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

<?php
     
     if (empty($_GET)) {
     	 header("location: psearch.php"); //redirect user
     }
     //Receive the patient_id
     $patient_id = $_GET['patient_id'];
     //use it in deletion query
       $conn = mysqli_connect("localhost","root","","clinic_db");  
       $response = mysqli_query($conn, "DELETE FROM table_patients 
              	WHERE patient_id = '$patient_id'");
       
       if ($response==true) {
          echo "$patient_id has been removed";
          echo "<a href ='psearch.php'>Back</a>";
        } 

        else {
        	echo "$patient_id has not been removed";
        	 echo "<a href ='psearch.php'>Back</a>";
        }
  
?>