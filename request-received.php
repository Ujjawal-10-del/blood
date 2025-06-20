<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['bbdmsdid'])==0)
	{	
header('location:logout.php');
}
else{
$uid=$_SESSION['bbdmsdid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blood Donation Management System | Request Received</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Blood Donation, Blood Bank, Request Received">
    
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
        }
        
        body {
            font-family: 'Poppins', sans-serif;
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
        
        .requests-section {
            padding: 80px 0;
        }
        
        .request-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .request-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        
        .request-header {
            background: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
        }
        
        .request-header h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .request-body {
            padding: 30px;
        }
        
        .request-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background: var(--light-bg);
            border-radius: 10px;
        }
        
        .info-item i {
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .info-content h5 {
            margin: 0;
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
        }
        
        .info-content p {
            margin: 5px 0 0 0;
            font-weight: 600;
            color: var(--text-color);
        }
        
        .request-message {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid var(--primary-color);
        }
        
        .request-message h5 {
            margin: 0 0 10px 0;
            color: var(--text-color);
            font-weight: 600;
        }
        
        .request-message p {
            margin: 0;
            color: #666;
            line-height: 1.6;
        }
        
        .no-requests {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        
        .no-requests i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
        }
        
        .no-requests h3 {
            margin-bottom: 10px;
            color: var(--text-color);
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
				<li class="breadcrumb-item active" aria-current="page">Request Received</li>
			</ol>
		</div>
	</div>
	<!-- //page details -->

    <!-- Requests Section -->
    <section class="requests-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center mb-5" style="color: var(--text-color); font-weight: 700;">Blood Requests You've Received</h2>
                    
                    <?php
                    $sql = "SELECT tblbloodrequirer.*, tbldonars.FullName as DonorName, tbldonars.MobileNumber as DonorMobile, tbldonars.BloodGroup 
                           FROM tblbloodrequirer 
                           JOIN tbldonars ON tbldonars.id = tblbloodrequirer.BloodDonarID 
                           WHERE tblbloodrequirer.BloodDonarID = :uid 
                           ORDER BY tblbloodrequirer.ApplyDate DESC";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':uid', $uid, PDO::PARAM_INT);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    
                    if($query->rowCount() > 0) {
                        foreach($results as $result) {
                    ?>
                    <div class="request-card">
                        <div class="request-header">
                            <h3><i class="fas fa-tint mr-2"></i>Blood Request</h3>
                        </div>
                        <div class="request-body">
                            <div class="request-info">
                                <div class="info-item">
                                    <i class="fas fa-user"></i>
                                    <div class="info-content">
                                        <h5>Requester Name</h5>
                                        <p><?php echo htmlentities($result->name); ?></p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <i class="fas fa-phone"></i>
                                    <div class="info-content">
                                        <h5>Requester Phone</h5>
                                        <p><?php echo htmlentities($result->ContactNumber); ?></p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <i class="fas fa-envelope"></i>
                                    <div class="info-content">
                                        <h5>Requester Email</h5>
                                        <p><?php echo htmlentities($result->EmailId); ?></p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <i class="fas fa-heart"></i>
                                    <div class="info-content">
                                        <h5>Blood Required For</h5>
                                        <p><?php echo htmlentities($result->BloodRequirefor); ?></p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <i class="fas fa-calendar"></i>
                                    <div class="info-content">
                                        <h5>Request Date</h5>
                                        <p><?php echo date('d M Y', strtotime($result->ApplyDate)); ?></p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <i class="fas fa-clock"></i>
                                    <div class="info-content">
                                        <h5>Request Time</h5>
                                        <p><?php echo date('h:i A', strtotime($result->ApplyDate)); ?></p>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if(!empty($result->Message)) { ?>
                            <div class="request-message">
                                <h5><i class="fas fa-comment mr-2"></i>Message from Requester</h5>
                                <p><?php echo htmlentities($result->Message); ?></p>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php 
                        }
                    } else {
                    ?>
                    <div class="no-requests">
                        <i class="fas fa-inbox"></i>
                        <h3>No Requests Yet</h3>
                        <p>You haven't received any blood requests yet. When someone requests your blood, it will appear here.</p>
                    </div>
                    <?php } ?>
                </div>
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
<?php } ?> 