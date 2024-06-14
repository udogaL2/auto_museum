<?php

namespace App\Controller;

class homeController extends BaseController
{
	protected static string $viewPath = 'pages/home';

	public function execute(): string
	{
		$currentPage = static::view();

		return LayoutController::execute(
			[
				'params' => [
					'content' => $currentPage,
					'selectedMenu' => 'home',
					'hideSearchBar' => true,
				],
			],
		);
	}
}
