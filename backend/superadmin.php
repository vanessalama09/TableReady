<!DOCTYPE html>

<html>
    <head>
        <title>SuperAdmin Page</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            body{
                max-width: 100%;
            }
            h4{
                color: #9C1B1F;
            }
            #logo{
                position: relative;
                margin-left: 0%;
                float: left;
                width: 50%;
            }
            #welcome{
                font-size: calc(16px + 0.5vw);
                margin: auto;
                color: #9C1B1F;
            }
            tr{
                background-color: #e8bb7d;
                color: black;
                }
            th{
                background-color: #9C1B1F;
                border-right: 2px solid white;
                border-bottom: 2px solid white;
                color: white;
                font-family: Arial, Helvetica, sans-serif;
                font-size: calc(12px + 0.5vw);
            }
            td{
                border-right: 1px solid white;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 18px;
            }

            tr:nth-of-type(even){
                background-color: #f2e3ce;
                color: #9C1B1F;
            }

            #submit{
                background-color: #9C1B1F;
                color: white;
                border: none;
                font-size: calc(16px + 0.5vw);
                float: left;
                margin: auto;
                margin-top: 20%;
            }
        </style>
    </head>
    <body>

    <?php

include '../backend/dbConnection.php';
session_start();

/*if(isset($_POST['username'])){
    $username=$_POST['username'];
    $password = md5($_POST['password']);*/

    //this is form for posting a value to update the restaurant to be suspended
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $restaurant_ID = $_POST['restaurant_ID'];
        $update = "UPDATE restaurant_info SET suspended='1' WHERE restaurant_ID='".$restaurant_ID."' limit 1";
        if ($conn->query($update) === TRUE) {
            echo '<script language="javascript">';
            echo 'alert("Successful")';
            echo '</script>';
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Not successful")';
            echo '</script>';
        }
    }

    $sql = "SELECT * FROM restaurant_info";
    if ($result=mysqli_query($conn,$sql))
  {
     echo  "<div class=container>
            <div id='top' class='row'>

                <div class='col-xs-2' id='logo'>

                        <img src='http://www.tableready.net/wp-content/uploads/2019/03/cropped-logo-big-768x199.png' id='logo'>

                </div>
                
                <div class='col-xs-7' id='welcome' >
                    Welcome, " . $_SESSION['name'] . "!";
   echo         "</div>";
            
    //this is the start of the table header
         echo "<table class='tbl'>
    <thead>
        <tr>
            <th>RESTAURANT ID</th>
            <th>RESTAURANT NAME</th>
            <th>RESTAURANT'S ADDRESS</th>
            <th>OWNER'S NAME</th>
            <th>USERNAME</th>
            <th>CUISINE</th>
            <th>PHONE NUMBER</th>
            <th>SPECIALS</th>
            <th>SUSPENDED  (1 = suspended) (0 = not suspended)</th>
        </tr>
    </thead>
    <tbody>

                <tr>";
    //values for the table are being implemented
    while ($row = mysqli_fetch_array($result))
    {
            echo "<td>" . $row['restaurant_ID'] . "</td>";
            echo "<td>" . $row['restaurant_name'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['owner_name'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['cuisine'] . "</td>";
            echo "<td>" . $row['phone_number'] . "</td>";
            echo "<td>" . $row['specials'] . "</td>";
            echo "<td>" .$row['suspended'] ."</td>";
          echo "</tr>";
    }
                echo "</tbody>";
}
    echo"        </table>";
    $change = "SELECT * FROM restaurant_info";
    $result1=mysqli_query($conn,$change);
    $opt = "<select name='restaurant_ID'>";
    while($row1= mysqli_fetch_assoc($result1)){
        $opt .= "<option value='{$row1['restaurant_ID']}'>{$row1['restaurant_ID']}</option>";
    }
    echo "<br >";
    echo "<br >";
    echo "<form method='post'>";
    echo "<h4>Pick a restaurant to suspend</h4>";
    echo "<strong>Restaurant name</strong>";
    $opt .= "</select>";

    echo $opt;
    echo " ";
    echo "<input type='submit' value='Suspend'>";
    echo " ";
    echo "</form>";

      echo"  </body>
        ";
    echo "</html>";
?>



