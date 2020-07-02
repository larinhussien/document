<?php 
//Get title
function getTitle() {

    global $pageTitle;

    if (isset($pageTitle)) {

        echo $pageTitle;

    } else {

        echo 'Default';

    }
}


$errors=array();
/*redicrt to page */
       function redicrt($url){
       header("location:".$url);
     
         exit();
}


function errors_function($errors=array())
{
   if(!empty($errors)){

    foreach ($errors as $key => $value) {
     echo"<div class='alert alert-danger alert-dismissible'>";
     echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
     echo "<strong>Warning!</strong> worng {$key}=>${value}.";
     echo "</div>";
    }

}
}
function secusse_msg_admin(){
    $emsg="<div class='alert alert-success alert-dismissible'>";
    $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    $emsg.="<strong>Success!</strong>Successful  Registration admin.";
    $emsg.="</div>";
    return($emsg);

} 

function error_msg_admin(){

    $emsg="<div class='alert alert-danger alert-dismissible'>";
    $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    $emsg.="<strong>Warning!</strong>cann’t Registration admin.";
    $emsg.="</div>";

   
    return($emsg);
}
function check_login(){
    if(!(isset($_SESSION['admin_id']))){
        redicrt('index.php');
    }
}
function error_msg_login()
{
    $emsg="<div class='alert alert-danger alert-dismissible'>";
    $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
    $emsg.="<strong>Warning!</strong>cann’t login admin.";
    $emsg.="</div>";

   
    return($emsg);
}



function checkemployee($select, $from, $value) {

    global $conn;
    $query="SELECT $select FROM $from WHERE $select= '$value' ";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    return $count;
    


}
function checkadmin($select, $from, $value) {

    global $conn;
    $query="SELECT $select FROM $from WHERE $select= '$value' ";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    return $count;
    


}
function checkadmin2($select,$from,$value,$type,$value2){
    global $conn;
    $query="SELECT $select FROM $from WHERE $select= '$value' AND $type='$value2'";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    return $count;
}

function total($select,$from) {

    global $conn;
    $query="SELECT $select FROM $from";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    return $count;
    }

    function error_msg_delete(){
        $emsg="<div class='alert alert-danger alert-dismissible'>";
        $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
        $emsg.="<strong>Warning!</strong>cann’t delete.";
        $emsg.="</div>";
    
       
        return($emsg);
    
    }
    function secusse_msg_delete(){
        $emsg="<div class='alert alert-success alert-dismissible'>";
        $emsg.="<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
        $emsg.="<strong>Success!</strong>Successful delete.";
        $emsg.="</div>";
    
       
        return($emsg);
 }

 function getinfo($select,$from){
    global $conn;
    $query="SELECT $select FROM $from";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
    
 }
    
