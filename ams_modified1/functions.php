<?php
//initializes the holiday window = 1 if yes else 0 
function initialize_holid($holid, $from, $till, $con) 
{
    $date = $from;
    $end_date = $till;

    while (strtotime($date) <= strtotime($end_date)) 
    {
        $dt = new DateTime($date);
        $day = $dt->format('l');    //day		
        $d = $dt->format('Y-m-d');  //date

        $holid[$d] = 0;

        $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
    }

    $query = "	
                    SELECT date
                    FROM holidays 
                    WHERE date BETWEEN '$from' AND '$till'
             ";
    
    $result = mysqli_query($con, $query) or die("Error: " . mysqli_error($con));

    while ($row = mysqli_fetch_array($result)) 
    {
        $holid[$row['date']] = 1;
    }
    
    return $holid;
}

//prints report
function print_chart($chart, $from, $till, $type, $holid,$comp_name,$comp_roll , $percentage) 
{	
    $present_count = 0;
    $absent_count = 0;

    $date = $from;
    $end_date = $till;
	
    $dt = new DateTime($date);
    $d = $dt->format('Y-m-d'); //date		
	
	if($type!="Compact")
	{
    	echo "<TABLE >\n";
    	echo "<th>DATE</th><th>DAY</th><th>START TIME</th><th>END TIME</th><th>TYPE</th><th>ENTRY</th><th>STATUS</th>"; 
	}
	
    while (strtotime($date) <= strtotime($end_date)) 
    {
        $dt = new DateTime($date);
        $d = $dt->format('Y-m-d');
        $day = $dt->format('l');
		
        if ($holid[$d] == 1) 
        {
            if ($type == "Complete" )
            {
                echo "<tr>";
                echo
                "<td>" . $d . " </td>" .
                "<td>" . $day . " </td>" .
                "<td>" . "" . " </td>" .
                "<td>" . "" . " </td>" .
                "<td>" . "Holiday" . " </td>" .
                "<td>" . "" . " </td>" .
                "<td>" . "" . " </td>";
                echo "</tr>";
            }
            
            else
            {
                
            }
        } 
        else if ($chart[$d][7] == $type || $type == "Complete" || $type=="Compact") 
        {
            if($type!="Compact")
			{
            echo "<tr>";
            echo
            "<td>" . $chart[$d][1] . " </td>" .
            "<td>" . $chart[$d][2] . " </td>" .
            "<td>" . $chart[$d][3] . " </td>" .
            "<td>" . $chart[$d][4] . " </td>" .
            "<td>" . $chart[$d][5] . " </td>" .
            "<td>" . $chart[$d][6] . " </td>" .
            "<td>" . $chart[$d][7] . " </td>";
            echo "</tr>";
			}
		
				if ($chart[$d][7] == "Absent")
                $absent_count++;
	            if ($chart[$d][7] == "Present")
                $present_count++;

			
		}
		
        if ($chart[$d][0] == 2 || $chart[$d][0] == 3) 
        {
		    if ($holid[$d] == 0 )
            {
				if ($chart[$d][9][0][7] == $type || $type == "Complete") 
                {
                
                    echo "<tr>";
                    echo
                    "<td>" . $chart[$d][9][0][1] . "</td> " .
                    "<td>" . $chart[$d][9][0][2] . "</td> " .
                    "<td>" . $chart[$d][9][0][3] . "</td> " .
                    "<td>" . $chart[$d][9][0][4] . "</td> " .
                    "<td>" . $chart[$d][9][0][5] . "</td> " .
                    "<td>" . $chart[$d][9][0][6] . "</td> " .
                    "<td>" . $chart[$d][9][0][7] . "</td> ";
                    echo "</tr>";                    
                }
				if( $type == "Complete" ||  $type == "Compact" || $chart[$d][9][0][7] == $type)
				{
					if ($chart[$d][9][0][7] == "Absent")
                         $absent_count++;
                    if ($chart[$d][9][0][7] == "Present")
                        $present_count++;
				}
            }            
            else if ($holid[$d]==1 )
            {
                if ($type=="Complete")
                {   echo "<tr>";
                    echo
                        "<td>" . $d . " </td>" .
                        "<td>" . $day . " </td>" .
                        "<td>" . "" . " </td>" .
                        "<td>" . "" . " </td>" .
                        "<td>" . "Holiday" . " </td>" .
                        "<td>" . "" . " </td>" .
                        "<td>" . "" . " </td>";
                        echo "</tr>";
                }
                        
            }
          
        }

		if ($chart[$d][0] == 3) 
		{
			if ($holid[$d] == 0 )
			{				
				if ($chart[$d][9][1][7] == $type || $type == "Complete") 
				{
				
					echo "<tr>";
					echo
					"<td>" . $chart[$d][9][1][1] . "</td> " .
					"<td>" . $chart[$d][9][1][2] . "</td> " .
					"<td>" . $chart[$d][9][1][3] . "</td> " .
					"<td>" . $chart[$d][9][1][4] . "</td> " .
					"<td>" . $chart[$d][9][1][5] . "</td> " .
					"<td>" . $chart[$d][9][1][6] . "</td> " .
					"<td>" . $chart[$d][9][1][7] . "</td> ";
					echo "</tr>";

					
				}
				if( $type == "Complete" ||  $type == "Compact" || $chart[$d][9][1][7] == $type)
				{
					if ($chart[$d][9][1][7] == "Absent")
						 $absent_count++;
					if ($chart[$d][9][1][7] == "Present")
						$present_count++;
				}
			}
			
			else if ($holid[$d]==1 )
			{
				if ($type=="Complete")
				{   echo "<tr>";
					echo
						"<td>" . $d . " </td>" .
						"<td>" . $day . " </td>" .
						"<td>" . "" . " </td>" .
						"<td>" . "" . " </td>" .
						"<td>" . "Holiday" . " </td>" .
						"<td>" . "" . " </td>" .
						"<td>" . "" . " </td>";
						echo "</tr>";
				}
						
			}
		  
		}

        //if any extra classes arranged
        //no holiday check
        //because extra class can be on any holiday also
        if ($chart[$d][8] > 0) 
        {
			$count = 0;
			$num = $chart[$d][8] ;
			while ($num != 0)
			{
				if ($chart[$d][10][$count][6] == $type || $type == "Complete" || $type == "Compact") 
				{
					if ($type != "Compact")
					{
					echo "<tr>";
					echo
					"<td>" . $chart[$d][10][$count][0] . "</td> " .
					"<td>" . $chart[$d][10][$count][1] . "</td> " .
					"<td>" . $chart[$d][10][$count][2] . "</td> " .
					"<td>" . $chart[$d][10][$count][3] . "</td> " .
					"<td>" . $chart[$d][10][$count][4] . "</td> " .
					"<td>" . $chart[$d][10][$count][5] . "</td> " .
					"<td>" . $chart[$d][10][$count][6] . "</td> ";
					echo "</tr>";
					}
					
						
						if ($chart[$d][10][$count][6] == "Absent")
							$absent_count++;
						if ($chart[$d][10][$count][6] == "Present")
							$present_count++;
					
				}
				$num = $num - 1 ;
				$count = $count + 1 ;
			}
        }

        //date increment
        $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
    }//end while loop
	
    if($type!="Compact")
	{
    	//echo "</TABLE></HTML>";
    	echo "<br>";
    	echo "<br>";
	}
    
    if ($type == "Present" || $type == "Complete")
	{
        echo "<tr><td  class=\"empty\"></td><td class=\"empty\"></td><td class=\"empty\"></td><td class=\"empty\"></td><td colspan=2 class=\"res\"><b># Present classes  </b></td> <td >" . $present_count."</td>";
	}
    if ($type == "Absent" || $type == "Complete")
	{
		echo "<tr><td class=\"empty\"></td><td class=\"empty\"></td><td class=\"empty\"></td><td class=\"empty\"></td><td colspan=2 class=\"res\"><b># Absent classes  </b></td> <td >" . $absent_count."</td>";
	}
	echo "</TABLE></HTML>";
	if($type!="Compact")
	    echo "<br><br>  <br><br>";
	else
	{
		$nume = $present_count * 100 ;
		$deno = $present_count+$absent_count;
		$frac = bcdiv($nume , $deno, 3);
		$p=(($present_count)/($present_count+$absent_count))*100;
		if($percentage > $p)
		$_SESSION['tab1'].="<tr><td>".$comp_roll."</td><td>".$comp_name."</td><td>".$present_count."</td><td>".$absent_count."</td><td>".$frac."</td></tr>";
	}
}

