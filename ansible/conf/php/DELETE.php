<?php
function mysql_DELETE($id){
	$link = mysql_connect('172.31.2.14', 'testuser', 'testuser');
	if (!$link) {
		die('接続失敗です。'.mysql_error());
	}

	$db_selected = mysql_select_db('testdb', $link);
	if (!$db_selected){
		die('データベース選択失敗です。'.mysql_error());
	}

	$sql = sprintf("DELETE FROM User WHERE id = %d;",(int)$id);

	$result_flag = mysql_query($sql);

	if (!$result_flag) {
		die('DELETEクエリーが失敗しました。'.mysql_error());
	}

	$close_flag = mysql_close($link);

	if (!$close_flag){
		print('切断に失敗しました。');
	}
}
?>

