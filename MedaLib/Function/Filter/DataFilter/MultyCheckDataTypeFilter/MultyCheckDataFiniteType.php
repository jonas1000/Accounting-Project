<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is Finite
//Return false the first key it finds is not Finite
function ME_MultyCheckFiniteType(float ...$InfaVar) : bool
{
  $iArrayLenght = count($InfaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_finite($InfaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>