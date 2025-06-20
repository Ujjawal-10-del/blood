<?php
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Blood Donation Management System | Donor List</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="Blood Donation, Blood Bank, Donor List">
	
	<!-- Custom-Files -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/fontawesome-all.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	
	<style>
		:root {
			--primary-color: #dc3545;
			--secondary-color: #c82333;
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
		
		.donors-section {
			padding: 100px 0;
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
		
		.donor-card {
			background: white;
			border-radius: 20px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.1);
			margin-bottom: 30px;
			transition: all 0.3s ease;
			border-top: 4px solid var(--primary-color);
		}
		
		.donor-card:hover {
			transform: translateY(-10px);
			box-shadow: 0 15px 35px rgba(0,0,0,0.2);
		}
		
		.blood-group {
			background: var(--primary-color);
			color: white;
			padding: 5px 15px;
			border-radius: 50px;
			font-weight: 600;
			font-size: 1rem;
		}
		
		.donor-info {
			padding: 30px;
		}

		.donor-header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 20px;
		}
		
		.donor-name {
			font-size: 1.5rem;
			font-weight: 600;
			margin-bottom: 0;
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
		
		.filters {
			margin-bottom: 40px;
			text-align: center;
		}
		
		.filter-btn {
			background: white;
			border: 2px solid var(--primary-color);
			color: var(--primary-color);
			padding: 8px 20px;
			border-radius: 50px;
			margin: 0 5px;
			font-weight: 500;
			transition: all 0.3s ease;
		}
		
		.filter-btn:hover,
		.filter-btn.active {
			background: var(--primary-color);
			color: white;
		}

		.modal-form .modal-content {
			border-radius: 15px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.2);
		}

		.modal-form .modal-header {
			background: var(--primary-color);
			color: white;
			border-top-left-radius: 15px;
			border-top-right-radius: 15px;
		}

		.modal-form .modal-header .modal-title {
			font-weight: 600;
		}

		.modal-form .modal-header .close {
			color: white;
			opacity: 0.9;
		}

		.modal-form .modal-body {
			background-color: #fce8e6;
		}

		.modal-form .form-control {
			border-radius: 10px;
			padding: 12px;
			border: 1px solid #ddd;
			transition: all 0.3s ease;
		}

		.modal-form .form-control:focus {
			border-color: var(--primary-color);
			box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
		}

		.modal-form select.form-control {
			border-color: var(--primary-color);
		}

		.modal-form label {
			color: #343a40;
			font-weight: 500;
		}

		.modal-form .btn-request {
			border-radius: 10px;
			padding: 12px 20px;
		}
	</style>
</head>

<body>
	<?php include('includes/header.php');?>

	<!-- Page Banner -->
	<section class="page-banner">
		<div class="container">
			<h1>Blood Donors</h1>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb justify-content-center">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Donor List</li>
				</ol>
			</nav>
		</div>
	</section>

	<!-- Donors Section -->
	<section class="donors-section">
		<div class="container">
			<div class="section-title">
				<h2>Our Blood Donors</h2>
				<p>Meet our generous blood donors who are making a difference in people's lives</p>
			</div>
			
			<div class="filters">
				<button class="filter-btn active" data-group="all">All</button>
				<?php
				$sql = "SELECT DISTINCT BloodGroup from tbldonars";
				$query = $dbh->prepare($sql);
				$query->execute();
				$results = $query->fetchAll(PDO::FETCH_OBJ);
				if($query->rowCount() > 0) {
					foreach($results as $result) {
				?>
				<button class="filter-btn" data-group="<?php echo htmlentities($result->BloodGroup);?>">
					<?php echo htmlentities($result->BloodGroup);?>
				</button>
				<?php }} ?>
			</div>
			
			<div class="row">
				<?php
				$sql = "SELECT * from tbldonars where status=1";
				$query = $dbh->prepare($sql);
				$query->execute();
				$results = $query->fetchAll(PDO::FETCH_OBJ);
				$cnt = 1;
				if($query->rowCount() > 0) {
					foreach($results as $result) {
				?>
				<div class="col-md-4 donor-item" data-group="<?php echo htmlentities($result->BloodGroup);?>">
					<div class="donor-card">
						<div class="donor-info">
							<div class="donor-header">
								<h3 class="donor-name"><?php echo htmlentities($result->FullName);?></h3>
								<div class="blood-group"><?php echo htmlentities($result->BloodGroup);?></div>
							</div>
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
					<div class="modal-dialog modal-form" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="requestModalLabel<?php echo $cnt;?>"><i class="fas fa-tint mr-2"></i>Request Contact for <?php echo htmlentities($result->FullName);?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="contact-blood.php?cid=<?php echo htmlentities($result->id);?>" method="post">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label>Your Name</label>
											<input type="text" class="form-control" name="fullname" required>
										</div>
										<div class="form-group col-md-6">
											<label>Your Email</label>
											<input type="email" class="form-control" name="email" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label>Contact Number</label>
											<input type="text" class="form-control" name="contactno" required>
										</div>
										<div class="form-group col-md-6">
											<label>Reason For Blood</label>
											<select name="brf" class="form-control" required>
												<option value="">Select</option>
												<option value="Father">Father</option>
												<option value="Mother">Mother</option>
												<option value="Brother">Brother</option>
												<option value="Sister">Sister</option>
												<option value="Others">Others</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label>Your Message</label>
										<textarea class="form-control" name="message" rows="4" required></textarea>
									</div>
									<button type="submit" name="send" class="btn btn-request">
										<i class="fas fa-paper-plane mr-2"></i> Send Request
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php $cnt++;}} ?>
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
	
	<script>
	$(document).ready(function() {
		$('.filter-btn').click(function() {
			$('.filter-btn').removeClass('active');
			$(this).addClass('active');
			
			var group = $(this).data('group');
			if(group === 'all') {
				$('.donor-item').show();
			} else {
				$('.donor-item').hide();
				$('.donor-item[data-group="' + group + '"]').show();
			}
		});
	});
	</script>
</body>
</html>