<?php

declare(strict_types=1);

$select = $_POST['select'];
session_start();
if ($select == 'p') {
   header('Location:pdf_export.php');
} elseif ($select == 'e') {
   header('Location:excel_export.php');
}
exit();
