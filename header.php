<header><?php
include 'db_config.php';
echo "<a href = ".dirname("index.php").">На главную</a><br>";


if ( isset($_SESSION['logged_user']) ) {
 	echo "<a href = 'logout.php'>Выход</a>       ";
 	echo "<a href = 'lk.php'>Личный кабинет</a><br>";
 	echo "Привет, ".$_SESSION['logged_user'];
}else{
	echo "<a href = 'singl.php'>Войти</a>       ";
	echo "<a href = 'reg.php'>Регистрация</a>       ";
}



?></header>
