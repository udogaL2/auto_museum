<?php

namespace App\Model;

class ImageModel
{
	public function __construct
	(
		private int $id,
		private string $title,
		private string $originalTitle,
		private string $path,
		private int $height,
		private int $width,
		private string $extension
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

	public function getOriginalTitle(): string
	{
		return $this->originalTitle;
	}

	public function setOriginalTitle(string $originalTitle): void
	{
		$this->originalTitle = $originalTitle;
	}

	public function getPath(): string
	{
		return $this->path;
	}

	public function setPath(string $path): void
	{
		$this->path = $path;
	}

	public function getHeight(): int
	{
		return $this->height;
	}

	public function setHeight(int $height): void
	{
		$this->height = $height;
	}

	public function getWidth(): int
	{
		return $this->width;
	}

	public function setWidth(int $width): void
	{
		$this->width = $width;
	}

	public function getExtension(): string
	{
		return $this->extension;
	}

	public function setExtension(string $extension): void
	{
		$this->extension = $extension;
	}
}