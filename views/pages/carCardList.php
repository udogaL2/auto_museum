<?php
/**
 * @var array $params
 * @var \App\Model\CarModel $card
 */

$selectedCards = $params['selectedCards'] ?? [];
$pagination = $params['pagination'] ?? '';

?>
<div class="card-list">
	<?php
	foreach ($selectedCards as $card): ?>
		<div class="card">
			<div class="card-overlay">
				<a href="/car.php?id=<?= $card->getId() ?>" class="film-card-read-more">подробнее</a>
			</div>
			<div class="card-img-box">
				<img src="<?= $card->getPath() ?>" alt="" class="card-img">
			</div>
			<div class="card-wrapper">
				<div class="card-header">
					<div class="card-title"><?= $card->getTitle() ?> (<?= $card->getReleaseYear() ?>)</div>
				</div>
				<div class="card-footer">
					<div class="card-country"><?= $card->getCountry() ?></div>
					<div class="card-parts-percent">% первоначальных деталей: <?= $card->getPartsPercent() ?>%</div>
				</div>
			</div>
		</div>
	<?php
	endforeach; ?>
</div>
<?= $pagination ?>