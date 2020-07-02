<?php
/*
manage admin
Edit /delete /add /

*/
ob_start(); // Output Buffering Start


$pageTitle='subject';


include 'init.php';
check_login();
$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		if ($do == 'Manage') {
			$query="SELECT subjects.*, department.name_department AS department_name 
			FROM subjects 
			INNER JOIN department
			 ON department.id_department=subjects.`dep`
	
	
	";


         
			$result=mysqli_query($conn,$query);
			if(mysqli_num_rows($result)>0)
			{    
		
		?>
		<div class="formBox">
		<h1 class="text-center">subject</h1>
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
                        echo "<td>" . $row['id_subject'] . "</td>";
                        echo "<td>" . $row['name_subject'] . "</td>";
                        echo "<td>" . $row['department_name'] . "</td>";
						echo "<td>
							<a href='subject.php?do=Edit&id_subject=".$row['id_subject'] . "' class='btn btn-success' ><i class='fa fa-edit'></i> Edit</a>
							<a href='subject.php?do=Delete&id_subject=" . $row['id_subject'] . "' class='btn btn-danger confirm s><i class='fa fa-close'></i> Delete </a>";
					  echo "</td>";
					 echo "</tr>";
				}
			?>
		<?php
			  ?>
			<tr>
		</table>
		</div>
		<a href="subject.php?do=Add" class="btn btn-primary">
		<i class="fa fa-plus"></i> New subject
		</a>
		</div>
           
		<?php
	    }else{

		echo '<div class="container">';
	   echo '<div class="nice-message">There\'s No Members To Show</div>';
	   echo '<a href="subject.php?do=Add" class="btn btn-primary">
	   <i class="fa fa-plus"></i> New subject
			</a>';
		   echo '</div>';
   
	   } ?>
		
          <?php
		} elseif ($do == 'Add') {
            ?>
		<div class="col-md-8 offset-md-2">
		<span class="anchor" id="formUserEdit">
	      Add New subject
		</span>
		<div class="header-a">
		<a href="#"> <span class="homeicon">
		<i class="fa fa-home "> </i> Home </span> </a>
		  /
		<a href="#">  <span class="adminicon">
		  <i class="fa fa-admin"></i> subject</span> </a>
		  /
		 new subject
		 
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
                                 foreach ($row as $i){
                                    echo "<option value='" . $i['id_department'] . "'>" . $i['name_department'] . "</option>";
								 }
                                ?>  	
							</select>
						</div>
				</div>
				<div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label">stage</label>
						<div class="col-lg-9">
					<select name="stage" id="user_time_zone" class="form-control" >
					<option value="0">..................</option>
					<?php
                                 $query="SELECT `stage_id`, `name_stage` FROM `stage` ";
                                 $result=mysqli_query($conn,$query);
                                 $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row as $u){
                                    echo "<option value='" . $u['stage_id'] . "'>" . $u['name_stage'] . "</option>";
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
			$stage=$_POST['stage'];
			
          
    if(!empty($errors)){
        $_SESSION['errors']=$errors;
        redicrt("?do=Add");
    }else{
         $sql="INSERT INTO `subjects`(`name_subject`,`stage_id`, `dep`) 
         VALUES ('{$name}','{$stage}','{$department}') ";
            
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
	    Edit Info subject
		</span>
		<div class="header-a">
		<a href="#"> <span class="homeicon">
		<i class="fa fa-home "> </i> Home </span> </a>
		  /
		<a href="#">  <span class="adminicon">
		  <i class="fa fa-admin"></i> subject</span> </a>
		  /
		 Edit Info subject
		 
		  </div>
		  <?php echo msg(); ?>
					<?php $errors=er(); ?>
					  <?php errors_function($errors);
				 ?>
				 <?php

			$id_subject = isset($_GET['id_subject']) && is_numeric($_GET['id_subject']) ? intval($_GET['id_subject']) : 0;
			$query="SELECT * FROM `subjects` WHERE id_subject=$id_subject LIMIT 1 "   ;
			$result=mysqli_query($conn,$query);
			$row=mysqli_fetch_assoc($result);
			if($result && mysqli_affected_rows($conn)>0)
		{
			?>
			<!-- form user info -->
			<div class="card card-outline-secondary">
				<div class="card-body">
					<form class="form" role="form" action="?do=Update" method="POST">
					<input type="hidden" name="id_subject" value="<?php echo $id_subject ?>" />
						<div class="form-group row">
							<label class="col-lg-3 col-form-label form-control-label">Name</label>
							<div class="col-lg-9">
							 <input class="form-control" type="text"  name="name"
							  autocomplete="off" required="required" 
							  value="<?php echo $row['name_subject'] ?>"
							 >
							</div>
						</div>
						
                        
                        <div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label"> department</label>
						<div class="col-lg-9">
						<select  name="name_college" id="user_time_zone" class="form-control" size="0">
						<?php
                                 $query="SELECT `id_department`, `name_department` FROM `department` ";
                
                                 $result=mysqli_query($conn,$query);
                                 $row1=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row1 as $u){
									echo "<option value='" . $u['id_department'] . "'";
                                    if ($row['dep']== $u['id_department']) 
                                    { 
                                        echo 'selected';
                                    
                                    }
                                    
                                    
                                    echo ">" . $u['name_department'] . "</option>";
                                }
                                ?>
                                 
						 </select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label">stage</label>
						<div class="col-lg-9">
					<select name="stage" id="user_time_zone" class="form-control" >
					<option value="0">..................</option>
					<?php
                                 $query="SELECT `stage_id`, `name_stage` FROM `stage` ";
                                 $result=mysqli_query($conn,$query);
                                 $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row as $u){
                                    echo "<option value='" . $u['stage_id'] . "'>" . $u['name_stage'] . "</option>";
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
                $id= $_POST['id_subject'];
				$name=mysqli_real_escape_string($conn,$_POST["name"]);
				$department=$_POST["department"];
				$stage=$_POST['stage'];
                if(!empty($errors)){
                $_SESSION['errors']=$errors;
                redicrt("?do=Add");
                }else{
                $sql="UPDATE `subjects` SET
                            `name_subject`='{$name}',
                            `dep`='{$college}' ,
							`stage_id`='{$stage}'
							
							WHERE `id_subject`='{$id}'
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
        
          
				$id_subject = isset($_GET['id_subject']) && is_numeric($_GET['id_subject']) ? intval($_GET['id_subject']) : 0;
                // Select All Data Depend On This   
        
               
                $sql="DELETE FROM `subjects` WHERE id_subject={$id_subject} LIMIT 1";
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