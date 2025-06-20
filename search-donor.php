<?php
//error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Blood Donation Management System | Search Donor</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="Blood Donation, Blood Bank, Search Donor">
	
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
			--primary-color: #4CAF50;
			--secondary-color: #45a049;
			--accent-color: #2ed573;
			--text-color: #2f3542;
			--light-bg: #f1f2f6;
		}
		
		body {
			font-family: 'Poppins', sans-serif;
			color: var(--text-color);
			background: var(--light-bg);
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
		
		.search-section {
			padding: 80px 0;
			background: white;
			border-radius: 20px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.1);
			margin-top: -50px;
			position: relative;
			z-index: 3;
		}
		
		.search-form {
			max-width: 800px;
			margin: 0 auto;
			padding: 30px;
		}
		
		.form-group {
			margin-bottom: 25px;
		}
		
		.form-group label {
			font-weight: 600;
			color: var(--text-color);
			margin-bottom: 10px;
			display: block;
		}
		
		.form-control {
			height: 50px;
			border-radius: 10px;
			border: 2px solid #eee;
			padding: 10px 20px;
			font-size: 1rem;
			transition: all 0.3s ease;
		}
		
		.form-control:focus {
			border-color: var(--primary-color);
			box-shadow: none;
		}
		
		.btn-search {
			background: var(--primary-color);
			color: white;
			padding: 12px 40px;
			border-radius: 50px;
			font-weight: 600;
			border: none;
			transition: all 0.3s ease;
			width: 100%;
			height: 50px;
		}
		
		.btn-search:hover {
			background: var(--secondary-color);
			transform: translateY(-3px);
			box-shadow: 0 10px 20px rgba(255,71,87,0.3);
		}
		
		.results-section {
			padding: 80px 0;
		}
		
		.section-title {
			text-align: center;
			margin-bottom: 60px;
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
		
		.donor-card {
			background: white;
			border-radius: 20px;
			overflow: hidden;
			box-shadow: 0 10px 30px rgba(0,0,0,0.1);
			margin-bottom: 30px;
			transition: all 0.3s ease;
		}
		
		.donor-card:hover {
			transform: translateY(-10px);
			box-shadow: 0 15px 35px rgba(0,0,0,0.2);
		}
		
		.donor-image {
			position: relative;
			overflow: hidden;
		}
		
		.donor-image img {
			width: 100%;
			height: 250px;
			object-fit: cover;
			transition: all 0.3s ease;
		}
		
		.donor-card:hover .donor-image img {
			transform: scale(1.1);
		}
		
		.blood-group {
			position: absolute;
			top: 20px;
			right: 20px;
			background: var(--primary-color);
			color: white;
			padding: 10px 20px;
			border-radius: 50px;
			font-weight: 600;
			font-size: 1.2rem;
		}
		
		.donor-info {
			padding: 30px;
		}
		
		.donor-name {
			font-size: 1.5rem;
			font-weight: 600;
			margin-bottom: 20px;
			color: var(--text-color);
		}
		
		.info-item {
			display: flex;
			align-items: center;
			margin-bottom: 15px;
		}
		
		.info-item i {
			width: 40px;
			height: 40px;
			background: var(--light-bg);
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			color: var(--primary-color);
			margin-right: 15px;
			transition: all 0.3s ease;
		}
		
		.donor-card:hover .info-item i {
			background: var(--primary-color);
			color: white;
		}
		
		.info-item span {
			color: #666;
		}
		
		.info-item strong {
			color: var(--text-color);
			margin-right: 5px;
		}
		
		.btn-request {
			background: var(--primary-color);
			color: white;
			padding: 12px 30px;
			border-radius: 50px;
			font-weight: 600;
			transition: all 0.3s ease;
			border: none;
			width: 100%;
			margin-top: 20px;
		}
		
		.btn-request:hover {
			background: var(--secondary-color);
			transform: translateY(-3px);
			box-shadow: 0 10px 20px rgba(255,71,87,0.3);
		}
		
		.no-results {
			text-align: center;
			padding: 50px;
			background: white;
			border-radius: 20px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.1);
		}
		
		.no-results i {
			font-size: 4rem;
			color: var(--primary-color);
			margin-bottom: 20px;
		}
		
		.no-results h3 {
			font-size: 1.8rem;
			font-weight: 600;
			margin-bottom: 15px;
			color: var(--text-color);
		}
		
		.no-results p {
			color: #666;
			font-size: 1.1rem;
		}
		
		.modal-content {
			border-radius: 15px;
			border: none;
			box-shadow: 0 10px 30px rgba(0,0,0,0.1);
		}
		
		.modal-header {
			background: var(--primary-color);
			color: white;
			border-radius: 15px 15px 0 0;
			border: none;
		}
		
		.modal-header .close {
			color: white;
			text-shadow: none;
			opacity: 0.8;
		}
		
		.modal-header .close:hover {
			opacity: 1;
		}
		
		.modal-body {
			padding: 30px;
		}
		
		.form-group label {
			color: var(--text-color);
			font-weight: 500;
			margin-bottom: 8px;
		}
		
		.form-control {
			border: 2px solid #eee;
			border-radius: 10px;
			padding: 12px 15px;
			transition: all 0.3s ease;
		}
		
		.form-control:focus {
			border-color: var(--primary-color);
			box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
		}
		
		.btn-request {
			background: var(--primary-color);
			color: white;
			padding: 12px 30px;
			border-radius: 50px;
			font-weight: 600;
			transition: all 0.3s ease;
			border: none;
			width: 100%;
		}
		
		.btn-request:hover {
			background: var(--secondary-color);
			transform: translateY(-3px);
			box-shadow: 0 10px 20px rgba(76, 175, 80, 0.3);
		}
	</style>
