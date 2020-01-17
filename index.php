<?php
require 'view_comment.php';

echo "<h style='color:green;'>Ваш коментарий:</h>
<form action = 'add_comments.php' method = 'post'>
	<input type = 'text' name = 'text_add'>
	<input type = 'submit' name = 'clic'>	
</form>";


$result_get_com = get_com();
view_com($result_get_com);




?>
