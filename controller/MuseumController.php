<?php

namespace App\Controller;

use App\Service\DataMapper\CarMapper;
use App\Service\DataMapper\MuseumMapper;

class MuseumController extends CardListController
{
	protected static string $viewPath = 'pages/museumCardList';

	protected string $selectedMenu = 'museums';

	protected function getParams(): array
	{
		$pageController = new PaginationController();
		$pageController->setParams([
			'page' => $this->currentPage,
			'countOnPage' =>option('CARDS_ON_PAGE'),
			'count' => MuseumMapper::count($this->searchQuery),
			'searchQuery' => $this->searchQuery,
		]);

		return [
			'selectedCards' => MuseumMapper::list(option('CARDS_ON_PAGE'), getOffsetByPage($this->currentPage), $this->searchQuery),
			'pagination' => $pageController->execute(),
		];
	}
}
