<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

mysqli_query('set autocommit=0',$connect); //auto commit off
mysqli_query('set session transaction isolation level serializable', $connect);//isolation level은 serializable
mysqli_query('begin', $connect);//transaction start

$장비종류_id = $_POST['장비종류_id'];
$장비_name = $_POST['장비_name'];
$장비_desc = $_POST['장비_desc'];
$장비_price = $_POST['장비_price'];

$ret = mysqli_query($conn, "insert into 장비(장비종류_id, 장비_name, 장비_desc, 장비_price, 대여현황) values('$장비종류_id', '$장비_name', '$장비_desc', '$장비_price', NULL)");
if(!$ret)
{
	mysqli_query("rollback", $connect);
    s_msg('장비 등록에 실패하였습니다. 다시 시도해주세요');
}
else
{
	mysqli_query("commit", $connect);
    s_msg ('성공적으로 등록되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=장비_list.php'>";
}

?>
