<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

mysqli_query('set autocommit=0',$connect); //auto commit off
mysqli_query('set session transaction isolation level serializable', $connect);//isolation level은 serializable
mysqli_query('begin', $connect);//transaction start

$국원_학번 = $_GET['국원_학번'];

$ret = mysqli_query($conn, "delete from 국원 where 국원_학번 = $국원_학번");

if(!$ret)
{
    mysqli_query("rollback", $connect);
    s_msg('국원 삭제에 실패하였습니다. 다시 시도해주세요');
}
else
{
	mysqli_query("commit", $connect);
    s_msg ('성공적으로 국원이 삭제되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=국원_list.php'>";
}
?>

