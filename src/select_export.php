<?php
$selected = $_POST['select'] ?? 1;
switch ($selected) {
    case 1:
        $data = $data1;
        break;
    case 2:
        $data = $data2;
        break;
    default:
        $data = $data1;
}
$orders = $_POST['orders'] ?? ($data['orders'] ?? []);
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

$_SESSION['data'] = $data;
$_SESSION['u_data'] = $u_data;
$_SESSION['orders'] = $orders;

?>
<!DOCTYPE html>
<html lanb="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
    <title>出力形式選択</title>
</head>
<style>
    .big-text {
        font-size: 18px;
    }

    .big-text input[type="text"] {
        font-size: 18px;
    }
</style>

<body>
    <h3>登録済みデータを選択</h3>
    <form action="?do=select_export" method="post">
        <?php
        if ($selected == 2) {
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
    <br>
    <div class="big-text">
        <form action="?do=select_export" method="post">
            [受注者]
            <table style="border-spacing:0; font-size:17px;">
                <tr>
                    <td>会社名: <input type="text" name="coname" value="<?= htmlspecialchars($data['coname'] ?? '') ?>"></td>
                </tr>
                <tr>
                    <td>住所: <input type="text" name="coaddress" value="<?= htmlspecialchars($data['coaddress'] ?? '') ?>"></td>
                </tr>
                <tr>
                    <td>Tell: <input type="text" name="cotel" value="<?= htmlspecialchars($data['cotel'] ?? '') ?>"></td>
                </tr>
            </table>
            <br>
            [発注者]
            <table style="border-spacing:0; font-size:17px;">
                <tr>
                    <td>氏名: <input type="text" name="clname" value="<?= htmlspecialchars($u_data['clname'] ?? '') ?>"></td>
                </tr>
                <tr>
                    <td>住所: <input type="text" name="claddress" value="<?= htmlspecialchars($u_data['claddress'] ?? '') ?>"></td>
                </tr>
                <tr>
                    <td>Tell: <input type="text" name="cltel" value="<?= htmlspecialchars($u_data['cltel'] ?? '') ?>"></td>
                </tr>
                <tr>
                    <td>メールアドレス: <input type="text" name="clmaile" value="<?= htmlspecialchars($u_data['clmaile'] ?? '') ?>"></td>
                </tr>
            </table>
            <h3>注文商品一覧</h3>
            <table border="1" style="border-collapse: collapse; width: 100%;">
                <tr>
                    <th style="width: 60%;">項目</th>
                    <th style="width: 10%;">数量</th>
                    <th style="width: 10%;">単価</th>
                    <th style="width: 10%;">税率</th>
                    <th style="width: 10%;">税抜金額</th>
                </tr>
                <?php foreach ($orders as $i => $order) : ?>
                    <tr>
                        <?php foreach ($order as $key => $value) : ?>
                            <td>
                                <input type="text" name="orders[<?= $i ?>][<?= htmlspecialchars($key) ?>]" value="<?= htmlspecialchars($value) ?>" style="width:100%; box-sizing:border-box;">
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
            <table style="width: 100%;">
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
                                <td><?= htmlspecialchars($data['cn10taxamount']) ?></td>
                                <td><?= htmlspecialchars($data['cn10total']) ?></td>
                            </tr>
                            <tr>
                                <td>8%対象）</td>
                                <td><?= htmlspecialchars($data['cn8taxamount']) ?></td>
                                <td><?= htmlspecialchars($data['cn8total']) ?></td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 50%;"></td>
                    <td style="width: 25%; vertical-align: top;">
                        <table border="1" style="width: 100%;">
                            <tr>
                                <td style="width: 50%">小計</td>
                                <td><?= htmlspecialchars($data['cntaxamount']) ?></td>
                            </tr>
                            <tr>
                                <td>消費税額</td>
                                <td><?= htmlspecialchars($data['subtotal']) ?></td>
                            </tr>
                            <tr>
                                <td><b>合計</b></td>
                                <td><b><?= htmlspecialchars($data['total']) ?></b></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br>
            <input type="submit" name="a" value="編集" />
        </form>
    </div>
    <h3>データの出力形式を選択</h3>
    <form action="?do=select_check" method="post">
        <input type="radio" name="select" value="e" />Excel
        <input type="radio" name="select" value="p" />PDF
        <br>
        <input type="submit" name="a" value="出力" />
    </form>
</body>

</html>