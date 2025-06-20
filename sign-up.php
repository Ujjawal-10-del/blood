<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('includes/config.php');

if(isset($_POST['submit'])) {
    try {
        // Log the start of registration process
        error_log("Starting registration process...");
        
        // Validate required fields
        $required_fields = ['fullname', 'mobileno', 'emailid', 'age', 'gender', 'bloodgroup', 'address', 'message', 'password'];
        $missing_fields = [];
        
        foreach($required_fields as $field) {
            if(empty($_POST[$field])) {
                $missing_fields[] = $field;
            }
        }
        
        if(!empty($missing_fields)) {
            error_log("Missing required fields: " . implode(', ', $missing_fields));
            echo "<script>alert('Please fill in all required fields: " . implode(', ', $missing_fields) . "');</script>";
            exit;
        }

        // Sanitize and validate input
        $fullname = htmlspecialchars(trim($_POST['fullname']), ENT_QUOTES, 'UTF-8');
        $mobile = htmlspecialchars(trim($_POST['mobileno']), ENT_QUOTES, 'UTF-8');
        $email = filter_var(trim($_POST['emailid']), FILTER_SANITIZE_EMAIL);
        $age = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);
        $gender = htmlspecialchars(trim($_POST['gender']), ENT_QUOTES, 'UTF-8');
        $blodgroup = htmlspecialchars(trim($_POST['bloodgroup']), ENT_QUOTES, 'UTF-8');
        $address = htmlspecialchars(trim($_POST['address']), ENT_QUOTES, 'UTF-8');
        $message = htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8');
        $status = 1;
        $password = md5($_POST['password']);

        error_log("Sanitized input data: " . json_encode([
            'fullname' => $fullname,
            'mobile' => $mobile,
            'email' => $email,
            'age' => $age,
            'gender' => $gender,
            'bloodgroup' => $blodgroup,
            'address' => $address
        ]));

        // Validate email format
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            error_log("Invalid email format: " . $email);
            echo "<script>alert('Invalid email format');</script>";
            exit;
        }

        // Check if email already exists
        $ret = "SELECT EmailId FROM tbldonars WHERE EmailId = :email";
        $query = $dbh->prepare($ret);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        
        if($query->rowCount() > 0) {
            error_log("Email already exists: " . $email);
            echo "<script>alert('Email-id already exists. Please try again');</script>";
            exit;
        }

        // Insert new donor
        $sql = "INSERT INTO tbldonars (FullName, MobileNumber, EmailId, Age, Gender, BloodGroup, Address, Message, status, Password) 
                VALUES (:fullname, :mobile, :email, :age, :gender, :blodgroup, :address, :message, :status, :password)";
        
        error_log("Preparing SQL query: " . $sql);
        
        $query = $dbh->prepare($sql);
        
        // Bind parameters
        $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':age', $age, PDO::PARAM_INT);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':blodgroup', $blodgroup, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_INT);
        $query->bindParam(':password', $password, PDO::PARAM_STR);

        error_log("Executing query...");
        
        // Execute the query
        if($query->execute()) {
            $lastInsertId = $dbh->lastInsertId();
            if($lastInsertId) {
                error_log("Registration successful. New donor ID: " . $lastInsertId);
                echo "<script>alert('Registration successful!');</script>";
                echo "<script>window.location.href='login.php';</script>";
            } else {
                error_log("Registration failed: No last insert ID");
                echo "<script>alert('Registration failed. Please try again.');</script>";
            }
        } else {
            $error = $query->errorInfo();
            error_log("Database error during registration: " . $error[2]);
            echo "<script>alert('Database error: " . $error[2] . "');</script>";
        }
    } catch(PDOException $e) {
        error_log("PDO Exception during registration: " . $e->getMessage());
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blood Donation Management System | Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Blood Donation, Blood Bank, Sign Up">
    
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
        
        .signup-section {
            padding: 80px 0;
        }
        
        .signup-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 800px;
            margin: 0 auto;
            margin-top: -50px;
            position: relative;
            z-index: 3;
        }
        
        .signup-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .signup-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 10px;
        }
        
        .signup-header p {
            color: #666;
            font-size: 1rem;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-color);
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .form-control {
            height: 50px;
            border-radius: 10px;
            border: 2px solid #eee;
            padding: 10px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: none;
        }
        
        textarea.form-control {
            height: auto;
            min-height: 100px;
        }
        
        .btn-signup {
            background: var(--primary-color);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            width: 100%;
            height: 50px;
            margin-top: 20px;
        }
        
        .btn-signup:hover {
            background: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255,71,87,0.3);
        }
        
        .signup-footer {
            text-align: center;
            margin-top: 30px;
        }
        
        .signup-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .signup-footer a:hover {
            color: var(--secondary-color);
        }
        
        .input-group {
            position: relative;
        }
        
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }
        
        .input-group .form-control {
            padding-left: 45px;
        }
        
        .row {
            margin: 0 -15px;
        }
        
        .col-md-6 {
            padding: 0 15px;
        }
    </style>
</head>

<body>
    <?php include('includes/header.php');?>

    <!-- Page Banner -->
    <section class="page-banner">
        <div class="container">
            <h1>Sign Up</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Sign Up Section -->
    <section class="signup-section">
        <div class="container">
            <div class="signup-card">
                <div class="signup-header">
                    <h2>Create Account</h2>
                    <p>Join our blood donation community</p>
                </div>
                
                <form action="#" method="post" name="signup" onsubmit="return checkpass();">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Name</label>
                                <div class="input-group">
                                    <i class="fas fa-user"></i>
                                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter your full name" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <div class="input-group">
                                    <i class="fas fa-phone"></i>
                                    <input type="text" class="form-control" name="mobileno" id="mobileno" required placeholder="Enter your mobile number" maxlength="10" pattern="[0-9]+">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email ID</label>
                                <div class="input-group">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" name="emailid" class="form-control" placeholder="Enter your email" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Age</label>
                                <div class="input-group">
                                    <i class="fas fa-birthday-cake"></i>
                                    <input type="number" class="form-control" name="age" id="age" placeholder="Enter your age" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control" id="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                        
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
                    </div>
                    
                    <div class="form-group">
                        <label>Address</label>
                        <div class="input-group">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" class="form-control" name="address" id="address" required placeholder="Enter your address">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" name="message" required placeholder="Enter your message"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" class="form-control" name="password" id="password" required placeholder="Enter your password">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-signup" name="submit">
                        <i class="fas fa-user-plus mr-2"></i> Create Account
                    </button>
                    
                    <div class="signup-footer">
                        <p>Already have an account? <a href="login.php">Sign in now</a></p>
                    </div>
                </form>
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