<?php
//ini_set('display_errors','Off');
session_start();
require_once 'class.user.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
	$user_login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);
	
	if($user_login->login($email,$upass))
	{
		$user_login->redirect('index.php');
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
      <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/mobile_styles.css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1">



     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>

  <body id="login">

    <div class="container">
		<?php 
		if(isset($_GET['inactive']))
		{
			?>
            <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Sorry!</strong> Ваш аккант не активирован, откройте почту и перейдите по ссылке из нашего письма:) 
			</div>
            <?php
		}
		?>
        <form class="form-signin" method="post">
        <?php
        if(isset($_GET['error']))
		{
			?>
            <div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Не правильные данные!</strong> 
			</div>
            <?php
		}
		?>
        <h2 class="form-signin-heading">Войти в Dignity</h2>
        <input type="email" class="input-block-level" placeholder="E-mail" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Пароль" name="txtupass" required />
   
        <button class="baton" type="submit" name="btn-login">Войти</button>
        <a href="mobile_signup.php" style="float:right;" class="bitn">Зарегистрироваться</a>
        <a href="mobile_fpass.php" class="forgot">Забыли пароль ? </a>
      </form>
    </div> <!-- /container -->
    <script src="bootstrap/js/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>



  </body>
</html>