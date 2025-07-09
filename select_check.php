<?php
$select = $_POST['select'];
session_start();
if ($select == 'p') {
   header('Location:pdf_export.php');
} else if ($select == 'e') {
   header('Location:excel_export.php');
}
exit();
?>