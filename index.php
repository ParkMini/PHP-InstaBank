<?php
// DB접속모듈
include 'config/DBConnector.php';

// 요청주소 파싱
$request = $_SERVER['REQUEST_URI']; 
$path = explode('?', $request);
$res = explode('/', $path[0]);
parse_str(getenv('QUERY_STRING'), $qs);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>인스타그램 클론</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <!-- ===== 상단 네비게이션 ===== -->
    <?php 
    include "components/Navbar.php"; 
    ?>

    <!-- ===== 메인 컨텐츠 ===== -->
    <div class="container">
    <?php
        // 주소 분류(라우터)
        switch($res[1]){
            case 'member':
                include './pages/Member.php';
                break;

            case 'admin':
                include './pages/Admin.php';
                break;

            case 'send':
                include './pages/Send.php';
                break;

            case 'find':
                include './pages/Find.php';
                break;

            case 'sort':
                include './pages/Sort.php';
                break;

            default: 
                include './pages/Main.php';
                break;
        }
    ?>
    </div>

    <!-- ===== 스크립트 ===== -->
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>