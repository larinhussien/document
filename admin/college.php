<?php
/*
manage admin
Edit /delete /add /

*/
ob_start(); // Output Buffering Start


$pageTitle='College';


include 'init.php';
check_login();
$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		if ($do == 'Manage') {
            $query="SELECT `id_college`, `name_college`, `description` FROM `college`";
			$result=mysqli_query($conn,$query);
			if(mysqli_num_rows($result)>0)
			{    
		
		?>
		<div class="formBox">
		<h1 class="text-center">College</h1>
					<?php echo msg(); ?>
					<?php $errors=er(); ?>
					  <?php errors_function($errors);
				 ?>
		<div class="container">
		<div class="table-responsive">
		<table class="main-table text-center table table-bordered" >
			<tr>
				<td>#ID</td>
				<td>Name</td>
				<td>Description</td>
                <td>control</td>
			</tr>
			<?php 
			while($row=mysqli_fetch_assoc($result)){
			
					echo "<tr>";
						echo "<td>" . $row['id_college'] . "</td>";
						echo "<td>" . $row['name_college'] . "</td>";
						echo "<td>" . $row['description'] . "</td>";
					
						echo "<td>
							<a href='college.php?do=Edit&id_college=".$row['id_college'] . "' class='btn btn-success' ><i class='fa fa-edit'></i> Edit</a>
							<a href='college.php?do=Delete&id_college=" . $row['id_college'] . "' class='btn btn-danger confirm s><i class='fa fa-close'></i> Delete </a>";
					  echo "</td>";
					 echo "</tr>";
				}
			?>
		<?php
			  ?>
			<tr>
		</table>
		</div>
		<a href="college.php?do=Add" class="btn btn-primary">
		<i class="fa fa-plus"></i> New college
		</a>
		</div>
           
		<?php
	    }else{

		echo '<div class="container">';
	   echo '<div class="nice-message">There\'s No Members To Show</div>';
	   echo '<a href="college.php?do=Add" class="btn btn-primary">
	   <i class="fa fa-plus"></i> New college
			</a>';
		   echo '</div>';
   
	   } ?>
		
          <?php
		} elseif ($do == 'Add') {
            ?>
		<div class="col-md-8 offset-md-2">
		<span class="anchor" id="formUserEdit">
	      Add New college
		</span>
		<div class="header-a">
		<a href="#"> <span class="homeicon">
		<i class="fa fa-home "> </i> Home </span> </a>
		  /
		<a href="#">  <span class="adminicon">
		  <i class="fa fa-admin"></i> college</span> </a>
		  /
		 new college
		 
		  </div>
		  <?php echo msg(); ?>
					<?php $errors=er(); ?>
					  <?php errors_function($errors);
				 ?>
	 
		<!-- form user info -->
		<div class="card card-outline-secondary">
			<div class="card-body">
				<form class="form" role="form" action="?do=Insert" method="POST">
					<div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label"> Name </label>
						<div class="col-lg-9">
						 <input class="form-control" type="text"  name="name" autocomplete="off" required="required" placeholder="Name">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label">Description</label>
						<div class="col-lg-9">
							<textarea class="form-control" type="text" name="desc"   autocomplete="off">
							</textarea>
                        </div>
					</div>
					<div class="row">
					<div class="col-lg-9">
					<input type="submit" value="save" class="btn btn-lg btn-block add_btn" name="submit" >
					</div>
				</div>
				</form>
			</div>
		</div>
		<!-- /form college info -->

<?php
            
	} elseif ($do == 'Insert') {
        if(isset($_POST['submit'])){
            $name=mysqli_real_escape_string($conn,$_POST["name"]);
            $desc=mysqli_real_escape_string($conn,$_POST["desc"]);
          
    if(!empty($errors)){
        $_SESSION['errors']=$errors;
        redicrt("?do=Add");
    }else{
         $sql="INSERT INTO `college`(`name_college`, `description`) 
                VALUES ('{$name}','{$desc}') ";
            
                if (mysqli_query($conn, $sql) && mysqli_affected_rows($conn)>0) {
                $_SESSION['msg']=secusse_msg_admin();
                  redicrt("?do=Manage");
                }else{
                        $_SESSION['msg']=error_msg_admin();
                        redicrt("?do=Add");
                        
                    }

            
          }
      }


//end insert page
        
		} elseif ($do == 'Edit') {
            ?>
			<div class="col-md-8 offset-md-2">
		<span class="anchor" id="formUserEdit">
	    Edit Info college
		</span>
		<div class="header-a">
		<a href="#"> <span class="homeicon">
		<i class="fa fa-home "> </i> Home </span> </a>
		  /
		<a href="#">  <span class="adminicon">
		  <i class="fa fa-admin"></i> college</span> </a>
		  /
		 Edit Info college
		 
		  </div>
		  <?php echo msg(); ?>
					<?php $errors=er(); ?>
					  <?php errors_function($errors);
				 ?>
				 <?php

			$id_college = isset($_GET['id_college']) && is_numeric($_GET['id_college']) ? intval($_GET['id_college']) : 0;
			$query="SELECT * FROM `college` WHERE id_college=$id_college    LIMIT 1 "   ;
			$result=mysqli_query($conn,$query);
			$row=mysqli_fetch_assoc($result);
			if($result && mysqli_affected_rows($conn)>0)
		{
			?>
			<!-- form user info -->
			<div class="card card-outline-secondary">
				<div class="card-body">
					<form class="form" role="form" action="?do=Update" method="POST">
					<input type="hidden" name="id_college" value="<?php echo $id_college ?>" />
						<div class="form-group row">
							<label class="col-lg-3 col-form-label form-control-label">Name</label>
							<div class="col-lg-9">
							 <input class="form-control" type="text"  name="name"
							  autocomplete="off" required="required" 
							  value="<?php echo $row['name_college'] ?>"
							  placeholder="Username">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 col-form-label form-control-label">description</label>
							<div class="col-lg-9">
								<textarea class="form-control" type="text" name="desc" 
								value="<?php echo $row['description'] ?>"
                                 autocomplete="off">
								</textarea>
							</div>
						</div>
					
						<div class="row">
						<div class="col-lg-9">
						<input type="submit" value="save" class="btn btn-lg btn-block add_btn" name="submit" >
						</div>
					</div>
					</form>
				</div>
			</div>
			<!-- /form user info -->
 <?php
        }



		
		} elseif ($do == 'Update') {
            if(isset($_POST['submit'])){
                $id= $_POST['id_college'];
                $name=mysqli_real_escape_string($conn,$_POST["name"]);
                $desc=mysqli_real_escape_string($conn,$_POST["desc"]);
                if(!empty($errors)){
                $_SESSION['errors']=$errors;
                redicrt("?do=Add");
                }else{
                $sql="UPDATE `college` SET `name_college`='{$name}',`description`='{$desc}'
                 WHERE `id_college`='{$id}' ";
                        if (mysqli_query($conn, $sql) && mysqli_affected_rows($conn)>0) {
                        $_SESSION['msg']=secusse_msg_admin();
                        redicrt("?do=Manage");
                        }else{
                                $_SESSION['msg']=error_msg_admin();
                                redicrt("?do=Edit");
                                
                            }

                
                            }
            }



		} elseif ($do == 'Delete') {

            echo "<h1 class='text-center'>Delete Member</h1>";
            echo "<div class='container'>";
        
                // Check If Get Request userid Is Numeric & Get The Integer Value Of It
        
                $id_college = isset($_GET['id_college']) && is_numeric($_GET['id_college']) ? intval($_GET['id_college']) : 0;
              
        
                // Select All Data Depend On This   
        
               
                $sql="DELETE FROM `college` WHERE id_college={$id_college} LIMIT 1";
                    $result=mysqli_query($conn,$sql);
                        if ( $result && mysqli_affected_rows($conn)>0) {
                                
                                
                            $_SESSION['msg']=secusse_msg_delete();
                            redicrt("?do=Manage");
                                
                            }else{
                                
                                $_SESSION['msg']= error_msg_delete();
                                redicrt("?do=Manage");
                                }
                            
     }
    ?>

    <?php
    ob_end_flush(); // Release The Output
    include $tpl.'footer.php';
    ?>