<?php
include 'header.php';
function save_info($login = NULL, $password = NULL, $email = NULL, $mobNumber = NULL, $user_name = NULL, $user_surname = NULL)
{
	$password = password_hash($password, PASSWORD_DEFAULT);
	$connect = mysqli_connect(HOST,USER,PASS,DB) or die('Поблема коннекта');
	if (isset($login) && isset($password) && isset($email)) {
		$sql_request = "INSERT INTO users (login, password, email, _mob_number, user_name, user_surname) values('$login', '$password', '$email', '$mobNumber', '$user_name', '$user_surname')";
		mysqli_query($connect,$sql_request);
		mysqli_close($connect);
		echo "<h1 style = 'color:blue'>Вы успешно зарегестрированы!</h1>";
	}
	
}
function chekc_info($login = NULL, $email = NULL)
{
	$connect = mysqli_connect(HOST,USER,PASS,DB) or die('Поблема коннекта');
	if (isset($login)) {
			$sql_request = "SELECT * FROM `users` WHERE login = '$login'";
			if( mysqli_fetch_array(mysqli_query($connect,$sql_request)) ){
				return 1;
				mysqli_close($connect);
			}else {
				return 0;
				mysqli_close($connect);
			}
		}
		if (isset($email)) {
			$sql_request = "SELECT * FROM `users` WHERE email = '$email'";
			if( mysqli_fetch_array(mysqli_query($connect,$sql_request)) ){
				return 1;
				mysqli_close($connect);
			}else {
				return 0;
				mysqli_close($connect);
			}
	}
}



$data = $_POST;
if (isset($data['save'])) {
	$errors = [];
	//Проверка
	if (trim($data['login']) == '') {
		$errors[] = 'Вы не ввели логин';
		}
	if ($data['password'] == $data['add_passwors'] && $data['password'] != '') {
		//Добавлем пароль
	}else{
		$errors[] = 'С Вашими паролями что то не так..';
	}
	if (trim($data['email']) == '') {
		$errors[] = 'Вы не ввели Ваш e-mail';
	}
	if (trim($data['MobNumber'])  == '') {
		$errors[] = 'Вы не ввели Ваш мобильный номер';
	}
	if (chekc_info($data['login']) > 0) {
		$errors[] = 'Польователь с таким логином уже существует';
	}
	if (chekc_info(NULL,$data['email']) > 0) {
		$errors[] = 'Польователь с таким email`ом уже существует';
	}

	//проверка end,регистрируем
	if (empty($errors)) {
		#
		save_info($data['login'], $data['password'], $data['email'], $data['MobNumber'], $data['user_name'], $data['user_surname']);
		# 

	}else{
	 	echo '<div style = color:red;><strong>'.array_shift($errors).'</strong></div>';
}
}
?>
<form action="reg.php" method="POST">
	<p>
		<strong>Ваш логин:</strong><br>
		<input type="text" name="login" value="<?php @$data['login'] ?>">
	</p>
	<p>
		<strong>Ваш пароль:</strong><br>
		<input type="password" name="password" value="<?php @$data['password'] ?>">
	</p>
	<p>
		<strong>Повторный ввод Вашего пароля:</strong><br>
		<input type="password" name="add_passwors" value="<?php @$data['add_passwors'] ?>">
	</p>
	<p>
		<strong>Ваш e-mail:</strong><br>
		<input type="email" name="email" value="<?php @$data['email'] ?>">
	</p>
	<p>
		<strong>Ваш номер мобильного телефона:</strong><br>
		<input type="number" name="MobNumber" value="<?php @$data['MobNumber'] ?>">
	</p>
	<p>
		<strong>Ваше Имя:</strong><br>
		<input type="text" name="user_name" value="<?php @$data['user_name'] ?>">
	</p>
	<p>
		<strong>Ваша Фамилия:</strong><br>
		<input type="text" name="user_surname" value="<?php @$data['login'] ?>">
	</p>
	<p>
		<input type="submit" name="save" value="Зарегистрироваться!">
	</p>

</form>