<?php

namespace App\Service\DataMapper;

use App\Model\MuseumEntryModel;
use App\Model\MuseumModel;
use App\Service\DBSession;

class MuseumMapper
{
	public static function getById(int $id): MuseumModel|false
	{
		$dbQquery = "
			select m.id as `id`, m.title as `title`, m.description as `description`, c.title `country`, i.path as `path`
			from museum m
				inner join country c on m.country_id = c.id
				left join image i on m.image_id = i.id
			where m.id = ?
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

		if (isset($row['id']))
		{
			return prepareMuseumInfo($row, true);
		}

		return false;
	}

	public static function getEntryListByMuseumId(int $id, int $limit = 20, int $offset = 0): array
	{
		$dbQquery = "
			select me.car_id as `carId`, cc.title as `carTitle`, me.museum_id as `museumId`, me.entry_year as `year`, me.room_number as `roomNumber`, i.path as `path`
			from museum_entry me
				inner join car c on me.car_id = c.id
				inner join car_configuration cc on c.configuration_id = cc.id
				left join image i on me.image_id = i.id
			where me.museum_id = ?
			order by me.museum_id
			limit {$limit} offset {$offset};
		";
		$rowTypes = 'i';
		$vars = [$id];

		$dbRes = DBSession::requestDB(
			$dbQquery,
			$rowTypes,
			$vars,
		);

		$entryList = [];

		while ($row = mysqli_fetch_assoc($dbRes))
		{
			$entryList[] =  new MuseumEntryModel(
				$row['carId'],
				htmlspecialcharsbx($row['carTitle']),
				$row['museumId'],
				$row['year'],
				$row['roomNumber'],
				$row['path'],
			);
		}

		return $entryList;
	}

	public static function getEntryByCarId(int $id): MuseumEntryModel|false
	{
		$dbQquery = "
				select me.car_id as `carId`, cc.title as `carTitle`, me.museum_id as `museumId`, me.entry_year as `year`, me.room_number as `roomNumber`, i.path as `path`, m.title as `title`
				from museum_entry me
					inner join car c on me.car_id = c.id
					inner join car_configuration cc on c.configuration_id = cc.id
					inner join museum m on me.museum_id = m.id
					left join image i on me.image_id = i.id
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

		if (isset($row['carId']))
		{
			$model = new MuseumEntryModel(
				$row['carId'],
				htmlspecialcharsbx($row['carTitle']),
				$row['museumId'],
				$row['year'],
				$row['roomNumber'],
				$row['path'],
			);
			$model->setMuseumTitle(htmlspecialcharsbx($row['title']));

			return $model;
		}

		return false;
	}

	public static function list(int $limit = 20, int $offset = 0, string $searchQuery = ''): array
	{
		$dbQquery = "
			select m.id as `id`, m.title as `title`, m.description as `description`, c.title `country`, i.path as `path`
			from museum m
				inner join country c on m.country_id = c.id
				left join image i on m.image_id = i.id
			where 1 = 1
		";
		$rowTypes = '';
		$vars = [];

		if ($searchQuery)
		{
			$dbQquery .= " and (LOWER(m.title) like ? or m.title sounds like ?)";
			$rowTypes .= "ss";
			$vars = array_merge($vars, ['%' . strtolower($searchQuery) . '%', strtolower($searchQuery)]);
		}

		$dbQquery .= " 
			order by m.id
			limit {$limit} offset {$offset};
		";

		$dbRes = DBSession::requestDB(
			$dbQquery,
			$rowTypes,
			$vars,
		);

		$museumList = [];

		while ($row = mysqli_fetch_assoc($dbRes))
		{
			$museumList[] =  prepareMuseumInfo($row);
		}

		return $museumList;
	}

	public static function count(string $searchQuery = ''): int
	{
		$dbQquery = "
			select count(*) as `count`
			from museum m
			where 1 = 1
		";
		$rowTypes = '';
		$vars = [];

		if ($searchQuery)
		{
			$dbQquery .= " and (LOWER(m.title) like ? or m.title sounds like ?)";
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

	public static function entryCount(int $id): int
	{
		$dbQquery = "
				select count(*)
				from museum_entry me
					inner join museum m on me.museum_id = m.id
				where m.id = ?;
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
