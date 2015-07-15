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
    var used_time = Number(h)*3600 + Number(m)*60 + Number(s);
    document.getElementById("my_timer").innerHTML = h+":"+m+":"+s;
    if (Number(s) % 5 == 1) {
      if(document.getElementById('question1') != null) {
        document.getElementById('question1').innerHTML += '<input type="hidden" name="used_time" value="' + used_time +'">';
      }
      if(document.getElementById('question2') != null) {
        document.getElementById('question2').innerHTML += '<input type="hidden" name="used_time" value="' + used_time +'">';
      }
      if(document.getElementById('question3') != null) {
        document.getElementById('question3').innerHTML += '<input type="hidden" name="used_time" value="' + used_time +'">';
      }
      if(document.getElementById('question4') != null) {
        document.getElementById('question4').innerHTML += '<input type="hidden" name="used_time" value="' + used_time +'">';
      }
      if(document.getElementById('question5') != null) {
        document.getElementById('question5').innerHTML += '<input type="hidden" name="used_time" value="' + used_time +'">';
      }
    }
    setTimeout(startTimer, 1000);    
  }
</script>
</head>
<body bgcolor="#FFDEAD" onload="startTimer()">
  <span id="my_timer" style="color: #8B0000; font-size: 150%;">00:00:00</span><br>
  <?php
  if ($_GET['all_used_time'] == '') {
    $all_used_time = 0;
  } else {
    $all_used_time = $_GET['used_time'] + $_GET['all_used_time'];
    }
  $count = $_GET['count'];
  if ($_GET['first_answer'] == '' and $_GET['second_answer'] == '' and $_GET['third_answer']
    == '' and $_GET['forth_answer'] == '' and $_GET['fifth_answer'] == '') {
     $count = 0;
  echo '<form id="question1" method="get">
    <b>Сколько рублей получила Российская Империя в 1912 году на акцизах с табака?</b><br> 
    <input type="radio" name="first_answer" value="false"> 5700000<br>
    <input type="radio" name="first_answer" value="true"> 61000000<br>
    <input type="radio" name="first_answer" value="false"> 130000<br>
    <input type="radio" name="first_answer" value="false"> 440000000<br>
    <input type="hidden" name="count" value="'.$count.'">
    <input type="hidden" name="all_used_time" value="'.$all_used_time.'">
    <input type="submit" value="Подтвердите свой выбор" style="font-size: 107%; color: #CD5555">
    </form> ';
    }       
    if ($_GET['first_answer'] == 'true')
      $count++;
    if ($_GET['first_answer'] != '') {
      echo '
    <form id="question2" method="get">
    <b>Каковы были подымные подати и сборы?</b><br> 
    <input type="radio" name="second_answer" value="false"> 5820322<br>
    <input type="radio" name="second_answer" value="false"> 3850222<br>
    <input type="radio" name="second_answer" value="false"> 852322<br>
    <input type="radio" name="second_answer" value="true"> 2850322<br>
    <input type="hidden" name="count" value="'.$count.'">
    <input type="hidden" name="all_used_time" value="'.$all_used_time.'">
    <input type="submit" value="Подтвердите свой выбор" style="font-size: 107%; color: #CD5555">
    </form> ' ;
    }     
    if ($_GET['second_answer'] == 'true')
      $count++;
    if ($_GET['second_answer'] != '') {
      echo '
    <form id="question3" method="get">
    <b>А каков был сахарный доход?</b><br> 
    <input type="radio" name="third_answer" value="true"> 128430000<br>
    <input type="radio" name="third_answer" value="false"> 12843000<br>
    <input type="radio" name="third_answer" value="false"> 1128430000<br>
    <input type="radio" name="third_answer" value="false"> 0<br>
    <input type="hidden" name="count" value="'.$count.'">
    <input type="hidden" name="all_used_time" value="'.$all_used_time.'">
    <input type="submit" value="Подтвердите свой выбор" style="font-size: 107%; color: #CD5555">
    </form> ' ;
    }     
    if ($_GET['third_answer'] == 'true')
      $count++;
    if ($_GET['third_answer'] != '') {
      echo '
    <form id="question4" method="get">
    <b>Суммарный доход от всех пошлин?</b><br> 
    <input type="radio" name="forth_answer" value="false"> 11847376<br>
    <input type="radio" name="forth_answer" value="true"> 191847376<br>
    <input type="radio" name="forth_answer" value="false"> 1991847376<br>
    <input type="radio" name="forth_answer" value="false"> 19991847376<br>
    <input type="hidden" name="count" value="'.$count.'">
    <input type="hidden" name="all_used_time" value="'.$all_used_time.'">
    <input type="submit" value="Подтвердите свой выбор" style="font-size: 107%; color: #CD5555">
    </form> ' ;
    }     
    if ($_GET['forth_answer'] == 'true')
      $count++;
    if ($_GET['forth_answer'] != '') {
      echo '
    <form id="question5" method="get">
    <b>А чем  может похвастаться Главное Интендантское Управление?</b><br> 
    <input type="radio" name="fifth_answer" value="false"> 17500<br>
    <input type="radio" name="fifth_answer" value="false"> 137500<br>
    <input type="radio" name="fifth_answer" value="true"> 1337500<br>
    <input type="radio" name="fifth_answer" value="false"> 13337500<br>
    <input type="hidden" name="count" value="'.$count.'">
    <input type="hidden" name="all_used_time" value="'.$all_used_time.'">
    <input type="submit" value="Подтвердите свой выбор" style="font-size: 107%; color: #CD5555">
    </form> ' ;
    }
    if ($_GET['fifth_answer'] == 'true')
      $count++;
    if ($_GET['fifth_answer'] != '') {
      echo '
    <form name="finish" method="get" action="result.php">
    <input type="hidden" name="count" value="'.$count.'">
    <input type="hidden" name="all_used_time" value="'.$all_used_time.'">
    <input type="submit" value="Посмотреть результаты" style="font-size: 107%; color: #CD5555">
    </form> ' ;
    }
  ?>
</body>
</html>