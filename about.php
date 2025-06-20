<?php
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Blood Donation Management System | About Us</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="Blood Donation, Blood Bank, Donor Management">
	
	<!-- Custom-Files ujal -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/fontawesome-all.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	
	<style>
		:root {
			--primary-color: #ff4757;
			--secondary-color: #ff6b81;
			--accent-color: #2ed573;
			--text-color: #2f3542;
			--light-bg: #f1f2f6;
		}
		
		body {
			font-family: 'Poppins', sans-serif;
			color: var(--text-color);
		}
		
		.page-banner {
			background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('images/banner2.jpg');
			background-size: cover;
			background-position: center;
			padding: 100px 0;
			color: white;
			text-align: center;
			position: relative;
		}
		
		.page-banner::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: linear-gradient(45deg, #ff4757, #ff6b81);
			opacity: 0.3;
		}
		
		.page-banner .container {
			position: relative;
			z-index: 2;
		}
		
		.page-banner h1 {
			font-size: 3rem;
			font-weight: 700;
			margin-bottom: 1rem;
			text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
		}
		
		.breadcrumb {
			background: transparent;
			padding: 0;
			margin: 0;
		}
		
		.breadcrumb-item a {
			color: white;
			text-decoration: none;
			transition: all 0.3s ease;
		}
		
		.breadcrumb-item a:hover {
			color: var(--primary-color);
		}
		
		.breadcrumb-item.active {
			color: var(--primary-color);
		}
		
		.about-section {
			padding: 100px 0;
			background: white;
		}
		
		.section-title {
			text-align: center;
			margin-bottom: 60px;
			position: relative;
		}
		
		.section-title h2 {
			font-size: 2.5rem;
			font-weight: 700;
			margin-bottom: 15px;
			color: var(--text-color);
		}
		
		.section-title p {
			color: #666;
			font-size: 1.1rem;
			max-width: 700px;
			margin: 0 auto;
		}
		
		.section-title::after {
			content: '';
			position: absolute;
			bottom: -15px;
			left: 50%;
			transform: translateX(-50%);
			width: 80px;
			height: 4px;
			background: var(--primary-color);
			border-radius: 2px;
		}
		
		.about-content {
			background: white;
			padding: 40px;
			border-radius: 20px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.1);
			margin-bottom: 30px;
			transition: all 0.3s ease;
		}
		
		.about-content:hover {
			transform: translateY(-10px);
			box-shadow: 0 15px 35px rgba(0,0,0,0.2);
		}
		
		.about-content p {
			font-size: 1.1rem;
			line-height: 1.8;
			color: #666;
		}
		
		.stats-section {
			padding: 80px 0;
			background: var(--light-bg);
		}
		
		.stat-box {
			text-align: center;
			padding: 30px;
			background: white;
			border-radius: 20px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.1);
			transition: all 0.3s ease;
		}
		
		.stat-box:hover {
			transform: translateY(-10px);
			box-shadow: 0 15px 35px rgba(0,0,0,0.2);
		}
		
		.stat-box i {
			font-size: 3rem;
			color: var(--primary-color);
			margin-bottom: 20px;
		}
		
		.stat-box h3 {
			font-size: 2.5rem;
			font-weight: 700;
			color: var(--text-color);
			margin-bottom: 10px;
		}
		
		.stat-box p {
			color: #666;
			font-size: 1.1rem;
		}
		
		.team-section {
			padding: 100px 0;
			background: white;
		}
		
		.team-member {
			text-align: center;
			margin-bottom: 30px;
		}
		
		.team-member img {
			width: 200px;
			height: 200px;
			border-radius: 50%;
			margin-bottom: 20px;
			object-fit: cover;
			border: 5px solid white;
			box-shadow: 0 10px 30px rgba(0,0,0,0.1);
			transition: all 0.3s ease;
		}
		
		.team-member:hover img {
			transform: scale(1.1);
		}
		
		.team-member h4 {
			font-size: 1.5rem;
			font-weight: 600;
			margin-bottom: 10px;
			color: var(--text-color);
		}
		
		.team-member p {
			color: #666;
			font-size: 1.1rem;
		}
		
		.cta-section {
			padding: 100px 0;
			background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('images/banner1.jpg');
			background-size: cover;
			background-position: center;
			background-attachment: fixed;
			color: white;
			text-align: center;
			position: relative;
		}
		
		.cta-section::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: linear-gradient(45deg, #ff4757, #ff6b81);
			opacity: 0.3;
		}
		
		.cta-section .container {
			position: relative;
			z-index: 2;
		}
		
		.cta-section h2 {
			font-size: 3rem;
			font-weight: 700;
			margin-bottom: 1.5rem;
			text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
		}
		
		.cta-section p {
			font-size: 1.2rem;
			margin-bottom: 2rem;
			text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
		}
		
		.btn-cta {
			background: white;
			color: var(--primary-color);
			padding: 15px 40px;
			border-radius: 50px;
			font-weight: 600;
			transition: all 0.3s ease;
			border: 2px solid white;
			text-decoration: none;
			display: inline-block;
		}
		
		.btn-cta:hover {
			background: transparent;
			color: white;
			transform: translateY(-3px);
			box-shadow: 0 10px 20px rgba(0,0,0,0.2);
		}
	</style>
