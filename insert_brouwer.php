<?php

    echo "<h1>Insert Bier</h1>";

    require_once('functions.php');
	
    if(isset($_POST) && isset($_POST['btn_ins'])){

        if(insertFiets($_POST) == true){
            echo "<script>alert('Bier is toegevoegd')</script>";
        } else {
            echo '<script>alert("Bier is NIET toegevoegd")</script>';
        }
    }
?>
<html>
    <body>
        <form method="post">

        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" required><br>

        <label for="land">Land:</label>
        <input type="text" id="land" name="land" required><br>

        <input type="submit" name="btn_ins" value="Insert">
        </form>
        
        <br><br>
        <a href='crud_brouwer.php'>Home</a>
    </body>
</html>
