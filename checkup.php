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
	<title>Add Patient</title>
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

    <h1>Patient CheckUp</h1> 
   <fieldset>
   <legend>Patient Details</legend>
    <form action="" method="POST">
    	<input type="text" name="surname" 
    	placeholder = "Enter Surname">
    	<br><br>

    	<input type="text" name="fname" 
    	placeholder = "Enter Firstname">
    	<br><br>

    	<input type="text" name="lname" 
    	placeholder = "Enter Last Name">
    	<br><br>

    	<input type="tel" name="phone" 
    	placeholder = "Enter Phone">
    	<br><br>

    	<input type="text" name="residence" 
    	placeholder = "Enter  Residence ">
    	<br><br>

    	<input type="text" name="patient_id" 
    	placeholder = "Enter  Patient Identity No ">
    	<br><br>

    	<label>Select Gender</label>
        <input type="radio" name="gender" value="Male">  Male
        <input type="radio" name="gender" value="Female">  Female
        <br><br>

         <input type="email" name="email" 
    	placeholder = "Enter  Email ">
    	<br><br>         

    	<input type="submit" value="Save Patient">
    </form>
</fieldset>
</body>
</html>


<?php
     //This is the Logic: provide the constructor with form values
  if (empty($_POST)) {
    exit(); //quit executing PHP code until, Form Button 
    //is clicked
  }

    $object = new Patient($_POST['surname'],
    	                  $_POST['fname'],
    	                  $_POST['lname'],
    	                  $_POST['phone'],
    	                  $_POST['residence'],
    	                  $_POST['patient_id'],
    	                  $_POST['gender'],
     	                  $_POST['email']);
       $object->save(); # trigger save function


 class Patient{
      function __construct($surname,$fname, $lname,$phone,
      	$residence, $patient_id, $gender, $email){
 
         $this->surname = $surname;
         $this->fname = $fname;
         $this->lname = $lname;
         $this->phone = $phone;
         $this->residence = $residence;
         $this->patient_id = $patient_id;
         $this->gender = $gender;
         $this->email = $email;
      }//end
     
      function save(){
      	  //connect to your database
          $conn = mysqli_connect("localhost","root","","clinic_db");  
          //save to table
          $response = mysqli_query($conn, "INSERT INTO `table_patients`
          	(`surname`, `fname`, `lname`, `phone`, `residence`, 
          		`patient_id`, `gender`, `email`) 
          VALUES ('$this->surname','$this->fname','$this->lname',
          	'$this->phone','$this->residence','$this->patient_id',
          	'$this->gender','$this->email')");    

           //testing the response
           if ($response==true) {
             echo "Sucessfully Saved Record";
           }

           else {
            echo "Record Failed. Check Your Details ";
           }
      }//end

 }

?>






