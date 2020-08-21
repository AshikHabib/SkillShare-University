<?php

	session_start();
	if(isset($_SESSION['name'])){
		
		$username = $_SESSION['name'];
		
		$conn = mysqli_connect('localhost', 'root', '', 'managementdb');
		$sql="SELECT count(`course-id`) as total FROM `courses`";
		$result1=mysqli_query($conn, $sql);
		$values=mysqli_fetch_assoc($result1);
		$rows=$values['total'];
		$rows = $rows+1;
		
		
		if(isset($_POST['cancelbutton'])){
			header("location: adminprofile.php");		
		}
		if(isset($_POST['submitAmount'])){
			
			$course_name= $_POST['course_name'];
			$tchr_id = $_POST['teacher_id'];
			$tchr_name = $_POST['teacher_name'];
			$credit = $_POST['credit'];
			if(!empty($course_name)){
				$sql2="INSERT INTO `courses`(`course-id`, `course-name`, `credit`, `course-teacher`, `tchr-username`) 
				VALUES ($rows,'$course_name','$credit','$tchr_name','$tchr_id')";
				mysqli_query($conn, $sql2);
				
				header("location: adminprofile.php");
			}			
		}
	}
	else{
		session_unset();
		session_destroy();
		header('location:login.php');
	}
?>

<title> Courses Form </title>
	<style>
		body{
			background:url('Background.jpg');
			background-size:fullscreen;
			background-repeat:no-repeat;
			margin:0;
			padding:0;
			font-family:Arial;
		}
		.main-page{
			margin:auto;
			width:550px;
			box-shadow:0px 8px 16px 0px rgba(0,0,0,0.9);
			padding:10px 40px;
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
	<div class="main-page">
	
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
		<div  class="CourseInfo" align="center">
			
			<form action="add_courses.php" method="post">
				<fieldset style="width: 500px;" align="center">
					<legend><h4>Course Information</h4></legend>
					<table style="width: 100%; padding: 15px;">
						<tr>
							<th></th>
							<th></th>
						</tr>
						
						<tr>
							<td>Couse's ID:</td>
							<td>
							<input type="text" name="course_id" value="<?php echo $rows ?>"><br>
							</td>
						</tr>
						
						<tr>
							<td>Couse's Name:</td>
							<td>
							<input type="text" name="course_name" required><br>
							</td>
						</tr>
						
						<tr>
							<td>
							Teacher's ID: 
							</td>
							<td>
							<input type="text" name="teacher_id" required><br>
							</td>
						</tr>
						
						<tr>
							<td>
							Teacher's Name: 
							</td>
							<td>
							<input type="text" name="teacher_name" required><br>
							</td>
						</tr>
						<tr>
							<td>
							Credit: 
							</td>
							<td>
							<input type="text" name="credit" required><br>
							</td>
						</tr>
						
					</table>	
				</fieldset>
				<br>
				<br>
				
				<hr style="width: 530px;" align="center">
				
				<input type="submit" name="submitAmount" value="Submit" align="center">
				<input type="submit" name="cancelbutton" value="Cancel" align="center"><br>
				
			</form>
		</div>
		<br>
		<br>
	</div>
</body>