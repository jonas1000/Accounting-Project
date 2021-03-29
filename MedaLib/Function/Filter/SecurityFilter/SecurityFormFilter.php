<?php
function ME_SecDataFilter(string &$InsData) : string
{
  if(!empty($InsData))
  {
    $InsData = trim($InsData);

    $InsData = htmlspecialchars($InsData, ENT_HTML5 | ENT_DISALLOWED | ENT_SUBSTITUTE | ENT_QUOTES);
  }

  return $InsData;
}
?>