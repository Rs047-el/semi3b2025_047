<?php
declare(strict_types=1);
session_start();
?>
<!DOCTYPE html>
<html lanb="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
    <title>ログイン</title>
</head>

<body>
    <form action="login_check.php" method="post">
        <table class="table table-hover">
            <tr>
                <td>ユーザ名：</td>
                <td><input type="text" name="uid"></td>
            </tr>
            <tr>
                <td>パスワード：</td>
                <td><input type="password" name="pass"></td>
            </tr>
        </table>
        <input type="submit" value="送信" >
        <input type="reset" value="取消" >
    </form>
</body>
</html>