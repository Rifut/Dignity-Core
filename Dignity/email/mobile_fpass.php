<?php
ini_set('display_errors','Off');
session_start();
require_once 'class.user.php';
$user = new USER();

if($user->is_logged_in()!="")
{
	$user->redirect('home.php');
}

if(isset($_POST['btn-submit']))
{
	$email = $_POST['txtemail'];
	
	$stmt = $user->runQuery("SELECT userID FROM tbl_users WHERE userEmail=:email LIMIT 1");
	$stmt->execute(array(":email"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);	
	if($stmt->rowCount() == 1)
	{
		$id = base64_encode($row['userID']);
		$code = md5(uniqid(rand()));
		
		$stmt = $user->runQuery("UPDATE tbl_users SET tokenCode=:token WHERE userEmail=:email");
		$stmt->execute(array(":token"=>$code,"email"=>$email));
		
		$message= "
				   Здравствуйте , $email
				   <br /><br />
				 Мы получили запрос на восстановление пароля, если это были вы , то перейдите по ссылке ниже, а если же это были не вы, проигнорируйте данный E-mail,
				   <br /><br />
				  Для восстановления пароля перейдите по ссылке !  
				   <br /><br />
				   <a href='http://line-lite.ru/email/resetpass.php?id=$id&code=$code'>Восстановить пароль!</a>
				   <br /><br />
				  Спасибо!
				   ";
		$subject = "Восстановление пароля Dignity";
		
		$user->send_mail($email,$message,$subject);
		
		$msg = "<div class='alert alert-success'>
					<button class='close' data-dismiss='alert'>&times;</button>
					Мы отправили письмо на  $email.
                    Пожалуйста перейдите по ссылке из письма для восстановления пароля. 
			  	</div>";
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Простите!</strong>  E-mail не найден!. 
			    </div>";
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Восстановление пароля!</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/mobile_styles.css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body id="login">
    <div class="container">

      <form class="form-signin" method="post">
        <h3 class="form-signin-heading" style="white-space: nowrap;">Восстановление пароля</h3><hr />
        
        	<?php
			if(isset($msg))
			{
				echo $msg;
			}
			else
			{
				?>
              	<div class='alert alert-info'>
				Пожалуйста введите ваш  E-mail адрес. Вы получите ссылку на восстановление пароля по E-mail!
				</div>  
                <?php
			}
			?>
        
        <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
     	<hr />
        <button class="batonres" type="submit" name="btn-submit">Сгенерировать новый пароль!</button>
      </form>

    </div> <!-- /container -->
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>