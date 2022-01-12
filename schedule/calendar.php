<?php
// Set your timezone!!
date_default_timezone_set('Europe/Amsterdam');

$date = new DateTime;
if (isset($_GET['year']) && isset($_GET['week'])) {
    $date->setISODate($_GET['year'], $_GET['week']);
} else {
    $date->setISODate($date->format('o'), $date->format('W'));
}

$year = $date->format('o');
$yw = $date->format('W');

$today = $date->format('d M Y');

$title = 'Week ' . $date->format('W, o');

$prev = ['week' => $yw-1, 'year' => $year];
$next = ['week' => $yw+1, 'year' => $year];

$day_count = 7;

$week = [];
$day = [];

for ($x=1; $x <= $day_count; $x++) {
    $day['day'] = $date->format('l');
    $day['date'] = $date->format('j');
    $day['full_date'] = $date->format('Y-m-j');
    
    array_push($week, $day);
    $date->modify('+1 day');
}
?>