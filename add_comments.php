<?php
include 'header.php';
function add_comments($comment,$parent_id = 0)
{
	$connect = mysqli_connect(HOST,USER,PASS,DB) or die('Нехочет');
	$sql_request = "INSERT INTO comments (comment,parent_id) values('$comment', '$parent_id')";
	mysqli_query($connect,$sql_request);
	mysqli_close($connect);
	header ("Location: ".$_SERVER['HTTP_REFERER']);

}

if (isset($_POST['text_add'])) {
//Собираем
	$key = array_keys($_POST);
	$parent_id = intval(preg_replace("/[^0-9]/", '', $key[1]));
	$comment = $_POST['text_add'];
	add_comments($comment,$parent_id);
	}






?>
