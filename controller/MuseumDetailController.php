<?php

namespace App\Controller;

use App\Service\DataMapper\MuseumMapper;

class MuseumDetailController extends BaseController
{
	protected int $currentId = 1;

	protected static string $viewPath = 'pages/museumDetail';

	protected function prepareParams(): void
	{
		$id = 1;

		if (isset($_GET["id"]) && is_numeric($_GET["id"]))
		{
			$id = (int)$_GET["id"];
			$id = $id > 0 ? $id : 1;
		}

		$this->currentId = $id;
	}

	protected function getParams(): array
	{
		return [
			'selectedMuseum' => MuseumMapper::getById($this->currentId),
		];
	}

	public function execute(): string
	{
		$this->prepareParams();
		$params = $this->getParams();

		if (!$params['selectedMuseum'])
		{
			return LayoutController::execute(
				[
					'params' => [
						'content' => 'error404',
						'selectedMenu' => 'null',
						'hideSearchBar' => true,
					],
				],
			);
		}

		$currentPage = static::view(['params' => $params]);

		return LayoutController::execute(
			[
				'params' => [
					'content' => $currentPage,
					'selectedMenu' => 'null',
					'hideSearchBar' => true,
				],
			],
		);
	}
}
