<?php

function cutTitle($title, $length = 35): string
{
	if (mb_strlen($title) < $length)
	{
		return $title;
	}

	return mb_substr($title, 0, $length - 3) . '...';
}

function cutDescription($title): string
{
	if (mb_strlen($title) < 265)
	{
		return $title;
	}

	return mb_substr($title, 0, 266) . '...';
}

function htmlspecialcharsbx(string $value): string
{
	return htmlspecialchars($value, ENT_QUOTES);
}

function getOffsetByPage(int $page): int
{
	return ($page - 1) * option('CARDS_ON_PAGE');
}

function createSearchRequest(int $page = null, string $searchSubstr = ''): string
{
	if (isset($page) && $searchSubstr)
	{
		return "?page={$page}" . "&search_query={$searchSubstr}";
	}
	elseif (isset($page))
	{
		return "?page={$page}";
	}
	elseif ($searchSubstr)
	{
		return "?search_query={$searchSubstr}";
	}

	return '';
}
