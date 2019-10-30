<?php
// 자동으로 require을 해주는 기능
// 이 기능을 등록해준다. 익명함수
spl_autoload_register(function($classname){
    echo $classname;
    require "../Module/Database/".$classname.".php";
    //exit;
});