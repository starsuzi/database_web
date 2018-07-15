<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

mysqli_query('set autocommit=0',$connect); //auto commit off
mysqli_query('set session transaction isolation level serializable', $connect);//isolation level은 serializable
mysqli_query('begin', $connect);//transaction start

$장비_id = $_POST['장비_id'];
$국원_학번 = $_POST['국원_학번'];
$대여현황 = $_POST['대여현황'];
$비밀번호 = $_POST['비밀번호'];

$query = "select 비밀번호 
from 대여목록
where 비밀번호 = $비밀번호 and 장비_id = $장비_id"; 
$res = mysqli_query($conn, $query);
$비밀번호확인 = mysqli_fetch_assoc($res);
if (!$비밀번호확인) {
        msg("비밀번호를 제대로 입력해주세요");
    }

$query = "update 대여목록 set 반납_datetime = NOW() where 장비_id = $장비_id";
$ret = mysqli_query($conn, $query);
if(!$ret)
{
	mysqli_query("rollback", $connect);
    s_msg('실패하였습니다. 다시 시도해주세요');
}
else
{
    mysqli_query("commit", $connect);
    s_msg ('성공적으로 반납되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=장비_list.php'>";
}

$query = "update 장비 set 대여현황 = null where 장비_id = $장비_id";
$ret = mysqli_query($conn, $query);
if(!$ret)
{
	mysqli_query("rollback", $connect);
    s_msg('실패하였습니다. 다시 시도해주세요');
}
else
{
	mysqli_query("commit", $connect);
    echo "<meta http-equiv='refresh' content='0;url=장비_list.php'>";
}

$query = "update 대여목록
		set 비밀번호 = null 
		where 장비_id = $장비_id
		";
$ret = mysqli_query($conn, $query);
if(!$ret)
{
	mysqli_query("rollback", $connect);
    s_msg('실패하였습니다. 다시 시도해주세요');
}
else
{
    mysqli_query("commit", $connect);
    echo "<meta http-equiv='refresh' content='0;url=장비_list.php'>";
}

?>
