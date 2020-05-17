<?php

    // includes the database connection file within this file,
    // allowing elements of this page to connect to and use database
    include '../backend/dbConnection.php';
    session_start();
    ini_set("display_errors", "off");

    // the following if statement is used to send information to the database
    // about the restraunt so that it can be saved for other viewers
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $phonenumber = $_POST['phone'];
        $address = $_POST['address'];
        $specials = $_POST['specials'];
        $cuisine = $_POST['Cuisines'];

        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $fileType = $_FILES['image']['type'];
        
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($fileActualExt, $allowed))
        {
            if($fileError === 0)
            {
                if ($fileSize < 1000000)
                {
                    $fileNameNew = $_SESSION['restaurant_ID']."-".uniqid('', true).".".$fileActualExt;
                    $fileDestination = 'menuuploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                }
                else
                {
                    echo "Your file is too big";
                }

            }
            else{
                echo "There was an error uploading your file";
            }
        }
        else{
            //
        }

    }

    //This segment of code is for retrieving image files for the restraunt
    $path = "menuuploads/";
    $extensions_array = array('jpg', 'jpeg', 'png');

    if(is_dir($path))
    {
        $files = scandir($path);

        for ($i = 0; $i < count($files); $i++)
        {
            if (strpos($files[$i], $_SESSION['restaurant_ID']) !== false) {
                $file = pathinfo($files[$i]);
                $extension = $file['extension'];

                echo "<img src = '$path$files[$i]' style = 'width:100px; height: 150px;'>";
            }
        }
    }

    // The following code connects the dashboard to the database, allowing user inputted values to be displayed
    $restaurant_info = "SELECT * from restaurant_info where restaurant_ID='".$_SESSION['restaurant_ID']."' limit 1";
    $result = mysqli_query($conn, $restaurant_info);
    $row = mysqli_fetch_assoc($result);
    //the following variables are the display variable for the dashboard and if the value is null it will display nothing
    $tempAddress = ((empty($row["address"])) || is_null($row["address"]) ? NULL : $row['address'] );
    $tempPhoneNumber = ((empty($row['phone_number'])) || is_null($row["phone_number"]) ? NULL : $row['phone_number'] );
    $tempSpecials = ((empty($row['specials'])) || is_null($row["specials"]) ? NULL : $row['specials'] );
    $tempCuisine = ((empty($row['cuisine'])) || is_null($row["cuisine"]) ? NULL : $row['cuisine'] );
    $tempNotes = ((empty($row['notes'])) || is_null($row["notes"]) ? NULL : $row['notes'] );

    $restaurantMonHours = "SELECT * from operation_hours where restaurant_ID='".$_SESSION['restaurant_ID']."' AND `week_day` = 'Monday' limit 1";
    $MonResult = mysqli_query($conn, $restaurantMonHours);
    $rowMonHours = mysqli_fetch_assoc($MonResult);

    $monTempOpen = ((empty($rowMonHours['opening_time'])) || is_null($rowMonHours["opening_time"]) ? NULL : $rowMonHours['opening_time'] );
    $monTempClose = ((empty($rowMonHours['closing_time'])) || is_null($rowMonHours["closing_time"]) ? NULL : $rowMonHours['closing_time'] );
    $monTempCheckbox = $rowMonHours['closed'];

    $restaurantTueHours = "SELECT * from operation_hours where restaurant_ID='".$_SESSION['restaurant_ID']."' AND `week_day` = 'Tuesday' limit 1";
    $TueResult = mysqli_query($conn, $restaurantTueHours);
    $rowTueHours = mysqli_fetch_assoc($TueResult);

    $tueTempOpen = ((empty($rowTueHours['opening_time'])) || is_null($rowTueHours["opening_time"]) ? NULL : $rowTueHours['opening_time'] );
    $tueTempClose = ((empty($rowTueHours['closing_time'])) || is_null($rowTueHours["closing_time"]) ? NULL : $rowTueHours['closing_time'] );
    $tueTempCheckbox = $rowTueHours['closed'];

    $restaurantWedHours = "SELECT * from operation_hours where restaurant_ID='".$_SESSION['restaurant_ID']."' AND `week_day` = 'Wednesday' limit 1";
    $WedResult = mysqli_query($conn, $restaurantWedHours);
    $rowWedHours = mysqli_fetch_assoc($WedResult);

    $wedTempOpen = ((empty($rowWedHours['opening_time'])) || is_null($rowWedHours["opening_time"]) ? NULL : $rowWedHours['opening_time'] );
    $wedTempClose = ((empty($rowWedHours['closing_time'])) || is_null($rowWedHours["closing_time"]) ? NULL : $rowWedHours['closing_time'] );
    $wedTempCheckbox = $rowWedHours['closed'];

    $restaurantThursHours = "SELECT * from operation_hours where restaurant_ID='".$_SESSION['restaurant_ID']."' AND `week_day` = 'Thursday' limit 1";
    $ThursResult = mysqli_query($conn, $restaurantThursHours);
    $rowThursHours = mysqli_fetch_assoc($ThursResult);

    $thursTempOpen = ((empty($rowThursHours['opening_time'])) || is_null($rowThursHours["opening_time"]) ? NULL : $rowThursHours['opening_time'] );
    $thursTempClose = ((empty($rowThursHours['closing_time'])) || is_null($rowThursHours["closing_time"]) ? NULL : $rowThursHours['closing_time'] );
    $thursTempCheckbox = $rowThursHours['closed'];

    $restaurantFriHours = "SELECT * from operation_hours where restaurant_ID='".$_SESSION['restaurant_ID']."' AND `week_day` = 'Friday' limit 1";
    $FriResult = mysqli_query($conn, $restaurantFriHours);
    $rowFriHours = mysqli_fetch_assoc($FriResult);

    $friTempOpen = ((empty($rowFriHours['opening_time'])) || is_null($rowFriHours["opening_time"]) ? NULL : $rowFriHours['opening_time'] );
    $friTempClose = ((empty($rowFriHours['closing_time'])) || is_null($rowFriHours["closing_time"]) ? NULL : $rowFriHours['closing_time'] );
    $friTempCheckbox = $rowFriHours['closed'];

    $restaurantSatHours = "SELECT * from operation_hours where restaurant_ID='".$_SESSION['restaurant_ID']."' AND `week_day` = 'Saturday' limit 1";
    $SatResult = mysqli_query($conn, $restaurantSatHours);
    $rowSatHours = mysqli_fetch_assoc($SatResult);

    $satTempOpen = ((empty($rowSatHours['opening_time'])) || is_null($rowSatHours["opening_time"]) ? NULL : $rowSatHours['opening_time'] );
    $satTempClose = ((empty($rowSatHours['closing_time'])) || is_null($rowSatHours["closing_time"]) ? NULL : $rowSatHours['closing_time'] );
    $satTempCheckbox = $rowSatHours['closed'];

    $restaurantSunHours = "SELECT * from operation_hours where restaurant_ID='".$_SESSION['restaurant_ID']."' AND `week_day` = 'Sunday' limit 1";
    $SunResult = mysqli_query($conn, $restaurantSunHours);
    $rowSunHours = mysqli_fetch_assoc($SunResult);
    
    $sunTempOpen = ((empty($rowSunHours['opening_time'])) || is_null($rowSunHours["opening_time"]) ? NULL : $rowSunHours['opening_time'] );
    $sunTempClose = ((empty($rowSunHours['closing_time'])) || is_null($rowSunHours["closing_time"]) ? NULL : $rowSunHours['closing_time'] );
    $sunTempCheckbox = $rowSunHours['closed'];

    //this will be called when the edit form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_SESSION['restaurant_ID'];
        $phonenumber = $_POST['phone'];
        $address = $_POST['address'];
        $specials = $_POST['specials'];
        $cuisine = $_POST['Cuisines'];
        $notes = $_POST['notes'];
        //this section will check for every day if the restaurant is open
        if (isset($_POST['MonClosed'])){
            $MonUpdate = "UPDATE operation_hours SET opening_time = NULL, closing_time = NULL, closed = '1' WHERE `restaurant_ID` = '".$id."' AND `week_day` = 'Monday' ";
            $conn->query($MonUpdate);
        }
        else{
            $monOpenTime = $_POST['Mondayopen'];
            $monCloseTIme = $_POST['Mondayclose'];
            $MonUpdate = "UPDATE operation_hours SET closed = '0', opening_time = '".$monOpenTime."', closing_time = '".$monCloseTIme."' WHERE `restaurant_ID` = '".$id."' AND `week_day` = 'Monday' ";
            $conn->query($MonUpdate);
        }

        if (isset($_POST['TueClosed'])){
            $TueUpdate = "UPDATE operation_hours SET opening_time = NULL, closing_time = NULL, closed = '1' WHERE `restaurant_ID` = '".$id."' AND `week_day` = 'Tuesday' ";
            $conn->query($MonUpdate);
        }
        else{
            $tuesOpenTime = $_POST['Tuesdayopen'];
            $tuesCloseTIme = $_POST['Tuesdayclose'];
            $TueUpdate = "UPDATE operation_hours SET closed = '0', opening_time = '".$tuesOpenTime."', closing_time = '".$tuesCloseTIme."' WHERE `restaurant_ID` = '".$id."' AND `week_day` = 'Tuesday' ";
            $conn->query($TueUpdate);
        }

        if (isset($_POST['WedClosed'])){
            $WedUpdate = "UPDATE operation_hours SET opening_time = NULL, closing_time = NULL, closed = '1' WHERE `restaurant_ID` = '".$id."' AND `week_day` = 'Wednesday' ";
            $conn->query($MonUpdate);
        }
        else{
            $wedOpenTime = $_POST['Wednesdayopen'];
            $wedCloseTIme = $_POST['Wednesdayclose'];
            $WedUpdate = "UPDATE operation_hours SET closed = '0', opening_time = '".$wedOpenTime."', closing_time = '".$wedCloseTIme."' WHERE `restaurant_ID` = '".$id."' AND `week_day` = 'Wednesday' ";
            $conn->query($WedUpdate);
        }
                
        if (isset($_POST['ThursClosed'])){
            $ThursUpdate = "UPDATE operation_hours SET opening_time = NULL, closing_time = NULL, closed = '1' WHERE `restaurant_ID` = '".$id."' AND `week_day` = 'Thursday' ";
            $conn->query($ThursUpdate);
        }
        else{
            $thursOpenTime = $_POST['Thursdayopen'];
            $thursCloseTIme = $_POST['Thursdayclose'];
            $ThursUpdate = "UPDATE operation_hours SET closed = '0', opening_time = '".$thursOpenTime."', closing_time = '".$thursCloseTIme."' WHERE `restaurant_ID` = '".$id."' AND `week_day` = 'Thursday' ";
            $conn->query($ThursUpdate);
        }

        if (isset($_POST['FriClosed'])){
            $FriUpdate = "UPDATE operation_hours SET opening_time = NULL, closing_time = NULL, closed = '1' WHERE `restaurant_ID` = '".$id."' AND `week_day` = 'Friday' ";
            $conn->query($FriUpdate);
        }
        else{
            $friOpenTime = $_POST['Fridayopen'];
            $friCloseTIme = $_POST['Fridayclose'];
            $FriUpdate = "UPDATE operation_hours SET closed = '0', opening_time = '".$friOpenTime."', closing_time = '".$friCloseTIme."' WHERE `restaurant_ID` = '".$id."' AND `week_day` = 'Friday' ";
            $conn->query($FriUpdate);
        }

        if (isset($_POST['SatClosed'])){
            $SatUpdate = "UPDATE operation_hours SET opening_time = NULL, closing_time = NULL, closed = '1' WHERE `restaurant_ID` = '".$id."' AND `week_day` = 'Saturday' ";
            $conn->query($SatUpdate);
        }
        else{
            $satOpenTime = $_POST['Saturdayopen'];
            $satCloseTIme = $_POST['Saturdayclose'];
            $SatUpdate = "UPDATE operation_hours SET closed = '0', opening_time = '".$satOpenTime."', closing_time = '".$satCloseTIme."' WHERE `restaurant_ID` = '".$id."' AND `week_day` = 'Saturday' ";
            $conn->query($SatUpdate);
        }

        if (isset($_POST['SunClosed'])){
            $SunUpdate = "UPDATE operation_hours SET opening_time = NULL, closing_time = NULL, closed = '1' WHERE `restaurant_ID` = '".$id."' AND `week_day` = 'Sunday' ";
            $conn->query($SunUpdate);
        }
        else{
            $sunOpenTime = $_POST['Sundayopen'];
            $sunCloseTIme = $_POST['Sundayclose'];
            $SunUpdate = "UPDATE operation_hours SET closed = '0', opening_time = '".$sunOpenTime."', closing_time = '".$sunCloseTIme."' WHERE `restaurant_ID` = '".$id."' AND `week_day` = 'Sunday' ";
            $conn->query($SunUpdate);
        }

        $update = "UPDATE restaurant_info SET phone_number = '".$phonenumber."', address = '".$address."', specials = '".$specials."', notes = '".$notes."', cuisine = '".$cuisine."' WHERE restaurant_ID = '".$id."'";

        if ($conn->query($update) === TRUE) {
            //echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
        header("Refresh:0");
        $conn->close();
    }
