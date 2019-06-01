<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
 include("header.php");

if ( isset( $_SESSION['login_user'] ) ) {
       
    
} else {
    // Redirect them to the login page
    header("Location: login.php");
}
?>


<div class="container" style="margin-top: 5%;">
	<div class="row" >
	  <div class="col-md-6">
        <input class="form-control" id="myInput" type="text" placeholder="Maliyet Arayın..">
        <table class="table table-striped table-dark">
          <thead>
            <tr>
                <th scope="col">Maliyet Adı</th>
                <th scope="col">Maliyet Tutarı</th>
            </tr>
          </thead>
          <tbody id="myTable">
<?php
   include("config.php");

 $bldID = mysqli_real_escape_string($db,$_SESSION['bldID']);

$sql = "SELECT *
FROM  maliyet
WHERE belediyeID = '$bldID'";

      $result = mysqli_query($db,$sql);
if ($result!="") {
if(mysqli_num_rows($result) > 0 ){
  while ($row = mysqli_fetch_array($result)){ ?>
 <tr>
       <td><?php echo $row['maliyetAdı'];   ?></td>
       <td><?php echo $row['maliyetTutarı'];   ?></td>

 </tr>
<?php }}} ?>

      </tbody>
  </table>
  <button id="btnEkle" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ekleMaliyetModal">Maliyet Ekle</button>

   </div>
	 <div class="col-md-6" >

       <input class="form-control" id="myInput2" type="text" placeholder="Gelir Arayın..">
       <table class="table table-striped table-dark">
         <thead>
            <tr>
                <th scope="col">Maliyet Adı</th>
                <th scope="col">Maliyet Tutarı</th>
            </tr>
         </thead>
         <tbody id="myTable2">
<?php

 $bldID = mysqli_real_escape_string($db,$_SESSION['bldID']);

$sql = "SELECT *
FROM  gelirler
WHERE belediyeID = '$bldID'";

      $result = mysqli_query($db,$sql);
if ($result!="") {
if(mysqli_num_rows($result) > 0 ){
  while ($row = mysqli_fetch_array($result)){?>
 <tr>
       <td><?php echo $row['gelirAdı'];   ?></td>
       <td><?php echo $row['gelirTutarı'];   ?></td>

 </tr>
<?php }}} ?>

  </tbody>
</table>
<button id="btnEkle2" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ekleGelirModal">Gelir Ekle</button>

    </div>
</div> 




</div>

<!-- Modal -->
<div class="modal fade" id="ekleMaliyetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="color: black;">
 <form   method="POST">

  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Maliyet Ekleme Paneli</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<div class="row">
 <div class="col-md-6">         
   <div class="form-group">
      <label for="stokAdetiInput">Maliyet Adı </label>
      <input name="maliyetAd" type="input" class="form-control" id="stokAdetiInput" aria-describedby="" placeholder="">
   </div>
 </div>
 <div class="col-md-6">         
   <div class="form-group">
      <label for="stokAdetiInput">Maliyet Tutarı</label>
      <input name="maliyetTutar" type="input" class="form-control" id="stokAdetiInput" aria-describedby="" placeholder="">
   </div>
 </div>
</div>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
        <button id="reload"type="submit" class="btn btn-primary">Ekle</button>
</div>
</div>
 </div>
 </form>
</div>
<!-- Modal -->
<div class="modal fade" id="ekleGelirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="color: black;">
 <form    method="POST">

  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Gelir Ekleme Paneli</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<div class="row">
 <div class="col-md-6">         
   <div class="form-group">
      <label for="stokAdetiInput">Gelir Adı </label>
      <input name="gelirAd" type="input" class="form-control" id="stokAdetiInput" aria-describedby="" placeholder="">
   </div>
 </div>
 <div class="col-md-6">         
   <div class="form-group">
      <label for="stokAdetiInput">Gelir Tutarı</label>
      <input name="gelirTutar" type="input" class="form-control" id="stokAdetiInput" aria-describedby="" placeholder="">
   </div>
 </div>
</div>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
        <button id="reload2" type="submit" class="btn btn-primary">Ekle</button>
</div>
</div>
 </div>
 </form>
</div>

<?php

         if($_SERVER["REQUEST_METHOD"] == "POST") {
              if ( isset( $_POST['maliyetAd'] ) &&isset( $_POST['maliyetTutar'] ) ) {
        
    
              
               $bldID = mysqli_real_escape_string($db,$_SESSION['bldID']);
               $maliyetAd = mysqli_real_escape_string($db,$_POST['maliyetAd']);
               $maliyetTutar = mysqli_real_escape_string($db,$_POST['maliyetTutar']); 
                         
               $sql="INSERT INTO maliyet (belediyeID,maliyetAdı,maliyetTutarı) VALUES ('$bldID','$maliyetAd','$maliyetTutar') " ;
               $result = mysqli_query($db,$sql);
               
              }
              if ( isset( $_POST['gelirTutar'] )&&isset( $_POST['gelirAd'] )  ) {
  
                      $bldID = mysqli_real_escape_string($db,$_SESSION['bldID']);
               $gelirAd = mysqli_real_escape_string($db,$_POST['gelirAd']);
               $gelirTutar = mysqli_real_escape_string($db,$_POST['gelirTutar']); 
                         
               $sql="INSERT INTO gelirler (belediyeID,gelirAdı,gelirTutarı) VALUES ('$bldID','$gelirAd','$gelirTutar') " ;
               $result = mysqli_query($db,$sql);
               
              }

         } 
?>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$(document).ready(function(){
  $("#myInput2").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable2 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});


$('#reload').click(function() {
   history.go(0);
});
$('#reload2').click(function() {
   history.go(0);
});



</script>
