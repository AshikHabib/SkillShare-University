<?php
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'managementdb');
	
	if(isset($_POST['btnLogin'])){
		$username = $_POST['txtUsername'];
		$password = $_POST['txtPass'];
		$sql="SELECT * FROM user WHERE user_id = '$username'";
		$result=mysqli_query($conn, $sql);
		$rowcount=mysqli_num_rows($result);
		$result_w=mysqli_fetch_array($result);
		$job = $result_w['job'];
		$pass_w = $result_w['password'];

		if($rowcount){
			if($pass_w==$password){
				if($job=="teacher"){
					$_SESSION['tchr_name']=$username;
					header("location:tachr_profile.php");
				}
				else if($job == "student"){
					$_SESSION['name']=$username;
					header("location:std_profile.php");
				}
				else{
					$_SESSION['name']=$username;
					header("location:adminprofile.php");
				}
			}
		}
		
	}
	
?>
<title> Login Form </title>
	<style>
		body{
			background:url('Background.jpg');
			background-size:fullscreen;
			background-repeat:no-repeat;
			margin:0;
			padding:0;
			font-family:Arial;
		}
		.login{
			margin:auto;
			width:300px;
			box-shadow:0px 8px 16px 0px rgba(0,0,0,0.9);
			padding:80px 40px;
			margin-top:100px;;
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
	<div class="login">
		<h2> LOGIN </h2>
			<form method="post">
				<input type="text" name="txtUsername" placeholder="Enter User Name" required>
				<input type="password" name="txtPass" placeholder="Enter Password" required>
				<input type="submit" name="btnLogin" value="Log In">
				<?php 
						if(isset($_POST['btnLogin'])){
							if($rowcount){
								if($pass_w!=$password){
									echo "<center>";
									echo "<h5 style='color:RED;'>*Password is incorrect!<h5>";
									echo "</center>";
								}
							}
						}
				?>
				
				<center>
					<!--<a href="registration.php"> Don't have an account? Register Here!</a>-->
				</center>
			</form>
	</body>