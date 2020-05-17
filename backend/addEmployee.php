<?php
    include('dbConnection.php');
    session_start();
    echo $_SESSION['restaurant_ID'];
    echo "hello";
    $id = $_SESSION['restaurant_ID'];
    echo $id;
    //$update = "UPDATE restaurant_info SET phone_number='123123', address = 'yoo132123oo' WHERE restaurant_ID='".$_SESSION['restaurant_ID']."'";
    //$result = mysqli_query($conn, $update);
    
    ///if ($conn->query($result) === TRUE) {
    //    echo "Logged in";
    //}
    //else{
    //    echo "Login failed!" . $conn->error;
    //}
?>

<!DOCTYPE html>
<html>
<header>
	<h1>TableReady</h1>
	
	<div id="loginlink">
		<a href="../index.html">Home</a>
	</div>
	
</header>
<body>
		<div id="login">
			<br>
			<strong>Please Login</strong>
			<br>
			<br>
				<form method="post" action="" >
					<br />
					<strong>Username </strong>
					<input type="text" id="name" name="username" autofocus />
					<br><br>
					<strong>Email </strong>
					<input type="text" name="email" id="email" />
					<br>
					<br>
                    <strong>Password</strong>
                    <input type="password" id="pass" name="password"/>
					<br>
					<br>
                    <strong>Re type Password</strong>
                    <input type="password" id="cnfpassword" name="cnfpassword" />
					<br>
					<br>
					<br>
                    <strong>First Name</strong>
                    <input type="text" id="fName" name="fName"/>
					<br>
					<br>
                    <strong>Last Name</strong>
                    <input type="text" id="lName" name="lName"/>
					<br>
					<br>
                    <strong>Restaurant Name</strong>
                    <input type="text" id="restaurant" name="restaurant_name" value=<?= $_SESSION['restaurant_name']?> disabled/>
					<br>
					<input type="submit" > 
					<input type="Reset">
				</form>

</body>

</html>