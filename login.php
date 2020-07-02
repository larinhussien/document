<?php
$noNavbar=' ';
$noNavbar2=' ';
$pageTitle=' log in';
include 'init.php';


?>
<?php

// Check If User Coming From HTTP Post Request
if(isset($_POST['submit'])){
$email=htmlentities($_POST['email']);
$pass=($_POST['pass']);

$email1=mysqli_real_escape_string($conn,$email);
$pass1=mysqli_real_escape_string($conn,$pass);

$sql="SELECT  `id_employee`, `name_employee`, `email`, `password`,`task_id`,`id_college`,`dep`,`groub_id`
FROM `employee` WHERE `email`='{$email1}' LIMIT 1";

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
 // If Count > 0 This Mean The Database Contain Record About This Username
   if($result && mysqli_affected_rows($conn)>0)
   {
       $_SESSION['admin_id']=$row['id_employee'];
       $_SESSION['username']=$row['name_employee'];
       $_SESSION['task_id']=$row['task_id'];
       $_SESSION['departement']=$row['dep'];
       $_SESSION['college']=$row['id_college'];
       $_SESSION['group']=$row['groub_id'];

       if(password_verify($pass1,$row['password']))
       {
        if($_SESSION['group']==1){
            redicrt('admin/index.php');

        }


        if($_SESSION['task_id']==1){
            redicrt('department.php');

        }
        elseif($_SESSION['task_id']==3){
            redicrt('stagefrist.php');

        }
        elseif($_SESSION['task_id']==4){
            redicrt('stage2.php');

        }
        elseif($_SESSION['task_id']==5){
            redicrt('stage3.php');

        }
        elseif($_SESSION['task_id']==6){
            redicrt('stage4.php');

        }
        elseif($_SESSION['task_id']==7){
            redicrt('document.php');

        }

       }else{
          
        $_SESSION['msg']=error_msg_login();//message error
        redicrt('login.php');//Redirect To index page
       }
   }else{
       
       $_SESSION['msg']=error_msg_admin();//message error
       redicrt('login.php');//Redirect To index page
   }

}

?>

<div class="container-fluid">
    <div class="row">

<div class="signup-img">

    

</div>
  <!--sign up form -->
  <div class="card_signup">
      <header>
          <h2> Welcome </h2>
      </header>
					<?php echo msg(); ?>
                                <?php $errors=er(); ?>
                                  <?php errors_function($errors);
                             ?>
				
			
                <form  action='login.php' method='POST'>
                    <div class="form-group">
                        <span class="input-icons"> 
                                <i class="fa fa-envelope fa-2x"></i></span>
                        <input type="email" class="form-control" name="email" required autocomplete="off" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <span class="input-icons"> 
                                <i class="fa fa-lock fa-2x "></i></span>
                        <input type="password" class="form-control" name="pass" placeholder="password" autocomplete="new-password">
                    </div>
                <div class="link">
                
                    
                </div>
                <input class="btn btn-primary" type='submit' name='submit' value='Log IN'>
                <div class="link">
                Realy have account ?
                <a href="signup.php"> Sign Up</a>
                </div>
               
                

            </form>
            </div>
            </div>
            </div>

            <div class="signup-wave">
                <img src="layout/image/image7.png" alt="">
            </div>

              <div class="signup-wave2">
                <img src="layout/image/image7.png" alt="">
            </div>


            
<?php
include $tpl.'footer.php';
?>