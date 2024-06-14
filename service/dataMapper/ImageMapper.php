<?php

namespace App\Service\DataMapper;

use App\Model\ImageModel;
use App\Service\DBSession;

class ImageMapper
{
	public static function getById(int $id): ImageModel|bool
	{
		$dbQquery = "
			select
			    id,
			    title,
			    original_title as `originalTitle`,
			    path,
			    height,
			    width,
			    extension
			from image i
			where i.id = ?
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
			return prepareImageInfo($row);
		}

		return false;
	}
}