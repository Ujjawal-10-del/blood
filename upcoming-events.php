<?php
session_start();
include('includes/config.php');
// Redirect to login if not logged in
if (!isset($_SESSION['login']) && !isset($_SESSION['alogin'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upcoming Events | Blood Donation Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <style>
        .list-group-item strong {
            color: #dc3545;
            font-size: 1.1rem;
        }
        .list-group-item {
            font-size: 1rem;
            background: #fff;
            border-left: 4px solid #dc3545;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<?php include('includes/header.php'); ?>
<div class="container" style="margin-top: 60px; margin-bottom: 60px;">
    <h2 class="mb-5 text-center" style="color:#dc3545; font-weight:700;">Upcoming Blood Donation Events</h2>
    <?php
    $today = date('Y-m-d');
    $sql = "SELECT * FROM tblevents WHERE event_date >= :today ORDER BY event_date ASC";
    try {
        $query = $dbh->prepare($sql);
        $query->bindParam(':today', $today, PDO::PARAM_STR);
        $query->execute();
        $events = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            echo '<ul class="list-group mb-4">';
            foreach ($events as $event) {
                echo '<li class="list-group-item">';
                echo '<strong>' . htmlentities($event->title) . '</strong> &mdash; ';
                echo date('F j, Y', strtotime($event->event_date));
                if (!empty($event->venue)) {
                    echo '<br><span><b>Venue:</b> ' . htmlentities($event->venue) . '</span>';
                }
                if (!empty($event->organizer)) {
                    echo '<br><span><b>Organizer:</b> ' . htmlentities($event->organizer) . '</span>';
                }
                if (!empty($event->contact)) {
                    echo '<br><span><b>Contact:</b> ' . htmlentities($event->contact) . '</span>';
                }
                if (!empty($event->description)) {
                    echo '<br><span style="color:#555"><b>Description:</b> ' . nl2br(htmlentities($event->description)) . '</span>';
                }
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<div class="alert alert-info text-center">No upcoming events at the moment. Please check back later!</div>';
        }
    } catch (Exception $e) {
        echo '<div class="alert alert-danger text-center">Database error: ' . htmlentities($e->getMessage()) . '</div>';
    }
    ?>
</div>
<?php include('includes/footer.php'); ?>
</body>
</html> 