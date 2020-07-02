<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="layoutp/image/3.png" style="width: 50px; height: 46px; "></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    
 
    </ul>



    <ul class="navbar-nav">
   <?php if(isset($_SESSION['admin_id']))
  {?>
  
    <li class="nav-item">
      <a class="nav-link" href="#"><?php echo $_SESSION['username']?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php">LOGOUT</a>
    </li>
   <?php
    }else
  {
     ?>
        <li class="nav-item">
      <a class="nav-link" href="login.php">SIGN IN</a>
    </li>
   
   
  <?php
  }

 echo ' </ul>';

  ?>



  
</nav>
<!--end navbar -->