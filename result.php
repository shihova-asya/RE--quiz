<html>
<head>
  <meta charset="utf-8">
  <title>Результаты</title>
</head>
<body bgcolor="#FFDEAD">
<?php
  echo 'Количество правильных ответов: ';
  $count = $_GET['count'];
  echo $count.' , ';
  $all_used_time = $_GET['all_used_time'];
  echo 'время (в секундах): ';
  echo $all_used_time;  
?>
<br><br><a href="start.php">Ещё разок?</a>
</body>
</html>