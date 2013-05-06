<?php

class Booked extends Model {
	public function getByRange($from, $to)
	{
		$stmt = $this->db->prepare('SELECT time, user, comment FROM booked WHERE time >= :start AND time <= :end');
		$stmt->bindParam(':start', $from);
		$stmt->bindParam(':end', $to);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$ret = array();
		foreach ($data as $v)
		{
			$ret[$v['time']] = $v;
		}
		return $ret;
	}

	public function save ()
	{
		$stmt = $this->db->prepare('INSERT INTO booked (room, time, user, comment) VALUES (:room, :time, :user, :comment)');
		if (!empty($_POST['period']))
		{
			foreach ($_POST['period'] as $time)
			{
				$stmt->bindValue(':room', 1);
				$stmt->bindValue(':time', $time);
				$stmt->bindValue(':user', 1);
				$stmt->bindValue(':comment', 'No comment');
				$stmt->execute();
			}
		}
	}
}