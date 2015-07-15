<html>
<head>
  <meta charset="utf-8">
  <title>Старт</title>
  <style type="text/css">
   h1 { 
    font-size: 120%; 
    font-family: Verdana, Arial, Helvetica, sans-serif; 
    color: #CD5555;
   }
   b { 
    font-size: 107%; 
   }
  </style>
</head>
<body bgcolor="#FFDEAD">
<?php
  $fp = fopen('43.csv', 'r');
  // У меня два массива - первый (text) сопоставляет id вопроса и текст, второй (answer) - id и число.
  $text = array(); $answer = array();
  $str = fgets($fp, 999);
  $id = 0;
  while (!feof($fp)) {
    $str = fgets($fp, 999);
    $number = substr($str, strripos($str, ",") + 1);
    $str = substr($str, 0, strripos($str, ","));
      for ($idx = 0; $idx < 3; $idx++) {
        $str = substr($str, stripos($str, ",") + 1);
      }
    $str = trim($str, '[".]');
    if ($number > 0 and !in_array($str, $text)) { // Берём в качестве вопроса
      $id++;      
      $text[$id] = $str;
      $answer[$id] = $number; // $id - число вопросов, около 5000
    }
  }  
  fclose($fp);
  $count = $_GET['count'];
  if ($count == '' )
    $count = 0;
  $idx = $_GET['idx'];
  if ($idx == '') {
    $idx = 0;
  } else {
    $idx++;
    }
  if ($_GET['first_answer'] == 'true' or $_GET['second_answer'] == 'true' or $_GET['third_answer']
     == 'true' or $_GET['forth_answer'] == 'true' or $_GET['fifth_answer'] == 'true')
    $count++;
  $quest = rand(1, $id);
  if ($_GET['fifth_answer'] == '') {
    echo '<form name="questions" method="get" action="start.php">'; 
    echo "<b>".$text[$quest]." </b><br> \n"; // Название вопроса
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
        $value_of_number = $answer[$quest];
      } else {
        $value_of_number = rand(1, $id);
        }
      echo '<input type="radio" name="'.$number_of_answer.'_answer" value="'.$value_of_truth.'"> '.$value_of_number.' <br> ';
    }
    echo '<input type="hidden" name="count" value="'.$count.'">';
    echo '<input type="hidden" name="idx" value="'.$idx.'">';
    echo '<input type="submit" style="font-size: 107%; color: #CD5555" value="Подтвердите
свой выбор"></form>'; 
  } else {
    echo '<form name="questions" method="get" action="result.php">';
    echo '<input type="hidden" name="count" value="'.$count.'">';
    echo '<input type="submit" style="font-size: 107%; color: #CD5555" value="Посмотреть
результаты"></form>';
    }
?>
</body>
</html>