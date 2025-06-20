<?php
session_start();
include('includes/config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['alogin'])) {
    header('location:index.php');
    exit();
}

// Handle Add Event
if (isset($_POST['add_event'])) {
    $title = $_POST['title'];
    $event_date = $_POST['event_date'];
                                $venue = $_POST['venue'];
    $time = $_POST['time'];
    $organizer = $_POST['organizer'];
    $contact = $_POST['contact'];
                                $description = $_POST['description'];
    $sql = "INSERT INTO tblevents (title, event_date, venue, time, organizer, contact, description) VALUES (:title, :event_date, :venue, :time, :organizer, :contact, :description)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':event_date', $event_date, PDO::PARAM_STR);
    $query->bindParam(':venue', $venue, PDO::PARAM_STR);
    $query->bindParam(':time', $time, PDO::PARAM_STR);
    $query->bindParam(':organizer', $organizer, PDO::PARAM_STR);
    $query->bindParam(':contact', $contact, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->execute();
    header('Location: manage-events.php');
    exit();
}

// Handle Delete Event
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM tblevents WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    header('Location: manage-events.php');
    exit();
}

// Handle Edit Event
if (isset($_POST['edit_event'])) {
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $event_date = $_POST['event_date'];
    $venue = $_POST['venue'];
    $time = $_POST['time'];
                                $organizer = $_POST['organizer'];
                                $contact = $_POST['contact'];
    $description = $_POST['description'];
    $sql = "UPDATE tblevents SET title = :title, event_date = :event_date, venue = :venue, time = :time, organizer = :organizer, contact = :contact, description = :description WHERE id = :id";
                                $query = $dbh->prepare($sql);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':event_date', $event_date, PDO::PARAM_STR);
                                $query->bindParam(':venue', $venue, PDO::PARAM_STR);
    $query->bindParam(':time', $time, PDO::PARAM_STR);
                                $query->bindParam(':organizer', $organizer, PDO::PARAM_STR);
                                $query->bindParam(':contact', $contact, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    header('Location: manage-events.php');
    exit();
}

// Fetch all events
$sql = "SELECT * FROM tblevents ORDER BY event_date ASC";
$query = $dbh->prepare($sql);
                                $query->execute();
