<?php

use App\Controller\homeController;

require_once __DIR__ . "/../boot.php";

$homeController = new homeController();

echo $homeController->execute();
