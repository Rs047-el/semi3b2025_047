<?php
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// スプレッドシートオブジェクトを作成
$spreadsheet = IOFactory::load('data/ExcelTemplate.xlsx');

// アクティブなシートを取得
$sheet = $spreadsheet->getActiveSheet();

// データを設定

$data = $_SESSION['data'];
$u_data = $_SESSION['u_data'];
$orders = $_SESSION['orders'];

$config = [
    'coname' => ['B', 4], //受注者名
    'coaddress' => ['C', 5], //受注者住所
    'cotel' => ['C', 6], //受注者TEL
    'no' => ['K', 4], //ナンバー
    'day' => ['K', 5], //発行日
    'esprice' => ['D', 11], //見積金額
    'deadline' => ['D', 12], //期限
    'cn10taxamount' => ['D', 32], //消費税10％ 税抜合計
    'cn10total' => ['E', 32], //消費税10％ 合計
    'cn8taxamount' => ['D', 33], //消費税8％ 税抜合計
    'cn8total' => ['E', 33], //消費税10％ 合計
    'cntaxamount' => ['I', 31], //小計 
    'subtotal' => ['I', 32], //消費税額
    'total'  => ['I', 33], //合計
    'remarks'  => ['B', 36] //備考
];
$uconfig=[
    'clname' => ['G', 7], //発注者名
    'claddress' => ['H', 8], //発注者住所
    'cltel' => ['H', 9], //発注者TEL
    'clmaile' => ['H', 10], //発注者メールアドレス
];
$orconfig = [
    'order' => 'B', //項目
    'quantity' => 'G', //数量
    'unitprice' => 'H', //単価
    'taxrate' => 'J', //税率
    'amount' => 'K' //税抜き金額
];

foreach ($config as $key => $value) {
    //setCellValue([挿入するセル],[データ]);
    $sheet->setCellValue($value[0] . $value[1], $data[$key]);
}
foreach($uconfig as $key => $value){
    $sheet->setCellValue($value[0] . $value[1], $u_data[$key]);
}
for ($i = 0; $i < count($orders); $i++) {
    foreach ($orconfig as $key => $order) {
        $sheet->setCellValue($order . $i + 15, $orders[$i][$key]);
    }
}

// 出力時に余計な出力がないようにバッファをクリア
if (ob_get_length()) {
    ob_end_clean();
}

// HTTPレスポンスヘッダーをセット Content-Type <- 送受信されるデータの種類や形式を指定する
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data_excel.xlsx"');
header('Cache-Control: max-age=0');

// Excelファイルを書き出し
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();
