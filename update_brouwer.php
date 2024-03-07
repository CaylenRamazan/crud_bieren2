<?php
   
    require_once('functions.php');

  
    if(isset($_POST['btn_wzg'])){

        if(updateFiets($_POST) == true){
            echo "<script>alert('Bier is gewijzigd')</script>";
        } else {
            echo '<script>alert("Bier is NIET gewijzigd")</script>';
        }
    }

    if(isset($_GET['brouwcode'])){  
        $id = $_GET['brouwcode'];
        $row = getFiets($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig Bier</title>
</head>
<body>
  <h2>Wijzig bier</h2>
  <form method="post">
    
    <input type="hidden" id="brouwcode" name="brouwcode" required value="<?php echo $row['brouwcode']; ?>"><br>
    <label for="naam">Naam:</label>
    <input type="text" id="naam" name="naam" required value="<?php echo $row['naam']; ?>"><br>

    <label for="land">Type:</label>
    <input type="text" id="land" name="land" required value="<?php echo $row['land']; ?>"><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='crud_brouwer.php'>Home</a>
</body>
</html>

<?php
    } else {
        "Geen brouwcode opgegeven<br>";
    }
?>