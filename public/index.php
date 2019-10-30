<?php
$config = include "../dbconf.php";
require "../Loading.php";

$uri = $_SERVER['REQUEST_URI'];
$uris = explode("/",$uri);//파란책
//print_r($uris);

$db = new \Module\Database\Database($config);

//배열이 있나 확인 && 배열값이 있나 확인
if(isset($uris[1]) && $uris[1]) {
    //컨트롤러 실행
    //echo $uris[1]."컨트롤러 실행";
    $controllerName = "\App\Controller\\".ucfirst($uris[1]);
    $tables = new $controllerName($db);
    $tables->main();
}else {
    //처음 페이지
    //echo "처음 페이지";
    $body = file_get_contents("../Resource/index.html");
    echo $body;
}

// $desc = new \App\Controller\TableInfo;
// $desc->main();