<?php
include 'header.php';
#
#
#
function get($user)
{
	$connect = mysqli_connect(HOST,USER,PASS,DB) or die('Нехочет');
	$sql_request = "SELECT * FROM `users` WHERE login = '$user'";
	$query = mysqli_query($connect,$sql_request);
	$arr = [];
	$arr = mysqli_fetch_array($query, MYSQLI_ASSOC);
	unset($arr['id'],$arr['password']);
	return $arr;
}
				$all = get($_SESSION['logged_user']);
				foreach ($all as $key => $value) {
					echo "{$key}  ---  {$value}.<br>";
				}
#
#
#
function viev_user_data($arr)
{
	$form = "<form action = '' method = 'post'>";
	foreach ($arr as $key => $value) {
		$form .= "<h4 style = 'color: blue;'>Ваш `{$key}`  <input type = 'text' name = 'edit_{$key}' value = '{$value}'</h4>";
	}		
	$form .="<input type = 'submit' name = 'save_data' value = 'Save All'>
		</form>";
		echo $form;
}

#
#
#
function save($data,$all)
{
	var_dump($all);
	if (count($data) === count($all)) {
		$cler_data = [];
		foreach (array_keys($all) as $key => $value) {
			$cler_data[] = $value; 
		}
		foreach ($data as $key => $value) {
			# code...
		}

		var_dump($data);
		/*$connect = mysqli_connect(HOST,USER,PASS,DB) or die('Нехочет');
			$sql_request = "UPDATE user
							SET column1 = {$data['']}, column2 = value2, ...
							WHERE login = '{$data['login']}';"
			var_dump($sql_request);
		$query = mysqli_query($connect,$sql_request);
		*/
	}else{
			return;
	}
}
#
#
#
if (isset($_POST['save_data'])) {
	unset($_POST['save_data']);
	save($_POST,$all);

}
/////
##
viev_user_data($all);	
##
/////
?>
