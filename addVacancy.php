<?php
//addVacancy.php
$servername = "localhost";
$username = "shriram";
$password = "shriramDB";
$myDb = "shriramEntDb";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$con = createConnection($servername, $username, $password, $myDb);
	if($_GET["operation"]){
		$operation = $_GET["operation"];
		$id = $_GET["id"];
		if($operation === "delete"){
			deleteVacancy($id, $con);
		}elseif($operation === "getById"){
			$data = getDataById($id,$con);
			closeConnection($con);
			echo $data;
			return $data;	
		}elseif($operation === "getAllProfiles"){
			$data = getAllProfile($con);
			closeConnection($con);
			echo $data;
			return $data;
		}elseif($operation === "deleteProfile"){
			$fileName = $_GET["fileName"];
			$data = deleteProfile($con, $id, $fileName);
			closeConnection($con);
			echo $data;
			return $data;
		}else{
			echo "-----";
		}	
	}else{
		$data = getData($con);
		closeConnection($con);
		echo $data;
		return $data;			
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if($_POST["operation"] && $_POST["operation"]==="profileUpload"){
   	$firstName = $_POST["firstName"];
   	
   	$lastName = $_POST["lastName"];
   	$email = $_POST["email"];
   	$mobNum = $_POST["mobNumber"];
   	$profileFile = $_FILES['file']['tmp_name'];

   	$con = createConnection($servername, $username, $password, $myDb);
   	
   	$data = getProfileByEmail($con, $email);
	$someArray = json_decode($data, true);
	if(sizeof($someArray)==0){
		move_uploaded_file($_FILES['file']['tmp_name'],"resumes/".$_FILES['file']['name']);
	   	uploadProfileData($con, $firstName, $lastName, $email, $mobNum, $_FILES['file']['name']);
	}else{
		echo "profile ".$email." already exists in system.";
	}
   	
   	closeConnection($con);
   }
	
   $passcodeString = "1235";
   $title = filterInput($_POST["title"]);
   $city = filterInput($_POST["city"]);
   $description = filterInput($_POST["description"]);
   $skillSet = filterInput($_POST["skillSet"]);
   $workEx = filterInput($_POST["workEx"]);
   $salaryRange = filterInput($_POST["salaryRange"]);
   $jobType = filterInput($_POST["jobType"]);
   $passcode = filterInput($_POST["passcode"]);
  if($passcode === $passcodeString && $title!=="" && $city!=="" && $description!=="" && $skillSet!=="" && $workEx!=="" && $salaryRange!=="" && $jobType!==""){
	$con = createConnection($servername, $username, $password, $myDb);
	if($_POST["operation"] && $_POST["operation"]==="update"){
		$id = $_POST["id"];
		updateData($title, $city, $description, $skillSet, $workEx, $salaryRange, $jobType, $con, $id);
	}else{
		insertData($title, $city, $description, $skillSet, $workEx, $salaryRange, $jobType, $con);
	}
	
	closeConnection($con);
  }
  //header("Location: http://www.shrirament.com/addVacancyForm.php");
}

function filterInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return (string)$data;
}

function createConnection($servername, $username, $password, $myDb){
	$conn = new mysqli($servername, $username, $password, $myDb);
	// Check connection
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}
	return $conn;
}

function closeConnection($conn){
	$conn->close();
}

function insertData($title, $city, $description, $skillSet, $workEx, $salaryRange, $jobType, $conn){

	$createdTime = (string)date("Y-m-d H:i:s");
	$sql = "INSERT INTO Vacancies (title, city, description, skillSet, workEx, salaryRange, jobType, createdTime) VALUES ('$title', '$city', '$description', '$skillSet', '$workEx', '$salaryRange', '$jobType', '$createdTime')";
	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	    echo "<br><b><a href='http://www.shrirament.com/addVacancyForm.php'>Go Back</a><b>";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

function updateData($title, $city, $description, $skillSet, $workEx, $salaryRange, $jobType, $conn, $id){

	$sql = "UPDATE Vacancies SET title = '$title', city = '$city', description = '$description', skillSet = '$skillSet', workEx = '$workEx', salaryRange = '$salaryRange', jobType = '$jobType' WHERE id=".$id;

	if ($conn->query($sql) === TRUE) {
	    echo "Record updated successfully";
	} else {
	    echo "Error updating record: " . $conn->error;
	}
		
}


function getData($conn){

	$sql = "SELECT * FROM Vacancies";
	$result = mysqli_query($conn,$sql);
	$rows = array();
	while($r = mysqli_fetch_array($result)) {
        	$rows[] = $r;
  	}
  	return json_encode($rows);
}

function getDataById($id, $conn){
	$sql = "SELECT * FROM Vacancies WHERE id=".$id;
	$result = mysqli_query($conn,$sql);
	$rows = array();
	while($r = mysqli_fetch_array($result)) {
        	$rows[] = $r;
  	}
  	return json_encode($rows);
}

function deleteVacancy($id, $conn){
	$sql = "DELETE FROM Vacancies WHERE id=".$id;

	if ($conn->query($sql) === TRUE) {
	    echo "Record deleted successfully";
	} else {
	    echo "Error deleting record: " . $conn->error;
	}
}

function uploadProfileData($conn, $firstName, $lastName, $email, $mobNum, $profileFile){
	
	$sql = "INSERT INTO profileDetail (firstName, lastName, email, mobile, fileName) VALUES ('$firstName', '$lastName', '$email', '$mobNum', '$profileFile')";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
		echo "<br><b><a href='http://www.shrirament.com/addVacancyForm.php'>Go Back</a><b>";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

function getAllProfile($conn){
	$sql = "SELECT * FROM profileDetail";
	$result = mysqli_query($conn,$sql);
	$rows = array();
	while($r = mysqli_fetch_array($result)) {
        	$rows[] = $r;
  	}
  	return json_encode($rows);
}

function getProfileByEmail($conn, $email){
	$sql = "SELECT * FROM profileDetail WHERE email='$email'";
	$result = mysqli_query($conn,$sql);
	$rows = array();
	while($r = mysqli_fetch_array($result)) {
        	$rows[] = $r;
  	}
  	$data = json_encode($rows);
  	$jsonArray = json_decode($data, true);
  	return $jsonArray;
}

function deleteProfile($conn, $id, $fileName){
	unlink("resumes/".$fileName);
	$sql = "DELETE FROM profileDetail WHERE id=".$id;

	if ($conn->query($sql) === TRUE) {
	    echo "Record deleted successfully";
	} else {
	    echo "Error deleting record: " . $conn->error;
	}
}

?>