<?php
/**
 * @var array $params
 * @var CarModel $car
 * @var FamousHumanModel $famousHuman
 * @var MuseumEntryModel $museumEntry
 */

use App\Model\CarModel;
use App\Model\FamousHumanModel;
use App\Model\MuseumEntryModel;

$car = $params['selectedCar'];

$additionalInfo = $car->getAdditionalInfo();

?>

<div class="details-wrapper">
	<div class="details-header">
		<div class="details-title">
			<div class="details-name"><?= $car->getTitle() ?></div>
		</div>
	</div>
	<div class="details-content">
		<img src="<?= $car->getPath() ?>" class="details-img" alt="">
		<div class="details-specification">
			<div class="about-details">Об автомобиле</div>
			<div class="details-characteristics">
				<ul>
					<li>
						<div class="details-characteristics-header">Год производства:</div>
						<div class="details-characteristics-value"><?= $car->getReleaseYear() ?></div>
					</li>
					<li>
						<div class="details-characteristics-header">Бренд:</div>
						<div class="details-characteristics-value"><?= $car->getBrandTitle() ?></div>
					</li>
					<li>
						<div class="details-characteristics-header">Тип кузова:</div>
						<div class="details-characteristics-value"><?= $car->getBodyTitle() ?></div>
					</li>
					<li>
						<div class="details-characteristics-header">Тип автомобиля:</div>
						<div class="details-characteristics-value"><?= $car->getTypeTitle() ?></div>
					</li>
					<li>
						<div class="details-characteristics-header">Название завода:</div>
						<div class="details-characteristics-value"><?= $car->getFactoryTitle() ?></div>
					</li>
					<li>
						<div class="details-characteristics-header">Страна производства:</div>
						<div class="details-characteristics-value"><?= $car->getCountry() ?></div>
					</li>
					<li>
						<div class="details-characteristics-header">Процент первоначальных деталей:</div>
						<div class="details-characteristics-value"><?= $car->getPartsPercent() ?>%</div>
					</li>
					<li>
						<div class="details-characteristics-header">Объем двигателя:</div>
						<div class="details-characteristics-value"><?= $car->getEngineCapacity() ?> л</div>
					</li>
					<li>
						<div class="details-characteristics-header">Количество аналогов</div>
						<div class="details-characteristics-value"><?= $car->getAnaloguesNumber() ?></div>
					</li>
					<?php
						if ($additionalInfo['famousHuman'])
						{
							$famousHuman = $additionalInfo['famousHuman'];

							echo "
								<li>
									<div class=\"details-characteristics-header\">Владелец автомобиля:</div>
									<div class=\"details-characteristics-value\">{$famousHuman->getName()} {$famousHuman->getSurname()}</div>
								</li>
							";
						}
						if ($additionalInfo['museumEntry'])
						{
							$museumEntry = $additionalInfo['museumEntry'];

							echo "
									<li>
										<div class=\"details-characteristics-header\">Музей:</div>
										<div class=\"details-characteristics-value\"><a href='/museum.php?id={$museumEntry->getMuseumId()}'>{$museumEntry->getMuseumTitle()}</a>: позиция №{$museumEntry->getRoomNumber()}</div>
									</li>
								";
						}
					?>
				</ul>
			</div>
			<div class="details-description">
				<div class="details-description-header">Описание</div>
				<div class="details-description-text"><?= $car->getDescription() ?></div>
			</div>
		</div>
	</div>
</div>
