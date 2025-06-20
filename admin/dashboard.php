<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="Blood Donation Management System Admin Dashboard">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Blood Donation Management System | Admin Dashboard</title>

	<!-- Custom-Files -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
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
			background: var(--light-bg);
		}
		
		.content-wrapper {
			padding: 30px;
		}
		
		.page-title {
			font-size: 2rem;
			font-weight: 700;
			color: var(--text-color);
			margin-bottom: 30px;
			padding-bottom: 15px;
			border-bottom: 2px solid var(--light-bg);
		}
		
		.stats-card {
			background: white;
			border-radius: 15px;
			box-shadow: 0 5px 15px rgba(0,0,0,0.1);
			padding: 25px;
			margin-bottom: 30px;
			transition: all 0.3s ease;
			border: none;
		}
		
		.stats-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 8px 25px rgba(0,0,0,0.15);
		}
		
		.stats-card.primary {
			background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
		}
		
		.stats-card.success {
			background: linear-gradient(45deg, #2ed573, #7bed9f);
		}
		
		.stats-card.info {
			background: linear-gradient(45deg, #1e90ff, #70a1ff);
		}
		
		.stats-card.warning {
			background: linear-gradient(45deg, #ffa502, #ffd32a);
		}
		
		.stats-card .icon {
			font-size: 2.5rem;
			color: rgba(255,255,255,0.8);
			margin-bottom: 15px;
		}
		
		.stats-card .number {
			font-size: 2.5rem;
			font-weight: 700;
			color: white;
			margin-bottom: 5px;
		}
		
		.stats-card .title {
			font-size: 1rem;
			color: rgba(255,255,255,0.9);
			text-transform: uppercase;
			letter-spacing: 1px;
		}
		
		.stats-card .footer {
			margin-top: 20px;
			padding-top: 15px;
			border-top: 1px solid rgba(255,255,255,0.1);
		}
		
		.stats-card .footer a {
			color: white;
			text-decoration: none;
			font-size: 0.9rem;
			display: flex;
			align-items: center;
			justify-content: space-between;
			transition: all 0.3s ease;
		}
		
		.stats-card .footer a:hover {
			transform: translateX(5px);
		}
		
		.stats-card .footer i {
			font-size: 1.2rem;
		}
		
		.chart-container {
			background: white;
			border-radius: 15px;
			box-shadow: 0 5px 15px rgba(0,0,0,0.1);
			padding: 25px;
			margin-bottom: 30px;
		}
		
		.chart-title {
			font-size: 1.2rem;
			font-weight: 600;
			color: var(--text-color);
			margin-bottom: 20px;
		}
		
		.recent-activity {
			background: white;
			border-radius: 15px;
			box-shadow: 0 5px 15px rgba(0,0,0,0.1);
			padding: 25px;
		}
		
		.activity-item {
			display: flex;
			align-items: center;
			padding: 15px 0;
			border-bottom: 1px solid var(--light-bg);
		}
		
		.activity-item:last-child {
			border-bottom: none;
		}
		
		.activity-icon {
			width: 40px;
			height: 40px;
			border-radius: 50%;
			background: var(--light-bg);
			display: flex;
			align-items: center;
			justify-content: center;
			margin-right: 15px;
			color: var(--primary-color);
		}
		
		.activity-content {
			flex: 1;
		}
		
		.activity-title {
			font-weight: 600;
			color: var(--text-color);
			margin-bottom: 5px;
		}
		
		.activity-time {
			font-size: 0.8rem;
			color: #666;
		}
	</style>
</head>

<body>
<?php include('includes/header.php');?>

	<div class="ts-main-content">
<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Dashboard</h2>
						
						<div class="row">
							<div class="col-md-3">
								<div class="stats-card primary">
									<?php 
									$sql = "SELECT id from tblbloodgroup";
									$query = $dbh->prepare($sql);
									$query->execute();
									$results = $query->fetchAll(PDO::FETCH_OBJ);
									$bg = $query->rowCount();
									?>
									<div class="icon">
										<i class="fa fa-tint"></i>
									</div>
									<div class="number"><?php echo htmlentities($bg);?></div>
									<div class="title">Blood Groups</div>
									<div class="footer">
										<a href="manage-bloodgroup.php">
											View Details
											<i class="fa fa-arrow-right"></i>
										</a>
									</div>
								</div>
							</div>
							
							<div class="col-md-3">
								<div class="stats-card success">
									<?php 
									$sql1 = "SELECT id from tbldonars";
									$query1 = $dbh->prepare($sql1);
									$query1->execute();
									$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
									$regbd = $query1->rowCount();
									?>
									<div class="icon">
										<i class="fa fa-users"></i>
									</div>
									<div class="number"><?php echo htmlentities($regbd);?></div>
									<div class="title">Registered Donors</div>
									<div class="footer">
										<a href="donor-list.php">
											View Details
											<i class="fa fa-arrow-right"></i>
										</a>
									</div>
								</div>
							</div>
							
							<div class="col-md-3">
								<div class="stats-card info">
									<?php 
									$sql2 = "SELECT id from tblcontactusquery";
									$query2 = $dbh->prepare($sql2);
									$query2->execute();
									$results2 = $query2->fetchAll(PDO::FETCH_OBJ);
									$cq = $query2->rowCount();
									?>
									<div class="icon">
										<i class="fa fa-question-circle"></i>
									</div>
									<div class="number"><?php echo htmlentities($cq);?></div>
									<div class="title">Total Queries</div>
									<div class="footer">
										<a href="manage-conactusquery.php">
											View Details
											<i class="fa fa-arrow-right"></i>
										</a>
									</div>
								</div>
							</div>

							<div class="col-md-3">
								<div class="stats-card warning">
									<?php 
									$sql3 = "SELECT id from tblbloodrequirer";
									$query3 = $dbh->prepare($sql3);
									$query3->execute();
									$results3 = $query3->fetchAll(PDO::FETCH_OBJ);
									$tr = $query3->rowCount();
									?>
									<div class="icon">
										<i class="fa fa-bell"></i>
									</div>
									<div class="number"><?php echo htmlentities($tr);?></div>
									<div class="title">Total Blood Requests</div>
									<div class="footer">
										<a href="blood-requests.php">
											View Details
											<i class="fa fa-arrow-right"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="chart-container">
									<h3 class="chart-title">Blood Group Distribution</h3>
									<canvas id="bloodGroupChart"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Recent Donations</div>
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Donor Name</th>
														<th>Mobile Number</th>
														<th>Email ID</th>
														<th>Age</th>
														<th>Gender</th>
														<th>Blood Group</th>
														<th>Address</th>
														<th>Message</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$sql = "SELECT * from tbldonars order by rand() limit 5";
													$query = $dbh -> prepare($sql);
													$query->execute();
													$results=$query->fetchAll(PDO::FETCH_OBJ);
													$cnt=1;
													if($query->rowCount() > 0)
													{
														foreach($results as $result)
														{
													?>
													<tr>
														<td><?php echo htmlentities($cnt);?></td>
														<td><?php echo htmlentities($result->FullName);?></td>
														<td><?php echo htmlentities($result->MobileNumber);?></td>
														<td><?php echo htmlentities($result->EmailId);?></td>
														<td><?php echo htmlentities($result->Age);?></td>
														<td><?php echo htmlentities($result->Gender);?></td>
														<td><?php echo htmlentities($result->BloodGroup);?></td>
														<td><?php echo htmlentities($result->Address);?></td>
														<td><?php echo htmlentities($result->Message);?></td>
													</tr>
													<?php $cnt=$cnt+1; }} ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	
	<script>
		// Blood Group Distribution Chart
		var ctx = document.getElementById('bloodGroupChart').getContext('2d');
		var bloodGroupChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'],
				datasets: [{
					label: 'Number of Donors',
					data: [
						<?php
						$sql = "SELECT BloodGroup, COUNT(*) as count FROM tbldonars GROUP BY BloodGroup";
						$query = $dbh->prepare($sql);
						$query->execute();
						$results = $query->fetchAll(PDO::FETCH_OBJ);
						$counts = array();
						foreach($results as $result) {
							$counts[$result->BloodGroup] = $result->count;
						}
						echo $counts['A+'] . ', ' . $counts['A-'] . ', ' . $counts['B+'] . ', ' . $counts['B-'] . ', ' . 
							 $counts['O+'] . ', ' . $counts['O-'] . ', ' . $counts['AB+'] . ', ' . $counts['AB-'];
						?>
					],
					backgroundColor: [
						'#ff4757',
						'#ff6b81',
						'#2ed573',
						'#7bed9f',
						'#1e90ff',
						'#70a1ff',
						'#ffa502',
						'#ffd32a'
					],
					borderWidth: 0
				}]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				scales: {
					y: {
						beginAtZero: true,
						grid: {
							display: true,
							color: 'rgba(0,0,0,0.1)'
						}
					},
					x: {
						grid: {
							display: false
						}
					}
				},
				plugins: {
					legend: {
						display: false
					}
				}
			}
		});
	</script>
</body>
</html>
<?php } ?>