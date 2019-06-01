    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<?php include("header.php");?>

<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first

if ( isset( $_SESSION['login_user'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: login.php");
}
?>
   <h1 style="margin-top: 5%; position: unset;" data-text="black mirror"><span>HAYVAN BARINAK YÖNETİM SİSTEMİ </span></h1>

<div class="container">
 
  <div class="row" style="margin-top: 4%;    margin-left: auto;margin-right: auto;">
     <div class="col-md-4">
             <div class="corner" id="btnHayvan">
            <img  src="img/animals.svg" style="margin:auto; width: 90px;height:90px;" />
         <div style="text-align: center;"><b>HAYVANLAR</b></div>

              </div>



     </div>
    
       <div class="col-md-4" >
  
<div class="corner" id="btnAsilar" >
            
            <img  src="img/asilar.svg" style="margin:auto; width: 90px;height:90px;" />

         <div style="text-align: center;"><b>AŞILAR</b></div>

              </div>


     </div>

  </div>

  <div class="row" style="margin-top: 4%;    margin-left: auto;margin-right: auto;">

  <div class="altcorner" style="margin-top: 4%;    margin-left: auto;margin-right: auto;">
      <div class="container">
       <div class="row" style="margin-bottom: 2%">

           
       </div>
       <div class="row">
          <div class="col-md-6">
                  <div class="row">            

<?php
   include("config.php");

$bldID = mysqli_real_escape_string($db,$_SESSION['bldID']);


$sql="SELECT * from belediye_hayvan
 INNER JOIN hayvan ON hayvan.id=belediye_hayvan.hayvanID
 INNER JOIN tür ON tür.türID=hayvan.türID
 where belediye_hayvan.belediyeID='$bldID' ";
 $result = mysqli_query($db,$sql); 
$hayvanSayısı=mysqli_num_rows($result);

$sql="SELECT * from belediye
 where belediyeID='$bldID' ";
 $result = mysqli_query($db,$sql); 
$row = mysqli_fetch_array($result);
$barınakKapasitesi=$row['kapasite'];

$sql="SELECT SUM(gelirTutarı) AS toplam FROM gelirler where belediyeID='$bldID'";
 $result = mysqli_query($db,$sql); 
$row = mysqli_fetch_array($result);
$toplamGelir=$row['toplam'];

$sql="SELECT SUM(maliyetTutarı) AS toplam FROM maliyet where belediyeID='$bldID'";
 $result = mysqli_query($db,$sql); 
$row = mysqli_fetch_array($result);
$toplamGider=$row['toplam'];

?>



                             <div style="text-align: center;"><b>Muayene Edilen Toplam Hayvan Sayısı: <?php echo $hayvanSayısı;?></b></div>                
                  </div>      
                   <div class="row">            
                             <div style="text-align: center;"><b>Barınak Kapasitesi: <?php echo $barınakKapasitesi;?></b></div>                
                  </div>
          </div> 
          <div class="col-md-6">
                  <div class="row">            
                             <div style="text-align: center;"><b>Toplam Gelir: <?php echo $toplamGelir;?></b></div>                
                  </div> 
                   <div class="row">            
                             <div style="text-align: center;"><b>Toplam Gider: <?php echo $toplamGider;?></b></div>                
                  </div> 
          </div> 

       </div>
      </div>



  </div>

</div>
</div>


<script type="text/javascript">
  
$( "#btnHayvan" ).click(function() {
  window.location.href='hayvanlar.php';
});
$( "#btnGelirgider").click(function() {
  window.location.href='gelirgider.php';
});
$( "#btnAsilar").click(function() {
  window.location.href='asilar.php';
});


</script>



