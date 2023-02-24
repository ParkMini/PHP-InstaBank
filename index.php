<?php
// DB접속모듈
include 'config/DBConnector.php';

// 요청주소 파싱
$request = $_SERVER['REQUEST_URI']; 
$path = explode('?', $request);
$res = explode('/', $path[0]);
parse_str(getenv('QUERY_STRING'), $qs);


// 주소 분류(라우터)
$currentPage = './pages/Main.php';
switch($path[0]){
    case '/member':
        $currentPage = './pages/Member.php';
        break;

    case '/admin':
        $currentPage = './pages/Admin.php';
        break;

    case '/send':
        $currentPage = './pages/Send.php';
        break;

    case '/find':
        $currentPage = './pages/Find.php';
        break;

    case '/sort':
        $currentPage = './pages/Sort.php';
        break;

    case '/sample':
        $currentPage = './pages/Sample.php';
        break;
        
    case '/api/account/history':
        $currentPage = './pages/Sample.php';
        break;

    default: 
        $currentPage = './pages/Main.php';
        break;
}
if($res[1] == 'api') {
    include $currentPage;
} else {
    include './components/Layout.php';
}
?>