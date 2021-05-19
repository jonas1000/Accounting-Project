<?php


/*----Data inserted in tables*/
function InsertEssentialData(ME_CDBConnManager &$InrConn, string &$InsPrefix)
{
    /*--------<INSERT DATA TO TABLE AVAILABLE>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."AVAILABLE
    (AVAILABLE_Deleted)
    VALUES
    (?);";

    $rStatement = $InrConn->CreateStatement($sQuery);

    $bAvailable = 0;

    $rStatement->bind_param("i", $bAvailable);

    $rStatement->execute();

    $bAvailable = 1;

    $rStatement->execute();

    $InrConn->Commit();


    /*--------<INSERT DATA TO TABLE ACCESS_LEVEL>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."ACCESS_LEVEL
    (ACCESS_LEVEL_Title,
    ACCESS_LEVEL_Clearance,
    AVAILABLE_ID)
    VALUES
    (?,?,?);";


    $rStatement->prepare($sQuery);

    $sAccessLevelTitle = "Admin";
    $iAccessLevelClearance = 1;
    $iAccessLevelAvailableID = $GLOBALS['AVAILABLE']['SHOW'];

    $rStatement->bind_param("sii", $sAccessLevelTitle, $iAccessLevelClearance, $iAccessLevelAvailableID);

    $rStatement->execute();


    $sAccessLevelTitle = "CEO";
    $iAccessLevelClearance = 2;
    $iAccessLevelAvailableID = $GLOBALS['AVAILABLE']['SHOW'];

    $rStatement->execute();


    $sAccessLevelTitle = "Employee";
    $iAccessLevelClearance = 3;
    $iAccessLevelAvailableID = $GLOBALS['AVAILABLE']['SHOW'];

    $rStatement->execute();


    $sAccessLevelTitle = "Guest";
    $iAccessLevelClearance = 4;
    $iAccessLevelAvailableID = $GLOBALS['AVAILABLE']['SHOW'];

    $rStatement->execute();

    $InrConn->Commit();

    $rStatement->close();
}
?>
