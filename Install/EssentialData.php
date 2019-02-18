<?php
printf("<br><h1>ESSESTIAL DATA</h1><br>");

/*----Data inserted in tables*/

/*--------<INSERT DATA TO TABLE AVAILABLE>--------*/
$DBQuery="INSERT INTO ".$DBConn->GetPrefix()."AVAILABLE
(AVAILABLE_Deleted)
VALUES
(TRUE),
(FALSE);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg . " -> AVAILABLE");
else
	printf("<br>ERROR 1 " . $DBInsErrorMsg . $DBConn->GetError());

/*--------<INSERT DATA TO TABLE ACCESS_LEVEL>--------*/
$DBQuery="INSERT INTO ".$DBConn->GetPrefix()."ACCESS_LEVEL
(ACCESS_LEVEL_Title,
ACCESS_LEVEL_Clearance,
AVAILABLE_ID)
VALUES
(\"Admin\",1,2),
(\"CEO\",2,2),
(\"Employee\",3,2),
(\"Guest\",4,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg . " -> ACCESS_LEVEL");
else
	printf("<br>ERROR 2 " . $DBInsErrorMsg . $DBConn->GetError());

require_once("DemoData.php");

?>
