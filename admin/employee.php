<?php
/*
manage admin
Edit /delete /add /

*/
ob_start(); // Output Buffering Start


$pageTitle='Employee';


include 'init.php';

$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		if ($do == 'Manage') {


            $query="SELECT employee.*, college.name_college 
                    AS College_Name
                    FROM employee 
                    INNER JOIN college 
                    ON college.id_college=employee.id_college
					where groub_id=0
            
            
            ";
			$result=mysqli_query($conn,$query);
			if(mysqli_num_rows($result)>0)
			{    
		
		?>
		<div class="formBox">
		<h1 class="text-center">Employee</h1>
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
				<td>email</td>
				<td>task</td>
                <td>college</td>
                <td>control</td>
			</tr>
			<?php 
			while($row=mysqli_fetch_assoc($result)){
			
					echo "<tr>";
                        echo "<td>" . $row['id_employee'] . "</td>";
                        echo "<td>" . $row['name_employee'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['task_id'] . "</td>";

                        echo "<td>" . $row['College_Name'] . "</td>";
						echo "<td>
							<a href='employee.php?do=Edit&id_employee=".$row['id_employee'] . "' class='btn btn-success' ><i class='fa fa-edit'></i> Edit</a>
							<a href='employee.php?do=Delete&id_employee=" . $row['id_employee'] . "' class='btn btn-danger confirm s><i class='fa fa-close'></i> Delete </a>";
					  echo "</td>";
					 echo "</tr>";
				}
			?>
		<?php
			  ?>
			<tr>
		</table>
		</div>
		<a href="employee.php?do=Add" class="btn btn-primary">
		<i class="fa fa-plus"></i> New employee
		</a>
		</div>
           
		<?php
	    }else{

		echo '<div class="container">';
	   echo '<div class="nice-message">There\'s No Members To Show</div>';
	   echo '<a href="employee.php?do=Add" class="btn btn-primary">
	   <i class="fa fa-plus"></i> New employee
			</a>';
		   echo '</div>';
   
	   } ?>
		
          <?php
		} elseif ($do == 'Add') {
            ?>
		<div class="col-md-8 offset-md-2">
		<span class="anchor" id="formUserEdit">
	      Add New employee
		</span>
		<div class="header-a">
		<a href="#"> <span class="homeicon">
		<i class="fa fa-home "> </i> Home </span> </a>
		  /
		<a href="#">  <span class="adminicon">
		  <i class="fa fa-admin"></i> employee</span> </a>
		  /
		 new employee
		 
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
						<label class="col-lg-3 col-form-label form-control-label"> email </label>
						<div class="col-lg-9">
						 <input class="form-control" type="email"  name="email" autocomplete="off" required="required" placeholder="Email">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label"> password </label>
						<div class="col-lg-9">
						 <input class="form-control" type="password"  name="pass" autocomplete="off" required="required" placeholder="password">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label"> Task</label>
						<div class="col-lg-9">
					<select name="status" id="user_time_zone" class="form-control" >
					<option value="0">..................</option>
					<?php
                                 $query="SELECT `id_task`, `name_task` FROM `task`";
                                 $result=mysqli_query($conn,$query);
                                 $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row as $u){
                                    echo "<option value='" . $u['id_task'] . "'>" . $u['name_task'] . "</option>";
                                }
                                ?>  	
							</select>
						</div>
					</div>
                    <div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label"> college</label>
						<div class="col-lg-9">
						<select  name="name_college" id="user_time_zone" class="form-control" size="0">
						<option value="0">..................</option>
						<?php
                                 $query="SELECT `id_College`, `name_College` FROM `college` ";
                                 $result=mysqli_query($conn,$query);
                                 $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row as $u){
                                    echo "<option value='" . $u['id_College'] . "'>" . $u['name_College'] . "</option>";
                                }
                                ?>  
						 </select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label"> Department</label>
						<div class="col-lg-9">
						<select  name="name_departemt" id="user_time_zone" class="form-control" size="0">
						<option value="0">..................</option>
						<?php
                                 $query="SELECT `id_department`, `name_department` FROM `department` ";
                                 $result=mysqli_query($conn,$query);
                                 $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row as $m){
                                    echo "<option value='" . $m['id_department'] . "'>" . $m['name_department'] . "</option>";
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
            $username=mysqli_real_escape_string($conn,$_POST["name"]);
			$email=mysqli_real_escape_string($conn,$_POST["email"]);
			$pass=mysqli_real_escape_string($conn,$_POST["pass"]);
			$pass1=password_hash($pass,PASSWORD_BCRYPT);
			$college=$_POST["name_college"];
			$dep=$_POST["name_departemt"];
			$status=$_POST["status"];
			
          
    if(!empty($errors)){
        $_SESSION['errors']=$errors;
        redicrt("?do=Add");
    }else{
         $sql="INSERT INTO `employee`(`name_employee`, `email`, `password`,`task_id`, `id_college`, `groub_id`,`dep`) 
		 VALUES ('{$username}','{$email}','{$pass1}','{$status}','{$college}',0,'{$dep}')";
            
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
	    Edit Info employee
		</span>
		<div class="header-a">
		<a href="#"> <span class="homeicon">
		<i class="fa fa-home "> </i> Home </span> </a>
		  /
		<a href="#">  <span class="adminicon">
		  <i class="fa fa-admin"></i> Employee</span> </a>
		  /
		 Edit Info employee
		 
		  </div>
		  <?php echo msg(); ?>
					<?php $errors=er(); ?>
					  <?php errors_function($errors);
				 ?>
				 <?php

			$id_employee = isset($_GET['id_employee']) && is_numeric($_GET['id_employee']) ? intval($_GET['id_employee']) : 0;
			$query="SELECT * FROM `employee` WHERE id_employee=$id_employee LIMIT 1 "   ;
			$result=mysqli_query($conn,$query);
			$row=mysqli_fetch_assoc($result);
			if($result && mysqli_affected_rows($conn)>0)
		{
			?>
			<!-- form user info -->
			<div class="card card-outline-secondary">
				<div class="card-body">
					<form class="form" role="form" action="?do=Update" method="POST">
					<input type="hidden" name="id_admin" value="<?php echo $id_employee ?>" />
					
						<div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label"> Name </label>
						<div class="col-lg-9">
						 <input class="form-control" type="text" 
						  name="name" autocomplete="off" required="required"
						  value="<?php echo $row['name_employee'] ?>"
						  >
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label"> email </label>
						<div class="col-lg-9">
						 <input class="form-control" type="email"  
						 name="email" autocomplete="off" required="required" 
						 value="<?php echo $row['email'] ?>"
						 >
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label"> password </label>
						<div class="col-lg-9">
						 <input class="form-control" type="password"  name="pass" autocomplete="off" required="required" placeholder="password">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label"> Task</label>
						<div class="col-lg-9">
					<select name="status" id="user_time_zone" class="form-control" >
					<option value="0">task<option>
					<?php
                                 $query="SELECT `id_task`, `name_task` FROM `task`";
                                 $result=mysqli_query($conn,$query);
                                 $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row as $u){
                                    echo "<option value='" . $u['id_task'] . "'>" . $u['name_task'] . "</option>";
                                }
                                ?>  	
							</select>
						</div>
					</div>
                  
					<div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label"> college</label>
						<div class="col-lg-9">
						<select  name="name_college" id="user_time_zone" class="form-control" size="0">

						<?php
						$query="SELECT `id_College`, `name_College` FROM `college`";
                                 $result=mysqli_query($conn,$query);
                                 $row1=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row1 as $s){
									echo "<option value='" . $s['id_College'] . "'>" . $s['name_College'] . "</option>";
								 }
									
                                ?>
                                 
						 </select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label"> Department</label>
						<div class="col-lg-9">
						<select  name="name_departemt" id="user_time_zone" class="form-control" size="0">
						<option value="0">..................</option>
						<?php
                                 $query="SELECT `id_department`, `name_department` FROM `department` ";
                                 $result=mysqli_query($conn,$query);
                                 $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row as $m){
                                    echo "<option value='" . $m['id_department'] . "'>" . $m['name_department'] . "</option>";
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
                $id= $_POST['id_admin'];
				$username=mysqli_real_escape_string($conn,$_POST["name"]);
				$email=mysqli_real_escape_string($conn,$_POST["email"]);
				$pass=mysqli_real_escape_string($conn,$_POST["pass"]);
				$pass1=password_hash($pass,PASSWORD_BCRYPT);
				$college=$_POST["name_college"];
				$status=$_POST["status"];
				$dep=$_POST["name_departemt"];
                if(!empty($errors)){
                $_SESSION['errors']=$errors;
                redicrt("?do=manage");
                }else{
                $sql="UPDATE `employee` SET
                            `name_employee`='{$username}',
							`email`='{$email}',
							`password`='{$pass1}',
							`task_id`='{$status}',
							`id_college`='{$college}',
							`groub_id`=0,
							`dep`='{$dep}'
                        WHERE `id_employee`='{$id}'
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
        
                $id_employee = isset($_GET['id_employee']) && is_numeric($_GET['id_employee']) ? intval($_GET['id_employee']) : 0;
              
        
                // Select All Data Depend On This   
        
               
				$sql="DELETE FROM `employee` WHERE id_employee={$id_employee} LIMIT 1";
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