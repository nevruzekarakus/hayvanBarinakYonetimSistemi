
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="css/main.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">HAYVAN BARINAK YÖNETİM SİSTEMİ</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fa fa-home"></i>
          Anasayfa
          <span class="sr-only">(current)</span>
          </a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link disabled" href="istatistikler.php">
          <i class="fa fa-envelope-o">
            <span class="badge badge-warning">4</span>
          </i>
          İstatistikler
        </a>
      </li>
    </ul>  
   Hoşgeldin <?php session_start(); echo $_SESSION['login_user']; 

if ( isset( $_SESSION['login_user'] ) ) {
       
    
} else {
    // Redirect them to the login page
    header("Location: login.php");
}

   ?>
      <a href="logout.php" class="btn btn-danger" style="margin-left: 2%; ">Logout</a> 
    
  </div>
</nav>



