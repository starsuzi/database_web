<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "장비_insert.php";

if (array_key_exists("장비_id", $_GET)) {
    $장비_id = $_GET["장비_id"];
    $query =  "select * from 장비 where 장비_id = $장비_id";
    $res = mysqli_query($conn, $query);
    $장비 = mysqli_fetch_array($res);
    if(!$장비) {
        msg("장비가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "장비_modify.php";
}

$장비종류들 = array();

$query = "select * from 장비종류";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $장비종류들[$row['장비종류_id']] = $row['장비종류_name'];
}
?>
    <div class="container">
        <form name="장비_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="장비_id" value="<?=$장비['장비_id']?>"/>
            <h3>장비 정보 <?=$mode?></h3>
            <p>
                <label for="장비종류_id">장비종류</label>
                <select name="장비종류_id" id="장비종류_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($장비종류들 as $id => $name) {
                            if($id == $장비['장비종류_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="장비_name">장비명</label>
                <input type="text" placeholder="장비명 입력" id="장비_name" name="장비_name" value="<?=$장비['장비_name']?>"/>
            </p>
            <p>
                <label for="장비_desc">장비설명</label>
                <textarea placeholder="장비설명 입력" id="장비_desc" name="장비_desc" rows="10"><?=$장비['장비_desc']?></textarea>
            </p>
            <p>
                <label for="price">가격</label>
                <input type="text" placeholder="가격을 입력" id="장비_price" name="장비_price" value="<?=$장비['장비_price']?>" />
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("장비종류_id").value == "-1") {
                        alert ("장비종류를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("장비_name").value == "") {
                        alert ("장비명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("장비_desc").value == "") {
                        alert ("장비설명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("장비_price").value == "") {
                        alert ("가격을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>