//considers only scheduled classes
//extra classes will be added later in report function
function initialize_chart($chart, $chart1, $schedule, $from, $till, $con , $c_id) 
{
    //0:	0 / 1 / 2 classes
    //1:	date
    //2:	day
    //3:	time-start for class
    //4:	time-end  for class
    //5:	scheduled or extra or cancelled or not scheduled or holiday
    //6:	entry time of student
    //7:	Absent / Present
    //8:	1 -> yes extra , 0 -> no extra
    //9:	if 0=2 then go to 9  and same as $chart[9] = $chart1 so $chart[$d][9][0][x] and $chart[$d][9][1][x] 
    //10:	if 8=1 then go to 10 and same as $chart[10]= $chart2 so $chart[$d][10][x]

    $date       = $from;
    $end_date   = $till;

    //outer while loop :: date incrementor through time window
    while (strtotime($date) <= strtotime($end_date)) 
    {
        $dt = new DateTime($date);
        $day = $dt->format('l');    //day		
        $d = $dt->format('Y-m-d');  //date
     
        //if only one class is there on this day
        if ($schedule[$day][0] == 1) 
        {
            if (cancel_check($con, $d, $c_id, $schedule[$day][1], $schedule[$day][2]))
            {   
                //if not cancelled, assign scheduled
                $chart[$d] = array("1", $d, $day, $schedule[$day][1], $schedule[$day][2], " Scheduled ", " ", "Absent", 0, 0, 0);
            }
            else
            {
                //if cancelled then, assign cancelled
                $chart[$d] = array("1", $d, $day, $schedule[$day][1], $schedule[$day][2], " Cancelled ", " ", "NULL", 0, 0, 0);
            }
            
        } 
        else if ($schedule[$day][0] == 2) 
        {            
            //checking if first class of the day has been cancelled
            if (cancel_check($con, $d, $c_id, $schedule[$day][1], $schedule[$day][2]))
            {
                //if first class isn't cancelled
                $chart[$d] = array("2", $d, $day, $schedule[$day][1], $schedule[$day][2], "Scheduled", " ", "Absent", 0, 0, 0);
            }
            else
            {
                //if first class cancelled
                $chart[$d] = array("2", $d, $day, $schedule[$day][1], $schedule[$day][2], "Cancelled", " ", "NULL1", 0, 0, 0);
            }
            
            //checking if second class of the day has been cancelled
            if (cancel_check($con, $d, $c_id, $schedule[$day][3], $schedule[$day][4]))
            {
                //if second class has not been cancelled
                $chart1[0] = array("2", $d, $day, $schedule[$day][3], $schedule[$day][4], "Scheduled", " ", "Absent", 0, 0, 0);
            }        
            else
            {
                //if second class of the day has been cancelled
                $chart1[0] = array("2", $d, $day, $schedule[$day][3], $schedule[$day][4], "Cancelled", " ", "NULL1", 0, 0, 0);
            }
			//[1] initialized just to keep size 2 : not at all necessary
            $chart1[1] = array();     
            $chart[$d][9] = $chart1;
        }
		
        else if ($schedule[$day][0] == 3) 
        {            
            //checking if first class of the day has been cancelled
            if (cancel_check($con, $d, $c_id, $schedule[$day][1], $schedule[$day][2]))
            {
                //if first class isn't cancelled
                $chart[$d] = array("3", $d, $day, $schedule[$day][1], $schedule[$day][2], "Scheduled", " ", "Absent", 0, 0, 0);
            }
            else
            {
                //if first class cancelled
                $chart[$d] = array("3", $d, $day, $schedule[$day][1], $schedule[$day][2], "Cancelled", " ", "", 0, 0, 0);
            }
            
            //checking if second class of the day has been cancelled
            if (cancel_check($con, $d, $c_id, $schedule[$day][3], $schedule[$day][4]))
            {
                //if second class has not been cancelled
                $chart1[0] = array("3", $d, $day, $schedule[$day][3], $schedule[$day][4], "Scheduled", " ", "Absent", 0, 0, 0);
            }        
            else
            {
                //if second class of the day has been cancelled
                $chart1[0] = array("3", $d, $day, $schedule[$day][3], $schedule[$day][4], "Cancelled", " ", "", 0, 0, 0);
            }
            
			//checking if third class of the day has been cancelled
            if (cancel_check($con, $d, $c_id, $schedule[$day][6], $schedule[$day][7]))
            {
                //if third class has not been cancelled
                $chart1[1] = array("3", $d, $day, $schedule[$day][6], $schedule[$day][7], "Scheduled", " ", "Absent", 0, 0, 0);
            }        
            else
            {
                //if third class of the day has been cancelled
                $chart1[1] = array("3", $d, $day, $schedule[$day][6], $schedule[$day][7], "Cancelled", " ", "", 0, 0, 0);
            }			
            $chart[$d][9] = $chart1;
        }	
		else 
        {   
            //if not 1 , not 2 then 0 classes on that day so "No scheduled class"
            $chart[$d] = array(0, $d, $day, "", "", "No scheduled class", "", "", "", "", "");
        }
        $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
    }//while end
	
    return $chart;
}

