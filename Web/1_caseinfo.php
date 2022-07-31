<body>

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
    <h1 style = "text-align:center"> 데이터베이스 팀 프로젝트 3주차 Team4 CASEINFO
    <hr style = "border : 5px solid yellowgreen">

<?php
require_once 'dbconfig.php';
?>

<?php
$sql="select count(*) as num from CASEINFO";
$result=mysqli_query($link, $sql);
$data=mysqli_fetch_assoc($result);
?>
	<p>        
        <h3>CASE Info table (Currently <?php echo $data['num'] ?>)cases in databases</h3>
    </p>
	

	
<table class="table table-striped">
<tr>
<th>case_id</th>
<th>province</th>
<th>city</th>
<th>infection_group</th>
<th>infection_case</th>
<th>confirmed</th>
<th>latitude</th>
<th>longitude</th>
</th>

<?php
$sql="select * from CASEINFO;";
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