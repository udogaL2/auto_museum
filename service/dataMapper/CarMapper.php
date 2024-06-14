<?php

namespace App\Service\DataMapper;

use App\Service\DBSession;
use App\Model\CarModel;
use Exception;

class CarMapper
{
	/**
	 * @param int $limit
	 * @param int $offset
	 * @param string $searchQuery
	 * @return CarModel[]
	 * @throws Exception
	 */
	public static function list(int $limit = 20, int $offset = 0, string $searchQuery = ''): array
	{
		$dbQquery = "
			select
				c.id as `id`,
				i.path as `path`,
				c.release_year as `releaseYear`,
				c.original_parts_percent as `partsPercent`,
				cc.id as `configurationId`,
				cc.title as `title`,
       			cc.description as `description`,
				cc.engine_capacity as `engineCapacity`,
				cc.analogues_number as `analoguesNumber`,
				b.title as `bodyTitle`,
				ct.title as `typeTitle`,
				cb.title as `brandTitle`,
				f.title as `factoryTitle`,
				c2.title as `country`
			from car c
				inner join factory f on c.factory_id = f.id
				inner join country c2 on f.country_id = c2.id
				inner join car_configuration cc on c.configuration_id = cc.id
				left join image i on c.image_id = i.id
         		inner join car_brand cb on cc.brand_id = cb.id
				inner join car_type ct on cc.type_id = ct.id
         		inner join car_body b on cc.body_id = b.id
			where 1 = 1
		";
		$rowTypes = '';
		$vars = [];

		if ($searchQuery)
		{
			$dbQquery .= " and (LOWER(cc.title) like ? or cc.title sounds like ?)";
			$rowTypes .= "ss";
			$vars = array_merge($vars, ['%' . strtolower($searchQuery) . '%', strtolower($searchQuery)]);
		}

		$dbQquery .= " 
			order by c.id
			limit {$limit} offset {$offset};
		";

		$dbRes = DBSession::requestDB(
			$dbQquery,
			$rowTypes,
			$vars,
		);

		$carList = [];

		while ($row = mysqli_fetch_assoc($dbRes))
		{
			$carList[] =  prepareCarInfo($row);
		}

		return $carList;
	}

	public static function count(string $searchQuery = ''): int
	{
		$dbQquery = "
			select count(*) as `count`
			from car c
				inner join car_configuration cc on c.configuration_id = cc.id
			where 1 = 1
		";
		$rowTypes = '';
		$vars = [];

		if ($searchQuery)
		{
			$dbQquery .= " and (LOWER(cc.title) like ? or cc.title sounds like ?)";
			$rowTypes .= "ss";
			$vars = array_merge($vars, ['%' . strtolower($searchQuery) . '%', strtolower($searchQuery)]);
		}

		$dbRes = DBSession::requestDB(
			$dbQquery,
			$rowTypes,
			$vars,
		);

		return mysqli_fetch_assoc($dbRes)['count'];
	}

	public static function getById(int $id): CarModel|false
	{
		$dbQquery = "
			select
				c.id as `id`,
				i.path as `path`,
				c.release_year as `releaseYear`,
				c.original_parts_percent as `partsPercent`,
				cc.id as `configurationId`,
				cc.title as `title`,
       			cc.description as `description`,
				cc.engine_capacity as `engineCapacity`,
				cc.analogues_number as `analoguesNumber`,
				b.title as `bodyTitle`,
				ct.title as `typeTitle`,
				cb.title as `brandTitle`,
				f.title as `factoryTitle`,
				c2.title as `country`
			from car c
				inner join factory f on c.factory_id = f.id
				inner join country c2 on f.country_id = c2.id
				inner join car_configuration cc on c.configuration_id = cc.id
				left join image i on c.image_id = i.id
         		inner join car_brand cb on cc.brand_id = cb.id
				inner join car_type ct on cc.type_id = ct.id
         		inner join car_body b on cc.body_id = b.id
			where c.id = ?
		";
		$rowTypes = 'i';
		$vars = [$id];

		$dbRes = DBSession::requestDB(
			$dbQquery,
			$rowTypes,
			$vars,
		);

		$row = mysqli_fetch_assoc($dbRes);

		if (isset($row['id']))
		{
			return prepareCarInfo($row, true);
		}

		return false;
	}

	public static function getAnaloguesNumberByConfigurationId(int $id): int
	{
		$dbQquery = "
			select count(*) as `count`
			from car c
			where c.configuration_id = ?
		";
		$rowTypes = 'i';
		$vars = [$id];

		$dbRes = DBSession::requestDB(
			$dbQquery,
			$rowTypes,
			$vars,
		);

		return mysqli_fetch_assoc($dbRes)['count'];
	}
}