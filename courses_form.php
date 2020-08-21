<?php
	
	session_start();
	if(isset($_SESSION['name'])){
		$username = $_SESSION['name'];
		
		$conn = mysqli_connect('localhost', 'root', '', 'managementdb');
		$sql="SELECT * FROM `student-courses` WHERE `std-username` = '$username'";
		$result=mysqli_query($conn, $sql);
		
		
		
		if(isset($_POST['btnCancel'])){
			$_SESSION['name'] = $username;
			header("location: std_profile.php");
		}
	}
	else{
		session_unset();
		session_destroy();
		header('location:login.php');
	}
	
	
	
	
?>

<title>Courses View</title>
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
			width:800px;
			box-shadow:0px 8px 16px 0px rgba(0,0,0,0.9);
			padding:10px 40px;
			margin-top:30px;
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
		<form action="courses_form.php" method="post">
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
			
			<div class="user_info" align="left">
				<table style="width: 100%; border:1px; border-collapse: collapse;">
					<tr>
						<th style="background-color: #4CAF50; color: white; text-align: left;
							padding: 8px;"><h4 align="center">ID</h4></th>
						<th style="background-color: #4CAF50; color: white; text-align: left;
							padding: 8px;"><h4 align="center">Course Name</h4></th>
						<th style="background-color: #4CAF50; color: white; text-align: left;
							padding: 8px;"><h4 align="center">Teacher's Name</h4></th>
						<th style="background-color: #4CAF50; color: white; text-align: left;
							padding: 8px;"><h4 align="center">Credit</h4></th>
						<th style="background-color: #4CAF50; color: white; text-align: left;
							padding: 8px;"><h4 align="center">Semester</h4></th>
						<th style="background-color: #4CAF50; color: white; text-align: left;
							padding: 8px;"><h4 align="center">GPA</h4></th>
					</tr>
					<?php
						while($row=mysqli_fetch_array($result)){
							$id = $row[0];
							$c_name = $row[2];
							$t_name = $row[3];
							$credit = $row[5];
							$semester = $row[6];
							$cgpa = $row[7];
							echo "<tr>";
							echo "<td style='text-align: center;padding: 8px;'> {$id} </td>";
							echo "<td style='text-align: center;padding: 8px;'> {$c_name} </td>";
							echo "<td style='text-align: center;padding: 8px;'> {$t_name} </td>";
							echo "<td style='text-align: center;padding: 8px;'> {$credit} </td>";
							echo "<td style='text-align: center;padding: 8px;'> {$semester} </td>";
							echo "<td style='text-align: center;padding: 8px;'> {$cgpa} </td>";
							echo "</tr>";
						}
					?>
				</table>
				<hr/>
			</div>
			<br>
			
			<div align="center">
				<input type="submit" name="btnCancel" value="Back">
				<br>
				<br>
			</div>
		
		</form>
	</div>

</body>