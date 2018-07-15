<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("장비_id", $_GET)) {
    $장비_id = $_GET["장비_id"];
    $query =  "select * 
    from 장비
    where 장비_id = $장비_id and 장비.대여현황 is not null";

    $res = mysqli_query($conn, $query);
    $장비 = mysqli_fetch_array($res);
    if(!$장비) {
        msg("반납할 장비가 없습니다");
    }
    
    $mode = "반납";
    $action = "장비_반납.php";
}

?>
    <div class="container">
        <form name="반납_form" action="<?=$action?>" method="post" class="fullwidth">
            <input readonly type="hidden" name="장비_id" value="<?=$장비['장비_id']?>"/>

        	
            <h3>장비 <?=$mode?></h3>

            <p>
                <label for="비밀번호">비밀번호</label>
                <input type="number" placeholder="비밀번호를 숫자로 입력" id="비밀번호" name="비밀번호" />
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
					

                    if(document.getElementById("비밀번호").value == "") {
                        alert ("비밀번호를 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>