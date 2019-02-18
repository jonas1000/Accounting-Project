<?php

class CDBConnManager
{
	//Connection to the database
	private $rDBConnMan = 0;

	private $sDBName = "";

	//The errors and warning message of the execution operations
	private $sDBError = "";
	private $sDBWarning = "";
	private $sDBSuccess = "";

	//boolean flags for if there was errors or warning detected
	private $bHasError = FALSE;
	private $bHasWarning = FALSE;

	//QueryResult is used to get the array that the database returned and used as a reference for the arrays
	private $QueryResult = 0;

	//The last id number that the database inserted
	private $iLastIndex = 0;

	private $sPrefix = "";

	//Constructor of the class
	public function __construct(string &$InsServerName = "localhost", string &$InsDBName, string &$InsDBUserName = "root", string &$InsDBPassword = "", string &$InsPrefix = "", string &$InsEncoding = "utf8")
	{
		$this->sPrefix = $InsPrefix;

		//Init connection to the database
		$this->rDBConnMan = new mysqli($InsServerName, $InsDBUserName, $InsDBPassword);

		//disable autocommit method in this connection
		$this->rDBConnMan->autocommit(FALSE);

		//check if connection was a success
		if($this->rDBConnMan->connect_error)
		{
			$this->SetError($this->rDBConnMan->errno . " - Failed to create connection: " . $this->rDBConnMan->connect_error);
			$bHasError = 1;
		}

		//Set connection encoding type
		if(!$this->rDBConnMan->set_charset($InsEncoding))
		{
			$this->AddError("Failed to encode connection to " . $InsEncoding);
			$bHasError = 1;
		}

		//Select the database from the mysql connection to use
		$this->rDBConnMan->select_db($this->sPrefix . $InsDBName);

		$this->sDBName = $InsDBName;

	}

	//Called by class out of scope or unset function
	//Warning:never call this method in your code!
	public function __destruct()
	{
		$this->CloseConn();

		//unset variables for the GC operation to take account of variables destruction
		unset($this->rDBConnMan, $this->sDBError, $this->sDBWarning, $this->sDBSuccess);
		unset($this->bHasFailure, $this->bHasWarning, $this->sDBName);
		unset($this->QueryResult, $this->iLastIndex);
	}

	//Execute query, if transaction is false assume it is an operation and not an insert or update
	//Warning:the transaction method may show errors if your mysql version does not support transaction
	public function ExecQuery(string &$InQuery = NULL, bool $InbIsTransaction = FALSE) : void
	{
		$this->bHasError = 0;
		$this->bHasWarning = 0;

		switch((!empty($InQuery)))
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
				$this->SetError("Coulnd't get the query status");
				$this->bHasError = 1;
			}
		}
	}

	//Close the connection of the database
	public function CloseConn() : void
	{
		if(!empty($this->eDBConnMan))
			$this->rDBConnMan->close();
	}

	//Execute query without transaction method
	private function QueryNoTrans(string &$InsQuery) : void
	{

		$this->QueryResult = $this->rDBConnMan->query($InsQuery);

		if($this->QueryResult)
		{
			$this->iLastIndex = $this->rDBConnMan->insert_id;
		}
		else
		{
			$this->SetError($this->rDBConnMan->errno . " - Failed to execute query: " . $this->rDBConnMan->error);
			$this->bHasError = 1;
		}
	}

	//Execute query with transaction method
	private function QueryTrans(&$InQuery)
	{
		$this->rDBConnMan->begin_transaction();

		$this->QueryNoTrans($InQuery);

		if(!$this->bHasError)
		{
			if(!$this->rDBConnMan->commit())
			{
				$this->bHasError = 1;
				$this->AddError("Failed to commit");
			}
		}
		else
		{
			if(!$this->rDBConnMan->rollback())
				$this->AddError("Failed to rollback transaction");
			$this->AddError("Rollback transaction");
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
		return $this->sDBError;
	}

	public function GetWarning()
	{
		return $this->sDBWarning;
	}

	public function GetSuccess()
	{
		return $this->sDBSuccess;
	}

	public function GetLastQueryID()
	{
		return $this->iLastIndex;
	}

	public function GetEncoding()
	{
		return $this->rDBConnMan->get_charset();
	}

	public function GetResult()
	{
		if(!empty($this->QueryResult))
			return $this->QueryResult;
		else
			return 0;
	}

	public function GetPrefix() : string
	{
		return $this->sPrefix;
	}

	public function GetDBName() : string
	{
		return $this->sDBName;
	}

	//-----------<SET>-----------//
	protected function SetError(string $InsError) : void
	{
		$this->sDBError = $InsError;
	}

	protected function SetWarning(string $InsWarning) : void
	{
		$this->sDBWarning = $InsWarning;
	}

	protected function SetSuccess(string $InsSuccess) : void
	{
		$this->sDBSuccess = $InsSuccess;
	}

	public function SetLastQueryID(int $IniLastIndex) : void
	{
		$this->iLastIndex = $IniLastIndex;
	}

	public function SetEncoding(string $InsEncoding) : void
	{
		if(!$this->rDBConnMan->set_charset($InsEncoding))
			throw new Exception("Failed to change the encoding to: " . $InsEncoding);
	}

	public function SetPrefix(string $InsPrefix = "AT4553_") : void
	{
		$this->sPrefix = $InsPrefix;
	}

	//-----------<ADD>-----------//
	protected function AddError(string $InsError) : void
	{
		$this->sDBError .= "\n" . $InsError;
	}

	protected function AddWarning(string $InsWarning) : void
	{
		$this->sDBWarning .= "\n" . $InsWarning;
	}

	Protected function AddSuccess(string $InsSuccess) : void
	{
		$this->sDBSuccess .= "\n" . $InsSuccess;
	}
}

?>
