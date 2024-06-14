<?php

use App\Controller\MuseumDetailController;

require_once __DIR__ . "/../boot.php";

$museumController = new MuseumDetailController();

echo $museumController->execute();

