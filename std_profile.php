<?php
	
	session_start();
	
	if(isset($_SESSION["name"])){

		$username = $_SESSION['name'];
		
		$conn = mysqli_connect('localhost', 'root', '', 'managementdb');
		$sql="SELECT * FROM user WHERE user_id = '$username'";
		$result=mysqli_query($conn, $sql);
		$result_w=mysqli_fetch_array($result);
		$id = $result_w[3];
		$name = $result_w[1]." ".$result_w[2];
		$address = $result_w[4];
		$email = $result_w[5];
		
		//Getting status
		$sql4="SELECT `status` FROM `payment` WHERE `std-username`= '$username'";
		$result4=mysqli_query($conn, $sql4);
		$result4_w=mysqli_fetch_array($result4);
		$paid_status = $result4_w[0];
		
		//Calculating Credit
		$sql2 = "SELECT `credit` FROM `student-courses` WHERE `std-username` = '$username'";
		$result2 = mysqli_query($conn, $sql2);
		$credit = 0;
		$total_credit = 0;
		$total_cost = 0;
		while($row=mysqli_fetch_array($result2)){
			$credit = $row[0];
			$total_credit = $total_credit + $credit;
		}
		// Calculating CGPA
		$sql3 = "SELECT `gpa`, `credit` FROM `student-courses` WHERE `std-username` = '$username'";
		$result3 = mysqli_query($conn, $sql3);
		$cgpa = 0.0;
		$ans = 0.0;
		$temp = 0.0;
		while($row3=mysqli_fetch_array($result3)){
			$gpa = $row3[0];
			$temp_c = $row3[1];
			switch($gpa){
				case "A+":
					$temp = 4.00;
					break;
				case "A":
					$temp = 3.75;
					break;
				case "B+":
					$temp = 3.50;
					break;
				case "B":
					$temp = 3.25;
					break;
				case "C+":
					$temp = 3.00;
					break;	
				case "C":
					$temp = 2.75;
					break;
				case "D+":
					$temp = 2.50;
					break;
				case "D":
					$temp = 2.25;
					break;
				case "F":
					$temp = 0.00;
					break;
			}
			$ans = $temp * $temp_c;
			$cgpa = $cgpa + $ans;
		}
		
		$cgpa = $cgpa / $total_credit;
		$total_cost = ($total_credit*5000) + 5000;
		
		if(isset($_POST['course_button'])){
			
			$_SESSION['name'] = $username;
			header("location: courses_form.php");
		}
		
		if(isset($_POST['pay_button'])){
			
			$_SESSION['name'] = $username;
			header("location: Payment.php");
		}
		
		if(isset($_POST['logout_button'])){
		header("location:login.php");
		session_unset();
		session_destroy();
		}
	}
	else{
		session_unset();
		session_destroy();
		header('location:login.php');
	}
	
	
?>
	<title>Student's Profile Page</title>
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
			padding:5px 40px;
			margin-top:auto;
			background:#F1F1F9;
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
		<form action="std_profile.php" method="post">
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
				
					<td style="width: 200px">
						<div class="User-Name" style="padding: 5px;">
							<h3>Student: <?php echo $name ?></h3>
							<hr>
						</div>
					</td>
					<td  align="right">
						<div class="image-container">
							<img src="Student_profile.png" style="width:45%">
						</div>
					</td>
					
				</tr>
				</table>
				<table  style="width: 60%; padding:0px">
				<tr>
					<td>
						<h4>Student ID:</h4>
					</td>
					<td>
						<h4><?php echo $id ?></h4>
						
					</td>
				</tr>
				<tr>
					<td>
						<h4>CGPA:</h4>
					</td>
					<td>
						<h4><?php echo $cgpa ?> </h4>
					</td>
				</tr>
				<tr>
					<td>
						<h4>Credit:</h4>
					</td>
					<td>
						<h4><?php echo $total_credit ?> </h4>
					</td>
				</tr>
				<tr>
					<td>
						<h4>Program:</h4>
					</td>
					<td>
						<h4>CSE</h4>
					</td>
				</tr>
				<tr>
					<td>
						<h4>Email:</h4>
					</td>
					<td>
						<h4><?php echo $email ?></h4>
					</td>
					
				</tr>
				</table>
				<hr/>
				<table style="width: 100%">
				<tr>
					<td style="padding: 5px;">
						<h4  style="color: #3A3372;">Credit Taken: <?php echo $total_credit ?></h4>

						<h4 style="color: #3A3372;">Cost: <?php echo "BDT-".$total_cost ?> </h4>
			
						<h4 style="color: #3A3372;"> Status: <?php echo $paid_status ?></h4>
					</td>
					<td>
						<table align="right">
						<tr>
							<th></th>
							<th></th>
						</tr>
						<tr>
							<td><img src="payment_logo.png"></td>
							<td><input type="submit" name="pay_button" value='Make Payment'></td>
						</tr>
						<tr>
							<td><img src="Courses_logo.jpg"></td>
							<td><input type="submit" name="course_button" value='Show Courses'></td>
						</tr>
						
						</table>
					</td>
					
				</tr>
				</table>
				<hr/>
			</div>
			<br>
			
			<div align="center">
				<input type="submit" name="logout_button" value='Logout'>
				<br>
				<br>
			</div>
		
		</form>
	</div>

</body>