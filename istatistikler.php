
<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
include("header.php");
if ( isset( $_SESSION['login_user'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: login.php");
}
   include("config.php");

$bldID = mysqli_real_escape_string($db,$_SESSION['bldID']);

$sql="SELECT * from belediye_hayvan
 INNER JOIN hayvan ON hayvan.id=belediye_hayvan.hayvanID
 INNER JOIN tür ON tür.türID=hayvan.türID
 where belediye_hayvan.belediyeID='$bldID' and tür.ad='kedi' ";

 $result = mysqli_query($db,$sql);

  
$kediSayısı=mysqli_num_rows($result);

$sql="SELECT * from belediye_hayvan
 INNER JOIN hayvan ON hayvan.id=belediye_hayvan.hayvanID
 INNER JOIN tür ON tür.türID=hayvan.türID
 where belediye_hayvan.belediyeID='$bldID' and tür.ad='köpek' ";

 $result = mysqli_query($db,$sql);

  
$köpekSayısı=mysqli_num_rows($result);

$dataPoints = array(
	array("label"=> "Kedi", "y"=> $kediSayısı),
	array("label"=> "Köpek", "y"=> $köpekSayısı),
	
);


 $myusername = mysqli_real_escape_string($db,$_SESSION['login_user']);      
$sql = "SELECT *
FROM belediye_asi ba
INNER JOIN belediye b ON b.belediyeID=ba.belediyeID
INNER JOIN asi a ON a.asiID=ba.asiID
WHERE b.belediyeAdi = '$myusername'";

      $result = mysqli_query($db,$sql);
if(mysqli_num_rows($result) > 0 ){


$dataPointsAsilar =  array();
while ($row = mysqli_fetch_array($result)){
	array_push($dataPointsAsilar, array("label"=> $row['asiAD'], "y"=> $row['stokSayısı']));

}}



$sql = "SELECT *
FROM  gelirler
WHERE belediyeID = '$bldID'";

      $result = mysqli_query($db,$sql);
if(mysqli_num_rows($result) > 0 ){


$dataPointsGelir =  array();
while ($row = mysqli_fetch_array($result)){
	array_push($dataPointsGelir, array("label"=> $row['gelirAdı'], "y"=> $row['gelirTutarı']));

}}





$sql = "SELECT *
FROM  maliyet
WHERE belediyeID = '$bldID'";

      $result = mysqli_query($db,$sql);
if(mysqli_num_rows($result) > 0 ){


$dataPointsGider =  array();
while ($row = mysqli_fetch_array($result)){
	array_push($dataPointsGider, array("label"=> $row['maliyetAdı'], "y"=> $row['maliyetTutarı']));

}}




$sql = "SELECT *
FROM  maliyet
WHERE belediyeID = '$bldID' and year(maliyetTarih)='2018'";

      $result = mysqli_query($db,$sql);
if(mysqli_num_rows($result) > 0 ){

$gider2018 =  array();
while ($row = mysqli_fetch_array($result)){
	array_push($gider2018, array($row['maliyetTutarı']));
}}

$sql = "SELECT *
FROM  gelirler
WHERE belediyeID = '$bldID' and year(gelirTarih)=2018";

      $result = mysqli_query($db,$sql);
if(mysqli_num_rows($result) > 0 ){

$gelir2018 =  array();
while ($row = mysqli_fetch_array($result)){
	array_push($gelir2018, array($row['gelirTutarı']));
}}

//----------------------------2019

$sql = "SELECT *
FROM  maliyet
WHERE belediyeID = '$bldID' and year(maliyetTarih)='2019'";

      $result = mysqli_query($db,$sql);
if(mysqli_num_rows($result) > 0 ){

$gider2019 =  array();
while ($row = mysqli_fetch_array($result)){
	array_push($gider2019, array($row['maliyetTutarı']));
}}

$sql = "SELECT *
FROM  gelirler
WHERE belediyeID = '$bldID' and year(gelirTarih)=2019";

      $result = mysqli_query($db,$sql);
if(mysqli_num_rows($result) > 0 ){

$gelir2019 =  array();
while ($row = mysqli_fetch_array($result)){
	array_push($gelir2019, array($row['gelirTutarı']));
}}






?>


<div class="row" style="margin-top: 4%; margin-left: auto;margin-right: auto;">
<div class="col-md-5" id="chartContainer" style="height: 370px; width: 100%; 
    margin-left: auto;margin-right: auto;"></div>

<div class="col-md-5" id="chartContainerAsilar" style="height: 370px; width: 100%;  margin-left: auto;margin-right: auto;"></div>
</div>


<div class="row" style="margin-top:4%; margin-left: auto;margin-right: auto; background-color: '#2196f3';width:90%;">2018 YILI GRAFİĞİ</div>
<div class="row" style="margin-top: 4%; margin-left: auto;margin-right: auto; background-color: white;width:90%;">
              <canvas id="myChart2018" style="height: 200px;"></canvas>

</div>
<div class="row" style="margin-top:4%; margin-left: auto;margin-right: auto;background-color: '#2196f3';width:90%; ">2019 YILI GRAFİĞİ</div>
<div class="row" style="margin-top: 4%; margin-left: auto;margin-right: auto; background-color: white;width:90%;">
              <canvas id="myChart2019" style="height: 200px;"></canvas>

</div>

<script>
window.onload = function () {
	
var ctx = document.getElementById("myChart2018").getContext('2d');

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Ocak","Şubat","Mart",	"Nisan",	"Mayıs",	"Haziran",	"Temmuz","Ağustos",	"Eylül","Ekim","Kasım","Aralık"],
        datasets: [{
            label: 'Giderler', // Name the series
            data:  <?php echo json_encode($gider2018, JSON_NUMERIC_CHECK); ?>, // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (Line)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        },
                  {
            label: 'Gelirler', // Name the series
            data: <?php echo json_encode($gelir2018, JSON_NUMERIC_CHECK); ?>, // Specify the data values array
            fill: false,
            borderColor: '#4CAF50', // Add custom color border (Line)
            backgroundColor: '#4CAF50', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]
    },
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});
var ctx = document.getElementById("myChart2019").getContext('2d');

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Ocak","Şubat","Mart",	"Nisan",	"Mayıs"],
        datasets: [{
            label: 'Giderler', // Name the series
            data:  <?php echo json_encode($gider2019, JSON_NUMERIC_CHECK); ?>, // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (Line)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        },
                  {
            label: 'Gelirler', // Name the series
            data: <?php echo json_encode($gelir2019, JSON_NUMERIC_CHECK); ?>, // Specify the data values array
            fill: false,
            borderColor: '#4CAF50', // Add custom color border (Line)
            backgroundColor: '#4CAF50', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]
    },
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
    }
});
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Belediyenin Kedi Köpek Oranı"
	},
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "฿#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
 
var chart = new CanvasJS.Chart("chartContainerAsilar", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Belediyenin Aşı Stokları Sayısı"
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",   
		dataPoints: <?php echo json_encode($dataPointsAsilar, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();









}



</script>



<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script src="js/Chart.min.js" type="text/javascript"></script>