//weekly schedule for course
function get_schedule($schedule , $c_id , $con)
{    
    //setting default schedule 
    //setting all values to 00:00:00
    $i = 0;
    $day = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
    while ($i < 7) 
    {

        $schedule[$day[$i]][0] = 0;             // 	for count
        $schedule[$day[$i]][1] = "00:00:00";    //	for time1_start	
        $schedule[$day[$i]][2] = "00:00:00";    //	for time1_end
        $schedule[$day[$i]][3] = "00:00:00";    //	for time2_start
        $schedule[$day[$i]][4] = "00:00:00";    //	for time2_end
        $schedule[$day[$i]][5] = $day[$i];      //	for day	
		$schedule[$day[$i]][6] = "00:00:00";    //	for time3_end
		$schedule[$day[$i]][7] = "00:00:00";    //	for time3_end
        $i = $i + 1;
    }
 
    //query for expected scheduling and extra classes	
    $query1 =   "
                SELECT count , time1_start , time1_end , time2_start , time2_end , day , time3_start , time3_end		  
				FROM course_schedule 
				WHERE course_id = '$c_id'
                ";

    $result1 = mysqli_query($con, $query1) or die("Error: " . mysqli_error($con));

    //scheduled is day wise
    //so following thing have been saved 
    //0 -   count   -   how many classes ?
    //1 -   time1_start
    //2 -   time1_end
    //3 -   time2_start
    //4 -   time2_end
    //5 -   day
	//6	-	time3_start
	//7	-	time3_end
        
    while ($row1 = mysqli_fetch_array($result1)) 
    {
        $schedule[$row1['day']] = array($row1['count'], $row1['time1_start'], $row1['time1_end'], 
														$row1['time2_start'], $row1['time2_end'],
																	$row1['day'],
														$row1['time3_start'], $row1['time3_end']);
    }
    return $schedule;
}

