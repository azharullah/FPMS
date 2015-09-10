var flag=0;
var course_canvas;
var activeAjaxConnections = 0;



$(function () {
    $(".sr_no_edit").dblclick(function (e) {
		
        e.stopPropagation();
        var currentEle = $(this);
		var stuid=currentEle.prev().prev().html();
		var classid=currentEle.attr("data-classid");
        var value = $(this).html();
        updateVal(currentEle, value,stuid,classid);
    });
});

function updateVal(currentEle, value,stuid,classid) {
    $(currentEle).html('<input class="thVal" type="text" value="' + value + '" />');
    $(".thVal").focus();
    $(".thVal").keyup(function (event) {
        if (event.keyCode == 13) {
           var new_sno  = $(".thVal").val();
		   if (new_sno == "" || isNaN(new_sno))
		   {
			alert("Required field shouldn't be empty or it's not a number");
		   }
		   else
			change_sno(currentEle, value,stuid,classid,new_sno);
			
        }
    });
	/*
	$(document).not(currentEle).click(function () {
            var new_sno  = $(".thVal").val();
			change_sno(currentEle, value,stuid,classid,new_sno);
    });
*/
    
		
}




function change_sno(currentEle, value,stuid,classid,new_sno) {



    

     var url = "listener.php?action=change_sno&classid="+classid+"&stuid="+stuid.trim()+"&sno="+new_sno;
     var req = initRequest();
     req.open("GET", url, true);
     activeAjaxConnections++;
     req.onreadystatechange = function () {
         
         if (req.readyState == 4) {
            if (req.status == 200) {
				
                $(currentEle).html($(".thVal").val().trim());;
                activeAjaxConnections--;

            }
            if (req.status == 403) {
				if(value!=new_sno)
                alert("This serial number is already assigned");
				
				$(currentEle).html(value);
                 activeAjaxConnections--;
            }
            if( activeAjaxConnections==0)
            {
                //document.body.removeChild(document.getElementById("overlay"));
            }
        }


    };
    req.send(null);


}


function percentage (a,bb,ccc)
{
    var b = document.getElementById(bb);
    var c = document.getElementById(ccc);
    if (a.options[a.selectedIndex].text == "Compact")
    {
        if (b != null)
        {
            if ( b.style.display != 'block' )
            {	
                b.style.display = 'block';
                c.value = 101;
            }
            else if ( b.style.display != 'none' )
                b.style.display = 'none';
        }
    }
    else
    {
        b.style.display = 'none';
    }
}

window.onload = function hide ()
{

   var courseIDtag=document.getElementById("edit_courseid");
   if(courseIDtag!=null)
   {
       show_edit_details();
   }
   
   var courseIDtag=document.getElementById("edit_profileid");
   if(courseIDtag!=null)
   {
       show_profile_details();
   }


   var divOne = document.getElementById("start_time");
   if (divOne != null)
    divOne.style.display='block';

divOne = document.getElementById("finish_time");
if (divOne != null)
    divOne.style.display='block';

divOne = document.getElementById("if_req");
if (divOne != null)
    divOne.style.display='none';


divOne = document.getElementById("ForCanOne");
if (divOne != null)
    divOne.style.display='none';

divOne = document.getElementById("ForCanMny");
if (divOne != null)
    divOne.style.display='none';


divOne = document.getElementById("add_many_hol");
if (divOne != null)
    divOne.style.display='none';

divOne = document.getElementById("per");
if (divOne != null)
    divOne.style.display='none';

divOne = document.getElementById("hidden");
if (divOne != null)
    divOne.style.display='none';

divOne = document.getElementById("sun2");
if (divOne != null)
    divOne.style.display='none';

divOne = document.getElementById("sun3");
if (divOne != null)
    divOne.style.display='none';


divOne = document.getElementById("mon2");
if (divOne != null)
    divOne.style.display='none';

divOne = document.getElementById("mon3");
if (divOne != null)
    divOne.style.display='none';


divOne = document.getElementById("tue2");
if (divOne != null)
    divOne.style.display='none';

divOne = document.getElementById("tue3");
if (divOne != null)
    divOne.style.display='none';

divOne = document.getElementById("wed2");
if (divOne != null)
    divOne.style.display='none';

divOne = document.getElementById("wed3");
if (divOne != null)
    divOne.style.display='none';


divOne = document.getElementById("thu2");
if (divOne != null)
    divOne.style.display='none';

divOne = document.getElementById("thu3");
if (divOne != null)
    divOne.style.display='none';

divOne = document.getElementById("fri2");
if (divOne != null)
    divOne.style.display='none';

divOne = document.getElementById("fri3");
if (divOne != null)
    divOne.style.display='none';

divOne = document.getElementById("sat2");
if (divOne != null)
    divOne.style.display='none';

divOne = document.getElementById("sat3");
if (divOne != null)
    divOne.style.display='none';

}

