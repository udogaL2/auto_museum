<?php

namespace App\Controller;

use App\Service\DataMapper\CarMapper;

class CarController extends CardListController
{
	protected static string $viewPath = 'pages/carCardList';

	protected string $selectedMenu = 'cars';

	protected function getParams(): array
	{
		$pageController = new PaginationController();
		$pageController->setParams([
			'page' => $this->currentPage,
			'countOnPage' =>option('CARDS_ON_PAGE'),
			'count' => CarMapper::count($this->searchQuery),
			'searchQuery' => $this->searchQuery,
		]);

		return [
			'selectedCards' => CarMapper::list(option('CARDS_ON_PAGE'), getOffsetByPage($this->currentPage), $this->searchQuery),
			'pagination' => $pageController->execute(),
		];
	}
}
