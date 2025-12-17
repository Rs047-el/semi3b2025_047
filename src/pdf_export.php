<?php
$data = $_SESSION['data'] ?? [];
$u_data = $_SESSION['u_data'] ?? [];
$orders = $_SESSION['orders'] ?? [];

// セッションに必要な情報が揃っているかチェック
if (empty($data) || empty($u_data) || !is_array($orders)) 
{
    throw new RuntimeException('必要な見積データがセッション内にありません。');
}

// 出力用のHTMLエスケープ関数
function h(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

$mpdf = new \Mpdf\Mpdf([
    'tempDir' => __DIR__ . '/tmp',
    'mode' => 'ja',
    'format' => 'A4',
    'orientation' => 'P',
]);

$html = <<<HTML
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
</head>
<title>date_pdf</title>

<body>
    <h1>    
        <div style="text-align: center;">見積書</div>
    </h1><br>
    <table style ="border-spacing: 0; font-size:17px;"><tr><td>$data[coname]</td></tr><tr><td>住所:$data[coaddress]</td></tr><tr><td>Tell:$data[cotel]</td></tr></table>
    <div style="text-align: right;">No:$data[no]</div><br>
    <div style="text-align: right;">発行日:$data[day]</div><br><br>
    <table style="width: 20%; margin-left: auto; margin-right: 0; border-spacing: 0; font-size:17px;"><tr><td>$u_data[clname]<td></tr><tr><td>住所:$u_data[claddress]</td></tr><tr><td>Tell:$u_data[cltel]</td></tr><tr><td>E-mail:$u_data[clmaile]</td></tr></table><br>
    <h2><u>お見積り金額:$data[total]</u><br>
    <b><u>有効期限：$data[deadline]</u></b></h2><br>
    <table border="1" style="border-collapse: collapse; width: 100%;">
        <tr>
            <th style="width: 60%;">項目</th>
            <th style="width: 10%;">数量</th>
            <th style="width: 10%;">単価</th>
            <th style="width: 10%;">税率</th>a
            <th style="width: 10%;">税抜金額</th>
        </tr>
HTML;
for ($i = 0; $i < 16; $i++) 
{
    if (isset($orders[$i]) && $orders[$i]) 
    {
        $order = $orders[$i];
        $html .= <<<HTML
        <tr>
            <td>$order[order]</td>
            <td>$order[quantity]</td>
            <td>$order[unitprice]</td>
            <td>$order[taxrate]</td>
            <td>$order[amount]</td>
        </tr>
        HTML;
    } 
    else 
    {
        $html .= <<<HTML
        <tr>
            <td>　</td>
            <td>　</td>
            <td>　</td>
            <td>　</td>
            <td>　</td>
            </tr>
        HTML;
    }
}
$html .= <<<HTML
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
                            <td>$data[cn10taxamount]</td>
                            <td>$data[cn10total]</td>
                        </tr>
                        <tr>
                            <td>8%対象）</td>
                            <td>$data[cn8taxamount]</td>
                            <td>$data[cn8total]</td>
                        </tr>
                    </table>
                </td>
                <td style ="width: 50%;">
                </td>
                <td style="width: 25%; vertical-align: top;">
                    <table border="1" style="width: 100%;">
                        <tr>
                            <td style="width: 50%">小計</td>
                            <td>$data[cntaxamount]</td>
                        </tr>
                        <tr>
                            <td>消費税額</td>
                            <td>$data[subtotal]</td>
                        </tr>
                        <tr>
                            <td><b>合計</b></td>
                            <td><b>$data[total]</b></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br>
        <table border="1" style="border-collapse: collapse; width: 100%;">
            <tr><td style="text-align: center;">備考</td></tr>
            <tr><td>$data[remarks]</td></tr>
        </table>
    </body>
HTML;

$mpdf->WriteHTML($html);
$mpdf->Output(); // ブラウザに表示
exit();
