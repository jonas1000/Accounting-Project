<?php
function ProDelEmployee(CDBConnManager &$InDBConn) : void
{
	if(isset($_POST['EmpIndex']))
	{
		if(ME_MultyCheckEmptyType($InDBConn, $_POST['EmpIndex']))
		{
			$sEmpIndex = $_POST['EmpIndex'];

			ME_SecDataFilter($sEmpIndex);

			$iEmpIndex = (int) $sEmpIndex;

			unset($sEmpIndex);

			EmployeeVisParser($InDBConn, $iEmpIndex, $_ENV['Available']['Hide']);

			unset($iEmpIndex);
			unset($_POST['EmpIndex']);

			header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Employee']);
		}
	}
}
?>