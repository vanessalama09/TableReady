<?php
    include '../backend/dbConnection.php';
    session_start();
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * from superadmin where username='".$username."' AND password = '".$password."' limit 1";

        $result = mysqli_query($conn, $sql);
        echo mysqli_num_rows($result);
        if(mysqli_num_rows($result) == 1){
            echo "Logged in";
            $row = mysqli_fetch_assoc($result);
            $name = $row["first_name"] . " " . $row["last_name"];
            $_SESSION['username']= $username;
            $_SESSION['name'] = $name;
            header("location: superadmin.php");
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Please retry to login, username and/or password is incorrect")';
            echo '</script>';
            //echo "Login failed!". $conn->error;
            //exit();
        
        }
    }
    
    
    mysqli_close($conn);

?>
<!DOCTYPE html>
<html>
    <head>

        <title>Superadmin login</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


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
                width: 40%;
                float: none;
                margin: 0 auto;
                height: 450px;
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
                margin: 20px 0px 20px;
                color: #9C1B1F;
                text-align: center;
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
                                <!--<div id="navButtons" class="col-xs-3"> <b><a href="">Home</a></b> </div> -->
                                
                                <div id="navButtons" class="col-xs-3"> <b><a href="../frontend/homepage.html#aboutus">About&nbsp;Us</a></b> </div>
                                <div id="pop" class="col-xs-3"> <b><a href="../frontend/homepage.html">Home</a></b> </div>
                                <!--<div id="navButtons" class="col-xs-3"> <b><a href="#aboutus">Log&nbsp;In</a></b> </div> -->
                        </div>
                        
                        
                        
                </div>

            <br><br>

            <div id="login-block">

                <form  method="post">

                    <div id="row">

                        <div id="col-lg-12">
                            <b><legend>LOGIN FOR SUPERADMIN</legend></b> 
                        </div>
                    </div>

                    <div id="row">
                        
                        <div id="col-lg-12">

                            <i class="fa fa-user icon" style="font-size: 30px"></i>
                            &nbsp;
                            <input type="text" name="username" id="username" placeholder="Username"><br> <br>

                        </div>
                    
                    </div>

                    <div id="row">

                            <div id="col-lg-12">

                                <i class="fa fa-key icon" style="font-size: 30px"></i>
                                <input type="password" name="password" id="password" placeholder="Password"><br><br>

                            </div>

                    </div>

                    <div id="row">
                        
                        <div id="col-lg-12">

                            <label>Position</label>
                            <br>

                            <select name="role" id="role">
                                <option value="1" name="owner">Superadmin</option>
                            </select> <br><br>

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