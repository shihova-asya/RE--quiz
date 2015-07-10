<html>
<head>
  <meta charset="utf-8">
  <title>Старт</title>
</head>
<body bgcolor="#87CEFF">
<?php
  $fp = fopen('43.csv', 'r');
  // У меня два массива - первый (text) сопоставляет id вопроса и текст, второй (answer) - id и число.
  $text = array(); $answer = array();
  $str = fgets($fp, 999);
  $id = 0;
  while (!feof($fp)) {
    $str = fgets($fp, 999);
    $number = substr($str, strripos($str, ",") + 1);
    if ($number > 0) { // Берём в качестве вопроса
      $id++;
      $str = substr($str, 0, strripos($str, ","));
      for ($idx = 0; $idx < 3; $idx++) {
        $str = substr($str, stripos($str, ",") + 1);
      }
      $str = trim($str, '[".]');
      $text[$id] = $str;
      $answer[$id] = $number;
    }
  }  
  fclose($fp);
  $fp = fopen('data.txt', 'w');
  for ($idx = 1; $idx < $id; $idx++) {
    fwrite($fp, $idx."  ".$text[$idx]."  ".$answer[$idx]);
  }
  fclose($fp);
  $quest[0] = rand(1, $id);
  $quest[1] = rand(1, $id);
  $quest[2] = rand(1, $id);
  $quest[3] = rand(1, $id);
  $quest[4] = rand(1, $id);
  echo '<form name="questions" method="get" action="result.php">';
  for ($idx = 0; $idx < 5; $idx++) {
    echo $text[$quest[$idx]]." <br> \n"; // Название вопроса
    // Потом четырежды выводим что-то вроде этого - <input type="radio" name="first_answer" value="false"> 5700000<br>
    $true_ans = rand(1, 4);
    for ($idx2 = 1; $idx2 < 5; $idx2++) {
      $number_of_answer = "first";
      if ($idx == 1)
        $number_of_answer = "second";
      if ($idx == 2)
        $number_of_answer = "third";
      if ($idx == 3)
        $number_of_answer = "forth";
      if ($idx == 4)
        $number_of_answer = "fifth";
      $value_of_truth = "false";
      if ($idx2 == $true_ans) {
        $value_of_truth = "true";
        $value_of_number = $answer[$quest[$idx]];
      } else {
        $value_of_number = rand(1, $id);
        }
      echo '<input type="radio" name="'.$number_of_answer.'_answer" value="'.$value_of_truth.'"> '.$value_of_number.' <br> ';
    }
  }
  echo '<input type="submit" value="Подтвердите свой выбор">
  </form>';
?>
</body>
</html>