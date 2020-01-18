<?php
include 'header.php';
function singl($login = NULL,$password = NULL)
{
		$connect = mysqli_connect(HOST,USER,PASS,DB) or die('Нехочет');
		$sql_request_login = "SELECT * FROM `users` WHERE login = '$login'";
		$query_login = mysqli_query($connect,$sql_request_login);
		if ($query_login->num_rows != 0) {
			$array = mysqli_fetch_array($query_login);
				if (password_verify($password, $array['password'])) {
					mysqli_close($connect);
					echo $_SESSION['logged_user'] = $login.', Вы авторизованы!'."<h1><a href = '/hotel'>Перейти на главную?</a></h1>"; 
					header("Location: singl.php");
					return $_SESSION['logged_user'] = $login;
				}else {
					echo "Неверный пароль";
					mysqli_close($connect);
				}
		}else {
			echo "Неверный логин";
			mysqli_close($connect);
		}
	
}
$data = $_POST;
if (isset($data['singl'])) {
	singl($data['login'],$data['password']); 

}
?>
<form action="singl.php" method="POST">
	<p>
		<strong>Ваш логин:</strong><br>
		<input type="text" name="login" value="<?php @$data['login'] ?>">
	</p>
	<p> 
		<strong>Ваш пароль:</strong><br>
		<input type="password" name="password" value="<?php @$data['password'] ?>">
	</p>
	<p>
		<input type="submit" name="singl" value="Вход">
	</p>
</form>
			