function copy()
{
    var index = new Array('fri_time1_start','fri_time1_end','fri_time2_start','fri_time2_end', 'fri_time3_start' , 'fri_time3_end',
        'tue_time1_start','tue_time1_end','tue_time2_start','tue_time2_end', 'tue_time3_start' , 'tue_time3_end',
        'wed_time1_start','wed_time1_end','wed_time2_start','wed_time2_end', 'wed_time3_start' , 'wed_time3_end',
        'thu_time1_start','thu_time1_end','thu_time2_start','thu_time2_end', 'thu_time3_start' , 'thu_time3_end' 
        );

    var t1 = document.getElementsByName('mon_time1_start')[0].value ;
    var t2 = document.getElementsByName('mon_time1_end')[0].value ;
    var t3 = document.getElementsByName('mon_time2_start')[0].value ;
    var t4 = document.getElementsByName('mon_time2_end')[0].value;
    var t5 = document.getElementsByName('mon_time3_start')[0].value ;
    var t6 = document.getElementsByName('mon_time3_end')[0].value;
    var i = 0 ;
    
    show('Tue','tue2');
    show('Tue','tue3');
    show('Wed','wed2');
    show('Wed','wed3');
    show('Thu','thu2');
    show('Thu','thu3');
    show('Fri','fri2');
    show('Fri','fri3');

    while (i < 23)
    {
        document.getElementsByName(index[i++])[0].value = t1 ;
        document.getElementsByName(index[i++])[0].value = t2 ;
        document.getElementsByName(index[i++])[0].value = t3 ;
        document.getElementsByName(index[i++])[0].value = t4 ;
        document.getElementsByName(index[i++])[0].value = t5 ;
        document.getElementsByName(index[i++])[0].value = t6 ;

    }
    
    



}

function change (x,y,z)
{
	var a = document.getElementById(x);
	var b = document.getElementById(y);
	var c = document.getElementById(z);
	
	if (a.checked)
       {	document.getElementById("ForAddOne").style.display = 'block';
}
else
{
  document.getElementById("ForAddOne").style.display = 'none';
}

if (b.checked)
	{	document.getElementById("ForCanOne").style.display = 'block';
}
else
	{	document.getElementById("ForCanOne").style.display = 'none';
}

if (c.checked)
	{	document.getElementById("ForCanMny").style.display = 'block';
}
else
	{	document.getElementById("ForCanMny").style.display = 'none';
}
}	

