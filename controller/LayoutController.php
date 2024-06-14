<?php

namespace App\Controller;

use Exception;

class LayoutController extends BaseController
{
	protected static string $viewPath = 'layout';

	/**
	 * @throws Exception
	 */
	public static function execute(array $params): string
	{
		static::$viewPath = 'layout';

		return static::view($params);
	}
}
