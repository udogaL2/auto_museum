<?php

namespace App\Controller;

use App\Service\DataMapper\CarMapper;

abstract class CardListController extends BaseController
{
	protected int $currentPage = 1;
	protected string $searchQuery = '';
	protected static string $viewPath = 'pages/carCardList';
	protected string $selectedMenu = '';

	protected function prepareParams(): void
	{
		$page = 1;

		if (isset($_GET["page"]) && is_numeric($_GET["page"]))
		{
			$page = (int)$_GET["page"];
			$page = $page > 0 ? $page : 1;
		}

		$this->currentPage = $page;

		$searchQuery = '';

		if (isset($_GET["search_query"]) && is_string($_GET["search_query"]))
		{
			$searchQuery = $_GET["search_query"];
		}

		$this->searchQuery = $searchQuery;
	}

	abstract protected function getParams(): array;

	public function execute(): string
	{
		$this->prepareParams();
		$params = $this->getParams();
		$currentPage = static::view(['params' => $params]);

		return LayoutController::execute(
			[
				'params' => [
					'content' => $currentPage,
					'selectedMenu' => $this->selectedMenu,
				],
			],
		);
	}
}
