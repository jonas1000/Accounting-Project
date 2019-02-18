<?php
function ME_MultyCheckNanType(float ...$InfaVar) : bool
{
  $iArrayLenght = count($InfaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_nan($InfaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>