
<?php

session_start();
include('dbconnect.php');

if(isset($_GET['action']) && $_GET['action']=="show_course")
{
    $id=$_SESSION['id'];
     $result = mysql_query("select * from course_details where id_no='$id'") or die(mysql_error());
     
  
        header('Content-type: text/xml');
        
        echo "<courses>";
         while($row = mysql_fetch_array($result))
         {
             echo "<course>";
            echo "<course_name>" . $row['course_name'] . "</course_name>";
            echo "<course_id>" .  $row['course_id'] . "</course_id>";
            echo "</course>";
         }
            echo "</courses>";
         //header("Location: composerView.php");
}

else if(isset($_GET['action']) && $_GET['action']=="enroll")
{

    $s_no=$_GET['sno'];
    $st_id = $_GET['st_toenroll'];
    $class_id = $_GET['id'];
    require_once('dbconnect.php');
   
    $result1=mysql_query("select * from enrolled_details where course_id='$class_id' and s_no=' $s_no'") or die(mysql_error());
    if ($row = mysql_fetch_array($result1))
    {
       header('HTTP/1.1 403 Forbidden');
   }
   else
   {
    
    $result = mysql_query("insert ignore into enrolled_details values('$st_id','$class_id',' $s_no')") or die(mysql_error());
}
}


else if(isset($_GET['action']) && $_GET['action']=="change_sno")
{

    $s_no=$_GET['sno'];
    $st_id = $_GET['stuid'];
    $class_id = $_GET['classid'];
    require_once('dbconnect.php');
   
    $result1=mysql_query("select * from enrolled_details where course_id='$class_id' and s_no=' $s_no'") or die(mysql_error());
    if ($row = mysql_fetch_array($result1))
    {
       header('HTTP/1.1 403 Forbidden');
    }
   else
	{
    
		$result = mysql_query("update enrolled_details set s_no='$s_no' where  course_id='$class_id' and id_no='$st_id' ") or die(mysql_error());
	
	}
}


else if(isset($_GET['action']) && $_GET['action']=="show_profile_details")
{

    $s_no=$_GET['sno'];
    
    
    require_once('dbconnect.php');
   
    $result=mysql_query("select * from registered where  serial_no=' $s_no'") or die(mysql_error());
	
    header('Content-type: text/xml');
        if($row = mysql_fetch_array($result)){
        echo "<profile>";
         
		
		echo "<name>" .  $row['name'] . "</name>";
		echo "<phone_no>" .  $row['phone_no'] . "</phone_no>";
		echo "<email_id>" .  $row['email_id'] . "</email_id>";
		echo "</profile>";
		}
}



else if(isset($_GET['action']) && $_GET['action']=="show_opted_courses")
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
      
