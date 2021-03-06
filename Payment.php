<?php

	session_start();
	if(isset($_SESSION['name'])){
		
		$username = $_SESSION['name'];
			
		$conn = mysqli_connect('localhost', 'root', '', 'managementdb');
		$sql = "SELECT * FROM `user` WHERE `user_id` = '$username'";
		$result=mysqli_query($conn, $sql);
		$result_w=mysqli_fetch_array($result);	
		
		$f_name = $result_w[1];
		$l_name = $result_w[2];
		$email = $result_w[5];
		
		if(isset($_POST['cancelbutton'])){
			header("location:std_profile.php");		
		}
	}
	else{
		session_unset();
		session_destroy();
		header('location:login.php');
	}
?>

<title> Payment Form </title>
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
		<div  class="studentInfo" align="center">
			
			<form action="Payment.php" method="post">
				<fieldset style="width: 500px;" align="center">
					<legend><h4>Student Information</h4></legend>
					<table style="width: 100%; padding: 15px;">
						<tr>
							<th></th>
							<th></th>
						</tr>
						
						<tr>
							<td>First Name:</td>
							<td>
							<input type="text" name="FirstName" value="<?php echo $f_name ?>" readonly><br>
							</td>
						</tr>
						
						<tr>
							<td>
							Last Name: 
							</td>
							<td>
							<input type="text" name="LastName" value="<?php echo $l_name ?>" readonly><br>
							</td>
						</tr>
						
						<tr>
							<td>
							ID: 
							</td>
							<td>
							<input type="text" name="stID" value="<?php echo $username ?>" readonly><br>
							</td>
						</tr>
						<tr>
							<td>
							Email Address: 
							</td>
							<td>
							<input type="text" name="email" value="<?php echo $email ?>" readonly><br>
							</td>
						</tr>
						
					</table>	
				</fieldset>
				<br>
				<br>
				
				<hr style="width: 530px;" align="center">
				
				<fieldset style="width: 500px;" align="center">
					<legend><h4>Payment Information</h4></legend>
					<table style="width: 100%; padding: 15px;">
						<tr>
							<th></th>
							<th></th>
						</tr>
						
						<tr>
							<td>Card Holder's Name:</td>
							<td>
							<input type="text" name="cardOwner"><br>
							</td>
						</tr>
						
						<tr>
							<td>
							Card Number: 
							</td>
							<td>
							<input type="text" name="cardNumber" ><br>
							</td>
						</tr>
						
						<tr>
							<td>
							CVV: 
							</td>
							<td>
							<input type="text" name="cvvID"><br>
							</td>
						</tr>
						<tr>
							<td>
							Semester: 
							</td>
							<td>
							<input type="text" name="txtsemester"><br>
							</td>
						</tr>
						<tr>
							<td>
							Amount 
							</td>
							<td>
							<input type="text" name="paymentAmount"><br>
							</td>
						</tr>
						<tr>
							<td>
							Confirm Amount: 
							</td>
							<td>
							<input type="text" name="confirmAmount" ><br>
							</td>
						</tr>
						<tr>
							<td>
							</td>
							<td>
							</td>
						</tr>
						
					</table>	
					
				</fieldset>
				<br>
				<br>
				
				<input type="submit" name="submitAmount" value="Submit" align="center">
				<input type="submit" name="cancelbutton" value="Cancel" align="center"><br>
				
				<?php
					if(isset($_POST['submitAmount'])){
						$semester = $_POST['txtsemester'];
						$ac_holder = $_POST['cardOwner'];
						$amount = $_POST['paymentAmount'];
						$c_amount = $_POST['confirmAmount'];
						$sql = "SELECT * FROM `payment` WHERE `std-username`='$username' AND `semester`='$semester'";
						$result=mysqli_query($conn, $sql);
						$result_w=mysqli_fetch_array($result);
						$status = $result_w[5];
						if(!(strcmp("$status", "DUE")) && !(strcmp("$amount", "$c_amount"))){
							$sql2 ="UPDATE `payment` SET `ac_holder`='$ac_holder',`status`='PAID' WHERE `std-username`='$username'";
							mysqli_query($conn, $sql2);
							
							$_SESSION['name'] = $username;
							header("location:paymentconfirm.php");	
						}
						else{
							echo "<center>";
							echo "<h5 style='color:RED;'>*Payment Already Done!<h5>";
							echo "</center>";
						}
							
					}
				?>
				
			</form>
		</div>
		<br>
		<br>
	</div>
</body>