$events = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Events | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #e3eafc 0%, #b6c6e6 100%);
            font-family: 'Montserrat', Arial, sans-serif;
        }
        .main-card {
            background: rgba(255,255,255,0.92);
            border-radius: 22px;
            box-shadow: 0 8px 32px rgba(44,62,80,0.18);
            padding: 48px 32px 32px 32px;
            margin: 48px auto;
            max-width: 1200px;
            backdrop-filter: blur(8px);
            border: 1.5px solid rgba(44,62,80,0.10);
        }
        .header-bar {
            background: linear-gradient(90deg, #2563eb 0%, #1e3a8a 100%);
            border-radius: 18px 18px 0 0;
            padding: 24px 0 18px 0;
            margin-bottom: 32px;
            box-shadow: 0 2px 12px rgba(44,62,80,0.10);
            text-align: center;
            animation: gradientMove 6s ease-in-out infinite alternate;
        }
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }
        .header-bar h1 {
            color: #fff;
            font-size: 2.5rem;
            font-weight: 800;
            letter-spacing: 2px;
            margin: 0;
            text-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .modern-form label {
            font-weight: 600;
            color: #333;
        }
        .modern-form input {
            border-radius: 10px;
            border: 1.5px solid #e0e0e0;
            box-shadow: none;
            font-size: 1rem;
        }
        .modern-form input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37,99,235,0.10);
        }
        .modern-form .btn-danger {
            border-radius: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            background: linear-gradient(90deg, #dc3545 60%, #ff6b81 100%);
            border: none;
            transition: background 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 8px rgba(220,53,69,0.10);
        }
        .modern-form .btn-danger:hover {
            background: linear-gradient(90deg, #ff6b81 0%, #dc3545 100%);
            box-shadow: 0 4px 16px rgba(220,53,69,0.18);
        }
        .table-card {
            background: rgba(255,255,255,0.97);
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(44,62,80,0.10);
            padding: 28px 18px 12px 18px;
            margin-top: 36px;
        }
        .table thead th {
            background: linear-gradient(90deg, #2563eb 60%, #1e3a8a 100%);
            color: #fff;
            font-weight: 700;
            border: none;
            font-size: 1.08rem;
            vertical-align: middle;
        }
        .table thead th i {
            margin-right: 6px;
        }
        .table tbody tr {
            background: #fff;
            transition: background 0.2s;
        }
        .table tbody tr:hover {
            background: #e3eafc;
        }
        .btn-sm {
            border-radius: 7px;
            font-weight: 600;
            font-size: 0.98rem;
            transition: box-shadow 0.2s;
        }
        .btn-primary {
            background: #2563eb;
            border: none;
        }
        .btn-primary:hover {
            background: #1e3a8a;
            box-shadow: 0 2px 8px rgba(37,99,235,0.12);
        }
        .btn-success {
            background: #2ed573;
            border: none;
        }
        .btn-success:hover {
            background: #218838;
            box-shadow: 0 2px 8px rgba(46,213,115,0.12);
        }
        .btn-secondary {
            background: #888;
            border: none;
        }
        .btn-secondary:hover {
            background: #555;
        }
        .btn-danger {
            background: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background: #a71d2a;
            box-shadow: 0 2px 8px rgba(220,53,69,0.12);
        }
        @media (max-width: 991px) {
            .main-card { padding: 16px 2px; }
            .table-card { padding: 8px 1px; }
            .header-bar h1 { font-size: 1.5rem; }
        }
        .table td:last-child, .table th:last-child {
            min-width: 120px;
            width: 1%;
            white-space: nowrap;
            overflow-x: auto;
        }
        .action-btns {
            display: flex;
            flex-direction: column;
            gap: 6px;
            justify-content: center;
            align-items: center;
            white-space: nowrap;
        }
        .action-btns::after, .action-btns::before {
            display: none !important;
            content: none !important;
        }
        td.action-btns {
            border-bottom: none !important;
        }
        .action-btns a {
            flex-shrink: 0;
            white-space: nowrap;
            width: 70px;
            text-align: center;
            font-size: 0.85rem;
            padding: 3px 0;
        }
        /* Increase font size for Title, Date, and Time columns */
        .table th.title-col, .table td.title-col {
            font-size: 1.25rem;
            font-weight: 700;
            min-width: 200px;
            width: 260px;
        }
        .table th.date-col, .table td.date-col {
            font-size: 1.25rem;
            font-weight: 400;
            min-width: 140px;
            width: 160px;
        }
        .table th.time-col, .table td.time-col {
            font-size: 1.25rem;
            font-weight: 400;
            min-width: 110px;
            width: 130px;
        }
        .table th.organizer-col, .table td.organizer-col {
            min-width: 140px;
            width: 160px;
        }
        /* Center and style Add Event form */
        .add-event-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 32px;
        }
        .modern-form {
            max-width: 900px;
            margin: 0 auto;
            background: #f8fafc;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(44,62,80,0.08);
            padding: 24px 32px 18px 32px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .modern-form .form-row {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            gap: 18px 12px;
            justify-content: center;
        }
        .modern-form .form-group {
            flex: 1 1 160px;
            min-width: 140px;
            margin-bottom: 0;
        }
        .modern-form label {
            display: block;
            margin-bottom: 4px;
            font-weight: 600;
            color: #333;
        }
        .modern-form input {
            border-radius: 10px;
            border: 1.5px solid #e0e0e0;
            box-shadow: none;
            font-size: 1rem;
            width: 100%;
        }
        .modern-form .add-btn-row {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 18px;
        }
        @media (max-width: 991px) {
            .modern-form { padding: 12px 4px 8px 4px; }
            .modern-form .form-row { gap: 10px 0; }
        }
        .main-top,
        .navbar,
        .navbar * {
            border-bottom: none !important;
            box-shadow: none !important;
            background-image: none !important;
        }
        .main-top::after,
        .main-top::before,
        .navbar::after,
        .navbar::before,
        .navbar *::after,
        .navbar *::before {
            border-bottom: none !important;
            box-shadow: none !important;
            background: none !important;
            background-image: none !important;
            content: none !important;
        }
    </style>
</head>
<body>
<div class="main-card">
    <div class="header-bar"><h1><i class="fa fa-calendar"></i> Manage Blood Donation Events</h1></div>
    <div class="add-event-wrapper">
        <!-- Add Event Form -->
        <form method="post" class="modern-form bg-light rounded">
            <div class="form-row align-items-end">
                            <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="event_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Venue</label>
                                <input type="text" name="venue" class="form-control" required>
                            </div>
                            <div class="form-group">
                    <label>Time</label>
                    <input type="text" name="time" class="form-control" placeholder="e.g. 10am-3pm" required>
                            </div>
                            <div class="form-group">
                    <label>Organizer</label>
                                <input type="text" name="organizer" class="form-control" required>
                            </div>
                            <div class="form-group">
                    <label>Contact</label>
                                <input type="text" name="contact" class="form-control" required>
                            </div>
                            <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" class="form-control" required>
                </div>
            </div>
            <div class="add-btn-row">
                <button type="submit" name="add_event" class="btn btn-danger btn-block"><i class="fa fa-plus"></i> Add Event</button>
        </div>
        </form>
                    </div>
    <!-- Events Table -->
    <div class="table-card">
        <table class="table table-bordered table-striped table-hover">
            <caption class="text-center font-weight-bold" style="caption-side:top;color:#dc3545;">All Upcoming and Past Events</caption>
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                    <th class="title-col">Title</th>
                    <th class="date-col"><i class="fa fa-calendar"></i> Date</th>
                    <th><i class="fa fa-map-marker"></i> Venue</th>
                    <th class="time-col"><i class="fa fa-clock-o"></i> Time</th>
                    <th class="organizer-col"><i class="fa fa-users"></i> Organizer</th>
                    <th><i class="fa fa-phone"></i> Contact</th>
                    <th><i class="fa fa-info-circle"></i> Description</th>
                    <th><i class="fa fa-cogs"></i> Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
            <?php $cnt=1; foreach ($events as $event): ?>
                <tr>
                    <td><?= $cnt++; ?></td>
                    <?php if(isset($_GET['edit']) && $_GET['edit'] == $event->id): ?>
                    <form method="post" class="form-inline">
                        <input type="hidden" name="id" value="<?= $event->id ?>">
                        <td class="title-col"><input type="text" name="title" value="<?= htmlentities($event->title ?? '') ?>" class="form-control" required></td>
                        <td class="date-col"><input type="date" name="event_date" value="<?= htmlentities($event->event_date ?? '') ?>" class="form-control" required></td>
                        <td><input type="text" name="venue" value="<?= htmlentities($event->venue ?? '') ?>" class="form-control" required></td>
                        <td class="time-col"><input type="text" name="time" value="<?= htmlentities($event->time ?? '') ?>" class="form-control" required></td>
                        <td class="organizer-col"><input type="text" name="organizer" value="<?= htmlentities($event->organizer ?? '') ?>" class="form-control" required></td>
                        <td><input type="text" name="contact" value="<?= htmlentities($event->contact ?? '') ?>" class="form-control" required></td>
                        <td><input type="text" name="description" value="<?= htmlentities($event->description ?? '') ?>" class="form-control" required></td>
                        <td>
                            <button type="submit" name="edit_event" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
                            <a href="manage-events.php" class="btn btn-secondary btn-sm"><i class="fa fa-times"></i> Cancel</a>
                                                </td>
                    </form>
                    <?php else: ?>
                    <td class="title-col"><?= htmlentities($event->title ?? '') ?></td>
                    <td class="date-col"><?= htmlentities($event->event_date ?? '') ?></td>
                    <td><?= htmlentities($event->venue ?? '') ?></td>
                    <td class="time-col"><?= htmlentities($event->time ?? '') ?></td>
                    <td class="organizer-col"><?= htmlentities($event->organizer ?? '') ?></td>
                    <td><?= htmlentities($event->contact ?? '') ?></td>
                    <td><?= htmlentities($event->description ?? '') ?></td>
                    <td class="action-btns">
                        <a href="manage-events.php?edit=<?= $event->id ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="manage-events.php?delete=<?= $event->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this event?');"><i class="fa fa-trash"></i> Delete</a>
                                                </td>
                    <?php endif; ?>
                                            </tr>
            <?php endforeach; ?>
                                </tbody>
                            </table>
    </div>
</div>
</body>
</html> 