else if(isset($_GET['action']) && $_GET['action']=="show_edit_details")
{
  header('Content-type: text/xml'); 
   echo "<course_details>";
    $course_id = $_GET['courseID'];
    
    
    $query =    "
                SELECT *
                FROM course_details
                WHERE course_id='$course_id'
                ";
    $result = mysql_query($query);
    
    $query_mon  =   "
                    SELECT time1_start , time1_end , time2_start , time2_end,time3_start , time3_end
                    FROM course_schedule
                    WHERE course_id='$course_id' AND day='Monday'
                ";
    $result_mon = mysql_query($query_mon);
    
    $row_mon    = mysql_fetch_array($result_mon);
    
    $query_tue  =   "
                    SELECT time1_start , time1_end , time2_start , time2_end,time3_start , time3_end
                    FROM course_schedule
                    WHERE course_id='$course_id' AND day='Tuesday'
                ";
    $result_tue = mysql_query($query_tue);
    
    $row_tue    = mysql_fetch_array($result_tue);
    
    $query_wed  =   "
                    SELECT time1_start , time1_end , time2_start , time2_end,time3_start , time3_end
                    FROM course_schedule
                    WHERE course_id='$course_id' AND day='Wednesday'
                ";
    $result_wed = mysql_query($query_wed);
    $row_wed    = mysql_fetch_array($result_wed);
    
    $query_thu  =   "
                    SELECT time1_start , time1_end , time2_start , time2_end,time3_start , time3_end
                    FROM course_schedule
                    WHERE course_id='$course_id' AND day='Thursday'
                ";
    $result_thu = mysql_query($query_thu);
    $row_thu    = mysql_fetch_array($result_thu);
    
    $query_fri  =   "
                    SELECT time1_start , time1_end , time2_start , time2_end,time3_start , time3_end
                    FROM course_schedule
                    WHERE course_id='$course_id' AND day='Friday'
                ";
    $result_fri = mysql_query($query_fri);
    $row_fri    = mysql_fetch_array($result_fri);
    
    $query_sat  =   "
                    SELECT time1_start , time1_end , time2_start , time2_end,time3_start , time3_end
                    FROM course_schedule
                    WHERE course_id='$course_id' AND day='Saturday'
                ";
    $result_sat = mysql_query($query_sat);
    $row_sat    = mysql_fetch_array($result_sat);
    
    $query_sun  =   "
                    SELECT time1_start , time1_end , time2_start , time2_end,time3_start , time3_end
                    FROM course_schedule
                    WHERE course_id='$course_id' AND day='Sunday'
                ";
    $result_sun = mysql_query($query_sun);
    $row_sun    = mysql_fetch_array($result_sun);
     
    if ( $row = mysql_fetch_array($result) )
    {
        
         echo "<Course_Name>".$row['course_name']."</Course_Name>";
        
            $f_id = $row['id_no'];

            $query_fn =     "
                            SELECT name
                            FROM registered
                            WHERE id_no = '$f_id'
                            ";
            $result_fn = mysql_query($query_fn);
            $row_fn    = mysql_fetch_array($result_fn);

            $f_nm = $row_fn['name'];
         echo "<FacultyID>".$f_id."</FacultyID>";
         echo "<FacultyName>".$f_nm."</FacultyName>";
         echo "<Start_Date>".$row['starting_date']."</Start_Date>";
         echo "<Finish_Date>".$row['finishing_date']."</Finish_Date>";
         
         echo "<mon_time1_start>";echo ($row_mon==null)?"00:00:00":  $row_mon['time1_start'];echo "</mon_time1_start>";
         echo "<mon_time1_end>";echo ($row_mon==null)?"00:00:00":  $row_mon['time1_end'];echo "</mon_time1_end>";
         
         echo "<mon_time2_start>";echo ($row_mon==null)?"00:00:00":  $row_mon['time2_start'];echo "</mon_time2_start>";
         echo "<mon_time2_end>";echo ($row_mon==null)?"00:00:00":  $row_mon['time2_end'];echo "</mon_time2_end>";
         
         echo "<mon_time3_start>";echo ($row_mon==null)?"00:00:00":  $row_mon['time3_start'];echo "</mon_time3_start>";
         echo "<mon_time3_end>";echo ($row_mon==null)?"00:00:00":  $row_mon['time3_end'];echo "</mon_time3_end>";
         
         
         echo "<tue_time1_start>";echo ($row_tue==null)?"00:00:00": $row_tue['time1_start'];echo "</tue_time1_start>";
         echo "<tue_time1_end>";echo ($row_tue==null)?"00:00:00": $row_tue['time1_end'];echo "</tue_time1_end>";
         
         echo "<tue_time2_start>";echo ($row_tue==null)?"00:00:00": $row_tue['time2_start'];echo "</tue_time2_start>";
         echo "<tue_time2_end>";echo ($row_tue==null)?"00:00:00": $row_tue['time2_end'];echo "</tue_time2_end>";
         
         echo "<tue_time3_start>";echo ($row_tue==null)?"00:00:00": $row_tue['time3_start'];echo "</tue_time3_start>";
         echo "<tue_time3_end>";echo ($row_tue==null)?"00:00:00": $row_tue['time3_end'];echo "</tue_time3_end>";
         
         
         echo "<wed_time1_start>";echo ($row_wed==null)?"00:00:00":  $row_wed['time1_start'];echo "</wed_time1_start>";
         echo "<wed_time1_end>";echo ($row_wed==null)?"00:00:00":  $row_wed['time1_end'];echo "</wed_time1_end>";
         
         echo "<wed_time2_start>";echo ($row_wed==null)?"00:00:00":  $row_wed['time2_start'];echo "</wed_time2_start>";
         echo "<wed_time2_end>";echo ($row_wed==null)?"00:00:00":  $row_wed['time2_end'];echo "</wed_time2_end>";
         
         echo "<wed_time3_start>";echo ($row_wed==null)?"00:00:00":  $row_wed['time3_start'];echo "</wed_time3_start>";
         echo "<wed_time3_end>";echo ($row_wed==null)?"00:00:00":  $row_wed['time3_end'];echo "</wed_time3_end>";
         
         
         echo "<thu_time1_start>";echo ($row_thu==null)?"00:00:00":  $row_thu['time1_start'];echo "</thu_time1_start>";
         echo "<thu_time1_end>";echo ($row_thu==null)?"00:00:00":  $row_thu['time1_end'];echo "</thu_time1_end>";
         
         echo "<thu_time2_start>";echo ($row_thu==null)?"00:00:00":  $row_thu['time2_start'];echo "</thu_time2_start>";
         echo "<thu_time2_end>";echo ($row_thu==null)?"00:00:00":  $row_thu['time2_end'];echo "</thu_time2_end>";
         
         echo "<thu_time3_start>";echo ($row_thu==null)?"00:00:00":  $row_thu['time3_start'];echo "</thu_time3_start>";
         echo "<thu_time3_end>";echo ($row_thu==null)?"00:00:00":  $row_thu['time3_end'];echo "</thu_time3_end>";
         
         
         echo "<fri_time1_start>";echo ($row_fri==null)?"00:00:00":  $row_fri['time1_start'];echo "</fri_time1_start>";
         echo "<fri_time1_end>";echo ($row_fri==null)?"00:00:00":  $row_fri['time1_end'];echo "</fri_time1_end>";
         
         echo "<fri_time2_start>";echo ($row_fri==null)?"00:00:00":  $row_fri['time2_start'];echo "</fri_time2_start>";
         echo "<fri_time2_end>";echo ($row_fri==null)?"00:00:00":  $row_fri['time2_end'];echo "</fri_time2_end>";
         
         echo "<fri_time3_start>";echo ($row_fri==null)?"00:00:00":  $row_fri['time3_start'];echo "</fri_time3_start>";
         echo "<fri_time3_end>";echo ($row_fri==null)?"00:00:00":  $row_fri['time3_end'];echo "</fri_time3_end>";
         
         
         echo "<sat_time1_start>";echo ($row_sat==null)?"00:00:00":  $row_sat['time1_start'];echo "</sat_time1_start>";
         echo "<sat_time1_end>";echo ($row_sat==null)?"00:00:00":  $row_sat['time1_end'];echo "</sat_time1_end>";
         
         echo "<sat_time2_start>";echo ($row_sat==null)?"00:00:00":  $row_sat['time2_start'];echo "</sat_time2_start>";
         echo "<sat_time2_end>";echo ($row_sat==null)?"00:00:00":  $row_sat['time2_end'];echo "</sat_time2_end>";
         
         echo "<sat_time3_start>";echo ($row_sat==null)?"00:00:00":  $row_sat['time3_start'];echo "</sat_time3_start>";
         echo "<sat_time3_end>";echo ($row_sat==null)?"00:00:00":  $row_sat['time3_end'];echo "</sat_time3_end>";
         
         
         echo "<sun_time1_start>";echo ($row_sun==null)?"00:00:00":  $row_sun['time1_start'];echo "</sun_time1_start>";
         echo "<sun_time1_end>";echo ($row_sun==null)?"00:00:00":  $row_sun['time1_end'];echo "</sun_time1_end>";
         
         echo "<sun_time2_start>";echo ($row_sun==null)?"00:00:00":  $row_sun['time2_start'];echo "</sun_time2_start>";
         echo "<sun_time2_end>";echo ($row_sun==null)?"00:00:00":  $row_sun['time2_end'];echo "</sun_time2_end>";
         
         echo "<sun_time3_start>";echo ($row_sun==null)?"00:00:00":  $row_sun['time3_start'];echo "</sun_time3_start>";
         echo "<sun_time3_end>";echo ($row_sun==null)?"00:00:00":  $row_sun['time3_end'];echo "</sun_time3_end>";
         
         
         
         
        
         
         
    }
     echo "</course_details>";
}
   

?>
