<?php

namespace App\Model;

class CarModel
{
	private array $additionalInfo = [];

	public function __construct
	(
		private int $id,
		private ?string $path,
		private int $releaseYear,
		private float $partsPercent,
		private string $title,
		private string $country,
		private string $description,
		private float $engineCapacity,
		private ?int $analoguesNumber,
		private string $bodyTitle,
		private string $typeTitle,
		private string $brandTitle,
		private string $factoryTitle,
	)
	{}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function setDescription(string $description): void
	{
		$this->description = $description;
	}

	public function getEngineCapacity(): float
	{
		return $this->engineCapacity;
	}

	public function setEngineCapacity(float $engineCapacity): void
	{
		$this->engineCapacity = $engineCapacity;
	}

	public function getAnaloguesNumber(): ?int
	{
		return $this->analoguesNumber;
	}

	public function setAnaloguesNumber(?int $analoguesNumber): void
	{
		$this->analoguesNumber = $analoguesNumber;
	}

	public function getBodyTitle(): string
	{
		return $this->bodyTitle;
	}

	public function setBodyTitle(string $bodyTitle): void
	{
		$this->bodyTitle = $bodyTitle;
	}

	public function getTypeTitle(): string
	{
		return $this->typeTitle;
	}

	public function setTypeTitle(string $typeTitle): void
	{
		$this->typeTitle = $typeTitle;
	}

	public function getBrandTitle(): string
	{
		return $this->brandTitle;
	}

	public function setBrandTitle(string $brandTitle): void
	{
		$this->brandTitle = $brandTitle;
	}

	public function getFactoryTitle(): string
	{
		return $this->factoryTitle;
	}

	public function setFactoryTitle(string $factoryTitle): void
	{
		$this->factoryTitle = $factoryTitle;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function getPath(): string
	{
		return $this->path;
	}

	public function setPath(string $path): void
	{
		$this->path = $path;
	}

	public function getReleaseYear(): int
	{
		return $this->releaseYear;
	}

	public function setReleaseYear(int $releaseYear): void
	{
		$this->releaseYear = $releaseYear;
	}

	public function getPartsPercent(): float
	{
		return $this->partsPercent;
	}

	public function setPartsPercent(float $partsPercent): void
	{
		$this->partsPercent = $partsPercent;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function setTitle(string $title): void
	{
		$this->title = $title;
	}

	public function getCountry(): string
	{
		return $this->country;
	}

	public function setCountry(string $country): void
	{
		$this->country = $country;
	}

	public function getAdditionalInfo(): array
	{
		return $this->additionalInfo;
	}

	public function setAdditionalInfo(array $additionalInfo): void
	{
		$this->additionalInfo = $additionalInfo;
	}
}