<?php
print("<br><h1>ESSESTIAL DATA</h1><br>");

/*----Data inserted in tables*/

/*--------<INSERT DATA TO TABLE AVAILABLE>--------*/
$DBQuery="INSERT INTO ".$sPrefix."AVAILABLE
(AVAILABLE_Deleted)
VALUES
(TRUE),
(FALSE);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>%s -> AVAILABLE", $DBInsSuccMsg);
else
	printf("<br>ERROR 1 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE ACCESS_LEVEL>--------*/
$DBQuery="INSERT INTO ".$sPrefix."ACCESS_LEVEL
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
	printf("<br>%s -> ACCESS_LEVEL", $DBInsSuccMsg);
else
	printf("<br>ERROR 2 %s %s", $DBInsErrorMsg, $DBConn->GetError());

require_once("DemoData.php");

?>
