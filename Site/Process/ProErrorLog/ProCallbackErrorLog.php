<?php
function ProFunctionCallback(string $InFunctionCallback, int $IniUserAccessLevel, int $IniContentAccessLevel, string $InsRequestMethod, string $InsErrorLogPath = ".", string $InsAccessErrorPath = "Index.php?MenuIndex=-1")
{
	try
	{
		ME_SecFilterFunctionCallback($InFunctionCallback, $IniUserAccessLevel, $IniContentAccessLevel, $InsRequestMethod);
	}
	catch(Throwable $tExcept)
	{
		$ExceptionErrorLog = new ME_CLog("ErrorLog.txt", $InsErrorLogPath, "a");

		$ExceptionErrorLog->Write("File: " . $tExcept->getFile(). ", Line: " . $tExcept->getLine() . ", Message: " . $tExcept->getMessage() . ", Date: " . $ExceptionErrorLog->GetDate() . " " . $ExceptionErrorLog->GetTime() ."\n");

		unset($ExceptionErrorLog);

		if(isset($_SESSION['Debug']))
		{
			if(!$_SESSION['Debug'])
				header("Location:" . $InsAccessErrorPath);
		}
	}
}

function ProQueryFunctionCallback(ME_CDBConnManager &$InDBConn, string $InFunctionCallback, int $IniUserAccessLevel, int $IniContentAccessLevel, string $InsRequestMethod, string $InsErrorLogPath = ".", string $InsAccessErrorPath = "Index.php?MenuIndex=-1")
{
	try
	{
		ME_SecFilterQueryFunctionCallback($InDBConn, $InFunctionCallback, $IniUserAccessLevel, $IniContentAccessLevel, $InsRequestMethod);
	}
	catch(Throwable $tExcept)
	{
		$ExceptionErrorLog = new ME_CLog("ErrorLog.txt", $InsErrorLogPath, "a");

		$ExceptionErrorLog->Write("File: " . $tExcept->getFile(). ", Line: " . $tExcept->getLine() . ", Message: " . $tExcept->getMessage() . ", Date: " . $ExceptionErrorLog->GetDate() . " " . $ExceptionErrorLog->GetTime() ."\n");

		unset($ExceptionErrorLog);

		if(isset($_SESSION['Debug']))
		{
			if(!$_SESSION['Debug'])
				header("Location:" . $InsAccessErrorPath);
		}
	}
}
?>
