<?php
	
	session_start();
	//echo "<a href='loginTest.php?e=1'>Logout</a><br>";
	if(isset($_SESSION['name'])){

		//session_start();
		$username = $_SESSION['name'];
		//echo $username;
		if(isset($_POST['btn_addstudent'])){
			$_SESSION['job'] = "student";
			header("location: registration.php");
			//session_unset();
			//session_destroy();
		}
		else if(isset($_POST['btn_addteacher'])){
			$_SESSION['job'] = "teacher";
			header("location: registration.php");
			//session_unset();
			//session_destroy();
		}
		
		else if(isset($_POST['btn_assigncourses'])){
			$_SESSION['job'] = "courses";
			header("location: assign_courses.php");
			//session_unset();
			//session_destroy();
		}
		else if(isset($_POST['btn_addcourses'])){
			$_SESSION['name'] = $username;
			header("location: add_courses.php");
			//session_unset();
			//session_destroy();
		}
		
		if(isset($_POST['admin_logout'])){
			
			header("location:login.php");
			session_unset();
			session_destroy();
			
		}
		$conn = mysqli_connect('localhost', 'root', '', 'managementdb');
		$sql="SELECT * FROM user WHERE user_id = '$username'";
		$result=mysqli_query($conn, $sql);
		$result_w=mysqli_fetch_array($result);
		$name = $result_w[1]." ".$result_w[2];
	}else{
		session_unset();
		session_destroy();
		header('location:login.php');
	}
	
	
?>

<title>Admin Profile Page</title>
	<style>
		body{
			background:url('Background.jpg');
			background-size:fullscreen;
			background-repeat:no-repeat;
			margin:0;
			padding:0;
			font-family:Arial;
		}
		.profile-view{
			margin:auto;
			width:600px;
			box-shadow:0px 8px 16px 0px rgba(0,0,0,0.9);
			padding:5px 40px;
			margin-top:auto;
			background:#F1F1F9;
			background:linear-gradient(top, #3c3c3c 0%, #222222 100%);
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
	</style>
</head>

<body>
	
	<div class="profile-view">
		<form action="adminprofile.php" method="post">
			<div class="top-view" align="left">
				<table>
				<tr>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<td><img src="versity_logo.jpg"></td>
					<td><h2 style="color: #6C19A3;" >SkillShare <br/> University</h2>
					</td>
				</tr>
				</table>
				<hr/>
			</div>
			
			<div class="user-info" align="left">
				<table style="width: 100%">
				<tr>
					<th></th>
					<th></th>
				</tr>
				<tr>
				
					<td>
						<div class="User-Name" style="padding: 10px;">
							<h3>Admin: <?php echo $name?></h3>
							<hr>
						</div>
					</td>
					<td  align="right">
						<div class="image-container">
							<img src="Admin_profile.jpg" style="width=40%">
						</div>
					</td>
					
				</tr>
				<tr>
					
					<td>
						<table style="width: 100%">
							<tr>
								<td><img src="Student_logo.jpg"></td>
								<td><input type="submit" name="btn_addstudent" value='Add Students'></td>
							</tr>
							<tr>
								<td><img src="Teachers_logo.png"></td>
								<td><input type="submit" name="btn_addteacher" value='Add Teachers'></td>
							</tr>
							<tr>
								<td><img src="Courses_logo.jpg"></td>
								<td><input type="submit" name="btn_addcourses" value='Add Courses'></td>
							</tr>
							<tr>
								<td><img src="Courses_logo.jpg"></td>
								<td><input type="submit" name="btn_assigncourses" value='Assign Courses'></td>
							</tr>
						
						</table>
					</td>
					<td></td>
					
				</tr>
				</table>
				<hr/>
			</div>
			<br>
			
			<div align="center">
				<input type="submit" name="admin_logout" value="Logout">
				<br>
				<br>
			</div>
		
		</form>
	</div>

</body>