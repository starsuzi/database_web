<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from 국원 natural join 부서";
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>부서</th>
            <th>기수</th>
            <th>학번</th>
            <th>이름</th>
            <th>전화번호</th>
            <th>수정/삭제</th>
           
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='부서_view.php?부서_id={$row['부서_id']}'>{$row['부서_name']}</a></td>";
            echo "<td>{$row['기수']}</td>";
            echo "<td>{$row['국원_학번']}</td>";
            echo "<td>{$row['국원_name']}</td>";
            echo "<td>{$row['국원_phonenum']}</td>";
            echo "<td width='17%'>
                <a href='국원_form.php?국원_학번={$row['국원_학번']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['국원_학번']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(국원_학번) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "국원_delete.php?국원_학번=" + 국원_학번;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