function report($con, $rollno,$comp_name, $c_id, $from, $till, $type ,$schedule , $holid , $chart , $p) 
{
        $comp_roll=$rollno;
		
		$query2 =   "
                    SELECT timestamp 
                    FROM attendance 
                    WHERE userid='$rollno'	AND DATE(timestamp) BETWEEN '$from' AND '$till' 
						";
        $result2 = mysqli_query($con, $query2) or die("Error: " . mysqli_error($con));

        //array storing student's TimeStamp in the entered window of $from and $till
        $ts = array();

        while ($row2 = mysqli_fetch_array($result2)) 
		{
            array_push($ts, $row2['timestamp']);
        }

        //length of array storing student's timestamp
        $ts_length = count($ts);
        
        //counter
        $i = 0;

        // Set timezone
        date_default_timezone_set('UTC');

        // Start date
        $date = $from;

        // End date
        $end_date = $till;


        //finding total expected classes
			//outer loop goes from '$from' to '$till' 
            //in each outer loop inner loop goes from '$ts[0]' to '$ts[$ts_length - 1]
            //if students entry time in '$ts' is between scheduled classes then assign present 
			//no need to asssign absent because it has been done in initialized
			//holidays are considered while printing 
			//so consider 
			//1.scheduled class
			//2.extra class
			//3.cancel class
			
		while (strtotime($date) <= strtotime($end_date)) {
            
            $dt = new DateTime($date);
            $day = $dt->format('l');    //day		
            $d = $dt->format('Y-m-d');  //date
			
            //counter
            $i = 0;  
                          
            //will enter the loop only if student is present at-least once           
            while ( $i < $ts_length ) 
            {                
                $user_timestamp = date_create($ts[$i]);
                $user_date      = date_format($user_timestamp, 'Y-m-d');
                $user_time      = date_format($user_timestamp, 'H:i:s');

                //if only one class on this date
                //condition = count + date + start_time + finishing_time
                
                if ($schedule[$day][0] == 1 and $d == $user_date and $user_time >= $schedule[$day][1] and $user_time <= $schedule[$day][2]) 
                {
                    //in time range of class
                    
                    if (cancel_check($con, $d, $c_id, $schedule[$day][1], $schedule[$day][2])) 
                    {
                        //if not cancelled then it's scheduled
                        $chart[$d][5] = "Scheduled";
                        $chart[$d][6] = $user_time;
                        $chart[$d][7] = "Present";
                    } 
                    else 
                    {
                        //if cancelled
                        $chart[$d][5] = "Cancel";
                        $chart[$d][6] = "";
                        $chart[$d][7] = "";
                    }
                }
                
                //if user entry time is beyond class scheduled
                else if ($schedule[$day][0] == 1 and $d == $user_date and ($user_time <= $schedule[$day][1] || $user_time >= $schedule[$day][2])) 
                {
                    
                }

                //if two classes on this date
                if ($schedule[$day][0] == 2) 
                {
                    //if first isn't cancelled
                    if (cancel_check($con, $d, $c_id, $schedule[$day][1], $schedule[$day][2])) 
                    {
                        if (($d == $user_date) and ($user_time >= $schedule[$day][1]) and ($user_time <= $schedule[$day][2])) 
                        {
                            //if student entry time is in scheduled class timing
                            $chart[$d][5] = "Scheduled";
                            $chart[$d][6] = $user_time;
                            $chart[$d][7] = "Present";
                        }
                        
                        //if user entry time is beyond the scheduled class time
                        else if (($d == $user_date) and ($user_time <= $schedule[$day][1] || $user_time >= $schedule[$day][2])) 
                        {                           
                            
                        }
                    }
                    
                    //if first class of the day is cancelled 
                    else 
                    {                        
                        $chart[$d][5] = "Cancelled";
                        $chart[$d][6] = " ";
                        $chart[$d][7] = " ";
                    }

                    //if second class of the day isn't cancelled   
                    if (cancel_check($con, $d, $c_id, $schedule[$day][3], $schedule[$day][4])) 
                    {
                        //if user entry time is between scheduled class
                        if ($d == $user_date and $user_time >= $schedule[$day][3] and $user_time <= $schedule[$day][4]) {
                            $chart[$d][9][0][5] = "Scheduled";
                            $chart[$d][9][0][6] = $user_time;
                            $chart[$d][9][0][7] = "Present";
                        } 
                        //if entry time beyond class schedule
                        else if ($d == $user_date and ($user_time <= $schedule[$day][3] || $user_time >= $schedule[$day][4])) 
                        {
                           
                        }
                    } 
                    //second class cancelled
                    else 
                    {
                        $chart[$d][9][0][5] = "Cancelled";
                        $chart[$d][9][0][6] = " ";
                        $chart[$d][9][0][7] = " ";
                    }
                }
								
				//if three classes on this date
                if ($schedule[$day][0] == 3) 
                {
                    //if first isn't cancelled
                    if (cancel_check($con, $d, $c_id, $schedule[$day][1], $schedule[$day][2])) 
                    {
                        if (($d == $user_date) and ($user_time >= $schedule[$day][1]) and ($user_time <= $schedule[$day][2])) 
                        {
                            //if student entry time is in scheduled class timing
                            $chart[$d][5] = "Scheduled";
                            $chart[$d][6] = $user_time;
                            $chart[$d][7] = "Present";
                        }
                        
                        //if user entry time is beyond the scheduled class time
                        else if (($d == $user_date) and ($user_time <= $schedule[$day][1] || $user_time >= $schedule[$day][2])) 
                        {                           
                            
                        }
                    }
                    
                    //if first class of the day is cancelled 
                    else 
                    {                        
                        $chart[$d][5] = "Cancelled";
                        $chart[$d][6] = " ";
                        $chart[$d][7] = " ";
                    }

                    //if second class of the day isn't cancelled   
                    if (cancel_check($con, $d, $c_id, $schedule[$day][3], $schedule[$day][4])) 
                    {
                        //if user entry time is between scheduled class
                        if ($d == $user_date and $user_time >= $schedule[$day][3] and $user_time <= $schedule[$day][4]) {
                            $chart[$d][9][0][5] = "Scheduled";
                            $chart[$d][9][0][6] = $user_time;
                            $chart[$d][9][0][7] = "Present";
                        } 
                        //if entry time beyond class schedule
                        else if ($d == $user_date and ($user_time <= $schedule[$day][3] || $user_time >= $schedule[$day][4])) 
                        {
                           
                        }
                    } 
                    //second class cancelled
                    else 
                    {
                        $chart[$d][9][0][5] = "Cancelled";
                        $chart[$d][9][0][6] = " ";
                        $chart[$d][9][0][7] = " ";
                    }
					
					//if third class of the day isn't cancelled   
                    if (cancel_check($con, $d, $c_id, $schedule[$day][6], $schedule[$day][7])) 
                    {
                        //if user entry time is between scheduled class
                        if ($d == $user_date and $user_time >= $schedule[$day][6] and $user_time <= $schedule[$day][7]) 
						{
                            $chart[$d][9][1][5] = "Scheduled";
                            $chart[$d][9][1][6] = $user_time;
                            $chart[$d][9][1][7] = "Present";
                        } 
                        //if entry time beyond class schedule
                        else if ($d == $user_date and ($user_time <= $schedule[$day][6] || $user_time >= $schedule[$day][7])) 
                        {
                           
                        }
                    } 
                    //third class cancelled
                    else 
                    {
                        $chart[$d][9][1][5] = "Cancelled";
                        $chart[$d][9][1][6] = " ";
                        $chart[$d][9][1][7] = " ";
                    }
                }
				
                //checking for extra classes
                //add to chart and also decide present or absent
				$query = "
                            SELECT time1_start , time1_end
                            FROM alter_class 
                            WHERE course_id='$c_id' AND date='$d' AND type='E'
						";
                
                $result = mysqli_query($con, $query) or die("Error: " . mysqli_error($con));

				$extra = array();
				$count = 0 ;
                $chart[$d][8] = 0;
				while ($row = mysqli_fetch_array($result)) 
                {           

					$chart2[$d][0] = $d;
					$chart2[$d][1] = $day;
					$chart2[$d][2] = $row['time1_start'];
					$chart2[$d][3] = $row['time1_end'];
					$chart2[$d][4] = "Extra";
					$chart2[$d][5] = "";
					$chart2[$d][6] = "Absent";

					 
					if ($user_time >= $row['time1_start'] and $user_time <= $row['time1_end']) 
					{
						
						$chart2[$d][5] = $user_time;
						$chart2[$d][6] = "Present";
					} 
					
					$extra[$count] = array($chart2[$d][0], $chart2[$d][1], $chart2[$d][2], $chart2[$d][3], $chart2[$d][4], $chart2[$d][5], $chart2[$d][6]);
					
					$count = $count + 1 ;
                
				}
				
				$chart[$d][10] = $extra ;
				$chart[$d][8]  = $count ;
                //next index of $ts[]
                $i = $i + 1;
            }//end of inner while loop
            
            //for those students whose $ts_length=0
			//chart has been initialized as absent for all scheduled class
			//so add information about only extra classes now
            if ($ts_length == 0)
            {
                //checking for extra classes
                $query1 = "
                            SELECT time1_start , time1_end
                            FROM alter_class 
                            WHERE course_id='$c_id' AND date='$d' AND type='E'
						";
                
                $result1 = mysqli_query($con, $query1) or die("Error: " . mysqli_error($con));
				$extraaa = array();
				$counttt = 0;
                $chart[$d][8] = 0;
				
				while ($row = mysqli_fetch_array($result1))
                {
					$chart[$d][8] = 1;

					$chart2[$d][0] = $d;
					$chart2[$d][1] = $day;
					$chart2[$d][2] = $row['time1_start'];
					$chart2[$d][3] = $row['time1_end'];
					$chart2[$d][4] = "Extra";
					$chart2[$d][5] = "";
					$chart2[$d][6] = "Absent";


					$extraaa[$counttt] = array($chart2[$d][0], $chart2[$d][1], $chart2[$d][2], $chart2[$d][3], $chart2[$d][4], $chart2[$d][5], $chart2[$d][6]);
					
					$counttt = $counttt + 1 ;
				}
				$chart[$d][10] = $extraaa ;
				$chart[$d][8]  = $counttt ;
				
            }//end of ts=0 condition
            
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
        
		}//outer while loop ends
		
		//if user wanted to export this data
		//variable $_SESSION['Export'] has been set in class_attend file in if(array_exist(export))
        if ($_SESSION['Export'] != "Yes")
		{
			print_chart($chart, $from, $till, $type, $holid , $comp_name,$comp_roll , $p);
		}
		else
		{
			export($chart, $from, $till, $type, $holid , $comp_name,$comp_roll , $p);
		}
}//report ends

