<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>登録サイト</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php 
    function lists($list){
        if(!empty($list)){
          return $list;
        }
    }
  ?>
  <h1>新規登録サイト</h1>
  <form method="POST" action="">
    お名前:<input type="text" name="member_name" value="<?php if($_POST)  echo lists($_POST['member_name']) ?>">
    <br>
    生年月日:<input type="date" name="birthday" value="<?php   if($_POST)  echo lists($_POST['birthday']) ?>">
    <br>
    メールアドレス:<input type="text" name="mail" value="<?php  if($_POST) echo lists($_POST['mail']) ?>">
    <br>
    ID:<input type="text" name="member_id" value="<?php   if($_POST) echo lists($_POST['member_id']) ?>">
    <br>
    パスワード:<input type="password" name="pass1" value="">
    <br>
    パスワード(確認用):<input type="password" name="pass2" value="">
    <br>
   <input type="submit" name="submit" value="登録" class="link">
   <input type="reset" name="reset"  value="リセット" class="link"> 
  </form>
  <div class="color1">
    <p>正式なアドレスを送りください</p>
    <p>IDは半角英数字をそれぞれ5文字以上含んだ8文字以上で設定してください</p>
    <p>パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください</p>
  </div>
    <?php 
      if($_POST){
        if(empty($_POST['member_name'])){
          echo '<p>※名前を入力してください</p>';
          return false;
        }
        if(empty($_POST['birthday'])){
          echo '<p>※生年月日を入力してください</p>';
          return false;
        }
        if(empty($_POST['mail'])){
          echo '<p>※メールアドレスを入力してください</p>';
          return false;
        } elseif(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
          echo '<p>※正式なメールアドレスを入力してください</p>';
          return false;
        }
        if(empty($_POST['member_id'])){
          echo '<p>※IDを入力してください</p>';
          return false;
        } elseif(!(preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{5,100}+\z/i', $_POST['member_id']))){
          echo '<p>※IDは半角英数字をそれぞれ1文字以上含んだ5文字以上で設定してください</p>';
          return false;
        }
        if (empty($_POST['pass1'])||empty($_POST['pass2'])) {
            echo '<p>※パスワードを入力してください</p>';
            ;
            return false;
        }
       
          if (!(preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{5,100}+\z/i', $_POST['pass1']))||!(preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{5,100}+\z/i', $_POST['pass2']))) {
              echo '<p>※パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください</p>';
              return false;
          }
        if(!$_POST['pass1']==$_POST['pass2']){
          echo '<p>※パスワードが異なります</p>';
          return false;
        }
        require_once('PDO.php');
        function h($s) {
          return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
        }
        $stmt =$dbh->prepare("INSERT INTO member (member_name,birthday,mail,member_id,password) VALUES (?,?,?,?,?)");
        $stmt->bindValue(1,$_POST['member_name'],PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST['birthday'],PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST['mail'],PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST['member_id'],PDO::PARAM_STR);
        $stmt->bindValue(5,$_POST['pass1'],PDO::PARAM_STR);
        $stmt->execute();
        session_start();
        session_regenerate_id(true); 
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['nameid']=$_POST['id'];
        $_SESSION['birthday'] = $_POST['birthday'];
        $dbh =null;     
        echo '登録が完了しました<br>';
        echo h('<a herf="#">XXXXXX</a>');
      }
    ?>
</body>
</html>
