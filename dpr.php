<?php
//drp.php
$servername = "localhost";
$username = "shriram";
$password = "shriramDB";
$myDb = "shriramEntDb";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if($_GET["operation"] && $_GET["operation"] == "getAllDpr"){
		$conn = createConnection($servername, $username, $password, $myDb);
		$data = getData($conn);
		closeConnection($conn);
		echo $data;
		return $data;
	}
	if($_GET["operation"] && $_GET["operation"] == "deleteDpr"){
		
		if($_GET["passcode"] === "1235"){
			$id = $_GET["id"];
			$conn = createConnection($servername, $username, $password, $myDb);
			deleteDpr($id, $conn);
			closeConnection($conn);		
		}else{
			echo "Please enter correct passcode to delete.";
		}	
		
	}
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	echo $_POST['projectLocation'];
	if($_POST["operation"] && $_POST["operation"] == "addDpr"){
		$projectLocation = $_POST["projectLocation"];
		$datetimepickerIn = $_POST["datetimepickerIn"]; 
		$datetimepickerOut = $_POST["datetimepickerOut"];
		$description = $_POST["description"]; 
		$measurement = $_POST["measurement"];
		$supervisor = $_POST["supervisor"];
		$fitter = $_POST["fitter"];
		$welder = $_POST["welder"];
		$helper = $_POST["helper"];
		$rigger = $_POST["rigger"];
		$electrician = $_POST["electrician"];
		$remarks = $_POST["remarks"];
		$conn = createConnection($servername, $username, $password, $myDb);
		if($_POST["id"] && $_POST["id"] != ""){
			updateData($projectLocation, $datetimepickerIn, $datetimepickerOut, $description, $measurement, $supervisor, $fitter, $welder, $helper, $rigger, $electrician, $remarks, $conn, $_POST["id"]);
		}else{
			insertData($projectLocation, $datetimepickerIn, $datetimepickerOut, $description, $measurement, $supervisor, $fitter, $welder, $helper, $rigger, $electrician, $remarks, $conn);
		}
		closeConnection($conn);
		
	}
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

function insertData($projectLocation, $datetimepickerIn, $datetimepickerOut, $description, $measurement, $supervisor, $fitter, $welder, $helper, $rigger, $electrician, $remarks, $conn){

	$sql = "INSERT INTO dpr (location, timingIn, timingOut, description, measurement, supervisor, fitter, welder, helper, rigger, electrician, remarks) VALUES ('$projectLocation', '$datetimepickerIn', '$datetimepickerOut', '$description', '$measurement', '$supervisor', '$fitter', '$welder', '$helper', '$rigger', '$electrician', '$remarks')";
	echo $sql;
	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Insert Error: " . $sql . "<br>" . $conn->error;
	}
}

function updateData($location, $timingIn, $timingOut, $description, $measurement, $supervisor, $fitter, $welder, $helper, $rigger, $electrician, $remarks, $conn, $id){

	$sql = "UPDATE dpr SET location = '$location', timingIn = '$timingIn', timingOut = '$timingOut', description = '$description', measurement = '$measurement', supervisor = '$supervisor', fitter = '$fitter', welder = $welder, helper = $helper, rigger = $rigger, electrician = $electrician, remarks = '$remarks'  WHERE id=".$id;
	echo $sql;
	if ($conn->query($sql) === TRUE) {
	    echo "Record updated successfully";
	} else {
	    echo "update Error updating record: " . $conn->error;
	}
		
}


function getData($conn){

	$sql = "SELECT * FROM dpr";
	$result = mysqli_query($conn,$sql);
	$rows = array();
	while($r = mysqli_fetch_array($result)) {
        	$rows[] = $r;
  	}
  	return json_encode($rows);
}

function getDataById($id, $conn){
	$sql = "SELECT * FROM dpr WHERE id=".$id;
	$result = mysqli_query($conn,$sql);
	$rows = array();
	while($r = mysqli_fetch_array($result)) {
        	$rows[] = $r;
  	}
  	return json_encode($rows);
}

function deleteDpr($id, $conn){
	$sql = "DELETE FROM dpr WHERE id=".$id;

	if ($conn->query($sql) === TRUE) {
	    echo "Record deleted successfully";
	} else {
	    echo "Error deleting record: " . $conn->error;
	}
}