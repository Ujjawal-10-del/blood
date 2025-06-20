<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['send']))
  {
    $cid=$_GET['cid'];
$name=$_POST['fullname'];
$email=$_POST['email'];
$contactno=$_POST['contactno'];
$brf=$_POST['brf'];
$message=$_POST['message'];
$sql="INSERT INTO  tblbloodrequirer(BloodDonarID,name,EmailId,ContactNumber,BloodRequirefor,Message) VALUES(:cid,:name,:email,:contactno,:brf,:message)";
$query = $dbh->prepare($sql);
$query->bindParam(':cid',$cid,PDO::PARAM_STR);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
$query->bindParam(':brf',$brf,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{

echo '<script>alert("Request has been sent. We will contact you shortly.")</script>';
echo "<script>window.location.href ='donor-list.php'</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again.');</script>";  
}

}
else {
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Blood Bank Donar Management System | Blood Requerer </title>
    <!-- Meta tag Keywords -->
    
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
        .isFixed {
            background-color: #dc3545 !important;
        }
        .isFixed .navbar-nav .nav-link {
            color: #fff !important;
        }
        .isFixed .navbar-nav .nav-link:hover,
        .isFixed .navbar-nav .nav-link:focus {
            color: #fff !important;
            opacity: 0.8;
        }
        .isFixed .navbar-brand {
            color: #fff !important;
        }
        nav.navbar.navbar-expand-lg.navbar-light {
            background-color: rgba(220, 53, 69, 0.26);
        }
        nav.navbar.navbar-expand-lg.navbar-light.isFixed {
            background-color: #dc3545 !important;
        }
    </style>

</head>

<body>
    <?php include('includes/header.php');?>

    <!-- banner 2 -->
    <div class="inner-banner-w3ls" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('images/banner2.jpg') no-repeat center; background-size: cover; min-height: 300px; display: flex; align-items: center;">
        <div class="container">
            <h2 class="text-center text-white" style="font-size: 3em; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Request Blood</h2>
        </div>
    </div>
    <!-- //banner 2 -->
    <!-- page details -->
    <div class="breadcrumb-agile" style="background-color: #f8f9fa; padding: 15px 0;">
        <div class="container">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Blood Needed Person</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- //page details -->

    <!-- contact -->
    <div class="agileits-contact py-5" style="background-color: #fff;">
        <div class="py-xl-5 py-lg-3">
            <div class="w3ls-titles text-center mb-5">
                <h3 class="title" style="color: #dc3545; font-size: 2.5em; margin-bottom: 20px;">Contact For Blood</h3>
                <span style="color: #dc3545; font-size: 2em;">
                    <i class="fas fa-user-md"></i>
                </span>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 contact-right-w3l">
                        <div class="card shadow-lg" style="border: none; border-radius: 15px;">
                            <div class="card-body p-5">
                                <h5 class="title-w3 text-center mb-4" style="color: #dc3545; font-size: 1.5em;">Fill following form for blood</h5>
                                <form action="#" method="post">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label" style="color: #333; font-weight: 600;">Your Name</label>
                                                <input type="text" class="form-control" id="name" name="fullname" placeholder="Please enter your name" style="border: 1px solid #dc3545; border-radius: 8px; padding: 12px;">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label" style="color: #333; font-weight: 600;">Phone Number</label>
                                                <input type="tel" class="form-control" id="phone" name="contactno" placeholder="Please enter your phone number" style="border: 1px solid #dc3545; border-radius: 8px; padding: 12px;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label" style="color: #333; font-weight: 600;">Email Address</label>
                                                <input type="email" class="form-control" id="email" name="email" required placeholder="Please enter your email address" style="border: 1px solid #dc3545; border-radius: 8px; padding: 12px;">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label" style="color: #333; font-weight: 600;">Blood Require For</label>
                                                <select class="form-control" id="phone" name="brf" style="border: 1px solid #dc3545; border-radius: 8px; padding: 12px;">
                                                    <option value="">Select Relationship</option>
                                                    <option value="Father">Father</option>
                                                    <option value="Mother">Mother</option>
                                                    <option value="Brother">Brother</option>
                                                    <option value="Sister">Sister</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="recipient-name" class="col-form-label" style="color: #333; font-weight: 600;">Message</label>
                                        <textarea rows="6" class="form-control" id="message" name="message" placeholder="Please enter your message" maxlength="999" style="resize:none; border: 1px solid #dc3545; border-radius: 8px; padding: 12px;"></textarea>
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="submit" value="Send Message" name="send" style="background-color: #dc3545; color: white; border: none; padding: 12px 30px; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; width: 100%;">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //contact -->

    


    <?php include('includes/footer.php');?>

    <!-- Js files -->
    <!-- JavaScript -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- Default-JavaScript-File -->

    <!-- banner slider -->
    <script src="js/responsiveslides.min.js"></script>
    <script>
        $(function () {
            $("#slider4").responsiveSlides({
                auto: true,
                pager: true,
                nav: true,
                speed: 1000,
                namespace: "callbacks",
                before: function () {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function () {
                    $('.events').append("<li>after event fired.</li>");
                }
            });
        });
    </script>
    <!-- //banner slider -->

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

</html>
<?php } ?>