<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['bbdmsdid']==0)) {
  header('location:logout.php');
  } else{

 if(isset($_POST['update']))
  {
    $uid=$_SESSION['bbdmsdid'];
    $name=$_POST['fullname'];
    $mno=$_POST['mobileno']; 
    $emailid=$_POST['emailid'];
    $age=$_POST['age']; 
    $gender=$_POST['gender'];
    $bloodgroup=$_POST['bloodgroup']; 
    $address=$_POST['address'];
    $message=$_POST['message']; 
    $profileImage = $row->ProfileImage ?? null;
    if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $imgName = time() . '_' . basename($_FILES['profile_image']['name']);
        $targetDir = 'images/profiles/';
        if (!file_exists($targetDir)) { mkdir($targetDir, 0777, true); }
        $targetFile = $targetDir . $imgName;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        $allowedTypes = ['jpg','jpeg','png','gif'];
        if(in_array($imageFileType, $allowedTypes)) {
            if(move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)) {
                $profileImage = $imgName;
            }
        }
    }
    $sql="update tbldonars set FullName=:name,MobileNumber=:mno, Age=:age,Gender=:gender,BloodGroup=:bloodgroup,Address=:address,Message=:message, ProfileImage=:profileImage  where id=:uid";
     $query = $dbh->prepare($sql);
     $query->bindParam(':name',$name,PDO::PARAM_STR);
     $query->bindParam(':mno',$mno,PDO::PARAM_STR);
     $query->bindParam(':age',$age,PDO::PARAM_STR);
     $query->bindParam(':gender',$gender,PDO::PARAM_STR);
     $query->bindParam(':bloodgroup',$bloodgroup,PDO::PARAM_STR);
     $query->bindParam(':address',$address,PDO::PARAM_STR);
     $query->bindParam(':message',$message,PDO::PARAM_STR);
     $query->bindParam(':profileImage',$profileImage,PDO::PARAM_STR);
     $query->bindParam(':uid',$uid,PDO::PARAM_STR);
     $query->execute();
        echo '<script>alert("Profile has been updated")</script>';
  }

  ?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Blood Bank Donar Management System !! Donor Profile</title>
	
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--// Meta tag Keywords -->

	<!-- Custom-Files -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Bootstrap-Core-CSS -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link rel="stylesheet" href="css/fontawesome-all.css">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //Custom-Files -->

	<!-- Web-Fonts -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
	    rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
	    rel="stylesheet">
	<!-- //Web-Fonts -->

	<style>
		:root {
			--primary-color: #dc3545;
			--accent-color: #2563eb;
			--bg-glass: rgba(255,255,255,0.85);
			--shadow: 0 8px 32px rgba(44,62,80,0.18);
			--border-radius: 22px;
			--header-gradient: linear-gradient(90deg, #dc3545 0%, #2563eb 100%);
		}
		body {
			font-family: 'Poppins', sans-serif;
			color: #222;
			background: linear-gradient(135deg, #e3eafc 0%, #b6c6e6 100%);
			min-height: 100vh;
		}
		.profile-main-card {
			background: var(--bg-glass);
			backdrop-filter: blur(8px);
			border-radius: var(--border-radius);
			box-shadow: var(--shadow);
			padding: 40px 32px 32px 32px;
			margin: 12px auto 32px auto;
			max-width: 600px;
			position: relative;
			border: 1.5px solid rgba(44,62,80,0.10);
		}
		.profile-header {
			text-align: center;
			margin-bottom: 0;
			position: relative;
		}
		.profile-img {
			width: 120px;
			height: 120px;
			object-fit: cover;
			border-radius: 50%;
			border: 5px solid #fff;
			box-shadow: 0 4px 24px rgba(44,62,80,0.18);
			margin: -80px auto 10px auto;
			background: #fff;
			display: block;
		}
		.profile-title {
			font-size: 2rem;
			font-weight: 700;
			margin-bottom: 0.5rem;
			color: var(--primary-color);
			letter-spacing: 1px;
		}
		.blood-badge {
			display: inline-block;
			background: var(--header-gradient);
			color: #fff;
			font-weight: 700;
			border-radius: 12px;
			padding: 6px 18px;
			font-size: 1.1rem;
			margin-bottom: 10px;
			box-shadow: 0 2px 8px rgba(220,53,69,0.10);
		}
		.profile-info {
			display: flex;
			flex-wrap: wrap;
			gap: 18px 24px;
			margin: 24px 0 0 0;
		}
		.info-col {
			flex: 1 1 220px;
			min-width: 180px;
		}
		.info-item {
			display: flex;
			align-items: center;
			margin-bottom: 12px;
			font-size: 1rem;
			color: #333;
		}
		.info-item i {
			color: var(--primary-color);
			margin-right: 10px;
			font-size: 1.1rem;
		}
		.info-item strong {
			font-weight: 600;
			margin-right: 6px;
		}
		.profile-form {
			margin-top: 32px;
			background: #f8fafc;
			border-radius: 16px;
			box-shadow: 0 2px 12px rgba(44,62,80,0.08);
			padding: 24px 18px 18px 18px;
		}
		.profile-form .form-group {
			margin-bottom: 16px;
		}
		.profile-form label {
			font-weight: 600;
			color: #333;
			margin-bottom: 4px;
		}
		.profile-form input,
		.profile-form select,
		.profile-form textarea {
			border-radius: 10px;
			border: 1.5px solid #e0e0e0;
			box-shadow: none;
			font-size: 1rem;
			width: 100%;
			padding: 8px 12px;
		}
		.profile-form input:focus,
		.profile-form select:focus,
		.profile-form textarea:focus {
			border-color: var(--primary-color);
			box-shadow: 0 0 0 2px rgba(220,53,69,0.10);
		}
		.profile-form .btn-update {
			background: var(--header-gradient);
			color: white;
			padding: 10px 0;
			border: none;
			font-size: 1.1rem;
			width: 100%;
			border-radius: 10px;
			font-weight: 700;
			letter-spacing: 1px;
			transition: background 0.3s, box-shadow 0.3s;
			box-shadow: 0 2px 8px rgba(220,53,69,0.10);
		}
		.profile-form .btn-update:hover {
			background: linear-gradient(90deg, #2563eb 0%, #dc3545 100%);
			box-shadow: 0 4px 16px rgba(220,53,69,0.18);
		}
		@media (max-width: 700px) {
			.profile-main-card { padding: 12px 2px; }
			.profile-info { flex-direction: column; gap: 0; }
		}
	</style>

</head>

<body>
	<?php include('includes/header.php');?>

	<!-- page details -->
	<div class="breadcrumb-agile">
		<div aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="index.php">Home</a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Donor Profile</li>
			</ol>
		</div>
	</div>

	<!-- Profile Section -->
	<section class="profile-section">
		<div class="container">
			<div class="profile-main-card">
				<?php
				$uid = $_SESSION['bbdmsdid'];
				$sql = "SELECT * from tbldonars where id=:uid";
				$query = $dbh->prepare($sql);
				$query->bindParam(':uid', $uid, PDO::PARAM_STR);
				$query->execute();
				$row = $query->fetch(PDO::FETCH_OBJ);
				?>

				<details style="margin-bottom: 24px; cursor: pointer;">
					<summary style="font-weight: 700; font-size: 1.2rem; color: #333; padding: 12px; background: #f0f0f0; border-radius: 10px;">View Current Profile</summary>
					<div class="profile-summary-card" style="padding-top:20px;">
						<div class="profile-header">
							<?php
							$profileImgPath = (!empty($row->ProfileImage) && file_exists('images/profiles/' . $row->ProfileImage))
								? 'images/profiles/' . $row->ProfileImage
								: 'images/blood-donor.jpg';
							?>
							<img src="<?php echo $profileImgPath; ?>" alt="Profile Image" class="profile-img" style="margin-top:0;">
						</div>
						<div class="profile-info" style="justify-content:center; margin-top:20px;">
							<div class="info-col">
								<div class="info-item"><i class="fas fa-user"></i><strong>Name:</strong> <span><?php echo htmlentities($row->FullName);?></span></div>
								<div class="info-item"><i class="fas fa-venus-mars"></i><strong>Gender:</strong> <span><?php echo htmlentities($row->Gender);?></span></div>
								<div class="info-item"><i class="fas fa-birthday-cake"></i><strong>Age:</strong> <span><?php echo htmlentities($row->Age);?></span></div>
							</div>
							<div class="info-col">
								<div class="info-item"><i class="fas fa-phone"></i><strong>Phone:</strong> <span><?php echo htmlentities($row->MobileNumber);?></span></div>
								<div class="info-item"><i class="fas fa-envelope"></i><strong>Email:</strong> <span><?php echo htmlentities($row->EmailId);?></span></div>
								<div class="info-item"><i class="fas fa-map-marker-alt"></i><strong>Address:</strong> <span><?php echo htmlentities($row->Address);?></span></div>
							</div>
						</div>
					</div>
				</details>

				<div class="profile-form">
					<form method="post" enctype="multipart/form-data">
						<h5 style="text-align:center; margin-bottom: 1.5rem; color:#333; font-weight:700;">Update Your Profile</h5>
						<div class="form-group">
							<label>Profile Image:</label>
							<input type="file" name="profile_image" class="form-control" accept="image/*">
						</div>
						<div class="form-group">
							<label>Full Name:</label>
							<input type="text" name="fullname" class="form-control" value="" required>
						</div>
						<div class="form-group">
							<label>Mobile:</label>
							<input type="text" name="mobileno" class="form-control" value="" required>
						</div>
						<div class="form-group">
							<label>Email:</label>
							<input type="email" name="emailid" class="form-control" value="">
						</div>
						<div class="form-group">
							<label>Age:</label>
							<input type="text" name="age" class="form-control" value="" required>
						</div>
						<div class="form-group">
							<label>Gender:</label>
							<select name="gender" class="form-control" required>
								<option value="">Select Gender</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
								<option value="Others">Others</option>
							</select>
						</div>
						<div class="form-group">
							<label>Blood Group:</label>
							<select name="bloodgroup" class="form-control" required>
								<option value="">Select Blood Group</option>
								<?php
								$sql = "SELECT * from tblbloodgroup";
								$query = $dbh->prepare($sql);
								$query->execute();
								$results = $query->fetchAll(PDO::FETCH_OBJ);
								if($query->rowCount() > 0) {
									foreach($results as $result) {
								?>
								<option value="<?php echo htmlentities($result->BloodGroup);?>"><?php echo htmlentities($result->BloodGroup);?></option>
								<?php }} ?>
							</select>
						</div>
						<div class="form-group">
							<label>Address:</label>
							<input type="text" name="address" class="form-control" value="" required>
						</div>
						<div class="form-group">
							<label>Message:</label>
							<textarea name="message" class="form-control"></textarea>
						</div>
						<button type="submit" name="update" class="btn-update">
							Update Profile
						</button>
					</form>
				</div>
			</div>
		</div>
	</section>

	<?php include('includes/footer.php');?>
	<!-- Js files -->
	<!-- JavaScript -->
	<script src="js/jquery-2.2.3.min.js"></script>
	<!-- Default-JavaScript-File -->

	<!--start-date-piker-->
	<link rel="stylesheet" href="css/jquery-ui.css" />
	<script src="js/jquery-ui.js"></script>
	<script>
		$(function () {
			$("#datepicker,#datepicker1").datepicker();
		});
	</script>
	<!-- //End-date-piker -->

	<!-- fixed navigation -->
	<script src="js/fixed-nav.js"></script>
	<!-- //fixed navigation -->

	<!-- smooth scrolling -->
	<script src="js/SmoothScroll.min.js"></script>
	<!-- move-top -->
	<script src="js/move-top.js"></script>
	<!-- easing -->
	<script src="js/easing.js"></script>
	<!--  necessary snippets for few javascript files -->
	<script src="js/medic.js"></script>

	<script src="js/bootstrap.js"></script>
	<!-- Necessary-JavaScript-File-For-Bootstrap -->

	<!-- //Js files -->

</body>

</html><?php } ?>