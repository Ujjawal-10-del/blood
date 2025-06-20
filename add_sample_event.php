<?php
// Database connection settings (edit if needed)
$host = 'localhost';
$db   = 'bbdms';
$user = 'root';
$pass = '';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $events = [
        [
            'title' => 'Leo Club Blood Donation Drive',
            'event_date' => date('Y-m-d', strtotime('+10 days')),
            'description' => 'Join the Leo Club for a community blood donation drive. Venue: City Hall. Time: 10am-3pm.'
        ],
        [
            'title' => 'Lion Club Annual Blood Camp',
            'event_date' => date('Y-m-d', strtotime('+15 days')),
            'description' => 'Lion Club organizes its annual blood camp. Venue: Central Park. Time: 9am-2pm.'
        ],
        [
            'title' => 'Youthful Club Youth Blood Donation',
            'event_date' => date('Y-m-d', strtotime('+20 days')),
            'description' => 'Youthful Club invites all youths to donate blood. Venue: Youth Center. Time: 11am-4pm.'
        ],
        [
            'title' => 'Leo Club Summer Blood Fest',
            'event_date' => date('Y-m-d', strtotime('+25 days')),
            'description' => 'A summer blood donation festival by Leo Club. Venue: Community Ground. Time: 8am-1pm.'
        ],
        [
            'title' => 'Lion Club Mega Blood Donation',
            'event_date' => date('Y-m-d', strtotime('+30 days')),
            'description' => 'Mega blood donation event by Lion Club. Venue: Main Auditorium. Time: 10am-5pm.'
        ],
        [
            'title' => 'Youthful Club Health & Blood Camp',
            'event_date' => date('Y-m-d', strtotime('+35 days')),
            'description' => 'Health and blood donation camp by Youthful Club. Venue: Health Post. Time: 9am-3pm.'
        ],
    ];
    $sql = "INSERT INTO tblevents (title, event_date, description) VALUES (:title, :event_date, :description)";
    $query = $dbh->prepare($sql);
    foreach ($events as $event) {
        $query->bindParam(':title', $event['title'], PDO::PARAM_STR);
        $query->bindParam(':event_date', $event['event_date'], PDO::PARAM_STR);
        $query->bindParam(':description', $event['description'], PDO::PARAM_STR);
        $query->execute();
    }
    echo "Multiple sample events added successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?> 