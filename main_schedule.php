
<?php
date_default_timezone_set('Asia/Tokyo');
if (isset($_GET['y'])) {
    $y = $_GET['y'];
} else {
    $y = date('Y');
}
if(isset($_GET['m'])){
  $m = $_GET['m'];
}else {
  $m = date('m');
}

$timestamp = strtotime($y.'-'.$m . '-01');
if ($timestamp === false) {
    $y = date('Y');
    $m =date('m');
    $timestamp = strtotime($y.'-'.$m . '-01');
}
$title = date('Y年', $timestamp);

$prev = date('Y', mktime(0, 0, 0, $m, 1, date('Y', $timestamp)-1));
$next = date('Y', mktime(0, 0, 0, $m, 1, date('Y', $timestamp)+1));

$months='';
for($month=1;$month<=12;$month++){
  $months.='<li><a href="main_sulezul.php?m='.$month.'">'.$month.'月</a></li>';
}
$months='<ul>'.$months.'</ul>';
$daycount = date('t',$timestamp);
$days="";
for($day=1;$day<=$daycount;$day++){
  $days.='<tr><td>'.$day.'日</td><td class="text"></td></tr>';
}
$days ='<table border="1">'.$days.'</table>';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>PHPカレンダー</title>
    <link rel="stylesheet" href="style.css">
    <style>
      ul li{width:100px}
      a{background-color: blueviolet;color: white;width: 100px;padding: 20px;border-radius: 20px;text-decoration: none;}
      table{border-collapse: collapse;margin-left: auto;margin-right: auto;}
      .text{width: 500px;}
    </style>
</head>
<body>
    <div class="container">
        <h3><a href="?y=<?php echo $prev; ?>">&lt;</a> <?php echo $title; ?> <a href="?y=<?php echo $next; ?>">&gt;</a></h3> 
        <?php echo $months;
              echo '<p>'.$m.'月</p>';
              echo $days;
        ?>
    </div>
</body>
</html>
