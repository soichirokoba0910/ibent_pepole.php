<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>イベント登録ページ</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>ライブ追加</h1>
  <div id ="main">
    <form method="POST" action=<?php if($_POST) {
      if(!(empty($_POST['live_name'])||empty($_POST['live_id']))){
        echo "live_text.php";}}?>>    
      <p>ライブ名</p>
      <input type="text" name="live_name" value="<?php  if($_POST) echo $_POST['live_name'] ?>">
      <p>ライブＩＤ</p>
      <input type="text" name="live_id" value="<?php  if($_POST) echo $_POST['live_id'] ?>">
      <br>
      <?php  if($_POST){
        if(empty($_POST['live_name'])||empty($_POST['live_id'])){
          echo "※入力されてません";         
        }
      } 
      ?>
      <div class="sub">
        <p>半角英数字でお願いいたします</p>
        <p>入力例:20200203A→2020年02月03日のＡ日程</p>
        <p>ＩＤが被らないように英語で日程を換えてください</p>
      </div>
        <input class="bottom" type="submit" name="submit" value="追加">
        <input class="bottom" type="reset" name="reset" value="リセット">
    </form>
  </div>
  <a href="live_text.php">ライブ一覧へ</a>
</body>
</html>
