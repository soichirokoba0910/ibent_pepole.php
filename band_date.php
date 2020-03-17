<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>参加者一覧</title>
    <link rel="stylesheet" href="style.css">
    <style>
      p{color: blueviolet; font-weight:bold;}
      span{color: black; font-size: 20px; }
      .red{color: red;}
    </style>
</head>
<body>

<?php
  require_once('PDO.php');
  if(isset($_GET['id'])||isset($_POST['id'])){
    $id = $_GET['id'];
     } 
  $stmt =$dbh->prepare("SELECT * FROM formation WHERE id=?");
  $stmt->bindValue(1,$id,PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $livename = $result['live_name'];
  echo '<h1>参加者一覧</h1>';
  echo '<p>ライブ名:<span>'.$result['live_name'].'</span></p>';
  echo '<p>開催場所:<span>'.$result['place'].'</span></p>';
  echo  '<p>予定日:<span>'.$result['day'].'</span></p>';
  echo '<p>出演バンド名:<span>'.$result['band_name'].'</span></p>';
  echo '<p>内容:<span>'.$result['contect'].'</span></p>';
  echo '<h2>参加者一覧</h2>';
  $stmt = $dbh->query("SELECT * FROM enter");
  $entry="名前:";
  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    if($result['live_name'] == $livename){
      $entry.=$result['member_name'];
    }
  }
  echo '<a>'.$entry.'</a>';
?>
     <form action="" method="POST">
    <p>参加メンバーに加わりますか？</p>
    <input type="radio" name="entry" value="1">YES
    <input type="radio" name="entry" value="2">NO
    <br>
    <input type="hidden" name="id" value="<?php echo $id;  ?>">
    <input type="submit" name="submit" value="送信">
  </form>
  <a href="main_sulezul.php">戻る</a>
  <?php
   if($_POST){
     $x=0;
     $y=0;
     session_start();
     if(empty($_POST['entry'])){
       echo '<p class="red">※入力してください</p>';
     } else {
       if($_POST['entry'] == 1){
        $stmt =$dbh->query("SELECT * FROM enter");
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
          if(!empty($result)){
            if($result['live_name'] == $livename){
              $y++;
              if($result['member_name'] == $_SESSION['member_name']){
                echo '<p class="red">すでにエントリーメンバーです</p>';
                return false;
              } else{
                $x++;
              }           
            }
          }
        }
        if($x == $y){
          $stmt = $dbh->prepare("INSERT INTO enter (live_name,member_name) VALUES (?,?)");
          $stmt->bindValue(1,$livename,PDO::PARAM_STR);
          $stmt->bindValue(2,$_SESSION['member_name'],PDO::PARAM_STR);
          $stmt->execute();
          echo '<p class="red">エントリーメンバーになりました</p>';
        }        
       }
     }
   }
  ?>
</body>
</html>
