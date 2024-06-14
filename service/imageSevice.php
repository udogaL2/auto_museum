<?php

use App\Model\ImageModel;

function prepareImageInfo(array $params): ImageModel
{
	return new ImageModel (
		(int)$params['id'],
		htmlspecialcharsbx($params['title']),
		htmlspecialcharsbx($params['originalTitle']),
		htmlspecialcharsbx($params['path']),
		(int)($params['height']),
		(int)($params['width']),
		htmlspecialcharsbx($params['extension'])
	);
}