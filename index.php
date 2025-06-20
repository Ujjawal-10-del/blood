<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Blood Donation Management System | Save Lives</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Custom-Files -->
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
			--gradient-1: linear-gradient(45deg, #ff4757, #ff6b81);
			--gradient-2: linear-gradient(45deg, #2ed573, #7bed9f);
			--gradient-3: linear-gradient(45deg, #1e90ff, #70a1ff);
		}
		
		body {
			font-family: 'Poppins', sans-serif;
			color: var(--text-color);
			background-color: var(--light-bg);
		}
		
		.hero-section {
			background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('images/banner2.jpg');
			background-size: cover;
			background-position: center;
			height: 90vh;
			display: flex;
			align-items: center;
			color: white;
			position: relative;
			overflow: hidden;
		}
		
		.hero-section::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: var(--gradient-1);
			opacity: 0.3;
			animation: gradientShift 10s ease infinite;
		}
		
		@keyframes gradientShift {
			0% { opacity: 0.3; }
			50% { opacity: 0.5; }
			100% { opacity: 0.3; }
		}
		
		.hero-content {
			text-align: center;
			position: relative;
			z-index: 2;
			animation: fadeInUp 1s ease;
		}
		
		@keyframes fadeInUp {
			from {
				opacity: 0;
				transform: translateY(20px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
		
		.hero-content h1 {
			font-size: 4rem;
			font-weight: 800;
			margin-bottom: 1.5rem;
			text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
			background: var(--gradient-1);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			animation: titleGlow 2s ease-in-out infinite;
		}
		
		@keyframes titleGlow {
			0% { text-shadow: 0 0 10px rgba(255,71,87,0.5); }
			50% { text-shadow: 0 0 20px rgba(255,71,87,0.8); }
			100% { text-shadow: 0 0 10px rgba(255,71,87,0.5); }
		}
		
		.hero-content p {
			font-size: 1.3rem;
			margin-bottom: 2rem;
			text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
			max-width: 800px;
			margin-left: auto;
			margin-right: auto;
		}
		
		.btn-donate {
			background: var(--gradient-1);
			color: white;
			padding: 15px 40px;
			border-radius: 50px;
			text-transform: uppercase;
			font-weight: 600;
			transition: all 0.3s ease;
			border: none;
			position: relative;
			overflow: hidden;
			z-index: 1;
		}
		
		.btn-donate::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: var(--gradient-2);
			z-index: -1;
			transition: all 0.3s ease;
			transform: scaleX(0);
			transform-origin: right;
		}
		
		.btn-donate:hover::before {
			transform: scaleX(1);
			transform-origin: left;
		}
		
		.btn-donate:hover {
			transform: translateY(-3px);
			box-shadow: 0 10px 20px rgba(0,0,0,0.2);
		}
		
		.features {
			padding: 100px 0;
			background: white;
			position: relative;
		}
		
		.features::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: url('images/bg1.jpg') center/cover;
			opacity: 0.05;
		}
		
		.feature-box {
			padding: 40px 30px;
			text-align: center;
			background: white;
			border-radius: 20px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.1);
			transition: all 0.4s ease;
			margin-bottom: 30px;
			border: 1px solid rgba(0,0,0,0.1);
			position: relative;
			overflow: hidden;
		}
		
		.feature-box::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 5px;
			background: var(--gradient-1);
			transform: scaleX(0);
			transition: transform 0.4s ease;
		}
		
		.feature-box:hover::before {
			transform: scaleX(1);
		}
		
		.feature-box:hover {
			transform: translateY(-15px);
			box-shadow: 0 15px 35px rgba(0,0,0,0.2);
		}
		
		.feature-box i {
			font-size: 3.5rem;
			background: var(--gradient-1);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			margin-bottom: 25px;
			transition: all 0.4s ease;
		}
		
		.feature-box:hover i {
			transform: scale(1.2) rotate(5deg);
		}
		
		.feature-box h3 {
			color: var(--text-color);
			font-size: 1.5rem;
			margin-bottom: 15px;
			font-weight: 600;
		}
		
		.donors {
			padding: 100px 0;
			background: var(--light-bg);
			position: relative;
		}
		
		.donor-card {
			background: white;
			border-radius: 20px;
			overflow: hidden;
			box-shadow: 0 10px 30px rgba(0,0,0,0.1);
			transition: all 0.4s ease;
			border: 1px solid rgba(0,0,0,0.1);
			position: relative;
		}
		
		.donor-card::after {
			content: '';
			position: absolute;
			bottom: 0;
			left: 0;
			width: 100%;
			height: 5px;
			background: var(--gradient-1);
			transform: scaleX(0);
			transition: transform 0.4s ease;
		}
		
		.donor-card:hover::after {
			transform: scaleX(1);
		}
		
		.donor-card:hover {
			transform: translateY(-10px);
			box-shadow: 0 15px 35px rgba(0,0,0,0.2);
		}
		
		.donor-card img {
			width: 100%;
			height: 250px;
			object-fit: cover;
			transition: all 0.4s ease;
		}
		
		.donor-card:hover img {
			transform: scale(1.1);
		}
		
		.donor-info {
			padding: 25px;
		}
		
		.donor-info h4 {
			color: var(--primary-color);
			margin-bottom: 15px;
			font-size: 1.3rem;
			font-weight: 600;
		}
		
		.blood-groups {
			padding: 100px 0;
			background: white;
			position: relative;
		}
		
		.blood-group-item {
			background: white;
			padding: 30px;
			border-radius: 20px;
			text-align: center;
			margin-bottom: 30px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.1);
			border: 1px solid rgba(0,0,0,0.1);
			transition: all 0.4s ease;
			position: relative;
			overflow: hidden;
		}
		
		.blood-group-item::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 5px;
			background: var(--gradient-3);
			transform: scaleX(0);
			transition: transform 0.4s ease;
		}
		
		.blood-group-item:hover::before {
			transform: scaleX(1);
		}
		
		.blood-group-item:hover {
			transform: translateY(-10px);
			box-shadow: 0 15px 35px rgba(0,0,0,0.2);
		}
		
		.blood-group-item h3 {
			font-size: 2.5rem;
			margin-bottom: 15px;
			background: var(--gradient-3);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
		}
		
		.cta {
			background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('images/banner1.jpg');
			background-size: cover;
			background-position: center;
			background-attachment: fixed;
			padding: 100px 0;
			position: relative;
			overflow: hidden;
		}
		
		.cta::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: var(--gradient-1);
			opacity: 0.3;
			animation: gradientShift 10s ease infinite;
		}
		
		.cta .container {
			position: relative;
			z-index: 2;
		}
		
		.cta h2 {
			font-size: 3rem;
			font-weight: 700;
			margin-bottom: 1.5rem;
			text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
		}
		
		.cta p {
			font-size: 1.2rem;
			margin-bottom: 2rem;
			text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
		}
		
		.cta .btn-light {
			background: white;
			color: var(--primary-color);
			padding: 15px 40px;
			border-radius: 50px;
			font-weight: 600;
			transition: all 0.3s ease;
			border: 2px solid white;
		}
		
		.cta .btn-light:hover {
			background: transparent;
			color: white;
			transform: translateY(-3px);
			box-shadow: 0 10px 20px rgba(0,0,0,0.2);
		}
		
		/* Section Titles */
		.section-title {
			text-align: center;
			margin-bottom: 60px;
			position: relative;
		}
		
		.section-title h2 {
			font-size: 2.5rem;
			font-weight: 700;
			margin-bottom: 15px;
			background: var(--gradient-1);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
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
			background: var(--gradient-1);
			border-radius: 2px;
		}
	</style>