?>

<!-- Declears the document to be html -->
<!DOCTYPE html>

<!-- Sets language to english -->
<html lang = "en">

	<head>

        <!-- The following 4 lines add bootstrap to the website. The bootstrap code is not stored locally but is instead called from another place on the internet. -->
        <!-- Bootstrap is used to mainly make the page more responsive -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <!-- Sets the title of the webpage to be Dashboard -->
		<title>Dashboard</title>
        
        <!-- The character set of this webpage is UTF-8, a common standard -->
		<meta charset="UTF-8">
        
        <!-- Defines the viewport which allows later code to more easily see the width of the device. For example, the width of a phone would be smaller. useful for making things responsive -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- These keywords are used to make the website more easily searchable -->
		<meta name="keywords" content="TableReady, Table, Ready">
        
        <!-- sets the webpage's description -->
		<meta name="description" content="TableReady">
        
        <!-- Shows the author(s) of the webpage -->
        <meta name="author" content="Vanessa, Omar, Jacob, Sudin, Suman, Subarna">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        
        <!-- The following code within the style tag is CSS code that affects the way the other elements of the page look -->
        <style>

            /* Sets the background color of the webpage to a nice offwhite */
            body{
                background-color: ghostwhite;
            }

            /* the element with the id of title will have a small solid black border at the bottom and have a signature red background color */
            #title{
                border-bottom: black 1px solid;
                background-color: #9C1B1F;;
            }

            /* Sets thte element with id titleButtons to be aligned right and colored pink */
            /* I think this has been replaced with an improved header tho and is not necessary anymore */
            #titleButtons{
                text-align: right;
                margin: auto;
                color: pink
            }

            /* Sets the element with id content1 to have text center aligned, margins automatically set, and have an antique white background color */
            /* content 1 is the first row of content on the dashboard */
            #content1{
                text-align: center;
                margin: auto;
                background-color: antiquewhite;
            }

            /* The following 3 stylings deal with the three columns within the id content1 */
            /* They are styled separately so that they can be modified separately if needed */
            #content1col1{
                border: #9C1B1F 1px solid;
            }

            #content1col2{
                border: #9C1B1F 1px solid;
            }

            #content1col3{
                border: #9C1B1F 1px solid;
            }

            /* The elements in id content2 have their text center aligned, margins automatically set, and background color set to an antique white */
            /* content 2 is the other row of content with 3 columns on the webpage */
            #content2{
                text-align: center;
                margin: auto;
                background-color: antiquewhite;
                
            }

            /* The following 3 stylings deal with the three columns within the id content2 */
            /* They are styled separately so that they can be modified separately if needed */
            #content2col1{
                border: #9C1B1F 1px solid;
            }

            #content2col2{
                border: #9C1B1F 1px solid;
            }

            #content2col3{
                border: #9C1B1F 1px solid;
            }

            /* The bannercontent is the midsection that contains thumbnail images of uploaded restraunt pictures */
            /* The followin code sets text alignment, margins, colors, borders, and padding of the bannercontent row */
            #bannercontent{
                text-align: center;
                margin: auto;
                background-color: #9C1B1F;
                border-top: black 2px dashed;
                border-bottom: black 2px dashed;
                padding-top: 20px;
                padding-bottom: 20px;
            }

            /* sets h1 to be colored black */
            h1{
                color: black;
            }

            /* sets h2 to be colored our signature red, center aligned, and have the size of the font a calculation of 24px plus 1% of the viewport (screen) width */
            h2{
                color: #9C1B1F;
                text-align: center;
                font-size: calc(24px + 1vw);
            }

            /* sets h3 to be a signature red */
            h3{
                color: #9C1B1F;
            }

            /* sets the size of regular paragraph text to be a calculation including screen width for responsive purposes and sets the margins to auto */
            p{
                font-size: calc(12px + 0.5vw);
                margin: auto;
            }

            /* sets the size of pre text to be a calculation including screen width for responsive purposes and sets the margins to auto */
            pre{
                font-size: calc(12px + 0.5vw);
                margin: auto;
            }

            /* sets height, width, and object-fit style to the image in the header (tablereadylogo)*/
            /* i think the whole header has been replaced so this might not be in use anymore */
            #headerimg{
                width: 100%;
                height: 400px;
                object-fit: cover;
            }

            /* styles the buttons at the top of the screen setting them to float right, have specific spacings, and margins */
            #navButtons{
                margin: auto;
                margin-top: 5%;
                padding-left: 5%;
                float: right;
                text-align: center;
                cursor: pointer;
            }

            /* Styles the anchor textt within the navbuttons to be a specific size and color and no text decoration*/
            #navButtons a{
                text-decoration: none;
                color: #9C1B1F;
                font-family: Helvetica, sans-serif;
                font-size: calc(16px + 0.5vw);
                border: none;
            }
            #pop{
                cursor: pointer;
                margin: auto;
                margin-top: 5%;
                margin-left: 5%;
                float: right;
                text-align: center;
                background-color: rgba(156, 27, 31, 0.8);
                border: none;
                padding-left: 2%;
                padding-right: 2%;
            }

            #pop a{
                text-decoration: none;
                color: white;
                font-family: Helvetica, sans-serif;
                font-size: calc(16px + 0.5vw);
            }


            /* styling for tableready logo */
            #logo{
                height: 100%;
                width: 100%;
            }

            /*add padding to upoaded images from menu to keep them from appear too closely */
            #menuimg{
                margin: auto;
                padding: 5%;
            }
            

            /*Styles about us section at bottom to be centered, and have borders*/
            #aboutus{
                text-align: center;
                border-top: #E48400 solid 1px;
                color: white;
                background-color: #9C1B1F;
                min-height: 200px;
            }

            #aboutus p{
                font-size: calc(12px + 0.5vw);
                color: white;
            }
            
            #aboutus h3{
                color: white;
            }

            /* The element with class popup form is styled to not display until a button is clicked which calls a function to change display:none */
            /* other than that, the popup is positioned in the bottom right with a border and a high z index to appear on top */
            .popupform {
                font-family: Helvetica, sans-serif;
                display: none;
                position: fixed;
                bottom: 0;
                right: 0;
                border: 3px solid #9C1B1F;
                z-index: 9;
            }

            /* This is the container for the form which appears inside the popupform */
            /* The stylings specify the max size, background color, and padding of the popup */
            .formcontainer {
                max-width: 800px;
                max-height: 1000px;
                padding: 10px;
                background-color: antiquewhite;
            }

            /* The following lines of code further style the popup form, specifically the inputs, buttons, text, and so on */
            .formcontainer input[type=text], .form-container input[type=password] {
                width: 75%;
            }

            .formcontainer input[type=time], .formcontainer input[type=checkbox]{
                float: right;
            }

            .formcontainer input[type=text]:focus, .form-container input[type=password]:focus {
                background-color: #ccc;
                outline: none;
            }

            .formcontainer .btn {
                background-color: green;
                color: white;
                padding: 8px 18px;
                border: none;
                font-size: 24px;
                font-weight: bold;
                width: 100%;
                margin-bottom:15px;
                opacity: 0.8;
            }

            .formcontainer .cancel {
                background-color: red;
                color: white;
                padding: 8px 18px;
                border: none;
                font-size: 12;
                font-weight: bold;
                width: 100%;
                margin-bottom:15px;
                opacity: 0.8;
            }

            .formcontainer h1{
                text-align: center;
            }

            .formcontainer h3{
                font-size: 24px;
                text-align: center;
            }

            .formcontainer p{
                float: right;
                font-size: 12px;
            }

            /* the following stylings set the thumbnail images to appear a specific size with a border and margins*/
            #menuthumbnail img{
                height: 200px;
                width: 200px;
                border: solid black 2px;
                margin-top: 10px;
                margin-bottom: 10px;
            }

            /* the element with id viewall is the last image of the thumbnails in the bannercontent it looks like the other thumbnails but acts as a button to display a popup */
            #Viewall{
                height: 200px;
                width: 200px;
                background-image: url("localhost/frontend/menu.jpg");
                border: dashed black 5px;
                filter: blur(2px);
                -webkit-filter: blur(2px);
                margin-top: 10px;
                margin-bottom: 10px;
            }

            /* The element with id morephoto is the column that the viewall element exists within. the cursor is set to pointer so the page viewer knows that viewall button is clickable*/
            #Morephoto{
                cursor: pointer;
                text-align: center;
            }

            /* This code styles the text within the Morephoto, viewall button to be a centered overlay */
            #Morephoto a{
                z-index: 5;
                position: absolute;
                top: 30%;
                left: 35%;
                font-size: 32px;
            }

            /* The class popupphoto is similar to the previous popupform element with set height, width, display:none, and positioning at bottom left*/
            /* its not all the way at the bottom because the buttons are in a separate thing at the bottom. The buttons are separate so when the viewer scrolls throught the pictures*/
            /* they can always click on the close button without scrolling all the way down*/
            .popupphoto{
                max-height: 800px;
                width: 800px;
                display: none;
                position: fixed;
                bottom: 150px;
                left: 0;
                border: 3px solid #9C1B1F;
                z-index: 9;
                overflow-y: scroll;
            }

            /* The photo container is the elementt that the photos are contained within, this is whithin the popupphoto element */
            .photocontainer{
                padding: 10px;
                background-color: antiquewhite;
            }

            /* sets the size of the larger images in the popup */
            #menuphoto img{
                width: 600px;
                height: 600px;
            }
            
            /* this is the smaller popup alongside the popupphoto that contains the close button and upload button*/
            #Photosclose{
                height: 150px;
                width: 800px;
                display: none;
                position: fixed;
                bottom: 0px;
                left: 0;
                padding-top: 10px;
                padding-bottom: 10px;
                background-color: antiquewhite;
                z-index: 9;
                border: 3px solid #9C1B1F;
            }

            /* stylings for the close and upoad button within the photosclose element*/
            #Photosclose .cancel {
                background-color: red;
                color: white;
                padding: auto;
                border: none;
                height: 40px;
                width: 100%;
                margin-bottom:15px;
                opacity: 0.8;
            }

            #Photosclose .btn{
                background-color: green;
                color: white;
                padding: auto;
                border: none;
                height: 40px;
                width: 100%;
                margin-bottom:5px;
                opacity: 0.8;
            }

            #Photosclose #upload {
                background-color: green;
                color: white;
                padding: auto;
                border: none;
                height: 40px;
                width: 100%;
                margin-bottom:5px;
                opacity: 0.8;
            }

            /*Styles the input button to be centered */
            #Photosclose input[type=file]{
                position: absolute;
                left: 300px;
                margin-bottom: 10px;
            }

        </style>      
        
        <!-- Thte following scripts are used to display and hide the edit form and photo popups at the click of a button -->
        <script>

            function openForm() 
            {
                document.getElementById("form").style.display = "block";
            }

            function closeForm() 
            {
                document.getElementById("form").style.display = "none";
            }

            function openPhoto() 
            {
                document.getElementById("Photos").style.display = "block";
                document.getElementById("Photosclose").style.display = "block";
            }

            function closePhoto() 
            {
                document.getElementById("Photos").style.display = "none";
                document.getElementById("Photosclose").style.display = "none";
            }

            function enableDisableTxtbox (state ,textboxOpen, textboxclose){
                document.getElementById(textboxOpen).disabled = state;
                document.getElementById(textboxclose).disabled = state;
            }
        </script>
	</head>
    
    
	<body>

        <!-- class container is a part of bootstrap and is styled through bootstrap. it's necessary for utilizing bootstraps row and column style -->
        <div class="container">

            <!-- The following code within this div is a part of the popupform which will popup when the edit button is click and allow the user to change content about their restraunt -->
            <div class="popupform" id="form">
        
                <!-- This form contains info about the phone number, operation hours, address, specials, and cuisine type of the restraunt for submitting changes to database -->
                <!-- The h1 is the heading, the labels are the text beside the inputs, and the inputs are the boxes to be filled with info the by user -->
                <form method="post" class="formcontainer">
                    <h1>Update Information</h1>

                    <label for="phone number"><b>Phone number</b></label>
                    <input type="tel" placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone" value="<?=$tempPhoneNumber?>">
                    <br>
                    <h3><b>Hours of Operation</b></h3>
                    <label for="Mondayhours"><b>Monday</b></label>
                    <p>check if closed</p>
                    <input type="checkbox" name="MonClosed" id ="mon" value="closed" onclick="enableDisableTxtbox(this.checked, 'mono','monc')" <?php if($monTempCheckbox == 1) echo 'checked="checked"'; ?>>
                    <input type="time" name="Mondayclose" value="<?=$monTempClose?>" id = "monc" <?php if($monTempCheckbox == 1) echo 'disabled ="disabled"'; ?>  >
                    <input type="time" name="Mondayopen" value="<?=$monTempOpen?>" id ="mono" <?php if($monTempCheckbox == 1) echo 'disabled ="disabled"'; ?> >
                    <br>
                    <label for="Tuesdayhours"><b>Tuesday</b></label>
                    <p>check if closed</p>
                    <input type="checkbox" name="TueClosed" id="tue" value="closed" onclick="enableDisableTxtbox(this.checked, 'tueso','tuesc')" <?php if($tueTempCheckbox == 1) echo 'checked="checked"'; ?>>
                    <input type="time" name="Tuesdayclose" id="tuesc" value="<?=$tueTempClose?>" <?php if($tueTempCheckbox == 1) echo 'disabled ="disabled"'; ?>>
                    <input type="time" name="Tuesdayopen" id="tueso" value="<?=$tueTempOpen?>" <?php if($tueTempCheckbox == 1) echo 'disabled ="disabled"'; ?>>
                    <br>
                    <label for="Wednesdayhours"><b>Wednesday&nbsp</b></label>
                    <p>check if closed</p>
                    <input type="checkbox" name="WedClosed" id="wed" value="closed" onclick="enableDisableTxtbox(this.checked, 'wedo','wedc')" <?php if($wedTempCheckbox == 1) echo 'checked="checked"'; ?>>
                    <input type="time" name="Wednesdayclose" id="wedc" value="<?=$wedTempClose?>" <?php if($wedTempCheckbox == 1) echo 'disabled ="disabled"'; ?>>
                    <input type="time" name="Wednesdayopen" id="wedo" value="<?=$wedTempClose?>" <?php if($wedTempCheckbox == 1) echo 'disabled ="disabled"'; ?>>
                    <br>
                    <label for="Thursdayhours"><b>Thursday</b></label>
                    <p>check if closed</p>
                    <input type="checkbox" name="ThursClosed" id="thurs" value="closed" onclick="enableDisableTxtbox(this.checked, 'thurso','thursc')" <?php if($thursTempCheckbox == 1) echo 'checked="checked"'; ?>>
                    <input type="time" name="Thursdayclose" id="thursc" value="<?=$thursTempClose?>" <?php if($thursTempCheckbox == 1) echo 'disabled ="disabled"'; ?>>
                    <input type="time" name="Thursdayopen" id="thurso" value="<?=$thursTempOpen?>" <?php if($thursTempCheckbox == 1) echo 'disabled ="disabled"'; ?>>
                    <br>
                    <label for="Fridayhours"><b>Friday</b></label>
                    <p>check if closed</p>
                    <input type="checkbox" name="FriClosed" id="fri" value="closed" onclick="enableDisableTxtbox(this.checked, 'frio','fric')"  <?php if($friTempCheckbox == 1) echo 'checked="checked"'; ?>>
                    <input type="time" name="Fridayclose" id="fric" value="<?=$friTempOpen?>" <?php if($friTempCheckbox == 1) echo 'disabled ="disabled"'; ?>>
                    <input type="time" name="Fridayopen" id="frio" value="<?=$friTempOpen?>" <?php if($friTempCheckbox == 1) echo 'disabled ="disabled"'; ?>>
                    <br>
                    <label for="Saturdayhours"><b>Saturday</b></label>
                    <p>check if closed</p>
                    <input type="checkbox" name="SatClosed" id="sat" value="closed" onclick="enableDisableTxtbox(this.checked, 'sato','satc')"  <?php if($satTempCheckbox == 1) echo 'checked="checked"'; ?>>
                    <input type="time" name="Saturdayclose" id="satc" value="<?=$satTempClose?>" <?php if($satTempCheckbox == 1) echo 'disabled ="disabled"'; ?>>
                    <input type="time" name="Saturdayopen" id="sato" value="<?=$satTempOpen?>" <?php if($satTempCheckbox == 1) echo 'disabled ="disabled"'; ?>>
                    <br>
                    <label for="Sundayhours"><b>Sunday</b></label>
                    <p>check if closed</p>
                    <input type="checkbox" name="SunClosed" id="sun" value="closed" onclick="enableDisableTxtbox(this.checked, 'suno','sunc')"  <?php if($sunTempCheckbox == 1) echo 'checked="checked"'; ?>>
                    <input type="time" name="Sundayclose" id="sunc" value="<?=$sunCloseTIme?>" <?php if($sunTempCheckbox == 1) echo 'disabled ="disabled"'; ?>>
                    <input type="time" name="Sundayopen" id="suno" value="<?=$sunOpenTime?>" <?php if($sunTempCheckbox == 1) echo 'disabled ="disabled"'; ?>>
                    <br>
                    <label for="address"><b>Address</b></label>
                    <input type="text" placeholder="1234 Place st." value="<?=$tempAddress?>" name="address">
                    <br>
                    <label for="Specials"><b>Specials</b></label>
                    <input type="text" placeholder="Specials" value="<?=$tempSpecials?>" name="specials">
                    <br>
                    <label for="Cuisines"><b>Cuisines</b></label>
                    <input type="text" placeholder="Cuisine Type" value="<?=$tempCuisine?>" name="Cuisines">
                    <br>
                    <label for="notes"><b>Notes &nbsp; &nbsp;&nbsp;</b></label>
                    <input type="text" placeholder="notes" value="<?=$tempNotes?>" name="notes">
                    <br>
                    <button type="submit" class="btn">Save</button>
                    <button type="submit" class="cancel" onclick="closeForm()">Close</button>
                </form>

            </div>

            <!--This div contains the top row of the dashboard which is used for the title and navigation buttons-->
            <div id="top" class="row">

                <!--this column contains the tableready logo -->
                <div class="col-sm-3">

                    <img src="http://www.tableready.net/wp-content/uploads/2019/03/cropped-logo-big-768x199.png" id="logo">

                </div>

                <div class="col-sm-2"></div>

                <div class="col-sm-7" id="navbar">
                <div id="navButtons" class="col-xs-3"> <b><a href="homepage.html">Home</a></b> </div>
                <div id="navButtons" class="col-xs-3"> <b><a href="../backend/logout.php">Signout</a></b> </div>
                <?php if ($_SESSION['role']== "owner") echo "<div id='pop' class='col-xs-3'> <b><a onclick='openForm()'>Edit</a></b> </div>"; else{echo NULL;}?>
                <?php if ($_SESSION['role']== "owner") echo "<div id='navButtons' class='col-xs-3'> <b><a href='employee_access.php'>Add Employee</a></b> </div>"; else {echo NULL;}?>

                </div>

                

            </div>

            <!-- The hr creats a horizontal line across the page separating the heading bar from the rest of the page and the br is just a blank line for spacing purposes -->
            <hr>
            <br>

            <!-- This row contains the restraunt title which is obtained by the database using session data -->
            <div id="resttitle" class="row">

                <div class="col-lg-12">

                    <h2> <?=ucfirst($_SESSION['restaurant_name'])?> </h2>
                    <!--//if (isset($_SESSION['restaurant_name'])) {
                    //echo $_SESSION['restaurant_name'];
                    //} else {
                    //echo 'Not signed in';
                    //} -->
                </div>

            </div>


            <br>

            <!-- The code within the content1 div make up the phone number, hours of operation, and address columns of the dashboard -->
            <div id="content1" class="row">

                <!-- This column displays the restraunts phonenumber-->
                <div id="content1col1" class="col-md-4">
                    <h3>Phone Number:</h3>
                    <br>
                    <p><?=$tempPhoneNumber?></p>
                    <br>
                    <br>
                </div>

                <!-- This column displays the restraunts hours of operation-->
                <div id="content1col2" class="col-md-4">
                    <h3>Hours of Operation:</h3>
                    <pre><p>Monday:     <?php if($monTempCheckbox == 0) echo $monTempOpen."-". $monTempClose; else echo "Closed All Day";?> </p></pre>
                    <pre><p>Tuesday:    <?php if($tueTempCheckbox == 0) echo $tueTempOpen."-". $tueTempClose; else echo "Closed All Day";?></p></pre>
                    <pre><p>Wednesday:  <?php if($wedTempCheckbox == 0) echo $wedTempOpen."-". $wedTempClose; else echo "Closed All Day";?></p></pre>
                    <pre><p>Thursday:   <?php if($thursTempCheckbox == 0) echo $thursTempOpen."-". $thursTempClose; else echo "Closed All Day";?></p></pre>
                    <pre><p>Friday:     <?php if($friTempCheckbox == 0) echo $friTempOpen."-". $friTempClose; else echo "Closed All Day";?></p></pre>
                    <pre><p>Saturday:   <?php if($satTempCheckbox == 0) echo $satTempOpen."-". $satTempClose; else echo "Closed All Day";?></p></pre>
                    <pre><p>Sunday:     <?php if($sunTempCheckbox == 0) echo $satTempOpen."-". $satTempClose; else echo "Closed All Day";?></p></pre>
                    <br>
                </div>

                <!-- This column displays the restraunts address-->
                <div id="content1col3" class="col-md-4">
                    <h3>Address:</h3>
                    <br>
                    <p><?=$tempAddress?></p>
                    <br>
                    <br>
                </div>

            </div>

            <br>

            <!-- The code within the bannercontent make up the portion of the website containing the thumbnails of images uploaded by the restraunt owner -->
            <div id="bannercontent" class="row">

                <br>

                <!-- The php code navigates to the folder containing uploaded pictures and prints them onto the webpage in separate columns -->
                <?php
                                

                    $path = "../backend/menuuploads/";
                    $extensions_array = array('jpg', 'jpeg', 'png');

                    if(is_dir($path))
                    {
                        $files = scandir($path);

                        for ($i = 0; $i < count($files); $i++)
                        {
                            if (strpos($files[$i], $_SESSION['restaurant_ID']) !== false)
                            {
                                $file = pathinfo($files[$i]);
                                $extension = $file['extension'];

                                echo 
                                            
                                "
                                <div id='menuthumbnail' class='col-md-3'>
                    
                                    <img src = '$path$files[$i]'>
                
                                </div> 
                                
                                ";

                            }
                        }
                    }

                ?>

            <!-- the morephoto div contains the viewall image which when clicked on displays the popup that contains larger versions of the uploaded images -->
            <div id="Morephoto" class="col-md-3">
                    
                <img id="Viewall" onclick="openPhoto()" src="menu.jpg" alt="Menu">

                <a onclick="openPhoto()"><b>View</b></a>

            </div>

            <br>

            </div>

            <br>

            <!-- The content2 row contains the columns with information about restraunt specials, cuisine, and notes -->
            <div id="content2" class="row">

                    <div id="content2col1" class="col-md-4">
                        <h3>Specials</h3>
                        <p><?=$tempSpecials?></p>
                        <br>
                    </div>
    
                    <div id="content2col2" class="col-md-4">
                        <h3>Cuisines</h3>
                        <p><?=$tempCuisine?></p>
                        <br>
                    </div>
    
                    <div id="content2col3" class="col-md-4">
                        <h3>Notes</h3>
                        <p> <?=$tempNotes?> </p>
                        <br>
                    </div>
    
                </div>

                <br>
                <br>

                <!-- The about us row at the bottom of the webpage displays a helpful message about tableready -->
                <div id="aboutus" class="row">

                    <div class="col-md-12">
    
                        <br>
                            <h3>Hello There!</h3>
                            <p>
                            <i class="fa fa-coffee" style="font-size:48px"></i><br><br><i class="fa fa-circle" style="font-size:12px"></i> TableReady is a reservations and seating management system that turns smartphones into pagers, revolutionizing the way restaurants connect with customers.
                            <br> <i class="fa fa-circle" style="font-size:12px"></i> TableReady allows restaurants to see the wait list in real-time, notify customers when their table is ready, seat them efficiently, and stay connected with them by push notification messages.
                            <br> <i class="fa fa-circle" style="font-size:12px"></i> TableReady is a wait list, paging, and reservations system with a mobile app that allows users to map restaurants, waitlist themselves, make reservations, leave feedback easily, and order food to-go online.
                            The free app allows users to find restaurants near them, waitlist their party, book reservations quickly and easily, and order food for take-out, all with the restaurant's full control and ability to communicate with them every step of the way.
                            <br> <i class="fa fa-circle" style="font-size:12px"></i> For an affordable monthly subscription fee, TableReady manages your wait list and reservations system, allowing restaurants to connect with their customers, seat them, and reward them.
                    </p>


                    </div>

                </div>  

            <!-- the following code is for the popup containing larger images of photos -->
            <div id="Photos" class="popupphoto">

                <div class="photocontainer">

                    <div id="bannercontent" class="row">

                        <br>

                        <h3>Photos</h3>

                        <div id="menuphoto" class="col-md-12">
                    
                            <!--<img src="menu.jpg" alt="menu1">-->

                            <!-- similar to the previous phpcode for the thumbnails, this php code grabs uploaded images and displays them on the webpage, within the photo popup -->
                            <?php
                                

                                $path = "../backend/menuuploads/";
                                $extensions_array = array('jpg', 'jpeg', 'png');

                                if(is_dir($path))
                                {
                                    $files = scandir($path);

                                    for ($i = 0; $i < count($files); $i++)
                                    {
                                        if (strpos($files[$i], $_SESSION['restaurant_ID']) !== false)
                                        {
                                            $file = pathinfo($files[$i]);
                                            $extension = $file['extension'];

                                            echo 
                                            
                                            "
                                            
                                            <div id='bannercontent' class='row'>

                                            <br>
                    
                                            <div id='menuphoto' class='col-md-12'>
                                        
                                            <img src = '$path$files[$i]' style = 'width: 600px; height: 600px;'>
                    
                                            </div>
                    
                                            </div>
                                            ";

                                        }
                                    }
                                }

                            ?>

                        </div>

                    </div>

                    <br>

                </div>

            </div>

            <!-- the photoclose div contains code for the upload photo button and close photo pop up button -->
            <div id="Photosclose">

                <form action="../backend/upload.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="image" id="image"/>
                    <br><br>
                    <input type="submit" name="upload" value="Upload Menu" id="upload"/>
                </form>

            <button type="submit" class="cancel" onclick="closePhoto()">Close</button>
             <br><br>

            </div>

        </div>

        <br>
        <br>
		
	</body>

</html>