<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ログイン</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>ログイン</h1>
    <form action="" method="POST">
      ＩＤ:<input type="text" name="member_id" value="">
      <br>
      パスワード:<input type="password" name="password" id="password" value="">
      <br>
      <input type="checkbox" id="password-check">パスワードを表示化する
      <br>
      <script>
        const pwd = document.getElementById('password');
        const pwdCheck = document.getElementById('password-check');
        pwdCheck.addEventListener('change', function() {
            if(pwdCheck.checked) {
                pwd.setAttribute('type', 'text');
            } else {
                pwd.setAttribute('type', 'password');
            }
        }, false);
        </script> 
      <input type="submit" name="submit" value="ログイン" class="link">
      <input type="reset" name="reset" value="取り消し" class="link">
    </form>
    <h6>まだ登録してない方は<a href="new_pepole.php">こちら</a></h6>
  </body>
</html>
<?php
  if($_POST){
    require_once('PDO.php');
    $sql = 'SELECT * FROM member WHERE member_id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$_POST['member_id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!isset($row['member_id'])) {
      echo 'メールアドレス又はパスワードが間違っています。';
      return false;
    }
    if($_POST['member_id']==$row['member_id'] && $_POST['password']==$row['password']){
      session_start();
      session_regenerate_id(true); 
      $_SESSION['member_name'] = $row['member_name'];
      $_SESSION['member_id']=$row['member_id'];
      $_SESSION['birthday']=$row['birthday'];
      $_SESSION['gender'] = $row['gender'];
      echo 'ログインされました<a href="main_sulezul.php">メイン画面へ</a>';
  } else{
      echo 'ログイン失敗';
  }
  }
?>
