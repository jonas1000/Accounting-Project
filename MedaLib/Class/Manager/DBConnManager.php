<?php
class ME_CDBConnManager
{
    public $bFailedToConnect = TRUE;

    private $rDBLogHandle = 0;

    //Connection to the database
    private $rDBConnMan = 0;

    private $sDBName = "";

    //QueryResult is used to get the array that the database returned and used as a reference for the arrays
    //private $rQueryResult = 0;

    //The last id number that the database inserted
    private $iLastInsertIndex = 0;

    private $sPrefix = "";

    //Constructor of the class
    public function __construct(ME_CLogHandle &$InrLogHandle, string &$InsDBName, string &$InsServerName = "localhost", string &$InsDBUserName = "root", string &$InsDBPassword = "", string &$InsPrefix = "", string &$InsEncoding = "utf8")
    {
        $this->rDBLogHandle = $InrLogHandle;

        $this->sPrefix = $InsPrefix;
        $this->sDBName = $InsDBName;

        //Init connection to the database
        $this->rDBConnMan = new mysqli($InsServerName, $InsDBUserName, $InsDBPassword, $this->sPrefix . $this->sDBName);

        //check if connection was a success
        if($this->rDBConnMan->connect_error)
        {
            $this->bFailedToConnect = true;
            
            $this->rDBLogHandle->AddLogMessage($this->rDBConnMan->errno . " - Failed to create connection: " . $this->rDBConnMan->connect_error, __FILE__, __METHOD__, __LINE__);
        }
        else
        {
            $this->bFailedToConnect = FALSE;

            //disable autocommit method in this connection
            $this->rDBConnMan->autocommit(false);

            //Set connection encoding type
            if(!$this->rDBConnMan->set_charset($InsEncoding))
                $this->rDBLogHandle->AddLogMessage("Failed to encode connection to " . $InsEncoding, __FILE__, __METHOD__, __LINE__);

            //Select the database from the mysql connection to use
            $this->rDBConnMan->select_db($this->sPrefix . $this->sDBName);
        }
    }

    //Called by class out of scope or unset function
    //Warning:never call this method in your code!
    public function __destruct()
    {
        $this->CloseConn();

        //unset variables for the GC operation to take account of variables destruction
        unset($this->rDBConnMan, $this->sDBName, $this->iLastInsertIndex, $this->sPrefix);
    }

    //Close the connection of the database
    private function CloseConn() : void
    {        
        if(!empty($this->rDBConnMan))
        {
            $this->rDBConnMan->kill($this->rDBConnMan->thread_id);
            $this->rDBConnMan->close();
        }
    }

    public function CreateStatement(string &$InsDBQuery)
    {
        $rDBStatement = $this->rDBConnMan->stmt_init();

        if($rDBStatement->prepare($InsDBQuery))
            return $rDBStatement;

        $this->rDBLogHandle->AddLogMessage("Errorno: " . $this->rDBConnMan->errno . ", Error: " . $this->rDBConnMan->error, __FILE__, __METHOD__, __LINE__);

        return FALSE;
    }

    public function Commit() : bool
    {
        if(!$this->rDBConnMan->commit())
        {
            $this->rDBLogHandle->AddLogMessage("Failed to commit, Errorno: " . $this->rDBConnMan->errno . ", Error: " . $this->rDBConnMan->error, __FILE__, __METHOD__, __LINE__);

            return FALSE;
        }
        
        return TRUE;
    }

    public function RollBack() : bool
    {
        if(!$this->rDBConnMan->rollback())
        {
            $this->rDBLogHandle->AddLogMessage("Failed to rollback, Errorno: " . $this->rDBConnMan->errno . ", Error: " . $this->rDBConnMan->error, __FILE__, __METHOD__, __LINE__);

            return FALSE;
        }
        
        return TRUE;
    }

    //-----------<GET>-----------//
    public function GetLastInsertID() : int
    {
        return $this->iLastInsertIndex;
    }

    public function GetEncoding() : object
    {
        return $this->rDBConnMan->get_charset();
    }

    public function GetPrefix() : string
    {
        return $this->sPrefix;
    }

    public function GetDBName() : string
    {
        return $this->sDBName;
    }

    public function GetMySQLI() : mysqli
    {
        return $this->rDBConnMan;
    }

    //-----------<SET>-----------//
    public function SetLastInsertID(int $IniLastIndex) : void
    {
        $this->iLastInsertIndex = $IniLastIndex;
    }

    public function SetEncoding(string $InsEncoding) : bool
    {
        if (!$this->rDBConnMan->set_charset($InsEncoding))
        {
            $this->rDBLogHandle->AddLogMessage("Errorno: " . $this->rDBConnMan->errno . ", Error: " . $this->rDBConnMan->error, __FILE__, __METHOD__, __LINE__);

            return FALSE;
        }

        return TRUE;
    }

    public function SetPrefix(string $InsPrefix = "AT4553_") : void
    {
        $this->sPrefix = $InsPrefix;
    }

    public function SetNewDBName(string $InsDBName) : void
    {
        $this->sDBName = $InsDBName;

        //Select the database from the mysql connection to use
        if(!$this->rDBConnMan->select_db($this->sPrefix . $this->sDBName))
        {
            $this->rDBLogHandle->AddLogMessage("Errorno: " . $this->rDBConnMan->errno . ", Error: " . $this->rDBConnMan->error, __FILE__, __METHOD__, __LINE__);

            $this->bFailedToConnect = TRUE;
        }
        else
            $this->bFailedToConnect = FALSE;
    }
}
 ?>