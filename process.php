<?php 

$mysqli = new mysqli('localhost','root','','crud') or die (mysqli_error($mysqli)); 

if(isset($_POST['save'])){
    
    $name = $_POST['name'];
    $location = $_POST['location'];
    
    if(empty($name)){
        echo "Name field is empty";
    }
    else if (empty($location)){
        echo "Location field is empty";
    }else{

        $mysqli->query("INSERT INTO data (name, location) VALUES ('$name','$location')") or
        die($mysqli->error);
        header("location: index.php");
        exit;
    }
    
}

?>