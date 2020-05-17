<?php
include '../backend/dbConnection.php';
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //two passwords equal two each other
    if($_POST['password'] == $_POST['conf_password']){
        $username = $conn->real_escape_string($_POST['username']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = md5($_POST['password']);
        $fName = $conn->real_escape_string($_POST['fName']);
        $lName = $conn->real_escape_string($_POST['lName']);
        $restaurant_name = $conn->real_escape_string($_POST['res_name']);
        
        $_SESSION['name'] = $fName.' '.$lName;
        $ownerFullName = $fName.' '.$lName;
        $_SESSION['username'] = $username;
        $_SESSION['restaurant_name'] = $restaurant_name;
        //insert in db
        //$insert_accountInfo = "INSERT INTO ownersinfo (username, email, fName, lName, password, restaurant_name) "
        //        . "VALUES ('$username', '$email', '$fName, '$lName', '$password', '$restaurant_name' )";
        $insert_accountInfo = "INSERT INTO `owners_info` (`username`, `email`, `password`, `fName`, `lName`, `restaurant_name`, `created_at`) 
        VALUES ('$username', '$email', '$password', '$fName', '$lName', '$restaurant_name', CURRENT_TIMESTAMP)";

        $insert_restaurantInfo = "INSERT INTO restaurant_info (username, owner_name, restaurant_name) "
        . "VALUES ('$username', '$ownerFullName', '$restaurant_name' )";
        
        if( ($conn->query($insert_accountInfo) === true) && ($conn->query($insert_restaurantInfo) === true) ){
            $_SESSION['message'] = "Registration done";
            header("location: ../backend/welcomeSignup.php");
        }
        else{
            //$_SESSION['message'] = "User could not be added to db";
            $_SESSION['message'] = "error: " . mysqli_error($conn);
        }        
    }
    else{
        $_SESSION['message'] = "password and cnf password are not the same";
    }

}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
    <head>

        <title>Sign UP</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <!-- establishes the viewport which is set to be the devices width and is used for responsive css stylings -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<!-- the following few lines import bootstrap libraries and functionality to the webpage -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"crossorigin="anonymous">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script>
		

		
        <style>

            h2 img{
                position: relative;
                width: 20%;
                left: 0%;
            }

            #login-block{
                text-align: center;
                background-color: rgba(242, 227, 206, 0.8);
                top: 100px;
                width: 50%;
                float: none;
                margin: 0 auto;
                height: 680px;
                box-shadow: 0 1px 6px rgba(0, 0, 0, 0.12), 0 1px 4px rgba(0, 0, 0, 0.24);
            }

            legend{
                color: #9C1B1F;
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                font-size: 28px;
            }

            label{
                color: #9C1B1F;
                font-size: 22px;
                font-weight: bold;
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            }

            input{
                margin: auto;
                margin: 8px 0px 8px;
				padding: 4px 15px 4px;
                color: #9C1B1F;
                text-align: center;
				font-size: 20px;
            }

            form i{
                font-size: 30px;
                color:#9C1B1F;
            }

            #submit{
                color: white;
                background-color: rgba(156, 27, 31, 0.8);
                min-width: 20px;
            }

            select{
                height: 35px;
                color: #9C1B1F;
                font-size: 18px;
                font-family: Arial, Helvetica, sans-serif;
                text-align-last: center;
                -moz-text-align-last: center;
                -ms-text-align-last: center;
            }

            option{
                color: #9C1B1F;
                font-size: 18px;
                font-family: Arial, Helvetica, sans-serif;
            }

            #navButtons{
                position: relative;
                margin: auto;
                margin-left: 5%;
                text-align: center;
                max-width: 100%;
                margin-top: 5%;
                float: right;
            }

            #navButtons a{
                text-decoration: none;
                color: #9C1B1F;
                font-family: Helvetica, sans-serif;
                font-size: calc(16px + 0.5vw);
            }

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

            #pop a{
                text-decoration: none;
                color: white;
                font-family: Helvetica, sans-serif;
                font-size: calc(16px + 0.5vw);
            }

            #logo{
                height: 100%;
                width: 100%;
            }
            
            

        </style>

    </head>

    <body>

        <div class = "container">

                <div id="top" class="row">

                        <div class="col-sm-3" >
                        
                            <img src="http://www.tableready.net/wp-content/uploads/2019/03/cropped-logo-big-768x199.png" id="logo">
                        
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-7" id="navbar" span="">
                                <div id="navButtons" class="col-xs-3"> <b><a href="homepage.html">Home</a></b> </div>
                                
                                <div id="navButtons" class="col-xs-3"> <b><a href="#aboutus">About&nbsp;Us</a></b> </div>
                                <div id="pop" class="col-xs-3"> <b><a href="login.php">Login</a></b> </div>
                                <!--<div id="navButtons" class="col-xs-3"> <b><a href="#aboutus">Log&nbsp;In</a></b> </div> -->
                        </div>
                        
                        
                        
                </div>

            <br><br>

            <div id="login-block">

                <form method="post">

                    <div id="row">

                        <div id="col-lg-12">
                            <b><legend>SIGN UP FOR OWNER ONLY</legend></b> 
                        </div>
					</div>

					
					<div id="row">
                        
							<div id="col-lg-12">
								<i class="fa fa-caret-square-o-right" style="font-size: 30px"></i>
								<input type="text" name="fName" id="fname" placeholder="FirstName" required><br> <br>
	
							</div>
						
						</div>

						<div id="row">
                        
								<div id="col-lg-12">
										<i class="fa fa-caret-square-o-right" style="font-size: 30px"></i>
									<input type="text" name="lName" id="lname" placeholder="LastName" required><br> <br>
		
								</div>
							
							</div>

							<div id="row">

									<div id="col-lg-12">
		
										<i class="fa fa-caret-square-o-right" style="font-size: 30px"></i>
										<input type="text" name="res_name" id="res_name" placeholder="Restaurant Name" required><br><br>
		
									</div>
		
							</div>

                    <div id="row">
                        
                        <div id="col-lg-12">

                            <i class="fa fa-user-o" style="font-size: 30px"></i>
                            &nbsp;
                            <input type="text" name="username" id="username" placeholder="Username" required><br> <br>

                        </div>
                    
                    </div>

                    <div id="row">

                            <div id="col-lg-12">

                                <i class="fa fa-key icon" style="font-size: 30px"></i>
                                <input type="password" name="password" id="password" placeholder="Password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;" required><br><br>

                            </div>

					</div>
					<div id="row">

                            <div id="col-lg-12">

                                <i class="fa fa-check-circle-o" style="font-size: 30px"></i>
                                <input type="password" name="conf_password" id="conf_password" placeholder="Confirm Password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" placeholder="Re-enter password" required><br><br>

                            </div>

					</div>

					<div id="row">

                            <div id="col-lg-12">

                                <i class="fa fa-envelope-o" style="font-size: 30px"></i>
                                <input type="email" name="email" id="email" placeholder="Email" required><br><br>

                            </div>

					</div>


                    <div id="row">

                        <div id="col-lg-12">

                            <input type="submit" id="submit" name="submit" value="Submit">
                            <br>
                        </div>
                    
                    </div>

                </form>

            </div>

        </div>

    </body>

</html>