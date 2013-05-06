<html>
<head>
<title>Booking</title>

<style>
body {
	font-family: Tahoma;
	font-size: 13px;
	margin: 0;
	padding: 0;
	color: #333;
}
#bar {
	background-color: #EEE;
	padding: 5px;
}
#main {
	margin: 20px auto 0 auto;
	width: 960px;
}
table.week {
	border-collapse: collapse;
}
table.week td, table.week th {
	padding: 5px 2px;
	color: #333;
}

table.week tr.even {
	background: #F6F6F6;
}

table.week th.hour {
	font-size: 10px;
	text-align: center;
	border-left: 1px solid #EEE;
	border-right: 1px solid #EEE;
}
table.week td.day {
	font-size: 11px;
	font-weight: bold;
	text-align: right;
	padding: 0 15px;
}
table.week td.time {
	text-align: center;
	border-left: 1px solid #EEE;
	border-right: 1px solid #EEE;
}
input[type="submit"] {
	background: #555;
	border: 0;
	padding: 3px 10px;
	color: #FFF;
}
</style>

</head>

<body>

<div id="bar">
	<?php echo 'Today is ' . $time['mday'].' '.$time['month'].' '.$time['year'].'. The time is '.$time['hours'].':'.$time['minutes'].'.'; ?>
</div>

<div id="main">
	<form action="room">
	Room
	<select name="room">
		<option>Nature</option>
		<option>Paradise</option>
		<option>Urban</option>
	</select>
	<input type="submit" value="Change"/>
	</form>

	<form method="post" action="book/save">

	<table class="week">
		<tr>
			<th></th>
			<?php foreach ($hours as $h): ?>
			<th class="hour"><?php echo $h; ?></th>
			<?php endforeach;?>
		</tr>
		<?php foreach ($weekdays as $date => $day): ?>
		<tr <?php echo (in_array($day, array('Mon', 'Wed', 'Fri')) ? 'class="even"':'');?>>
			<?php
			if ($day == $time['weekday']) {
				echo '<td class="day"><b>'.$day.'</b></td>';
			}
			else {
				echo '<td class="day">'.$day.'</td>';
			}
			foreach ($hours as $time => $h) {
				echo '<td class="time"><input type="checkbox" name="period[]" value="'.$date.' '.$time.'"/></td>';
			}
			?>
		</tr>
		<?php endforeach; ?>
		<tr>
			<th></th>
			<?php foreach ($hours as $h): ?>
			<th class="hour"><?php echo $h; ?></th>
			<?php endforeach;?>
		</tr>
	<table>

	Comment <input type="text" name="comment"/><input type="submit" value="Book"/>

	</form>
</div>

</body>
</html>