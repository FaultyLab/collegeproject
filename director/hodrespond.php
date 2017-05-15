<?php
include('session.php');
isset($_SESSION) || session_start();
?>
<html>

	<head>
  <title>N.B.K.R INSTITUTE OF SCIENCE & TECHNOLOGY</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="password.js"></script>

</head>
	<body>
	<?php
include "databaseconnection.php"; //Include the database connection script
$query="SELECT * FROM director WHERE userid='".mysqli_real_escape_string($con,$_SESSION["login_user"])."'";
//Check the logged in user information from the database
$check_user_details = mysqli_query($con,$query);
if (!$query) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}


//Get the logged in user info from the database
$get_user_details = mysqli_fetch_array($check_user_details);

//Pass all the logged in user info to variables to easily display them when needed
$user_id = strip_tags($get_user_details['userid']);
$name = strip_tags($get_user_details['name']);
$gender = strip_tags($get_user_details['gender']);
$department = strip_tags($get_user_details['department']);
$date = strip_tags($get_user_details['date']);
$month = strip_tags($get_user_details['month']);
$year = strip_tags($get_user_details['year']);
?>

		<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="http://nbkrist.org">N.B.K.R.I.S.T.</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">INSTRUCTIONS <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="instructions.php">FACULTY</a></li>
          </ul>
        </li>
        <li><a href="index.php">HOME</a></li>
		<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">RESPOND <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="facultyrespond.php">FACULTY</a></li>
			<li><a href="hodrespond.php">HOD</a></li>
          </ul>
        </li>
      </ul>
	  <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> LOG OUT</a></li>
    </div>
  </div>
</nav>
</br>
</br>
</br>
<form align="center">
<img src="nbkrist.png"  class="img-rounded" alt="Cinque Terre" width="200" height="200">
</form>
<div class="container">
  <div class="jumbotron">
<?php
include "databaseconnection.php"; 
$query="select * from hodrequest";
$result=mysqli_query($con,$query);
echo"<div class='table-responsive'>";
echo"<table class='table'>";
   echo" <thead>";
   echo"   <tr>";
   echo"  <th>#</th>";
      echo"  <th>USER ID</th>";
	  echo"<th>FROM DATE</th>";
	   echo"<th>TO DATE</th>";
	  echo"<th>SUBJECT</th>";
	  echo"<th>REASON</th>";
        echo"<th>LEAVE TYPE</th>";
		echo"<th>DAYS</th>";
		echo"<th>STATUS</th>";
     echo" </tr>";
   echo" </thead>";
      echo" <tbody>";
   while($row=mysqli_fetch_array($result))
   {
	if($row["directorstatus"]=="ACCEPTED" || $row["directorstatus"]=="REJECTED")
	{
		echo" <tr class='info'>";
	echo"    <td>",$row['id'],"</td>";
    echo"    <td>",$row['fromuser'],"</td>";
	echo"   <td>",$row['fromdate'],"-",$row['frommonth'],"-",$row['fromyear'],"</td>";
	echo"   <td>",$row['todate'],"-",$row['tomonth'],"-",$row['toyear'],"</td>";
	echo"    <td>",$row['subject'],"</td>";
	echo"    <td>",$row['reason'],"</td>";
	 $a=$row["id"];
     echo"   <td>",$row['leavetype'],"</td>";
	 echo"   <td>",$row['daysapplied'],"</td>";
	 echo"    <td>",$row['directorstatus'],"</td>";
     echo" </tr>";
	}
	else{
    echo" <tr class='info'>";
	echo"    <td>",$row['id'],"</td>";
    echo"    <td>",$row['fromuser'],"</td>";
	echo"   <td>",$row['fromdate'],"-",$row['frommonth'],"-",$row['fromyear'],"</td>";
	echo"   <td>",$row['todate'],"-",$row['tomonth'],"-",$row['toyear'],"</td>";
	echo"    <td>",$row['subject'],"</td>";
	echo"    <td>",$row['reason'],"</td>";
	 $a=$row["id"];
     echo"   <td>",$row['leavetype'],"</td>";
	 echo"   <td>",$row['daysapplied'],"</td>";
	 echo"    <td>",$row['directorstatus'],"<form method='post' action = 'accepthodrequest.php' class='form' id='ACCEPT'>
	 <input type = 'hidden' name = 'id' value=",$a,"/>
<input type = 'submit' VALUE = 'ACCEPT'/></form><form method='post' action = 'rejecthodrequest.php' class='form' id='REJECT'>
	 <input type = 'hidden' name = 'id' value=",$a,"/>
<input type = 'submit' value = 'REJECT'/></form></td>";
     echo" </tr>";
   }
   }
    echo"</tbody>";
 echo" </table>";
 echo"</div>";

?>
  
  </div>
</div>
</body>
</html>