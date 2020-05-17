<?php
    $dbServername = " ";
    $dbUsername = " ";
    $dbPassword = " ";
    $dbName = " ";

    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
    if(!$conn){
        echo 'Connection error: '.mysqli_connect_error();
    }
    //$sql = 'SELECT * FROM owners_info WHERE Username="test123" limit 1';
    //$result = mysqli_query($conn, $sql);
    //$row = mysqli_fetch_assoc($result);

    //mysqli_free_result($result);
    //$name = $row["fName"];
    //echo $name;
    //mysqli_close($conn);
    
?>

