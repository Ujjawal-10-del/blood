<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['send']))
{
    $name=$_POST['fullname'];
    $email=$_POST['email'];
    $contactno=$_POST['contactno'];
    $message=$_POST['message'];
    $sql="INSERT INTO  tblcontactusquery(name,EmailId,ContactNumber,Message) VALUES(:name,:email,:contactno,:message)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
    $query->bindParam(':message',$message,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        echo '<script>alert("Query Sent. We will contact you shortly.")</script>';
    }
    else 
    {
        echo "<script>alert('Something went wrong. Please try again.');</script>";  
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Blood Donation Management System | Contact Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Blood Donation, Blood Bank, Contact Us">
    
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
        
        .contact-section {
            padding: 100px 0;
            background: var(--light-bg);
        }
        
        .contact-info {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            height: 100%;
        }
        
        .contact-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .contact-info-item i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-right: 20px;
            width: 60px;
            height: 60px;
            background: var(--light-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .contact-info-item:hover i {
            background: var(--primary-color);
            color: white;
            transform: rotateY(360deg);
        }
        
        .contact-info-item h4 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .contact-info-item p {
            color: #666;
            margin: 0;
        }
        
        .contact-form {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-control {
            height: 50px;
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 10px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255,71,87,0.25);
        }
        
        textarea.form-control {
            height: 150px;
            resize: none;
        }
        
        .btn-submit {
            background: var(--primary-color);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-submit:hover {
            background: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255,71,87,0.3);
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
        
        .social-links a {
            width: 40px;
            height: 40px;
            background: var(--light-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-color);
            margin: 0 10px;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
        }
        
        .map-section {
            padding: 100px 0;
            background: white;
        }
        
        .map-container {
            height: 400px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>
    <?php include('includes/header.php');?>

    <!-- Page Banner -->
    <section class="page-banner">
        <div class="container">
            <h1>Contact Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="contact-info">
                        <h3 class="mb-4">Get In Touch</h3>
                        <?php 
                        $sql = "SELECT * from tblcontactusinfo";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        if($query->rowCount() > 0) {
                            foreach($results as $result) { ?>
                                <div class="contact-info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div>
                                        <h4>Our Location</h4>
                                        <p><?php echo $result->Address; ?></p>
                                    </div>
                                </div>
                                <div class="contact-info-item">
                                    <i class="fas fa-phone"></i>
                                    <div>
                                        <h4>Phone Number</h4>
                                        <p>+<?php echo $result->ContactNo; ?></p>
                                    </div>
                                </div>
                                <div class="contact-info-item">
                                    <i class="fas fa-envelope"></i>
                                    <div>
                                        <h4>Email Address</h4>
                                        <p><?php echo $result->EmailId; ?></p>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="contact-form">
                        <h3 class="mb-4">Send Us a Message</h3>
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="fullname" placeholder="Your Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="tel" class="form-control" name="contactno" placeholder="Phone Number" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" placeholder="Your Message" required></textarea>
                            </div>
                            <button type="submit" name="send" class="btn-submit">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container">
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3517.1234567890123!2d83.9855!3d28.2096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3995937bbf0376ff%3A0xf6cf823b25802164!2sPokhara%2C%20Nepal!5e0!3m2!1sen!2s!4v1645564750981!5m2!1sen!2s" 
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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