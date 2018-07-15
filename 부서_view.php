<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("부서_id", $_GET)) {
    $부서_id = $_GET["부서_id"];
    $query = "select * from 부서 where 부서_id = $부서_id";
    $res = mysqli_query($conn, $query);
    $부서 = mysqli_fetch_assoc($res);
    if (!$부서) {
        msg("부서가 존재하지 않습니다.");
    }
    
	
	$query = "select 부서_id from 국원 where 부서_id = $부서_id";
	$result_set = mysqli_query($conn, $query);
	$count = mysqli_num_rows($result_set);
//	echo '$count : '.$count.'<br>';
}



?>

    <div class="container fullwidth">

        <h3>부서 설명</h3>

        <p>
            <label for="부서_id">부서 코드</label>
            <input readonly type="text" id="부서_id" name="부서_id" value="<?= $부서['부서_id'] ?>"/>
        </p>

        <p>
            <label for="부서_name">부서명</label>
            <input readonly type="text" id="부서_name" name="부서_name" value="<?= $부서['부서_name'] ?>"/>
        </p>

        <p>
            <label>해당 부서 국원 수</label>
            <input readonly type="number" id="부서_id" name="부서_id" value="<?= $count ?>"/>
        </p>
    </div>
<? include("footer.php") ?>

