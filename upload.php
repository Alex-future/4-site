<?php

error_reporting(-1);

header('Content-Type: text/html; charset=utf-8');

$s=0;

$name=$_POST['name'];

$fam=$_POST['fam'];

$tel=$_POST['tel'];

$email=$_POST['email'];

$geo=$_POST['geo'];

$calendar=$_POST['calendar'];

$period=$_POST['period'];

$gosty=$_POST['gosty'];

$pay=$_POST['pay'];

switch($period) {

case "2-3 ночи":$s+=1500;break;

case "7-10 ночей":$s+=7000;break;

case "14 ночей":$s+=30000;break;

case "30 ночей":$s+=100000;break;

}

switch($gosty) {

case "1 взрослый":$s+=1700;break;

case "2 взрослых":$s+=2500;break;

case "3 взрослых":$s+=4000;break;

case "4 взрослых":$s+=5400;break;

case "размещение с детьми":$s+=1500;break;

}

echo "<html lang='ru'>

<head>

<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

<title>Данные о путевке</title>

</head>

<body style='background:url(/5.jpg);background-size:cover'>

<h2 style='margin left:10%;'>Данные о путёвке: </h2>

<p>Имя:" .$name. "</p>

<p>Фамилия:" .$fam. "</p>

<p>E-mail:" .$email. "</p>

<p>Куда отправится:" .$geo. "</p>

<p>Дата:" .$calendar. "</p>

<p>Период:" .$period. "</p>

<p>Кол-во гостей:" .$gosty. "</p>

<p>Способ оплаты:" .$pay. "</p>

<p>Сумма:" .$s. "</p>

<div style = 'display:inline-block'><img src = '/4.jpg' style = 'width:20%; margin-left:10%; margin-top:20%'></div>;

</body>

</html>";

//указывает каталог, в который будет помещен файл

$target_dir="upload/";
//проверка директории для загрузки
if(!is_dir($target_dir))
	{
	mkdir($target_dir,0777,true);
	}
$target_file=$target_dir.basename($_FILES["fileToUpload"]["name"]);
$uploadOk=1;
$imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//проверка,сущ. ли файл
if(file_exists($target_file))
	{
	echo "Извините,файл уже существует.\n";
	$uploadOk=0;
	}
//проверка размера файла
if($_FILES["fileToUpload"]["size"]<100000)
	{
	echo "Извините,ваш файл слишком маленький.\n";
	$uploadOk=0;
	}
if($_FILES["fileToUpload"]["size"]>200000)
	{
	echo "Извините,ваш файл слишком большой.\n";
	$uploadOk=0;
	}
//Разрешить определенные форматы файлов
if($imageFileType!="jpg" && $imageFileType!="jpeg")
	{
	echo "Извините, разрешено только файлы JPG, JPEG.\n";
	$uploadOk=0;
	}
//Проверка, имеет ли uploadOk значение 0 (ошибка при загрузке)
if($uploadOk==0)
	{
	echo "Извините, ваш файл не был загружен.";
	}
else
	{
	if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
		{
		echo "Файл ".basename($_FILES["fileToUpload"]["name"])." был загружен";
		}
	else
		{
		echo "К сожалению, произошла ошибка при загрузке файла.";
		}
	}


$flag = 0;

$flagg = 0;

$msg = '';

function file_force_download($file) {

if (file_exists($file)) {

// сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт

if (ob_get_level()) {

ob_end_clean();

}

header('Content-Description: File Transfer');

header('Content-Type: application/octet-stream');

header('Content-Disposition: attachment; filename=' . basename($file));

header('Content-Transfer-Encoding: binary');

header('Expires: 0');

header('Cache-Control: must-revalidate');

header('Pragma: public');

header('Content-Length: ' . filesize($file));

// читаем файл и отправляем его пользователю

readfile($file);

exit;

}}

// проверка входных данных, полученных из web-формы

function test_input($data) {

$data = trim($data);

$data = stripslashes($data);

$data = htmlspecialchars($data);

return $data;}

if(isset( $_POST['button2'])) {

$f = fopen('textfile.txt', 'w');

// Записать текст

if(!empty($_POST['email'])) {

fwrite($f,"Емэйл: " . $_POST['email'] . "\r\n");}

if(!empty($_POST['tel'])) {

	fwrite($f,"Телефон: " . $_POST['tel'] . "\r\n");}

if(!empty($_POST['name'])) {

fwrite($f,"Имя: " . $_POST['name'] . "\r\n");}
	
if(!empty($_POST['geo'])) {

fwrite($f,"Место: " . $_POST['geo'] . "\r\n");}

if(!empty($_POST['calendar'])) {

fwrite($f,"Дата: " . $_POST['calendar'] . "\r\n");}

if(!empty($_POST['period'])) {

fwrite($f,"Период: " . $_POST['period'] . "\r\n");}

if(!empty($_POST['gosty'])) {

fwrite($f,"Гости: " . $_POST['gosty'] . "\r\n");}

if(!empty($_POST['pay'])) {

fwrite($f,"Оплата: " . $_POST['pay'] . "\r\n");}

if(!empty($_POST['fam'])) {

fwrite($f,"Фамилия: " . $_POST['fam'] . "\r\n");}

if(!empty($_POST['s'])) {

fwrite($f,"Сумма: " . $_POST['s'] . "\r\n");}

// Закрыть текстовый файл

fclose($f);

$flag = 1;

echo "<br><br><a style='text-align:center;' href='index.html'>Назад</a></div> ";}

if(isset($_POST['button3'])) {

echo "<div class='ddd' style='width:500px'>";

readfile("textfile.txt");

echo "<br><br><a style='text-align:center;' href='index.html'>Назад</a></div> ";

$flagg = 1;

}

if(isset($_POST['button4'])) {

$file = ('textfile.txt');

file_force_download($file);

echo "<br><br><a style='text-align:center;' href='index.html'>Назад</a></div> ";

}

$file = ('textfile.txt');

$getMime = explode( '.', $file );

$mime = end( $getMime );

$msg = 'Файл в формате ';

$msg .= $mime;

$msg .= ' был загружен.';

?>