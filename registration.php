<?php

	session_start();
	if(isset($_SESSION['job'])){

		//session_start();
		$userjob = $_SESSION['job'];
		
		$conn = mysqli_connect('localhost', 'root', '', 'managementdb');
	}else{
		session_unset();
		session_destroy();
		header('location:adminprofile.php');
	}
	
?>

<title> Registration Form </title>
	<style>
		body{
			background:url('Background.jpg');
			background-size:fullscreen;
			background-repeat:no-repeat;
			margin:10;
			padding:10;
			font-family:Arial;
		}
		.registration{
			margin:auto;
			width:400px;
			box-shadow:0px 8px 16px 0px rgba(0,0,0,0.9);
			padding:40px 40px;
			margin-top:auto;
			background:linear-gradient(top, #3c3c3c 0%, #222222 100%);
			background:-webkit-linear-gradient(top, #3c3c3c 0%, #222222 100%);
		}
		h2{
			margin:0 0 30px 0;
			padding:05px;
			color:#efed40;
			text-align:center;
		}
		input{
			width:100%;
			margin-bottom:30px;
		}
		input[type=text], input[type=password]{
			border:none;
			outline:none;
			border:2px #fff dotted;
			background:transparent;
			border-radius:20px;
			box-sizing:border-box;
			color:#fff;
			font-size:16px;
			padding:10px;
			text-align:center;
		}
		::placeholder{
			color:rgba(255,255,255,0.5);
			text-align:center;
		}
		input[type=submit]{
			border:none;
			outline:none;
			padding:10px;
			color:#fff;
			font-size:16px;
			font-family:Arial;
			background:#ff267e;
			cursor:pointer;
			border-radius:20px;
		}
		input[type=submit]:hover{
			background:#efed40;
			color:#262626;
		}
		a{
			color:#fff;
			font-size:15px;
			font-weight:bold;
			text-decoration:none;
			text-align:center;
		}
		a:hover{
			text-decoration:underline;
		}
	</style>
</head>
	<body>
	<div class="registration">
		<h2> REGISTRATION FORM </h2>
			<form action="registration.php" method="post">
				<input type="text" name="txtFirstname" placeholder="First Name">
				
				<input type="text" name="txtLastname" placeholder="Last Name">
				<input type="text" name="txtUserName" placeholder="User Name" required>
				<input type="text" name="txtAddress" placeholder="Address">
				<input type="text" name="txtJob" value="<?php echo $userjob ?>" readonly>
				<input type="text" name="txtEmail" placeholder="Email" required>
				<input type="password" name="txtPass" placeholder="Enter Password" required>
				<input type="password" name="txtConfirmPass" placeholder="Confirm Password" required>
				
				<input type="submit" name="btnRegister" value="Register Now">
				
				<?php 
						
						if(isset($_POST['btnRegister'])){
							$firstname = $_POST['txtFirstname'];
							$lastname = $_POST['txtLastname'];
							$username = $_POST['txtUserName'];
							$address = $_POST['txtAddress'];
							$job = $userjob;
							$email = $_POST['txtEmail'];
							$password = $_POST['txtPass'];
							$c_password = $_POST['txtConfirmPass'];
							if($password != $c_password){
								echo "<center>";
								echo "<h5 style='color:RED;'>*Password doesn't match!<h5>";
								echo "</center>";
							}
							else if (!preg_match("/^[a-zA-Z ]*$/",$firstname) || !preg_match("/^[a-zA-Z ]*$/",$lastname)){
								echo "<center>";
								echo "<h5 style='color:RED;'>Only letters and white space allowed</h5>";
								echo "</center>";
							}
							else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
								echo "<center>";
								echo "<h5 style='color:RED;'>Invalid email format</h5>"; 
								echo "</center>";
							}
							else{
								$sql="SELECT count(id) as total FROM user";
								$result=mysqli_query($conn, $sql);
								$values=mysqli_fetch_assoc($result);
								$rows=$values['total'];
								$rows= $rows+1;
								//echo $rows;
								$sql="SELECT * FROM user WHERE user_id = '$username'";
								$result=mysqli_query($conn, $sql);
								$rowcount=mysqli_num_rows($result);
								if($rowcount==0){
									$sql="INSERT INTO user(id, first_name, last_name, user_id, address, email, password, job) 
										VALUES ($rows, '$firstname', '$lastname', '$username', '$address', '$email', '$password', '$job')";
									mysqli_query($conn, $sql);
									header('location:adminprofile.php');
								}
								//else echo "user name already exists.";
								else{
									echo "<center>";
									echo "<h5 style='color:RED;'>Username already exists!<h5>";
									echo "</center>";
								}
							}
						}
				?>
				
				<center>
					<!--<a href="login.php"> Already have an account? Log In Here!</a>-->	
				</center>
			</form>
	</body>