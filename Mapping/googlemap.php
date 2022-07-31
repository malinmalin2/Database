<?php
   require_once 'dbconfig.php';
?>

<body>
<div id="map_ma"></div>

<?php   
   $hid=$_GET['hid'];
   
   $sql = "select Hospital_name,Hospital_latitude,Hospital_longitude,Hospital_province,
   Hospital_city  from HOSPITAL where Hospital_id = '$hid' ";
   $result = mysqli_query($link, $sql);
   if (mysqli_num_rows($result) > 0) {
   if($row = mysqli_fetch_assoc($result)) {
	   $name= $row["Hospital_name"];
	   $latitude= $row["Hospital_latitude"];
	   $longitude= $row["Hospital_longitude"];
	   $province= $row["Hospital_province"];
	   $city= $row["Hospital_city"];
   }
   }else{
   echo "테이블에 데이터가 없습니다.";
   }

?>
<!DOCTYPE html>
<html lang="ko">
<head>
<title>병원위치</title>
<meta charset = 'utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBdHmcT_N0kMZJ5ldjxOANhRMnuBlu2Fts" >//키를 발급받아 사용하세요</script>
<style>
#map_ma {width:100%; height:400px; clear:both; border:solid 1px red;}
</style>
</head>

<script type="text/javascript">
      $(document).ready(function() {
         var myLatlng = new google.maps.LatLng(<?= $latitude ?>,<?= $longitude ?>); // 위치값 위도 경도
   var Y_point         = <?= $latitude ?>;      // Y 좌표
   var X_point         = <?= $longitude ?>;      // X 좌표
   var zoomLevel      = 18;            // 지도의 확대 레벨 : 숫자가 클수록 확대정도가 큼
   var markerTitle      = "<?= $province ?>";      // 현재 위치 마커에 마우스를 오버을때 나타나는 정보
   var markerMaxWidth   = 300;            // 마커를 클릭했을때 나타나는 말풍선의 최대 크기

// 말풍선 내용
   var contentString   = '<div>' +
   '<h2></h2>'+
   '<p>안녕하세요. 병원입니다.</p>' +
   
   '</div>';
   var myLatlng = new google.maps.LatLng(Y_point, X_point);
   var mapOptions = {
                  zoom: zoomLevel,
                  center: myLatlng,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
               }
   var map = new google.maps.Map(document.getElementById('map_ma'), mapOptions);
   var marker = new google.maps.Marker({
                                 position: myLatlng,
                                 map: map,
                                 title: markerTitle
   });
   var infowindow = new google.maps.InfoWindow(
                                    {
                                       content: contentString,
                                       maxWizzzdth: markerMaxWidth
                                    }
         );
   google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map, marker);
   });
});
      </script>
</body>
</html>
