<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select *
    from 장비
    inner join 장비종류 on 장비종류.장비종류_id = 장비.장비종류_id
    ";
    
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where 장비_name like '%$search_keyword%'or 장비종류_name like '%$search_keyword%'";
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>장비종류</th>
            <th>장비이름</th>
            <th>장비가격</th>
            <th>대여현황</th>
            <th>대여/반납</th>
    		<th>수정/삭제</th>
    		
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['장비종류_name']}</td>";
            echo "<td><a href='장비_view.php?장비_id={$row['장비_id']}'>{$row['장비_name']}</a></td>";
        	echo "<td>{$row['장비_price']}</td>";
            echo "<td><a href='대여현황_view.php?장비_id={$row['장비_id']}'>{$row['대여현황']}</a></td>";
            echo "<td width='17%'>
        		<a href='대여_form.php?장비_id={$row['장비_id']}'><button class='button primary small'>대여</button></a>
                <button onclick='javascript:반납Confirm({$row['장비_id']})' class='button danger small'>반납</button>
                </td>";
            echo "<td width='17%'>
                <a href='장비_form.php?장비_id={$row['장비_id']}'><button class='button primary small'>수정</button></a>
                <button onclick='javascript:deleteConfirm({$row['장비_id']})' class='button danger small'>삭제</button>
                </td>";
                
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
   
           function 대여Confirm(대여현황) {
            if (대여현황){   
                alert("이미 대여중인 장비입니다");
                return;
            }else{
               return;
            }
        }
        
           function 대여(장비_id) {
 
                window.location = "대여_form.php?장비_id=" + 장비_id;
           
        }
   
        function deleteConfirm(장비_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "장비_delete.php?장비_id=" + 장비_id;
            }else{   //취소
                return;
            }
        }
         function 반납Confirm(장비_id) {
                window.location = "반납_form.php?장비_id=" + 장비_id;
        }
        
        
    </script>

</div>
<? include("footer.php") ?>
