<?php
ob_start(); // Output Buffering Start
$pageTitle='Department';
$noNavbar=' ';

include 'init.php';

?>
<?php
global $college;
global $stage;
$stage=2;
$college=$_SESSION['college'];
$namecollege=fetch('name_college','college',$college);
foreach ($namecollege as $coll){


 $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
 if($do=='manage'){ 
   ?>
    <div class="formBox">
    <div class="row">
    <div class="container text-center">
         <h1><?php echo $coll['name_college'] ?></h1>
             <?php echo msg(); ?>
                       <?php $errors=er(); ?>
              <?php errors_function($errors);
             ?>
                 </div>
           </div>
           <div class="col-md-8 offset-md-2">
    <span class="anchor" id="formUserEdit">
      search student
    </span>
    <div class="header-a">
    <a href="#"> <span class="homeicon">
    <i class="fa fa-home "> </i> Home </span> </a>
      /
    <a href="#">  <span class="adminicon">
      <i class="fa fa-admin"></i> student</span> </a>
   
     
      </div>
      <?php echo msg(); ?>
                <?php $errors=er(); ?>
                  <?php errors_function($errors);
             ?>
 
    <!-- form user info -->
    <div class="card card-outline-secondary">
        <div class="card-body">
            <form class="form" role="form" action="?do=insert" method="POST"
            name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
            <div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label"> ID </label>
						<div class="col-lg-9">
						 <input class="form-control" type="text"  name="name" required="required" placeholder="#ID_student">
						</div>
					</div>
                    <div class="form-group row">
						<label class="col-lg-3 col-form-label form-control-label"> Department</label>
						<div class="col-lg-9">
						<select  name="departemnt" id="user_time_zone" class="form-control" size="0">
						<option value="0">..................</option>
						<?php
                                 $query="SELECT `id_department`, `name_department`, `id_college` FROM `department` WHERE `id_college`=$college ";
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
                <input type="submit" value="document export  for students" class="btn btn-lg btn-block add_btn" name="import" style="
                 margin-left: 219px;">
                </div>
            </div>
            </form>
        </div>
    </div>
   
   <?php
    
 }elseif($do=='insert'){
    $noNavbar2=' ';
if (isset($_POST["import"]))
{
    $dep=$_POST["departemnt"];	
    $name=mysqli_real_escape_string($conn,$_POST["name"]);	
   
    $query="SELECT student.*, college.name_college
     AS College_Name ,department.name_department AS department 
     FROM student 
     INNER JOIN college ON college.id_college=student.id_college 
    INNER JOIN department  ON department.id_department=student.id_departement
     WHERE `id_student` LIKE '$name' AND id_departement=$dep";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
    foreach ($row as $u){
      

        ?>
        <div class="titel text-center">
            <h3> الى من يهمه الامر </h3>
            <p> 
                لقد منحت السيده \السيد <?php echo $u['full_name']; ?>
                المثب صورته اعلاه شهادةبكالوريس 
            <?php echo $u['department'];?>
                من كلية
                <?php echo $u['College_Name'];?>
                بتقدير 
          <?php
          if($u['avarage']>=90 AND $u['avarage']<=100 ) 
          {
              echo 'امتياز';
          }
          elseif($u['avarage']>=80 AND $u['avarage']<=89 ) 
          {
              echo 'جيد جدا';
          }
          elseif($u['avarage']>=70 AND $u['avarage']<=79 ) 
          {
              echo ' جيد';
          }
          elseif($u['avarage']>=70 AND $u['avarage']<=79 ) 
          {
              echo ' جيد';
          }
          elseif($u['avarage']>=70 AND $u['avarage']<=79 ) 
          {
              echo ' جيد';
          }
          ?>
         (      ) للعام الدراسي 
          
          بناءآ على الامر  الجامعي (  )
          بتاريخ(   /    / )
          ادنا درجات حصل عليها خلال مدة الدراسه 

           </p>
  </div>
 
 
  <div class="row">
 <div class="col-sm-6">
      <?php $id=$u['id_student'];
      ?>
   
      <div class="table-responsive">
		<table class="main-table text-center table table-bordered" >
        <p class="a text-center"> السنه الاولى </p>
        <tr style="
                        background-color: #9D5981;
                        color: #fff;
                        font-weight: 700;">
                <td>Subject</td>
                <td>Degree</td>
				
			</tr>
 <?php
 $query="SELECT `id_subject`, `name_subject`, `year`, `stage_id` FROM `subjects` WHERE `stage_id`=1";
 $result=mysqli_query($conn,$query);
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);
foreach ($row as $q){
    $w=$q['id_subject'];
 $query="SELECT * FROM `degrees` WHERE `subject_id`=$w AND `stage_id`=1 AND student_id=$id";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);
foreach ($row as $m){


	echo "<tr>";
      echo "<td>" . $q['name_subject'] . "</td>";
      echo "<td>" . $m['degree'] . "</td>";
     echo "</tr>";

                    

 
}}
?>
</table>
 </div>
 </div>
 <!--tabel 2 -->
 <div class="col-sm-6">
      <?php $id=$u['id_student'];
      ?>
   
      <div class="table-responsive">
		<table class="main-table text-center table table-bordered" >
        <p class="a text-center"> السنه الثانيه </p>
        <tr style="
                        background-color: #9D5981;
                        color: #fff;
                        font-weight: 700;">
                <td>Subject</td>
                <td>Degree</td>
				
			</tr>
 <?php
 $query="SELECT `id_subject`, `name_subject`, `year`, `stage_id` FROM `subjects` WHERE `stage_id`=2";
 $result=mysqli_query($conn,$query);
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);
foreach ($row as $q){
    $w=$q['id_subject'];
 $query="SELECT * FROM `degrees` WHERE `subject_id`=$w AND `stage_id`=2 AND student_id=$id ";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);
foreach ($row as $m){


	echo "<tr>";
      echo "<td>" . $q['name_subject'] . "</td>";
      echo "<td>" . $m['degree'] . "</td>";
     echo "</tr>";

                    

 
}}
?>
</table>
 </div>
 </div>

  </div>


   <!--tabel 2 -->
   <div class="row">
 <div class="col-sm-6">
      <?php $id=$u['id_student'];
      ?>
   
      <div class="table-responsive">
		<table class="main-table text-center table table-bordered" >
        <p class="a text-center"> السنه الثالثه </p>
        <tr style="
                        background-color: #9D5981;
                        color: #fff;
                        font-weight: 700;">
                <td>Subject</td>
                <td>Degree</td>
				
			</tr>
 <?php
 $query="SELECT `id_subject`, `name_subject`, `year`, `stage_id` FROM `subjects` WHERE `stage_id`=3 ";
 $result=mysqli_query($conn,$query);
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);
foreach ($row as $q){
    $w=$q['id_subject'];
 $query="SELECT * FROM `degrees` WHERE `subject_id`=$w AND `stage_id`=3 AND student_id=$id";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);
