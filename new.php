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

$hours = array(
	'08:00',
	'08:30',
	'09:00',
	'09:30',
	'10:00',
	'10:30',
	'11:00',
	'11:30',
	'12:00',
	'12:30',
	'13:00',
	'13:30',
	'14:00',
	'14:30',
	'15:00',
	'15:30',
	'16:00',
	'16:30',
	'17:00',
	'17:30',
	'18:00',
	'18:30',
	'19:00',
	'19:30',
	'20:00',
	'20:30',
);

echo 'Today is ' . $time['mday'].' '.$time['month'].' '.$time['year'].'. The time is '.$time['hours'].':'.$time['minutes'].'.';
?>

<br/><br/>
Room
<select name="room">
	<option>Nature</option>
	<option>Paradise</option>
	<option>Urban</option>
</select>
<br/><br/>
<?php
echo '<table>';
echo '<tr>';
echo '<td></td>';
foreach ($hours as $h) {
	echo '<td>'.$h.'</td>';
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
	foreach ($hours as $h) {
		echo '<td><input type="checkbox" name="period"/></td>';
	}
	echo '</tr>';
}
echo '<table>';
?>
Comment <input type="text" name="comment"/>
<input type="submit" value="Book"/>