<?
$key = "this is a very secret key";
$input = $_POST['chatText'];

$td = mcrypt_module_open ('tripledes', '', 'ecb', '');
$iv = mcrypt_create_iv (mcrypt_enc_get_iv_size ($td), MCRYPT_RAND);
mcrypt_generic_init ($td, $key, $iv);
$encrypted_data = mcrypt_generic ($td, $input);
mcrypt_generic_end ($td);
?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="js/jScrollPane/jScrollPane.css" />
<link rel="stylesheet" type="text/css" href="css/page.css" />
<link rel="stylesheet" type="text/css" href="css/chat.css" />

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<script type="text/javascript" src=" smail/smail.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Dignity</title>
</head>
<body>
  <div class="H1">
    <h1>Dignity</h1>
  </div>
<div id="chatContainer">

    <div id="chatTopBar" class="rounded">
    </div>
    <div id="chatLineHolder"></div>
    
    <div id="chatUsers" class="rounded"></div>
    <div id="chatBottomBar" class="rounded">
    	<div class="tip"></div>
        
        <form id="loginForm" method="post" action="">
            <input id="name" name="name" class="rounded" maxlength="16" />
            <input type="submit" class="blueButton" value="Войти" />
        </form>
        
        <form id="submitForm" method="post" action="">
            <input id="chatText" name="chatText" class="rounded" maxlength="255" />
            <input type="submit" class="blueButton" value="Отправить" />
             <img src="img/mc.png" onclick="speech()" id = "xD" style="margin-top: -9%;
    width: 12%;
    margin-left: 485px;;"> 
        </form>
                  
    </div>


 <script>
  // Создаем распознаватель
  var recognizer = new webkitSpeechRecognition();

  // Ставим опцию, чтобы распознавание началось ещё до того, как пользователь закончит говорить
  recognizer.interimResults = true;

  // Какой язык будем распознавать?
  recognizer.lang = 'ru-Ru';

  // Используем колбек для обработки результатов
  recognizer.onresult = function (event) {
    var result = event.results[event.resultIndex];
    if (result.isFinal) {
          var text = document.getElementById("chatText").value = result[0].transcript;
          var img = document.getElementById("xD"); // добываем ссылку на элемент (например, по id)
img.src = 'img/GIF_OFF.gif'; // а вот собственно замена
    
    } else {

    }
  };

  function speech () {
     var img = document.getElementById("xD"); // добываем ссылку на элемент (например, по id)
 img.src = "img/mic_on.gif"; // а вот собственно замена
    // Начинаем слушать микрофон и распознавать голос
   document.getElementById('chatText').value = '';
    recognizer.start();

  }

  var synth = window.speechSynthesis;
  var utterance = new SpeechSynthesisUtterance('How about we say this now? This is quite a long sentence to say.');

  function talk () {
    synth.speak (utterance);
  }

  function stop () {
    synth.pause();
  }
  </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="js/jScrollPane/jquery.mousewheel.js"></script>
<script src="js/jScrollPane/jScrollPane.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