</head>

<body>
	<?php include('includes/header.php');?>

	<!-- Hero Section -->
	<section class="hero-section">
		<div class="container">
			<div class="hero-content">
				<h1>Donate Blood, Save Lives</h1>
				<p>Your blood donation can save up to three lives. Join our mission to help those in need and make a difference in someone's life today.</p>
				<a href="sign-up.php" class="btn btn-donate">Become a Donor</a>
			</div>
		</div>
	</section>

	<!-- Features Section -->
	<section class="features">
		<div class="container">
			<div class="section-title">
				<h2>Why Donate Blood?</h2>
				<p>Your donation can make a significant impact on someone's life. Here's why it matters.</p>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="feature-box">
						<i class="fas fa-heartbeat"></i>
						<h3>Save Lives</h3>
						<p>One donation can save up to three lives. Your blood can make a difference in emergency situations and medical procedures.</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="feature-box">
						<i class="fas fa-user-md"></i>
						<h3>Expert Care</h3>
						<p>Professional medical staff ensures a safe and comfortable donation process with state-of-the-art equipment.</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="feature-box">
						<i class="fas fa-clock"></i>
						<h3>Quick Process</h3>
						<p>Whole blood donation takes only about 8-10 minutes to complete, with minimal discomfort and maximum impact.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Donors Section -->
	<section class="donors">
		<div class="container">
			<div class="section-title">
				<h2>Our Recent Donors</h2>
				<p>Meet some of our amazing donors who have made a difference in someone's life.</p>
			</div>
			<div class="row">
				<?php 
				$status=1;
				$sql = "SELECT * from tbldonars where status=:status order by rand() limit 6";
				$query = $dbh -> prepare($sql);
				$query->bindParam(':status',$status,PDO::PARAM_STR);
				$query->execute();
				$results=$query->fetchAll(PDO::FETCH_OBJ);
				if($query->rowCount() > 0) {
					foreach($results as $result) { ?>
						<div class="col-md-4 mb-4">
							<div class="donor-card">
								<img src="images/blood-donor.jpg" alt="Donor" class="img-fluid">
								<div class="donor-info">
									<h4><?php echo htmlentities($result->FullName);?></h4>
									<p><strong>Blood Group:</strong> <?php echo htmlentities($result->BloodGroup);?></p>
									<p><strong>Location:</strong> <?php echo htmlentities($result->Address);?></p>
									<a href="contact-blood.php?cid=<?php echo $result->id;?>" class="btn btn-donate btn-block">Request Blood</a>
								</div>
							</div>
						</div>
					<?php }
				} ?>
			</div>
		</div>
	</section>

	<!-- Blood Groups Section -->
	<section class="blood-groups">
		<div class="container">
			<div class="section-title">
				<h2>Blood Types</h2>
				<p>Understanding blood types is crucial for safe transfusions. Here are the main blood groups.</p>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="blood-group-item">
						<h3>A+</h3>
						<p>Universal recipient for A+ and AB+</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="blood-group-item">
						<h3>B+</h3>
						<p>Universal recipient for B+ and AB+</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="blood-group-item">
						<h3>O+</h3>
						<p>Universal donor for all positive types</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="blood-group-item">
						<h3>AB+</h3>
						<p>Universal recipient for all types</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Call to Action -->
	<section class="cta">
		<div class="container text-center">
			<h2>Ready to Make a Difference?</h2>
			<p>Join our community of blood donors and help save lives today. Your donation could be the difference between life and death for someone in need.</p>
			<a href="sign-up.php" class="btn btn-light btn-lg">Become a Donor</a>
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