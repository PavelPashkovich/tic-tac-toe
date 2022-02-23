<?php
$db_link = mysqli_connect("207.180.216.166", "user1", "qwerty12345", 'pavel_pashkovich');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$sql = 'select id, player_1, player_2 from x_o_game';
$sql_player1 = mysqli_query($db_link, $sql);
$arr = [];
while($row = $sql_player1->fetch_array()){
    if($row['player_1']) {
        $arr[$row['id']] = $row['player_1'];
    }
    if($row['player_2']) {
        $arr[$row['id']] = $row['player_2'];
    }

}
//print_r($arr);
//foreach($arr as $key=>$value) {
//    echo $key.'<br>';
//}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style-ttt.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Tic Tac Toe</title>
</head>
<body>
    <div class="container">
            <?php
            for ($i = 1; $i <= 9; $i++) {
                ?>
                <div><button class="button" id="<?php echo $i;?>" name="btn_<?php echo $i;?>"

                             onclick="onclick_fn(<?php echo $i;?>)">

                        <?php if(isset($arr[$i])) {
                            echo $arr[$i];

                        }?>
                    </button></div>
                <?php
            }
            ?>
            <button class="reset-btn" id="reset-btn" name="reset" onclick="onclick_f()" value="reset">reset</button>

        <div id="result" hidden></div>
        <div id="win"></div>
    </div>

    <script>
        function onclick_fn(i) {
            let data = {id: i, result: document.getElementById('result').innerHTML, win: document.getElementById('win').innerHTML};

            jQuery.ajax({
                type: "GET",
                url: 'result.php',
                data: data,
                success: function (response) {
                    let response_parsed = JSON.parse(response);
                    let button = document.getElementById(`${i}`);
                    let result = document.getElementById('result');
                    let win = document.getElementById('win');
                    button.innerHTML = response_parsed.result;
                    result.innerHTML = response_parsed.result;
                    win.innerHTML = response_parsed.win;
                }
            });
            // location.reload();
        }
    </script>

    <script>
        function onclick_f() {
            let reset_data = {reset: 'reset'};

            jQuery.ajax({
                type: "GET",
                url: 'reset.php',
                data: reset_data,
                success: function (response) {
                    let response_parsed = JSON.parse(response);
                    let button = document.getElementsByClassName('button');
                    let result = document.getElementById('result');
                    button.innerHTML = response_parsed.result;
                    result.innerHTML = response_parsed.result;
                }
            });
            location.reload();
        }
    </script>

</body>
</html>