</head>

<body>
	<?php include('includes/header.php');?>

	<!-- Page Banner -->
	<section class="page-banner">
		<div class="container">
			<h1>About Us</h1>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb justify-content-center">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">About Us</li>
				</ol>
			</nav>
		</div>
	</section>

	<!-- About Section -->
	<section class="about-section">
		<div class="container">
			<div class="section-title">
				<h2>Our Mission</h2>
				<p>Connecting blood donors with those in need, saving lives one donation at a time.</p>
			</div>
			<?php 
			$pagetype="aboutus";
			$sql = "SELECT type,detail,PageName from tblpages where type=:pagetype";
			$query = $dbh -> prepare($sql);
			$query->bindParam(':pagetype',$pagetype,PDO::PARAM_STR);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			if($query->rowCount() > 0) {
				foreach($results as $result) { ?>
					<div class="about-content">
						<h3 class="mb-4"><?php echo htmlentities($result->PageName); ?></h3>
						<p><?php echo $result->detail; ?></p>
					</div>
				<?php }
			} ?>
		</div>
	</section>

	<!-- Stats Section -->
	<section class="stats-section">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="stat-box">
						<i class="fas fa-users"></i>
						<h3>10,000+</h3>
						<p>Registered Donors</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="stat-box">
						<i class="fas fa-tint"></i>
						<h3>50,000+</h3>
						<p>Units Collected</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="stat-box">
						<i class="fas fa-hospital"></i>
						<h3>100+</h3>
						<p>Partner Hospitals</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="stat-box">
						<i class="fas fa-heartbeat"></i>
						<h3>15,000+</h3>
						<p>Lives Saved</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Team Section -->
	<section class="team-section">
		<div class="container">
			<div class="section-title">
				<h2>Our Leadership Team</h2>
				<p>Meet the dedicated professionals behind our mission.</p>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="team-member">
						<img src="images/team1.jpg" alt="Team Member">
						<h4>Dr. Sarah Johnson</h4>
						<p>Medical Director</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="team-member">
						<img src="images/team2.jpg" alt="Team Member">
						<h4>Michael Chen</h4>
						<p>Operations Manager</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="team-member">
						<img src="images/team3.jpg" alt="Team Member">
						<h4>Dr. Emily Brown</h4>
						<p>Head of Donor Relations</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- CTA Section -->
	<section class="cta-section">
		<div class="container">
			<h2>Join Our Mission</h2>
			<p>Your blood donation can save up to three lives. Become a donor today and make a difference in someone's life.</p>
			<a href="sign-up.php" class="btn-cta">Become a Donor</a>
		</div>
	</section>

	<?php include('includes/footer.php');?>

	<!-- Scripts -->
	<script src="js/jquery-2.2.3.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/move-top.js"></script>
	<script src="js/easing.js"></script>
	<script src="js/medic.js"></script>
</body>
</html>