function validation (f_id)
{	
    //alert(f_id);

    /*
		1.	check for empty entries
		2.	check for valid time entries
		1+2	give alerts about 1+2 in aingle alert box
		if these errors are removed then move forward
		3.	check for complete slot i.e. both starting and finishing time for a slot
		give alerts for 3
		4a.	check if starting time < finishing time or not
		4b.	check if starting date < finishing date or not
		give alerts for 4
		5. 	check if slots has been placed in order
		give alerts for 5
       */

       var reason  = "";



    // check 1 begin //

    var a	= 0;
    a	=	validateEmpty(f_id.CourseID);
    if (a==0)
        reason += "Course ID \n"; 
    a	=	validateEmpty(f_id.Name);
    if (a==0)
        reason += "Course name \n";
    a	=	validateEmpty(f_id.StartDate);
    if (a==0)
        reason += "Starting date \n";
    a	=	validateEmpty(f_id.FinishDate);
    if (a==0)
        reason += "Finishing date \n";



    var index = new Array(	
        'mon_time1_start','mon_time1_end','mon_time2_start','mon_time2_end', 'mon_time3_start' , 'mon_time3_end',
        'tue_time1_start','tue_time1_end','tue_time2_start','tue_time2_end', 'tue_time3_start' , 'tue_time3_end',
        'wed_time1_start','wed_time1_end','wed_time2_start','wed_time2_end', 'wed_time3_start' , 'wed_time3_end',
        'thu_time1_start','thu_time1_end','thu_time2_start','thu_time2_end', 'thu_time3_start' , 'thu_time3_end', 
        'fri_time1_start','fri_time1_end','fri_time2_start','fri_time2_end', 'fri_time3_start' , 'fri_time3_end', 
        'sat_time1_start','sat_time1_end','sat_time2_start','sat_time2_end', 'sat_time3_start' , 'sat_time3_end',
        'sun_time1_start','sun_time1_end','sun_time2_start','sun_time2_end', 'sun_time3_start' , 'sun_time3_end'
        );

    var day = new Array ('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');

    // check 2 begin //

    var b = 0;
    var c = 0;
    var d = 0;

    var answers = new Array();
    var reason1 = "";

    while (c < 42)
    {
        //alert(index[c]);
        answers[c] = 1;
        b = validateTime(index[c]  );

        if (b==0)
        {	

            reason1 += "\n"+day[Math.floor(c/6)] +" -- " +(Math.floor((c%6)/2)+1) +" slot" ;
            answers[c] = 0;

        }
        if (b==-1)
        {
            answers[c] = -1;
        }
        c=c+1;
    }

    // alert for check 1 and check 2 //
    if (reason != "" || reason1 != "") 
    {
        var string = "";

        if (reason  != "")
        {
            string  += "Following are empty :\n" + reason ;
        }
        if (reason1 != "")
        {
            string  += "\n\nFollowing slots has error in time format: " + reason1 ;
        }
        alert( string );

        return false;
    }


    // check 3 start //
    var count = 0;
    if (reason == "")
    {
        //alert("Hii");

        while (count < 42)
        {
            //alert(answers[count]+" " +answers[count+1]);
            if (answers[count] != answers[count+1] )
            {
                //alert("coutn :" + count);
                reason += "\n"+day[Math.floor(count/6)] + " - " + (Math.floor((count%6)/2)+1) + " slot.\n";
                var v = document.getElementsByName(index[count])[0].style.background = 'Yellow';
                v = document.getElementsByName(index[count+1])[0].style.background = 'Yellow';
            }
            count = count + 2 ;
        }
    }

    // check 3 alert //

    if (reason != "") 
    {
        alert("No complete slot :" + reason);
        return false;
    }

    // check 4 start //


    // check for date entries in starting and finishing time //
    if (reason == "")
    {
        var starting  = document.getElementsByName('StartDate')[0];
        var finishing = document.getElementsByName('FinishDate')[0];

        var s  = starting.value.split("-");
        var f  = finishing.value.split("-");

        var date1 = new Date(s[0],s[1],s[2]);
        var date2 = new Date(f[0],f[1],f[2]);

        if ( (date2.getTime() - date1.getTime() ) < 0 )
        {

            starting.style.background = 'Yellow';
            finishing.style.background= 'Yellow';
            alert("Starting date less than finishing date");
            return false;
        }
    }

    // check for time entries //
    if (reason == "")
    {
        count = 0;
        while ( count < 42 )
        {

            //alert(count);
            var start = document.getElementsByName(index[count])[0].value;
            var finish= document.getElementsByName(index[count+1])[0].value;


            if ((start.length + finish.length) == 0)
            {
            //
            //alert("in if");
        }
        else
        {
                //alert("in else");
                start = start .split(":");
                finish= finish.split(":");

                var d1 = new Date('1970','01','01',start[0],start[1],start[2]);
                var d2 = new Date('1970','01','01',finish[0],finish[1],finish[2]);



                if ( d1.getTime() >= d2.getTime() )
                {
                    //alert("inside if for "+count);
                    reason += "\n" + day[Math.floor(count/6)] + " -- " + (Math.floor((count%6)/2)+1) + " slot";
                //alert(reason);
            }
        }
        count = count + 2 ;
        //alert(count);
    }
    //alert("re");
}
    //alert("done");

    // check 4 alert //
    if (reason != "")
    {
        alert("Starting time less than finishing time :" + reason);
        return false;
    }

    // check 5 start //

    if (reason == "")
    {
        count = 0;
        while ( count < 42 )
        {

            //alert(count);
            var text1 = document.getElementsByName(index[count])[0].value.length;
            var text2 = document.getElementsByName(index[count+2])[0].value.length;
            var text3 = document.getElementsByName(index[count+4])[0].value.length;

            if ( (text1 == 0) && ( ( text2 > 0 ) || ( text3 > 0 ) ) )
            {
                reason += "\n"+day[Math.floor(count/6)] ;
                count = count + 6 ;
                continue;
            }
            if ( (text2 == 0) &&  ( text3 > 0 ) )
            {
                reason += "\n"+day[Math.floor(count/6)] ;
                count = count + 6 ;
                continue;
            }
            count = count + 6 ;
        }
    }

    // check 5 alert //
    if (reason != "")
    {
        alert("Please enter slots in order. Don't keep empty slots between two entered slots for following days.\n"+reason);
        return false;
    }

    return true;
} 

