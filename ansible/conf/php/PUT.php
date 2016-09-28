<?php
function mysql_PUT(){
	$link = mysql_connect('172.31.2.14', 'testuser', 'testuser');
	if (!$link) {
		die('接続失敗です。'.mysql_error());
	}

	//print('<p>接続に成功しました。</p>');

	$db_selected = mysql_select_db('testdb', $link);
	if (!$db_selected){
		die('データベース選択失敗です。'.mysql_error());
	}
	
	$putdata = fopen("php://input", "r");
	while ($buf = fread($putdata, 1024))
		$post_data=$buf;

	$post_data=strtok($post_data,"= ");
	$post_data=strtok("= ");

        $tok=strtok($post_data,"&,: ");
        while ($tok !== false) {
                $post_array[]=$tok;
                $tok = strtok(",:");
        }
        	
	$sql = sprintf("UPDATE User SET name = %s WHERE id = %d;",$post_array[3],$post_array[1]);
	$result = mysql_query($sql);
	if (!$result) {
		die('UPDATE クエリーが失敗しました。'.mysql_error());
	}

	$close_flag = mysql_close($link);

	if (!$close_flag){
		print('切断に失敗しました。');
	}
	
	
	
#	header("Location: http://172.31.2.14/");
	header("Location: http://172.31.2.10/v1/users/".str_replace("'","",$post_array[1]));
}
?>

