<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

mysqli_query('set autocommit=0',$connect); //auto commit off
mysqli_query('set session transaction isolation level serializable', $connect);//isolation level은 serializable
mysqli_query('begin', $connect);//transaction start

$장비_id = $_GET['장비_id'];

$ret = mysqli_query($conn, "delete from 장비 where 장비_id = $장비_id");

if(!$ret)
{
    mysqli_query("rollback", $connect);
    s_msg('장비 삭제에 실패하였습니다. 다시 시도해주세요');
}
else
{
	mysqli_query("commit", $connect);
    s_msg ('성공적으로 장비가 삭제되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=장비_list.php'>";
}

$ret = mysqli_query($conn, "delete from 대여목록 where 장비_id = $장비_id");

if(!$ret)
{
	mysqli_query("rollback", $connect);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    mysqli_query("commit", $connect);
    echo "<meta http-equiv='refresh' content='0;url=장비_list.php'>";
}
?>

