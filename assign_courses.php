<?php

	session_start();
	if(isset($_SESSION['job'])){

		//session_start();
		$userjob = $_SESSION['job'];
		
		$conn = mysqli_connect('localhost', 'root', '', 'managementdb');
		
		$course1 = "";
		$tc_name1 = "";
		$credit1 = "";
		
		$course2 = "";
		$tc_name2 = "";
		$credit2 = "";
		
		$course3 = "";
		$tc_name3 = "";
		$credit3 = "";
		$total_credit = 0;
		
		if(isset($_POST['btnback'])){
			$_SESSION['job'] = $userjob;
			header('location:adminprofile.php');
		}
		
		if(isset($_POST['btnload'])){
			$course1 = $_POST['coursename1'];
			$sql1 = "SELECT * FROM `courses` WHERE `course-name`='$course1'";
			$result=mysqli_query($conn, $sql1);
			$result_w=mysqli_fetch_array($result);
			$tc_name1 = $result_w[3];
			$credit1 = $result_w[2];
			$tc_username1 = $result_w[4];
			
			$course2 = $_POST['coursename2'];
			$sql2 = "SELECT * FROM `courses` WHERE `course-name`='$course2'";
			$result=mysqli_query($conn, $sql2);
			$result_w=mysqli_fetch_array($result);
			$tc_name2 = $result_w[3];
			$credit2 = $result_w[2];
			$tc_username2 = $result_w[4];
			
			$course3 = $_POST['coursename3'];
			$sql3 = "SELECT * FROM `courses` WHERE `course-name`='$course3'";
			$result=mysqli_query($conn, $sql3);
			$result_w=mysqli_fetch_array($result);
			$tc_name3 = $result_w[3];
			$credit3 = $result_w[2];
			$tc_username3 = $result_w[4];
		}
	
		if(isset($_POST['submitbtn'])){
			
			$course1 = $_POST['coursename1'];
			$sql1 = "SELECT * FROM `courses` WHERE `course-name`='$course1'";
			$result=mysqli_query($conn, $sql1);
			$result_w=mysqli_fetch_array($result);
			$tc_name1 = $result_w[3];
			$credit1 = $result_w[2];
			$tc_username1 = $result_w[4];
			
			$course2 = $_POST['coursename2'];
			$sql2 = "SELECT * FROM `courses` WHERE `course-name`='$course2'";
			$result=mysqli_query($conn, $sql2);
			$result_w=mysqli_fetch_array($result);
			$tc_name2 = $result_w[3];
			$credit2 = $result_w[2];
			$tc_username2 = $result_w[4];
			
			$course3 = $_POST['coursename3'];
			$sql3 = "SELECT * FROM `courses` WHERE `course-name`='$course3'";
			$result=mysqli_query($conn, $sql3);
			$result_w=mysqli_fetch_array($result);
			$tc_name3 = $result_w[3];
			$credit3 = $result_w[2];
			$tc_username3 = $result_w[4];
			
			$username = $_POST['txtname'];
			$semester = $_POST['select_semester'];
			$gpa = " ";
			
			$sql="SELECT count(id) as total FROM `student-courses`";
			$result1=mysqli_query($conn, $sql);
			$values=mysqli_fetch_assoc($result1);
			$rows=$values['total'];
			if(!empty($course1)){ 
				$rows= $rows+1;
				$sql="INSERT INTO `student-courses`(`id`, `std-username`, `course-name`, `course-teacher`, `tchr-username`, `credit`, `semester`, `gpa`)
				VALUES ($rows, '$username', '$course1', '$tc_name1', '$tc_username1', $credit1, '$semester', '$gpa')";
				mysqli_query($conn, $sql);
			}
			if(!empty($course2)){
				$rows = $rows+1;
				$sql="INSERT INTO `student-courses`(`id`, `std-username`, `course-name`, `course-teacher`, `tchr-username`, `credit`, `semester`, `gpa`)
				VALUES ($rows, '$username', '$course2', '$tc_name2', '$tc_username2', $credit2, '$semester', '$gpa')";
				mysqli_query($conn, $sql);
			}	
			if(!empty($course3)){
				$rows = $rows+1;
				$sql="INSERT INTO `student-courses`(`id`, `std-username`, `course-name`, `course-teacher`, `tchr-username`, `credit`, `semester`, `gpa`)
				VALUES ($rows, '$username', '$course3', '$tc_name3', '$tc_username3', $credit3, '$semester', '$gpa')";
				mysqli_query($conn, $sql);
			}
			$sql="SELECT count(id) as total FROM `payment`";
			$result2=mysqli_query($conn, $sql);
			$values=mysqli_fetch_assoc($result2);
			$rows = $values['total'];
			$rows = $rows + 1;
			$total_credit = $credit1 + $credit2 + $credit3;
			
			$sql = "INSERT INTO `payment`(`id`, `std-username`, `credit`, `semester`, `status`) 
			VALUES ($rows,'$username',$total_credit,'$semester','DUE')";
			mysqli_query($conn, $sql);
				
				header('location:adminprofile.php');
		}
	}else{
		session_unset();
		session_destroy();
		header('location:adminprofile.php');
	}
	
?>
	<title>Student's Couse Page</title>
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
			margin-top:25px;
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
		<form action="assign_courses.php" method="post">
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
								<h3>Student's Username : <input type="text" name="txtname"></h3>
								<hr>
							</div>
						</td>
						<td  align="right">
							<div >
								<select name="select_semester">
									<option value="spring"> Spring </option>
									<option value="summer"> Summer </option>
									<option value="fall"> Fall </option>
								</select>
							</div>
						</td>
						
					</tr>
				</table>
				<table style="width: 100%">
					<tr>
						<td> Couse Name: </td>
						<td> <input type="text" name="coursename1"  value="<?php echo $course1 ?>"> </td>
					</tr>
					<tr>
						<td> Teacher's Name: </td>
						<td> <input type="text" name="tchr-name1" value="<?php echo $tc_name1 ?>" > </td>
					</tr>
					<tr>
						<td> Credit: </td>
						<td> <input type="text" name="credit1" value="<?php echo $credit1 ?>"> </td>
					</tr>
				</table>
					
					<br/>
				<table style="width: 100%">
					<tr>
						<td> Couse Name: </td>
						<td> <input type="text" name="coursename2" value="<?php echo $course2 ?>"> </td>
					</tr>
					<tr>
						<td> Teacher's Name: </td>
						<td> <input type="text" name="tchr-name2" value="<?php echo $tc_name2 ?>" > </td>
					</tr>
					<tr>
						<td> Credit: </td>
						<td> <input type="text" name="credit2" value="<?php echo $credit2 ?>" > </td>
					</tr><br/>
				</table>
				
				<br/>
				
				<table style="width: 100%">
					<tr>
						<td> Couse Name: </td>
						<td> <input type="text" name="coursename3" value="<?php echo $course3 ?>"> </td>
					</tr>
					<tr>
						<td> Teacher's Name: </td>
						<td> <input type="text" name="tchr-name3" value="<?php echo $tc_name3 ?>" > </td>
					</tr>
					<tr>
						<td> Credit: </td>
						<td> <input type="text" name="credit3" value="<?php echo $credit3 ?>" > </td>
					</tr><br/>
				</table>
				
				<hr/>
				<table style="width: 100%">
					<tr>
						<td>  </td>
						<td align="center">
						<input type ="submit" name="btnback" value="Back">
						<input type="submit" name="btnload" value="Load">
						<input type="submit" name="submitbtn" value="Submit">
						</td>
						
					</tr>
				</table>
			</div>
			<br>
			
		
		</form>
	</div>

</body>