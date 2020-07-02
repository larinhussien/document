<?php
/*
manage admin
Edit /delete /add /

*/
ob_start(); // Output Buffering Start


$pageTitle='Stage';


include 'init.php';
check_login();
$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		if ($do == 'Manage') {


            $query="SELECT stage.*, department.name_department AS department_name 
                    FROM stage 
                    INNER JOIN department
                     ON department.id_department=stage.id_department
            
            
            ";
			$result=mysqli_query($conn,$query);
			if(mysqli_num_rows($result)>0)
			{    
		
		?>
		<div class="formBox">
		<h1 class="text-center">stage</h1>
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
                <td>department</td>
                <td>control</td>
			</tr>
			<?php 
			while($row=mysqli_fetch_assoc($result)){
			
					echo "<tr>";
                        echo "<td>" . $row['stage_id'] . "</td>";
                        echo "<td>" . $row['name_stage'] . "</td>";
                        echo "<td>" . $row['department_name'] . "</td>";
						echo "<td>
							<a href='stage.php?do=Edit&id_stage=".$row['stage_id'] . "' class='btn btn-success' ><i class='fa fa-edit'></i> Edit</a>
							<a href='stage.php?do=Delete&id_stage=" . $row['stage_id'] . "' class='btn btn-danger confirm s><i class='fa fa-close'></i> Delete </a>";
					  echo "</td>";
					 echo "</tr>";
				}
			?>
		<?php
			  ?>
			<tr>
		</table>
		</div>
		<a href="stage.php?do=Add" class="btn btn-primary">
		<i class="fa fa-plus"></i> New stage
		</a>
		</div>
           
		<?php
	    }else{

		echo '<div class="container">';
	   echo '<div class="nice-message">There\'s No Members To Show</div>';
	   echo '<a href="stage.php?do=Add" class="btn btn-primary">
	   <i class="fa fa-plus"></i> New stage
			</a>';
		   echo '</div>';
   
	   } ?>
		
          <?php
		} elseif ($do == 'Add') {
            ?>
		<div class="col-md-8 offset-md-2">
		<span class="anchor" id="formUserEdit">
	      Add New stege
		</span>
		<div class="header-a">
		<a href="#"> <span class="homeicon">
		<i class="fa fa-home "> </i> Home </span> </a>
		  /
		<a href="#">  <span class="adminicon">
		  <i class="fa fa-admin"></i> stage</span> </a>
		  /
		 new stage
		 
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
						 <input class="form-control" type="text"  name="name" autocomplete="off" required="required" placeholder="Full name">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label"> department</label>
						<div class="col-lg-9">
					<select name="department" id="user_time_zone" class="form-control" >
					<option value="0">..................</option>
					<?php
                                 $query="SELECT `id_department`, `name_department` FROM `department` ";
                                 $result=mysqli_query($conn,$query);
                                 $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row as $u){
                                    echo "<option value='" . $u['id_department'] . "'>" . $u['name_department'] . "</option>";
                                }
                                ?>  	
							</select>
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
			$department=$_POST["department"];
			
          
    if(!empty($errors)){
        $_SESSION['errors']=$errors;
        redicrt("?do=Add");
    }else{
         $sql="INSERT INTO `stage`(`name_stage`, `id_department`) 
         VALUES ('{$name}','{$department}') ";
            
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
	    Edit Info stage
		</span>
		<div class="header-a">
		<a href="#"> <span class="homeicon">
		<i class="fa fa-home "> </i> Home </span> </a>
		  /
		<a href="#">  <span class="adminicon">
		  <i class="fa fa-admin"></i> stage</span> </a>
		  /
		 Edit Info stage
		 
		  </div>
		  <?php echo msg(); ?>
					<?php $errors=er(); ?>
					  <?php errors_function($errors);
				 ?>
				 <?php

			$id_stage = isset($_GET['id_stage']) && is_numeric($_GET['id_stage']) ? intval($_GET['id_stage']) : 0;
			$query="SELECT * FROM `stage` WHERE stage_id=$id_stage LIMIT 1 "   ;
			$result=mysqli_query($conn,$query);
			$row=mysqli_fetch_assoc($result);
			if($result && mysqli_affected_rows($conn)>0)
		{
			?>
			<!-- form user info -->
			<div class="card card-outline-secondary">
				<div class="card-body">
					<form class="form" role="form" action="?do=Update" method="POST">
					<input type="hidden" name="id_stage" value="<?php echo $id_stage ?>" />
						<div class="form-group row">
							<label class="col-lg-3 col-form-label form-control-label">Name</label>
							<div class="col-lg-9">
							 <input class="form-control" type="text"  name="name"
							  autocomplete="off" required="required" 
							  value="<?php echo $row['name_stage'] ?>"
							 >
							</div>
						</div>
					
                        
                        <div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label"> department</label>
						<div class="col-lg-9">
						<select  name="department" id="user_time_zone" class="form-control" size="0">
						<?php
                                 $query="SELECT `id_department`, `name_department` FROM `department` ";
                                 $result=mysqli_query($conn,$query);
                                 $row1=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row1 as $u){
									echo "<option value='" . $u['id_department'] . "'";
                                    if ($row['id_department']== $u['id_department']) 
                                    { 
                                        echo 'selected';
                                    
                                    }
                                    
                                    
                                    echo ">" . $u['name_department'] . "</option>";
                                }
                                ?>
                                 
						 </select>
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
                $id= $_POST['id_stage'];
				$name=mysqli_real_escape_string($conn,$_POST["name"]);
				$department=$_POST["department"];
                if(!empty($errors)){
                $_SESSION['errors']=$errors;
                redicrt("?do=Add");
                }else{
                $sql="UPDATE `stage` SET
                            `name_stage`='{$name}',
                            `id_department`='{$department}' 
							WHERE `stage_id`='{$id}'
                            ";
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
				
				$id_stage = isset($_GET['id_stage']) && is_numeric($_GET['id_stage']) ? intval($_GET['id_stage']) : 0;
			
        
             
              
        
                // Select All Data Depend On This   
        
               
                $sql="DELETE FROM `stage` WHERE stage_id={$id_stage} LIMIT 1";
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