<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select 대여목록.국원_학번, 장비.장비_name, 대여목록.빌린_datetime, 대여목록.반납_datetime, 장비.장비_id, 국원.국원_name, 대여목록.대여_id
    from 대여목록
    left join 장비 on 대여목록.장비_id = 장비.장비_id
    inner join 국원 on 국원.국원_학번 = 대여목록.국원_학번
    ";
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>대여국원</th>
            <th>장비이름</th>
            <th>대여날짜</th>
            <th>반납날짜</th>
            <th>삭제</th>

    		
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['국원_name']}</td>";
            echo "<td>{$row['장비_name']}</td>";
            echo "<td>{$row['빌린_datetime']}</td>";
            echo "<td>{$row['반납_datetime']}</td>";
            echo "<td width='17%'>
                 <button onclick='javascript: 대여_rowDelete({$row['대여_id']})' class='button danger small'>삭제</button>
                </td>";            
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        	function 대여_rowDelete (대여_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "대여_rowDelete.php?대여_id=" + 대여_id;
            }else{   //취소
                return;
            }
        }
        
        
    	
    </script>
    

</div>
<? include("footer.php") ?>
