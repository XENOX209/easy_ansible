<?php
function mysql_GET(){
	$link = mysql_connect('172.31.2.14', 'testuser', 'testuser');
	if (!$link) {
		die('接続失敗です。'.mysql_error());
	}

	$db_selected = mysql_select_db('testdb', $link);
	if (!$db_selected){
		die('データベース選択失敗です。'.mysql_error());
	}

	$result = mysql_query('SELECT * FROM User');
	if (!$result) {
		die('GET クエリーが失敗しました。'.mysql_error());
	}
	while ($row = mysql_fetch_assoc($result)) {
		$userData[]=array('id'=>(int)$row['id'],'name'=>$row['name']);
	}
	echo json_encode($userData);
	echo "\n";
	$close_flag = mysql_close($link);
	if (!$close_flag){
		die("切断に失敗しました。");
	}
}
?>
