<?php 

session_start();

$mysqli = new mysqli('localhost','root','','crud') or die (mysqli_error($mysqli)); 

//Setting the default value to 0
$id = 0;

// Incase the edit button is not pressed these values will be initialized 
$name = "";
$location = "";
$update = false;

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
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location: index.php");
        exit;
    }
    
    }


    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $mysqli-> query("DELETE FROM data WHERE id=$id") or die ($mysqli-> error());
        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";
        header("location: index.php");
    }

    if(isset($_GET['edit'])){
        $update = true; // this value will be true if the edit button is clicked
        $id = $_GET['edit'];
        $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die ($mysqli->error());
        
        if(count(array($result)) == 1){
            
            $row = $result->fetch_array();
            $name = $row['name'];
            $location = $row['location'];
        }
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $location = $_POST['location'];

        $mysqli->query("UPDATE data SET name = '$name' , location = '$location' WHERE id = '$id' ") or die($mysqli->error());

        $_SESSION['message'] = "Record updated!";
        $_SESSION['msg_type'] = "warning";
        
        header('location: index.php'); //redirecting to the index page

    }

?>