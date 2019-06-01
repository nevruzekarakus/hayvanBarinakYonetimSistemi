
<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
include("header.php");


?>


<div class="container" style="margin-top: 5%;">
  <input class="form-control" id="myInput" type="text" placeholder="Hayvan Arayın..">
<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Tür Adı</th>
      <th scope="col">Cinsiyet</th>
      <th scope="col">Kayıt Tarihi</th>
      <th scope="col">Sağlık Durumu</th>
      <th scope="col">Maliyeti</th>
      <th scope="col">Yaşı</th>
    </tr>
  </thead>
  <tbody id="myTable">

<?php
   include("config.php");

$bldID = mysqli_real_escape_string($db,$_SESSION['bldID']);


$sql="SELECT * from belediye_hayvan
 INNER JOIN hayvan ON hayvan.id=belediye_hayvan.hayvanID
 INNER JOIN tür ON tür.türID=hayvan.türID
 where belediye_hayvan.belediyeID='$bldID' ";

 $result = mysqli_query($db,$sql);


if ($result!="") {
  
if(mysqli_num_rows($result) > 0 ){
  while ($row = mysqli_fetch_array($result)){ ?>
 <tr>
       <td><?php echo $row['id'];   ?>  </td>
       <td><?php echo $row['ad'];   ?> </td>
       <td><?php echo $row['cinsiyet'];   ?></td>
       <td><?php echo $row['kayıtTarihi'];   ?></td>
       <td><?php echo $row['sağlıkDurumu'];   ?></td>
       <td><?php echo $row['maliyet']." TL";   ?></td>
       <td><?php echo $row['yaşı'];   ?></td>
 </tr>
<?php } } } 
?> </tbody>
</table>

<button id="btnEkle" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ekleModal">Yeni Hayvan Kaydı</button>



</div>

<!-- Modal -->
<div class="modal fade" id="ekleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="color: black;">
 <form name="form" id="stokEkleForm"  method="POST">

  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Hayvan Kayıt Paneli</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<div class="row">
<div class="col-md-6">         
 <div class="form-group">
    <label for="exampleFormControlSelect1">Tür Adı Seçiniz..</label>
    <select name="turID" class="form-control" id="exampleFormControlSelect1">
      <?php
         $sql = "SELECT* FROM tür ORDER BY ad ";
         $result = mysqli_query($db,$sql);

         if(mysqli_num_rows($result) > 0 ){
              while ($row = mysqli_fetch_array($result)){     ?>
                    <option value="<?php echo $row['türID']; ?>" > <?php echo $row['ad']; ?></option>
<?php }} 
?>
    </select>
  </div> 
 </div>
 <div class="col-md-6">   
 <div class="form-group">
    <label for="exampleFormControlSelect1">Cinsiyet Türü Seçiniz..</label>      
   <select name="cinsiyet" class="form-control" id="exampleFormControlSelect1">
             <option value="disi">dişi</option>
             <option value="erkek">erkek</option>
    </select>
    </div>
 </div>
</div>

<div class="row">
<div class="col-md-6">         
 <div class="form-group">
      <label for="exampleFormControlSelect1">Kayıt Tarihi Seçiniz..</label>      
                <div class='input-group date' id='datetimepicker1'>
                    <input name="tarih"type='date' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
 </div>
 </div>
 <div class="col-md-6">         
   <div class="form-group">
      <label for="stokAdetiInput">Sağlık Durumu</label>
      <input name="saglik" type="input" class="form-control" id="stokAdetiInput" aria-describedby="" placeholder="">
   </div>
 </div>
</div>

<div class="row">
<div class="col-md-6">         
  <div class="form-group">
      <label for="stokAdetiInput">Maliyet</label>
      <input name="maliyet" type="input" class="form-control" id="stokAdetiInput" aria-describedby="" placeholder="">
   </div>
 </div>
 <div class="col-md-6">         
   <div class="form-group">
      <label for="stokAdetiInput">Yaş</label>
      <input name="yas" type="input" class="form-control" id="stokAdetiInput" aria-describedby="" placeholder="">
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

               $bldID = $_SESSION['bldID'];
               $türID = $_POST['turID'];
               $cinsiyet = mysqli_real_escape_string($db,$_POST['cinsiyet']); 
               $tarih = mysqli_real_escape_string($db,$_POST['tarih']); 
               $saglik = mysqli_real_escape_string($db,$_POST['saglik']); 
               $maliyet = mysqli_real_escape_string($db,$_POST['maliyet']); 
               $yas = mysqli_real_escape_string($db,$_POST['yas']); 

               
               $sql="INSERT INTO hayvan (türID, cinsiyet, kayıtTarihi, sağlıkDurumu, maliyet, yaşı) VALUES ('$türID','$cinsiyet','$tarih','$saglik','$maliyet','$yas')" ;
              
               if (mysqli_query($db, $sql)) {
                   $last_id = mysqli_insert_id($db);
                   $sql="INSERT INTO belediye_hayvan (belediyeID,hayvanID) VALUES ('$bldID','$last_id')" ;
                   $result=mysqli_query($db, $sql);

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


