<?php

use App\Controller\CarController;

require_once __DIR__ . "/../boot.php";

$carController = new CarController();

echo $carController->execute();