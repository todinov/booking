<html>
<head>
<title>Booking</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>

<body>

<div id="bar">
	<div class="wrap">
		<div class="left">
			Today is <?php echo date('d M Y'); ?>. The time is <?php echo date('H:i'); ?>.
		</div>
		<div class="right">
			Hello, Burning Fighting Fighter | 
			<a href="#">Profile</a> | 
			<a href="#">Exit</a>
		</div>
	</div>
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
			<?php for ($h = 0; $h < count($hours); $h += 2): ?>
			<th class="hour" colspan="2"><?php echo $hours[$h]; ?></th>
			<?php endfor;?>
			<th></th>
		</tr>
		<?php foreach ($data as $k => $day): ?>
		<tr <?php echo ($k%2 ? 'class="even"':'');?>>
			<td class="day">
				<?php echo ($day['selected'] ? '<b>'.$day['label'].'</b>' : $day['label']); ?>
			</td>
			<td class="spacing"></td>
			<?php foreach ($day['periods'] as $key => $period): ?>
			<td class="time">
				<?php if ($period['booked']): ?>
					<input type="checkbox" value="<?php echo $period['time']; ?>" title="<?php echo $period['booked']['comment']; ?>" disabled="disabled" checked="checked"/>
				<?php else: ?>
					<input type="checkbox" name="period[]" value="<?php echo $period['time']; ?>"/>
				<?php endif; ?>
			</td>
			<?php endforeach; ?>
		</tr>
		<?php endforeach; ?>
		<tr>
			<th></th>
			<th></th>
			<?php for ($h = 1; $h < count($hours); $h += 2): ?>
			<th class="hour" colspan="2"><?php echo $hours[$h]; ?></th>
			<?php endfor;?>
		</tr>
	<table>

	Comment <input type="text" name="comment"/><input type="submit" value="Book"/>

	</form>
</div>

</body>
</html>