</head>

<body>
	<?php include('includes/header.php');?>

	<!-- Page Banner -->
	<section class="page-banner">
		<div class="container">
			<h1>Search Blood Donors</h1>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb justify-content-center">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Search Donor</li>
				</ol>
			</nav>
		</div>
	</section>

	<!-- Search Section -->
	<section class="search-section">
		<div class="container">
			<div class="search-form">
				<form name="donar" method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Blood Group</label>
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
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label>Location</label>
								<input type="text" class="form-control" name="location" placeholder="Enter your location" required>
							</div>
						</div>
					</div>
					
					<button type="submit" class="btn btn-search" name="search">
						<i class="fas fa-search mr-2"></i> Search Donors
					</button>
				</form>
			</div>
		</div>
	</section>

	<!-- Results Section -->
	<section class="results-section">
		<div class="container">
			<div class="section-title">
				<h2>Search Results</h2>
				<p>Find blood donors in your area</p>
			</div>
			
			<div class="row">
				<?php
				if(isset($_POST['search'])) {
					$bloodgroup = $_POST['bloodgroup'];
					$location = $_POST['location'];
					
					$sql = "SELECT * from tbldonars where BloodGroup=:bloodgroup and Address like :location and status=1";
					$query = $dbh->prepare($sql);
					$query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
					$query->bindValue(':location', '%' . $location . '%', PDO::PARAM_STR);
					$query->execute();
					$results = $query->fetchAll(PDO::FETCH_OBJ);
					$cnt = 1;
					
					if($query->rowCount() > 0) {
						foreach($results as $result) {
				?>
				<div class="col-md-4">
					<div class="donor-card">
						<div class="donor-image">
							<img src="images/donor.jpg" alt="Donor Image">
							<div class="blood-group"><?php echo htmlentities($result->BloodGroup);?></div>
						</div>
						<div class="donor-info">
							<h3 class="donor-name"><?php echo htmlentities($result->FullName);?></h3>
							<div class="info-item">
								<i class="fas fa-venus-mars"></i>
								<span><strong>Gender:</strong> <?php echo htmlentities($result->Gender);?></span>
							</div>
							<div class="info-item">
								<i class="fas fa-phone"></i>
								<span><strong>Mobile:</strong> <?php echo htmlentities($result->MobileNumber);?></span>
							</div>
							<div class="info-item">
								<i class="fas fa-envelope"></i>
								<span><strong>Email:</strong> <?php echo htmlentities($result->EmailId);?></span>
							</div>
							<div class="info-item">
								<i class="fas fa-birthday-cake"></i>
								<span><strong>Age:</strong> <?php echo htmlentities($result->Age);?></span>
							</div>
							<div class="info-item">
								<i class="fas fa-map-marker-alt"></i>
								<span><strong>Address:</strong> <?php echo htmlentities($result->Address);?></span>
							</div>
							<button type="button" class="btn btn-request" data-toggle="modal" data-target="#requestModal<?php echo $cnt;?>">
								<i class="fas fa-handshake mr-2"></i> Request Contact
							</button>
						</div>
					</div>
				</div>
				
				<!-- Request Modal -->
				<div class="modal fade" id="requestModal<?php echo $cnt;?>" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel<?php echo $cnt;?>" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="requestModalLabel<?php echo $cnt;?>">Request Contact</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="send-message.php" method="post">
									<input type="hidden" name="donor_id" value="<?php echo htmlentities($result->id);?>">
									<div class="form-group">
										<label>Your Name</label>
										<input type="text" class="form-control" name="name" required>
									</div>
									<div class="form-group">
										<label>Your Email</label>
										<input type="email" class="form-control" name="email" required>
									</div>
									<div class="form-group">
										<label>Your Message</label>
										<textarea class="form-control" name="message" rows="4" required></textarea>
									</div>
									<button type="submit" class="btn btn-request">
										<i class="fas fa-paper-plane mr-2"></i> Send Request
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php $cnt++;}} else { ?>
				<div class="col-12 text-center">
					<div class="alert alert-info">
						<i class="fas fa-info-circle mr-2"></i> No donors found in your area. Please try a different location.
					</div>
				</div>
				<?php }} ?>
			</div>
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