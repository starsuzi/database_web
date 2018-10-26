<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$대여_id = $_GET['대여_id'];

$query = "select 반납_datetime from 대여목록 where 반납_datetime is not null and 대여_id = $대여_id";

$res = mysqli_query($conn, $query);
$반납 = mysqli_fetch_assoc($res);
if (!$반납) {
        msg("반납 후에 삭제해주세요");
}

else {
	
	mysqli_query('set autocommit=0',$connect); //auto commit off
	mysqli_query('set session transaction isolation level serializable', $connect);//isolation level은 serializable
	mysqli_query('begin', $connect);//transaction start
	
	$ret = mysqli_query($conn, "delete from 대여목록 where 대여_id = '$대여_id'");
	
	if(!$ret)
	{
    	mysqli_query("rollback", $connect); 
    	s_msg('대여 삭제에 실패하였습니다. 다시 시도해주세요');
	}
	else
	{
		mysqli_query("commit", $connect);   
    	s_msg ('성공적으로 대여 삭제되었습니다');
    	echo "<meta http-equiv='refresh' content='0;url=대여_list.php'>";
	}
	
}




?>
