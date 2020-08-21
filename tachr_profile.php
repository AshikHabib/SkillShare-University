<?php
	session_start();

	if(isset($_SESSION["tchr_name"])){

		$username = $_SESSION['tchr_name'];

		if(isset($_POST['btn_studentview'])){
			
			$_SESSION['tchr_name'] = $username;
			header("location: Student_view.php");
			
			
			
			/*$conn = mysqli_connect('localhost', 'root', '', 'managementdb');
			$sql="SELECT * FROM user WHERE job = 'student'";
			$result=mysqli_query($conn, $sql);
			echo "<table border ='1px'>";
			while($row=mysqli_fetch_array($result)){
				$id = $row[0];
				$name = $row[1]." ".$row[2];
				$address = $row[4];
				$email = $row[5];
				echo "<tr>";
				echo "<td> {$id} </td>";
				echo "<td> {$name} </td>";
				echo "<td> {$address} </td>";
				echo "<td> {$email} </td>";
				echo "</tr>";
			}
			echo "</table>";*/
		}
		
		if(isset($_POST['btn_logout'])){
			
			header("location:login.php");
			session_destroy();
			
		}
		$conn = mysqli_connect('localhost', 'root', '', 'managementdb');
		$sql="SELECT * FROM user WHERE user_id = '$username'";
		$result=mysqli_query($conn, $sql);
		$result_w=mysqli_fetch_array($result);
		$id = $result_w[3];
		$name = $result_w[1]." ".$result_w[2];
		$address = $result_w[4];
		$email = $result_w[5];
	}else{
		session_unset();
		session_destroy();
		header('location:login.php');
	}
	
?>	
	<head>
	<title>Teacher's Profile Page</title>
	
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
			width:550px;
			box-shadow:0px 8px 16px 0px rgba(0,0,0,0.9);
			padding:57px 40px;
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
			<form method="post">
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
					
						<td style="width: 170px">
							<div class="User-Name" style="padding: 10px;">
								<h3>Teacher: <?php echo $name ?></h3>
								<hr>
							</div>
						</td>
						<td  align="right">
							<div class="image-container">
								<img src="Teacher_profile.png" style="width:45%">
							</div>
						</td>
						
					</tr>
					<tr>
						<td>
							Email:
						</td>
						<td>
							<input type="text" name="txtEmail" value="<?php echo $email ?>"readonly>
						</td>
					</tr>
					
					<tr>
						<td>
							 Address:
						</td>
						<td>
							<input type="text" name="txtContact"  value="<?php echo $address ?>" readonly>
						</td>
					</tr>
					
	
					<tr>
						<td>
							Room Number:
						</td>
						<td>
							<input type="text" name="txtRoomInfo" value="TBA"readonly>
						</td>
					</tr>
					
					<tr>
						<td style="padding: 15px;">
							
						</td>
						<td>
							<table align="right">
							<tr>
								<th></th>
								<th></th>
							</tr>
							<tr>
								<td><img src="Student_logo.jpg"></td>
								<td><input type="submit" name="btn_studentview" value='View Student'></td>
							</tr>
							
							</table>
						</td>
						
					</tr>
					</table>
					<hr/>
				</div>
				<br>
				
				<div align="center">
					<input type="submit" name="btn_logout" value='Logout'>
					<br>
					<br>
				</div>
			
			</form>
		</div>

	</body>
