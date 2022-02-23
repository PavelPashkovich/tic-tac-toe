<?php
$db_link = mysqli_connect("207.180.216.166", "user1", "qwerty12345", 'pavel_pashkovich');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$btn = $_REQUEST['id'] ?? '';
$result = $_REQUEST['result'] ?? '';
$win = $_REQUEST['win'] ?? '';

$winningCombination = [
    [ 1, 2, 3 ],
    [ 4, 5, 6 ],
    [ 7, 8, 9 ],
    [ 1, 4, 7 ],
    [ 2, 5, 8 ],
    [ 3, 6, 9 ],
    [ 1, 5, 9 ],
    [ 3, 5, 7 ],
];

if ($result == "X") {
    $result = "O";
    $sql_insert_result = "insert into x_o_game set id = '".$btn."', player_2 = '".$result."'";
    $sql_insert_result_complete = mysqli_query($db_link, $sql_insert_result);
    $sql = 'select id from x_o_game where player_2 is not null';
    $sql_done = mysqli_query($db_link, $sql);
    $arr = [];
    while($row = $sql_done->fetch_array()){
        $arr[] = $row['id'];
    }
    foreach ($winningCombination as $elem) {
        if(in_array($elem[0], $arr) && in_array($elem[1], $arr) && in_array($elem[2], $arr)) {
            $win = "O WIN!";
        }
    }
} else {
    $result = "X";
    $sql_insert_result = "insert into x_o_game set id='".$btn."', player_1 = '".$result."'";
    $sql_insert_result_complete = mysqli_query($db_link, $sql_insert_result);
    $sql = 'select id from x_o_game where player_1 is not null';
    $sql_done = mysqli_query($db_link, $sql);
    $arr = [];
    while($row = $sql_done->fetch_array()){
        $arr[] = $row['id'];
    }
    foreach ($winningCombination as $elem) {
        if(in_array($elem[0], $arr) && in_array($elem[1], $arr) && in_array($elem[2], $arr)) {
            $win = "X WIN!";
        }
    }
}

$array = json_encode(['result' => $result, 'win' => $win]);
echo $array;

