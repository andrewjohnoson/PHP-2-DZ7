<?php

require __DIR__ . '/App/autoload.php';

session_start();
$_SESSION['login'] = 'admin';

try {
    $ctrl = isset($_GET['ctrl']) ? ucfirst($_GET['ctrl']) : 'Index';
    $class = '\App\Controllers\\' . $ctrl;
    $ctrl = new $class;
    $ctrl();
} catch (\App\Exceptions\DbException $error) {
    echo 'Ошибка в БД: ' . $error->message();
    $log = new \App\Logger();
    $log->error($error, []);
    die;
} catch (\App\Exceptions\Error404 $error) {
    echo $error->message();
    $log = new \App\Logger();
    $log->error($error, []);
    die;
}