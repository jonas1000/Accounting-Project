<?php
class ME_CLog
{
	//Stream source file
	private $rLogFile=0;

	//File name
	private $sLogFileName="";

	//File path
	private $sLogFilePath="";

	//File mode
	private $sLogFileMode="";

	//open file method
	private function OpenFile() : void
	{
		try
		{
			//check if mode is r or r+, those mode do not create automatecally a file.
			if(($this->sLogFileMode == "r") || ($this->sLogFileMode == "r+"))
			{
				if(file_exists(($this->sLogFilePath . $this->sLogFileName)))
				{
					$this->rLogFile = fopen(($this->sLogFilePath . $this->sLogFileName), $this->sLogFileMode);

					if(empty($this->rLogFile))
						throw new Exception("Failed to open the file");
				}
				else
					throw new Exception("File does not exists");
			}
			else
			{
				$this->rLogFile = fopen(($this->sLogFilePath . $this->sLogFileName), $this->sLogFileMode);

				if(!$this->rLogFile)
					throw new Exception("Failed to open the file");
			}
		}
		catch(Throwable $tExcept)
		{
			$rLogSystemErrorFile = fopen("LogSystemError.txt", "a");

			if(!empty($rLogSystemErrorFile))
			{
				fwrite($rLogSystemErrorFile, "File: " . $tExcept->getFile(). " Line: " . $tExcept->getLine() . " Message: " . $tExcept->getMessage() . ", Varibale Resource: ".$this->rLogFile.", Date: ".$this->GetDate()." Time: ".$this->GetTime()."\n");

				fclose($rLogSystemErrorFile);
			}
		}
	}

	//constructor method
	public function __construct(string $InsFileName, string $InsFilePath, string $InsFileMode)
	{
		$this->sLogFileName = $InsFileName;
		$this->sLogFilePath = $InsFilePath . "/";
		$this->sLogFileMode = $InsFileMode;

		$this->OpenFile();
	}

	//destruct method
	public function __destruct()
	{
		try
		{
			if(!$this->CloseFile())
				throw new Exception("Failed to close the file");
		}
		catch(Throwable $tExcept)
		{
			$rLogSystemErrorFile = fopen("LogSystemError.txt", "a");

			if(!empty($rLogSystemErrorFile))
			{
				fwrite($rLogSystemErrorFile, "File: " . $tExcept->getFile(). " Line: " . $tExcept->getLine() . " Message: " . $tExcept->getMessage() . ", Varibale Resource: ".$this->rLogFile.", Date: ".$this->GetDate()." Time: ".$this->GetTime()."\n");

				fclose($rLogSystemErrorFile);
			}
		}

		unset($this->sLogFileName);
		unset($this->sLogFilePath);
		unset($this->sLogFileMode);
	}

	public function CloseFile() : bool
	{
		if(!empty($this->rLogFile))
		{
			if(fclose($this->rLogFile))
				return TRUE;
		}
		else
			return TRUE;

		return FALSE;
	}

	public function Write(string $InsData): void
	{
		fwrite($this->rLogFile, $InsData);
	}

	public function Read() : string
	{
		return fread($this->rLogFile);
	}

	public function SetFileName(string $InsFileName) : void
	{
		$this->sLogFileName = $InsFileName;

		$this->CloseFile();

		$this->OpenFile($this->sLogFileName, $this->sLogFilePath, $this->sLogFileMode);
	}

	public function SetFilePath(string $InsFilePath) : void
	{
		$this->sLogFilePath = $InsFilePath . "/";

		$this->CloseFile();

		$this->OpenFile($this->sLogFileName, $this->sLogFilePath, $this->sLogFileMode);
	}

	public function SetFileMode(string $InsFileMode) : void
	{
		$this->sLogFileMode = $InsFileMode;

		$this->CloseFile();

		$this->OpenFile($this->sLogFileName, $this->sLogFilePath, $this->sLogFileMode);
	}

	public function GetDate() : string
	{
		$aDateArray = getdate();

		return ($aDateArray['mday'] . "-" . $aDateArray['mon'] . "-" . $aDateArray['year']);
	}

	public function GetTime() : string
	{
		$aDateArray = getdate();

		return ($aDateArray['hours'] . ":" . $aDateArray['minutes'] . ":" . $aDateArray['seconds']);
	}

	public function GetFileName() : string
	{
		return $this->sLogFileName;
	}

	public function GetFilePath() : string
	{
		return $this->sLogFilePath;
	}

	public function GetFileMode() : string
	{
		return $this->sLogFileMode;
	}
}
?>