<?php
function ProDelJobPIT(CDBConnManager &$InDBConn) : void
{
	if(isset($_POST['JobIndex']))
	{
		if(ME_MultyCheckEmptyType($InDBConn, $_POST['JobIndex']))
		{
			$sJobPitIndex = $_POST['JobIndex'];

			ME_SecDataFilter($sJobPitIndex);

			$iJobPitIndex = (int) $sJobPitIndex;

			unset($sJobIndex);

			JobPITVisParser($InDBConn, $iJobPitIndex, $_ENV['Available']['Hide']);

			unset($iJobPitIndex);
			unset($_POST['JobIndex']);

			header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Job']."&bIsSubOver=1");
		}
	}
}
?>