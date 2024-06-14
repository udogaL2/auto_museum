<?php
/**
 * @var array $params
 * @var string $selectedMenu
 * @var string $content
 */

$content = $params['content'] ?? '';
$selectedMenu = $params['selectedMenu'] ?? '';
$hideSearchBar = $params['hideSearchBar'] ?? false;
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?= option('TITLE')?></title>
	<link rel="stylesheet" href="/static/css/reset.css">
	<link rel="stylesheet" href="/static/css/style.css">
	<link rel="stylesheet" href="/static/css/pagination.css">
</head>
<body>
<div class="container">
	<div class="sidebar">
		<div class="logo-box">
			<a class="logo" href="/"><?= option('TITLE')?></a>
		</div>
		<ul class="side-menu">
			<li class="<?= $selectedMenu === "home" ? "side-menu-item side-menu-item-active" : "side-menu-item" ?>"><a href="/">Главная</a></li>
			<li class="<?= $selectedMenu === "museums" ? "side-menu-item side-menu-item-active" : "side-menu-item" ?>"><a href="/museums.php">Музеи</a></li>
			<li class="<?= $selectedMenu === "cars" ? "side-menu-item side-menu-item-active" : "side-menu-item" ?>"><a href="/cars.php">Автомобили</a></li>
		</ul>
	</div>
	<div class="wrapper">
		<div class="header">
			<div <?= $hideSearchBar ? "style=\"display: none\"" : ""?> class="search-bar">
				<form class="search-bar-form" method="get" action="">
					<input name="search_query" type="text" class="search-text" placeholder="Поиск по каталогу..." id="search-text">
					<button type="submit" class="search-btn">
						<img src="/static/ico/search.png" alt="" class="search-img">
					</button>
				</form>
			</div>
		</div>
		<div class="wrapper-decoration"></div>
		<div class="wrapper-content">
			<?= $content ?? ''?>
		</div>
	</div>
</div>
</body>
</html>