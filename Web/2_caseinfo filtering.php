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
    <h1 style = "text-align:center"> 데이터베이스 팀 프로젝트 3주차 Team4 CASEINFO FILTERING
    <hr style = "border : 5px solid yellowgreen">
    Province를 선택하세요
    <form method = "POST" action = "2_caseinfo filtering.php">                                     
        <select name = "province">
		    <option value = "none"selected>선택</option>
            <option value = "Seoul">Seoul</option>
            <option value = "Incheon">Incheon</option>
            <option value = "Daejeon">Daegeon</option>
            <option value = "Daegu">Daegu</option>
            <option value = "Busan">Busan</option>
            <option value = "Ulsan">Ulsan</option>  
            <option value = "Sejong">Sejong</option>  
            <option value = "Gwangju">Gwangju</option>
            <option value = "Gyeonggi-do">Gyeonggi-do</option>
            <option value = "Gangwon-do">Gangwon-do</option>
            <option value = "Jeollabuk-do">Jeollabuk-do</option>
            <option value = "Jeollanam-do">Jeollanam-do</option>
            <option value = "Gyeongsangbuk-do">Gyeongsangbuk-do</option>
            <option value = "Gyeongsangnam-do">Gyeongsangnam-do</option>
            <option value = "Chungcheongbuk-do">Chungcheongbuk-do</option>
            <option value = "Chungcheongnam-do">Chungcheongnam-do</option>
            <option value = "Jeju-do">Jeju-do</option>
        </select>
	<br>집단감염 여부를 선택하세요<br>
	<select name="infection_group">
	<option value = "none"selected>선택</option>
	<option value="1">O</option>
	<option value="0">X</option>
	</select>
	<input type="submit" value="load">
	<br>
	<form>
	
	<table class = "table table-striped">
        
    <tr>
        <th>Case_id</th>
        <th>Province</th>
        <th>City</th>
        <th>Infection_group</th>
        <th>Infection_Case</th>
        <th>Confirmed</th>      
        <th>latitude</th>          
        <th>longitude</th>          
    </tr>

    <?php
        if(!isset($_POST['province'])){
			$sql = "select count(*) as num from CASEINFO";
			$result = mysqli_query($link, $sql);
			$data = mysqli_fetch_assoc($result);
			print("총 ");
			echo $data['num'];
			$sql = "select * from CASEINFO;";
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
			$value = $_POST['province'];
			$sql = "select count(*) as num from CASEINFO where province = '$value'";
			$result = mysqli_query($link, $sql);
			$data = mysqli_fetch_assoc($result);
			print("'$value'의 case는 총 ");
			echo $data['num'];
			print("개이며, ");
			if($_POST['infection_group']==1){
			$sql = "select count(*) as num from CASEINFO where province = '$value' and infection_group=1";
			$result = mysqli_query($link, $sql);
			$data = mysqli_fetch_assoc($result);
			echo $data['num'];
			print("개의 집단감염 case가 있습니다.");	
			
			$sql = "select * from CASEINFO where province = '$value'and infection_group=1;";
			$result = mysqli_query($link, $sql);
			while($row = mysqli_fetch_assoc($result)){
				print "<tr>";
				foreach($row as $key => $val){	
					print "<td>" .$val. "</td>";
					}
					print "</tr>";
				}
			}
			else{
			$sql = "select count(*) as num from CASEINFO where province = '$value' and infection_group=0";
			$result = mysqli_query($link, $sql);
			$data = mysqli_fetch_assoc($result);
			echo $data['num'];
		    print("개의 not 집단감염 case가 있습니다.");		
			
			$sql = "select * from CASEINFO where province = '$value'and infection_group=0;";
			$result = mysqli_query($link, $sql);
			while($row = mysqli_fetch_assoc($result)){
				print "<tr>";
				foreach($row as $key => $val){	
					print "<td>" .$val. "</td>";
					}
					print "</tr>";
				}
			}	
			}
	?>
</body>

<html>