function validateTime(fld)
{
    var textbox = document.getElementsByName(fld)[0];
    var time    = textbox.value;
    var k = time.length;


    if ( k == 0 )
    {		
        k = k + k;

        //-1 for empty
        return -1;
    }
    else 
    {
        var array   = time.split(":");

        var patt   = /(([0-1][0-9])|2[0-3]):([0-5][0-9]):([0-5][0-9])$/g;
        var result  = time.match(patt);
        //alert("1");

        //if match found
        if (result != null)
        {
            //alert("2");
            var res_arr = result.length ;
            //alert("2.5" + result + "  " + res_arr);

            //if multiple matches found
            if (res_arr != 1)
            {
                //alert("3");
                textbox.style.background = 'Yellow';
                return 0;
            }			
            else
            {
                //if single match found
                //alert("4");
                textbox.style.background = 'White';
                return 1;
            }
        }				
        else
        {
            //if no matches found
            //alert("5");
            textbox.style.background = 'Yellow';
            return 0;
        }
        //alert("6");
        textbox.style.background = 'White';
        return 1;
    }
}

function validateEmpty(fld) {
    var error = "";
    if (fld.value.length == 0) {
        fld.style.background = 'Yellow'; 
        return 0;
    } 
    else 
    {
        fld.style.background = 'White';
    }
    return 1;   
}

function show (a ,b , c)
{
    //var but = document.getElementById(a);
    var divOne = document.getElementById(b);
    var check = document.getElementById(c);

    //block = show
    //none  = hide

    if (divOne.style.display != "block")
    {

        divOne.style.display = 'block';
        a.value = "  -1  Slot  ";

    }
    else if (divOne.style.display != "none")
    {
        if (b == c)
        {
            divOne.style.display = 'none';
            a.value = "  +1 Slot  ";
        }
        else
        {
            if (check.style.display != 'block')
            {
                divOne.style.display = 'none';
                a.value = "  +1 Slot  ";
            }
            else
            {

            }
        }
    }
}

function show1 (a )
{
    var divOne = document.getElementById(a);


    if (divOne.style.display != "block")
    {
        divOne.style.display = 'block';

    }
    else if (divOne.style.display != "none")
    {
        divOne.style.display = 'none';

    }


}

function show2 (a ,b )
{
    var divOne = document.getElementById(a);
    var divTwo = document.getElementById('mng_hol'); 
    var divThr = document.getElementById(b);


    if (divOne.style.display != "block")
    {
        divOne.style.display = 'block';

        divThr.style.display = 'block';

    }
    else if (divOne.style.display != "none")
    {
        divOne.style.display = 'none';
        
        divThr.style.display = 'none';

    }

    
    document.getElementById('add_hols').checked = false;
    document.getElementById('view_hols').checked = false;
}
function show3 (a ,b ,c ,d)
{
    var divOne = document.getElementById(a);
    var divTwo = document.getElementById(b);
    var divThr = document.getElementById(c);
    var divFor = document.getElementById(d);

    if (divOne.style.display != "block")
    {
        divOne.style.display = 'block';
        divTwo.style.display = 'none';
        divThr.style.display = 'none';
        divFor.style.display = 'none';
    }
    else if (divOne.style.display != "none")
    {
        divOne.style.display = 'none';
        divTwo.style.display = 'block';
        divThr.style.display = 'block';
        divFor.style.display = 'block';
    }
}
function show_courses() {

    course_canvas=document.getElementById("course_canvas");
    if(flag==0)
    {
        var linkElement = document.createElement("div");
        linkElement.setAttribute("id", "overlay");
        document.body.appendChild(linkElement);
        var url = "listener.php?action=show_course";
        req = initRequest();
        req.open("GET", url, true);
        req.onreadystatechange = callback;
        req.send(null);
        flag=1;
    }
    else
    {
        flag=0;
        remove_elements(course_canvas);
    }

}

