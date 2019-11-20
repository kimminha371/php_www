<?php
$config = include "../dbconf.php";
require "../Loading.php";

// 세션 활성화
session_start();

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
    // 클래스의 메인이 처음으로 동작하는 것으로 정함
    $tables->main();
}else {
    //처음 페이지
    //echo "처음 페이지";
    $body = file_get_contents("../Resource/index.html");

    if($_SESSION["email"]) {
        // 로그아웃 상태
        $body = str_replace("{{login}}","로그인 상태입니다. <a href='logout'>로그아웃</a>",$body);
    } else {
        // 로그인 상태
        $loginform = file_get_contents("../Resource/login.html");
        $body = str_replace("{{login}}",$loginform,$body);
    }
    echo $body;
}

// $desc = new \App\Controller\TableInfo;
// $desc->main();