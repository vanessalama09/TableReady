
<?php
// connects to database, redirects user to dashboard upon logging in
include 'dbConnection.php';
session_start();
$sql = "SELECT * from restaurant_info where username='".$_SESSION['username']."' limit 1";
$result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){
        echo "Logged in";
        $row = mysqli_fetch_assoc($result);
        $id = $row["restaurant_ID"];
        $_SESSION['restaurant_ID'] = $id;
        header("location: ../frontend/dashboard.php");
    }
    else{
        echo "Restaurant is not found";
        exit();
    }

?>
