<?php

/* Connect to the local server using AD DS Windows Authentication system */

$serverName = "SQLSERVER1\SQLEXPRESS";
$connectionInfo = array(
	"Database"=>"FB_Website_table1",
	"CharacterSet"=>"UTF-8"
);

$conn = sqlsrv_connect($serverName, $connectionInfo);

if( $conn ) {
     echo "Connection Established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r(sqlsrv_errors(), true));
}  

/* Define the query */  
$tsql1 = "INSERT INTO dbo.FB_Website_table1 (Groupname, Firstname, Lastname, Located, [Date submitted])  
           VALUES (?, ?, ?, ?, ?)";  

/* Construct the parameter array from HTML variable inputs */  
$Groupname = $_POST ["Groupname"];  
$Firstname = $_POST ["Firstname"];  
$Lastname = $_POST ["Lastname"];  
$Located = $_POST ["Located"];
$Datesubmitted = $_POST ["Date submitted"];

$params1 = array(
	array ($Groupname, null),
	array($Firstname, null),
	array($Lastname, null),
	array($Located, null),
	array($Datesubmitted , null),
           );    

/* Execute the INSERT query. */  
$stmt1 = sqlsrv_query($conn, $tsql1, $params1);  
if( $stmt1 === false )  
{  
     echo "Error in execution of INSERT.\n";  
     die( print_r( sqlsrv_errors(), true));  
}  
if( $stmt1 ) 
{
     echo "Database updated by WebServer1.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

//Set Refresh header using PHP.
header( "refresh:5;url=http://www.youtube.com/watch?v=dQw4w9WgXcQ" );

//Print out some content for example purposes.
echo 'This page will be redirected in 5 seconds.';
?>