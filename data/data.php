<?php
$uname = 'kyusan';
$password = '9323';

$orders1 = [
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

$data1 = [
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

$orders2 = [
    [
        'order' => 'モニター', //項目
        'quantity' => 5, //数量
        'unitprice' => 19800, //単価
        'taxrate' => 10, //税率
        'amount' => 0 //税抜き金額
    ],
    [
        'order' => 'LANケーブル', //項目
        'quantity' => 6, //数量
        'unitprice' => 1200, //単価
        'taxrate' => 10, //税率
        'amount' => 0 //税抜き金額
    ],
    [
        'order' => 'USBメモリ', //項目
        'quantity' => 10, //数量
        'unitprice' => 800, //単価
        'taxrate' => 8, //税率
        'amount' => 0 //税抜き金額
    ],
    [
        'order' => 'SDカード', //項目
        'quantity' => 20, //数量
        'unitprice' => 1280, //単価
        'taxrate' => 8, //税率
        'amount' => 0 //税抜き金額
    ],
    [
        'order' => 'USBケーブル', //項目
        'quantity' => 15, //数量
        'unitprice' => 720, //単価
        'taxrate' => 8, //税率
        'amount' => 0 //税抜き金額
    ],
    [
        'order' => 'マウス', //項目
        'quantity' => 5, //数量
        'unitprice' => 1350, //単価
        'taxrate' => 10, //税率
        'amount' => 0 //税抜き金額
    ],
    [
        'order' => 'キーボード', //項目
        'quantity' => 5, //数量
        'unitprice' => 1500, //単価
        'taxrate' => 10, //税率
        'amount' => 0 //税抜き金額
    ]
];

$data2 = [
    'coname' => '福岡', //受注者名
    'coaddress' => '福岡県福岡市博多東区', //受注者住所
    'cotel' => '092-1234-5678', //受注者TEL
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
    'orders' => $orders2
];
?>