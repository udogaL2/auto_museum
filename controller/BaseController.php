<?php

namespace App\Controller;

use Exception;

abstract class BaseController
{
	protected static string $viewPath;

	protected static function view(array $params = []): string
	{
		if (!preg_match('/^[0-9A-Za-z\/_-]+$/', static::$viewPath))
		{
			throw new Exception('Invalid template path');
		}

		$viewPath = static::$viewPath;
		$path = "../views/{$viewPath}.php";

		if (!file_exists($path))
		{
			throw new Exception('Template not found');
		}

		extract($params);

		ob_start();

		require $path;

		return ob_get_clean();
	}
}
