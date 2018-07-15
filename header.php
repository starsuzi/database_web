<!DOCTYPE html>
<html lang='ko'>
<head>
    <title>KUTV</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="장비_list.php" method="post">
    <div class='navbar fixed'>
        <div class='container'>
            <a class='pull-left title' href="index.php">KUTV 장비관리</a>
            <ul class='pull-right'>
                <li>
                    <input type="text" name="search_keyword" placeholder="KUTV 장비검색">
                </li>
                <li><a href='장비_list.php'>장비 목록</a></li>
                <li><a href='장비_form.php'>장비 등록</a></li>
                <li><a href='대여_list.php'>대여/반납</a></li>
                <li><a href='국원_form.php'>국원 등록</a></li>           
                <li><a href='국원_list.php'>국원 목록</a></li>
                
            </ul>
        </div>
    </div>
</form>