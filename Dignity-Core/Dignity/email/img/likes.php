    <?php
ini_set('display_errors', 0);
// session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
    $user_home->redirect('home.php');
} else {
    session_start();
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
    <!DOCTYPE html>
<html>


    
    <head>
        <title><?php echo $row['userEmail']; ?></title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
              <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet" type="text/css">
        <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css"/>

        <!-- PAGE LEVEL PLUGIN STYLES -->
        <link href="css/animate.css" rel="stylesheet">
        <link href="vendor/swiper/css/swiper.min.css" rel="stylesheet" type="text/css"/>
        <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="layout.css"></link>

        <!-- Font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <!-- THEME STYLES -->
        <link href="css/layout.min.css" rel="stylesheet" type="text/css"/>
             <link rel="stylesheet" href="maincss.css">
                     <link rel="stylesheet" type="text/css" href="css/stylesforchange.css"></link>
                       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">


 
</head>
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
    </head>
    
<body>
    <br />
    <br />
        
        <script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="jquery.malihu.PageScroll2id.min.js"></script>
       <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Lite Line</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> 
								<?php echo $row['userEmail']; ?> <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                         

                       
                            <li class="active">
                                <a href="http://www.codingcage.com/2015/09/login-registration-email-verification-forgot-password-php.html">Типы общения:</a>
                            </li>
                            
                            
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <!-- Контейнер с адаптиными блоками -->
<div class="masonry">
    <!-- Адаптивные блоки с содержанием -->
   <div class="item"><a href="###">
       <img src="img/Trump.jpg">
           <br><h1>Политика</h1></a>
    </div>
 
   <div class="item">
    <a href="###">
       <img src="img/Footbal.jpg">
           <br><h1>Футбол</h1></a>
    </div>
 
   <div class="item">
    <a href="###">
      <a href="###">
       <img src="img/Student.jpg">
           <br><h1>Образование</h1></a>
    </div>
 
   <div class="item">
    <a href="###">
       <img src="img/advancher.jpg">
           <br><h1>Путешествие</h1></a>
    </div>
 
   <div class="item">
    <a href="###">
       <img src="img/Logo_IT_all.jpg">
           <br><h1>IT События</h1></a>
    </div>
 
   <div class="item">
    <a href="###">
       <img src="img/ICO.jpg">
           <br><h1>Об ICO</h1></a>
    </div>
 
    <div class="item">
      <a href="###">
       <img src="img/Kazan.jpg">
           <br><h1>Казань сейчас</h1></a>
    </div>
 
   <div class="item">
    <a href="###">
       <img src="img/istoriy.jpeg">
           <br><h1>Настоящая история</h1></a>
    </div>
 

    <div class="item">
      <a href="###">
       <img src="img/Medik.jpeg">
           <br><h1>Медицина</h1></a>
    </div>
 
    <div class="item">
      <a href="###">
       <img src="img/E3.jpg">
           <br><h1>Новости E3</h1></a>
    </div>
    <!-- Конец адаптивных блоков с содержанием -->
 
</div>
    <!-- Конец контейнера с адаптивными блоками -->
         <!-- Контейнер с адаптиными блоками -->

    <!-- Конец контейнера с адаптивными блоками -->
         <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

    <script  src="js/index.js"></script>
        </div>
</body>
</html>