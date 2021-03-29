<?php
class ME_CLogHandle
{
    public static $iLogCounter = 0;

    //The handles name in the log, this is usefull to be able to aproximate where did the error come from
    private $sHandleLogName = "";

    //The errors and warning message of the execution operations
    private $sLogMessage = "";

    //The resource of ME_CFileHandle class where this class will communicate with
    private $rFile = 0;

    public function __construct(ME_CFileHandle &$InFile, string $InsLogName)
    {
        $this->rFile = &$InFile;

        $this->sHandleLogName = $InsLogName;
    }

    public function __destruct()
    {
        //$this->WriteToFileAndClear();
        unset($this->rFile, $this->sHandleLogName, $this->sLogMessage);
    }

    public function WriteToFile() : void
    {
        if(!empty($this->sLogMessage))
            $this->rFile->Write("\n\r//------<" . $this->sHandleLogName . " - " . ME_CLogHandle::GetDateTime() . ">------//" . PHP_EOL . $this->sLogMessage);
    }

    public function WriteToFileAndClear() : void
    {
        $this->WriteToFile();

        $this->Clear();
    }

    public function Clear() : void
    {
        $this->sLogMessage = "";
    }

    //-----------<GET>-----------//
    public function GetLogMessage() : string
    {
        return $this->sLogMessage;
    }

    public static function GetDate() : string
	{
		$aDateArray = getdate();

		return (string)($aDateArray['mday'] . "-" . $aDateArray['mon'] . "-" . $aDateArray['year']);
	}

	public static function GetTime() : string
	{
		$aDateArray = getdate();

		return (string)($aDateArray['hours'] . ":" . $aDateArray['minutes'] . ":" . $aDateArray['seconds']);
    }

    public static function GetDateTime() : string
    {
        $aDateArray = getdate();

		return (string)($aDateArray['mday'] . "-" . $aDateArray['mon'] . "-" . $aDateArray['year'] . " " .$aDateArray['hours'] . ":" . $aDateArray['minutes'] . ":" . $aDateArray['seconds']);
    }

    public function GetFileName() : string
    {
        return $this->sFileName;
    }

    public function GetFunctionMethodName() : string
    {
        return $this->sFunctionMethodName;
    }

    //-----------<ADD>-----------//
    public function AddSimpleLogMessage(string $InsLogMessage, int $IniLineError) : void
    {
        $this->sLogMessage .= "LOG[" . ME_CLogHandle::$iLogCounter++ . "]-> " . $InsLogMessage . " on line: " . $IniLineError . PHP_EOL;
    }

    public function AddLogMessage(string $InsLogMessage, string $InsFileName, string $InsFunctionMethodName, int $IniLineError) : void
    {
        $this->sLogMessage .= "LOG[" . ME_CLogHandle::$iLogCounter++ . "]-> " . $InsLogMessage . ", File: " . $InsFileName . ", Function/Method: " . $InsFunctionMethodName . ", Line: " . $IniLineError . PHP_EOL;
    }
}
?>