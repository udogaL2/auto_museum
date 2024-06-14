<?php

use App\Controller\CarDetailController;

require_once __DIR__ . "/../boot.php";

$carDetailController = new CarDetailController();

echo $carDetailController->execute();

