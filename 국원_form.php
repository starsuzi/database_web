<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "국원_insert.php";

if (array_key_exists("국원_학번", $_GET)) {
    $국원_학번 = $_GET["국원_학번"];
    $query = "select * from 국원 where 국원_학번= $국원_학번";
    $res = mysqli_query($conn, $query);
    $국원 = mysqli_fetch_array($res);
    if(!$국원) {
        msg("국원이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "국원_modify.php";
}

$부서들 = array();

$query = "select * from 부서";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $부서들[$row['부서_id']] = $row['부서_name'];
}
?>
    <div class="container">
        <form name="국원_form" action="<?=$action?>" method="post" class="fullwidth">
		<input type="hidden" name="국원_학번" value="<?=$국원['국원_학번']?>"/>
            <h3>국원 정보 <?=$mode?></h3>
            <p>
                <label for="부서_id">부서</label>
                <select name="부서_id" id="부서_id">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($부서들 as $id => $name) {
                            if($id == $국원['부서_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="기수">기수</label>
                <input type="number" placeholder="정수로 기수 입력" id="기수" name="기수" value="<?=$국원['기수']?>"/>
            </p>            
            <p>
                <label for="국원_학번">학번</label>
                <input type="number" placeholder="학번은 입력 후 수정이 불가능합니다" id="국원_학번" name="국원_학번" value="<?=$국원['국원_학번']?>"/>
            </p>
            <p>
                <label for="국원_name">이름</label>
                <input type="text" placeholder="이름 입력" id="국원_name" name="국원_name" value="<?=$국원['국원_name']?>"/>
            </p>            
            <p>
                <label for="국원_phonenum">전화번호</label>
                <input type="text" placeholder="- 제외하고 01012341234처럼 입력" id="국원_phonenum" name="국원_phonenum" value="<?=$국원['국원_phonenum']?>"/>
            </p>            
            
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("부서").value == "-1") {
                        alert ("부서를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("기수").value == "") {
                        alert ("기수를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("국원_학번").value == "") {
                        alert ("학번을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("국원_name").value == "") {
                        alert ("이름을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("국원_phonenum").value == "") {
                        alert ("전화번호를 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>