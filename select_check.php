<?php

declare(strict_types=1);
session_start();

$select = $_POST['select'];
if ($select == 'p') {
   header('Location:pdf_export.php');
} elseif ($select == 'e') {
   header('Location:excel_export.php');
}
exit();