function class_details($con, $c_id, $from, $till , $holid) {
    
	//variables for #classes 
    $class_count["Sunday"] 		= 0;
    $class_count["Monday"] 		= 0;
    $class_count["Tuesday"] 	= 0;
    $class_count["Wednesday"] 	= 0;
    $class_count["Thursday"] 	= 0;
    $class_count["Friday"] 		= 0;
    $class_count["Saturday"] 	= 0;
    
    $total_class = 0;
    $cancelled_class = 0;
    $extra_class = 0;

    //updating count of classes per day as given in database table course_schedule
    $query = "	
		SELECT day ,count 
		FROM course_schedule 
		WHERE course_id='$c_id'	
             ";
    $result = mysqli_query($con, $query) or die("Error: " . mysqli_error($con)); 
    while ($row = mysqli_fetch_array($result)) 
    {
        $class_count[$row['day']] = $row['count'];
    }

    // Set timezone
    date_default_timezone_set('UTC');

    // Start date
    $date = $from;

    // End date
    $end_date = $till;

    //finding total expected classes in expected scheduled classes
    while (strtotime($date) <= strtotime($end_date)) 
    {
        $dt = new DateTime($date);
        $day = $dt->format('l');
		
        switch ($day) 
        {

            case "Monday" : {
                    $total_class = $total_class + $class_count[$day];
                    break;
                }
            case "Tuesday" : {
                    $total_class = $total_class + $class_count[$day];
                    break;
                }
            case "Wednesday" : {
                    $total_class = $total_class + $class_count[$day];
                    break;
                }
            case "Thursday" : {
                    $total_class = $total_class + $class_count[$day];
                    break;
                }
            case "Friday" : {
                    $total_class = $total_class + $class_count[$day];
                    break;
                }
        }

        //date increment
        $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
    }

    //checking for extra and cancelled classes
    $query = "
		SELECT date , type 
		FROM alter_class 
		WHERE course_id='$c_id' AND date BETWEEN '$from' AND '$till'	
             ";

    $result = mysqli_query($con, $query) or die("Error: " . mysqli_error($con));
    
    while ($row = mysqli_fetch_array($result)) 
    {
        switch ($row['type']) {
            
            //E for extra
            case "E" : {
                    $extra_class = $extra_class + 1;
                    break;
                }
            
            //E for extra
            case "C" : {
					//if some class is cancelled on holiday. give more preference to cancel slots
					if ($holid[$row['date']] == 0 )
                    $cancelled_class = $cancelled_class + 1;
                    break;
                }
        }
    }
    
    //checking for holidays. if holidays are found subtract from total classes 
    $query =    "
		SELECT date 
		FROM holidays 
		WHERE  date BETWEEN '$from' AND '$till'	
                ";

    $result = mysqli_query($con, $query) or die("Error: " . mysqli_error($con));
    while ($row = mysqli_fetch_array($result)) 
    {
        $dt = new DateTime($row['date']);
        $day = $dt->format('l');        //day		
        $d = $dt->format('Y-m-d');      //date

        $total_class = $total_class - $class_count[$day];
    }
    
    $t = $total_class - $cancelled_class + $extra_class ;
 
    echo "<TABLE borderColor=#000000  cellSpacing=0 cellPadding=\"10\" border=0>\n";
    echo "From  ".$from . "  to  "  . $till. "<br><br>";
    echo "<TR><TD>Total scheduling expected :	</TD>" . "<TD class=\"val\">" . $total_class . "</TD></TR>";
    echo "<TR><TD>Total cancelled :	</TD>" . "<TD class=\"val\">" . $cancelled_class . "</TD></TR>";
    echo "<TR><TD>Total extra :	</TD>" . "<TD class=\"val\">" . $extra_class . "</TD></TR>";
    echo "<TR><TD>Total classes happened : </TD>" ."<TD class=\"val\">" . $t ."</TD></TR>";
    echo "</TABLE><br><br>";
}

