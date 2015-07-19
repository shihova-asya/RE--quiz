<html>
<head>
  <title>Старт</title>
  <meta charset="utf-8">
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
  <script type="text/javascript">
  var used_time = 0;
  function startTimer() {
    var my_timer = document.getElementById("my_timer");
    var time = my_timer.innerHTML;
    var arr = time.split(":");
    var h = arr[0];
    var m = arr[1];
    var s = arr[2];
    if (s == 60) {
      if (m == 60) {
        h++;
        m = 0;
        if (h < 10) h = "0" + h;
      }
      m++;
      if (m < 10) m = "0" + m;
      s = 0;
    }
    else  s++;
    if (s < 10) s = "0" + s;
    used_time = Number(h)*3600 + Number(m)*60 + Number(s);
    document.getElementById("my_timer").innerHTML = h+":"+m+":"+s;
    setTimeout(startTimer, 1000);    
  }
  function Send_time(truth) {
    document.getElementById('questions').innerHTML +='<input type="hidden" name="answer" value="' + truth + '">';
    document.getElementById('questions').innerHTML += '<input type="hidden" name="used_time" value="' + used_time +'">';
  }
  </script>
</head>
<body bgcolor="#FFDEAD" onload="startTimer()">
  <span id="my_timer" style="color: #8B0000; font-size: 150%;">00:00:00</span><br>
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
  if ($_GET['all_used_time'] == '') {
    $all_used_time = 0;
  } else {
    $all_used_time = $_GET['used_time'] + $_GET['all_used_time'];
    }
  if ($_GET['answer'] == 'true')
    $count++;
  $quest = rand(1, $id);
  if ($idx <= 4) {
    echo '<form id="questions" method="get" action="start.php">'; 
    echo "<b>".$text[$quest]." </b><br> \n"; // Название вопроса
    $true_ans = rand(1, 4);
    for ($idx2 = 1; $idx2 < 5; $idx2++) {
      $value_of_truth = "false";
      if ($idx2 == $true_ans) {
        $value_of_truth = "true";
        $value_of_number = $answer[$quest];
      } else {
        $value_of_number = rand(1, $id);
        }
      echo '<input type="radio" onclick=Send_time("'.$value_of_truth.'")>'.$value_of_number.' <br>';
    }
    echo '<input type="hidden" name="count" value="'.$count.'">';
    echo '<input type="hidden" name="idx" value="'.$idx.'">';
    echo '<input type="hidden" name="all_used_time" value="'.$all_used_time.'">';
    echo '<input type="submit" style="font-size: 107%; color: #CD5555" value="Подтвердите свой выбор"></form>'; 
  } else {
    echo '<form name="questions" method="get" action="result.php">';
    echo '<input type="hidden" name="count" value="'.$count.'">';
    echo '<input type="hidden" name="all_used_time" value="'.$all_used_time.'">';
    echo '<input type="submit" style="font-size: 107%; color: #CD5555" value="Посмотреть результаты "></form>';
    }
?>
</body>
</html>