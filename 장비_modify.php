<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

mysqli_query('set autocommit=0',$connect); //auto commit off
mysqli_query('set session transaction isolation level serializable', $connect);//isolation level은 serializable
mysqli_query('begin', $connect);//transaction start

$장비_id = $_POST['장비_id'];
$장비종류_id = $_POST['장비종류_id'];
$장비_name = $_POST['장비_name'];
$장비_desc = $_POST['장비_desc'];
$장비_price = $_POST['장비_price'];

$ret = mysqli_query($conn, "update 장비 set 장비종류_id = $장비종류_id, 장비_name = '$장비_name', 장비_desc = '$장비_desc', 장비_price = '$장비_price' where 장비_id = '$장비_id'");

if(!$ret)
{
    mysqli_query("rollback", $connect);
    s_msg('장비 수정에 실패하였습니다. 다시 시도해주세요');
}
else
{
	mysqli_query("commit", $connect);
    s_msg ('장비가 성공적으로 수정되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=장비_list.php'>";
}
?>

