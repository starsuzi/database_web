<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("장비_id", $_GET)) {
    $장비_id = $_GET["장비_id"];
    $query = "select * from 장비 natural join 장비종류 where 장비_id = $장비_id";
    $res = mysqli_query($conn, $query);
    $장비 = mysqli_fetch_assoc($res);
    if (!$장비) {
        msg("장비가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>상품 정보 상세 보기</h3>

        <p>
            <label for="장비_id">장비 코드</label>
            <input readonly type="text" id="장비_id" name="장비_id" value="<?= $장비['장비_id'] ?>"/>
        </p>

        <p>
            <label for="장비종류_name">장비 종류</label>
            <input readonly type="text" id="장비종류_name" name="장비종류_name" value="<?= $장비['장비종류_name'] ?>"/>
        </p>

        <p>
            <label for="장비_name">장비명</label>
            <input readonly type="text" id="장비_name" name="장비_name" value="<?= $장비['장비_name'] ?>"/>
        </p>

        <p>
            <label for="장비_desc">장비설명</label>
            <textarea readonly id="장비_desc" name="장비_desc" rows="10"><?= $장비['장비_desc'] ?></textarea>
        </p>

        <p>
            <label for="장비_price">장비가격</label>
            <input readonly type="text" id="장비_price" name="장비_price" value="<?= $장비['장비_price'] ?>"/>
        </p>
    </div>
<? include("footer.php") ?>