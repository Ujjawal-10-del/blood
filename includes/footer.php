<footer>
    <div class="w3ls-footer-grids pt-sm-4 pt-3">
      <div class="container py-xl-5 py-lg-3">
        <div class="row">
          <div class="col-md-4 w3l-footer">
            <h2 class="mb-sm-3 mb-2">
              <a href="index.php" class="text-white font-italic font-weight-bold">
                <span>Bloodlink & </span>Donor Management System 
                <i class="fas fa-syringe ml-2"></i>
              </a>
            </h2>
            <p>Your little effort can give  seconds chance to lives others.</p>
          </div>
          <div class="col-md-4 w3l-footer my-md-0 my-4">
            <h3 class="mb-sm-3 mb-2 text-white">Address</h3>
            <ul class="list-unstyled">
              <?php 
$pagetype="contactus";
$sql = "SELECT * from tblcontactusinfo";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
              <li>
                <i class="fas fa-location-arrow float-left"></i>
                <p class="ml-4">
                  <span><?php  echo $result->Address; ?>. </p>
                <div class="clearfix"></div>
              </li>
              <li class="my-3">
                <i class="fas fa-phone float-left"></i>
                <p class="ml-4"><?php  echo $result->ContactNo; ?></p>
                <div class="clearfix"></div>
              </li>
              <li>
                <i class="far fa-envelope-open float-left"></i>
                <a href="mailto:info@example.com" class="ml-3"><?php  echo $result->EmailId; ?></a>
                <div class="clearfix"></div>
              </li>
            <?php } } ?></ul>
          </div>
          <div class="col-md-4 w3l-footer">
            <h3 class="mb-sm-3 mb-2 text-white">Quick Links</h3>
            <div class="nav-w3-l">
              <ul class="list-unstyled">
                <li>
                  <a href="index.php">Home</a>
                </li>
                <li class="mt-2">
                  <a href="about.php">About Us</a>
                </li>
                <li class="mt-2">
                  <a href="contact.php">Contact Us</a>
                </li>
            
              </ul>
            </div>
          </div>
        </div>
        <div class="border-top mt-5 pt-lg-4 pt-3 pb-lg-0 pb-3 text-center">
          <p class="copy-right-grids mt-lg-1">©  Bloodlink and Donor Management System
           
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- //footer -->

<style>
footer {
    background: #ff4757 !important;
}

.footer {
    background: var(--primary-color);
    padding: 80px 0 20px;
    color: #fff;
}

.footer-title {
    font-size: 24px;
    margin-bottom: 25px;
    color: #fff;
}

.footer-title a {
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-title a:hover {
    color: #fff;
    opacity: 0.8;
}

.footer-title span {
    color: #fff;
    opacity: 0.9;
}

.footer-description {
    color: rgba(255,255,255,0.8);
    margin-bottom: 25px;
    line-height: 1.8;
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-link {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    transition: all 0.3s ease;
}

.social-link:hover {
    background: rgba(255,255,255,0.2);
    color: #fff;
    transform: translateY(-3px);
}

.contact-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
}

.contact-item i {
    color: #fff;
    font-size: 20px;
    margin-right: 15px;
    margin-top: 5px;
}

.contact-item p {
    color: rgba(255,255,255,0.8);
    margin: 0;
    line-height: 1.6;
}

.footer-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-menu li {
    margin-bottom: 15px;
}

.footer-menu a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

.footer-menu a:hover {
    color: #fff;
    transform: translateX(5px);
}

.footer-menu a:before {
    content: '\f105';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    margin-right: 10px;
    color: #fff;
}

.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.1);
    margin-top: 50px;
    padding-top: 20px;
    text-align: center;
}

.copyright p {
    color: rgba(255,255,255,0.8);
    margin: 0;
}

@media (max-width: 991px) {
    .footer {
        padding: 60px 0 20px;
    }
    
    .footer-title {
        font-size: 20px;
    }
}

@media (max-width: 767px) {
    .footer {
        padding: 40px 0 20px;
    }
    
    .footer-about,
    .footer-contact,
    .footer-links {
        margin-bottom: 30px;
    }
}

.w3ls-footer-grids {
    background: #ff4757 !important;
}

.w3l-footer h2 a span {
    color: #fff !important;
}
</style>