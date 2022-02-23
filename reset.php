<?php
$db_link = mysqli_connect("207.180.216.166", "user1", "qwerty12345", 'pavel_pashkovich');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$reset = $_REQUEST['reset'] ?? '';
$result = '';
if ($reset === 'reset') {
    $sql_reset = "delete from x_o_game";
    $sql_reset_complete = mysqli_query($db_link, $sql_reset);
}

$array = json_encode(['result' => $result]);
echo $array;