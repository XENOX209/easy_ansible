<?php
function mysql_POST(){
	$link = mysql_connect('172.31.2.14', 'testuser', 'testuser');
	if (!$link) {
		die('接続失敗です。'.mysql_error());
	}
	
        $post_data=$_POST['data'];
	$tok=strtok($post_data,",: ");
	while ($tok !== false) {
		$post_array[]=$tok;
		$tok = strtok(",:");
	}
#	print_r($post_array);

	$db_selected = mysql_select_db('testdb', $link);
	if (!$db_selected){
		die('データベース選択失敗です。'.mysql_error());
	}

	$sql = sprintf("INSERT INTO User (id, name) VALUES (%d, %s);",(int)$post_array[1],$post_array[3]);
	$result_flag = mysql_query($sql);

	if (!$result_flag) {
		var_dump($sql);
		die('INSERT クエリーが失敗しました。'.mysql_error());
	}

	$close_flag = mysql_close($link);

	if ($close_flag){
		//print('<p>切断に成功しました。</p>');
	}
	$access_id=str_replace("'","",$post_array[1]);
	#var_dump($access_id);
	#header("Location: http://172.31.2.10/v1/users/".$access_id);
	#header("Location: http://172.31.2.10/");
}
?>

