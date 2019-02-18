<?php
//-------------<FUNCTION>-------------//
function CustomerAddParser(CDBConnManager &$InDBConn, int $IniAccessIndex, int $IniIsAvailIndex) : void
{
  if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
  {
    if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
    {
      $sDBQuery = "INSERT INTO
      ".$InDBConn->GetPrefix()."VIEW_CUSTOMER
      (
      CUST_DATA_ID,
      CUST_ACCESS,
      CUST_AVAIL
      )
      VALUES
      (
      ".$InDBConn->GetLastQueryID().",
      ".$IniAccessIndex.",
      ".$IniIsAvailIndex."
      );";

      $InDBConn->ExecQuery($sDBQuery, TRUE);

      if(!$InDBConn->HasError())
      {
        if($InDBConn->HasWarning())
          throw new Exception("warning detected: " . $InDBConn->GetWarning());
      }
      else
        throw new Exception($InDBConn->GetError());

      unset($sDBQuery);
    }
    else
      throw new Exception("Input parameters do not meet requirements range");
  }
  else
		throw new Exception("Input parameters are empty");
}

function CustomerDataAddParser(CDBConnManager &$InDBConn, string &$InsName, string &$InsSurname, string &$InsPN, string &$InsSN, string &$InsEmail, string &$InsVAT, string &$InsAddr, string &$InsNote, int $IniAccessIndex, int $IniIsAvailIndex) : void
{
  if(ME_MultyCheckEmptyType($InDBConn, $InsName, $InsSurname, $InsPN, $IniAccessIndex, $IniIsAvailIndex))
  {
    if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
    {
      $sDBQuery = "INSERT INTO
      ".$InDBConn->GetPrefix()."VIEW_CUSTOMER_DATA(
      CUST_DATA_NAME,
      CUST_DATA_SURNAME,
      CUST_DATA_PN,
      CUST_DATA_SN,
      CUST_DATA_EMAIL,
      CUST_DATA_VAT,
      CUST_DATA_ADDR,
      CUST_DATA_NOTE,
      CUST_DATA_ACCESS,
      CUST_DATA_AVAIL)
      VALUES(
      \"".$InsName."\",
      \"".$InsSurname."\",
      \"".$InsPN."\",
      ".(empty($InsSN) ? "NULL" : "\"".$InsSN."\"").",
      ".(empty($InsEmail) ? "NULL" : "\"".$InsEmail."\"").",
      ".(empty($InVat) ? "NULL" : "\"".$InVat."\"").",
      \"".(empty($InsAddr) ? "None" : $InsAddr)."\",
      \"".(empty($InsNote) ? "None" : $InsNote)."\",
      ".$IniAccessIndex.",
      ".$IniIsAvailIndex.");";

      $InDBConn->ExecQuery($sDBQuery, TRUE);

      if(!$InDBConn->HasError())
      {
        if($InDBConn->HasWarning())
          throw new Exception($InDBConn->GetWarning());
      }
      else
        throw new Exception($InDBConn->GetError());

      unset($sDBQuery);
    }
    else
      throw new Exception("Input parameters do not meet requirements range");
  }
  else
		throw new Exception("Input parameters are empty");
}
?>
