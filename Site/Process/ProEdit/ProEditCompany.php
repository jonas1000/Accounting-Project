<?php

function ProEditCompany(CDBConnManager &$InDBConn)
{
    if(isset($_POST['Name'], $_POST['Date'], $_POST['County'], $_POST['Access']))
    {
        if(ME_MultyCheckEmptyType($_POST['Name'], $_POST['Date'], $_POST['County'], $_POST['Access']))
        {
            $sName = $_POST['Name'];
            $sDate = $_POST['Date'];
            $sCounty = $_POST['County'];
            $sAccess = $_POST['Access'];

            CompanyEditParser($InDBConn, $sCounty );
        } 
        else
            throw new Exception("Some POST data are NULL, Those POST cannot be NULL");
    } 
    else
        throw new Exception("Some POST data are not initialized");
}

?>