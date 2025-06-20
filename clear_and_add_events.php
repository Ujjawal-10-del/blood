<?php
// Database connection settings
$host = 'localhost';
$db   = 'bbdms';
$user = 'root';
$pass = '';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Delete all existing events
    $dbh->exec("DELETE FROM tblevents");
    // Add new, clear, well-detailed events
    $events = [
        [
            'title' => 'Leo Club Pokhara Blood Drive',
            'event_date' => date('Y-m-d', strtotime('+7 days')),
            'venue' => 'Lakeside Community Hall, Pokhara',
            'time' => '10:00 AM - 3:00 PM',
            'organizer' => 'Leo Club Pokhara',
            'contact' => '9800000001',
            'description' => 'Join us for a community blood donation drive to save lives in Pokhara.'
        ],
        [
            'title' => 'Lion Club Annual Blood Camp',
            'event_date' => date('Y-m-d', strtotime('+14 days')),
            'venue' => 'Central Park, Pokhara',
            'time' => '9:00 AM - 2:00 PM',
            'organizer' => 'Lion Club Pokhara',
            'contact' => '9800000002',
            'description' => 'Annual blood camp organized by Lion Club. All are welcome!'
        ],
        [
            'title' => 'Youthful Club Health & Blood Camp',
            'event_date' => date('Y-m-d', strtotime('+21 days')),
            'venue' => 'Health Post, Hemja, Pokhara',
            'time' => '8:00 AM - 1:00 PM',
            'organizer' => 'Youthful Club Pokhara',
            'contact' => '9800000003',
            'description' => 'Health and blood donation camp for the community.'
        ],
        [
            'title' => 'Leo Club Summer Blood Fest',
            'event_date' => date('Y-m-d', strtotime('+28 days')),
            'venue' => 'Community Ground, Prithvi Chowk, Pokhara',
            'time' => '11:00 AM - 4:00 PM',
            'organizer' => 'Leo Club Pokhara',
            'contact' => '9800000004',
            'description' => 'A summer festival with blood donation, music, and food.'
        ],
        [
            'title' => 'Lion Club Mega Blood Donation',
            'event_date' => date('Y-m-d', strtotime('+35 days')),
            'venue' => 'Main Auditorium, Mahendrapool, Pokhara',
            'time' => '10:00 AM - 5:00 PM',
            'organizer' => 'Lion Club Pokhara',
            'contact' => '9800000005',
            'description' => 'Mega blood donation event. Let\'s make a difference together!'
        ],
    ];
    $sql = "INSERT INTO tblevents (title, event_date, venue, time, organizer, contact, description) VALUES (:title, :event_date, :venue, :time, :organizer, :contact, :description)";
    $query = $dbh->prepare($sql);
    foreach ($events as $event) {
        $query->bindParam(':title', $event['title'], PDO::PARAM_STR);
        $query->bindParam(':event_date', $event['event_date'], PDO::PARAM_STR);
        $query->bindParam(':venue', $event['venue'], PDO::PARAM_STR);
        $query->bindParam(':time', $event['time'], PDO::PARAM_STR);
        $query->bindParam(':organizer', $event['organizer'], PDO::PARAM_STR);
        $query->bindParam(':contact', $event['contact'], PDO::PARAM_STR);
        $query->bindParam(':description', $event['description'], PDO::PARAM_STR);
        $query->execute();
    }
    echo "All old events removed and new clear events added!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?> 