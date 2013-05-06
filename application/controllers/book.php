<?php

class Book extends Controller {
	public function index()
	{
		$interval = 30;
		$daylength = 60*60*24;
		$time = time();

		$weekstart = $time - $daylength*date('w', $time);
		$weekend = $weekstart + 6*$daylength;

		$weekdays = array();
		for ($d = $weekstart; $d <= $weekend; $d += $daylength)
		{
			$weekdays[date('Y-m-d', $d)] = date('D', $d);
		}

		$hours = array();
		for ($i = 8; $i < 21; ++$i)
		{
			for ($j = 0; $j < 60; $j += $interval)
			{
				$t = sprintf('%02d', $i).':'.sprintf('%02d', $j);
				$hours[$t.':00'] = $t;
			}
		}

		$model = $this->model('booked');
		$booked = $model->getByRange(date('Y-m-d 00:00:00', $weekstart), date('Y-m-d 23:59:59', $weekend));

		$data = array();
		foreach ($weekdays as $date => $day) 
		{
			$data[$date] = array(
				'label'    => $day,
				'date'     => $date,
				'selected' => false,
				'periods'  => array()
			);
			foreach ($hours as $value => $name)
			{
				$t = $date . ' ' . $value;
				$data[$date]['periods'][] = array(
					'label'  => $name,
					'time'   => $t,
					'booked' => isset($booked[$t])?$booked[$t]:false,
				);
			}
		}

		$this->assign('hours', array_values($hours));
		$this->assign('data', array_values($data));
		$this->view('booking');
	}

	public function save()
	{
		$model = $this->model('booked');
		$model->save();
		redirect('book');
	}
}