<?php

namespace App\Model;

class MuseumModel
{
	private ?array $entryList = [];
	public function __construct
	(
		private int $id,
		private string $title,
		private string $description,
		private string $country,
		private ?string $path,
	)
	{}

	public function getId(): int
	{
		return $this->id;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function setTitle(string $title): void
	{
		$this->title = $title;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function setDescription(string $description): void
	{
		$this->description = $description;
	}

	public function getCountry(): string
	{
		return $this->country;
	}

	public function setCountry(string $country): void
	{
		$this->country = $country;
	}

	public function getPath(): ?string
	{
		return $this->path;
	}

	public function setPath(?string $path): void
	{
		$this->path = $path;
	}

	public function getEntryList(): array
	{
		return $this->entryList;
	}

	public function setEntryList(array $entryList): void
	{
		$this->entryList = $entryList;
	}
}
