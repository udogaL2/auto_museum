<?php

namespace App\Service\DataMapper;

use App\Model\FamousHumanModel;
use App\Service\DBSession;

class FamousPeopleMapper
{
	public static function getByCarId(int $id): FamousHumanModel|false
	{
		$dbQquery = "
				select c.id as `car_id`, fp.id as `human_id`, fp.name as `name`, fp.surname as `surname`, i.path as `path`
				from car_fpeople
					inner join car c on car_fpeople.car_id = c.id
					inner join famous_people fp on car_fpeople.human_id = fp.id
					left join image i on fp.image_id = i.id
				where c.id = ?
				limit 1;
		";
		$rowTypes = 'i';
		$vars = [$id];

		$dbRes = DBSession::requestDB(
			$dbQquery,
			$rowTypes,
			$vars,
		);

		$row = mysqli_fetch_assoc($dbRes);

		if (isset($row['human_id']))
		{
			return new FamousHumanModel(
				$row['human_id'],
				$row['name'],
				$row['surname'],
				$row['path'],
			);
		}

		return false;
	}
}