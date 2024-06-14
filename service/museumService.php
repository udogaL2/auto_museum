<?php

use App\Model\MuseumModel;
use App\Service\DataMapper\ImageMapper;
use App\Service\DataMapper\MuseumMapper;

function prepareMuseumInfo(array $params, bool $withAdditionalInfo = false): MuseumModel
{
	$params['path'] ??= ImageMapper::getById(1)->getPath();

	$model = new MuseumModel
	(
		(int)$params['id'],
		htmlspecialcharsbx(cutTitle($params['title'])),
		htmlspecialcharsbx($params['description']),
		htmlspecialcharsbx($params['country']),
		$params['path'],
	);

	if ($withAdditionalInfo)
	{
		$model->setEntryList(MuseumMapper::getEntryListByMuseumId($params['id']));
	}

	return $model;
}