function db_connect() {
    // Make a MySQL Connection
    $host = "localhost";
    $user = "b130727cs";
    $pass = "8686325560";
    $db = "db_b130727cs";
	
	$con = mysqli_connect($host, $user, $pass, $db);

    if (mysqli_connect_errno()) 
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    return $con;
}

function alter_db_connect() {
    // Make a MySQL Connection
    $host = "localhost";
    $user = "b130727cs";
    $pass = "8686325560";
    $db = "db_b130727cs";

    mysql_connect($host, $user, $pass) or die(mysql_error());
    mysql_select_db($db) or die(mysql_error());
}

function cancel_check($con, $d, $c_id, $time_start, $time_end) {
    
    $query = "      SELECT      * 
                    FROM alter_class 
                    WHERE course_id='$c_id'	AND date='$d' AND type='C' AND time1_start='$time_start' AND time1_end='$time_end'
             ";
    $result = mysqli_query($con, $query) or die("Error: " . mysqli_error($con));
    $row = mysqli_fetch_array($result);

    if (is_null($row) != 0) 
    {
        return true;
    } 
    else 
    {
        return false;
    }
}
function export($chart, $from, $till, $type, $holid , $comp_name,$comp_roll , $p)
{
	$present_count = 0;
    $absent_count = 0;

    $date = $from;
    $end_date = $till;
    $dt = new DateTime($date);
    $d = $dt->format('Y-m-d'); //date			

	//entry for name,uni_id , rollno , count
	//$stuInfo = $_SESSION['$entryCount'] ; 
	
	$_SESSION['info'] = "";
	
	//date window loop
    while (strtotime($date) <= strtotime($end_date)) 
    {
        $dt = new DateTime($date);
        $d = $dt->format('Y-m-d');
        $day = $dt->format('l');
	
        if ($holid[$d] == 1) 
        {
            if ($type == "Complete" )
            {
				
			}
            
            else
            {
                
            }
        } 
        else if ($chart[$d][7] == $type || $type == "Complete" || $type=="Compact") 
        {
            if($type!="Compact")
			{			
				//$_SESSION['list'][$_SESSION['$entryCount']]=array("".',', "".',', "".','  , $chart[$d][1].',' , $chart[$d][3].'--'.$chart[$d][4] );
				//$_SESSION['$entryCount'] = $_SESSION['$entryCount'] + 1 ;
				$_SESSION['info'] = $_SESSION['info']. $chart[$d][1] . "<".$chart[$d][3]."--".$chart[$d][4]."> \n";
			}
		
			if ($chart[$d][7] == "Absent")
                $absent_count++;
	        if ($chart[$d][7] == "Present")
                $present_count++;
		}
		
        if ($chart[$d][0] == 2 || $chart[$d][0] == 3) 
        {
			//if two classes in a day
            //first has been printed above
            
            if ($holid[$d] == 0 )
            {
				if ($chart[$d][9][0][7] == $type || $type == "Complete") 
                {
					
	//$_SESSION['list'][$_SESSION['$entryCount']]=array("".',', "".',', "".',' ,$chart[$d][9][0][1].',' , $chart[$d][9][0][3].'--'.$chart[$d][9][0][4] );
	//$_SESSION['$entryCount'] = $_SESSION['$entryCount'] + 1 ;
                $_SESSION['info'] = $_SESSION['info']. $chart[$d][9][0][1] . "<".$chart[$d][9][0][3]."--".$chart[$d][9][0][4]."> \n";
				}
				
				if ($chart[$d][9][0][7] == "Absent")
					 $absent_count++;
				if ($chart[$d][9][0][7] == "Present")
					$present_count++;
				
            }
            
            else if ($holid[$d]==1 )
            {
                if ($type=="Complete")
                {   
				
				}
                        
            }
          
        }


if ($chart[$d][0] == 3) 
{
			
            //if three classes in a day
            //first has been printed above
            
            if ($holid[$d] == 0 )
            {
				
                if ($chart[$d][9][1][7] == $type || $type == "Complete") 
                {
					
	//$_SESSION['list'][$_SESSION['$entryCount']]=array("".',', "".',', "".',' ,$chart[$d][9][1][1].',' , $chart[$d][9][1][3].'--'.$chart[$d][9][1][4]);
	//$_SESSION['$entryCount'] = $_SESSION['$entryCount'] + 1 ;
                $_SESSION['info'] = $_SESSION['info']. $chart[$d][9][1][1] . "<".$chart[$d][9][1][3]."--".$chart[$d][9][1][4]."> \n";    
                }
				
				if ($chart[$d][9][1][7] == "Absent")
					 $absent_count++;
				if ($chart[$d][9][1][7] == "Present")
					$present_count++;
				
            }
            
            else if ($holid[$d]==1 )
            {
                if ($type=="Complete")
                {   
					
				}
                        
            }
          
        }

        //if any extra classes arranged
        //no holiday check
        //because extra class can be on any holiday also
        if ($chart[$d][8] > 0) 
        {
			$count = 0;
			$num = $chart[$d][8] ;
			while ($num != 0)
			{
				if ($chart[$d][10][$count][6] == $type || $type == "Complete" || $type == "Compact") 
				{
					if ($type != "Compact")
					{
					
		//	$_SESSION['list'][$_SESSION['$entryCount']]=array("".',', "".',', "".',',$chart[$d][10][$count][0].',' ,$chart[$d][10][$count][2].'--'.$chart[$d][10][$count][3]);
		//	$_SESSION['$entryCount'] = $_SESSION['$entryCount'] + 1 ;
					$_SESSION['info'] = $_SESSION['info']. $chart[$d][10][$count][0] . "<".$chart[$d][9][10][$count][2]."--".$chart[$d][10][$count][3].">\n ";
					}
					
						
					if ($chart[$d][10][$count][6] == "Absent")
						$absent_count++;
					if ($chart[$d][10][$count][6] == "Present")
						$present_count++;
					
				}
				$num = $num - 1 ;
				$count = $count + 1 ;
			}
        }

        //date increment
        $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
    }
	$info = $_SESSION['info'] ;
	if ($type == "Absent")
	{
		$_SESSION['list'][$_SESSION['$entryCount']]=array($_SESSION['uni_id']  ,  $comp_name  ,  $comp_roll , $info  ,   $absent_count);
		$_SESSION['$entryCount'] = $_SESSION['$entryCount'] + 1 ;
		
	
	}
	else
	{
		$_SESSION['list'][$_SESSION['$entryCount']]=array($_SESSION['uni_id']  ,  $comp_name  ,  $comp_roll  ,  $info  ,    $present_count);
		$_SESSION['$entryCount'] = $_SESSION['$entryCount'] + 1 ;
		
	}
}

?>




