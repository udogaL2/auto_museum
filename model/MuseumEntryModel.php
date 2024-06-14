<?php

namespace App\Model;

class MuseumEntryModel
{
	private string $museumTitle = '';

	public function __construct
	(
		private int $carId,
		private string $carTitle,
		private int $museumId,
		private int $year,
		private int $roomNumber,
		private ?string $path
	)
	{}

	public function getCarTitle(): string
	{
		return $this->carTitle;
	}

	public function setCarTitle(string $carTitle): void
	{
		$this->carTitle = $carTitle;
	}

	public function getMuseumTitle(): string
	{
		return $this->museumTitle;
	}

	public function setMuseumTitle(string $museumTitle): void
	{
		$this->museumTitle = $museumTitle;
	}

	public function getCarId(): int
	{
		return $this->carId;
	}

	public function setCarId(int $carId): void
	{
		$this->carId = $carId;
	}

	public function getMuseumId(): int
	{
		return $this->museumId;
	}

	public function setMuseumId(int $museumId): void
	{
		$this->museumId = $museumId;
	}

	public function getYear(): int
	{
		return $this->year;
	}

	public function setYear(int $year): void
	{
		$this->year = $year;
	}

	public function getRoomNumber(): int
	{
		return $this->roomNumber;
	}

	public function setRoomNumber(int $roomNumber): void
	{
		$this->roomNumber = $roomNumber;
	}

	public function getPath(): ?string
	{
		return $this->path;
	}

	public function setPath(?string $path): void
	{
		$this->path = $path;
	}
}
