<?php
/**
 * @var array $params
 */

$currentPage = $params['page'];
$countOnPage = $params['countOnPage'];
$totalPages = $params['pageCount'];
$searchQuery = $params['searchQuery'];

$firstPageSearchQuery = createSearchRequest(1, $searchQuery);
$endPageSearchQuery = createSearchRequest($totalPages, $searchQuery);

$startPage = max(1, $currentPage - 2);
$endPage = min($totalPages, $currentPage + 2);

if ($endPage - $startPage + 1 < 5)
{
	if ($startPage == 1)
	{
		$endPage = min(5, $totalPages);
	}
	else
	{
		$startPage = max(1, $endPage - 4);
	}
}

?>
<div class="pagination">
	<?=
		($currentPage === 1)
			? '<span class="page-btn">&laquo;</span>'
			: "<a href=\"$firstPageSearchQuery\" class=\"page-btn\">&laquo;</a>"
	?>

	<?php
		for ($i = $startPage; $i <= $endPage; $i++)
		{
			$searchRequest = createSearchRequest($i, $searchQuery);
			echo "<a href=\"$searchRequest\" class=\"page-btn" . ($i === $currentPage ? " page-btn-selected\"" : "\"") . ">$i</a>";
		}
	?>

	<?=
		($currentPage === $totalPages)
			? '<span class="page-btn">&raquo;</span>'
			: "<a href=\"$endPageSearchQuery\" class=\"page-btn\">&raquo;</a>"
	?>
</div>