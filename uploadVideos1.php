<?php

error_reporting(1);

$con=mysql_connect("localhost","root","");

mysql_select_db("demo",$con);

extract($_POST);

$target_dir = "test_upload/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

 // Check file size -- Kept for 500Mb
 if ($_FILES["fileToUpload"]["size"] > 500000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }
	
if($upd)
{
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg")
{
    echo "File Format Not Suppoted";
} 

else
{

$vidname=$_FILES['fileToUpload']['name'] . "";
$vidsize=$_FILES['fileToUpload']['size'] . "";
$vidtype=$_FILES['fileToUpload']['type'] . "";

mysql_query("insert into video1(name,size,type) values('$vidname','$vidsize','$vidtype')");

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file);

echo "uploaded ";

}

}

//display all uploaded video

if($disp)

{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demo";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    else

    //============================= DATABASE CONNECTIVITY u ====================
    //============================= Retrieve data from DB d ====================
    $sql = "SELECT name, size, type FROM video1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
        {
        $path = "uploaded/" . $row["name"];

            echo $path . "<br>";

        }
    } else {
        echo "0 results";
    }
    $conn->close();
 } ?>
	
	
<form method="post" enctype="multipart/form-data">

<table border="1">

<tr>

<Td>Upload  Video</td></tr>

<Tr><td><input type="file" name="fileToUpload"/></td></tr>

<tr><td>

<input type="submit" value="Uplaod Video" name="upd"/>

<input type="submit" value="Display Video" name="disp"/>

</td></tr>

</table>

</form>	