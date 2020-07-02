<?php
ob_start(); // Output Buffering Start
$pageTitle='Department';
$noNavbar=' ';
include 'init.php';
check_login_employe();

?>
<?php
global $college;


$college=$_SESSION['college'];
$namecollege=fetch('name_college','college',$college);
foreach ($namecollege as $coll){


 $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
 if($do=='manage'){ 
   ?>
    <div class="formBox">
    <div class="row">
    <div class="container text-center">
    <h1> شعبة التسجيل <?php echo $coll['name_college'] ?></h1>
             <?php echo msg(); ?>
                       <?php $errors=er(); ?>
              <?php errors_function($errors);
             ?>
                 </div>
           </div>
    
    <div class="home-stats">
          <div class="container text-center">
           
              <div class="row">
              <div class="col-md-6">
                      <div class="stat st-members">
                          <i class="fa fa-user-plus"></i>
                          <div class="info">
                           Total student  / add students
                              <span>
                                  <a href="?do=add"><?php
                                  echo countItems('student',$college);
                           
                                  
                                  
                                  ?> </a>
                              </span>
                          </div>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="stat st-pending">
                          <i class="fa fa-graduation-cap"></i>
                          <div class="info">
                          Total students  / viwe studnets /total student 
                              <span style="margin-left: -145px;">
                                  <a href="?do=viwe"><?php
                               echo countItems('student',$college) ?>
                              
                                
                                  
                               </a>
                       
                          </div>
                      </div>
                  </div>

             </div>
        </div>
   </div>

   <?php



 }elseif($do=='add')

 {
     ?>	<div class="col-md-8 offset-md-2">
    <span class="anchor" id="formUserEdit">
      Add New studnet 
    </span>
    <div class="header-a">
    <a href="#"> <span class="homeicon">
    <i class="fa fa-home "> </i> Home </span> </a>
      /
    <a href="#">  <span class="adminicon">
      <i class="fa fa-admin"></i> student</span> </a>
      /
     new new
     
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
                    <label class="col-lg-3 col-form-label form-control-label"> student excel </label>
                    <div class="col-lg-9">
                    <input type="file" name="file"  class="form-control" id="file" accept=".xls,.xlsx">
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
                    <select  name="department" id="user_time_zone" class="form-control" size="0">
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
                </div>
                <div class="row">
                <div class="col-lg-9">
                <input type="submit" value="save" class="btn btn-lg btn-block add_btn" name="import" style="
                 margin-left: 219px;">
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- /form college info -->
    <?php
 }elseif($do=='insert'){
    require_once('inc/Libraries/vendor/php-excel-reader/excel_reader2.php');
    require_once('inc/Libraries/vendor/SpreadsheetReader.php');
    

if (isset($_POST["import"]))
{
				
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  $department=$_POST["department"];

  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
                $name_student = "";
                if(isset($Row[1])) {
                    $name_student = mysqli_real_escape_string($conn,$Row[1]);
                }
                
                $degree = "";
                if(isset($Row[2])) {
                    $degree = mysqli_real_escape_string($conn,$Row[2]);
                }
                $total = "";
                if(isset($Row[3])) {
                    $total = mysqli_real_escape_string($conn,$Row[3]);
                }
                
                
                
                if (!empty($name_student) || !empty($degree)) {
                 $query=" INSERT INTO `student`(`full_name`, `total`, `avarage`, `id_college`, `id_departement`)
                    VALUES ('{$name_student}', '{$total}', '{$degree}', '{$college}','{$department}')";
                      $result = mysqli_query($conn, $query);
                
                    if (! empty($result)) {
                       
                    } else {
                    
                    }
                    
                }

             }
             
             

        
        }redicrt('?do=manage');
  }
  else
  { 
       redicrt('');
  }
  
}
  
 


 }elseif($do=='viwe'){
    
    ?>
        <div class="formBox">
        <div class="row">
        <div class="container text-center">
                         
                         <br>
                         <h1> شعبة التسجيل <?php echo $coll['name_college'] ?></h1>
                         <?php echo msg(); ?>
                                     <?php $errors=er(); ?>
                                       <?php errors_function($errors);
                                  ?>
                     </div>
                 </div>
    
           <?php
          $query="SELECT student.*, college.name_college 
          AS College_Name, department.name_department AS department 
          FROM student INNER JOIN college ON college.id_college=student.id_college 
          INNER JOIN department ON department.id_department=student.id_departement 
          WHERE(student.id_college=$college)";
    
             $result=mysqli_query($conn,$query);
             if(mysqli_num_rows($result)>0)
             {
    
    
    
    
          ?>
        <div class="container">
        <hr style="border-top: 3px solid rgb(241, 25, 25)";>
        <div class="row">
            <div class="panel panel-primary filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">Student info</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
                <table id="testTable"
                class="main-table text-center table table-bordered"
                style="background-color:#214860; color:#fff;"
                >
                    <thead>
                        <tr class="filters" style="background-color:#214860; color:#fff;">
                            <th>#ID</th>
                            <th><input type="text" class="form-control" placeholder="FULL Name" disabled></th>
                            <th><input type="text" class="form-control" placeholder="avarage" disabled></th>
                            <th><input type="text" class="form-control" placeholder="department" disabled></th>
                            <th><input type="text" class="form-control" placeholder="total" disabled></th>
                         
                            <th>year</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                            while($row=mysqli_fetch_assoc($result)){
    
    
                                echo "<tr>";
                                echo "<td>" . $row['id_student'] . "</td>";
                                echo "<td>" . $row['full_name'] . "</td>";
                                echo "<td>" . $row['avarage'] . "</td>";
                                echo "<td>" . $row['department'] ."</td>";
                                echo "<td>" . $row['total'] . "</td>";
                               
                               
                                echo "<td>" . $row['year'] . "</td>";
                             
                                echo "<td>
                                    <a href='?do=Delete&student_id=".$row['id_student']. "' class='btn btn-danger confirm s><i class='fa fa-close'></i> Delete </a>
                                    
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



