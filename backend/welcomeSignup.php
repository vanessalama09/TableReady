
<?php
// connects to the database to welcome the user who just signed up
// this code helps setup the dashboard and redirect the user to it
include 'dbConnection.php';
session_start();
$sql = "SELECT * from restaurant_info where username='".$_SESSION['username']."' limit 1";
$result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){
        echo "Logged in";
        $row = mysqli_fetch_assoc($result);
        $id = $row["restaurant_ID"];
        $_SESSION['restaurant_ID'] = $id;
        $_SESSION['role']= "owner";
        $insert_MondayHours = "INSERT INTO operation_hours (restaurant_ID, week_day) "
        . "VALUES ('$id', 'Monday')";
        $monResult = mysqli_query($conn, $insert_MondayHours);

        $insert_TuesdayHours = "INSERT INTO operation_hours (restaurant_ID, week_day) "
        . "VALUES ('$id', 'Tuesday')";
        $tueResult = mysqli_query($conn, $insert_TuesdayHours);

        $insert_WednesdayHours = "INSERT INTO operation_hours (restaurant_ID, week_day) "
        . "VALUES ('$id', 'Wednesday')";
        $wedResult = mysqli_query($conn, $insert_WednesdayHours);

        $insert_ThursdayHours = "INSERT INTO operation_hours (restaurant_ID, week_day) "
        . "VALUES ('$id', 'Thursday')";
        $thursResult = mysqli_query($conn, $insert_ThursdayHours);

        $insert_FridayHours = "INSERT INTO operation_hours (restaurant_ID, week_day) "
        . "VALUES ('$id', 'Friday')";
        $friResult = mysqli_query($conn, $insert_FridayHours);

        $insert_SaturdayHours = "INSERT INTO operation_hours (restaurant_ID, week_day) "
        . "VALUES ('$id', 'Saturday')";
        $satResult = mysqli_query($conn, $insert_SaturdayHours);

        $insert_SundayHours = "INSERT INTO operation_hours (restaurant_ID, week_day) "
        . "VALUES ('$id', 'Sunday')";
        $sunResult = mysqli_query($conn, $insert_SundayHours);
        header("location: ../frontend/dashboard.php");
    }
    else{
        echo "Restaurant is not found";
        exit();
    }

?>
