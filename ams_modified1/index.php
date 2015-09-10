<html>
<head>
    <title>Attendance Management System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <link href="css/style1.css" rel="stylesheet" type="text/css" />
</head>
<body id="page">
  <script>
  function studentchk()
    {
        var divOne = document.getElementById("pass1");
        if (document.login.loginas.value == "Student")
        {
					//alert("hello");
					//var divOne = document.getElementById("pass");
					
            divOne.style.visibility = 'hidden';
        }
        else
        {
            divOne.style.visibility = 'visible';
        }
    }
       </script>
       
       <div id="header">
        <br> <br> <h1><center>Attendance Management System</center></h1><br><br>
    </div>
    <br><br><br><br>
    <div id="content">

        <div class="wrapper">

            <div id="corner"></div>
            <div class="col-center">
                
                <div class="login_box">
                <form name="login" action="login.php" method="post">
                    <fieldset>
                        <div class="field">
                            <label>Login as &nbsp;&nbsp; </label> 
                            <select name="loginas" size="1" onchange='studentchk();'>
                            <option> Faculty </option>
                            <option> Admin </option>
                            
                            <option value="Student"> Student </option>
                            </select>
                        </div>
                    <br>
                    <br>
                    <div class="field">
                                                <input type="text" name="id" value=""  placeholder="Username" required="" id="username" />
                    </div>
                    <br>
                    
                    <div class="field" id="pass1">
                       
                        <input type="password" name="password" value=""  placeholder="Password"  id="password"/>
                    </div>
                    <br>
                    <?php
                    session_start();
                    $_SESSION['nm']="";
                    if (isset($_GET['q']) && $_GET['q'] === 'invalid') {
                        echo "<div class='errors' style='text-align:center'> Wrong Id or Password</li></div>";
                    }

                    if (isset($_SESSION['started']) && $_SESSION['loginas'] == "Admin" && ($_SESSION['started'] == 1)) {
                        header('Location:adminindex.php');
                    }

                    if (isset($_SESSION['started']) && $_SESSION['loginas'] == "Faculty" && ($_SESSION['started'] == 1)) {
                        header('Location:facindex.php');
                    }

                    if (isset($_SESSION['started']) && $_SESSION['loginas'] == "Student" && ($_SESSION['started'] == 1)) {
                        header('Location:stuindex.php');
                    }
                    ?>
                    <div class="field">
                        <label></label>
                        <input type="submit" value="Login" name="login" class="submit" />
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    </div>

</body>
</html>
