<?php
/**
 * @var array $params
 * @var MuseumModel $museum
 * @var FamousHumanModel $famousHuman
 * @var MuseumEntryModel $museumEntry
 */

use App\Model\FamousHumanModel;
use App\Model\MuseumEntryModel;
use App\Model\MuseumModel;

$museum = $params['selectedMuseum'];

$additionalInfo = $museum->getEntryList();

?>

<div class="details-wrapper">
	<div class="details-header">
		<div class="details-title">
			<div class="details-name"><?= $museum->getTitle() ?></div>
		</div>
	</div>
	<div class="details-content">
		<img src="<?= $museum->getPath() ?>" class="details-img" alt="">
		<div class="details-specification">
			<div class="about-details">О музее</div>
			<div class="details-characteristics">
				<ul>
					<li>
						<div class="details-characteristics-header">Страна:</div>
						<div class="details-characteristics-value"><?= $museum->getCountry() ?></div>
					</li>
					<?php
					foreach ($additionalInfo as $museumEntry)
					{
						echo "
							<li>
								<div class=\"details-characteristics-header\">Поступление №{$museumEntry->getRoomNumber()}</div>
								<div class=\"details-characteristics-value\"><a href='/car.php?id={$museumEntry->getCarId()}'>{$museumEntry->getCarTitle()}</a></div>
							</li>
						";
					}
					?>
				</ul>
			</div>
			<div class="details-description">
				<div class="details-description-header">Описание</div>
				<div class="details-description-text"><?= $museum->getDescription() ?></div>
			</div>
		</div>
	</div>
</div>
