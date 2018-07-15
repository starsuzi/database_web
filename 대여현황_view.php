<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("장비_id", $_GET)) {
    $장비_id = $_GET["장비_id"];
    $query = "select * from 장비 
    		inner join 대여목록 on 대여목록.장비_id = 장비.장비_id 
    		inner join 국원 on 국원.국원_학번 = 대여목록.국원_학번
    		where 장비.장비_id = $장비_id and 반납_datetime is null";
    		
    $res = mysqli_query($conn, $query);
    $대여장비 = mysqli_fetch_assoc($res);
    if (!$대여장비) {
        msg("대여장비가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>대여현황 상세 보기</h3>


        <p>
            <label for="장비_name">장비명</label>
            <input readonly type="text" id="장비_name" name="장비_name" value="<?= $대여장비['장비_name'] ?>"/>
        </p>
        <p>
            <label for="국원_학번">대여한 국원 학번</label>
            <input readonly type="number" id="국원_학번" name="국원_학번" value="<?= $대여장비['국원_학번'] ?>"/>
        </p>
        <p>
            <label for="국원_name">대여한 국원 이름</label>
            <input readonly type="text" id="국원_name" name="국원_name" value="<?= $대여장비['국원_name'] ?>"/>
        </p>
        <p>
            <label for="국원_phonenum">대여한 국원 번호</label>
            <input readonly type="text" id="국원_phonenum" name="국원_phonenum" value="<?= $대여장비['국원_phonenum'] ?>"/>
        </p>                
        <p>
            <label for="용도">대여 용도</label>
            <textarea readonly id="용도" name="용도" rows="10"><?= $대여장비['용도'] ?></textarea>
        </p>


    </div>
<? include("footer.php") ?>