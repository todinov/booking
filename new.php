<?php

$time = getdate();

$weekdays = array(
	'Monday',
	'Tuesday',
	'Wednesday',
	'Thursday',
	'Friday',
	'Saturday',
	'Sunday',
);

echo 'Today is ' . $time['mday'].' '.$time['month'].' '.$time['year'].'. The time is '.$time['hours'].':'.$time['minutes'].'.';

echo '<table border=1>';
echo '<tr>';
echo '<td></td>';
for ($h = 8; $h <= 20; ++$h) {
	echo '<td>'.$h.'h</td>';
}
echo '</tr>';
foreach ($weekdays as $day) {
	echo '<tr>';
	if ($day == $time['weekday']) {
		echo '<td><b>'.$day.'</b></td>';
	}
	else {
		echo '<td>'.$day.'</td>';
	}
	for ($h = 8; $h <= 20; ++$h) {
		echo '<td><input type="checkbox" name="period"/></td>';
	}
	echo '</tr>';
}
echo '<table>';

echo '<input type="submit" value="Book"/>';