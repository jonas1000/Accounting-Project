<?php
function ProDelShareholder(CDBConnManager &$InDBConn) : void
{
	if(isset($_POST['ShareIndex']))
	{
		if(ME_MultyCheckEmptyType($InDBConn, $_POST['ShareIndex']))
		{
			$sShareIndex = $_POST['ShareIndex'];

			ME_SecDataFilter($sShareIndex);

			$iShareIndex = (int) $sShareIndex;

			unset($sShareIndex);

			ShareholderVisParser($InDBConn, $iShareIndex, $_ENV['Available']['Hide']);

			unset($iShareIndex);
			unset($_POST['ShareIndex']);

			header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Shareholder']);
		}
	}
}
?>