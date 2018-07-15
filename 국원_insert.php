<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

mysqli_query('set autocommit=0',$connect); //auto commit off
mysqli_query('set session transaction isolation level serializable', $connect);//isolation level은 serializable
mysqli_query('begin', $connect);//transaction start

$부서_id = $_POST['부서_id'];
$기수 = $_POST['기수'];
$국원_학번 = $_POST['국원_학번'];
$국원_name = $_POST['국원_name'];
$국원_phonenum = $_POST['국원_phonenum'];

$ret = mysqli_query($conn, "insert into 국원( 부서_id, 기수,국원_학번, 국원_name, 국원_phonenum) values('$부서_id', '$기수', '$국원_학번','$국원_name', '$국원_phonenum')");
if(!$ret)
{
    mysqli_query("rollback", $connect);
    s_msg('국원 등록에 실패하였습니다. 다시 시도해주세요');
}
else
{
	mysqli_query("commit", $connect);
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=국원_list.php'>";
}

?>
