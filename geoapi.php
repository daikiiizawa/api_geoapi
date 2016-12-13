<?php
error_reporting(E_ALL & ~E_NOTICE);
$keyword = '';
$data['location'] = array();

//郵便番号
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $keyword = $_POST['keyword'];
    $url = 'http://geoapi.heartrails.com/api/xml?method=suggest&matching=like&keyword='.$keyword;
    $xml = simplexml_load_file($url);
    $data = get_object_vars($xml);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>APIを用いた住所検索</title>
    <meta charset="UTF-8">
</head>

<body>
    <form action="" method="post">
        <input type="text" name='keyword' value='<?php echo $keyword;?>'><br>
        <input type="submit" value="住所検索"><br>
    </form>

    <?php if ($data['error']) :?>
        <?php echo '該当データなし';?>
    <?php elseif ($keyword || !$data) :?>
        <?php foreach($data['location'] as $data['location']) :?>
            <ul>
                <li><?php echo $data['location']->prefecture;?></li>
                <li><?php echo $data['location']->city;?></li>
                <li><?php echo $data['location']->town;?></li>
                <li>
                <form action="place.php" method="post" target="_blank">
                    <input type="hidden" name="x" value=<?php echo $data['location']->x; ?>>
                    <input type="hidden" name="y" value=<?php echo $data['location']->y; ?>>
                    <input type="hidden" name="town" value=<?php echo $data['location']->town; ?>>
                    <input type="submit" value="周辺地図を表示 (半径500m)" style="border:none;background-color:transparent;color:#0000FF;cursor:pointer;">
                </form>
                </li>
            </ul>
        <?php endforeach;?>
    <?php endif;?>
</body>
</html>