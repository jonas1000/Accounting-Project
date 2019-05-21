<?php
function ME_SecDataFilter(string &$InsData) : string
{
  if(!empty($InsData))
  {
    $InsData = ltrim($InsData);
    $InsData = rtrim($InsData);
    $InsData = trim($InsData);

    $InsData = htmlspecialchars($InsData);
  }

  return $InsData;
}

function ME_SecDataTypeNumberFilter(numeric &$InData) : bool
{
  if(is_int($InData) || is_float($InData) || is_finite($InData))
    return TRUE;
  else
    return FALSE;
}
?>