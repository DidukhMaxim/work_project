<?php
include 'header.php';
function get_com()
{
	$connect = mysqli_connect(HOST,USER,PASS,DB) or die('Нехочет');
	$sql_request = "SELECT id,comment,parent_id FROM `comments";
	$query = mysqli_query($connect,$sql_request);
	$arr_com = array();
	if (mysqli_num_rows($query) != 0) {
		for ($i=0; $i < mysqli_num_rows($query) ; $i++) { 
			$row = mysqli_fetch_array($query, MYSQLI_ASSOC);	
			if (empty($arr_com[$row['parent_id']])) {
				$arr_com[$row['parent_id']] = array();
			}
			$arr_com[$row['parent_id']][] = $row;
		}
	}
	mysqli_close($connect);
	return $arr_com;
}

function view_com($arr,$parent_id = 0) {
	 //Условия выхода из рекурсии
	 if( empty($arr[$parent_id] )) {
	  return;
	 }
	 //перебираем в цикле массив и выводим на экран
	 echo '<ul>';

	 for($i = 0; $i < count($arr[$parent_id]);$i++) {

	  echo "
	  <li>
	  		<div>{$arr[$parent_id][$i]['comment']}</div>
	  		<div>
				<form action = 'add_comments.php' method = 'post'>
					<input type='text' name='text_add'>
					<input type='submit' name='clic{$arr[$parent_id][$i]['id']}' value='{$arr[$parent_id][$i]['id']}'>
				</form>
			</div>
	  </li>";

	  //рекурсия - проверяем нет ли дочерних категорий
	  view_com($arr,$arr[$parent_id][$i]['id']);
	 
	 }
	 echo "</ul>";
 }


?>
