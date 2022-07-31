<?php
    require_once 'dbconfig.php';
?>

<style>
	table{
	width: 100%;
	border: 1px solid #444444;
	border-collapse: collapse;
	}
	th, td{
		border : 1px solid #444444;
	}
</style>

<body>
    <h1 style = "text-align:center"> 데이터베이스 팀 프로젝트 3주차 Team4 WEATHER
    <hr style = "border : 5px solid yellowgreen">
    
   
    <?php
        
    $sql = "select count(*) as num from Weather ";
        $result = mysqli_query($link, $sql);
        $data = mysqli_fetch_assoc($result);
    ?>
    <p>        
        <h3>Weather Info table (Currently <?php echo $data['num'] ?>)weathers in databases</h3>
    </p>

    <table class = "table table-striped">
        
    <tr>
        <th>Region_code</th>
        <th>Province</th>
        <th>Wdate</th>
        <th>avg_temp</th>
        <th>min_temp</th>
        <th>max_temp</th>         
    </tr>

    <?php
        $sql = "select * from WEATHER;";
        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($result)){
            print "<tr>";
            foreach($row as $key => $val){
                print "<td>" .$val. "</td>";
            }
            print "</tr>";

        }
    ?>
    </table>
</body>

<html>