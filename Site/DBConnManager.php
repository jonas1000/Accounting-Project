<?php

class DBConnManager
{
	private $DBConnMan = 0;
	private $ConnEncoding = 0;
	private $DBError = 0;
	private $DBWarning = 0;
	private $DBSuccess = 0;
	private $bHasError = 0;
	private $bHasWarning = 0;
	private $Result = 0;

	public function __construct($InServerName = "localhost", $InDBUserName = "root", $InDBPassWord = "", $InEncoding = "utf8")
	{
		$this->DBConnMan = new mysqli($InServerName, $InDBUserName, $InDBPassWord);

		$this->DBConnMan->autocommit(FALSE);

		if($this->DBConnMan->connect_error)
		{
			$this->SetError($this->DBConnMan->errno . " - Failed to create connection: " . $this->DBConnMan->connect_error);
			$bHasError = 1;
		}

		if(!$this->DBConnMan->set_charset($InEncoding))
		{
			$this->AddError("Failed to encode connection to " . $InEncoding);
			$bHasError = 1;
		}
		else
			$ConnEncoding = $InEncoding;

		$this->ExecQuery("USE " . $_SERVER['DBName'], FALSE);
	}

	public function __destruct()
	{
		$this->DBConnMan = null;
		$this->DBError = null;
		$this->DBWarning = null;
		$this->DBSuccess = null;
		$this->bHasFailure = null;
		$this->bHasWarning = null;
		$this->ConnEncoding = null;
		$this->Result = null;
	}

	public function ExecQuery($InQuery = null, $InbIsTransaction = FALSE)
	{
		$this->bHasError = 0;
		$this->bHasWarning = 0;

		if(!$InQuery === FALSE)
		{
			if($InbIsTransaction)
				$this->QueryTrans($InQuery);
			else
				$this->QueryNoTrans($InQuery);
		}
		else
		{
			$this->SetWarning("Query was empty, abording execution");
			$this->bHasWarning = 1;
		}
	}

	public function closeConn()
	{
		$this->DBConnMan->close();
		$this->__destruct();
	}

	private function QueryNoTrans($InQuery)
	{

		$this->Result = $this->DBConnMan->query($InQuery);

		if($this->Result)
		{
			$this->SetSuccess("Succesfully executed query");
		}
		else
		{
			$this->SetError($this->DBConnMan->errno . " - Failed to execute query: " . $this->DBConnMan->error);
			$this->bHasError = 1;
		}
	}

	private function QueryTrans($InQuery)
	{
		$this->DBConnMan->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

		$this->QueryNoTrans($InQuery);

		if(!$this->DBConnMan->commit())
		{
			$this->bHasError = 1;
			$this->SetError("<br>Failed to commit");
		}
	}

	//-----------<GET>-----------//
	public function HasError()
	{
		return $this->bHasError;
	}

	public function HasWarning()
	{
		return $this->bHasWarning;
	}

	public function GetError()
	{
		return $this->DBError;
	}

	public function GetWarning()
	{
		return $this->DBWarning;
	}

	public function GetSuccess()
	{
		return $this->DBSuccess;
	}

	public function GetLastQueryInsID()
	{
		return $this->insert_id;
	}

	public function GetEncoding()
	{
		return $this->ConnEncoding;
	}

	public function GetResult()
	{
		if($this->DBConnMan->field_count > 0)
			return $this->Result;
		else
			return 0;
	}

	//-----------<SET>-----------//
	protected function SetError($InError)
	{
		$this->DBError = $InError;
	}

	protected function SetWarning($InWarning)
	{
		$this->DBWarning = $InWarning;
	}

	protected function SetSuccess($InSuccess)
	{
		$this->DBSuccess = $InSuccess;
	}

	public function SetEncoding($InEncoding)
	{
		if(!$this->DBConnMan->set_charset($InEncoding))
			printf("Failed to change the encoding to: " . $InEncoding);
	}

	//-----------<ADD>-----------//
	protected function AddError($InError)
	{
		$this->DBError .= "<br>" . $InError;
	}

	protected function AddWarning($InWarning)
	{
		$this->DBWarning .= "<br>" . $InWarning;
	}

	Protected function AddSuccess($InSuccess)
	{
		$this->DBSuccess .= "<br>" . $InSuccess;
	}
}

?>
