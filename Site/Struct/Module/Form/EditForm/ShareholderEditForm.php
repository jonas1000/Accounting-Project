<?php
//-------------<FUNCTION>-------------//
function HTMLShareholderEditForm(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
    if(isset($_POST['ShareIndex']))
    {
        if(!empty($_POST['ShareIndex']))
        {
            $iShareholderIndex = (int) $_POST['ShareIndex'];

            unset($_POST['ShareIndex']);

            if($iShareholderIndex > 0)
            {
                ShareholderGeneralSpecificRetriever($InDBConn, $iShareholderIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                $aShareholderRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                $iShareholderNumRows = $InDBConn->GetResultNumRows();

                if(!empty($aShareholderRow) && ($iShareholderNumRows > 0 && $iShareholderNumRows < 2))
                {
                    $iShareholderAccessIndex = (int) $aShareholderRow['SHARE_ACCESS'];
                    $iEmployeeIndex = (int) $aShareholderRow['EMP_ID'];

                    print("<div class='Form'>");
                    print("<form method='POST'>");
                    print("<div>");

                    //Title
                    print("<div id='FormTitle'>");
                    print("<h3>Edit Shareholder</h3>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Employee</h5>");
                    print("</div>");

                    print("<div>");
                    RenderEmployeeSelectRow($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show'], $iEmployeeIndex);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Access</ph5>");
                    print("</div>");

                    print("<div>");
                    RenderAccessSelectRow($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show'], $iShareholderAccessIndex);
                    print("</div>");
                    print("</div>");

                    print("</div>");

                    print("<div>");
                    printf("<input type='hidden' value='%s' required>", $aShareholderRow['SHARE_ID']);
                    printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProEdit'>", $_GET['MenuInded'], $_GET['Module']);
                    printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a>", $_GET['MenuIndex']);
                    print("</div>");

                    print("</form>");

                    print("</div>");

                    unset($iShareholderAccessIndex, $iEmployeeIndex);
                }
                else
                    throw new Exception("Query did not return any row");

                unset($aShareholderRow, $iShareholderIndex, $iShareholderNumRows);
            }
            else
                throw new Exception("POST data could not be converted to required format");
        }
        else
			throw new Exception("Some POST data are empty, Those POST cannot be empty");
	}
	else
		throw new Exception("Some POST data are not initialized");
}
?>