function show_opted_courses() {

    course_canvas1=document.getElementById("course_canvas1");
    if(flag==0)
    {
        var linkElement = document.createElement("div");
        linkElement.setAttribute("id", "overlay");
        document.body.appendChild(linkElement);
        var url = "listener.php?action=show_opted_courses";
        req = initRequest();
        req.open("GET", url, true);
        req.onreadystatechange = callback1;
        req.send(null);
        flag=1;
    }
    else
    {
        flag=0;
        remove_elements(course_canvas1);
    }

}


function show_edit_details() {

    var linkElement = document.createElement("div");
    linkElement.setAttribute("id", "overlay");
    document.body.appendChild(linkElement);
    var courseIDtag=document.getElementById("edit_courseid");
    var courseID=courseIDtag.options[courseIDtag.selectedIndex].value;

    var url = "listener.php?action=show_edit_details&courseID="+courseID;
    req = initRequest();
    req.open("GET", url, true);
    req.onreadystatechange = callback2;
    req.send(null);
    flag=1;
    
    
}


function show_profile_details() {

    var linkElement = document.createElement("div");
    linkElement.setAttribute("id", "overlay");
    document.body.appendChild(linkElement);
    var courseIDtag=document.getElementById("edit_profileid");
    var profileID=courseIDtag.options[courseIDtag.selectedIndex].value;
	
    var url = "listener.php?action=show_profile_details&sno="+profileID;
    req = initRequest();
    req.open("GET", url, true);
    req.onreadystatechange = callback3;
    req.send(null);
    flag=1;
    
    
}

function enroll(ele) {



    var id=ele.getAttribute("id");

    var name=ele.getAttribute("name");
    
    var sno=ele.parentNode.previousSibling.firstChild.value;

    if(sno=="")
    {
        alert("please enter serial no first");
    }
    
    else {

     var url = "listener.php?action=enroll&id="+name+"&st_toenroll="+id+"&sno="+sno;
     var req = initRequest();
     req.open("GET", url, true);
     activeAjaxConnections++;
     req.onreadystatechange = function () {
         
         if (req.readyState == 4) {
            if (req.status == 200) {

                var parent=ele.parentNode.parentNode;
                parent.parentNode.removeChild(parent);
                activeAjaxConnections--;

            }
            if (req.status == 403) {

                alert("This serial number is already assigned");
                 activeAjaxConnections--;
            }
            if( activeAjaxConnections==0)
            {
                document.body.removeChild(document.getElementById("overlay"));
            }
        }


    };
    req.send(null);

}



}



function enroll_all()
{

    

    var a=document.getElementsByName("sno");
    
    var flag=0;
    for(i=0;i<a.length;i++)
    {

        if(a[i].value=="")
        {
            flag=1;
            alert("One or More serial no fields are empty, Please check..")
            break;

        }
    }
    if(!flag)
    {
        var linkElement = document.createElement("div");
    
    linkElement.setAttribute("id", "overlay");

    document.body.appendChild(linkElement);
    
        for(i=0;i<a.length;i++)
        {
            var link=a[i].parentNode.nextSibling.firstChild;
            
            enroll(link);
        }
    }
    
}


function remove_elements(ele)
{
    for (loop = ele.childNodes.length -1; loop >= 0 ; loop--) {
        ele.removeChild(ele.childNodes[loop]);
    }
}

