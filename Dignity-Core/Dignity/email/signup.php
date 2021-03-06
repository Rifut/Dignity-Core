﻿<?php error_reporting( E_ERROR ); ?>
<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('index.php');
}


if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txtuname']);

	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$code = md5(uniqid(rand()));
	
	$stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		$msg = "
		       <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Простите !</strong> E-mail уже используется, попробуйте использовать другой!
			  </div>
			  ";
	}
	else
	{
		if($reg_user->register($uname,$email,$upass,$code))
		{			
			$id = $reg_user->lasdID();		
			$key = base64_encode($id);
			$id = $key;
		
			$message = "					
						Здравствуйте,
					
					
						
						<br /><br />
						<br/>
						Для подтверждения регистрации перейдите по ссылке!<br/>
						<br /><br />
						<a href='http://line-lite.ru/email/verify.php?id=$id&code=$code'>Нажмите чтобы активировать!</a>
						<br /><br />
						<body><p></p></body>
						Спасибо,";
						
			$subject = '=?utf-8?B?'.base64_encode('Подтверждение регистрации в Dignity!').'?=';
						
			$reg_user->send_mail($email,$message,$subject);	
				$msg = "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Success!</strong>  Мы отправили письмо на $email.
                   Пожалуйста подтвердите ваш аккаунт, для этого зайдите в вашу почту и перейдите по ссылке из нашего письма! 
			  		</div>
					";
		}
		else
		{
			echo "sorry , Query could no execute...";
		}		
	}
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Signup</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="assets/site_global.css?crc=444006867"/>
  <link rel="stylesheet" type="text/css" href="assets/___-2.css?crc=3804483651" id="pagesheet"/>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">
				<?php if(isset($msg)) echo $msg;  ?>
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Зарегистрироваться</h2><hr />
        <input type="text" class="input-block-level" placeholder="Имя" name="txtuname" required />
        <input type="email" class="input-block-level" placeholder="E-mail" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Пароль" name="txtpass" required />
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-signup">Зарегистрироваться</button>
        <a href="signin.php" style="float:right;" class="btn btn-large">Войти</a>
      </form>

    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>


  </body>
</html>