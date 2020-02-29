<?php
  $user ="jobtest1";
  $pass ="sakiyama0910";

  try{
    $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user,$pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($_POST){
      $sql="INSERT INTO live (live_id,live_name) VALUES (:live_id,:live_name)";
      $stmt=$dbh->prepare($sql);
      $stmt->bindValue(':live_id',$_POST['live_id'],PDO::PARAM_STR);
      $stmt->bindValue(':live_name',$_POST['live_name'],PDO::PARAM_STR);    
      $stmt->execute();
    }
    } catch(PDOException $e){
       echo '接続エラー' . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <title>ライブ登録ページ</title>
</head>
<body>
  <h1>ライブ一覧</h1>
  <table>
    <tr><td>ライブＩＤ</td><td class="cell2">ライブ名</td></tr>
    <?php
        $sql = "SELECT * FROM live";
        $stmt = $dbh->query($sql);
        foreach ($stmt as $row) {
          echo '<tr><td>'.$row['live_id'].'</td><td class="cell2">'.$row['live_name'].'</td><td class="delete"><a href="live_delete.php?live_id='.$row['live_id'].'">削除</a></td></tr>';
        }
    ?>
  </table>
  <a href="live_new.php">戻る</a>
</body>
</html>
