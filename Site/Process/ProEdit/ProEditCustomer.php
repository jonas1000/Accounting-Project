<?php
//-------------<FUNCTION>-------------//
function ProEditCustomer(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex)
{
    if(isset($_POST['CustIndex'], $_POST['Name'], $_POST['Surname'], $_POST['PhoneNumber'], $_POST['StableNumber'], $_POST['Email'], $_POST['VAT'], $_POST['Addr'], $_POST['Note'], $_POST['Access']))
    {
        if(ME_MultyCheckEmptyType($_POST['CustIndex'], $_POST['Name'], $_POST['Surname'], $_POST['PhoneNumber'], $_POST['Access'], $IniUserAccessLevelIndex))
        {
            if(ME_MultyCheckNumericType($_POST['CustIndex'], $_POST['Access']))
            {
                //take strings as is
                $sName = $_POST['Name'];
                $sSurname = $_POST['Surname'];
                $sPhoneNumber = $_POST['PhoneNumber'];
                $sStableNumber = $_POST['StableNumber'];
                $sEmail = $_POST['Email'];
                $sVAT = $_POST['VAT'];
                $sAddr = $_POST['Addr'];
                $sNote = $_POST['Note'];

                //variables consindered to be holding ID's
                $iCustomerIndex = (int) $_POST['CustIndex'];
                $iContentAccessIndex = (int) $_POST['Access'];

                unset($_POST['CustIndex'], $_POST['Name'], $_POST['Surname'], $_POST['PhoneNumber'], $_POST['StableNumber'], $_POST['Email'], $_POST['VAT'], $_POST['Addr'], $_POST['Note'], $_POST['Access']);

                //format the string to be compatible with HTML and avoid SQL injection
                ME_SecDataFilter($sName);
                ME_SecDataFilter($sSurname);
                ME_SecDataFilter($sPhoneNumber);
                ME_SecDataFilter($sStableNumber);
                ME_SecDataFilter($sEmail);
                ME_SecDataFilter($sVAT);
                ME_SecDataFilter($sAddr);
                ME_SecDataFilter($sNote);

                //database cannot accept Primary or foreign keys below 1
				//If duplicate the database will throw a exception
                if(($iContentAccessIndex > 0) && ($iCustomerIndex > 0) && ($IniUserAccessLevelIndex > 0))
                {
                    //Get the information of the row to be able to modifie references
                    CustomerGeneralSpecificRetriever($InDBConn, $iCustomerIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                    $aCustomerRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                    $iCustomerNumRows = $InDBConn->GetResultNumRows();

                    if(!empty($aCustomerRow) && ($iCustomerNumRows > 0 && $iCustomerNumRows < 2))
                    {
                        $iCustomerDataIndex = (int) $aCustomerRow['CUST_DATA_ID'];

                        CustomerEditParser($InDBConn, $iCustomerIndex, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                        CustomerDataEditParser($InDBConn, $iCustomerDataIndex, $sName, $sSurname, $sPhoneNumber, $sStableNumber, $sEmail, $sVAT, $sAddr, $sNote, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                        unset($iCustomerDataIndex);
                    }
                    else
                        throw new Exception("Could not fetch result for Company");

                    unset($aCustomerRow, $iCustomerNumRows);
                }
                else
                    throw new Exception("Some POST data do not meet the requirement range");

                unset($sName, $sSurname, $sPhoneNumber, $sStableNumber, $sEmail, $sVAT, $sAddr, $sNote, $iContentAccessIndex, $iCustomerIndex);
                header("Location:.?MenuIndex=".$_ENV['MenuIndex']['Customer']);
            }
            else 
                throw new Exception("Some POST data are not considered numeric type");
        }
        else
			throw new Exception("Some POST data are empty, Those POST cannot be empty");
	}
	else
		throw new Exception("Some POST data are not initialized");
}
?>