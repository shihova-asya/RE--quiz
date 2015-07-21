<html>
<head>
  <meta charset="utf-8">
  <title>Результаты</title>
  <style type="text/css">
    svg {
      position: absolute;
      top: 50px;
      left: 200px;
    }
  </style>
</head>
<body bgcolor="#FFDEAD">
<?php
  echo 'Количество правильных ответов: ';
  $count = $_GET['count'];
  echo $count.' , ';
  $all_used_time = $_GET['all_used_time'];
  echo 'Время (в секундах): ';
  echo $all_used_time; 
?>
  <script src="http://d3js.org/d3.v3.min.js"></script>
  <svg width="600" height="600"></svg>
  <script>
  var colors = ["#000000", "#87CEFA", "#98FB98", "#87CEFA", "#98FB98", "#87CEFA", "#98FB98"];
  var count = <?php echo $count ?> ;
  
  for (var index = 6; index > 0; --index) {
    var two_pi = 2 * Math.PI;
    var width = index * 100,
      height = index * 100,
      outerRadius = width / 2,
      innerRadius = 0;
  
    if (6 - count == index) {
      colors[index] = "red";
    }
   
    d3.select("svg").append("g")
      .attr("transform", "translate(" + 300 + "," + 300 + ")")
    .selectAll("path")
      .data([0])
      .enter()
      .append("path")
        .attr("d", d3.svg.arc()
          .outerRadius(outerRadius)
          .innerRadius(innerRadius)
          .startAngle(function(d) { return d; })
          .endAngle(function(d) { return d + two_pi; }))
        .style("fill", colors[index])   
    }
    </script>

<br><br><a href="start.php">Ещё разок?</a>
</body>
</html>