<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("장비_id", $_GET)) {
    $장비_id = $_GET["장비_id"];
    $query =  "select * 
    from 장비
    where 장비_id = $장비_id and 장비.대여현황 is null";

    $res = mysqli_query($conn, $query);
    $장비 = mysqli_fetch_array($res);
    if(!$장비) {
        msg("이미 대여중인 장비입니다.");
    }
    
    $mode = "대여";
    $action = "장비_대여.php";
}

?>
    <div class="container">
        <form name="대여_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="장비_id" value="<?=$장비['장비_id']?>"/>
        
            <h3>장비 <?=$mode?></h3>
            <p>
                <label for="국원_학번">대여한 국원</label>
                <input type="number" placeholder="학번 입력" id="국원_학번" name="국원_학번" />
            </p>
            <p>
                <label for="용도">대여 용도</label>
                <textarea placeholder="대여 용도 입력" id="용도" name="용도" rows="10"></textarea>
            </p>
            
            <p>
                <label for="비밀번호">비밀번호</label>
                <input type="number" placeholder="비밀번호를 숫자로 입력" id="비밀번호" name="비밀번호" />
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
					
					if(document.getElementById("국원_학번").value == "") {
                        alert ("학번을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("용도").value == "") {
                        alert ("대여 용도를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("비밀번호").value == "") {
                        alert ("비밀번호를 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>