<?php

session_start();
spl_autoload_register();
error_reporting(0);
$template = new \Core\Template();
$dataBinder = new \Core\DataBinder();
$dbInfo = parse_ini_file("Config/db.ini");
$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);
$db = new \Database\PDODatabase($pdo);


$userRepository = new \App\Repository\UserRepository($db, $dataBinder);

$floorRepository = new \App\Repository\FloorRepository($db, $dataBinder);

$cabinetRepository = new \App\Repository\CabinetRepository($db, $dataBinder);

$workerRepository = new \App\Repository\WorkerRepository($db, $dataBinder);

$encryptionService = new \App\Service\Encryption\ArgonEncryptionService();

$userService = new \App\Service\User\UserService($userRepository, $encryptionService);

$floorService = new \App\Service\Floor\FloorService($floorRepository);

$cabinetService = new \App\Service\Cabinet\CabinetService($cabinetRepository);

$workerService = new \App\Service\Worker\WorkerService($workerRepository);



$userController = new \App\Controller\UserController($template, $dataBinder, $userService);

$dashboardController = new \App\Controller\DashboardController
(
    $template, $dataBinder, $userService,$floorService,$cabinetService,$workerService
);