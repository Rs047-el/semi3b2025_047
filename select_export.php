<?php

declare(strict_types=1);
session_start();

$orders = [
    [
        'order' => 'ホワイトボード', //項目
        'quantity' => 1, //数量
        'unitprice' => 11980, //単価
        'taxrate' => 10, //税率
        'amount' => 0 //税抜き金額
    ],
    [
        'order' => 'マーカー（黒）', //項目
        'quantity' => 100, //数量
        'unitprice' => 132, //単価
        'taxrate' => 10, //税率
        'amount' => 0 //税抜き金額
    ],
    [
        'order' => 'マーカー（赤）', //項目
        'quantity' => 50, //数量
        'unitprice' => 132, //単価
        'taxrate' => 10, //税率
        'amount' => 0 //税抜き金額
    ],
    [
        'order' => 'マーカー（青）', //項目
        'quantity' => 50, //数量
        'unitprice' => 132, //単価
        'taxrate' => 10, //税率
        'amount' => 0 //税抜き金額
    ],
    [
        'order' => 'プリント用紙（A4）500枚x10冊', //項目
        'quantity' => 10, //数量
        'unitprice' => 3890, //単価
        'taxrate' => 10, //税率
        'amount' => 0 //税抜き金額
    ],
    [
        'order' => 'プリンターインク（4色セット）', //項目
        'quantity' => 100, //数量
        'unitprice' => 4102, //単価
        'taxrate' => 10, //税率
        'amount' => 0 //税抜き金額
    ]
];

$data = [
    'coname' => '北九', //受注者名
    'coaddress' => '福岡県北九州市', //受注者住所
    'cotel' => '092-8765-4321', //受注者TEL
    'no' => 1, //ナンバー
    'day' => '2025/7/2', //発行日
    'esprice' => '',
    'deadline' => '2025/7/28', //期限
    'clname' => '九州産業', //発注者名
    'claddress' => '福岡県福岡市東区', //発注者住所
    'cltel' => '092-1234-5678', //発注者TEL
    'clmaile' => 'kyusan*******@kyusan.ac.jp', //発注者メールアドレス
    'cn10taxamount' => 0, //消費税10％ 税抜合計
    'cn10total' => 0,
    'cn8taxamount' => 0, //消費税8％ 税抜合計
    'cn8total' => 0,
    'cntaxamount' => 0, //小計 
    'subtotal' => 0, //消費税額
    'total'  => '', //合計
    'remarks'  => '特になし', //備考
    'orders' => $orders1
];

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