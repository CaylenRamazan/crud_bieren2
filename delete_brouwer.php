<?php
include 'functions.php';

if(isset($_GET['brouwcode'])){

    
    if(deleteFiets($_GET['brouwcode']) == true){
        echo '<script>alert("Fietscode: ' . $_GET['brouwcode'] . ' is verwijderd")</script>';
        echo "<script> location.replace('crud_brouwer.php'); </script>";
    } else {
        echo '<script>alert("Bier is NIET verwijderd")</script>';
    }
}
?>

