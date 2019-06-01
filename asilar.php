<?php include("header.php");?>

<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first


if ( isset( $_SESSION['login_user'] ) ) {
       
    
} else {
    // Redirect them to the login page
    header("Location: login.php");
}
?>


<div class="container" style="margin-top: 5%;">
  <input class="form-control" id="myInput" type="text" placeholder="Aşı Arayın..">
<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">Aşı Adı</th>
      <th scope="col">Stok Sayısı</th>
    </tr>
  </thead>
  <tbody id="myTable">
<?php
   include("config.php");

 $myusername = mysqli_real_escape_string($db,$_SESSION['login_user']);      
$sql = "SELECT *
FROM belediye_asi ba
INNER JOIN belediye b ON b.belediyeID=ba.belediyeID
INNER JOIN asi a ON a.asiID=ba.asiID
WHERE b.belediyeAdi = '$myusername'";

      $result = mysqli_query($db,$sql);
if ($result!="") {
if(mysqli_num_rows($result) > 0 ){
  while ($row = mysqli_fetch_array($result)){?>
 <tr>
       <td><?php echo $row['asiAD'];   ?></td>
       <td><?php echo $row['stokSayısı'];   ?></td>

 </tr>
<?php }}} ?>


   
     
   
   
  </tbody>
</table>

<button id="btnEkle" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ekleModal">Aşı Stoğu Ekle</button>



</div>

<!-- Modal -->
<div class="modal fade" id="ekleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="color: black;">
 <form name="form" id="stokEkleForm"  method="POST">

  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Aşı Ekleme Paneli</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<div class="row">
<div class="col-md-6">         
 <div class="form-group">
    <label for="exampleFormControlSelect1">Aşı Adı Seçiniz..</label>
    <select name="asiAd" class="form-control" id="exampleFormControlSelect1">
      <?php
         $sql = "SELECT* FROM asi ORDER BY asiAD ";
         $result = mysqli_query($db,$sql);

         if(mysqli_num_rows($result) > 0 ){
              while ($row = mysqli_fetch_array($result)){?>
                    <option value="<?php echo $row['asiID']; ?>"><?php echo $row['asiAD']; ?></option>
      <?php }} ?>
    </select>
  </div>
 </div>
 <div class="col-md-6">         
   <div class="form-group">
      <label for="stokAdetiInput">Stok Adeti</label>
      <input name="stokSayısı" type="input" class="form-control" id="stokAdetiInput" aria-describedby="" placeholder="">
   </div>
 </div>
</div>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
        <button id="reload" type="submit" class="btn btn-primary">Ekle</button>
</div>
</div>
 </div>
 </form>
</div>
<?php

         if($_SERVER["REQUEST_METHOD"] == "POST") {

               $bldAD = mysqli_real_escape_string($db,$_SESSION['login_user']);
               $bldID = mysqli_real_escape_string($db,$_SESSION['bldID']);
               $asiID = mysqli_real_escape_string($db,$_POST['asiAd']);
               $stokSayısı = mysqli_real_escape_string($db,$_POST['stokSayısı']); 
               $sql = "SELECT ba.stokSayısı
                      FROM belediye_asi ba
                      INNER JOIN belediye b ON b.belediyeID=ba.belediyeID
                      INNER JOIN asi a ON a.asiID=ba.asiID
                      WHERE b.belediyeAdi = '$bldAD' AND ba.asiID= '$asiID' ";
               $result = mysqli_query($db,$sql);
               $count = mysqli_num_rows($result);
               if ($count==1) {
                  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                  $stokSayısı= $stokSayısı+$row['stokSayısı'];
                  $sql="UPDATE belediye_asi SET stokSayısı = '$stokSayısı' where asiID='$asiID' and belediyeID='$bldID' ";
                  $result = mysqli_query($db,$sql);
               }
               else{
                  $sql="INSERT INTO belediye_asi (belediyeID,asiID,stokSayısı) VALUES ('$bldID','$asiID','$stokSayısı') " ;
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

$('#reload').click(function() {
   history.go(0);
});

</script>