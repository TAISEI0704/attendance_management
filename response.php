<?php 
    require_once 'vendor/autoload.php'; // Composer のオートロードファイルを読み込む
    use Dotenv\Dotenv;

    // .env ファイルを読み込む
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    require_once('./database.php');

    $database = new Database();
    $records = $database -> find((int)$_GET['id']);
    // // var_dump($records);
?>
 
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>一覧</title>
</head>
<body>
    <h3>返信画面</h3>
    <table border="1">
        <tr>
            <th>園児名</th>
            <th>日付</th>
            <th>出欠</th>
            <th>欠席理由</th>
            <th>返信</th>
        </tr>

        <?php foreach($records as $record){ ?>
        <tr>
            <td><?= $record['child_name']; ?></td>
            <td><?= date('Y/m/d', strtotime($record['date'])); ?></td>
            
            
            <td><?php if ($record['status'] == 1){
                    print '欠席';
                }else{print '出席';}?></td>
            <td><?= $record['absence_reason']; ?></td>
            
            <td><a href="">返信</a></td>
        </tr>
        <?php } ?>
    </table>
    <a href="management.php">管理画面に戻る</a>
</body>
</html>
