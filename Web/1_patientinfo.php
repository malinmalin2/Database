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
    <h1 style = "text-align:center"> 데이터베이스 팀 프로젝트 3주차 Team4 PATIENTINFO
    <hr style = "border : 5px solid yellowgreen">


<?php
require_once 'dbconfig.php';
?>

<?php
$sql="select count(*) as num from PATIENTINFO";
$result=mysqli_query($link, $sql);
$data=mysqli_fetch_assoc($result);
	?>
	
	<p>        
        <h3>PATIENT Info table (Currently <?php echo $data['num'] ?>)patients in databases</h3>
    </p>
	

	
<table class="table table-striped">
<tr>
<th>Patient_ID</th>
<th>Sex</th>
<th>Age</th>
<th>Country</th>
<th>province</th>
<th>City</th>
<th>Infection_Case</th>
<th>Infected_by</th>
<th>contact_number</th>
<th>symptom_onset_date</th>
<th>confirmed_date</th>
<th>released_date</th>
<th>decreased_date</th>
<th>state</th>

</th>

<?php
$sql="select * from PATIENTINFO;";
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