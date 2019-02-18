<?php
function ProDelEmployeePosition(CDBConnManager &$InDBConn) : void
{
	if(isset($_POST['EmpPosIndex']))
	{
		if(ME_MultyCheckEmptyType($InDBConn, $_POST['EmpPosIndex']))
		{
			$sEmpPosIndex = $_POST['EmpPosIndex'];

			ME_SecDataFilter($sEmpPosIndex);

			$iEmpPosIndex = (int) $sEmpPosIndex;

			unset($sEmpPosIndex);

			EmployeePositionVisParser($InDBConn, $iEmpPosIndex, $_ENV['Available']['Hide']);

			unset($iEmpPosIndex);
			unset($_POST['EmpPosIndex']);

			header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['EmployeePosition']);
		}
	}
}
?>