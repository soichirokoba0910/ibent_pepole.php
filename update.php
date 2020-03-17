<?php
 require('PDO.php');
 if(isset($_GET['id'])){
   $id =$_GET['id'];
 }
if($_POST){
  function links($link){
    if(empty($link)){
      echo '<p>※入力してください</p>';
      return ;
    }
  }
}
 $stmt =$dbh->prepare("SELECT * FROM formation WHERE id=?");
 $stmt->bindValue(1,$_GET['id'],PDO::PARAM_INT);
 $stmt->execute();
 $result = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ライブ登録</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .red{color: red;}
  </style>
</head>
<body>
  <h1>ライブ更新表</h1>
  <form method="POST" action="">
    ライブ名:<input type="text" name="live_name" value="<?php echo $result['live_name']  ?>" >
    <?php if($_POST) links($_POST['live_name']); ?>
    <br>
    場所:<input type="text" name="place" value="<?php echo $result['place'];  ?>">
    <br>
    <?php if($_POST) links($_POST['place']); ?>
    日にち:<input type="date" name="day" value="<?php echo $result['day'] ?>">
    <br>
    <?php if($_POST) links($_POST['day']); ?>
    時間:<input type="time" name="start" value="<?php echo $result['start'] ?>">～
         <input type="time" name="end" value="<?php echo $result['end'] ?>">
         <?php 
          if($_POST){
            $start =strtotime($_POST['start']);
            $end =strtotime($_POST['end']);
            if($start>$end){
              echo '<p>※時間を確認してください</p>';
            }
          }
         ?>
    <br>
    <?php if($_POST) {
        links($_POST['start']);
        links($_POST['end']);
    } ?>
    
    バンド名:<select name="band_name" >
             </select>
    <br>
    バンド名:<input type="text" name="band_name" value="<?php echo $result['band_name'];  ?>">
    <br>
    <?php if($_POST) links($_POST['band_name']); ?>
    内容:<br>
    <textarea name="contect" rows="10" cols="40">
    <?php  echo $result['contect'] ?>
    </textarea>
    <br>
    <?php if($_POST) links($_POST['contect']); ?>
    <input type="submit" value="登録する" class="link">
    <input type="reset" value="リセット" class="link">
  </form>
  <?php
     if($_POST){
      if(empty($_POST['live_name'])||empty($_POST['place'])||empty($_POST['start'])||empty($_POST['end'])||empty($_POST['band_name'])||empty($_POST['contect'])||empty($_POST['day'])){
        return false;
      } else {
       $sql = "UPDATE formation SET live_name = ?, place= ?, start = ?, end = ?, band_name = ?, contect = ?,day = ? WHERE id = ?";
       $stmt = $dbh->prepare($sql);
       $stmt->bindValue(1,$_POST['live_name'],PDO::PARAM_STR);
       $stmt->bindValue(2,$_POST['place'],PDO::PARAM_STR);
       $stmt->bindValue(3,$_POST['start'],PDO::PARAM_STR);
       $stmt->bindValue(4,$_POST['end'],PDO::PARAM_STR);
       $stmt->bindValue(5,$_POST['band_name'],PDO::PARAM_STR);
       $stmt->bindValue(6,$_POST['contect'],PDO::PARAM_STR);
       $stmt->bindValue(7,$_POST['day'],PDO::PARAM_STR);
       $stmt->bindValue(8,$id,PDO::PARAM_STR);
       $stmt->execute();
       $dbh =null;
       function dainyuu($name,$table,$caram){
         require('PDO.php');
         $stmt=$dbh->query("SELECT * FROM $table");
         while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ){
           if(!empty($row['band_name'])){
            if($row['band_name'] == $name){
              return false;
            }
           }
         }
         $stmt = $dbh->prepare("INSERT INTO $table ($caram) VALUES (?)");
         $stmt->bindValue(1,$name,PDO::PARAM_STR);
         $stmt ->execute();
         $dbh = null;
       }
       dainyuu($_POST['band_name'],'band','band_name');
       echo '<p>更新が完了しました</p>';
      }
     }
    ?>
     <a href="main_sulezul.php">戻る</a>
  </body>
 </html>
