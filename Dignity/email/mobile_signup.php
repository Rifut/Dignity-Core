<?php
ini_set('display_errors','Off');
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
    <link href="assets/mobile_styles.css" rel="stylesheet" media="screen">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <h3 class="form-signin-heading" style="white-space: nowrap; margin-left: -11%;">Зарегистрироваться в Dignity</h3>
        <input type="text" class="input-block-level" placeholder="Имя" name="txtuname" required />
        <input type="email" class="input-block-level" placeholder="E-mail" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Пароль" name="txtpass" required />
        <button class="batonreg" type="submit" name="btn-signup">Зарегистрироваться</button>
        <a href="mobile_signin.php" style="float:left;" class="forgot2">Уже есть есть аккаунт?</a>
      </form>

    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

<style type="text/css">#hellopreloader>p{display:none;}#hellopreloader_preload{display: block;position: fixed;z-index: 99999;top: 0;left: 0;width: 100%;height: 100%;min-width: 1000px;background: #4183D7 url(http://hello-site.ru//main/images/preloads/tail-spin.svg) center center no-repeat;background-size:175px;}</style>
<div id="hellopreloader"><div id="hellopreloader_preload"></div><p><a href="http://hello-site.ru">Hello-Site.ru. Бесплатный конструктор сайтов.</a></p></div>
<script type="text/javascript">var hellopreloader = document.getElementById("hellopreloader_preload");function fadeOutnojquery(el){el.style.opacity = 1;var interhellopreloader = setInterval(function(){el.style.opacity = el.style.opacity - 0.05;if (el.style.opacity <=0.05){ clearInterval(interhellopreloader);hellopreloader.style.display = "none";}},16);}window.onload = function(){setTimeout(function(){fadeOutnojquery(hellopreloader);},1000);};</script>
  </body>
</html>