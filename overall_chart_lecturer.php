<div id="piechart"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

<?php



$user = $_SESSION['login_id'];
//projects
$sql = "SELECT sum(`projects`) FROM `workload`WHERE `email` = $user; ";      
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
  if ($resultCheck > 0){
  if($row = mysqli_fetch_array($result)){
    $_SESSION['projects'] = $row['sum(`projects`)'];
  }}

//Students
$sql = "SELECT sum(`students`) FROM `workload` WHERE `email` = $user; ";      
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
  if ($resultCheck > 0){
  if($row = mysqli_fetch_array($result)){
    $_SESSION['students'] = $row['sum(`students`)'];
  }}

//Available
$sql = "SELECT sum(`available`) FROM `workload`  WHERE `email` = $user;";      
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
  if ($resultCheck > 0){
  if($row = mysqli_fetch_array($result)){
    $_SESSION['available'] = $row['sum(`available`)'];
  }}


?>


// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Workload', 'Hours'],
  ['Available', <?php $x = $_SESSION['available']; echo "$x "; ?>],
  ['Project', <?php $x = $_SESSION['projects'];  echo "$x " ;  ?>],
  ['Students', <?php $x = $_SESSION['students'];  echo "$x "; ?>]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Overall Workload', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>