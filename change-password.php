<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['bbdmsdid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['change']))
{
$uid=$_SESSION['bbdmsdid'];
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$sql ="SELECT ID FROM tbldonars WHERE id=:uid and Password=:cpassword";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query-> bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);

if($query -> rowCount() > 0)
{
$con="update tbldonars set Password=:newpassword where id=:uid";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':uid', $uid, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();

echo '<script>alert("Your password successully changed")</script>';
} else {
echo '<script>alert("Your current password is wrong")</script>';

}
}

  ?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Blood Bank Donar Management System !! Change Password</title>
	
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
}   

</script>

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
			--bg-glass: rgba(255,255,255,0.9);
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
		.main-card {
			background: var(--bg-glass);
			backdrop-filter: blur(8px);
			border-radius: var(--border-radius);
			box-shadow: var(--shadow);
			padding: 40px 32px;
			margin: 24px auto;
			max-width: 500px;
			position: relative;
			border: 1.5px solid rgba(44,62,80,0.10);
		}
		.card-header {
			text-align: center;
			margin-bottom: 2rem;
		}
		.card-header .title {
			font-size: 2.2rem;
			font-weight: 700;
			color: var(--primary-color);
			margin-bottom: 0.5rem;
		}
		.card-header .icon {
			font-size: 1.5rem;
			color: var(--primary-color);
		}
		.form-group {
			margin-bottom: 1.25rem;
		}
		label {
			font-weight: 600;
			color: #333;
			margin-bottom: 0.5rem;
			display: block;
		}
		.form-control {
			border-radius: 10px;
			border: 1.5px solid #e0e0e0;
			box-shadow: none;
			font-size: 1rem;
			width: 100%;
			padding: 10px 14px;
			height: auto;
		}
		.form-control:focus {
			border-color: var(--primary-color);
			box-shadow: 0 0 0 3px rgba(220,53,69,0.10);
		}
		.btn-submit {
			background: var(--header-gradient);
			color: white;
			padding: 12px 0;
			border: none;
			font-size: 1.1rem;
			width: 100%;
			border-radius: 10px;
			font-weight: 700;
			letter-spacing: 1px;
			transition: all 0.3s ease;
			box-shadow: 0 2px 8px rgba(220,53,69,0.15);
		}
		.btn-submit:hover {
			background-position: right center;
			background-size: 200% auto;
			box-shadow: 0 4px 16px rgba(220,53,69,0.25);
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
				<li class="breadcrumb-item active" aria-current="page">Change Password</li>
			</ol>
		</div>
	</div>
	<!-- //page details -->

	<!-- Change Password Section -->
	<div class="container py-5">
		<div class="main-card">
			<div class="card-header">
				<h3 class="title">Change Password</h3>
				<span class="icon">
					<i class="fas fa-lock"></i>
				</span>
			</div>
			<div class="card-body">
				<form action="#" method="post" onsubmit="return checkpass();" name="changepassword">
					<div class="form-group">
						<label for="currentpassword">Current Password</label>
						<input type="password" class="form-control" name="currentpassword" id="currentpassword" required>
					</div>
					<div class="form-group">
						<label for="newpassword">New Password</label>
						<input type="password" name="newpassword" id="newpassword" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="confirmpassword">Confirm Password</label>
						<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
					</div>
					<input type="submit" value="Update Password" name="change" class="btn-submit">
				</form>
			</div>
		</div>
	</div>
	<!-- //Change Password Section -->

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