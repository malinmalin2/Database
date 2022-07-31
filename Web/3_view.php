<body>

<p><h3> VIEW table </h3></p>

<style>
table{
	width:100%;
	border:1px solid #444444;
	border-collapse:collapse;
}
th,td{
	border:1px solid #444444;
}
</style>
<body>
    <h1 style = "text-align:center"> 데이터베이스 팀 프로젝트 3주차 Team4 PATIENTINFO&CASEINFO
    <hr style = "border : 5px solid yellowgreen">
	나이별,지역별 집단감염 case count

<?php
require_once 'dbconfig.php';
?>

	
<table class="table table-striped">
<tr>
<th>age</th>
<th>province</th>
<th>infection_group_count</th>
</th>

<?php
$sql="select * from C;";
$result=mysqli_query($link, $sql);
while($row=mysqli_fetch_assoc($result))
{
	print "<tr>";
	foreach ($row as $key => $val){
		print "<td>".$val."</td>";
	}
	print "</tr>";
}
?>


</body>
</html>