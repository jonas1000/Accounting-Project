<?php
function ProEditCustomer(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess)
{
    if(isset($_POST['CustIndex'], $_POST['Name'], $_POST['Surname'], $_POST['PhoneNumber'], $_POST['StableNumber'], $_POST['Email'], $_POST['VAT'], $_POST['Addr'], $_POST['Note'], $_POST['Access']) 
    && !ME_MultyCheckEmptyType($_POST['CustIndex'], $_POST['Name'], $_POST['Surname'], $_POST['PhoneNumber'], $_POST['Access']) 
    && ME_MultyCheckNumericType($_POST['CustIndex'], $_POST['Access']))
    {
        //format the string to be compatible with HTML and avoid SQL injection
        $sName = ME_SecDataFilter($_POST['Name']);
        $sSurname = ME_SecDataFilter($_POST['Surname']);
        $sPhoneNumber = ME_SecDataFilter($_POST['PhoneNumber']);
        $sStableNumber = ME_SecDataFilter($_POST['StableNumber']);
        $sEmail = ME_SecDataFilter($_POST['Email']);
        $sVAT = ME_SecDataFilter($_POST['VAT']);
        $sAddr = ME_SecDataFilter($_POST['Addr']);
        $sNote = ME_SecDataFilter($_POST['Note']);

        //variables consindered to be holding ID's
        $iCustomerIndex = (int)$_POST['CustIndex'];
        $iContentAccess = (int)$_POST['Access'];

        //database cannot accept Primary or foreign keys below 1
        //If duplicate the database will throw a exception
        if(CheckAccessRange($iContentAccess) && ($iCustomerIndex > 0) && CheckAccessRange($IniUserAccess))
        {
            //Get the information of the row to be able to modifie references
            $rResult = CustomerSpecificRetriever($InrConn, $InrLogHandle, $iCustomerIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['SHOW']);

            if(!empty($rResult) && ($rResult->num_rows == 1))
            {
                $aDataRow = $rResult->fetch_assoc();

                $iCustomerDataIndex = (int) $aDataRow['CUST_DATA_ID'];
                $iCustomerAccess = (int) $aDataRow['CUST_ACCESS'];

                if(($iCustomerDataIndex > 0) && CheckAccessRange($iCustomerAccess))
                {
                    if(CustomerEditParser($InrConn, $InrLogHandle, $iCustomerIndex, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
                    {
                        if(CustomerDataEditParser($InrConn, $InrLogHandle, $iCustomerDataIndex, $sName, $sSurname, $sPhoneNumber, $sStableNumber, $sEmail, $sVAT, $sAddr, $sNote, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
                            $InrConn->Commit();
                        else
                        {
                            $InrConn->RollBack();
                            $InrLogHandle->AddLogMessage("Failed to edit data table", __FILE__, __FUNCTION__, __LINE__);
                        }
                    }
                    else
                    {
                        $InrConn->RollBack();
                        $InrLogHandle->AddLogMessage("Failed to edit table", __FILE__, __FUNCTION__, __LINE__);
                    }
                }
                else
                    $InrLogHandle->AddLogMessage("Query returned empty, did not find any ID (Possible data corruption)", __FILE__, __FUNCTION__, __LINE__);

                $rResult->free();
            }
            else
                $InrLogHandle->AddLogMessage("Could not fetch Table result", __FILE__, __FUNCTION__, __LINE__);
        }
        else
            $InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __FUNCTION__, __LINE__);
	}
	else
        $InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);
}
?>