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

<?php
	require_once 'dbconfig.php';
?>

<body>
    <h1 style = "text-align:center"> 데이터베이스 팀 프로젝트 3주차 Team4 WEATHER FILTERING
    <hr style = "border : 5px solid yellowgreen">
	<h1 style = "text-align:left"> wdate를 선택하세요.
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">	

		<select name = "year">
			<option value="2020">2020</option>		
		</select>
		<select name = "month">
			<option value="01">01</option>
			<option value="02">02</option>
			<option value="03">03</option>
			<option value="04">04</option>
			<option value="05">05</option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>				
		</select>
		<select name = "date">
			<option value="01">01</option>
			<option value="02">02</option>
			<option value="03">03</option>
			<option value="04">04</option>
			<option value="05">05</option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="29">29</option>
			<option value="30">30</option>
			<option value="31">31</option>
		</select>		
		<input type="submit" value="submit">
	</form>

	<table class="table table-striped">

	<tr>
		<th>region_code</th>
		<th>province</th>
		<th>wdate</th>
		<th>avg_temp</th>
		<th>min_temp</th>
		<th>max_temp</th>
	</th>		


	<?php		
		if(!isset($_POST['date'])){
            $sql = "select count(*) as num from weather";			
			$result = mysqli_query($link, $sql);
        	$data = mysqli_fetch_assoc($result);

			echo 'Weather table은 총';
			echo $data['num'].'개 입니다';

			$sql = "select * from WEATHER;";
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
            $value = $_POST['year'].'-'.$_POST['month'] .'-'.$_POST['date'];      	
			$sql = "select count(*) as num from weather where wdate = '$value'";
			$result = mysqli_query($link, $sql);
        	$data = mysqli_fetch_assoc($result);

						
			echo $value.'의 Weather table은 총';
			echo $data['num'].'개 입니다';

			$sql = "select * from WEATHER where wdate = '$value';";
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
		

	

	</table>
	
</body>

<html>