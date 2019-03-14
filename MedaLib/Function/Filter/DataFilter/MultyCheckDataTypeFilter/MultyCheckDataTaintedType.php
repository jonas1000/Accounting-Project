<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is Tainted
//Return false the first key it finds is not Tainted
function ME_MultyCheckTaintedType(string ...$InsaVar) : bool
{
  $iArrayLenght = count($InsaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_Tainted($InsaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>