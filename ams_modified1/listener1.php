<?php
session_start();
include('dbconnect.php');
if(isset($_GET['action']) && $_GET['action']="show_opted_courses")
{
    $id=$_SESSION['id'];
     $result = mysql_query("select course_id from enrolled_details where id_no='$id'") or die(mysql_error());
     
  
        header('Content-type: text/xml');
        
        echo "<courses>";
         while($row = mysql_fetch_array($result))
         {
			//$result1 = mysql_query("select * from course_details where course_id='$row[course_id]'") or die(mysql_error()); 
             echo "<course>";
            //echo "<course_name>" . $row['course_name'] . "</course_name>";
            echo "<course_id>" .  $row['course_id'] . "</course_id>";
            echo "</course>";
         }
            echo "</courses>";
         //header("Location: composerView.php");
}
      
    

?>
