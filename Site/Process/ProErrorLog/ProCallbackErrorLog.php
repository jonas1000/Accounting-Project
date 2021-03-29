<?php
function ProFunctionCallback(ME_CLogHandle &$InrLogHandle, string $InFunctionCallback, int $IniContentAccess, string $InsRequestMethod = "GET") : bool
{
	try
	{
		if(isset($_SESSION['AccessID']))
			return ME_SecFilterFunctionCallback($InrLogHandle, $InFunctionCallback, $_SESSION['AccessID'], $IniContentAccess, $InsRequestMethod);
		else
			$InrLogHandle->AddLogMessage("User access ID is not set, User access ID must be set", __FILE__, __FUNCTION__, __LINE__);
	}
	catch(Throwable $rExcept)
	{
		$InrLogHandle->AddLogMessage($rExcept->getMessage(), $rExcept->getFile(), "NULL", $rExcept->getLine());
	}

	return FALSE;
}

function ProQueryFunctionCallback(ME_CDBConnManager &$InrDBConn, ME_CLogHandle &$InrLogHandle, string $InFunctionCallback, int $IniContentAccess, string $InsRequestMethod) : bool
{
	try
	{
		if(isset($_SESSION['AccessID']))
			return ME_SecFilterQueryFunctionCallback($InrDBConn, $InrLogHandle, $InFunctionCallback, $_SESSION['AccessID'], $IniContentAccess, $InsRequestMethod);
		else
			$InrLogHandle->AddLogMessage("User access ID is not set, User access ID must be set", __FILE__, __FUNCTION__, __LINE__);
	}
	catch(Throwable $rExcept)
	{
		$InrLogHandle->AddLogMessage($rExcept->getMessage(), $rExcept->getFile(), "NULL", $rExcept->getLine());
	}

	return FALSE;
}
?>
