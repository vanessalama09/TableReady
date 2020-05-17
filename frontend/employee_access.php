<!-- The php code establishes a database connection, starts the session, and assigns values to the variables username, fname, lname, and more
corresponding to the values inputted into the form thus registering the employee -->
<?php
    include '../backend/dbConnection.php';
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $role = $_POST['role'];
        if($_POST['password'] == $_POST['confirm_password']){
            $username = $_POST['username'];
            $fName = $_POST['firstname'];
            $lName = $_POST['lastname'];
            $password = md5($_POST['password']);
            //$role = $_POST['role'];
            $restaurant_ID = $_SESSION['restaurant_ID'];
            $restaurant_name = $_SESSION['restaurant_name'];
            $add_employee = "INSERT INTO `employees` (`username`, `password`, `first_name`, `last_name`, `restaurant_name`, `role`) 
            VALUES ('$username', '$password', '$fName', '$lName', '$restaurant_name', '$role')";

            if($conn->query($add_employee) === true){
                //echo "Registration done";
                echo '<script language="javascript">';
                echo 'alert("Registration Successful")';
                echo '</script>';
            }
            else{
                //echo "user was not added". $conn->error;
                echo '<script language="javascript">';
                echo 'alert("Error")';
                echo '</script>';

            }
        }
    }
?>

<!-- sets doc type to html -->
<!DOCTYPE html>
<html>

<head>

    <!-- sets the title of the webpage to Employee access form -->
	<title>Employee Access Form</title>
    
    <!-- sets the character set to utf-8 which is a common standard -->
    <meta charset="UTF-8">

    <!-- establishes the viewport which is set to be the devices width and is used for responsive css stylings -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- the following few lines import bootstrap libraries and functionality to the webpage -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"crossorigin="anonymous">
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


	
<style>

            /* sets the width of the class elements employee access form to 450 pixels and margin to auto */
			.employee-access-form {
				width: 450px;
				margin: auto;
			}

            /* sets h1 elements to have a width of 700 pixels and a margin of 5 */
			h1{
				width:700px;
				margin: 5;
			}

            /* images under the h2 header have a relative position and a width of 20% */
            h2 img{
                position: relative;
                width: 20%;
                left: 0%;
            }

            /* legend elements have a signature tableready color, font family, and font size */
            legend{
                color: #9C1B1F;
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                font-size: 28px;
            }

            /* label elements have a signature tableready color, font family, and font size */
            label{
                color: #9C1B1F;
                font-size: 22px;
                font-weight: bold;
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            }

            /* input elements have automatic margins, a signature color, and are center aligned */
            input{
                margin: auto;
                color: #9C1B1F;
                text-align: center;
            }

            /* i elements within form have a font size of 30 pixels and a signature color */
            form i{
                font-size: 30px;
                color:#9C1B1F;
            }

            /* option elementst have the signature tableready color, font size 18 pixels */
            option{
                color: #9C1B1F;
                font-size: 18px;
                font-family: Arial, Helvetica, sans-serif;
            }

            /* the pop id is used for the header and sets the logout button to stand up more giving it a background-color */
			#pop{
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

            /* the anchor element within the pop id has no text decoration, is colored white, and has a responsive font size using the viewport */
            #pop a{
                text-decoration: none;
                color: white;
                font-family: Helvetica, sans-serif;
                font-size: calc(16px + 0.5vw);
            }

            /* the tableready logo has a height and width of 100% */
            #logo{
                height: 100%;
                width: 100%;
            }

            /* The navigation buttons at the top of the screen are positioned to the right side, relative to each other, and spaced out in a responsive way */
            #navButtons{
                position: relative;
                margin: auto;
                margin-left: 5%;
                text-align: center;
                max-width: 100%;
                margin-top: 5%;
                float: right;
            }

            /* the anchor text within the navigation butons are colored the signature tableready color, and sized responsively */
            #navButtons a{
                text-decoration: none;
                color: #9C1B1F;
                font-family: Helvetica, sans-serif;
                font-size: calc(16px + 0.5vw);
            }
			

</style>
</head>

<body>

<!-- the container class is a part of bootstrap and is need to use bootstraps grid system of design -->
<div class = "container">


    <!-- The row class creates at the top of the page allowing 12 columns to be created within it. This row contains the header -->
    <div id="top" class="row">

        <!-- The first 3 columns in the header row are used for the tableready logo -->
        <div class="col-sm-3" >

            <img src="http://www.tableready.net/wp-content/uploads/2019/03/cropped-logo-big-768x199.png" id="logo">

        </div>

        <!-- The next 2 columns are blank -->
        <div class="col-sm-2">

        </div>

        <!-- The next 7 columns contain the navigation buttons allowing the user to return home, to the about us section, or to logout -->
        <div class="col-sm-7" id="navbar" span="">

            <div id="navButtons" class="col-xs-3"> <b><a href="homepage.html">Home</a></b> </div>
        
            <div id="navButtons" class="col-xs-3"> <b><a href="#aboutus">About&nbsp;Us</a></b> </div>

            <div id="pop" class="col-xs-3"> <b><a href="../backend/logout.php">logout</a></b> </div>
        <!--<div id="navButtons" class="col-xs-3"> <b><a href="#aboutus">Log&nbsp;In</a></b> </div>-->
        </div>



    </div>

    <br><br>

    <!-- This form is the employee access form and contains the signup information of the employee -->
    <form method="post" class="employee-access-form">
        <div class="row">
			<div>
				<h1>Employee Access Form</h1>
			</div>
				<div class="col">
					<div class="form-group">
                        <!-- This label and input are for the first name section of the form -->
						<label for="firstname">Firstname</label>
						<input type="text" name="firstname" id="employee_firstname" class="form-control" required>
					
					</div>
				</div>
				
				<div class="col">
					<div class="form-group">
                        <!-- This label and input are for the last name section of the form -->
						<label for="lastname">Lastname</label>
						<input type="text" name="lastname" id="employee_lastname" class="form-control" required>
						
					</div>
				</div>
        </div>
		
        <div class="form-group">
            <!-- This label and input are for the username section of the form -->
            <label for="username">Username</label>
            <input type="text" name="username" id="employee_username" class="form-control" required>
            <small class="form-text text-muted">
                        Enter Username for the employee
            </small>
        </div>
		
        <div class="form-group">
            <!-- This label and input are for the password section of the form -->
            <label for="password">Password</label>
            <input type="password" name="password" id="employee_password" class="form-control" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;" required>
			<small class="form-text text-muted">
                        Enter password for the employee
			</small>
        </div>
		
		<div class="form-group">
            <!-- This label and input are for the password confirmation section of the form -->
            <label for="password">Confirm Password</label>
            <input type="password" name="confirm_password" id="employee_password_confirm" class="form-control" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" placeholder="Re-enter password" required>
        </div>
		
		
        <div class="form-group">
            <!-- This label and input are for the position section of the form -->
            <label for="position">Position</label>
            <select name="role" id="employee_position" class="form-control" required>
                <option value="Manager">Manager</option>
                <option value="Other">Other</option>
            </select>
        </div>
		
		
		<div class="form-group">
            <!-- This button is to submit the form to be added into the database -->
			<button type="submit" color="red" class="btn btn-success" style="background-color:#9C1B1F;color:white;border:none;" >Submit</button>
		</div>
        
    </form>
  
</body>

</html>