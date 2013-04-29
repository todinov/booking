<?php

$days = array(
	'Monday',
	'Tuesday',
	'Wednesday',
	'Thursday',
	'Friday',
	'Saturday'
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

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en">
<head>
<title>test page</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<style type="text/css">

body {
	font-family: Arial, Tahoma, sans-serif;
	font-size: 13px;
	line-height: 2;
}

#wrapper {
	background-color: #FFF;
	width: 960px;
	margin: 0 auto;
	border: 1px solid #EEE;
}

#content {
	margin: 10px;
}

#days th {
	font-size:11px;
	text-align: center;
	color: #666;
}
#days td {
	width: 30px;
}
.book {
	border-left: 1px solid #CCC;
	border-bottom: 1px solid #EEE;
	text-align: center;
}
.bookbox {
	display: none;
}
</style>
<script>
$(document).ready(function(){
	function selections() {
		var selections = [];

		$('.bookbox:checked').each(function(){
			var day = $(this).attr('data-day');
			/*if (typeof selections[day] == 'undefined') {
				selections[day] = [];
			}*/
			var time = $(this).attr('data-time');
			selections[day] = time;
		});

		console.log(selections);

		$('#selections .list').empty().append('');
	}

	$('.book').click(function(){
		//console.log($(this).find('.bookbox').val());
		var checkbox = $(this).find('.bookbox');
		checkbox.prop('checked', !checkbox.is(':checked'));
		checkbox.change();
	});

	$('.bookbox').change(function(){
		selections();
	});
});
</script>
</head>
<body>
	<div id="wrapper">
		<div id="content">
			<span>Hello, Burning Fighting Fighter!</span>
			<div style="float:right">It is <?php echo date('H:i \o\n d.m.Y');?></div>

			<div>
				Room
				<select name="room">
					<option value="1">Conference Big 5 floor</option>
					<option value="2">Conference Room 3 floor</option>
					<option value="3">Conference Small 5 floor</option>
				</select>
			</div>

			<div>
				<table id="days" cellspacing="0">
					<tr>
						<th></th>
						<th colspan="2">08:00</th>
						<th colspan="2">09:00</th>
						<th colspan="2">10:00</th>
						<th colspan="2">11:00</th>
						<th colspan="2">12:00</th>
						<th colspan="2">13:00</th>
						<th colspan="2">14:00</th>
						<th colspan="2">15:00</th>
						<th colspan="2">16:00</th>
						<th colspan="2">17:00</th>
						<th colspan="2">18:00</th>
						<th colspan="2">19:00</th>
						<th colspan="2">20:00</th>
						<th colspan="2">21:00</th>
					</tr>
					<?php foreach ($days as $day):?>
						<tr>
							<td class="day"><?php echo $day;?></td>
							<td></td>
							<?php foreach ($hours as $i):?>
								<td class="book"><input type="checkbox" class="bookbox" data-day="<?php echo $day;?>" data-time="<?php echo $i;?>" name="Book[<?php echo $day;?>][<?php echo $i;?>]"/></td>
							<?php endforeach;?>
							<td class="book"></td>
						</tr>
					<?php endforeach;?>
					<tr>
						<th></th>
						<th colspan="2">08:00</th>
						<th colspan="2">09:00</th>
						<th colspan="2">10:00</th>
						<th colspan="2">11:00</th>
						<th colspan="2">12:00</th>
						<th colspan="2">13:00</th>
						<th colspan="2">14:00</th>
						<th colspan="2">15:00</th>
						<th colspan="2">16:00</th>
						<th colspan="2">17:00</th>
						<th colspan="2">18:00</th>
						<th colspan="2">19:00</th>
						<th colspan="2">20:00</th>
						<th colspan="2">21:00</th>
					</tr>
				</table>
			</div>

			<div id="selections">
				Your selections: <div class="list">asdf</div>
			</div>
		</div>
	</div>
</body>
</html>