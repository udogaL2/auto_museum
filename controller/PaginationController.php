<?php

namespace App\Controller;

class PaginationController extends BaseController
{
	protected static string $viewPath = 'ui/pagination';

	private array $params = [];

	public function execute(): string
	{
		$this->prepareParams();
		$params = $this->params;

		return static::view(['params' => $params]);
	}

	public function setParams(array $params): void
	{
		if (
			isset($params['page'])
			&& isset($params['count'])
			&& isset($params['countOnPage'])
			&& isset($params['searchQuery'])
		)
		{
			$this->params = $params;
		}
	}

	private function prepareParams(): void
	{
		$this->params['page'] = (int)$this->params['page'] ?? 1;
		$this->params['count'] = (int)$this->params['count'] ?? 3;
		$this->params['countOnPage'] = (int)$this->params['countOnPage'] ?? 3;
		$this->params['pageCount'] = (int)($this->params['count'] / $this->params['countOnPage']) + ((($this->params['count'] % $this->params['countOnPage']) === 0) ? 0 : 1);
		$this->params['searchQuery'] = (string)$this->params['searchQuery'] ?? '';
	}
}
