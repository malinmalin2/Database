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
    <h1 style = "text-align:center"> 데이터베이스 팀 프로젝트 3주차 Team4 PATIENTINFO filtering
    <hr style = "border : 5px solid yellowgreen">
	state를 선택하세요.

<?php
require_once 'dbconfig.php';
?>

<form method="post" action="2_patientinfo filtering.php">
<select name="state">
<option value="released">released</option>
<option value="isolated">isolated</option>
</select>
<input type="submit" value="load">
</form>


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
        if(!isset($_POST['state'])){
			$sql = "select count(*) as num from PATIENTINFO";
			$result = mysqli_query($link, $sql);
			$data = mysqli_fetch_assoc($result);
			echo $data['num'];	

			$sql = "select * from PATIENTINFO";
			$result = mysqli_query($link, $sql);
			while($row = mysqli_fetch_assoc($result)){
				print "<tr>";
				foreach($row as $key => $val){
					print "<td>" .$val. "</td>";
					}
					print "</tr>";
				}
			}	
			
        else {
            $value = $_POST['state'];
			$sql = "select count(*) as num from PATIENTINFO where state = '$value'";
			$result = mysqli_query($link, $sql);
			$data = mysqli_fetch_assoc($result);
			echo $data['num'];
			
			$sql = "select * from PATIENTINFO where state = '$value';";
			$result = mysqli_query($link, $sql);
			while($row = mysqli_fetch_assoc($result)){
				print "<tr>";
				foreach($row as $key => $val){
					print "<td>" .$val. "</td>";
					}
					print "</tr>";
				}
			}
	?>

</body>
</html>