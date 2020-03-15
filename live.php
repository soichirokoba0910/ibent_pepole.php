<?php
  require_once('PDO.php');
  if($_POST){
    function links($link){
      if(empty($link)){
        echo '<p>※入力してください</p>';
        return ;
      }
    }
  }
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
  <h1>ライブ登録表</h1>
  <form method="POST" action="">
    ライブ名:<input type="text" name="live_name" value="<?php  if($_POST){ if(!empty($_POST['live_name'])){ echo $_POST['live_name']; } } ?>" >
    <?php if($_POST) links($_POST['live_name']); ?>
    <br>
    場所:<input type="text" name="place" value="<?php  if($_POST){ if(!empty($_POST['place'])){ echo $_POST['place']; } } ?>">
    <br>
    <?php if($_POST) links($_POST['place']); ?>
    日にち:<input type="date" name="day" value="<?php  if($_POST){ if(!empty($_POST['day'])){ echo $_POST['day']; } } 
        if($_GET['m'] && $_GET['y'] && $_GET['day']){echo date('Y-m-d',mktime(0, 0, 0, $_GET['m'], $_GET['day'], $_GET['y']));} ?>">
    <br>
    <?php if($_POST) links($_POST['day']); ?>
    時間:<input type="time" name="start" value="<?php  if($_POST){ if(!empty($_POST['start'])){ echo $_POST['start']; } } ?>">～
         <input type="time" name="end" value="<?php  if($_POST){ if(!empty($_POST['end'])){ echo $_POST['end']; } } ?>">
    <br>
    <?php if($_POST) {
        links($_POST['start']);
        links($_POST['end']);
    } ?>
    バンド名:<select name="band_name" >
             </select>
    <br>
    <a class="red">※選択肢にない場合はこちら</a>
    バンド名:<input type="text" name="band_name" value="<?php  if($_POST){ if(!empty($_POST['band_name'])){ echo $_POST['band_name']; } } ?>">
    <br>
    <?php if($_POST) links($_POST['band_name']); ?>
    内容:<br>
    <textarea name="contect" rows="10" cols="40" value="<?php  if($_POST){ if(!empty($_POST['contect'])){ echo $_POST['contect']; } } ?>"></textarea>
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
     $stmt =$dbh->prepare("INSERT INTO formation (live_name,place,start,end,band_name,contect,day) VALUES (?,?,?,?,?,?,?)");
     $stmt->bindValue(1,$_POST['live_name'],PDO::PARAM_STR);
     $stmt->bindValue(2,$_POST['place'],PDO::PARAM_STR);
     $stmt->bindValue(3,$_POST['start'],PDO::PARAM_STR);
     $stmt->bindValue(4,$_POST['end'],PDO::PARAM_STR);
     $stmt->bindValue(5,$_POST['band_name'],PDO::PARAM_STR);
     $stmt->bindValue(6,$_POST['contect'],PDO::PARAM_STR);
     $stmt->bindValue(7,$_POST['day'],PDO::PARAM_STR);
     $stmt->execute();
     $dbh =null;     
     echo '<p>登録が完了しました</p>';
    }
   }
  ?>
   <a href="main_sulezul.php">戻る</a>
</body>
</html>
