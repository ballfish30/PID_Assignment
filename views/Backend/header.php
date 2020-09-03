<!doctype html>
<!--
	Itsy by FreeHTML5.co
	Twitter: https://twitter.com/fh5co
	Facebook: https://fb.com/fh5co
	URL: https://freehtml5.co
-->
<html class="home blog no-js" lang="en-US">
<head>
    <title>阿魚桌遊店</title>

    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          type="text/css" media="all"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC%3A400%2C700%7CLato%3A400%2C700%2C400italic%2C700italic&amp;ver=4.9.8"
          type="text/css" media="screen"/>
    <link rel="stylesheet" href="/PID_Assignment/css/style.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="/PID_Assignment/css/print.css" type="text/css" media="print"/>
    <!--[if (lt IE 9) & (!IEMobile)]>
    <link rel="stylesheet" id="lt-ie9-css" href="ie.css" type="text/css" media="screen"/>
    <![endif]-->
    <script src='/PID_Assignment/js/jquery-3.0.0.min.js'></script>
    <script src='/PID_Assignment/js/jquery-migrate-3.0.1.min.js'></script>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body class="home sticky-menu sidebar-off" id="top">
<header class="header">

    <div class="header-wrap">

        <div class="logo plain logo-left">
            <div class="site-title">
                <a href="http://localhost:8888/PID_Assignment/store/" title="Go to Home">阿魚桌遊店</a>
            </div>
        </div><!-- /logo -->


        <nav id="nav" role="navigation">
            <div class="table">
                <div class="table-cell">
                    <ul id="menu-menu-1">
                        <li class="menu-item">
                            <a href="http://localhost:8888/PID_Assignment/store/">後台首頁</a></li>
                            <li class="menu-item">
                            <a href="http://localhost:8888/PID_Assignment/store/">前台首頁</a></li>
                        <li class="menu-item">
                            <a href="http://localhost:8888/PID_Assignment/backend/members">會員列表</a></li>
                        <li class="menu-item">
                            <a href="http://localhost:8888/PID_Assignment/backend/products">商品管理</a></li>
                            <?php
                            session_start();
                            if(isset($_SESSION['userId'])){
                                echo("<li class='menu-item'>
                                <a href='http://localhost:8888/PID_Assignment/user/logout'>登出</a></li>"); 
                            }else{
                                echo("<li class='menu-item'>
                                <a href='http://localhost:8888/PID_Assignment/user/login'>登入</a></li>");   
                            }
                        ?>
                        <li class="menu-inline menu-item">
                            <a title="Facebook" href="https://www.facebook.com/tbgm0906311158">
                                <i class="fa fa-facebook"></i><span class="i">Facebook</span>
                            </a></li>
                        <li class="menu-inline menu-item">
                            <a title="Instagram" href="https://www.instagram.com/tbgm.service/">
                                <i class="fa fa-instagram"></i><span class="i">Instagram</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <a href="#nav" class="menu-trigger"><i class="fa fa-bars"></i></a>

        <a href="#topsearch" class="search-trigger"><i class="fa fa-search"></i></a>

    </div>

</header>