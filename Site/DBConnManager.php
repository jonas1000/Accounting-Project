<?php

class DBConnManager
{
	//Connection to the database
	private $DBConnMan = 0;
	private $ConnEncoding = 0;

	//The errors and warning message of the execution operations
	private $DBError = 0;
	private $DBWarning = 0;
	private $DBSuccess = 0;

	//boolean flags for if there was errors or warning detected
	private $bHasError = 0;
	private $bHasWarning = 0;

	//Result is used to get the array that the database returned and used as a reference for the arrays
	private $Result = 0;

	//The last id number that the database inserted
	private $LastID = 0;

	//Constructor of the class
	public function __construct($InServerName = "localhost", $InDBUserName = "root", $InDBPassWord = "", $InEncoding = "utf8")
	{
		//Init connection to the database
		$this->DBConnMan = new mysqli($InServerName, $InDBUserName, $InDBPassWord);

		//disable autocommit method in this connection
		$this->DBConnMan->autocommit(FALSE);

		//check if connection was a success
		if($this->DBConnMan->connect_error)
		{
			$this->SetError($this->DBConnMan->errno . " - Failed to create connection: " . $this->DBConnMan->connect_error);
			$bHasError = 1;
		}

		//Set connection encoding type
		if(!$this->DBConnMan->set_charset($InEncoding))
		{
			$this->AddError("Failed to encode connection to " . $InEncoding);
			$bHasError = 1;
		}
		else
			$ConnEncoding = $InEncoding;

		//Select the database from the mysql connection to use
		$this->DBConnMan->select_db($_SESSION['DBName']);

	}

	//Called by class and Destroy() method
	//Warning:never call this method in your code!
	public function __destruct()
	{
		//unset variables for the GC operation to take account of variables destruction
		unset($this->DBConnMan);
		unset($this->DBError);
		unset($this->DBWarning);
		unset($this->DBSuccess);
		unset($this->bHasFailure);
		unset($this->bHasWarning);
		unset($this->ConnEncoding);
		unset($this->Result);
		unset($this->LastID);
	}

	//Execute query, if transaction is false assume it is an operation and not an insert
	//Warning:the transaction method may show errors if your mysql version does not support transaction
	public function ExecQuery($InQuery = null, $InbIsTransaction = FALSE)
	{
		$this->bHasError = 0;
		$this->bHasWarning = 0;

		switch($InQuery)
		{
			case TRUE:
			{
				if($InbIsTransaction)
					$this->QueryTrans($InQuery);
				else
					$this->QueryNoTrans($InQuery);
				break;
			}
			case FALSE:
			{
				$this->SetWarning("Query was empty, abording execution");
				$this->bHasWarning = 1;
				break;
			}
			default:
			{
				printf("Error: Coulnd't get the query status");
			}
		}
	}

	//Close the connection of the database
	public function closeConn()
	{
		$this->DBConnMan->close();
		$this->__destruct();
	}

	//Execute query without transaction method
	private function QueryNoTrans($InQuery)
	{

		$this->Result = $this->DBConnMan->query($InQuery);

		if($this->Result)
		{
			$this->LastID = $this->DBConnMan->insert_id;
		}
		else
		{
			$this->SetError($this->DBConnMan->errno . " - Failed to execute query: " . $this->DBConnMan->error);
			$this->bHasError = 1;
		}
	}

	//Execute query with transaction method
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

	public function GetLastQueryID()
	{
		return $this->LastID;
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
