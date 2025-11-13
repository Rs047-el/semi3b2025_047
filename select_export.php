<?php

declare(strict_types=1);
session_start();
require_once 'data.php';

$selected = $_POST['select'] ?? 1;

switch($selected){
    case 1:
        $data = $data1;
        break;
    case 2:
        $data = $data2;
        break;
    default:
        $data = $data1; // デフォルトを設定して安全にする
}
$orders = $data['orders'] ?? [];

foreach ($orders as &$order) {
    $order['amount'] = $order['quantity'] * $order['unitprice'];
    if ($order['taxrate'] == 10) {
        $data['cn10taxamount'] += $order['amount'];
    } else {
        $data['cn8taxamount'] += $order['amount'];
    }
}
unset($order);

$data['cn10total'] = $data['cn10taxamount'] * 1.1;
$data['cn8total'] = $data['cn8taxamount'] * 1.08;
$data['cntaxamount'] = $data['cn10taxamount'] + $data['cn8taxamount'];
$data['subtotal'] = ($data['cn10taxamount'] * 0.1) + ($data['cn8taxamount'] * 0.08);
$data['total'] = ($data['cn10total'] + $data['cn8total']) . '円';
$data['esprice'] = $data['cn10total'] + $data['cn8total'] . '円';

?>
<!DOCTYPE html>
<html lanb="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
    <title>出力形式選択</title>
</head>

<body>
    <?php
    echo '[受注者]<br><table style ="border-spacing: 0; font-size:17px;"><tr><td>' . $data['coname'] . '</td></tr><tr><td>住所:' . $data['coaddress'] . '</td></tr><tr><td>Tell:' . $data['cotel'] . '</td></tr></table>';
    echo '[発注者]<table style ="border-spacing: 0; font-size:17px;"><tr><td>' . $data['clname'] . '</td></tr><tr><td>住所:' . $data['claddress'] . '</td></tr><tr><td>Tell:' . $data['cltel'] . '</td></tr><tr><td>メールアドレス:' . $data['clmaile'] . '</td></tr></table>';
    ?>
    <h3>注文商品一覧</h3>

    <table border="1" style="border-collapse: collapse; width: 100%;">
        <tr>
            <th style="width: 60%;">項目</th>
            <th style="width: 10%;">数量</th>
            <th style="width: 10%;">単価</th>
            <th style="width: 10%;">税率</th>
            <th style="width: 10%;">税抜金額</th>
        </tr>
        <?php
        foreach ($orders as $order) {
            echo '<tr>';
            foreach ($order as $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }
        echo '<table style="width: 100%;">
            <tr>
                <td style="width: 30%; vertical-align: top;">
                    <table border="1" style="border-collapse: collapse; width: 100%;">
                        <tr>
                            <th style="width: 30%">内訳</th>
                            <th style="width: 30%">税抜金額</th>
                            <th style="width: 30%">消費税額</th>
                        </tr>
                        <tr>
                            <td>10%対象）</td>
                            <td>' . $data['cn10taxamount'] . '</td>
                            <td>' . $data['cn10total'] . '</td>
                        </tr>
                        <tr>
                            <td>8%対象）</td>
                            <td>' . $data['cn8taxamount'] . '</td>
                            <td>' . $data['cn8total'] . '</td>
                        </tr>
                    </table>
                </td>
                <td style ="width: 50%;">
                </td>
                <td style="width: 25%; vertical-align: top;">
                    <table border="1" style="width: 100%;">
                        <tr>
                            <td style="width: 50%">小計</td>
                            <td>' . $data['cntaxamount'] . '</td>
                        </tr>
                        <tr>
                            <td>消費税額</td>
                            <td>' . $data['subtotal'] . '</td>
                        </tr>
                        <tr>
                            <td><b>合計</b></td>
                            <td><b>' . $data['total'] . '</b></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>';
        ?>
    </table>
    <h3>出力するデータの選択</h3>
    <form action="select_export.php" method="post">
        <?php
        if($selected == 2){
            echo '<input type="radio" name="select" value="1" />北九';
            echo '<input type="radio" name="select" value="2" checked />福岡';
        } else {
            echo '<input type="radio" name="select" value="1" checked />北九';
            echo '<input type="radio" name="select" value="2" />福岡';
        }
        ?>
        <br>
        <input type="submit" name="a" value="変更" />
    </form>
    <h3>データの出力形式を選択</h3>
    <form action="select_check.php" method="post">
        <input type="radio" name="select" value="e" />Excel
        <input type="radio" name="select" value="p" />PDF
        <br>
        <input type="submit" name="a" value="出力" />
    </form>
</body>

</html>