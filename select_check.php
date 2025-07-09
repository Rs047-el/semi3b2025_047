<?php
$select = $_POST['select'];
session_start();

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
   'remarks'  => '特になし' //備考
];

$orders = [
   [
      'order' => 'あれ', //項目
      'quantity' => 3, //数量
      'unitprice' => 500, //単価
      'taxrate' => 10, //税率
      'amount' => 0 //税抜き金額
   ],
   [
      'order' => 'それ', //項目
      'quantity' => 6, //数量
      'unitprice' => 650, //単価
      'taxrate' => 10, //税率
      'amount' => 0 //税抜き金額
   ],
   [
      'order' => 'これ', //項目
      'quantity' => 10, //数量
      'unitprice' => 1000, //単価
      'taxrate' => 8, //税率
      'amount' => 0 //税抜き金額
   ],
   [
      'order' => 'それら', //項目
      'quantity' => 20, //数量
      'unitprice' => 750, //単価
      'taxrate' => 8, //税率
      'amount' => 0 //税抜き金額
   ],
   [
      'order' => 'これら', //項目
      'quantity' => 15, //数量
      'unitprice' => 200, //単価
      'taxrate' => 8, //税率
      'amount' => 0 //税抜き金額
   ],
   [
      'order' => 'あれら', //項目
      'quantity' => 3, //数量
      'unitprice' => 1500, //単価
      'taxrate' => 10, //税率
      'amount' => 0 //税抜き金額
   ]
];

for ($i = 0; $i < count($orders); $i++) {
   $orders[$i]['amount'] = $orders[$i]['quantity'] * $orders[$i]['unitprice'];
   if ($orders[$i]['taxrate'] == 10) {
      $data['cn10taxamount'] += $orders[$i]['amount'];
   } else {
      $data['cn8taxamount'] += $orders[$i]['amount'];
   }
}

$data['cn10total'] = $data['cn10taxamount'] * 1.1;
$data['cn8total'] = $data['cn8taxamount'] * 1.08;
$data['cntaxamount'] = $data['cn10taxamount'] + $data['cn8taxamount'];
$data['subtotal'] = ($data['cn10taxamount'] * 0.1) + ($data['cn8taxamount'] * 0.08);
$data['total'] = ($data['cn10total'] + $data['cn8total']) . '円';
$data['esprice'] = $data['cn10total'] + $data['cn8total'] . '円';

$_SESSION['data'] = $data;
$_SESSION['orders'] = $orders;

if ($select == 'p') {
   header('Location:pdf_export.php');
} else if ($select == 'e') {
   header('Location:excel_export.php');
}
exit();
?>