foreach ($row as $m){


	echo "<tr>";
      echo "<td>" . $q['name_subject'] . "</td>";
      echo "<td>" . $m['degree'] . "</td>";
     echo "</tr>";

                    

 
}}
?>
</table>
 </div>
 </div>
<!-- four -->
<div class="col-sm-6">
      <?php $id=$u['id_student'];
      ?>
   
      <div class="table-responsive">
		<table class="main-table text-center table table-bordered" >
        <p class="a text-center"> السنه الرابعه </p>
			<tr style="
                        background-color: #9D5981;
                        color: #fff;
                        font-weight: 700;">
                <td>Subject</td>
                <td>Degree</td>
				
			</tr>
 <?php
 $query="SELECT `id_subject`, `name_subject`, `year`, `stage_id` FROM `subjects` WHERE `stage_id`=4";
 $result=mysqli_query($conn,$query);
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);
foreach ($row as $q){
    $w=$q['id_subject'];
 $query="SELECT * FROM `degrees` WHERE `subject_id`=$w AND `stage_id`=4 AND student_id=$id ";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);
foreach ($row as $m){


	echo "<tr>";
      echo "<td>" . $q['name_subject'] . "</td>";
      echo "<td>" . $m['degree'] . "</td>";
     echo "</tr>";

                    

 
}}
?>
</table>
 </div>
 </div>


<?php
       


}

  




}

 }elseif($do=='viwe'){
    
?>
    <div class="formBox">
    <div class="row">
    <div class="container text-center">
                     
                     <br>
                     <h1> مواد المرحله الاولى <?php echo $coll['name_college'] ?></h1>
                     <?php echo msg(); ?>
                                 <?php $errors=er(); ?>
                                   <?php errors_function($errors);
                              ?>
                 </div>
             </div>

       <?php
      $query="SELECT `id_subject`, `name_subject`, `year`, `stage_id` FROM `subjects` WHERE stage_id=$stage";

         $result=mysqli_query($conn,$query);
         if(mysqli_num_rows($result)>0)
         {




      ?>
    <div class="container">
        
    <hr style="border-top: 3px solid rgb(241, 25, 25)";>
    <div class="row">
        <div class="panel panel-primary filterable" style="margin-left: 260px;">
            <div class="panel-heading">
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
            </div>
            <table id="testTable"
            class="main-table text-center table table-bordered"
            style="background-color:#214860; color:#fff;">
                <thead>
                    <tr class="filters" style="background-color:#214860; color:#fff;">
                        <th>#ID</th>
                        <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="year" disabled></th>
                        <th>Control</th>
                       
                    </tr>
                </thead>
                <tbody>
                <?php 
						while($row=mysqli_fetch_assoc($result)){

                            echo "<tr>";
                            echo "<td>" . $row['id_subject'] . "</td>";
                            echo "<td>" . $row['name_subject'] . "</td>";
                            echo "<td>" . $row['year'] . "</td>";
                           
                         
                            echo "<td>
                                <a href='?do=Delete&student_id=".$row['id_subject']. "' class='btn btn-danger confirm s><i class='fa fa-close'></i> Delete </a>
                                
                                </td>";
                                
                             
                           
                        echo "</tr>";
                    }


                }
                ?>
                 
                 
                 
                 
                 
                 
                 
                 
                 
                 
                </tbody>
            </table>
        </div>
    </div>
</div>
 </div>
 


<?php

 }elseif ($do == 'Delete') { // Delete Member Page

    echo "<h1 class='text-center'>Delete Member</h1>";
    echo "<div class='container'>";

        // Check If Get Request userid Is Numeric & Get The Integer Value Of It

       

        // Select All Data Depend On This ID

        
        // If There's Such ID Show The Form
        $student = isset($_GET['student_id']) && is_numeric($_GET['student_id']) ? intval($_GET['student_id']) : 0;

        // Select All Data Depend On This ID

         $check=checkItem('student_id','student',$student);
        if($check>0){
      
       
        $sql="DELETE FROM `student` WHERE student_id={$student} LIMIT 1";
            $result=mysqli_query($conn,$sql);
                if ( $result && mysqli_affected_rows($conn)>0) {
                        
                        
                    $_SESSION['msg']=secusse_msg_delete();
                    redicrt("?do=viwe");
                        
                    }else{
                        
                        $_SESSION['msg']= error_msg_delete();
                        redicrt("?do=viwe");
                        }
            



        }	
    }				


    










































































}
include $tpl  .'footer.php';
?>



