<?php

	session_start();
	if(isset($_SESSION['name'])){
		
		$username = $_SESSION['name'];
			
		$conn = mysqli_connect('localhost', 'root', '', 'managementdb');
		$sql = "SELECT * FROM `payment` WHERE `std-username`='$username'";
		$result=mysqli_query($conn, $sql);
		$result_w=mysqli_fetch_array($result);	
		
		$id = $result_w[0];
		$ac_name = $result_w[2];
		
		if(isset($_POST['submitDone'])){
			header("location:std_profile.php");		
		}
	}
	else{
		session_unset();
		session_destroy();
		header('location:login.php');
	}
?>


<title> Payment Confirmation</title>
<style>
			body{
				background:url('Background.jpg');
				background-size:fullscreen;
				background-repeat:no-repeat;
				margin:0;
				padding:0;
				font-family:Arial;
			}
			.confirm-page{
				margin:auto;
				width:550px;
				box-shadow:0px 8px 16px 0px rgba(0,0,0,0.9);
				padding:60px 40px;
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
		
		<div class="confirm-page">
		<form action="paymentconfirm.php" method="post">
			<div class="page-header" style="background-color: #BBBBC3; height: 50px;" align="center">
					<h3 style="padding: 10px;">Confirmation!</h3>
			</div>
			<hr>
			<div align="center" style="height: 310px;">
				<img src="tick_logo.png" >
				<h4>Your Payment has been scheduled!!</h4>
				
				<table align="left" style="padding: 10px;">
					<tr>
						<th></th>
						<th></th>
					</tr>
					
					<tr>
						<td>
						Confirmation Number: 
						</td>
						<td>
						<input type="text" name="txtConfirmNum" value="<?php echo $id ?>" readonly>
						</td>
					</tr>
					
					<tr>
						<td>
							To:
						</td>
						<td>
							<input type="text" name="txtTo" value="<?php echo $username ?>" readonly>
						</td>
					</tr>
					<tr>
						<td>
							From:
						</td>
						<td>
							<input type="text" name="txtFrom" value="<?php echo $ac_name ?>" readonly>
						</td>
					</tr>
					<tr>
						<td>
							Total Amount:
						</td>
						<td>
							<input type="text" name="txtAmount" value = "50000" readonly>
						</td>
					</tr>
					
					<tr>
						<td>
							Payment Date:
						</td>
						<td>
							<input type="text" name="txtDate" value="NULL" readonly>
						</td>
					</tr>
					
					<tr>
						<td>
						</td>
						<td>
						</td>
					</tr>
					
				</table>
				
			</div>
			<h5 style="color: #DE3F10;">* Your peyment will be updated within 24 hours.<h5>
			<div align="center">
			<input type="submit" name="submitDone" value="Done" style="width: 100px;">
			</div>
		</form>
		</div>
	</body>