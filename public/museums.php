<?php

use App\Controller\MuseumController;

require_once __DIR__ . "/../boot.php";

$museumController = new MuseumController();

echo $museumController->execute();