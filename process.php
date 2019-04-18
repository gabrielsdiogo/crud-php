<?php

session_start();

$mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
$name='';
$location='';
$button='Save';

if(isset($_POST['Save'])){
    $name=$_POST['name'];
    $location=$_POST['location'];
    if($name!="" && $location!=""){
        $mysqli->query("INSERT INTO data (name,location) VALUES ('$name','$location')") or die($mysqli->error);
        

        $_SESSION['message'] = "Record has been saved!!";
        $_SESSION['msg_type'] = "success";
        echo"<script>window.location.href = 'index.php';</script>";
    }

}

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);
    $_SESSION['message'] = "Record has been deleted!!";
    $_SESSION['msg_type'] = "danger";
    echo"<script>window.location.href = 'index.php';</script>";
}

if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $button='Update';
    $result=$mysqli->query("SELECT * FROM data WHERE id=$id");
    $row=$result->fetch_array();
    $id=$row['id'];
    $name=$row['name'];
    $location=$row['location'];
    


}

if(isset($_POST['Update'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $location=$_POST['location'];
    if($name!="" && $location!=""){
        $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or die($mysqli->error);
        

        $_SESSION['message'] = "Record has been updated!!";
        $_SESSION['msg_type'] = "success";
        echo"<script>window.location.href = 'index.php';</script>";
    }

}


?>