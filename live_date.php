<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ライブ登録</title>
  <link rel="stylesheet" href="style.css">
  <style>
    table{width: 1000px; margin-left: auto;margin-right: auto;}
  </style>
</head>
<body>
  <?php 
    require_once('PDO.php');
    $stmt=$dbh->query("SELECT * FROM formation");
    $date="";
    foreach ($stmt as $row) {
      $date .='<tr><td>'.$row['day'].'</td>';
      $date .='<td>'.$row['start'].'～'.$row['end'].'</td>';
      $date .='<td> <a href="band_date.php?id='.$row['id'].'">'.$row['live_name'].'</a></td>';
      $date .='<td>'.$row['band_name'].'</td>';
      $date .='<td>'.$row['place'].'</td>';
      $date .='<td>'.$row['contect'].'</td>';
      $date .='<td><a href="update.php?id='.$row['id'].'">更新</a></td>';
      $date .='<td><a href="delete.php?id='.$row['id'].'">削除</a></td></tr>';
    }
    $date='<table border="1"><tr><th>開催日</th><th>開催時間</th><th>ライブ名</th><th>出演バンド名</th><th>開催場所</th><th>内容</th><th>更新</th><th>削除</th></tr>'.$date.'</table>';
    echo '<h1>開催予定ライブ一覧表</h1>';
    echo $date;
  ?>
  <a href="main_sulezul.php">戻る</a>
</body>
</html>
