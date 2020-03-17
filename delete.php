<?php
 require_once('PDO.php');
 $stmt = $dbh->prepare("DELETE FROM formation WHERE id=?");
 $stmt ->bindValue('1',$_GET['id'],PDO::PARAM_INT);
 $stmt->execute();
 $dbh=null;
 echo '<p>削除が完了しました</p>';
 echo '<a href="live_date.php">戻る</a>';
?>
