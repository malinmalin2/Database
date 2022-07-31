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

<!DOCTYPE html>
<html>



<body>
    <h1 style = "text-align:center"> 데이터베이스 팀 프로젝트 4주차 Team4
    <hr style = "border : 5px solid yellowgreen">
	<form method = "POST" action = "<?php echo $_SERVER['PHP_SELF'];?>" action="2_patientinfo filtering.php">
        
		<p><label>Put Hospital_id : <input type = "number" name ="Hospital_id"></label></p>    
	
        <input type="submit" value="load">
	
	<form>	

    <?php
        if(!isset($_POST['Hospital_id'])){            
            $value2 = '1~43';
            $sql = "select count(*) as num from patientinfo";            
            $result = mysqli_query($link, $sql);
            $data = mysqli_fetch_assoc($result);
        }
        else {
            $value = $_POST['Hospital_id'];               
            $value2 = $value;
            $sql = "select count(*) as num from patientinfo where hospital_id = $value ";
            $result = mysqli_query($link, $sql);
            $data = mysqli_fetch_assoc($result);
        }        
        
    ?>
    <p>        
        <h3>Hospital Info Info table (Currently <?php echo $data['num'] ?>)cases in databases which hospital_id <?php echo $value2 ?></h3>
    </p>
    
	<table class = "table table-striped">
        
    <tr>
        <th>Patient_ID</th>
        <th>Sex</th>
        <th>Age</th>
        <th>Country</th>
        <th>Province</th>
        <th>City</th>
        <th>infection_Case</th>
        <th>infected_by</th>
        <th>contract_number</th>
        <th>symptom_onset_date</th>
        <th>confirmed_date</th>
        <th>released_date</th>
        <th>decreased_date</th>          
        <th>state</th>           
        <th>Hospital_id</th>
    </tr>
    

    <?php
        if(!isset($_POST['Hospital_id']))  {
            
            $sql = "select * from PATIENTINFO limit 100";
            $result = mysqli_query($link, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $cnt = 0;
                print "<tr>";                
                foreach($row as $key => $val){                      
                    if($cnt == 14){                                                                     
                        print "<td>"."<a href=googlemap.php?hid=$val> $val </a>"."<td>";                                            						
                        
                    }
                    else{
                        print "<td>" .$val. "</td>";                                                                                                                  
                    }
                    $cnt++;

                }
                print "</tr>";
            }  
        }
        else{
            $value = $_POST['Hospital_id'];

            $sql = "select * from PATIENTINFO where Hospital_id = '$value' ";
            $result = mysqli_query($link, $sql);
            while($row = mysqli_fetch_assoc($result)){                
                $cnt = 0;
                print "<tr>";                
                foreach($row as $key => $val){                      
                    if($cnt == 14){                                                                     
                        print "<td>"."<a href=googlemap.php?hid=$value> $val </a>"."<td>";                                               
                        
                    }
                    else{
                        print "<td>" .$val. "</td>";                                                                                                                  
                    }
                    $cnt++;

                }
                print "</tr>";
            }
            
        }
	?>
	
	<!--<form action="googlemap.php" method="POST">
	<input type="hidden" name="hid" value=21>
	</form>-->
	
    <!-- <form name = "input_form" method = "POST" action = "test.php">
    <input type  = "hidden" name = "data" value = <?php echo $value;?>>; -->

</body>
</html>


