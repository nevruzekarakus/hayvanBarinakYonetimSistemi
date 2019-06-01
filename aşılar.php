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

if(mysqli_num_rows($result) > 0 ){
  while ($row = mysqli_fetch_array($result)){?>
 <tr>
       <td><?php echo $row['asiAD'];   ?></td>
       <td><?php echo $row['stokSayısı'];   ?></td>

 </tr>
<?php }} ?>


   
     
   
   
  </tbody>
</table>

</div>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>