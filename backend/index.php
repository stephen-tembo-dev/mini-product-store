<?php

require_once __DIR__.'./vendor/autoload.php';
require_once './router.php';
include './cors.php';

use app\database\DB;
use app\controllers\baseController;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {

    $db = DB::getInstance()->getDB();

    $baseController = new baseController($db);

    session_start();

} catch(\Exception $e){
    echo "something went wrong";
}







