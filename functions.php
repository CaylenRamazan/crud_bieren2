<?php

include_once "config.php";

 function connectDb(){
    $servername = SERVERNAME;
    $username = USERNAME;
    $password = PASSWORD;
    $dbname = DATABASE;
   
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

 }

 
 function getData($table){
    
    $conn = connectDb();

    
    $sql = "SELECT * FROM $table";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

    return $result;
 }

 
 function getFiets($brouwcode){
    
    $conn = connectDb();

    
    $sql = "SELECT * FROM " . CRUD_TABLE . " WHERE brouwcode = :brouwcode";
    $query = $conn->prepare($sql);
    $query->execute([':brouwcode'=>$brouwcode]);
    $result = $query->fetch();

    return $result;
 }


 function ovzFietsen(){
    $result = getData(CRUD_TABLE);
    printTable($result);
    
 }

 

function printTable($result){
   
    $table = "<table>";
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";   
    }

    foreach ($result as $row) {
        
        $table .= "<tr>";
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";
        }
        $table .= "</tr>";
    }
    $table.= "</table>";

    echo $table;
}


function crudFietsen(){

    $txt = "
    <h1>Crud bieren</h1>
    <nav>
		<a href='insert_brouwer.php'>Toevoegen nieuwe bier</a>
    </nav><br>";
    echo $txt;
 
    $result = getData(CRUD_TABLE);

    printCrudFiets($result);
    
 }

function printCrudFiets($result){
    $table = "<table>";

    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";   
    }
    
    $table .= "<th colspan=2>Actie</th>";
    $table .= "</th>";

    foreach ($result as $row) {
        
        $table .= "<tr>";
       
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";  
        }
        
        
        $table .= "<td>
            <form method='post' action='update_brouwer.php?brouwcode=$row[brouwcode]' >       
                <button>Wzg</button>	 
            </form></td>";

        
        $table .= "<td>
            <form method='post' action='delete_brouwer.php?brouwcode=$row[brouwcode]' >       
                <button>Verwijder</button>	 
            </form></td>";

        $table .= "</tr>";
    }
    $table.= "</table>";

    echo $table;
}


function updateFiets($row){

    $conn = connectDb();

    $sql = "UPDATE " . CRUD_TABLE .
    " SET 
        land = :land, 
        naam = :naam
    WHERE brouwcode = :brouwcode
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':naam'=>$row['naam'],
        ':land'=>$row['land'],
        ':brouwcode'=>$row['brouwcode']
    ]);

    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}

function insertFiets($post){
    
    $conn = connectDb();

    $sql = "
        INSERT INTO " . CRUD_TABLE . " (naam, land)
        VALUES (:naam, :land) 
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':naam'=>$_POST['naam'],
        ':land'=>$_POST['land'],
    ]);

    
    
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;  
}

function deleteFiets($brouwcode){

    $conn = connectDb();
    
    $sql = "
    DELETE FROM " . CRUD_TABLE . 
    " WHERE brouwcode = :brouwcode";

    
    $stmt = $conn->prepare($sql);

   
    $stmt->execute([
    ':brouwcode'=>$_GET['brouwcode']
    ]);

    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}


?>