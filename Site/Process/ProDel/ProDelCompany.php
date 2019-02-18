<?php
function ProDelCompany(CDBConnManager &$InDBConn) : void
{
	if(isset($_POST['CompIndex']))
	{
		if(ME_MultyCheckEmptyType($InDBConn, $_POST['CompIndex']))
		{
			$sCompIndex = $_POST['CompIndex'];

			ME_SecDataFilter($sCompIndex);

			$iCompIndex = (int) $sCompIndex;

			unset($sCompIndex);

			CompanyVisParser($InDBConn, $iCompIndex, $_ENV['Available']['Hide']);

			unset($iCompIndex);
			unset($_POST['CompIndex']);

			header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Company']);
		}
		else
			throw new Exception("Some POST data are NULL, Those POST cannot be NULL");
	}
	else
		throw new Exception("Missing POST data to complete transaction");
}
?>