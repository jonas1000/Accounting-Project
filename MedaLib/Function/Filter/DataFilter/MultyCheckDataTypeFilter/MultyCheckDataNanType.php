<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is not a number(NAN)
//Return false the first key it finds is not a number(NAN)
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