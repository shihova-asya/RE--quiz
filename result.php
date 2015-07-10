<html>
<head>
  <meta charset="utf-8">
  <title>Результаты</title>
</head>
<body bgcolor="#87CEFF">
<?php
  echo 'Количество правильных ответов: ';
  $count = 0; 
  if ($_GET['first_answer'] == 'true')
    $count++; 
  if ($_GET['second_answer'] == 'true')
    $count++; 
  if ($_GET['third_answer'] == 'true')
    $count++;
  if ($_GET['forth_answer'] == 'true')
    $count++;
  if ($_GET['fifth_answer'] == 'true')
    $count++;
  echo $count;
?>
<br><br><a href="start.php">Ещё разок?</a>
</body>
</html>