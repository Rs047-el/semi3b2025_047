<?php
$select = $_POST['select'];
if ($select == 'p') {
   header('Location:?do=pdf_export');
} elseif ($select == 'e') {
   header('Location:?do=excel_export');
}
exit();
