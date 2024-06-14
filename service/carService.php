<?php

use App\Model\CarModel;
use App\Service\DataMapper\CarMapper;
use App\Service\DataMapper\FamousPeopleMapper;
use App\Service\DataMapper\ImageMapper;
use App\Service\DataMapper\MuseumMapper;

function prepareCarInfo(array $params, bool $withAdditionalInfo = false): CarModel
{
	$params['analoguesNumber'] ??= CarMapper::getAnaloguesNumberByConfigurationId($params['configurationId']);
	$params['path'] ??= ImageMapper::getById(1)->getPath();

	$model =  new CarModel
	(
		(int)$params['id'],
		$params['path'],
		(int)$params['releaseYear'],
		(float)$params['partsPercent'],
		htmlspecialcharsbx(cutTitle($params['title'])),
		htmlspecialcharsbx($params['country']),
		htmlspecialcharsbx($params['description']),
		(float)($params['engineCapacity']),
		$params['analoguesNumber'],
		htmlspecialcharsbx($params['bodyTitle']),
		htmlspecialcharsbx($params['typeTitle']),
		htmlspecialcharsbx($params['brandTitle']),
		htmlspecialcharsbx($params['factoryTitle']),
	);

	if ($withAdditionalInfo)
	{
		$additionalInfo = [];
		$additionalInfo['famousHuman'] = FamousPeopleMapper::getByCarId($params['id']);
		if ($additionalInfo['famousHuman'])
		{
			$additionalInfo['famousHuman']->setName(htmlspecialcharsbx($additionalInfo['famousHuman']->getName()));
			$additionalInfo['famousHuman']->setSurname(htmlspecialcharsbx($additionalInfo['famousHuman']->getSurname()));
		}
		$additionalInfo['museumEntry'] = MuseumMapper::getEntryByCarId($params['id']);
		if ($additionalInfo['museumEntry'])
		{
			$additionalInfo['museumEntry']->setMuseumTitle(htmlspecialcharsbx($additionalInfo['museumEntry']->getMuseumTitle()));
		}

		$model->setAdditionalInfo($additionalInfo);
	}

	return $model;
}