function initRequest() {

    if (window.XMLHttpRequest) {
        if (navigator.userAgent.indexOf('MSIE') != -1) {
            isIE = true;
        }
        return new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        isIE = true;
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

function callback() {


    if (req.readyState == 4) {
        if (req.status == 200) {

            parseMessages(req.responseXML);
        }
        document.body.removeChild(document.getElementById("overlay"));
    }
    
}

function callback1() {


    if (req.readyState == 4) {
        if (req.status == 200) {

            parseMessages1(req.responseXML);
        }
         document.body.removeChild(document.getElementById("overlay"));
    }
    
}


function callback2() {

   
    if (req.readyState == 4) {
       
        if (req.status == 200) {

            parseMessages2(req.responseXML);
             
        }
        document.body.removeChild(document.getElementById("overlay"));
    }
    
}

function callback3() {

   
    if (req.readyState == 4) {
       
        if (req.status == 200) {

            parseMessages3(req.responseXML);
             
        }
        document.body.removeChild(document.getElementById("overlay"));
    }
    
}

function callback4() {

   
    if (req.readyState == 4) {
       
        if (req.status == 200) {

            parseMessages3(req.responseXML);
             
        }
        document.body.removeChild(document.getElementById("overlay"));
    }
    
}

function parseMessages(responseXML) {


    // no matches returned

    if (responseXML == null) {

        return false;
        
    } else {

        var courses = responseXML.getElementsByTagName("courses")[0];

        if (courses.childNodes.length > 0) {

            for (loop = 0; loop < courses.childNodes.length; loop++) {

                var course = courses.childNodes[loop];

                var course_name = course.getElementsByTagName("course_name")[0].childNodes[0].nodeValue;

                var course_id = course.getElementsByTagName("course_id")[0].childNodes[0].nodeValue;


                linkElement = document.createElement("a");
                linkElement.appendChild(document.createTextNode(course_name));
                linkElement.setAttribute("href", "facindex.php?page=course_sel&id="+course_id);
                // linkElement.setAttribute("onclick", "show_selected(this)");
                course_canvas.appendChild(linkElement);
                linkElement = document.createElement("br"); 
                course_canvas.appendChild(linkElement);



            }
        }
    }

}


function parseMessages1(responseXML) {

    // no matches returned

    if (responseXML == null) {

        return false;
        
    } else {

        var courses = responseXML.getElementsByTagName("courses")[0];

        if (courses.childNodes.length > 0) {

            for (loop = 0; loop < courses.childNodes.length; loop++) {

                var course = courses.childNodes[loop];

                //var course_name = course.getElementsByTagName("course_id")[0].childNodes[0].nodeValue;

                var course_id = course.getElementsByTagName("course_id")[0].childNodes[0].nodeValue;


                linkElement = document.createElement("a");
                //linkElement.appendChild(document.createTextNode(course_name));
                linkElement.appendChild(document.createTextNode(course_id));
                linkElement.setAttribute("href", "stuindex.php?page=course_sel&id="+course_id);
                // linkElement.setAttribute("onclick", "show_selected(this)");
                course_canvas1.appendChild(linkElement);
                linkElement = document.createElement("br"); 
                course_canvas1.appendChild(linkElement);



            }
        }
    }

}



function parseMessages2(responseXML) {


    // no matches returned

    if (responseXML == null) {

        return false;
        
    } else {


        var courses = responseXML.getElementsByTagName("course_details")[0];

        if (courses.childNodes.length > 0) {
            document.getElementById("Course_Name").value= courses.getElementsByTagName("Course_Name")[0].childNodes[0].nodeValue;
            var mySelect =document.getElementById("FacultyID");
            var temp=courses.getElementsByTagName("FacultyID")[0].childNodes[0].nodeValue; 
            
            for(var i, j = 0; i = mySelect.options[j]; j++) {
                if(i.value == temp) {
                    mySelect.selectedIndex = j;
                    break;
                }
            }
            
            
            document.getElementById("Start_Date").value= courses.getElementsByTagName("Start_Date")[0].childNodes[0].nodeValue;  
            document.getElementById("Finish_Date").value= courses.getElementsByTagName("Finish_Date")[0].childNodes[0].nodeValue;  


            
           

            document.getElementsByName("mon_time1_start")[0].value= courses.getElementsByTagName("mon_time1_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("mon_time1_end")[0].value= courses.getElementsByTagName("mon_time1_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("mon_time2_start")[0].value= courses.getElementsByTagName("mon_time2_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("mon_time2_end")[0].value= courses.getElementsByTagName("mon_time2_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("mon_time3_start")[0].value= courses.getElementsByTagName("mon_time3_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("mon_time3_end")[0].value= courses.getElementsByTagName("mon_time3_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("tue_time1_start")[0].value= courses.getElementsByTagName("tue_time1_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("tue_time1_end")[0].value= courses.getElementsByTagName("tue_time1_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("tue_time2_start")[0].value= courses.getElementsByTagName("tue_time2_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("tue_time2_end")[0].value= courses.getElementsByTagName("tue_time2_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("tue_time3_start")[0].value= courses.getElementsByTagName("tue_time3_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("tue_time3_end")[0].value= courses.getElementsByTagName("tue_time3_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("wed_time1_start")[0].value= courses.getElementsByTagName("wed_time1_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("wed_time1_end")[0].value= courses.getElementsByTagName("wed_time1_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("wed_time2_start")[0].value= courses.getElementsByTagName("wed_time2_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("wed_time2_end")[0].value= courses.getElementsByTagName("wed_time2_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("wed_time3_start")[0].value= courses.getElementsByTagName("wed_time3_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("wed_time3_end")[0].value= courses.getElementsByTagName("wed_time3_end")[0].childNodes[0].nodeValue; 
            
            
            document.getElementsByName("thu_time1_start")[0].value= courses.getElementsByTagName("thu_time1_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("thu_time1_end")[0].value= courses.getElementsByTagName("thu_time1_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("thu_time2_start")[0].value= courses.getElementsByTagName("thu_time2_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("thu_time2_end")[0].value= courses.getElementsByTagName("thu_time2_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("thu_time3_start")[0].value= courses.getElementsByTagName("thu_time3_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("thu_time3_end")[0].value= courses.getElementsByTagName("thu_time3_end")[0].childNodes[0].nodeValue; 
            
            document.getElementsByName("fri_time1_start")[0].value= courses.getElementsByTagName("fri_time1_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("fri_time1_end")[0].value= courses.getElementsByTagName("fri_time1_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("fri_time2_start")[0].value= courses.getElementsByTagName("fri_time2_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("fri_time2_end")[0].value= courses.getElementsByTagName("fri_time2_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("fri_time3_start")[0].value= courses.getElementsByTagName("fri_time3_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("fri_time3_end")[0].value= courses.getElementsByTagName("fri_time3_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("sat_time1_start")[0].value= courses.getElementsByTagName("sat_time1_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("sat_time1_end")[0].value= courses.getElementsByTagName("sat_time1_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("sat_time2_start")[0].value= courses.getElementsByTagName("sat_time2_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("sat_time2_end")[0].value= courses.getElementsByTagName("sat_time2_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("sat_time3_start")[0].value= courses.getElementsByTagName("sat_time3_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("sat_time3_end")[0].value= courses.getElementsByTagName("sat_time3_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("sun_time1_start")[0].value= courses.getElementsByTagName("sun_time1_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("sun_time1_end")[0].value= courses.getElementsByTagName("sun_time1_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("sun_time2_start")[0].value= courses.getElementsByTagName("sun_time2_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("sun_time2_end")[0].value= courses.getElementsByTagName("sun_time2_end")[0].childNodes[0].nodeValue; 

            document.getElementsByName("sun_time3_start")[0].value= courses.getElementsByTagName("sun_time3_start")[0].childNodes[0].nodeValue;        
            document.getElementsByName("sun_time3_end")[0].value= courses.getElementsByTagName("sun_time3_end")[0].childNodes[0].nodeValue; 
        }
    }

}


function parseMessages3(responseXML) 
{


    // no matches returned

    if (responseXML == null) {
		
        return false;
        
    } 
	else 
	{
		
		 var profile = responseXML.getElementsByTagName("profile")[0];
		
         if (profile.childNodes.length > 0)
		 {

			document.getElementsByName("name1")[0].value=profile.getElementsByTagName("name")[0].childNodes[0].nodeValue;
			document.getElementsByName("phone1")[0].value=profile.getElementsByTagName("phone_no")[0].childNodes[0].nodeValue;
			document.getElementsByName("email1")[0].value=profile.getElementsByTagName("email_id")[0].childNodes[0].nodeValue;
		 }
	}
}

function parseMessages3(responseXML) 
{


    // no matches returned

    if (responseXML == null) {
		
        return false;
        
    } 
	else 
	{
		
		 var profile = responseXML.getElementsByTagName("profile")[0];
		
         if (profile.childNodes.length > 0)
		 {

			document.getElementsByName("name1")[0].value=profile.getElementsByTagName("name")[0].childNodes[0].nodeValue;
			document.getElementsByName("phone1")[0].value=profile.getElementsByTagName("phone_no")[0].childNodes[0].nodeValue;
			document.getElementsByName("email1")[0].value=profile.getElementsByTagName("email_id")[0].childNodes[0].nodeValue;
		 }
	}
}
	
	
