<html>
<head>
  <title>Старт</title>
  <meta charset="utf-8">
  <style type="text/css">
    #questions {      
      font-size: 150%;
      text-align: center;
      position: absolute;
      top: 57px;
      left: 400px;    
      width: 500px; 
      border: 7px ridge #CD5555;
      padding: 13px;
      background: #FFDEAD;
    }
    #to-results {      
      text-align: center;
      position: absolute;
      top: 50px;
      left: 500px;     
    }
    #my_timer {
      position: absolute;
      bottom: 20px;
      right: 20px;
    }
    h1 { 
      font-size: 120%; 
      font-family: Verdana, Arial, Helvetica, sans-serif; 
      color: #CD5555;
    }
    b { 
      font-size: 107%; 
    }
    body {
      background: url(RussianMap.png) no-repeat;    
      background-size: 1370px 700px;
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
    document.getElementById('questions').innerHTML +='<input type="hidden" name="answer" value="' + truth.substr(0, truth.indexOf(":")) + '">';
    document.getElementById('questions').innerHTML += '<input type="hidden" name="used_time" value="' + used_time +'">';
    document.getElementById('choice'+truth.substr(truth.indexOf(":") + 1)).checked="checked";
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
      for ($index = 0; $index < 3; $index++) {
        $str = substr($str, stripos($str, ",") + 1);
      }
    $str = trim($str, '[".]');
    if ($number > 0 and !in_array($str, $text)) { // Берём в качестве вопроса
      $id++;      
      $text[$id] = $str;
      $answer[$id] = $number; // $id - число вопросов
    }
  }  
  fclose($fp);
  $idx = $_GET['idx'];
  $count = $_GET['count'];
  if ($idx == '') { // Первый вопрос
    $idx = 0; $count = 0; $all_used_time = 0;
    $fp = fopen('data.txt', 'w');
    $five = array(); // $five - массив из пяти произвольно выбранных вопросов.
    while (count($five) < 5) {
      $num = rand(1, $id);
      if (!in_array($num, $five)) {
        $five[] = $num;
        fwrite($fp, $num.' 
');
      }
    }
    fclose($fp);
  } else {
    $idx++;
    $all_used_time = $_GET['used_time'] + $_GET['all_used_time'];
    }   
  if ($_GET['answer'] == 'true')
    $count++;
  $fp = fopen('data.txt', 'r');
  for ($index = 0; $index <= $idx; $index++) {
    $quest = fgets($fp, 999);
  }
  $quest = 0 + $quest;
  fclose($fp);
  if ($idx <= 4) {
    echo '<form id="questions" method="get">'; 
    echo "<b>".$text[$quest]." </b><br> \n"; // Название вопроса
    $true_ans = rand(1, 4);
    for ($idx2 = 1; $idx2 < 5; $idx2++) {
      $value_of_truth = "false".":".$idx2;
      if ($idx2 == $true_ans) {
        $value_of_truth = "true".":".$idx2;
        $value_of_number = $answer[$quest];
      } else {
        $value_of_number = $answer[rand(1, $id)];
        while ($value_of_number == $answer[$quest]) {
          $value_of_number = $answer[rand(1, $id)];
        }
      }
      echo '<input type="radio" id="choice'.$idx2.'" onclick=Send_time("'.$value_of_truth.'")><label for="choice'.$idx2.'">'.$value_of_number.'руб. </label><br>';
    }
    echo '<input type="hidden" name="count" value="'.$count.'">';
    echo '<input type="hidden" name="idx" value="'.$idx.'">';
    echo '<input type="hidden" name="all_used_time" value="'.$all_used_time.'">';
    echo '<input type="submit" style="font-size: 107%; color: #CD5555" value="Подтвердите свой выбор"> </form>'; 
  } else {
    header("Refresh: 0; URL=result.php?count=$count&all_used_time=$all_used_time");
    exit;
    }
?>
</body>
</html>