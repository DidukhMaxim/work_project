<?php
include 'header.php';
function add_comments($comment,$parent_id = 0,$user)
{
	$connect = mysqli_connect(HOST,USER,PASS,DB) or die('Нехочет');
	$sql_request = "INSERT INTO comments (comment,parent_id,user) values('$comment', '$parent_id', '$user')";
	mysqli_query($connect,$sql_request);
	mysqli_close($connect);
	//header ("Location: ".$_SERVER['HTTP_REFERER']);
	var_dump($_POST);

}

function delete_comments($id)
{
	$connect = mysqli_connect(HOST,USER,PASS,DB) or die('Нехочет');
	$sql_request = "DELETE from `comments` WHERE id=$id";
	mysqli_query($connect,$sql_request);
	mysqli_close($connect);
	header ("Location: ".$_SERVER['HTTP_REFERER']);
}
if ($_POST) {

//Ключи поста
	$key = array_keys($_POST);
##############################
	if(stripos($key[1], 'add') === 0 ){
		if (trim($_POST['text_add']) === "" ) {
				echo "Вы не ввели свой комментарий";
			}else {
				if (isset($_SESSION['logged_user'])) {
					$user = $_SESSION['logged_user'];
				}else{
					$user = "Guest";
				}
				$parent_id = intval(preg_replace("/[^0-9]/", '', $key[1]));
				$comment = $_POST['text_add'];
				add_comments($comment,$parent_id,$user);
			}
	}elseif(stripos($key[1], 'delete') === 0){
	$id = intval(preg_replace("/[^0-9]/", '', $key[1]));
		delete_comments($id);
	}
}










?>
